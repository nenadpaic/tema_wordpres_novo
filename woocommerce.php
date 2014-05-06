<?php
    get_header();
?>  
<div class="clearfix">
    <div class="col-md-10">
    <div class="col-md-4">
    <?php
    side_nav_menu($post->ID);
    ?>
    </div>
    <div class="col-md-6">
            <?php woocommerce_content(); ?>     
    </div>
    </div>
</div>
    <?php
    get_footer();
?>