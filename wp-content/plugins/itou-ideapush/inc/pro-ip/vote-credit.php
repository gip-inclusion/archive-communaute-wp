<?php



    //on status change
    add_action( 'idea_push_idea_status_change', 'idea_push_give_people_back_their_votes_status',20,3);
    function idea_push_give_people_back_their_votes_status($ideaId,$currentUser,$content){
    
        //get the status of the idea and check
        $status = explode('|',$content);
        $old_status = $status[0];
        $new_status = $status[1];

        if(
            ($old_status == 'open' &&  $new_status == 'approved') || 
            ($old_status == 'open' &&  $new_status == 'declined') || 
            ($old_status == 'open' &&  $new_status == 'reviewed') ||  
            ($old_status == 'open' &&  $new_status == 'completed') || 
            ($old_status == 'open' &&  $new_status == 'in-progress') 
        ){
            //if good update status
            idea_push_give_people_back_their_votes($ideaId);
        }

    }


    //on delete
    add_action( 'before_delete_post', 'idea_push_give_people_back_their_votes_delete');
    function idea_push_give_people_back_their_votes_delete($postid){

        global $post_type;   
        if ( $post_type == 'idea' ) {    

            //first we need to check if the post has already been redeemed
            //if it hasn't continue
            if(!get_post_meta($postid,'votes-credited',false)){
                update_post_meta($postid,'votes-credited',true);
                idea_push_give_people_back_their_votes($postid);
            }
        }
    }

    //do action
    function idea_push_give_people_back_their_votes($postid){
        //get positive and negative voters
        $positive_voters = get_post_meta($postid,'up-voters',true);
        $negative_voters = get_post_meta($postid,'down-voters',true);

        $options = get_option('idea_push_settings');
        $userVoteBankNumber = intval($options['idea_push_amount_of_user_votes_in_bank']);   

        //merge the arrays
        $all_voters = array_merge($positive_voters, $negative_voters);

        //only continue if voters exist
        if(count($all_voters)){

            //loop through voters
            foreach($all_voters as $voter){

                $user_id = $voter[0];

                if(!get_user_meta($user_id, 'ideaPushVotesRemaining', false)){
                    //set the users vote meta to the score
                    update_user_meta($user_id,'ideaPushVotesRemaining',$userVoteBankNumber-1);
                }
        
                $users_bank = get_user_meta($user_id, 'ideaPushVotesRemaining', true);

                $users_bank++;

                update_user_meta($user_id,'ideaPushVotesRemaining',$users_bank);

            }
        }
    }



?>