<?php
//calls function before header from functions.php
before_header();
?>

<!DOCTYPE html>

<html>
<head>
    <title><?php wp_title('-', 'true', 'right');
        bloginfo('name'); ?></title>

   
    
    <?php wp_head(); ?>
     <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
    
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url');?>/css/bootstrap.css"/>

   
  <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/flexslider.css" type="text/css" media="screen">

  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/style.css" />
 
  <script type="text/javascript">
    $(function(){
      SyntaxHighlighter.all();
    });
    $(window).load(function(){
      $('#carousel').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: true,
        slideshow: false,
        itemWidth: 210,
        itemMargin: 5,
        asNavFor: '#slider'
      });

      $('#slider').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: true,
        slideshow: true,
        sync: "#carousel",
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
    });
  </script>

</head>
<body>
<div class="<?php echo style($post->ID)?>">
<div class="row" id="logoPosition">
<div id="wrapper-header">
<div class="col-md-4" id="logo"><?php add_logo();?></div>
<div class="col-md-4"></div>
<div class="col-md-4" id="header-widget"><?php dynamic_sidebar('headersection') ?></div>
</div>
</div>
</div>

        <div id="wrapper" >
<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

        </div>
     <?php
        main_nav_menu()
     ?>
    </div>
</nav>
<?php if (!is_front_page()){
?>
<div class ="content">
    <div class="row" id="sub-nav">
        <div class="second-menu">
            <button type="button" id="second-menu-toggle" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> </button>
            <ul id="collapsable">
                <?php
                    nav_bar($post->ID);
                ?>
            </ul>
        </div>
    </div>
<?php
}
    if ($post->post_parent == 0 && !isset($_GET['s']) && !is_single() && !is_woocommerce()){
      slider();
   }   
    else{
       echo '<div id="breadcumb">';
            echo breadcumb($post->ID);
       echo '</div>';
    }
?>

<script >

    $("#searchsubmit").val('Go');
    $("#s").attr("placeholder", "Search");
    $("#s").attr("size", "30");
    $(".screen-reader-text").html("");

    $("#second-menu-toggle").click(function(){
    $("#collapsable").fadeToggle(1000);
    });

</script> 



