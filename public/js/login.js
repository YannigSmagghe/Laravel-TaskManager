var $login_xhr = null;

var login = function($btn) {
	$data = $('#login input');
	if($login_xhr === null) {
		$login_xhr = $.ajax({
			url: '/login',
			type: 'POST',
			data: $data,
			dataType: 'json',
			beforeSend: function() {
				$btn.html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> Processing...');
			},
			complete: function() {
				$login_xhr = null;
				$btn.html('<i class="fa fa-lock" aria-hidden="true"></i> LogIn');
			},
			success: function(json) {
				if(json.status == true) {
					toastr.success(json.message);					
					window.location = json.redirect;
				}
			},
			error: function($login_xhr, ajaxOptions, thrownError) {				
				$error = JSON.parse($login_xhr.responseText);
				toastr.error($error.message);			
			}
		});
	}
}

$(document).ready(function() {	
	$('.btn-login').click(function() {
    	login($(this));
    });
});