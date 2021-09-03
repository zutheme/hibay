<?php $idpost = get_the_ID();
    $prfx_stored_meta = get_post_meta( $idpost );  ?>
<!-- support-section -->
<section class="support-section">
    <div class="auto-container">
        <div class="inner-container">
            <div class="row clearfix">
                <div class="col-lg-7 col-md-12 col-sm-12 inner-column">
                    <div class="inner-box">
                        <div class="sec-title light left">
                            <h5><?php if ( isset ( $prfx_stored_meta['contact-title'] ) ) echo $prfx_stored_meta['contact-title'][0]; ?></h5>
                            <h2><?php if ( isset ( $prfx_stored_meta['contact-title1'] ) ) echo $prfx_stored_meta['contact-title1'][0]; ?></h2>
                            <p><?php if ( isset ( $prfx_stored_meta['contact-des'] ) ) echo $prfx_stored_meta['contact-des'][0]; ?></p>
                        </div>
                        <form action="#" method="post" class="submit-form">
							<input type="hidden" id="captcha-contact" value="" />
                            <div class="form-group">
                                <input type="text" name="name" placeholder="<?php if ( isset ( $prfx_stored_meta['contact-fullname'] ) ) echo $prfx_stored_meta['contact-fullname'][0]; ?>" required="">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" placeholder="<?php if ( isset ( $prfx_stored_meta['contact-email'] ) ) echo $prfx_stored_meta['contact-email'][0]; ?>" required="">
                            </div>
                            <div class="form-group">
                                <input type="text" name="phone" placeholder="<?php if ( isset ( $prfx_stored_meta['contact-phone'] ) ) echo $prfx_stored_meta['contact-phone'][0]; ?>" required="">
                            </div>
                            <div class="form-group">
                                <textarea name="note" placeholder="<?php if ( isset ( $prfx_stored_meta['contact-note'] ) ) echo $prfx_stored_meta['contact-note'][0]; ?>"></textarea>
                            </div>
							<div class="form-group">
								<div id="captcha_contact"></div>
							</div>
                            <div class="form-group message-btn">
                                <button type="button" class="theme-btn style-one btn-register-api"><?php if ( isset ( $prfx_stored_meta['contact-submit'] ) ) echo $prfx_stored_meta['contact-submit'][0]; ?></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12 col-sm-12 info-column">
                    <div class="info-inner">
                        <figure class="image-box"><img src="<?php if ( isset ( $prfx_stored_meta['contact_image'] ) ) echo $prfx_stored_meta['contact_image'][0]; ?>" alt=""></figure>
                        <div class="info-box">
                            <figure class="info-logo"><img src="<?php if ( isset ( $prfx_stored_meta['contact_info_logo'] ) ) echo $prfx_stored_meta['contact_info_logo'][0]; ?>" alt=""></figure>
                            <div class="icon-box"><i class="fas fa-phone"></i></div>
                            <h2><a href="tel:><?php if ( isset ( $prfx_stored_meta['contact-support'] ) ) echo $prfx_stored_meta['contact-support'][0]; ?>"><?php if ( isset ( $prfx_stored_meta['contact-support'] ) ) echo $prfx_stored_meta['contact-support'][0]; ?></a></h2>
                            <div class="email"><a href="mailto:<?php if ( isset ( $prfx_stored_meta['contact-support-email'] ) ) echo $prfx_stored_meta['contact-support-email'][0]; ?>"><?php if ( isset ( $prfx_stored_meta['contact-support-email'] ) ) echo $prfx_stored_meta['contact-support-email'][0]; ?></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- support-section end -->