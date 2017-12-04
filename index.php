<?php get_header(); ?>

<div id="content_body">
  <section>
    <?php if (is_front_page()) : ?>
    
    <!-- HOMEPAGE -->
    
    <div id="carousel-example-captions" class="carousel slide shadow-border" data-ride="carousel">
      <?php
			$my_args = array(
			'post_type' => 'slider',
			'post_status' => 'publish',
			'posts_per_page' => -1,
			);

			$my_query = new WP_Query( $my_args );
			$num_of_sliders = $my_query->post_count; 				
		?>
      <ol class="carousel-indicators">
        <? for ($x=0; $x<$num_of_sliders; $x++) {  ?>
        <li data-target="#carousel-example-captions" data-slide-to="<?=$x?>" <? if ($x==0) echo 'class="active"'?>></li>
        <? } ?>
      </ol>
      <div class="carousel-inner">
        <?	
		$counter = 0;

		 while ($my_query->have_posts()) :
			$my_query->the_post();
			$image = get_the_post_thumbnail();
			$link = trim(get_post_meta(get_the_ID(), 'wpcf-slider-link', true));
		?>
        <div class="item <? if ($counter==0) echo 'active';?>">
          <? if ($link <> "") echo '<a href="'.$link.'" target="_blank">'; ?>
          <?=$image?>
          <? if ($link <> "") echo '</a>'; ?>
          <div class="carousel-caption"> 
            <!-- <h3>First slide label</h3>
            <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p> --> 
          </div>
        </div>
        <?
			++$counter;
			endwhile;
			wp_reset_query();
			wp_reset_postdata();
		?>
      </div>
      <a class="left carousel-control" href="#carousel-example-captions" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"><img src="/wp-content/uploads/2014/06/btn_left.png" /></span> </a> <a class="right carousel-control" href="#carousel-example-captions" data-slide="next"> <span class="glyphicon glyphicon-chevron-right"><img src="/wp-content/uploads/2014/06/btn_right.png" /></span> </a> </div>
    <h1>Upcoming Events</h1>
    <div class="row">
      <?php 

		global $wp_query;
		
		/*
		$atts = array(
			'title' => NULL,
			'limit' => NULL,
			'css_class' => NULL,
			'show_expired' => FALSE,
			'month' => NULL,
			'category_slug' => NULL,
			'order_by' => 'start_date',
			'sort' => 'ASC'
		);
		*/
		
		add_filter( 'posts_join', 'my_posts_join' );
		add_filter( 'posts_where', 'my_posts_where_upcoming' );
		add_filter( 'posts_orderby', 'my_posts_orderby_upcoming' );
		
		$args = array(
			'post_type' => 'espresso_events',
			'post_status' => 'publish',
			'show_expired' => FALSE,
			'posts_per_page' => 3,
		);
		
		$wp_query = new WP_Query( $args );

		//http://code.eventespresso.com/class-EE_Event.html
		//https://eventespresso.com/topic/get-event-start-date-when-looping-through-events/
		//https://gist.github.com/joshfeck/e3c9540cd4ccc734e755

		/*
		$posts = get_posts(array(
			'post_type'=>'espresso_events',
			'suppress_filters'=>false,
		));
		*/
		$i = 0;

        if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : 
			
			$wp_query->the_post(); 
			$check = $post->EE_Event->is_upcoming();

			if( $check && $i < 3 )  {
				$i++;	
				$event_obj = $post->EE_Event;
				$link = $event_obj->get_permalink();
				$title = $event_obj->name();
			
				//$x = $event_obj->first_datetime(); 
				//echo $x->start_date();

				//$datetimes = $event_obj->datetimes_ordered();
				//echo "has ".count($datetimes)." datetimes";	

				$event_thumbnail_url = $event_obj->feature_image_url('full');

				if(empty($event_thumbnail_url)) {
					$event_thumbnail_url = '/wp-content/uploads/2015/06/blank-event-holder.jpg';
				}
				?>
      <div class="col-sm-3"><a href="<?=$link?>"><img src="<?= $event_thumbnail_url ?>" class="featured-event shadow-border img-responsive" /></a></div>
      <?
			}

        endwhile; endif;

		//clean up to ensure at least 3 events
		if ($i == 0): ?>
      <div class="col-sm-3"><!-- <img src="/wp-content/uploads/2015/06/blank-event-holder.jpg" class="featured-event shadow-border  img-responsive" --></div>
      <div class="col-sm-3"><!-- <img src="/wp-content/uploads/2015/06/blank-event-holder.jpg" class="featured-event shadow-border  img-responsive" --></div>
      <div class="col-sm-3"><!-- <img src="/wp-content/uploads/2015/06/blank-event-holder.jpg" class="featured-event shadow-border  img-responsive" --></div>
      <? elseif ($i == 1): ?>
      <div class="col-sm-3"><!-- <img src="/wp-content/uploads/2015/06/blank-event-holder.jpg" class="featured-event shadow-border  img-responsive" --></div>
      <div class="col-sm-3"><!-- <img src="/wp-content/uploads/2015/06/blank-event-holder.jpg" class="featured-event shadow-border  img-responsive" --></div>
      <? elseif ($i == 2): ?>
      <div class="col-sm-3"><!-- <img src="/wp-content/uploads/2015/06/blank-event-holder.jpg" class="featured-event shadow-border  img-responsive" --></div>
      <? endif;  ?>
      <div class="col-sm-3"> <?php echo do_shortcode( '[Become_A_Member]' ) ?> <?php echo do_shortcode( '[Donate]' ) ?> </div>
    </div>
    
    <h1>Past Events</h1>
    <div class="row">
      <?php 
	
		remove_filter( 'posts_join', 'my_posts_join' );
		remove_filter( 'posts_where', 'my_posts_where_upcoming' );
		remove_filter( 'posts_orderby', 'my_posts_orderby_upcoming' );
		  
	  	rewind_posts();
		wp_reset_query();
		wp_reset_postdata();
		rewind_posts();
		/*
		$atts = array(
			'title' => NULL,
			'limit' => -1,
			'css_class' => NULL,
			'show_expired' => TRUE,
			'month' => NULL,
			'category_slug' => NULL,
			'order_by' => 'end_date',
			'sort' => 'DESC'
		);
		*/
		  
		add_filter( 'posts_join', 'my_posts_join' );
		add_filter( 'posts_where', 'my_posts_where_past' );
		add_filter( 'posts_orderby', 'my_posts_orderby_past' );

		$args = array(
			'post_type' => 'espresso_events',
			'post_status' => 'publish',
			'show_expired' => FALSE,
			'posts_per_page' => 3,
		);
		
		$wp_query = new WP_Query( $args );
		
		  
		$i = 0;
		  
		  
        if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : 
			
			$wp_query->the_post(); 
		
			$check = $post->EE_Event->is_upcoming();

			if( !$check && $i < 3 )  {
				$i++;	
				$event_obj = $post->EE_Event;
				$link = $event_obj->get_permalink();
				$title = $event_obj->name();
				$event_thumbnail_url = $event_obj->feature_image_url('full');
			
				if(empty($event_thumbnail_url)) {
					$event_thumbnail_url = '/wp-content/uploads/2015/06/blank-event-holder.jpg';
				}
				?>
      <div class="col-sm-3"><a href="<?=$link?>"><img src="<?= $event_thumbnail_url ?>" class="featured-event shadow-border img-responsive" /></a></div>
      <?
			}
        endwhile; endif;
	?>
    </div>
    <?php
    elseif (have_posts()) :

		while (have_posts()) : the_post(); ?>
    <!-- REGULAR PAGE -->
    
    <?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it. ?>
    <div class="row">
      <div class="col-sm-12">
        <?php the_post_thumbnail('full',array('class' =>  ' img-responsive page-featured-image shadow-border')); ?>
      </div>
    </div>
    <?php } else {

		//default
		echo '<img src="/wp-content/uploads/2014/06/default-header.jpg" class=" img-responsive page-featured-image shadow-border">';	
	}?>
    <div class="row main-page-content">
      <div class="col-sm-9">
        <div class="breadcrumbs">
          <?php if(function_exists('bcn_display')) { bcn_display(); }?>
        </div>
        <h1>
          <?php the_title(); ?>
        </h1>
        <article>
          <?php the_content(); ?>
        </article>
      </div>
      <div class="col-sm-3">
        <aside>
          <?php get_sidebar(); ?>
        </aside>
      </div>
    </div>
    <?php endwhile;



	elseif (is_404()) : ?>
    
    <!-- 404 -->
    
    <div class="row">
      <div class="col-sm-12"> <img src="/wp-content/uploads/2014/06/feature_404.jpg" class="img-responsive page-featured-image shadow-border" /> </div>
    </div>
    <div class="row main-page-content">
      <div class="col-sm-9">
        <div class="breadcrumbs">Home > <span color="#de001d">Page Not Found</span></div>
        <h1>We're sorry...</h1>
        <article>
          <p>Looks like we can't find the page you are looking for!</p>
        </article>
      </div>
      <div class="col-sm-3">
        <aside>
          <?php get_sidebar(); ?>
        </aside>
      </div>
    </div>
    <?php endif; ?>
  </section>
</div>
<?php get_footer(); 
