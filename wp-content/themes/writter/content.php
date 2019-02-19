<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Writter
 * @since Writter 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if (is_sticky() && is_home() && !is_paged()) : ?>
        <div class="featured-post-wrapper">
            <div class="featured-post">HOT</div>
        </div>
    <?php endif; ?>
    <header class="entry-header">
        <?php if (has_post_thumbnail() && !post_password_required()) : ?>
            <?php if (is_single()) : ?>
                <div class="entry-thumbnail">
                    <?php //the_post_thumbnail(); ?>
                </div>
            <?php else : ?>
                <a href="<?php the_permalink() ?>" style="/*position: relative;*/">
                    <div class="entry-thumbnail">
                        <?php the_post_thumbnail(); ?>
                    </div>
                    <div class="short-book-desc">
                        <?= get_the_content(); ?>
                    </div>
                </a>
            <?php endif; ?>
        <?php endif; ?>

        <?php if (is_single()) : ?>
            <div class="playlist-single sm2-bar-ui playlist-open full-width"
                 style="margin-top: 20px; max-width: 420px; display: none;">

                <div class="bd sm2-main-controls">

                    <div class="sm2-inline-texture"></div>
                    <div class="sm2-inline-gradient"></div>

                    <div class="sm2-inline-element sm2-button-element">
                        <div class="sm2-button-bd">
                            <a href="#play" class="sm2-inline-button sm2-icon-play-pause">Play / pause</a>
                        </div>
                    </div>

                    <div class="sm2-inline-element sm2-inline-status">

                        <div class="sm2-playlist">
                            <div class="sm2-playlist-target">
                                <ul class="sm2-playlist-bd">
                                    <li><b>SonReal</b> - LA<span class="label">Explicit</span></li>
                                </ul>
                            </div>
                        </div>

                        <div class="sm2-progress">
                            <div class="sm2-row">
                                <div class="sm2-inline-time">0:00</div>
                                <div class="sm2-progress-bd">
                                    <div class="sm2-progress-track">
                                        <div class="sm2-progress-bar"></div>
                                        <div class="sm2-progress-ball">
                                            <div class="icon-overlay"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="sm2-inline-duration">0:00</div>
                            </div>
                        </div>

                    </div>

                    <div class="sm2-inline-element sm2-button-element sm2-volume">
                        <div class="sm2-button-bd">
                            <span class="sm2-inline-button sm2-volume-control volume-shade"></span>
                            <a href="#volume" class="sm2-inline-button sm2-volume-control">volume</a>
                        </div>
                    </div>

                    <div class="sm2-inline-element sm2-button-element">
                        <div class="sm2-button-bd">
                            <a href="#prev" title="Previous" class="sm2-inline-button sm2-icon-previous">&lt;
                                previous</a>
                        </div>
                    </div>

                    <div class="sm2-inline-element sm2-button-element">
                        <div class="sm2-button-bd">
                            <a href="#next" title="Next" class="sm2-inline-button sm2-icon-next">&gt; next</a>
                        </div>
                    </div>

                    <div class="sm2-inline-element sm2-button-element sm2-menu">
                        <div class="sm2-button-bd">
                            <a href="#menu" class="sm2-inline-button sm2-icon-menu">menu</a>
                        </div>
                    </div>

                </div>

                <div class="bd sm2-playlist-drawer sm2-element" style="height: 147px;">

                    <div class="sm2-inline-texture">
                        <div class="sm2-box-shadow"></div>
                    </div>

                    <!-- playlist content is mirrored here -->

                    <div class="sm2-playlist-wrapper">

                        <ul class="sm2-playlist-bd">

                            <!-- item with "download" link -->
                            <li class="selected">
                                <!--<div class="sm2-row">
                                    <div class="sm2-col sm2-wide">
                                        <a href=""><b>SonReal</b> - LA</a>
                                    </div>
                                    <div class="sm2-col">
                                        <a href="" target="_blank"
                                           title="Download &quot;LA&quot;" class="sm2-icon sm2-music sm2-exclude">Download
                                            this track</a>
                                    </div>
                                </div>-->
                            </li>

                            <!-- standard one-line items -->
                            <?php if (get_field('audio_list')) {
                                foreach (get_field('audio_list') as $item) { ?>
                                    <li><a href="<?= $item['file']['url']; ?>"><?= $item['file']['title']; ?></a></li>
                                <?php }
                            } ?>
                        </ul>

                    </div>

                    <div class="sm2-extra-controls">

                        <div class="bd">

                            <div class="sm2-inline-element sm2-button-element">
                                <a href="#prev" title="Previous" class="sm2-inline-button sm2-icon-previous">&lt;
                                    previous</a>
                            </div>

                            <div class="sm2-inline-element sm2-button-element">
                                <a href="#next" title="Next" class="sm2-inline-button sm2-icon-next">&gt; next</a>
                            </div>

                            <!-- not implemented -->
                            <!--
                            <div class="sm2-inline-element sm2-button-element disabled">
                             <div class="sm2-button-bd">
                              <a href="#repeat" title="Repeat playlist" class="sm2-inline-button sm2-icon-repeat">&infin; repeat</a>
                             </div>
                            </div>

                            <div class="sm2-inline-element sm2-button-element disabled">
                             <a href="#shuffle" title="Shuffle" class="sm2-inline-button sm2-icon-shuffle">shuffle</a>
                            </div>
                            -->

                        </div>

                    </div>

                </div>

            </div>

            <!--<div id="player332"></div>

            <script>
                var player = new Playerjs({id:"player332", file:"<? /*= get_field('audio_list')[0]['file']['url']; */ ?>"});
            </script>-->

        <div id="player332" class="player-pljs"></div>
            <script>
                var player = new Playerjs({
                    id: "player332",
                    file: [
                        <?php foreach (get_field('audio_list') as $item) { ?>
                        {"title": "<?= $item['file']['title'] ?>", "file": "<?= $item['file']['url'] ?>"},
                        <?php } ?>
                    ],
                    poster: "<?= get_the_post_thumbnail_url(); ?>",
                });
            </script>
            <h1 class="entry-title bigger"><?php the_title(); ?></h1>
            <div class="entry-meta">
                <?php writter_entry_meta(); ?>
                <?php edit_post_link(__('Edit', 'writter'), '<span class="edit-link">', '</span>'); ?>
            </div><!-- .entry-meta -->
        <?php else : ?>
            <div id="player<?php the_ID(); ?><?=  $GLOBALS['ident'] ?>" class="player-pljs"></div>
            <script>
                var player = new Playerjs({
                    id: "player<?php the_ID(); ?><?= $GLOBALS['ident'] ?>",
                    file: [
                        {"title": "<?= get_field('audio_list')[0]['file']['title']; ?>", "file": "<?= get_field('audio_list')[0]['file']['url']; ?>"},
                    ],
                    poster: "<?= get_the_post_thumbnail_url(); ?>",
                });
            </script>
            <div class="sm2-bar-ui compact full-width"
                 style="position: absolute; top: 0; left: 0; width: 44px; margin-top: 0; display: none;">

                <div class="bd sm2-main-controls">

                    <div class="sm2-inline-texture"></div>
                    <div class="sm2-inline-gradient"></div>

                    <div class="sm2-inline-element sm2-button-element">
                        <div class="sm2-button-bd">
                            <a href="#play" class="sm2-inline-button sm2-icon-play-pause">Play / pause</a>
                        </div>
                    </div>

                    <div class="sm2-inline-element sm2-inline-status">

                        <div class="sm2-playlist" style="display: none;">
                            <div class="sm2-playlist-target">
                                <ul class="sm2-playlist-bd">
                                    <li><b>Adrian Glynn</b> - Seven Or Eight Days</li>
                                </ul>
                            </div>
                        </div>

                        <div class="sm2-progress">
                            <div class="sm2-row">
                                <div class="sm2-inline-time">0:00</div>
                                <div class="sm2-progress-bd">
                                    <div class="sm2-progress-track">
                                        <div class="sm2-progress-bar"></div>
                                        <div class="sm2-progress-ball">
                                            <div class="icon-overlay"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="sm2-inline-duration">0:00</div>
                            </div>
                        </div>

                    </div>

                    <div class="sm2-inline-element sm2-button-element sm2-volume">
                        <div class="sm2-button-bd">
                            <span class="sm2-inline-button sm2-volume-control volume-shade"></span>
                            <a href="#volume" class="sm2-inline-button sm2-volume-control">volume</a>
                        </div>
                    </div>

                </div>

                <div class="bd sm2-playlist-drawer sm2-element">

                    <div class="sm2-inline-texture">
                        <div class="sm2-box-shadow"></div>
                    </div>

                    <!-- playlist content is mirrored here -->

                    <div class="sm2-playlist-wrapper">
                        <ul class="sm2-playlist-bd">
                            <li class="selected">
                                <?php if (get_field('audio_list')) { ?>
                                    <a href="<?= get_field('audio_list')[0]['file']['url']; ?>"></a>
                                <?php } ?>
                            </li>
                        </ul>
                    </div>

                </div>

            </div>
            <h1 class="entry-title">
                <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
            </h1>

            <!--<audio id="aSound" class="audio-player" controls>
                <source src="<?php /*the_field("audio_f") */ ?>">
            </audio>-->
            <!--<div class="entry-meta">
                <?php /*writter_entry_meta(); */ ?>
            </div>--><!-- .entry-meta -->
        <?php endif; // is_single() ?>

    </header><!-- .entry-header -->

    <?php if (is_search()) : // Only display Excerpts for Search ?>
        <div class="entry-content">
            <?php the_excerpt(); ?>
        </div><!-- .entry-conten -->
    <?php else : ?>
        <div class="entry-content <?php if (is_single()) echo "bigger"; ?>">
            <?php the_content('', FALSE, ''); ?>
        </div><!-- .entry-content -->
    <?php endif; ?>

    <?php if ((!is_single() && (comments_open() || function_exists('zilla_likes'))) || (is_single() && (function_exists('zilla_share') || function_exists('zilla_likes')))) : ?>
        <footer class="entry-footer-meta<?php if (!is_single()) echo " entry-footer-meta-border"; ?>">
            <?php if (!is_single()) : ?>
                <?php if (comments_open()) : ?>
                    <!--<div class="comments-link">
                        <?php /*comments_popup_link('<span class="leave-reply">' . __('Leave a reply', 'writter') . '</span>', __('One reply', 'writter'), __('% replies', 'writter')); */ ?>
                    </div>--><!-- .comments-link -->
                <?php endif; // comments_open() ?>

                <?php if (function_exists('zilla_likes')) : ?>
                    <div class="post-likes">
                        <?php zilla_likes(); ?>
                    </div><!-- .post-likes -->
                <?php endif; // function_exists('zilla_likes') ?>
            <?php endif; // ! is_single() ?>

            <?php if (is_single()) : ?>
                <?php if (function_exists('zilla_share')) : ?>
                    <div class="post-shares">
                        <?php zilla_share(); ?>
                    </div><!-- .post-shares -->
                <?php endif; // function_exists('zilla_share') ?>

                <?php if (function_exists('zilla_likes')) : ?>
                    <div class="post-likes">
                        <?php zilla_likes(); ?>
                    </div><!-- .post-likes -->
                <?php endif; // function_exists('zilla_likes') ?>


            <?php endif; // is_single() ?>
        </footer><!-- .entry-footer-meta -->
    <?php endif; // .entry-footer-meta active ?>

    <?php if (is_single() && get_the_author_meta('description')) : ?>
        <?php get_template_part('author-bio'); ?>
    <?php endif; // author-bio ?>
    <?php wp_link_pages(array('before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'writter') . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>')); ?>
</article><!-- #post -->
