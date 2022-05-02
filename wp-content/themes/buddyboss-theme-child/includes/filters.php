<?php 


/**
 * Affords an opportunity to modify the event link (typically for the next or previous
 * event in relation to $post).
 *
 * @var string  $link
 * @var WP_Post $post
 * @var string  $mode (typically "previous" or "next")
 * @var string  $anchor
*/
function itou_filter_prev_next_links($link, $post, $mode, $anchor) {
  var_dump($link);
  $link = str_replace('Previous Event', __('Évèvenement précédent'), $link);
  $link = str_replace('Next Event', __('Évèvenement suivant'), $link);
  return $link;
}

add_filter('tribe_events_get_event_link', 'itou_filter_prev_next_links', 20, 4);

// Remove bb_core_remove_unfiltered_html that Buddyboss added on group description
remove_filter( 'bp_get_group_description', 'bb_core_remove_unfiltered_html', 99 );
remove_filter( 'groups_group_description_before_save', 'bb_core_remove_unfiltered_html', 99 );

remove_action( 'bbp_new_topic', 'bbp_notify_forum_subscribers', 11);
