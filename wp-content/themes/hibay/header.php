<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package hibay
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<!-- Fav Icon -->
	<?php $favicon = get_field('favicon','customizer'); ?>
	<link rel="icon" href="<?php bloginfo('template_directory');?>//images/icon.png" type="image/png">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Arimo:400,400i,700,700i&display=swap" rel="stylesheet">

	<!-- Stylesheets -->
	<link href="<?php bloginfo('template_directory');?>/fionca/assets/css/font-awesome-all.css" rel="stylesheet">
	<link href="<?php bloginfo('template_directory');?>/fionca/assets/css/flaticon.css" rel="stylesheet">
	<link href="<?php bloginfo('template_directory');?>/fionca/assets/css/owl.css" rel="stylesheet">
	<link href="<?php bloginfo('template_directory');?>/fionca/assets/css/bootstrap.css" rel="stylesheet">
	<link href="<?php bloginfo('template_directory');?>/fionca/assets/css/jquery.fancybox.min.css" rel="stylesheet">
	<link href="<?php bloginfo('template_directory');?>/fionca/assets/css/animate.css" rel="stylesheet">
	<link href="<?php bloginfo('template_directory');?>/fionca/assets/css/color.css?v=0.0.6" rel="stylesheet">
	<link href="<?php bloginfo('template_directory');?>/fionca/assets/css/rtl.css" rel="stylesheet">
	<link href="<?php bloginfo('template_directory');?>/fionca/assets/css/style.css?v=1.4.8" rel="stylesheet">
	<link href="<?php bloginfo('template_directory');?>/fionca/assets/css/responsive.css?v=0.1.0" rel="stylesheet">

	<?php wp_head(); ?>
</head>

<body class="boxed_wrapper ltr">
<?php wp_body_open(); ?>
<?php get_template_part('layout/preload'); 
	  get_template_part('layout/main-header');
?>

