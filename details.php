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

      // build an sql statment to update the student details
      $sql = "update student set firstname ='" . $_POST['txtfirstname'] . "',";
      $sql .= "lastname ='" . $_POST['txtlastname']  . "',";
      $sql .= "house ='" . $_POST['txthouse']  . "',";
      $sql .= "town ='" . $_POST['txttown']  . "',";
      $sql .= "county ='" . $_POST['txtcounty']  . "',";
      $sql .= "country ='" . $_POST['txtcountry']  . "',";
      $sql .= "postcode ='" . $_POST['txtpostcode']  . "' ";
      $sql .= "where studentid = '" . $_SESSION['id'] . "';";
      $result = mysqli_query($conn,$sql);

      $data['content'] = "<p>Your details have been updated</p>";

   }
   else {
      // Build a SQL statment to return the student record with the id that
      // matches that of the session variable.
      $sql = "select * from student where studentid='". $_SESSION['id'] . "';";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result);

      // using <<<EOD notation to allow building of a multi-line string
      // see http://stackoverflow.com/questions/6924193/what-is-the-use-of-eod-in-php for info
      // also http://stackoverflow.com/questions/8280360/formatting-an-array-value-inside-a-heredoc
      $data['content'] = <<<EOD

   <h2>My Details</h2>
   <form name="frmLogin" action="authenticate.php" method="post">
  <div class="mb-3">
    <label for="txtfirstname" class="form-label">First Name</label>
    <input type="text" class="form-control" id="txtfirstname" name="txtfirstname" value="{$row['firstname']}">
  </div>
  <div class="mb-3">
    <label for="txtlastname" class="form-label">Surname</label>
    <input type="text" class="form-control" id="txtlastname" name="txtlastname" value="{$row['lastname']}">
  </div>
  <div class="mb-3">
    <label for="txthouse" class="form-label">Number and Street</label>
    <input type="text" class="form-control" id="txthouse" name="txthouse" value="{$row['house']}">
  </div>
  <div class="mb-3">
    <label for="txttown" class="form-label">Town</label>
    <input type="text" class="form-control" id="txttown" name="txttown" value="{$row['town']}">
  </div>
  <div class="mb-3">
    <label for="txtcounty" class="form-label">County</label>
    <input type="text" class="form-control" id="txtcounty" name="txtcounty" value="{$row['county']}">
  </div>
  <div class="mb-3">
    <label for="txtcountry" class="form-label">Country</label>
    <input type="text" class="form-control" id="txtcountry" name="txtcountry" value="{$row['country']}">
  </div>
  <div class="mb-3">
    <label for="txtpostcode" class="form-label">Postcode</label>
    <input type="text" class="form-control" id="txtpostcode" name="txtpostcode" value="{$row['postcode']}">
  </div>

  <input type="submit" name="btnlogin" class="btn btn-primary" value="submit" />
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
