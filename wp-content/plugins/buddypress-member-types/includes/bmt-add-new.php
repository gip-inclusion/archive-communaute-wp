<?php

/**
 * Helper class for Edit Member Type screen
 *
 */
class BP_Member_Type_Add_New_Screen_Helper {

	private static $instance = null;
	private $post_type = '';

	private function __construct() {

		$this->post_type = bmt_get_post_type();

		$this->init();
	}

	/**
	 *
	 * @return BP_Member_Type_Generator_Admin_Edit_Screen_Helper
	 */
	public static function get_instance() {

		if ( is_null( self::$instance ) ) {

			self::$instance = new self();
		}

		return self::$instance;
	}

	private function init() {
		//save post
		add_action( 'save_post', array( $this, 'save_post' ) );

		//delete post
		add_action( 'before_delete_post', array( $this, 'delete_member_type' ) );

		add_action( 'add_meta_boxes', array( $this, 'register_metabox' ) );
		add_filter( 'post_updated_messages', array( $this, 'filter_update_messages' ) );
	}

	/**
	 * Register meta boxes
	 */
	public function register_metabox() {

		add_meta_box( 'bp-member-type-key', __( 'Member Type Key', 'bp-member-types' ), array( $this, 'bp_member_type_key_metabox' ), $this->post_type );
        add_meta_box( 'bp-member-type-label-box', __( 'Labels', 'bp-member-types' ), array( $this, 'bp_member_type_labels_metabox' ), $this->post_type );
        add_meta_box( 'bp-member-type-visibility', __( 'Visibility', 'bp-member-types' ), array( $this, 'bp_member_type_visibility_metabox' ), $this->post_type );
        add_meta_box( 'bp-member-type-shortcode', __( 'Shortcode', 'bp-member-types' ), array( $this, 'bp_member_type_shortcode_metabox' ), $this->post_type );
        add_meta_box( 'bp-member-type-wp-role', __( 'WordPress Roles', 'bp-member-types' ), array( $this, 'bp_member_type_wprole_metabox' ), $this->post_type );
	}

	/**
	 * Generate Member Type Key Meta box
	 *
	 * @param type $post
	 */
	public function bp_member_type_key_metabox( $post ) {

		$key = get_post_meta($post->ID, '_bp_member_type_key', true );
		?>
		<p>
			<input type="text" name="bp-member-type[member_type_key]" value="<?php echo $key; ?>" placeholder="e.g. students" />
		</p>
		<p><?php _e( 'Member Type Keys are used as internal identifiers. Lowercase alphanumeric characters, dashes and underscores are allowed', 'bp-member-types' ); ?></p>
		<?php
	}

	/**
	 * Generate Member Type Label Meta box
	 *
	 * @param type $post
	 */
	public function bp_member_type_labels_metabox( $post ) {

		$meta = get_post_custom( $post->ID );

		$label_name = isset( $meta[ '_bp_member_type_label_name' ] ) ? $meta[ '_bp_member_type_label_name' ][ 0 ] : '';
		$label_singular_name = isset( $meta[ '_bp_member_type_label_singular_name' ] ) ? $meta[ '_bp_member_type_label_singular_name' ][ 0 ] : '';
		?>
		<table style="width: 100%;">
			<tr valign="top">
				<th scope="row" style="text-align: left; width: 15%;"><label for="bp-member-type[label_name]"><?php _e( 'Plural Label', 'bp-member-types' ); ?></label></th>
				<td>
					<input type="text" class="bmt-label-name" name="bp-member-type[label_name]" placeholder="<?php _e( 'e.g. Students', 'bp-member-types' ); ?>"  value="<?php echo esc_attr( $label_name ); ?>" tabindex="2" style="width: 100%;" />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row" style="text-align: left; width: 15%;"><label for="bp-member-type[label_singular_name]"><?php _e( 'Singular Label', 'bp-member-types' ); ?></label></th>
				<td>
					<input type="text" class="bmt-singular-name" name="bp-member-type[label_singular_name]" placeholder="<?php _e( 'e.g. Student', 'bp-member-types' ); ?>" value="<?php echo esc_attr( $label_singular_name ); ?>" tabindex="3" style="width: 100%;" />
				</td>
			</tr>
		</table>
		<?php wp_nonce_field( 'buddyboss-bmt-edit-member-type', '_buddyboss-bmt-nonce' ); ?>
		<?php
	}

	/**
	 * Generate Member Type Directory Meta box
	 *
	 * @param type $post
	 */
	public function bp_member_type_visibility_metabox( $post ) {

		$meta = get_post_custom( $post->ID );
		$enable_registration = isset( $meta[ '_bp_member_type_enable_registration' ] ) ? $meta[ '_bp_member_type_enable_registration' ][ 0 ] : 0; //disabled by default
                $options_url = admin_url().'edit.php?post_type=bmt-member-type&page=bmt-member-type';
		?>
		<p>
                    <input type='checkbox' name='bp-member-type[enable_registration]' value='1' <?php checked( $enable_registration, 1 ); ?> tabindex="4" />
                    <strong><?php _e( 'Display in <a href="'.$options_url.'">Registration Form</a>', 'bp-member-types' ); ?></strong>
		</p>
		<?php
		$enable_directory = isset( $meta[ '_bp_member_type_enable_directory' ] ) ? $meta[ '_bp_member_type_enable_directory' ][ 0 ] : 1; //enabled by default
		?>
		<p>
                    <input type='checkbox' name='bp-member-type[enable_directory]' value='1' <?php checked( $enable_directory, 1 ); ?> tabindex="5" />
                    <strong><?php _e( 'Display tab in Members Directory', 'bp-member-types' ); ?></strong>
		</p>
		<?php
		$enable_remove = isset( $meta[ '_bp_member_type_enable_remove' ] ) ? $meta[ '_bp_member_type_enable_remove' ][ 0 ] : 0; //enabled by default
        ?>
        <p>
            <input type='checkbox' name='bp-member-type[enable_remove]' value='1' <?php checked( $enable_remove, 1 ); ?> tabindex="6" />
            <strong><?php _e( 'Hide completely from Members Directory', 'bp-member-types' ); ?></strong>
        </p>
		<?php
	}


	/**
	 * Shortcode metabox for the Member types admin edit screen.
	 *
	 * @param type $post
	 */
	public function bp_member_type_shortcode_metabox( $post ) {

		$key = bmt_get_member_type_key( $post->ID );

		?>
		<p class="member-type-shortcode-wrapper">
			<!-- Target -->
			<input id='member-type-shortcode' value='<?php echo '[members type="'. $key .'"]' ?>' style="width: 85%;">

			<button class="copy-to-clipboard button"  data-clipboard-target="#member-type-shortcode" style="width: 14%;">
				<?php _e('Copy to clipboard', 'bp-member-types' ) ?>
			</button>
		</p>
		<p><?php printf( __( 'To display all members of the %s type on a dedicated page, add the above shortcode to any WordPress page', 'bp-member-types' ), $post->post_title )?></p>

		<?php
	}

    /**
     * Generate Member Type WP Role Meta box
     *
     * @param type $post
     */
    public function bp_member_type_wprole_metabox( $post ) {

        global $wp_roles;
		$tabindex = 7;
        $all_roles = $wp_roles->role_names;

        //remove bbPress roles
        unset($all_roles['bbp_keymaster']);
        unset($all_roles['bbp_spectator']);
        unset($all_roles['bbp_blocked']);
        unset($all_roles['bbp_moderator']);
        unset($all_roles['bbp_participant']);

        $selected_roles = get_post_meta($post->ID, '_bp_member_type_wp_roles', true);
        $selected_roles = (array) $selected_roles;
        ?>

        <p><?php _e( 'Choose WP roles to be auto-assigned to this member type (includes existing users).', 'bp-member-types' ); ?></p>
		<p>
			<label for="bp-member-type-roles-none">
				<input
						type='radio'
						name='bp-member-type[wp_roles][]'
						id="bp-member-type-roles-none"
						value='' <?php echo empty( $selected_roles[0] ) ? 'checked' : '';
						?> />
				<?php _e( 'None', 'bp-member-types' ) ?>
			</label>
		</p>
        <?php
        if( isset($all_roles) && !empty($all_roles) ){
            foreach($all_roles as $key => $val){
                $role_member_type = bmt_get_member_type_by_wp_role($key);
                $disabled = '';
                $disabled_style = '';
                $disable_message = '';
                if( isset($role_member_type) && !empty($role_member_type) && $post->ID != $role_member_type[0]['ID'] ){
                    $disabled = 'disabled readonly';
                    $disabled_style = 'style="color:#bbb"';
                    $disable_message = ' (Already assigned to "'.$role_member_type[0]['nice_name'].'" member type)';
                }
        ?>
            <p <?php echo $disabled_style;?>>
				<label for="bp-member-type-wp-roles-<?php echo $key ?>">
					<input
							type='radio'
							name='bp-member-type[wp_roles][]' <?php echo $disabled; ?>
							id="bp-member-type-wp-roles-<?php echo $key ?>"
							value='<?php echo $key;?>' <?php echo in_array($key, $selected_roles) ? 'checked' : ''; ?>
							tabindex="<?php echo ++$tabindex ?>"
					/>
					<?php echo $val.$disable_message; ?>
				</label>
            </p>

            <?php
            }
        }
    }

	/**
	 * Save all data as post meta
	 *
	 * @param type $post_id
	 * @return type
	 */
	public function save_post( $post_id ) {

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return;

		$post = get_post( $post_id );

		if ( $post->post_type != $this->post_type )
			return;

		if ( ! isset( $_POST[ '_buddyboss-bmt-nonce' ] ) )
			return;

		//verify nonce
		if ( ! wp_verify_nonce( $_POST[ '_buddyboss-bmt-nonce' ], 'buddyboss-bmt-edit-member-type' ) )
			return;

		//Save data
		$data = isset( $_POST[ 'bp-member-type' ] ) ? $_POST[ 'bp-member-type' ] : array();

		if ( empty( $data ) )
			return;

		$post_title = wp_kses( $_POST[ 'post_title' ], wp_kses_allowed_html( 'strip' ) );

		// key
		$key = isset( $data['member_type_key'] ) ? sanitize_key( $data['member_type_key'] )  : '';

		//for label
		$label_name = isset( $data[ 'label_name' ] ) ? wp_kses( $data[ 'label_name' ], wp_kses_allowed_html( 'strip' ) ) : $post_title;
		$singular_name = isset( $data[ 'label_singular_name' ] ) ? wp_kses( $data[ 'label_singular_name' ], wp_kses_allowed_html( 'strip' ) ) : $post_title;

		//Remove space
		$label_name     = trim( $label_name );
		$singular_name  = trim( $singular_name );

        $enable_directory = isset( $data[ 'enable_directory' ] ) ? absint( $data[ 'enable_directory' ] ) : 0; //default inactive
        $enable_remove = isset( $data[ 'enable_remove' ] ) ? absint( $data[ 'enable_remove' ] ) : 0; //default inactive
		$enable_registration = isset( $data[ 'enable_registration' ] ) ? absint( $data[ 'enable_registration' ] ) : 0; //default inactive

		$data[ 'wp_roles' ] = array_filter( $data[ 'wp_roles' ] ); // Remove empty value from wp_roles array
        $wp_roles = isset( $data[ 'wp_roles' ] ) ? $data[ 'wp_roles' ] : '';

        update_post_meta( $post_id, '_bp_member_type_key', $key );

		update_post_meta( $post_id, '_bp_member_type_label_name', $label_name );
		update_post_meta( $post_id, '_bp_member_type_label_singular_name', $singular_name );

        update_post_meta( $post_id, '_bp_member_type_enable_directory', $enable_directory );
        update_post_meta( $post_id, '_bp_member_type_enable_remove', $enable_remove );
        update_post_meta( $post_id, '_bp_member_type_enable_registration', $enable_registration );

        $old_wp_roles = get_post_meta( $post_id, '_bp_member_type_wp_roles', true );
        update_post_meta( $post_id, '_bp_member_type_wp_roles', $wp_roles );

        //set this member type to users with these roles
        $key = bmt_get_member_type_key( $post_id );

        if( isset( $key ) && ! empty( $key ) ){

            if ( ! empty( $old_wp_roles ) ) {
                bmt_remove_member_type_to_roles( $old_wp_roles, $key );
            }
            if ( ! empty( $wp_roles ) ){
                bmt_set_member_type_to_roles( $wp_roles, $key );
            }
        }
	}

	public function filter_update_messages( $messages ) {

		$update_message = $messages[ 'post' ];

		$update_message[ 1 ] = sprintf( __( 'Member type updated.', 'bp-member-types' ) );

		$update_message[ 4 ] = __( 'Member type updated.', 'bp-member-types' );

		$update_message[ 6 ] = sprintf( __( 'Member type published. ', 'bp-member-types' ) );

		$update_message[ 7 ] = __( 'Member type  saved.', 'bp-member-types' );

		$messages[ $this->post_type ] = $update_message;

		return $messages;
	}

	/**
	 * Remove member type from users, when the Member Type is deleted
	 * @param $post_id
	 */
	public function delete_member_type( $post_id ) {
		global $wpdb;

		$post = get_post( $post_id );

		//Return if post is not 'bmt-member-type' type
		if ( 'bmt-member-type' != $post->post_type ) return;

		$member_type_name 	= bmt_get_member_type_key( $post_id );
		$type_term 			= get_term_by( 'name', $member_type_name, 'bp_member_type' ); // Get member type term data from database by name field.

		//term exist
		if ( $type_term ) {

			//Removes a member type term from the database.
			wp_delete_term( $type_term->term_id, 'bp_member_type' );

			//Removes a member type term relation with users from the database.
			$wpdb->delete( $wpdb->term_relationships, array( 'term_taxonomy_id' => $type_term->term_taxonomy_id ) );
		}
	}

}

BP_Member_Type_Add_New_Screen_Helper::get_instance();
