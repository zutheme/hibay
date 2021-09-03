
<!-- Preloader -->
<!--<div class="loader-wrap">
    <div class="preloader"><div class="preloader-close">Preloader Close</div></div>
    <div class="layer layer-one"><span class="overlay"></span></div>
    <div class="layer layer-two"><span class="overlay"></span></div>        
    <div class="layer layer-three"><span class="overlay"></span></div>        
</div>-->


<!-- page-direction -->
<!--<div class="page_direction">
    <div class="demo-rtl direction_switch"><button class="rtl">RTL</button></div>
    <div class="demo-ltr direction_switch"><button class="ltr">LTR</button></div>
</div>-->
<!-- page-direction end -->


<!-- search-popup -->
<div id="search-popup" class="search-popup">
    <div class="close-search"><span><?php pll_e('close'); ?></span></div>
    <div class="popup-inner">
        <div class="overlay-layer"></div>
            <form role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="search-form">
                <div class="form-group">
                    <fieldset>
                        <!--<input type="search" class="search-field" placeholder="" value="" name="s" />-->
                    <input type="search" class="search-field" name="s" value="" placeholder="<?php pll_e('keyword'); ?>" required="">
                    <input type="submit" value="<?php pll_e('search'); ?>" class="theme-btn style-four">
                    </fieldset>
                </div>
            </form>
            <!--<h3>Recent Search Keywords</h3>
            <ul class="recent-searches">
                <li><a href="index-1.html">Finance</a></li>
                <li><a href="index-1.html">Idea</a></li>
                <li><a href="index-1.html">Service</a></li>
                <li><a href="index-1.html">Growth</a></li>
                <li><a href="index-1.html">Plan</a></li>
            </ul>-->
        </div>
    </div>
</div>
<!-- search-popup end -->