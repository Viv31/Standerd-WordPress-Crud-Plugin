<?php 
include('../../../wp-config.php'); 
$id = $_GET['id'];
get_header();
//echo $id;

global $wpdb;
$edit_user_data = "SELECT * FROM `vg_crud_table` WHERE id ='".$id."'";
		$data = $wpdb->get_results($edit_user_data);
		/*print_r($data);
		die;*/

		foreach ($data as $edit_data) {
			
		}


?>

<div class="container">
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<div class="jumbotron">
				<a href="<?php echo SITE_URL ?>/vg-crudpage"><button class="btn btn-primary pull-right">Back</button></a>
				<h4 class="text-center">Updation Form</h4><hr>
				<form action="<?php echo PLUGIN_URL."/CRUD/update_user.php"?>" method="POST" class="form-group">
					<div class="form-group">
						<label>First Name:</label>
						<input type="text" name="first_name" id="first_name" class="form-control" placeholder="Insert First Name" value="<?php echo $edit_data->first_name; ?>" required>
					</div>

					<div class="form-group">
						<label>Last Name:</label>
						<input type="text" name="last_name" id="last_name" placeholder="Insert Last Name" class="form-control" value="<?php echo $edit_data->last_name; ?>" required>
					</div>
					<div class="form-group">
						<label>Email:</label>
						<input type="text" name="user_email" id="user_email" placeholder="Insert email" class="form-control" value="<?php echo $edit_data->user_email; ?>" required>
					</div>
					<input type="hidden" name="id" value="<?php echo $edit_data->id; ?>">
					<input type="submit" name="update" class="btn btn-primary">
					
				</form>
			</div>

		</div>
		<div class="col-md-1"></div>

	</div>

</div>
<?php get_footer();?>
