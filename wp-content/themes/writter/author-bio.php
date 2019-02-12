<?php
/**
 * The template for displaying Author bios.
 *
 * @package WordPress
 * @subpackage Writter
 * @since Writter 1.0
 */
?>

<div class="author-info">
	<h2 class="author-title"><?php printf( __( 'Few words about author %s', 'writter' ), writter_author_posts_link() ); ?></h2>
	<div class="author-avatar">
		<?php echo get_avatar( get_the_author_meta( 'user_email' ), 74 ); ?>
	</div><!-- .author-avatar -->
	<div class="author-description">
		<p class="author-bio">
			<?php the_author_meta( 'description' ); ?>
		</p>
	</div><!-- .author-description -->
</div><!-- .author-info -->