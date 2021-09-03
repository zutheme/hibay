<?php
function request_question(){
    wp_verify_nonce( 'my-special-string', 'security' );
    $input = json_decode(file_get_contents('php://input'),true);
    $idpost = $input['idpost'];  
    //date_default_timezone_set('Asia/Ho_Chi_Minh'); 
            // $args = array(
            //     'post_type' => array( 'trac_nghiem' ),
            //     'post__in' => $idpost
            // );
            $post = get_post($idpost);
            if (isset($post)) {  
                    $title = $post->post_title;
                    $content = $post->post_content;
                    $lst_quest = array();
                    $list_quiz = get_post_meta( $idpost, 'list_quiz', true );
                    if( $list_quiz ){
                        $arr_data = json_decode($list_quiz, true);
                        if($arr_data){
                             foreach ($arr_data as $key => $value) {
                                $lst_quest[] = $value;
                             }
                        }
                     }  
              echo json_encode(array('error'=>'','idpost'=>$idpost,'title'=>$title,'content'=>$content,'list-quest'=>$lst_quest));
                die();   
        }
        echo json_encode(array('error'=>'error','title'=>''));
        die();        
}
add_action( 'wp_ajax_request_question', 'request_question' );
add_action( 'wp_ajax_nopriv_request_question', 'request_question');
if(!function_exists('get_curent_slug_custom_taxonomy')){
    function get_curent_slug_custom_taxonomy(){
    //echo "get_curent_slug_custom_taxonomy";
    $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
    //echo $term->name; 
    return $term->slug; 
  }
}
function create_ticket_api_quiz(){
    wp_verify_nonce('media-form', 'security');
    $input = json_decode(file_get_contents('php://input'),true);
    $jsonstring = $input["data"];
    $arr_data = json_decode($jsonstring, true);
    $str_asw = '';
    if($arr_data){
         foreach ($arr_data as $value) { 
            $str_asw .= '<p>'.$value['numquest'].'). '.$value['title'].'<p>';
            if(isset($value['ans'])){
                foreach ($value['ans'] as $item) {
                    $str_asw .= '<p>-'.$item['quiz_content'].'-('.$item['user_ans'].')</p>';
                }
            }
         }
    }
    $_ticket = $input['ticket'];
    $_phone = $_ticket['phone'];
    $_username = $_ticket['username'];
    $_ticket_cmt = $_ticket['ticket_comment'];
    $_ticket_cmt .= $str_asw;
    $json = json_encode([
        'ticket'  => [
            'ticket_subject' => $_ticket['ticket_subject'],
            'ticket_comment'    => $_ticket_cmt,
            'email' => $_ticket['email'],
            'phone'  =>  $_phone,
            'group_id'  => $_ticket['group_id'],
            'username'  => $_username,
            'ticket_priority'  => $_ticket['ticket_priority'],
            'custom_fields'  => $_ticket['custom_fields']
            ]
    ]);
    $mgs = esc_attr( get_option('sms_text') );
    //$count = null;
    //$returnValue = preg_replace('#_ten_khach#', $_username,  $mgs , -1, $count);
    if(!isset($_username)){
      $_username = 'Anh/chi';
    }
    $returnValue = preg_replace('/_ten_khach/i', $_username, $mgs);
    //$returnValue = preg_replace('#_ten_khach#', $_username,  $mgs , -1, $count);
    //$count = null;
    //$returnValue = preg_replace('#_ten_khach#', $_username,  $mgs , -1, $count);
    $arrMessage = array(
        'Phone'      => $_phone,
        'BrandName'  => 'TICKMEDICAL',
        'Message'    => $returnValue
    );
     $result = curlapi($json);
     $result_curl = json_decode($result,true);
     if($result_curl['code']=='ok'){
        $sms = sendsmsbrandnameopt($arrMessage);
        echo json_encode($sms);
        wp_die();
     }
     echo json_encode($result);
     wp_die();
}
add_action('wp_ajax_create_ticket_api_quiz', 'create_ticket_api_quiz');
add_action('wp_ajax_nopriv_create_ticket_api_quiz', 'create_ticket_api_quiz');
function curlapiquiz($data){
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.caresoft.vn/tickfulllife/api/v1/tickets",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS =>$data,
      CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer 6Ai6qoJoE10l3nU",
        "Content-Type: application/json"
      ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
} 
function outresult(){
    wp_verify_nonce('my-special-string', 'security');
    $input = json_decode(file_get_contents('php://input'),true);
    $jsonstring = $input["data"];
    $idpost = $input["idpost"];
    $arr_data = json_decode($jsonstring, true);
    $str_asw = '';
    if($arr_data){
         foreach ($arr_data as $value) { 
            $str_asw .= '<p>+'.$value['title'].'<p>';
            if(isset($value['ans'])){
                foreach ($value['ans'] as $item) {
                    $str_asw .= '<p> -('.$item['user_ans'].') '.$item['quiz_content'].'</p>';
                }
            }
         }
    }
    echo json_encode($str_asw);
    die();      
}
add_action( 'wp_ajax_outresult', 'outresult' );
add_action( 'wp_ajax_nopriv_outresult', 'outresult');
//request id post by category 
function listcheckcat(){
    wp_verify_nonce( 'my-special-string', 'security' );
    $input = json_decode(file_get_contents('php://input'),true);
    $idcat = $input['idcate'];  
    //date_default_timezone_set('Asia/Ho_Chi_Minh');
    $args = array(
        'post_type' => 'trac_nghiem',
        'posts_per_page' => 10,
        'post_parent' => 0,
        'tax_query' => array(
            array(          
                'taxonomy' => 'depart_trac_nghiem',
                'field' => 'term_id',
                'terms' => array($idcat),
                'operator' => 'IN'
            )
         )
    );
    $list = array();
    $team_query = new WP_Query($args); 
    if ($team_query->have_posts()) {
          while ($team_query->have_posts()) {
            $team_query->the_post();  
                $id = get_the_ID();
                $title = get_the_title($idpost);
                $link = get_permalink($idpost);
                //$listsubject = get_post_meta( $id, 'listsubject', true );
                $list[] = array('idpost'=>$id,'title'=>$title,'link'=>$link);
            }
          wp_reset_postdata();
          echo json_encode($list);
            die();   
    }
    echo json_encode(array('idpost'=>'','title'=>''));
    die();        
}
add_action( 'wp_ajax_listcheckcat', 'listcheckcat' );
add_action( 'wp_ajax_nopriv_listcheckcat', 'listcheckcat');
//add question
function addquestion(){
    wp_verify_nonce( 'my-special-string', 'security' );
    $input = json_decode(file_get_contents('php://input'),true);
    $title = $input['title_question_more'];
    $idparent = $input['idparent'];   
    //date_default_timezone_set('Asia/Ho_Chi_Minh');
    $post_data = array(
        'post_title' => $title,
        'post_content' => '',
        'post_author'  => get_current_user_id(),
        'post_type' => 'trac_nghiem',
        'post_status'  => 'private',
        'post_parent'  => $idparent,
    );
    $post_id = wp_insert_post( $post_data );
    //$permalink = get_permalink($post_id);
     $args = array(
        'post_type' => 'trac_nghiem',
        'posts_per_page'  => -1,
        'post_status'  => 'private',
        'post_parent__in' => array($idparent),  
        'order' => 'asc',
        //'post_parent' => $idparent
    );
    $list = array();
    $team_query = new WP_Query($args); 
    if ($team_query->have_posts()) {
          while ($team_query->have_posts()) {
            $team_query->the_post();  
                $id = get_the_ID();
                $title = get_the_title($idpost);
                //$link = get_permalink($idpost);
                $link = get_edit_post_link($id,'');
                //$listsubject = get_post_meta( $id, 'listsubject', true );
                $list[] = array('idpost'=>$id,'title'=>$title,'link'=>$link);
            }
          wp_reset_postdata();
          echo json_encode($list);
            die();   
    }
    echo json_encode(array('idpost'=>'','title'=>''));
    die();           
}
add_action( 'wp_ajax_addquestion', 'addquestion' );
add_action( 'wp_ajax_nopriv_addquestion', 'addquestion');
//load post by idparent
function loadquestion(){
    $input = json_decode(file_get_contents('php://input'),true);
    $idparent = $input['idparent'];   
    $args = array(
        'post_type' => 'trac_nghiem',
        'posts_per_page'  => -1,
        'post_status'  => 'private',
        'post_parent__in' => array($idparent),  
        'order' => 'asc',
        //'post_parent' => $idparent
    );
    $list = array();
    $team_query = new WP_Query($args); 
    if ($team_query->have_posts()) {
          while ($team_query->have_posts()) {
            $team_query->the_post();  
                $id = get_the_ID();
                $title = get_the_title($id);
                //$link = get_permalink($id);
                $link = get_edit_post_link($id,'');
                //$listsubject = get_post_meta( $id, 'listsubject', true );
                $list[] = array('idpost'=>$id,'title'=>$title,'link'=>$link);
            }
          wp_reset_postdata();
          echo json_encode($list);
            die();   
    }
    echo json_encode(array('idpost'=>$idparent,'title'=>''));
    die();           
}
add_action( 'wp_ajax_loadquestion', 'loadquestion' );
add_action( 'wp_ajax_nopriv_loadquestion', 'loadquestion');
//load all question
function loadallquestion(){
    $input = json_decode(file_get_contents('php://input'),true);
    $idparent = $input['idparent'];   
    $args = array(
        'post_type' => 'trac_nghiem',
        'posts_per_page'  => -1,
        'post_status'  => 'private',
        'post_parent__in' => array($idparent),  
        'order' => 'asc',
        //'post_parent' => $idparent
    );
    $list = array();
    $allquiz = array();
    $team_query = new WP_Query($args);
    if ($team_query->have_posts()) {
          while ($team_query->have_posts()) {
                $team_query->the_post();  
                $id = get_the_ID();
                $title = get_the_title();
                $link = get_permalink();
                $content = apply_filters( 'the_content', get_the_content() );
                $lst_quest = array();
                $list_quiz = get_post_meta( $id, 'list_quiz', true );
                if( $list_quiz ){
                    $arr_data = json_decode($list_quiz, true);
                    if($arr_data){
                         foreach ($arr_data as $key => $value) {
                            $lst_quest[] = $value;
                         }
                    }
                 }
                $allquiz[] = array('error'=>'','idpost'=>$id,'title'=>$title,'content'=>$content,'list-quest'=>$lst_quest);  
            }
    }
    echo json_encode($allquiz);
    die();          
}
add_action( 'wp_ajax_loadallquestion', 'loadallquestion' );
add_action( 'wp_ajax_nopriv_loadallquestion', 'loadallquestion');
//add quiz abc
function addquizabc(){
    wp_verify_nonce( 'my-special-string', 'security' );
    $input = json_decode(file_get_contents('php://input'),true);
    $post_id = $input['hiddenidpost'];
    $list_quiz = $input['list_quiz'];
    $update = update_post_meta( $post_id, 'list_quiz', $list_quiz );
    echo json_encode(array('result'=>$update));
    wp_die();          
}
add_action( 'wp_ajax_addquizabc', 'addquizabc' );
add_action( 'wp_ajax_nopriv_addquizabc', 'addquizabc');
?>
