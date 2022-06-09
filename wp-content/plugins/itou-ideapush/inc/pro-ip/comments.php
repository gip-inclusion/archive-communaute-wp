<?php


    add_action( 'wp_ajax_get_idea_comments', 'idea_push_render_comments' );
    add_action( 'wp_ajax_nopriv_get_idea_comments', 'idea_push_render_comments' );

    function idea_push_render_comments(){

        $ideaId = idea_push_sanitization_validation($_POST['ideaId'],'id');
        $boardId = idea_push_sanitization_validation($_POST['boardId'],'id');


        //start output
        $html = '';

        if(strlen($ideaId)>0 && strlen($boardId)>0){
        
            //get settings    
            $individualBoardSetting = idea_push_get_board_settings($boardId);
            $multiIp = $individualBoardSetting[27];
            if(!isset($multiIp)){
                $multiIp = 'No';
            }
            $currentUserId = idea_push_check_if_non_logged_in_user_is_guest($multiIp);

            $html .= '<li data="'.$ideaId.'" id="idea-item-comments-listing">';

                //get comments
                $comments = get_comments(array(
                        'post_id' => $ideaId,
                        'status' => 'approve',
                    )
                );

                //only proceed if comments exist
                if(!empty($comments)){

                    //do new list to contain the comments
                    $html .= '<ul class="idea-push-comments-container">';

                    foreach($comments as $comment) {

                        //get key variables
                        $content = $comment->comment_content;
                        $date = $comment->comment_date; 
                        $id = $comment->comment_ID;
                        $date = $comment->comment_date;
                        $user_id = $comment->user_id;

                        $html .= '<li data="'.$id.'">';

                            //left side - do image
                            $html .= '<div class="idea-push-comments-container-left">';

                                $html .= '<img class="idea-commenter-profile-image" src="'.esc_url(idea_push_get_user_avatar($user_id)).'" />';
        
                                //do admin star            
                                if(idea_push_is_user_admin($user_id)){
                                    $html .= '<span class="admin-star-outer-large admin-star-outer-large-comment"><i class="ideapush-icon-Star admin-star-icon-large"></i></span>';      
                                }

                            $html .= '</div>';
                            //right side - do name and then comment
                            $html .= '<div class="idea-push-comments-container-right">';
                                $html .= '<strong>'.esc_html(idea_push_get_user_name($user_id)).'</strong>';
                                
                                $time_of_comment = sprintf( _x( '%1$s ago', 'ideapush' ),
                                    human_time_diff( strtotime($date), current_time( 'timestamp' )));

                                $html .= '<span class="idea-push-comment-date">'.esc_html($time_of_comment).'</span>';
                                $html .= '<span class="idea-push-comment-content">'.$content.'</span>';
                            $html .= '</div>';


                            
                        $html .= '</li>';
                    }   
                    $html .= '</ul>';
                }

                //add action here so people can put messages
                $html .= apply_filters('idea_push_before_textarea', '');

                //check if person is a guest
                if($currentUserId == false){

                    global $wp;
                    $currentPage = home_url($wp->request);

                    //show login
                    $html .= '<a href="'.wp_login_url($currentPage).'" class="ideapush-login-link-comment">'.__( 'Login to comment', 'ideapush' ).'</a>';
                } else {
                    //enable the ability to post a comment
                    $html .= '<textarea id="idea-push-new-comment" placeholder="'.__('Add new comment','ideapush').'">'; 

                    $html .= '</textarea>'; 

                    $html .= '<button data-idea-id="'.$ideaId.'" data-user-id="'.$currentUserId.'" class="submit-new-comment">'.__('Comment','ideapush').' <i class="ideapush-icon-Submit"></i></button>';
                }

                    



            $html .= '</li>';
        }
        echo $html;

        wp_die();

    }



    add_action( 'wp_ajax_post_idea_comment', 'idea_push_post_comment' );
    add_action( 'wp_ajax_nopriv_post_idea_comment', 'idea_push_post_comment' );

    function idea_push_post_comment(){

        $ideaId = idea_push_sanitization_validation($_POST['ideaId'],'id');
        $userId = idea_push_sanitization_validation($_POST['userId'],'id');
        $comment = idea_push_sanitization_validation($_POST['comment'],'textarea');

        $user = get_user_by( 'ID', $userId );


        if(strlen($ideaId)>0 && strlen($userId)>0 && strlen($comment)>0){

            $commentdata = array(
                'user_id' => $userId,
                'comment_content' => $comment,
                'comment_post_ID' => $ideaId,
                'comment_author' => $user->first_name.' '.$user->last_name,
                'comment_author_email' => $user->user_email,
                'comment_author_url' => $user->user_url
            );

            //we need to adjust the approval setting according to wordpress
            $wordpress_option_comment_moderation = get_option('comment_moderation');

            if($wordpress_option_comment_moderation){
                $commentdata['comment_approved'] = 0;
            } else {
                $commentdata['comment_approved'] = 1;    
            }

            $comment_id = wp_insert_comment( $commentdata );
            $comment = get_comment( $comment_id );

            //lets check if an email needs to be sent
            $wordpress_option_comment_notify = get_option('comments_notify');

            if($wordpress_option_comment_notify){
                
                //do common variables
                $blogname = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
                $post = get_post($ideaId);
                $comment_content = wp_specialchars_decode( $comment->comment_content );

                /* translators: %s: Post title. */
				$notify_message = sprintf( __( 'New comment on your post "%s"' ), $post->post_title ) . "\r\n";
				/* translators: 1: Comment author's name, 2: Comment author's IP address, 3: Comment author's hostname. */
				$notify_message .= sprintf( __( 'Author: %1$s (IP address: %2$s, %3$s)' ), $comment->comment_author, $comment->comment_author_IP, $comment_author_domain ) . "\r\n";
				/* translators: %s: Comment author email. */
				$notify_message .= sprintf( __( 'Email: %s' ), $comment->comment_author_email ) . "\r\n";
				/* translators: %s: Trackback/pingback/comment author URL. */
				$notify_message .= sprintf( __( 'URL: %s' ), $comment->comment_author_url ) . "\r\n";

				if ( $comment->comment_parent && user_can( $post->post_author, 'edit_comment', $comment->comment_parent ) ) {
					/* translators: Comment moderation. %s: Parent comment edit URL. */
					$notify_message .= sprintf( __( 'In reply to: %s' ), admin_url( "comment.php?action=editcomment&c={$comment->comment_parent}#wpbody-content" ) ) . "\r\n";
				}

				/* translators: %s: Comment text. */
				$notify_message .= sprintf( __( 'Comment: %s' ), "\r\n" . $comment_content ) . "\r\n\r\n";
				$notify_message .= __( 'You can see all comments on this post here:' ) . "\r\n";
				/* translators: Comment notification email subject. 1: Site title, 2: Post title. */
	

                $notify_message .= get_permalink( $comment->comment_post_ID ) . "#comments\r\n\r\n";
                /* translators: %s: Comment URL. */
                $notify_message .= sprintf( __( 'Permalink: %s' ), get_comment_link( $comment ) ) . "\r\n";

                if ( EMPTY_TRASH_DAYS ) {
                    /* translators: Comment moderation. %s: Comment action URL. */
                    $notify_message .= sprintf( __( 'Trash it: %s' ), admin_url( "comment.php?action=trash&c={$comment->comment_ID}#wpbody-content" ) ) . "\r\n";
                } else {
                    /* translators: Comment moderation. %s: Comment action URL. */
                    $notify_message .= sprintf( __( 'Delete it: %s' ), admin_url( "comment.php?action=delete&c={$comment->comment_ID}#wpbody-content" ) ) . "\r\n";
                }
                /* translators: Comment moderation. %s: Comment action URL. */
                $notify_message .= sprintf( __( 'Spam it: %s' ), admin_url( "comment.php?action=spam&c={$comment->comment_ID}#wpbody-content" ) ) . "\r\n";


                $notify_message = apply_filters( 'comment_notification_text', $notify_message, $comment->comment_ID );

                $to = get_option( 'admin_email' );
                $subject = sprintf( __( '[%1$s] Comment: "%2$s"' ), $blogname, $post->post_title );
                $body = $notify_message;
                $headers = "$from\n"
                . 'Content-Type: text/plain; charset="' . get_option( 'blog_charset' ) . "\"\n";
                wp_mail( $to, $subject, $body, $headers );

            }

        } else {
            echo 'ERROR';
        }

        wp_die();

    }


    

?>