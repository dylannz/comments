# AJAX comment system

Features:

* AJAX comment submission
* Threaded replies
* Gravatar 
* Link to specific comments with #comment_X
* Basic clientside and serverside input validation

## Configuration
Copy config.default.php to config.php and make any necessary changes to fit your setup.

## Framework
This project does not use an existing PHP framework. I wrote it myself to show knowledge of code rather than knowledge of a particular framework.

## Database
A MySQL database server is required. The SQL for the database is included in comments.sql.

## What have I used from other libraries?
I wrote all of the code in this repository, except for:

* jQuery library + validation plugin
* get_gravatar() in lib/functions.php
* $app->_set() in lib/app.php (pulled from cakePHP)
* reset.css stuff in css/style.css