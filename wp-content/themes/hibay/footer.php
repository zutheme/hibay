<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package hibay
 */
get_template_part('layout/main-footer');
//get_template_part('layout/sidebar-widget'); 
?>
<div class="htz-popup-processing" style="display: none; position: fixed; z-index: 1010;left: 0;top: 0%;width: 100%; height: 100%; overflow: auto;background-color: rgb(0,0,0); background-color: rgba(0,0,0,0.1); ">
  <div class="processing" style="position:relative;background-color: rgba(255,255,255,0.6);width: 250px;height: 250px;margin-top:15%; margin-left: auto;margin-right: auto;text-align: center;">
	<p><img id="loading" class="loading" style=" position: absolute;top: 11%;left: 11%;display: block;width: 200px; height: 200px;margin-left: auto;margin-right: auto;" src="<?php bloginfo('template_directory');?>/images/loader1.gif"></p>
	<!--<div id="loader" class="loading" style=" position: absolute;top: 40%;left: 11%;display: block;width: 200px; height: 200px;margin-left: auto;margin-right: auto;"><div class="cssload-box-loading"></div></div>-->
	<p class="result" style="font-weight: 500;font-size: 28px;"></p>
	<p><img class="checked-img" style="display: none;width: 60px;margin-right: auto;margin-left: auto;padding:5px; " src="<?php bloginfo('template_directory');?>/images/checked.jpg"></p>
  </div>
</div>
<!-- jequery plugins -->
<script src="<?php bloginfo('template_directory');?>/fionca/assets/js/jquery.js"></script>
<script src="<?php bloginfo('template_directory');?>/fionca/assets/js/popper.min.js"></script>
<script src="<?php bloginfo('template_directory');?>/fionca/assets/js/bootstrap.min.js"></script>
<script src="<?php bloginfo('template_directory');?>/fionca/assets/js/owl.js"></script>
<script src="<?php bloginfo('template_directory');?>/fionca/assets/js/wow.js"></script>
<script src="<?php bloginfo('template_directory');?>/fionca/assets/js/validation.js"></script>
<script src="<?php bloginfo('template_directory');?>/fionca/assets/js/jquery.fancybox.js"></script>
<script src="<?php bloginfo('template_directory');?>/fionca/assets/js/appear.js"></script>
<script src="<?php bloginfo('template_directory');?>/fionca/assets/js/jquery.countTo.js"></script>
<script src="<?php bloginfo('template_directory');?>/fionca/assets/js/scrollbar.js"></script>
<script src="<?php bloginfo('template_directory');?>/fionca/assets/js/nav-tool.js"></script>
<script src="<?php bloginfo('template_directory');?>/fionca/assets/js/TweenMax.min.js"></script>
<script src="<?php bloginfo('template_directory');?>/fionca/assets/js/circle-progress.js"></script>
<script src="<?php bloginfo('template_directory');?>/fionca/assets/js/jquery.nice-select.min.js"></script>
<!-- main-js -->
<script src="<?php bloginfo('template_directory');?>/fionca/assets/js/script.js?v=0.0.4"></script>
<script src="<?php bloginfo('template_directory');?>/js/captcha.js?v=0.1.0"></script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
<?php wp_footer(); ?>
</body>
</html>
