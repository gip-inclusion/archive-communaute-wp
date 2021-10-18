<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
add_shortcode('AWL-BlogFilter', 'awl_blog_filter_shortcode');
function awl_blog_filter_shortcode($atts) {
	
	//if(!isset($atts[0])) return;
	$unique_id = rand(1, 1000);
	
	ob_start();
	//js
	//wp_enqueue_script('jquery');
	wp_enqueue_script('imagesloaded');
	wp_enqueue_script('awl-bf-bootstrap-js', plugin_dir_url( __FILE__ ).'js/bootstrap.min.js', array('jquery'), '' , true);
	wp_enqueue_script('awl-bf-filterizr-js', plugin_dir_url( __FILE__ ).'js/jquery.filterizr.js', array('jquery'), '', false);
	wp_enqueue_script('awl-bf-controls-js', plugin_dir_url( __FILE__ ).'js/controls.js', array('jquery'), '', false);
	//wp_enqueue_script('awl-bf-throttle-js', plugin_dir_url( __FILE__ ).'js/jquery.ba-throttle-debounce.js', array('jquery'), '', false);
	wp_enqueue_script('awl-underscore-js', plugin_dir_url( __FILE__ ).'js/underscore.js', array('jquery'), '', false);
	
	// css
	wp_enqueue_style('awl-bootstrap-css', plugin_dir_url( __FILE__ ).'css/bootstrap.css');
	//wp_enqueue_style( 'awl-fontawesome-all-5.min-css', plugin_dir_url( __FILE__ ).'css/fontawesome-all-5.min.css' );
	wp_enqueue_style( 'awl-font-awesome-4-min-css', plugin_dir_url( __FILE__ ).'css/font-awesome-4.min.css' );
	wp_enqueue_style('awl-filter-css', plugin_dir_url( __FILE__ ) .'css/blog-filter-output.css');
	wp_enqueue_style('ggp-hover-css', plugin_dir_url( __FILE__ ) .'css/hover.css');
	
	//swipe box lightbox
	wp_enqueue_style('awl-swipebox-css', plugin_dir_url( __FILE__ ).'lightbox/swipebox/css/swipebox.min.css');
	wp_enqueue_script('awl-bfg-swipebox-js', plugin_dir_url( __FILE__ ).'lightbox/swipebox/js/jquery.swipebox.min.js', array('jquery'), '' , true); 
	
	if(isset($atts['blog_direction'])) $blog_direction = $atts['blog_direction']; else $blog_direction = "ltr";
	if(isset($atts['blog_fixed_grid'])) $blog_fixed_grid = $atts['blog_fixed_grid']; else $blog_fixed_grid = "";
	if(isset($atts['blog_template'])) $blog_template = $atts['blog_template']; else $blog_template = "template1";
	if(isset($atts['blog_col_large_desktops'])) $blog_col_large_desktops = $atts['blog_col_large_desktops']; else $blog_col_large_desktops = "col-lg-4";
	if(isset($atts['blog_col_desktops'])) $blog_col_desktops = $atts['blog_col_desktops']; else $blog_col_desktops = "col-md-4";
	if(isset($atts['blog_col_tablets'])) $blog_col_tablets = $atts['blog_col_tablets']; else $blog_col_tablets = "col-sm-6";
	if(isset($atts['blog_col_phones'])) $blog_col_phones = $atts['blog_col_phones']; else $blog_col_phones = "col-xs-12";
	if(isset($atts['blog_image'])) $blog_image = $atts['blog_image']; else $blog_image = "no";
	if(isset($atts['blog_image_link'])) $blog_image_link = $atts['blog_image_link']; else $blog_image_link = "no";
	if(isset($atts['blog_image_lightbox'])) $blog_image_lightbox = $atts['blog_image_lightbox']; else $blog_image_lightbox = "no";
	if(isset($atts['blog_image_hover_effect'])) $blog_image_hover_effect = $atts['blog_image_hover_effect']; else $blog_image_hover_effect = "none";
	if(isset($atts['blog_image_quality'])) $blog_image_quality = $atts['blog_image_quality']; else $blog_image_quality = "large";
	if(isset($atts['blog_title'])) $blog_title = $atts['blog_title']; else $blog_title = "no";
	if(isset($atts['blog_title_link'])) $blog_title_link = $atts['blog_title_link']; else $blog_title_link = "no";
	if(isset($atts['blog_title_font_size'])) $blog_title_font_size = $atts['blog_title_font_size']; else $blog_title_font_size = 25;
	if(isset($atts['blog_title_color'])) $blog_title_color = $atts['blog_title_color']; else $blog_title_color = "#000";
	if(isset($atts['blog_title_below_image'])) $blog_title_below_image = $atts['blog_title_below_image']; else $blog_title_below_image = "no";
	if(isset($atts['blog_desc'])) $blog_desc = $atts['blog_desc']; else $blog_desc = "no";
	if(isset($atts['blog_desc_characters'])) $blog_desc_characters = $atts['blog_desc_characters']; else $blog_desc_characters = "100";
	if(isset($atts['blog_desc_font_size'])) $blog_desc_font_size = $atts['blog_desc_font_size']; else $blog_desc_font_size = 12;
	if(isset($atts['blog_desc_color'])) $blog_desc_color = $atts['blog_desc_color']; else $blog_desc_color = "#a4a6ac";
	if(isset($atts['blog_desc_box_color'])) $blog_desc_box_color = $atts['blog_desc_box_color']; else $blog_desc_box_color = "#EDEEF0";
	if(isset($atts['link_open_new_tab'])) $link_open_new_tab = $atts['link_open_new_tab']; else $link_open_new_tab = "";
	if(isset($atts['blog_read_more'])) $blog_read_more = $atts['blog_read_more']; else $blog_read_more = "no";
	if(isset($atts['blog_read_more_text'])) $blog_read_more_text = $atts['blog_read_more_text']; else $blog_read_more_text = "Read More";
	if(isset($atts['blog_date'])) $blog_date = $atts['blog_date']; else $blog_date = "no";
	if(isset($atts['blog_date_below_image'])) $blog_date_below_image = $atts['blog_date_below_image']; else $blog_date_below_image = "no";
	if(isset($atts['blog_author'])) $blog_author = $atts['blog_author']; else $blog_author = "no";
	if(isset($atts['blog_author_below_image'])) $blog_author_below_image = $atts['blog_author_below_image']; else $blog_author_below_image = "no";
	if(isset($atts['blog_categories'])) $blog_categories = $atts['blog_categories']; else $blog_categories = "no";
	if(isset($atts['blog_tags'])) $blog_tags = $atts['blog_tags']; else $blog_tags = "no";
	if(isset($atts['blog_comments_count'])) $blog_comments_count = $atts['blog_comments_count']; else $blog_comments_count = "no";
	if(isset($atts['blog_order_by'])) $blog_order_by = $atts['blog_order_by']; else $blog_order_by = "date";
	if(isset($atts['blog_order'])) $blog_order = $atts['blog_order']; else $blog_order = "DESC";
	if(isset($atts['blog_thumb_hover'])) $blog_thumb_hover = $atts['blog_thumb_hover']; else $blog_thumb_hover = "no";
	if(isset($atts['blog_thumb_spac'])) $blog_thumb_spac = $atts['blog_desc_font_size']; else $blog_thumb_spac = 5;
	if(isset($atts['blog_filter_order_by'])) $blog_filter_order_by = $atts['blog_filter_order_by']; else $blog_filter_order_by = "title";
	if(isset($atts['blog_filter_order'])) $blog_filter_order = $atts['blog_filter_order']; else $blog_filter_order = "ASC";
	if(isset($atts['blog_pagination'])) $blog_pagination = $atts['blog_pagination']; else $blog_pagination = "no";
	if(isset($atts['blog_load_more'])) $blog_load_more = $atts['blog_load_more']; else $blog_load_more = "no";
	if(isset($atts['blog_load_onscroll'])) $blog_load_onscroll = $atts['blog_load_onscroll']; else $blog_load_onscroll = "no";
	if(isset($atts['blog_pagination_loadmore_color'])) $blog_pagination_color = $atts['blog_pagination_loadmore_color']; else $blog_pagination_color = "#58BBEE";
	if(isset($atts['blog_per_page_and_init_load'])) $blog_per_page_and_init_load = $atts['blog_per_page_and_init_load']; else $blog_per_page_and_init_load = "12";
	if(isset($atts['blog_on_load_scroll'])) $blog_on_load_scroll = $atts['blog_on_load_scroll']; else $blog_on_load_scroll = "3";
	if(isset($atts['blog_filters_dropdown'])) $blog_filters_dropdown = $atts['blog_filters_dropdown']; else $blog_filters_dropdown = "no";
	if(isset($atts['blog_filters'])) $blog_filters = $atts['blog_filters']; else $blog_filters = "no";
	if(isset($atts['blog_filter_all'])) $blog_filter_all = $atts['blog_filter_all']; else $blog_filter_all = "no";
	if(isset($atts['blog_all_text'])) $blog_all_text = $atts['blog_all_text']; else $blog_all_text = "All";
	if(isset($atts['blog_first_filter_selected'])) $blog_first_filter_selected = $atts['blog_first_filter_selected']; else $blog_first_filter_selected = "no";
	if(isset($atts['blog_multi_filter'])) $blog_multi_filter = $atts['blog_multi_filter']; else $blog_multi_filter = "no";
	if(isset($atts['blog_multi_filter_logic'])) $blog_multi_filter_logic = $atts['blog_multi_filter_logic']; else $blog_multi_filter_logic = "no";
	if(isset($atts['blog_search'])) $blog_search = $atts['blog_search']; else $blog_search = "no";
	if(isset($atts['blog_search_text'])) $blog_search_text = $atts['blog_search_text']; else $blog_search_text = "Search";
	if(isset($atts['blog_buttons_color'])) $blog_buttons_color = $atts['blog_buttons_color']; else $blog_buttons_color = "#58BBEE";
	if(isset($atts['blog_filtering'])) $blog_filtering = $atts['blog_filtering']; else $blog_filtering = "blog_category";
	if(isset($atts['default_cat_filter'])) $default_cat_filter = $atts['default_cat_filter']; else $default_cat_filter = "none";
	if(isset($atts['default_tag_filter'])) $default_tag_filter = $atts['default_tag_filter']; else $default_tag_filter = "none";
	if(isset($atts['selected_categories'])) $selected_categories = $atts['selected_categories']; else $selected_categories = "";
	if(isset($atts['exclude_categories'])) $exclude_categories = $atts['exclude_categories']; else $exclude_categories = "";
	if(isset($atts['selected_tags'])) $selected_tags = $atts['selected_tags']; else $selected_tags = "";
	if(isset($atts['exclude_tags'])) $exclude_tags = $atts['exclude_tags']; else $exclude_tags = "";
	if(isset($atts['custom-css'])) $custom_css = $atts['custom-css']; else $custom_css = "";
	if($blog_pagination == "no" and $blog_load_more == "no" and $blog_load_onscroll == "no") {
		$blog_per_page_and_init_load = wp_count_posts()->publish;
	}
	
	//color dark code
	list($r, $g, $b) = sscanf($blog_desc_box_color, "#%02x%02x%02x");
	$r = $r - 24;
	$g = $g - 22;
	$b = $b - 19;
	
	require('blog-filter-output-css.php'); ?>
	
	<div class="blog_filter_main" version="<?php echo BF_PLUGIN_VER; ?>" >
		<?php
		include(BF_PLUGIN_DIR. "filtering/filters.php");
		
		// pagination work with front page
		if(is_front_page()) {
			$no_of_page = (get_query_var('page')) ? get_query_var('page') : 1;
		} else {
			$no_of_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
		}
	
		if($blog_filtering == 'blog_category'){
			$new_selected_categories = explode(",",$selected_categories);
			$new_exclude_categories = explode(",",$exclude_categories);
			$custom_query_args_posts = array( 'post_status' => 'publish', 'cat' => $new_selected_categories, 'category__not_in' => $new_exclude_categories, 'posts_per_page' => $blog_per_page_and_init_load, 'paged' => $no_of_page, 'orderby' => $blog_order_by, 'order' => $blog_order);
		} else if($blog_filtering == 'blog_tag') {
			$new_selected_tags = explode(",",$selected_tags);
			$new_exclude_tags = explode(",",$exclude_tags);
			
			$custom_query_args_posts = array( 'post_status' => 'publish', 'tag__in' => $new_selected_tags, 'tag__not_in' => $new_exclude_tags, 'posts_per_page' => $blog_per_page_and_init_load, 'paged' => $no_of_page, 'orderby' => $blog_order_by, 'order' => $blog_order);
		} ?>
		<div class="filtr-container filters-div bf_gallery_1-<?php echo $unique_id; ?>" style="width:100%">
			<?php
			include('templates/blog-filter-content.php');
			?>
			<div class="blog_loader-<?php echo $unique_id; ?>"></div>
		</div>
		<?php
		// Load More Button
		if($blog_load_more == "yes") { 
			$query_args_count = array( 'cat' => 225,  'category__not_in' => $exclude_categories);
			$query_for_count = new WP_Query( $query_args_count );
			$count = $query_for_count->found_posts; ?>
			
			<div class="row text-center" style="padding:35px;"><button id="load-more-<?php echo $unique_id; ?>" class="btn snip0047 snip0047-<?php echo $unique_id; ?>"><span style="pointer-events: none;"><?php _e('Load More', 'blog-filter'); ?></span><i class="fa fa-circle-o-notch fa-spin" style="pointer-events: none;"></i></button></div>
			<?php
		} 
		// Load On Scroll
		if($blog_load_onscroll == "yes") { ?>
			<div class="load-scroll-block"><div class="lds-ellipsis lds-ellipsis-<?php echo $unique_id; ?>"><div></div><div></div><div></div><div></div></div></div>
			<div class="no-more-posts"><?php _e('No More Posts', 'blog-filter'); ?></div>
			<?php 
		}  // Pagination ?>
		<div style="text-align: center; <?php if($blog_pagination == "no"){ ?> display:none; <?php } ?>" class="blog_pagination blog_pagination-<?php echo $unique_id; ?> font-alt col-lg-12 col-md-12 col-sm-12">
			<?php the_posts_pagination( array(
				'mid_size' => 2,
				'prev_text' =>'<i class="fa fa-caret-left"></i>',
				'next_text' =>'<i class="fa fa-caret-right"></i>',
			) ); 
			// Reset main query object
			$wp_query = NULL;
			$wp_query = $temp_query; ?>
		</div>
		<?php
		// Geting filter from URL
		if(isset($_GET['filter'])) {
			foreach($terms as $term) { 
				if($term->slug == $_GET['filter']) {
					$default_filter = $term->term_id;
				}
			}
		} else if($default_cat_filter) {
			$default_filter = $default_cat_filter;
		} else if($default_tag_filter) {
			$default_filter = $default_tag_filter;
		} else {
			$default_filter = "all";
		}
		
		include(BF_PLUGIN_DIR. "filtering/filters-ajax.php"); ?>
	</div>
	<?php
	wp_reset_query();
	return ob_get_clean();
} ?>