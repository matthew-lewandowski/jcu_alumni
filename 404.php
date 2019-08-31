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
                <header class="archive-header">
                    <div class="search-container">
                        <div class="search_inner">
                            <div class="search_text no_results">
                                <h5>No Results found for</h5>
                            </div>
                            <?php get_search_form(); ?>
                        </div>
                    </div>
                </header><!-- .archive-header -->

				<div class="page-content">

					<?php
					the_widget( 'WP_Widget_Recent_Posts' );
					?>

					<?php
					/* translators: %1$s: smiley */
					$jcu_alumni_archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives', 'jcu_alumni' ) ) . '</p>';
					the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$jcu_alumni_archive_content" );

					the_widget( 'WP_Widget_Tag_Cloud' );
					?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
