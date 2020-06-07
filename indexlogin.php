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
                    $query = "select * from posts where post_status = 'published' ";
                    $select_all_posts_query = mysqli_query($connection,$query);
                    if(mysqli_num_rows($select_all_posts_query) == 0){
                        echo "<h2 class='text-center'> NO POSTS PUBLISHED! </h2>";
                    }
                else{
                    while($row = mysqli_fetch_assoc($select_all_posts_query)){
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];     $post_content = substr($row['post_content'],0,70);
                        $post_status = $row['post_status'];
                    
                            
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
                <a href="postlogin.php?p_id=<?php echo $post_id; ?>">
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">   
                </a>    
                <hr>
                <p><?php echo $post_content ?></p>
                
                <a href="postlogin.php?p_id=<?php echo $post_id; ?>" class="btn btn-primary">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
        
            <?php } } ?>


            </div>

            
            <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebarlogin.php"; ?>    
            
        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php"; ?>