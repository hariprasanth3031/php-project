           <div class="col-lg-12" style="overflow-x:auto;">            
                <table class="table table-bordered table-hover">
                    <thead>        
                        <tr>
                            <th>Id</th>
                            <th>Username</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Email</th>
                            <th>Role</th>

                        </tr>
                    </thead>
                    <tbody>
                        
<?php                        
    $query = "select * from users";
    $select_comments = mysqli_query($connection, $query);            
                            
     while($row = mysqli_fetch_assoc($select_comments)){
        $user_id = $row['user_id'];
        $username = $row['username']; 
        $user_firstname = $row['user_firstname'];           $user_password = $row['user_password'];   
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];
        $user_image = $row['user_image'];
     
         
        echo "<tr>";
        echo "<td>$user_id</td>";
        echo "<td>$username</td>"; 
        echo "<td>$user_firstname</td>"; 
/*    
        $query_rel = "select * from categories where cat_id = {$post_category_id} ";
        //echo $post_category_id."<br>";
        $select_categories_id = mysqli_query($connection, $query_rel);            
        if(!$select_categories_id){
            die('query failed' . mysqli_error($connection));
        }                    
        while($rows = mysqli_fetch_assoc($select_categories_id)){
                $cat_id = $rows['cat_id'];
                $cat_title = $rows['cat_title'];            
         
          
        echo "<td>$cat_title</td>"; 
        }
  */
         
         
        echo "<td>$user_lastname</td>"; 
        echo "<td>$user_email</td>"; 
        echo "<td>$user_role</td>";
         
/*        $query = "select * from posts where post_id = $comment_post_id "; 
        $select_post_id_query = mysqli_query($connection,$query);
         
        while($row = mysqli_fetch_assoc($select_post_id_query)){
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            
            echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>" ;
        } 
  */       
         
//        echo "<td>$comment_date</td>"; 
        echo "<td><a href='users.php?change_to_admin={$user_id}'>Admin</a></td>"; 
        echo "<td><a href='users.php?change_to_subscriber={$user_id}'>Subscriber</a></td>"; 
        echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>" ;
         
         echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>"; 
        echo "</tr>";
     }
                        
    ?>                   
    
                    </tbody>  
                </table>
               
<?php               
               
if(isset($_GET['change_to_admin'])){
    
    if(isset($_SESSION['user_role'])){
        
        if($_SESSION['user_role'] == 'admin'){
            
    $the_user_id = $_GET['change_to_admin'];
    
    $query = "update users set user_role = 'admin' where user_id = $the_user_id ";
    $change_admin_query = mysqli_query($connection, $query);
    header("location: users.php");
        }
    }
}

if(isset($_GET['change_to_subscriber'])){
    
    if(isset($_SESSION['user_role'])){
        
        if($_SESSION['user_role'] == 'admin'){
    
    $the_user_id = $_GET['change_to_subscriber'];
    
    $query = "update users set user_role = 'subscriber' where user_id = $the_user_id ";
    $change_subscriber_query = mysqli_query($connection, $query);
    header("location: users.php");
        }
    }
}
               
if(isset($_GET['delete'])){
    
    if(isset($_SESSION['user_role'])){
        
        if($_SESSION['user_role'] == 'admin'){
    
    $the_user_id = mysqli_real_escape_string($connection, $_GET['delete']);
            
    if($the_user_id == $_SESSION['user_id']){
        //echo  "yes admin is deleted";   
        $_SESSION['username'] = null;
        $_SESSION['firstname'] = null;
        $_SESSION['lastname'] = null;
        $_SESSION['user_role'] = null;
        $_SESSION['user_id'] = null;

        $del = "delete from admin_post where user_id = {$the_user_id} ";
        $del_query = mysqli_query($connection,$del);
        
        $query = "delete from users where user_id = {$the_user_id} ";
            $delete_user_query = mysqli_query($connection, $query);

header("Location: ../index.php");


    }else{

    $del = "delete from user_post where user_id = {$the_user_id} ";
    $del_query = mysqli_query($connection,$del);
        
    $query = "delete from users where user_id = {$the_user_id} ";
    $delete_user_query = mysqli_query($connection, $query);
    header("Location: users.php");
            }    
        }
    }
}               
               
?>               
                         
                
            </div>                             