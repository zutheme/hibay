<?php 
$current_language = pll_current_language('slug');
$client = get_field('review_'.$current_language,'customizer'); 
?>
<!-- testimonial-section -->
<section class="testimonial-section">
	<div class="testimonial-inner">
		<div class="client-testimonial-carousel owl-carousel owl-theme owl-nav-none owl-dots-none">
			<?php
			if(isset($client)){
				foreach($client as $row) { ?>
					<div class="testimonial-block">
						<div class="text">
							<p><?php echo $row['review_desc_'.$current_language]; ?></p>
						</div>
					 </div>
				  <?php 
				}
			 } ?>
		</div>
		<div class="client-thumb-outer">
			<div class="client-thumbs-carousel owl-carousel owl-theme owl-nav-none owl-dots-none">
			<?php
			if(isset($client)){
				foreach($client as $row) { ?>
					<div class="thumb-item">
						<figure class="thumb-box"><img src="<?php echo $row['review_avatar_'.$current_language]['url']; ?>" alt=""></figure>
						<div class="info-box">
							<h5><?php echo $row['review_name_'.$current_language]; ?></h5>
							<span class="designation"><?php echo $row['review_pos_'.$current_language]; ?></span>
						</div>
					</div>
				  <?php 
				}
			 } ?>
			</div>
		</div>
	</div>        
 </section>   
<!-- testimonial-section end -->