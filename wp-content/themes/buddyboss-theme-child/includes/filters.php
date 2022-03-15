<?php 

// Remove bb_core_remove_unfiltered_html that Buddyboss added on group description
remove_filter( 'bp_get_group_description', 'bb_core_remove_unfiltered_html', 99 );

// function itou_bp_nouveau_customizer_controls($array) {
//   var_dump($array);
//   die();
// }

// add_filter('bp_nouveau_customizer_controls', 'itou_bp_nouveau_customizer_controls', 20);