<?php 

/**
 * 
 * itou_on_group_screen_view
 * add action to override redirection to subgroups when a group "home" is reached
 * @return void
 */
function itou_on_group_screen_view() {
  //bp_core_redirect( bp_get_group_permalink( groups_get_current_group() ) . 'subgroups/' );
}

/**
 * 
 * itou_get_group_from_area
 * match group from a search term (e.g. xprofile_get_field_data('Région', $user_id))
 * @return array List of matching groups
 */
function itou_get_group_from_area($area_name) {
  $matches = groups_get_groups([
    "search_terms" => $area_name,
  ]);
  return $matches['groups'];
}
/**
 * Hooks to handle groups
 */
add_action( 'groups_screen_group_members', 'itou_on_group_screen_view', 20);