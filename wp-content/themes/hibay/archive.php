<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hibay
 */

get_header();
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
            <?php the_archive_title( '<h1>', '</h1>' );
			//the_archive_description( '<div class="archive-description">', '</div>' );?>
			<?php
				if ( function_exists('yoast_breadcrumb') ) {
					yoast_breadcrumb( '<p id="breadcrumbs" class="bread-crumb clearfix">','</p>' );
				}
				?>
        </div>
    </div>
</section>
<!-- news-section -->
      <!-- sidebar-page-container -->
    <section class="sidebar-page-container">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-9 col-md-12 col-sm-12 content-side">
                    <div class="blog-classic-content">
					<?php if ( have_posts() ) : ?>

						<?php
						$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1; 
						/* Start the Loop */
						while ( have_posts() ) :
							the_post();

							/*
							 * Include the Post-Type-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content', get_post_type() );

						endwhile;

						//the_posts_navigation(); 
						if ( $wp_query->max_num_pages > 1 ) : // if there's more than one page turn on pagination ?>
							<div class="pagination-wrapper centred">
								<?php custom_pagination($wp_query->max_num_pages,"",$paged); ?>
			                    <!--<ul class="pagination clearfix">
			                        <li><a href="blog-classic.html" class="active">1</a></li>
			                        <li><a href="blog-classic.html">2</a></li>
			                        <li><a href="blog-classic.html">3</a></li>
			                        <li><a href="blog-classic.html"><i class="fas fa-arrow-right"></i></a></li>
			                    </ul>-->
			                </div>   
                   		<?php endif;
						?>
						<?php else :

							get_template_part( 'template-parts/content', 'none' );

						endif;
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

<?php

get_footer();
