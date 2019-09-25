<?php 
include('../../../wp-config.php');

if(isset($_POST['insert'])){

	$first_name = sanitize_text_field($_POST['first_name']);
	$last_name = sanitize_text_field($_POST['last_name']);
	$email = sanitize_email($_POST['user_email']);

	if(!empty($first_name) && !empty($last_name) && !empty($email)){
		global $wpdb;
		$sql = "SELECT first_name FROM `vg_crud_table` WHERE user_email='".$email."'";
		$exist_user_data = $wpdb->get_results($sql);
		if($exist_user_data){
			
			$path = plugins_url();
	wp_redirect($path.'/CRUD/alluser.php?email_exist');
			//echo "Email exist";

		}
		else{
			global $wpdb;
			$insert_records = $wpdb->insert('vg_crud_table',
				array(
					'first_name'=>$first_name,
					'last_name'=>$last_name, 
					'user_email'=>$email
				));
			if(is_wp_error($insert_records)){

				echo "<p style='color:red'>Failed to insert data</p>";
			}
			else{
				$path = plugins_url();
			wp_redirect($path.'/CRUD/alluser.php?reg_success');
			}


		}

	}
	else{
			$msg = "All fields are required";
	$path = plugins_url();
	wp_redirect($path.'/CRUD/alluser.php?success');

	}

}

?>