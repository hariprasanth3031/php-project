<?php include "includes/adminheader.php"; ?>

    <div id="wrapper">


        <!-- Navigation -->
        <?php include "includes/adminnavigation.php" ?>


      <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin
                            <small><?php
                              echo $_SESSION['username'];
                            ?></small>
                        </h1>

                    </div>
                </div>

<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

    <?php

        $query = "select * from users";
        $select_all_user = mysqli_query($connection,$query); $user_counts = mysqli_num_rows($select_all_user);
        echo "<div class='huge'>{$user_counts}</div>"
    ?>

                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

    <?php

        $query = "select * from posts";
        $select_all_post = mysqli_query($connection,$query); $post_counts = mysqli_num_rows($select_all_post);
        echo "<div class='huge'>{$post_counts}</div>"
    ?>

                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

    <?php

        $query = "select * from comments";
        $select_all_comments = mysqli_query($connection,$query);
        $comment_counts = mysqli_num_rows($select_all_comments);

        echo "<div class='huge'>{$comment_counts}</div>"
    ?>

                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

    <?php

        $query = "select * from categories";
        $select_all_category = mysqli_query($connection,$query);
        $category_counts = mysqli_num_rows($select_all_category);
        echo "<div class='huge'>{$category_counts}</div>"
    ?>
                        <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                <!-- /.row -->

<?php

    $draft_query = "select * from posts where post_status = 'draft' ";
    $select_all_draft_posts = mysqli_query($connection, $draft_query);
    $draft_counts = mysqli_num_rows($select_all_draft_posts);

    $pub_query = "select * from posts where post_status = 'published' ";
    $select_all_pub_posts = mysqli_query($connection, $pub_query);
    $pub_counts = mysqli_num_rows($select_all_pub_posts);
    $approve_query = "select * from comments where comment_status = 'approved' ";
    $select_all_approve_comments = mysqli_query($connection, $approve_query);
    $app_counts = mysqli_num_rows($select_all_approve_comments);

    $unapprove_query = "select * from comments where comment_status = 'approved' ";
    $select_all_approve_comments = mysqli_query($connection, $unapprove_query);
    $unapp_counts = mysqli_num_rows($select_all_approve_comments);
    $admin_query = "select * from users where user_role = 'admin' ";
    $select_all_admin = mysqli_query($connection, $admin_query);
    $admin_counts = mysqli_num_rows($select_all_admin);

    $sub_query = "select * from users where user_role = 'subscriber' ";
    $select_all_sub = mysqli_query($connection, $sub_query);
    $sub_counts = mysqli_num_rows($select_all_sub);
?>


       <div class="row>">

<script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'count'],

    <?php

        $element_text = ['Active posts', 'Draft posts', 'Admins', 'Subscribers', 'Approved comments', 'Unapproved comments', 'Categories'];

        $element_count = [$pub_counts, $draft_counts, $admin_counts, $sub_counts, $app_counts, $unapp_counts, $category_counts];



        for($i = 0; $i < 7; $i++){

        echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}]," ;

        }


    ?>

        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>

<div id="columnchart_material" style="width: 1000px ; height: 500px;"></div>
        </div>





            </div>
            <!-- /.container-fluid -->

        </div>
         <!-- /#page-wrapper -->

<?php include "includes/adminfooter.php"; ?>
