<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage Writter
 * @since Writter 1.0
 */

get_header();
?>
    <div class="section-title">
        <h2>Новинки</h2>
    </div>
	<div id="content" class="site-content" role="main">
		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>

			<div id="page-nav" style="visibility: hidden;">
                	<?php posts_nav_link();   ?>
            </div>
            
            <?php wp_reset_postdata(); ?>
            
            <script type="text/javascript">
				jQuery(document).ready(function() {
		
					 var $container = jQuery('#content').masonry();
					 // initialize Masonry after all images have loaded  
					 $container.imagesLoaded( function() {
					 	$container.masonry({
							itemSelector: '.post',
							isFitWidth: true,
							stamp: ".sticky"
						});
					 });

					 $container.infinitescroll({
						navSelector  : '#page-nav',    // selector for the paged navigation 
						nextSelector : '#page-nav a',  // selector for the NEXT link (to page 2)
						itemSelector : '.post',     // selector for all items you'll retrieve
						
						bufferPX: 20,
						animate      : true,  
						donetext     : "No more post to load, Jim" , 
						loading: {
							finishedMsg: '<div class="loading-message">No more posts to load.</div>',
							msgText: '<div class="loading-message">Loading older posts...</div>'
						  }
						},	
						
	
						function( newElements ) {
							var $newElems = jQuery( newElements ).css({ opacity: 0 });
							$newElems.imagesLoaded(function(){
								$newElems.fadeIn(); // fade in when ready
								$container.masonry( 'appended', $newElems );
							});

							jQuery('.gallery-slider').flexslider({
								animation: "fade",
								directionNav: false,
								animationLoop: false,
								controlNav: true, 
								slideToStart: 1,
								slideshow: true,
								useCSS: true, 
								touch: true,  
								animationDuration: 300,
								start: function(){
									jQuery('.gallery-slider').animate({opacity: 1}, 750);
								}
							});

						  }
					  );


				});
			</script>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

	</div><!-- #content -->

    <div class="section-title" style="margin-top: 10px;">
        <h2>Популярные</h2>
    </div>
    <div id="content2" class="site-content" role="main">
        <?php
        $args = array(
            'posts_per_page' => 10,
            'category_name' => 'popular'
        );

        $query = new WP_Query( $args );

        if (  $query->have_posts() ) : ?>

            <?php while (  $query->have_posts() ) :  $query->the_post(); ?>
                <?php get_template_part( 'content', get_post_format() ); ?>
            <?php endwhile; ?>

            <div id="page-nav" style="visibility: hidden;">
                <?php posts_nav_link();   ?>
            </div>

        <?php wp_reset_postdata(); ?>

            <script type="text/javascript">
                jQuery(document).ready(function() {

                    var $container = jQuery('#content2').masonry();
                    // initialize Masonry after all images have loaded
                    $container.imagesLoaded( function() {
                        $container.masonry({
                            itemSelector: '.post',
                            isFitWidth: true,
                            stamp: ".sticky"
                        });
                    });

                    $container.infinitescroll({
                            navSelector  : '#page-nav',    // selector for the paged navigation
                            nextSelector : '#page-nav a',  // selector for the NEXT link (to page 2)
                            itemSelector : '.post',     // selector for all items you'll retrieve

                            bufferPX: 20,
                            animate      : true,
                            donetext     : "No more post to load, Jim" ,
                            loading: {
                                finishedMsg: '<div class="loading-message">No more posts to load.</div>',
                                msgText: '<div class="loading-message">Loading older posts...</div>'
                            }
                        },


                        function( newElements ) {
                            var $newElems = jQuery( newElements ).css({ opacity: 0 });
                            $newElems.imagesLoaded(function(){
                                $newElems.fadeIn(); // fade in when ready
                                $container.masonry( 'appended', $newElems );
                            });

                            jQuery('.gallery-slider').flexslider({
                                animation: "fade",
                                directionNav: false,
                                animationLoop: false,
                                controlNav: true,
                                slideToStart: 1,
                                slideshow: true,
                                useCSS: true,
                                touch: true,
                                animationDuration: 300,
                                start: function(){
                                    jQuery('.gallery-slider').animate({opacity: 1}, 750);
                                }
                            });

                        }
                    );


                });
            </script>

        <?php else : ?>
            <?php get_template_part( 'content', 'none' ); ?>
        <?php endif; ?>

    </div><!-- #content -->
        
<?php get_footer(); ?>