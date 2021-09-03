<?php 

function add_query_vars_filter( $vars ){

  $vars[] = "email";

  $vars[] = "idevent";

 return $vars;

}

$ulr=$_SERVER['REQUEST_URI'];

//Add custom query vars

add_filter( 'query_vars', 'add_query_vars_filter' );

add_query_arg( array('email' => 'value1','idevent'=>'value2'),$ulr );



function your_scripts() {

  //wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/ajax.js', $deps=array(), $ver=true, true);

  wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/crm.js', array(), '0.4.4', true );

  wp_localize_script( 'script-name', 'MyAjax', array(
    'ajaxurl' => admin_url( 'admin-ajax.php' ),
	'home_url' => get_home_url(),
    'security' => wp_create_nonce( 'my-special-string' )
  ));

}

add_action( 'wp_enqueue_scripts', 'your_scripts' );



function get_the_user_ip() {

if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {

//check ip from share internet

$ip = $_SERVER['HTTP_CLIENT_IP'];

} elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {

//to check ip is pass from proxy

$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];

} else {

$ip = $_SERVER['REMOTE_ADDR'];

}

return apply_filters( 'wpb_get_ip', $ip );

}

/*login*/

//send mail

if(!function_exists('send_message')):
	function send_message(){
			 wp_verify_nonce( 'my-special-string', 'security' );
			 $to="info@hibay.com.vn";
			 $input = json_decode(file_get_contents('php://input'),true);
			 $ticket = $input['data'];
			 $name = $ticket['name'];
			 $email = $ticket['email'];
			 $phone = $ticket['phone'];
			 $_subject = $ticket['subject'];
			 $note = $ticket['note'];
			 $captcha_contact = $ticket['captcha_contact'];
			 if(!isset($captcha_contact)){
				 $result = array('result'=>1,'desc'=>'empty captcha');
	             echo json_encode($result);
	             wp_die();
			 }
			 $data = array(
				'secret' => "6LfXty8cAAAAAIJIUE8PnBfP4ctWodX_rP7Dobk_",
				'response' => $captcha_contact
			);        
			$verify = curl_init();
			curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
			curl_setopt($verify, CURLOPT_POST, true);
			curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
			curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($verify);       
			if(!$response){ 
				 $result = array('result'=>1,'desc'=>'Verification failed, please try again');
	             echo json_encode($result);
	             wp_die();
			}
			 date_default_timezone_set('Asia/Ho_Chi_Minh');
			 $time_reg = date('Y-m-d H:i:s', time());
			 $subject = pll__('consultant');
			 if(isset($_subject) && !empty($_subject)){
				 $subject = $_subject;
			 }
			/*body mail*/	
	     	//$message = $name.'<br>'.$phone.'<br>'.$email.'<br>'.$message;
			$message ='<!DOCTYPE html>';
			$message .='<html>';
			$message .='<head>';
			$message .='<style>';
			$message .='table, th, td {';
			$message .='border: 1px solid black;';
			$message .='}';
			$message .='</style>';
			$message .='</head>';
			$message .='<body>';

			$message .='<h1>'.$subject.'</h1>';

			$message .='<table style="width:100%">';
			//$message .='<thead>';
			//$message .='<tr>';
			//$message .='<th>Month</th>';
			//$message .='<th>Savings</th>';
			//$message .='</tr>';
			//$message .='</thead>';
			$message .='<tbody>';
			$message .='<tr>';
			$message .='<td>'.pll__('fullname').'</td>';
			$message .='<td>'.$name.'</td>';
			$message .='</tr>';
			$message .='<tr>';
			$message .='<td>'.pll__('phone').'</td>';
			$message .='<td>'.$phone.'</td>';
			$message .='</tr>';
			$message .='<tr>';
			$message .='<td>'.pll__('email').'</td>';
			$message .='<td>'.$email.'</td>';
			$message .='</tr>';
			$message .='<tr>';
			$message .='<td>'.pll__('note').'</td>';
			$message .='<td>'.$note.'</td>';
			$message .='</tr>';
			$message .='</tbody>';
			$message .='</table>';

			$message .='</body>';
			$message .='</html>';
			/*end body*/
	        $headers  = 'MIME-Version: 1.0' . "\r\n";

	        $headers .= 'Content-type: text/html; charset=utf8' . "\r\n";      

	        // Create email headers

	        $headers .= 'From: '.$to."\r\n".

	            'Reply-To: '.$to."\r\n" .

	            'X-Mailer: PHP/' . phpversion();

	        $mail_send = wp_mail($to, $subject, $message, $headers);

	        if($mail_send){
				$result = array('result'=>0,'desc'=>'success');
	            echo json_encode($result);

	             die();     

	        }

	        else{
				$result = array('result'=>1,'desc'=>$mail_send->error);
	            echo json_encode();

	             die();

	        }

	    

	}

endif;
add_action( 'wp_ajax_send_message', 'send_message' );
add_action( 'wp_ajax_nopriv_send_message', 'send_message' );
function loading(){ ?>
    <div class="htz-popup-processing" style="display: none; position: fixed; z-index: 1010;left: 0;top: 0%;width: 100%; height: 100%; overflow: auto;background-color: rgb(0,0,0); background-color: rgba(0,0,0,0.1); ">
      <div class="processing" style="position:relative;background-color: rgba(255,255,255,0.6);width: 250px;height: 250px;margin-top:15%; margin-left: auto;margin-right: auto;text-align: center;">
        <p><img id="loading" class="loading" style=" position: absolute;top: 11%;left: 11%;display: block;width: 200px; height: 200px;margin-left: auto;margin-right: auto;" src="<?php bloginfo('template_directory');?>/images/loader1.gif"></p>
        <!--<div id="loader" class="loading" style=" position: absolute;top: 40%;left: 11%;display: block;width: 200px; height: 200px;margin-left: auto;margin-right: auto;"><div class="cssload-box-loading"></div></div>-->
        <p class="result" style="font-weight: 500;font-size: 28px;"></p>
        <p><img class="checked-img" style="display: none;width: 60px;margin-right: auto;margin-left: auto;padding:5px; " src="<?php bloginfo('template_directory');?>/images/checked.jpg"></p>
      </div>
    </div>
<?php }
//add_action( 'wp_footer', 'loading');

/*login*/
if(!function_exists('userlogin')):
	function userlogin(){
			 wp_verify_nonce( 'my-special-string', 'security' );
			 $input = json_decode(file_get_contents('php://input'),true);
			 $ticket = $input['data'];
			 $username = $ticket['username'];
			 $password = $ticket['password'];
			 $captcha_login = $ticket['captcha_login'];
			 if(!isset($captcha_login)){
				 $result = array('result'=>1,'desc'=>'empty captchar');
	             echo json_encode($result);
	             wp_die();
			 }
			 $data = array(
            'secret' => "6LfXty8cAAAAAIJIUE8PnBfP4ctWodX_rP7Dobk_",
            'response' => $captcha_login
			);        
			$verify = curl_init();
			curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
			curl_setopt($verify, CURLOPT_POST, true);
			curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
			curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($verify);       
			if(!$response){ 
				 $result = array('result'=>1,'desc'=>'Verification failed, please try again');
	             echo json_encode($result);
	             wp_die();
			}
			if(!isset($username) || !isset($password)){
				$result = array('result'=>1,'desc'=>'error input');
				echo json_encode($result);
				wp_die();
			} 
			$creds = array(
				'user_login'    => $username,
				'user_password' => $password,
				'remember'      => true
			);
			$user = wp_signon( $creds, false );
		 
			if ( is_wp_error( $user ) ) {
				$signUpError = $user->get_error_message();
				$result = array('result'=>1,'desc'=>$signUpError);
	             echo json_encode($result);
	             wp_die();
			}
			$result = array('result'=>0,'desc'=>'success');
	        echo json_encode($result);
	        wp_die();
	}
endif;
add_action( 'wp_ajax_userlogin', 'userlogin' );
add_action( 'wp_ajax_nopriv_userlogin', 'userlogin' );
/*user register*/
if(!function_exists('user_register')):
	function user_register(){
			 wp_verify_nonce( 'my-special-string', 'security' );
			 $input = json_decode(file_get_contents('php://input'),true);
			 $ticket = $input['data'];
			 $username = $ticket['username'];
			 $useremail = $ticket['useremail'];
			 $password = $ticket['password'];
			 $fullname = $ticket['fullname'];
			 $captcha_register = $ticket['captcha_register'];
			 if(!isset($captcha_register)){
				 $result = array('result'=>1,'desc'=>'empty captchar');
	             echo json_encode($result);
	             wp_die();
			 }
			 $data = array(
            'secret' => "6LfXty8cAAAAAIJIUE8PnBfP4ctWodX_rP7Dobk_",
            'response' => $captcha_register
			);        
			$verify = curl_init();
			curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
			curl_setopt($verify, CURLOPT_POST, true);
			curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
			curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($verify);       
			if(!$response){ 
				 $result = array('result'=>1,'desc'=>'Verification failed, please try again');
	             echo json_encode($result);
	             wp_die();
			}
			if(!isset($username) || !isset($password)){
				$result = array('result'=>1,'desc'=>'error input');
				echo json_encode($result);
				wp_die();
			} 
			$userdata = array(
				'user_login' => $username,
				'user_email' => $useremail,
				'user_pass' => $password,
				'show_admin_bar_front' => "false",
				'first_name' => $fullname, 
				'role' => 'subscriber',
				'display_name' => $fullname,
				);
			$user_id = wp_insert_user( $userdata );
			// On success.
			if ( ! is_wp_error( $user_id ) ) {
				$creds = array(
					'user_login'    => $username,
					'user_password' => $password,
					'remember'      => true
				);
			 
				$user = wp_signon( $creds, false );
			 
				if ( is_wp_error( $user ) ) {
					$signUpError = $user->get_error_message();
					$result = array('result'=>1,'desc'=>$signUpError);
					echo json_encode($result);
				}else{
					$result = array('result'=>0,'desc'=>'success');
					echo json_encode($result);
					wp_die();
				}
			}else{
				$signUpError = $user_id->get_error_message();
				$result = array('result'=>1,'desc'=>$signUpError);
				echo json_encode($result);
				wp_die();
			}
	}
endif;
add_action( 'wp_ajax_user_register', 'user_register' );
add_action( 'wp_ajax_nopriv_user_register', 'user_register' );