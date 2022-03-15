<?php

function idea_push_leader_board_render_output($boardNumber){

    //start output
    $html = '';

    //create container
    $html .= '<div class="ideapush-leader-board-inner">';

        //do heading
        $html .= '<span class="ideapush-form-title">'.__('Leaderboard','ideapush').'</span>';

        //do navigation
        $html .= '<ul class="ideapush-leader-board-menu">';

            $html .= '<li class="active" data="ideapush-leader-board-content-most-votes">'.__('Most Votes','ideapush').'</li>';
            $html .= '<li data="ideapush-leader-board-content-top-ideas">'.__('Top Ideas','ideapush').'</li>';
            $html .= '<li data="ideapush-leader-board-content-most-ideas">'.__('Most Ideas','ideapush').'</li>';

        $html .= '</ul>';


        //do content
        $html .= '<div class="ideapush-leader-board-content">';


            //we need to get all users in wordpress and put them into an array
            $allUsers = get_users();
            $allUsersArray = array();

            foreach($allUsers as $user){
                $allUsersArray[$user->ID] = array('username'=>$user->user_login,'name'=>$user->first_name.' '.$user->last_name,'mostVotes'=>0,'topIdeas'=>0,'mostIdeas'=>0);   
            }

            //then we need to get all ideas belonging to the board
            $args = array(
                'suppress_filters' => 0,
                'post_type' => 'idea',
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'tax_query' => array("relation" => "AND",
                array(
                    'taxonomy' => 'boards',
                    'field'    => 'term_id',
                    'terms'    => array($boardNumber)
                )),
            );

            $ideaPosts = get_posts($args);

            foreach($ideaPosts as $ideaPost){
                //get the author id
                $authorId = get_the_author_meta('ID',$ideaPost->post_author);
                //get the amount of votes
                $votes = get_post_meta($ideaPost->ID,'votes',true);


                //do most votes
                //get existing value
                $existingMostVotesValue = $allUsersArray[$authorId]['mostVotes'];

                //add current amount of votes to amount
                $existingMostVotesValue = intval($existingMostVotesValue) + intval($votes);

                //set new value
                $allUsersArray[$authorId]['mostVotes'] = $existingMostVotesValue;


                //do top ideas
                //get existing value
                $existingMostVotesValue = $allUsersArray[$authorId]['topIdeas'];
                if($votes > $existingMostVotesValue){
                    $allUsersArray[$authorId]['topIdeas'] = $votes;
                }


                //do most ideas
                
                //get existing value
                $existingMostIdeasValue = $allUsersArray[$authorId]['mostIdeas'];

                //increment the value by one
                $existingMostIdeasValue++;

                //update the value
                $allUsersArray[$authorId]['mostIdeas'] = $existingMostIdeasValue;

            }    


            //lets sort the array by values

            //create sort arrays
            $mostVotesSorted = array();
            $topIdeasSorted = array();
            $mostIdeasSorted = array();


            foreach($allUsersArray as $key => $value){

                $mostVotesSorted[$key] = $value['mostVotes'];
                $topIdeasSorted[$key] = $value['topIdeas'];
                $mostIdeasSorted[$key] = $value['mostIdeas'];
                
            }

            // var_dump($mostVotesSorted);

            //sort all the arrays
            arsort($mostVotesSorted);
            arsort($topIdeasSorted);
            arsort($mostIdeasSorted);

            // var_dump($mostVotesSorted);



            //do most votes
            $html .= '<div class="ideapush-leader-board-content-most-votes">';

                $html .= '<ul class="leader-board-listing">';
                $mostVotesCounter = 0;
                foreach($mostVotesSorted as $key => $value){
                    if($mostVotesCounter < 10){
                        if($value > 0){
                            $html .= idea_push_leader_board_user_output($key,$value);
                        }
                    }
                    $mostVotesCounter++;
                }
                $html .= '</ul>';

            $html .= '</div>';

            //do top ideas
            $html .= '<div style="display: none;" class="ideapush-leader-board-content-top-ideas">';

                $html .= '<ul class="leader-board-listing">';
                $topIdeasCounter = 0;
                foreach($topIdeasSorted as $key => $value){
                    if($topIdeasCounter < 10){

                        //only show person if they have at least 1
                        
                        if($value > 0){
                            $html .= idea_push_leader_board_user_output($key,$value);
                        }

                        
                    }
                    $topIdeasCounter++;
                }
                $html .= '</ul>';

               

            $html .= '</div>';

            //do most ideas
            $html .= '<div style="display: none;" class="ideapush-leader-board-content-most-ideas">';

                $html .= '<ul class="leader-board-listing">';
                $mostIdeasCounter = 0;
                foreach($mostIdeasSorted as $key => $value){
                    if($mostIdeasCounter < 10){

                        if($value > 0){
                            $html .= idea_push_leader_board_user_output($key,$value);
                        }

                    }
                    $mostIdeasCounter++;
                }
                $html .= '</ul>';

            $html .= '</div>';


        $html .= '</div>';


    $html .= '</div>';

    return $html;
}    

function idea_push_leader_board_user_output($userId,$number){

    //get user name
    // $userObject = get_user_by('ID', $userId);
    // $usersName = $userObject->first_name.' '.$userObject->last_name;
    // $username = $userObject->user_login;

    //start output
    $html = '';

    $html .= '<li data="'.esc_attr($userId).'">';


        $html .= '<img class="idea-author-profile-image" src="'.esc_url(idea_push_get_user_avatar($userId)).'" />';

        //do admin star            
        if(idea_push_is_user_admin($userId)){
            $html .= '<span class="admin-star-outer"><i class="ideapush-icon-Star admin-star-icon"></i></span>';    
        }
        
        $html .= '<a href="'.esc_url(idea_push_get_user_author_page($userId)).'" class="idea-author">'.esc_html(idea_push_get_user_name($userId)).'</a>';

        $html .= '<span class="leader-board-number">'.esc_html($number).'</span>';


    $html .= '</li>';

    return $html;

}


?>