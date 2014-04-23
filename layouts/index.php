<?php if (!defined('IN_APP')) die(); ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Comments</title>
		
		<link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" media="all" href="<?php echo $app->_href('/css/style.css'); ?>" />
		
		<script>
			var SITE_URL = '<?php echo $app->_href(); ?>';
		</script>
		
		<script src="<?php echo $app->_href('/js/jquery.js'); ?>"></script>
		<script src="<?php echo $app->_href('/js/jquery.validate.min.js'); ?>"></script>
		<script src="<?php echo $app->_href('/js/custom.js'); ?>"></script>
	</head>
	
	<body>
		<div id="container">
			<?php $app->_view(); ?>
		</div>
	</body>
</html>