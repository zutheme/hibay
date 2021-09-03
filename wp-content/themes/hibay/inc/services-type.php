<?php
// Our custom post type function
function create_service_post_type() {

	register_post_type( 'services',
	// CPT Options
		array(
			'labels' => array(
				'name' => __( 'services' ),
				'singular_name' => __( 'service' )
			),
			'public' => true,
			'menu_icon' => 'dashicons-megaphone',
			'has_archive' => true,
			'rewrite' => array('slug' => 'services'),
		)
	);
}
// Hooking up our function to theme setup
add_action( 'init', 'create_service_post_type' );

/*
* Creating a function to create our CPT
*/

function custom_service_post_type() {

// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'services', 'Post Type General Name', 'hatazu' ),
		'singular_name'       => _x( 'service', 'Post Type Singular Name', 'hatazu' ),
		'menu_name'           => __( 'services', 'hatazu' ),
		'parent_item_colon'   => __( 'Parent service', 'hatazu' ),
		'all_items'           => __( 'All services', 'hatazu' ),
		'view_item'           => __( 'View service', 'hatazu' ),
		'add_new_item'        => __( 'Add New service', 'hatazu' ),
		'add_new'             => __( 'Add New', 'hatazu' ),
		'edit_item'           => __( 'Edit service', 'hatazu' ),
		'update_item'         => __( 'Update service', 'hatazu' ),
		'search_items'        => __( 'Search service', 'hatazu' ),
		'not_found'           => __( 'Not Found', 'hatazu' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'hatazu' ),
	);
	
// Set other options for Custom Post Type
	
	$args = array(
		'label'               => __( 'services', 'hatazu' ),
		'description'         => __( 'service news and reviews', 'hatazu' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
		// You can associate this CPT with a taxonomy or custom taxonomy. 

		'taxonomies' => array( 'post_tag'), 
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/	
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	
	// Registering your Custom Post Type
	register_post_type( 'services', $args );

}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/

add_action( 'init', 'custom_service_post_type', 0 );


/* Create blog Type Taxonomy */
if (!function_exists('create_service_group_taxonomy')) {
    function create_service_group_taxonomy()
    {
        $group_labels = array(
            'name' => __( 'group_service', 'hatazu' ),
            'singular_name' => __( 'group_service', 'hatazu' ),
            'search_items' =>  __( 'Search groups', 'hatazu' ),
            'popular_items' => __( 'Popular groups', 'hatazu' ),
            'all_items' => __( 'All groups', 'hatazu' ),
            'parent_item' => __( 'Parent group', 'hatazu' ),
            'parent_item_colon' => __( 'Parent group:', 'hatazu' ),
            'edit_item' => __( 'Edit group', 'hatazu' ),
            'update_item' => __( 'Update group', 'hatazu' ),
            'add_new_item' => __( 'Add New group', 'hatazu' ),
            'new_item_name' => __( 'New group Name', 'hatazu' ),
            'separate_items_with_commas' => __( 'Separate groups with commas', 'hatazu' ),
            'add_or_remove_items' => __( 'Add or remove groups', 'hatazu' ),
            'choose_from_most_used' => __( 'Choose from the most used groups', 'hatazu' ),
            'menu_name' => __( 'groups_service', 'hatazu' )
        );

        register_taxonomy(
            'group_service',
            array( 'services' ),
            array(
                'hierarchical' => true,
                'labels' => $group_labels,
                'show_ui' => true,
                'query_var' => true,
                'rewrite' => array('slug' => __('group_service', 'hatazu'))
            )
        );
    }
}

add_action('init', 'create_service_group_taxonomy', 0);

/*

 * Adds a meta box to the post editing screen

 */

function prfx_field_custom_service_meta() {

    add_meta_box( 'prfx_meta', __( 'Field Box Title', 'prfx-textdomain' ), 'prfx_field_meta_service_callback', 'services','normal', 'high');

}

add_action( 'add_meta_boxes', 'prfx_field_custom_service_meta');
/*
 * Outputs the content of the meta box
 */
function prfx_field_meta_service_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' );
    $prfx_stored_meta = get_post_meta( $post->ID ); ?>
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
    <?php
    //$content = '';
    //$editor_id = 'service-app-desc18';
    //$settings  = array( 'media_buttons' => false );
 //    $settings = array(
 //    	'media_buttons' => false,
 //    	//'wpautop' => false,
 //    	'textarea_rows' => '3',
 //    	'tinymce' => true,
 //    	'quicktags' => false,
 //    	'drag_drop_upload' => false,
	// );
	//wp_editor( $content, $editor_id, $settings );
}

/*

 * Saves the custom meta input

 */

function prfx_field_service_save( $post_id ) {

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

    if ( "services" != $post_type ) return;   

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
}

add_action( 'save_post', 'prfx_field_service_save' );

// add_action("admin_enqueue_scripts", "services_admin_script");
// function services_admin_script() {
// 	    global $post_type;
//     	if( 'services' != $post_type ) return;
// 	        wp_enqueue_media();
// 	        // Registers and enqueues the required javascript.
// 	        wp_register_script( 'services_admin_script', get_stylesheet_directory_uri() . '/js/media_upload.js', array(), '0.0.1', true );
// 	        wp_localize_script( 'services_admin_script', 'meta_image',
// 	            array(
// 	                'title' => __( 'Choose or Upload an Image', 'prfx-textdomain' ),
// 	                'button' => __( 'Use this image', 'prfx-textdomain' ),
// 	            )
// 	        );
// 	        wp_enqueue_script( 'services_admin_script' );
// }