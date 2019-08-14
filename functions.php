<?php
/**
 * JCU_Alumni functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package JCU_Alumni
 */
if (!session_id()) {
    session_start();
}
if (!function_exists('jcu_alumni_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function jcu_alumni_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on JCU_Alumni, use a find and replace
         * to change 'jcu_alumni' to the name of your theme in all the template files.
         */
        load_theme_textdomain('jcu_alumni', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        add_image_size('jcu_alumni-full-bleed', 2000, 1200, true);
        add_image_size('jcu_alumni-index-image', 800, 450, true);
        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => esc_html__('Header', 'jcu_alumni'),
            'social' => esc_html__('Social Media Menu', 'jcu_alumni'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('jcu_alumni_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo', array(
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        ));
    }
endif;
add_action('after_setup_theme', 'jcu_alumni_setup');

/**
 * creates font url from google, this way it is not language dependent.
 *
 * @return string $font_url as the font url from google
 */
function jcu_alumni_fonts_url()
{
    $fonts_url = '';

    /*
     * Translators: If there are characters in your language that are not
     * supported by Open Sans, translate this to 'off'. Do not translate
     * into your own language.
     */
    $open_sans = _x('on', 'Open Sans font: on or off', 'jcu_alumni');

    if ('off' !== $open_sans) {
        $font_families = array();

        $font_families[] = 'Open Sans:400,400i,700';

        $query_args = array(
            'family' => urlencode(implode('|', $font_families)),
            'subset' => urlencode('latin,latin-ext'),
        );

        $fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');
    }

    return esc_url_raw($fonts_url);
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since JCU Alumni 1.0
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function jcu_alumni_resource_hints($urls, $relation_type)
{
    if (wp_style_is('jcu_alumni-fonts', 'queue') && 'preconnect' === $relation_type) {
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin',
        );
    }

    return $urls;
}

add_filter('wp_resource_hints', 'jcu_alumni_resource_hints', 10, 2);

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function jcu_alumni_content_width()
{
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters('jcu_alumni_content_width', 640);
}

add_action('after_setup_theme', 'jcu_alumni_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function jcu_alumni_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'jcu_alumni'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'jcu_alumni'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Widget', 'jcu_alumni'),
        'id' => 'footer-1',
        'description' => esc_html__('Add footer widgets here.', 'jcu_alumni'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Page Sidebar', 'jcu_alumni'),
        'id' => 'sidebar-2',
        'description' => esc_html__('Add page widgets here.', 'jcu_alumni'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}

add_action('widgets_init', 'jcu_alumni_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function jcu_alumni_scripts()
{
    //Enqueue Google Fonts: Sourse Open Sans
    wp_enqueue_style('jcu_alumni-fonts', jcu_alumni_fonts_url());

    wp_enqueue_style('jcu_alumni-style', get_stylesheet_uri());

    wp_enqueue_style('jcu_alumni-bootstrap', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css');

    wp_enqueue_style('jcu_alumni-icons', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', '', '20191627');

    wp_enqueue_script('jcu_alumni-boostrap-js', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js', array('jquery'), '4.3.1', true);

    wp_enqueue_script('jcu_alumni-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20151215', true);

    wp_enqueue_script('jcu_alumni-functions', get_template_directory_uri() . '/js/functions.js', array('jquery'), '20190709', true);

    wp_enqueue_script('jcu_alumni-map-widget', get_template_directory_uri() . '/js/map-widget.js', array('jquery'), '20190731', true);

    wp_localize_script('jcu_alumni-navigation', 'jcu_alumniScreenReaderText', array(
        'expand' => __('Expand child menu', 'jcu_alumni'),
        'collapse' => __('Collapse child menu', 'jcu_alumni'),
    ));

    wp_enqueue_script('jcu_alumni-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'jcu_alumni_scripts');

/**
 * SVG Icons class.
 */
require get_template_directory() . '/classes/class-jcu_alumni-svg-icons.php';

/**
 * Implement the Custom Header feature.
 */

require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load SVG icon functions.
 */
require get_template_directory() . '/inc/icon-functions.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @origin Twenty Seventeen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array $size Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function jcu_alumni_content_image_sizes_attr($sizes, $size)
{
    $width = $size[0];

    if (900 <= $width) {
        $sizes = '(min-width: 900px) 700px, 900px';
    }

    if (is_active_sidebar('sidebar-1') || is_active_sidebar('sidebar-2')) {
        $sizes = '(min-width: 900px) 600px, 900px';
    }

    return $sizes;
}

add_filter('wp_calculate_image_sizes', 'jcu_alumni_content_image_sizes_attr', 10, 2);

/**
 * Filter the `sizes` value in the header image markup.
 *
 * @origin Twenty Seventeen 1.0
 *
 * @param string $html The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array $attr Array of the attributes for the image tag.
 * @return string The filtered header image HTML.
 */
function jcu_alumni_header_image_tag($html, $header, $attr)
{
    if (isset($attr['sizes'])) {
        $html = str_replace($attr['sizes'], '100vw', $html);
    }
    return $html;
}

add_filter('get_header_image_tag', 'jcu_alumni_header_image_tag', 10, 3);

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @origin Twenty Seventeen 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function jcu_alumni_post_thumbnail_sizes_attr($attr, $attachment, $size)
{

    if (!is_singular()) {
        if (is_active_sidebar('sidebar-1')) {
            $attr['sizes'] = '(max-width: 900px) 90vw, 800px';
        } else {
            $attr['sizes'] = '(max-width: 1000px) 90vw, 1000px';
        }
    } else {
        $attr['sizes'] = '100vw';
    }

    return $attr;
}

add_filter('wp_get_attachment_image_attributes', 'jcu_alumni_post_thumbnail_sizes_attr', 10, 3);

function handle_shortcode()
{
    $shortcode_num = $_REQUEST['shortcode_number'];
    $shortcode = "height=600&width=100%&map_cat=$shortcode_num";
    echo GeoMashup::map($shortcode);
    exit;
}

add_action('wp_ajax_nopriv_handle_shortcode', 'handle_shortcode');
add_action('wp_ajax_handle_shortcode', 'handle_shortcode');


/**
 * Add a header on top of the image and URL fields to linked page
 *
 * @param $form_fields array, fields to include in attachment form
 * @param $post object, attachment record in database
 * @return $form_fields, modified form fields
 */

function be_attachment_field_credit($form_fields, $post)
{
    $form_fields['be-image-header'] = array(
        'label' => 'Image Header',
        'input' => 'text',
        'value' => get_post_meta($post->ID, 'be-image-header', true),
        'helps' => 'If provided, Will display on top of header image',
    );

    $form_fields['be-page-url'] = array(
        'label' => 'Page URL',
        'input' => 'text',
        'value' => get_post_meta($post->ID, 'be_photographer_url', true),
        'helps' => 'Add Link to intended page as header image',
    );

    return $form_fields;
}

add_filter('attachment_fields_to_edit', 'be_attachment_field_credit', 10, 2);

/**
 * Save values of Photographer Name and URL in media uploader
 *
 * @param $post array, the post data for database
 * @param $attachment array, attachment fields from $_POST form
 * @return $post array, modified post data
 */

function be_attachment_field_credit_save($post, $attachment)
{
    if (isset($attachment['be-image-header']))
        update_post_meta($post['ID'], 'be_image_header', $attachment['be-image-header']);

    if (isset($attachment['be-page-url']))
        update_post_meta($post['ID'], 'be_page_url', esc_url($attachment['be-page-url']));

    return $post;
}

add_filter('attachment_fields_to_save', 'be_attachment_field_credit_save', 10, 2);
