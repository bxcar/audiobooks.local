<?php
/**
 * Writter theme functions and definitions.
 *
 * @package Writter
 * @since 1.0
 */





/************************************************************************************/
/* Declarations and Definitions */
/************************************************************************************/

// Define basic variables
define("THEMEROOT", get_template_directory_uri());
define("IMAGEDIR", get_template_directory_uri() . '/images');
define("JSDIR", get_template_directory_uri() . '/js');
define("CSSDIR", get_template_directory_uri() . '/css');

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) $content_width = 646; // pixels, at 1000px wide





/************************************************************************************/
/* After Setup Theme Actions */
/************************************************************************************/

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since 1.0
 */
function writter_setup() {
	
	// Make theme available for translation. Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'writter', THEMEROOT . '/languages' );
	$locale = get_locale();
    $locale_file = THEMEROOT . '/languages/$locale.php';
    if ( is_readable( $locale_file ) ) require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'main-navigation', __( 'Navigation Menu', 'writter' ) );
	
	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );
	
	// This theme supports featured images
	add_theme_support( 'post-thumbnails' );
	
	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'video', 'audio', 'gallery' ) ); // array( 'aside', 'image', 'link', 'quote', 'status' ) );
	
	// Add support for custom background
	add_theme_support( 'custom-background', array(
		'default-color' => 'f6f6f6',
	) );
	
	// Add support for Jetpack's Featured Content
	add_theme_support( 'featured-content', array(
		'featured_content_filter' => 'debut_featured_content',
	) );

}
add_action( 'after_setup_theme', 'writter_setup' );





/************************************************************************************/
/* Create Custom Title Template */
/************************************************************************************/

/**
 * Creates a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Writter 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function writter_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentythirteen' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'writter_wp_title', 10, 2 );





/************************************************************************************/
/* Add Meta Boxes to the Posts */
/************************************************************************************/
add_action( 'admin_init', 'writter_add_meta_box' );
function writter_add_meta_box()
{
	add_meta_box(
		'post-description',
		'Post Description',
		'writter_display_meta_box',
		'post',
		'side'
	);
}

function writter_display_meta_box( $post ) {
	$post_decription = get_post_meta($post->ID, 'post-description', true);
    wp_nonce_field('post-description-nonce', 'description-nonce');
    
?>
    <p>
	    <label for="post-description">Description Text</label>
	    <textarea name="post-description" id="post-description" class="widefat"><?php echo $post_decription ?></textarea>
    </p>
<?php 
}

add_action('save_post', 'writter_save_post_description');
function writter_save_post_description( $post_id )
{
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return;	
	
	if( ! isset( $_POST['description-nonce'] ) || ! wp_verify_nonce( $_POST['description-nonce'], 'post-description-nonce' ) )
		return;
		
	if( isset( $_POST['post-description'] ) )
	{
		update_post_meta( $post_id, 'post-description', esc_html( $_POST['post-description'] ) );
	}
}





/************************************************************************************/
/* Create Custom Function for Showing Post Meta */
/************************************************************************************/
if ( ! function_exists( 'writter_entry_meta' ) ) :
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * @since Writter 1.0
 * @return void
 */
function writter_entry_meta() {

	if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
		writter_entry_date();
		
	if ( is_single() || is_page() ) :

		// Translators: used between list items, there is a space after the comma.
		$categories_list = get_the_category_list( __( ', ', 'writter' ) );
		if ( $categories_list ) {
			echo '<span class="categories-links">In ' . $categories_list . '</span>';
		}
	
		// Translators: used between list items, there is a space after the comma.
		$tag_list = get_the_tag_list( '', __( ', ', 'writter' ) );
		if ( $tag_list ) {
			echo '<span class="tags-links">' . $tag_list . '</span>';
		}
	
		// Post author
		if ( 'post' == get_post_type() ) {
			printf( '<span class="author">By <a href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_attr( sprintf( __( 'View all posts by %s', 'writter' ), get_the_author() ) ),
				get_the_author()
			);
		}
	endif;
}
endif;





/************************************************************************************/
/* Create Custom Function for Showing Post Date */
/************************************************************************************/
if ( ! function_exists( 'writter_entry_date' ) ) :
/**
 * Prints HTML with date information for current post.
 *
 * @since Writter 1.0
 * @param boolean $echo Whether to echo the date. Default true.
 * @return string The HTML-formatted post date.
 */
function writter_entry_date( $echo = true ) {

	$date = sprintf( '<span class="date">Posted on <time class="entry-date" datetime="%1$s">%2$s</time></a></span>',
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);
	if ( $echo )
		echo $date;

	return $date;
}
endif;






/************************************************************************************/
/* Register Widget Areas */
/************************************************************************************/
/**
 * Registers widget areas.
 *
 * @since Writter 1.0
 * @return void
 */
function writter_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Main Widget Area', 'writter' ),
		'id'            => 'main-sidebar',
		'description'   => __( 'Always appears on the left side of the screen.', 'writter' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="sidebar-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'writter_widgets_init' );





/************************************************************************************/
/* Extend <body> class */
/************************************************************************************/
/**
 * Extends the default WordPress body classes.
 *
 * @since Writter 1.0
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function writter_body_class( $classes ) {

	if ( ! is_active_sidebar( 'secondary-sidebar' ) )
		$classes[] = 'no-sidebar';

	if ( ! get_option( 'show_avatars' ) )
		$classes[] = 'no-avatars';
		
	if ( is_single() || is_page() || is_404() || ! have_posts()  )
		$classes[] = 'single';
		
	if( is_admin_bar_showing() )
		$classes[] = 'admin-bar-active';
		
	if( ! is_active_widget( false, false, 'search' ) )
		$classes[] = 'no-search-widget';

	return $classes;
}
add_filter( 'body_class', 'writter_body_class' );





/************************************************************************************/
/* Custom Comment Template */
/************************************************************************************/
if ( ! function_exists( 'writter_comment' ) ) :
/**
 * Customized comments template
 *
 * @since Writter 1.0
 * @return string
 */
function writter_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
?>
	<li <?php comment_class(); ?> id="li-comment-<?php 	comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>">
			<div class="comment-author vcard">
				<?php echo get_avatar($comment, $size = '60' ); ?>
				<?php printf(__('<span class="comment-author-title">%s says:</span>'), get_comment_author_link() ) ?>
			</div>
			<?php if ($comment->comment_approved == '0') : ?>
				<em><?php _e('Your comment is awaiting moderation.', 'writter') ?></em>
				<br />
			<?php endif; ?>
		
			<div class="comment-meta commentmetadata">
				<?php printf(__('%1$s at %2$s - ', 'writter'), get_comment_date(),  get_comment_time()) ?>
				<?php edit_comment_link(__('Edit', 'writter'),'  ',' |') ?>
                <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
			</div>

			<?php comment_text() ?>
            
		</div>
<?php
}
endif;





/************************************************************************************/
/* Returns Author Posts Link */
/************************************************************************************/
if ( ! function_exists( 'writter_author_posts_link' ) ) :
/**
 * Prints HTML with author posts link. Used in author-bio.php
 *
 * @since Writter 1.0
 * @return string
 */
function writter_author_posts_link( $echo = false ) {
	if ( is_single() )
	$string = '<a class="author-link" href="'. esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'" rel="author">'.get_the_author().'</a>';
	if ( $echo == true )
		echo $string;
	else return $string;

}
endif;





/************************************************************************************/
/* Enqueue Scripts and Styles */
/************************************************************************************/
/**
 * Enqueues scripts and styles for front end.
 *
 * @since Writter 1.0
 * @return void
 */
function writter_scripts_styles() {
	
	// Enhanced Comment Display
	if ( is_singular() )
		wp_enqueue_script( "comment-reply" );
	
	// Loads jQuery
	wp_enqueue_script( 'jquery', true );
	
	// Loads Masonry
	wp_enqueue_script( 'jquery-masonry-3', JSDIR . '/masonry.pkgd.min.js', array( 'jquery' ), '1.0', true );
	
	// Loads InfiniteScroll
	wp_enqueue_script( 'jquery-infinite-scroll', JSDIR . '/jquery.infinitescroll.min.js', array( 'jquery' ), '1.0', true );
	
	// Loads InfiniteScroll
	wp_enqueue_script( 'jquery-imagesloaded', JSDIR . '/jquery.imagesloaded.pkgd.min.js', array( 'jquery' ), '1.0', true );
	
	// Loads Perfect Scrollbar
	wp_enqueue_script( 'jquery-perfect-scrollbar', JSDIR . '/perfect-scrollbar.js', array( 'jquery' ), '1.0', true );
	
	// Loads jQuery Mousewheel library
	wp_enqueue_script( 'jquery-mousewheel', JSDIR . '/jquery.mousewheel.js', array( 'jquery' ), '1.0', true );
	
	// Loads jQuery FlexSlider
	wp_enqueue_script( 'jquery-flexslider', JSDIR . '/jquery.flexslider-min.js', array( 'jquery' ), '1.0', true );	
	
	// Loads our main scripts file
	wp_enqueue_script( 'writter-scripts', JSDIR . '/writter.main.js', array( 'jquery' ), '1.0', true );
	
	// Import Google font Source Sans Pro
	wp_enqueue_style( 'source-sans-pro', 'http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic', array(), '1.0' );
	
	// Loads CSS file for Perfect Scrollbar
	wp_enqueue_style( 'perfect-scrollbar-style', CSSDIR . '/perfect-scrollbar.css', array(), '1.0' );
	
	// Loads CSS file for FlexSlider
	wp_enqueue_style( 'flexslider-style', CSSDIR . '/flexslider.css', array(), '1.0' );
	
	// Loads our main stylesheet.
	wp_enqueue_style( 'writter-style', get_stylesheet_uri(), array(), '1.0' );
	
	// Loads our main stylesheet.
	wp_enqueue_style( 'writter-responsive-style', CSSDIR . '/writter-responsive.css', array(), '1.0' );
	
}
add_action( 'wp_enqueue_scripts', 'writter_scripts_styles' );

if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title' => 'Общие настройки сайта',
        'menu_title' => 'Общие настройки',
        'menu_slug' => 'theme-general-settings',
        'capability' => 'manage_options',
        'redirect' => true
    ));

    acf_add_options_sub_page(array(
        'page_title' => 'Настройки',
        'menu_title' => 'Настройки',
        'menu_slug' => 'header',
        'parent_slug' => 'theme-general-settings',
    ));
}
?>