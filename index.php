<?php
/**
 * Created by CodeCrew.
 * Developer: Nenad Paic
 * Date: 4/30/14
 * Time: 7:05 PM
 */


?>

<?php get_header(); ?>
<?php //get_template_part(); ?>


<div class="row">
    <div class="col-md-8" id="content-post">
        <?php if(have_posts()): while(have_posts()): the_post(); ?>
            <a href="<?php the_permalink() ?>"> <h1><?php the_title(); ?></h1></a>
            <p><?php the_content()?></p>
  <?php  ?>

<?php endwhile; endif; ?>
    </div>
    <div class="col-md-4"><?php get_sidebar(); ?></div>
</div>
<div class="row">
    <div class="col-md-12"><?php wpbeginner_numeric_posts_nav(); ?></div>
</div>



<?php if(have_posts()) : while(have_posts()): the_post();
?>
    
    <h2><?php the_title(); ?></h2>
    <p><?php the_author(); ?></p>
    <p><?php the_time(); ?></p>
    <p><?php the_date(); ?></p>
    <p><?php the_content(); ?></p>
    <?php
endwhile;
else:?>
<p>Nema postova</p>
<?php endif; 
?>


<?php get_footer(); ?>



