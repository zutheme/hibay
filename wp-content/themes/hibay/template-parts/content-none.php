<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hibay
 */

?>


		<h1><?php pll_e('nothingfound'); ?></h1>
	
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			// printf(
			// 	'<p>' . wp_kses(
			// 		/* translators: 1: link to WP admin new post page. */
			// 		__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'hibay' ),
			// 		array(
			// 			'a' => array(
			// 				'href' => array(),
			// 			),
			// 		)
			// 	) . '</p>',
			// 	esc_url( admin_url( 'post-new.php' ) )
			// );

		elseif ( is_search() ) :
			?>

			<p><?php pll_e('nothingmatched'); ?></p>
			<?php
			//get_search_form();
			get_template_part('layout/search-form');
		else :
			?>
			<p><?php pll_e('searchingcanhelp'); ?></p>
			<?php
			//get_search_form();
			get_template_part('layout/search-form');
		endif;
		?>
	
