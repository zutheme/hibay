<?php $idpost = get_the_ID();
    $prfx_stored_meta = get_post_meta( $idpost );  ?>
<!-- service-section -->
<section class="service-section">
    <div class="auto-container">
        <div class="title-box">
			 <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
					<div class="sec-title centred">
						<h5><?php if ( isset ( $prfx_stored_meta['intro-service-title1'] ) ) echo $prfx_stored_meta['intro-service-title1'][0]; ?></h5>
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
                                <div class="icon-box">
								<!--<i class="flaticon-rocket"></i>-->
								<a href="#"><img src="<?php if ( isset ( $prfx_stored_meta['info-serivice-icon2'] ) ) echo $prfx_stored_meta['info-serivice-icon2'][0]; ?>"></a>
								</div>
                                <p><?php if ( isset ( $prfx_stored_meta['intro-service-des2'] ) ) echo $prfx_stored_meta['intro-service-des2'][0]; ?></p>
                                <a href="<?php if ( isset ( $prfx_stored_meta['intro-service-link2'] ) ) echo $prfx_stored_meta['intro-service-link2'][0]; ?>"><i class="fas fa-arrow-right"></i><span><?php pll_e('readmore'); ?></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                    <div class="service-block-one wow fadeInUp animated animated" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <h4><a href="<?php if ( isset ( $prfx_stored_meta['intro-service-link3'] ) ) echo $prfx_stored_meta['intro-service-link3'][0]; ?>"><?php if ( isset ( $prfx_stored_meta['intro-service-title3'] ) ) echo $prfx_stored_meta['intro-service-title3'][0]; ?></a></h4>
                            <div class="inner">
                                <div class="icon-box">
									<a href="#"><img src="<?php if ( isset ( $prfx_stored_meta['info-serivice-icon3'] ) ) echo $prfx_stored_meta['info-serivice-icon3'][0]; ?>"></a>
								</div>
                                <p><?php if ( isset ( $prfx_stored_meta['intro-service-des3'] ) ) echo $prfx_stored_meta['intro-service-des3'][0]; ?></p>
                                <a href="<?php if ( isset ( $prfx_stored_meta['intro-service-link3'] ) ) echo $prfx_stored_meta['intro-service-link3'][0]; ?>"><i class="fas fa-arrow-right"></i><span><?php pll_e('readmore'); ?></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                    <div class="service-block-one wow fadeInUp animated animated" data-wow-delay="600ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <h4><a href="<?php if ( isset ( $prfx_stored_meta['intro-service-link4'] ) ) echo $prfx_stored_meta['intro-service-link4'][0]; ?>"><?php if ( isset ( $prfx_stored_meta['intro-service-title4'] ) ) echo $prfx_stored_meta['intro-service-title4'][0]; ?></a></h4>
                            <div class="inner">
                                <div class="icon-box">
									<a href="#"><img src="<?php if ( isset ( $prfx_stored_meta['info-serivice-icon4'] ) ) echo $prfx_stored_meta['info-serivice-icon4'][0]; ?>"></a>
								</div>
                                <p><?php if ( isset ( $prfx_stored_meta['intro-service-des4'] ) ) echo $prfx_stored_meta['intro-service-des4'][0]; ?></p>
                                <a href="<?php if ( isset ( $prfx_stored_meta['intro-service-link4'] ) ) echo $prfx_stored_meta['intro-service-link4'][0]; ?>"><i class="fas fa-arrow-right"></i><span><?php pll_e('readmore'); ?></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                    <div class="service-block-one wow fadeInUp animated animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <h4><a href="<?php if ( isset ( $prfx_stored_meta['intro-service-link5'] ) ) echo $prfx_stored_meta['intro-service-link5'][0]; ?>"><?php if ( isset ( $prfx_stored_meta['intro-service-title5'] ) ) echo $prfx_stored_meta['intro-service-title5'][0]; ?></a></h4>
                            <div class="inner">
                                <div class="icon-box">
									<a href="#"><img src="<?php if ( isset ( $prfx_stored_meta['info-serivice-icon5'] ) ) echo $prfx_stored_meta['info-serivice-icon5'][0]; ?>"></a>
								</div>
                                <p><?php if ( isset ( $prfx_stored_meta['intro-service-des5'] ) ) echo $prfx_stored_meta['intro-service-des5'][0]; ?></p>
                                <a href="<?php if ( isset ( $prfx_stored_meta['intro-service-link5'] ) ) echo $prfx_stored_meta['intro-service-link5'][0]; ?>"><i class="fas fa-arrow-right"></i><span><?php pll_e('readmore'); ?></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                    <div class="service-block-one wow fadeInUp animated animated" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <h4><a href="<?php if ( isset ( $prfx_stored_meta['intro-service-link6'] ) ) echo $prfx_stored_meta['intro-service-link6'][0]; ?>"><?php if ( isset ( $prfx_stored_meta['intro-service-title6'] ) ) echo $prfx_stored_meta['intro-service-title6'][0]; ?></a></h4>
                            <div class="inner">
                                <div class="icon-box">
									<a href="#"><img src="<?php if ( isset ( $prfx_stored_meta['info-serivice-icon6'] ) ) echo $prfx_stored_meta['info-serivice-icon6'][0]; ?>"></a>
								</div>
                                <p><?php if ( isset ( $prfx_stored_meta['intro-service-des6'] ) ) echo $prfx_stored_meta['intro-service-des6'][0]; ?></p>
                                <a href="<?php if ( isset ( $prfx_stored_meta['intro-service-link6'] ) ) echo $prfx_stored_meta['intro-service-link6'][0]; ?>"><i class="fas fa-arrow-right"></i><span><?php pll_e('readmore'); ?></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                    <div class="service-block-one wow fadeInUp animated animated" data-wow-delay="600ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <h4><a href="<?php if ( isset ( $prfx_stored_meta['intro-service-link7'] ) ) echo $prfx_stored_meta['intro-service-link7'][0]; ?>"><?php if ( isset ( $prfx_stored_meta['intro-service-title7'] ) ) echo $prfx_stored_meta['intro-service-title7'][0]; ?></a></h4>
                            <div class="inner">
                                <div class="icon-box">
									<a href="#"><img src="<?php if ( isset ( $prfx_stored_meta['info-serivice-icon7'] ) ) echo $prfx_stored_meta['info-serivice-icon7'][0]; ?>"></a>
								</div>
                                <p><?php if ( isset ( $prfx_stored_meta['intro-service-des7'] ) ) echo $prfx_stored_meta['intro-service-des7'][0]; ?></p>
                                <a href="<?php if ( isset ( $prfx_stored_meta['intro-service-link7'] ) ) echo $prfx_stored_meta['intro-service-link7'][0]; ?>"><i class="fas fa-arrow-right"></i><span><?php pll_e('readmore'); ?></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- service-section end -->