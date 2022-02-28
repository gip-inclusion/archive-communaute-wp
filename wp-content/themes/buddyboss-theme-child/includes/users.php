<?php

function itou_on_user_registration($user_id) {
  $type = bp_get_member_type($user_id, true);
  if($type === 'membre') {    
    $user = new WP_User($user_id);
    $user->add_role(get_option('default_role'));
  }
}
add_action( 'user_register', 'itou_on_user_registration', 20, 1 );
add_action( 'bp_core_activated_user', 'itou_on_user_registration', 20, 1 );
add_action( 'save_post', 'itou_on_user_registration', 20, 1 );
add_action( 'bp_core_signup_user', 'itou_on_user_registration', 20, 1 );