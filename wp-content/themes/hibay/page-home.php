<?php
/**
 *  Template Name: Home template
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
<?php //get_template_part('layout/slider-section'); ?>
<?php get_template_part('layout/banner-section'); ?>
<?php get_template_part('layout/info-section'); ?>
<?php get_template_part('layout/feature-section'); ?>
<?php get_template_part('layout/about-section'); ?>
<?php get_template_part('layout/service-section'); ?>
<?php get_template_part('layout/support'); ?>
<?php get_template_part('layout/testimonial'); ?>
<?php //get_template_part('layout/news'); ?>
<?php get_footer(); ?>