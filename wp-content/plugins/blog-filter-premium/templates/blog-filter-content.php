<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

$custom_query = new WP_Query( $custom_query_args_posts );
$temp_query = $wp_query;
$wp_query   = NULL;
$wp_query = $custom_query;
	
if( $custom_query->have_posts()) :
		$abc = 0;
		if(isset($_POST['action'])) { 
			$blog_load = $blog_on_load_scroll;
		
		} else {
			$blog_load = $blog_per_page_and_init_load;
		}
		
		while ($abc < $blog_load && $custom_query->have_posts()) : $custom_query->the_post();
	
		//while ( $custom_query->have_posts()) : $custom_query->the_post();
		$post_id = get_the_ID();
		//Categories Fetch
		global $post;
		if($blog_filtering == 'blog_category'){
			$category_detail= get_the_category( $post->ID );
			$prefix = $keys = '';
			$prefix2 = $lightbox_keys = '';
			
			foreach ($category_detail as $filter_value) {
				$keys .= $prefix . $filter_value->cat_ID;
				$prefix = ', ';
				$lightbox_keys .= $prefix2 . $filter_value->cat_ID;
				$prefix2 = ' bfg-lightbox-';
			}
		} else if($blog_filtering == 'blog_tag') {
			$tag_detail= get_the_tags( $post->ID );
			$prefix = $keys = '';
			$prefix2 = $lightbox_keys = '';
			foreach ($tag_detail as $filter_value) {
				$keys .= $prefix . $filter_value->term_id;
				$prefix = ', ';
				$lightbox_keys .= $prefix2 . $filter_value->term_id;
				$prefix2 = ' bfg-lightbox-';
			}
		} ?>
		<div style="opacity:0;" id="bf_<?php echo get_the_ID(); ?>"  data-category="<?php echo $keys; ?>" data-sort="<?php echo $filter_value->name; ?>" class="<?php echo str_replace(",","",$keys); ?> pfg_theme_1 filtr-item filtr_item_1 single_one <?php echo $blog_col_large_desktops; ?> <?php echo $blog_col_desktops; ?> <?php echo $blog_col_tablets; ?> <?php echo $blog_col_phones; ?>">
			<?php 
			// ------------ ********** -----------------//
			// ------------ TEMPLATE 1 -----------------//
			// ------------ ********** -----------------//
			if($blog_template == 'template1') { ?>
				<div class="post-box bf_thumb_box_1-<?php echo $unique_id; ?> <?php if($blog_thumb_hover == "yes"){ ?> hvr-shadow-radial <?php } ?> ">
					<div class="bf_title_box_1-<?php echo $unique_id; ?> fit-text-main" maxlength="20">
						<?php 
						if($blog_title_below_image == "no") { 
							if($blog_title == "yes"){ 
								if($blog_title_link == "yes"){ ?>
									<a class="" href="<?php the_permalink(); ?>" target="<?php echo $link_open_new_tab; ?>"><h3 class="bf_title_1-<?php echo $unique_id; ?> blog_title fit-text"><?php echo ucwords(the_title()); ?></h3></a>
								<?php 
								} else { ?>
									<h3 class="bf_title_1-<?php echo $unique_id; ?> blog_title fit-text"><?php echo ucwords(the_title()); ?></h3>
								<?php 
								} 
							} 
						} if($blog_date_below_image == "no"){ 
							if($blog_date == "yes"){ 
							$day   = get_the_date('d');
							$month = get_the_date('m');
							$year = get_the_date('Y');?>
								<div class="blog_metaInfo">
									<span><i class="fa fa-calendar"></i> <a href="<?php echo get_day_link( $year, $month, $day ); ?>"><?php the_time('j F, Y'); ?></a> </span>
								</div>
								<?php 
							}
						} if($blog_author_below_image == "no"){
							if($blog_author == "yes"){ ?>
								<div class="blog_metaInfo">
									<span><i class="fa fa-user-o"></i> <?php _e('By') ?> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a> </span>
								</div>
							<?php 
							}
						} ?>
					</div>
					
					<?php // Image Content 
					include(BF_PLUGIN_DIR. "templates/blog-img-content.php"); ?>
					
					<div class="bf_title_box_2-<?php echo $unique_id; ?> fit-text-main">
						<?php 
						if($blog_title_below_image == "yes"){ 
							if($blog_title == "yes"){ 
								if($blog_title_link == "yes"){ ?>
									<a class="" href="<?php the_permalink(); ?>" target="<?php echo $link_open_new_tab; ?>"><h3 class="bf_title_1-<?php echo $unique_id; ?> fit-text"><?php echo ucwords(the_title()); ?></h3></a>
								<?php 
								} else { ?>
									<h3 class="bf_title_1-<?php echo $unique_id; ?> fit-text"><?php echo ucwords(the_title()); ?></h3>
								<?php 
								} 
							} 
						} if($blog_date_below_image == "yes"){ 
							if($blog_date == "yes"){ 
								$day   = get_the_date('d');
								$month = get_the_date('m');
								$year = get_the_date('Y'); ?>
								<div class="blog_metaInfo">
									<span><i class="fa fa-calendar"></i> <a href="<?php echo get_day_link( $year, $month, $day ); ?>"><?php the_time('j F, Y'); ?></a> </span>
								</div>
								<?php 
							}
						} if($blog_author_below_image == "yes"){
							if($blog_author == "yes"){ ?>
								<div class="blog_metaInfo">
									<span><i class="fa fa-user-o"></i> <?php _e('By') ?> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a> </span>
								</div>
							<?php 
							}
						} if($blog_categories == "yes"){ ?>
							<div class="blog_metaInfo">
								<span><i class=""><img class="blog_cat_icon" src="<?php echo BF_PLUGIN_URL ?>img/cat.png"></i> <a href="#"><?php $categories = get_the_category();
								$separator = ", ";
								$output = '';
								if($categories){
									foreach($categories as $category){
										$output .= '<a href="' .get_category_link($category->term_id) .'">' . $category->cat_name . '</a>'  . $separator;
									}
									echo trim($output, $separator);
								} ?></a> </span>
							</div><!-- end meta -->
						<?php 
						} if($blog_desc == "yes"){ ?>
							<div class="bf_desc_1-<?php echo $unique_id; ?> blog_desc fit-text">
								<?php echo ucfirst(stripcslashes(substr(get_the_excerpt(), 0, $blog_desc_characters)).'...'); ?>
							</div>
						<?php 
						} if($blog_tags == "yes"){ ?>
						<div class="blog_metaInfo">
							<?php
							if( get_the_tags() ){
								echo '<span><i class=""><img class="blog_tag_icon" src="'.BF_PLUGIN_URL.'img/tag.png"></i> <a href="#">';
								ucwords( the_tags( '',', ','' ) );
								echo '</a> </span>';
							} ?>
						</div>
						<?php 
						} if($blog_read_more == "yes"){ ?>
						<div class="bf_read_more_div_1">
							<a id="blog_read_more" class="snip0047 snip0047-<?php echo $unique_id; ?> bf_read_more_1" href="<?php the_permalink(); ?>" target="<?php echo $link_open_new_tab; ?>"><span><?php echo $blog_read_more_text; ?></span><i class="fa fa-link"></i></a>
						</div>
						<?php 
						} ?>
					</div>
				</div>
				<?php
			}
			// ------------ / TEMPLATE 1 End -----------------//
			
			
			// ------------ ********** -----------------//
			// ------------ TEMPLATE 2 -----------------//
			// ------------ ********** -----------------//
			if($blog_template == 'template2') { ?>
				<figure class="post-box snip1216 snip1216-<?php echo $unique_id; ?> <?php if($blog_thumb_hover == "yes"){ ?> hvr-shadow-radial <?php } ?> ">
					<div class="blog_content_2 fit-text-main">
						<?php
						if($blog_title_below_image == "no"){ 
							if($blog_title == "yes"){ 
								$day   = get_the_date('d');
								$Month = get_the_date('M');
								$month = get_the_date('m');
								$year  = get_the_date('Y');
								if($blog_title_link == "yes"){ ?>
									<a href="<?php echo get_day_link( $year, $month, $day ); ?>"><div class="date"><span class="day"><?php echo $day; ?></span><span class="month"><?php echo $Month; ?></span></div></a>
									<a class="" href="<?php the_permalink(); ?>" target="<?php echo $link_open_new_tab; ?>"><h3 class="blog_title fit-text"><?php echo ucwords(the_title()); ?></h3></a>
								<?php
								} else { ?>
									<a href="<?php echo get_day_link( $year, $month, $day ); ?>"><div class="date"><span class="day"><?php echo $day; ?></span><span class="month"><?php echo $Month; ?></span></div></a>
									<h3 class="blog_title fit-text"><?php echo ucwords(the_title()); ?></h3>
								<?php 
								} 
							} 
						} if($blog_author_below_image == "no"){
							if($blog_author == "yes"){ ?>
								<div class="blog_metaInfo">
									<span><i class="fa fa-user-o"></i> <?php _e('By') ?> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a> </span>
								</div>
							<?php
							}
						} ?>
					</div>
					<?php // Image Content 
					include(BF_PLUGIN_DIR. "templates/blog-img-content.php"); ?>
					
					<div class="blog_content fit-text-main">
						<?php
						if($blog_title_below_image == "yes"){ 
							if($blog_title == "yes"){ 
								$day   = get_the_date('d');
								$Month = get_the_date('M');
								$month = get_the_date('m');
								$year = get_the_date('Y');
								if($blog_title_link == "yes") { ?>
									<a href="<?php echo get_day_link( $year, $month, $day ); ?>"><div class="date"><span class="day"><?php echo $day; ?></span><span class="month"><?php echo $Month; ?></span></div></a>
									<a class="" href="<?php the_permalink(); ?>" target="<?php echo $link_open_new_tab; ?>"><h3 class="blog_title fit-text"><?php echo ucwords(the_title()); ?></h3></a>
								<?php 
								} else { ?>
									<a href="<?php echo get_day_link( $year, $month, $day ); ?>"><div class="date"><span class="day"><?php echo $day; ?></span><span class="month"><?php echo $Month; ?></span></div></a>
									<h3 class="blog_title fit-text"><?php echo ucwords(the_title()); ?></h3>
								<?php 
								} 
							} 
						} if($blog_categories == "yes"){ ?>
							<div class="blog_metaInfo">
								<span><i class="fa fa-list"></i><?php $categories = get_the_category();
								$separator = ", ";
								$output = '';
								if($categories){
									foreach($categories as $category){
										$output .= '<a href="' .get_category_link($category->term_id) .'">' . $category->cat_name . '</a>'  . $separator;
									}
									echo trim($output, $separator);
								} ?></span>
							</div><!-- end meta -->
							<?php
						} if($blog_author_below_image == "yes") {
							if($blog_author == "yes"){ ?>
								<div class="blog_metaInfo">
									<span><i class="fa fa-user-o"></i> <?php _e('By') ?> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a> </span>
								</div>
							<?php 
							}
						} 	if($blog_desc == "yes"){ ?>
							<div class="bf_desc_1-<?php echo $unique_id; ?> fit-text">
								<?php echo ucfirst(stripcslashes(substr(get_the_excerpt(), 0, $blog_desc_characters)).'...'); ?>
							</div>
						<?php 
						} if($blog_read_more == "yes"){ ?>
							<div class="bf_read_more_div_1">
								<a id="blog_read_more" class="snip0047 snip0047-<?php echo $unique_id; ?> bf_read_more_1" href="<?php the_permalink(); ?>" target="<?php echo $link_open_new_tab; ?>"><span><?php echo $blog_read_more_text; ?></span><i class="fa fa-link"></i></a>
							</div>
							<?php 
						} ?>
					 </div>
					<?php
					if($blog_tags == "yes") {  
						if( get_the_tags() ) { ?>
							<div class="blog_footer">
								<div class="blog_metaInfo">
									<?php
									echo '<span><i class="fa fa-tag"></i>';
									ucwords( the_tags( '',', ','' ) );
									echo '</span>';  ?>
								</div>
							</div>
						  <?php 
						} 
					} ?>
				</figure>
				<?php
			}
			// ------------ / TEMPLATE 2 End -----------------//
			
			// ------------ ********** -----------------//
			// ------------ TEMPLATE 3 -----------------//
			// ------------ ********** -----------------//
			if($blog_template == 'template3') { ?>
				<div class="post-box post-module post-module-<?php echo $unique_id; ?>">
					<div class="bf-thumbnail">
						<?php
						if($blog_date == "yes"){ 
							$day   = get_the_date('d');
							$Month = get_the_date('M');
							$month = get_the_date('m');;
							$year  = get_the_date('Y'); ?>
							<a href="<?php echo get_day_link( $year, $month, $day ); ?>">
								<div class="date">
									<div class="day"><?php echo $day; ?></div>
									<div class="month"><?php echo $Month; ?></div>
								</div>
							</a>
							<?php
						}
						// Image Content 
						include(BF_PLUGIN_DIR. "templates/blog-img-content.php"); ?>
						
						<div class="category"><?php
							$taxonomy = 'category'; 
							$primary_cat_id = get_post_meta($post_id,'_yoast_wpseo_primary_' . $taxonomy, true);
							if($primary_cat_id){
							   $primary_cat = get_term($primary_cat_id, $taxonomy);
							   if(isset($primary_cat->name)) 
								   echo $primary_cat->name;
							} else {
								$category = get_the_category(); 
								echo $category[0]->cat_name;
							} ?>
						</div>
					</div>
					<div class="post-content fit-text-main">
						<?php
						if($blog_title == "yes"){ 
							if($blog_title_link == "yes"){ ?>
								<a class="" href="<?php the_permalink(); ?>" target="<?php echo $link_open_new_tab; ?>"><h3 class="blog_title"><?php echo ucwords(the_title()); ?></h3></a>
							<?php 
							} else { ?>
								<h2 class="blog_title fit-text"><?php echo ucwords(the_title()); ?></h2>
							<?php
							}
						} if($blog_categories == "yes"){ ?>
						<div class="blog_metaInfo">
							<span><i class="fa fa-folder-open-o"></i><?php $categories = get_the_category();
								$separator = ", ";
								$output = '';
								if($categories){
									foreach($categories as $category){
										$output .= '<a href="' .get_category_link($category->term_id) .'">' . $category->cat_name . '</a>'  . $separator;
									}
									echo trim($output, $separator);
								} ?>
							</span>
						</div>
							<?php
						} if($blog_desc == "yes"){ ?>
							<p class="blog_description"><?php echo ucfirst(stripcslashes(substr(get_the_excerpt(), 0, $blog_desc_characters)).'...'); ?></p>
							<?php
						} ?>
						<div class="post-meta">
							<?php 
							if($blog_author == "yes"){ ?>
								<span class="timestamp">
									<i class="fa fa-user-o"></i> <?php _e('By') ?> 
										<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?>
									</a>
								</span>
								<?php 
							} if($blog_comments_count == "yes"){ ?>
								<span class="comments">
									<i class="fa fa-comments"></i> <?php echo get_comments_number(); ?><?php _e(' Comments', 'blog-filter'); ?>
								</span>
								<?php 
							} ?>
						</div>
						<?php
						if($blog_tags == "yes"){ ?>
							<div class="blog_footer">
								<div class="blog_metaInfo">
									<?php
									if( get_the_tags() ){
										echo '<span><i class="fa fa-tag"></i>';
										ucwords( the_tags( '',', ','' ) );
										echo '</span>';
									} ?>
								</div>
							</div>
						<?php 
						} if($blog_read_more == "yes"){ ?>
							<div class="bf_read_more_div_1">
								<a id="blog_read_more" class="snip0047 snip0047-<?php echo $unique_id; ?> bf_read_more_1" href="<?php the_permalink(); ?>" target="<?php echo $link_open_new_tab; ?>"><span><?php echo $blog_read_more_text; ?></span><i class="fa fa-link"></i></a>
							</div>
							<?php 
						} ?>
					</div>
				</div>
			<?php
			}
			// ------------ / TEMPLATE 3 End -----------------// ?>
			<input type="hidden" value="<?php echo get_the_ID(); ?>" class="displayed_posts">
		</div>
	<?php
	$abc++;
	endwhile;
	// Reset Post Data
	wp_reset_postdata(); 
endif; ?>