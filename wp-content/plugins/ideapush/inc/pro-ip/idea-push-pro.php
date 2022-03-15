<?php
//pro stuff

//include pro options
require('options-output.php');

//include leaderboard
if(file_exists(get_stylesheet_directory().'/ideapush/leader-board.php')) {
    require(get_stylesheet_directory().'/ideapush/leader-board.php');      
} else {
    require('leader-board.php');    
}

//include comments widget
if(file_exists(get_stylesheet_directory().'/ideapush/comments-widget.php')) {
    require(get_stylesheet_directory().'/ideapush/comments-widget.php');      
} else {
    require('comments-widget.php');    
}

//include recent ideas
require('recent-ideas.php');

//include widgets
require('custom-widgets.php');

//include vote credit
//used when ideas are approved, rejected, deleted
require('vote-credit.php');

//include comment comment
require('comments.php');

//include pro script
// Load frontend  style and scripts
function idea_push_register_frontend_pro_styles(){
    
    //css

    //js
    wp_register_script( 'custom-frontend-script-ideapush-pro', plugins_url( 'frontendscriptpro.js', __FILE__ ), array( 'jquery'), idea_push_plugin_get_version());
    
    wp_localize_script('custom-frontend-script-ideapush-pro','get_suggested_ideas', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
    wp_localize_script('custom-frontend-script-ideapush-pro','get_suggested_tags', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
    wp_localize_script('custom-frontend-script-ideapush-pro','user_delete_idea', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
    wp_localize_script('custom-frontend-script-ideapush-pro','user_edit_idea', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
    wp_localize_script('custom-frontend-script-ideapush-pro','merge_duplicate_ideas', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
    wp_localize_script('custom-frontend-script-ideapush-pro','get_idea_comments', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
    wp_localize_script('custom-frontend-script-ideapush-pro','post_idea_comment', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
    
}
add_action( 'wp_enqueue_scripts', 'idea_push_register_frontend_pro_styles' );





// Load styles and scripts for the single idea page
function idea_push_register_admin_styles_pro($hook){
    
    global $idea_push_wp_reports_page;
    
    global $post_type;
    
    if($hook != $idea_push_wp_reports_page && 'idea' != $post_type)
    return;

    //css
    wp_enqueue_style( 'custom-admin-style-ideapush-pro', plugins_url( 'idea-post.css', __FILE__ ));
    wp_enqueue_style( 'font-awesome', plugins_url( '../css/font-awesome.min.css', __FILE__ ));
    
    
    
    //js
    wp_enqueue_script('read-more', plugins_url('../js/readmore.min.js', __FILE__ ), array( 'jquery'));
    wp_enqueue_script( 'custom-frontend-script-pro-single-idea', plugins_url( 'singleideascriptpro.js', __FILE__ ), array( 'jquery'), '1.0.0');
    wp_enqueue_script('alertify', plugins_url('/../js/alertify.js', __FILE__ ), array( 'jquery'),null,true);  
    wp_enqueue_script('jquery-ui-dialog');
    wp_enqueue_script('chart','https://www.gstatic.com/charts/loader.js');

}
add_action( 'admin_enqueue_scripts', 'idea_push_register_admin_styles_pro' );
























//get suggested ideas
// function idea_push_fetch_suggested_idea(){

//         $boardNumber = idea_push_sanitization_validation($_POST['boardNumber'],'id');
//         $titleValue = $_POST['titleValue'];
//         $descriptionValue = $_POST['descriptionValue'];
        
//         if($boardNumber == false){
//             wp_die();       
//         }    
    

//         //lets create the query
//         //we dont need to make this query to speficific as we want to get all ideas regardless of status because someone might be searching for an idea already completed or about to be implemented
//         $args = array(
//             'post_type' => 'idea',
//             'post_status' => 'publish',
//             'posts_per_page' => -1,
//             'tax_query' => array(
//                 array(
//                     'taxonomy' => 'boards',
//                     'field'    => 'term_id',
//                     'terms'    => array($boardNumber)
//                 )
//             )
//         );
    
//         $ideaPosts = get_posts($args);
    
//         if(empty($ideaPosts)){
//             //there aren't any posts so there's nothing to suggest!
//             echo '';
//             wp_die();
//         }
        
//         $highestMatchScore = 0;
//         $highestMatchId = '';
    

//         foreach($ideaPosts as $ideaPost){
            
//             //get post variables
//             $postId = $ideaPost->ID;
//             $postTitle = $ideaPost->post_title;
//             $postContent = $ideaPost->post_content;
            
//             //get the comparison scores
// //            $titleScore = idea_push_string_comparison($postTitle,$titleValue);
// //            $contentScore = idea_push_string_comparison($postContent,$descriptionValue);
//             $totalScore = idea_push_string_comparison($titleValue,$postTitle,$descriptionValue,$postContent,'','');
//             //get the total
// //            $totalScore = idea_push_string_comparison($titleValue,$postTitle,$descriptionValue,$postContent);
            
            
            
//             if($totalScore>$highestMatchScore){
//                 $highestMatchScore = $totalScore;
//                 $highestMatchId = $postId;
//             }
          
//         }
    
//         //only echo the post if some relevancy was found
//         if($highestMatchScore > 0){
        
//             //echo the match
            
//             $html = '';
            
//             $html .= '<div class="suggested-idea-inner">';
            
// //                $html .= '<i class="far fa-question-circle question-mark-icon"></i>'; 


            
//                 $html .= '<span class="suggestion-question">'.__( 'Has your idea already been submitted?', 'ideapush' ).'</span>';
//                 $html .= '<a class="suggestion-title" href="'.esc_url(get_post_permalink($highestMatchId)).'">'.esc_html(html_entity_decode(get_the_title($highestMatchId))).'</a>';
//                 $html .= '<span class="suggestion-content">'.mb_substr(htmlentities(strip_tags(get_post_field('post_content',$highestMatchId,'raw'))),0,150).'...</span>';
//             $html .= '</div>';

//             echo $html;
            
//         } else {
            
//             echo '';
//         }
            
//         wp_die(); 

//     } //end function
// add_action( 'wp_ajax_get_suggested_ideas', 'idea_push_fetch_suggested_idea' );
// add_action( 'wp_ajax_nopriv_get_suggested_ideas', 'idea_push_fetch_suggested_idea' );






function idea_push_string_comparison($providedTitle,$postTitle,$providedContent,$postContent,$providedTags,$postTags){

    $providedTitleArray = explode(" ", $providedTitle);
    $postTitleArray = explode(" ", $postTitle);
    $providedContentArray = explode(" ", $providedContent);
    $postContentArray = explode(" ", $postContent);

    $providedTitleFiltered = idea_push_filterArray($providedTitleArray);
    $postTitleFiltered = idea_push_filterArray($postTitleArray);
    $providedContentFiltered = idea_push_filterArray($providedContentArray);
    $postContentFiltered = idea_push_filterArray($postContentArray);
    
    //we dont need to filter tags because we can assume that because it is a tag it is important and has been vetted
    
    
    
    //now lets compare the arrays
    
    
    $matchingTitlesScore = 0;
    
    //this double loop is better than array_intersect because it picks up doubles and triples
    foreach($providedTitleFiltered as $providedTitleItem){
        foreach($postTitleFiltered as $postTitleItem){
            if($postTitleItem == $providedTitleItem) {
                $matchingTitlesScore++;    
            } 
        }  
    }
    
    $matchingContentScore = 0;
    
    //this double loop is better than array_intersect because it picks up doubles and triples
    foreach($providedContentFiltered as $providedContentItem){
        foreach($postContentFiltered as $postContentItem){
            if($postContentItem == $providedContentItem) {
                $matchingContentScore++;    
            } 
        }  
    }
    
    
    $matchingTagScore = 0;
    
    
    if(is_array($providedTags) && is_array($postTags)){
        
        //this double loop is better than array_intersect because it picks up doubles and triples
        foreach($providedTags as $providedTag){
            foreach($postTags as $postTag){
                if($postTag == $providedTag) {
                    $matchingTagScore++;    
                } 
            }  
        }      
    }
    

 
    
    //lets give more emphasis to tags, followed by titles, followed by content
    $comparisonScore = ($matchingTagScore*3) + ($matchingTitlesScore*2) + $matchingContentScore;

    return $comparisonScore;
  
}
    

 //now lets remove values that are less than 3 characters and not in array
function idea_push_filterArray($explodedArray){
    
    
    //declaration of common words
    $commonWords = array('a','able','about','above','abroad','according','accordingly','across','actually','adj','after','afterwards','again','against','ago','ahead','ain\'t','all','allow','allows','almost','alone','along','alongside','already','also','although','always','am','amid','amidst','among','amongst','an','and','another','any','anybody','anyhow','anyone','anything','anyway','anyways','anywhere','apart','appear','appreciate','appropriate','are','aren\'t','around','as','a\'s','aside','ask','asking','associated','at','available','away','awfully','b','back','backward','backwards','be','became','because','become','becomes','becoming','been','before','beforehand','begin','behind','being','believe','below','beside','besides','best','better','between','beyond','both','brief','but','by','c','came','can','cannot','cant','can\'t','caption','cause','causes','certain','certainly','changes','clearly','c\'mon','co','co.','com','come','comes','concerning','consequently','consider','considering','contain','containing','contains','corresponding','could','couldn\'t','course','c\'s','currently','d','dare','daren\'t','definitely','described','despite','did','didn\'t','different','directly','do','does','doesn\'t','doing','done','don\'t','down','downwards','during','e','each','edu','eg','eight','eighty','either','else','elsewhere','end','ending','enough','entirely','especially','et','etc','even','ever','evermore','every','everybody','everyone','everything','everywhere','ex','exactly','example','except','f','fairly','far','farther','few','fewer','fifth','first','five','followed','following','follows','for','forever','former','formerly','forth','forward','found','four','from','further','furthermore','g','get','gets','getting','given','gives','go','goes','going','gone','got','gotten','greetings','h','had','hadn\'t','half','happens','hardly','has','hasn\'t','have','haven\'t','having','he','he\'d','he\'ll','hello','help','hence','her','here','hereafter','hereby','herein','here\'s','hereupon','hers','herself','he\'s','hi','him','himself','his','hither','home','hopefully','how','howbeit','however','hundred','i','i\'d','ie','if','ignored','i\'ll','i\'m','immediate','izn','inasmuch','inc','inc.','indeed','indicate','indicated','indicates','inner','inside','insofar','instead','into','inward','is','isn\'t','it','it\'d','it\'ll','its','it\'s','itself','i\'ve','j','just','k','keep','keeps','kept','know','known','knows','l','last','lately','later','latter','latterly','least','less','lest','let','let\'s','like','liked','likely','likewise','little','look','looking','looks','low','lower','ltd','m','made','mainly','make','makes','many','may','maybe','mayn\'t','me','mean','meantime','meanwhile','merely','might','mightn\'t','mine','minus','miss','more','moreover','most','mostly','mr','mrs','much','must','mustn\'t','my','myself','n','name','namely','nd','near','nearly','necessary','need','needn\'t','needs','neither','never','neverf','neverless','nevertheless','new','next','nine','ninety','no','nobody','non','none','nonetheless','noone','no-one','nor','normally','not','nothing','notwithstanding','novel','now','nowhere','o','obviously','of','off','often','oh','ok','okay','old','on','once','one','ones','one\'s','only','onto','opposite','or','other','others','otherwise','ought','oughtn\'t','our','ours','ourselves','out','outside','over','overall','own','p','particular','particularly','past','per','perhaps','placed','please','plus','possible','presumably','probably','provided','provides','q','que','quite','qv','r','rather','rd','re','really','reasonably','recent','recently','regarding','regardless','regards','relatively','respectively','right','round','s','said','same','saw','say','saying','says','second','secondly','see','seeing','seem','seemed','seeming','seems','seen','self','selves','sensible','sent','serious','seriously','seven','several','shall','shan\'t','she','she\'d','she\'ll','she\'s','should','shouldn\'t','since','six','so','some','somebody','someday','somehow','someone','something','sometime','sometimes','somewhat','somewhere','soon','sorry','specified','specify','specifying','still','sub','such','sup','sure','t','take','taken','taking','tell','tends','th','than','thank','thanks','thanx','that','that\'ll','thats','that\'s','that\'ve','the','their','theirs','them','themselves','then','thence','there','thereafter','thereby','there\'d','therefore','therein','there\'ll','there\'re','theres','there\'s','thereupon','there\'ve','these','they','they\'d','they\'ll','they\'re','they\'ve','thing','things','think','third','thirty','this','thorough','thoroughly','those','though','three','through','throughout','thru','thus','till','to','together','too','took','toward','towards','tried','tries','truly','try','trying','t\'s','twice','two','u','un','under','underneath','undoing','unfortunately','unless','unlike','unlikely','until','unto','up','upon','upwards','us','use','used','useful','uses','using','usually','v','value','various','versus','very','via','viz','vs','w','want','wants','was','wasn\'t','way','we','we\'d','welcome','well','we\'ll','went','were','we\'re','weren\'t','we\'ve','what','whatever','what\'ll','what\'s','what\'ve','when','whence','whenever','where','whereafter','whereas','whereby','wherein','where\'s','whereupon','wherever','whether','which','whichever','while','whilst','whither','who','who\'d','whoever','whole','who\'ll','whom','whomever','who\'s','whose','why','will','willing','wish','with','within','without','wonder','won\'t','would','wouldn\'t','x','y','yes','yet','you','you\'d','you\'ll','your','you\'re','yours','yourself','yourselves','you\'ve','z','zero');

    $returnArray = array();

    foreach($explodedArray as $item){

        //make lowercase
        $item = strtolower($item);

        if( strlen($item)>2 && !in_array($item,$commonWords)){
            array_push($returnArray,$item);    
        }

    }
    return $returnArray; 
}









//add content at the top of the post
function idea_push_related_posts( $content ) {
    if ( is_single() && 'idea' == get_post_type()) {

        //get the normal content
        $custom_content = $content;
        
        
        //get the plugin settings
        $options = get_option('idea_push_settings');

        
        //only show related content if enabled in the plugin settings
        if(isset($options['idea_push_enable_related_ideas'])){
            
            //get the post idea
            $ideaId = get_the_ID();

            //get the board id for the post
            $boardId = idea_push_get_board_id_from_post_id($ideaId);
            
            $getBoardSettings = idea_push_get_board_settings($boardId);
            
            
            $showBoardTo = $getBoardSettings[14];
            $multiIp = $getBoardSettings[27];

            if(!isset($multiIp)){
                $multiIp = 'No';
            }
            
            $currentUserId = idea_push_check_if_non_logged_in_user_is_guest($multiIp);
            
            if($currentUserId == false){
                $currentUserRole = array();   
            } else {
                $currentUserObject = get_user_by( 'id', $currentUserId);
                $currentUserRole = $currentUserObject->roles;
            }
            
            if(in_array($showBoardTo, $currentUserRole) || $showBoardTo == "Everyone"){  
                

                //get the idea title
                $ideaTitle = get_the_title($ideaId);

                //get the idea content
                $ideaContent = get_post_field('post_content',$ideaId,'raw');

                //get the idea tags
                $ideaTags = get_the_terms($ideaId,'tags');

                $ideaTagsStorage = array();

                //check to see if tags exist
                if(!empty($ideaTags)){
                    foreach($ideaTags as $ideaTag){
                        array_push($ideaTagsStorage,strtolower($ideaTag->name));
                    }
                }






                //do a query where we get all relevant posts
                $args = array(
                    'post_type' => 'idea',
                    'post_status' => 'publish',
                    'posts_per_page' => -1,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'boards',
                            'field'    => 'term_id',
                            'terms'    => array($boardId)
                        )
                    )
                );

                $ideaPosts = get_posts($args);

                //if the query isn't empty
                if(!empty($ideaPosts)){

                    //unfortunately because the scores could be the same we need to make the key of the associative array the post id and not the vote
                    $scoresAssociativeArray = array();

                    foreach($ideaPosts as $ideaPost){
                        //loop through each post

                        //then compare each post to the original title and content
                        //get post variables
                        $comparisonId = $ideaPost->ID;
                        $comparisonTitle = $ideaPost->post_title;
                        $comparisonContent = $ideaPost->post_content;


                        //get the idea tags
                        $comparisonTags = get_the_terms($comparisonId,'tags');

                        $comparisonTagsStorage = array();

                        //check to see if tags exist
                        if(!empty($comparisonTags)){
                            foreach($comparisonTags as $comparisonTag){
                                array_push($comparisonTagsStorage,strtolower($comparisonTag->name));
                            }
                        }





                        //if the ids are the same don't do the comparison because its an exact match and we want to show different ideas!
                        if($comparisonId !== $ideaId){
                            //get relevancy score
                            $relevancyScore = idea_push_string_comparison($ideaTitle,$comparisonTitle,$ideaContent,$comparisonContent,$ideaTagsStorage,$comparisonTagsStorage);

                            //add to associative array
                            $scoresAssociativeArray[$comparisonId] = $relevancyScore;    

                        }



                    }    


                    //then sort the array by largest to smallest
                    arsort($scoresAssociativeArray);



                    //add our additional content to the bottom of the post

                    $custom_content .= '<div class="ideapush-container related-ideas-section" data="'.$ideaId.'">';

                    $custom_content .= '<h3 class="ideapush-related-main-heading">'.__( 'Related Ideas', 'ideapush' ).'</h3>';

                    //then loop through the first 3 i.e. the largest

                    $custom_content .= '<div class="related-idea-item-container">';

                        $counter = 0;

                        foreach($scoresAssociativeArray as $key => $value){

                            if($counter++ > 2) break;

                            //get id
                            $relatedIdeaId = $key;

                            //idea title
                            $relatedIdeaTitle = esc_html(html_entity_decode(get_the_title($relatedIdeaId)));

                            //idea content
                            $relatedIdeaContent = substr(htmlentities(strip_tags(get_post_field('post_content',$relatedIdeaId,'raw'))),0,150);

                            //idea link
                            $relatedIdeaLink = esc_url(get_permalink($relatedIdeaId));

                            //featured image
                            $relatedIdeaImage = esc_url(get_the_post_thumbnail_url($relatedIdeaId,'medium-large'));
                            $relatedIdeaImageClass = 'related-image'; 

                            if($relatedIdeaImage==false){
                                $relatedIdeaImage = plugins_url( '../images/default-idea-image.png', __FILE__ );  
                                $relatedIdeaImageClass = 'no-related-image'; 
                            }


                            //get status
                            $relatedIdeaStatus = get_the_terms($relatedIdeaId,'status');
                            $relatedIdeaStatus = $relatedIdeaStatus[0]->slug;

                            //get date
                            $relatedIdeaDate = esc_html(human_time_diff(strtotime(get_the_date('c', $relatedIdeaId )), current_time( 'timestamp' ) )).' '.__( 'ago','ideapush' );




                            $custom_content .= '<div class="related-idea-item">'; 


                                $custom_content .= '<h4 class="related-idea-title"><a href="'.$relatedIdeaLink.'">'; 
                                     $custom_content .= $relatedIdeaTitle; 
                                $custom_content .= '</a></h4>'; 

                                $custom_content .= '<span class="related-idea-meta">'; 
                                    $custom_content .= idea_push_render_status($relatedIdeaStatus,'ONLY');
                                    $custom_content .= '<span class="related-idea-date">'.$relatedIdeaDate.'</span>';
                                $custom_content .= '</span>';


                                $custom_content .= '<span class="related-idea-content">'; 
                                     $custom_content .= $relatedIdeaContent.'...<a class="related-idea-read-more" href="'.$relatedIdeaLink.'">'.__( 'Read more', 'ideapush' ).' <i class="ideapush-icon-Submit"></i></a>'; 
                                $custom_content .= '</span>'; 



                                $custom_content .= '<a class="related-idea-feature-image '.$relatedIdeaImageClass.'" href="'.$relatedIdeaLink.'"><img alt="'.$relatedIdeaTitle.'" src="'.$relatedIdeaImage.'" /></a>'; 

                            $custom_content .= '</div>';



                        }


                        $custom_content .= '</div>';

                    $custom_content .= '</div>';     

                } 
                
            } else {
                
                #comments
                $html = '<style>#comments{display: none!important}</style>';
                
                $html .= '<div id="remove-comments"></div>';
                $html .= __( 'Sorry you do not have permission to view this idea.', 'ideapush' );

                return $html; 
            }
            
        } //end is set option
        
        return $custom_content;
        
    } else {
        //the post is not an idea post and not a post
        return $content;
    }
}
add_filter( 'the_content', 'idea_push_related_posts' );
















//function that adds an item to the idea history meta
function idea_push_add_idea_history_item($ideaId,$type,$user,$content,$recipient){

    // $type (either: CREATED, EMAIL, AUTOMATED EMAIL, NOTE, VOTE THRESHOLD, STATUS)
    // $user (the user id who is responsible for the action)
    // $content (the content of the history item)
    // $recipient (either: ADMIN, VOTERS, AUTHOR)
    
    $currentTime = current_time( 'timestamp', 0 );
    
    //remove pipes from the content if they exist
    //$content = str_replace("|","",$content);
    
    //if no recipient make it N/A that way the splitting can still work as expected
    if($recipient == ''){
        $recipient = 'NA';    
    }
    
    if($user == ''){
        $user = 'NA';    
    }
    
    
    //lets do some smarts for the content in case there's empty values in the emails
    $contentExploded = explode("|", $content);
    
    $newContent = array();
    
    foreach($contentExploded as $contentItem){
        
        if($contentItem == ''){
            array_push($newContent," ");   
        } else {
            array_push($newContent,$contentItem);     
        }       
    }
    
    $content = implode('|',$newContent);
    
    
    
    //new itea history item
    $newIdeaHistoryItem = $currentTime.'||'.$type.'||'.$user.'||'.$content.'||'.$recipient.'|||';
    
    //get post meta
    $existingIdeaHistory = get_post_meta($ideaId,'idea-history',true);
    
    //if there's existing information tack the new iteam item to the end
    if($existingIdeaHistory !== ''){ 
        $newIdeaHistoryItem = $existingIdeaHistory.$newIdeaHistoryItem;
    }
    
    //now update the post meta
    update_post_meta($ideaId,'idea-history',$newIdeaHistoryItem);
    
    //sample
    //    1519674137|CREATED|1|Test of Heading|NA||
     
}







//Created


//we are going to use this action instead of the above hook that way the created history line item shows for ideas created both in the front and backend
add_action('transition_post_status','idea_push_add_published_post_to_timeline',10,3);
function idea_push_add_published_post_to_timeline($new, $old, $post) {

    
	// On first publish
	if ($new == 'publish' && $old != 'publish' && isset($post->post_type) && $post->post_type == 'idea') {
		
        idea_push_add_idea_history_item($post->ID,'CREATED',$post->post_author,$post->post_title,'');  
        
        
        //we only want to do this line if idea created in backend otherwise it will be done twice
        
        $createdInFrontend = get_post_meta($post->ID,'frontend-created', true);
        
        if($createdInFrontend !== 'true'){
            //add action here as well so zendesk integration can fire if necessary
            do_action('idea_push_after_idea_created',$post->ID,$post->post_author,$post->post_title,$post->post_content);    
            
        }
        
        

	}
    
    
    
    
    
    
}








//Admin notifications automated
//admin notification when idea is created
function idea_push_add_idea_history_item_idea_created_admin_notification($newIdeaId,$content){
    
    //add item to meta
    idea_push_add_idea_history_item($newIdeaId,'AUTOMATED EMAIL','',$content,'Administrator');

}
add_action( 'idea_push_idea_created_admin_notification', 'idea_push_add_idea_history_item_idea_created_admin_notification',10,2);


//admin notification when the vote threshold is reached
function idea_push_add_idea_history_item_vote_threshold_admin_notification($ideaId,$content){
    
    //add item to meta
    idea_push_add_idea_history_item($ideaId,'AUTOMATED EMAIL','',$content,'Administrator');

}
add_action( 'idea_push_idea_review_admin_notification', 'idea_push_add_idea_history_item_vote_threshold_admin_notification',10,2);






//author notifications automated
//author notification when an idea is published
function idea_push_add_idea_history_item_idea_published_author_notification($newIdeaId,$content){
    
    //add item to meta
    idea_push_add_idea_history_item($newIdeaId,'AUTOMATED EMAIL','',$content,'Author');

}
add_action( 'idea_push_idea_created_published_author_notification', 'idea_push_add_idea_history_item_idea_published_author_notification',10,2);


//author notification when an idea is pending review for admin approval
function idea_push_add_idea_history_item_idea_reviewed_author_notification($newIdeaId,$content){
    
    //add item to meta
    idea_push_add_idea_history_item($newIdeaId,'AUTOMATED EMAIL','',$content,'Author');

}
add_action( 'idea_push_idea_created_reviewed_author_notification', 'idea_push_add_idea_history_item_idea_reviewed_author_notification',10,2);


//author notification when an idea has been voted on
function idea_push_add_idea_history_item_idea_vote_author_notification($ideaId,$content){
    
    //add item to meta
    idea_push_add_idea_history_item($ideaId,'AUTOMATED EMAIL','',$content,'Author');

}
add_action( 'idea_push_idea_vote_author_notification', 'idea_push_add_idea_history_item_idea_vote_author_notification',10,2);


//author notification when a vote has been cast and it has now changed the status from open to reviewed
function idea_push_add_idea_history_item_idea_vote_author_notification_review($ideaId,$content){
    
    //add item to meta
    idea_push_add_idea_history_item($ideaId,'AUTOMATED EMAIL','',$content,'Author');

}
add_action( 'idea_push_idea_vote_author_notification_review', 'idea_push_add_idea_history_item_idea_vote_author_notification_review',10,2);


//author notification when a status has changed
function idea_push_add_idea_history_item_status_change_author_notification($ideaId,$content){
    
    //add item to meta
    idea_push_add_idea_history_item($ideaId,'AUTOMATED EMAIL','',$content,'Author');

}
add_action( 'idea_push_idea_status_change_author_notification', 'idea_push_add_idea_history_item_status_change_author_notification',10,2);



//author notification when an idea goes from on hold/pending to published
function idea_push_add_idea_published_after_pending_author_notification($ideaId,$content){
    
    //add item to meta
    idea_push_add_idea_history_item($ideaId,'AUTOMATED EMAIL','',$content,'Author');

}
add_action( 'idea_push_idea_published_after_pending_author_notification', 'idea_push_add_idea_published_after_pending_author_notification',10,2);








//voter notifications automated
//voter notification when they cast a vote for something that has reached the review stage
function idea_push_add_idea_history_item_idea_vote_voter_notification($ideaId,$content){
    
    //add item to meta
    idea_push_add_idea_history_item($ideaId,'AUTOMATED EMAIL','',$content,'Voter');

}
add_action( 'idea_push_idea_vote_voter_notification', 'idea_push_add_idea_history_item_idea_vote_voter_notification',10,2);


//voter notification when the idea they voted on changes status
function idea_push_add_idea_history_item_status_change_voter_notification($ideaId,$content){
    
    //add item to meta
    idea_push_add_idea_history_item($ideaId,'AUTOMATED EMAIL','',$content,'Voter');

}
add_action( 'idea_push_idea_status_change_voter_notification', 'idea_push_add_idea_history_item_status_change_voter_notification',10,2);














//status changed
//generic when status has changed
function idea_push_add_idea_history_item_status_change($ideaId,$currentUser,$content){
    
    //add item to meta
    idea_push_add_idea_history_item($ideaId,'STATUS',$currentUser,$content,'');

}
add_action( 'idea_push_idea_status_change', 'idea_push_add_idea_history_item_status_change',10,3);

















//vote threshold
//generic when vote threshold has been achieved
function idea_push_add_idea_history_item_vote_threshold($ideaId,$content){
    
    //add item to meta
    idea_push_add_idea_history_item($ideaId,'VOTE THRESHOLD','',$content,'');

}
add_action( 'idea_push_idea_vote_threshold', 'idea_push_add_idea_history_item_vote_threshold',10,2);



















 add_action( 'add_meta_boxes', 'idea_push_add_metaboxes_pro');
 function idea_push_add_metaboxes_pro() {
     add_meta_box( 'idea-history-div', 'Idea History','idea_push_idea_history_metabox','idea' ,'normal','core');
     add_meta_box( 'idea-history-note-div', 'Idea Internal Note','idea_push_idea_internal_note_metabox','idea' ,'normal','core');
     add_meta_box( 'idea-history-email-div', 'Send Email','idea_push_idea_send_email_metabox','idea' ,'normal','core');
     add_meta_box( 'custom-fields-div', 'Custom Fields','idea_push_custom_fields_metabox','idea' ,'normal','core');
     add_meta_box( 'idea-positive-voters', 'Positive Voters','idea_push_positive_voters_metabox','idea' ,'normal','core');
     add_meta_box( 'idea-negative-voters', 'Negative Voters','idea_push_negative_voters_metabox','idea' ,'normal','core');
 }


 function idea_push_positive_voters_metabox( $post ) {

    $post_id = $post->ID;


    if(get_post_meta($post_id,'up-voters',true)){

        //get voters
        $voters = get_post_meta($post_id,'up-voters',true);

        //only continue if voters exist
        if(is_array($voters) && count($voters)){
            //start output
            echo '<ul class="voters-listing">';

                //loop through voters
                foreach($voters as $voter){

                    $user_id = $voter[0];
                    $vote_time = $voter[1];
                    $user_object = get_userdata($user_id);

                    $voter_name = $user_object->first_name.' '.$user_object->last_name;
                    $voter_edit_link = get_admin_url().'user-edit.php?user_id='.$user_id;

                    $vote_time_nice = date_i18n(get_option( 'date_format' ) .' '.get_option( 'time_format' ),$vote_time);

                    echo '<li>';

                        //do image
                        echo '<img class="idea-author-profile-image" src="'.esc_url(idea_push_get_user_avatar($user_id)).'" />';
                        //do text

                        echo '<a href="'.$voter_edit_link.'">'.$voter_name.'</a> <em>'.$vote_time_nice.'</em>';
                    echo '</li>';
                }

            echo '</ul>';
        }
    }

 }

 function idea_push_negative_voters_metabox( $post ) {

    $post_id = $post->ID;

    //get voters
    $voters = get_post_meta($post_id,'down-voters',true);

    //only continue if voters exist
    if(count($voters)){
        //start output
        echo '<ul class="voters-listing">';

            //loop through voters
            foreach($voters as $voter){

                $user_id = $voter[0];
                $vote_time = $voter[1];
                $user_object = get_userdata($user_id);

                $voter_name = $user_object->first_name.' '.$user_object->last_name;
                $voter_edit_link = get_admin_url().'user-edit.php?user_id='.$user_id;

                $vote_time_nice = date_i18n(get_option( 'date_format' ) .' '.get_option( 'time_format' ),$vote_time);

                echo '<li>';

                    //do image
                    echo '<img class="idea-author-profile-image" src="'.esc_url(idea_push_get_user_avatar($user_id)).'" />';
                    //do text

                    echo '<a href="'.$voter_edit_link.'">'.$voter_name.'</a> <em>'.$vote_time_nice.'</em>';
                echo '</li>';
            }

        echo '</ul>';
    }

 }


function idea_push_custom_fields_metabox( $post ) {
    echo '<div class="custom-field-table-container">';

        //here we will have the add new meta option
        echo '<button data-post-id="'.$post->ID.'" class="add-custom-meta ui-button">'.__('Add Custom Field Value','ideapush').'</button>';

        echo '<table class="custom-field-table">';

            echo '<thead>';
                echo '<tr>';
                    echo '<th>'.__( 'Custom Field Name', 'ideapush' ).'</th>'; 
                    echo '<th>'.__( 'Custom Field Value', 'ideapush' ).'</th>'; 
                    echo '<th>'.__( 'Update Field Value', 'ideapush' ).'</th>'; 
                echo '</tr>';
            echo '</thead>';


            //cycle through custom fields
            //get post meta
            $postMeta = get_post_meta($post->ID,'',true);
            foreach($postMeta as $key => $value){

                //check if key has our special prefix
                if(strpos($key, 'ideapush-custom-field-') !== false) {


                    echo '<tr>';
                        echo '<td>'.str_replace("ideapush-custom-field-","",$key).'</td>';
                        echo '<td>';
                            echo '<input class="custom-field-update-field" type="text" value="'.$value[0].'">';
                        echo '</td>';

                        echo '<td>';
                            echo '<button class="custom-field-update-button" data-post-id="'.$post->ID.'" data-meta-key="'.$key.'"><i class="fa fa-check-circle-o" aria-hidden="true"></i> '.__( 'Update', 'ideapush' ).'</button>';
                        echo '</td>';
                    echo '</tr>';

                }    

            }

        echo '</table>';
    echo '</div>';

}    



function idea_push_idea_send_email_metabox( $post ) {
    echo '<div style="padding-bottom: 0px !important;" class="inside">';
    
    echo '<span style="top: 8px; position: relative;">'.__( 'To: ', 'ideapush' ).'</span><select class="email-audience">';
    
    echo '<option val="Positive Voters">'.__( 'Positive Voters', 'ideapush' ).'</option>';
    echo '<option val="Idea Author">'.__( 'Idea Author', 'ideapush' ).'</option>';
    
    echo '</select>';
    
    $shortcodesVoter = array('[Idea Title]','[Idea Content]','[Board Name]','[Idea Link]','[Vote Count]','[Author First Name]','[Author Last Name]','[Voter First Name]','[Voter Last Name]');
    
    echo '<ul class="shortcode-list-voter">';
    
    foreach ($shortcodesVoter as $shortcode){
        echo '<li class="shortcode-item">'.$shortcode.'</li>';      
    }
    
    echo '</ul>';
        
        
    $shortcodesAuthor = array('[Idea Title]','[Idea Content]','[Board Name]','[Idea Link]','[Vote Count]','[Author First Name]','[Author Last Name]');    
    
    
    echo '<ul class="shortcode-list-author" style="display:none;">';
    
    foreach ($shortcodesAuthor as $shortcode){
        echo '<li class="shortcode-item">'.$shortcode.'</li>';      
    }
    
    echo '</ul>';
        
    echo '<div class="last-item-focused" style="display:none;" data=""></div>';
    
    echo '<input placeholder="'.__( 'Email subject', 'ideapush' ).'" class="email-subject">';
    
    echo '<textarea placeholder="'.__( 'Email message', 'ideapush' ).'" rows="7" class="email-content"></textarea>';
    
    echo '<button data="'.$post->ID.'" class="single-idea-submit-button send-email">'.__( 'Submit', 'ideapush' ).'</button>';

    echo '</div>';  
}



function idea_push_idea_internal_note_metabox( $post ) {
    echo '<div style="padding-bottom: 0px !important;" class="inside">';
    echo '<textarea placeholder="'.__( 'Add an internal note to the idea history timeline', 'ideapush' ).'" rows="7" class="internal-note-text-area"></textarea>';
    echo '<button data="'.$post->ID.'" class="single-idea-submit-button add-internal-note-to-timeline">'.__( 'Submit', 'ideapush' ).'</button>';

    echo '</div>';  
}





function idea_push_idea_history_metabox( $post ) {
    
    $html = '<div style="padding-bottom: 0px !important;" class="inside"><ul class="idea-history-list">';    
    $html .=  idea_push_html_of_idea_history($post->ID);
    $html .= '</ul></div>'; 
    echo $html;
    
}







function idea_push_html_of_idea_history($ideaId){
    
    //declare the initial variable
    $html = '';
    $counter = 0;
    
    
    $ideaHistoryMeta = get_post_meta($ideaId, 'idea-history', true);	
	

    $ideaHistoryArray = explode('|||',$ideaHistoryMeta);
    
    foreach($ideaHistoryArray as $historyItem){
        
        if(!empty($historyItem)){
            
            //split the history item into necessary chunks
            $ideaHistoryArrayExplosion = explode('||',$historyItem);
            
            //set the variables
            $time = $ideaHistoryArrayExplosion[0];
            $type = $ideaHistoryArrayExplosion[1];
            $user = $ideaHistoryArrayExplosion[2];
            $content = $ideaHistoryArrayExplosion[3];
            $recipient = $ideaHistoryArrayExplosion[4];
            
            //further splitting of content
            $contentExploded = explode('|',$content);
            
            
            //get class necessary to add to the item, this is because we want the note to be different to the rest
            if($type == 'NOTE'){
                $listClass = 'note-item';
            } else {
                $listClass = 'normal-item';    
            }
            
            
            //lets go through the different types and set the icon colour, icon background and icon type
            switch ($type){
                
                case 'CREATED':
                    $iconType = 'fa-rocket';
                    $iconColor = '#ffffff';
                    $iconBackground = '#4eb5e1';
                    $title = __( 'Idea Created', 'ideapush' );
                    $content = '<strong>'.__( 'Idea Title', 'ideapush' ).'</strong></br>'.$content;
            
                    
                    break;
                case 'EMAIL':
                    $iconType = 'fa-envelope-o';
                    $iconColor = '#23272c';
                    $iconBackground = '#ffffff';
                    $title = __( 'Email Sent to', 'ideapush' ).' '.$recipient;
                    
                    $subject = $contentExploded[0];
                    $emailContent = $contentExploded[1];     
                    
                    $content = '<strong>'.__( 'Email Subject', 'ideapush' ).'</strong></br>';
                    $content .= $subject.'<br></br>';
                    $content .= '<strong>'.__( 'Email Content', 'ideapush' ).'</strong></br>';
                    $content .= $emailContent;
                    
                    break;
                
                case 'AUTOMATED EMAIL':
                    $iconType = 'fa-bolt';
                    $iconColor = '#23272c';
                    $iconBackground = '#ffffff';
                    $title = __( 'Automated Email Sent to', 'ideapush' ).' '.$recipient;
                    
                    $subject = $contentExploded[0];
                    $emailContent = $contentExploded[1];     
                    
                    $content = '<strong>'.__( 'Email Subject', 'ideapush' ).'</strong></br>';
                    $content .= $subject.'<br></br>';
                    $content .= '<strong>'.__( 'Email Content', 'ideapush' ).'</strong></br>';
                    $content .= $emailContent;
                    
                    break;
                    
                case 'NOTE':
                    $iconType = 'fa-sticky-note-o';
                    $iconColor = '#23272c';
                    $iconBackground = '#f3f3f4';
                    $title = __( 'Internal Note', 'ideapush' );
                    
                    break;
                    
                case 'VOTE THRESHOLD':
                    $iconType = 'fa-trophy';
                    $iconColor = '#ffffff';
                    $iconBackground = '#fbbf67';
                    $title = __( 'Vote Threshold Achieved', 'ideapush' );
                    $content = __( 'Vote threshold reached with', 'ideapush' ).' <strong>'.$content.'</strong> '.__( 'votes reached. Idea has changed status from open to reviewed.', 'ideapush' );
                    
                    break;
                    
                case 'STATUS':
                    
                    $iconType = 'fa-random';
                    $iconColor = '#ffffff';
                    
                    if($contentExploded[1] == 'open'){
                        $iconBackground = '#4eb5e1';      
                    } elseif ($contentExploded[1] == 'reviewed'){ 
                        $iconBackground = '#fbbf67';      
                    } elseif ($contentExploded[1] == 'approved'){
                        $iconBackground = '#5eb46a';
                    } elseif ($contentExploded[1] == 'declined'){
                        $iconBackground = '#f05d55';  
                    } elseif ($contentExploded[1] == 'in-progress'){
                        $iconBackground = '#a7a9ac';    
                    } else {
                        //completed
                        $iconBackground = '#414042';    
                    }
                    
                    $oldStatus = ucwords(str_replace("-"," ",$contentExploded[0]));
                    $newStatus = ucwords(str_replace("-"," ",$contentExploded[1]));    
                    
                    
                    $title = __( 'Status Changed', 'ideapush' );
                    $content = __( 'Status changed from', 'ideapush' ).' <strong>'.$oldStatus.'</strong> '.__( 'to', 'ideapush' ).' <strong>'.$newStatus.'</strong>';
                    
                    
                    break; 
                    
                case 'ZENDESK':
                    $iconType = 'zendesk';
                    $iconColor = '#ffffff';
                    $iconBackground = '#03363d';
                    $title = __( 'Idea Sent to Zendesk', 'ideapush' );
                    $content = '<strong>'.__( 'Ticket ID:', 'ideapush' ).'</strong></br>'.$content;
            
                    
                    break; 
                    
                case 'JIRA':
                    $iconType = 'jira';
                    $iconColor = '#ffffff';
                    $iconBackground = '#2684ff';
                    $title = __( 'Idea Sent to Jira', 'ideapush' );
                    $content = '<strong>'.__( 'Issue ID:', 'ideapush' ).'</strong></br>'.$content;
            
                    
                    break;     
      
            } //end switch
            
            
            
            //date and time format
            $dateFormat = get_option('date_format');
            $timeFormat = get_option('time_format');
            
            
            
            

            $html .= '<li class="idea-history-item '.$listClass.'">';  
            
                $html .= '<i class="fa fa-times-circle delete-history-item" data-position="'.$counter.'" data-id="'.$ideaId.'" aria-hidden="true"></i>';
            
                $html .= '<table class="idea-history-item-table"><colgroup>
                        <col class="icon-column">
                        <col class="title-column">
                        <col class="content-column">
                      </colgroup><tr>';
            
                    $html .= '<td>';
                        //render the icon
                        $html .= '<span style="background-color: '.$iconBackground.';" class="idea-history-item-type">';
                        
                        if($iconType == 'zendesk'){
                            
                            $html .= '<img style="width:35px; margin-top: 27px;" class="style-svg idea-history-icon" alt="IdeaPush Logo" src="'.plugins_url( "../images/Zendesk-Icon.svg", __FILE__ ).'">';    
                            
                        } elseif($iconType == 'jira') {
                            $html .= '<img style="width:35px; margin-top: 23px;" class="style-svg idea-history-icon" alt="IdeaPush Logo" src="'.plugins_url( "../images/Jira-Icon.svg", __FILE__ ).'">';
                        } else {
                            $html .= '<i style="color: '.$iconColor.';" class="idea-history-icon fa '.$iconType.'" aria-hidden="true"></i>';     
                        }
                        
                        
                        $html .= '</span>';
            
                    $html .= '</td>';
                    $html .= '<td>';
                        $html .= '<div class="idea-history-item-title-section">';
                            $html .= '<h3>'.$title.'</h3>'; 
                            $html .= '<span class="action-date">'.date($dateFormat.' '.$timeFormat, $time).'</span>'; 
            
                            //only show author if we have to
                            if($user !== 'NA'){
                                $html .= '<img class="idea-author-profile-image" src="'.idea_push_get_user_avatar($user).'" />';
                                
                                //do admin star            
                                if(idea_push_is_user_admin($user)){
                                    $html .= '<span class="admin-star-outer"><i class="fa fa-star admin-star-icon" aria-hidden="true"></i></span>';    
                                }
                                
                                
                            
                                $html .= '<span class="author-name">'.esc_html(get_the_author_meta('first_name',$user)).' '.esc_html(get_the_author_meta('last_name',$user)).'</span>';       
                            }
                            
                            
            
            
                        $html .= '</div>';
                    $html .= '</td>';
                    $html .= '<td>';      
                        $html .= '<span class="read-more">'.$content.'</span>'; 
                    $html .= '</td>';
                $html .= '</tr></table>';
            
            
            
                
            $html .= '</li>'; 

        }
        
        $counter++;
    }
        
    return $html;
    
}










//add a note to the timeline
function idea_push_add_note_to_idea_history() {

    
    //get post variables
    $ideaId = idea_push_sanitization_validation($_POST['ideaId'],'id');
    $content = sanitize_textarea_field($_POST['note']);
    $currentUser = idea_push_check_if_non_logged_in_user_is_guest('Yes');
    
    if($ideaId == false){
        wp_die();   
    }
    
    //add note to idea history meta
    idea_push_add_idea_history_item($ideaId,'NOTE',$currentUser,$content,'');
    
    
    //get new html of idea history
    echo idea_push_html_of_idea_history($ideaId); 

    
    //die
    wp_die();

 
}
add_action( 'wp_ajax_add_note_to_idea_history', 'idea_push_add_note_to_idea_history' );






//delete item from history
function idea_push_remove_idea_history_item() {

    //get post variables
    $ideaId = idea_push_sanitization_validation($_POST['ideaId'],'id');
    $position = intval($_POST['position']);
    
    if($ideaId == false){
        wp_die();   
    }
    
    
    //we need to get the meta
    $ideaHistoryMeta = get_post_meta($ideaId, 'idea-history', true);	
	
    //we need to split the meta by |||
    $ideaHistoryArray = explode('|||',$ideaHistoryMeta);
    
    //we need to remove that part of the array
    unset($ideaHistoryArray[$position]);
    
    //we need to collapse the array
    $ideaHistoryArrayImploded = implode('|||',$ideaHistoryArray);
    
    //we need to update the meta
    update_post_meta($ideaId, 'idea-history',$ideaHistoryArrayImploded);
    
    
    
    //die
    wp_die();

 
}
add_action( 'wp_ajax_remove_idea_history_item', 'idea_push_remove_idea_history_item' );





//add a note to the timeline
function idea_push_send_email_ad_hoc() {

    //get post variables
    $ideaId = idea_push_sanitization_validation($_POST['ideaId'],'id');
    
    $to = $_POST['to'];
    $subject = sanitize_textarea_field($_POST['subject']);
    $content = sanitize_textarea_field($_POST['content']);
    
    if($ideaId == false){
        wp_die();   
    }
    
    if($to !== 'Positive Voters' && $to !== 'Idea Author'){
        wp_die();   
    }
    
    $currentUser = idea_push_check_if_non_logged_in_user_is_guest('Yes');
    
    
    if($to == 'Positive Voters'){
        $audience = 'Voter';
        
        //get positive voters
        $positiveVoters = get_post_meta($ideaId,'up-voters',true);

        //now cycle through each voter
        foreach($positiveVoters as $voter){
            if(strlen($voter[0])>0){
                
                $emailSubject = idea_push_shortcode_replacement($ideaId,$subject,$voter[0]);

                $body = idea_push_shortcode_replacement($ideaId,$content,$voter[0]);

                //get voter email
                $voterEmail = get_user_by('id',$voter[0]);    
                $voterEmail = $voterEmail->user_email;

                //send email to author on first publush
                idea_push_send_email($voterEmail,$emailSubject,$body);
            }    
            
        }
        
    } else {
        $audience = 'Author';
        
        //send author email
        $postAuthorId = get_post_field( 'post_author', $ideaId );
        $postAuthor = get_user_by('id',$postAuthorId);
        $postAuthorEmail = $postAuthor->user_email;
          
        $emailSubject = idea_push_shortcode_replacement($ideaId, $subject,'');

        $body = idea_push_shortcode_replacement($ideaId, $content,'');
        
        idea_push_send_email($postAuthorEmail,$emailSubject,$body);  
        
        
    }
    

    
    //add note to idea history meta
    idea_push_add_idea_history_item($ideaId,'EMAIL',$currentUser,$subject.'|'.$content,$audience);
    
    
    
    //get new html of idea history
    echo idea_push_html_of_idea_history($ideaId); 
 
    //die
    wp_die();

 
}
add_action( 'wp_ajax_send_email_ad_hoc', 'idea_push_send_email_ad_hoc' );







//lets add our reports page
//lets add our settings page
add_action( 'admin_menu', 'idea_push_add_reports_page' );

function idea_push_add_reports_page() {
    
    global $idea_push_wp_reports_page;
    
    $idea_push_wp_reports_page = add_submenu_page('edit.php?post_type=idea', __('Reports','ideapush'), __('Reports','ideapush'), 'manage_options', 'idea_push_reports', 'idea_push_reports_page_content');    
    
}

//callback function of setting page
function idea_push_reports_page_content(){
    
    $currentDate = current_time('Y-m-d',0);
    $currentDateMinusMonth = date('Y-m-d', strtotime('-1 month'));
    
    ?>
    
    <!-- start wrap -->
    <div class="wrap">
        <div id="poststuff">
        
            <!-- heading -->
            <img style="width:200px;" class="style-svg" alt="IdeaPush Logo" src="<?php echo plugins_url( '../images/IdeaPush-Logo.svg', __FILE__ ); ?>"><h1><?php _e('| Reports', 'ideapush' ); ?></h1>
            
            <div class="report-header" style="margin-top:20px;">
                
                <?php _e( 'Start Date: ', 'ideapush' ); ?><input style="margin-right:10px; margin-bottom: 10px;" id="idea_push_start_date" class="datepicker" type="text" placeholder="<?php echo $currentDateMinusMonth; ?>" value="<?php echo $currentDateMinusMonth; ?>"/>


                <?php _e( 'End Date: ', 'ideapush' ); ?><input style="margin-bottom: 10px;" id="idea_push_end_date" class="datepicker" type="text" placeholder="<?php echo $currentDate; ?>" value="<?php echo $currentDate; ?>" />

                <a id="get-ideapush-reports" class="button-primary" href="#"><?php _e( 'Get Reports', 'ideapush' ); ?></a>
            
            </div> 
            
            <div style="display:none;" class="report-body">
                <h2><?php _e( 'Activity Report', 'ideapush' ); ?></h2>

                <div id="activity-line-graph"></div>

                <h2><?php _e( 'User Report', 'ideapush' ); ?></h2>

                <div id="user-table"></div>
            </div>    
                
        </div>     
    </div>    
        
    <?php    
        
}




//add a note to the timeline
function idea_push_get_user_table() {
    
    
    $startDate = strtotime($_POST['startDate']);
    
    //we need to add a day to the end date as the date below is the very start of the day like 12:01AM when people would expect it to be 11:59PM.
    
    $endDate = strtotime($_POST['endDate'].'+1 day');
    
//    echo $startDate.' '.$endDate;
    
    $args = array(
            'post_type' => 'idea',
            'post_status' => 'publish',
            'posts_per_page' => -1,
        );
    
    $ideaPosts = get_posts($args);
    
    if(empty($ideaPosts)){
        //there aren't any posts so there's nothing to suggest!
        echo '';
        wp_die();
    }
    
    //we need to store values
    //do table stuff
    $authors = array();
    $upVotes = array();
    $downVotes = array();
        
    //do chart stuff
//    $ideaCount = array();
//    $upVotesCount = array();
//    $downVotesCount = array();
    
    $chartData = array();
    
    
    

    foreach($ideaPosts as $ideaPost){
        
        //we need to check if the post was done in our timeframe
        $postDate = strtotime($ideaPost->post_date);
        $postId = $ideaPost->ID;
        $ideaAuthor = $ideaPost->post_author;
        
        
        //do idea creators
        if($postDate >= $startDate && $postDate<= $endDate){
            
            
            //do table stuff
            $existingAuthor = $authors[$ideaAuthor];

            if(isset($existingAuthor)){
                $existingAuthor++;
                $authors[$ideaAuthor] = $existingAuthor;    
            } else {
                $authors[$ideaAuthor] = 1;
            }
            
            
            $dateReformatted = date("Y-m-d",$postDate);
            
            //do chart stuff
            $existingChartData = $chartData[$dateReformatted]['ideaCount'];
            
            if(isset($existingChartData)){
                
                $existingChartData++;
                
                $chartData[$dateReformatted]['ideaCount'] = $existingChartData;
                
            } else {
               $chartData[$dateReformatted]['ideaCount'] = 1; 
            }
 
        }
        
        
        
        
        //get upvoters
        $positiveVoters = get_post_meta($postId,'up-voters',true);
        
        foreach($positiveVoters as $voter){
            
//            echo $voter[1].'>'.$startDate.'>'.$endDate.'  ';
            
            //first value in array is the user id, the second is the date which is a number
            if($voter[1] >= $startDate && $voter[1] <= $endDate){
                
                //do table stuff
                $existingUpVoters = $upVotes[$voter[0]];
                
                if(isset($existingUpVoters)){
                    $existingUpVoters++;
                    $upVotes[$voter[0]] = $existingUpVoters;    
                } else {
                    $upVotes[$voter[0]] = 1;
                }   
                
                
                //do chart stuff   
                $dateReformatted = date("Y-m-d",$voter[1]);    
                
                $existingChartData = $chartData[$dateReformatted]['upVoterCount'];
            
                if(isset($existingChartData)){

                    $existingChartData++;

                    $chartData[$dateReformatted]['upVoterCount'] = $existingChartData;

                } else {
                   $chartData[$dateReformatted]['upVoterCount'] = 1; 
                }

   
            } 
        }
        
        
        
        
        //get downvoters
        $negativeVoters = get_post_meta($postId,'down-voters',true);
        
        foreach($negativeVoters as $voter){
            //first value in array is the user id, the second is the date which is a number
            
            
            
            if($voter[1] >= $startDate && $voter[1] <= $endDate){
                
                //do table stuff
                $existingDownVoters = $downVotes[$voter[0]];
                
                if(isset($existingDownVoters)){
                    $existingDownVoters++;
                    $downVotes[$voter[0]] = $existingDownVoters;    
                } else {
                    $downVotes[$voter[0]] = 1;
                }   
                
                //do chart stuff
                $dateReformatted = date("Y-m-d",$voter[1]);    
                
                $existingChartData = $chartData[$dateReformatted]['downVoterCount'];
            
                if(isset($existingChartData)){

                    $existingChartData++;

                    $chartData[$dateReformatted]['downVoterCount'] = $existingChartData;

                } else {
                   $chartData[$dateReformatted]['downVoterCount'] = 1; 
                }
                
                
            } 
        }
  
    }
            
    
    
//    print_r($upVotes);
//    print_r($downVotes);
    
    
    $getUsers = get_users();
    
    $returnData = '';
    
    foreach($getUsers as $user){
        
        $userId = $user->ID;
        
        $roles = $user->roles;
        $roles = implode(',',$roles);
        
        global $wp_roles;
        $roles = $wp_roles->roles[$roles]['name'];
     
        $name = $user->first_name.' '.$user->last_name;
        
        $ideasCreated = $authors[$userId];
        
        if($ideasCreated==''){
           $ideasCreated = 0; 
        }
        
        
        $upVotesOfUser = $upVotes[$userId];
        
        $downVotesOfUser = $downVotes[$userId];
        
        if($upVotesOfUser==''){
            $upVotesOfUser = 0;    
        }
        
        if($downVotesOfUser==''){
            $downVotesOfUser = 0;    
        }
        
        
        $returnData .= $name.'|'.$roles.'|'.$ideasCreated.'|'.$upVotesOfUser.'|'.$downVotesOfUser.'||';
        
    }
        
    $returnChartData = '';
    
    //we need to sort the chart data
    ksort($chartData);
    
    
    foreach($chartData as $date => $arrayData){
        
        $ideaCountValue = $arrayData['ideaCount'];
        $upVoterCountValue = $arrayData['upVoterCount'];
        $downVoterCountValue = $arrayData['downVoterCount'];
        
        if($ideaCountValue == ''){
            $ideaCountValue = 0;    
        }
        
        if($upVoterCountValue == ''){
            $upVoterCountValue = 0;    
        }
        
        if($downVoterCountValue == ''){
            $downVoterCountValue = 0;    
        }
        
        
        $returnChartData .= $date.'|'.$ideaCountValue.'|'.$upVoterCountValue.'|'.$downVoterCountValue.'||';
        
        
    }
    

    //get new html of idea history
    echo $returnData.'$$$'.$returnChartData; 
    
    //die
    wp_die();

 
}
add_action( 'wp_ajax_get_user_table', 'idea_push_get_user_table' );







function idea_push_output_suggested_tags($tagScope,$boardId){

    //we need to get the actual existings tags    
    $actualExistingTags = get_terms('tags',array('hide_empty' => false));
    
    $tagOutput = '';

    foreach ($actualExistingTags as $tag) {

        $tagName =  $tag->name;

        //only continue if tag scope is board and the tag contain BoardTag-Board#
        // or if tag scope is global and the tag doesnt contain BoardTag-

        if(($tagScope == 'Board' && strpos($tagName, 'BoardTag-'.$boardId) !== false)  ||  ($tagScope == 'Global' && strpos($tagName, 'BoardTag-') === false)){
            $tagOutput .= $tagName.'|';
        } //end if tag meets criteria

    }    
    
    //output suggested tags
    return '<div style="display: none;" id="suggested-tags" data-tag-scope="'.$tagScope.'" data="'.rtrim($tagOutput,'|').'"></div>';

}



//we no longer use this and use javascript instead
// function idea_push_get_suggested_tags(){
    
//     $enteredValue = $_POST['enteredValue'];
//     $existingTags = $_POST['existingTags'];
//     $boardNumber = idea_push_sanitization_validation($_POST['boardNumber'],'id');

//     //get the board settings
//     $getBoardSettings = idea_push_get_board_settings($boardNumber);
    
//     $tagScope = $getBoardSettings[22]; //can be either Board or Global


    
//     $existingTagsArray = explode(',',$existingTags);
    
//     //lets make the used tags uppercase for comparison purposes
//     $existingTagsUppercase = array();
    
//     foreach ($existingTagsArray as $tag){
//         $tag = strtoupper($tag);
//         array_push($existingTagsUppercase,$tag);  
//     }
    
    
    
//     //we need to get the actual existings tags    
//     $actualExistingTags = get_terms('tags');
    
    
//     $suggestedTags = array();
    
  
//     foreach ($actualExistingTags as $tag) {
        
//         //check to make sure the value isn't already a tag entered
//         if(!in_array(strtoupper($tag->name), $existingTagsUppercase)){
            
//             $tagName =  $tag->name;

//             //only continue if tag scope is board and the tag contain BoardTag-Board#
//             // or if tag scope is global and the tag doesnt contain BoardTag-

//             if(   ($tagScope == 'Board' && strpos($tagName, 'BoardTag-'.$boardNumber) !== false)  ||  ($tagScope == 'Global' && strpos($tagName, 'BoardTag-') === false)   ){

//                 //$comparisonScore = levenshtein(strtoupper($tag->name), strtoupper($enteredValue));
//                 $comparisonScore = substr_count(strtoupper($tag->name), strtoupper($enteredValue));
//                 $suggestedTags[$tagName] = $comparisonScore;    

//             } //end if tag meets criteria

//         } //end check if value isn't existing value
//     } //end foreach
    
    
//     function comparisonFunction($a, $b) {
//         if ($a == $b) {
//             return 0;
//         }
//         return ($a > $b) ? -1 : 1;
//     }
    
//     uasort($suggestedTags,'comparisonFunction');
    
// //    print_r($suggestedTags);
    
//     $returnedSuggestedTags = '';
    
//     foreach(array_keys($suggestedTags) as $tag){

//         //if the tag is a board tag remove the prefix from the suggestion
//         if(strpos($tag, 'BoardTag-') !== false){

//             $positionOfSecondHyphen = strpos($tag, '-', strpos($tag, '-') + 1);

//             $tagName = substr($tag,$positionOfSecondHyphen+1,strlen($tag)-$positionOfSecondHyphen);

//         } else {
//             $tagName = $tag;
//         }


//         $returnedSuggestedTags .= $tagName.',';


//     }
    
    
//     echo $returnedSuggestedTags; 
    
//     //die
//     wp_die();

// } //end function
// add_action( 'wp_ajax_get_suggested_tags', 'idea_push_get_suggested_tags' );
// add_action( 'wp_ajax_nopriv_get_suggested_tags', 'idea_push_get_suggested_tags' );

























//this common function is used by the publish and vote threshold functions below to add an idea to zendesk
function idea_push_common_add_idea_to_zendesk($newIdeaId,$userId,$title,$description){
    
      

    
    //get settings
    $options = get_option('idea_push_settings');
    
    //do request
    // Create JSON body
    $json = json_encode( array(
        'request' => array(
            'subject' => $title,
            'requester' => array(
                'name' => get_the_author_meta('first_name',$userId).' '.get_the_author_meta('last_name',$userId),
                'email' => get_the_author_meta('user_email',$userId)
            ),
            'comment' => array(
                'body' => $description
            ),
        ),
    ) );

    // {@see https://codex.wordpress.org/HTTP_API}
    $response = wp_remote_post( 'https://'.$options['idea_push_zendesk_domain'].'.zendesk.com/api/v2/requests.json', array(
        'headers' => array(
            'Content-Type' => 'application/json; charset=utf-8',
        ),
        'body' => $json,
    ) );

    
    
    
    
    
    
    
    
    if ( 201 == wp_remote_retrieve_response_code( $response ) ) {

        $jsondata = json_decode($response['body'],true); 

        $ticketId = $jsondata['request']['id'];


        //add integration to idea history
        idea_push_add_idea_history_item($newIdeaId,'ZENDESK','',$ticketId,'');

        //add ticket id to idea meta
        update_post_meta($newIdeaId, 'zendesk-id',$ticketId);

        $authorisation = base64_encode($options['idea_push_zendesk_login_email'].':'.$options['idea_push_zendesk_login_password']); 

        
        
        
        
        
        
        //lets now add tags to the ticket if they exist
        $ideaTags = get_the_terms($newIdeaId,'tags');
        
        //check to see if tags exist
        if(!empty($ideaTags)){    

            $tagsToAdd = array(); 

            foreach($ideaTags as $ideaTag){
                //add item to array
                array_push($tagsToAdd,$ideaTag->name);
            } 

            //do query here
            // Create JSON body
            $json = json_encode(array(
                'tags' => $tagsToAdd
            ));
            

            //do api call
            $response = wp_remote_request( 'https://'.$options['idea_push_zendesk_domain'].'.zendesk.com/api/v2/tickets/'.$ticketId.'/tags.json', array(
                'method' => 'PUT',
                'headers' => array(
                    'Authorization' => 'Basic '.$authorisation,
                    'Content-Type' => 'application/json; charset=utf-8',
                ),
                'body' => $json,
            ));
  
        } //end if tags empty

        
     
        //lets try and add an attachment
        //get the content of the file
        $imageUrl = get_the_post_thumbnail_url($newIdeaId,'full');
        
        //only do something if image exists
        
        if($imageUrl !== false){
            
            $imagedata = file_get_contents($imageUrl);
        
            //lets get the content type
            //make get request to get file type
            $response2 = wp_remote_get($imageUrl);
            //get headers
            $headers2 = wp_remote_retrieve_headers($response2);
            //get content type
            $contentType = $headers2['Content-Type'];


            $response = wp_remote_post( 'https://'.$options['idea_push_zendesk_domain'].'.zendesk.com/api/v2/uploads.json?filename=Attachment', array(
                'headers' => array(
                    'Authorization' => 'Basic '.$authorisation,
                    'Content-Type' => $contentType,
                ),
            ));

           
             
            if ( 201 == wp_remote_retrieve_response_code( $response ) ) {

                $jsondata = json_decode($response['body'],true); 

                $token = $jsondata['upload']['token'];

                //now lets add the attachment to the ticket
                $json = json_encode( array(
                    'ticket' => array(
                        'comment' => array(
                            'uploads' => array(
                                $token
                            ),
                            'body' => 'Attachment added'
                        ),
                    ),
                ));

                // {@see https://codex.wordpress.org/HTTP_API}
                $response = wp_remote_request( 'https://'.$options['idea_push_zendesk_domain'].'.zendesk.com/api/v2/tickets/'.$ticketId.'.json', array(
                    'method' => 'PUT',
                    'headers' => array(
                        'Authorization' => 'Basic '.$authorisation,
                        'Content-Type' => 'application/json; charset=utf-8',
                    ),
                    'body' => $json,
                ));

            } //end if image was uploaded successfully

        } //end if image exists
        


    } //end success response of initial zendesk ticket creation 
    
  
} //end function









//this common function is used by the publish and vote threshold functions below to add an idea to zendesk
function idea_push_common_add_idea_to_jira($newIdeaId,$userId,$title,$description){

    //get settings
    $options = get_option('idea_push_settings');

    //we need to get the ideas board id
    $board_id = idea_push_get_board_id_from_post_id($newIdeaId);

    //get the filter setting
    if(!isset($options['idea_push_jira_board_filter']) || $options['idea_push_jira_board_filter'] == ''){
        $boards_filter = array(); 
    } else {
        $boards_filter = explode(',',$options['idea_push_jira_board_filter']);
    }
    
    if(empty($boards_filter) || in_array($board_id,$boards_filter)){
        $projectId = $options['idea_push_jira_project_selection'];
        $jiraDomain = $options['idea_push_jira_domain'];
        $jiraEmail = $options['idea_push_jira_login_email'];
        $jiraPassword = $options['idea_push_jira_login_password'];
        $jiraType = $options['idea_push_jira_type'];
        $jiraCustomField = $options['idea_push_jira_custom_field'];
        
        $authorization = base64_encode($jiraEmail.':'.$jiraPassword);

        // Create JSON body
        $json = array(
            'fields' => array(
                'project' => array(
                    'id' => $projectId
                ),
                'issuetype' => array(
                    'name' => $jiraType
                ),
                'description' => $description,
                'summary' => $title
            ),
        );

        //lets try and add our tags as labels
        $ideaTags = get_the_terms($newIdeaId,'tags');
            
        //check to see if tags exist
        if(!empty($ideaTags)){    

            $tagsToAdd = array(); 

            foreach($ideaTags as $ideaTag){
                //add item to array
                $tagName = str_replace(' ','_',$ideaTag->name);
                array_push($tagsToAdd,$tagName);
            } 

            //now lets add the array to our json body
            $json['fields']['labels'] = $tagsToAdd;
        }   
        
        //lets add the idea link to a custom field
        if(isset($jiraCustomField) && strlen($jiraCustomField)>0){
            $json['fields']['customfield_'.$jiraCustomField] = get_the_permalink($newIdeaId);
        }


        //encode the body
        $json = json_encode($json);
        
        $url = 'https://'.$jiraDomain.'.atlassian.net/rest/api/2/issue';
        $response = wp_remote_post($url , array(
            'headers' => array(
                'Authorization' => 'Basic '.$authorization,
                'Content-Type' => 'application/json',
            ),
            'body' => $json,
        ));

        $status = wp_remote_retrieve_response_code( $response );

    

        if($status == 201){

            $jsondata = json_decode(preg_replace('/("\w+"):(\d+(\.\d+)?)/', '\\1:"\\2"', wp_remote_retrieve_body( $response )), true);	

            $id = $jsondata['id'];
            $key = $jsondata['key'];
            $self = $jsondata['self'];

            // //add ticket id to idea meta
            update_post_meta($newIdeaId, 'jira-id',$id);

            //add integration to idea history
            idea_push_add_idea_history_item($newIdeaId,'JIRA','',$key,'');




            //lets try and add an attachment
            //get the content of the file
            $imageUrl = get_the_post_thumbnail_url($newIdeaId,'full');
            
            //only do something if image exists
            //currently this does not work
            if($imageUrl !== false){
                
                $imagedata = file_get_contents($imageUrl);

                $json = json_encode( array(
                    'file' => $imagedata
                ));
                
                $response = wp_remote_post( 'https://'.$jiraDomain.'.atlassian.net/rest/api/3/issue/'.$id.'/attachments', array(
                    'headers' => array(
                        'Content-Type' => 'application/json; charset=utf-8',
                        'Authorization' => 'Basic '.$authorization,
                        'X-Atlassian-Token' => 'no-check',
                    ),
                    'body' => $json,
                ));
                
        
                

            } //end if image exists




        } else {
            //do nothing
        }
    }
    


    

  
  
} //end function














//do integration work
function idea_push_add_to_zendesk_when_idea_published($newIdeaId,$userId,$title,$description){
    
    
    
    
    //get settings
    $options = get_option('idea_push_settings');
    
    //only do integration if enabled in the settings to share all published ideas to zendesk
    if($options['idea_push_zendesk_integration_event'] == 'published'){
        
        idea_push_common_add_idea_to_zendesk($newIdeaId,$userId,$title,$description);
        
    } //end if published

    //only do integration if enabled in the settings to share all published idea to jira
    if($options['idea_push_jira_integration_event'] == 'published'){
        
        idea_push_common_add_idea_to_jira($newIdeaId,$userId,$title,$description);
        
    } //end if published
    
    //here we need to call a common function to create a user in mailchimp
    idea_push_common_add_idea_to_mailchimp($userId);
    
    
}
add_action( 'idea_push_after_idea_created', 'idea_push_add_to_zendesk_when_idea_published',10,4);





function idea_push_add_to_mailchimp_when_vote_cast($ideaId,$userId,$voteIntent,$ideaScoreNow,$voteThreshold){
    
    
    
    //here we need to call a common function to create a user in mailchimp
    idea_push_common_add_idea_to_mailchimp($userId);
    
    
}
add_action( 'idea_push_vote_cast', 'idea_push_add_to_mailchimp_when_vote_cast',10,5);


function idea_push_common_add_idea_to_mailchimp($userId){
    
    //get settings
    $options = get_option('idea_push_settings');
    
    //get user information
    $userInfo = get_userdata($userId);
    

    //here we do the integration
    $json = json_encode(array(
                'status' => 'subscribed',
                'merge_fields' => array('FNAME' => $userInfo->first_name,'LNAME' => $userInfo->last_name),
                'email_address' => $userInfo->user_email
            ));
    
    $mailChimpList = $options['idea_push_mailchimp_list_select'];

    $mailChimpDataCentre = substr($options['idea_push_mailchimp_api_key'],strpos($options['idea_push_mailchimp_api_key'],"-")+1);
    $mailChimpAuthorization = 'Basic '.base64_encode('anystring:'.$options['idea_push_mailchimp_api_key']);

    $response = wp_remote_post( 'https://'.$mailChimpDataCentre.'.api.mailchimp.com/3.0/lists/'.$mailChimpList.'/members', array(
        'headers' => array(
        'Content-Type' => 'text/plain',
        'Authorization' => $mailChimpAuthorization,
    ),
    'body' => $json,
    ));
    
    
    
}







//generic when vote threshold has been achieved
function idea_push_add_idea_to_zendesk_vote_threshold($ideaId,$content){
    
    //get settings
    $options = get_option('idea_push_settings');
    
    //only do integration if enabled in the settings to share with zendesk when threshold achieved
    if($options['idea_push_zendesk_integration_event'] == 'threshold'){
        
        
        //get post author from ideaid
        $postAuthorId = get_post_field( 'post_author', $ideaId );
        
        //get post
        $content_post = get_post($ideaId);
        

        idea_push_common_add_idea_to_zendesk($ideaId,$postAuthorId,$content_post->post_title,$content_post->post_content);

        
    } //end if threshold


    //only do integration if enabled in the settings to share with jira when threshold achieved
    if($options['idea_push_jira_integration_event'] == 'threshold'){
        
        
        //get post author from ideaid
        $postAuthorId = get_post_field( 'post_author', $ideaId );
        
        //get post
        $content_post = get_post($ideaId);
        

        idea_push_common_add_idea_to_jira($ideaId,$postAuthorId,$content_post->post_title,$content_post->post_content);

        
    } //end if threshold
    

}
add_action( 'idea_push_idea_vote_threshold', 'idea_push_add_idea_to_zendesk_vote_threshold',10,2);





































//creates the api

add_action( 'rest_api_init', 'idea_push_create_api_endpoints');

function idea_push_create_api_endpoints(){
    register_rest_route( 'ideapush/v1', '/jira/', array(
        'methods' => 'POST',
        'callback' => 'idea_push_jira_api_processing',
        'permission_callback' => '__return_true'
    ));

    register_rest_route( 'ideapush/v1', '/jira-comment/', array(
        'methods' => 'POST',
        'callback' => 'idea_push_jira_api_processing_comment',
        'permission_callback' => '__return_true'
    ));

    register_rest_route( 'ideapush/v1', '/zendesk/', array(
        'methods' => 'POST',
        'callback' => 'idea_push_zendesk', 
        'permission_callback' => '__return_true'
    ));
}

function idea_push_jira_api_processing_comment($data){
    $id = $data['id'];
    $phrase = $data['phrase'];
    $commentId = $data['commentid'];

    //only process the request if the phrase matches what is in the settings
    $options = get_option('idea_push_settings');

    $jiraDomain = $options['idea_push_jira_domain'];
	$jiraEmail = $options['idea_push_jira_login_email'];
    $jiraPassword = $options['idea_push_jira_login_password'];
    $jiraUniquePhrase = $options['idea_push_jira_unique_phrase'];
    $adminAccountId = $options['idea_push_jira_admin_account'];

    $authorization = base64_encode($jiraEmail.':'.$jiraPassword);

    if($phrase == $jiraUniquePhrase){

        //lets get the comment
        $response = wp_remote_get( 'https://'.$jiraDomain.'.atlassian.net/rest/api/2/issue/'.$id.'/comment/'.$commentId, array(
            'headers' => array(
                'Authorization' => 'Basic '.$authorization,
            ),
        ) );

        $status = wp_remote_retrieve_response_code( $response );
            
        if($status == 200){

            $jsondata = json_decode(preg_replace('/("\w+"):(\d+(\.\d+)?)/', '\\1:"\\2"', wp_remote_retrieve_body( $response )), true);	

            $commentContent = $jsondata['body'];

            $args = array(
                'post_type'  => 'idea',
                'meta_query' => array(
                    array(
                        'key'   => 'jira-id',
                        'value' => $id,
                    )
                )
            );
            $posts = get_posts( $args );
            
            foreach($posts as $post){
                $ideaId = $post->ID;         
            }


            idea_push_add_idea_history_item($ideaId,'NOTE',$adminAccountId,$commentContent,'');

        }
        
        


    }    


}    





function idea_push_jira_api_processing($data){
    
    $id = $data['id'];
    $phrase = $data['phrase'];
    
    //only process the request if the phrase matches what is in the settings
    $options = get_option('idea_push_settings');

    $jiraDomain = $options['idea_push_jira_domain'];
	$jiraEmail = $options['idea_push_jira_login_email'];
    $jiraPassword = $options['idea_push_jira_login_password'];
    $jiraUniquePhrase = $options['idea_push_jira_unique_phrase'];
    $adminAccountId = $options['idea_push_jira_admin_account'];

    $authorization = base64_encode($jiraEmail.':'.$jiraPassword);

    if($phrase == $jiraUniquePhrase){

        //we need to get the status of issue in jira
        $response = wp_remote_get( 'https://'.$jiraDomain.'.atlassian.net/rest/api/2/issue/'.$id, array(
            'headers' => array(
                'Authorization' => 'Basic '.$authorization,
            ),
        ));

        $status =  wp_remote_retrieve_response_code( $response );

        if($status == 200){

            $jsondata = json_decode(preg_replace('/("\w+"):(\d+(\.\d+)?)/', '\\1:"\\2"', wp_remote_retrieve_body( $response )), true);	

            $statusName = $jsondata['fields']['status']['name'];
            //status can be either To Do, Done or In Progress

            //lets get the existing status
            //to do this we need to cycle through the ideas and find the idea that has the jira id that matches
            $args = array(
                'post_type'  => 'idea',
                'meta_query' => array(
                    array(
                        'key'   => 'jira-id',
                        'value' => $id,
                    )
                )
            );
            $posts = get_posts( $args );
            
            foreach($posts as $post){
                $ideaId = $post->ID;         
            }

            $existingStatus = get_post_meta($ideaId,'current-status',true);

            
            if($statusName == 'In Progress' && $existingStatus !== 'in-progress'){
                //update the status to in-progress
                wp_set_object_terms($ideaId, 'in-progress', 'status', false );  
                idea_push_common_status($ideaId,$existingStatus,'in-progress',$adminAccountId);
            }

            if($statusName == 'Done' && $existingStatus !== 'completed'){
                //update the status to completed
                wp_set_object_terms($ideaId, 'completed', 'status', false );  
                idea_push_common_status($ideaId,$existingStatus,'completed',$adminAccountId);
            }

            if($statusName == 'To Do' && ($existingStatus == 'completed' || $existingStatus == 'in-progress') ){
                //update the status to completed
                wp_set_object_terms($ideaId, 'approved', 'status', false );  
                idea_push_common_status($ideaId,$existingStatus,'approved',$adminAccountId);
            }

           

        }
        


        return 'Excellent';
    }


}



//this function is the callback function of the api and handles the data sent to WordPress from Zendesk
function idea_push_zendesk($data){
    
    //get the response
    $json_result = json_decode($data->get_body(), true); //note second param is for setting this to an associative array
    
    //get the uniquephrase
    $uniquePhrase = $json_result["uniquePhrase"];
    
    //get options
    $options = get_option('idea_push_settings');
    $uniquePhraseSettings = $options['idea_push_zendesk_unique_phrase'];
    
    //lets check that the unique phrase matches our settings before proceeding any further
    if($uniquePhrase == $uniquePhraseSettings){
        
        
        
        //no matter what action we are trying to carry out we need to get the idea which has the ticket id as the meta of the idea
        $ticketId = $json_result["ticket"];
        
        $args = array(
            'post_type'  => 'idea',
            'meta_query' => array(
                array(
                    'key'   => 'zendesk-id',
                    'value' => $ticketId,
                )
            )
        );
        $posts = get_posts( $args );
        

        foreach($posts as $post){
            $ideaId = $post->ID;         
        }
        
        
        //get the admin user id for the integration
        $adminAccountId = $options['idea_push_zendesk_admin_account'];
        
        //get the action
        $action = $json_result["action"]; //the action can be either solved, comment, note
        
        //now we need to do things based on the action
        switch ($action){
                
            case 'note':
                
                idea_push_add_idea_history_item($ideaId,'NOTE',$adminAccountId,$json_result["noteContent"],'');

                break;

            case 'comment':
                
                $commentDataArray = array(
                    'comment_post_ID' => $ideaId,
                    'comment_author' => get_the_author_meta('first_name',$adminAccountId).' '.get_the_author_meta('last_name',$adminAccountId),
                    'comment_author_email' => get_the_author_meta('user_email',$adminAccountId),
                    'comment_content' => $json_result["commentContent"],
                    'user_id' => $adminAccountId,
                    'comment_approved' => 1,
                );

                wp_insert_comment($commentDataArray);

                break;


            case 'solved':
                
                //get the existing status
                $existingStatus = get_post_meta($ideaId,'current-status',true);
                
                
                wp_set_object_terms($ideaId, 'completed', 'status', false );    
                
                //do common status change function which sends notifications and allows action hooks
                idea_push_common_status($ideaId,$existingStatus,'completed',$adminAccountId);
                
                    
                break;
            
      
        } //end switch
        
    
        
        return 'Action completed';
        
        
    } //end unique phrase check
    
 
} //end zendesk api for wordpress function












//this function adds the target and triggers to zendesk on behalf of the user
function idea_push_zendesk_finalisation() {
    
    //establish return variable
    
    $returnValue = '';
    
    
    //get options
    $options = get_option('idea_push_settings');
    
    $siteUrl = get_site_url();
    
    $authorisation = base64_encode($options['idea_push_zendesk_login_email'].':'.$options['idea_push_zendesk_login_password']);    
    
    //create target
    // Create JSON body
    $json = json_encode( array(
        'target' => array(
            'target_url' => $siteUrl.'/wp-json/ideapush/v1/zendesk/',
            'title' => 'IdeaPush',
            'method' => 'post',
            'type' => 'url_target_v2',
            'active' => 'true',
            'content_type' => 'application/json'
        ),
    ));
    
    //used for testing because local server won't work
//    $json = json_encode( array(
//        'target' => array(
//            'target_url' => 'https://northernbeacheswebsites.com.au/wp-json/ideapush/v1/zendesk/',
//            'title' => 'IdeaPush',
//            'method' => 'post',
//            'type' => 'url_target_v2',
//            'active' => 'true',
//            'content_type' => 'application/json'
//        ),
//    ));
//    
    
 
    // {@see https://codex.wordpress.org/HTTP_API}
    $response = wp_remote_post( 'https://'.$options['idea_push_zendesk_domain'].'.zendesk.com/api/v2/targets.json', array(
        'headers' => array(
            'Authorization' => 'Basic '.$authorisation,
            'Content-Type' => 'application/json; charset=utf-8',
        ),
        'body' => $json,
    ));
    
    
    $returnValue .= wp_remote_retrieve_response_code($response).' ';
    

    if ( ! is_wp_error( $response ) ) {
        // The request went through successfully, check the response code against
        // what we're expecting
        if ( 201 == wp_remote_retrieve_response_code( $response ) ) {

            
            
            //get target id
            
            $jsondata = json_decode($response['body'],true); 

            $targetId = $jsondata['target']['id'];
            
            $uniquePhrase = $options['idea_push_zendesk_unique_phrase'];
            
            
            //now lets create our triggers
            
            //trigger 1 - note
            $json = json_encode( array(
                'trigger' => array(
                    'all' => array(
                        array(
                            'field' => 'comment_is_public',
                            'operator' => 'is',
                            'value' => 'false'
                        ),
                        array(
                            'field' => 'update_type',
                            'operator' => 'is',
                            'value' => 'Change'
                        ),
                    ),
                    'title' => 'IdeaPush Internal Note',
                    'active' => true,
                    'description' => 'Used to sync ticket notes with idea history internal notes',
                    'actions' => array(
                        array(
                            'field' => 'notification_target',
                            'value' => array(
                                $targetId,
                                '{
                                   "uniquePhrase": "'.$uniquePhrase.'",
                                   "action": "note",
                                   "ticket" : "{{ticket.id}}",
                                   "noteContent" : "{{ticket.latest_comment}}"
                                }'
                            ),
                        ),
                    ),
                ),
            ));

            // {@see https://codex.wordpress.org/HTTP_API}
            $response = wp_remote_post( 'https://'.$options['idea_push_zendesk_domain'].'.zendesk.com/api/v2/triggers.json', array(
                'headers' => array(
                    'Authorization' => 'Basic '.$authorisation,
                    'Content-Type' => 'application/json; charset=utf-8',
                ),
                'body' => $json,
            ) );
            
            $returnValue .= wp_remote_retrieve_response_code($response).' ';


            //trigger 2 - comment
            $json = json_encode( array(
                'trigger' => array(
                    'all' => array(
                        array(
                            'field' => 'comment_is_public',
                            'operator' => 'is',
                            'value' => 'true'
                        ),
                        array(
                            'field' => 'update_type',
                            'operator' => 'is',
                            'value' => 'Change'
                        ),
                    ),
                    'title' => 'IdeaPush Comment',
                    'active' => true,
                    'description' => 'Used to sync ticket comments with idea comments',
                    'actions' => array(
                        array(
                            'field' => 'notification_target',
                            'value' => array(
                                $targetId,
                                '{
                                   "uniquePhrase": "'.$uniquePhrase.'",
                                   "action": "comment",
                                   "ticket" : "{{ticket.id}}",
                                   "commentContent" : "{{ticket.latest_comment}}"
                                }'
                            ),
                        ),
                    ),
                ),
            ));

            // {@see https://codex.wordpress.org/HTTP_API}
            $response = wp_remote_post( 'https://'.$options['idea_push_zendesk_domain'].'.zendesk.com/api/v2/triggers.json', array(
                'headers' => array(
                    'Authorization' => 'Basic '.$authorisation,
                    'Content-Type' => 'application/json; charset=utf-8',
                ),
                'body' => $json,
            ));
            
            $returnValue .= wp_remote_retrieve_response_code($response).' ';
            
            
            //trigger 3 - solved
            $json = json_encode( array(
                'trigger' => array(
                    'all' => array(
                        array(
                            'field' => 'status',
                            'operator' => 'value',
                            'value' => 'solved'
                        ),
                    ),
                    'title' => 'IdeaPush Solved',
                    'active' => true,
                    'description' => 'Used to mark ideas as completed in IdeaPush',
                    'actions' => array(
                        array(
                            'field' => 'notification_target',
                            'value' => array(
                                $targetId,
                                '{ "uniquePhrase": "'.$uniquePhrase.'",  "action": "solved",   "ticket" : "{{ticket.id}}"
            }'
                            ),
                        ),
                    ),
                ),
            ) );

            // {@see https://codex.wordpress.org/HTTP_API}
            $response = wp_remote_post( 'https://'.$options['idea_push_zendesk_domain'].'.zendesk.com/api/v2/triggers.json', array(
                'headers' => array(
                    'Authorization' => 'Basic '.$authorisation,
                    'Content-Type' => 'application/json; charset=utf-8',
                ),
                'body' => $json,
            ));

            $returnValue .= wp_remote_retrieve_response_code($response).' ';
            
            //trigger 4 - deleted
            //cant do as zendesk doesn't provide this functionality.
            
            
            //trigger 5 - sync tags - maybe I can work on this in the future when I get more time :/
            
            
            
            
            
            
            
            
            
        } else {
            // The response code was not what we were expecting, record the message
            $error_message = wp_remote_retrieve_response_message( $response );
        }
    } else {
        // There was an error making the request
        $error_message = $response->get_error_message();
    }

    
    
    
    echo $returnValue;
    
    //die
    wp_die();

 
}
add_action( 'wp_ajax_zendesk_finalisation', 'idea_push_zendesk_finalisation' );



function idea_push_vote_bank_message($currentUserId){

    $html = '<div class="vote-bank-message-box vote-bank-message">';
    
        $html .= '<i class="ideapush-icon-Bell"></i>';

        $options = get_option('idea_push_settings');


        

        if(get_user_meta($currentUserId, 'ideaPushVotesRemaining', true)){
            $users_bank = get_user_meta($currentUserId, 'ideaPushVotesRemaining', true);
        } else {
            $users_bank = $options['idea_push_amount_of_user_votes_in_bank'];   
        }



        if($users_bank == 1){
            $html .= '<span>'.__('You have ','ideapush').$users_bank.__(' vote left','ideapush').'</span>';
        } else {
            $html .= '<span>'.__('You have ','ideapush').$users_bank.__(' votes left','ideapush').'</span>';
        }


        
        
    $html .= '</div>';
    
    return $html;    
}



function idea_push_challenge_message($individualBoardSetting){
    
    //get options
    $options = get_option('idea_push_settings');
    
    $challengeVictory = $individualBoardSetting[17];
    $challengeDate = $individualBoardSetting[18];
    $challengeTime = $individualBoardSetting[19];
    $challengeMessage = $individualBoardSetting[20];
    
    $expiryDate = strtotime($challengeDate.' '.$challengeTime.':00');
    
    $wordPressDateAndTimeFormat = get_option('date_format').' '.get_option('time_format');
    
    $expiryDateInNewFormat = date($wordPressDateAndTimeFormat,$expiryDate);
    
    $expiryDateInJavascriptFormat = date('F j, Y G:i:s',$expiryDate);
    
    $currentDateInJavascriptFormat = date('F j, Y G:i:s',strtotime(current_time('mysql')));
    
    
    // 1. replace [expiry]
    $challengeMessage = str_replace('[expiry]',$expiryDateInNewFormat,$challengeMessage); 
    
    // 2. replace [expiry-countdown]
    $challengeMessage = str_replace('[expiry-countdown]','<span data-expiry="'.$expiryDateInJavascriptFormat.'" data-now="'.$currentDateInJavascriptFormat.'" id="challenge-countdown"></span>',$challengeMessage);
    
    $html = '<div class="challenge-message-box challenge-message">';
    
    $html .= '<i class="ideapush-icon-Bell"></i>';
    
    $html .= '<span>'.$challengeMessage.'</span>';
    
    $html .= '</div>';
    
    return $html; 
    
}


function idea_push_challenge_victory_message($individualBoardSetting){
    
    //get options
    $options = get_option('idea_push_settings');
    
    $boardId = $individualBoardSetting[0];
    $challengeVictory = $individualBoardSetting[17];
    $challengeDate = $individualBoardSetting[18];
    $challengeTime = $individualBoardSetting[19];
    $challengeVictoryMessage = $individualBoardSetting[21];
    
    
    // do a query which gets all ideas for the board
    $args = array(
            'post_type' => 'idea',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'tax_query' => array(
                "relation" => "AND", // important apparently
                array(
                    'taxonomy' => 'boards',
                    'field'    => 'term_id',
                    'terms'    => array($boardId)
                )
            )
        );
    
    $ideaPosts = get_posts($args);
    
    if(empty($ideaPosts)){
        //there aren't any posts so there's nothing to suggest!
        $winnerName = '';
        $winnerNumber = '';
    } else {
        
        
        $vistoryData = array();
        
        $mostVotesArray = array();
        $mostIdeasArray = array();
        $populaIdeaArray = array();
        
        //cycle through the ideas
        foreach($ideaPosts as $ideaPost){
            
            $ideaAuthor = $ideaPost->post_author;
            $postId = $ideaPost->ID;
            $ideaVotes = intval(get_post_meta($postId,'votes',true));
                
            //if the idea author doesn't exist in the array let's initialise the author with 0 value. this will help is later on
            if(!array_key_exists($ideaAuthor,$mostVotesArray)){
                $mostVotesArray[$ideaAuthor] = 0;    
            }
            
            if(!array_key_exists($ideaAuthor,$mostIdeasArray)){
                $mostIdeasArray[$ideaAuthor] = 0;    
            }
            
            if(!array_key_exists($ideaAuthor,$populaIdeaArray)){
                $populaIdeaArray[$ideaAuthor] = 0;    
            }
            
            
            //get existing values
            $mostVotes = $mostVotesArray[$ideaAuthor];
            $mostIdeas = $mostIdeasArray[$ideaAuthor];
            $popularIdea = $populaIdeaArray[$ideaAuthor];
            
            $mostVotes = $mostVotes + $ideaVotes;
            $mostIdeas = $mostIdeas + 1;
            
            if($ideaVotes > $popularIdea){
                $popularIdea = $ideaVotes;    
            }
            
            //now overwrite the key with the new array
            $mostVotesArray[$ideaAuthor] = $mostVotes;
            $mostIdeasArray[$ideaAuthor] = $mostIdeas;
            $populaIdeaArray[$ideaAuthor] = $popularIdea;

            
        }
        
    }
    
    
    //var_dump($vistoryData);
    
    
    
    if($challengeVictory == 'Most Votes'){
        
        arsort($mostVotesArray);
        
        $winnerNumber = reset($mostVotesArray);
        
        $winners = array_keys($mostVotesArray, $winnerNumber);
        
    }
    
    if($challengeVictory == 'Most Ideas'){
        
        arsort($mostIdeasArray);
        
        $winnerNumber = reset($mostIdeasArray);
        
        $winners = array_keys($mostIdeasArray, $winnerNumber);
      
    }
    
    if($challengeVictory == 'Popular Idea'){
        
        arsort($populaIdeaArray);
        
        $winnerNumber = reset($populaIdeaArray);
        
        $winners = array_keys($populaIdeaArray, $winnerNumber);
        
    }
    
    $winnerName = '';
    
    foreach($winners as $winner){
        
        $currentUserObject = get_user_by( 'id', $winner);
        
        $winnerFullName = $currentUserObject->first_name.' '.$currentUserObject->last_name;
        
        if($winnerName == ''){
            $winnerName .= $winnerFullName;   
        } else {
            $winnerName .= ' & '.$winnerFullName;    
        }

    }
    
    
    
    
    
    // 1. replace [winner-name]
    $challengeVictoryMessage = str_replace('[winner-name]',$winnerName,$challengeVictoryMessage);
    
    // 1. replace [win-number]
    $challengeVictoryMessage = str_replace('[win-number]',$winnerNumber,$challengeVictoryMessage);
    
    
    $html = '<div class="challenge-message-box challenge-victory-message">';
    
    $html .= '<i class="ideapush-icon-Trophy"></i>';
    
    $html .= '<span>'.$challengeVictoryMessage.'</span>';
    
    $html .= '</div>';
    
    return $html; 
    
}







function idea_push_form_settings_pro_options_builder($default){

    if(strlen($default) < 1){
        $defaultFieldType = 'text';
        $defaultFieldName = '';
        $defaultFieldOptions = '';
        $defaultFieldRequired = 'no';
        $defaultFieldFilter = 'no';
    } else {
        $explodedCustomField = explode('|',$default);
        $defaultFieldType = $explodedCustomField[0];
        $defaultFieldName = $explodedCustomField[1];
        $defaultFieldOptions = $explodedCustomField[2];
        $defaultFieldRequired = $explodedCustomField[3];
        $defaultFieldFilter = $explodedCustomField[4];
    }

    $html = '<li>';

        //icons
        $html .= '<span><i class="fa fa-sort move-custom-field" aria-hidden="true"></i></span>'; 
        $html .= '<span><i class="fa fa-plus-circle add-custom-field" aria-hidden="true"></i></span>';
        $html .= '<span style="display: inline-block; min-width: 12px;"><i class="fa fa-minus-circle delete-custom-field" aria-hidden="true"></i></span>';

        //field type
        $html .= '<span class="custom-field-type-container">';
            $html .= '<label>'.__( 'Field Type', 'ideapush' ).'</label>';
            $html .= '<select class="custom-field-type">';


                $customFieldTypeOptions = array(
                    'text'=> __( 'Text', 'ideapush' ),
                    'textarea' => __( 'Text Area', 'ideapush' ), 
                    'select' => __( 'Select', 'ideapush' ), 
                    'radio' => __( 'Radio', 'ideapush' ), 
                    'checkbox' => __( 'Checkbox', 'ideapush' ), 
                    'video' => __( 'Video', 'ideapush' ), 
                    'website' => __( 'Website URL', 'ideapush' ), 
                    'date' => __( 'Date', 'ideapush' ),
                    'image' => __( 'Image', 'ideapush' ),  
                );

                foreach($customFieldTypeOptions as $key => $value){

                    if($key == $defaultFieldType){
                        $selectedClass = 'selected="selected"';
                    } else {
                        $selectedClass = '';
                    }

                    $html .= '<option value="'.$key.'" '.$selectedClass.'>'.$value.'</option>';

                }

            $html .= '</select>';
        $html .= '</span>'; 

        //field name
        $html .= '<span class="custom-field-name-container">';
            $html .= '<label>'.__( 'Field Label', 'ideapush' ).'</label>';
            $html .= '<input class="custom-field-name" type="text" value="'.$defaultFieldName.'">';
        $html .= '</span>';  

        //field options
        $html .= '<span class="custom-field-options-container">';
            $html .= '<label>'.__( 'Field Options', 'ideapush' ).'</label>';
            $html .= '<input placeholder="'.__( 'e.g. Red,Blue,Green', 'ideapush' ).'" class="custom-field-options" type="text" value="'.$defaultFieldOptions.'">';
        $html .= '</span>';  

        //required
        $html .= '<span class="custom-field-required-container">';
            $html .= '<label>'.__( 'Required', 'ideapush' ).'</label>';


            $html .= '<select class="custom-field-required">';

                $customFieldRequiredOptions = array('no'=> __( 'No', 'ideapush' ),'yes' => __( 'Yes', 'ideapush' ));

                foreach($customFieldRequiredOptions as $key => $value){

                    if($key == $defaultFieldRequired){
                        $selectedClass = 'selected="selected"';
                    } else {
                        $selectedClass = '';
                    }

                    $html .= '<option value="'.$key.'" '.$selectedClass.'>'.$value.'</option>';

                }

            $html .= '</select>';


        $html .= '</span>';  

        //filter
        $html .= '<span class="custom-field-filter-container">';
            $html .= '<label>'.__( 'Used as Filter', 'ideapush' ).'</label>';


            $html .= '<select class="custom-field-filter">';

                $customFieldRequiredOptions = array('no'=> __( 'No', 'ideapush' ),'yes' => __( 'Yes', 'ideapush' ));

                foreach($customFieldRequiredOptions as $key => $value){

                    if($key == $defaultFieldFilter){
                        $selectedClass = 'selected="selected"';
                    } else {
                        $selectedClass = '';
                    }

                    $html .= '<option value="'.$key.'" '.$selectedClass.'>'.$value.'</option>';

                }

            $html .= '</select>';


        $html .= '</span>';


    $html .= '</li>';

    return $html;
}



//create pro options for form settings
function idea_push_form_settings_pro_options($settingsInput){


    $html = '';

    if($settingsInput == '' || $settingsInput == ' '){
        $html .= idea_push_form_settings_pro_options_builder('');
    } else {

        if(strpos($settingsInput, '||') !== false){
            $explodedCustomFields = explode('||',$settingsInput);

            foreach($explodedCustomFields as $customField){
                if(strlen($customField)>0){
                    $html .= idea_push_form_settings_pro_options_builder($customField);
                }
            }
        } else {
            $html .= idea_push_form_settings_pro_options_builder($settingsInput);
        }
    }

    return $html;
}




//the below 3 functions are used by the custom field generator
function convertFieldLabelToClass($input){

    //remove html
    $input = esc_html($input);  
    //remove space from the start and end
    $input = trim($input);
    //make everything lowercase
    $input = strtolower($input);
    //replace inner space with hyphens
    $input = str_replace(' ','-',$input);

    return $input;

}

function turnStringOptionsIntoNiceArray($input){

    //convertToArray
    $input = explode(',',$input);

    $parsedArray = array();

    foreach($input as $inputItem){
        $inputItem = esc_html($inputItem);  
        $inputItem = trim($inputItem);   
        array_push($parsedArray,$inputItem); 
    }    

    return $parsedArray;
}

function convertFieldLabelToNiceName($input){

    //remove html
    $input = esc_html($input);  
    //remove space from the start and end
    $input = trim($input);

    return $input;

}



//create custom fields on form
function idea_push_create_custom_fields($settingsInput){    

    //if there are no custom fields just return nothing
    if($settingsInput == '' || $settingsInput == ' '){
        return '';
    } else {

        //create holding variable
        $html = '';

        
        //first lets split the setting into individual field items
        $explodedCustomFields = explode('||',$settingsInput);

            foreach($explodedCustomFields as $customField){

                //lets further explode things to get the field properties
                $customFieldProperty = explode('|',$customField);
                $fieldType = $customFieldProperty[0];
                $fieldLabel = $customFieldProperty[1];
                $fieldOptions = $customFieldProperty[2];
                $fieldRequired = $customFieldProperty[3];

                $html .= '<div class="ideapush-form-custom-field" data-type="'.$fieldType.'" data-required="'.$fieldRequired.'" data-field-name="'.convertFieldLabelToNiceName($fieldLabel).'">';

                    //do required star
                    if($fieldRequired == 'yes'){
                        $requiredStar = '*';
                    } else {
                        $requiredStar = '';    
                    }

                    if($fieldType == 'text'){
                        
                        $html .= '<input type="text" class="ideapush-form-idea-'.convertFieldLabelToClass($fieldLabel).'" placeholder="'.esc_html($fieldLabel).$requiredStar.'" maxlength="250">';

                    }

                    if($fieldType == 'website'){
                        
                        $html .= '<input type="url" pattern="https://.*" class="ideapush-form-idea-'.convertFieldLabelToClass($fieldLabel).'" placeholder="'.esc_html($fieldLabel).$requiredStar.'" maxlength="250">';

                    }

                    if($fieldType == 'date'){
                        $html .= '<input type="date" class="ideapush-form-idea-'.convertFieldLabelToClass($fieldLabel).'" placeholder="'.esc_html($fieldLabel).$requiredStar.'">';

                    }

                    if($fieldType == 'video'){
                        
                        $html .= '<input type="text" class="ideapush-form-idea-'.convertFieldLabelToClass($fieldLabel).'" placeholder="'.esc_html($fieldLabel).$requiredStar.'" maxlength="250">';

                    }

                    if($fieldType == 'textarea'){

                        $html .= '<textarea class="ideapush-form-idea-'.convertFieldLabelToClass($fieldLabel).'" placeholder="'.esc_html($fieldLabel).$requiredStar.'" maxlength="2000" rows="8"></textarea>';
                    }

                    
                    if($fieldType == 'select'){
                        $html .= '<fieldset>';
                            $html .= '<label>'.esc_html($fieldLabel).'</label>';

                            $html .= '<select class="ideapush-form-idea-'.convertFieldLabelToClass($fieldLabel).'">';

                                $fieldOptionsInArray = turnStringOptionsIntoNiceArray($fieldOptions);

                                foreach($fieldOptionsInArray as $fieldOption){
                                    $html .= '<option value="'.$fieldOption.'">'.$fieldOption.'</option>';   
                                }

                            $html .= '</select>';
                        $html .= '</fieldset>'; 

                    }


                    if($fieldType == 'checkbox'){

                        $html .= '<fieldset>';

                            $html .= '<label>'.esc_html($fieldLabel).$requiredStar.'</label>';

                            $fieldOptionsInArray = turnStringOptionsIntoNiceArray($fieldOptions);

                            foreach($fieldOptionsInArray as $fieldOption){
                                $html .= '<input type="checkbox" class="ideapush-form-idea-'.convertFieldLabelToClass($fieldLabel).'" name="ideapush-form-idea-'.convertFieldLabelToClass($fieldLabel).'" value="'.$fieldOption.'">'.$fieldOption.'<br>';   
                            }

                        $html .= '</fieldset>';    
                    }


                    if($fieldType == 'radio'){

                        $html .= '<fieldset>';

                            $html .= '<label>'.esc_html($fieldLabel).$requiredStar.'</label>';

                            $fieldOptionsInArray = turnStringOptionsIntoNiceArray($fieldOptions);

                            foreach($fieldOptionsInArray as $fieldOption){
                                $html .= '<input type="radio" class="ideapush-form-idea-'.convertFieldLabelToClass($fieldLabel).'" name="ideapush-form-idea-'.convertFieldLabelToClass($fieldLabel).'" value="'.$fieldOption.'">'.$fieldOption.'<br>';   
                            }

                        $html .= '</fieldset>';    
                    }


                    if($fieldType == 'image'){
                        
                        //do input
                        $html .= '<input class="ideapush-form-idea-'.convertFieldLabelToClass($fieldLabel).' ideapush-form-idea-image" type="file" name="'.convertFieldLabelToClass($fieldLabel).'" id="'.convertFieldLabelToClass($fieldLabel).'" accept=".jpg, .jpeg, .png, .gif">';

                        //do labelling
                        $html .= '<label class="ideapush-form-idea-attachment-label" for="'.convertFieldLabelToClass($fieldLabel).'"><i class="ideapush-icon-Image"></i> '.esc_html($fieldLabel).$requiredStar.'</label>';

                    }

                $html .= '</div>'; 

            }    


        return $html;

     }    

} 








//get suggested ideas
// function idea_push_get_ideas_suggestion_candidates(){

//     $boardNumber = idea_push_sanitization_validation($_POST['boardNumber'],'id');

//     $args = array(
//         'post_type' => 'idea',
//         'post_status' => 'publish',
//         'posts_per_page' => -1,
//         'tax_query' => array(
//             array(
//                 'taxonomy' => 'boards',
//                 'field'    => 'term_id',
//                 'terms'    => array($boardNumber)
//             )
//         )
//     );

//     $ideaPosts = get_posts($args);

//     if(empty($ideaPosts)){
//         //there aren't any posts so there's nothing to suggest!
//         echo '';
//         wp_die();
//     }

//     $returnValue = '';


//     foreach($ideaPosts as $ideaPost){
        
//         //get post variables
//         $postId = $ideaPost->ID;
//         $postTitle = $ideaPost->post_title;
//         $postContent = $ideaPost->post_content;
//         $postLink = get_post_permalink($postId);

//         if($postTitle == ''){
//             $postTitle = ' ';
//         }

//         if($postContent == ''){
//             $postContent = ' ';
//         }

//         $returnValue .= $postId .'|||'.$postTitle.'|||'.$postContent.'|||'.$postLink.'||||';
        
//     } 

//     $returnValue = substr($returnValue, 0, -4);

//     echo $returnValue;
        
//     wp_die(); 

// } //end function
// add_action( 'wp_ajax_get_ideas_suggestion_candidates', 'idea_push_get_ideas_suggestion_candidates' );
// add_action( 'wp_ajax_nopriv_get_ideas_suggestion_candidates', 'idea_push_get_ideas_suggestion_candidates' );


function idea_push_output_suggested_ideas($ideaScope,$boardId){
    
    $ideaOutput = '';

    if($ideaScope == 'Board'){

        $args = array(
            'post_type' => 'idea',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'boards',
                    'field'    => 'term_id',
                    'terms'    => array($boardId)
                )
            )
        );

    } else {
        $args = array(
            'post_type' => 'idea',
            'post_status' => 'publish',
            'posts_per_page' => 400,
        );
    }

    //do query
    $ideaPosts = get_posts($args);

    if(empty($ideaPosts)){
        //there aren't any posts so there's nothing to suggest!

    } else {


        foreach($ideaPosts as $ideaPost){
        
            //get post variables
            $postId = $ideaPost->ID;
            $postTitle = $ideaPost->post_title;
            $postContent = $ideaPost->post_content;
            $postLink = get_post_permalink($postId);
    
            if($postTitle == ''){
                $postTitle = ' ';
            }
    
            if($postContent == ''){
                $postContent = ' ';
            } else {
                $postContent = htmlentities(strip_tags($postContent));
            }
    
            $ideaOutput .= $postId .'|||'.$postTitle.'|||'.$postContent.'|||'.$postLink.'||||';
            
        } 

    }

    
    //output suggested tags
    return '<div style="display: none;" id="suggested-ideas" data="'.rtrim(htmlentities($ideaOutput),'||||').'"></div><div style="display: none;" id="suggested-ideas-text" data="'.__( 'Has your idea already been submitted?', 'ideapush' ).'"></div>';

}

function idea_push_user_edit_delete($ideaId){

    //start output
    $html = '';

    //get the title
    $ideaTitle = get_the_title($ideaId);
    //get the content
    $ideaContent = get_post_field('post_content', $ideaId);

    //edit
    $html .= '<span class="edit-container"><i title="'.__('Edit Idea','ideapush').'" data-title="'.strip_tags($ideaTitle).'" data-content="'.strip_tags($ideaContent).'" data="'.$ideaId.'" class="ideapush-icon-Edit user-edit-idea"></i></span>';

    //delete
    $html .= '<span class="delete-container"><i title="'.__('Delete Idea','ideapush').'" data="'.$ideaId.'" class="ideapush-icon-Delete user-delete-idea"></i></span>';


    return $html;

}

function idea_push_admin_duplicate($ideaId){

    //start output
    $html = '';

    $html .= '<span class="duplicate-container"><i title="'.__('Mark idea as duplicate','ideapush').'" data="'.$ideaId.'" class="ideapush-icon-Duplicate admin-duplicate-idea"></i></span>';

    return $html;

}


function idea_push_user_idea_delete(){

    $ideaId = idea_push_sanitization_validation($_POST['ideaId'],'id');

    if($ideaId == false){
        wp_die();      
    }

    //get the post author
    $postAuthorId = get_post_field( 'post_author', $ideaId );

    //get current user
    $current_user = wp_get_current_user();
        
    //returns current user id
    $current_user_id =  $current_user->ID;

    //only delete the idea if the current user is the author
    if($postAuthorId == $current_user_id){
        
        wp_trash_post($ideaId);  
        echo 'SUCCESS';

    } else {
        echo 'SOMETHING BAD HAPPENED';
    }

    

    wp_die();

} //end function
add_action( 'wp_ajax_user_delete_idea', 'idea_push_user_idea_delete' );
add_action( 'wp_ajax_nopriv_user_delete_idea', 'idea_push_user_idea_delete' );




function idea_push_user_idea_edit(){

    $ideaId = idea_push_sanitization_validation($_POST['ideaId'],'id');
    $ideaTitle = sanitize_text_field($_POST['ideaTitle']);
    $ideaContent = sanitize_text_field($_POST['ideaContent']);

    if($ideaId == false){
        wp_die();      
    }

    //get the post author
    $postAuthorId = get_post_field( 'post_author', $ideaId );

    //get current user
    $current_user = wp_get_current_user();
        
    //returns current user id
    $current_user_id =  $current_user->ID;

    //only delete the idea if the current user is the author
    if($postAuthorId == $current_user_id){
        
        //update the idea title and content
        $updated_post = array(
            'ID'           => $ideaId,
            'post_title'   => $ideaTitle,
            'post_content' => $ideaContent,
        );
       
        wp_update_post($updated_post);

        echo 'SUCCESS';


    } else {
        echo 'SOMETHING BAD HAPPENED';
    }

    

    wp_die();

} //end function
add_action( 'wp_ajax_user_edit_idea', 'idea_push_user_idea_edit' );
add_action( 'wp_ajax_nopriv_user_edit_idea', 'idea_push_user_idea_edit' );










//this function adds the target and triggers to zendesk on behalf of the user
function idea_push_jira_finalisation() {
    
    //get options
    $options = get_option('idea_push_settings');
    
    //only do action if variables exist
    $jiraDomain = $options['idea_push_jira_domain'];
	$jiraEmail = $options['idea_push_jira_login_email'];
    $jiraPassword = $options['idea_push_jira_login_password'];
    $jiraUniquePhrase = $options['idea_push_jira_unique_phrase'];

    $authorization = base64_encode($jiraEmail.':'.$jiraPassword);

    if(isset($jiraDomain) && strlen($jiraDomain)>0 && isset($jiraEmail) && strlen($jiraEmail)>0 && isset($jiraPassword) && strlen($jiraPassword)>0 && isset($jiraUniquePhrase) && strlen($jiraUniquePhrase)>0 ){

        $siteUrl = get_site_url();

        //create the first webhook for issues

        $json = json_encode( array(
            'excludeBody' => true,
            'name' => 'IdeaPush Statuses',
            'url' => $siteUrl.'/wp-json/ideapush/v1/jira?id=${issue.id}&phrase='.$jiraUniquePhrase,
            'events' => array(
                'jira:issue_updated'
            ),
        ));
        
        $response = wp_remote_post( 'https://'.$jiraDomain.'.atlassian.net/rest/webhooks/1.0/webhook/', array(
            'headers' => array(
                'Authorization' => 'Basic '.$authorization,
                'Content-Type' => 'application/json; charset=utf-8',
            ),
            'body' => $json,
        ));

        //create the second webhook for comments
        $json = json_encode( array(
            'excludeBody' => true,
            'name' => 'IdeaPush Comments',
            'url' => $siteUrl.'/wp-json/ideapush/v1/jira-comment?id=${issue.id}&commentid=${comment.id}&phrase='.$jiraUniquePhrase,
            'events' => array(
                // 'comment_updated',
                'comment_created',
                // 'comment_deleted'
            ),
        ));
        
        $response = wp_remote_post( 'https://'.$jiraDomain.'.atlassian.net/rest/webhooks/1.0/webhook/', array(
            'headers' => array(
                'Authorization' => 'Basic '.$authorization,
                'Content-Type' => 'application/json; charset=utf-8',
            ),
            'body' => $json,
        ));

        // $status = wp_remote_retrieve_response_code( $response );
        // echo $status;

    }


    //die
    wp_die();

 
}
add_action( 'wp_ajax_jira_finalisation', 'idea_push_jira_finalisation' );
            



//merge duplicate ideas
function idea_push_merge_duplicate_ideas(){

    //get from javascript variables
    $duplicateIdea = idea_push_sanitization_validation($_POST['duplicateIdea'],'id');
    $originalIdea = idea_push_sanitization_validation($_POST['originalIdea'],'id');
    $boardId = idea_push_sanitization_validation($_POST['boardId'],'id');

    if( $duplicateIdea == false || $originalIdea == false || $boardId == false ){
        wp_die();      
    }

 
    //only continue if user can do important stuff!
    if( current_user_can('editor') || current_user_can('administrator') || current_user_can('idea_push_manager') ) {



        //get options
        $options = get_option('idea_push_settings');

        //author details
        $postAuthorId = get_post_field( 'post_author', $originalIdea );
        $postAuthor = get_user_by('id',$postAuthorId);
        $postAuthorEmail = $postAuthor->user_email;



        //operations
        //change the duplicate idea status to duplicate - maybe see if we can do that with the change status feature - this may take care of the notification as well?
        $existingStatus = get_post_meta($duplicateIdea,'current-status',true);
        $currentUser = idea_push_check_if_non_logged_in_user_is_guest('Yes');


        wp_set_object_terms( $duplicateIdea, 'duplicate', 'status', false );
        idea_push_common_status($duplicateIdea,$existingStatus,'duplicate',$currentUser);

        //get the votes of the duplicate idea and add it to the original idea
        $duplicateIdeaScore = intval(get_post_meta($duplicateIdea,'votes',true));
        $originalIdeaScore = intval(get_post_meta($originalIdea,'votes',true));

        //get the positive voters
        $duplicateIdeaPositiveVoters = get_post_meta($duplicateIdea,'up-voters',true);
        $originalIdeaPositiveVoters = get_post_meta($originalIdea,'up-voters',true);

        //create a counter of the amount of votes we want to add
        $votesToAdd = 0;

        //lets first turn the original idea positive voters into a more usable form
        $originalIdeaPositiveVotersNice = array();

        foreach($originalIdeaPositiveVoters as $positiveVoter){
            array_push($originalIdeaPositiveVotersNice,$positiveVoter[0]);
        }

        //now lets loop through duplicate positive voters
        //if they didn't vote in the original add them to this array and add 1 to the score
        foreach($duplicateIdeaPositiveVoters as $positiveVoterDuplicate){

            $positiveVoterId = $positiveVoterDuplicate[0];
            
            if(!in_array($positiveVoterId,$originalIdeaPositiveVotersNice)){
                $votesToAdd++;
                array_push($originalIdeaPositiveVoters,$positiveVoterDuplicate);  
            }

        }

        //now lets update the votes 
        update_post_meta($originalIdea,'votes',$originalIdeaScore + $votesToAdd);

        //and update the positive voters array
        update_post_meta($originalIdea,'up-voters',$originalIdeaPositiveVoters);







        //we also need to check if the vote threshold has been reached
        $ideaScoreNow = get_post_meta($originalIdea,'votes',true);

        $individualBoardSetting = idea_push_get_board_settings($boardId);
        $voteThreshold = $individualBoardSetting[2];


        if($ideaScoreNow >= $voteThreshold){

            //change the status
            wp_set_object_terms($originalIdea,'reviewed','status',false);

            update_post_meta($originalIdea,'current-status', 'reviewed');
            
            //lets do our standard action here
            do_action('idea_push_idea_vote_threshold',$originalIdea,$voteThreshold);
            
            
            //send admin email if enabled in the settings
            if(isset($options['idea_push_notification_idea_review'])){

                if(strlen($options['idea_push_notification_email'])>0 && strpos($options['idea_push_notification_email'], '@') !== FALSE){

                    $to = $options['idea_push_notification_email'];
                    
                    $subject = idea_push_shortcode_replacement($originalIdea, $options['idea_push_notification_idea_review_subject'],'');

                    $body = idea_push_shortcode_replacement($originalIdea, $options['idea_push_notification_idea_review_content'],'');


                    idea_push_send_email($to,$subject,$body); 
                    
                    
                    do_action('idea_push_idea_review_admin_notification',$originalIdea,$options['idea_push_notification_idea_review_subject'].'|'.$options['idea_push_notification_idea_review_content']);
                    
                }

            }




            //send status change email to voters and authors

            //lets start with the author


            //send email to author if enabled that the status has changed
            if(isset($options['idea_push_notification_author_idea_change_review_enable'])){

                $subject = idea_push_shortcode_replacement($originalIdea, $options['idea_push_notification_author_idea_change_review_subject'],'');

                $body = idea_push_shortcode_replacement($originalIdea, $options['idea_push_notification_author_idea_change_review_content'],'');
                
                do_action('idea_push_idea_vote_author_notification_review',$originalIdea,$options['idea_push_notification_author_idea_change_review_subject'].'|'.$options['idea_push_notification_author_idea_change_review_content']);

                //send email to author on first publush
                idea_push_send_email($postAuthorEmail,$subject,$body);  
            }



            //send email to voters if enabled that the status has changed
            if(isset($options['idea_push_notification_voter_idea_change_review_enable'])){

                //get positive voters
                $positiveVoters = get_post_meta($originalIdea,'up-voters',true);

                //now cycle through each voter
                foreach($positiveVoters as $voter){
                    if(strlen($voter[0])>0){
                        $subject = idea_push_shortcode_replacement($originalIdea, $options['idea_push_notification_voter_idea_change_review_subject'],$voter[0]);

                        $body = idea_push_shortcode_replacement($originalIdea, $options['idea_push_notification_voter_idea_change_review_content'],$voter[0]);

                        //get voter email
                        $voterEmail = get_user_by('id',$voter[0]);    
                        $voterEmail = $voterEmail->user_email;

                        //send email to author on first publush
                        idea_push_send_email($voterEmail,$subject,$body);
                    }
                }  
                
                do_action('idea_push_idea_vote_voter_notification',$originalIdea,$options['idea_push_notification_voter_idea_change_review_subject'].'|'.$options['idea_push_notification_voter_idea_change_review_content']);
 
            }

        } //end vote threshold reached 





        echo 'SUCCESS';    
    } 

    

    wp_die();

} //end function
add_action( 'wp_ajax_merge_duplicate_ideas', 'idea_push_merge_duplicate_ideas' );
add_action( 'wp_ajax_nopriv_merge_duplicate_ideas', 'idea_push_merge_duplicate_ideas' );





//update custom field value
function idea_push_update_custom_field_value() {

    //get post variables
    $postId = intval($_POST['postId']);
    $metaKey = $_POST['metaKey'];
    $metaValue = $_POST['metaValue'];

    update_post_meta($postId,$metaKey,$metaValue);
    
    //get new html of idea history
    echo 'SUCCESS'; 
 
    //die
    wp_die();

}
add_action( 'wp_ajax_update_ideapush_custom_field', 'idea_push_update_custom_field_value' );



//add a new custom field and value
function idea_push_add_ideapush_custom_field() {

    //get post variables
    $postId = intval($_POST['postId']);
    $metaKey = $_POST['metaKey'];
    $metaValue = $_POST['metaValue'];

    update_post_meta($postId,$metaKey,$metaValue);
    
    //get new html of idea history
    echo 'SUCCESS'; 
 
    //die
    wp_die();

}
add_action( 'wp_ajax_add_ideapush_custom_field', 'idea_push_add_ideapush_custom_field' );



?>