<?php 

include('../../../wp-config.php'); 
get_header();
//echo PLUGIN_URL.'/CRUD/css/bootstrap.min.css'; die;

/*function css_js(){
    ?>
<link rel="stylesheet" type="text/css" href="<?php echo  PLUGIN_URL.'/CRUD/css/bootstrap.min.css' ?>">

    <?php 
}

css_js();
*/

function bg_img(){ ?>
<style type="text/css">
    body{
        background-image: url("<?php echo PLUGIN_URL.'/CRUD/img/bg.jpg'?>");
    }






   div#email_error_msg ,#inserted_success,#update_sucess,#delete_msg {
    

    -moz-animation: cssAnimation 0s ease-in 5s forwards;
    /* Firefox */
    -webkit-animation: cssAnimation 0s ease-in 5s forwards;
    /* Safari and Chrome */
    -o-animation: cssAnimation 0s ease-in 5s forwards;
    /* Opera */
    animation: cssAnimation 0s ease-in 5s forwards;
    -webkit-animation-fill-mode: forwards;
    animation-fill-mode: forwards;
}
@keyframes cssAnimation {
    to {
        width:0;
        height:0;
        overflow:hidden;
       
        
    }
}
@-webkit-keyframes cssAnimation {
    to {
        width:0;
        height:0;
       visibility:hidden;
      
        

    }
}
</style>


<?php
}

bg_img();
?>

<div class="container">

<?php
            if(isset($_GET['email_exist'])==true){ ?>
               
                <div class="" id="email_error_msg">
                
  <strong>Error!</strong>Email is already exist
</div>
                
           <?php }
            if(isset($_GET['reg_success'])==true){ ?>
                <div class="" id="inserted_success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong>Data Inserted Successfully
</div>
            <?php }

            if(isset($_GET['update_success'])==true){ ?>
               <div class="" id="update_sucess">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong>Data Updated Successfully
</div>

           <?php  }

            if(isset($_GET['delete_success'])==true){ ?>
                <div class="" id="delete_msg" >
                
  <strong>Success!</strong>Data Deleted Successfully
</div>
           <?php }

            ?>



	<div class="row">
		
            
            <div class="col-md-12">
			<div class="jumbotron">
				<a href="<?php echo SITE_URL?>/vg-crudpage"><button class="btn btn-primary pull-right">Back</button></a>
				<h4>Register User List</h4><hr>
				<table class="table">
    <thead>
      <tr>
      	<th>Sno.<?php $sno ='1'; ?></th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>
        
    	<?php 
    	global $wpdb;
    	$all_user_data = "SELECT * FROM vg_crud_table";
    	$data = $wpdb->get_results($all_user_data);
    	foreach($data as $user_data){
    		?>
            <tr>
    			<td><?php echo $sno++; ?></td>
        		<td><?php echo $user_data->first_name; ?></td>
       			<td><?php echo $user_data->last_name; ?></td>
        		<td><?php echo $user_data->user_email; ?></td>
        		<td><a href="edit_user.php?id=<?php echo $user_data->id;?>"><button class="btn btn-primary">Edit</button></a></td>
        		<td><a href="delete_user.php?id=<?php echo $user_data->id; ?>"><button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this');">Delete</button></a></td>
                </tr>
    		<?php
    	}

    	?>
    
    </tbody>
    </table>
			</div>
		</div>

	</div>

</div>
<?php get_footer();?>

