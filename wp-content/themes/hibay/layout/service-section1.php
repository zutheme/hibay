<?php $idpost = get_the_ID();
    $prfx_stored_meta = get_post_meta( $idpost );  ?>
<!-- service-section -->
<section class="service-section">
    <div class="auto-container">
        <div class="title-box">
            <div class="row clearfix">
                <div class="col-lg-6 col-md-12 col-sm-12 title-column">
                    <div class="sec-title right">
                        <h5><?php if ( isset ( $prfx_stored_meta['intro-service-title1'] ) ) echo $prfx_stored_meta['intro-service-title1'][0]; ?></h5>
                        <h2><?php if ( isset ( $prfx_stored_meta['intro-service-title1-2'] ) ) echo $prfx_stored_meta['intro-service-title1-2'][0]; ?></h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 text-column">
                    <div class="text">
                        <p><?php if ( isset ( $prfx_stored_meta['intro-service-des1'] ) ) echo $prfx_stored_meta['intro-service-des1'][0]; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="inner-content">
            <div class="row clearfix">
                <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                    <div class="service-block-one wow fadeInUp animated animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <h4><a href="<?php if ( isset ( $prfx_stored_meta['intro-service-link2'] ) ) echo $prfx_stored_meta['intro-service-link2'][0]; ?>"><?php if ( isset ( $prfx_stored_meta['intro-service-title2'] ) ) echo $prfx_stored_meta['intro-service-title2'][0]; ?></a></h4>
                            <div class="inner">
                                <div class="icon-box"><i class="flaticon-rocket"></i></div>
                                <p><?php if ( isset ( $prfx_stored_meta['intro-service-des2'] ) ) echo $prfx_stored_meta['intro-service-des2'][0]; ?></p>
                                <a href="<?php if ( isset ( $prfx_stored_meta['intro-service-link2'] ) ) echo $prfx_stored_meta['intro-service-link2'][0]; ?>"><i class="fas fa-arrow-right"></i><span><?php if ( isset ( $prfx_stored_meta['intro-service-readmore2'] ) ) echo $prfx_stored_meta['intro-service-readmore2'][0]; ?></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                    <div class="service-block-one wow fadeInUp animated animated" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <h4><a href="<?php if ( isset ( $prfx_stored_meta['intro-service-link3'] ) ) echo $prfx_stored_meta['intro-service-link3'][0]; ?>"><?php if ( isset ( $prfx_stored_meta['intro-service-title3'] ) ) echo $prfx_stored_meta['intro-service-title3'][0]; ?></a></h4>
                            <div class="inner">
                                <div class="icon-box"><i class="flaticon-innovation-1"></i></div>
                                <p><?php if ( isset ( $prfx_stored_meta['intro-service-des3'] ) ) echo $prfx_stored_meta['intro-service-des3'][0]; ?></p>
                                <a href="<?php if ( isset ( $prfx_stored_meta['intro-service-link3'] ) ) echo $prfx_stored_meta['intro-service-link3'][0]; ?>"><i class="fas fa-arrow-right"></i><span><?php if ( isset ( $prfx_stored_meta['intro-service-readmore3'] ) ) echo $prfx_stored_meta['intro-service-readmore3'][0]; ?></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                    <div class="service-block-one wow fadeInUp animated animated" data-wow-delay="600ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <h4><a href="<?php if ( isset ( $prfx_stored_meta['intro-service-link4'] ) ) echo $prfx_stored_meta['intro-service-link4'][0]; ?>"><?php if ( isset ( $prfx_stored_meta['intro-service-title4'] ) ) echo $prfx_stored_meta['intro-service-title4'][0]; ?></a></h4>
                            <div class="inner">
                                <div class="icon-box"><i class="flaticon-innovation-1"></i></div>
                                <p><?php if ( isset ( $prfx_stored_meta['intro-service-des4'] ) ) echo $prfx_stored_meta['intro-service-des4'][0]; ?></p>
                                <a href="<?php if ( isset ( $prfx_stored_meta['intro-service-link4'] ) ) echo $prfx_stored_meta['intro-service-link4'][0]; ?>"><i class="fas fa-arrow-right"></i><span><?php if ( isset ( $prfx_stored_meta['intro-service-readmore4'] ) ) echo $prfx_stored_meta['intro-service-readmore4'][0]; ?></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                    <div class="service-block-one wow fadeInUp animated animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <h4><a href="<?php if ( isset ( $prfx_stored_meta['intro-service-link5'] ) ) echo $prfx_stored_meta['intro-service-link5'][0]; ?>"><?php if ( isset ( $prfx_stored_meta['intro-service-title5'] ) ) echo $prfx_stored_meta['intro-service-title5'][0]; ?></a></h4>
                            <div class="inner">
                                <div class="icon-box"><i class="flaticon-innovation-1"></i></div>
                                <p><?php if ( isset ( $prfx_stored_meta['intro-service-des5'] ) ) echo $prfx_stored_meta['intro-service-des5'][0]; ?></p>
                                <a href="<?php if ( isset ( $prfx_stored_meta['intro-service-link5'] ) ) echo $prfx_stored_meta['intro-service-link5'][0]; ?>"><i class="fas fa-arrow-right"></i><span><?php if ( isset ( $prfx_stored_meta['intro-service-readmore5'] ) ) echo $prfx_stored_meta['intro-service-readmore5'][0]; ?></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                    <div class="service-block-one wow fadeInUp animated animated" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <h4><a href="<?php if ( isset ( $prfx_stored_meta['intro-service-link6'] ) ) echo $prfx_stored_meta['intro-service-link6'][0]; ?>"><?php if ( isset ( $prfx_stored_meta['intro-service-title6'] ) ) echo $prfx_stored_meta['intro-service-title6'][0]; ?></a></h4>
                            <div class="inner">
                                <div class="icon-box"><i class="flaticon-innovation-1"></i></div>
                                <p><?php if ( isset ( $prfx_stored_meta['intro-service-des6'] ) ) echo $prfx_stored_meta['intro-service-des6'][0]; ?></p>
                                <a href="<?php if ( isset ( $prfx_stored_meta['intro-service-link6'] ) ) echo $prfx_stored_meta['intro-service-link6'][0]; ?>"><i class="fas fa-arrow-right"></i><span><?php if ( isset ( $prfx_stored_meta['intro-service-readmore6'] ) ) echo $prfx_stored_meta['intro-service-readmore6'][0]; ?></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                    <div class="service-block-one wow fadeInUp animated animated" data-wow-delay="600ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <h4><a href="<?php if ( isset ( $prfx_stored_meta['intro-service-link7'] ) ) echo $prfx_stored_meta['intro-service-link7'][0]; ?>"><?php if ( isset ( $prfx_stored_meta['intro-service-title7'] ) ) echo $prfx_stored_meta['intro-service-title7'][0]; ?></a></h4>
                            <div class="inner">
                                <div class="icon-box"><i class="flaticon-innovation-1"></i></div>
                                <p><?php if ( isset ( $prfx_stored_meta['intro-service-des7'] ) ) echo $prfx_stored_meta['intro-service-des7'][0]; ?></p>
                                <a href="<?php if ( isset ( $prfx_stored_meta['intro-service-link7'] ) ) echo $prfx_stored_meta['intro-service-link7'][0]; ?>"><i class="fas fa-arrow-right"></i><span><?php if ( isset ( $prfx_stored_meta['intro-service-readmore7'] ) ) echo $prfx_stored_meta['intro-service-readmore7'][0]; ?></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- service-section end -->