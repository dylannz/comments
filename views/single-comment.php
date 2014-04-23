<div id="comment_<?php echo $comment['id']; ?>" class="comment" data-comment_id="<?php echo $comment['id']; ?>">
	<div class="comment-info">
		<a href="#comment_<?php echo $comment['id']; ?>" class="number">#<?php echo $comment['id']; ?></a>
		<img src="<?php echo htmlentities($comment['gravatar_url']); ?>" width="80" height="80" class="comment-image" />
		<h3 class="comment-name"><?php echo htmlentities($comment['name']); ?></h3>
		<h4 class="comment-email"><a href="mailto:<?php echo htmlentities($comment['email']); ?>"><?php echo htmlentities($comment['email']); ?></a></h4>
	</div>
	<div class="comment-text">
		<p><?php echo nl2br(htmlentities($comment['comment'])); ?></p>
		<p><a href="#" class="reply">Reply</a></p>
	</div>
</div>