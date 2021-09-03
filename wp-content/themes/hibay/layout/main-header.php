 <?php $logo = get_field('logo','customizer'); 
 $phone1 = get_field('header_phone1','customizer');
 $phone2 = get_field('header_phone2','customizer');  
 $address1 = get_field('header_address','customizer');
 $email1 = get_field('header_email','customizer');
 $social = get_field('social','customizer');
 $current_user = wp_get_current_user();
 $current_user_id = $current_user->ID; ?>
<script> var _userlogin = '';</script>
 <?php if($current_user_id > 0){ ?>
	<script> var _userlogin = '<?php echo $current_user->display_name; ?>';</script>
 <?php }
 ?>
  <!-- main header -->
<header class="main-header style-one style-six">
    <div class="header-lower">
        <div class="auto-container">
            <div class="outer-box clearfix">
                <div class="logo-box pull-left">
                    <figure class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="logo-img" src="<?php echo $logo['url']; ?>" alt=""></a></figure>
                </div>
                <div class="menu-area pull-right">
                    <!--Mobile Navigation Toggler-->
                    <div class="mobile-nav-toggler">
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                    </div>
                    <nav class="main-menu navbar-expand-md navbar-light">
                        <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                            <?php 
                                  wp_nav_menu( array(

                                  'theme_location'    => 'menu-1',

                                  'menu'              => 'menu-1',

                                  'depth'             => 4,

                                  'container'         => '',

                                  'container_class'   => '',

                                  'container_id'      => '',

                                  'menu_id'           => '',

                                  'menu_class'        => 'navigation clearfix',

                                  'fallback_cb'       => 'wp_bootstrap_navwalker_desktop::fallback',

                                  'walker'            => new wp_bootstrap_navwalker_desktop(),
                                  'items_wrap' => '<ul class="%2$s">%3$s</ul>'

                              ) );
                            ?>
                            
                        </div>
                    </nav>
                    <div class="menu-right-content clearfix">
                        <div class="search-btn">
                            <button type="button" class="search-toggler"><i class="flaticon-search-1"></i></button>
                        </div>
                        <div class="nav-btn nav-toggler navSidebar-button clearfix">
                            <i class="fas fa-align-right"></i>
                        </div>
						
                        <div class="btn-box account">
							<?php 
                                  wp_nav_menu( array(

                                  'theme_location'    => 'menu-5',

                                  'menu'              => 'menu-5',

                                  'depth'             => 1,

                                  'container'         => '',

                                  'container_class'   => '',

                                  'container_id'      => '',

                                  'menu_id'           => '',

                                  'menu_class'        => 'language',

                                  'fallback_cb'       => 'wp_bootstrap_navwalker_desktop_language::fallback',

                                  'walker'            => new wp_bootstrap_navwalker_desktop_language(),
                                  'items_wrap' => '<ul class="%2$s">%3$s</ul>'

                              ) );
                            ?>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--sticky Header-->
    <div class="sticky-header">
        <div class="auto-container">
            <div class="outer-box clearfix">
                <div class="logo-box pull-left">
                    <figure class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="logo-img" src="<?php echo $logo['url']; ?>" alt=""></a></figure>
                </div>
                <div class="menu-area pull-right">
                    <nav class="main-menu clearfix">
                        <!--Keep This Empty / Menu will come through Javascript-->
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
    <!-- main-header end -->

    <!-- Mobile Menu  -->
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <div class="close-btn"><i class="fas fa-times"></i></div>
        <nav class="menu-box">
            <div class="nav-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo $logo['url']; ?>" alt="" title=""></a></div>
            <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
            <div class="account">
				<?php 
					  wp_nav_menu( array(

					  'theme_location'    => 'menu-5',

					  'menu'              => 'menu-5',

					  'depth'             => 1,

					  'container'         => '',

					  'container_class'   => '',

					  'container_id'      => '',

					  'menu_id'           => '',

					  'menu_class'        => 'clearfix',

					  'fallback_cb'       => 'wp_bootstrap_navwalker_desktop_language::fallback',

					  'walker'            => new wp_bootstrap_navwalker_desktop_language(),
					  'items_wrap' => '<ul class="%2$s">%3$s</ul>'

				  ) );
				?>
			   
			</div>
			<div class="contact-info">
                <h4><?php pll_e('infocontact'); ?></h4>
				<ul class="info-list clearfix">
					<li><i class="fas fa-address-card"></i></i><?php pll_e('taxcode'); ?>: <a href="tel:<?php echo $phone1; ?>"><?php echo $phone1; ?></a></li>
					<li><i class="fas fa-envelope"></i>Email: <a href="mailto:<?php echo $email1; ?>"><?php echo $email1; ?></a></li>
					<li><i class="fas fa-headphones"></i><?php pll_e('support'); ?>: <a href="tel:<?php echo $phone2; ?>"><?php echo $phone2; ?></a></li>
				</ul>		
                <ul>
                    <li><i class="fas fa-map-marker-alt"></i> <?php pll_e('addresscorp1'); ?></li>
                    <li><i class="fas fa-map-marker-alt"></i> <?php pll_e('addresscorp2'); ?></li>
                     <li><i class="fas fa-map-marker-alt"></i> <?php pll_e('addresscorp3'); ?></li>
                </ul>
            </div>
            <div class="social-links">
				<ul class="clearfix">
					<?php  if(isset($social)){
							foreach($social as $row) { ?>
								<li><a href="<?php echo $row['link_social'] ?>">
									<img class="social-img" src="<?php echo $row['image_social']['url'] ?>">
								</a></li>
							  <?php 
							}
						 } ?>
				</ul>
            </div>
        </nav>
    </div><!-- End Mobile Menu -->