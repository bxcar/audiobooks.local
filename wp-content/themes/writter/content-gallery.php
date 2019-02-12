<?php
/**
 * The template for displaying posts in the Gallery post format
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
	<header class="entry-header gallery-post">
		<?php
			$args = array(
				'post_type' => 'attachment',
				'numberposts' => -1,
				'post_status' => null,
				'post_mime_type'   => 'image',
				'post_parent' =>  $post->ID
			);		
			$attachments = get_posts( $args );
			if( $attachments ) : ?>
            <div class="entry-thumbnail gallery-slider" id="gallery-post-<?php the_ID(); ?>">
                <ul class="slides">
                    <?php foreach( $attachments as $attachment ) : ?>
                    <li><?php echo wp_get_attachment_image( $attachment->ID, 'full' ); ?></li>
                    <?php endforeach; ?>	
                </ul>
            </div>
            <?php else : ?>
            	<p class="no-images">No images found.</p>
            <?php endif; ?>
            
            <?php if ( ! is_single() ) : ?>
                <h1 class="entry-title">
                    <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                </h1>
            <?php endif; ?>
            <?php if ( is_single() ) : ?>
            	<?php the_post_thumbnail(); ?>
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
        <?php if ( is_single() ) : ?>
        	<p><?php echo wp_trim_excerpt(); ?></p>
		<?php endif; ?>
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

<script>
jQuery(document).ready(function() {
    jQuery('#gallery-post-<?php the_ID(); ?>').flexslider({
		animation: "fade",
		directionNav: false,
		animationLoop: true,
		slideshowSpeed: 5000,
		controlNav: true, 
		slideToStart: 1,
		slideshow: true,
		useCSS: true, 
		touch: true,  
		animationDuration: 300,
		start: function(){
			jQuery('#gallery-post-<?php the_ID(); ?>').animate({opacity: 1}, 750);
		}
	});
});
</script>