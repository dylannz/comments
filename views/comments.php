<?php
if (!isset($app->template->comments) || !$app->template->comments) {
	?>
	<p>There are no comments at this time.</p>
	<?php
	return;
}

foreach($app->template->comments as $comment) {
	$app->_view('single-comment', compact('comment'));
}
