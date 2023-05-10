<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");


   // check logged in
   if (isset($_SESSION['id'])) {

      echo template("templates/partials/header.php");
      echo template("templates/partials/nav.php");

      // Build SQL statment that selects a student's modules
      $sql = "SELECT * FROM student";

      $result = mysqli_query($conn,$sql);

      $data['content'] .="<form action='deletestudents.php' method='POST'>";

      // prepare page content
      $data['content'] .= "<table border='1'>";
      $data['content'] .= "<tr><th colspan='10' align='center'>Students</th></tr>";
      $data['content'] .= "<th>Student ID</th><th>Firstname</th><th>Lastname</th><th>House</th><th>Town</th><th>County</th><th>Country</th><th>Postcode</th>";
      // Display student's information inside a table
      while($row = mysqli_fetch_array($result)) {
         $data['content'] .= "<tr><td> $row[studentid] </td>";
         $data['content'] .= "<td> $row[firstname] </td>";
         $data['content'] .= "<td> $row[lastname] </td>";
         $data['content'] .= "<td> $row[house] </td>";
         $data['content'] .= "<td> $row[town] </td><";
         $data['content'] .= "<td> $row[county] </td><";
         $data['content'] .= "<td> $row[country] </td><";
         $data['content'] .= "<td> $row[postcode] </td>";
         $data['content'] .= "<td><input type='checkbox' name='delete[$row[studentid]]' /></td></tr>";
      }
      $data['content'] .= "</table>";

      // Delete Button
      $data['content'] .="<input type='submit' name='deletebtn' value='Delete'/>";

      $data['content'] .="</form>";

      // render the template
      echo template("templates/default.php", $data);

   } else {
      header("Location: index.php");
   }

   echo template("templates/partials/footer.php");

?>