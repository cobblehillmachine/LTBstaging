<?php $summer_page = get_field('summer_strong_page') ?>
<?php if ($summer_page) { ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<div class="hero">
			<?php the_post_thumbnail() ?>
			<div class="content">
				<?php the_field("headline") ?>
				<p><?php the_field("subheadline") ?></p>
				<?php if ( is_page('seattle') || is_page('denver') ) { ?>
					<a href="#" class="button fake-dropdown">Find a Studio</a>
				<?php } else { ?>
					<?php wp_dropdown_categories(array('hide_empty' => '0', 'taxonomy' => 'states','show_option_none' => 'Find a Studio', 'orderby' => 'name', 'order' => 'ASC', 'value_field' => 'slug', 'id' => 'cat_hero')) ?>
						<script type="text/javascript">
					
						var hero_dropdown = document.getElementById("cat_hero");
						function onCatChange() {
							var state = hero_dropdown.options[hero_dropdown.selectedIndex].value;
							$('#cat').val(state);
							if (state == '-1') {
								$('.studio').show();
								return false;
							}
							$('.studio').each(function() {
								if ($(this).hasClass(state)) {
									$(this).show();
								} else {
									$(this).hide();
								}
							})
							if ($('.studio').hasClass(state)) {
								$(".no-studios").hide();
							}else {
								$(".no-studios").show();
							}
						}
						hero_dropdown.onchange = onCatChange;
						
					</script>
				<?php } ?>
			</div>
			
		</div>
		<div class="content mid-cont summer">
			<?php the_content(); ?>
		</div>
	<?php endwhile; wp_reset_query(); ?>

<?php } else { ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<div class="hero"><?php the_post_thumbnail() ?></div>
		<div class="content mid-cont top">
			<div class="p-icon"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/p-on-red.png"></div>
			<?php the_content(); ?>
		</div>
	<?php endwhile; wp_reset_query(); ?>
<?php } ?>