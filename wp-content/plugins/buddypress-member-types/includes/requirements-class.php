<?php
// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;


class BMT_Plugin_Requirements_Check {
    function __construct() {
        add_action( 'admin_init', array( $this, 'backup_activation_check' ) );

        // Don't run anything else in the plugin, if we're on an incompatible WordPress version
        if ( ! self::bmt_activation_check() ) {
            return;
        }
    }

    // The primary sanity check, automatically disable the plugin on activation if it doesn't
    // meet minimum requirements.
    static function activation_check() {
        if ( ! self::bmt_activation_check() ) {
            deactivate_plugins( plugin_basename( __FILE__ ) );
            wp_die( __( 'Please activate BuddyPress first', 'bp-member-types' ) );
        } else {
            self::install();
        }
    }

    // The backup sanity check, in case the plugin is activated in a weird way
    function backup_activation_check() {
        if ( ! self::bmt_activation_check() ) {
            if ( is_plugin_active( plugin_basename( __FILE__ ) ) ) {
                deactivate_plugins( plugin_basename( __FILE__ ) );
                add_action( 'admin_notices', array( $this, 'disabled_notice' ) );
                if ( isset( $_GET['activate'] ) ) {
                    unset( $_GET['activate'] );
                }
            }
        }
    }

    function disabled_notice() {
        echo '<strong>' . esc_html__( 'Please activate BuddyPress first', 'bp-member-types' ) . '</strong>';
    }

    static function bmt_activation_check() {
        if ( function_exists( 'bp_is_active' ) ) {
            return true;
        }

        // Add sanity checks for other version requirements here

        return false;
    }

    /**
     * Install
     */
    static function install() {
        global $wp_roles;

        //create capabilities
        $capabilities = self::get_core_capabilities();

        foreach ( $capabilities as $cap_group ) {
            foreach ( $cap_group as $cap ) {
                $wp_roles->add_cap( 'administrator', $cap );
            }
        }
    }

    /**
     * Get capabilities - these are assigned to admin during installation or reset.
     *
     * @return array
     */
    static function get_core_capabilities() {

        $capability_types = array( 'bmt-member-type' );

        foreach ( $capability_types as $capability_type ) {

            $capabilities[ $capability_type ] = array(
                // Post type
                "edit_{$capability_type}",
                "read_{$capability_type}",
                "delete_{$capability_type}",
                "edit_{$capability_type}s",
                "edit_others_{$capability_type}s",
                "publish_{$capability_type}s",
                "read_private_{$capability_type}s",
                "delete_{$capability_type}s",
                "delete_private_{$capability_type}s",
                "delete_published_{$capability_type}s",
                "delete_others_{$capability_type}s",
                "edit_private_{$capability_type}s",
                "edit_published_{$capability_type}s",

                // Terms
                "manage_{$capability_type}_terms",
                "edit_{$capability_type}_terms",
                "delete_{$capability_type}_terms",
                "assign_{$capability_type}_terms",
            );
        }

        return $capabilities;
    }

}
