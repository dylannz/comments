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
	
	C.loadNewComment = function() {
		$('#new-comment-form').validate({
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
				$.post(C.url('/?action=new'), data, function(r){
					try {
						var newComment = $.parseJSON(r);
					} catch (e) {
						alert('Comment failed to post!');
					}
					if (newComment) {
						// Append to comment list
					} else {
						alert('Comment failed to post!');
					}
				});
			}
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
 