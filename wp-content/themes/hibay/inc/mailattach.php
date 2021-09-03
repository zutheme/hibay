<?php
/*attach file*/
function attachfile($to, $subject, $message,$attachments = array()){
    if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );
    $upload_overrides = array( 'test_form' => false );
    add_filter('upload_dir', 'my_upload_dir');
    $uploadedfile = $attachments;
    $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
    remove_filter('upload_dir', 'my_upload_dir');
    $headers   = array();
    $headers[] = "Content-Type: text/html; charset=UTF-8";
    //$headers[] = "To: {$to}";
    $headers[] = "From: Lifico.com";
    $headers[] = "Reply-To: noreply@liphoco.com";
    $headers[] = "Subject: {$subject}";
    //$headers[] = "X-Mailer: PHP/".phpversion();
    //$headers[] = "MIME-Version: 1.0";
    //$boundary = md5(time());
    
    $headers = array('Content-Type: text/html; charset=UTF-8; From: Lifico.com');
    if ($movefile) {
        $_attachment = array($movefile["file"]);
        return wp_mail( $to, $subject, $message, $headers, $_attachment );
    } else {
        return "Possible file upload attack!\n";
    }
}
function my_upload_dir($upload) {
  $upload['subdir'] = '/uploadfiles' . $upload['subdir'];

  $upload['path']   = $upload['basedir'] . $upload['subdir'];

  $upload['url']    = $upload['baseurl'] . $upload['subdir'];

  return $upload;

}
function sendmessage($to, $subject, $message){
    // $headers   = array();
 //    $headers[] = "To: {$to}";
 //    $headers[] = "From: Lifico.com";
 //    $headers[] = "Reply-To: noreply@liphoco.com";
 //    $headers[] = "Subject: {$subject}";
 //    $headers[] = "X-Mailer: PHP/".phpversion();
 //    $headers[] = "MIME-Version: 1.0";
    $headers = array('Content-Type: text/html; charset=UTF-8');
    return wp_mail( $to, $subject, $message, $headers );
}
 ?>