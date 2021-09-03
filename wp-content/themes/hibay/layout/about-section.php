<?php $idpost = get_the_ID();
    $prfx_stored_meta = get_post_meta( $idpost );  ?>
<!-- about-section -->
<section class="about-section bg-color-1"> 
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-6 col-md-12 col-sm-12 video-column">
                <div class="video-inner">
                    <figure class="image-box"><img src="<?php if ( isset ( $prfx_stored_meta['about_image'] ) ) echo $prfx_stored_meta['about_image'][0]; ?>" alt=""></figure>
                    <div class="video-btn">
                        <a href=<?php if ( isset ( $prfx_stored_meta['about-youtube'] ) ) echo $prfx_stored_meta['about-youtube'][0]; ?>" class="lightbox-image" data-caption="" style="background-image: url(<?php bloginfo('template_directory');?>/fionca/assets/images/resource/btn-bg.png);"><i class="fas fa-play"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                <div id="content_block_one">
                    <div class="content-box">
                        <div class="sec-title left">
                            <h5><?php if ( isset ( $prfx_stored_meta['about-title1'] ) ) echo $prfx_stored_meta['about-title1'][0]; ?></h5>
                            <h2><?php if ( isset ( $prfx_stored_meta['about-title2'] ) ) echo $prfx_stored_meta['about-title2'][0]; ?></h2>
                        </div>
                        <div class="text">
                            <p><?php if ( isset ( $prfx_stored_meta['about-des1'] ) ) echo $prfx_stored_meta['about-des1'][0]; ?></p>
                        </div>
                        <div class="inner-box">
                            <div class="single-item">
                                <div class="icon-box">
                                    <span class="bg-box"></span>
                                    <i class="flaticon-computer-1"></i>
                                </div>
                                <h4><a href="<?php if ( isset ( $prfx_stored_meta['about-link3'] ) ) echo $prfx_stored_meta['about-link3'][0]; ?>"><?php if ( isset ( $prfx_stored_meta['about-title3'] ) ) echo $prfx_stored_meta['about-title3'][0]; ?></a></h4>
                                <p><?php if ( isset ( $prfx_stored_meta['about-desc3'] ) ) echo $prfx_stored_meta['about-desc3'][0]; ?></p>
                            </div>
                            <div class="single-item">
                                <div class="icon-box">
                                    <span class="bg-box"></span>
                                    <i class="flaticon-browser-1"></i>
                                </div>
                                <h4><a href="<?php if ( isset ( $prfx_stored_meta['about-link4'] ) ) echo $prfx_stored_meta['about-link4'][0]; ?>"><?php if ( isset ( $prfx_stored_meta['about-title4'] ) ) echo $prfx_stored_meta['about-title4'][0]; ?></a></h4>
                                <p><?php if ( isset ( $prfx_stored_meta['about-desc4'] ) ) echo $prfx_stored_meta['about-desc4'][0]; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- about-section end -->