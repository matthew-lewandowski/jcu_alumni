<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 8/13/2019
 * Time: 4:41 PM
 */
if (is_front_page()) { //displays if it is the front page
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
                        <img class="d-block w-100" src="<?php echo $header['url']; ?>" alt="slide"/>
                        <div class="carousel-caption d-non d-md-block">
                            <h5>This is the title</h5>
                            <p>this is the description</p>
                        </div>
                    </div>
                    <?php $bool = true;
                } else { ?>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="<?php echo $header['url']; ?>" alt="slide"/>
                        <div class="carousel-caption d-non d-md-block">
                            <h5>This is the title</h5>
                            <p>this is the description</p>
                        </div>
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
    <?php
} else { //displays if it is not the front page
    the_header_image_tag();
}
