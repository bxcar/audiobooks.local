<?php
/**
 * The template file for 404.
 *
 * @package WordPress
 * @subpackage Writter
 * @since Writter 1.0
 */

get_header();
?>

	<div id="content" class="site-content" role="main">
	
        <article id="404">
            <header class="entry-header">
                <h1 class="entry-title bigger"><?php _e( 'This isn\'t the page I was looking for.', 'writter' ); ?></h1>
            </header>
        
            <div class="entry-content bigger">
                <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching, or one of the links below, can help.', 'writter' ); ?></p>
        
        
                <?php the_widget( 'WP_Widget_Recent_Posts', array( 'number' => 10 ), array( 'widget_id' => '404' ) ); ?>
        
                <div class="widget">
                    <h2 class="widgettitle"><?php _e( 'Most Used Categories', 'writter' ); ?></h2>
                    <ul>
                        <?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
                    </ul>
                </div>
        
                <?php
                    /* translators: %1$s: smilie */
                    $archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'writter' ), convert_smilies( ':-)' ) ) . '</p>';
                    the_widget( 'WP_Widget_Archives', array('count' => 0 , 'dropdown' => 1 ), array( 'after_title' => '</h2>'.$archive_content ) );
                ?>
                <?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
            </div><!-- .entry-content -->
                
           <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'writter' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
        </article><!-- #post -->
	

	</div><!-- #content -->
        
<?php get_footer(); ?>