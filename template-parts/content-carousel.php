<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 8/13/2019
 * Time: 4:41 PM
 *
 * The header carousel for every page. grabs all header images and the meta attached to them
 * and creates titles for each image with a clickable link to a page specified in the meta.
 */


?>
<div id="carousel-1" class="carousel slide" data-ride="carousel" data-interval="12000">
    <div class="carousel-inner">
        <?php
        $bool = false;
        $headers = get_uploaded_header_images();
        foreach ($headers as $header) {
            if (!$bool) {
                ?>
                <div class="carousel-item active">

                    <?php
                    $id = $header['attachment_id'];
                    $slug = get_post_meta($id, "be-image-header-url", true);
                    if ($slug) {
                        ?> <a href="<?php echo url() . $slug ?>"><img class="d-block w-100"
                                                                      src="<?php echo $header['url']; ?>" alt="slide"/></a>
                        <?php
                    }
                    else { ?>
                    <img class="d-block w-100" src="<?php echo $header['url']; ?>" alt="slide"/>
                    <?php }
                    $position = get_post_meta($id, 'be-image-header-pos', true);
                    $color = get_post_meta($id, 'be-image-header-color', true);
                    if (get_post_meta($id, 'be-image-header', true)) {
                        ?>
                        <div class="carousel-caption-header d-non d-md-block <?php
                        echo ' pos-' . $position;
                        echo ' color-' . $color;
                        ?>
                            ">
                            <h5><?php echo get_post_meta($id, 'be-image-header', true); ?></h5>
                            <p><?php echo get_post_meta($id, 'be-image-header-desc', true); ?></p>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <?php $bool = true;
            } else { ?>
                <div class="carousel-item">

                    <?php
                    $id = $header['attachment_id'];
                    $slug = get_post_meta($id, "be-image-header-url", true);
                    if ($slug) {
                        ?> <a href="<?php echo url() . $slug ?>"><img class="d-block w-100"
                                                                      src="<?php echo $header['url']; ?>" alt="slide"/></a>
                        <?php
                    }
                    else { ?>
                    <img class="d-block w-100" src="<?php echo $header['url']; ?>" alt="slide"/>
                    <?php }
                    $position = get_post_meta($id, 'be-image-header-pos', true);
                    $color = get_post_meta($id, 'be-image-header-color', true);
                    if (get_post_meta($id, 'be-image-header', true)) {
                        ?>
                        <div class="carousel-caption-header d-non d-md-block <?php
                        echo ' pos-' . $position;
                        echo ' color-' . $color;
                        ?>
                            ">
                            <h5><?php echo get_post_meta($id, 'be-image-header', true); ?></h5>
                            <p><?php echo get_post_meta($id, 'be-image-header-desc', true); ?></p>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            <?php }
        } ?>
    </div><!-- .carousel-inner -->
    <a class="carousel-control-prev" href="#carousel-1" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-1" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div><!--#carousel-1-->

