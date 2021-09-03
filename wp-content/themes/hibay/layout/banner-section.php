<?php $idpost = get_the_ID();
	 $current_language = pll_current_language('slug');
	 //$strlang = 'slider_'.$current_language;
    $prfx_stored_meta = get_post_meta( $idpost );  ?>
 <?php $slider = get_field('slider_'.$current_language,'customizer'); ?>
<!-- banner-section -->
<section class="banner-section <?php echo $current_language; ?>">
    <div class="banner-carousel owl-theme owl-carousel owl-dots-none">
		<?php  if(isset($slider)){
            $count = 0; $active = "active"; 
            foreach($slider as $row) { ?>
              <?php if($count > 0) {
                  $active = "";
              } 
                ?>
				<div class="slide-item">
					<div class="auto-container">
						<div class="content-box">
							<a href="<?php echo $row['link_slider_'.$current_language] ?>"><img class="slider-desktop" src="<?php echo $row['image_slider_'.$current_language]['url'] ?>" alt=""></a>
							<!--<img class="slider-mobile" src="<?php //echo $row['image_slider_mobile']['url'] ?>" alt="" style="width:100%;">-->
						</div>  
					</div>
				</div>
              <?php 
               $count++; 
            }
         } ?>
    </div>
</section>
<!-- banner-section end -->