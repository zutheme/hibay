 <?php $logo = get_field('logo','customizer'); 
 $phone1 = get_field('header_phone1','customizer'); 
 $address1 = get_field('header_address','customizer');
 $email1 = get_field('header_email','customizer');
 ?>
  <!-- main header -->
<header class="main-header style-one style-six">
    <!--<div class="header-top">
        <div class="auto-container">
            <div class="top-inner clearfix">
                <ul class="info top-left pull-left">
                    <li><i class="fas fa-map-marker-alt"></i>838 Andy Street, Madison, NJ 08003</li>
                    <li><i class="fas fa-headphones"></i>Support <a href="tel:01005200369">0100 5200 369</a></li>
                </ul>
                <div class="top-right pull-right">
                    <ul class="social-links clearfix">
                        <li><a href="index-1.html"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="index-1.html"><i class="fab fa-google-plus-g"></i></a></li>
                        <li><a href="index-1.html"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="index-1.html"><i class="fab fa-linkedin-in"></i></a></li>
                        <li><a href="index-1.html"><i class="fab fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>-->
    <div class="header-lower">
        <div class="auto-container">
            <div class="outer-box clearfix">
                <div class="logo-box pull-left">
                    <figure class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo $logo['url']; ?>" alt=""></a></figure>
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
                        <div class="btn-box">
                            <a href="#" class="theme-btn style-one">EN</a>
                            <a href="#" class="theme-btn style-one">VN</a>
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
                    <figure class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo $logo['url']; ?>" alt=""></a></figure>
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
            <div class="contact-info">
                <h4>Thông tin liên hệ</h4>
                <ul>
                    <li><?php echo $address1; ?></li>
                    <li><a href="tel:+8801682648101"><?php echo $phone1; ?></a></li>
                    <li><a href="mailto:info@example.com"><?php echo $email1; ?></a></li>
                </ul>
            </div>
            <div class="social-links">
                <ul class="clearfix">
                    <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                    <li><a href="#"><span class="fab fa-facebook-square"></span></a></li>
                    <li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
                    <li><a href="#"><span class="fab fa-instagram"></span></a></li>
                    <li><a href="#"><span class="fab fa-youtube"></span></a></li>
                </ul>
            </div>
        </nav>
    </div><!-- End Mobile Menu -->