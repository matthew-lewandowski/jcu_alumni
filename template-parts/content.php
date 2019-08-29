<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package JCU_Alumni
 */

?>
<article id="post-<?php the_ID(); ?>" class="archive__inner" <?php post_class(); ?>>
    <div class="archive__title">
        <?php
        if (is_singular()) :
            the_title('<h1 class="entry-title">', '</h1>');
        else :
            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
        endif; ?>
    </div>
    <div class="post__content">
        <header class="entry-header-archive">
            <?php
            if (has_post_thumbnail()) { ?>
                <figure class="featured-image index-image">
                    <a href="<?php echo esc_url(get_permalink()) ?>" rel="bookmark">
                        <?php the_post_thumbnail(); ?>
                    </a>
                </figure><!-- .featured-image index-image -->

            <?php } ?>
        </header><!-- .entry-header -->

        <div class="entry-content">
            <?php
            add_filter('excerpt_length', 'wpdocs_custom_excerpt_length_fifty', 999);
            add_filter('excerpt_more', 'change_and_link_excerpt', 999);
            the_excerpt();
            ?>
        </div><!-- .entry-content -->

        <div class="continue-reading">
            <?php
            $read_more_link = sprintf(
                wp_kses(
                /* translators: %s: Name of current post. Only visible to screen readers */
                    __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'jcu_alumni'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                get_the_title()
            );
            ?>
            <a href="<?php echo esc_url(get_permalink()) ?>" rel="bookmark">
                <?php echo $read_more_link; ?>
            </a>
        </div><!-- .continue-reading -->
    </div><!-- .post__content -->
</article><!-- #post-<?php the_ID(); ?> -->