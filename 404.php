<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package JCU_Alumni
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="error-404 not-found">
                <div class="no-results-title">
                    <p><?php esc_html_e('Error 404. It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'jcu_alumni'); ?></p>
                </div><!--.no-results-title-->
                <header class="archive-header">
                    <div class="search-container">
                        <div class="search_inner">
                            <div class="search_text no_results">
                                <h5>Search for</h5>
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
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
