<?php 

/**
 * 
 * itou_on_group_screen_view
 * add action to override redirection to subgroups when a group "home" is reached
 * @return void
 */
function itou_on_group_screen_view($location) {  
  if(bp_current_action() === 'members') { // BP tries to redirect to the members tab
    $current_group = groups_get_current_group();
    $descendant_groups = bp_get_descendent_groups($current_group->id);
    if (count( $descendant_groups)) {
      $location = bp_get_group_permalink( groups_get_current_group() ) . 'subgroups';
    }    
  }
  return $location;
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
add_filter( 'wp_redirect', 'itou_on_group_screen_view', 20);