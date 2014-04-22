<?php
function _get($var, $repl = null) {
	return isset($_GET[$var]) && $_GET[$var] ? $_GET[$var] : $repl;
}

function _post($var, $repl = null) {
	return isset($_POST[$var]) && $_POST[$var] ? $_POST[$var] : $repl;
}