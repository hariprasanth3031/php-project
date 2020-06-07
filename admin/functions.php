<?php

function confirm($result){
        global $connection;
            
        if(!$result){
        die('query failed' . mysqli_error($connection));
    }
    
}

function insert_categories(){
    
        global $connection;
    
        if(isset($_POST['submit'])){
                                
        $cat_title = $_POST['cat_title'];
        if($cat_title == "" || empty($cat_title)){
            echo "This field should not be empty";
        }else{
        $query = "insert into categories(cat_title) value('{$cat_title}')";
                                
        $create_category_query = mysqli_query($connection,$query);
        if(!$create_category_query){
            die('Query failed' . mysqli_error($connection));
            }                                   
        }                       
    }
}


function findAllCategories(){
    
    global $connection;
    
    
    $query = "select * from categories";
    $select_categories = mysqli_query($connection, $query);            
                            
     while($row = mysqli_fetch_assoc($select_categories)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title']; 
                      
        echo "<tr>"; 
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete= {$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";
      } 
}


function deleteCategories(){
    
    global $connection;
    
if(isset($_GET['delete'])){
    
    if(isset($_SESSION['user_role'])){
        
        if($_SESSION['user_role'] == 'admin'){

    
    $the_cat_id = $_GET['delete'];
    echo $the_cat_id;
                    
            
    $find_id = "select post_id from posts where post_category_id = {$the_cat_id}";
    $find_query = mysqli_query($connection, $find_id);
    $row = mysqli_fetch_assoc($find_query);
    $del_id = $row['post_id'];     

            $del_user = "delete from user_post where post_id = {$del_id} ";        
    $del_user_query = mysqli_query($connection,$del_user);        
    $del_admin = "delete from admin_post where post_id = {$del_id} ";        
    $del_admin_query = mysqli_query($connection,$del_admin);                     
    $del_comment = "delete from comments where comment_post_id = {$del_id} ";
    $del_comment_query = mysqli_query($connection,$del_comment);             
            
    $del_query = "delete from posts where post_category_id = {$the_cat_id} ";
    $del_post_query = mysqli_query($connection,$del_query);
            
            
            
    $query = "delete from categories where cat_id = {$the_cat_id} ";
    $delete_query = mysqli_query($connection,$query);
    
    if(!$delete_query){
        die('query failed' . mysqli_error($connection));
    }        
                   
    header("location: categories.php");
     
      }            
    }
}

}








?>