<?php if (!defined('IN_APP')) die(); ?>

<div id="comments-list">
	<h2>Comments</h2>
	
	<div id="all-comments">
		<div class="comment abstract" data-comment_id="">
			<div class="comment-info">
				<a href="" class="number">#</a>
				<img src="" width="80" height="80" class="comment-image" />
				<h3 class="comment-name"></h3>
				<h4 class="comment-email"><a href=""></a></h4>
			</div>
			<div class="comment-text">
				<p></p>
			</div>
		</div>
		
		<?php $app->_view('comments'); ?>
	</div>
</div>

<div class="new-comment">
	<h2>New comment</h2>
	<form class="new-comment-form" action="" method="post">
		<input type="hidden" name="parent_id" value="0" />
		
		<div class="field text">
			<label>Name: </label>
			<input type="text" maxlength="50" name="name" class="input-text" />
		</div>
		
		<div class="field text">
			<label>Email: </label>
			<input type="email" maxlength="255" name="email" class="input-text" />
		</div>
		
		<div class="field textarea">
			<label>Comment: </label>
			<textarea class="input-textarea" name="comment"></textarea>
		</div>
		
		<div class="field button">
			<input type="submit" class="input-button" value="Post comment" />
		</div>
	</form>
</div>
