<?php get_header(); ?>

<?php get_template_part('content', 'top'); ?>

<?php $subpages = new WP_query(array('post_type' => 'page', 'post_parent' => 22, 'orderby' => 'menu_order', 'order' => 'ASC')) ?>

<div class="tabs mid-cont">
	<?php while ( $subpages->have_posts() ) : $subpages->the_post(); ?>
		<a href="#<?php echo $post->post_name ?>" class="deep-link"><?php the_title() ?></a>
	<?php endwhile; ?>
</div>


<?php while ( $subpages->have_posts() ) : $subpages->the_post(); ?>
	<div id="<?php echo $post->post_name ?>" class="subpage">	
		<div class="red content"><div class="mid-cont"><?php the_field('top_content'); ?></div></div>
		<?php
			$expect = get_field('faqs');
			$lingo  = get_field('lingo');
			$benefits = get_field('benefits');
			if ($expect) { ?>
				<div class="faqs table">
					<?php $i = 1; ?>		
					<?php while( have_rows('faqs') ): the_row(); 
						$image = get_sub_field('image');
						$question = get_sub_field('question');
						$answer = get_sub_field('answer');?>
						<?php if ($i % 2 == 0 ) { ?>
							<div class="row fade-in">
								<img class="mobile" src="<?php echo $image ?>">
								<div class="table-cell text">
									<h3><?php echo $question ?></h3>
									<p><?php echo $answer ?></p>
								</div>
								<div class="table-cell pic" style="background-image: url(<?php echo $image ?>)"></div>
							</div>
						<?php } else { ?>
							<div class="row fade-in">
								<img class="mobile" src="<?php echo $image ?>">
								<div class="table-cell pic" style="background-image: url(<?php echo $image ?>)"></div>
								<div class="table-cell text">
									<h3><?php echo $question ?></h3>
									<p><?php echo $answer ?></p>
								</div>
							</div>
						<?php } ?>
						<?php $i++; ?>
					<?php endwhile; ?>
				</div>
				<div class="flow content wide-cont">
					<div class="mid-cont"><?php the_field('the_flow_of_class'); ?></div>
					<div class="steps">
						<?php $k = 1; ?>
						<?php while( have_rows('flow_steps') ): the_row(); 
							$img = get_sub_field('step');?>
							<?php if ($k == 1 || $k == 4) {
								echo '<div class="table">';
							} ?>
							<div class="step table-cell fade-in">
								<img src="<?php echo $img ?>" onload="this.width/=2;this.onload=null;">
							</div>
							<?php if ($k == 3 || $k == 6) {
								echo '</div>';
							} ?>
							<?php $k++ ?>
					<?php endwhile; ?>
					</div>
				</div>
				
				<div class="up-next red fade-in">
					<div class="mid-cont table">					
						<?php up_next(); ?>
					</div>
				</div>
				
			<?php } else if ($lingo) { ?>
				<div class="grid-three wide-cont">
					<?php while( have_rows('lingo') ): the_row(); 
						$term = get_sub_field('term');
						$definition = get_sub_field('definition');?>
						<div class="grid-item lingo center fade-in">
							<h3><?php echo $term ?></h3>
							<p><?php echo $definition ?></p>
						</div>
					<?php endwhile; ?>
				</div>
				<div class="up-next red fade-in">
					<div class="mid-cont table">
						<?php up_next(); ?>
					</div>
				</div>	
			<?php } else if ($benefits) { ?>
				
				<div class="column-two wide-cont">
					<?php $i = 1; ?>
					<?php while( have_rows('benefits') ): the_row(); 
						$benefit = get_sub_field('benefit');
						$cont = get_sub_field('content');?>
						<?php if ($i == 1 || $i == 6) {
							echo '<div class="column">';
						} ?>
						<div class="grid-item lingo left dontsplit fade-in">
							<h3><?php echo $benefit ?></h3>
							<p><?php echo $cont ?></p>
						</div>
						
						<?php if ($i == 5 || $i == 10) {
							echo '</div>';
						} ?>
	
						<?php $i++; ?>
					<?php endwhile; ?>
				</div>
				
				
				
			<?php } ?>
		
	
		
		
	</div> <!-- end subpage -->
<?php endwhile; ?>
	
	
<?php get_footer(); ?>

<script>
	if (location.hash) {
	} else {
		$('.deep-link:first-child').addClass('current');
	}
	
</script>