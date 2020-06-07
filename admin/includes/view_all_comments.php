           <div class="col-lg-12" style="overflow-x:auto;">            
                <table class="table table-bordered table-hover">
                    <thead>        
                        <tr>
                            <th>Id</th>
                            <th>Author</th>
                            <th>Comments</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>In Response to</th>
                            <th>Date</th>
                            <th>Approve</th>
                            <th>Unapprove</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        
<?php                        
    
    $query = "select * from comments";
    $select_comments = mysqli_query($connection, $query);            
                            
     while($row = mysqli_fetch_assoc($select_comments)){
        $comment_id = $row['comment_id'];
        $comment_author = $row['comment_author'];              
        $comment_email = $row['comment_email'];
        $comment_post_id = $row['comment_post_id'];
        $comment_content = $row['comment_content'];
        $comment_status = $row['comment_status'];
        $comment_date = $row['comment_date'];
     
         
        echo "<tr>";
        echo "<td>$comment_id</td>";
        echo "<td>$comment_author</td>"; 
        echo "<td>$comment_content</td>"; 
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
         
         
        echo "<td>$comment_email</td>"; 
        echo "<td>$comment_status</td>";
         
         
        $query = "select * from posts where post_id = $comment_post_id "; 
        $select_post_id_query = mysqli_query($connection,$query);
         
        while($row = mysqli_fetch_assoc($select_post_id_query)){
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            
            echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>" ;
        } 
         
         
        echo "<td>$comment_date</td>"; 
        echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>"; 
        echo "<td><a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>"; 
         
         
         echo "<td><a href='comments.php?delete=$comment_id'>Delete</a></td>"; 
        echo "</tr>";
     }
                        
    ?>                   
    
                    </tbody>  
                </table>
               
<?php               
               
if(isset($_GET['unapprove'])){
    
    if(isset($_SESSION['user_role'])){
        
        if($_SESSION['user_role'] == 'admin'){
    
    $the_comment_id = mysqli_real_escape_string($connection,$_GET['unapprove']);
    
    $query = "update comments set comment_status = 'unapproved' where comment_id = $the_comment_id ";
    $unapprove_comment_query = mysqli_query($connection, $query);
    header("location: comments.php");
        }
    }
}

if(isset($_GET['approve'])){
    
    if(isset($_SESSION['user_role'])){
        
        if($_SESSION['user_role'] == 'admin'){    
    
    $the_comment_id = mysqli_real_escape_string($connection,$_GET['approve']);
    
    $query = "update comments set comment_status = 'approved' where comment_id = $the_comment_id ";
    $approve_comment_query = mysqli_query($connection, $query);
    header("location: comments.php");
        }
    }
}
               
if(isset($_GET['delete'])){
 
    if(isset($_SESSION['user_role'])){
        
        if($_SESSION['user_role'] == 'admin'){
    
    $the_comment_id = mysqli_real_escape_string($connection,$_GET['delete']);
    
    $query = "delete from comments where comment_id = {$the_comment_id} ";
    $delete_comment_query = mysqli_query($connection, $query);
    header("location: comments.php");
        }
    }

}               
               
?>               
                         
                
            </div>                             