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
<?php
    
if(isset($_GET['source'])){
    
    $source = $_GET['source']; 
}
else{
    $source ='';
}
        
switch($source){
        
    case 'add_user';    
        include "includes/add_users.php";
        break;
        
    case 'edit_user';    
        include "includes/edit_user.php";
        break;
        
    default:
        include "includes/view_all_users.php";




}        
            
?>    
 
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
         <!-- /#page-wrapper -->

<?php include "includes/adminfooter.php"; ?>