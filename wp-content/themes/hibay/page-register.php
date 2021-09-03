<?php
/**
 *  Template Name: Custom Register Page
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
	  $prfx_stored_meta = get_post_meta( $idpost ); ?>
<!--Page Title-->
<section class="page-title centred" style="background-image: url(<?php if ( isset ( $prfx_stored_meta['banner_page'] ) ) echo $prfx_stored_meta['banner_page'][0]; ?>);">
	<div class="auto-container">
		<div class="content-box clearfix">
			<h1><?php the_title(); ?></h1>
			<?php custom_breadcrumbs(); ?>
		</div>
	</div>
</section>
<?php

$current_user = wp_get_current_user();
$current_user_id = $current_user->ID;
if($current_user_id < 1) { 
 ?>
   <!-- contact-style-two -->
	<section class="contact-style-two" style="background-image: url(<?php bloginfo('template_directory');?>/fionca/assets/images/background/contact-3.jpg);">
		<div class="auto-container">
			<div class="col-xl-8 col-lg-12 col-md-12 inner-column">
				<div class="sec-title left light">
					<h5><?php if ( isset ( $prfx_stored_meta['register-title1'] ) ) echo $prfx_stored_meta['register-title1'][0]; ?></h5>
					<h2><?php if ( isset ( $prfx_stored_meta['register-title2'] ) ) echo $prfx_stored_meta['register-title2'][0]; ?></h2>
					<p><?php if ( isset ( $prfx_stored_meta['register-desc3'] ) ) echo $prfx_stored_meta['register-desc3'][0]; ?></p>
				</div>
				<form id="contact-form" class="default-form"> 
					<div class="row clearfix">
						<input type="hidden" id="captcha-register" value="" />
						<div class="col-lg-9 col-md-9 col-sm-12 form-group">
							<input type="text" name="phone" placeholder="<?php if ( isset ( $prfx_stored_meta['register-title6'] ) ) echo $prfx_stored_meta['register-title6'][0]; ?>" required="">
						</div>
						<div class="col-lg-9 col-md-9 col-sm-12 form-group">
							<input type="text" name="fullname" value="" placeholder="<?php if ( isset ( $prfx_stored_meta['register-title4'] ) ) echo $prfx_stored_meta['register-title4'][0]; ?>" required="">
						</div>
						<div class="col-lg-9 col-md-9 col-sm-12 form-group">
							<input type="email" name="useremail" value="" placeholder="<?php if ( isset ( $prfx_stored_meta['register-title5'] ) ) echo $prfx_stored_meta['register-title5'][0]; ?>" required="">
						</div>
						
						<div class="col-lg-9 col-md-6 col-sm-12 form-group">
							<input type="password" name="password" value="" placeholder="<?php if ( isset ( $prfx_stored_meta['register-title7'] ) ) echo $prfx_stored_meta['register-title7'][0]; ?>" required="">
						</div>
						<div class="col-lg-9 col-md-6 col-sm-12 form-group">
							<input type="password" name="password2" value="" placeholder="<?php if ( isset ( $prfx_stored_meta['register-title8'] ) ) echo $prfx_stored_meta['register-title8'][0]; ?>" required="">
						</div>
						<div class="col-lg-9 col-md-6 col-sm-12 form-group">
							<div id="captcha_register"></div>
						</div>
						<div class="col-lg-9 col-md-9 col-sm-12 form-group message-btn">
							<button class="theme-btn style-one btn-user-register" type="button" ><?php if ( isset ( $prfx_stored_meta['register-title9'] ) ) echo $prfx_stored_meta['register-title9'][0]; ?></button>
						</div>
					</div>
				</form>
				<div class="sec-title left light">
				
				</div>
			</div>
		</div>
	</section>
<?php }else{ ?>
<section class="contact-style-two" style="background-image: url(<?php bloginfo('template_directory');?>/fionca/assets/images/background/contact-3.jpg);">
	<div class="auto-container">
		<div class="col-xl-8 col-lg-12 col-md-12 inner-column">
			<div class="sec-title left light">
				<h5><?php if ( isset ( $prfx_stored_meta['register-title1'] ) ) echo $prfx_stored_meta['register-title1'][0]; ?></h5>
			</div>
			<p><?php echo $current_user->user_nicename; ?></p>
			<p><?php echo $current_user->user_login; ?></p>
		</div>
	</div>
</section>	
<?php }  
?>

<?php get_footer(); ?>