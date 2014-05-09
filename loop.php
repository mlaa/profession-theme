 <?php while (have_posts()) : the_post();?>
	<div class="article" id="post-<?php the_ID(); ?>">

		<?php if ( option::get('display_thumb') == 'on' ) {

 			$custom_field = ( option::get( 'cf_use' ) == 'on' ) ? get_post_meta( $post->ID, option::get( 'cf_photo' ), true ) : '';
 			$args = array(  'size' => 'thumbnail', 'width' => option::get('thumb_width'), 'height' => option::get('thumb_height'), 'before' => '<div class="post-thumb">', 'after' => '</div>'  );
			if ($custom_field) {
				$args['meta_key'] = option::get( 'cf_photo' );
			}
			get_the_image( $args );

			} ?>

		<div class="post-content">

			<?php
			/* Get first relevant category */
			$categories = get_the_category();
			foreach($categories as $category) :
				if ( strpos($category->name, 'Column') !== 0 && $category->name != 'Uncategorized' && $category->name != 'Prominent' ) :
					?><span class="category"><?php echo"<a href=\"" . get_category_link($category->term_id) . "\">$category->name</a>"; ?></span><?php
					break;
				endif;
			endforeach;
			?>

			<h3 class="title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

			<h4 class="author"><?php echo get_post_meta($post->ID, 'profession_author', true); ?></h4>

			<!--
 			<div class="post-meta">
				<?php
				if (option::get('display_author') == 'on') { ?><span><?php _e('by', 'wpzoom'); ?> <?php the_author_posts_link(); ?></span> <span class="separator">&times;</span> <?php }
 				if ( option::get('display_date') == 'on' ) { ?><span class="date"><?php printf( __('on %s at %s', 'wpzoom'),  get_the_date(), get_the_time()); ?></span> <span class="separator">&times;</span> <?php }
				if ( option::get('display_comm_count') == 'on' ) { ?><span class="comments"><?php comments_popup_link(__('0 comments', 'wpzoom'), __('1 comment', 'wpzoom'), __('% comments', 'wpzoom')); ?></span><?php }
				edit_post_link(__('Edit', 'wpzoom'), ' ', ' ');
				?>
			</div>
 			//-->

			<?php if ( option::get('display_type') == 'Post Excerpts' ) echo get_post_meta($post->ID, 'profession_excerpt', true); else { ?>

				<div class="entry">
					<?php the_content(); ?>
				</div>
			<?php } ?>

 		</div>
 		<div class="clear"></div>

	</div> <!-- /.article -->

<?php endwhile; ?>
<?php get_template_part( 'pagination'); ?>
<?php wp_reset_query(); ?>
