<?php
/*
Plugin Name: Directory Plus
Plugin URI: http://monkeyta.co/directory-plus
Description: Organization member directory. Add members and associated organization information 
Version: 0.1
Author: Andrew Adcock
Author URI: http://andrewadcock.com
License: wtfpl http://wtfpl.net
*/

/*
***********************************************
NOTE: THIS HAS NOT BEEN TESTED YET!!!!
***********************************************

SHORTCODE: [dplus category=[0 for all, or specific #] columns=[#] images=[boolean] bio=[boolean] ]
SHORTCODE EXAMPLE: [dplus category=2 columns=4 images=false bio=true]

TEMPLATE:  dplus($category = [0 for all, or specific #], columns=[#], images=[boolean], bio=[boolean])
TEMPLATE EXAMPLE: 
	<?php
		echo dplus($category=2, $columns=4, $images=false, $bio=true);
	?>
*/
?>

<?php

define( 'DPLUS_PATH', dirname(__FILE__) );
define( 'DPLUS_URL', plugins_url( '', __FILE__ ) );
define( 'DPLUS_FILE', plugin_basename( __FILE__ ) );

if(!class_exists('DirectoryPlus')) {
	class DirectoryPlus {
		
		public function __construct() {
		
			// Initialize Settings 
			include(sprintf("%s/settings.php", DPLUS_PATH));
			$directoryPlusSettings = new directoryPlusSettings;
			
			// Register the CPT 
			include(sprintf("%s/members.php", DPLUS_PATH));
			$directoryPlusSettings = new directoryPlusSettings;
		
			load_plugin_textdomain( 'dplus', false, dirname( plugin_basename(__FILE__)) . '/lang');
		}
		
		// Activate DirectoryPlus
		public static function activate_dplus() {
			
		} // END activate_dplus
		
		// Deactivate DirectoryPlus
		public static function deactivate_dplus() {
		
		} // END deactive_dplus
	} // END class DirectoryPlus
} // END if(!class_exists('DirectoryPlus'))

if(class_exists('DirectoryPlus')) {
	// Activate and Deactivate hooks
	register_activation_hook( __FILE__, array( 'DirectoryPlus', 'activate_dplus') );
	register_deactivation_hook( __FILE__, array( 'DirectoryPlus', 'deactivate_plus' ) );
	
	// Instantiate Directory Plus class
	$directoryPlus = new DirectoryPlus();
	
	// Enqueue Scripts --> This should be moved somewhere more logical
	add_action( 'wp_enqueue_scripts', array( $this, 'register_dplus_styles') );
	add_action( 'wp_enqueue_scripts', array( $this, 'register_dplus_scripts') );
	
	// Add settings page to plugin page
	if( isset( $directoryPlus ) ) {
		function dplus_settings_link( $links ) {
			$settings_link = '<a href="options-general.php?page=DirectoryPlus">Settings</a>';
			array_unshift( $links, $settings_link);
			return $links;
		}
		add_filter( 'plugin_action_links_' . DPLUS_FILE, 'dplus_settings_link' );
	}
	
	// Allow easy use in template files
	function dplus($category = 0, $columns = 3, $images = true, $bio = true)
	{
		$directoryPlus = new DirectoryPlus();
		return $directoryPlus->show_directory($category, $columns, $images, $bio);
	} // END dplus
	
	// Add the shortcode
	function dplus_shortcode($atts) {
			extract( shortcode_atts( array(
				'category' => 0,
				'columns' => 3,
				'images' => true,
				'bio' => true
			), $atts ) );
			
			return $this->show_directory($category, $columns, $images);
		} // END dplus_shortcode
		
		// Add styles
	function register_dplus_styles() {
			wp_register_style( 'dplus',   DPLUS_URL . 'dplus/css/dplus'  );
			wp_enqueue_style( 'dplus' );
		} // END register_dplus_styles
		
		// Add JavaScripts
		function register_dplus_scripts() {
			wp_register_style( 'dplus', DPLUS_URL . (  'dplus/js/scripts.js' ) );
			wp_enqueue_style( 'dplus' );
		}  // END register_dplus_scripts
		
				// Show the Directory
		function show_directory($category = 0, $columns = 3, $images = true, $bio = true) {
			include 'display.php';
		}  // END show_directory


		// Categories (ie member lists) represented as custom post types

		if( !class_exists( 'dplus-list' ) ) {
			include 'members.php';
		}

	
}// END if(class_exists('DirectoryPlus')

?>