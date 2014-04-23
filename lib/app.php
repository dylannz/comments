<?php

class App {
	public function __construct() {
		global $config;
		$this->config = $config;
		
		$this->db = new BlackliteDB(
			$this->config['DB_HOST'],
			$this->config['DB_USER'],
			$this->config['DB_PASS'],
			$this->config['DB_NAME']
		);
		
		$this->root = dirname(dirname(__FILE__));
		
		$this->template = new stdClass();
		$this->view = 'index';
		$this->viewVars = array();
		$this->layout = 'index';
		$this->action = _get('action', 'index');
		
		// If action is not found, die with 404 error
		if (preg_match('/^_/', $this->action) || !method_exists($this, $this->action)) {
			header('HTTP/1.0 404 Not Found');
			echo '<h1>404 not found</h1>';
			die();
		}
		
		call_user_func(array($this, $this->action));
	}
	
	public function _set($one, $two = null) {
		if (is_array($one)) {
			if (is_array($two)) {
				$data = array_combine($one, $two);
			} else {
				$data = $one;
			}
		} else {
			$data = array($one => $two);
		}
		$this->viewVars = $data + $this->viewVars;
	}
	
	public function _view($view = null, $set = array()) {
		global $app;
		$this->_set($set);
		extract($this->viewVars);
		include($this->root . '/views/' . ($view ? $view : $this->view) . '.php');
	}
	
	public function _href($extra = null) {
		return $this->config['URL'] . $extra;
	}
	
	private function _404() {
		
	}
	
	private function index() {
		$this->template->comments = $this->db->get_results(
			"SELECT * FROM comments ORDER BY id ASC"
		);
	}
	
	private function add() {
		$name = _post('name');
		$email = _post('email');
		$comment = _post('comment');
		if (!$name || !$email || !$comment || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($name) > 50 || strlen($email) > 255) {
			die(); // have no mercy
		}
		$comment = array(
			'parent_id' => 0,
			'gravatar_url' => get_gravatar($email),
			'name' => $name,
			'email' => $email,
			'comment' => $comment,
			'ip_address' => $_SERVER['REMOTE_ADDR'],
			'user_agent' => $_SERVER['HTTP_USER_AGENT']
		);
		
		$this->db->query(
			$this->db->prepare(
				"
				INSERT INTO comments
				(
					`parent_id`,
					`gravatar_url`,
					`name`,
					`email`,
					`comment`,
					`ip_address`,
					`user_agent`,
					`timestamp`
				)
				VALUES (
					%d, %s, %s, %s, %s, %s, %s, UNIX_TIMESTAMP()
				)
				",
				$comment
			)
		);
		
		$newID = $this->db->insert_id();
		
		if ($newID) {
			$comment = $this->db->get_row(
				$this->db->prepare(
					"SELECT * FROM comments WHERE id=%d",
					array(
						$newID
					)
				)
			);
			$this->_view('single-comment', compact('comment'));
		}
		die();
	}
	
}

global $app;
$app = new App();