var verifyCallback = function(response) {
      console.log(response);
};
var onloadCallback = function() {
	var _e_captcha_contact = document.getElementById("captcha_contact");
	if(_e_captcha_contact){
		grecaptcha.render('captcha_contact', {
		  'sitekey' : '6LfXty8cAAAAAIzrAO3LRHmq_OIvOd-fGLsdVF3_',
		  'callback' : render_contact,
		  'theme' : 'light'
		});
	}
	var _e_captcha_login = document.getElementById("captcha_login");
	if(_e_captcha_login){
		  grecaptcha.render('captcha_login', {
		  'sitekey' : '6LfXty8cAAAAAIzrAO3LRHmq_OIvOd-fGLsdVF3_',
		  'callback' : render_login,
		  'theme' : 'light'
		});
	}
	var _e_captcha_register = document.getElementById("captcha_register");
	if(_e_captcha_register){
		  grecaptcha.render('captcha_register', {
		  'sitekey' : '6LfXty8cAAAAAIzrAO3LRHmq_OIvOd-fGLsdVF3_',
		  'callback' : render_register,
		  'theme' : 'light'
		});
	}
};