<?php 
/**
*Plugin Name: VG-CRUD
** Plugin URI:
* Description:A plugin for CRUD (Create,Read,Update,Delete) operations it creates Table in Database Automatically.  It creates page called Crud automatically.
* version:1.0
* Author:Vaibhav Gangrade
* Author URI:
*/

define("PLUGIN_DIR_PATH",plugin_dir_path(__FILE__));
define("PLUGIN_URL",plugins_url());
define("SITE_URL",site_url());

############### CREATING CUSTOM PAGE ON PLUGIN ACTIVATION ##############################


//echo PLUGIN_DIR_PATH; die;
if (!defined('ABSPATH')) exit;

function VG_CreatePage(){
	add_option('Custom Crud','Plugin-Slug');

	$create_fields_for_page = array(
		'post_title'=>wp_strip_all_tags('VG-CrudPage'),
		'post_content'=>'[VG_CRUD_FORM]',
		'post_status'=>'publish',
		'post_author'=>1,
		'post_type'=>'page'

	);
	wp_insert_post($create_fields_for_page);
}
register_activation_hook(__FILE__,'VG_CreatePage');

##################### END OF PAGE CREATION FUNCTION ####################################

#############     CREATING TABLE ON PLUGIN ACTIVATION    ############################

global $wpdb;
global $table_name;
$table_name = 'VG_CRUD_TABLE';
$charset_collate = $wpdb->get_charset_collate();
$create_user_table = "CREATE TABLE IF NOT EXISTS $table_name(
  		id mediumint(11) NOT NULL AUTO_INCREMENT,
  		first_name varchar(100) NOT NULL,
  		last_name varchar(100) NOT NULL,
  		user_email varchar(100) NOT NULL,
 		PRIMARY KEY  (id)
) $charset_collate;";
require_once( ABSPATH . 'wp-admin/includes/upgrade.php');
dbDelta($create_user_table);

############      END OF CREATING TABLE CODE ###########################################


########## FUNCTION FOR ADDING STYLESHEET/JS ##########################################


function VG_CSS_n_JS() {
    wp_register_style('VG_CSS_n_JS', plugins_url('/css/bootstrap.min.css',__FILE__ ));
    wp_enqueue_style('VG_CSS_n_JS');
    wp_register_script( 'VG_CSS_n_JS', plugins_url('/js/bootstrap.min.js',__FILE__ ));
    wp_enqueue_script('VG_CSS_n_JS');
    wp_register_script( 'VG_CSS_n_JS', plugins_url('/js/jquery.js',__FILE__ ));
    wp_enqueue_script('VG_CSS_n_JS');
}

add_action( 'init','VG_CSS_n_JS');

function theme_scripts() {
  wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'theme_scripts');


/*function  VG_Custom_CSS_JS(){


	wp_enqueue_style("VG_CRUD_Style",PLUGIN_URL.'/CRUD/css/bootstrap.min.css',array(), '1.1', 'all');
	wp_enqueue_script("VG_CRUD_Script",PLUGIN_URL.'/CRUD/js/bootstrap.min.js',array ( 'jquery' ), 1.1, true);

	wp_enqueue_script("VG_CRUD_Script_Validation",PLUGIN_URL.'/CRUD/js/FormValidation.js',array ( 'jquery' ), 1.1, true);
	
}
add_action('wp_enqueue_scripts','VG_Custom_CSS_JS');
*/
########## END OF FUNCTION FOR ADDING STYLESHEET/JS ####################################

######### Function for Making Form #############################################

function VG_CRUDFormFunction(){
	?>
	<div class="container">
		<a href="<?php echo PLUGIN_URL ?>/CRUD/alluser.php"><button class="btn btn-primary pull-right">View All User</button></a>
		
		<!-- <div class="col-md-2"></div> -->
		<div class="col-md-8">
			<form method="POST" action="<?php echo PLUGIN_URL."/CRUD/insert_data.php" ?>" class="form-group" onsubmit="return FormValidation();">
				<div class="form-group">
					<label>First Name:</label>
					<input type="text" name="first_name" class="form-control" placeholder="Enter First Name" required>
				</div>
				<div class="form-group">
					<label>Last Name:</label>
					<input type="text" name="last_name" class="form-control" placeholder="Enter Last Name" required>
				</div>
				<div class="form-group">
					<label>Email :</label>
					<input type="email" name="user_email" class="form-control" placeholder="Enter email" required>
				</div>
				<input type="submit" name="insert" value="Insert" class="btn btn-primary">
			</form>
		</div>
		<!-- <div class="col-md-2"></div> -->
	</div>

	<?php
}

######### End of Function for Making Form #############################################

######################         Shortcode Function          ############################

function VG_ShortcodeForPage(){
	
	VG_CRUDFormFunction();
	ob_start();
	return ob_get_clean();
}

add_shortcode("VG_CRUD_FORM","VG_ShortcodeForPage");
######################   END OF Shortcode Function        ############################


/* Function for Deleting Custom table and Custom page that was created on plugin activation. */
register_deactivation_hook( __FILE__, 'my_plugin_remove_database' );
function my_plugin_remove_database() {
		$page = get_page_by_path( 'VGCRUDPAGE' );
    	wp_delete_post($page->ID);
     global $wpdb;
     $delete_table_name =  'VG_CRUD_TABLE';
     $delete_table_query = "DROP TABLE IF EXISTS $delete_table_name";
     $wpdb->query($delete_table_query);
     delete_option("my_plugin_db_version");
 
}   
 ?>