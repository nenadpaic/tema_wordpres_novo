<?php
/*
Template Name: Right Sidebar Down
*/
?>
<?php
    get_header();
    if(!is_front_page()): ?>
    <div class="row">
        <div class="col-md-9" id="content-post">
            <?php if(have_posts()): while(have_posts()): the_post(); ?>
                <?php get_template_part('content', 'page'); ?>
            <?php endwhile; endif; ?>
        </div>
        <div class="col-md-3" id="sidebar-page"><?php dynamic_sidebar('rightsidebar'); ?></div>
    </div>
<?php endif; ?>
<?php get_footer(); ?>
?>