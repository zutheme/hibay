<?php
/**
 *  Template Name: Contact
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package eleaning
 */
get_header(); ?>
<?php $idpost = get_the_ID();
    $prfx_stored_meta = get_post_meta( $idpost );  ?>
<!--Page Title-->
<section class="page-title centred" style="background-image: url(<?php if ( isset ( $prfx_stored_meta['banner_page'] ) ) echo $prfx_stored_meta['banner_page'][0]; ?>);">
	<div class="auto-container">
		<div class="content-box clearfix">
			<h1><?php the_title(); ?></h1>
			<?php custom_breadcrumbs(); ?>
		</div>
	</div>
</section>
<!--End Page Title-->
<section class="contact-information centred">
	<div class="auto-container">
		<div class="sec-title right">
			<h5><?php if ( isset ( $prfx_stored_meta['info-cont-title1'] ) ) echo $prfx_stored_meta['info-cont-title1'][0]; ?></h5>
			<h2><?php if ( isset ( $prfx_stored_meta['info-cont-desc1'] ) ) echo $prfx_stored_meta['info-cont-desc1'][0]; ?></h2>
		</div>
		<div class="row clearfix">
			<div class="col-lg-4 col-md-6 col-sm-12 single-column">
				<div class="single-item wow fadeInUp" data-wow-delay="00ms" data-wow-duration="1500ms">
					<div class="inner-box">
						<div class="icon-box"><i class="far fa-map"></i></div>
						<h3><?php if ( isset ( $prfx_stored_meta['info-column-title2'] ) ) echo $prfx_stored_meta['info-column-title2'][0]; ?></h3>
						<p><?php if ( isset ( $prfx_stored_meta['info-column-desc2'] ) ) echo $prfx_stored_meta['info-column-desc2'][0]; ?></p>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 col-sm-12 single-column">
				<div class="single-item wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms">
					<div class="inner-box">
						<div class="icon-box"><i class="fas fa-phone"></i></div>
						<h3><?php if ( isset ( $prfx_stored_meta['info-column-title3'] ) ) echo $prfx_stored_meta['info-column-title3'][0]; ?></h3>
						<?php if ( isset ( $prfx_stored_meta['info-column-desc3'] ) ) echo $prfx_stored_meta['info-column-desc3'][0]; ?>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 col-sm-12 single-column">
				<div class="single-item wow fadeInUp" data-wow-delay="400ms" data-wow-duration="1500ms">
					<div class="inner-box">
						<div class="icon-box"><i class="far fa-envelope-open"></i></div>
						<h3><?php if ( isset ( $prfx_stored_meta['info-column-title4'] ) ) echo $prfx_stored_meta['info-column-title4'][0]; ?></h3>
						<p><?php if ( isset ( $prfx_stored_meta['info-column-desc4'] ) ) echo $prfx_stored_meta['info-column-desc4'][0]; ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
    <!-- contact-information end -->
    <section class="contact-style-two" style="background-image: url(<?php bloginfo('template_directory');?>/fionca/assets/images/background/contact-3.jpg);">
        <div class="auto-container">
            <div class="col-xl-8 col-lg-12 col-md-12 inner-column">
                <div class="sec-title left light">
                    <h5><?php if ( isset ( $prfx_stored_meta['info-contsv-title1'] ) ) echo $prfx_stored_meta['info-contsv-title1'][0]; ?></h5>
                    <h2><?php if ( isset ( $prfx_stored_meta['info-contsv-title2'] ) ) echo $prfx_stored_meta['info-contsv-title2'][0]; ?></h2>
                    <p><?php if ( isset ( $prfx_stored_meta['info-contsv-desc3'] ) ) echo $prfx_stored_meta['info-contsv-desc3'][0]; ?></p>
                </div>
                <form method="post" action="<?php the_permalink(); ?>" id="contact-form" class="default-form"> 
                    <div class="row clearfix">
						<input type="hidden" id="captcha-contact" value="" />
                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                            <input type="text" name="name" value="" placeholder="<?php if ( isset ( $prfx_stored_meta['info-contsv-title4'] ) ) echo $prfx_stored_meta['info-contsv-title4'][0]; ?>" required="">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                            <input type="email" name="email" value="" placeholder="<?php if ( isset ( $prfx_stored_meta['info-contsv-title5'] ) ) echo $prfx_stored_meta['info-contsv-title5'][0]; ?>" required="">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                            <input type="text" name="phone" placeholder="<?php if ( isset ( $prfx_stored_meta['info-contsv-title6'] ) ) echo $prfx_stored_meta['info-contsv-title6'][0]; ?>" required="">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                            <input type="text" name="subject" value="" placeholder="<?php if ( isset ( $prfx_stored_meta['info-contsv-title7'] ) ) echo $prfx_stored_meta['info-contsv-title7'][0]; ?>" required="">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <textarea name="note" value="" placeholder="<?php if ( isset ( $prfx_stored_meta['info-contsv-title8'] ) ) echo $prfx_stored_meta['info-contsv-title8'][0]; ?>"></textarea>
                        </div>
						<div class="col-lg-12 col-md-12 col-sm-12 form-group">
								<div id="captcha_contact"></div>
						</div>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn">
                            <button class="theme-btn style-one btn-register-api" type="button" name="submit-form"><?php if ( isset ( $prfx_stored_meta['info-contsv-title9'] ) ) echo $prfx_stored_meta['info-contsv-title9'][0]; ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
   
<?php get_footer(); ?>