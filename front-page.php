<?php get_header(); ?>
<div class="hero homepage desktop"><a href="/ltb/new-client-offers"><?php the_post_thumbnail() ?></a></div>
<div class="hero homepage mobile" style="background-image:url(<?php echo get_template_directory_uri(); ?>/assets/images/hero-homepage-mobile.jpg)">
	<a href="/ltb/new-client-offers">
		<p>One month of unlimited classes for new clients</p>
		<div class="button">Find a Studio Near You</div>
		
	</a>
</div>
<!--
<div class="microsite-nav nav homepage ">
	<?php wp_nav_menu(array('menu' => 'Microsite Nav')) ?>
</div>
-->

<?php while ( have_posts() ) : the_post(); ?>
<div class="content mid-cont">
	<?php the_content(); ?>
</div>
<?php endwhile; wp_reset_query(); ?>

<div class="inspiration red content fade-in">
	<div class="p-icon"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/p-on-white.png"></div>
	<div class="mid-cont"><?php the_field('inspiration_cont'); ?></div>
</div>	
<div id="instafeed" class="homepage"></div>
<div class="insta-table table fade-in">
	<div id="instafeed2">

		<div class="first-two row"></div>
		<div class="row">
			<div class="sticky table-cell"><img src="<?php the_field('instagram_tile_1'); ?>"></div>
			<div class="third table-cell"></div>
		</div>
	</div>
	<div class="table-cell gray">
		<div class="insta-icon"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/instagram-icon-white.png"></div>
		<h2>#isurvivedpurebarre</h2>
	</div>
	<div id="instafeed3">
		<div class="row">
			<div class="fourth table-cell"></div>
			<div class="sticky table-cell"><img src="<?php the_field('instagram_tile_2'); ?>"></div>
		</div>
		<div class="last-two row"></div>
	</div>
</div>


<div class="content challenge mid-cont fade-in">
	<?php the_field('challenge_cont'); ?>
</div>
<div class="red tip content badge fade-in">
	<div class="mid-cont"><?php the_field('badge_intro', 30); ?></div>
</div>
<div class="badges wide-cont grid-four fade-in">
	<?php $badges = new WP_query(array('post_type' => 'badges', 'order' => 'ASC')) ?>
	<?php while ( $badges->have_posts() ) : $badges->the_post(); ?>
		<?php get_template_part('content', 'badge'); ?>
	<?php endwhile; wp_reset_query(); ?>
</div>

<div class="featured-testimonials fade-in">
	<?php $i = 1; ?>
	<?php while( have_rows('featured_testimonials') ): the_row();
    	$img = get_sub_field('image');
    	$name = get_sub_field('name');
    	$testimonial = get_sub_field('testimonial'); ?>
    	<div class="table-cell <?php if ($i == 2) { ?>open<?php } ?>">
	    	<div class="section " style=" background-color: darkgray; background-image: url(<?php echo $img ?>)">
		    	<div class="cont">
			    	<p><?php echo $testimonial ?></p>
			    	<p>- <?php echo $name ?> </p>
		    	</div>
	    	</div> 
	    	<div class="label">
		    	<span>Advice From <?php echo $name ?></span>
	    	</div>
    	</div>
    	<?php $i++; ?> 
	<?php endwhile; ?>
</div>
	
<?php get_footer(); ?>