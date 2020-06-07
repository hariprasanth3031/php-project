<?php include "includes/db.php"; ?>


<?php session_start(); ?>
<?php

if(isset($_POST['add_post'])){
    
        $post_title = $_POST['title'];
        $post_author = $_POST['author'];                  
        $post_category = $_POST['post_category'];
        $post_status = $_POST['post_status'];
        
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');

        move_uploaded_file($post_image_temp, "images/$post_image");


$search = "select * from categories where cat_title = '{$post_category}' ";    
$search_query = mysqli_query($connection,$search);    
    
if(mysqli_num_rows($search_query) == 0){    
$ins_query = "insert into categories(cat_title) values('{$post_category}') ";    
$insert_query = mysqli_query($connection,$ins_query);    
}
    
$find_catid = "select cat_id from categories where cat_title = '{$post_category}' ";
$find_catid_query = mysqli_query($connection,$find_catid);
    
$ro = mysqli_fetch_array($find_catid_query);
$post_category_id = $ro['cat_id'];    
    
    
$query = "insert into posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_status) ";    
        
$query .=  "values({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}' )";

$create_post_query = mysqli_query($connection, $query);
    
    
$id = mysqli_insert_id($connection);
        
$insert_user = "insert into user_post values({$_SESSION['user_id']},{$id})";    

$insert_user_query = mysqli_query($connection,$insert_user);
    
    
}

?>

<!DOCTYPE html>
<html>
<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-home.css" rel="stylesheet">

</head>    
<body>

        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./indexlogin.php">HOME</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
<!--                <?php 
                    $query = "select * from categories";
                    $select_all_categories_query = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_assoc($select_all_categories_query)){
                        $cat_title = $row['cat_title'];
                        echo "<li><a href='#'>{$cat_title}</a></li>";
                        
                    }
                        //echo "<li><a href='admin'>Admin</li>";
                ?>  
-->                    
                    <li><a href="mypost.php">My posts</a></li>
                    <li><a href="addpost.php">Add post</a></li>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="includes/logout.php"> Logout </a></li>            
                
                </ul>
            </div>
            <!-- /.navbar-collapse -->
            </div>
        <!-- /.container -->
    </nav>
<div class="container">
    <div class="row">
<div class="col-md-8">    
<form action="" method="post" enctype="multipart/form-data">
	
    <div class="form-group">
	<label for="title">Post Title</label><br>
	<input type="text" class="form-control" name="title" placeholder="Enter your post title" required>
	</div>
	
<div class="form-group">
    <label for="post_category">Post category</label><br>    
    <input type="text" class="form-control" name="post_category" placeholder="Enter post category" required>
    </div>
	
	<div class="form-group">
	<label for="author">Post Author</label><br>
	<input type="text" class="form-control" name="author" placeholder="Enter author name" required>
	</div>
    
    <div class="form-group">
    <label for="post_status">Post Status</label><br>    
    <input type="text" value="draft" class="form-control" name="post_status" required>
	</div>

    <div class="form-group">
	<label for="image">Post Image</label><br>
	<input type="file"  name="image" required>
	</div>
    
    <div class="form-group">
	<label for="post_tags">Post Tags</label><br>
	<input type="text" class="form-control" name="post_tags" placeholder="Enter related tags" required>
	</div>
    
    <div class="form-group">
	<label for="post_content">Post Content</label><br>
	<textarea class="form-control" name="post_content" id="" cols="30" rows="10" required>
    </textarea>
	</div>
    
    <input class="btn btn-primary" type="submit" name="add_post" value="Add post">
	</form>
    </div>
    </div>
    </div>
    </body>
</html>