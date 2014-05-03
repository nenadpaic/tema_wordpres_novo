<?php
get_header(); ?>
    <div class="row">
        <div class="col-md-8" id="content-post">
            <?php if(have_posts()): while(have_posts()): the_post(); ?>


                <?php get_template_part('content', 'single'); ?>

            <?php endwhile; endif; ?>
        </div>
        <div class="col-md-4">
            <?php get_sidebar(); ?>
        </div>
    </div>


<?php get_footer(); ?>