<?php $idpost = get_the_ID();
    $prfx_stored_meta = get_post_meta( $idpost );  ?>
<!-- info-section -->
<section class="info-section">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-7 col-md-12 col-sm-12 title-column">
                <div class="title-inner">
                    <div class="year-box">
                        <figure class="image-box"><img class="info-logo" src="<?php if ( isset ( $prfx_stored_meta['info_logo'] ) ) echo $prfx_stored_meta['info_logo'][0]; ?>" alt=""></figure>
                    </div>
                    <div class="title">
                        <h2><?php if ( isset ( $prfx_stored_meta['info-title'] ) ) echo $prfx_stored_meta['info-title'][0]; ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-12 col-sm-12 text-column">
                <div class="text">
                    <p><?php if ( isset ( $prfx_stored_meta['info-desc'] ) ) echo $prfx_stored_meta['info-desc'][0]; ?></p>
                    <a href="<?php if ( isset ( $prfx_stored_meta['info-link'] ) ) echo $prfx_stored_meta['info-link'][0]; ?>"><i class="fas fa-arrow-right"></i><span><?php pll_e('readmore'); ?></span></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- info-section end -->