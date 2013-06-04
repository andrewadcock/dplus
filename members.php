<?php
// Categories (ie member lists) represented as custom post types
if( !class_exists( 'dplusList' ) ) {
	class dplusList {
		const DPLUS_MEMBERS = "dplus-members";
		private $_meta = array(
			'first_name', 
			'last_name',
			'position',
			'email',
			'phone',
			'fax',
			'bio',
			'image'
		);
		
		public function __construct() {
			add_action( 'init', array( &$this, 'init' ));
			add_action( 'admin_init', array( &$this, 'admin_init' ) );
		} // END __construct
		
		public function init() {
			$this->create_post_type();
			add_action( 'save_post', array( &$this, 'save_post' ) );
		} // END init
		
		public function create_post_type() {
			register_post_type(self::POST_TYPE,
    			array(
    				'labels' => array(
    					'name' => __(sprintf('%ss', ucwords(str_replace("_", " ", self::POST_TYPE)))),
    					'singular_name' => __(ucwords(str_replace("_", " ", self::POST_TYPE)))
    				),
    				'public' => true,
    				'has_archive' => true,
    				'description' => __("Directory list (testing)"),
    				'supports' => array(
    					'title', 'editor', 'excerpt', 
    				),
    			)
    		);
		} // END create_post_type
		
		public function save_post($post_id)
    	{
            // is this autosave?
            if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            {
                return;
            }
            
    		if($_POST['post_type'] == self::POST_TYPE && current_user_can('edit_post', $post_id))
    		{
    			foreach($this->_meta as $field_name)
    			{
    				// Update meta fields
    				update_post_meta($post_id, $field_name, $_POST[$field_name]);
    			}
    		}
    		else
    		{
    			return;
    		} // if($_POST['post_type'] == self::POST_TYPE && current_user_can('edit_post', $post_id))
    	} // END save_post($post_id)
		
		public function admin_init()
    	{			
    		// Add metaboxes
    		add_action('add_meta_boxes', array(&$this, 'add_meta_boxes'));
    	} // END admin_init()
			
    	public function add_meta_boxes()
    	{
    		// Add metaboxes to posts
    		add_meta_box( 
    			sprintf('wp_plugin_template_%s_section', self::POST_TYPE),
    			sprintf('%s Information', ucwords(str_replace("_", " ", self::POST_TYPE))),
    			array(&$this, 'add_inner_meta_boxes'),
    			self::POST_TYPE
    	    );					
    	} // END add_meta_boxes()

	
		public function add_inner_meta_boxes($post)
		{		
			// Render the job order metabox
			include(sprintf("%s/../templates/%s_metabox.php", dirname(__FILE__), self::POST_TYPE));			
		} // END add_inner_meta_boxes($post)

	} // END dplus-list
}// END
?>