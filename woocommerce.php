<?php
    get_header();
?>  
<div class="clearfix">
    <div class="col-md-10">
    <div class="col-md-4" id="shop-left-sidebar">
        <div id="shop-left-sidebar-categories">
            <?php
                dynamic_sidebar('shopleftsidebar');
            ?>
        </div>
    </div>
    <div class="col-md-6">
            <?php woocommerce_content(); ?>     
    </div>
    </div>
</div>
    <?php
    get_footer();
?>