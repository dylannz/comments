<?php if (!defined('IN_APP')) die(); ?>

<div id="comments-list">
	<h2>Comments</h2>
	
	<div id="all-comments">
		<?php /* $app->_view('comments'); */ ?>
		
		<?php for ($i = 0; $i < 20; $i++): ?>
			<div id="comment_<?php echo $i; ?>" class="comment" data-comment_id="123456">
				<div class="comment-info">
					<a href="#comment_<?php echo $i; ?>" class="number">#<?php echo $i; ?></a>
					<img src="http://dummyimage.com/80x80/000/fff&text=Gravatar" width="80" height="80" class="comment-image" />
					<h3 class="comment-name">Dylan Jennings</h3>
					<h4 class="comment-email"><a href="mailto:dylan@dt.net.nz">dylan@dt.net.nz</a></h4>
				</div>
				<div class="comment-text">
					<p>Donec at nibh non quam pulvinar hendrerit a at erat. Nunc porttitor ultrices condimentum. Sed scelerisque massa sed leo fermentum, id facilisis urna ultricies. Aliquam pulvinar fringilla felis non commodo. Sed in congue nisi. In tincidunt dignissim ipsum. Integer id porttitor felis, vestibulum sollicitudin lectus. Ut quis placerat enim, nec convallis massa. Mauris ac iaculis diam.</p>
					<p>Fusce a quam risus. Suspendisse interdum enim nec magna dictum posuere. In ut arcu a purus dignissim facilisis vel quis libero. Nunc sem dui, luctus id velit sed, rhoncus pharetra velit. Quisque neque arcu, vestibulum tincidunt volutpat eget, sodales vel nibh. Quisque laoreet tellus at arcu ultrices adipiscing. Nullam molestie fermentum hendrerit. Sed ligula augue, luctus vehicula fringilla eu, lacinia eu nisl.</p>
				</div>
			</div>
		<?php endfor; ?>
	</div>
</div>

<div id="new-comment">
	<form id="new-comment-form" action="" method="post">
		<h2>New comment</h2>
		
		<div class="field text">
			<label for="new-comment-name">Name: </label>
			<input id="new-comment-name" type="text" maxlength="50" name="name" class="input-text" />
		</div>
		
		<div class="field text">
			<label for="new-comment-email">Email: </label>
			<input id="new-comment-email" type="email" maxlength="255" name="email" class="input-text" />
		</div>
		
		<div class="field textarea">
			<label for="new-comment-comment">Comment: </label>
			<textarea class="input-textarea" name="comment" id="new-comment-comment"></textarea>
		</div>
		
		<div class="field button">
			<input type="submit" class="input-button" value="Post comment" />
		</div>
	</form>
</div>
