<?php
/*
Template Name: Sidebar/Content
*/
?>

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
        <?php if(have_posts()): while(have_posts()): the_post(); ?>

        <?php get_template_part('content', 'page'); ?>

        <?php endwhile; endif; ?>
    </div>
    </div>
</div>
    <?php
    get_footer();
?>