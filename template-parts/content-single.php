<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package JCU_Alumni
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="bio">

        <?php
        if (has_post_thumbnail()) { ?>
            <figure class="featured-image bio-image">
                <?php the_post_thumbnail(); ?>
                <?php jcu_alumni_post_navigation(); ?>
            </figure><!-- .featured-image bio-image -->
        <?php } ?>
        <div class="bio-content-wrap">
            <header class="entry-header-bio">
                <?php
                if (is_singular()) :
                    the_title('<h1 class="entry-title">', '</h1>');
                else :
                    the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                endif; ?>
            </header><!-- .entry-header-bio -->
            <?php
            $id = $post->ID;
            $year = "Unknown";
            $degree = "Unknown";
            $university = "Unknown";
            $next = get_the_category($id);
            if ($next) :
                foreach ($next as $cat) :
                    $parent = get_cat_name($cat->parent);
                    if ($parent === "Year") {
                        $year = $cat->name;
                    } elseif ($parent === "Degree") {
                        $degree = $cat->name;
                    } elseif ($parent === "University") {
                        $university = $cat->name;
                    }
                endforeach;
            endif;
            ?>
            <div class="bio-meta">
                <div class="meta-wrap"><h4>Degree:<h5><?php echo $degree?></h5></h4></div>
                <div class="meta-wrap"><h4>Year:<h5><?php echo $year?></h5></div>
                <div class="meta-wrap"><h4>University:<h5><?php echo $university?></h5></h4></div>
                <div class="meta-wrap"><h6>Updated On <?php echo the_modified_date();?></h6></div>
            </div>
            <section class="post-content-bio">
                <div class="post-content__wrap">
                        <div class="post-content__body">
                            <div class="entry-content">

                                <?php
                                if (has_post_thumbnail()) { ?>
                                    <figure class="featured-image bio-image">
                                        <?php the_post_thumbnail(); ?>
                                    </figure><!-- .featured-image bio-image -->
                                <?php } ?>
                                <?php
                                the_content(sprintf(
                                    wp_kses(
                                    /* translators: %s: Name of current post. Only visible to screen readers */
                                        __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'jcu_alumni'),
                                        array(
                                            'span' => array(
                                                'class' => array(),
                                            ),
                                        )
                                    ),
                                    get_the_title()
                                ));
                                ?>
                            </div><!-- .entry-content -->
                        </div><!-- .post-content__body -->
                    </div><!-- .post-content__wrap -->
            </section><!-- .post-content-bio -->
        </div><!--.bio-content-wrap-->
    </div><!--.bio-->
    <div id="mapShortcode"><?php echo GeoMashup::map('height=400px&width=100%&map_cat=0&zoom=5');?></div>
    <div class="mobile-navigation"><?php jcu_alumni_post_navigation(); ?></div>
</article><!-- #post-<?php the_ID(); ?> -->
