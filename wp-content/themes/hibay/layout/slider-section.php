<?php $idpost = get_the_ID();
    $prfx_stored_meta = get_post_meta( $idpost );  ?>
<!-- clients-section -->
<section class="clients-section home-5 slider">
	<div class="auto-container">
		<div class="clients-carousel owl-carousel owl-theme owl-dots-none">
			<figure class="client-logo"><a href="<?php if ( isset ( $prfx_stored_meta['slide-link1'] ) ) echo $prfx_stored_meta['slide-link1'][0]; ?>"><img src="<?php if ( isset ( $prfx_stored_meta['slide_image1'] ) ) echo $prfx_stored_meta['slide_image1'][0]; ?>" alt=""></a></figure>
			<figure class="client-logo"><a href="<?php if ( isset ( $prfx_stored_meta['slide-link1'] ) ) echo $prfx_stored_meta['slide-link1'][0]; ?>"><img src="<?php if ( isset ( $prfx_stored_meta['slide_image1'] ) ) echo $prfx_stored_meta['slide_image1'][0]; ?>" alt=""></a></figure>
			<figure class="client-logo"><a href="<?php if ( isset ( $prfx_stored_meta['slide-link1'] ) ) echo $prfx_stored_meta['slide-link1'][0]; ?>"><img src="<?php if ( isset ( $prfx_stored_meta['slide_image1'] ) ) echo $prfx_stored_meta['slide_image1'][0]; ?>" alt=""></a></figure>
			<figure class="client-logo"><a href="<?php if ( isset ( $prfx_stored_meta['slide-link1'] ) ) echo $prfx_stored_meta['slide-link1'][0]; ?>"><img src="<?php if ( isset ( $prfx_stored_meta['slide_image1'] ) ) echo $prfx_stored_meta['slide_image1'][0]; ?>" alt=""></a></figure>
			<figure class="client-logo"><a href="<?php if ( isset ( $prfx_stored_meta['slide-link1'] ) ) echo $prfx_stored_meta['slide-link1'][0]; ?>"><img src="<?php if ( isset ( $prfx_stored_meta['slide_image1'] ) ) echo $prfx_stored_meta['slide_image1'][0]; ?>" alt=""></a></figure>
		</div>
	</div>
</section>
<!-- clients-section end -->