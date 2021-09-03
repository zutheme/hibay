<?php
/*htz Theme Customizer.*
 * @package htz */

/*Create options page*/
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Tùy chỉnh',
		'menu_title'	=> 'Tùy chỉnh',
		'menu_slug' 	=> 'customizer',
		'capability'	=> 'edit_posts',
		'icon_url' 		=> 'dashicons-hammer',
		'id'			=> 'customizer',
		'post_id' 		=> 'customizer',
	));
}

/*Add FTP field group*/
if( function_exists('acf_add_local_field_group') ) {
	
	acf_add_local_field_group(	array(
		'key'		=> 'customizer_setup',
		'title' 	=> __( 'Cài đặt', 'htz' ),
		'fields' 	=> array (
			/*Logo*/
            array (
				'key'   		=> 'tab_hotro',
				'label' 		=> __( 'Logo  ', 'htz' ),
				'name'  		=> 'tab_hotro',
				'type'  		=> 'tab',
				'placement' 	=> 'left',
			),
			
			 array (
				'key'   		=> 'logo',
				'label' 		=> __( 'Logo (275px - 77px)', 'htz' ),
				'name'  		=> 'logo',
				'type'  		=> 'image',
			),
			array (
				'key'   		=> 'logo_mobile',
				'label' 		=> __( 'Logo mobile', 'htz' ),
				'name'  		=> 'logo_mobile',
				'type'  		=> 'image',
			),
			 array (
				'key'   		=> 'favicon',
				'label' 		=> __( 'Favicon', 'htz' ),
				'name'  		=> 'favicon',
				'type'  		=> 'image',
			),
			 
			 array (
				'key'   		=> 'keywords',
				'label' 		=> __( 'Keywords', 'htz' ),
				'name'  		=> 'keywords',
				'type'  		=> 'textarea',
			),
		
		    array (
				'key'   		=> 'description',
				'label' 		=> __( 'Description', 'htz' ),
				'name'  		=> 'description',
				'type'  		=> 'textarea',
			),
	
		

		 
		 array (
				'key'   		=> 'header_phone1',
				'label' 		=> __( 'Số điện thoại 1', 'htz' ),
				'name'  		=> 'header_phone1',
				'type'  		=> 'text',
			),
		 array (
				'key'   		=> 'header_phone2',
				'label' 		=> __( 'Số điện thoại 2', 'htz' ),
				'name'  		=> 'header_phone2',
				'type'  		=> 'text',
			),
		  array (
				'key'   		=> 'header_address',
				'label' 		=> __( 'Dia chi', 'htz' ),
				'name'  		=> 'header_address',
				'type'  		=> 'text',
			),
		  array (
				'key'   		=> 'header_email',
				'label' 		=> __( 'Email', 'htz' ),
				'name'  		=> 'header_email',
				'type'  		=> 'text',
			),
		  array (
				'key'   		=> 'zalo',
				'label' 		=> __( 'Zalo', 'htz' ),
				'name'  		=> 'zalo',
				'type'  		=> 'text',
			),
			
		  
		    array (
				'key'   		=> 'idfacebook',
				'label' 		=> __( 'facebook', 'htz' ),
				'name'  		=> 'idfacebook',
				'type'  		=> 'text',
			),	
			 array (
				'key'   		=> 'idyoutube',
				'label' 		=> __( 'Youtube', 'htz' ),
				'name'  		=> 'idyoutube',
				'type'  		=> 'text',
			),
			  array (
				'key'   		=> 'twiter',
				'label' 		=> __( 'twiter', 'htz' ),
				'name'  		=> 'twiter',
				'type'  		=> 'text',
			),
			  array (
				'key'   		=> 'intagram',
				'label' 		=> __( 'intagram', 'htz' ),
				'name'  		=> 'intagram',
				'type'  		=> 'text',
			),
			  array (
				'key'   		=> 'linkedin',
				'label' 		=> __( 'linkedin', 'htz' ),
				'name'  		=> 'linkedin',
				'type'  		=> 'text',
			),
			/*slider_vie*/
			  array (
					'key'   		=> 'tab_slider_vie',
					'label' 		=> __( 'slider_vie', 'htz' ),
					'name'  		=> 'tab_slider_vie',
					'type'  		=> 'tab',
					'placemviet' 	=> 'left',
				),


				array (
				'key'   		=> 'slider_vie',
				'label' 		=> __( 'Hình slider_vie (1400x600)', 'htz' ),
				'name'  		=> 'slider_vie',
				'type'  		=> 'repeater',
				//'layout'	   => 'block',
				'layout'	   => 'table',
				'button_label' => __( 'Thêm', 'htz' ),
				'sub_fields' => array (
					array (
						'key'   		=> 'image_slider_vie',
						'label' 		=> __( 'slider_vie desktop', 'htz' ),
						'name'  		=> 'image_slider_vie',
						'type'  		=> 'image',
					),
					 
					/*array (
						'key'   		=> 'image_slider_vie_mobile',
						'label' 		=> __( 'slider_vie mobile', 'htz' ),
						'name'  		=> 'image_slider_vie_mobile',
						'type'  		=> 'image',
					), */
					 
					array (
						'key'   		=> 'link_slider_vie',
						'label' 		=> __( 'Link', 'htz' ),
						'name'  		=> 'link_slider_vie',
						'type'  		=> 'text',
					 
					),
				),
			),

			/*slider_vie*/
			/*slider_en*/
			  array (
					'key'   		=> 'tab_slider_en',
					'label' 		=> __( 'slider_en', 'htz' ),
					'name'  		=> 'tab_slider_en',
					'type'  		=> 'tab',
					'placement' 	=> 'left',
				),


				array (
				'key'   		=> 'slider_en',
				'label' 		=> __( 'Hình slider_en (1400x600)', 'htz' ),
				'name'  		=> 'slider_en',
				'type'  		=> 'repeater',
				//'layout'	   => 'block',
				'layout'	   => 'table',
				'button_label' => __( 'Thêm', 'htz' ),
				'sub_fields' => array (
					array (
						'key'   		=> 'image_slider_en',
						'label' 		=> __( 'slider_en desktop', 'htz' ),
						'name'  		=> 'image_slider_en',
						'type'  		=> 'image',
					),
					 
					/*array (
						'key'   		=> 'image_slider_en_mobile',
						'label' 		=> __( 'slider_en mobile', 'htz' ),
						'name'  		=> 'image_slider_en_mobile',
						'type'  		=> 'image',
					), */
					 
					array (
						'key'   		=> 'link_slider_en',
						'label' 		=> __( 'Link', 'htz' ),
						'name'  		=> 'link_slider_en',
						'type'  		=> 'text',
					 
					),
				),
			),

			/*slider_en*/
     		/*gallery*/
			  array (
					'key'   		=> 'tab_gallery',
					'label' 		=> __( 'gallery', 'htz' ),
					'name'  		=> 'tab_gallery',
					'type'  		=> 'tab',
					'placement' 	=> 'left',
				),
		 
			
				array (
				'key'   		=> 'gallery',
				'label' 		=> __( 'Hình gallery (600x600)', 'htz' ),
				'name'  		=> 'gallery',
				'type'  		=> 'repeater',
				'layout'	   => 'block',
				//'layout'	   => 'table',
				'button_label' => __( 'Thêm', 'htz' ),
				'sub_fields' => array (
					array (
						'key'   		=> 'image_gallery',
						'label' 		=> __( 'gallery desktop', 'htz' ),
						'name'  		=> 'image_gallery',
						'type'  		=> 'image',
						),
					),
				),

		
				array (
					'key'   		=> 'banner',
					'label' 		=> __( 'Banner', 'htz' ),
					'name'  		=> 'banner',
					'type'  		=> 'tab',
					'placement' 	=> 'left',
				),
				array (
					'key'   		=> 'banner_detail',
					'label' 		=> __( 'Banner detail 1920 x 282', 'htz' ),
					'name'  		=> 'banner_detail',
					'type'  		=> 'image',
				),
				
				array (
					'key'   		=> 'banner_service',
					'label' 		=> __( 'Banner service 1920 x 282', 'htz' ),
					'name'  		=> 'banner_service',
					'type'  		=> 'image',
				),
				array (
					'key'   		=> 'banner_news',
					'label' 		=> __( 'Banner news 1920 x 282', 'htz' ),
					'name'  		=> 'banner_news',
					'type'  		=> 'image',
				),
				/*----------------------------------------------*/
			  	array (
					'key'   		=> 'main_footer',
					'label' 		=> __( 'footer', 'htz' ),
					'name'  		=> 'main_footer',
					'type'  		=> 'tab',
					'placement' 	=> 'left',
				),
				
				array (
					'key'   		=> 'main_footer_bottom',
					'label' 		=> __( 'copy right', 'htz' ),
					'name'  		=> 'main_footer_bottom',
					'type'  		=> 'textarea',
				),
				/*social*/
				  array (
						'key'   		=> 'tab_social',
						'label' 		=> __( 'social', 'htz' ),
						'name'  		=> 'tab_social',
						'type'  		=> 'tab',
						'placement' 	=> 'left',
					),
			 
					array (
					'key'   		=> 'social',
					'label' 		=> __( 'Hình social (40x40)', 'htz' ),
					'name'  		=> 'social',
					'type'  		=> 'repeater',
					//'layout'	   => 'block',
					'layout'	   => 'table',
					'button_label' => __( 'Thêm', 'htz' ),
					'sub_fields' => array (
						array (
							'key'   		=> 'image_social',
							'label' 		=> __( 'social icon', 'htz' ),
							'name'  		=> 'image_social',
							'type'  		=> 'image',
						),
						array (
							'key'   		=> 'link_social',
							'label' 		=> __( 'Link', 'htz' ),
							'name'  		=> 'link_social',
							'type'  		=> 'text',
						 
						),
					),
				),
	
				/*social*/
				
				/*review*/
				  array (
						'key'   		=> 'tab_review_vie',
						'label' 		=> __( 'review vie', 'htz' ),
						'name'  		=> 'tab_review_vie',
						'type'  		=> 'tab',
						'placement' 	=> 'left',
					),
			 
					array (
					'key'   		=> 'review_vie',
					'label' 		=> __( 'review vie', 'htz' ),
					'name'  		=> 'review_vie',
					'type'  		=> 'repeater',
					//'layout'	   => 'block',
					'layout'	   => 'table',
					'button_label' => __( 'Thêm', 'htz' ),
					'sub_fields' => array (
						array (
							'key'   		=> 'review_avatar_vie',
							'label' 		=> __( 'avatar (100x100)', 'htz' ),
							'name'  		=> 'review_avatar_vie',
							'type'  		=> 'image',
						),
						array (
							'key'   		=> 'review_desc_vie',
							'label' 		=> __( 'description', 'htz' ),
							'name'  		=> 'review_desc_vie',
							'type'  		=> 'textarea',
						 
						),
						array (
							'key'   		=> 'review_name_vie',
							'label' 		=> __( 'name', 'htz' ),
							'name'  		=> 'review_name_vie',
							'type'  		=> 'text',
						 
						),
						array (
							'key'   		=> 'review_pos_vie',
							'label' 		=> __( 'position', 'htz' ),
							'name'  		=> 'review_pos_vie',
							'type'  		=> 'text',
						 
						),
					),
				),
				/*review en*/
				  array (
						'key'   		=> 'tab_review_en',
						'label' 		=> __( 'review en', 'htz' ),
						'name'  		=> 'tab_review_en',
						'type'  		=> 'tab',
						'placement' 	=> 'left',
					),
			 
					array (
					'key'   		=> 'review_en',
					'label' 		=> __( 'review ', 'htz' ),
					'name'  		=> 'review_en',
					'type'  		=> 'repeater',
					//'layout'	   => 'block',
					'layout'	   => 'table',
					'button_label' => __( 'Thêm', 'htz' ),
					'sub_fields' => array (
						array (
							'key'   		=> 'review_avatar_en',
							'label' 		=> __( 'avatar', 'htz' ),
							'name'  		=> 'review_avatar_en',
							'type'  		=> 'image',
						),
						array (
							'key'   		=> 'review_desc_en',
							'label' 		=> __( 'description', 'htz' ),
							'name'  		=> 'review_desc_en',
							'type'  		=> 'textarea',
						 
						),
						array (
							'key'   		=> 'review_name_en',
							'label' 		=> __( 'name', 'htz' ),
							'name'  		=> 'review_name_en',
							'type'  		=> 'text',
						 
						),
						array (
							'key'   		=> 'review_pos_en',
							'label' 		=> __( 'position', 'htz' ),
							'name'  		=> 'review_pos_en',
							'type'  		=> 'text',
						 
						),
					),
				),

				/*review*/
			/*doc*/
			  array (
					'key'   		=> 'tab_doc_vie',
					'label' 		=> __( 'doc vie', 'htz' ),
					'name'  		=> 'tab_doc_vie',
					'type'  		=> 'tab',
					'placement' 	=> 'left',
				),
		 
				array (
				'key'   		=> 'doc_vie',
				'label' 		=> __( 'doc vie', 'htz' ),
				'name'  		=> 'doc_vie',
				'type'  		=> 'repeater',
				//'layout'	   => 'block',
				'layout'	   => 'table',
				'button_label' => __( 'Thêm', 'htz' ),
				'sub_fields' => array (
					array (
						'key'   		=> 'doc_image_vie',
						'label' 		=> __( 'image (40 x 40)', 'htz' ),
						'name'  		=> 'doc_image_vie',
						'type'  		=> 'image',
					),
					array (
						'key'   		=> 'doc_name_vie',
						'label' 		=> __( 'name', 'htz' ),
						'name'  		=> 'doc_name_vie',
						'type'  		=> 'text',
					 
					),
					array (
						'key'   		=> 'doc_url_vie',
						'label' 		=> __( 'url file', 'htz' ),
						'name'  		=> 'doc_url_vie',
						'type'  		=> 'text',
					 
					),
				),
			),
			/*end doc*/
			/*doc en*/
			  array (
					'key'   		=> 'tab_doc_en',
					'label' 		=> __( 'doc en', 'htz' ),
					'name'  		=> 'tab_doc_en',
					'type'  		=> 'tab',
					'placement' 	=> 'left',
				),
		 
				array (
				'key'   		=> 'doc_en',
				'label' 		=> __( 'doc vie', 'htz' ),
				'name'  		=> 'doc_en',
				'type'  		=> 'repeater',
				//'layout'	   => 'block',
				'layout'	   => 'table',
				'button_label' => __( 'Thêm', 'htz' ),
				'sub_fields' => array (
					array (
						'key'   		=> 'doc_image_en',
						'label' 		=> __( 'image', 'htz' ),
						'name'  		=> 'doc_image_en',
						'type'  		=> 'image',
					),
					array (
						'key'   		=> 'doc_name_en',
						'label' 		=> __( 'name', 'htz' ),
						'name'  		=> 'doc_name_en',
						'type'  		=> 'text',
					 
					),
					array (
						'key'   		=> 'doc_url_en',
						'label' 		=> __( 'url file', 'htz' ),
						'name'  		=> 'doc_url_en',
						'type'  		=> 'text',
					 
					),
				),
			),
			/*end doc*/
		/*===============================================*/
		),
		'location' => array (
			array (
				array (
					'param'    => 'options_page',
					'operator' => '==',
					'value'    => 'customizer',
				),
			),
		),
	));
}