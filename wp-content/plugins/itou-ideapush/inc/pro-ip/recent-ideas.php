<?php

function idea_push_recent_ideas_render_output($board_id,$number_of_ideas,$status){

    //enqueue scripts and styles
    wp_enqueue_style(array('custom-frontend-style-ideapush','ideapush-font'));
    wp_enqueue_script(array('alertify','custom-frontend-script-ideapush','scroll-reveal','read-more','custom-frontend-script-ideapush-pro'));

    //get all posts
    global $post;
        
    //get options
    $options = get_option('idea_push_settings');

    //translate status
    $status = strtolower($status);
    $status = str_replace(" ", "-", $status);

    //start output
    $html = '';

    //do query
    $args = array(
        'suppress_filters' => 0,
        'post_type' => 'idea',
        'post_status' => 'publish',
        'posts_per_page' => intval($number_of_ideas),
    );
    
    if($board_id != ''){
        $args['tax_query'] = array("relation" => "AND",
        array(
            'taxonomy' => 'boards',
            'field'    => 'term_id',
            'terms'    => array($board_id)
        ));
    }


    if($status !== 'all-statuses'){

        //get original value
        $originalValue = $args['tax_query'];

        //length of array
        $lengthOfArray = count($originalValue);

        $originalValue[$lengthOfArray-1] = array(
            'taxonomy' => 'status',
            'field'    => 'slug',
            'terms'    => array($status)
        );

        $args['tax_query'] = $originalValue;
    }

    $ideas = get_posts($args);


    if(!empty($ideas)){
        $html .= '<ul class="recent-ideas">';

            foreach($ideas as $idea){

                $html .= '<li>';

                    //title
                    //if pro option is set
                    if(!isset($options['idea_push_disable_single_idea_page']) || $options['idea_push_disable_single_idea_page'] !== "1"){
                        $html .= '<a href="'.esc_url(get_post_permalink($idea->ID)).'" class="recent-idea-title">';
                    } else {
                            $html .= '<a class="recent-idea-title">';    
                    }
        
                    $html .= esc_html($idea->post_title);
                    $html .= '</a>'; 

                    //date published
                    $html .= ' <span class="recent-idea-item-date">'.esc_html(human_time_diff(strtotime($idea->post_date), current_time( 'timestamp' ) )).' '.__( 'ago','ideapush' ).'</span>';

                    //show content
                    if(!isset($options['idea_push_disable_single_idea_page']) || $options['idea_push_disable_single_idea_page'] !== "1"){
                                
                        if(strlen($idea->post_content)>200){
                            $readMore = '... <a class="idea-read-more" href="'.esc_url(get_post_permalink($idea->ID)).'">'.__('Read more','ideapush').'...</a>';
                        } else {
                            $readMore = '';   
                        }

                        $html .= '<span class="recent-idea-item-content">'.mb_substr(strip_tags($idea->post_content),0,200).'</span>'.$readMore;     
                    } else {
                        
                        $html .= '<div id="ideaReadMoreText" style="display: none;">'.__('Read more','ideapush').'</div>';
                        
                        $html .= '<div id="ideaReadLessText" style="display: none;">'.__('Read less','ideapush').'</div>';
                        
                        $html .= '<span class="recent-idea-item-content idea-item-content-read-more">'.strip_tags($idea->post_content).'</span>';    
                        
                    }

                $html .= '</li>';
            }

        $html .= '</ul>';
    }

    return $html;

}    


function idea_push_recent_ideas_render_shortcode($atts) {

    
    //set a default attribute for board
    $a = shortcode_atts(array('board' => '','number' => 3,'status' => 'all-statuses'),$atts);

    return idea_push_recent_ideas_render_output($a['board'],$a['number'],$a['status']);


}
add_shortcode('ideapush_recent_ideas', 'idea_push_recent_ideas_render_shortcode');

?>