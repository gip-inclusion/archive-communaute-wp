<?php 

// Remove bb_core_remove_unfiltered_html that Buddyboss added on group description
remove_filter( 'bp_get_group_description', 'bb_core_remove_unfiltered_html', 99 );
remove_filter( 'groups_group_description_before_save', 'bb_core_remove_unfiltered_html', 99 );

remove_action( 'bbp_new_topic', 'bbp_notify_forum_subscribers', 11);
