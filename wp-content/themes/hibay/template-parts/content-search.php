<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hibay
 */

?>
<div class="news-block-three">
    <div class="inner-box">
        <div class="lower-content">
            <?php the_title( sprintf( '<h2><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
            <div class="link"><a href="<?php the_permalink(); ?>"><i class="fas fa-arrow-right"></i><span><?php pll_e('readmore'); ?></span></a></div>
        </div>
    </div>
</div>
<?php //the_title( sprintf( '<h2><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>