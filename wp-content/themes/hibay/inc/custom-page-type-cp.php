<?php


/*

 * Adds a meta box to the post editing screen

 */

function prfx_field_custom_page_meta() {

    add_meta_box( 'prfx_meta', __( 'Field Box Title', 'prfx-textdomain' ), 'prfx_field_meta_page_callback', 'page','normal', 'high');

}

add_action( 'add_meta_boxes', 'prfx_field_custom_page_meta');
/*
 * Outputs the content of the meta box
 */
function prfx_field_meta_page_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' );
    $idpost = $post->ID;
    $prfx_stored_meta = get_post_meta( $idpost ); 
    $post_type = get_post_type($idpost);
    $template = get_post_meta( $idpost, '_wp_page_template', true );
    if ( "page" != $post_type) return;
		if('page-home.php' == $template){ 
			prfx_field_meta_custom_field_page_home($idpost);
		}else if("page-prefaq.php" == $template){
			prfx_field_meta_custom_field_page_callback($idpost);
		}else if("page-contact.php" == $template){
			prfx_field_meta_custom_field_page_contact($idpost);
		}else return;
}
/*

 * Saves the custom meta input

 */

function prfx_field_page_save( $post_id ) {
    // Checks save status

    $is_autosave = wp_is_post_autosave( $post_id );

    $is_revision = wp_is_post_revision( $post_id );

    $is_valid_nonce = ( isset( $_POST[ 'prfx_nonce' ] ) && wp_verify_nonce( $_POST[ 'prfx_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

    // Exits script depending on save status

    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {

        return;

    }

    // Checks for input and sanitizes/saves if needed 

    $post_type = get_post_type($post_id);
    $template = get_post_meta( $post_id, '_wp_page_template', true );
    if ( "page" != $post_type) return false;
    if ("page-home.php" == $template){
		update_custom_field_page_home($post_id);
    }else if("page-prefaq.php" == $template){
        update_custom_field_page($post_id);
    }else if("page-contact.php" == $template){
        update_custom_field_page_contact($post_id);
    }
    else return;
}

add_action('save_post', 'prfx_field_page_save');

// add_action("admin_enqueue_scripts", "pages_admin_script");
// function pages_admin_script() {
// 	    global $post_type;
//     	if( 'pages' != $post_type ) return;
// 	        wp_enqueue_media();
// 	        // Registers and enqueues the required javascript.
// 	        wp_register_script( 'pages_admin_script', get_stylesheet_directory_uri() . '/js/media_upload.js', array(), '0.0.1', true );
// 	        wp_localize_script( 'pages_admin_script', 'meta_image',
// 	            array(
// 	                'title' => __( 'Choose or Upload an Image', 'prfx-textdomain' ),
// 	                'button' => __( 'Use this image', 'prfx-textdomain' ),
// 	            )
// 	        );
// 	        wp_enqueue_script( 'pages_admin_script' );
// }
function prfx_field_meta_custom_field_page_contact( $post_id ){ 
     wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' );
	 $prfx_stored_meta = get_post_meta( $post_id ); ?>
	 <table width="100%">
		 <tr width="100%">
		  <td width="50%">
			<p><label>Header left</label></p>
			<p><textarea rows="5" cols="50" name="contact-header-left-text1"><?php if ( isset ( $prfx_stored_meta['contact-header-left-text1'] ) ) echo $prfx_stored_meta['contact-header-left-text1'][0]; ?></textarea></p>
			<p><label>Privacy Policy</label></p>
			<p><textarea rows="5" cols="50" name="contact-header-privacy-text1"><?php if ( isset ( $prfx_stored_meta['contact-header-privacy-text1'] ) ) echo $prfx_stored_meta['contact-header-privacy-text1'][0]; ?></textarea></p>
			<p><label>I'm interested in</label></p>
			<p><input type="text" name="contact-label-intered1" value="<?php if ( isset ( $prfx_stored_meta['contact-label-intered1'] ) ) echo $prfx_stored_meta['contact-label-intered1'][0]; ?>"/></p>
			<p><textarea rows="5" cols="50" name="contact-select-intered1"><?php if ( isset ( $prfx_stored_meta['contact-select-intered1'] ) ) echo $prfx_stored_meta['contact-select-intered1'][0]; ?></textarea></p>
		  </td>
		  <td width="50%">
			<p><label>Company</label></p>
			<p><input type="text" name="contact-label-company1" value="<?php if ( isset ( $prfx_stored_meta['contact-label-company1'] ) ) echo $prfx_stored_meta['contact-label-company1'][0]; ?>"/></p>
			<p><label>country</label></p>
			<p><input type="text" name="contact-label-country1" value="<?php if ( isset ( $prfx_stored_meta['contact-label-country1'] ) ) echo $prfx_stored_meta['contact-label-country1'][0]; ?>"/></p>
			<p><label>name</label></p>
			<p><input type="text" name="contact-label-name1" value="<?php if ( isset ( $prfx_stored_meta['contact-label-name1'] ) ) echo $prfx_stored_meta['contact-label-name1'][0]; ?>"/></p>
			<p><label>email</label></p>
			<p><input type="text" name="contact-label-email1" value="<?php if ( isset ( $prfx_stored_meta['contact-label-email1'] ) ) echo $prfx_stored_meta['contact-label-email1'][0]; ?>"/></p>
			<p><label>phone</label></p>
			<p><input type="text" name="contact-label-phone1" value="<?php if ( isset ( $prfx_stored_meta['contact-label-phone1'] ) ) echo $prfx_stored_meta['contact-label-phone1'][0]; ?>"/></p>
			<p><label>message</label></p>
			<p><input type="text" name="contact-label-message1" value="<?php if ( isset ( $prfx_stored_meta['contact-label-message1'] ) ) echo $prfx_stored_meta['contact-label-message1'][0]; ?>"/></p>
			<p><label>submit</label></p>
			<p><input type="text" name="contact-label-submit1" value="<?php if ( isset ( $prfx_stored_meta['contact-label-submit1'] ) ) echo $prfx_stored_meta['contact-label-submit1'][0]; ?>"/></p>
		   </td>
		</tr>
	</table>
	<table width="100%">
		<tr width="100%">
		  <td width="100%">---------------------------------------------------------------------------------------------------------------</td>
		</tr>
	</table>
	<table width="100%">
		 <tr width="100%">
		  <td width="100%">
			<p><label>Header left</label></p>
			<p><textarea rows="5" cols="50" name="contact-header-left-text2"><?php if ( isset ( $prfx_stored_meta['contact-header-left-text2'] ) ) echo $prfx_stored_meta['contact-header-left-text2'][0]; ?></textarea></p>
			<p><label>Privacy Policy</label></p>
			<p><textarea rows="5" cols="50" name="contact-header-privacy-text2"><?php if ( isset ( $prfx_stored_meta['contact-header-privacy-text2'] ) ) echo $prfx_stored_meta['contact-header-privacy-text2'][0]; ?></textarea></p>
			<p><label>I'm interested in</label></p>
			<p><input type="text" name="contact-label-intered2" value="<?php if ( isset ( $prfx_stored_meta['contact-label-intered2'] ) ) echo $prfx_stored_meta['contact-label-intered2'][0]; ?>"/></p>
			<p><textarea rows="5" cols="50" name="contact-select-intered2"><?php if ( isset ( $prfx_stored_meta['contact-select-intered2'] ) ) echo $prfx_stored_meta['contact-select-intered2'][0]; ?></textarea></p>
		  </td>
		 
		</tr>
	</table>
	<table width="100%">
		<tr width="100%">
		  <td width="100%">-----------------------------------------------CONTACT----------------------------------------------------------------</td>
		</tr>
	</table>
	
	<table width="100%">
		 <tr width="100%">
		  <td width="100%">
			<p><label>Infomation contact</label></p>
			<p><textarea rows="7" cols="100" name="contact-info-text"><?php if ( isset ( $prfx_stored_meta['contact-info-text'] ) ) echo $prfx_stored_meta['contact-info-text'][0]; ?></textarea></p>
			<p><input type="text" class="edit-image" name="contact-info-bg" value="<?php if ( isset ( $prfx_stored_meta['contact-info-bg'] ) ) echo $prfx_stored_meta['contact-info-bg'][0]; ?>" /></p>
			<p><img height="50" width="auto" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['contact-info-bg'] ) ) echo $prfx_stored_meta['contact-info-bg'][0]; ?>"></p>
            <button type="button" class="images-menu-button">Upload</button>
		  </td>
		 
		</tr>
	</table>
	 <table width="100%">
		<tr width="100%">
		  <td width="100%">---------------------------------------------------button contact next------------------------------------------------------------</td>
		</tr>
	</table>
	<table>
		 <tr width="100%">
		  <td width="100%">
			<p><input type="text" name="contact-button-next1" value="<?php if ( isset ( $prfx_stored_meta['contact-button-next1'] ) ) echo $prfx_stored_meta['contact-button-next1'][0]; ?>"/></p>
			<p><input type="text" name="contact-button-next2" value="<?php if ( isset ( $prfx_stored_meta['contact-button-next2'] ) ) echo $prfx_stored_meta['contact-button-next2'][0]; ?>"/></p>
			<p><input type="text" name="contact-button-next3" value="<?php if ( isset ( $prfx_stored_meta['contact-button-next3'] ) ) echo $prfx_stored_meta['contact-button-next3'][0]; ?>"/></p>
		  </td>
		</tr>
	</table>
<?php }
function update_custom_field_page_contact($post_id){
	if( isset( $_POST['contact-info-text'] ) ) {
        update_post_meta( $post_id, 'contact-info-text', $_POST[ 'contact-info-text' ] );    
    }
	if( isset( $_POST['contact-info-bg'] ) ) {
        update_post_meta( $post_id, 'contact-info-bg', $_POST[ 'contact-info-bg' ] );    
    }
	if( isset( $_POST['contact-header-left-text1'] ) ) {
        update_post_meta( $post_id, 'contact-header-left-text1', $_POST[ 'contact-header-left-text1' ] );    
    }
	if( isset( $_POST['contact-header-privacy-text1'] ) ) {
        update_post_meta( $post_id, 'contact-header-privacy-text1', $_POST[ 'contact-header-privacy-text1' ] );    
    }
	if( isset( $_POST['contact-label-intered1'] ) ) {
        update_post_meta( $post_id, 'contact-label-intered1', $_POST[ 'contact-label-intered1' ] );    
    }
	if( isset( $_POST['contact-select-intered1'] ) ) {
        update_post_meta( $post_id, 'contact-select-intered1', $_POST[ 'contact-select-intered1' ] );    
    }
	if( isset( $_POST['contact-header-left-text2'] ) ) {
        update_post_meta( $post_id, 'contact-header-left-text2', $_POST[ 'contact-header-left-text2' ] );    
    }
	if( isset( $_POST['contact-header-privacy-text2'] ) ) {
        update_post_meta( $post_id, 'contact-header-privacy-text2', $_POST[ 'contact-header-privacy-text2' ] );    
    }
	if( isset( $_POST['contact-label-intered2'] ) ) {
        update_post_meta( $post_id, 'contact-label-intered2', $_POST[ 'contact-label-intered2' ] );    
    }
	if( isset( $_POST['contact-select-intered2'] ) ) {
        update_post_meta( $post_id, 'contact-select-intered2', $_POST[ 'contact-select-intered2' ] );    
    }
	if( isset( $_POST['contact-label-company1'] ) ) {
        update_post_meta( $post_id, 'contact-label-company1', $_POST[ 'contact-label-company1' ] );    
    }
	if( isset( $_POST['contact-label-country1'] ) ) {
        update_post_meta( $post_id, 'contact-label-country1', $_POST[ 'contact-label-country1' ] );    
    }
	if( isset( $_POST['contact-label-name1'] ) ) {
        update_post_meta( $post_id, 'contact-label-name1', $_POST[ 'contact-label-name1' ] );    
    }
	if( isset( $_POST['contact-label-email1'] ) ) {
        update_post_meta( $post_id, 'contact-label-email1', $_POST[ 'contact-label-email1' ] );    
    }
	if( isset( $_POST['contact-label-phone1'] ) ) {
        update_post_meta( $post_id, 'contact-label-phone1', $_POST[ 'contact-label-phone1' ] );    
    }
	if( isset( $_POST['contact-label-message1'] ) ) {
        update_post_meta( $post_id, 'contact-label-message1', $_POST[ 'contact-label-message1' ] );    
    }
	if( isset( $_POST['contact-label-submit1'] ) ) {
        update_post_meta( $post_id, 'contact-label-submit1', $_POST[ 'contact-label-submit1' ] );    
    }
	/*-----------------------------button next----------------------------------*/
	if( isset( $_POST['contact-button-next1'] ) ) {
        update_post_meta( $post_id, 'contact-button-next1', $_POST[ 'contact-button-next1' ] );    
    }
	if( isset( $_POST['contact-button-next2'] ) ) {
        update_post_meta( $post_id, 'contact-button-next2', $_POST[ 'contact-button-next2' ] );    
    }
	if( isset( $_POST['contact-button-next3'] ) ) {
        update_post_meta( $post_id, 'contact-button-next3', $_POST[ 'contact-button-next3' ] );    
    }
	
}
function prfx_field_meta_custom_field_page_home( $post_id ){ 
     wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' );
     $prfx_stored_meta = get_post_meta( $post_id ); 
	 $slider = get_field('slider','customizer');
        if(isset($slider)){
            $_count = 1;
            echo '<table width="100%">';
            foreach ($slider as $row) { ?> 
             <tr width="100%">
                <td  width="100%">
                <p><label class="prfx-row-title"><?php _e( 'text slide', 'prfx-textdomain' )?></label></p>
                <textarea class="my_custom_class" name="page-slide-text-<?php echo $_count; ?>" rows="3" cols="100"><?php if ( isset ( $prfx_stored_meta['page-slide-text-'.$_count] ) ) echo $prfx_stored_meta['page-slide-text-'.$_count][0]; else echo $row['text_slider']; ?></textarea>
                </td>
               </tr>
            <?php
                $_count++; 
            }
            echo '</table>';
        }?>
		<table width="100%">
			 <tr width="100%">
				<td  width="100%">
				<p><label class="prfx-row-title"><?php _e( 'text1', 'prfx-textdomain' )?></label></p>

				<p><textarea class="editor" name="page-main-home-text1" rows="5" cols="100"><?php if ( isset ( $prfx_stored_meta['page-main-home-text1'] ) ) echo $prfx_stored_meta['page-main-home-text1'][0]; else echo get_field('main_content_html','customizer'); ?></textarea>
				</p>	
				<p><label class="prfx-row-title"><?php _e( 'link', 'prfx-textdomain' )?></label></p>
				<p><input width="100%" type="text" name="page-main-home-link1" value="<?php if ( isset ( $prfx_stored_meta['page-main-home-link1'] ) ) echo $prfx_stored_meta['page-main-home-link1'][0]; ?>" />
				</p>
				<p><label class="prfx-row-title"><?php _e( 'readmore', 'prfx-textdomain' )?></label></p>
				<p>
				   <input type="text" name="page-main-home-button1" value="<?php if ( isset ( $prfx_stored_meta['page-main-home-button1'] ) ) echo $prfx_stored_meta['page-main-home-button1'][0]; ?>" />
				</p>
				</td>
			</tr>
		</table>
		<table width="100%">
			 <tr width="100%">
				<td  width="100%">
				<p><label class="prfx-row-title"><?php _e( 'text solution', 'prfx-textdomain' )?></label></p>
				<p><textarea name="page-solution-main-text1" rows="5" cols="100"><?php if ( isset ( $prfx_stored_meta['page-solution-main-text1'] ) ) echo $prfx_stored_meta['page-solution-main-text1'][0]; else echo get_field('main_content_html','customizer'); ?></textarea>
				</p>	
				</td>
			</tr>
		</table>
		<table width="100%">
			 <tr width="100%">
				<?php $main_solution_item = get_field('main_solution_item','customizer'); 
					  $_count = 1;
					  foreach($main_solution_item as $row){ ?>
						<td  width="30%">
							<p><label class="prfx-row-title"><?php _e( 'text link '.$_count, 'prfx-textdomain' )?></label></p>
							<p>
							   <input type="text" name="page-solution-home-text<?php echo $_count; ?>" value="<?php if ( isset ( $prfx_stored_meta['page-solution-home-text'.$_count] ) ) echo $prfx_stored_meta['page-solution-home-text'.$_count][0]; ?>" />
							</p>
							<p><label class="prfx-row-title"><?php _e( 'link '.$_count, 'prfx-textdomain' )?></label></p>
							<p>
							   <input type="text" name="page-solution-home-link<?php echo $_count; ?>" value="<?php if ( isset ( $prfx_stored_meta['page-solution-home-link'.$_count] ) ) echo $prfx_stored_meta['page-solution-home-link'.$_count][0]; ?>" />
							</p>
						</td>
					  <?php
						$_count++;
					  } ?>
			</tr>
		</table>
		<table width="100%">
			 <tr width="100%">
				<td  width="100%">
				<p><label class="prfx-row-title"><?php _e( 'text news', 'prfx-textdomain' )?></label></p>
				<p><input type="text" name="page-home-news-text1" value="<?php if ( isset ( $prfx_stored_meta['page-home-news-text1'] ) ) echo $prfx_stored_meta['page-home-news-text1'][0]; ?>" />
				</p>
				<textarea name="page-home-news-caption1" rows="3" cols="100"><?php if ( isset ( $prfx_stored_meta['page-home-news-caption1'] ) ) echo $prfx_stored_meta['page-home-news-caption1'][0]; ?></textarea>	
				</p>
				<p><input type="text" name="page-home-news-link1" value="<?php if ( isset ( $prfx_stored_meta['page-home-news-link1'] ) ) echo $prfx_stored_meta['page-home-news-link1'][0]; ?>" />
				</p>				
				</td>
			</tr>
		</table>
<?php }
function update_custom_field_page_home($post_id){
	 $slider = get_field('slider','customizer');
        if(isset($slider)){
            $_count = 1;
            foreach ($slider as $row) {
                if( isset( $_POST['page-slide-text-'.$_count] ) ) {
                    update_post_meta( $post_id, 'page-slide-text-'.$_count, $_POST[ 'page-slide-text-'.$_count ] );    
                }
                $_count++;
            }
        }
     if( isset( $_POST['page-main-home-text1'] ) ) {
        update_post_meta( $post_id, 'page-main-home-text1', $_POST[ 'page-main-home-text1' ] );    
    }
	if( isset( $_POST['page-main-home-link1'] ) ) {
        update_post_meta( $post_id, 'page-main-home-link1', $_POST[ 'page-main-home-link1' ] );    
    }
	if( isset( $_POST['page-main-home-button1'] ) ) {
        update_post_meta( $post_id, 'page-main-home-button1', $_POST[ 'page-main-home-button1' ] );    
    }
	if( isset( $_POST['page-solution-main-text1'] ) ) {
        update_post_meta( $post_id, 'page-solution-main-text1', $_POST[ 'page-solution-main-text1' ] );    
    }
	$main_solution_item = get_field('main_solution_item','customizer');
	if(isset($main_solution_item)){
		$_count = 1 ;
		foreach($main_solution_item as $row){
			if( isset( $_POST['page-solution-home-text'.$_count] ) ) {
				update_post_meta( $post_id, 'page-solution-home-text'.$_count , $_POST[ 'page-solution-home-text'.$_count] );    
			} 
			if( isset( $_POST['page-solution-home-link'.$_count] ) ) {
				update_post_meta( $post_id, 'page-solution-home-link'.$_count, $_POST[ 'page-solution-home-link'.$_count] );    
			}
			$_count++;
		}
	}
	if( isset( $_POST['page-home-news-text1'] ) ) {
        update_post_meta( $post_id, 'page-home-news-text1', $_POST[ 'page-home-news-text1' ] );    
    }
	if( isset( $_POST['page-home-news-link1'] ) ) {
        update_post_meta( $post_id, 'page-home-news-link1', $_POST[ 'page-home-news-link1' ] );    
    }
	if( isset( $_POST['page-home-news-caption1'] ) ) {
        update_post_meta( $post_id, 'page-home-news-caption1', $_POST[ 'page-home-news-caption1' ] );    
    }
}	
function prfx_field_meta_custom_field_page_callback( $post_id ) {
    wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' );
    $prfx_stored_meta = get_post_meta( $post_id ); ?>
  <table width="100%">
     <tr width="100%">
        <td  width="50%">
        <p><label class="prfx-row-title"><?php _e( 'text1', 'prfx-textdomain' )?></label></p>
        <textarea name="service-text-left1" rows="4" cols="50"><?php if ( isset ( $prfx_stored_meta['service-text-left1'] ) ) echo $prfx_stored_meta['service-text-left1'][0]; ?></textarea></td>
        <td  width="50%">   
        <p><label class="prfx-row-title"><?php _e( 'video', 'prfx-textdomain' )?></label></p>
        <p><input type="text" class="edit-image" name="service-right-video1" value="<?php if ( isset ( $prfx_stored_meta['service-right-video1'] ) ) echo $prfx_stored_meta['service-right-video1'][0]; ?>" /></p>
        <p>
        <video class="thumbnail" width="320" height="240" controls>
              <source src="<?php if ( isset ( $prfx_stored_meta['service-right-video1'] ) ) echo $prfx_stored_meta['service-right-video1'][0]; ?>" type="video/mp4">
              <!-- <source src="movie.ogg" type="video/ogg"> -->
            Your browser does not support the video tag.
            </video>
            
            </p>
            <button type="button" class="images-menu-button">Upload</button>
        </td>
    </tr>
    <tr width="100%">
        <td  width="50%">
        <p><label class="prfx-row-title"><?php _e( 'text 2', 'prfx-textdomain' )?></label></p>
        <textarea name="service-text-left2" rows="10" cols="50"><?php if ( isset ( $prfx_stored_meta['service-text-left2'] ) ) echo $prfx_stored_meta['service-text-left2'][0]; ?></textarea></td>
        <td  width="50%">   
        <p><label class="prfx-row-title"><?php _e( 'image right', 'prfx-textdomain' )?></label></p>
        <p><input type="text" class="edit-image" name="service-right-image2" value="<?php if ( isset ( $prfx_stored_meta['service-right-image2'] ) ) echo $prfx_stored_meta['service-right-image2'][0]; ?>" /></p>
        <p><img height="100" width="auto" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['service-right-image2'] ) ) echo $prfx_stored_meta['service-right-image2'][0]; ?>"></p>
            <button type="button" class="images-menu-button">Upload</button>
        </td>
    </tr>
    <tr width="100%">
        <td  width="50%">   
        <p><label class="prfx-row-title"><?php _e( 'image 3', 'prfx-textdomain' )?></label></p>
        <p><input type="text" class="edit-image" name="service-right-image3" value="<?php if ( isset ( $prfx_stored_meta['service-right-image3'] ) ) echo $prfx_stored_meta['service-right-image3'][0]; ?>" /></p>
        <p><img height="100" width="auto" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['service-right-image3'] ) ) echo $prfx_stored_meta['service-right-image3'][0]; ?>"></p>
            <button type="button" class="images-menu-button">Upload</button>
        </td>
        <td  width="50%">
        <p><label class="prfx-row-title"><?php _e( 'text 3', 'prfx-textdomain' )?></label></p>
            <textarea name="service-text-left3" rows="10" cols="50"><?php if ( isset ( $prfx_stored_meta['service-text-left3'] ) ) echo $prfx_stored_meta['service-text-left3'][0]; ?></textarea></td>
        
    </tr>
     <tr width="100%">
        <td  width="50%">
            <p><label class="prfx-row-title"><?php _e( 'text 4', 'prfx-textdomain' )?></label></p>
                <textarea name="service-text-left4" rows="10" cols="50"><?php if ( isset ( $prfx_stored_meta['service-text-left4'] ) ) echo $prfx_stored_meta['service-text-left4'][0]; ?></textarea></td>
            <td  width="50%">   
            <p><label class="prfx-row-title"><?php _e( 'image 4', 'prfx-textdomain' )?></label></p>
            <p><input type="text" class="edit-image" name="service-right-image4" value="<?php if ( isset ( $prfx_stored_meta['service-right-image4'] ) ) echo $prfx_stored_meta['service-right-image4'][0]; ?>" /></p>
            <p><img height="100" width="auto" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['service-right-image4'] ) ) echo $prfx_stored_meta['service-right-image4'][0]; ?>"></p>
                <button type="button" class="images-menu-button">Upload</button>
        </td>
    </tr>
    <tr width="100%">
        <td  width="50%">   
            <p><label class="prfx-row-title"><?php _e( 'image 5', 'prfx-textdomain' )?></label></p>
            <p><input type="text" class="edit-image" name="service-right-image5" value="<?php if ( isset ( $prfx_stored_meta['service-right-image5'] ) ) echo $prfx_stored_meta['service-right-image5'][0]; ?>" /></p>
            <p><img height="100" width="auto" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['service-right-image5'] ) ) echo $prfx_stored_meta['service-right-image5'][0]; ?>"></p>
                <button type="button" class="images-menu-button">Upload</button><p>
        </td>
        <td  width="50%">
            <p><label class="prfx-row-title"><?php _e( 'text 5', 'prfx-textdomain' )?></label></p>
            <textarea name="service-text-left5" rows="10" cols="50"><?php if ( isset ( $prfx_stored_meta['service-text-left5'] ) ) echo $prfx_stored_meta['service-text-left5'][0]; ?></textarea>
         </td>
    </tr>
    
 </table>
 <table width="100%">
    <tr width="100%"><td>------------------------------------------------------</td></tr>
    <tr width="100%">
        <td width="100%">
            <p><input type="text" name="service-text-center6" value="<?php if ( isset ( $prfx_stored_meta['service-text-center6'] ) ) echo $prfx_stored_meta['service-text-center6'][0]; ?>"/></p>
        </td>
    </tr>
  </table>
  <table width="100%">
    <tr width="100%">
        <td width="33%">
            <p><input type="text" class="edit-image" name="service-icon-image6" value="<?php if ( isset ( $prfx_stored_meta['service-icon-image6'] ) ) echo $prfx_stored_meta['service-icon-image6'][0]; ?>" /></p>
            <p><img height="100" width="auto" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['service-icon-image6'] ) ) echo $prfx_stored_meta['service-icon-image6'][0]; ?>"></p>
                <button type="button" class="images-menu-button">Upload</button>
             <p><input type="text" name="service-text-right6" value="<?php if ( isset ( $prfx_stored_meta['service-text-right6'] ) ) echo $prfx_stored_meta['service-text-right6'][0]; ?>"/></p>
            <p><textarea name="service-text-bottom6" rows="5" cols="30"><?php if ( isset ( $prfx_stored_meta['service-text-bottom6'] ) ) echo $prfx_stored_meta['service-text-bottom6'][0]; ?></textarea><p>

        </td>
        <td width="33%">
            <p><input type="text" class="edit-image" name="service-icon-image7" value="<?php if ( isset ( $prfx_stored_meta['service-icon-image7'] ) ) echo $prfx_stored_meta['service-icon-image7'][0]; ?>" /></p>
            <p><img height="100" width="auto" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['service-icon-image7'] ) ) echo $prfx_stored_meta['service-icon-image7'][0]; ?>"></p>
                <button type="button" class="images-menu-button">Upload</button>
             <p><input type="text" name="service-text-right7" value="<?php if ( isset ( $prfx_stored_meta['service-text-right7'] ) ) echo $prfx_stored_meta['service-text-right7'][0]; ?>"/></p>
            <p><textarea name="service-text-bottom7" rows="5" cols="30"><?php if ( isset ( $prfx_stored_meta['service-text-bottom7'] ) ) echo $prfx_stored_meta['service-text-bottom7'][0]; ?></textarea><p>

        </td>
        <td width="33%">
            <p><input type="text" class="edit-image" name="service-bg-image8" value="<?php if ( isset ( $prfx_stored_meta['service-bg-image8'] ) ) echo $prfx_stored_meta['service-bg-image8'][0]; ?>" /></p>
            <p><img height="100" width="auto" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['service-bg-image8'] ) ) echo $prfx_stored_meta['service-bg-image8'][0]; ?>"></p>
                <button type="button" class="images-menu-button">Upload</button>

        </td>
        </tr>
        <tr width="100%">
            <td width="33%">
                <p><input type="text" class="edit-image" name="service-icon-image9" value="<?php if ( isset ( $prfx_stored_meta['service-icon-image9'] ) ) echo $prfx_stored_meta['service-icon-image9'][0]; ?>" /></p>
                <p><img height="100" width="auto" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['service-icon-image9'] ) ) echo $prfx_stored_meta['service-icon-image9'][0]; ?>"></p>
                    <button type="button" class="images-menu-button">Upload</button>
                 <p><input type="text" name="service-text-right9" value="<?php if ( isset ( $prfx_stored_meta['service-text-right9'] ) ) echo $prfx_stored_meta['service-text-right9'][0]; ?>"/></p>
                <p><textarea name="service-text-bottom9" rows="5" cols="30"><?php if ( isset ( $prfx_stored_meta['service-text-bottom9'] ) ) echo $prfx_stored_meta['service-text-bottom9'][0]; ?></textarea><p>

            </td>
            <td width="33%">
                <p><input type="text" class="edit-image" name="service-icon-image10" value="<?php if ( isset ( $prfx_stored_meta['service-icon-image10'] ) ) echo $prfx_stored_meta['service-icon-image10'][0]; ?>" /></p>
                <p><img height="100" width="auto" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['service-icon-image10'] ) ) echo $prfx_stored_meta['service-icon-image10'][0]; ?>"></p>
                    <button type="button" class="images-menu-button">Upload</button>
                 <p><input type="text" name="service-text-right10" value="<?php if ( isset ( $prfx_stored_meta['service-text-right10'] ) ) echo $prfx_stored_meta['service-text-right10'][0]; ?>"/></p>
                <p><textarea name="service-text-bottom10" rows="5" cols="30"><?php if ( isset ( $prfx_stored_meta['service-text-bottom10'] ) ) echo $prfx_stored_meta['service-text-bottom10'][0]; ?></textarea><p>

            </td>
            <td width="33%">
                <p><input type="text" class="edit-image" name="service-icon-image11" value="<?php if ( isset ( $prfx_stored_meta['service-icon-image11'] ) ) echo $prfx_stored_meta['service-icon-image11'][0]; ?>" /></p>
                <p><img height="110" width="auto" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['service-icon-image11'] ) ) echo $prfx_stored_meta['service-icon-image11'][0]; ?>"></p>
                    <button type="button" class="images-menu-button">Upload</button>
                 <p><input type="text" name="service-text-right11" value="<?php if ( isset ( $prfx_stored_meta['service-text-right11'] ) ) echo $prfx_stored_meta['service-text-right11'][0]; ?>"/></p>
                <p><textarea name="service-text-bottom11" rows="5" cols="30"><?php if ( isset ( $prfx_stored_meta['service-text-bottom11'] ) ) echo $prfx_stored_meta['service-text-bottom11'][0]; ?></textarea><p>

            </td>
        </tr>
        <tr width="100%">
            <td width="33%">
                <p><input type="text" class="edit-image" name="service-bg-image12" value="<?php if ( isset ( $prfx_stored_meta['service-bg-image12'] ) ) echo $prfx_stored_meta['service-bg-image12'][0]; ?>" /></p>
                <p><img height="100" width="auto" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['service-bg-image12'] ) ) echo $prfx_stored_meta['service-bg-image12'][0]; ?>"></p>
                    <button type="button" class="images-menu-button">Upload</button>

            </td>
            <td width="33%">
                <p><input type="text" class="edit-image" name="service-icon-image13" value="<?php if ( isset ( $prfx_stored_meta['service-icon-image13'] ) ) echo $prfx_stored_meta['service-icon-image13'][0]; ?>" /></p>
                <p><img height="100" width="auto" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['service-icon-image13'] ) ) echo $prfx_stored_meta['service-icon-image13'][0]; ?>"></p>
                    <button type="button" class="images-menu-button">Upload</button>
                 <p><input type="text" name="service-text-right13" value="<?php if ( isset ( $prfx_stored_meta['service-text-right13'] ) ) echo $prfx_stored_meta['service-text-right13'][0]; ?>"/></p>
                <p><textarea name="service-text-bottom13" rows="5" cols="30"><?php if ( isset ( $prfx_stored_meta['service-text-bottom13'] ) ) echo $prfx_stored_meta['service-text-bottom13'][0]; ?></textarea><p>

            </td>
            <td width="33%">
                <p><input type="text" class="edit-image" name="service-icon-image14" value="<?php if ( isset ( $prfx_stored_meta['service-icon-image14'] ) ) echo $prfx_stored_meta['service-icon-image14'][0]; ?>" /></p>
                <p><img height="100" width="auto" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['service-icon-image14'] ) ) echo $prfx_stored_meta['service-icon-image14'][0]; ?>"></p>
                    <button type="button" class="images-menu-button">Upload</button>
                 <p><input type="text" name="service-text-right14" value="<?php if ( isset ( $prfx_stored_meta['service-text-right14'] ) ) echo $prfx_stored_meta['service-text-right14'][0]; ?>"/></p>
                <p><textarea name="service-text-bottom14" rows="5" cols="30"><?php if ( isset ( $prfx_stored_meta['service-text-bottom14'] ) ) echo $prfx_stored_meta['service-text-bottom14'][0]; ?></textarea><p>

            </td>
        </tr>
        <tr width="100%">
        <td width="33%">
            <p><input type="text" class="edit-image" name="service-icon-image15" value="<?php if ( isset ( $prfx_stored_meta['service-icon-image15'] ) ) echo $prfx_stored_meta['service-icon-image15'][0]; ?>" /></p>
            <p><img height="100" width="auto" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['service-icon-image15'] ) ) echo $prfx_stored_meta['service-icon-image15'][0]; ?>"></p>
                <button type="button" class="images-menu-button">Upload</button>
             <p><input type="text" name="service-text-right15" value="<?php if ( isset ( $prfx_stored_meta['service-text-right15'] ) ) echo $prfx_stored_meta['service-text-right15'][0]; ?>"/></p>
            <p><textarea name="service-text-bottom15" rows="5" cols="30"><?php if ( isset ( $prfx_stored_meta['service-text-bottom15'] ) ) echo $prfx_stored_meta['service-text-bottom15'][0]; ?></textarea><p>

        </td>
        <td width="33%">
            <p><input type="text" class="edit-image" name="service-icon-image16" value="<?php if ( isset ( $prfx_stored_meta['service-icon-image16'] ) ) echo $prfx_stored_meta['service-icon-image16'][0]; ?>" /></p>
            <p><img height="100" width="auto" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['service-icon-image16'] ) ) echo $prfx_stored_meta['service-icon-image16'][0]; ?>"></p>
                <button type="button" class="images-menu-button">Upload</button>
             <p><input type="text" name="service-text-right16" value="<?php if ( isset ( $prfx_stored_meta['service-text-right16'] ) ) echo $prfx_stored_meta['service-text-right16'][0]; ?>"/></p>
            <p><textarea name="service-text-bottom16" rows="5" cols="30"><?php if ( isset ( $prfx_stored_meta['service-text-bottom16'] ) ) echo $prfx_stored_meta['service-text-bottom16'][0]; ?></textarea><p>

        </td>
        <td width="33%">
            <p><input type="text" class="edit-image" name="service-bg-image17" value="<?php if ( isset ( $prfx_stored_meta['service-bg-image17'] ) ) echo $prfx_stored_meta['service-bg-image17'][0]; ?>" /></p>
            <p><img height="100" width="auto" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['service-bg-image17'] ) ) echo $prfx_stored_meta['service-bg-image17'][0]; ?>"></p>
                <button type="button" class="images-menu-button">Upload</button>

        </td>
    </tr>
  </table>

  <table width="100%">
    <tr>
        <td width="100%">
            <p><input type="text" name="service-app-center18" value="<?php if ( isset ( $prfx_stored_meta['service-app-center18'] ) ) echo $prfx_stored_meta['service-app-center18'][0]; ?>"/></p>
            <p><textarea id="service-app-desc18" name="service-app-desc18" rows="5" cols="30"><?php if ( isset ( $prfx_stored_meta['service-app-desc18'] ) ) echo $prfx_stored_meta['service-app-desc18'][0]; ?></textarea><p>
        </td>
    </tr>
  </table>
  <table width="100%">
    <tr width="100%">
        <td width="50%">
            <p><input type="text" name="service-app-text19" value="<?php if ( isset ( $prfx_stored_meta['service-app-text19'] ) ) echo $prfx_stored_meta['service-app-text19'][0]; ?>"/></p>
        
            <p><input type="text" name="service-app-text20" value="<?php if ( isset ( $prfx_stored_meta['service-app-text20'] ) ) echo $prfx_stored_meta['service-app-text20'][0]; ?>"/></p>
        
            <p><input type="text" name="service-app-text21" value="<?php if ( isset ( $prfx_stored_meta['service-app-text21'] ) ) echo $prfx_stored_meta['service-app-text21'][0]; ?>"/></p>
        
            <p><input type="text" name="service-app-text22" value="<?php if ( isset ( $prfx_stored_meta['service-app-text22'] ) ) echo $prfx_stored_meta['service-app-text22'][0]; ?>"/></p>
        
            <p><input type="text" name="service-app-text23" value="<?php if ( isset ( $prfx_stored_meta['service-app-text23'] ) ) echo $prfx_stored_meta['service-app-text23'][0]; ?>"/></p>
        </td>
        <td width="50%">
            <p><input type="text" name="service-app-text24" value="<?php if ( isset ( $prfx_stored_meta['service-app-text24'] ) ) echo $prfx_stored_meta['service-app-text24'][0]; ?>"/></p>
        
            <p><input type="text" name="service-app-text25" value="<?php if ( isset ( $prfx_stored_meta['service-app-text25'] ) ) echo $prfx_stored_meta['service-app-text25'][0]; ?>"/></p>
        
            <p><input type="text" name="service-app-text26" value="<?php if ( isset ( $prfx_stored_meta['service-app-text26'] ) ) echo $prfx_stored_meta['service-app-text26'][0]; ?>"/></p>
       
            <p><input type="text" name="service-app-text27" value="<?php if ( isset ( $prfx_stored_meta['service-app-text27'] ) ) echo $prfx_stored_meta['service-app-text27'][0]; ?>"/></p>
        
            <p><input type="text" name="service-app-text28" value="<?php if ( isset ( $prfx_stored_meta['service-app-text28'] ) ) echo $prfx_stored_meta['service-app-text28'][0]; ?>"/></p>
        </td>
    </tr>
  </table>
  <table width="100%">
    <tr width="100%">
      <td width="100%">---------------------------------------------------gallery------------------------------------------------------------</td>
    </tr>
  </table>
  <table width="100%">
    <tr width="100%">
      <td width="30%">
        <p><input type="text" class="edit-image" name="service-bg-image29" value="<?php if ( isset ( $prfx_stored_meta['service-bg-image29'] ) ) echo $prfx_stored_meta['service-bg-image29'][0]; ?>" /></p>
        <p><img height="100" width="auto" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['service-bg-image29'] ) ) echo $prfx_stored_meta['service-bg-image29'][0]; ?>"></p>
            <button type="button" class="images-menu-button">Upload</button>
      </td>
      <td width="30%">
        <p><input type="text" class="edit-image" name="service-bg-image30" value="<?php if ( isset ( $prfx_stored_meta['service-bg-image30'] ) ) echo $prfx_stored_meta['service-bg-image30'][0]; ?>" /></p>
        <p><img height="100" width="auto" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['service-bg-image30'] ) ) echo $prfx_stored_meta['service-bg-image30'][0]; ?>"></p>
            <button type="button" class="images-menu-button">Upload</button>
      </td>
      <td width="30%">
        <p><input type="text" class="edit-image" name="service-bg-image31" value="<?php if ( isset ( $prfx_stored_meta['service-bg-image31'] ) ) echo $prfx_stored_meta['service-bg-image31'][0]; ?>" /></p>
        <p><img height="100" width="auto" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['service-bg-image31'] ) ) echo $prfx_stored_meta['service-bg-image31'][0]; ?>"></p>
            <button type="button" class="images-menu-button">Upload</button>
      </td>
    </tr>
    <tr width="100%">
      <td width="30%">
        <p><input type="text" class="edit-image" name="service-bg-image32" value="<?php if ( isset ( $prfx_stored_meta['service-bg-image32'] ) ) echo $prfx_stored_meta['service-bg-image32'][0]; ?>" /></p>
        <p><img height="100" width="auto" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['service-bg-image32'] ) ) echo $prfx_stored_meta['service-bg-image32'][0]; ?>"></p>
            <button type="button" class="images-menu-button">Upload</button>
      </td>
      <td width="30%">
        <p><input type="text" class="edit-image" name="service-bg-image33" value="<?php if ( isset ( $prfx_stored_meta['service-bg-image33'] ) ) echo $prfx_stored_meta['service-bg-image33'][0]; ?>" /></p>
        <p><img height="100" width="auto" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['service-bg-image33'] ) ) echo $prfx_stored_meta['service-bg-image33'][0]; ?>"></p>
            <button type="button" class="images-menu-button">Upload</button>
      </td>
      <td width="30%">
        <p><input type="text" class="edit-image" name="service-bg-image34" value="<?php if ( isset ( $prfx_stored_meta['service-bg-image34'] ) ) echo $prfx_stored_meta['service-bg-image34'][0]; ?>" /></p>
        <p><img height="100" width="auto" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['service-bg-image34'] ) ) echo $prfx_stored_meta['service-bg-image34'][0]; ?>"></p>
            <button type="button" class="images-menu-button">Upload</button>
      </td>
    </tr>
    <tr width="100%">
      <td width="30%">
        <p><input type="text" class="edit-image" name="service-bg-image35" value="<?php if ( isset ( $prfx_stored_meta['service-bg-image35'] ) ) echo $prfx_stored_meta['service-bg-image35'][0]; ?>" /></p>
        <p><img height="100" width="auto" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['service-bg-image35'] ) ) echo $prfx_stored_meta['service-bg-image35'][0]; ?>"></p>
            <button type="button" class="images-menu-button">Upload</button>
      </td>
      <td width="30%">
        <p><input type="text" class="edit-image" name="service-bg-image36" value="<?php if ( isset ( $prfx_stored_meta['service-bg-image36'] ) ) echo $prfx_stored_meta['service-bg-image36'][0]; ?>" /></p>
        <p><img height="100" width="auto" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['service-bg-image36'] ) ) echo $prfx_stored_meta['service-bg-image36'][0]; ?>"></p>
            <button type="button" class="images-menu-button">Upload</button>
      </td>
      <td width="30%">
        <p><input type="text" class="edit-image" name="service-bg-image37" value="<?php if ( isset ( $prfx_stored_meta['service-bg-image37'] ) ) echo $prfx_stored_meta['service-bg-image37'][0]; ?>" /></p>
        <p><img height="100" width="auto" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['service-bg-image37'] ) ) echo $prfx_stored_meta['service-bg-image37'][0]; ?>"></p>
            <button type="button" class="images-menu-button">Upload</button>
      </td>
    </tr>
  </table>
  <table width="100%">
    <tr width="100%">
      <td width="100%">---------------------------------------------------footer contact------------------------------------------------------------</td>
    </tr>
  </table>
  <table>
     <tr width="100%">
      <td width="100%">
         <p><textarea id="service-footer-contact40" name="service-footer-contact40" rows="10" cols="50"><?php if ( isset ( $prfx_stored_meta['service-footer-contact40'] ) ) echo $prfx_stored_meta['service-footer-contact40'][0]; ?></textarea><p>
        <p><input type="text" name="service-footer-contact41" value="<?php if ( isset ( $prfx_stored_meta['service-footer-contact41'] ) ) echo $prfx_stored_meta['service-footer-contact41'][0]; ?>"/></p>
        <p><input type="text" name="service-footer-contact42" value="<?php if ( isset ( $prfx_stored_meta['service-footer-contact42'] ) ) echo $prfx_stored_meta['service-footer-contact42'][0]; ?>"/></p>
      </td>
    </tr>
  </table>
  <table width="100%">
    <tr width="100%">
      <td width="100%">---------------------------------------------------button next------------------------------------------------------------</td>
    </tr>
  </table>
  <table>
     <tr width="100%">
      <td width="100%">
        <p><input type="text" name="service-button-next1" value="<?php if ( isset ( $prfx_stored_meta['service-button-next1'] ) ) echo $prfx_stored_meta['service-button-next1'][0]; ?>"/></p>
        <p><input type="text" name="service-button-next2" value="<?php if ( isset ( $prfx_stored_meta['service-button-next2'] ) ) echo $prfx_stored_meta['service-button-next2'][0]; ?>"/></p>
        <p><input type="text" name="service-button-next3" value="<?php if ( isset ( $prfx_stored_meta['service-button-next3'] ) ) echo $prfx_stored_meta['service-button-next3'][0]; ?>"/></p>
      </td>
    </tr>
  </table>
    <?php
}
function update_custom_field_page($post_id){
     if( isset( $_POST['service-text-left1'] ) ) {
        update_post_meta( $post_id, 'service-text-left1', $_POST[ 'service-text-left1' ] );    
    } 
    if( isset( $_POST['service-right-video1'] ) ) {
        update_post_meta( $post_id, 'service-right-video1', $_POST[ 'service-right-video1' ] ); 
    }   

    if( isset( $_POST['service-text-left2'] ) ) {
        update_post_meta( $post_id, 'service-text-left2', $_POST[ 'service-text-left2' ] );    
    } 
    if( isset( $_POST['service-right-image2'] ) ) {
        update_post_meta( $post_id, 'service-right-image2', $_POST[ 'service-right-image2' ] ); 
    } 
    if( isset( $_POST['service-text-left3'] ) ) {
        update_post_meta( $post_id, 'service-text-left3', $_POST[ 'service-text-left3' ] );    
    } 
    if( isset( $_POST['service-right-image3'] ) ) {
        update_post_meta( $post_id, 'service-right-image3', $_POST[ 'service-right-image3' ] ); 
    }  
    
    if( isset( $_POST['service-text-left4'] ) ) {
        update_post_meta( $post_id, 'service-text-left4', $_POST[ 'service-text-left4' ] );    
    } 
    if( isset( $_POST['service-right-image4'] ) ) {
        update_post_meta( $post_id, 'service-right-image4', $_POST[ 'service-right-image4' ] ); 
    }
    if( isset( $_POST['service-text-left5'] ) ) {
        update_post_meta( $post_id, 'service-text-left5', $_POST[ 'service-text-left5' ] );    
    } 
    if( isset( $_POST['service-right-image5'] ) ) {
        update_post_meta( $post_id, 'service-right-image5', $_POST[ 'service-right-image5' ] ); 
    } 
    if( isset( $_POST['service-text-center6'] ) ) {
        update_post_meta( $post_id, 'service-text-center6', $_POST[ 'service-text-center6' ] );    
    } 
    if( isset( $_POST['service-icon-image6'] ) ) {
        update_post_meta( $post_id, 'service-icon-image6', $_POST[ 'service-icon-image6' ] ); 
    }
    if( isset( $_POST['service-text-right6'] ) ) {
        update_post_meta( $post_id, 'service-text-right6', $_POST[ 'service-text-right6' ] );    
    } 
    if( isset( $_POST['service-text-bottom6'] ) ) {
        update_post_meta( $post_id, 'service-text-bottom6', $_POST[ 'service-text-bottom6' ] ); 
    }
    if( isset( $_POST['service-icon-image7'] ) ) {
        update_post_meta( $post_id, 'service-icon-image7', $_POST[ 'service-icon-image7' ] ); 
    }
    if( isset( $_POST['service-text-right7'] ) ) {
        update_post_meta( $post_id, 'service-text-right7', $_POST[ 'service-text-right7' ] );    
    } 
    if( isset( $_POST['service-text-bottom7'] ) ) {
        update_post_meta( $post_id, 'service-text-bottom7', $_POST[ 'service-text-bottom7' ] ); 
    } 
     if( isset( $_POST['service-bg-image8'] ) ) {
        update_post_meta( $post_id, 'service-bg-image8', $_POST[ 'service-bg-image8' ] ); 
    }
    if( isset( $_POST['service-icon-image9'] ) ) {
        update_post_meta( $post_id, 'service-icon-image9', $_POST[ 'service-icon-image9' ] ); 
    }
    if( isset( $_POST['service-text-right9'] ) ) {
        update_post_meta( $post_id, 'service-text-right9', $_POST[ 'service-text-right9' ] );    
    } 
    if( isset( $_POST['service-text-bottom9'] ) ) {
        update_post_meta( $post_id, 'service-text-bottom9', $_POST[ 'service-text-bottom9' ] ); 
    }
    if( isset( $_POST['service-icon-image10'] ) ) {
        update_post_meta( $post_id, 'service-icon-image10', $_POST[ 'service-icon-image10' ] ); 
    }
    if( isset( $_POST['service-text-right10'] ) ) {
        update_post_meta( $post_id, 'service-text-right10', $_POST[ 'service-text-right10' ] );    
    } 
    if( isset( $_POST['service-text-bottom10'] ) ) {
        update_post_meta( $post_id, 'service-text-bottom10', $_POST[ 'service-text-bottom10' ] ); 
    }
    if( isset( $_POST['service-icon-image11'] ) ) {
        update_post_meta( $post_id, 'service-icon-image11', $_POST[ 'service-icon-image11' ] ); 
    }
    if( isset( $_POST['service-text-right11'] ) ) {
        update_post_meta( $post_id, 'service-text-right11', $_POST[ 'service-text-right11' ] );    
    } 
    if( isset( $_POST['service-text-bottom11'] ) ) {
        update_post_meta( $post_id, 'service-text-bottom11', $_POST[ 'service-text-bottom11' ] ); 
    }
    if( isset( $_POST['service-bg-image12'] ) ) {
        update_post_meta( $post_id, 'service-bg-image12', $_POST[ 'service-bg-image12' ] ); 
    }
    if( isset( $_POST['service-icon-image13'] ) ) {
        update_post_meta( $post_id, 'service-icon-image13', $_POST[ 'service-icon-image13' ] ); 
    }
    if( isset( $_POST['service-text-right13'] ) ) {
        update_post_meta( $post_id, 'service-text-right13', $_POST[ 'service-text-right13' ] );    
    } 
    if( isset( $_POST['service-text-bottom13'] ) ) {
        update_post_meta( $post_id, 'service-text-bottom13', $_POST[ 'service-text-bottom13' ] ); 
    }
    if( isset( $_POST['service-icon-image14'] ) ) {
        update_post_meta( $post_id, 'service-icon-image14', $_POST[ 'service-icon-image14' ] ); 
    }
    if( isset( $_POST['service-text-right14'] ) ) {
        update_post_meta( $post_id, 'service-text-right14', $_POST[ 'service-text-right14' ] );    
    } 
    if( isset( $_POST['service-text-bottom14'] ) ) {
        update_post_meta( $post_id, 'service-text-bottom14', $_POST[ 'service-text-bottom14' ] ); 
    }

    if( isset( $_POST['service-icon-image15'] ) ) {
        update_post_meta( $post_id, 'service-icon-image15', $_POST[ 'service-icon-image15' ] ); 
    }
    if( isset( $_POST['service-text-right15'] ) ) {
        update_post_meta( $post_id, 'service-text-right15', $_POST[ 'service-text-right15' ] );    
    } 
    if( isset( $_POST['service-text-bottom15'] ) ) {
        update_post_meta( $post_id, 'service-text-bottom15', $_POST[ 'service-text-bottom15' ] ); 
    }
    if( isset( $_POST['service-icon-image16'] ) ) {
        update_post_meta( $post_id, 'service-icon-image16', $_POST[ 'service-icon-image16' ] ); 
    }
    if( isset( $_POST['service-text-right16'] ) ) {
        update_post_meta( $post_id, 'service-text-right16', $_POST[ 'service-text-right16' ] );    
    } 
    if( isset( $_POST['service-text-bottom16'] ) ) {
        update_post_meta( $post_id, 'service-text-bottom16', $_POST[ 'service-text-bottom16' ] ); 
    }
    if( isset( $_POST['service-bg-image17'] ) ) {
        update_post_meta( $post_id, 'service-bg-image17', $_POST[ 'service-bg-image17' ] ); 
    } 
    
    if( isset( $_POST['service-app-center18'] ) ) {
        update_post_meta( $post_id, 'service-app-center18', $_POST[ 'service-app-center18' ] ); 
    }
    if( isset( $_POST['service-app-desc18'] ) ) {
        update_post_meta( $post_id, 'service-app-desc18', $_POST[ 'service-app-desc18' ] ); 
    }
    if( isset( $_POST['service-app-text19'] ) ) {
        update_post_meta( $post_id, 'service-app-text19', $_POST[ 'service-app-text19' ] ); 
    }
    if( isset( $_POST['service-app-text20'] ) ) {
        update_post_meta( $post_id, 'service-app-text20', $_POST[ 'service-app-text20' ] ); 
    }
     if( isset( $_POST['service-app-text21'] ) ) {
        update_post_meta( $post_id, 'service-app-text21', $_POST[ 'service-app-text21' ] ); 
    } 
    if( isset( $_POST['service-app-text22'] ) ) {
        update_post_meta( $post_id, 'service-app-text22', $_POST[ 'service-app-text22' ] ); 
    }
     if( isset( $_POST['service-app-text23'] ) ) {
        update_post_meta( $post_id, 'service-app-text23', $_POST[ 'service-app-text23' ] ); 
    }
    if( isset( $_POST['service-app-text24'] ) ) {
        update_post_meta( $post_id, 'service-app-text24', $_POST[ 'service-app-text24' ] ); 
    }
    if( isset( $_POST['service-app-text25'] ) ) {
        update_post_meta( $post_id, 'service-app-text25', $_POST[ 'service-app-text25' ] ); 
    }
    if( isset( $_POST['service-app-text26'] ) ) {
        update_post_meta( $post_id, 'service-app-text26', $_POST[ 'service-app-text26' ] ); 
    }
     if( isset( $_POST['service-app-text27'] ) ) {
        update_post_meta( $post_id, 'service-app-text27', $_POST[ 'service-app-text27' ] ); 
    }
     if( isset( $_POST['service-app-text28'] ) ) {
        update_post_meta( $post_id, 'service-app-text28', $_POST[ 'service-app-text28' ] ); 
    }    
    if( isset( $_POST['service-bg-image29'] ) ) {
        update_post_meta( $post_id, 'service-bg-image29', $_POST[ 'service-bg-image29' ] ); 
    }
    if( isset( $_POST['service-bg-image30'] ) ) {
        update_post_meta( $post_id, 'service-bg-image30', $_POST[ 'service-bg-image30' ] ); 
    }
    if( isset( $_POST['service-bg-image31'] ) ) {
        update_post_meta( $post_id, 'service-bg-image31', $_POST[ 'service-bg-image31' ] ); 
    }
    if( isset( $_POST['service-bg-image32'] ) ) {
        update_post_meta( $post_id, 'service-bg-image32', $_POST[ 'service-bg-image32' ] ); 
    }
     if( isset( $_POST['service-bg-image33'] ) ) {
        update_post_meta( $post_id, 'service-bg-image33', $_POST[ 'service-bg-image33' ] ); 
    }
     if( isset( $_POST['service-bg-image34'] ) ) {
        update_post_meta( $post_id, 'service-bg-image34', $_POST[ 'service-bg-image34' ] ); 
    }
     if( isset( $_POST['service-bg-image35'] ) ) {
        update_post_meta( $post_id, 'service-bg-image35', $_POST[ 'service-bg-image35' ] ); 
    }
     if( isset( $_POST['service-bg-image36'] ) ) {
        update_post_meta( $post_id, 'service-bg-image36', $_POST[ 'service-bg-image36' ] ); 
    }
     if( isset( $_POST['service-bg-image37'] ) ) {
        update_post_meta( $post_id, 'service-bg-image37', $_POST[ 'service-bg-image37' ] ); 
    }
     if( isset( $_POST['service-bg-image38'] ) ) {
        update_post_meta( $post_id, 'service-bg-image38', $_POST[ 'service-bg-image38' ] ); 
    }
     if( isset( $_POST['service-bg-image39'] ) ) {
        update_post_meta( $post_id, 'service-bg-image39', $_POST[ 'service-bg-image39' ] ); 
    }
    if( isset( $_POST['service-footer-contact40'] ) ) {
        update_post_meta( $post_id, 'service-footer-contact40', $_POST[ 'service-footer-contact40' ] ); 
    }
    if( isset( $_POST['service-footer-contact41'] ) ) {
        update_post_meta( $post_id, 'service-footer-contact41', $_POST[ 'service-footer-contact41' ] ); 
    } 
    if( isset( $_POST['service-footer-contact42'] ) ) {
        update_post_meta( $post_id, 'service-footer-contact42', $_POST[ 'service-footer-contact42' ] ); 
    }
	
	if( isset( $_POST['service-button-next1'] ) ) {
        update_post_meta( $post_id, 'service-button-next1', $_POST[ 'service-button-next1' ] ); 
    }
	if( isset( $_POST['service-button-next2'] ) ) {
        update_post_meta( $post_id, 'service-button-next2', $_POST[ 'service-button-next2' ] ); 
    }
	if( isset( $_POST['service-button-next3'] ) ) {
        update_post_meta( $post_id, 'service-button-next3', $_POST[ 'service-button-next3' ] ); 
    }
}