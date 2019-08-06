<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package jcu_alumni
 */

?>

</div><!-- #content -->

<?php get_sidebar('footer'); ?>

<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="site-footer__wrap">
        <div class="site-info">
            <p>Follow us on</p>
        </div><!-- .site-info -->
        <?php
        // Make sure there is a social menu to display.
        if (has_nav_menu('social')) { ?>
            <nav class="social-menu">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'social',
                        'menu_class'     => 'social-links-menu',
                        'link_before'    => '<span class="screen-reader-text">',
                        'link_after'     => '</span>' . jcu_alumni_get_icon_svg( 'link' ),
                        'depth'          => 1,
                    )
                );
                ?>
            </nav><!-- .social-menu -->
        <?php } ?>
    </div><!-- .site-footer__wrap -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

