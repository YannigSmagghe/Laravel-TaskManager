var $url = "http://127.0.0.1:8000/contact";
var validateForm = function($form) {
    $valid = true;
    $fields = $form.find('.required');
    $fields.each(function() {
        $this = $(this);
        $parent = $this.parent();
        $value = $this.val();
        $field_name = $this.attr('data-field-name');
        $field_type = $this.attr('data-field-type');
        $error = '';
        switch($field_type) {
            case 'text':
                if($value.replace(/\s/g,'').length == 0) {
                    $error = 'Please enter ' + $field_name;                
                }
                break;
            case 'email':
                if($value.replace(/\s/g,'').length == 0) {
                    $error = 'Please enter ' + $field_name;
                } else if(validateEmail($value) === false) {
                    $error = 'Please enter valid ' + $field_name;
                }
                break;
        }
        if($error) {
            $valid = false;
            $parent.find('.error').html($error);
        }
    });

    return $valid;
}
var validateEmail = function($email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test($email);
}
var buttonClickedAnimation = function($button) {
    $button.addClass('clicked');
    setTimeout(function(){
        $button.addClass('spinner');
    }, 200);
}
var buttonUnclickedAnimation = function($button) {
    $button.removeClass('spinner');
    $button.removeClass('clicked');
}

$(document).ready(function() {

    $('body').scrollspy({ target: '#page-nav-wrapper', offset: 100});
    
    $('.scrollto').on('click', function(e){
        var target = this.hash;
        e.preventDefault();
		$('body').scrollTo(target, 800, {offset: -60, 'axis':'y'});
	});
	    
    $(window).on('scroll resize load', function() {
        
        $('#page-nav-wrapper').removeClass('fixed');
         
         var scrollTop = $(this).scrollTop();
         var topDistance = $('#page-nav-wrapper').offset().top;
         
         if ( (topDistance) > scrollTop ) {
            $('#page-nav-wrapper').removeClass('fixed');
            $('body').removeClass('sticky-page-nav');
         }
         else {
            $('#page-nav-wrapper').addClass('fixed');
            $('body').addClass('sticky-page-nav');
         }

    });
    
    $('.chart').easyPieChart({		
		barColor:'RGB(0, 150, 136)',
		trackColor: '#e8e8e8',
		scaleColor: false,
		lineWidth : 5,
		animate: 2000,
		onStep: function(from, to, percent) {
			$(this.el).find('span').text(Math.round(percent));
		}
	});  
	   
    var $container = $('.isotope');
    
    $container.imagesLoaded(function () {
        $('.isotope').isotope({
            itemSelector: '.item'
        });
    });
    
    $('#filters').on('click', '.type', function() {
        var filterValue = $(this).attr('data-filter');
        $container.isotope({ filter: filterValue });
    });
    
    $('.filters').each(function(i, typeGroup) {        
        var $typeGroup = $(typeGroup);
        console.log($typeGroup);
        $typeGroup.on('click', '.type', function() {
            $typeGroup.find('.active').removeClass('active');
            $(this).addClass('active');
        });
    });

    $('.form-group .form-control').on('focus', function() {
        var $input = $(this);
        $input.parent().removeClass('is-filled');
        $input.parent().addClass('is-focused');
    });
    
    $('.form-group .form-control').on('blur', function() {
        var $input = $(this);

        $input.parent().removeClass('is-focused');
        if($input.val().length > 0) {
            $input.parent().addClass('is-filled');
        }
    });

    $('.required').on('focus', function() {
        $(this).parent().find('span.error').html('');
    });

    $('.send-message-btn').on('click', function(e) {
        var $button = $(this);
        
        var $form = $('#form');
        $form.find('span.error').html('');
        if(validateForm($form) === true && $button.hasClass('clicked') === false) {            
            $formData = $('#form input[type="text"], #form input[type="email"], #form input[type="number"], #form input[type="hidden"], #form input[type="checkbox"]:checked, #form input[type="radio"]:checked, #form select, #form textarea');
            $.ajax({
                url: $url,
                type: 'POST',
                data: $formData,
                dataType: 'json',
                beforeSend: function() {
                    buttonClickedAnimation($button);
                },
                complete: function() {

                },
                success: function(json) {

                    if(json['success']) {
                        setTimeout(function() {                            
                            buttonUnclickedAnimation($button);
                            setTimeout(function() {                            
                                $button.closest('.form-group').html(json['success']);
                            }, 300);
                        }, 200);
                    }
                    
                },
                error: function(response) {

                    var $errors = response.responseJSON;

                    $.each($errors.errors, function($key, $value) {
                        $error = $form.find('#'+$key).closest('.form-group').find('span.error');
                        $error.html($value);
                        console.log($value);
                    });

                    setTimeout(function() {                            
                        buttonUnclickedAnimation($button);
                    }, 200);

                }
            });
        }
    });

});