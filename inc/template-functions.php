<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package JCU_Alumni
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function jcu_alumni_body_classes($classes)
{
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
        $classes[] = 'archive-view';
    }
    // Adds a class if sidebar is active or not
    if (is_active_sidebar('sidebar-1')) {
        $classes[] = "has-sidebar";
    } else {
        $classes[] = "no-sidebar";
    }
    if (is_active_sidebar('sidebar-2')) {
        $classes[] = 'has-page-sidebar';
    }

    return $classes;
}

add_filter('body_class', 'jcu_alumni_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function jcu_alumni_pingback_header()
{
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}

add_action('wp_head', 'jcu_alumni_pingback_header');
