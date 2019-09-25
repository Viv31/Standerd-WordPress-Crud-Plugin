<?php 
include('../../../wp-config.php'); 
$id = $_POST['id'];
//echo $id;


if(isset($_POST['update'])){
	//echo "Update";
	$first_name = sanitize_text_field($_POST['first_name']);
	$last_name = sanitize_text_field($_POST['last_name']);
	$user_email = sanitize_email($_POST['user_email']);
	

	if($first_name =='' || $last_name =='' || $user_email ==''){
		echo "All fields are required";

}
else{
	$update_userdata = $wpdb->update('vg_crud_table',
	array(
			'id'=>$id,
			'first_name'=>$first_name,
			'last_name'=>$last_name,
			'user_email'=>$user_email
),array('id'=>$id));

	if(is_wp_error($update_userdata)){
		echo "Failed to update data";

	}
	else{
		$path = plugins_url();
	wp_redirect($path.'/CRUD/alluser.php?update_success');
	}
}

}
?>