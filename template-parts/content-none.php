<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package jcu_alumni
 */
?>
    <section id="primary" class="content-area <?php if (is_404()) {
        echo 'error-404';
    } else {
        echo 'no-results';
    } ?> not-found">
        <main id="main" class="site-main" role="main">

            <div class="no-results-title">
                <?php if (is_home() && current_user_can('publish_posts')) : ?>
                    <p><?php printf(wp_kses(__('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'jcu_alumni'), array('a' => array('href' => array()))), esc_url(admin_url('post-new.php'))); ?></p>

                <?php elseif (is_search()) : ?>
                    <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'jcu_alumni'); ?></p>


                <?php elseif (is_404()) : ?>

                    <p><?php esc_html_e('You seem to be lost. To find what you are looking for check out the most recent articles below or try a search:', 'jcu_alumni'); ?></p>

                <?php else : ?>

                    <p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'jcu_alumni'); ?></p>

                <?php endif; ?>
            </div><!-- .no-results-title -->
            <header class="archive-header">
                <div class="search-container">
                    <div class="search_inner">
                        <div class="search_text">
                            <h5>No Results for</h5>
                        </div>
                        <?php get_search_form(); ?>
                    </div>
                </div>
            </header><!-- .archive-header -->

            <?php
            if (is_404() || is_search()) {
                ?>
                <h2 class="page-title secondary-title"><?php esc_html_e('Most recent posts:', 'jcu_alumni'); ?></h2>
                <?php
                // Get the 6 latest posts
                $args = array(
                    'posts_per_page' => 6
                );
                $latest_posts_query = new WP_Query($args);
                // The Loop
                if ($latest_posts_query->have_posts()) {
                    ?> <div class="archive__wrap"> <?php
                    while ($latest_posts_query->have_posts()) {
                        $latest_posts_query->the_post();
                        // Get the standard index page content
                        get_template_part('template-parts/content', get_post_format());
                    }
                } ?>
                </div><!-- .archive__wrap -->
                <?php
                /* Restore original Post Data */
                wp_reset_postdata();
            } // endif
            ?>


        </main><!-- #main -->
    </section><!-- #primary -->

<?php
get_sidebar();
get_footer();