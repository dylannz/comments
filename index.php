<?php

/*
	Include required files
*/

define('IN_APP', true);

require_once('config.php');

require_once('lib/functions.php');
require_once('lib/db.php');
require_once('lib/app.php');

include('layouts/' . $app->layout . '.php');