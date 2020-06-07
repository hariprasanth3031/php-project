<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php
    if(isset($_POST['submit'])){

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];

        $sql_u = "SELECT * FROM users WHERE username='$username'";
      	$sql_e = "SELECT * FROM users WHERE user_email='$email'";
      	$res_u = mysqli_query($connection, $sql_u);
      	$res_e = mysqli_query($connection, $sql_e);
       if (mysqli_num_rows($res_u) > 0 || mysqli_num_rows($res_e) > 0)
       {
        	  $message = "Sorry... username/mail already taken";
       }
       else
       {

    if(!empty($username) && !empty($email) && !empty($password) && !empty($firstname) && !empty($lastname)){

    $username = mysqli_real_escape_string($connection, $username);
    $email = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT randSalt from users";
    $select_randsalt_query = mysqli_query($connection,$query); if(!$select_randsalt_query){
        die('query failed' . mysqli_error($connection));
    }
    $row = mysqli_fetch_array($select_randsalt_query);
    $salt = $row['randSalt'];
    $password = crypt($password, $salt);

            $query = "insert into users(username, user_firstname, user_lastname, user_email, user_password, user_role) ";
            $query .= "values('{$username}','{$firstname}','{$lastname}','{$email}','{$password}','subscriber')";
            $register_user_query = mysqli_query($connection, $query);
            if(!$register_user_query)
            {
                die('query failed' . mysqli_error($connection) . ' ' . mysqli_errno($connection));
            }

            $message = "Your registration has been submitted";
        }


else if(empty($username) && !empty($email) && !empty($password) && !empty($firstname) && !empty($lastname))
  {
        $message = "fields cannot be empty";
  }
}}else{
        $message = "";
    }
?>

    <!-- Navigation -->

    <?php  include "includes/navigation.php"; ?>


    <!-- Page Content -->
    <div class="container">

<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <h6 class="text-center"><?php echo $message; ?></h6>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                        <div class="form-group">
                            <label for="firstname" class="sr-only">firstname</label>
                            <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter your Firstname">
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="sr-only">username</label>
                            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter your Lastname">
                        </div>

                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>

                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>

                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
