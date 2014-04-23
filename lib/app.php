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
		
		$this->view = 'index';
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
	
	public function _view($view = null) {
		global $app;
		include($this->root . '/views/' . ($view ? $view : $this->view) . '.php');
	}
	
	public function _href($extra = null) {
		return $this->config['URL'] . $extra;
	}
	
	private function _404() {
		
	}
	
	private function index() {
		
	}
	
}

global $app;
$app = new App();