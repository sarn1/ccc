<?php get_header(); ?>

<div id="content_body">
  <section>
    <?php
    if (have_posts()) :
		while (have_posts()) : the_post(); ?>
    <div class="row">
      <div class="col-sm-12"> <img src="/wp-content/uploads/2014/06/featured_events.jpg" class="img-responsive page-featured-image shadow-border" /> </div>
    </div>
    <div class="row">
      <div class="col-sm-9">
        <div class="breadcrumbs">
          <?php if(function_exists('bcn_display')) { bcn_display(); }?>
        </div>
        <h1>
          <? the_title()?>
        </h1>
        <p>
          <? the_content()?>
        </p>
      <?php endwhile; endif; ?>
        
        <!-- archive starts -->
        <div class="col-sm-12">
	 

     <?
     //https://gist.github.com/joshfeck/e3c9540cd4ccc734e755	
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
    	
	// run the query
	global $wp_query;
	$i = 0;
	$total = 0;
	$counter = 1;
	$current_year = NULL;
	
	$wp_query = new EE_Event_List_Query( $atts );

	while (have_posts()) : the_post();
	$check = $post->EE_Event->is_upcoming();
	
	if (!$check && $total < 9 ) { //do up to 9

		++$total;
		$event_obj = $post->EE_Event;
		$link = $event_obj->get_permalink();
		$title = $event_obj->name();
		
		$x = $event_obj->first_datetime(); 
		$start_date = $x->start_date();
		
		$event_year = (date('Y', strtotime($start_date)));
	
		//$datetimes = $event_obj->datetimes_ordered();
		//echo "has ".count($datetimes)." datetimes";	
		
		$event_thumbnail_url = $event_obj->feature_image_url('full');
		
		if(empty($event_thumbnail_url)) {
			$event_thumbnail_url = '/wp-content/uploads/2015/06/blank-event-holder.jpg';
		}
		
		
		if ($event_year <> $current_year) {
	
			//end last year
			if (!is_null($current_year)) {
				if ($total < 9 && $counter == 2) {
					echo '<div class="col-sm-4">&nbsp;</div><div class="col-sm-4">&nbsp;</div></div>';
				} elseif ($total < 9 && $counter == 3) {
					echo '<div class="col-sm-4">&nbsp;</div></div>';
				}
	
				if ($total > 9) {echo '</ul></div></div>';}
	
				$counter = 1;
				$total = 0;
			}
	
			$current_year = $event_year;
			echo "<h2>".$current_year."</h2>";
	}

			//for top 9 show the boxes
			if ($total <= 9) {
				if ($counter == 1) { echo '<div class="row portrait_rows">'; }
			?>
	  <div class="col-sm-4"><a href="<?=$link?>"><img src="<?= $event_thumbnail_url ?>" class="featured-event shadow-border img-responsive" /></a></div>
	  <?php
				++$counter;
				if ($counter == 4) {
					$counter = 1;
					echo '</div>';
				}

			} else {
			/* never happens - doing only 1st 9
			//start listing
				if ($total == 10) { echo '</div><div class="row portrait_rows"><div class="col-sm-12"><ul>'; }
			?>
          <li><a href="<?=$link?>">
              <?=the_title();?>
              (
              <?php do_action( 'AHEE_event_details_after_the_event_title', $post ); ?>
              )</a></li>
          <?
              */  
			}
		}
		
		endwhile;

		if ($total < 9 && $counter == 2) { echo '<div class="col-sm-4">&nbsp;</div><div class="col-sm-4">&nbsp;</div></div>'; }
		elseif ($total < 9 && $counter == 3) { echo '<div class="col-sm-4">&nbsp;</div></div>'; }
		if ($total > 9) {echo '</ul></div></div>';}
	
		//do the old stuff.
		?>

        <ul>
        <?
		 $i = 0;
		 while (have_posts()) : the_post(); 
			$check = $post->EE_Event->is_upcoming();
			if (!$check) { 
				//ship first 9
				++$i;
				if ($i > 9) {
					
					$x = $post->EE_Event->first_datetime(); 
					$start_date = $x->start_date();
					$event_year = (date('Y', strtotime($start_date)));
					
					if ($current_year <> $event_year) {
						echo '</ul><h2>'.$event_year.'</h2><ul>';
						$current_year = $event_year;
					}
					
					
 		?>
      			<li>
                	<a href="<?php the_permalink(); ?>"><?php the_title(); ?> (<?=$start_date?>)</a>
        		</li>    	 
		<?  	}
			 }
		  endwhile; 
		 ?>
          </ul>
        
        </div>
      </div>
      
      
      <div class="col-sm-3">
        <aside>
          <?php get_sidebar(); ?>
        </aside>
      </div>
    </div>
  </section>
</div>
<?php get_footer(); ?>
