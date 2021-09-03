<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package hibay
 */

get_header();
//$categories = get_the_category();
?>
<?php  $_banner_detail = get_field('banner_detail','customizer');
		$banner_detail = $_banner_detail['url'];
		$_banner_service = get_field('banner_service','customizer');
		$banner_service = $_banner_service['url'];
		$_banner_news = get_field('banner_news','customizer');
		$banner_news = $_banner_news['url'];
		$slug_banner = get_top_breadcrumbs('');
		if($slug_banner == 'dich-vu'){
			if(isset($banner_service)){
				$banner_detail = $banner_service;
			}
		}elseif($slug_banner == 'tin-tuc-va-su-kien'){
			if(isset($banner_news)){
				$banner_detail = $banner_news;
			}
		}
 ?>
  <!--Page Title-->
    <section class="page-title style-three centred" style="background-image: url(<?php echo $banner_detail; ?>);">
        <div class="auto-container">
            <div class="content-box clearfix">
                <h1><?php the_title(); ?></h1>
				<?php
				if ( function_exists('yoast_breadcrumb') ) {
					yoast_breadcrumb( '<p id="breadcrumbs" class="bread-crumb clearfix">','</p>' );
				}
				?>
            </div>
        </div>
    </section>
    <!--End Page Title-->
    <!-- sidebar-page-container -->
    <section class="sidebar-page-container">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-9 col-md-12 col-sm-12 content-side">
                    <div class="blog-details-content">
					<?php
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content', get_post_type() );

						/*the_post_navigation(
							array(
								'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'hibay' ) . '</span> <span class="nav-title">%title</span>',
								'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'hibay' ) . '</span> <span class="nav-title">%title</span>',
							)
						);*/

						// If comments are open or we have at least one comment, load up the comment template.
						//if ( comments_open() || get_comments_number() ) :
							//comments_template();
						//endif;

					endwhile; // End of the loop.
					?>
					</div>
				</div>
                <div class="col-lg-3 col-md-12 col-sm-12 sidebar-side">
                    <div class="sidebar">
                    	<?php 
							if($slug_banner == 'dich-vu'){
								get_template_part('layout/detail-service'); 
							}else{
								get_template_part('layout/detail-sidebar'); 
							}
						?>  
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- sidebar-page-container end -->
<?php
get_footer();
