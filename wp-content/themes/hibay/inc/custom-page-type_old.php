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
	}elseif('page-contact.php' == $template){
		prfx_field_meta_custom_field_page_contact($idpost);
	}elseif('page-register.php' == $template){
		prfx_field_meta_custom_field_page_register($idpost);
	}
	else{
		prfx_field_meta_custom_field_page_other($idpost);
	}
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
    }elseif("page-contact.php" == $template){
		update_custom_field_page_contact($post_id);
	}elseif("page-register.php" == $template){
		update_custom_field_page_register($post_id);
	}
    else{
		update_custom_field_page_other($post_id);
	};
}
add_action('save_post', 'prfx_field_page_save');
/*other*/
function prfx_field_meta_custom_field_page_other( $post_id ){
     wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' );
     $prfx_stored_meta = get_post_meta( $post_id ); ?>
		<div>
		 <p><button type="button" onclick="showslide(this)">banner page</button></p>
			  <table class="slide" style="display: none;">
				  <tr width="100%">
					  <td width="100%">
						<p><label class="prfx-row-title"><?php _e( 'banner', 'prfx-textdomain' )?></label></p>
						<p><input type="hidden" class="edit-image" name="banner_page" value="<?php if ( isset ( $prfx_stored_meta['banner_page'] ) ) echo $prfx_stored_meta['banner_page'][0]; ?>" /></p>
						<p><img style="height: 100px;width: auto;" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['banner_page'] ) ) echo $prfx_stored_meta['banner_page'][0]; ?>"></p>
						<button type="button" class="images-menu-button">Upload</button>
					   </td>
					</tr>
			</table>
		</div>
<?php }
function update_custom_field_page_other($post_id){
	
	 if( isset( $_POST['banner_page'])) {
         update_post_meta($post_id, 'banner_page', $_POST[ 'banner_page']);    
     }
}
/*end other*/
function prfx_field_meta_custom_field_page_register( $post_id ){
     wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' );
     $prfx_stored_meta = get_post_meta( $post_id ); ?>
		<div>
		 <p><button type="button" onclick="showslide(this)">banner page</button></p>
			  <table class="slide" style="display: none;">
				  <tr width="100%">
					  <td width="100%">
						<p><label class="prfx-row-title"><?php _e( 'banner', 'prfx-textdomain' )?></label></p>
						<p><input type="hidden" class="edit-image" name="banner_page" value="<?php if ( isset ( $prfx_stored_meta['banner_page'] ) ) echo $prfx_stored_meta['banner_page'][0]; ?>" /></p>
						<p><img style="height: 100px;width: auto;" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['banner_page'] ) ) echo $prfx_stored_meta['banner_page'][0]; ?>"></p>
						<button type="button" class="images-menu-button">Upload</button>
					   </td>
					</tr>
			</table>
		</div>
		<div>
	     <p><button type="button" onclick="showslide(this)">form register</button></p>
			  <table class="slide" style="display: none;">
				  <tr width="100%">
					  <td width="100%">
						<p><label>row title 1</label></p>
						<p><input style="width:100%" type="text" name="register-title1" value="<?php if ( isset ( $prfx_stored_meta['register-title1'] ) ) echo $prfx_stored_meta['register-title1'][0]; ?>" ></p>
					   </td>
				  </tr>
				   <tr width="100%">
					  <td width="100%">
						<p><label>row title 2</label></p>
						<p><input style="width:100%" type="text" name="register-title2" value="<?php if ( isset ( $prfx_stored_meta['register-title2'] ) ) echo $prfx_stored_meta['register-title2'][0]; ?>" ></p>
					   </td>
				  </tr>
				   <tr width="100%">
					  <td width="100%">
						<p><label>colum desc 3</label></p>
						<p><textarea  rows="3" cols="100" name="register-desc3"><?php if ( isset ( $prfx_stored_meta['register-desc3'] ) ) echo $prfx_stored_meta['register-desc3'][0]; ?></textarea></p>
					   </td>
				  </tr>
			</table>
		</div>
		<div>
		 <p><button type="button" onclick="showslide(this)">field register</button></p>
		  <table class="slide" style="display: none;">
			<tr width="100%">
			 <td width="100%">
				<p><label>row title 4</label></p>
				<p><input style="width:100%" type="text" name="register-title4" value="<?php if ( isset ( $prfx_stored_meta['register-title4'] ) ) echo $prfx_stored_meta['register-title4'][0]; ?>" ></p>
			   </td>
			 </tr>
			 <tr width="100%">
			  <td width="100%">
				<p><label>row title 5</label></p>
				<p><input style="width:100%" type="text" name="register-title5" value="<?php if ( isset ( $prfx_stored_meta['register-title5'] ) ) echo $prfx_stored_meta['register-title5'][0]; ?>" ></p>
			   </td>
			</tr>
			 <tr width="100%">
			  <td width="100%">
				<p><label>row title 6</label></p>
				<p><input style="width:100%" type="text" name="register-title6" value="<?php if ( isset ( $prfx_stored_meta['register-title6'] ) ) echo $prfx_stored_meta['register-title6'][0]; ?>" ></p>
			   </td>
			</tr>
			 <tr width="100%">
			  <td width="100%">
				<p><label>row title 7</label></p>
				<p><input style="width:100%" type="text" name="register-title7" value="<?php if ( isset ( $prfx_stored_meta['register-title7'] ) ) echo $prfx_stored_meta['register-title7'][0]; ?>" ></p>
			   </td>
			</tr>
			 <tr width="100%">
			  <td width="100%">
				<p><label>row title 8</label></p>
				<p><input style="width:100%" type="text" name="register-title8" value="<?php if ( isset ( $prfx_stored_meta['register-title8'] ) ) echo $prfx_stored_meta['register-title8'][0]; ?>" ></p>
			   </td>
			</tr>
			<tr width="100%">
			  <td width="100%">
				<p><label>row title 9</label></p>
				<p><input style="width:100%" type="text" name="register-title9" value="<?php if ( isset ( $prfx_stored_meta['register-title9'] ) ) echo $prfx_stored_meta['register-title9'][0]; ?>" ></p>
			   </td>
			</tr>
		  </table>
		</div>
<?php }
function update_custom_field_page_register($post_id){
	 if( isset( $_POST['banner_page'])) {
         update_post_meta($post_id, 'banner_page', $_POST[ 'banner_page']);    
     }
	 if( isset( $_POST['register-title1'])) {
         update_post_meta($post_id, 'register-title1', $_POST[ 'register-title1']);    
     }
	 if( isset( $_POST['register-title2'])) {
         update_post_meta($post_id, 'register-title2', $_POST[ 'register-title2']);    
     }
	 if( isset( $_POST['register-desc3'])) {
         update_post_meta($post_id, 'register-desc3', $_POST[ 'register-desc3']);    
     }
	 if( isset( $_POST['register-title4'])) {
		update_post_meta($post_id, 'register-title4', $_POST[ 'register-title4']);    
	 }
	 if( isset( $_POST['register-title5'])) {
		 update_post_meta($post_id, 'register-title5', $_POST[ 'register-title5']);    
	 }
	 if( isset( $_POST['register-title6'])) {
		 update_post_meta($post_id, 'register-title6', $_POST[ 'register-title6']);    
	 }
	 if( isset( $_POST['register-title7'])) {
		 update_post_meta($post_id, 'register-title7', $_POST[ 'register-title7']);    
	 }
	 if( isset( $_POST['register-title8'])) {
		 update_post_meta($post_id, 'register-title8', $_POST[ 'register-title8']);    
	 }
	 if( isset( $_POST['register-title9'])) {
		 update_post_meta($post_id, 'register-title9', $_POST[ 'register-title9']);    
	 }
}
function prfx_field_meta_custom_field_page_contact( $post_id ){
     wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' );
     $prfx_stored_meta = get_post_meta( $post_id ); ?>
	 <div>
		 <p><button type="button" onclick="showslide(this)">banner page</button></p>
			  <table class="slide" style="display: none;">
				  <tr width="100%">
					  <td width="100%">
						<p><label class="prfx-row-title"><?php _e( 'banner', 'prfx-textdomain' )?></label></p>
						<p><input type="hidden" class="edit-image" name="banner_page" value="<?php if ( isset ( $prfx_stored_meta['banner_page'] ) ) echo $prfx_stored_meta['banner_page'][0]; ?>" /></p>
						<p><img style="height: 100px;width: auto;" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['banner_page'] ) ) echo $prfx_stored_meta['banner_page'][0]; ?>"></p>
						<button type="button" class="images-menu-button">Upload</button>
					   </td>
					</tr>
			</table>
		</div>
     <div>
	     <p><button type="button" onclick="showslide(this)">Contact 1</button></p>
		  <table class="slide" style="display: none;">
			  <tr width="100%">
				  <td width="100%">
					<p><label>title 1</label></p>
					<p><input style="width:100%" type="text" name="info-cont-title1" value="<?php if ( isset ( $prfx_stored_meta['info-cont-title1'] ) ) echo $prfx_stored_meta['info-cont-title1'][0]; ?>" ></p>
				   </td>
			  </tr>
			  <tr width="100%">
				  <td width="100%">
					<p><label>mo ta 1</label></p>
					<p><textarea  rows="3" cols="100" name="info-cont-desc1"><?php if ( isset ( $prfx_stored_meta['info-cont-desc1'] ) ) echo $prfx_stored_meta['info-cont-desc1'][0]; ?></textarea></p>
				   </td>
			  </tr>
		</table>
	</div>
	<div>
	     <p><button type="button" onclick="showslide(this)">Contact 2</button></p>
		  <table class="slide" style="display: none;">
			  <tr width="100%">
				  <td width="100%">
					<p><label>colum title 1</label></p>
					<p><input style="width:100%" type="text" name="info-column-title2" value="<?php if ( isset ( $prfx_stored_meta['info-column-title2'] ) ) echo $prfx_stored_meta['info-column-title2'][0]; ?>" ></p>
				   </td>
			  </tr>
			  <tr width="100%">
				  <td width="100%">
					<p><label>colum desc 1</label></p>
					<p><textarea  rows="3" cols="100" name="info-column-desc2"><?php if ( isset ( $prfx_stored_meta['info-column-desc2'] ) ) echo $prfx_stored_meta['info-column-desc2'][0]; ?></textarea></p>
				   </td>
			  </tr>
			  <tr width="100%">
				  <td width="100%">
					<p><label>colum title 2</label></p>
					<p><input style="width:100%" type="text" name="info-column-title3" value="<?php if ( isset ( $prfx_stored_meta['info-column-title3'] ) ) echo $prfx_stored_meta['info-column-title3'][0]; ?>" ></p>
				   </td>
			  </tr>
			  <tr width="100%">
				  <td width="100%">
					<p><label>colum desc 2</label></p>
					<p><textarea  rows="3" cols="100" name="info-column-desc3"><?php if ( isset ( $prfx_stored_meta['info-column-desc3'] ) ) echo $prfx_stored_meta['info-column-desc3'][0]; ?></textarea></p>
				   </td>
			  </tr>
			  <tr width="100%">
				  <td width="100%">
					<p><label>colum title 3</label></p>
					<p><input style="width:100%" type="text" name="info-column-title4" value="<?php if ( isset ( $prfx_stored_meta['info-column-title4'] ) ) echo $prfx_stored_meta['info-column-title4'][0]; ?>" ></p>
				   </td>
			  </tr>
			  <tr width="100%">
				  <td width="100%">
					<p><label>colum desc 3</label></p>
					<p><textarea  rows="3" cols="100" name="info-column-desc4"><?php if ( isset ( $prfx_stored_meta['info-column-desc4'] ) ) echo $prfx_stored_meta['info-column-desc4'][0]; ?></textarea></p>
				   </td>
			  </tr>
		</table>
	</div>
	
	<div>
	     <p><button type="button" onclick="showslide(this)">form consultant</button></p>
		  <table class="slide" style="display: none;">
			  <tr width="100%">
				  <td width="100%">
					<p><label>row title 1</label></p>
					<p><input style="width:100%" type="text" name="info-contsv-title1" value="<?php if ( isset ( $prfx_stored_meta['info-contsv-title1'] ) ) echo $prfx_stored_meta['info-contsv-title1'][0]; ?>" ></p>
				   </td>
			  </tr>
			   <tr width="100%">
				  <td width="100%">
					<p><label>row title 2</label></p>
					<p><input style="width:100%" type="text" name="info-contsv-title2" value="<?php if ( isset ( $prfx_stored_meta['info-contsv-title2'] ) ) echo $prfx_stored_meta['info-contsv-title2'][0]; ?>" ></p>
				   </td>
			  </tr>
			   <tr width="100%">
				  <td width="100%">
					<p><label>colum desc 3</label></p>
					<p><textarea  rows="3" cols="100" name="info-contsv-desc3"><?php if ( isset ( $prfx_stored_meta['info-contsv-desc3'] ) ) echo $prfx_stored_meta['info-contsv-desc3'][0]; ?></textarea></p>
				   </td>
			  </tr>
		</table>
	</div>
	<div>
	     <p><button type="button" onclick="showslide(this)">field consultant</button></p>
		  <table class="slide" style="display: none;">
			<tr width="100%">
			 <td width="100%">
				<p><label>row title 4</label></p>
				<p><input style="width:100%" type="text" name="info-contsv-title4" value="<?php if ( isset ( $prfx_stored_meta['info-contsv-title4'] ) ) echo $prfx_stored_meta['info-contsv-title4'][0]; ?>" ></p>
			   </td>
			 </tr>
			 <tr width="100%">
			  <td width="100%">
				<p><label>row title 5</label></p>
				<p><input style="width:100%" type="text" name="info-contsv-title5" value="<?php if ( isset ( $prfx_stored_meta['info-contsv-title5'] ) ) echo $prfx_stored_meta['info-contsv-title5'][0]; ?>" ></p>
			   </td>
			</tr>
			 <tr width="100%">
			  <td width="100%">
				<p><label>row title 6</label></p>
				<p><input style="width:100%" type="text" name="info-contsv-title6" value="<?php if ( isset ( $prfx_stored_meta['info-contsv-title6'] ) ) echo $prfx_stored_meta['info-contsv-title6'][0]; ?>" ></p>
			   </td>
			</tr>
			 <tr width="100%">
			  <td width="100%">
				<p><label>row title 7</label></p>
				<p><input style="width:100%" type="text" name="info-contsv-title7" value="<?php if ( isset ( $prfx_stored_meta['info-contsv-title7'] ) ) echo $prfx_stored_meta['info-contsv-title7'][0]; ?>" ></p>
			   </td>
			</tr>
			 <tr width="100%">
			  <td width="100%">
				<p><label>row title 8</label></p>
				<p><input style="width:100%" type="text" name="info-contsv-title8" value="<?php if ( isset ( $prfx_stored_meta['info-contsv-title8'] ) ) echo $prfx_stored_meta['info-contsv-title8'][0]; ?>" ></p>
			   </td>
			</tr>
			<tr width="100%">
			  <td width="100%">
				<p><label>row title 9</label></p>
				<p><input style="width:100%" type="text" name="info-contsv-title9" value="<?php if ( isset ( $prfx_stored_meta['info-contsv-title9'] ) ) echo $prfx_stored_meta['info-contsv-title9'][0]; ?>" ></p>
			   </td>
			</tr>
		  </table>
		</div>
	<div>  
<?php }

function update_custom_field_page_contact($post_id){
	 if( isset( $_POST['banner_page'])) {
         update_post_meta($post_id, 'banner_page', $_POST[ 'banner_page']);    
     }
	/*slide 1*/
	 if( isset( $_POST['info-cont-title1'])) {
         update_post_meta($post_id, 'info-cont-title1', $_POST[ 'info-cont-title1']);    
     }
	 if( isset( $_POST['info-cont-desc1'])) {
         update_post_meta($post_id, 'info-cont-desc1', $_POST[ 'info-cont-desc1']);    
     }
	 if( isset( $_POST['info-column-title2'])) {
         update_post_meta($post_id, 'info-column-title2', $_POST[ 'info-column-title2']);    
     }
     if( isset( $_POST['info-column-desc2'])) {
         update_post_meta($post_id, 'info-column-desc2', $_POST[ 'info-column-desc2']);    
     }
	 if( isset( $_POST['info-column-title3'])) {
         update_post_meta($post_id, 'info-column-title3', $_POST[ 'info-column-title3']);    
     }
	 if( isset( $_POST['info-column-desc3'])) {
         update_post_meta($post_id, 'info-column-desc3', $_POST[ 'info-column-desc3']);    
     }
	 if( isset( $_POST['info-column-title4'])) {
         update_post_meta($post_id, 'info-column-title4', $_POST[ 'info-column-title4']);    
     }
	 if( isset( $_POST['info-column-desc4'])) {
         update_post_meta($post_id, 'info-column-desc4', $_POST[ 'info-column-desc4']);    
     }
	 if( isset( $_POST['info-cont-title5'])) {
         update_post_meta($post_id, 'info-cont-title5', $_POST[ 'info-cont-title5']);    
     }
	 if( isset( $_POST['info-cont-desc5'])) {
         update_post_meta($post_id, 'info-cont-desc5', $_POST[ 'info-cont-desc5']);    
     }
	 if( isset( $_POST['info-contsv-title1'])) {
         update_post_meta($post_id, 'info-contsv-title1', $_POST[ 'info-contsv-title1']);    
     }
	 if( isset( $_POST['info-contsv-title2'])) {
         update_post_meta($post_id, 'info-contsv-title2', $_POST[ 'info-contsv-title2']);    
     }
	 if( isset( $_POST['info-contsv-desc3'])) {
         update_post_meta($post_id, 'info-contsv-desc3', $_POST[ 'info-contsv-desc3']);    
     }
	 if( isset( $_POST['info-contsv-title4'])) {
		update_post_meta($post_id, 'info-contsv-title4', $_POST[ 'info-contsv-title4']);    
	 }
	 if( isset( $_POST['info-contsv-title5'])) {
		 update_post_meta($post_id, 'info-contsv-title5', $_POST[ 'info-contsv-title5']);    
	 }
	 if( isset( $_POST['info-contsv-title6'])) {
		 update_post_meta($post_id, 'info-contsv-title6', $_POST[ 'info-contsv-title6']);    
	 }
	 if( isset( $_POST['info-contsv-title7'])) {
		 update_post_meta($post_id, 'info-contsv-title7', $_POST[ 'info-contsv-title7']);    
	 }
	 if( isset( $_POST['info-contsv-title8'])) {
		 update_post_meta($post_id, 'info-contsv-title8', $_POST[ 'info-contsv-title8']);    
	 }
	 if( isset( $_POST['info-contsv-title9'])) {
		 update_post_meta($post_id, 'info-contsv-title9', $_POST[ 'info-contsv-title9']);    
	 }
}
 
function prfx_field_meta_custom_field_page_home( $post_id ){ 
     wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' );
     $prfx_stored_meta = get_post_meta( $post_id ); ?>
     <div>
	     <p><button type="button" onclick="showslide(this)">show slide</button></p>
		  <table class="slide" style="display: none;">
			 <tr width="100%">
				  <td width="100%">
					<p><label class="prfx-row-title"><?php _e( 'slde 1', 'prfx-textdomain' )?></label></p>
					<p><input type="hidden" class="edit-image" name="slide_image1" value="<?php if ( isset ( $prfx_stored_meta['slide_image1'] ) ) echo $prfx_stored_meta['slide_image1'][0]; ?>" /></p>
					<p><img style="height: 100px;width: auto;" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['slide_image1'] ) ) echo $prfx_stored_meta['slide_image1'][0]; ?>"></p>
		            <button type="button" class="images-menu-button">Upload</button>
				   </td>
			  </tr>
			  <tr width="100%">
				  <td width="100%">
					<p><label>title 1</label></p>
					<p><input style="width:100%" type="text" name="slide-title1" value="<?php if ( isset ( $prfx_stored_meta['slide-title1'] ) ) echo $prfx_stored_meta['slide-title1'][0]; ?>" ></p>
				   </td>
			  </tr>
			  <tr width="100%">
				  <td width="100%">
					<p><label>mo ta 1</label></p>
					<p><textarea  rows="3" cols="100" name="slide-desc1"><?php if ( isset ( $prfx_stored_meta['slide-desc1'] ) ) echo $prfx_stored_meta['slide-desc1'][0]; ?></textarea></p>
				   </td>
			  </tr>
			  <tr width="100%">
				  <td width="100%">
					<p><label>link 1</label></p>
					<p><input style="width:100%" type="text" name="slide-link1" value="<?php if ( isset ( $prfx_stored_meta['slide-link1'] ) ) echo $prfx_stored_meta['slide-link1'][0]; ?>" /></p>
				   </td>
			  </tr>
		</table>
	</div>
	<div>
		<p><button type="button" onclick="showslide(this)">show slide</button></p>
		<table class="slide" style="display: none;">
			<tr width="100%"><td>---------------------slide 2-------------------------</td></tr>
			  <tr width="100%">
				  <td width="100%">
					<p><label class="prfx-row-title"><?php _e( 'slde 2', 'prfx-textdomain' )?></label></p>
					<p><input type="hidden" class="edit-image" name="slide_image2" value="<?php if ( isset ( $prfx_stored_meta['slide_image2'] ) ) echo $prfx_stored_meta['slide_image2'][0]; ?>" /></p>
					<p><img style="height: 100px;width: auto;" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['slide_image2'] ) ) echo $prfx_stored_meta['slide_image2'][0]; ?>"></p>
				    <button type="button" class="images-menu-button">Upload</button>
				   </td>
				</tr>
				<tr width="100%">
				  <td width="100%">
					<p><label>title 2</label></p>
					<p><input style="width:100%" type="text" name="slide-title2" value="<?php if ( isset ( $prfx_stored_meta['slide-title2'] ) ) echo $prfx_stored_meta['slide-title2'][0]; ?>" ></p>
				   </td>
			  </tr>
			  <tr width="100%">
				  <td width="100%">
					<p><label>mo ta 2</label></p>
					<p><textarea  rows="3" cols="100" name="slide-desc2"><?php if ( isset ( $prfx_stored_meta['slide-desc2'] ) ) echo $prfx_stored_meta['slide-desc2'][0]; ?></textarea></p>
				   </td>
			  </tr>
			  <tr width="100%">
				  <td width="100%">
					<p><label>link 2</label></p>
					<p><input style="width:100%" type="text" name="slide-link2" value="<?php if ( isset ( $prfx_stored_meta['slide-link2'] ) ) echo $prfx_stored_meta['slide-link2'][0]; ?>" ></p>
				   </td>
			  </tr>
		</table>
	</div>
	<div>
		<p><button type="button" onclick="showslide(this)">show slide</button></p>
		<table class="slide" style="display: none;">
				<tr width="100%"><td>---------------------slide 3-------------------------</td></tr>
				<tr width="100%">
				  <td width="100%">
					<p><label class="prfx-row-title"><?php _e( 'slde 3', 'prfx-textdomain' )?></label></p>
					<p><input type="hidden" class="edit-image" name="slide_image3" value="<?php if ( isset ( $prfx_stored_meta['slide_image3'] ) ) echo $prfx_stored_meta['slide_image3'][0]; ?>" /></p>
					<p><img style="height: 100px;width: auto;" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['slide_image3'] ) ) echo $prfx_stored_meta['slide_image3'][0]; ?>"></p>
				    <button type="button" class="images-menu-button">Upload</button>
				   </td>
				</tr>
				<tr width="100%">
				  <td width="100%">
					<p><label>title 3</label></p>
					<p><input style="width:100%" type="text" name="slide-title3" value="<?php if ( isset ( $prfx_stored_meta['slide-title3'] ) ) echo $prfx_stored_meta['slide-title3'][0]; ?>" ></p>
				   </td>
			  </tr>
			  <tr width="100%">
				  <td width="100%">
					<p><label>mo ta 3</label></p>
					<p><textarea  rows="3" cols="100" name="slide-desc3"><?php if ( isset ( $prfx_stored_meta['slide-desc3'] ) ) echo $prfx_stored_meta['slide-desc3'][0]; ?></textarea></p>
				   </td>
			  </tr>
			  <tr width="100%">
				  <td width="100%">
					<p><label>link 3</label></p>
					<p><input style="width:100%" type="text" name="slide-link3" value="<?php if ( isset ( $prfx_stored_meta['slide-link3'] ) ) echo $prfx_stored_meta['slide-link3'][0]; ?>" ></p>
				   </td>
			  </tr>
		</table>
	</div>
	<div>
		<p><button type="button" onclick="showslide(this)">why choose hibay</button></p>
		<table class="slide" style="display: none;">
				<tr width="100%"><td>---------------------why choose hibay-------------------------</td></tr>
				<tr width="100%">
				  <td width="100%">
					<p><label class="prfx-row-title"><?php _e( 'logo', 'prfx-textdomain' )?></label></p>
					<p><input type="hidden" class="edit-image" name="info_logo" value="<?php if ( isset ( $prfx_stored_meta['info_logo'] ) ) echo $prfx_stored_meta['info_logo'][0]; ?>" /></p>
					<p><img style="height: 100px;width: auto;" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['info_logo'] ) ) echo $prfx_stored_meta['info_logo'][0]; ?>"></p>
				    <button type="button" class="images-menu-button">Upload</button>
				   </td>
				</tr>
				<tr width="100%">
				  <td width="100%">
					<p><label>title why</label></p>
					<p><input style="width:100%" type="text" name="info-title" value="<?php if ( isset ( $prfx_stored_meta['info-title'] ) ) echo $prfx_stored_meta['info-title'][0]; ?>" ></p>
				   </td>
			  </tr>
			  <tr width="100%">
				  <td width="100%">
					<p><label>mo ta </label></p>
					<p><textarea  rows="3" cols="100" name="info-desc"><?php if ( isset ( $prfx_stored_meta['info-desc'] ) ) echo $prfx_stored_meta['info-desc'][0]; ?></textarea></p>
				   </td>
			  </tr>
			   <tr width="100%">
				  <td width="100%">
					<p><label>readmore</label></p>
					<p><input style="width:100%" type="text" name="info-more" value="<?php if ( isset ( $prfx_stored_meta['info-more'] ) ) echo $prfx_stored_meta['info-more'][0]; ?>" ></p>
				   </td>
			  </tr>
			  <tr width="100%">
				  <td width="100%">
					<p><label>link info</label></p>
					<p><input style="width:100%" type="text" name="info-link" value="<?php if ( isset ( $prfx_stored_meta['info-link'] ) ) echo $prfx_stored_meta['info-link'][0]; ?>" ></p>
				   </td>
			  </tr>
			 
		</table>
	</div>
	<div>
		<p><button type="button" onclick="showslide(this)">service hibay 1</button></p>
		<table class="slide" style="display: none;">
				<tr width="100%"><td>---------------------service 1-------------------------</td></tr>
				<tr width="100%">
				  <td width="100%">
					<p><label class="prfx-row-title"><?php _e( 'logo', 'prfx-textdomain' )?></label></p>
					<p><input type="hidden" class="edit-image" name="service_image1" value="<?php if ( isset ( $prfx_stored_meta['service_image1'] ) ) echo $prfx_stored_meta['service_image1'][0]; ?>" /></p>
					<p><img style="height: 100px;width: auto;" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['service_image1'] ) ) echo $prfx_stored_meta['service_image1'][0]; ?>"></p>
				    <button type="button" class="images-menu-button">Upload</button>
				   </td>
				</tr>
				<tr width="100%">
				  <td width="100%">
					<p><label>title </label></p>
					<p><input style="width:100%" type="text" name="service-title1" value="<?php if ( isset ( $prfx_stored_meta['service-title1'] ) ) echo $prfx_stored_meta['service-title1'][0]; ?>" ></p>
				   </td>
			  </tr>
			   <tr width="100%">
				  <td width="100%">
					<p><label>readmore</label></p>
					<p><input style="width:100%" type="text" name="service-more1" value="<?php if ( isset ( $prfx_stored_meta['service-more1'] ) ) echo $prfx_stored_meta['service-more1'][0]; ?>" ></p>
				   </td>
			  </tr>
			  <tr width="100%">
				  <td width="100%">
					<p><label>link info</label></p>
					<p><input style="width:100%" type="text" name="service-link1" value="<?php if ( isset ( $prfx_stored_meta['service-link1'] ) ) echo $prfx_stored_meta['service-link1'][0]; ?>" ></p>
				   </td>
			  </tr>
			 
		</table>
	</div>
	<div>
		<p><button type="button" onclick="showslide(this)">service hibay 2</button></p>
		<table class="slide" style="display: none;">
				<tr width="100%"><td>---------------------service 2-------------------------</td></tr>
				<tr width="100%">
				  <td width="100%">
					<p><label class="prfx-row-title"><?php _e( 'logo', 'prfx-textdomain' )?></label></p>
					<p><input type="hidden" class="edit-image" name="service_image2" value="<?php if ( isset ( $prfx_stored_meta['service_image2'] ) ) echo $prfx_stored_meta['service_image2'][0]; ?>" /></p>
					<p><img style="height: 200px;width: auto;" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['service_image2'] ) ) echo $prfx_stored_meta['service_image2'][0]; ?>"></p>
				    <button type="button" class="images-menu-button">Upload</button>
				   </td>
				</tr>
				<tr width="100%">
				  <td width="100%">
					<p><label>title </label></p>
					<p><input style="width:100%" type="text" name="service-title2" value="<?php if ( isset ( $prfx_stored_meta['service-title2'] ) ) echo $prfx_stored_meta['service-title2'][0]; ?>" ></p>
				   </td>
			  </tr>
			   <tr width="100%">
				  <td width="100%">
					<p><label>readmore</label></p>
					<p><input style="width:100%" type="text" name="service-more2" value="<?php if ( isset ( $prfx_stored_meta['service-more2'] ) ) echo $prfx_stored_meta['service-more2'][0]; ?>" ></p>
				   </td>
			  </tr>
			  <tr width="100%">
				  <td width="100%">
					<p><label>link info</label></p>
					<p><input style="width:100%" type="text" name="service-link2" value="<?php if ( isset ( $prfx_stored_meta['service-link2'] ) ) echo $prfx_stored_meta['service-link2'][0]; ?>" ></p>
				   </td>
			  </tr>
			 
		</table>
	</div>
	<div>
		<p><button type="button" onclick="showslide(this)">service hibay 3</button></p>
		<table class="slide" style="display: none;">
				<tr width="100%"><td>---------------------service 3-------------------------</td></tr>
				<tr width="100%">
				  <td width="100%">
					<p><label class="prfx-row-title"><?php _e( 'logo', 'prfx-textdomain' )?></label></p>
					<p><input type="hidden" class="edit-image" name="service_image3" value="<?php if ( isset ( $prfx_stored_meta['service_image3'] ) ) echo $prfx_stored_meta['service_image3'][0]; ?>" /></p>
					<p><img style="height: 300px;width: auto;" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['service_image3'] ) ) echo $prfx_stored_meta['service_image3'][0]; ?>"></p>
				    <button type="button" class="images-menu-button">Upload</button>
				   </td>
				</tr>
				<tr width="100%">
				  <td width="100%">
					<p><label>title </label></p>
					<p><input style="width:100%" type="text" name="service-title3" value="<?php if ( isset ( $prfx_stored_meta['service-title3'] ) ) echo $prfx_stored_meta['service-title3'][0]; ?>" ></p>
				   </td>
			  </tr>
			   <tr width="100%">
				  <td width="100%">
					<p><label>readmore</label></p>
					<p><input style="width:100%" type="text" name="service-more3" value="<?php if ( isset ( $prfx_stored_meta['service-more3'] ) ) echo $prfx_stored_meta['service-more3'][0]; ?>" ></p>
				   </td>
			  </tr>
			  <tr width="100%">
				  <td width="100%">
					<p><label>link info</label></p>
					<p><input style="width:100%" type="text" name="service-link3" value="<?php if ( isset ( $prfx_stored_meta['service-link3'] ) ) echo $prfx_stored_meta['service-link3'][0]; ?>" ></p>
				   </td>
			  </tr>
			 
		</table>
	</div>
	<!--a bout -->
	<div>
		<p><button type="button" onclick="showslide(this)">About hibay</button></p>
		<table class="slide" style="display: none;">
				<tr width="100%"><td>---------------------About hibay-------------------------</td></tr>
				<tr width="100%">
				  <td width="100%">
					<p><label class="prfx-row-title"><?php _e( 'image 1', 'prfx-textdomain' )?></label></p>
					<p><input type="hidden" class="edit-image" name="about_image" value="<?php if ( isset ( $prfx_stored_meta['about_image'] ) ) echo $prfx_stored_meta['about_image'][0]; ?>" /></p>
					<p><img style="height: 300px;width: auto;" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['about_image'] ) ) echo $prfx_stored_meta['about_image'][0]; ?>"></p>
				    <button type="button" class="images-menu-button">Upload</button>
				   </td>
				</tr>
				<tr width="100%">
				  <td width="100%">
					<p><label>Link youtube </label></p>
					<p><input style="width:100%" type="text" name="about-youtube" value="<?php if ( isset ( $prfx_stored_meta['about-youtube'] ) ) echo $prfx_stored_meta['about-youtube'][0]; ?>" ></p>
				   </td>
			  </tr>
			   <tr width="100%">
				  <td width="100%">
					<p><label>title 1</label></p>
					<p><input style="width:100%" type="text" name="about-title1" value="<?php if ( isset ( $prfx_stored_meta['about-title1'] ) ) echo $prfx_stored_meta['about-title1'][0]; ?>" ></p>
				   </td>
			  </tr>
			  <tr width="100%">
				  <td width="100%">
					<p><label>title 2</label></p>
					<p><input style="width:100%" type="text" name="about-title2" value="<?php if ( isset ( $prfx_stored_meta['about-title2'] ) ) echo $prfx_stored_meta['about-title2'][0]; ?>" ></p>
				   </td>
			  </tr>
			 <tr width="100%">
				  <td width="100%">
					<p><label>Description 1</label></p>
					<p><textarea  rows="3" cols="100" name="about-des1"><?php if ( isset ( $prfx_stored_meta['about-des1'] ) ) echo $prfx_stored_meta['about-des1'][0]; ?></textarea></p>
				   </td>
			  </tr>
			   <tr width="100%">
				  <td width="100%">
					<p><label>title 3</label></p>
					<p><input style="width:100%" type="text" name="about-title3" value="<?php if ( isset ( $prfx_stored_meta['about-title3'] ) ) echo $prfx_stored_meta['about-title3'][0]; ?>" ></p>
				   </td>
			  </tr>
			  <tr width="100%">
				  <td width="100%">
					<p><label>link 3</label></p>
					<p><input style="width:100%" type="text" name="about-link3" value="<?php if ( isset ( $prfx_stored_meta['about-link3'] ) ) echo $prfx_stored_meta['about-link3'][0]; ?>" ></p>
				   </td>
			  </tr>
			   <tr width="100%">
				  <td width="100%">
					<p><label>Description 3</label></p>
					<p><textarea  rows="3" cols="100" name="about-desc3"><?php if ( isset ( $prfx_stored_meta['about-desc3'] ) ) echo $prfx_stored_meta['about-desc3'][0]; ?></textarea></p>
				   </td>
			  </tr>
			  <tr width="100%">
				  <td width="100%">
					<p><label>title 4</label></p>
					<p><input style="width:100%" type="text" name="about-title4" value="<?php if ( isset ( $prfx_stored_meta['about-title4'] ) ) echo $prfx_stored_meta['about-title4'][0]; ?>" ></p>
				   </td>
			  </tr>
			   <tr width="100%">
				  <td width="100%">
					<p><label>link 4</label></p>
					<p><input style="width:100%" type="text" name="about-link4" value="<?php if ( isset ( $prfx_stored_meta['about-link4'] ) ) echo $prfx_stored_meta['about-link4'][0]; ?>" ></p>
				   </td>
			  </tr>
			   <tr width="100%">
				  <td width="100%">
					<p><label>Description 4</label></p>
					<p><textarea  rows="3" cols="100" name="about-desc4"><?php if ( isset ( $prfx_stored_meta['about-desc4'] ) ) echo $prfx_stored_meta['about-desc4'][0]; ?></textarea></p>
				   </td>
			  </tr>
		</table>
	</div>
	<!--intro service -->
	<div>
		<p><button type="button" onclick="showslide(this)">intro service hibay</button></p>
		<table class="slide" style="display: none;">
			<tr width="100%"><td>---------------------intro-service hibay-------------------------</td></tr>
			   <tr width="100%">
				  <td width="100%">
					<p><label>title 1</label></p>
					<p><input style="width:100%" type="text" name="intro-service-title1" value="<?php if ( isset ( $prfx_stored_meta['intro-service-title1'] ) ) echo $prfx_stored_meta['intro-service-title1'][0]; ?>" ></p>
				   </td>
			  </tr>
			   <tr width="100%">
				  <td width="100%">
					<p><label>title 1.2</label></p>
					<p><input style="width:100%" type="text" name="intro-service-title1-2" value="<?php if ( isset ( $prfx_stored_meta['intro-service-title1-2'] ) ) echo $prfx_stored_meta['intro-service-title1-2'][0]; ?>" ></p>
				   </td>
			  </tr>
			  <tr width="100%">
				  <td width="100%">
					<p><label>Description 1</label></p>
					<p><textarea  rows="3" cols="100" name="intro-service-des1"><?php if ( isset ( $prfx_stored_meta['intro-service-des1'] ) ) echo $prfx_stored_meta['intro-service-des1'][0]; ?></textarea></p>
				   </td>
			  </tr>
		</table>
	</div>
	<div>
		<p><button type="button" onclick="showslide(this)">intro service 2</button></p>
		<table class="slide" style="display: none;">
			  <tr width="100%">
				  <td width="100%">
					<p><label class="prfx-row-title"><?php _e( 'icon service 1', 'prfx-textdomain' )?></label></p>
					<p><input type="hidden" class="edit-image" name="info-serivice-icon2" value="<?php if ( isset ( $prfx_stored_meta['info-serivice-icon2'] ) ) echo $prfx_stored_meta['info-serivice-icon2'][0]; ?>" /></p>
					<p><img style="height: 60px;width: auto;" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['info-serivice-icon2'] ) ) echo $prfx_stored_meta['info-serivice-icon2'][0]; ?>"></p>
					<button type="button" class="images-menu-button">Upload</button>
				   </td>
				</tr>
			  <tr width="100%">
				  <td width="100%">
					<p><label>title 2</label></p>
					<p><input style="width:100%" type="text" name="intro-service-title2" value="<?php if ( isset ( $prfx_stored_meta['intro-service-title2'] ) ) echo $prfx_stored_meta['intro-service-title2'][0]; ?>" ></p>
				   </td>
			  </tr>
			  <tr width="100%">
				  <td width="100%">
					<p><label>Description 2</label></p>
					<p><textarea  rows="3" cols="100" name="intro-service-des2"><?php if ( isset ( $prfx_stored_meta['intro-service-des2'] ) ) echo $prfx_stored_meta['intro-service-des2'][0]; ?></textarea></p>
				   </td>
			  </tr>
			   <tr width="100%">
				  <td width="100%">
					<p><label>readmore 2</label></p>
					<p><input style="width:100%" type="text" name="intro-service-readmore2" value="<?php if ( isset ( $prfx_stored_meta['intro-service-readmore2'] ) ) echo $prfx_stored_meta['intro-service-readmore2'][0]; ?>" ></p>
				   </td>
			  </tr>
			  <tr width="100%">
				  <td width="100%">
					<p><label>link 2</label></p>
					<p><input style="width:100%" type="text" name="intro-service-link2" value="<?php if ( isset ( $prfx_stored_meta['intro-service-link2'] ) ) echo $prfx_stored_meta['intro-service-link2'][0]; ?>" ></p>
				   </td>
			  </tr>
		  </table>
	</div>
	<div>
		<p><button type="button" onclick="showslide(this)">intro service 3</button></p>
		<table class="slide" style="display: none;">
		  <tr width="100%">
			  <td width="100%">
				<p><label class="prfx-row-title"><?php _e( 'icon service 2', 'prfx-textdomain' )?></label></p>
				<p><input type="hidden" class="edit-image" name="info-serivice-icon3" value="<?php if ( isset ( $prfx_stored_meta['info-serivice-icon3'] ) ) echo $prfx_stored_meta['info-serivice-icon3'][0]; ?>" /></p>
				<p><img style="height: 60px;width: auto;" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['info-serivice-icon3'] ) ) echo $prfx_stored_meta['info-serivice-icon3'][0]; ?>"></p>
				<button type="button" class="images-menu-button">Upload</button>
			   </td>
			</tr>
		  <tr width="100%">
			  <td width="100%">
				<p><label>title 3</label></p>
				<p><input style="width:100%" type="text" name="intro-service-title3" value="<?php if ( isset ( $prfx_stored_meta['intro-service-title3'] ) ) echo $prfx_stored_meta['intro-service-title3'][0]; ?>" ></p>
			   </td>
		  </tr>
		   <tr width="100%">
			  <td width="100%">
				<p><label>Description 3</label></p>
				<p><textarea  rows="3" cols="100" name="intro-service-des3"><?php if ( isset ( $prfx_stored_meta['intro-service-des3'] ) ) echo $prfx_stored_meta['intro-service-des3'][0]; ?></textarea></p>
			   </td>
		  </tr>
		   <tr width="100%">
			  <td width="100%">
				<p><label>readmore 3</label></p>
				<p><input style="width:100%" type="text" name="intro-service-readmore3" value="<?php if ( isset ( $prfx_stored_meta['intro-service-readmore3'] ) ) echo $prfx_stored_meta['intro-service-readmore3'][0]; ?>" ></p>
			   </td>
		  </tr>
		  <tr width="100%">
			  <td width="100%">
				<p><label>link 3</label></p>
				<p><input style="width:100%" type="text" name="intro-service-link3" value="<?php if ( isset ( $prfx_stored_meta['intro-service-link3'] ) ) echo $prfx_stored_meta['intro-service-link3'][0]; ?>" ></p>
			   </td>
		  </tr>
		</table>
	</div>
	<div>
		<p><button type="button" onclick="showslide(this)">intro service 4</button></p>
		<table class="slide" style="display: none;">
		  <tr width="100%">
			  <td width="100%">
				<p><label class="prfx-row-title"><?php _e( 'icon service 4', 'prfx-textdomain' )?></label></p>
				<p><input type="hidden" class="edit-image" name="info-serivice-icon4" value="<?php if ( isset ( $prfx_stored_meta['info-serivice-icon4'] ) ) echo $prfx_stored_meta['info-serivice-icon4'][0]; ?>" /></p>
				<p><img style="height: 60px;width: auto;" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['info-serivice-icon4'] ) ) echo $prfx_stored_meta['info-serivice-icon4'][0]; ?>"></p>
				<button type="button" class="images-menu-button">Upload</button>
			   </td>
		  </tr>
		  <tr width="100%">
			  <td width="100%">
				<p><label>title 4</label></p>
				<p><input style="width:100%" type="text" name="intro-service-title4" value="<?php if ( isset ( $prfx_stored_meta['intro-service-title4'] ) ) echo $prfx_stored_meta['intro-service-title4'][0]; ?>" ></p>
			   </td>
		  </tr>
		   <tr width="100%">
			  <td width="100%">
				<p><label>Description 4</label></p>
				<p><textarea  rows="3" cols="100" name="intro-service-des4"><?php if ( isset ( $prfx_stored_meta['intro-service-des4'] ) ) echo $prfx_stored_meta['intro-service-des4'][0]; ?></textarea></p>
			   </td>
		  </tr>
		   <tr width="100%">
			  <td width="100%">
				<p><label>readmore 4</label></p>
				<p><input style="width:100%" type="text" name="intro-service-readmore4" value="<?php if ( isset ( $prfx_stored_meta['intro-service-readmore4'] ) ) echo $prfx_stored_meta['intro-service-readmore4'][0]; ?>" ></p>
			   </td>
		  </tr>
		   <tr width="100%">
			  <td width="100%">
				<p><label>link 4</label></p>
				<p><input style="width:100%" type="text" name="intro-service-link4" value="<?php if ( isset ( $prfx_stored_meta['intro-service-link4'] ) ) echo $prfx_stored_meta['intro-service-link4'][0]; ?>" ></p>
			   </td>
		  </tr>
		</table>
	</div>
	<div>
		<p><button type="button" onclick="showslide(this)">intro service 5</button></p>
		<table class="slide" style="display: none;">
		  <tr width="100%">
			  <td width="100%">
				<p><label class="prfx-row-title"><?php _e( 'icon service 5', 'prfx-textdomain' )?></label></p>
				<p><input type="hidden" class="edit-image" name="info-serivice-icon5" value="<?php if ( isset ( $prfx_stored_meta['info-serivice-icon5'] ) ) echo $prfx_stored_meta['info-serivice-icon5'][0]; ?>" /></p>
				<p><img style="height: 60px;width: auto;" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['info-serivice-icon5'] ) ) echo $prfx_stored_meta['info-serivice-icon5'][0]; ?>"></p>
				<button type="button" class="images-menu-button">Upload</button>
			   </td>
			</tr>
		  <tr width="100%">
			  <td width="100%">
				<p><label>title 5</label></p>
				<p><input style="width:100%" type="text" name="intro-service-title5" value="<?php if ( isset ( $prfx_stored_meta['intro-service-title5'] ) ) echo $prfx_stored_meta['intro-service-title5'][0]; ?>" ></p>
			   </td>
			</tr>
			<tr width="100%">
			  <td width="100%">
				<p><label>Description 5</label></p>
				<p><textarea  rows="3" cols="100" name="intro-service-des5"><?php if ( isset ( $prfx_stored_meta['intro-service-des5'] ) ) echo $prfx_stored_meta['intro-service-des5'][0]; ?></textarea></p>
			   </td>
			</tr>
			<tr width="100%">
			  <td width="100%">
				<p><label>readmore 5</label></p>
				<p><input style="width:100%" type="text" name="intro-service-readmore5" value="<?php if ( isset ( $prfx_stored_meta['intro-service-readmore5'] ) ) echo $prfx_stored_meta['intro-service-readmore5'][0]; ?>" ></p>
			   </td>
			</tr>
			<tr width="100%">
			  <td width="100%">
				<p><label>link 5</label></p>
				<p><input style="width:100%" type="text" name="intro-service-link5" value="<?php if ( isset ( $prfx_stored_meta['intro-service-link5'] ) ) echo $prfx_stored_meta['intro-service-link5'][0]; ?>" ></p>
			   </td>
			</tr>
		</table>
	</div>
	<div>
		<p><button type="button" onclick="showslide(this)">intro service 6</button></p>
		<table class="slide" style="display: none;">
			<tr width="100%">
			  <td width="100%">
				<p><label class="prfx-row-title"><?php _e( 'icon service 6', 'prfx-textdomain' )?></label></p>
				<p><input type="hidden" class="edit-image" name="info-serivice-icon6" value="<?php if ( isset ( $prfx_stored_meta['info-serivice-icon6'] ) ) echo $prfx_stored_meta['info-serivice-icon6'][0]; ?>" /></p>
				<p><img style="height: 60px;width: auto;" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['info-serivice-icon6'] ) ) echo $prfx_stored_meta['info-serivice-icon6'][0]; ?>"></p>
				<button type="button" class="images-menu-button">Upload</button>
			   </td>
			</tr>
		  	<tr width="100%">
			  <td width="100%">
				<p><label>title 6</label></p>
				<p><input style="width:100%" type="text" name="intro-service-title6" value="<?php if ( isset ( $prfx_stored_meta['intro-service-title6'] ) ) echo $prfx_stored_meta['intro-service-title6'][0]; ?>" ></p>
			   </td>
			</tr>
			<tr width="100%">
			  <td width="100%">
				<p><label>Description 6</label></p>
				<p><textarea  rows="3" cols="100" name="intro-service-des6"><?php if ( isset ( $prfx_stored_meta['intro-service-des6'] ) ) echo $prfx_stored_meta['intro-service-des6'][0]; ?></textarea></p>
			   </td>
			</tr>
			<tr width="100%">
			  <td width="100%">
				<p><label>readmore 6</label></p>
				<p><input style="width:100%" type="text" name="intro-service-readmore6" value="<?php if ( isset ( $prfx_stored_meta['intro-service-readmore6'] ) ) echo $prfx_stored_meta['intro-service-readmore6'][0]; ?>" ></p>
			   </td>
			</tr>
			<tr width="100%">
			  <td width="100%">
				<p><label>link 6</label></p>
				<p><input style="width:100%" type="text" name="intro-service-link6" value="<?php if ( isset ( $prfx_stored_meta['intro-service-link6'] ) ) echo $prfx_stored_meta['intro-service-link6'][0]; ?>" ></p>
			   </td>
			</tr>
		</table>
	</div>
	<div>
		<p><button type="button" onclick="showslide(this)">intro service 7</button></p>
		<table class="slide" style="display: none;">
			<tr width="100%">
			  <td width="100%">
				<p><label class="prfx-row-title"><?php _e( 'icon service 7', 'prfx-textdomain' )?></label></p>
				<p><input type="hidden" class="edit-image" name="info-serivice-icon7" value="<?php if ( isset ( $prfx_stored_meta['info-serivice-icon7'] ) ) echo $prfx_stored_meta['info-serivice-icon7'][0]; ?>" /></p>
				<p><img style="height: 60px;width: auto;" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['info-serivice-icon7'] ) ) echo $prfx_stored_meta['info-serivice-icon7'][0]; ?>"></p>
				<button type="button" class="images-menu-button">Upload</button>
			   </td>
			</tr>
			<tr width="100%">
			  <td width="100%">
				<p><label>title 7</label></p>
				<p><input style="width:100%" type="text" name="intro-service-title7" value="<?php if ( isset ( $prfx_stored_meta['intro-service-title7'] ) ) echo $prfx_stored_meta['intro-service-title7'][0]; ?>" ></p>
			   </td>
			</tr>
			<tr width="100%">
			  <td width="100%">
				<p><label>Description 7</label></p>
				<p><textarea  rows="3" cols="100" name="intro-service-des7"><?php if ( isset ( $prfx_stored_meta['intro-service-des7'] ) ) echo $prfx_stored_meta['intro-service-des7'][0]; ?></textarea></p>
			   </td>
			</tr>
			<tr width="100%">
			  <td width="100%">
				<p><label>readmore 7</label></p>
				<p><input style="width:100%" type="text" name="intro-service-readmore7" value="<?php if ( isset ( $prfx_stored_meta['intro-service-readmore7'] ) ) echo $prfx_stored_meta['intro-service-readmore7'][0]; ?>" ></p>
			   </td>
			</tr>
			<tr width="100%">
			  <td width="100%">
				<p><label>link 7</label></p>
				<p><input style="width:100%" type="text" name="intro-service-link7" value="<?php if ( isset ( $prfx_stored_meta['intro-service-link7'] ) ) echo $prfx_stored_meta['intro-service-link7'][0]; ?>" ></p>
			   </td>
			</tr>
		</table>
	</div>
	<!--end intro service-->
	<!--Contact-->
	<div>
		<p><button type="button" onclick="showslide(this)">Contact</button></p>
		<table class="slide" style="display: none;">
			<tr width="100%">
			  <td width="100%">
				<p><label>title 1</label></p>
				<p><input style="width:100%" type="text" name="contact-title" value="<?php if ( isset ( $prfx_stored_meta['contact-title'] ) ) echo $prfx_stored_meta['contact-title'][0]; ?>" ></p>
			   </td>
			</tr>
			<tr width="100%">
			  <td width="100%">
				<p><label>title 2</label></p>
				<p><input style="width:100%" type="text" name="contact-title1" value="<?php if ( isset ( $prfx_stored_meta['contact-title1'] ) ) echo $prfx_stored_meta['contact-title1'][0]; ?>" ></p>
			   </td>
			</tr>
			<tr width="100%">
			  <td width="100%">
				<p><label>Description </label></p>
				<p><textarea  rows="3" cols="100" name="contact-des"><?php if ( isset ( $prfx_stored_meta['contact-des'] ) ) echo $prfx_stored_meta['contact-des'][0]; ?></textarea></p>
			   </td>
			</tr>
			<tr width="100%">
			  <td width="100%">
				<p><label>Fullname </label></p>
				<p><input style="width:100%" type="text" name="contact-fullname" value="<?php if ( isset ( $prfx_stored_meta['contact-fullname'] ) ) echo $prfx_stored_meta['contact-fullname'][0]; ?>" ></p>
			   </td>
			</tr>
			<tr width="100%">
			  <td width="100%">
				<p><label>Email </label></p>
				<p><input style="width:100%" type="text" name="contact-email" value="<?php if ( isset ( $prfx_stored_meta['contact-email'] ) ) echo $prfx_stored_meta['contact-email'][0]; ?>" ></p>
			   </td>
			</tr>
			<tr width="100%">
			  <td width="100%">
				<p><label>Phone </label></p>
				<p><input style="width:100%" type="text" name="contact-phone" value="<?php if ( isset ( $prfx_stored_meta['contact-phone'] ) ) echo $prfx_stored_meta['contact-phone'][0]; ?>" ></p>
			   </td>
			</tr>
			<tr width="100%">
			  <td width="100%">
				<p><label>Note </label></p>
				<p><input style="width:100%" type="text" name="contact-note" value="<?php if ( isset ( $prfx_stored_meta['contact-note'] ) ) echo $prfx_stored_meta['contact-note'][0]; ?>" ></p>
			   </td>
			</tr>
			<tr width="100%">
			  <td width="100%">
				<p><label>submit </label></p>
				<p><input style="width:100%" type="text" name="contact-submit" value="<?php if ( isset ( $prfx_stored_meta['contact-submit'] ) ) echo $prfx_stored_meta['contact-submit'][0]; ?>" ></p>
			   </td>
			</tr>
			<tr width="100%">
			  <td width="100%">
				<p><label class="prfx-row-title"><?php _e( 'Contact image', 'prfx-textdomain' )?></label></p>
				<p><input type="hidden" class="edit-image" name="contact_image" value="<?php if ( isset ( $prfx_stored_meta['contact_image'] ) ) echo $prfx_stored_meta['contact_image'][0]; ?>" /></p>
				<p><img style="height: 100px;width: auto;" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['contact_image'] ) ) echo $prfx_stored_meta['contact_image'][0]; ?>"></p>
			    <button type="button" class="images-menu-button">Upload</button>
			   </td>
			</tr>
			  <tr width="100%">
				  <td width="100%">
					<p><label class="prfx-row-title"><?php _e( 'Contact image logo', 'prfx-textdomain' )?></label></p>
					<p><input type="hidden" class="edit-image" name="contact_info_logo" value="<?php if ( isset ( $prfx_stored_meta['contact_info_logo'] ) ) echo $prfx_stored_meta['contact_info_logo'][0]; ?>" /></p>
					<p><img style="height: 100px;width: auto;" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['contact_info_logo'] ) ) echo $prfx_stored_meta['contact_info_logo'][0]; ?>"></p>
				    <button type="button" class="images-menu-button">Upload</button>
				   </td>
			  </tr>
			  <tr width="100%">
				  <td width="100%">
					<p><label>support </label></p>
					<p><input style="width:100%" type="text" name="contact-support" value="<?php if ( isset ( $prfx_stored_meta['contact-support'] ) ) echo $prfx_stored_meta['contact-support'][0]; ?>" ></p>
				   </td>
			 </tr>
			 <tr width="100%">
			  <td width="100%">
				<p><label>email support </label></p>
				<p><input style="width:100%" type="text" name="contact-support-email" value="<?php if ( isset ( $prfx_stored_meta['contact-support-email'] ) ) echo $prfx_stored_meta['contact-support-email'][0]; ?>" ></p>
			   </td>
			</tr>
		</table>
	</div>
	<!--end intro service-->
	<!--testimonial-->
	<div>
		<p><button type="button" onclick="showslide(this)">Testimonial</button></p>
		<table class="slide" style="display: none;">
			<tr width="100%">
			  <td width="100%">
				<p><label>title 1</label></p>
				<p><input style="width:100%" type="text" name="testimonial-title" value="<?php if ( isset ( $prfx_stored_meta['testimonial-title'] ) ) echo $prfx_stored_meta['testimonial-title'][0]; ?>" ></p>
			   </td>
			</tr>
			<tr width="100%">
			  <td width="100%">
				<p><label>title 2</label></p>
				<p><input style="width:100%" type="text" name="testimonial-title1" value="<?php if ( isset ( $prfx_stored_meta['testimonial-title1'] ) ) echo $prfx_stored_meta['testimonial-title1'][0]; ?>" ></p>
			   </td>
			</tr>
			<tr width="100%">
			  <td width="100%">
				<p><label>Description </label></p>
				<p><textarea  rows="3" cols="100" name="testimonial-des"><?php if ( isset ( $prfx_stored_meta['testimonial-des'] ) ) echo $prfx_stored_meta['testimonial-des'][0]; ?></textarea></p>
			   </td>
			</tr>
		</table>
	</div>
	<!--testimonial 1-->
	<div>
		<p><button type="button" onclick="showslide(this)">Client 1</button></p>
		<table class="slide" style="display: none;">
			<tr width="100%">
			  <td width="100%">
				<p><label class="prfx-row-title"><?php _e( 'testimonial avatar', 'prfx-textdomain' )?></label></p>
				<p><input type="hidden" class="edit-image" name="testimonial_avatar1" value="<?php if ( isset ( $prfx_stored_meta['testimonial_avatar1'] ) ) echo $prfx_stored_meta['testimonial_avatar1'][0]; ?>" /></p>
				<p><img style="height: 100px;width: auto;" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['testimonial_avatar1'] ) ) echo $prfx_stored_meta['testimonial_avatar1'][0]; ?>"></p>
			    <button type="button" class="images-menu-button">Upload</button>
			   </td>
			</tr>
			<tr width="100%">
			  <td width="100%">
				<p><label>content 1 </label></p>
				<p><textarea  rows="3" cols="100" name="testimonial-des1"><?php if ( isset ( $prfx_stored_meta['testimonial-des1'] ) ) echo $prfx_stored_meta['testimonial-des1'][0]; ?></textarea></p>
			  </td>
			</tr>
			 <tr width="100%">
			  <td width="100%">
				<p><label>fullname </label></p>
				<p><input style="width:100%" type="text" name="testimonial-name1" value="<?php if ( isset ( $prfx_stored_meta['testimonial-name1'] ) ) echo $prfx_stored_meta['testimonial-name1'][0]; ?>" ></p>
			   </td>
			</tr>
			<tr width="100%">
			  <td width="100%">
				<p><label>position </label></p>
				<p><input style="width:100%" type="text" name="testimonial-pos1" value="<?php if ( isset ( $prfx_stored_meta['testimonial-pos1'] ) ) echo $prfx_stored_meta['testimonial-pos1'][0]; ?>" ></p>
			   </td>
			</tr>
		</table>
	</div>
	<div>
	<p><button type="button" onclick="showslide(this)">Client 2</button></p>
	<table class="slide" style="display: none;">
		<tr width="100%">
		  <td width="100%">
			<p><label class="prfx-row-title"><?php _e( 'testimonial avatar 1', 'prfx-textdomain' )?></label></p>
			<p><input type="hidden" class="edit-image" name="testimonial_avatar2" value="<?php if ( isset ( $prfx_stored_meta['testimonial_avatar2'] ) ) echo $prfx_stored_meta['testimonial_avatar2'][0]; ?>" /></p>
			<p><img style="height: 200px;width: auto;" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['testimonial_avatar2'] ) ) echo $prfx_stored_meta['testimonial_avatar2'][0]; ?>"></p>
		    <button type="button" class="images-menu-button">Upload</button>
		   </td>
		</tr>
		<tr width="100%">
		  <td width="100%">
			<p><label>content 2 </label></p>
			<p><textarea  rows="3" cols="200" name="testimonial-des2"><?php if ( isset ( $prfx_stored_meta['testimonial-des2'] ) ) echo $prfx_stored_meta['testimonial-des2'][0]; ?></textarea></p>
		  </td>
		</tr>
		 <tr width="100%">
		  <td width="100%">
			<p><label>fullname </label></p>
			<p><input style="width:100%" type="text" name="testimonial-name2" value="<?php if ( isset ( $prfx_stored_meta['testimonial-name2'] ) ) echo $prfx_stored_meta['testimonial-name2'][0]; ?>" ></p>
		   </td>
		</tr>
		<tr width="100%">
		  <td width="100%">
			<p><label>position </label></p>
			<p><input style="width:100%" type="text" name="testimonial-pos2" value="<?php if ( isset ( $prfx_stored_meta['testimonial-pos2'] ) ) echo $prfx_stored_meta['testimonial-pos2'][0]; ?>" ></p>
		   </td>
		</tr>
	</table>
</div>
<div>
	<p><button type="button" onclick="showslide(this)">Client 3</button></p>
	<table class="slide" style="display: none;">
		<tr width="100%">
		  <td width="100%">
			<p><label class="prfx-row-title"><?php _e( 'testimonial avatar 1', 'prfx-textdomain' )?></label></p>
			<p><input type="hidden" class="edit-image" name="testimonial_avatar3" value="<?php if ( isset ( $prfx_stored_meta['testimonial_avatar3'] ) ) echo $prfx_stored_meta['testimonial_avatar3'][0]; ?>" /></p>
			<p><img style="height: 300px;width: auto;" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['testimonial_avatar3'] ) ) echo $prfx_stored_meta['testimonial_avatar3'][0]; ?>"></p>
		    <button type="button" class="images-menu-button">Upload</button>
		   </td>
		</tr>
		<tr width="100%">
		  <td width="100%">
			<p><label>content 3 </label></p>
			<p><textarea  rows="3" cols="300" name="testimonial-des3"><?php if ( isset ( $prfx_stored_meta['testimonial-des3'] ) ) echo $prfx_stored_meta['testimonial-des3'][0]; ?></textarea></p>
		  </td>
		</tr>
		 <tr width="100%">
		  <td width="100%">
			<p><label>fullname </label></p>
			<p><input style="width:100%" type="text" name="testimonial-name3" value="<?php if ( isset ( $prfx_stored_meta['testimonial-name3'] ) ) echo $prfx_stored_meta['testimonial-name3'][0]; ?>" ></p>
		   </td>
		</tr>
		<tr width="100%">
		  <td width="100%">
			<p><label>position </label></p>
			<p><input style="width:100%" type="text" name="testimonial-pos3" value="<?php if ( isset ( $prfx_stored_meta['testimonial-pos3'] ) ) echo $prfx_stored_meta['testimonial-pos3'][0]; ?>" ></p>
		   </td>
		</tr>
	</table>
</div>
<div>
	<p><button type="button" onclick="showslide(this)">Client 4</button></p>
	<table class="slide" style="display: none;">
		<tr width="100%">
		  <td width="100%">
			<p><label class="prfx-row-title"><?php _e( 'testimonial avatar 1', 'prfx-textdomain' )?></label></p>
			<p><input type="hidden" class="edit-image" name="testimonial_avatar4" value="<?php if ( isset ( $prfx_stored_meta['testimonial_avatar4'] ) ) echo $prfx_stored_meta['testimonial_avatar4'][0]; ?>" /></p>
			<p><img style="height: 400px;width: auto;" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['testimonial_avatar4'] ) ) echo $prfx_stored_meta['testimonial_avatar4'][0]; ?>"></p>
		    <button type="button" class="images-menu-button">Upload</button>
		   </td>
		</tr>
		<tr width="100%">
		  <td width="100%">
			<p><label>content 4 </label></p>
			<p><textarea  rows="4" cols="400" name="testimonial-des4"><?php if ( isset ( $prfx_stored_meta['testimonial-des4'] ) ) echo $prfx_stored_meta['testimonial-des4'][0]; ?></textarea></p>
		  </td>
		</tr>
		 <tr width="100%">
		  <td width="100%">
			<p><label>fullname </label></p>
			<p><input style="width:100%" type="text" name="testimonial-name4" value="<?php if ( isset ( $prfx_stored_meta['testimonial-name4'] ) ) echo $prfx_stored_meta['testimonial-name4'][0]; ?>" ></p>
		   </td>
		</tr>
		<tr width="100%">
		  <td width="100%">
			<p><label>position </label></p>
			<p><input style="width:100%" type="text" name="testimonial-pos4" value="<?php if ( isset ( $prfx_stored_meta['testimonial-pos4'] ) ) echo $prfx_stored_meta['testimonial-pos4'][0]; ?>" ></p>
		   </td>
		</tr>
	</table>
</div>
<div>
	<p><button type="button" onclick="showslide(this)">Client 5</button></p>
	<table class="slide" style="display: none;">
		<tr width="100%">
		  <td width="100%">
			<p><label class="prfx-row-title"><?php _e( 'testimonial avatar 1', 'prfx-textdomain' )?></label></p>
			<p><input type="hidden" class="edit-image" name="testimonial_avatar5" value="<?php if ( isset ( $prfx_stored_meta['testimonial_avatar5'] ) ) echo $prfx_stored_meta['testimonial_avatar5'][0]; ?>" /></p>
			<p><img style="height: 100px;width: auto;" class="thumbnail" src="<?php if ( isset ( $prfx_stored_meta['testimonial_avatar5'] ) ) echo $prfx_stored_meta['testimonial_avatar5'][0]; ?>"></p>
		    <button type="button" class="images-menu-button">Upload</button>
		   </td>
		</tr>
		<tr width="100%">
		  <td width="100%">
			<p><label>content 5 </label></p>
			<p><textarea  rows="5" cols="500" name="testimonial-des5"><?php if ( isset ( $prfx_stored_meta['testimonial-des5'] ) ) echo $prfx_stored_meta['testimonial-des5'][0]; ?></textarea></p>
		  </td>
		</tr>
		 <tr width="100%">
		  <td width="100%">
			<p><label>fullname </label></p>
			<p><input style="width:100%" type="text" name="testimonial-name5" value="<?php if ( isset ( $prfx_stored_meta['testimonial-name5'] ) ) echo $prfx_stored_meta['testimonial-name5'][0]; ?>" ></p>
		   </td>
		</tr>
		<tr width="100%">
		  <td width="100%">
			<p><label>position </label></p>
			<p><input style="width:100%" type="text" name="testimonial-pos5" value="<?php if ( isset ( $prfx_stored_meta['testimonial-pos5'] ) ) echo $prfx_stored_meta['testimonial-pos5'][0]; ?>" ></p>
		   </td>
		</tr>
	</table>
</div>
<!--end client-->
<div>
	<p><button type="button" onclick="showslide(this)">News</button></p>
	<table class="slide" style="display: none;">
		<tr width="100%">
		  <td width="100%">
			<p><label>Title 1</label></p>
			<p><input style="width:100%" type="text" name="news-title1" value="<?php if ( isset ( $prfx_stored_meta['news-title1'] ) ) echo $prfx_stored_meta['news-title1'][0]; ?>" ></p>
		   </td>
		</tr>
		<tr width="100%">
		  <td width="100%">
			<p><label>Title 2</label></p>
			<p><input style="width:100%" type="text" name="news-title2" value="<?php if ( isset ( $prfx_stored_meta['news-title2'] ) ) echo $prfx_stored_meta['news-title2'][0]; ?>" ></p>
		   </td>
		</tr>
		<tr width="100%">
		  <td width="100%">
			<p><label>readmore</label></p>
			<p><input style="width:100%" type="text" name="news-readmore" value="<?php if ( isset ( $prfx_stored_meta['news-readmore'] ) ) echo $prfx_stored_meta['news-readmore'][0]; ?>" ></p>
		   </td>
		</tr>
	</table>
</div>
<?php
}

function update_custom_field_page_home($post_id){
	/*slide 1*/
	if( isset( $_POST['slide_image1'])) {
         update_post_meta($post_id, 'slide_image1', $_POST[ 'slide_image1']);    
     }
     if( isset($_POST['slide-title1'])) {
         update_post_meta( $post_id, 'slide-title1', $_POST[ 'slide-title1']);    
     }
	 if( isset($_POST['slide-desc1'])) {
         update_post_meta( $post_id, 'slide-desc1', $_POST[ 'slide-desc1']);    
     }
     if( isset($_POST['slide-link1'])) {
         update_post_meta( $post_id, 'slide-link1', $_POST[ 'slide-link1']);    
     }
     /*slide 2*/
    if( isset( $_POST['slide_image2'])) {
         update_post_meta($post_id, 'slide_image2', $_POST[ 'slide_image2']);    
     }
     if( isset($_POST['slide-title2'])) {
         update_post_meta( $post_id, 'slide-title2', $_POST[ 'slide-title2']);    
     }
	 if( isset($_POST['slide-desc2'])) {
         update_post_meta( $post_id, 'slide-desc2', $_POST[ 'slide-desc2']);    
     }
     if( isset($_POST['slide-link2'])) {
         update_post_meta( $post_id, 'slide-link2', $_POST[ 'slide-link2']);    
     }
     /*slide 3*/
     if( isset( $_POST['slide_image3'])) {
         update_post_meta($post_id, 'slide_image3', $_POST[ 'slide_image3']);    
     }
     if( isset($_POST['slide-title3'])) {
         update_post_meta( $post_id, 'slide-title3', $_POST[ 'slide-title3']);    
     }
	 if( isset($_POST['slide-desc3'])) {
         update_post_meta( $post_id, 'slide-desc3', $_POST[ 'slide-desc3']);    
     }
     if( isset($_POST['slide-link3'])) {
         update_post_meta( $post_id, 'slide-link3', $_POST[ 'slide-link3']);    
     }
      /*why choose*/
     if( isset( $_POST['info_logo'])) {
         update_post_meta($post_id, 'info_logo', $_POST[ 'info_logo']);    
     }
     if( isset($_POST['info-title'])) {
         update_post_meta( $post_id, 'info-title', $_POST[ 'info-title']);    
     }
	 if( isset($_POST['info-desc'])) {
         update_post_meta( $post_id, 'info-desc', $_POST[ 'info-desc']);    
     }
     if( isset($_POST['info-link'])) {
         update_post_meta( $post_id, 'info-link', $_POST[ 'info-link']);    
     }
     if( isset($_POST['info-more'])) {
         update_post_meta( $post_id, 'info-more', $_POST[ 'info-more']);    
     }
       /*service 1*/
     if( isset( $_POST['service_image1'])) {
         update_post_meta($post_id, 'service_image1', $_POST[ 'service_image1']);    
     }
     if( isset($_POST['service-title1'])) {
         update_post_meta( $post_id, 'service-title1', $_POST[ 'service-title1']);    
     }
     if( isset($_POST['service-link1'])) {
         update_post_meta( $post_id, 'service-link1', $_POST[ 'service-link1']);    
     }
     if( isset($_POST['service-more1'])) {
         update_post_meta( $post_id, 'service-more1', $_POST[ 'service-more1']);    
     }
     /*service 2*/
     if( isset( $_POST['service_image2'])) {
         update_post_meta($post_id, 'service_image2', $_POST[ 'service_image2']);    
     }
     if( isset($_POST['service-title2'])) {
         update_post_meta( $post_id, 'service-title2', $_POST[ 'service-title2']);    
     }
     if( isset($_POST['service-link2'])) {
         update_post_meta( $post_id, 'service-link2', $_POST[ 'service-link2']);    
     }
     if( isset($_POST['service-more2'])) {
         update_post_meta( $post_id, 'service-more2', $_POST[ 'service-more2']);    
     }
     /*service 3*/
     if( isset( $_POST['service_image3'])) {
         update_post_meta($post_id, 'service_image3', $_POST[ 'service_image3']);    
     }
     if( isset($_POST['service-title3'])) {
         update_post_meta( $post_id, 'service-title3', $_POST[ 'service-title3']);    
     }
     if( isset($_POST['service-link3'])) {
         update_post_meta( $post_id, 'service-link3', $_POST[ 'service-link3']);    
     }
     if( isset($_POST['service-more3'])) {
         update_post_meta( $post_id, 'service-more3', $_POST[ 'service-more3']);    
     }
	/*service 3*/
     if( isset( $_POST['about_image'])) {
         update_post_meta($post_id, 'about_image', $_POST[ 'about_image']);    
     }
     if( isset($_POST['about-youtube'])) {
         update_post_meta( $post_id, 'about-youtube', $_POST[ 'about-youtube']);    
     }
     if( isset($_POST['about-title1'])) {
         update_post_meta( $post_id, 'about-title1', $_POST[ 'about-title1']);    
     }
     if( isset($_POST['about-title2'])) {
         update_post_meta( $post_id, 'about-title2', $_POST[ 'about-title2']);    
     }
     if( isset($_POST['about-des1'])) {
         update_post_meta( $post_id, 'about-des1', $_POST[ 'about-des1']);    
     }
     if( isset($_POST['about-title3'])) {
         update_post_meta( $post_id, 'about-title3', $_POST[ 'about-title3']);    
     }
     if( isset($_POST['about-link3'])) {
         update_post_meta( $post_id, 'about-link3', $_POST[ 'about-link3']);    
     }
     if( isset($_POST['about-desc3'])) {
         update_post_meta( $post_id, 'about-desc3', $_POST[ 'about-desc3']);    
     }
     if( isset($_POST['about-title4'])) {
         update_post_meta( $post_id, 'about-title4', $_POST[ 'about-title4']);    
     }
     if( isset($_POST['about-link4'])) {
         update_post_meta( $post_id, 'about-link4', $_POST[ 'about-link4']);    
     }
     if( isset($_POST['about-desc4'])) {
         update_post_meta( $post_id, 'about-desc4', $_POST[ 'about-desc4']);    
     }
     /*intro services*/
    if( isset( $_POST['intro-service-title1'])) {
         update_post_meta($post_id, 'intro-service-title1', $_POST[ 'intro-service-title1']);    
     }
     if( isset( $_POST['intro-service-title1-2'])) {
         update_post_meta($post_id, 'intro-service-title1-2', $_POST[ 'intro-service-title1-2']);    
     }
     if( isset($_POST['intro-service-des1'])) {
         update_post_meta( $post_id, 'intro-service-des1', $_POST[ 'intro-service-des1']);    
     }
     /*intro 2*/
	  if( isset($_POST['info-serivice-icon2'])) {
         update_post_meta( $post_id, 'info-serivice-icon2', $_POST[ 'info-serivice-icon2']);    
     }
     if( isset($_POST['intro-service-title2'])) {
         update_post_meta( $post_id, 'intro-service-title2', $_POST[ 'intro-service-title2']);    
     }
     if( isset($_POST['intro-service-des2'])) {
         update_post_meta( $post_id, 'intro-service-des2', $_POST[ 'intro-service-des2']);    
     }
     if( isset($_POST['intro-service-readmore2'])) {
         update_post_meta( $post_id, 'intro-service-readmore2', $_POST[ 'intro-service-readmore2']);    
     }
     if( isset($_POST['intro-service-link2'])) {
         update_post_meta( $post_id, 'intro-service-link2', $_POST[ 'intro-service-link2']);    
     }
     /*intro 3*/
	 if( isset($_POST['info-serivice-icon3'])) {
         update_post_meta( $post_id, 'info-serivice-icon3', $_POST[ 'info-serivice-icon3']);    
     }
     if( isset($_POST['intro-service-title3'])) {
         update_post_meta( $post_id, 'intro-service-title3', $_POST[ 'intro-service-title3']);    
     }
     if( isset($_POST['intro-service-des3'])) {
         update_post_meta( $post_id, 'intro-service-des3', $_POST[ 'intro-service-des3']);    
     }
     if( isset($_POST['intro-service-readmore3'])) {
         update_post_meta( $post_id, 'intro-service-readmore3', $_POST[ 'intro-service-readmore3']);    
     }
     if( isset($_POST['intro-service-link3'])) {
         update_post_meta( $post_id, 'intro-service-link3', $_POST[ 'intro-service-link3']);    
     }
     /*intro 4*/
	 if( isset($_POST['info-serivice-icon4'])) {
         update_post_meta( $post_id, 'info-serivice-icon4', $_POST[ 'info-serivice-icon4']);    
     }
     if( isset($_POST['intro-service-title4'])) {
         update_post_meta( $post_id, 'intro-service-title4', $_POST[ 'intro-service-title4']);    
     }
     if( isset($_POST['intro-service-des4'])) {
         update_post_meta( $post_id, 'intro-service-des4', $_POST[ 'intro-service-des4']);    
     }
     if( isset($_POST['intro-service-readmore4'])) {
         update_post_meta( $post_id, 'intro-service-readmore4', $_POST[ 'intro-service-readmore4']);    
     }
     if( isset($_POST['intro-service-link4'])) {
         update_post_meta( $post_id, 'intro-service-link4', $_POST[ 'intro-service-link4']);    
     }
      /*intro 5*/
	 if( isset($_POST['info-serivice-icon5'])) {
         update_post_meta( $post_id, 'info-serivice-icon5', $_POST[ 'info-serivice-icon5']);    
     }
     if( isset($_POST['intro-service-title5'])) {
         update_post_meta( $post_id, 'intro-service-title5', $_POST[ 'intro-service-title5']);    
     }
     if( isset($_POST['intro-service-des5'])) {
         update_post_meta( $post_id, 'intro-service-des5', $_POST[ 'intro-service-des5']);    
     }
     if( isset($_POST['intro-service-readmore5'])) {
         update_post_meta( $post_id, 'intro-service-readmore5', $_POST[ 'intro-service-readmore5']);    
     }
     if( isset($_POST['intro-service-link5'])) {
         update_post_meta( $post_id, 'intro-service-link5', $_POST[ 'intro-service-link5']);    
     }
     /*intro 6*/
	 if( isset($_POST['info-serivice-icon6'])) {
         update_post_meta( $post_id, 'info-serivice-icon6', $_POST[ 'info-serivice-icon6']);    
     }
     if( isset($_POST['intro-service-title6'])) {
         update_post_meta( $post_id, 'intro-service-title6', $_POST[ 'intro-service-title6']);    
     }
     if( isset($_POST['intro-service-des6'])) {
         update_post_meta( $post_id, 'intro-service-des6', $_POST[ 'intro-service-des6']);    
     }
     if( isset($_POST['intro-service-readmore6'])) {
         update_post_meta( $post_id, 'intro-service-readmore6', $_POST[ 'intro-service-readmore6']);    
     }
     if( isset($_POST['intro-service-link6'])) {
         update_post_meta( $post_id, 'intro-service-link6', $_POST[ 'intro-service-link6']);    
     }
      /*intro 7*/
	  if( isset($_POST['info-serivice-icon7'])) {
         update_post_meta( $post_id, 'info-serivice-icon7', $_POST[ 'info-serivice-icon7']);    
     }
     if( isset($_POST['intro-service-title7'])) {
         update_post_meta( $post_id, 'intro-service-title7', $_POST[ 'intro-service-title7']);    
     }
     if( isset($_POST['intro-service-des7'])) {
         update_post_meta( $post_id, 'intro-service-des7', $_POST[ 'intro-service-des7']);    
     }
     if( isset($_POST['intro-service-readmore7'])) {
         update_post_meta( $post_id, 'intro-service-readmore7', $_POST[ 'intro-service-readmore7']);    
     }
     if( isset($_POST['intro-service-link7'])) {
         update_post_meta( $post_id, 'intro-service-link7', $_POST[ 'intro-service-link7']);    
     }
     /*end intro service*/
     /* contact */
     if( isset($_POST['contact-title'])) {
         update_post_meta( $post_id, 'contact-title', $_POST[ 'contact-title']);    
     }
      if( isset($_POST['contact-title1'])) {
         update_post_meta( $post_id, 'contact-title1', $_POST[ 'contact-title1']);    
     }
     if( isset($_POST['contact-des'])) {
         update_post_meta( $post_id, 'contact-des', $_POST[ 'contact-des']);    
     }
     if( isset($_POST['contact-fullname'])) {
         update_post_meta( $post_id, 'contact-fullname', $_POST[ 'contact-fullname']);    
     }
     if( isset($_POST['contact-email'])) {
         update_post_meta( $post_id, 'contact-email', $_POST[ 'contact-email']);    
     }
     if( isset($_POST['contact-phone'])) {
         update_post_meta( $post_id, 'contact-phone', $_POST[ 'contact-phone']);    
     }
     if( isset($_POST['contact-note'])) {
         update_post_meta( $post_id, 'contact-note', $_POST[ 'contact-note']);    
     }
     if( isset($_POST['contact-submit'])) {
         update_post_meta( $post_id, 'contact-submit', $_POST[ 'contact-submit']);    
     }
     if( isset($_POST['contact_image'])) {
         update_post_meta( $post_id, 'contact_image', $_POST[ 'contact_image']);    
     }
     if( isset($_POST['contact_info_logo'])) {
         update_post_meta( $post_id, 'contact_info_logo', $_POST[ 'contact_info_logo']);    
     }
     if( isset($_POST['contact-support'])) {
         update_post_meta( $post_id, 'contact-support', $_POST[ 'contact-support']);    
     }
     if( isset($_POST['contact-support-email'])) {
         update_post_meta( $post_id, 'contact-support-email', $_POST[ 'contact-support-email']);    
     }
     /*testimonial*/
     if( isset($_POST['testimonial-title'])) {
         update_post_meta( $post_id, 'testimonial-title', $_POST[ 'testimonial-title']);    
     }
     if( isset($_POST['testimonial-title1'])) {
         update_post_meta( $post_id, 'testimonial-title1', $_POST[ 'testimonial-title1']);    
     }
     if( isset($_POST['testimonial-des'])) {
         update_post_meta( $post_id, 'testimonial-des', $_POST[ 'testimonial-des']);    
     }
     /*client 1*/
     if( isset($_POST['testimonial_avatar1'])) {
         update_post_meta( $post_id, 'testimonial_avatar1', $_POST[ 'testimonial_avatar1']);    
     }
     if( isset($_POST['testimonial-des1'])) {
         update_post_meta( $post_id, 'testimonial-des1', $_POST[ 'testimonial-des1']);    
     }
     if( isset($_POST['testimonial-name1'])) {
         update_post_meta( $post_id, 'testimonial-name1', $_POST[ 'testimonial-name1']);    
     }
      if( isset($_POST['testimonial-pos1'])) {
         update_post_meta( $post_id, 'testimonial-pos1', $_POST[ 'testimonial-pos1']);    
     }
     /*client 2*/
	if( isset($_POST['testimonial_avatar2'])) {
         update_post_meta( $post_id, 'testimonial_avatar2', $_POST[ 'testimonial_avatar2']);    
     }
     if( isset($_POST['testimonial-des2'])) {
         update_post_meta( $post_id, 'testimonial-des2', $_POST[ 'testimonial-des2']);    
     }
     if( isset($_POST['testimonial-name2'])) {
         update_post_meta( $post_id, 'testimonial-name2', $_POST[ 'testimonial-name2']);    
     }
      if( isset($_POST['testimonial-pos2'])) {
         update_post_meta( $post_id, 'testimonial-pos2', $_POST[ 'testimonial-pos2']);    
     }
     /*client 3*/
	if( isset($_POST['testimonial_avatar3'])) {
         update_post_meta( $post_id, 'testimonial_avatar3', $_POST[ 'testimonial_avatar3']);    
     }
     if( isset($_POST['testimonial-des3'])) {
         update_post_meta( $post_id, 'testimonial-des3', $_POST[ 'testimonial-des3']);    
     }
     if( isset($_POST['testimonial-name3'])) {
         update_post_meta( $post_id, 'testimonial-name3', $_POST[ 'testimonial-name3']);    
     }
      if( isset($_POST['testimonial-pos3'])) {
         update_post_meta( $post_id, 'testimonial-pos3', $_POST[ 'testimonial-pos3']);    
     }
     /*client 4*/
	if( isset($_POST['testimonial_avatar4'])) {
         update_post_meta( $post_id, 'testimonial_avatar4', $_POST[ 'testimonial_avatar4']);    
     }
     if( isset($_POST['testimonial-des4'])) {
         update_post_meta( $post_id, 'testimonial-des4', $_POST[ 'testimonial-des4']);    
     }
     if( isset($_POST['testimonial-name4'])) {
         update_post_meta( $post_id, 'testimonial-name4', $_POST[ 'testimonial-name4']);    
     }
      if( isset($_POST['testimonial-pos4'])) {
         update_post_meta( $post_id, 'testimonial-pos4', $_POST[ 'testimonial-pos4']);    
     }
      /*client 5*/
     if( isset($_POST['testimonial_avatar5'])) {
         update_post_meta( $post_id, 'testimonial_avatar5', $_POST[ 'testimonial_avatar5']);    
     }
     if( isset($_POST['testimonial-des5'])) {
         update_post_meta( $post_id, 'testimonial-des5', $_POST[ 'testimonial-des5']);    
     }
     if( isset($_POST['testimonial-name5'])) {
         update_post_meta( $post_id, 'testimonial-name5', $_POST[ 'testimonial-name5']);    
     }
      if( isset($_POST['testimonial-pos5'])) {
         update_post_meta( $post_id, 'testimonial-pos5', $_POST[ 'testimonial-pos5']);    
     }
      if( isset($_POST['news-title1'])) {
         update_post_meta( $post_id, 'news-title1', $_POST['news-title1']);    
     }
      if( isset($_POST['news-title2'])) {
         update_post_meta( $post_id, 'news-title2', $_POST['news-title2']);    
     }
     if( isset($_POST['news-readmore'])) {
         update_post_meta( $post_id, 'news-readmore', $_POST['news-readmore']);    
     }
    
}	