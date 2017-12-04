<?php get_header(); ?>

<div id="content_body">

<section>

	<div class="row">
    	<div class="col-sm-12">
            <img src="/wp-content/uploads/2014/06/default-header.jpg" class=" img-responsive page-featured-image shadow-border">
         </div>
	</div>

    <div class="row main-page-content">
    	<div class="col-sm-9">	
            <div class="breadcrumbs">
                <?php if(function_exists('bcn_display')) { bcn_display(); }?>
            </div>
			<article>
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <h1><?php the_title(); ?></h1>
                <div><?php the_excerpt(); ?></div>
                <div><a href="<? the_permalink(); ?>">Read More..</a></div>
                <hr />
            <?php endwhile; endif  ?>
            </article>
		</div>
        <div class="col-sm-3">
			<aside><?php get_sidebar(); ?></aside>
		</div>
    </div>
 
</section>

</div>

<?php get_footer(); ?>