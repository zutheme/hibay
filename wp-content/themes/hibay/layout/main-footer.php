 <?php $logo = get_field('logo','customizer'); 
 $phone1 = get_field('header_phone1','customizer');
 $phone2 = get_field('header_phone2','customizer'); 
 $address1 = get_field('header_address','customizer');
 $email1 = get_field('header_email','customizer');
 $main_footer_bottom = get_field('main_footer_bottom','customizer');
 $social = get_field('social','customizer');
 $current_user = wp_get_current_user();
 $current_user_id = $current_user->ID;
 $idpost = get_the_ID();
 $redirect_to = get_permalink($idpost);
 $current_language = pll_current_language('slug');
 ?>
<!-- main-footer -->
<footer class="main-footer">
	<div class="footer-top">
		<div class="auto-container">
			<div class="widget-section">
				<div class="row clearfix">
					<div class="col-lg-3 col-md-6 col-sm-12 footer-column">
						<div class="footer-widget logo-widget">
							<figure class="footer-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo $logo['url']; ?>" alt=""></a></figure>
							<div class="text">
								<p><?php //pll_e('description'); ?></p>
							</div>
							<ul class="info-list clearfix">
								<li><i class="fas fa-address-card"></i></i><?php pll_e('taxcode'); ?>: <a href="tel:<?php echo $phone1; ?>"><?php echo $phone1; ?></a></li>
								<li><i class="fas fa-envelope"></i>Email: <a href="mailto:<?php echo $email1; ?>"><?php echo $email1; ?></a></li>
								<li><i class="fas fa-headphones"></i><?php pll_e('support'); ?>: <a href="tel:<?php echo $phone2; ?>"><?php echo $phone2; ?></a></li>
							</ul>
							<ul class="social-links clearfix">
								<?php  if(isset($social)){
										$count = 0; $active = "active"; 
										foreach($social as $row) { ?>
										  <?php if($count > 0) {
											  $active = "";
										  } 
											?>
											<li><a href="<?php echo $row['link_social'] ?>">
												<img class="social-img" src="<?php echo $row['image_social']['url'] ?>">
												<img class="img-top" src="<?php echo $row['image_social']['url'] ?>">
											</a></li>
										  <?php 
										   $count++; 
										}
									 } ?>
							</ul>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-12 footer-column">
						<div class="footer-widget links-widget ml-70">
							<div class="widget-title">
								<h4><?php pll_e('infomation'); ?></h4>
							</div>
							<div class="widget-content">
								<?php 
									  wp_nav_menu( array(

									  'theme_location'    => 'menu-2',

									  'menu'              => 'menu-2',

									  'depth'             => 1,

									  'container'         => '',

									  'container_class'   => '',

									  'container_id'      => '',

									  'menu_id'           => '',

									  'menu_class'        => 'list clearfix',

									  'fallback_cb'       => 'wp_bootstrap_navwalker_desktop::fallback',

									  'walker'            => new wp_bootstrap_navwalker_desktop(),
									  'items_wrap' => '<ul class="%2$s">%3$s</ul>'

								  ) );
								?>
							   
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-12 footer-column">
						<div class="footer-widget links-widget">
							<div class="widget-title">
								<h4><?php pll_e('service'); ?></h4>
							</div>
							<div class="widget-content">
								<?php 
									  wp_nav_menu( array(

									  'theme_location'    => 'menu-3',

									  'menu'              => 'menu-3',

									  'depth'             => 1,

									  'container'         => '',

									  'container_class'   => '',

									  'container_id'      => '',

									  'menu_id'           => '',

									  'menu_class'        => 'list clearfix',

									  'fallback_cb'       => 'wp_bootstrap_navwalker_desktop::fallback',

									  'walker'            => new wp_bootstrap_navwalker_desktop(),
									  'items_wrap' => '<ul class="%2$s">%3$s</ul>'

								  ) );
								?>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-12 footer-column">
						<div class="footer-widget newsletter-widget">
							<div class="widget-title">
								<h4><?php pll_e('member'); ?></h4>
							</div>
							<div class="widget-content">
							<?php if($current_user_id < 1){ ?>
								<div class="text">
									<!--<p><?php //pll_e('login'); ?></p>-->
								<form action="" class="newsletter-form">
									<input type="hidden" id="captcha-login" value="" />
									<div class="form-group">
										<i class="far fa-user"></i>
										<input type="text" name="username" placeholder="Tài khoản" required="">
									</div>
									<div class="form-group">
										<i class="fa fa-key"></i>
										<input type="password" name="password" placeholder="Mật khẩu" required="">
									</div>
									<div class="form-group message-btn">
										<div id="captcha_login"></div>
										<button class="theme-btn style-one btn-user-login" type="button">Xác nhận</button>
									</div>
								</form>
							<?php }else{ ?>
								<div class="text">
									<p><?php pll_e('welcome'); ?> <?php echo $current_user->display_name; ?></p>
									<p><a href="<?php echo wp_logout_url( home_url() ); ?>"><?php pll_e('signout'); ?></a></p>
								</div>
							<?php } ?>
							</div>
						</div>
						
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-top-middle">
		<div class="auto-container">
			<div class="widget-section">
				<div class="row clearfix address">
					<div class="col-lg-3 col-md-6 col-sm-12 footer-column">
						<div class="footer-widget office">
							<div class="widget-content">
								<i class="far fa-map"></i>
								<p><?php pll_e('titleofffice'); ?></p>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-12 footer-column">
						<div class="footer-widget">
							<div class="widget-content">
								<i class="fas fa-map-marker-alt"></i> <?php pll_e('addresscorp1'); ?>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-12 footer-column">
						<div class="footer-widget">
							<div class="widget-content">
								<i class="fas fa-map-marker-alt"></i> <?php pll_e('addresscorp2'); ?>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-12 footer-column">
						<div class="footer-widget">
							<div class="widget-content">
								<i class="fas fa-map-marker-alt"></i> <?php pll_e('addresscorp3'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-bottom">
		<div class="auto-container">
			<div class="copyright"><?php echo $main_footer_bottom; ?></div>
		</div>
	</div>
</footer>
<!-- main-footer end -->
<!--Scroll to top-->
<button class="scroll-top scroll-to-target" data-target="html">
    <span class="fa fa-arrow-up"></span>
</button>