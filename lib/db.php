<?php
if(!class_exists('BlackliteDB')):
class BlackliteDB {
	/*
		Title: 		BlackliteDB MySQL Database Class
		Author: 	Blacklite
		Email: 		blacklite@sacnr.com

		Purpose: 	Based off functions from the Wordpress database class.
					It's really just a simpler, less bloated version of
					the WP-DB class.
		
		Changelog:
			2012/07/25	Updated to use mysqli instead of the soon-to-be-
						deprecated mysql extension
	*/

	private $queries;

	function __construct($host, $user, $pass, $db) {
		$this->mysqli = new mysqli($host, $user, $pass, $db);
		$this->queries = 0;
		return true;
	}

	function __destruct() {
		if (!$this->mysqli) {
			return false;
		}
		unset($this->mysqli);
		return true;
	}

	function prepare($query, $args) {
		foreach($args as &$v) {
			$v = $this->real_escape_string($v);
		}
		$query = str_replace(array("'%s'", '"%s"'), '%s', $query);
		$query = str_replace('%s', "'%s'", $query);
		return @vsprintf($query, $args);
	}

	function real_escape_string($str) {
		return $this->mysqli->real_escape_string($str);
	}

	public function get_results($query) {
		$r = $this->query($query);
		if (is_bool($r)) {
			return $r;
		}
		$a = array();
		while(($a[] = $r->fetch_assoc()) || array_pop($a)); 
		$this->free_result($r);
		return $a;
	}

	public function get_var($query, $colnum = 0) {
		$r = $this->query($query);
		if (is_bool($r)) {
			return $r;
		}
		$a = $r->fetch_assoc();
		$this->free_result($r);
		$i = 0;
		if (is_array($a)) {
			foreach($a as $v) {
				if ($i == $colnum) {
					return $v;
				}
				$i++;
			}
		}
		return false;
	}

	public function get_row($query, $rownum = 0) {
		$r = $this->query($query);
		if (is_bool($r)) {
			return $r;
		}
		for($i = 0; $a = $r->fetch_assoc(); $i++) {
			if ($i == $rownum) {
				$this->free_result($r);
				return $a;
			}
		}
		$this->free_result($r);
		return false;
	}

	public function query($query) {
		$this->queries++;
		$r = $this->mysqli->query($query);
		if ($r === false) {
			die($this->error());
		}
		return $r;
	}

	public function error() {
		return $this->mysqli->error;
	}

	public function insert_id() {
		return $this->mysqli->insert_id;
	}

	public function affected_rows() {
		return $this->mysqli->affected_rows;
	}

	public function free_result($result) {
		return $result->free();
	}
	
	public function queries() {
		return $this->queries;
	}
}
endif;
