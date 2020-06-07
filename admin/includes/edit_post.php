<?php

if(isset($_GET['p_id'])){

        if(isset($_SESSION['user_role'])){
        
        if($_SESSION['user_role'] == 'admin'){

    $the_post_id = mysqli_real_escape_string($connection,$_GET['p_id']);

   $query = "select * from posts where post_id = $the_post_id";
    $select_posts_by_id = mysqli_query($connection, $query);            
                            
     while($row = mysqli_fetch_assoc($select_posts_by_id)){
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];                  
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];
        $post_content = $row['post_content'];
            }
        }
    }
}
    

if(isset($_POST['update_post'])){
    
        $post_title = $_POST['title'];
        $post_author = $_POST['author'];                  
        $post_category_id = $_POST['post_category'];
        $post_status = $_POST['post_status'];
        
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
    
    move_uploaded_file($post_image_temp, "../images/$post_image");
    
    if(empty($post_image)){
        
        $query = "SELECT * FROM posts where post_id = $the_post_id ";
        $select_image = mysqli_query($connection,$query);
        
        while($row = mysqli_fetch_assoc($select_image)){
            $post_image = $row['post_image'];
        }
    
    }
    
    $query = "update posts set ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_category_id = '{$post_category_id}', ";
    $query .= "post_date = now(), ";
    $query .= "post_author = '{$post_author}', ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_tags = '{$post_tags}', ";
    $query .= "post_image = '{$post_image}', ";
    $query .= "post_content = '{$post_content}' ";
    $query .= "where post_id = {$the_post_id} ";

    $update_post = mysqli_query($connection,$query);
    confirm($update_post);
}
         
?>
<form action="" method="post" enctype="multipart/form-data">
	
    
    <div class="form-group">
	<label for="title">Post Title</label>
	<input value="<?php echo $post_title; ?>" type="text" class="form-control" name="title" placeholder="Enter your post title">
	</div>
	
	<div class="form-group">
    <label for="post_category">Post category Title</label><br>    
    <select name="post_category" id="">

        
<?php
        
  $query = "select * from categories";
  $select_categories = mysqli_query($connection, $query);           //confirm($select_categories); 
                            
while($row = mysqli_fetch_assoc($select_categories)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];       

        if($cat_id == $post_category_id){
            echo "<option selected value='{$cat_id}'>{$cat_title}</option>";
        }else{
            echo "<option value='{$cat_id}'>{$cat_title}</option>";    
        }   

}      
?>        
        
    </select>    
	</div>
	
	<div class="form-group">
	<label for="author">Post Author</label>
	<input value="<?php echo $post_author; ?>" type="text" class="form-control" name="author" placeholder="Enter author name">
	</div>

    <div class="form-group">
    <label for="post_status">Post Status</label><br>    
    <select name="post_status" id="">

    
    <?php
        echo "<option value='{$post_status}'>{$post_status}</option>"; ?>
        
        <?php    
        if($post_status == 'draft'){
            echo "<option value='published'>publish</option>";
        }else{
            echo "<option value='draft'>Draft</option>";   
        }
        ?>
        
        
        
    </select>    
	</div>
        
    
    
    
<!--    <div class="form-group">
	<label for="post_status">Post Status</label>
	<input value="<?php echo $post_status; ?>" type="text" class="form-control" name="post_status" >
	</div>
-->    
    <div class="form-group">
    <img width="100" src="../images/<?php echo $post_image; ?>" alt="">
    </div>
    <div class="form-group">
	<label for="image">Post Image</label>
	<input type="file"  name="image" >
	</div>
    
    <div class="form-group">
	<label for="post_tags">Post Tags</label>
	<input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags" placeholder="Enter related tags">
	</div>
    
    <div class="form-group">
	<label for="post_content">Post Content</label>
	<textarea class="form-control" name="post_content" id="" cols="30" rows="10">
    <?php echo $post_content; ?>    
    </textarea>
	</div>
    
    <input class="btn btn-primary" type="submit" name="update_post" value="Update post">
	</form>
