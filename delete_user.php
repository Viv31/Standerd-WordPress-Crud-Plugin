<?php 

include('../../../wp-config.php'); ?>
<?php 
$id = $_GET['id'];
//echo $id;

$table = 'vg_crud_table';
$delete_user = $wpdb->delete( $table, array( 'id' => $id ) );
if(is_wp_error($delete_user)){
	echo "<p style='color:red;'>Failed to delete data</p>";
	

}
else{

	$path = plugins_url();
	wp_redirect($path.'/CRUD/alluser.php?delete_success');
	
}

?>