/*

Mock object:

{
	id: '',
	parent_id: '',
	name: '',
	email: '',
	gravatar_url: '',
	comment: '',
	ip_address: '',
	user_agent: '',
	timestamp: ''
}

*/

var Comments = function() {
	var C = this;
	
	C.SITE_URL = window.SITE_URL;
	C.allComments = $('#all-comments');
	C.newCommentForm = $('form.new-comment-form');
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
					if ($(form).children('input[name=parent_id]').val() != '0') {
						var p = $(form).parents('.comment:first');
						$(form).slideUp(300, function(){
							$(this).remove();
						});
						p.append(r);
					} else {
						C.allComments.append(r);
						$(form).find('input[type=text],input[type=email],textarea').val('');
					}
				} else {
					alert('Comment failed to post!');
				}
			});
		}
	};
	C.abstractComment = C.allComments.children('.comment.abstract');
	
	C.loadNewComment = function() {
		C.newCommentForm.validate(C.newCommentFormVal);
		
		C.allComments.find(' > .comment').each(function(){
			var comment = $(this);
			$(this).find('a.reply').unbind('click').click(function(e){
				e.preventDefault();
				if (comment.children('form.new-comment-form').length > 0) {
					comment.children('form.new-comment-form').slideUp(300, function(){
						$(this).remove();
					});
				} else {
					var n = C.newCommentForm.clone();
					n.children('input[name=parent_id]').val(comment.data('comment_id'));
					n.validate(C.newCommentFormVal);
					comment.append(n);
				}
			});
		});
	}
	
	C.url = function(extra) {
		return C.SITE_URL + (typeof extra != 'undefined' ? extra : '');
	}
	
	C.init = function() {
		C.loadNewComment();
	}
}

$(function(){
	window.comments = new Comments();
	window.comments.init();
});
 