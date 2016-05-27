<?php get_header(); ?>

<?php get_template_part('content', 'top'); ?>


<div class="workshops mid-cont fade-in">
	<div class="state-filter">
		<h2>participating studios</h2>
		<?php wp_dropdown_categories(array('hide_empty' => '0', 'taxonomy' => 'states','show_option_none' => 'Sort by State or Province', 'orderby' => 'name', 'order' => 'ASC', 'value_field' => 'slug')) ?>
		<script type="text/javascript">
	
			var dropdown = document.getElementById("cat");
			function onCatChange() {
				var state = dropdown.options[dropdown.selectedIndex].value
				if (state == '-1') {
					$('.state').show();
					return false;
				}
				$('.state').each(function() {
					if ($(this).hasClass(state)) {
						$(this).show();
					} else {
						$(this).hide();
					}
				})
				if ($('.state.' + state ).has($('.state-title')).length > 0) {
					$(".no-studios").hide();
				}else {
					$(".no-studios").show();
				}
			}
			dropdown.onchange = onCatChange;
			
		</script>
	</div>
	<div class="no-studios"><h3>Sorry, there are no participating studios in your area.</h3></div>
	<?php $states = get_terms('states', array('hide_empty' => 1));
	foreach($states as $state) { ?>

	<div class="state <?php echo $state->slug ?>">	    
	    <?php $studios = new WP_query(array('post_type' => 'studios', 'taxonomy' => 'states', 'term' => $state->slug, 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => -1)); ?>
	    
		<?php if ($studios) { ?>
			<?php $i = 0; ?>
		    <?php while($studios->have_posts()) : $studios->the_post(); ?>
			    <?php if (have_rows('workshops_for_this__studio')) : ?>
				    <?php if ($i == 0) { ?>
					    <h4 class="state-title"><?php echo $state->name ?></h4>
				    <?php } ?>
			    	<?php while( have_rows('workshops_for_this__studio') ): the_row();
				    	$date = get_sub_field('date_of_workshop');
				    	$time = get_sub_field('time_of_workshop');
				    	$signup = get_sub_field('workshop_signup');
				    	 ?>
				        <div class="workshop table">
							<div class="table-cell">
								<h4 class="date-time ">
									<?php echo $date ?>,&nbsp;<?php echo $time ?>
								</h4>
							</div>
							<div class="table-cell">
								<h3><?php the_title() ?></h3>
								<p><?php the_field('street_address') ?></p>
								<p><?php the_field('city') ?>, <?php the_field('state') ?> <?php the_field('zip') ?></p>
								<p><?php the_field('phone') ?></p>
							</div>
							<div class="table-cell">
								<?php if ($signup) { ?>
									<a href="<?php echo $signup ?>" target=_blank class="button">Sign Up</a>
								<?php } ?>
								
							</div>
						</div>
						<?php $i++; ?>
					<?php endwhile; ?>
				<?php endif; ?>
		    <?php endwhile; wp_reset_query()?>
		<?php } ?>
  	</div>

<?php } ?>
</div>

					

<?php get_footer() ?>