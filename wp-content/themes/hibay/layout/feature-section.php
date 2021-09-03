<?php $idpost = get_the_ID();
    $prfx_stored_meta = get_post_meta( $idpost );  ?>
<!-- feature-section -->
<section class="feature-section">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                <div class="feature-block-one wow fadeInUp animated animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <figure class="image-box"><img src="<?php if ( isset ( $prfx_stored_meta['service_image1'] ) ) echo $prfx_stored_meta['service_image1'][0]; ?>" alt=""></figure>
                        <div class="lower-content">
                            <div class="inner">
                                <h3><?php if ( isset ( $prfx_stored_meta['service-title1'] ) ) echo $prfx_stored_meta['service-title1'][0]; ?></h3>
                                <a href="<?php if ( isset ( $prfx_stored_meta['service-link1'] ) ) echo $prfx_stored_meta['service-link1'][0]; ?>"><span><?php pll_e('readmore'); ?></span><i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                <div class="feature-block-one wow fadeInUp animated animated" data-wow-delay="300ms" data-wow-duration="1500ms">
                     <div class="inner-box">
                        <figure class="image-box"><img src="<?php if ( isset ( $prfx_stored_meta['service_image2'] ) ) echo $prfx_stored_meta['service_image2'][0]; ?>" alt=""></figure>
                        <div class="lower-content">
                            <div class="inner">
                                <h3><?php if ( isset ( $prfx_stored_meta['service-title2'] ) ) echo $prfx_stored_meta['service-title2'][0]; ?></h3>
                                <a href="<?php if ( isset ( $prfx_stored_meta['service-link2'] ) ) echo $prfx_stored_meta['service-link2'][0]; ?>"><span><?php pll_e('readmore'); ?></span><i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                <div class="feature-block-one wow fadeInUp animated animated" data-wow-delay="600ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <figure class="image-box"><img src="<?php if ( isset ( $prfx_stored_meta['service_image3'] ) ) echo $prfx_stored_meta['service_image3'][0]; ?>" alt=""></figure>
                        <div class="lower-content">
                            <div class="inner">
                                <h3><?php if ( isset ( $prfx_stored_meta['service-title3'] ) ) echo $prfx_stored_meta['service-title3'][0]; ?></h3>
                                <a href="<?php if ( isset ( $prfx_stored_meta['service-link3'] ) ) echo $prfx_stored_meta['service-link3'][0]; ?>"><span><?php pll_e('readmore'); ?></span><i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- feature-section end -->