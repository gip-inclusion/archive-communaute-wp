<?php 

/**
 * 
 * itou_on_group_screen_view
 * add action to override redirection to subgroups when a group "home" is reached
 * @return void
 */
function itou_on_group_screen_view() {
  bp_core_redirect( bp_get_group_permalink( groups_get_current_group() ) . 'subgroups/' );
}

/**
 * Hooks to handle groups
 */
add_action( 'groups_screen_group_members', 'itou_on_group_screen_view', 20);