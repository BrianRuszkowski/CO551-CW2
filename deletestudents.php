<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");


   // check logged in
   if (isset($_SESSION['id'])) {

    var_dump($_POST['students']);
    die();

    // loop over $_POST['students'] - foreach()
    // build sql query to delete item

    //   $sql = "SELECT * FROM student";

    //   $result = mysqli_query($conn,$sql);

    $result = mysqli_query($conn,$sql);

    header("Location: students.php");

   } else {
      header("Location: index.php");
   }

?>