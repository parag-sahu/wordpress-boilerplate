<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset');?>"> 
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header>
        <?php the_custom_logo(); ?>
        <?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'container' => 'nav' ) ); ?>
        <?php get_search_form( ); ?>
    </header>