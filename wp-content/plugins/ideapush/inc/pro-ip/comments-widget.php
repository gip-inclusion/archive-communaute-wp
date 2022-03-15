<?php

function idea_push_comments_widget_render_output($boardNumber){

    //start output
    $html = '';

    //create container
    $html .= '<div class="ideapush-comments-widget-inner">';

        //do heading
        $html .= '<span class="ideapush-form-title">'.__('Latest Comments','ideapush').'</span>';

        //we need to get all relevant comments
        $args = array(
            'post_type' => 'idea',
            'status' => 1,
            'order' => 'DESC',
            'orderby' => 'comment_date',
        );
        $comments = get_comments( $args );

        if($comments){

            $comments_shown = 0;

            $html .= '<ul class="ideapush-comments-listing">';

            foreach($comments as $comment){

                $comment_id = $comment->comment_ID;
                $comment_post_id = $comment->comment_post_ID;
                $comment_post_title = get_the_title($comment_post_id);
                $comment_post_link = get_the_permalink($comment_post_id);
                $comment_user_id = $comment->user_id;


                $comment_date = $comment->comment_date; //shown as 2019-04-17 08:28:13

                $comment_post_terms = get_the_terms( $comment_post_id, 'boards');

                foreach($comment_post_terms as $term){


                    $term_id = $term->term_id;

                    if($term_id == $boardNumber && $comments_shown < 10){

                        $html .= '<li>';
                            $html .= '<a href="'.esc_url(idea_push_get_user_author_page($comment_user_id)).'">'.esc_html(idea_push_get_user_name($comment_user_id)).'</a> '.__('on','ideapush').' '.'<a href="'.esc_url($comment_post_link).'">'.esc_html($comment_post_title).'</a>';   
                        $html .= '</li>';

                        $comments_shown++;

                    }
                }
            }

            $html .= '</ul>';
        }
       


    $html .= '</div>';

    return $html;
}    


?>