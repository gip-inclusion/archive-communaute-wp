<?php

/**
 * Helper class to register the internal member type post type and the actual Member type
 *
 */
class BP_Member_Type_Actions {

	private static $instance = null;

	private function __construct() {

		//register internal post type used to handle the member type
		add_action( 'init', array( $this, 'register_post_type' ) );

		add_action( 'admin_menu', array( $this, 'add_import_menu' ) );
		add_action( 'admin_menu', array( $this, 'add_help_menu' ),11 );

		//register member type
		add_action( 'bp_register_member_types', array( $this, 'register_member_type' ) );

		add_action( 'bp_signup_validate', array( $this, 'bmt_validate_member_type_field' ) );
		add_action( 'bp_core_signup_user', array( $this, 'bmt_member_type_on_registration' ), 10, 5 );
		add_action( 'bp_core_activated_user', array( $this, 'bmt_member_type_on_registration_multisite' ), 10, 3 );

		add_filter( 'bp_signup_usermeta', array( $this, 'bmt_alter_usermeta' ) );

		//Assign role from member type
		add_action( 'bp_set_member_type',array( $this, 'bmt_assign_wprole' ),10 ,3 );

		// add setting link
		$buddyboss = BuddyBoss_BMT_Plugin::instance();
		$plugin = $buddyboss->basename;
		add_filter("plugin_action_links_$plugin", array($this, 'plugin_settings_link'));

		add_action("admin_enqueue_scripts", array($this, 'changing_listing_label'));

		// Front End Assets
		if ( ! is_admin() && ! is_network_admin() )  {
			add_action( 'wp_enqueue_scripts', array( $this, 'assets' ) );
		}


		// remove users of a specific member type from members directory
		add_action( 'bp_ajax_querystring', array($this, 'exclude_users_from_directory_and_searches'), 999, 2 );
		// set member type while update user profile
		add_action( 'set_user_role', array($this, 'update_user_member_type_set'), 10, 2 );

		// fix all member count
		add_filter( 'bp_core_get_active_member_count', array($this, 'fixed_all_member_count'), 999 );

		add_filter( 'bp_before_has_profile_parse_args', array( $this, 'show_all_fields' ), 10 , 1 );
	}

    function fixed_all_member_count($count){
        $exclude_user_ids = bmt_get_users_of_removed_member_types();
        if( isset($exclude_user_ids) && !empty($exclude_user_ids) ){
            $count = $count - count($exclude_user_ids);
        }
        return $count;
    }

    function update_user_member_type_set( $user_id, $user_role ) {

        $get_member_type = bmt_get_member_type_by_wp_role($user_role);

        if( isset($get_member_type[0]['name']) && !empty($get_member_type[0]['name']) ){
            bp_set_member_type($user_id, $get_member_type[0]['name']);
        }
    }

    public static function get_instance() {

		if ( is_null( self::$instance ) )
			self::$instance = new self();

		return self::$instance;
	}

	/**
	 * Register internal post type
	 *
	 * @return type
	 */
	public function register_post_type() {

		register_post_type( bmt_get_post_type(), array(
			'label' 	=> __( 'BuddyPress Member Types', 'bp-member-types' ),
			'labels' 	=> array(
				'name'                          => __( 'BuddyPress Member Types', 'bp-member-types' ),
				'singular_name' 		=> __( 'Member Type', 'bp-member-types' ),
				'menu_name'       		=> __( 'Member Types', 'bp-member-types' ),
				'all_items'       		=> __( 'All Member Types', 'bp-member-types' ),
				'add_new_item'  		=> __( 'New Member Type', 'bp-member-types' ),
				'new_item'                      => __( 'New Member Type', 'bp-member-types' ),
				'edit_item' 			=> __( 'Edit Member Type', 'bp-member-types' ),
				'search_items' 			=> __( 'Search Member Types', 'bp-member-types' ),
				'not_found_in_trash'            => __( 'No Member Types found in trash', 'bp-member-types' ),
				'not_found' 			=> __( 'No Member Types found', 'bp-member-types' )
			),
			'public' 			=> false, //this is a private post type, not accesible from front end
			'show_ui' 			=> true,
			'show_in_menu' 		=> true,
			'menu_position'		=> 24,
			'menu_icon' 		=> 'dashicons-groups',
			'map_meta_cap' 		=> true,
			'capability_type' 	=> bmt_get_post_type(),
			'supports'			=> array( 'editor', 'title', 'page-attributes' ),
			'show_in_rest' 		=> true,
		) );
	}
	/**
	 * Calling Support menu
	 */
	public function add_help_menu() {
		add_submenu_page('edit.php?post_type=bmt-member-type', __('Support','bp-member-types'), __('Support','bp-member-types'), 'manage_options', 'support', 'bmt_support_text' );
	}

	/**
	 * Calling Import menu
	 */
	public function add_import_menu() {
		add_submenu_page('edit.php?post_type=bmt-member-type', __('Import','bp-member-types'), __('Import','bp-member-types'), 'manage_options', 'import', 'bmt_import_func' );
	}

	/**
	 * Register all active member types
	 *
	 */
	public function register_member_type() {

		//Give Multisite support

		//$this->register_post_type();
		//$is_root_blog = bp_is_root_blog();
		//if we are not on the main bp site, switch to it before registering member type

		//if ( ! $is_root_blog ) {
		//	switch_to_blog( bp_get_root_blog_id() );
		//}
		//get all posts in memeber type post type

		$post_ids = bmt_get_active_member_types();

		//update meta cache to avoid multiple db calls
		update_meta_cache( 'post', $post_ids );
		//build to register the memebr type
		$member_types = array();

		foreach ( $post_ids as $post_id ) {

			$key = bmt_get_member_type_key( $post_id );

			$enable_directory = get_post_meta( $post_id, '_bp_member_type_enable_directory', true );

			$has_dir = false;

			if ( $enable_directory ) {
				$has_dir = true;
			}

			$member_types[ $key ] = array(
				'labels' => array(
					'name' => get_post_meta( $post_id, '_bp_member_type_label_name', true ),
					'singular_name' => get_post_meta( $post_id, '_bp_member_type_label_singular_name', true ),
				),
				'has_directory' => $has_dir
			);
		}

		foreach ( $member_types as $member_type => $args ) {
			bp_register_member_type( $member_type, $args );
		}

//		if ( ! $is_root_blog ) {
//			restore_current_blog();
//		}
	}

	/**
	 * Validation of a member type field.
	 */
	public function bmt_validate_member_type_field() {
		global $bp;

		$is_registration_required_field = buddyboss_bmt()->option('registration_required_field');

		if ( ! empty( $is_registration_required_field )
		     && isset( $_REQUEST['bmt_member_type'] )
		     &&  empty( $_REQUEST['bmt_member_type'] )
		) {
			$bp->signup->errors['field_bmt_member_type'] = __( 'Please make sure you have selected member type', 'bp-member-types' );
		}
	}

	/**
	 * Update Member type on single site
	 *
	 * @param type $user_id
	 * @param type $user_login
	 * @param type $user_password
	 * @param type $user_email
	 * @param type $usermeta
	 */
	public function bmt_member_type_on_registration( $user_id, $user_login, $user_password, $user_email, $usermeta ) {

		//Set default member type if user has not selected any
		$bmt_member_type = is_array( $usermeta ) && ! empty ( $usermeta['bmt_member_type'] ) ? $usermeta['bmt_member_type'] : buddyboss_bmt()->option('default_member_type');

		if ( ! empty( $bmt_member_type ) ) {

			if ( !empty($user_id ) ) { //for multisite $user_id is empty
				bp_set_member_type($user_id, $bmt_member_type );
			}
		}
	}

	/**
	 * Update member type on multisite
	 *
	 * @param type $user_id
	 * @param type $key
	 * @param type $user
	 */
	public function bmt_member_type_on_registration_multisite( $user_id, $key, $user ) {

		//Set default member type if user has not selected any
		$bmt_member_type = is_array( $user ) && ! empty ( $user['meta']['bmt_member_type'] ) ? $user['meta']['bmt_member_type'] : buddyboss_bmt()->option('default_member_type');

		if ( ! empty( $bmt_member_type ) ) {

			if ( ! empty( $user_id ) ) {
				bp_set_member_type( $user_id, $bmt_member_type );
			}
		}
	}

	/**
	 * Add member type in $usermeta array
	 *
	 * @param type $usermeta
	 * @return type array
	 */
	public function bmt_alter_usermeta($usermeta) {

		//Set default member type if user has not selected any member type
		$bmt_member_type = ! empty ( $_POST['bmt_member_type'] ) ? $_POST['bmt_member_type'] : buddyboss_bmt()->option('default_member_type');

		if ( !empty( $bmt_member_type ) ) {
			$usermeta['bmt_member_type'] = $bmt_member_type;
		}

		return apply_filters( 'bmt_alter_usermeta', $usermeta );

	}

	/**
	 * Assign role from member type on Registration
	 * @param $user_id
	 * @param $member_type
	 * @param $append
	 */
	public function bmt_assign_wprole($user_id, $member_type, $append) {

		$req_post = bmt_member_post_by_type($member_type);

		if ( !isset($req_post) && !empty($req_post) ) {
			return;
		}

		$selected_roles = get_post_meta( $req_post, '_bp_member_type_wp_roles', true );

		if (is_array($selected_roles) && isset($selected_roles) ) {

            // set member type while update user profile
            remove_action( 'set_user_role', array($this, 'update_user_member_type_set'), 10, 2 );

			$user = new WP_User( $user_id );

			foreach ($selected_roles as $role) {
				if ( in_array( $role, $user->roles ) ) continue;
				$user->set_role($role);
			}
		}
	}

	/**
	 * Add settings link on plugin page
	 * @param type $links
	 */
	function plugin_settings_link($links) {
            $links[] = '<a href="'.admin_url("edit.php?post_type=bmt-member-type").'">'.__("Manage","bp-member-types").'</a>';
            return $links;
	}

	function changing_listing_label() {
		global $pagenow, $current_screen;

		$bmt_pages = array(
			'edit-bmt-member-type',
			'bmt-member-type'
		);

		// Check to make sure we're on a Member Type's admin page
		if ( isset( $current_screen->id ) && in_array( $current_screen->id, $bmt_pages ) ) {

			wp_enqueue_script('bmt-clipboard',buddyboss_bmt()->assets_url."/js/clipboard/clipboard.min.js",array(), '1.6.1' );
			wp_enqueue_script('bmt-admin-screen',buddyboss_bmt()->assets_url."/js/bmt-admin-screen.min.js",array('jquery'), BUDDYBOSS_BMT_PLUGIN_VERSION );

			$strings = array(
				'warnTrash' 		=> __( 'You have {total_users} members with this member type, are you sure you would like to trash it?', 'bp-member-types' ),
				'warnDelete' 		=> __( 'You have {total_users} members with this member type, are you sure you would like to delete it?', 'bp-member-types' ),
				'warnBulkTrash' 	=> __( 'You have members with these member types, are you sure you would like to trash it?', 'bp-member-types' ),
				'warnBulkDelete'	=> __( 'You have members with these member types, are you sure you would like to delete it?', 'bp-member-types' ),
				'copied'			=> __( 'Copied', 'bp-member-types' ),
				'copytoclipboard'	=> __( 'Copy to clipboard', 'bp-member-types' ),
			);

			wp_localize_script( 'bmt-admin-screen', '_bmtAdminL10n', $strings );
		}
	}

	/**
	 * Load CSS/JS
	 * @return void
	 */
	public function assets() {
		global $wpdb, $bp;

		wp_enqueue_script('buddypress-member-types',buddyboss_bmt()->assets_url."/js/buddypress-member-types.min.js",array('jquery'), BUDDYBOSS_BMT_PLUGIN_VERSION );

		if ( ! is_user_logged_in() ) {

			$m_fields 	= array();
			$m_holder 	= array(0);

			//Fetch all members types
			$m_types_singular_label = $wpdb->get_col("SELECT meta_value FROM {$wpdb->postmeta} WHERE meta_key = '_bp_member_type_label_singular_name'");

			//Also append null and _none type
			$m_types_singular_label = array_merge( $m_types_singular_label, array( 'null', '_none' ) );

			/****** Get fields for each member types *****************/
			foreach ( $m_types_singular_label as $type_name ) {

				$type_name = strtolower($type_name);
				$type_name = str_replace(array(' ', ','), array('-', '-'), $type_name );

				$result = $wpdb->get_col("SELECT DISTINCT object_id FROM {$bp->profile->table_name_meta} WHERE object_type = 'field'
 				AND meta_value = '{$type_name}' AND meta_key = 'member_type' ");

				if ( is_array( $result) && ! empty( $result ) ) {

					$m_fields[$type_name] 	= array_map( 'intval', $result );
					$m_holder 				= array_merge( $m_holder, $result );
				}
			}

			$m_not_in = implode( ',', $m_holder );

			/****** Get fields accessible for all members *****************/
			//Fields visible to the all users
			$result = $m_fields['all'] = $wpdb->get_col( "SELECT id FROM {$bp->profile->table_name_fields} WHERE id NOT IN ({$m_not_in}) 
			AND group_id = 1 AND parent_id = 0" );

			if ( is_array( $result) && ! empty( $result ) ) {
				$m_fields['all'] 	= array_map( 'intval', $result );;
			}

			wp_localize_script( 'buddypress-member-types', 'membersFields', $m_fields );
		}
	}

	/**
	 * Show all fields on register page
	 * @param $args
	 * @return mixed
	 */
	public function show_all_fields( $args ) {

		// Buddypress by default does not shows all fields, those fields which
		// has members type assigned/bound to them, so we need to set member_type = false to get
		// all fields on register page

		if ( ! is_user_logged_in() )
			$args['member_type'] = false;

		return $args;
	}

    public function exclude_users_from_directory_and_searches( $qs=false, $object=false ){

        $exclude_user_ids = bmt_get_users_of_removed_member_types();

        if( $object != 'members' )
            return $qs;

        $args = wp_parse_args( $qs );

        if( ! empty( $args['user_id'] ) )
            return $qs;

        if ( ! empty( $exclude_user_ids ) ) {
	        if ( ! empty( $args['exclude'] ) ) {
		        $args['exclude'] = $args['exclude'] . ',' . implode( ',', $exclude_user_ids );
	        } else {
		        $args['exclude'] = implode( ',', $exclude_user_ids );
	        }

	        $qs = build_query( $args );
        }

        return $qs;

    }

}

BP_Member_Type_Actions::get_instance();