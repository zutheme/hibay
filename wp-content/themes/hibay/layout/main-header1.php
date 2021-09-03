 <?php $logo = get_field('logo','customizer'); ?>
  <!-- main header -->
<header class="main-header style-one">
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
                            <ul class="navigation clearfix">
                                <li class="current dropdown"><a href="index-1.html">Home</a>
                                    <ul>
                                        <li><a href="index-1.html">Home Page One</a></li>
                                        <li><a href="index-2.html">Home Page Two</a></li>
                                        <li><a href="index-3.html">Home Page Three</a></li>
                                        <li><a href="index-4.html">Home Page Four</a></li>
                                        <li><a href="index-5.html">Home Page Five</a></li>
                                        <li><a href="index-onepage.html">Home OnePage</a></li>
                                        <li class="dropdown"><a href="index-1.html">Header Style</a>
                                            <ul>
                                                <li><a href="index-1.html">Header Style One</a></li>
                                                <li><a href="index-2.html">Header Style Two</a></li>
                                                <li><a href="index-3.html">Header Style Three</a></li>
                                                <li><a href="index-4.html">Header Style Four</a></li>
                                                <li><a href="index-5.html">Header Style Five</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li> 
                                <li class="dropdown"><a href="index-1.html">About</a>
                                    <ul>
                                        <li><a href="about-1.html">About Us 01</a></li>
                                        <li><a href="about-2.html">About Us 02</a></li>
                                        <li><a href="team.html">Experts Team</a></li>
                                        <li><a href="pricing.html">Our Pricing</a></li>
                                        <li><a href="error.html">Error Page</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="index-1.html">Services</a>
                                    <ul>
                                        <li><a href="service-1.html">Service Page 01</a></li>
                                        <li><a href="service-2.html">Service Page 02</a></li>
                                        <li><a href="financial-analysis.html">Financial Analysis</a></li>
                                        <li><a href="taxation-planning.html">Taxation Planning</a></li>
                                        <li><a href="investment-trading.html">Investment Trading</a></li>
                                        <li><a href="wealth-marketing.html">Wealth Marketing</a></li>
                                        <li><a href="planning-strategies.html">Planning Strategies</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="index-1.html">Elements</a>
                                    <div class="megamenu">
                                        <div class="row clearfix">
                                            <div class="col-lg-3 column">
                                                <ul>
                                                    <li><h4>Elements 1</h4></li>
                                                    <li><a href="feature-element-1.html">Feature 01</a></li>
                                                    <li><a href="feature-element-2.html">Feature 02</a></li>
                                                    <li><a href="feature-element-3.html">Feature 03</a></li>
                                                    <li><a href="about-element-1.html">About 01</a></li>
                                                    <li><a href="about-element-2.html">About 02</a></li>
                                                    <li><a href="about-element-3.html">About 03</a></li>
                                                    <li><a href="about-element-4.html">About 04</a></li>
                                                    <li><a href="stats-element.html">Stats Element</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-3 column">
                                                <ul>
                                                    <li><h4>Elements 2</h4></li>
                                                    <li><a href="news-element-1.html">News 01</a></li>
                                                    <li><a href="news-element-2.html">News 02</a></li>
                                                    <li><a href="funfact-element-1.html">Fun Fact 01</a></li>
                                                    <li><a href="funfact-element-2.html">Fun Fact 02</a></li>
                                                    <li><a href="service-element-1.html">Service 01</a></li>
                                                    <li><a href="service-element-2.html">Service 02</a></li>
                                                    <li><a href="skills-element.html">Skills Element</a></li>
                                                    <li><a href="clients-element.html">Clients</a></li>
                                                </ul>
                                            </div> 
                                            <div class="col-lg-3 column">
                                                <ul>
                                                    <li><h4>Elements 3</h4></li>
                                                    <li><a href="team-element-1.html">Team 01</a></li>
                                                    <li><a href="team-element-2.html">Team 02</a></li>
                                                    <li><a href="pricing-element.html">Pricing</a></li>
                                                    <li><a href="testimonial-element-1.html">Testimonial 01</a></li>
                                                    <li><a href="testimonial-element-2.html">Testimonial 02</a></li>
                                                    <li><a href="testimonial-element-3.html">Testimonial 03</a></li>
                                                    <li><a href="work-element-1.html">Working 01</a></li>
                                                    <li><a href="work-element-2.html">Working 02</a></li>
                                                </ul>
                                            </div> 
                                            <div class="col-lg-3 column">
                                                <ul>
                                                    <li><h4>Elements 4</h4></li>
                                                    <li><a href="project-element-1.html">Project 01</a></li>
                                                    <li><a href="project-element-2.html">Project 02</a></li>
                                                    <li><a href="chart-element.html">Chart Element</a></li>
                                                    <li><a href="footer-element-1.html">Footer 01</a></li>
                                                    <li><a href="footer-element-2.html">Footer 02</a></li>
                                                    <li><a href="footer-element-3.html">Footer 03</a></li>
                                                    <li><a href="footer-element-4.html">Footer 04</a></li>
                                                    <li><a href="footer-element-5.html">Footer 05</a></li>
                                                </ul>
                                            </div>                                       
                                        </div>                                            
                                    </div>
                                </li>
                                <li class="dropdown"><a href="index-1.html">Blog</a>
                                    <ul>
                                        <li><a href="blog-grid.html">Blog Grid</a></li>
                                        <li><a href="blog-classic.html">Blog Classic</a></li>
                                        <li><a href="blog-details.html">Blog Details</a></li>
                                    </ul>
                                </li>                              
                                <li><a href="contact.html">Contact</a></li>
                            </ul>
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
                            <a href="index-1.html" class="theme-btn style-one">Free Estimate</a>
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
                    <figure class="logo"><a href="index-1.html"><img src="<?php bloginfo('template_directory');?>/fionca/assets/images/small-logo.png" alt=""></a></figure>
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
            <div class="nav-logo"><a href="index-1.html"><img src="<?php bloginfo('template_directory');?>/fionca/assets/images/mobile-logo.png" alt="" title=""></a></div>
            <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
            <div class="contact-info">
                <h4>Contact Info</h4>
                <ul>
                    <li>Chicago 12, Melborne City, USA</li>
                    <li><a href="tel:+8801682648101">+88 01682648101</a></li>
                    <li><a href="mailto:info@example.com">info@example.com</a></li>
                </ul>
            </div>
            <div class="social-links">
                <ul class="clearfix">
                    <li><a href="index-1.html"><span class="fab fa-twitter"></span></a></li>
                    <li><a href="index-1.html"><span class="fab fa-facebook-square"></span></a></li>
                    <li><a href="index-1.html"><span class="fab fa-pinterest-p"></span></a></li>
                    <li><a href="index-1.html"><span class="fab fa-instagram"></span></a></li>
                    <li><a href="index-1.html"><span class="fab fa-youtube"></span></a></li>
                </ul>
            </div>
        </nav>
    </div><!-- End Mobile Menu -->