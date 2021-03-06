<?php get_header(); ?>
<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>

<!-- Prominent post -->
<?php query_posts('category_name=prominent'); ?>
<?php if ( have_posts() && $paged < 2 ) { ?>
	<div class="prominent-articles full-width">
		<?php get_template_part('loop'); ?>
	</div>
<?php } ?>


<?php

	wp_reset_query();

	if ( is_home() && $paged < 2) {
		if ( option::get('featured_enable') == 'on' ) get_template_part('wpzoom', 'featured');
		if ( option::get('featured_cats_show') == 'on' ) get_template_part('wpzoom', 'blocks');
	}

	wp_reset_query();

?>


<?php if ( $paged > 1 || option::get('recent_posts') == 'on') { ?>

	<div class="articles full-width">

		<h3 class="head_title"><?php echo option::get('recent_title'); ?></h3>

			<?php
		global $query_string; // required

		/* Exclude categories from Recent Posts */
		if (option::get('recent_part_exclude') != 'off') {
			if (count(option::get('recent_part_exclude'))) {
				$exclude_cats = implode(",-", (array) option::get('recent_part_exclude'));
				$exclude_cats = '-' . $exclude_cats;
				$args['cat'] = $exclude_cats;
			}
		}

		/* Exclude featured posts from Recent Posts */
		if (option::get('hide_featured') == 'on') {
			$featured_posts = new WP_Query(
				array(
					'post__not_in' => get_option( 'sticky_posts' ),
					'posts_per_page' => 4,
					'meta_key' => 'wpzoom_is_featured',
					'meta_value' => 1
					)
			);

			$postIDs = array();
			while ($featured_posts->have_posts()) {
				$featured_posts->the_post();
				global $post;
				$postIDs[] = $post->ID;
			}
			$args['post__not_in'] = $postIDs;
		}

		$args['paged'] = $paged;
		if (count($args) >= 1) {
			query_posts($args);
		}
		?>

		<?php get_template_part('loop'); ?>

	</div> <!-- /#articles -->

<?php } ?>


<?php get_sidebar(); ?>

<?php get_footer(); ?>
