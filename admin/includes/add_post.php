<?php

if(isset($_POST['create_post'])){

        $post_title = $_POST['title'];
        $post_author = $_POST['author'];
        $post_category_id = $_POST['post_category_id'];
        $post_status = $_POST['post_status'];
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');

        move_uploaded_file($post_image_temp, "../images/$post_image");

$query = "insert into posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_status) ";

$query .=  "values({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}' )";

$create_post_query = mysqli_query($connection, $query);
confirm($create_post_query);
echo "Post created: " . " " . "<a href='posts.php'>View Post</a>";
$id1 = mysqli_insert_id($connection);
$insert_admin = "insert into admin_post values({$_SESSION['user_id']},{$id1})";
$insert_user_query = mysqli_query($connection,$insert_admin);
}
?>
<form action="" method="post" enctype="multipart/form-data">


    <div class="form-group">
	<label for="title">Post Title</label>
	<input type="text" class="form-control" name="title" placeholder="Enter your post title" required>
	</div>

<div class="form-group">
    <label for="post_category_id">Post category Id</label><br>
    <select name="post_category_id" id="" required>

<?php

  $query = "select * from categories";
  $select_categories = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_categories)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<option value='$cat_id'>{$cat_title}</option>";
}
?>

    </select>
	</div>

	<div class="form-group">
	<label for="author">Post Author</label>
	<input type="text" class="form-control" name="author" placeholder="Enter author name" required>
	</div>

    <div class="form-group">
    <label for="post_status">Post Status</label><br>
    <select name="post_status" id="">
        <option value="" disabled selected>Select options</option>
        <option value="draft">Draft</option>
        <option value="published">Publish</option>


    </select>
	</div>


    <div class="form-group">
	<label for="image">Post Image</label>
	<input type="file"  name="image" >
	</div>

    <div class="form-group">
	<label for="post_tags">Post Tags</label>
	<input type="text" class="form-control" name="post_tags" placeholder="Enter related tags" required>
	</div>

    <div class="form-group">
	<label for="post_content">Post Content</label>
	<textarea class="form-control" name="post_content" id="" cols="30" rows="10" required>
    </textarea>
	</div>

    <input class="btn btn-primary" type="submit" name="create_post" value="Publish post">
	</form>
