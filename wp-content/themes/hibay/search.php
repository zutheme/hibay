<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package hibay
 */

get_header();
?>
<section class="page-title style-three centred" style="background-image: url(assets/images/background/page-title-5.jpg);">
    <div class="auto-container">
        <div class="content-box clearfix">
            <?php the_archive_title( '<h1>', '</h1>' );
			//the_archive_description( '<div class="archive-description">', '</div>' );?>
            <!--<ul class="bread-crumb clearfix">
                <li><a href="index-1.html">Home</a></li>
                <li>Blog Details</li>
            </ul>-->
        </div>
    </div>
</section>
<!-- news-section -->
      <!-- sidebar-page-container -->
<section class="sidebar-page-container">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-9 col-md-12 col-sm-12 content-side">
                <div class="blog-classic-content search">
					<?php if ( have_posts() ) : ?>
						<?php
						/* translators: %s: search query. */
						//printf( esc_html__( 'Search Results for: %s', 'hibay' ), '<span>' . get_search_query() . '</span>' );
						?>
						<?php
						/* Start the Loop */
						while ( have_posts() ) :
							the_post();
							/**
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							 */
							get_template_part( 'template-parts/content', 'search' );
						endwhile;
						//the_posts_navigation();
					else :
						get_template_part( 'template-parts/content', 'none' );
					endif;
					?>
				</div>
			 </div>
			 <div class="col-lg-3 col-md-12 col-sm-12 sidebar-side">
                <div class="sidebar">
                	<?php get_template_part('layout/detail-sidebar'); ?>  
                </div>
            </div>
        </div>
    </div>
</section>
<?php
get_footer();
