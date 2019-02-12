<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Writter
 * @since Writter 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
    	<div class="featured-post-wrapper"><div class="featured-post">HOT</div></div>
    <?php endif; ?>	
	<header class="entry-header">
		<?php if ( has_post_thumbnail() ) : ?>
		<div class="entry-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
		<?php endif; ?>

		<h1 class="entry-title bigger"><?php the_title(); ?></h1>
        <div class="entry-meta">
			<?php writter_entry_meta(); ?>
			<?php edit_post_link( __( 'Edit', 'writter' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->
		
	</header><!-- .entry-header -->


    <div class="entry-content bigger">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'writter' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
    
    <?php if( function_exists('zilla_share') || function_exists('zilla_likes') ) : ?>
    <footer class="entry-footer-meta<?php if( ! is_single() ) echo " entry-footer-meta-border"; ?>">
		<?php if( function_exists('zilla_share') ) : ?>
                <div class="post-shares">
                    <?php zilla_share(); ?>
                </div><!-- .post-shares -->
            <?php endif; // function_exists('zilla_share') ?>
            
            <?php if( function_exists('zilla_likes') ) : ?>
                <div class="post-likes">
                    <?php zilla_likes(); ?>
                </div><!-- .post-likes -->
            <?php endif; // function_exists('zilla_likes') ?>
	</footer><!-- .entry-footer-meta -->
    <?php endif; // .entry-footer-meta active ?>

</article><!-- #post-<?php the_ID(); ?> -->