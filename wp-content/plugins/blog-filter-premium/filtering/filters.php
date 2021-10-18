<?php
// get all selected categories
global $wp_query;
if($blog_filtering == 'blog_category'){
	$taxonomy_name = 'category';
	$term_args = array( 'hide_empty' => true, 'include' => $selected_categories );
} else if($blog_filtering == 'blog_tag') {
	$taxonomy_name = 'post_tag';
	$term_args = array( 'hide_empty' => true, 'include' => $selected_tags );
}
$terms = get_terms($taxonomy_name, $term_args); // Get all terms of a taxonomy
if ( $terms && !is_wp_error( $terms ) ) : ?>
	<!-- filters -->
	<?php
	if($blog_filters_dropdown == "yes"){ ?>
		<div id="filter-icon" class="">
			<div class="col-md-6">
				<i id="filter-hide-button" class="fa fa-2x fa-th-large" aria-hidden="true"></i>
			</div>
			<div class="blog_search col-md-6">
				<?php 
				if($blog_search == "yes") { ?>
					<div class="search">
						<input type="text"  class="filtr-controls-<?php echo $unique_id; ?> searchTerm" name="blog_search" placeholder="<?php _e($blog_search_text, 'blog-filter'); ?>" data-search>
					</div>
				   <?php 
				} ?>
			</div>
		</div>
		<?php
		if($blog_filters == "yes"){ ?>
			<div id="display-filter" class="col-md-12 text-center">
				<ul class="simplefilter filtr-control-<?php echo $unique_id; ?>">
					<?php 
					if ( $blog_filter_all == "yes" ) {
						if ( $blog_multi_filter == "no" ) { ?>
							<li id="all" class="filtr-controls-<?php echo $unique_id; ?> snip0047 snip0047-<?php echo $unique_id; ?> active" data-filter="all"><span style="pointer-events: none;"><?php _e($blog_all_text, 'blog-filter'); ?></span><i class="fa fa-check" style="pointer-events: none;"></i></li>
						<?php 
						} else if ( $blog_multi_filter == "yes" ) { ?>
							<li id="filter-all" class="filtr-controls-<?php echo $unique_id; ?> snip0047 snip0047-<?php echo $unique_id; ?> filter-active" data-multifilter="all"><span style="pointer-events: none;"><?php _e($blog_all_text, 'blog-filter'); ?></span><i class="fa fa-check" style="pointer-events: none;"></i></li>
							<?php 
						}
					}
					foreach ( $terms as $term) {
						if ( $blog_multi_filter == "no" ) { ?>
							<li id="<?php echo $term->term_id; ?>" class="filtr-controls-<?php echo $unique_id; ?> snip0047 snip0047-<?php echo $unique_id; ?>" value="<?php echo $term->term_id; ?>" data-filter="<?php echo $term->term_id; ?>"><span style="pointer-events: none;"><?php _e($term->name, 'blog-filter'); ?></span><i class="fa fa-check" style="pointer-events: none;"></i></li>
							<?php 
						} else if ( $blog_multi_filter == "yes" ) { ?>
							<li id="<?php echo $term->term_id; ?>" class="filtr-controls-<?php echo $unique_id; ?> snip0047 snip0047-<?php echo $unique_id; ?>" value="<?php echo $term->term_id; ?>" data-multifilter="<?php echo $term->term_id; ?>"><span style="pointer-events: none;"><?php _e($term->name, 'blog-filter'); ?></span><i class="fa fa-check" style="pointer-events: none;"></i></li>
							<?php 
						}
					}	?>
				</ul>
			</div>
			<?php
		} 
	} else {
		if($blog_filters == "yes"){ ?>
			<div class="text-center">
				<ul class="simplefilter filtr-control-<?php echo $unique_id; ?>">
					<?php 
					if ( $blog_filter_all == "yes" ) {
						if ( $blog_multi_filter == "no" ) { ?>
							<li id="all" class="snip0047 snip0047-<?php echo $unique_id; ?> active filtr-controls-<?php echo $unique_id; ?>" data-filter="all"><span style="pointer-events: none;"><?php _e($blog_all_text, 'blog-filter'); ?></span><i class="fa fa-check" style="pointer-events: none;"></i></li>
						<?php 
						} else if ( $blog_multi_filter == "yes" ) { ?>
							<li id="filter-all" class="snip0047 snip0047-<?php echo $unique_id; ?> filter-active filtr-controls-<?php echo $unique_id; ?>" data-multifilter="all"><span style="pointer-events: none;"><?php _e($blog_all_text, 'blog-filter'); ?></span><i class="fa fa-check" style="pointer-events: none;"></i></li>
							<?php 
						}
					}
					foreach ( $terms as $term) { 
						if ( $blog_multi_filter == "no" ) { ?>
							<li id="<?php echo $term->term_id; ?>" class="snip0047 snip0047-<?php echo $unique_id; ?> filtr-controls-<?php echo $unique_id; ?>" value="<?php echo $term->term_id; ?>" data-filter="<?php echo $term->term_id; ?>"><span style="pointer-events: none;"><?php _e($term->name, 'blog-filter'); ?></span><i class="fa fa-check" style="pointer-events: none;"></i></li>
							<?php 
						} else if ( $blog_multi_filter == "yes" ) { ?>
							<li id="<?php echo $term->term_id; ?>" class="snip0047 snip0047-<?php echo $unique_id; ?> filtr-controls-<?php echo $unique_id; ?>" value="<?php echo $term->term_id; ?>" data-multifilter="<?php echo $term->term_id; ?>"><span style="pointer-events: none;"><?php _e($term->name, 'blog-filter'); ?></span><i class="fa fa-check" style="pointer-events: none;"></i></li>
							<?php 
						}
					}	?>
				</ul>
			</div>
			<?php 
		} if($blog_search == "yes") { ?>
			<div class="search text-center">
				<input type="text" class="filtr-controls-<?php echo $unique_id; ?> searchTerm" name="blog_search" placeholder="<?php _e($blog_search_text, 'blog-filter'); ?>" data-search>
			</div> <?php 
		}
	}
endif;
?>