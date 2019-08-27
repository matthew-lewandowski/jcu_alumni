<form role="search" class="search-form" method="get" action="<?php echo home_url('/'); ?>">
    <input type="text" class="search-field" name="s" placeholder="" value="<?php the_search_query(); ?>">
    <button type="submit"><i class="fa fa-search"></i></button>
</form>