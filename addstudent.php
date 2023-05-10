<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// check logged in
if (isset($_SESSION['id'])) {

   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

   // if the form has been submitted
   if (isset($_POST['submit'])) {

      // retrieve the form data and sanitize it
      $studentid = mysqli_real_escape_string($conn, $_POST['studentid']);
      $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
      $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
      $house = mysqli_real_escape_string($conn, $_POST['house']);
      $town = mysqli_real_escape_string($conn, $_POST['town']);
      $county = mysqli_real_escape_string($conn, $_POST['county']);
      $country = mysqli_real_escape_string($conn, $_POST['country']);
      $postcode = mysqli_real_escape_string($conn, $_POST['postcode']);
      $password = mysqli_real_escape_string($conn, $_POST['password']);

      // hash the password before storing it in the database
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      // build an sql statement to insert the new student details
      $sql = "INSERT INTO student (studentid, firstname, lastname, house, town, county, country, postcode, password)
              VALUES ('$studentid','$firstname', '$lastname', '$house', '$town', '$county', '$country', '$postcode', '$hashed_password')";

      // execute the sql statement
      $result = mysqli_query($conn, $sql);

      if ($result) {
         // if student has successfully been added
         $data['content'] = "<p>New student record has been added</p>";
      } else {
         // if there is an error in adding student
         $data['content'] = "<p>Error: " . mysqli_error($conn) . "</p>";
      }

   } else {
      // if the form has not been submitted yet
      $data['content'] = <<<EOD
         <h2>Add New Student</h2>
         <form name="frmdetails" action="" method="post">
            Student ID: <input name="studentid" type="text" value="" /><br />
            First Name: <input name="firstname" type="text" value="" /><br />
            Last Name: <input name="lastname" type="text" value="" /><br />
            Number and Street: <input name="house" type="text" value="" /><br />
            Town: <input name="town" type="text" value="" /><br />
            County: <input name="county" type="text" value="" /><br />
            Country: <input name="country" type="text" value="" /><br />
            Postcode: <input name="postcode" type="text" value="" /><br />
            Password: <input name="password" type="password" value="" /><br />
            <input type="submit" value="Save" name="submit" />
         </form>
      EOD;
   }

   // render the template
   echo template("templates/default.php", $data);

} else {
   header("Location: index.php");
}

echo template("templates/partials/footer.php");

?>