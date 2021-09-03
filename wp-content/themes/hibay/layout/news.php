<?php $idpost = get_the_ID();
    $prfx_stored_meta = get_post_meta( $idpost );  ?>
 <!-- news-section -->
<section class="news-section bg-color-1">
    <div class="auto-container">
        <div class="sec-title centred">
            <?php //_e('Name', 'hibay'); ?>
            <h5><?php if ( isset ( $prfx_stored_meta['news-title1'] ) ) echo $prfx_stored_meta['news-title1'][0]; ?></h5>
            <h2><?php if ( isset ( $prfx_stored_meta['news-title2'] ) ) echo $prfx_stored_meta['news-title2'][0]; ?></h2>
        </div>
        <div class="row clearfix">
            <?php
          $team_query = new WP_Query( array(
              'post_type' => 'post',
              'posts_per_page' => 3,
              'order' => 'desc',
              // 'tax_query' => array(
              //     array(
              //         'taxonomy' => 'category',
              //         'field' => 'slug',
              //         'terms' =>'tin-tuc'
              //     )
              // )
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
            <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                <div class="news-block-one wow fadeInUp animated animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <figure class="image-box"><a href="<?php the_permalink(); ?>"><img src="<?php echo $thumbnail[0]; ?>" alt=""></a></figure>
                        <div class="lower-content">
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <p><?php echo $excerpt; ?></p>
                            <div class="link"><a href="<?php the_permalink(); ?>"><i class="fas fa-arrow-right"></i><span><?php if ( isset ( $prfx_stored_meta['news-readmore'] ) ) echo $prfx_stored_meta['news-readmore'][0]; ?></span></a></div>
                        </div>
                    </div>
                </div>
            </div>
             
               <?php
               //$order++;
                } 
          } ?>
        </div>
    </div>
</section>
<!-- news-section end -->