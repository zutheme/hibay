<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package hibay
 */

get_header();
?>
  <!--Page Title-->
    <section class="page-title centred" style="background-image: url(assets/images/background/page-title.jpg);">
        <div class="auto-container">
            <div class="content-box clearfix">
                <h1><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'hibay' ); ?></h1>
                <!--<ul class="bread-crumb clearfix">
                    <li><a href="index-1.html">Home</a></li>
                    <li>404</li>
                </ul>-->
            </div>
        </div>
    </section>
    <!--End Page Title-->


    <!-- error-section -->
    <section class="error-section centred">
        <div class="container">
            <div class="content-box">
                <h1>404</h1>
                <h2><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'hibay' ); ?></h2>
                <div class="text">><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'hibay' ); ?></div>
            </div>
        </div>
    </section>
    <!-- error-section end -->
	<?php
	get_search_form();
	?>
<?php
get_footer();
