<?php


    // Register and load the widget(s)
    function idea_push_load_widget() {
        register_widget( 'ideapush_leaderboard' );
        register_widget( 'ideapush_tags' );
        register_widget( 'ideapush_form' );
        register_widget( 'ideapush_recent_ideas' );
        register_widget( 'ideapush_recent_comments' );
    }
    add_action( 'widgets_init', 'idea_push_load_widget' );
    





    class ideapush_recent_ideas extends WP_Widget {

        function __construct() {
            parent::__construct(
            
            // Base ID of your widget
            'ideapush_recent_ideas', 
            
            // Widget name will appear in UI
            __('IdeaPush Recent Ideas', 'ideapush'), 
            
            // Widget description
            array( 'description' => __( 'Shows recent ideas in a simple display', 'ideapush' ), ) 
            );
        }
    
        // Creating widget front-end
        public function widget( $args, $instance ) {
            $title = apply_filters( 'widget_title', $instance['title'] );
            
            // before and after widget arguments are defined by themes
            echo $args['before_widget'];
            if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];


            // This is where you run the code and display the output
            //get the board id
            $board_id = $instance['board'];
            $number_of_ideas = $instance['number'];
            $status = $instance['status'];

            if(isset($board_id)){
                echo idea_push_recent_ideas_render_output($board_id,$number_of_ideas,$status);    
            }

            echo $args['after_widget'];
        }
            
        // Widget Backend 
        public function form( $instance ) {

            //sets defaults
            if ( isset( $instance[ 'title' ] ) ) {
                $title = $instance[ 'title' ];
            }
            else {
                $title = __( 'New title', 'ideapush' );
            }

            if ( isset( $instance[ 'number' ] ) ) {
                $number = $instance[ 'number' ];
            }
            else {
                $number = 3;
            }

            if ( isset( $instance[ 'status' ] ) ) {
                $status = $instance[ 'status' ];
            }
            else {
                $status = 'all-statuses';
            }

            // Widget admin form
            $html = '';

                $html .= '<p>';
                    $html .= '<label for="'.$this->get_field_id( 'title' ).'">'.__('Title:','ideapush').'</label>';
                    $html .= '<input class="widefat" id="'.$this->get_field_id( 'title' ).'" name="'.$this->get_field_name( 'title' ).'" type="text" value="'.esc_attr( $title ).'" />';
                $html .= '</p>';

                $html .= '<p>';
                    $html .= '<label for="'.$this->get_field_id( 'board' ).'">'.__('Board:','ideapush').'</label>';
                    $html .= '<select class="widefat" id="'.$this->get_field_id( 'board' ).'" name="'.$this->get_field_name( 'board' ).'">';
                        //get boards
                        $all_boards = get_terms('boards',array('hide_empty' => false));

                        // var_dump($all_boards);

                        foreach ($all_boards as $board_item) {

                            $board_name = $board_item->name;
                            $board_id = $board_item->term_id;

                            if($instance[ 'board' ] == $board_id){
                                $html .= '<option value="'.$board_id.'" selected="selected">'.$board_name.'</option>';
                            } else {
                                $html .= '<option value="'.$board_id.'">'.$board_name.'</option>';    
                            }
                                
                        }    

                    $html .= '</select>';
                $html .= '</p>';




                $html .= '<p>';
                    $html .= '<label for="'.$this->get_field_id( 'status' ).'">'.__('Status:','ideapush').'</label>';
                    $html .= '<select class="widefat" id="'.$this->get_field_id( 'status' ).'" name="'.$this->get_field_name( 'status' ).'">';
                        //get boards
                        $statuses = array('Open'=>'Open','Reviewed'=>'Reviewed','Approved'=>'Approved','Declined'=>'Declined','In Progress'=>'In Progress','Completed'=>'Completed','All Statuses'=>'All Statuses');

                        // var_dump($all_boards);

                        foreach ($statuses as $key => $value) {

                            if($instance[ 'status' ] == $status_item){
                                $html .= '<option value="'.$key.'" selected="selected">'.$value.'</option>';
                            } else {
                                $html .= '<option value="'.$key.'">'.$value.'</option>';    
                            }
                                
                        }    

                    $html .= '</select>';
                $html .= '</p>';

                $html .= '<p>';
                    $html .= '<label for="'.$this->get_field_id( 'number' ).'">'.__('Number of ideas to show:','ideapush').'</label>';
                    $html .= '<input class="widefat" id="'.$this->get_field_id( 'number' ).'" name="'.$this->get_field_name( 'number' ).'" type="number" value="'.esc_attr( $number ).'" />';
                $html .= '</p>';

            echo $html;

        }
        
        // Updating widget replacing old instances with new
        public function update( $new_instance, $old_instance ) {

            $instance = array();
            $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
            $instance['board'] = ( ! empty( $new_instance['board'] ) ) ? strip_tags( $new_instance['board'] ) : '';
            $instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';
            $instance['status'] = ( ! empty( $new_instance['status'] ) ) ? strip_tags( $new_instance['status'] ) : '';
            return $instance;
        }

    } // Class wpb_widget ends here










    //do leaderboard specific stuff
    // Creating the leaderboard widget 
    class ideapush_leaderboard extends WP_Widget {

        function __construct() {
            parent::__construct(
            
            // Base ID of your widget
            'ideapush_leaderboard', 
            
            // Widget name will appear in UI
            __('IdeaPush Leaderboard', 'ideapush'), 
            
            // Widget description
            array( 'description' => __( 'Leaderboard for IdeaPush board.', 'ideapush' ), ) 
            );
        }
    
        // Creating widget front-end
        public function widget( $args, $instance ) {
            $title = apply_filters( 'widget_title', $instance['title'] );
            
            // before and after widget arguments are defined by themes
            echo $args['before_widget'];
            if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];
            
            //enqueue scripts and styles
            wp_enqueue_style(array('custom-frontend-style-ideapush','ideapush-font'));
            wp_enqueue_script(array('alertify','custom-frontend-script-ideapush','scroll-reveal','read-more','custom-frontend-script-ideapush-pro'));

            // This is where you run the code and display the output
            //get the board id
            $board_id = $instance['board'];

            if(isset($board_id)){
                echo idea_push_leader_board_render_output($board_id);    
            }

            echo $args['after_widget'];
        }
            
        // Widget Backend 
        public function form( $instance ) {

            //sets defaults
            if ( isset( $instance[ 'title' ] ) ) {
                $title = $instance[ 'title' ];
            }
            else {
                $title = __( 'New title', 'ideapush' );
            }

            // Widget admin form
            $html = '';

                $html .= '<p>';
                    $html .= '<label for="'.$this->get_field_id( 'title' ).'">'.__('Title:','ideapush').'</label>';
                    $html .= '<input class="widefat" id="'.$this->get_field_id( 'title' ).'" name="'.$this->get_field_name( 'title' ).'" type="text" value="'.esc_attr( $title ).'" />';
                $html .= '</p>';

                $html .= '<p>';
                    $html .= '<label for="'.$this->get_field_id( 'board' ).'">'.__('Board:','ideapush').'</label>';
                    $html .= '<select class="widefat" id="'.$this->get_field_id( 'board' ).'" name="'.$this->get_field_name( 'board' ).'">';
                        //get boards
                        $all_boards = get_terms('boards',array('hide_empty' => false));

                        // var_dump($all_boards);

                        foreach ($all_boards as $board_item) {

                            $board_name = $board_item->name;
                            $board_id = $board_item->term_id;

                            if($instance[ 'board' ] == $board_id){
                                $html .= '<option value="'.$board_id.'" selected="selected">'.$board_name.'</option>';
                            } else {
                                $html .= '<option value="'.$board_id.'">'.$board_name.'</option>';    
                            }
                                
                        }    

                    $html .= '</select>';
                $html .= '</p>';

            echo $html;

        }
        
        // Updating widget replacing old instances with new
        public function update( $new_instance, $old_instance ) {

            $instance = array();
            $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
            $instance['board'] = ( ! empty( $new_instance['board'] ) ) ? strip_tags( $new_instance['board'] ) : '';
            return $instance;
        }

    } // Class wpb_widget ends here









    //do leaderboard specific stuff
    // Creating the leaderboard widget 
    class ideapush_recent_comments extends WP_Widget {

        function __construct() {
            parent::__construct(
            
            // Base ID of your widget
            'ideapush_recent_comments', 
            
            // Widget name will appear in UI
            __('IdeaPush Recent Comments', 'ideapush'), 
            
            // Widget description
            array( 'description' => __( 'Recent comments for IdeaPush board.', 'ideapush' ), ) 
            );
        }
    
        // Creating widget front-end
        public function widget( $args, $instance ) {
            $title = apply_filters( 'widget_title', $instance['title'] );
            
            // before and after widget arguments are defined by themes
            echo $args['before_widget'];
            if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];
            
            //enqueue scripts and styles
            wp_enqueue_style(array('custom-frontend-style-ideapush','ideapush-font'));
            wp_enqueue_script(array('alertify','custom-frontend-script-ideapush','scroll-reveal','read-more','custom-frontend-script-ideapush-pro'));

            // This is where you run the code and display the output
            //get the board id
            $board_id = $instance['board'];

            if(isset($board_id)){
                echo idea_push_comments_widget_render_output($board_id);    
            }

            echo $args['after_widget'];
        }
            
        // Widget Backend 
        public function form( $instance ) {

            //sets defaults
            if ( isset( $instance[ 'title' ] ) ) {
                $title = $instance[ 'title' ];
            }
            else {
                $title = __( 'New title', 'ideapush' );
            }

            // Widget admin form
            $html = '';

                $html .= '<p>';
                    $html .= '<label for="'.$this->get_field_id( 'title' ).'">'.__('Title:','ideapush').'</label>';
                    $html .= '<input class="widefat" id="'.$this->get_field_id( 'title' ).'" name="'.$this->get_field_name( 'title' ).'" type="text" value="'.esc_attr( $title ).'" />';
                $html .= '</p>';

                $html .= '<p>';
                    $html .= '<label for="'.$this->get_field_id( 'board' ).'">'.__('Board:','ideapush').'</label>';
                    $html .= '<select class="widefat" id="'.$this->get_field_id( 'board' ).'" name="'.$this->get_field_name( 'board' ).'">';
                        //get boards
                        $all_boards = get_terms('boards',array('hide_empty' => false));

                        // var_dump($all_boards);

                        foreach ($all_boards as $board_item) {

                            $board_name = $board_item->name;
                            $board_id = $board_item->term_id;

                            if($instance[ 'board' ] == $board_id){
                                $html .= '<option value="'.$board_id.'" selected="selected">'.$board_name.'</option>';
                            } else {
                                $html .= '<option value="'.$board_id.'">'.$board_name.'</option>';    
                            }
                                
                        }    

                    $html .= '</select>';
                $html .= '</p>';

            echo $html;

        }
        
        // Updating widget replacing old instances with new
        public function update( $new_instance, $old_instance ) {

            $instance = array();
            $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
            $instance['board'] = ( ! empty( $new_instance['board'] ) ) ? strip_tags( $new_instance['board'] ) : '';
            return $instance;
        }

    } // Class wpb_widget ends here














    //do tag specific stuff
    // Creating the tags widget 
    class ideapush_tags extends WP_Widget {

        function __construct() {
            parent::__construct(
            
            // Base ID of your widget
            'ideapush_tags', 
            
            // Widget name will appear in UI
            __('IdeaPush Tags', 'ideapush'), 
            
            // Widget description
            array( 'description' => __( 'Show tags', 'ideapush' ), ) 
            );
        }
    
        // Creating widget front-end
        public function widget( $args, $instance ) {
            $title = apply_filters( 'widget_title', $instance['title'] );
            
            // before and after widget arguments are defined by themes
            echo $args['before_widget'];
            if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];
            
            //enqueue scripts and styles
            wp_enqueue_style(array('custom-frontend-style-ideapush','ideapush-font'));
            wp_enqueue_script(array('alertify','custom-frontend-script-ideapush','scroll-reveal','read-more','custom-frontend-script-ideapush-pro'));

            // This is where you run the code and display the output
            //get the board id
            $board_id = $instance['board'];

            if(isset($board_id)){

                if($instance['empty'] == 'Yes'){
                    $hide_empty = false;
                } else {
                    $hide_empty = true;
                }

                $all_tags = get_terms('tags',
                    array(
                        'hide_empty' => $hide_empty,
                        'orderby'=>'count', 
                        'order'=>'DESC',
                    )
                );

                // var_dump($all_tags);
                


                if(!empty($all_tags)){

                    if(!isset($instance['number']) || $instance['number'] == 0){
                        $number_to_show = 999;
                    } else {
                        $number_to_show = intval($instance['number']);
                    }
                    $current_number = 0;


                    echo '<div class="ideapush-leader-board-inner">';
                        echo '<ul>';

                        foreach($all_tags as $tag){

                            
                            $tag_name = $tag->name;
                            $tag_id = $tag->term_id;
                            $tag_slug = $tag->slug;
                            $tag_link = get_term_link($tag_id);
                            $tag_count = $tag->count;
                            
                            if($board_id == 'All' || strpos($tag_slug, $board_id) !== false){
                                if($current_number < $number_to_show){

                                    //work with the board name
                                    if(strpos($tag_slug, 'boardtag') !== false){
                                        $where_board_id_is = strpos($tag_name,$board_id);
                                        $tag_name = substr($tag_name,$where_board_id_is+1+strlen($board_id));
                                    }

                                    echo '<li>';
                                        echo '<a href="'.$tag_link.'">'.$tag_name.'</a>';
                                        if($instance['count'] == 'Yes'){
                                            echo ' ('.$tag_count.')';
                                        }
                                    echo '</li>';
                                
                                }
                                $current_number++;
                            }
                            

                            
                        }
                        echo '</ul>';
                    echo '</div>';
                }
            }

            echo $args['after_widget'];
        }
            
        // Widget Backend 
        public function form( $instance ) {

            //sets defaults
            if ( isset( $instance[ 'title' ] ) ) {
                $title = $instance[ 'title' ];
            }
            else {
                $title = __( 'New title', 'ideapush' );
            }

            if ( isset( $instance[ 'number' ] ) ) {
                $number = $instance[ 'number' ];
            }
            else {
                $number = 0;
            }

            // Widget admin form
            $html = '';

                $html .= '<p>';
                    $html .= '<label for="'.$this->get_field_id( 'title' ).'">'.__('Title:','ideapush').'</label>';
                    $html .= '<input class="widefat" id="'.$this->get_field_id( 'title' ).'" name="'.$this->get_field_name( 'title' ).'" type="text" value="'.esc_attr( $title ).'" />';
                $html .= '</p>';

                $html .= '<p>';
                    $html .= '<label for="'.$this->get_field_id( 'board' ).'">'.__('Get tags from a specific board only:','ideapush').'</label>';
                    $html .= '<select class="widefat" id="'.$this->get_field_id( 'board' ).'" name="'.$this->get_field_name( 'board' ).'">';

                        if($instance[ 'board' ] == 'All'){
                            $html .= '<option value="All" selected="selected">'.__('Show all tags','ideapush').'</option>';
                        } else {
                            $html .= '<option value="All">'.__('Show all tags','ideapush').'</option>';    
                        }


                        //get boards
                        $all_boards = get_terms('boards',array('hide_empty' => false));

                        // var_dump($all_boards);

                        foreach ($all_boards as $board_item) {

                            $board_name = $board_item->name;
                            $board_id = $board_item->term_id;

                            if($instance[ 'board' ] == $board_id){
                                $html .= '<option value="'.$board_id.'" selected="selected">'.$board_name.'</option>';
                            } else {
                                $html .= '<option value="'.$board_id.'">'.$board_name.'</option>';    
                            }
                                
                        }    

                    $html .= '</select>';
                $html .= '</p>';
                    
                

                $html .= '<p>';
                    $html .= '<label for="'.$this->get_field_id( 'count' ).'">'.__('Show count:','ideapush').'</label>';
                    
                    if($instance[ 'count' ] == 'Yes'){
                        $html .= ' <input class="widefat" id="'.$this->get_field_id( 'count' ).'" name="'.$this->get_field_name( 'count' ).'" type="checkbox" value="Yes" checked />';
                    } else {
                        $html .= ' <input class="widefat" id="'.$this->get_field_id( 'count' ).'" name="'.$this->get_field_name( 'count' ).'" type="checkbox" value="Yes" />';
                    }

                $html .= '</p>';

                $html .= '<p>';
                    $html .= '<label for="'.$this->get_field_id( 'empty' ).'">'.__('Show empty tags:','ideapush').'</label>';
                    
                    if($instance[ 'empty' ] == 'Yes'){
                        $html .= ' <input class="widefat" id="'.$this->get_field_id( 'empty' ).'" name="'.$this->get_field_name( 'empty' ).'" type="checkbox" value="Yes" checked />';
                    } else {
                        $html .= ' <input class="widefat" id="'.$this->get_field_id( 'empty' ).'" name="'.$this->get_field_name( 'empty' ).'" type="checkbox" value="Yes" />';
                    }

                $html .= '</p>';

                $html .= '<p>';
                    $html .= '<label for="'.$this->get_field_id( 'number' ).'">'.__('Number of tags to show:','ideapush').'</label>';
                    $html .= '<input class="widefat" id="'.$this->get_field_id( 'number' ).'" name="'.$this->get_field_name( 'number' ).'" type="number" value="'.esc_attr( $number ).'" />';
                $html .= '</p>';

            echo $html;

        }
        
        // Updating widget replacing old instances with new
        public function update( $new_instance, $old_instance ) {

            $instance = array();
            $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
            $instance['board'] = ( ! empty( $new_instance['board'] ) ) ? strip_tags( $new_instance['board'] ) : '';
            $instance['count'] = ( ! empty( $new_instance['count'] ) ) ? strip_tags( $new_instance['count'] ) : '';
            $instance['empty'] = ( ! empty( $new_instance['empty'] ) ) ? strip_tags( $new_instance['empty'] ) : '';
            $instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';
            return $instance;
        }

    } // Class wpb_widget ends here















    //do form specific stuff
    // Creating the form widget 
    class ideapush_form extends WP_Widget {

        function __construct() {
            parent::__construct(
            
            // Base ID of your widget
            'ideapush_form', 
            
            // Widget name will appear in UI
            __('IdeaPush Form', 'ideapush'), 
            
            // Widget description
            array( 'description' => __( 'Form for IdeaPush board.', 'ideapush' ), ) 
            );
        }
    
        // Creating widget front-end
        public function widget( $args, $instance ) {
            $title = apply_filters( 'widget_title', $instance['title'] );
            
            // before and after widget arguments are defined by themes
            echo $args['before_widget'];
            if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];
            
            //enqueue scripts and styles
            wp_enqueue_style(array('custom-frontend-style-ideapush','ideapush-font'));
            wp_enqueue_script(array('alertify','custom-frontend-script-ideapush','scroll-reveal','read-more','custom-frontend-script-ideapush-pro'));

            // This is where you run the code and display the output
            //get the board id
            $board_id = $instance['board'];


            if(isset($board_id)){

                echo '<div class="ideapush-container">';
                    echo '<div class="ideapush-container-form">';
                        echo idea_push_form_render_output($board_id); 
                    echo '</div>';
                echo '</div>';

            }

            echo $args['after_widget'];
        }
            
        // Widget Backend 
        public function form( $instance ) {

            //sets defaults
            if ( isset( $instance[ 'title' ] ) ) {
                $title = $instance[ 'title' ];
            }
            else {
                $title = __( 'New title', 'ideapush' );
            }

            // Widget admin form
            $html = '';

                $html .= '<p>';
                    $html .= '<label for="'.$this->get_field_id( 'title' ).'">'.__('Title:','ideapush').'</label>';
                    $html .= '<input class="widefat" id="'.$this->get_field_id( 'title' ).'" name="'.$this->get_field_name( 'title' ).'" type="text" value="'.esc_attr( $title ).'" />';
                $html .= '</p>';

                $html .= '<p>';
                    $html .= '<label for="'.$this->get_field_id( 'board' ).'">'.__('Board:','ideapush').'</label>';
                    $html .= '<select class="widefat" id="'.$this->get_field_id( 'board' ).'" name="'.$this->get_field_name( 'board' ).'">';
                        //get boards
                        $all_boards = get_terms('boards',array('hide_empty' => false));

                        // var_dump($all_boards);

                        foreach ($all_boards as $board_item) {

                            $board_name = $board_item->name;
                            $board_id = $board_item->term_id;

                            if($instance[ 'board' ] == $board_id){
                                $html .= '<option value="'.$board_id.'" selected="selected">'.$board_name.'</option>';
                            } else {
                                $html .= '<option value="'.$board_id.'">'.$board_name.'</option>';    
                            }
                                
                        }    

                    $html .= '</select>';
                $html .= '</p>';

            echo $html;

        }
        
        // Updating widget replacing old instances with new
        public function update( $new_instance, $old_instance ) {

            $instance = array();
            $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
            $instance['board'] = ( ! empty( $new_instance['board'] ) ) ? strip_tags( $new_instance['board'] ) : '';
            return $instance;
        }

    } // Class wpb_widget ends here


?>