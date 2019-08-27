<?php
function ajax_search() {
    // Get search term from search field
    $search = sanitize_text_field( $_POST[ 'query' ] );

    // Set up query using search string, limit to 8 results
    $query = new WP_Query(
        array(
            'posts_per_page' => 8,
            's' => $search
        )
    );

    $output = '';

    // Run search query
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) : $query->the_post();

            /* Output a link to each result
               This is where the post thumbnail, excerpt, or anything else could be added */
            echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>';

        endwhile;

        // If there is more than one page of results, add link to the full results page
        if ( $query->max_num_pages > 1 ) {
            // We use urlencode() here to handle any spaces or odd characters in the search string
            echo '<a class="see-all-results" href="' . get_site_url() . '?s=' . urlencode( $search ) . '">View all results</a>';
        }

    } else {

        // There are no results, output a message
        echo '<p class="no-results">No results</p>';

    }

    // Reset query
    wp_reset_query();

    die();
}

/* We need to hook into both wp_ajax and wp_ajax_nopriv_ in order for
   the search to work for both logged in and logged out users. */
add_action( 'wp_ajax_ajax_search', 'ajax_search' );
add_action( 'wp_ajax_nopriv_ajax_search', 'ajax_search' );