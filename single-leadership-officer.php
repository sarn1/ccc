<?php get_header(); ?>

<div id="content_body" class="bio_page">

<section>
	<?php
    if (have_posts()) :
		while (have_posts()) : the_post(); ?>

	<div class="row">
    	<div class="col-sm-12">
        	<img src="/wp-content/uploads/2014/06/featured_fields_of_interest.jpg" class="img-responsive page-featured-image shadow-border" />
         </div>
	</div>



    <div class="row main-page-content">
    	<div class="col-sm-9">	
            <div class="breadcrumbs">
                <?php if(function_exists('bcn_display')) { bcn_display(); }?>
            </div>

            <h1>Leadership &mdash; <?php the_title(); ?></h1>
			<article>
            	<div class="row">
    				<div class="col-sm-3">
						<?php the_post_thumbnail('full',array('class' =>  ' img-responsive shadow-border')); ?>
            		</div>
                    <div class="col-sm-9 bio_content">
						<?php the_content(); ?>
                	</div>
                </div>
            </article>
		</div>
        <div class="col-sm-3">
			<aside><?php get_sidebar(); ?></aside>
		</div>
    </div>
    
	<?php endwhile;
	elseif (is_404()) : ?>

<!-- 404 -->
		<article>
		<h1>We're sorry...</h1>
		<p>Looks like we can't find the page you are looking for!</p>
		</article>

	<?php endif; ?>

</section>

</div>

<?php get_footer(); ?>