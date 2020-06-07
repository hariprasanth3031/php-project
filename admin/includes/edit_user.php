<?php

if(isset($_GET['edit_user'])){
    if(isset($_SESSION['user_role'])){
        
        if($_SESSION['user_role'] == 'admin'){

    $the_user_id = mysqli_real_escape_string($connection,$_GET['edit_user']);

   $query = "select * from users where user_id = $the_user_id";
    $select_user_by_id = mysqli_query($connection, $query);            
                            
    while($row = mysqli_fetch_assoc($select_user_by_id)){
         
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];          
        $user_role = $row['user_role'];
        
        $username = $row['username'];
        $user_email = $row['user_email'];
        $user_password = $row['user_password'];
            }
        }
    }
}



if(isset($_POST['edit_user'])){
    
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];          
        $user_role = $_POST['user_role'];
        
    //    $post_image = $_FILES['image']['name'];
    //    $post_image_temp = $_FILES['image']['tmp_name'];
        
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
    //    $post_date = date('d-m-y');



//      move_uploaded_file($post_image_temp, "../images/$post_image");
    $query = "select randSalt from users";
    $select_randSalt_query = mysqli_query($connection,$query);
    if(!$select_randSalt_query){
        die("query failed" . mysqli_error($connection));
    }
    
    $row = mysqli_fetch_array($select_randSalt_query);
    $salt = $row['randSalt'];
    $hashed_password = crypt($user_password,$salt);
    
    

    $query = "update users set ";
    $query .= "user_firstname = '{$user_firstname}', ";
    $query .= "user_lastname = '{$user_lastname}', ";
    $query .= "user_role = '{$user_role}', ";
    $query .= "username = '{$username}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_password = '{$hashed_password}' ";
    $query .= "where user_id = {$the_user_id} ";

    $edit_user_query = mysqli_query($connection,$query);

    if(!$edit_user_query){
        die('query failed' . mysqli_error($connection));
    }
}

?>
<form action="" method="post" enctype="multipart/form-data">
	
    
    <div class="form-group">
	<label for="user_firstname">Firstname</label>
	<input value="<?php echo $user_firstname; ?>" type="text" class="form-control" name="user_firstname" placeholder="Enter your firstname">
	</div>
	

    <div class="form-group">
	<label for="user_lastname">Lastname</label>
	<input value="<?php echo $user_lastname; ?>" type="text" class="form-control" name="user_lastname" placeholder="Enter your lastname" >
	</div>
    
    
    <div class="form-group">
    <label for="user_role">User role</label><br>    
    <select name="user_role" id="">
    
        <?php echo "<option value='{$user_role}'>{$user_role}</option>"; ?>
        
        <?php    
        if($user_role == 'admin'){
            echo "<option value='subscriber'>Subscriber</option>";
        }else{
            echo "<option value='admin'>Admin</option>";   
        }
        ?>
        
        
        
    </select>    
	</div>
	
    
<!--    <div class="form-group">
	<label for="image">Post Image</label>
	<input type="file"  name="image" >
	</div>
    -->
    <div class="form-group">
	<label for="username">Username</label>
	<input value="<?php echo $username; ?>" type="text" class="form-control" name="username" placeholder="Enter username">
	</div>

    <div class="form-group">
	<label for="user_email">Email</label>
	<input value="<?php echo $user_email; ?>" type="text" class="form-control" name="user_email" placeholder="Enter your email">
	</div>

    <div class="form-group">
	<label for="username">Password</label>
	<input value="<?php echo $user_password; ?>" type="password" class="form-control" name="user_password" placeholder="Enter password">
	</div>

    
    <input class="btn btn-primary" type="submit" name="edit_user" value="Update user">
	</form>
