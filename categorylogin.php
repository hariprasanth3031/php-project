<?php include "includes/db.php"; ?>
<?php include "includes/headerlogin.php"; ?>


    <!-- Navigation -->
<?php include "includes/navigationlogin.php"; ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
<?php
            if(isset($_GET['category'])){
                
                $post_category_id = $_GET['category']; 
            }    
                
                
                
                    $query = "select * from posts where post_category_id = $post_category_id and post_status = 'published' ";
                    $select_all_posts_query = mysqli_query($connection,$query);
                
                    if(mysqli_num_rows($select_all_posts_query) == 0){
                        echo "<h2 class='text-center'>NO POSTS PUBLISHED! </h2>";
                    }
                else{
                    while($row = mysqli_fetch_assoc($select_all_posts_query)){
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];           //Dei gokul ithu vanthu database la image column la image name potuko and itho athoda name
                        $post_content = substr($row['post_content'],0,70);
                    
                    ?>    

                <!-- First Blog Post -->
                <h2>
                    <a href="postlogin.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="#"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">   <!--Dei ithu vanthu antha image name eduthu search panna da-->
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="postlogin.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
        
            <?php } }?>


            </div>

            
            <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebarlogin.php"; ?>    
            
        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php"; ?>