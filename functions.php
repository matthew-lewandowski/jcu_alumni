<?php
/**
 * JCU_Alumni functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package JCU_Alumni
 */

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

    register_sidebar(array(
        'name' => esc_html__('Map Sidebar', 'jcu_alumni'),
        'id' => 'map-1',
        'description' => esc_html__('Add map widget here.', 'jcu_alumni'),
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

    wp_enqueue_style('jcu_alumni-icons', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', '', '20191627');

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

/**
 * A custom widget for the map
 */
class matts_Map_Widget extends WP_Widget
{
    /**
     * To create the map widget all four methods will be
     * nested inside this single instance of the WP_Widget class.
     **/

    public function __construct()
    {
        $widget_options = array(
            'classname' => 'widget_map',
            'description' => 'This is the map widget',
            'customize_selective_refresh' => true,
        );
        parent::__construct('map', 'Map Widget', $widget_options);
    }

    public function widget($args, $instance)
    {
        {
            static $first_dropdown = true;

            $title = !empty($instance['title']) ? $instance['title'] : __('Categories');

            /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
            $title = apply_filters('widget_title', $title, $instance, $this->id_base);

            $c = !empty($instance['count']) ? '1' : '0';
            $h = !empty($instance['hierarchical']) ? '1' : '0';
            $d = !empty($instance['dropdown']) ? '1' : '0';

            echo $args['before_widget'];

            if ($title) {
                echo $args['before_title'] . $title . $args['after_title'];
            }

            $cat_args = array(
                'orderby' => 'name',
                'show_count' => $c,
                'hierarchical' => $h,
            );

            if ($d) {
                echo sprintf('<form action="%s" method="get">', esc_url(home_url()));
                $dropdown_id = ($first_dropdown) ? 'cat' : "{$this->id_base}-dropdown-{$this->number}";
                $first_dropdown = false;

                echo '<label class="screen-reader-text" for="' . esc_attr($dropdown_id) . '">' . $title . '</label>';

                $cat_args['show_option_none'] = __('Select Category');
                $cat_args['id'] = $dropdown_id;

                /**
                 * Filters the arguments for the Categories widget drop-down.
                 *
                 * @since 2.8.0
                 * @since 4.9.0 Added the `$instance` parameter.
                 *
                 * @see wp_dropdown_categories()
                 *
                 * @param array $cat_args An array of Categories widget drop-down arguments.
                 * @param array $instance Array of settings for the current widget.
                 */
                wp_dropdown_categories(apply_filters('widget_categories_dropdown_args', $cat_args, $instance));

                echo '</form>';
                ?>

                <script type='text/javascript'>
                    /* <![CDATA[ */
                    (function () {
                        var dropdown = document.getElementById("<?php echo esc_js($dropdown_id); ?>");

                        function onCatChange() {
                            if (dropdown.options[dropdown.selectedIndex].value > 0) {
                                dropdown.parentNode.submit();
                            }
                        }

                        dropdown.onchange = onCatChange;
                    })();
                    /* ]]> */
                </script>

                <?php
            } else {
                ?>
                <ul id="map" class="map-widget-con">
                    <?php

                    $cat_args['title_li'] = '';
                    /**
                     * Filters the arguments for the Categories widget.
                     *
                     * @since 2.8.0
                     * @since 4.9.0 Added the `$instance` parameter.
                     *
                     * @param array $cat_args An array of Categories widget options.
                     * @param array $instance Array of settings for the current widget.
                     */
                    $this->wp_list_categories_matt(apply_filters('widget_categories_args', $cat_args, $instance));
                    foreach ((get_the_category()) as $category) {
                        echo $category->name . "<br>";
                    }
                    ?>
                </ul>
                <?php
            }

            echo $args['after_widget'];
        }
    }

    public function form($instance)
    {
        //Defaults
        $instance = wp_parse_args((array)$instance, array('title' => ''));
        $count = isset($instance['count']) ? (bool)$instance['count'] : false;
        $hierarchical = isset($instance['hierarchical']) ? (bool)$instance['hierarchical'] : false;
        $dropdown = isset($instance['dropdown']) ? (bool)$instance['dropdown'] : false;
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text"
                   value="<?php echo esc_attr($instance['title']); ?>"/></p>

        <p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('dropdown'); ?>"
                  name="<?php echo $this->get_field_name('dropdown'); ?>"<?php checked($dropdown); ?> />
            <label for="<?php echo $this->get_field_id('dropdown'); ?>"><?php _e('Display as dropdown'); ?></label><br/>

            <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('count'); ?>"
                   name="<?php echo $this->get_field_name('count'); ?>"<?php checked($count); ?> />
            <label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Show post counts'); ?></label><br/>

            <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('hierarchical'); ?>"
                   name="<?php echo $this->get_field_name('hierarchical'); ?>"<?php checked($hierarchical); ?> />
            <label for="<?php echo $this->get_field_id('hierarchical'); ?>"><?php _e('Show hierarchy'); ?></label></p>
        <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['count'] = !empty($new_instance['count']) ? 1 : 0;
        $instance['hierarchical'] = !empty($new_instance['hierarchical']) ? 1 : 0;
        $instance['dropdown'] = !empty($new_instance['dropdown']) ? 1 : 0;

        return $instance;
    }

    function wp_list_categories_matt($args = '')
    {
        $defaults = array(
            'child_of' => 0,
            'current_category' => 0,
            'depth' => 0,
            'echo' => 1,
            'exclude' => '',
            'exclude_tree' => '',
            'feed' => '',
            'feed_image' => '',
            'feed_type' => '',
            'hide_empty' => 1,
            'hide_title_if_empty' => false,
            'hierarchical' => true,
            'order' => 'ASC',
            'orderby' => 'name',
            'separator' => '<br />',
            'show_count' => 0,
            'show_option_all' => '',
            'show_option_none' => __('No categories'),
            'style' => 'list',
            'taxonomy' => 'category',
            'title_li' => __('Categories'),
            'use_desc_for_title' => 1,
        );

        $r = wp_parse_args($args, $defaults);

        if (!isset($r['pad_counts']) && $r['show_count'] && $r['hierarchical']) {
            $r['pad_counts'] = true;
        }

        // Descendants of exclusions should be excluded too.
        if (true == $r['hierarchical']) {
            $exclude_tree = array();

            if ($r['exclude_tree']) {
                $exclude_tree = array_merge($exclude_tree, wp_parse_id_list($r['exclude_tree']));
            }

            if ($r['exclude']) {
                $exclude_tree = array_merge($exclude_tree, wp_parse_id_list($r['exclude']));
            }

            $r['exclude_tree'] = $exclude_tree;
            $r['exclude'] = '';
        }

        if (!isset($r['class'])) {
            $r['class'] = ('category' == $r['taxonomy']) ? 'categories' : $r['taxonomy'];
        }

        if (!taxonomy_exists($r['taxonomy'])) {
            return false;
        }

        $show_option_all = $r['show_option_all'];
        $show_option_none = $r['show_option_none'];

        $categories = get_categories($r);

        $output = '';
        if ($r['title_li'] && 'list' == $r['style'] && (!empty($categories) || !$r['hide_title_if_empty'])) {
            $output = '<li class="' . esc_attr($r['class']) . '">' . $r['title_li'] . '<ul>';
        }
        if (empty($categories)) {
            if (!empty($show_option_none)) {
                if ('list' == $r['style']) {
                    $output .= '<li class="cat-item-none">' . $show_option_none . '</li>';
                } else {
                    $output .= $show_option_none;
                }
            }
        } else {
            if (!empty($show_option_all)) {

                $posts_page = '';

                // For taxonomies that belong only to custom post types, point to a valid archive.
                $taxonomy_object = get_taxonomy($r['taxonomy']);
                if (!in_array('post', $taxonomy_object->object_type) && !in_array('page', $taxonomy_object->object_type)) {
                    foreach ($taxonomy_object->object_type as $object_type) {
                        $_object_type = get_post_type_object($object_type);

                        // Grab the first one.
                        if (!empty($_object_type->has_archive)) {
                            $posts_page = get_post_type_archive_link($object_type);
                            break;
                        }
                    }
                }

                // Fallback for the 'All' link is the posts page.
                if (!$posts_page) {
                    if ('page' == get_option('show_on_front') && get_option('page_for_posts')) {
                        $posts_page = get_permalink(get_option('page_for_posts'));
                    } else {
                        $posts_page = home_url('/');
                    }
                }

                $posts_page = esc_url($posts_page);
                if ('list' == $r['style']) {
                    $output .= "<li class='cat-item-all'><a href='$posts_page'>$show_option_all</a></li>"; //not this
                } else {
                    $output .= "<a href='$posts_page'>$show_option_all</a>"; //not this
                }
            }

            if (empty($r['current_category']) && (is_category() || is_tax() || is_tag())) {
                $current_term_object = get_queried_object();
                if ($current_term_object && $r['taxonomy'] === $current_term_object->taxonomy) {
                    $r['current_category'] = get_queried_object_id();
                }
            }

            if ($r['hierarchical']) {
                $depth = $r['depth'];
            } else {
                $depth = -1; // Flat.
            }
            $output .= walk_category_tree($categories, $depth, $r);
        }

        if ($r['title_li'] && 'list' == $r['style'] && (!empty($categories) || !$r['hide_title_if_empty'])) {
            $output .= '</ul></li>';
        }

        /**
         * Filters the HTML output of a taxonomy list.
         *
         * @since 2.1.0
         *
         * @param string $output HTML output.
         * @param array $args An array of taxonomy-listing arguments.
         */
        $html = apply_filters('wp_list_categories_matt', $output, $args);

        if ($r['echo']) {
            echo $html;
        } else {
            return $html;
        }
    }
}

// Register and load the widget
function wpb_load_widget()
{
    register_widget('matts_Map_Widget');
}
add_action('widgets_init', 'wpb_load_widget');

add_action('widgets_init', 'generate_map');

function generate_map() {
    require_once WP_PLUGIN_DIR . '/novo-map/includes/class-novo-map-gmap.php';
    require_once WP_PLUGIN_DIR . '/novo-map/includes/class-novo-map-gmap-manager.php';
    global $wpdb;
    $gmap_manager = new \Gmap_Manager($wpdb);
    $gmap = $gmap_manager->get(1);
    $gmap->set_category('');
    $gmap->set_name('Alumni');
    $gmap->set_latitude('');
    $gmap->set_longitude('');
    $gmap->set_zoom('');
    echo '<div class="novomap-map-wrap"><div id="Alumni"></div></div>';
    $gmap->enqueue_map('nova-map');
}


add_filter( 'novo_map_allowed_post_type', 'novo_map_post_types' );
function novo_map_post_types($types) {
    $types = array( 'post', 'page', 'testimonial' );
    return $types;
}
