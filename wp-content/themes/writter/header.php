<?php
/**
 * The Header for Writter.
 *
 * Displays all of the <head> section and everything up till content section.
 *
 * @package WordPress
 * @subpackage Writter
 * @since Writter 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, initial-scale=1.0" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <link rel="shortcut icon" href="<?php echo THEMEROOT ?>/favicon.ico" type="image/x-icon" />
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
    <script src="<?= get_template_directory_uri(); ?>/js/soundmanager2-jsmin.js"></script>
    <script src="<?= get_template_directory_uri(); ?>/js/bar-ui.js"></script>
    <link rel="stylesheet" href="<?= get_template_directory_uri(); ?>/css/bar-ui.css" />
	<?php wp_head(); ?> 
</head>
<body <?php body_class(); ?>>
    <section id="page">
        <?php get_sidebar( 'main' ); ?>
        <section id="main-content">  
            <section id="title-mobile">
                <div id="header-left" style="display: flex; align-items: center">
                    <a href="#" id="a-menu"><img src="<?php echo IMAGEDIR; ?>/icons/navigation.png" alt="Navigation" /></a>
                    <span class="header-menu-img-title">Меню</span>
                </div>
                            
                <div id="header-title">
                    <h1><?php bloginfo('name') ?></h1>
                </div>
            </section> <!-- #title-mobile -->
            <?php
            $queried_object = get_queried_object();
            if(get_field('banner', $queried_object)) {
                $url = get_field('banner', $queried_object);
             } else {
                $url = get_field('banner', 'option');
            }?>
            <a href="#" class="bn-img"><img src="<?= $url ?>"></a>
            <?php
            if ( function_exists('yoast_breadcrumb') && !is_front_page() ) {
                yoast_breadcrumb( '<p style="margin-bottom: 0;" id="breadcrumbs">','</p>' );
            }
            ?>
            <!-- [space for extra ads or widgets -->