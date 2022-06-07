<?php
/**
 * Plugin Name: Export Users Data
 * Description: This Plugin allows you to export users data and metadata into CSV, Excel, XML file format.
 * Author: Kaushik Kalathiya
 * Author URI: https://kaushikkalathiya.github.io/kaushik/
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Version: 2.1
 * Tested up to: 6.0
 * Requires at least: 4.1
 * Requires PHP: 5.6.20
 * Text Domain: exportuser
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) { die; }

// Add setting link into plugin listing page
add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'eudc_settings_page_link');
function eudc_settings_page_link($links){
	$links[] = '<a href="'.admin_url('users.php').'">'.__('Export Users').'</a>';
	return $links;
}

// Add Button into admin side user list
add_action('admin_footer', 'eudc_export_users');
function eudc_export_users() {
	$screen = get_current_screen();
	// Only add to users.php page
	if ( $screen->id != "users" )
		return;
?>
	<script type="text/javascript">
		jQuery(document).ready( function($) {

			jQuery('.tablenav.top .clear, .tablenav.bottom .clear').before('<form name="eud_form" action="#" method="POST">'+
				'<select name="edu_select">'+
					'<option value="eud_csv">Export as CSV</option>'+
					'<option value="eud_excel">Export as Excel</option>'+
					'<option value="eud_xml">Export as XML</option>'+
				'</select> '+
				'<input type="submit" class="button" name="eud_btn" value="Export">'+
			'</form>');
		});
	</script>
<?php
}

//you can use admin_init as well
add_action('admin_init', 'export_csv');
function export_csv() {
	if (current_user_can('manage_options')) {

		$args = array (
			'order' => 'ASC',
			'orderby' => 'display_name',
			'fields' => 'all',
		);
		$wp_users = get_users( $args );

		if( !empty($_POST['eud_btn']) && isset($_POST['eud_btn']) ){

			// Code for CSV
			if ( !empty($_POST['edu_select']) && $_POST['edu_select'] == 'eud_csv' ) {
				header("Content-type: application/force-download");
				header('Content-Disposition: inline; filename="users_'.date('Y_m_d_H_i_s').'.csv"');

				echo '" User ID "," User Name "," First Name "," Last Name "," Email ID "," Nick Name "," User Role "," Registered Date "' . "\r\n";
				foreach ( $wp_users as $user ) {
					$user_id = $user->ID;
					$user_name = $user->user_login;
					$reg_date = $user->user_registered;
					$meta = get_user_meta($user_id);
					$role = $user->roles;
					$email = $user->user_email;

					$first_name = ( isset($meta['first_name'][0]) && $meta['first_name'][0] != '' ) ? $meta['first_name'][0] : '' ;
					$last_name  = ( isset($meta['last_name'][0]) && $meta['last_name'][0] != '' ) ? $meta['last_name'][0] : '' ;
					$nickname = ( isset($meta['nickname'][0]) && $meta['nickname'][0] != '' ) ? $meta['nickname'][0] : '' ;

					echo '"'.$user_id.'","'.$user_name.'","'.$first_name.'","'.$last_name.'","'.$email.'","'.$nickname.'","'.ucfirst($role[0]).'","'.$reg_date.'"'."\r\n";
				}
				exit();
			}

			// Code for Excel
			if ( !empty($_POST['edu_select']) && $_POST['edu_select'] == 'eud_excel' ) {
				header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
				header('Content-Disposition: attachment;filename="users_'.date('Y_m_d_H_i_s').'.xlsx');

				_e('" User_ID " " User_Name " " First_Name " " Last_Name " " Email_ID " " Nick_Name " " User_Role " " Registered_Date "' . "\r\n");
				foreach ( $wp_users as $user ) {
					$user_id = $user->ID;
					$user_name = $user->user_login;
					$reg_date = $user->user_registered;
					$meta = get_user_meta($user_id);
					$role = $user->roles;
					$email = $user->user_email;

					$first_name = ( isset($meta['first_name'][0]) && $meta['first_name'][0] != '' ) ? $meta['first_name'][0] : 'NULL' ;
					$last_name  = ( isset($meta['last_name'][0]) && $meta['last_name'][0] != '' ) ? $meta['last_name'][0] : 'NULL' ;
					$nickname = ( isset($meta['nickname'][0]) && $meta['nickname'][0] != '' ) ? $meta['nickname'][0] : 'NULL' ;

					_e('" '.$user_id.' " " '.$user_name.' " " '.$first_name.' " " '.$last_name.' " " '.$email.'" "'.$nickname.'" "'.ucfirst($role[0]).'" " '.$reg_date.' " '."\r\n");
				}
				exit();
			}

			// Code for XML
			if ( !empty($_POST['edu_select']) && $_POST['edu_select'] == 'eud_xml' ) {
				header("Content-type: text/xml");
				header('Content-Disposition: attachment; filename="users_'.date('Y_m_d_H_i_s').'.xml');

				_e('<users>');			
				foreach ( $wp_users as $user ) {
					$user_id = $user->ID;
					$user_name = $user->user_login;
					$reg_date = $user->user_registered;
					$meta = get_user_meta($user_id);
					$role = $user->roles;
					$email = $user->user_email;

					$first_name = ( isset($meta['first_name'][0]) && $meta['first_name'][0] != '' ) ? $meta['first_name'][0] : 'NULL' ;
					$last_name  = ( isset($meta['last_name'][0]) && $meta['last_name'][0] != '' ) ? $meta['last_name'][0] : 'NULL' ;
					$nickname = ( isset($meta['nickname'][0]) && $meta['nickname'][0] != '' ) ? $meta['nickname'][0] : 'NULL' ;

					_e("\n\t".'<user>'."\n\t\t");
						_e('<user_id>'.$user_id.'</user_id>'."\n\t\t".'<user_name>'.$user_name.'</user_name>'."\n\t\t".'<first_name>'.$first_name.'</first_name>'."\n\t\t".'<last_name>'.$last_name.'</last_name>'."\n\t\t".'<email>'.$email.'</email>'."\n\t\t".'<nickname>'.$nickname.'</nickname>'."\n\t\t".'<user_role>'.ucfirst($role[0]).'</user_role>'."\n\t\t".'<user_reg_date>'.$reg_date.'</user_reg_date>');
					_e("\n\t".'</user>');
				} 	
				_e("\n".'</users>');
				exit();
			}
		}
	}
}

?>