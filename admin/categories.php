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
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
                        
                    <div class="col-xs-6">
                        <?php insert_categories(); ?>
                          
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="cat_title"> Add Category</label>
                            <input type="text" class="form-control" name="cat_title">
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="submit" value="add category">
                        
                        </div>  
                        
                    </form>    

                    <?php    //update after clicking edit button
                        
                        if(isset($_GET['edit'])){
                            
                            $cat_id = $_GET['edit'];
                            
                        include "includes/update_categories.php";
                                
                        }
                        
                    ?>
                        
                        
                        
                        
                        </div><!--Add category form-->
                        
                    <div class="col-xs-6" style="overflow-x:auto;">
                                             
                    <table class="table table-bordered table-hover" >
                        <thead>
                            <tr>
                                <th> Id </th>
                                <th> Category Title </th>
                            </tr>
                        </thead>
                        <tbody>
                
            <?php findAllCategories(); ?>
                        
                            
            <?php  deleteCategories(); ?>   
                        </tbody>

                    </table>        
                    </div>    
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
         <!-- /#page-wrapper -->

<?php include "includes/adminfooter.php"; ?>