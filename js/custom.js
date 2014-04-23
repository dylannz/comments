var Comments = function() {
	var C = this;
	
	// Set initial variables
	C.SITE_URL = window.SITE_URL;
	C.allComments = $('#all-comments');
	C.newCommentForm = $('form.new-comment-form');
	
	// New/reply comment form validation rules and submit handler
	C.newCommentFormVal = {
		rules: {
			name: {
				required: true
			},
			email: {
				required: true,
				email: true
			},
			comment: {
				required: true
			}
		},
		submitHandler: function(form) {
			var data = $(form).serialize();
			$.post(C.url('/?action=add'), data, function(r){
				if (r) {
					// If this is a reply...
					if ($(form).children('input[name=parent_id]').val() != '0') {
						var p = $(form).parents('.comment:first');
						$(form).slideUp(300, function(){
							$(this).remove();
						});
						p.append(r);
						p.removeClass('active-reply');
						C.loadReply(p.children('.comment:last'));
					} else {
						// Nope, not a reply - add to top level!
						C.allComments.append(r);
						C.loadReply(C.allComments.children('.comment:last'));
						$(form).find('input[type=text],input[type=email],textarea').val('');
					}
				} else {
					alert('Comment failed to post!');
				}
			});
		}
	};
	C.abstractComment = C.allComments.children('.comment.abstract');
	
	// Load validation for new comment form
	C.loadNewComment = function() {
		C.newCommentForm.validate(C.newCommentFormVal);
	}
	
	// Load reply links for all comments (that are not abstract)
	C.loadReplies = function() {
		C.allComments.find('div.comment').not('.abstract').each(function(){
			C.loadReply($(this));
		});
	}
	
	// Attach callback for clicking "Reply" link for a single comment element
	C.loadReply = function(comment) {
		comment.find('a.reply').unbind('click').click(function(e){
			e.preventDefault();
			if (comment.children('form.new-comment-form').length > 0) {
				comment.children('form.new-comment-form').slideUp(300, function(){
					$(this).remove();
				});
				comment.removeClass('active-reply');
			} else {
				var n = C.newCommentForm.clone();
				n.prepend('<h2>Reply</h2>');
				n.children('input[name=parent_id]').val(comment.data('comment_id'));
				n.validate(C.newCommentFormVal);
				comment.append(n);
				C.scrollTo(comment.children('form.new-comment-form'));
				comment.addClass('active-reply');
			}
		});
	}
	
	// Scrolls to a particular ELement on the page
	C.scrollTo = function(el, offset) {
		if (typeof offset == 'undefined') {
			offset = 50;
		}
		$('html,body').animate({ scrollTop: el.offset().top - offset }, 300);
	}
	
	// Returns an absolute URL with anything extra appended to the end.
	C.url = function(extra) {
		return C.SITE_URL + (typeof extra != 'undefined' ? extra : '');
	}
	
	// Initialize callbacks etc.
	C.init = function() {
		C.loadNewComment();
		C.loadReplies();
	}
}

$(function(){
	// Declare comments system and initialize
	window.comments = new Comments();
	window.comments.init();
});
 