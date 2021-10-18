<script>
jQuery(document).ready(function() {
	jQuery("a.page-numbers").each(function() {
	  var $this = jQuery(this);      
	  var _href = $this.attr("href");
	  $this.attr("href", _href + '');
	});
	
	<?php 
	if($blog_filtering == "blog_category"){ ?>
		jQuery( "#<?php echo $default_filter; ?>" ).addClass('active');
		<?php
		$new_filter_value = $default_cat_filter;
	} if($blog_filtering == "blog_tag"){ ?>
		jQuery( "#<?php echo $default_filter; ?>" ).addClass('active');
		<?php
		$new_filter_value = $default_tag_filter;
	} ?>
	
	// Animate loader off screen
	jQuery(".blog_loader").hide();
	jQuery(".bfg_theme_1").css("opacity", 1);
	//Filterizd Default options
	options = {
		callbacks: {
			onFilteringStart: function() { },
			onFilteringEnd: function() { },
			onShufflingStart: function() { },
			onShufflingEnd: function() { },
			onSortingStart: function() { },
			onSortingEnd: function() { }
		},
		controlsSelector: '.filtr-controls-<?php echo $unique_id; ?>',
		filter: <?php if($default_tag_filter != "none" || $default_cat_filter != "none"){ echo $new_filter_value; } else { ?> 'all' <?php } ?>,
		filterOutCss: {
		  top:'0px',
			left:'0px',
			opacity: 0.001,
			transform: ''
		  },
		  filterInCss: {
			  top:'0px',
			left:'0px',
			opacity: 1,
			transform: ''
		  },
		layout: 'sameWidth',
		<?php
		if($blog_multi_filter == "yes"){
			if($blog_multi_filter_logic == "yes") { ?>
				multifilterLogicalOperator: 'and',
			<?php 
			}
		} ?>
		selector: '.filtr-item',
		setupControls: false
	}
	var filterizd = jQuery('.bf_gallery_1-<?php echo $unique_id; ?>').filterizr(options);
	
	jQuery('.filtr-container').imagesLoaded( function() {
	  // images have already loaded, instantiate Filterizr
	  jQuery('.bf_gallery_1-<?php echo $unique_id; ?>').filterizr(options);
	});
	
});

//blog_pagination class add and active class add
jQuery(document).ready(function() {
	// For init load scale
	jQuery('.filtr-item .post-box').addClass('lazyimg');
	
	//***************** Swipebox *********************//
	<?php
	if (wp_script_is( 'awl-bfg-swipebox-js' )) {
		if(isset($_GET['filter'])) { ?>
			var targetFilter = jQuery('.filtr-control-<?php echo $unique_id; ?> li.active').data('filter');
			var lighbox_class_name = "bfg-lightbox-" + targetFilter;
			jQuery('.bfg-lightbox-' + targetFilter ).attr('rel', lighbox_class_name); // add data filter for parent filters
			jQuery('.bfg-lightbox-<?php echo $unique_id; ?>').swipebox();
			<?php 
		} else { ?>
			//***************** Swipebox *********************//
			jQuery('.filtr-control-<?php echo $unique_id; ?> [data-filter]').click(function() {
				jQuery('.bfg-lightbox-<?php echo $unique_id; ?>').swipebox('swipebox-destroy');
				var targetFilter = jQuery(this).data('filter');
				
				var lighbox_class_name = "bfg-lightbox-" + targetFilter;
				jQuery('.bfg-lightbox-' + targetFilter ).attr('rel', lighbox_class_name); // add data filter for parent filters
				jQuery('.bfg-lightbox-<?php echo $unique_id; ?>').swipebox();
				
				//END Swipebox
			});
			
			//bfg-lightbox on page load
			jQuery('.bfg-lightbox-<?php echo $unique_id; ?>').swipebox();
			<?php 
		}
	} ?>
	
	jQuery("#filter-hide-button").on("click", function () {
		var Get_height = jQuery(".simplefilter").height();
        if (jQuery("#display-filter").hasClass("visible")) {
            jQuery("#display-filter").removeClass("visible");
			jQuery("#display-filter").height(0);
        } else {
            jQuery("#display-filter").addClass("visible");
			jQuery("#display-filter").height(Get_height+20);
        }
    });
	
	jQuery( "ul.page-numbers" ).addClass( "blog_pagination mrgt-0" );
	
	jQuery("#filter-all").click(function() {  
		options = {
			animationDuration: 0.5,
			callbacks: {
				onFilteringStart: function() { },
				onFilteringEnd: function() { },
				onShufflingStart: function() { },
				onShufflingEnd: function() { },
				onSortingStart: function() { },
				onSortingEnd: function() { }
			},
			controlsSelector: '.filtr-controls-<?php echo $unique_id; ?>',
			filter: 'all',
			 filterOutCss: {
			  top:'0px',
				left:'0px',
				opacity: 0.001,
				transform: ''
			  },
			  filterInCss: {
				  top:'0px',
				left:'0px',
				opacity: 1,
				transform: ''
			  },
			layout: 'sameWidth',
			 setupControls: false,
			
			selector: '.filtr-item',
		}
		var filterizd = jQuery('.bf_gallery_1-<?php echo $unique_id; ?>').filterizr(options);
		filterizd.filterizr('destroy');
		filterizd.filterizr(options).resize();
		jQuery('.filter-active').removeClass('filter-active');
		jQuery('#filter-all').addClass('filter-active');
	});
	
	// ==================================================
		
	<?php
	foreach($terms as $term) { $termandcount[$term->term_id] =  $term->count; }
	//print_r($termandcount);
	?>
	var total_posts_in_filter = <?php echo json_encode ($termandcount); ?>;
	jQuery('.filtr-controls-<?php echo $unique_id; ?>').click(function() {
		var button = jQuery('#load-more-<?php echo $unique_id; ?>');
		var button_scroll = jQuery('.load-scroll-block');
		var targetFilter = jQuery(this).data('filter');
		var filter_image_len = total_posts_in_filter[targetFilter];
		var loadedItems =  jQuery('.filtr-item.'+targetFilter).length; 
		//console.log(filter_image_len);
		//console.log(loadedItems);
		if(filter_image_len == loadedItems) {
			<?php if($blog_load_more == "yes") { ?>
			button[0].childNodes[0].innerHTML = 'No More Posts';
			button[0].style.pointerEvents = "none";
			button.removeClass('active');
			<?php }  ?>
			<?php if($blog_load_onscroll == "yes") { ?>
			button_scroll.removeClass('active');
			//button_scroll[0].style.display = "none";
			jQuery('.no-more-posts').addClass('active');
			<?php }  ?>
		} else {
			<?php if($blog_load_more == "yes") { ?>
			button[0].childNodes[0].innerHTML = 'Load More';
			button[0].style.pointerEvents = "auto";
			button.removeClass('active');
			<?php }  ?>
			<?php if($blog_load_onscroll == "yes") { ?>
			//button_scroll.addClass('active');
			jQuery('.no-more-posts').removeClass('active');
			<?php } ?>
		}
	});
	<?php 
	if($blog_load_more == "yes") { ?>
		jQuery('#load-more-<?php echo $unique_id; ?>').click(function() {
			<?php if ( $blog_multi_filter == 'yes' ) { ?>
			// Multi Filter
			let targetFilter = jQuery('.filtr-control-<?php echo $unique_id; ?> li.filter-active').map(function(){return jQuery(this).data('multifilter');}).get();
			<?php } else { ?>
			// Single Filter
			var targetFilter = jQuery('.filtr-control-<?php echo $unique_id; ?> li.active').map(function(){return jQuery(this).data('filter');}).get();
			<?php } ?>
			if(targetFilter[0] == "all" || targetFilter == '') { targetFilter = 'all'; }
			
			var ajaxurl = '<?php echo admin_url("admin-ajax.php"); ?>';
			var nonce = '<?php echo wp_create_nonce("load_more_nonce"); ?>';
			var bfg_query_vars = <?php echo json_encode($atts); ?>;
			var unique_id = <?php echo $unique_id; ?>;
			
			var displayed_posts = jQuery('.displayed_posts').map(function(){return jQuery(this).val();}).get();
			
			var button = jQuery(this);
				data = {
					'action': 'load_more',
					'nonce': nonce,
					'bfg_query_vars': bfg_query_vars,
					'displayed_posts' : displayed_posts,
					'targetFilter' : targetFilter,
					'unique_id' : unique_id,
				};
			jQuery.ajax({
				///dataType : 'html',
				url : ajaxurl,
				data : data,
				type : 'POST',
				cache: false,
				beforeSend : function ( xhr ) {
					 button[0].childNodes[0].innerHTML = 'Loading...';
					 button.addClass('active');
				},
				complete : function() {},
				success : function( data ){
					
					if( jQuery.trim(data) != '' ) {
						button[0].childNodes[0].innerHTML = 'Load More';
						button.removeClass('active');
						options = {
							/*animationDuration: 0.5,*/
							callbacks: {
								onFilteringStart: function() { },
								onFilteringEnd: function() { },
								onShufflingStart: function() { },
								onShufflingEnd: function() { },
								onSortingStart: function() { },
								onSortingEnd: function() { }
							},
							controlsSelector: '.filtr-controls-<?php echo $unique_id; ?>',
							filter: targetFilter,
							filterOutCss: {
							  top:'0px',
								left:'0px',
								opacity: 0.001,
								transform: ''
							  },
							  filterInCss: {
								  top:'0px',
								left:'0px',
								opacity: 1,
								transform: ''
							  },
							layout: 'sameWidth',
							<?php
							if($blog_multi_filter == "yes"){
								if($blog_multi_filter_logic == "yes") { ?>
									multifilterLogicalOperator: 'and',
								<?php 
								}
							} ?>
							selector: '.filtr-item',
							setupControls: false
						}
					
						var filterizd = jQuery('.bf_gallery_1-<?php echo $unique_id; ?>').filterizr(options);
						$node = jQuery(data); 
						
						$node[0].firstElementChild.classList.add("loaded-block");
						//console.log($node[0].firstElementChild);
						
						filterizd.filterizr('insertItem', $node);
						filterizd.filterizr(options).resize();
						jQuery('.filtr-item .post-box').addClass('lazyimg');
						
						setTimeout(function() {
						  jQuery('body, html').animate({ scrollTop: jQuery('.loaded-block').offset().top - 300 }, 500); 
							//jQuery($node).each(function() {
							 jQuery('.post-box').removeClass("loaded-block");
							//});

						  //jQuery('.filtr-item').removeClass('mystyle');
						}, 1000);
						
						jQuery('.filtr-container').imagesLoaded( function() {
						  // images have already loaded, instantiate Filterizr
						  jQuery('.bf_gallery_1-<?php echo $unique_id; ?>').filterizr(options);
						});
						
						// Swipebox
						var lighbox_class_name = "bfg-lightbox-" + targetFilter;
						jQuery('.bfg-lightbox-' + targetFilter ).attr('rel', lighbox_class_name); // add data filter for parent filters
						jQuery('.bfg-lightbox-<?php echo $unique_id; ?>').swipebox();
					} else {
						//alert('No More Posts');
						button[0].childNodes[0].innerHTML = 'No More Posts';
						button[0].style.pointerEvents = "none";
						button.removeClass('active');
					}
				} 
			});
		});
		<?php
	} ?>
});

<?php 
if($blog_load_onscroll == "yes" ) { ?>
	jQuery(function(jQuery){
		var button = jQuery('.load-scroll-block');
		//var busy = false;
		jQuery(window).on('scroll', _.debounce(function() {
			var canBeLoaded = true; // this param allows to initiate the AJAX call only if necessary
			//jQuery('.load-scroll-block').addClass('scrolling');
			<?php if ( $blog_multi_filter == 'yes' ) { ?>
			// Multi Filter
			let targetFilter = jQuery('.filtr-control-<?php echo $unique_id; ?> li.filter-active').map(function(){return jQuery(this).data('multifilter');}).get();
			<?php } else { ?>
			// Single Filter
			var targetFilter = jQuery('.filtr-control-<?php echo $unique_id; ?> li.active').map(function(){return jQuery(this).data('filter');}).get();
			<?php } ?>
			if(targetFilter[0] == "all" || targetFilter == '') { targetFilter = 'all'; }
			
			var ajaxurl = '<?php echo admin_url("admin-ajax.php"); ?>';
			var nonce = '<?php echo wp_create_nonce("load_more_nonce"); ?>';
			var bfg_query_vars = <?php echo json_encode($atts); ?>;
			var unique_id = <?php echo $unique_id; ?>;
			var displayed_posts = jQuery('.displayed_posts').map(function(){return jQuery(this).val();}).get();
			
			data = {
				'action': 'load_more',
				'nonce': nonce,
				'bfg_query_vars': bfg_query_vars,
				'displayed_posts' : displayed_posts,
				'targetFilter' : targetFilter,
				'unique_id' : unique_id,
			};
			
			// For check 'load-scroll-block' element visible in Viewport
			jQuery.fn.isInViewport = function() {
			  var elementTop = jQuery(this).offset().top;
			  var elementBottom = elementTop + jQuery(this).outerHeight();

			  var viewportTop = jQuery(window).scrollTop();
			  var viewportBottom = viewportTop + jQuery(window).height();

			  return elementBottom > viewportTop && elementTop < viewportBottom;
			};
			
			
			if (jQuery(window).scrollTop() >= jQuery('.load-scroll-block').offset().top - window.innerHeight && canBeLoaded == true && jQuery('.load-scroll-block').isInViewport()) { 
				
				jQuery.ajax({
					///dataType : 'html',
					url : ajaxurl,
					data : data,
					type : 'POST',
					cache: false,
					beforeSend : function ( xhr ) {
						//button[0].childNodes[0].innerHTML = 'Loading...';
						if( jQuery( ".no-more-posts" ).hasClass( "active" ) ) {
							button.removeClass('active');
						} else {
							button.addClass('active');
						}
						
						 canBeLoaded = false; 
					},
					complete : function() {},
					success : function( data ){
						if( jQuery.trim(data) != '' ) {
							//console.log(data);
							//reset button text
						   //button[0].childNodes[0].innerHTML = 'Load More';
							button.removeClass('active');
							options = {
									
									callbacks: {
										onFilteringStart: function() { },
										onFilteringEnd: function() { },
										onShufflingStart: function() { },
										onShufflingEnd: function() { },
										onSortingStart: function() { },
										onSortingEnd: function() { }
									},
									controlsSelector: '.filtr-controls-<?php echo $unique_id; ?>',
									filter: targetFilter,
									filterOutCss: {
									  top:'0px',
										left:'0px',
										opacity: 0.001,
										transform: ''
									  },
									  filterInCss: {
										  top:'0px',
										left:'0px',
										opacity: 1,
										transform: ''
									  },
									layout: 'sameWidth',
									selector: '.filtr-item',
									setupControls: false
								}
							
							
							var filterizd = jQuery('.bf_gallery_1-<?php echo $unique_id; ?>').filterizr(options);
							$node = jQuery(data); 
							
							
							$node[0].firstElementChild.classList.add("loaded-block");
							//console.log($node[0].firstElementChild);
							
							filterizd.filterizr('insertItem', $node);
						
							
							jQuery('.filtr-item .post-box').addClass('lazyimg');
							filterizd.filterizr(options).resize();
							
							setTimeout(function() {
								//jQuery('body, html').animate({ scroll: jQuery('.loaded-block').offset().top - 300 }, 500); 
								jQuery('.post-box').removeClass("loaded-block");
							}, 1000);
							
							jQuery('.filtr-container').imagesLoaded( function() {
							  // images have already loaded, instantiate Filterizr
							  jQuery('.bf_gallery_1-<?php echo $unique_id; ?>').filterizr(options);
							});
							
							// Swipebox
							var lighbox_class_name = "bfg-lightbox-" + targetFilter;
							jQuery('.bfg-lightbox-' + targetFilter ).attr('rel', lighbox_class_name); // add data filter for parent filters
							jQuery('.bfg-lightbox-<?php echo $unique_id; ?>').swipebox();
							
							
							canBeLoaded = true; // the ajax is completed, now we can run it again
							
						} else {
							//alert('No More Posts');
							jQuery('.no-more-posts').addClass('active');
							button.removeClass('active');
						}
					} 
				});
				
			}
			
		}, 150));
	});
	<?php 
} ?>
// Blog Load & scroll load on multifilter
<?php 
if ( $blog_multi_filter == 'yes' ) { ?>
	jQuery('.filtr-control-<?php echo $unique_id; ?> [data-multifilter]').on( "click", function() {
		jQuery( this ).toggleClass( "filter-active" );
		if(jQuery('.simplefilter li').hasClass('filter-active')) {
			jQuery('#filter-all').removeClass('filter-active'); 
		} else {
			jQuery('#filter-all').addClass('filter-active'); 
		}
		var targetFilter = jQuery('.filtr-control-<?php echo $unique_id; ?> li.filter-active').map(function(){return jQuery(this).data('multifilter');}).get();
		
		
		if(targetFilter == '') { targetFilter = 'all'; }
		if(targetFilter[0] == 'all') { targetFilter = 'all'; }
		console.log(targetFilter);
		//console.log(targetFilter);
		options = {				
			callbacks: {
				onFilteringStart: function() { },
				onFilteringEnd: function() { },
				onShufflingStart: function() { },
				onShufflingEnd: function() { },
				onSortingStart: function() { },
				onSortingEnd: function() { }
			},
			controlsSelector: '.filtr-controls-<?php echo $unique_id; ?>',
			filter: targetFilter,
			filterOutCss: {
			  top:'0px',
				left:'0px',
				opacity: 0.001,
				transform: ''
			  },
			  filterInCss: {
				  top:'0px',
				left:'0px',
				opacity: 1,
				transform: ''
			  },
			layout: 'sameWidth',
			<?php
			if($blog_multi_filter == "yes"){
				if($blog_multi_filter_logic == "yes") { ?>
					multifilterLogicalOperator: 'and',
				<?php 
				}
			} ?>
			selector: '.filtr-item',
			setupControls: false
		}
		var filterizd = jQuery('.bf_gallery_1-<?php echo $unique_id; ?>').filterizr(options);
		filterizd.filterizr(options).resize();
		event.preventDefault();
	});
	<?php 
} ?>
</script>