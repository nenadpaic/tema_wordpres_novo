<?php
get_header();

?>
<?php if(!is_front_page()): ?>
    <div class="row">
        <div class="col-md-8" id="content-post">
            <?php if(have_posts()): while(have_posts()): the_post(); ?>

                <?php get_template_part('content', 'page'); ?>

            <?php endwhile; endif; ?>
        </div>
        <div class="col-md-4" id="sidebar-page"><?php dynamic_sidebar('leftsidebar'); ?></div>
    </div>


<?php endif; ?>
<?php get_footer(); ?>