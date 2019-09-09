<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package jcu_alumni
 */

get_header(); ?>

<?php
if (have_posts()) : ?>

    <header class="archive-header">
        <div class="search-container">
            <div class="search_inner">
                <div class="search_text">
                    <h5>Search Results for</h5>
                </div>
                <?php get_search_form(); ?>
            </div>
        </div>
    </header><!-- .archive-header -->

<?php
else :

    get_template_part('template-parts/content', 'none');
    return;

endif; ?>

    <section id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <div class="archive__wrap">
                <?php
                /* Start the Loop */
                /* checks if post type is post
                skips anything that is not. If pages ever need to be displayed this needs to be rewritten.
                */
                while (have_posts()) : the_post();
                    if (get_post_type() === 'post') {
                        get_template_part('template-parts/content');
                    } else {
                        continue;
                    }

                    /**
                     * Run the loop for the search to output the results.
                     * If you want to overload this in a child theme then include a file
                     * called content-search.php and that will be used instead.
                     */


                endwhile; ?>

            </div><!-- .archive__wrap -->
            <?php
            the_posts_pagination(array(
                'prev_text' => __('Newer', 'jcu_alumni'),
                'next_text' => __('Older', 'jcu_alumni'),
                'before_page_number' => '<span class="screen-reader-text">' . __('Page ', 'jcu_alumni') . '</span>',
            ));

            ?>
        </main><!-- #main -->
    </section><!-- #primary -->

<?php
get_sidebar();
get_footer();