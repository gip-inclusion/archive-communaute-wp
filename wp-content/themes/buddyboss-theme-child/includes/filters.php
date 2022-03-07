<?php 

// Remove bb_core_remove_unfiltered_html that Buddyboss added on group description
remove_filter( 'bp_get_group_description', 'bb_core_remove_unfiltered_html', 99 );
