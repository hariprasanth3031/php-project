<?php include "includes/db.php"; ?>

<?php 

$query = "select * from fun where value = 10 ";
$result = mysqli_query($connection,$query);

if(isset($result)){
   echo "found"; 
}else{
    echo "not found";
}


?>



