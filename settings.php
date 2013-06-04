<?php
// Settings Page for Directory Plus

if( !class_exists( 'directoryPlusSettings' )) {
	class directoryPlusSettings {
		
		public function __construct() {	
			// Add Admin Pages
			add_action( 'admin_init', array( &$this, 'admin_init') );
			add_action( 'admin_menu', array( &$this, 'add_menu' ) );
			
			// Add shortcode --> This should be moved to some place more logical
			add_shortcode( 'dplus', array( $this, 'dplus_shortcode' ) );
			
			// Add Widget Support
			add_filter( 'widget_text', 'do_shortcode' );
		} // END __construct
		
		public function admin_init() {	
			// Add global settings here
			register_setting( 'dplus-group', 'setting_category' );
			register_setting( 'dplus-group', 'setting_images' );
			register_setting( 'dplus-group', 'setting_bio' );
			register_setting( 'dplus-group', 'setting_headers' );
			
			add_settings_section('dplus-section', 'dPlus Settings', array(&$this, 'settings_section_dplus'), 'directoryPlus');
			
			add_settings_field( 
				'dplus_setting_category', 
				'Default Category',
				array( &$this, 'settings_field_input_text' ), 
				'directoryPlus', 
				'dplus-section', 
				array( 'field' => 'setting_category' ) 
			);
			
			add_settings_field( 
				'dplus_setting_images', 
				'Images On?',
				array( &$this, 'settings_field_input_boolean' ), 
				'directoryPlus', 
				'dplus-section', 
				array( 'field' => 'setting_images' ) 
			);
			
			add_settings_field( 
				'dplus_setting_bio', 
				'Bio\'s On?',
				array( &$this, 'settings_field_input_boolean' ), 
				'directoryPlus', 
				'dplus-section', 
				array( 'field' => 'setting_bio' ) 
			);
			
			add_settings_field( 
				'dplus_setting_headers', 
				'Headers On?',
				array( &$this, 'settings_field_input_boolean' ), 
				'directoryPlus', 
				'dplus-section', 
				array( 'field' => 'setting_headers' ) 
			);
			
		} // END admin_init
		
		public function settings_section_dplus()
        {
            echo 'Set the default settings for Directory Plus. Settings can be overriden with shortcode or template calls';
        }
		
		public function settings_field_input_text( $args ) {
			$field = $args['field'];
			$value = get_option('field');
			echo sprintf( '<input type="text" name="%s" id="%s" value="%s" />', $field, $field, $value );
		
		} // END settings_field_input_text
		
		public function settings_field_input_boolean( $args ) {
			$field = $args['field'];
			$value = get_option('field');
			if( $value == true ) {
				echo sprintf( '<input type="checkbox" name="%s" id="%s" value="%s" checked="checked" />', $field, $field, true );
			} else {
				echo sprintf( '<input type="checkbox" name="%s" id="%s" value="%s" />', $field, $field, true );
			}
		}
		
		
		public function add_menu() {
			add_options_page(
				'dPlus Settings',
				'Directory Plus',
				'manage_options',
				'directoryPlus',
				array(&$this, 'dplus_settings_page')
			);
		} // END add_menu
		
				//Menu Callback
		public function dplus_settings_page() {
			if(!current_user_can('manage_options')) {
				wp_die(__( 'You do not have sufficient permissions to access this page.' ));
			}
			// Settings template page
        	include(sprintf("%s/templates/settings.php", DPLUS_PATH));
		} // END dplus_settings_page
		
		
			
	} // END directoryPlusSettings
}	// END if !class_exists( 'directoryPlusSettings' )
?>