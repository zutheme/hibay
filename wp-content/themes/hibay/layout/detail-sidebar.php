<div class="sidebar-widget sidebar-search">
    <form role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="search-form">
        <div class="form-group">
            <input type="search" class="search-field" placeholder="" value="" name="s" />
            <button type="submit"><i class="fas fa-search"></i></button>

        </div>
    </form>
</div>
<div class="sidebar-widget sidebar-categories">
    <div class="widget-title">
        <h3><?php pll_e('category'); ?></h3>
    </div>
    <div class="widget-content">
        <?php 
          wp_nav_menu( array(

          'theme_location'    => 'menu-3',

          'menu'              => 'menu-3',

          'depth'             => 1,

          'container'         => '',

          'container_class'   => '',

          'container_id'      => '',

          'menu_id'           => '',

          'menu_class'        => 'categories-list clearfix',

          'fallback_cb'       => 'wp_bootstrap_navwalker_desktop::fallback',

          'walker'            => new wp_bootstrap_navwalker_desktop(),
          'items_wrap' => '<ul class="%2$s">%3$s</ul>'

      ) );
    ?>
        <!--<ul class="categories-list clearfix">
            <li><a href="blog-details.html">Business<span>(23)</span></a></li>
            <li><a href="blog-details.html">Search Optimization<span>(8)</span></a></li>
            <li><a href="blog-details.html">Financial Services<span>(64)</span></a></li>
            <li><a href="blog-details.html">Tax Reforms<span>(10)</span></a></li>
            <li><a href="blog-details.html">Digital Marketing<span>(47)</span></a></li>
            <li><a href="blog-details.html">Strategies<span>(2)</span></a></li>
        </ul>-->
    </div>
</div>
<div class="sidebar-widget sidebar-post">
    <div class="widget-title">
        <h3><?php pll_e('recentnews'); ?></h3>
    </div>
    <div class="widget-content">
         <?php
          $team_query = new WP_Query( array(
              'post_type' => 'post',
              'posts_per_page' => 3,
              'order' => 'desc',
          ));  
       
          if ($team_query->have_posts()) {
            while ($team_query->have_posts()) {
              $team_query->the_post();  
              $id = get_the_ID();
              //$link = get_post_meta( $id, 'link', true );
              $excerpt = get_the_excerpt_max(200);
              //$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'full', false );
              $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'full', false );
             ?>
            <div class="post">
                <figure class="post-thumb"><a href="<?php the_permalink(); ?>"><img src="<?php echo $thumbnail[0]; ?>" alt=""></a></figure>
                <h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
                <!--<div class="post-date"><i class="far fa-calendar-alt"></i>March 23, 2019</div>-->
            </div>
             
               <?php
               //$order++;
                } 
          } ?>
    </div>
</div>
<div class="sidebar-widget sidebar-gallery">
    <div class="widget-title">
        <h3><?php pll_e('imagegallery'); ?></h3>
    </div>
    <div class="widget-content">
        <ul class="image-list clearfix">
           <?php $image_gallery = get_field('gallery','customizer');
              if (isset($image_gallery)) :?>
                <?php foreach ($image_gallery as $row) :?>
                   <li><a href="<?php echo $row['image_gallery']['url']; ?>" class="lightbox-image" data-fancybox="gallery"><img src="<?php echo $row['image_gallery']['url']; ?>" alt=""></a></li>
                   <?php $count++;  
                endforeach;          
             endif; ?> 
        </ul>
    </div>
</div>
<div class="sidebar-widget sidebar-tags">
    <div class="widget-title">
        <h3><?php pll_e('populartags'); ?></h3>
    </div>
    <div class="widget-content">
         <ul class="tags-list clearfix">
        <?php if (function_exists('wp_tag_cloud')) {
            $tags = wp_tag_cloud( array('smallest'=>10, 'largest'=>10, 'orderby'=>'name', 'order'=>'ASC', 'format' => 'array') );
            foreach($tags as $tag) {
                if(isset($tag) && !empty($tag)){
                    echo '<li>'.$tag.'</li>';
                }
            }
        }?>
         </ul>
    </div>
</div>