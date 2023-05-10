<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");


   // check logged in
   if (isset($_SESSION['id'])) {

      // Check if delete button is clicked
      if (isset($_POST['deletebtn'])) {
         // Loop over $_POST['delete'] to get the selected student IDs
         foreach ($_POST['delete'] as $student_id => $value) {
            // Build SQL query to delete student with the given ID
            $sql = "DELETE FROM student WHERE studentid='$student_id'";
            // Execute the query
            mysqli_query($conn,$sql);
         }
      }

      header("Location: students.php");

   } else {
      header("Location: index.php");
   }

?>