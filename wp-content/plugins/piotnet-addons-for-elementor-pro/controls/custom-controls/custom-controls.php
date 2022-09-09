<?php

namespace ElementorControls;

if (!defined('ABSPATH')) exit;

class PAFE_Custom_Controls {

	public function includes() {
		require_once( __DIR__ . '/select-control.php' );
		require_once( __DIR__ . '/select-files-control.php' );
	}

	public function register_controls() {
		$this->includes();
		$controls_manager = \Elementor\Plugin::$instance->controls_manager;
		$controls_manager->register_control(\Elementor\PafeCustomControls\Select_Control::Select, new \Elementor\PafeCustomControls\Select_Control());
		$controls_manager->register_control(\Elementor\PafeCustomControls\Select_Files_Control::Select_Files, new \Elementor\PafeCustomControls\Select_Files_Control());
	}

	public function __construct() {
		add_action('elementor/controls/controls_registered', [$this, 'register_controls']);
	}

}

new PAFE_Custom_Controls();