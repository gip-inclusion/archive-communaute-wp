<?php
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Range Value Customizer Control
 * 
 * Class BetterDocs_Customizer_Range_Value_Control
 *
 * @since 1.0.0
 */
class BetterDocs_Customizer_Range_Value_Control extends WP_Customize_Control {
	public $type = 'betterdocs-range-value';
	
	/**
	 * Enqueue scripts/styles.
	 *
	 * @since 1.0.0
	 */
	public function enqueue() {
		wp_enqueue_script(
			'betterdocs-customizer-range-value-control',
			BETTERDOCS_ADMIN_URL . 'assets/js/customizer-range-value-control.js',
			array( 'jquery' ),
			rand(),
			true
		);

		wp_enqueue_style( 
			'betterdocs-customizer-range-value-control', BETTERDOCS_ADMIN_URL . 'assets/css/customizer-range-value-control.css',
			array(),
			rand()
		);
	}

	/**
	 * Render the control's content.
	 *
	 * @version 1.0.0
	 * 
	 */
	public function render_content() {
		?>
		<?php if ( ! empty( $this->label ) ) : ?>
			<span class="customize-control-title betterdocs-customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<a href="#" title="<?php echo esc_html__('Reset', 'betterdocs') ?>" class="betterdocs-customizer-reset <?php echo esc_html( $this->type ); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="20px"><path d="M 25 2 C 12.321124 2 2 12.321124 2 25 C 2 37.678876 12.321124 48 25 48 C 37.678876 48 48 37.678876 48 25 A 2.0002 2.0002 0 1 0 44 25 C 44 35.517124 35.517124 44 25 44 C 14.482876 44 6 35.517124 6 25 C 6 14.482876 14.482876 6 25 6 C 30.475799 6 35.391893 8.3080175 38.855469 12 L 35 12 A 2.0002 2.0002 0 1 0 35 16 L 46 16 L 46 5 A 2.0002 2.0002 0 0 0 43.970703 2.9726562 A 2.0002 2.0002 0 0 0 42 5 L 42 9.5253906 C 37.79052 4.9067015 31.727675 2 25 2 z"></path></svg></a>
		<?php endif; ?>
		<div class="betterdcos-range-slider" data-default-val="<?php echo $this->settings[ 'default' ]->value(); ?>" style="width:100%; display:flex;flex-direction: row;justify-content: flex-start;">
			<span  style="width:100%; flex: 1 0 0; vertical-align: middle;"><input class="betterdcos-range-slider__range" type="range" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->input_attrs(); $this->link(); ?>>
			<span class="betterdcos-range-slider__value">0</span></span>
		</div>
		<?php if ( ! empty( $this->description ) ) : ?>
		<span class="description customize-control-description"><?php echo $this->description; ?></span>
		<?php endif; ?>
		<?php
	}
}

/**
 * Toogle Customizer Control
 * 
 * Class BetterDocs_Customizer_Toggle_Control
 *
 * @since 1.0.0
 * 
 */
class BetterDocs_Customizer_Toggle_Control extends WP_Customize_Control {
	public $type = 'betterdocs-toggle';

	/**
	 * Enqueue scripts/styles.
	 *
	 * @since 1.0.0
	 */
	public function enqueue() {
		wp_enqueue_script( 'betterdocs-customizer-toggle-control',
			BETTERDOCS_ADMIN_URL . 'assets/js/customizer-toggle-control.js',
			array( 'jquery' ),
			rand(),
			true
		);
		wp_enqueue_style( 'betterdocs-pure-css-toggle-buttons', 
			BETTERDOCS_ADMIN_URL . 'assets/css/customizer-togle-buttons.css',
			array(),
			rand()
		);

		$css = '
			.disabled-control-title {
				color: #a0a5aa;
			}
			input[type=checkbox].tgl-light:checked + .tgl-btn {
				background: #37de89;
			}
			input[type=checkbox].tgl-light + .tgl-btn {
			  background: #a0a5aa;
			}
			input[type=checkbox].tgl-light + .tgl-btn:after {
			  background: #f7f7f7;
			}

			input[type=checkbox].tgl-ios:checked + .tgl-btn {
			  background: #37de89;
			}

			input[type=checkbox].tgl-flat:checked + .tgl-btn {
			  border: 4px solid #37de89;
			}
			input[type=checkbox].tgl-flat:checked + .tgl-btn:after {
			  background: #37de89;
			}

		';
		wp_add_inline_style( 'pure-css-toggle-buttons' , $css );
	}

	/**
	 * Render the control's content.
	 *
	 * @version 1.0.0
	 * 
	 */
	public function render_content() {
		?>
		<label>
			<div class="betterdocs-customizer-toggle">
				<span class="customize-control-title betterdocs-customize-control-title betterdocs-customizer-toggle-title"><?php echo esc_html( $this->label ); ?></span>
				<input id="cb<?php echo $this->instance_number ?>" type="checkbox" data-default-val="<?php echo $this->settings[ 'default' ]->value(); ?>" class="tgl tgl-<?php echo $this->type?> <?php echo $this->type?>" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); checked( $this->value() ); ?> />
				<label for="cb<?php echo $this->instance_number ?>" class="tgl-btn"></label>
			</div>
			<?php if ( ! empty( $this->description ) ) : ?>
			<span class="description customize-control-description"><?php echo $this->description; ?></span>
			<?php endif; ?>
		</label>
		<?php
	}
}

/**
 * Alpha Color Picker Customizer Control
 * 
 * Class BetterDocs_Customizer_Alpha_Color_Control
 *
 * @since 1.0.0
 */

class BetterDocs_Customizer_Alpha_Color_Control extends WP_Customize_Control {
	/**
	 * Official control name.
	 *
	 * @var string
	 */
	public $type = 'betterdocs-alpha-color';
	/**
	 * Add support for palettes to be passed in.
	 *
	 * Supported palette values are true, false, or an array of RGBa and Hex colors.
	 *
	 * @var bool
	 */
	public $palette;
	/**
	 * Add support for showing the opacity value on the slider handle.
	 *
	 * @var array
	 */
	public $show_opacity;

    /**
     * ColorPicker Attributes
     */
    public $attributes = '';

    /**
     * Color palette defaults
     */
    public $defaultPalette = array(
        '#000000',
        '#ffffff',
        '#dd3333',
        '#dd9933',
        '#eeee22',
        '#81d742',
        '#1e73be',
        '#8224e3',
    );

    /**
     * Constructor
     */
    public function __construct( $manager, $id, $args = array(), $options = array() ) {
        parent::__construct( $manager, $id, $args );
        $this->attributes .= 'data-default-color="' . esc_attr( $this->value() ) . '"';
        $this->attributes .= 'data-alpha="true"';
        $this->attributes .= 'data-reset-alpha="' . ( isset( $this->input_attrs['resetalpha'] ) ? $this->input_attrs['resetalpha'] : 'true' ) . '"';
        $this->attributes .= 'data-custom-width="0"';
    }

	/**
	 * Enqueue scripts/styles.
	 * 
	 * @since 1.0.0
	 *
	 */
	public function enqueue() {
        wp_enqueue_style( 'wp-color-picker' );
        wp_register_script(
            'wp-color-picker-alpha',
            BETTERDOCS_ADMIN_URL . 'assets/js/wp-color-picker-alpha.min.js',
            array( 'wp-color-picker' ),
            rand(), true
        );
        wp_add_inline_script(
            'wp-color-picker-alpha',
            'jQuery( function() { jQuery( ".betterdocs-alpha-color-control" ).wpColorPicker(); } );'
        );
        wp_enqueue_script( 'wp-color-picker-alpha' );
	}

    /**
     * Pass our Palette colours to JavaScript
     */
    public function to_json() {
        parent::to_json();
        $this->json['colorpickerpalette'] = isset( $this->input_attrs['palette'] ) ? $this->input_attrs['palette'] : $this->defaultPalette;
    }

	/**
	 * Render the control.
	 */
	public function render_content() {
		echo '<div class="betterdocs-alpha-color-picker">';
		// Output the label and description if they were passed in.
		if ( isset( $this->label ) && '' !== $this->label ) {
			echo '<span class="customize-control-title betterdocs-customize-control-title">' . sanitize_text_field( $this->label ) . '</span>';
		}
		if ( isset( $this->description ) && '' !== $this->description ) {
			echo '<span class="description customize-control-description">' . sanitize_text_field( $this->description ) . '</span>';
		}
		?>
		<input id="<?php echo esc_attr( $this->id ); ?>" class="betterdocs-alpha-color-control" <?php echo $this->attributes; ?> <?php esc_attr( $this->link() ); ?>  />
		
		<?php
		echo '</div>';
	}
}

/**
 * Seperator Custom Customizer Control
 * 
 * Class BetterDocs_Separator_Custom_Control
 *
 * @since 1.0.0
 */

class BetterDocs_Separator_Custom_Control extends WP_Customize_Control{
	public $type = 'separator';
	public function render_content(){
		?>
		<label>
			<h4 class="betterdocs-customize-control-separator"><?php echo esc_html( $this->label ); ?></h4>
			<?php if ( ! empty( $this->description ) ) : ?>
			<span class="description customize-control-description"><?php echo $this->description; ?></span>
			<?php endif; ?>
		</label>
		<?php
	}
}

/**
 * Title Custom Customizer Control
 * 
 * Class BetterDocs_Title_Custom_Control
 *
 * @since 1.0.0
 */

class BetterDocs_Title_Custom_Control extends WP_Customize_Control{
	public $type = 'betterdocs-title';
	public function render_content() {
		?>
		<div <?php echo $this->input_attrs(); ?>>
		<span class="customize-control-title betterdocs-customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<a href="#" title="<?php echo esc_html__('Reset', 'betterdocs') ?>" class="betterdocs-customizer-reset"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="20px"><path d="M 25 2 C 12.321124 2 2 12.321124 2 25 C 2 37.678876 12.321124 48 25 48 C 37.678876 48 48 37.678876 48 25 A 2.0002 2.0002 0 1 0 44 25 C 44 35.517124 35.517124 44 25 44 C 14.482876 44 6 35.517124 6 25 C 6 14.482876 14.482876 6 25 6 C 30.475799 6 35.391893 8.3080175 38.855469 12 L 35 12 A 2.0002 2.0002 0 1 0 35 16 L 46 16 L 46 5 A 2.0002 2.0002 0 0 0 43.970703 2.9726562 A 2.0002 2.0002 0 0 0 42 5 L 42 9.5253906 C 37.79052 4.9067015 31.727675 2 25 2 z"></path></svg></a>
		<?php if ( ! empty( $this->description ) ) : ?>
		<span class="description customize-control-description"><?php echo $this->description; ?></span>
		<?php endif; ?>
		</div>
		<?php
	}
}


/**
 * Select Customizer Control
 * 
 * Class BetterDocs_Select_Control
 *
 * @since 1.0.0
 */

class BetterDocs_Select_Control extends WP_Customize_Control {

	public $type = 'betterdocs-select';
	public function render_content() {
		if( empty( $this->choices ) )
			return;
		?>
		<select <?php $this->link(); ?> data-default-val="<?php echo $this->settings[ 'default' ]->value(); ?>" <?php echo $this->input_attrs(); ?>>
			<?php
				foreach( $this->choices as $key => $label ) {
					echo '<option value="' . esc_attr( $key ) . '">' . $label . '</option>';
				}
			?>
		</select>
		<?php if( !empty( $this->label ) ) : ?>
			<span class="customize-control-title betterdocs-customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php endif;
	}

}

/**
 * Dimension Customizer Control
 * 
 * Class BetterDocs_Dimension_Control
 *
 * @since 1.0.0
 */

class BetterDocs_Dimension_Control extends WP_Customize_Control {
	public $type = 'betterdocs-dimension';

	/**
	 * Render the control's content.
	 *
	 * @since 1.0.0
	 */
	public function render_content() {
		?>
		<div class="dimension-field">
			<input type="number" data-default-val="<?php echo $this->settings[ 'default' ]->value(); ?>" value="<?php echo esc_attr($this->value()); ?>" <?php $this->input_attrs(); $this->link(); ?>>
			<span class="customize-control-title betterdocs-customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		</div>
		<?php
	}
}

/**
 * Number Customizer Control
 * 
 * Class BetterDocs_Dimension_Control
 *
 * @since 1.0.0
 */

class BetterDocs_Padding_Control extends WP_Customize_Control {
	public $type = 'betterdocs-padding';

	/**
	 * Render the control's content.
	 *
	 * @since 1.0.0
	 */
	public function render_content() {
		?>
		<div class="number-field">
			<?php 
			$controller_id = esc_attr($this->id);
			$val_top = get_theme_mod($this->id.'_top');
			$val_left = get_theme_mod($this->id.'_left');
			?>
			<?php if ( ! empty( $this->label ) ) : ?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<a href="#" title="<?php echo esc_html__('Reset', 'betterdocs') ?>" class="betterdocs-customizer-reset <?php echo esc_html( $this->type ); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="20px"><path d="M 25 2 C 12.321124 2 2 12.321124 2 25 C 2 37.678876 12.321124 48 25 48 C 37.678876 48 48 37.678876 48 25 A 2.0002 2.0002 0 1 0 44 25 C 44 35.517124 35.517124 44 25 44 C 14.482876 44 6 35.517124 6 25 C 6 14.482876 14.482876 6 25 6 C 30.475799 6 35.391893 8.3080175 38.855469 12 L 35 12 A 2.0002 2.0002 0 1 0 35 16 L 46 16 L 46 5 A 2.0002 2.0002 0 0 0 43.970703 2.9726562 A 2.0002 2.0002 0 0 0 42 5 L 42 9.5253906 C 37.79052 4.9067015 31.727675 2 25 2 z"></path></svg></a>
			<?php endif; ?>
			<!-- <input type="hidden" data-default-val="<?php echo $this->settings[ 'default' ]->value(); ?>" class="<?php echo $this->type.' '.$this->id ?> ?>" value="<?php echo esc_attr($this->value()) ?>" <?php $this->input_attrs(); $this->link(); ?>> -->
			<ul>
				<li id="<?php echo $controller_id . '_top' ?>" class="customize-control">
					<input type="number" data-default-val="20" class="<?php echo $this->type ?>" value="20" data-customize-setting-link="<?php echo $controller_id . '_top' ?>" >
				</li>
				<li id="<?php echo $controller_id . '_left' ?>" class="customize-control">
					<input type="number" data-default-val="20" class="<?php echo $this->type ?>" value="20" data-customize-setting-link="<?php echo $controller_id . '_left' ?>">
				</li>
			</ul>
		</div>
		<?php
	}
}


/**
 * Number Customizer Control
 * 
 * Class BetterDocs_Dimension_Control
 *
 * @since 1.0.0
 */

class BetterDocs_Number_Control extends WP_Customize_Control {
	public $type = 'betterdocs-number';

	/**
	 * Render the control's content.
	 *
	 * @since 1.0.0
	 */
	public function render_content() {
		?>
		<div class="number-field">
			<?php if ( ! empty( $this->label ) ) : ?>
			<span class="customize-control-title betterdocs-customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<a href="#" title="<?php echo esc_html__('Reset', 'betterdocs') ?>" class="betterdocs-customizer-reset <?php echo esc_html( $this->type ); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="20px"><path d="M 25 2 C 12.321124 2 2 12.321124 2 25 C 2 37.678876 12.321124 48 25 48 C 37.678876 48 48 37.678876 48 25 A 2.0002 2.0002 0 1 0 44 25 C 44 35.517124 35.517124 44 25 44 C 14.482876 44 6 35.517124 6 25 C 6 14.482876 14.482876 6 25 6 C 30.475799 6 35.391893 8.3080175 38.855469 12 L 35 12 A 2.0002 2.0002 0 1 0 35 16 L 46 16 L 46 5 A 2.0002 2.0002 0 0 0 43.970703 2.9726562 A 2.0002 2.0002 0 0 0 42 5 L 42 9.5253906 C 37.79052 4.9067015 31.727675 2 25 2 z"></path></svg></a>
			<?php endif; ?>
			<input type="number" data-default-val="<?php echo $this->settings[ 'default' ]->value(); ?>" class="<?php echo $this->type ?>" value="<?php echo esc_attr($this->value()); ?>" <?php $this->input_attrs(); $this->link(); ?>>
			<?php if ( ! empty( $this->description ) ) : ?>
			<span class="description customize-control-description"><?php echo $this->description; ?></span>
			<?php endif; ?>
		</div>
		<?php
	}
}

class BetterDocs_Radio_Image_Control extends WP_Customize_Control {
	/**
	 * Declare the control type.
	 *
	 * @since 1.0.0
	 */
	public $type = 'betterdocs-radio-image';
	
	/**
	 * Enqueue scripts/styles.
	 *
	 * @since 1.0.0
	 */
	public function enqueue() {
		wp_enqueue_script( 'jquery-ui-button' );
		wp_enqueue_style(
			'betterdocs-customizer-radio-image-select',
			BETTERDOCS_ADMIN_URL . 'assets/css/customizer-radio-image-select.css',
			array(),
			rand()
		);
	}
	
	/**
	 * Render the control's content.
	 *
	 * @since 1.0.0
	 */
	public function render_content() {
		if ( empty( $this->choices ) ) {
			return;
		}			
		
		$name = '_customize-radio-' . $this->id;
		?>
		<?php if ( ! empty( $this->label ) ) : ?>
		<span class="customize-control-title betterdocs-customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php endif; ?>
		<?php if ( ! empty( $this->description ) ) : ?>
			<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
		<?php endif; ?>
		<div id="input_<?php echo $this->id; ?>" class="image ui-buttonset">
			<?php 
			foreach ( $this->choices as $value => $label ) :
				if(isset( $label['pro'] ) && $label['pro'] === true){ ?>
				<label class="image-select" id="<?php echo $this->id . $value ?>">
				<a target="_blank" href="<?php echo esc_url($label['url']) ?>"><img src="<?php echo esc_url( $label['image'] ) ?>" alt=""></a>
				<span class="go-pro"><?php esc_html_e('Go Pro','betterdocs') ?></span>
				</label>
				<?php } else { ?>
				<input class="image-select" type="radio" value="<?php echo esc_attr( $value ) ?>" id="<?php echo $this->id . $value; ?>" name="<?php echo esc_attr( $name ) ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
					<label for="<?php echo $this->id . $value; ?>">
						<img src="<?php echo esc_url( $label['image'] ) ?>" alt="<?php echo esc_attr( $value ) ?>" title="<?php echo esc_attr( $value ) ?>">
					</label>
				</input>
			<?php } endforeach; ?>
		</div>
		<script>jQuery(document).ready(function($) { $( '[id="input_<?php echo $this->id; ?>"]' ).buttonset(); });</script>
		<?php
	}
}

 /**
 *  Load customizer conditional controler js file.
 *
 * @since 1.0.0
 */

function betterdocs_customizer_condition() {
	wp_enqueue_script( 'betterdocs-customize-condition', 
		BETTERDOCS_ADMIN_URL . 'assets/js/customizer-condition.js',
		array(), 
		true 
	);
}
add_action( 'customize_controls_enqueue_scripts', 'betterdocs_customizer_condition' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since 1.0.0
 */
function betterdocs_customize_preview_js() {
	wp_enqueue_script( 'betterdocs-customizer', 
		BETTERDOCS_ADMIN_URL . 'assets/js/customizer.js', 
		array( 'customize-preview' ), 
		'', 
		true 
	);
}
add_action( 'customize_preview_init', 'betterdocs_customize_preview_js' );
?>
