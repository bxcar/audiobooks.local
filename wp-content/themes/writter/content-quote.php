<?php
/**
 * The template for displaying posts in the Quote post format
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
    <header class="entry-header <?php if ( ! is_single() ) echo "quote-post"; ?>">
    <?php if ( ! is_single() ) : ?>
		 <?php the_content('',FALSE,''); ?>
    <?php endif; ?>
    <?php if ( is_single() ) : ?>
    	<h1 class="entry-title bigger"><?php the_title(); ?></h1>
        <div class="entry-meta">
			<?php writter_entry_meta(); ?>
			<?php edit_post_link( __( 'Edit', 'writter' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->
    <?php endif; ?>
	</header><!-- .entry-header -->


	<div class="entry-content <?php if ( is_single() ) echo "bigger"; ?>">
		<?php $post_description = esc_html( get_post_meta( $post->ID, 'post-description', true ) ); ?>
		<?php if ( $post_description && $post_description != '' ) :  ?>
			<div class="entry-post-description"><?php echo $post_description ?></div>	
        <?php endif; ?>		
        <?php if ( is_single() ) the_content(); ?>
	</div><!-- .entry-content -->
        
    <?php if( ( ! is_single() && ( comments_open() || function_exists('zilla_likes') ) ) || ( is_single() && ( function_exists('zilla_share') || function_exists('zilla_likes') ) ) ) : ?>
    <footer class="entry-footer-meta">
    	<?php if ( ! is_single() ) : ?>
			<?php if ( comments_open() ) : ?>
                <div class="comments-link">
                    <?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'writter' ) . '</span>', __( 'One reply', 'writter' ), __( '% replies', 'writter' ) ); ?>
                </div><!-- .comments-link -->
            <?php endif; // comments_open() ?>
            
            <?php if( function_exists('zilla_likes') ) : ?>
                <div class="post-likes">
                    <?php zilla_likes(); ?>
                </div><!-- .post-likes -->
            <?php endif; // function_exists('zilla_likes') ?>
		<?php endif; // ! is_single() ?>
        
        <?php if ( is_single() ) : ?>
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
            
        <?php endif; // is_single() ?>
	</footer><!-- .entry-footer-meta -->
    <?php endif; // .entry-footer-meta ?>
    
    <?php if ( is_single() && get_the_author_meta( 'description' ) ) : ?>
		<?php get_template_part( 'author-bio' ); ?>
	<?php endif; // author-bio ?>
</article><!-- #post -->