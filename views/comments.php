<?php
if (!isset($comments) || !$comments) {
	if (!isset($comment_parent_id) || !$comment_parent_id) {
		?>
		<p>There are no comments at this time.</p>
		<?php
	}
	return;
}

if (!isset($comment_parent_id)) {
	$comment_parent_id = 0;
}
foreach($comments as $comment) {
	if ($comment['parent_id'] != $comment_parent_id) {
		continue;
	}
	$app->_view('single-comment', compact('comment'));
}
