<div class="sidebar-widget sidebar-categories">
    <div class="widget-title">
        <h3><?php pll_e('service'); ?></h3>
    </div>
    <div class="widget-content">
        <?php 
          wp_nav_menu( array(

          'theme_location'    => 'menu-4',

          'menu'              => 'menu-4',

          'depth'             => 1,

          'container'         => '',

          'container_class'   => '',

          'container_id'      => '',

          'menu_id'           => '',

          'menu_class'        => 'categories-list clearfix',

          'fallback_cb'       => 'wp_bootstrap_navwalker_desktop::fallback',

          'walker'            => new wp_bootstrap_navwalker_desktop(),
          'items_wrap' => '<ul class="%2$s">%3$s</ul>'

      ) );
    ?>
    </div>
</div>
<div class="sidebar-widget">
	<div class="widget-title">
        <h3><?php pll_e('client'); ?></h3>
    </div>
    <div class="widget-content">
    <?php get_template_part('layout/testimonial-sidebar'); ?>
	</div>
</div>
<div class="sidebar-widget sidebar-categories">
	<div class="widget-title">
		<h3><?php pll_e('document'); ?></h3>
	</div>
	<div class="widget-content">
		<?php get_template_part('layout/document-sidebar'); ?>
	</div>
</div>