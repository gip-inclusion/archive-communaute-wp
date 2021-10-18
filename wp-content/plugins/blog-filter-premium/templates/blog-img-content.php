						<?php
						if($blog_image == "yes"){ 
						$image_id = get_post_thumbnail_id();
						$image_title = get_the_title($image_id);
						$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
						if ( empty( $image_alt )) {
						$image_alt = $image_title; }
						if($blog_fixed_grid == 'fixgrid') {
							$background_image = 'background-image: url('.get_the_post_thumbnail_url().')';
						} else {
							$background_image = '';
						}
						
						if($blog_image_hover_effect == "hover1") {
							if(get_the_post_thumbnail_url()){ ?>
								<figure class="snip1550 fit-in-content" style="<?php echo $background_image; ?>">
									<img title="<?php echo $image_title ?>" class="portfolio_thumbnail" src="<?php echo get_the_post_thumbnail_url(null, $blog_image_quality); ?>" alt="<?php echo $image_alt ?>">
									<div class="icons">
										<?php 
										if($blog_image_lightbox == "yes"){ ?>
											<a href="<?php echo get_the_post_thumbnail_url(); ?>" title="" rel="bfg-lightbox" class="bfg-lightbox-<?php echo $unique_id; ?>  bfg-lightbox-<?php echo $lightbox_keys; ?>" id="filter_main"><i class="fa fa-picture-o"></i></a>
										<?php
										} if($blog_image_link == "yes"){ ?>
											<a href="<?php the_permalink(); ?>" target="<?php echo $link_open_new_tab; ?>" ><i class="fa fa-link"></i></a>
										<?php 
										} ?>
									</div>
								</figure>
								<?php 
							}
						} if($blog_image_hover_effect == "hover2"){
							if(get_the_post_thumbnail_url()){ ?>
								<figure class="snip1228 snip1228-<?php echo $unique_id; ?> blue fit-in-content" style="<?php echo $background_image; ?>">
									<img title="<?php echo $image_title ?>" class="portfolio_thumbnail" src="<?php echo get_the_post_thumbnail_url(null, $blog_image_quality); ?>" alt="<?php echo $image_alt ?>">
									<figcaption>
										<div>
											<?php 
											if($blog_image_lightbox == "yes"){ ?>
												<a href="<?php echo get_the_post_thumbnail_url(); ?>" title="" rel="bfg-lightbox" class="bfg-lightbox-<?php echo $unique_id; ?>  bfg-lightbox-<?php echo $lightbox_keys; ?>" id="filter_main"><i class="fa fa-picture-o left"></i></a>
											<?php
											} if($blog_image_link == "yes"){ ?>
												<a href="<?php the_permalink(); ?>" target="<?php echo $link_open_new_tab; ?>" ><i class="fa fa-link right"></i></a>
											<?php 
											} ?>
										</div>
									</figcaption>
								</figure>
								<?php 
							}
						} if($blog_image_hover_effect == "hover3") { ?>
							<?php 
							if(get_the_post_thumbnail_url()){ ?>
								<figure class="snip1210 fit-in-content" style="<?php echo $background_image; ?>">
									<img title="<?php echo $image_title ?>" class="portfolio_thumbnail" src="<?php echo get_the_post_thumbnail_url(null, $blog_image_quality); ?>" alt="<?php echo $image_alt ?>">
									<figcaption>
										<?php 
										if($blog_image_lightbox == "yes"){ ?>
											<a href="<?php echo get_the_post_thumbnail_url(); ?>" title="" rel="bfg-lightbox" class="bfg-lightbox-<?php echo $unique_id; ?>  bfg-lightbox-<?php echo $lightbox_keys; ?>" id="filter_main"><i class="fa fa-picture-o"></i></a>
										<?php
											} if($blog_image_link == "yes"){ ?>
											<a href="<?php the_permalink(); ?>" target="<?php echo $link_open_new_tab; ?>" ><i class="fa fa-link right"></i></a>
										<?php 
										} ?>
									</figcaption>
								</figure>
								<?php 
							}
						} if($blog_image_hover_effect == "hover4") {
							if(get_the_post_thumbnail_url()){ ?>
								<figure class="snip1118 blue fit-in-content" style="<?php echo $background_image; ?>">
									<img title="<?php echo $image_title ?>" class="portfolio_thumbnail" src="<?php echo get_the_post_thumbnail_url(null, $blog_image_quality); ?>" alt="<?php echo $image_alt ?>">
									<h3 class=""><?php echo ucwords(the_title()); ?></h3>
									<div>
										<?php 
										if($blog_image_lightbox == "yes"){ ?>
											<a href="<?php echo get_the_post_thumbnail_url(); ?>" title="" rel="bfg-lightbox" class="bfg-lightbox-<?php echo $unique_id; ?>  bfg-lightbox-<?php echo $lightbox_keys; ?>" id="filter_main"><i class="fa fa-picture-o"></i></a>
										<?php
											} if($blog_image_link == "yes"){ ?>
											<a href="<?php the_permalink(); ?>" target="<?php echo $link_open_new_tab; ?>" ><i class="fa fa-link right"></i></a>
										<?php 
										} ?>
									</div>
								</figure>
								<?php 
							}
						} if($blog_image_hover_effect == "hover5"){
							if(get_the_post_thumbnail_url()){ ?>
								<figure class="snip1120 blue fit-in-content" style="<?php echo $background_image; ?>">
									<img title="<?php echo $image_title ?>" class="portfolio_thumbnail" src="<?php echo get_the_post_thumbnail_url(null, $blog_image_quality); ?>" alt="<?php echo $image_alt ?>">
									<div class="icons">
										<?php 
										if($blog_image_lightbox == "yes"){ ?>
											<a href="<?php echo get_the_post_thumbnail_url(); ?>" title="" rel="bfg-lightbox" class="bfg-lightbox-<?php echo $unique_id; ?> bfg-lightbox-<?php echo $lightbox_keys; ?>" id="filter_main"><i class="fa fa-picture-o"></i></a>
										<?php
										} if($blog_image_link == "yes"){ ?>
											<a href="<?php the_permalink(); ?>" target="<?php echo $link_open_new_tab; ?>" ><i class="fa fa-link right"></i></a>
										<?php 
										} ?>
									</div>
								</figure>
								<?php
							}
						} if($blog_image_hover_effect == "none"){ 
							if($blog_image_link == "yes"){ ?>
								<a href="<?php the_permalink(); ?>" target="<?php echo $link_open_new_tab; ?>" class="fit-in-content" style="<?php echo $background_image; ?>">
									<?php 
									if(get_the_post_thumbnail_url()){ ?>
										<img title="<?php echo $image_title ?>" class="portfolio_thumbnail" src="<?php echo get_the_post_thumbnail_url(null, $blog_image_quality); ?>" alt="<?php echo $image_alt ?>">
										<?php 
									} ?>
								</a>
								<?php 
							} else {
								if(get_the_post_thumbnail_url()){ ?>
									<img title="<?php echo $image_title ?>" class="portfolio_thumbnail" src="<?php echo get_the_post_thumbnail_url(null, $blog_image_quality); ?>" alt="<?php echo $image_alt ?>">
									<?php 
								}
							}
						}
					}