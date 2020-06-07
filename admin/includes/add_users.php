<?php

if(isset($_POST['create_user'])){
    
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

$query = "insert into users(username,user_password,user_firstname,user_lastname,user_email,user_role) ";    
        
$query .=  "values('{$username}','{$user_password}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_role}' )";

$create_user_query = mysqli_query($connection, $query);
    
    confirm($create_user_query);
    echo "User created: " . " " . "<a href='users.php'>View Users</a>";
}

?>
<form action="" method="post" enctype="multipart/form-data">
	
    
    <div class="form-group">
	<label for="user_firstname">Firstname</label>
	<input type="text" class="form-control" name="user_firstname" placeholder="Enter your firstname" required>
	</div>
	

    <div class="form-group">
	<label for="user_lastname">Lastname</label>
	<input type="text" class="form-control" name="user_lastname" placeholder="Enter your lastname" required>
	</div>
    
    <div class="form-group">
    <label for="user_role">User Role</label><br>    
    <select name="user_role" id="" required>
        <option value="" disabled selected>Select options</option>
        <option value="admin">Admin</option>
        <option value="subscriber">Subscriber</option>
    
        
    </select>    
	</div>
    
	
    
<!--    <div class="form-group">
	<label for="image">Post Image</label>
	<input type="file"  name="image" >
	</div>
    -->
    <div class="form-group">
	<label for="username">Username</label>
	<input type="text" class="form-control" name="username" placeholder="Enter username" required>
	</div>

    <div class="form-group">
	<label for="user_email">Email</label>
	<input type="text" class="form-control" name="user_email" placeholder="Enter your email" required>
	</div>

    <div class="form-group">
	<label for="username">Password</label>
	<input type="password" class="form-control" name="user_password" placeholder="Enter password" required>
	</div>

    
    <input class="btn btn-primary" type="submit" name="create_user" value="Add user">
	</form>
