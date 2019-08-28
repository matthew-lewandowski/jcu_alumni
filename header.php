<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package JCU_Alumni
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-svg">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <script type="text/javascript">
        function deleteLocal() {
            localStorage.removeItem('items');
        }
        window.onload = deleteLocal();
    </script>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'jcu_alumni'); ?></a>

    <header id="masthead" class="site-header" role="banner">
        <div class="site-header-restrainer">
            <div class="site-header__container">
                <div class="site-branding">
                    <?php the_custom_logo(); ?>
                    <div class='site-branding__text'>
                        <?php
                        if (is_front_page() && is_home()) :
                            ?>
                            <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
                                                      rel="home"><?php bloginfo('name'); ?></a></h1>
                        <?php
                        else :
                            ?>
                            <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
                                                     rel="home"><?php bloginfo('name'); ?></a></p>
                        <?php
                        endif;
                        $jcu_alumni_description = get_bloginfo('description', 'display');
                        if ($jcu_alumni_description || is_customize_preview()) :
                            ?>
                            <p class="site-description"><?php echo $jcu_alumni_description; /* WPCS: xss ok. */ ?></p>
                        <?php endif; ?>
                    </div><!-- .site-branding__text -->
                </div><!-- .site-branding -->

                <nav id="site-navigation" class="main-navigation">
                                        <button class="menu-toggle" aria-controls="primary-menu"
                                                aria-expanded="false">
                    <?php esc_html_e('', 'jcu_alumni'); ?></button>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_id' => 'primary-menu',
                    ));
                    ?>
                </nav><!-- #site-navigation -->
            </div><!-- #site-header__container -->
        </div><!-- #site-header-restrainer -->
    </header><!-- #masthead -->
<!--    --><?php //if (get_header_image() && is_front_page()) : //this will only display header image on front page ?>
    <?php if (get_header_image()) : //this will only display header image ?>
        <figure class="header-image">
            <?php get_template_part('template-parts/content', 'carousel'); ?>
        </figure><!-- #header-image -->
    <?php endif; //End header image check. ?>
    <div id="content" class="site-content">
