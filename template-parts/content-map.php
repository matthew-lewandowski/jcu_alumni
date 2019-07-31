<?php
/**
 * Template part for displaying the map post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package JCU_Alumni
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php
        if (is_singular()) :
            the_title('<h1 class="entry-title">', '</h1>');
        else :
            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
        endif;

        if (is_active_sidebar('map-1')) :
            ?>
        <?php endif; ?>
    </header><!-- .entry-header -->

    <section class="post-content">
        <?php
        if (!is_active_sidebar('map-1')) : ?>
        <div class="post-content__wrap">
            <aside id="page-secondary" class="widget-area page-sidebar">
                <div id="map-side">
                    <?php

                    function hierarchical_category_tree($cat)
                    {
                        // wpse-41548 // alchymyth // a hierarchical list of all categories //

                        $next = get_categories('hide_empty=false&orderby=name&order=ASC&parent=' . $cat);

                        if ($next) :
                            foreach ($next as $cat) :
                                echo '<ul><li><a href="#">' . $cat->name . '</a>';
//                                echo '<ul><li onclick="function map() {
//
//}" ' . $cat->name . '</ul></li>';
                                hierarchical_category_tree($cat->term_id);
                            endforeach;
                        endif;

                        echo '</li></ul>';
                        echo "\n";
                    }

                    hierarchical_category_tree(0); // the function call; 0 for all categories; or cat ID
                    ?>
                </div><!-- #map-side -->
            </aside><!-- #secondary -->
            <div class="post-content__body">
                <?php endif; ?>

                <div class="entry-content">
                    <?php
                    the_content(sprintf(
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
                    ));
                    generate_map();
                    ?>
                </div><!-- .entry-content -->
                <footer class="entry-footer">
                    <?php jcu_alumni_entry_footer(); ?>
                </footer><!-- .entry-footer -->

                <?php
                if (!is_active_sidebar('map-1')) : ?>
            </div><!-- .post-content__body -->
        </div><!-- .post-content__wrap -->
    <?php endif; ?>
    </section><!-- #post content -->
</article><!-- #post-<?php the_ID(); ?> -->
