<?php $idpost = get_the_ID();
    $prfx_stored_meta = get_post_meta( $idpost );  ?>
<!-- banner-section -->
<section class="banner-section">
    <div class="banner-carousel owl-theme owl-carousel owl-dots-none">
        <div class="slide-item">
            <div class="image-layer" style="background-image:url(<?php if ( isset ( $prfx_stored_meta['slide_image1'] ) ) echo $prfx_stored_meta['slide_image1'][0]; ?>)"></div>
            <div class="auto-container">
                <div class="content-box">
                    <h5><?php if ( isset ( $prfx_stored_meta['slide-title1'] ) ) echo $prfx_stored_meta['slide-title1'][0]; ?></h5>
                    <h1><?php if ( isset ( $prfx_stored_meta['slide-desc1'] ) ) echo $prfx_stored_meta['slide-desc1'][0]; ?></h1>
                    <div class="btn-box">
                        <a href="<?php if ( isset ( $prfx_stored_meta['slide-link1'] ) ) echo $prfx_stored_meta['slide-link1'][0]; ?>" class="theme-btn style-one">Tìm hiểu</a>
                    </div>
                </div>  
            </div>
        </div>
        <div class="slide-item">
            <div class="image-layer" style="background-image:url(<?php if ( isset ( $prfx_stored_meta['slide_image2'] ) ) echo $prfx_stored_meta['slide_image2'][0]; ?>)"></div>
           <div class="auto-container">
                <div class="content-box">
                    <h5><?php if ( isset ( $prfx_stored_meta['slide-title2'] ) ) echo $prfx_stored_meta['slide-title2'][0]; ?></h5>
                    <h1><?php if ( isset ( $prfx_stored_meta['slide-desc2'] ) ) echo $prfx_stored_meta['slide-desc2'][0]; ?></h1>
                    <div class="btn-box">
                        <a href="<?php if ( isset ( $prfx_stored_meta['slide-link2'] ) ) echo $prfx_stored_meta['slide-link2'][0]; ?>" class="theme-btn style-one">Tìm hiểu</a>
                    </div>
                </div>  
            </div>
        </div>
        <div class="slide-item">
            <div class="image-layer" style="background-image:url(<?php if ( isset ( $prfx_stored_meta['slide_image3'] ) ) echo $prfx_stored_meta['slide_image3'][0]; ?>)"></div>
            <div class="auto-container">
                <div class="content-box">
                    <h5><?php if ( isset ( $prfx_stored_meta['slide-title3'] ) ) echo $prfx_stored_meta['slide-title3'][0]; ?></h5>
                    <h1><?php if ( isset ( $prfx_stored_meta['slide-desc3'] ) ) echo $prfx_stored_meta['slide-desc3'][0]; ?></h1>
                    <div class="btn-box">
                        <a href="<?php if ( isset ( $prfx_stored_meta['slide-link3'] ) ) echo $prfx_stored_meta['slide-link3'][0]; ?>" class="theme-btn style-one">Tìm hiểu</a>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</section>
<!-- banner-section end -->