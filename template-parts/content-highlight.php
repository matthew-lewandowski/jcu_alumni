<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 8/20/2019
 * Time: 6:26 PM
 */
$categories = get_categories();
$id = get_cat_ID("outstanding");
$args = array('category' => 25, 'post_type' => 'post');
$posts = get_posts($args);
$bool = false;
?>
<div class="top-bar">
    <h5>Come check out our Outstanding Alumni</h5>
</div>
    <div id="highlight-carousel" class="carousel slide w-100" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            <?php foreach ($posts as $post) : setup_postdata($post);
                $id = $post->ID;
                $degree = "Unknown";
                $next = get_the_category($id);
                if ($next) :
                    foreach ($next as $cat) :
                        $parent = get_cat_name($cat->parent);
                        if ($parent === "Degree") {
                            $degree = $cat->name;
                        }
                    endforeach;
                endif;
                if (!$bool) {
                    ?>
                    <div class="carousel-item active">
                        <div class="carousel-item-wrap">
                            <img src="<?php the_post_thumbnail_url(); ?>""
                            alt="<?php echo "Slide " . $count ?>">
                            <div class="carousel-name">
                                <h5><?php the_title(); ?></h5>
                                <p><?php echo $degree?></p>
                            </div>
                        </div>
                    </div> <?php
                    $bool = true;
                } else {
                    ?>
                    <div class="carousel-item">
                        <div class="carousel-item-wrap">
                            <img src="<?php the_post_thumbnail_url(); ?>""
                            alt="<?php echo "Slide " . $count ?>">
                            <div class="carousel-name">
                                <h5><?php the_title(); ?></h5>
                                <p><?php echo $degree?></p>
                            </div>
                        </div>
                    </div> <?php
                }
                ?>

            <?php endforeach; ?>
        </div><!-- .carousel-inner -->
        <a class="carousel-control-prev" href="#highlight-carousel" role="button" data-slide="prev">
            <i class="fa fa-chevron-left fa-lg text-muted"></i>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next text-faded" href="#highlight-carousel" role="button" data-slide="next">
            <i class="fa fa-chevron-right fa-lg text-muted"></i>
            <span class="sr-only">Next</span>
        </a>
    </div><!-- #highlight-carousel -->
<div class="bottom-bar">
    <h5>Making a difference in today's world</h5>
</div>
