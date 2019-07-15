<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package JCU_Alumni
 */

?>

</div><!-- #content -->

<?php get_sidebar('footer');?>



<footer id="colophon" class="site-footer">
    <div class="site-info">
        <p>Follow us on</p>
    </div><!-- .site-info -->
    <nav class="social-menu">
    <?php wp_nav_menu(array('theme_location' => 'menu-2',)); ?>
    </nav>
    <div class="site-info">
        <?php
        /* translators: 1: Theme name, 2: Theme author. */
        printf(esc_html__('Theme: %1$s by %2$s.', 'jcu_alumni'), 'jcu_alumni', '<a href="https://www.linkedin.com/in/matthew-lewandowski93/">Matthew Lewandowksi</a>');
        ?>
    </div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
