<style><?php 
	if ( $blog_direction == "rtl" ) { ?>
		.blog_filter_main {
			direction: rtl;
		}
		<?php 
	} if($blog_thumb_hover == "yes") { ?> 
	.post-module:hover {
		transform: scale(1);
		box-shadow: 5px 20px 30px rgba(0, 0, 0, 0.2);
	}
	<?php } ?>
	
	.bf_gallery_1-<?php echo $unique_id; ?> .portfolio_thumbnail {
		border-radius: 0;
		display: block;
		height: auto;
		line-height: 1.42857;
		width: 100%;
		float: left;
	}

	/* thumb spacing */

	.bf_gallery_1-<?php echo $unique_id; ?> .col-xs-1, .bf_gallery_1-<?php echo $unique_id; ?> .col-sm-1, .bf_gallery_1-<?php echo $unique_id; ?> .col-md-1, .bf_gallery_1-<?php echo $unique_id; ?> .col-lg-1, .bf_gallery_1-<?php echo $unique_id; ?> .col-xs-2, .bf_gallery_1-<?php echo $unique_id; ?> .col-sm-2, .bf_gallery_1-<?php echo $unique_id; ?> .col-md-2, .bf_gallery_1-<?php echo $unique_id; ?> .col-lg-2, 
	.bf_gallery_1-<?php echo $unique_id; ?> .col-xs-3, .bf_gallery_1-<?php echo $unique_id; ?> .col-sm-3, .bf_gallery_1-<?php echo $unique_id; ?> .col-md-3, .bf_gallery_1-<?php echo $unique_id; ?> .col-lg-3, .bf_gallery_1-<?php echo $unique_id; ?> .col-xs-4, .bf_gallery_1-<?php echo $unique_id; ?> .col-sm-4, .bf_gallery_1-<?php echo $unique_id; ?> .col-md-4, .bf_gallery_1-<?php echo $unique_id; ?> .col-lg-4, 
	.bf_gallery_1-<?php echo $unique_id; ?> .col-xs-5, .bf_gallery_1-<?php echo $unique_id; ?> .col-sm-5, .bf_gallery_1-<?php echo $unique_id; ?> .col-md-5, .bf_gallery_1-<?php echo $unique_id; ?> .col-lg-5, .bf_gallery_1-<?php echo $unique_id; ?> .col-xs-6, .bf_gallery_1-<?php echo $unique_id; ?> .col-sm-6, .bf_gallery_1-<?php echo $unique_id; ?> .col-md-6, .bf_gallery_1-<?php echo $unique_id; ?> .col-lg-6, 
	.bf_gallery_1-<?php echo $unique_id; ?> .col-xs-7, .bf_gallery_1-<?php echo $unique_id; ?> .col-sm-7, .bf_gallery_1-<?php echo $unique_id; ?> .col-md-7, .bf_gallery_1-<?php echo $unique_id; ?> .col-lg-7, .bf_gallery_1-<?php echo $unique_id; ?> .col-xs-8, .bf_gallery_1-<?php echo $unique_id; ?> .col-sm-8, .bf_gallery_1-<?php echo $unique_id; ?> .col-md-8, .bf_gallery_1-<?php echo $unique_id; ?> .col-lg-8, 
	.bf_gallery_1-<?php echo $unique_id; ?> .col-xs-9, .bf_gallery_1-<?php echo $unique_id; ?> .col-sm-9, .bf_gallery_1-<?php echo $unique_id; ?> .col-md-9, .bf_gallery_1-<?php echo $unique_id; ?> .col-lg-9, .bf_gallery_1-<?php echo $unique_id; ?> .col-xs-10, .bf_gallery_1-<?php echo $unique_id; ?> .col-sm-10, .bf_gallery_1-<?php echo $unique_id; ?> .col-md-10, .bf_gallery_1-<?php echo $unique_id; ?> .col-lg-10, 
	.bf_gallery_1-<?php echo $unique_id; ?> .col-xs-11, .bf_gallery_1-<?php echo $unique_id; ?> .col-sm-11, .bf_gallery_1-<?php echo $unique_id; ?> .col-md-11, .bf_gallery_1-<?php echo $unique_id; ?> .col-lg-11, .bf_gallery_1-<?php echo $unique_id; ?> .col-xs-12, .bf_gallery_1-<?php echo $unique_id; ?> .col-sm-12, .bf_gallery_1-<?php echo $unique_id; ?> .col-md-12, .bf_gallery_1-<?php echo $unique_id; ?> .col-lg-12 {
		padding-right: <?php echo $blog_thumb_spac; ?>px !important;
		padding-left: <?php echo $blog_thumb_spac; ?>px !important;
		padding-bottom: <?php echo $blog_thumb_spac; ?>px !important;
		padding-top: <?php echo $blog_thumb_spac; ?>px !important;
	}
	.simplefilter {
		font-family: 'Raleway', Arial, sans-serif;
		text-align: center;
		text-transform: uppercase;
		font-weight: 500;
		letter-spacing: 1px;
		padding: 0;
		margin:20px 0px 20px 0px;
	}
	.snip0047-<?php echo $unique_id; ?> {
		background-color: <?php echo $blog_buttons_color; ?> !important;
	}
	.snip0047-<?php echo $unique_id; ?>:focus {
		background-color: <?php echo $blog_buttons_color; ?> !important;
	}
	.snip0047-<?php echo $unique_id; ?>:active {
		background-color: <?php echo $blog_buttons_color; ?> !important;
	}
	<?php 
	if($blog_filters_dropdown == "yes"){ ?>
		.blog_search{
			text-align:right
		}
		
		#filter-hide-button {
			color: <?php echo $blog_buttons_color; ?>;
		}
		<?php 
	}if ( $blog_multi_filter == "no" ) { ?>
		
		.snip0047-<?php echo $unique_id; ?>.active span {
			-webkit-transform: translate3d(-20px, 0px, 0px);
			transform: translate3d(-20px, 0px, 0px);
			opacity: 1;
		}
		
		.snip0047-<?php echo $unique_id; ?>.active i {
			opacity: 1;
			-webkit-transition-delay: 0.15s;
			transition-delay: 0.15s;
		}
		
		.snip0047-<?php echo $unique_id; ?>.active:before {
			width: 38px;
			-webkit-transition-delay: 0s;
			transition-delay: 0s;
			border-radius: 5px;
		}
		
		
	<?php
	} if ( $blog_multi_filter == "yes" ) { ?>
		/*Multi filter active Css*/
		
		.snip0047-<?php echo $unique_id; ?>.filter-active span {
		  -webkit-transform: translate3d(-20px, 0px, 0px);
		  transform: translate3d(-20px, 0px, 0px);
		  opacity: 1;
		}
		
		.snip0047-<?php echo $unique_id; ?>.filter-active i {
		  opacity: 1;
		  -webkit-transition-delay: 0.15s;
		  transition-delay: 0.15s;
		}
		
		.snip0047-<?php echo $unique_id; ?>.filter-active:before {
		  width: 38px;
		  -webkit-transition-delay: 0s;
		  transition-delay: 0s;
		  border-radius: 5px;
		}
	<?php
	} ?>
	
	@media (min-width: 1025px){
		<?php 
		if ( $blog_multi_filter == "no" ) { ?>
			.snip0047-<?php echo $unique_id; ?>:hover span {
				-webkit-transform: translate3d(-20px, 0px, 0px);
				transform: translate3d(-20px, 0px, 0px);
				opacity: 1;
			}
			.snip0047-<?php echo $unique_id; ?>:hover i {
				opacity: 1;
				-webkit-transition-delay: 0.15s;
				transition-delay: 0.15s;
			}
			.snip0047-<?php echo $unique_id; ?>:hover:before {
				width: 38px;
				-webkit-transition-delay: 0s;
				transition-delay: 0s;
				border-radius: 5px;
			}
			
		<?php
		} if ( $blog_multi_filter == "yes" ) { ?>
			/*Multi filter active Css*/
			.snip0047-<?php echo $unique_id; ?>:hover span {
			  -webkit-transform: translate3d(-20px, 0px, 0px);
			  transform: translate3d(-20px, 0px, 0px);
			  opacity: 1;
			}
			.snip0047-<?php echo $unique_id; ?>:hover i {
			  opacity: 1;
			  -webkit-transition-delay: 0.15s;
			  transition-delay: 0.15s;
			}
			.snip0047-<?php echo $unique_id; ?>:hover:before {
			  width: 38px;
			  -webkit-transition-delay: 0s;
			  transition-delay: 0s;
			  border-radius: 5px;
			}
		<?php
		} ?>
	}
	.blog_search {
		margin-bottom:20px;
		display: inline-block !important;
	}
	.blog_metaInfo {
		margin-top: 10px;
		margin-bottom: 10px;
		padding: 0;
		font-size: 14px;
		font-weight: 600;
		display:inline-block;
	}
	.bf_read_more_div_1 {
		text-align: right;
		margin:20px 0px 5px 0px;
	}
	.bf_read_more_1 {
		text-decoration:none;
	} 
	.bf_read_more_1:hover {
		text-decoration:none;
	}
	.blog_pagination {
		display: inline-block;
		padding-left: 0;
		margin: 20px 0;
		border-radius: 4px;
		z-index:9;
	}
	.blog_pagination-<?php echo $unique_id; ?> span { 
		background : <?php echo $blog_pagination_color; ?> !important;
		border: 1px solid #eaeaea;
		display: inline-block;
		text-align: center;
		color: #FFFFFF;
		padding: 4px 12px;
		border-radius:5px;
	}
	.blog_pagination-<?php echo $unique_id; ?> span:hover { 
		background : <?php echo $blog_pagination_color; ?> !important;
		color : #ffffff; 
	}
	.blog_pagination-<?php echo $unique_id; ?> a {
		border: 1px solid <?php echo $blog_pagination_color; ?> !important;
		display: inline-block;
		text-align: center;
		color: <?php echo $blog_pagination_color; ?> !important;
		padding: 4px 12px;
		border-radius:5px;
		transition: 0.7s;
	}
	.blog_pagination-<?php echo $unique_id; ?> a:hover, .blog_pagination-<?php echo $unique_id; ?> a:focus {
		background: <?php echo $blog_pagination_color; ?> !important;
		color: #FFFFFF;
		text-decoration:none;
	}
	
	figure.snip1228-<?php echo $unique_id; ?> figcaption i {
		background-color: <?php echo $blog_buttons_color; ?> !important;
	}
	.comments-area{
		z-index:99;
	}
	.blog_loader-<?php echo $unique_id; ?> {
		border-top: 5px solid <?php echo $blog_buttons_color; ?> !important;
	}
	<?php 
	if($blog_template == 'template1'){ ?>
		/* title box css*/

		.bf_thumb_box_1-<?php echo $unique_id; ?> {
			padding: inherit;
			background-color: <?php echo $blog_desc_box_color; ?>;
			border: 1px solid;
			border-color: rgba( <?php echo $r; ?>, <?php echo $g; ?>, <?php echo $b; ?> );
			/* border-color: #d5d8dd; */
		}
		<?php 
		if($blog_title_below_image == "no" || $blog_date_below_image == "no" || $blog_author_below_image == "no" ){  ?>
		.bf_title_box_1-<?php echo $unique_id; ?> {
			padding-top: 5px;
			padding-bottom: 10px;
			padding-left: 8px;
			padding-right: 8px;
		}
		<?php } ?>
		.bf_title_box_2-<?php echo $unique_id; ?> {
			padding-top: 10px;
			padding-bottom: 10px;
			padding-left: 8px;
			padding-right: 8px;
		}
		.bf_title_1-<?php echo $unique_id; ?> {
			float: left;
			margin-top: 15px;
			margin-bottom: 15px;
			font-size: <?php echo $blog_title_font_size; ?>px !important;
			color : <?php echo $blog_title_color; ?>;
			font-weight: bold;
		}
		.bf_desc_1-<?php echo $unique_id; ?> {
			font-size: <?php echo $blog_desc_font_size; ?>px;
			color: <?php echo $blog_desc_color; ?>;
			margin:10px 1px;
		}
		
		.blog_metaInfo > span {
			display: inline-block;
			margin-right: 6px;
			color: #777;
		}
		.blog_metaInfo > span > i > .blog_cat_icon {
			height: 16px !important;
			width: 20px !important;
			opacity: 0.7;
			margin-bottom: 2px
		}
		.blog_metaInfo > span > i > .blog_tag_icon {
			height: 22px !important;
			width: 22px !important;
			margin-bottom: 2px
		} 
		
	<?php
	} else if($blog_template == 'template2'){ ?>
		.blog_metaInfo > span > a {
			color: #fff !important;
		}
		.blog_metaInfo > span > i {
			height: 16px !important;
			width: 20px !important;
			margin-bottom: 2px;
		}
		.bf_desc_1-<?php echo $unique_id; ?> {
			font-size: <?php echo $blog_desc_font_size; ?>px;
			color: <?php echo $blog_desc_color; ?>;
			margin:10px 1px;
		}
		figure.snip1216-<?php echo $unique_id; ?> {
			font-family: 'Raleway', Arial, sans-serif;
			color: #fff;
			position: relative;
			background-color: <?php echo $blog_desc_box_color; ?>;
			text-align: left;
			font-size: 16px;
			box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
		}
		figure.snip1216 * {
			-webkit-box-sizing: border-box;
			box-sizing: border-box;
			-webkit-transition: all 0.3s ease;
			transition: all 0.3s ease;
		}
		figure.snip1216 .image {
			overflow: hidden;
		}
		figure.snip1216 img {
			vertical-align: top;
			position: relative;
		}
		figure.snip1216 .blog_content {
			padding: 25px;
			position: relative;
		}
		<?php 
		if($blog_title_below_image == "no" || $blog_author_below_image == "no" ){  ?>
			figure.snip1216 .blog_content_2 {
				padding: 25px;
			  position: relative;
			}
		<?php 
		} else if($blog_title_below_image == "yes" && $blog_author_below_image == "yes" ){  ?>
			figure.snip1216 .blog_content_2 {
				display:none;
			}
		<?php 
		} ?>
		figure.snip1216-<?php echo $unique_id; ?> .date {
			background-color: <?php echo $blog_buttons_color; ?>;
			top: 25px;
			color: #fff;
			left: 25px;
			min-height: 48px;
			min-width: 48px;
			position: absolute;
			text-align: center;
			font-size: 20px;
			font-weight: 700;
			text-transform: uppercase;
		}
		figure.snip1216 .date span {
			display: block;
			line-height: 24px;
		}
		figure.snip1216 .date .month {
			font-size: 14px;
			background-color: rgba(0, 0, 0, 0.1);
		}
		figure.snip1216 .date .day {
			padding:3px;
		}
		figure.snip1216 .blog_title{
			margin: 0;
			padding: 0;
		}
		
		figure.snip1216-<?php echo $unique_id; ?> .blog_title {
			min-height: 50px;
			margin-left: 60px;
			line-height: 1.1;
			margin-bottom:20px;
			display: block;
			font-weight: 600;
			text-transform: uppercase;
			font-size: <?php echo $blog_title_font_size; ?>px;
			color : <?php echo $blog_title_color; ?>;
		}
		figure.snip1216-<?php echo $unique_id; ?> .blog_footer {
			padding: 0 25px;
			background-color: rgba(0, 0, 0, 0.5);
			color: #e6e6e6;
			font-size: 0.8em;
			line-height: 30px;
		}
	<?php 
	} else if($blog_template == 'template3'){ ?>
		.post-module {
			transform: scale(0.99);
			position: relative;
			z-index: 1;
			display: block;
			background: #FFFFFF;
			/*min-width: 270px;*/
			/*height: 470px;*/
			-webkit-box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.15);
			-moz-box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.15);
			box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.15);
			/*-webkit-transition: all 0.3s linear 0s;
			-moz-transition: all 0.3s linear 0s;
			-ms-transition: all 0.3s linear 0s;
			-o-transition: all 0.3s linear 0s;
			transition: all 0.3s linear 0s;*/
		}
		.post-module .bf-thumbnail {
			position:relative;
			/*background: #000000;*/
			/*height: 400px;*/
			overflow: hidden;
		}
		.post-module-<?php echo $unique_id; ?> .bf-thumbnail .date {
			position: absolute;
			top: 20px;
			right: 20px;
			z-index: 1;
			background: <?php echo $blog_buttons_color; ?>;
			width: 55px;
			height: 55px;
			padding: 7.5px 0;
			line-height: normal;
			-webkit-border-radius: 100%;
			-moz-border-radius: 100%;
			border-radius: 100%;
			color: #FFFFFF;
			font-weight: 700;
			text-align: center;
			-webkti-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
		}
		.post-module .bf-thumbnail .date .day {
			font-size: 17px;
		}
		.post-module .bf-thumbnail .date .month {
			font-size: 11px;
			text-transform: uppercase;
		}
		.post-module-<?php echo $unique_id; ?> .bf-thumbnail .category {
			position: absolute;
			bottom: 0px;
			left: 0;
			background: <?php echo $blog_buttons_color; ?>;
			padding: 5px 15px;
			color: #FFFFFF;
			font-size: 13px;
			font-weight: 600;
			text-transform: uppercase;
		}
		.post-module .bf-thumbnail img {
			display: block;
			width: 120%;
			-webkit-transition: all 0.3s linear 0s;
			-moz-transition: all 0.3s linear 0s;
			-ms-transition: all 0.3s linear 0s;
			-o-transition: all 0.3s linear 0s;
			transition: all 0.3s linear 0s;
		}
		.post-module-<?php echo $unique_id; ?> .post-content {
			/*position: absolute;*/
			bottom: 0;
			background: <?php echo $blog_desc_box_color; ?>;
			width: 100%;
			padding: 30px;
			-webkti-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			-webkit-transition: all 0.3s cubic-bezier(0.37, 0.75, 0.61, 1.05) 0s;
			-moz-transition: all 0.3s cubic-bezier(0.37, 0.75, 0.61, 1.05) 0s;
			-ms-transition: all 0.3s cubic-bezier(0.37, 0.75, 0.61, 1.05) 0s;
			-o-transition: all 0.3s cubic-bezier(0.37, 0.75, 0.61, 1.05) 0s;
			transition: all 0.3s cubic-bezier(0.37, 0.75, 0.61, 1.05) 0s;
		}
		.post-module-<?php echo $unique_id; ?> .post-content .blog_title {
			margin: 0;
			padding: 0 0 10px;
			color: <?php echo $blog_title_color; ?>;
			font-size: <?php echo $blog_title_font_size; ?>px;
			font-weight: 700;
		}
		.post-module .post-content .blog_sub_title {
			margin: 0;
			padding: 0 0 5px;
			color: #e74c3c;
			font-size: 20px;
			font-weight: 400;
		}
		.post-module-<?php echo $unique_id; ?> .post-content .blog_description {
			color: <?php echo $blog_desc_color; ?>;
			font-size: <?php echo $blog_desc_font_size; ?>px;
			line-height: 1.8em;
		}
		.post-module .post-content .post-meta {
			<?php if($blog_description == "yes"){ ?>
			margin: 30px 0 0;
			<?php } ?>
			color: #999999;
		}
		.post-module .post-content .post-meta .timestamp {
			margin: 0 16px 0 0;
		}
		.post-module .post-content .post-meta a {
			color: #999999;
			text-decoration: none;
		}
		.blog_metaInfo-<?php echo $unique_id; ?> > span {
			display: inline-block;
			margin-right: 6px;
			color: <?php echo $blog_buttons_color; ?>;
		}
		.blog_metaInfo span a  {
			color: <?php echo $blog_buttons_color; ?> !important;
		}
		.blog_metaInfo span i {
			color: <?php echo $blog_buttons_color; ?> !important;
		}
		
		.blog_metaInfo > span > a:hover {
			text-decoration: none !important;
		}
		.blog_metaInfo > span > i {
			height: 16px !important;
			width: 20px !important;
			margin-bottom: 2px
		}
		
		
	<?php
	} ?>
	
	/* Image to background */
	
	<?php if($blog_fixed_grid == 'fixgrid') { ?>
	 .fit-in-content {
		height: 250px;
		background-repeat: no-repeat !important;
		background-size: cover !important;
		background-position: center !important;	
	}
	/* .fit-text-main {
		height:150px;
	} */
	/* .fit-text {
		word-break: break-word;
		overflow: hidden;
		text-overflow: ellipsis;
		display: -webkit-box;
		 line-height: 22px; 
		max-height: 200px;
		-webkit-line-clamp: 2;
		-webkit-box-orient: vertical;
	}  */
	.portfolio_thumbnail {
		opacity:0;
		display:none !important;
	}
	<?php } ?>
	/* Load More */
	.filtr-container {
		transition-property: height, width;
	}
	.filtr-container, .filtr-container .filtr-item {
		-webkit-transition-duration: 0.8s;
		-moz-transition-duration: 0.8s;
		-ms-transition-duration: 0.8s;
		-o-transition-duration: 0.8s;
		transition-duration: 0.8s;
		

	}
	.filtr-item {
	  -webkit-transition-property: height, width;
		 -moz-transition-property: height, width;
		  -ms-transition-property: height, width;
		   -o-transition-property: height, width;
			  transition-property: height, width;
	}
	.filtr-item .post-box { transform: scale3d(0.001, 0.001, 1); } 

	.filtr-item .lazyimg  {
		transition-property: transform, opacity;
		transition-duration: 0.8s;
		transform: scale3d(1, 1, 1);
		transition-delay: 0.8s;
	}
	#load-more-<?php echo $unique_id; ?> {
		transition-delay: 0.8s;
		text-align:center;
		margin: 0 auto;
		background-color: <?php echo $blog_pagination_color; ?> !important;
	}
	#load-more-<?php echo $unique_id; ?>:focus {
		box-shadow: none !important
	}
	.snip0047:parent { 
		margin:30px !important;
	}

	/* Load Scroll Icon*/
	.load-scroll-block, .no-more-posts {
		opacity:0;
		text-align:center;
		font-weight: bold;
	}
	.load-scroll-block.active {
		opacity:1;
	}
	.no-more-posts.active {
		opacity:1;
	}
	.lds-ellipsis {
	  display: inline-block;
	  position: relative;
	  width: 80px;
	  height: 80px;
	}
	.lds-ellipsis-<?php echo $unique_id; ?> div {
	  position: absolute;
	  top: 33px;
	  width: 13px;
	  height: 13px;
	  border-radius: 50%;
	  background: <?php echo $blog_pagination_color; ?> !important;
	  animation-timing-function: cubic-bezier(0, 1, 1, 0);
	}
	.lds-ellipsis div:nth-child(1) {
	  left: 8px;
	  animation: lds-ellipsis1 0.6s infinite;
	}
	.lds-ellipsis div:nth-child(2) {
	  left: 8px;
	  animation: lds-ellipsis2 0.6s infinite;
	}
	.lds-ellipsis div:nth-child(3) {
	  left: 32px;
	  animation: lds-ellipsis2 0.6s infinite;
	}
	.lds-ellipsis div:nth-child(4) {
	  left: 56px;
	  animation: lds-ellipsis3 0.6s infinite;
	}
	@keyframes lds-ellipsis1 {
	  0% {
		transform: scale(0);
	  }
	  100% {
		transform: scale(1);
	  }
	}
	@keyframes lds-ellipsis3 {
	  0% {
		transform: scale(1);
	  }
	  100% {
		transform: scale(0);
	  }
	}
	@keyframes lds-ellipsis2 {
	  0% {
		transform: translate(0, 0);
	  }
	  100% {
		transform: translate(24px, 0);
	  }
	}
	
	<?php echo $custom_css; ?>
</style>