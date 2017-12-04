<!DOCTYPE html>

<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->

<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->

<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->

<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' |'; } ?> <?php bloginfo('name'); ?></title>

    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />  
	
	<?php wp_head(); ?>
    <!--[if lte IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri()  ?>/includes/ie.css" />
    <![endif]-->
</head>

<body <?php body_class(); ?>>



<header>
    <div class="row social_head_container">
      <div class="col-sm-3"><a href="/"><img src="/wp-content/uploads/2014/06/logo.png" class="img-responsive logo" alt="Chicago Czech Center Logo" title="Chicago Czech Center"></a></div>
      <div class="col-sm-3 col-sm-offset-6 social_header">
      	<div><a href="http://eepurl.com/WU9Lb" target="_blank">Get Our Newsletter<img src="/wp-content/uploads/2014/06/ico_mail.png" class="mail" alt="Get Our Newsletter" title="Signup to get our newsletter"></a></div>
        <div><a href="https://www.facebook.com/ChicagoCzechCenter" target="_blank">Follow Us<img src="/wp-content/uploads/2014/06/ico_facebook.png" class="facebook" alt="Follow us on Facebook!" title="Follow us on Facebook!"></a></div>
      	<div class="search_event_header">
        	<form action="/" method="get" class="one_liner_form"><input type="text" name="s" placeholder="Search"><input type="image" src="/wp-content/uploads/2014/06/btn_submit.png"></form>
        </div>
      </div>
    </div>
    
    <div class="row">
      <div class="col-md-12">
        	<!-- Nav Bar -->
            <nav class="navbar navbar-default" role="navigation"> 
            <!-- Brand and toggle get grouped for better mobile display --> 
              <div class="navbar-header"> 
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"> 
                  <!-- <span class="sr-only">Toggle navigation</span> -->
                  <span class="icon-bar"></span> 
                  <span class="icon-bar"></span> 
                  <span class="icon-bar"></span> 
                </button> 
                <!-- <a class="navbar-brand" href="<?php bloginfo('url')?>"><?php bloginfo('name')?></a> -->
              </div> 
              <!-- Collect the nav links, forms, and other content for toggling --> 
              <div class=" navbar-collapse navbar-ex1-collapse collapse"> 
                <?php /* Primary navigation */
                        wp_nav_menu( array(
                            'menu'              => 'main-menu',
                            'depth'             => 2,
                            'container'         => 'div',
                            'container_class'   => 'collapse navbar-ex1-collapse',
                    'container_id'      => 'navbar-ex1-collapse',
                            'menu_class'        => 'nav navbar-nav',
                            'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                            'walker'            => new wp_bootstrap_navwalker())
                        );
            ?>
              </div>
            </nav>
    	</div>
    </div>




</header>





