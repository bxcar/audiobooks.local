<?php
/**
 * Main sidebar which is always active. Contains in default: logo, slogan, searchform, nav, widget area and copyright text.
 *
 * @package WordPress
 * @subpackage Writter
 * @since Writter 1.0
 */
?>

<header id="header-mobile" role="banner">
	<section id="sidebar-left-mobile">
        <h3 class="sidebar-title">Navigation</h3>
        <nav id="sidebar-navigation-mobile" class="navigation main-navigation" role="navigation">
            <?php wp_nav_menu( array(
                'container' => 'ul',
                'menu_class' => 'menu',
                'theme_location' => 'main-navigation',
                'link_before'      => '<span class="menu-li-title">',
                'link_after'      => '</span><img class="menu-li-arrow" src="'.IMAGEDIR.'/icons/arrow-forward.png" alt="" />',
            ) ); ?>
        </nav><!-- #sidebar-navigation -->  
        <?php if ( ! is_active_widget( false, false, 'search' ) ) : ?>
        	<?php get_search_form(); ?>
        <?php endif; ?><!-- searchform init -->
        <div class="mobile-widget-inner">
            <?php if ( is_active_sidebar( 'main-sidebar' ) ) : ?>
                    <?php dynamic_sidebar( 'main-sidebar' ); ?>
            <?php endif; ?>
            <div class="widget">
                <p>&copy; <?php echo date('Y'); ?>. All rights reserverd.<br />
                <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'writter' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'writter' ); ?>"><?php printf( __( 'Powered by %s', 'writter' ), 'WordPress' ); ?></a></p>
            </div><!-- .site-info -->
        </div><!-- .mobile-widget-inner -->
    </section><!-- #sidebar-left-mobile -->
</header><!-- #header-mobile -->