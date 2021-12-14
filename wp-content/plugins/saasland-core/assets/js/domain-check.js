jQuery(document).ready(function() {

	var loading;
	var results;
	var display;

	//////////////////////
	// Domain Checker 1 //
	//////////////////////
	jQuery("div[id='domain-form']").on("submit", function(){
			var form = this;
			var options = jQuery('.domainchecker').data('options');
			console.log(options.custom_link);

			if(jQuery("input[name='domain']",form).val() == ""){
				jQuery("div[id='results']",form).show().html('<p class="domain-error">Please enter a domain name.</p>');
				jQuery('.select-domain').hide().empty();
				return false;
			}

			var domain = jQuery("input[name='domain']",form).val();
			var domainTLD = jQuery("input[name='domainTLD']:checked",form).val();

			if ( domainTLD !== '' ) {
				domain = domain + '.' + domainTLD;
			}

			jQuery("div[id='results']",form).html('');
			jQuery('.select-domain').hide().empty();
			jQuery(".loader",form).show();
			var data = {
		      		'action': 'wdc_display',
		      		'domain': domain,
		      		'security' : wdc_ajax.wdc_nonce
		    		};
			jQuery.post(wdc_ajax.ajaxurl, data, function(response) {
			var x = JSON.parse(response);
				if(x.status == 1){
					display = x.text;
					link = '';

					if( options.buy_now_btn_style == 'whmcs_link') {
						var appendedForm = '<form method="post" action="'+ wdc_ajax.whmcsBridgeUrl +'?ccce=cart&a=add&domain=register&query='+ x.domain_name +'&systpl=six">';
							appendedForm += '<input type="text" class="hide-it" name="domain" value="'+ x.domain +'">';
							appendedForm += '<input type="submit" class="btn btn-primary" value="'+ options.buy_now_btn_text +'"> </form>';
					} else if ( options.buy_now_btn_style == 'custom_link' ) {
						var	appendedForm = '<a href="'+ options.custom_link + '" class="domain-form-btn btn btn-primary">'+ options.buy_now_btn_text + '</a>';
					}

					jQuery('.select-domain').show().html(appendedForm);

				}else if(x.status == 0) {
					display = x.text;
				}else{
					display = "Error occured.";
				}
			jQuery("div[id='results']",form).css('display','block');
			jQuery(".loader",form).hide();
			jQuery("div[id='results']",form).html(unescape(display));

		});
		return false;
	});


	//////////////////////
	// Domain Checker 2 //
	//////////////////////
	jQuery("div[id='domain-form2']").on("submit", function(){
			var form = this;

			if(jQuery("input[name='domain']",form).val() == ""){
				jQuery("div[id='results']",form).show().html('<p class="domain-error">Please enter a domain name.</p>');
				jQuery('.select-domain').hide().empty();
				return false;
			}

			var domain = jQuery("input[name='domain']",form).val();
			var domainTLD = jQuery("input[name='domainTLD']:checked",form).val();

			if ( domainTLD !== '' ) {
				domain = domain + '.' + domainTLD;
			}

			jQuery("div[id='results']",form).html('');
			jQuery('.select-domain').hide().empty();
			jQuery(".loader",form).show();
			var data = {
		      		'action': 'wdc_display',
		      		'domain': domain,
		      		'security' : wdc_ajax.wdc_nonce
		    		};
			jQuery.post(wdc_ajax.ajaxurl, data, function(response) {
			var x = JSON.parse(response);
				if(x.status == 1){
					display = '';
					link = '';

					var appendedForm = '<ul class="domains">';
					 	appendedForm +=	'<li class="availableDomain clearfix  animated fadeInUp" style="opacity: 1;">';
					 	appendedForm +=	'<div class="aDomainLeft clearfix">';
					 	appendedForm +=		'<div class="checkIcon"><i class="icofont icofont-verification-time"></i></div>';
					 	appendedForm +=		'<div class="DomainName">';
					 	appendedForm +=			'<div class="h3">'+ x.domain +'</div>';
					 	appendedForm +=			'<span>is available now!</span>';
					 	appendedForm +=		'</div>';
					 	appendedForm +=	'</div>';
					 	appendedForm +=	'<div class="domainBtn clearfix">';
					 	appendedForm += '<form method="post" action="'+ wdc_ajax.whmcsBridgeUrl +'?ccce=cart&a=add&domain=register&query='+ x.domain_name +'&systpl=six">';
						appendedForm += '<input type="text" class="hide-it" name="domain" value="'+ x.domain +'">';
						appendedForm += '<input type="submit" class="btn btn-primary btnBuy" value="Buy now">';
						appendedForm += '</form>';
					 	appendedForm +=	'</div>';
					 	appendedForm += '</li>';
					 	appendedForm += '</ul>';


					jQuery('.select-domain').show().html(appendedForm);

				}else if(x.status == 0) {
					display = x.text;
				}else{
					display = "Error occured.";
				}
			jQuery("div[id='results']",form).css('display','block');
			jQuery(".loader",form).hide();
			jQuery("div[id='results']",form).html(unescape(display));

		});
		return false;
	});

});
