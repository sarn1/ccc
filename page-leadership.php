<?php get_header(); ?>

<div id="content_body">
<section>

<!-- get page featured header image -->
<? if (have_posts()) :
		while (have_posts()) : the_post(); 
    		if ( has_post_thumbnail() ) { ?>
                <div class="row">
                    <div class="col-sm-12">
                        <?php the_post_thumbnail('full',array('class' =>  ' img-responsive page-featured-image shadow-border')); ?>
                     </div>
                </div>
<?php 		}
		endwhile;
 	endif; 
?>


    <div class="row main-page-content">
    	<div class="col-sm-9">	
            <div class="breadcrumbs">
                <?php if(function_exists('bcn_display')) { bcn_display(); }?>
            </div>
            <h1><?php the_title(); ?></h1>
			<article>
            	<h4>OFFICERS</h4>
				<?php 
					query_posts(array(
					'post_type' => 'leadership-officer',
					'post_status' => 'publish',
					'posts_per_page' => -1,
					));
					
					$counter = 1;
					while (have_posts()) : the_post();
						$portrait = get_the_post_thumbnail(get_the_ID(),'full',array('class' =>  ' portrait-img-small img-responsive'));
						$credentials = get_post_meta(get_the_ID(), 'wpcf-credentials-toc', true);
						$email = get_post_meta(get_the_ID(), 'wpcf-email', true);
						$permalink = get_permalink( get_the_ID() );
						
						if ($counter == 1) { echo '<div class="row portrait_rows">'; }
					?>
						<div class="col-sm-6">
                        	<div class="col-sm-4">
							<?=$portrait?>
                            </div>
                            <div class="col-sm-8">
							<b><? the_title()?></b>
                            <?=$credentials?>
                            <a href="<?=$permalink?>">View Full Bio</a>
							<? if ($email <> "") echo '<br><a href="mailto:'.$email.'">Email '.get_the_title().'</a>'; ?>
                        	</div>
                        </div>                
                	<? 
						++$counter;
						if ($counter == 3) {
							$counter = 1;
							echo '</div>';
						}
					endwhile; 
					if ($counter <> 1) { echo '<div class="col-sm-6">&nbsp;</div></div>'; }
					?>
                
                <h4>DIRECTORS</h4>
				<?php 
					query_posts(array(
					'post_type' => 'leadership-director',
					'post_status' => 'publish',
					'posts_per_page' => -1,
					));
					
					$counter = 1;
					while (have_posts()) : the_post();
						$portrait = get_the_post_thumbnail(get_the_ID(),'full',array('class' =>  ' portrait-img-small img-responsive'));
						$credentials = get_post_meta(get_the_ID(), 'wpcf-credentials-toc', true);
						$email = get_post_meta(get_the_ID(), 'wpcf-email', true);
						$permalink = get_permalink( get_the_ID() );
						
						if ($counter == 1) { echo '<div class="row portrait_rows">'; }
					?>
						<div class="col-sm-6">
                        	<div class="col-sm-4">
							<?=$portrait?>
                            </div>
                            <div class="col-sm-8">
							<b><? the_title()?></b>
                            <?=$credentials?>
                            <a href="<?=$permalink?>">View Full Bio</a>
							<? if ($email <> "") echo '<br><a href="mailto:'.$email.'">Email '.get_the_title().'</a>'; ?>
                        	</div>
                        </div>                
                	<? 
						++$counter;
						if ($counter == 3) {
							$counter = 1;
							echo '</div>';
						}
					endwhile; 
					if ($counter <> 1) { echo '<div class="col-sm-6">&nbsp;</div></div>'; }
					?>                
                
            </article>
		</div>
        <div class="col-sm-3">
			<aside><?php get_sidebar(); ?></aside>
		</div>
    </div>
    


</section>

</div>

<?php get_footer(); ?>