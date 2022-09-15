<?php
include_once('_functions_/database/employee.php');
include_once('_functions_/strings.php');

$row = DatabaseFetchArray(RetrieveSchool($_GET['id']));
?>
      
<form action="" method="post" enctype="multipart/form-data">
  <?php echo $status; ?>
  <label for="schoolname" class="d-inline-block">School</label>
  <input id="schoolname" name="school" type="text" class="form-control text-uppercase" value="<?php echo $row['school']; ?>" readonly>
  <input type="hidden" name="schoolid" value="<?php echo $_GET['id']; ?>">

  <label for="schoolemail" class="d-inline-block mt-2">Email Address</label>
  <input id="schoolemail" name="schoolemail" type="email" class="form-control" value="" placeholder="schoolname@deped.gov.ph" required>
        
  <label for="schoolpassword" class="d-inline-block mt-2">Password</label>
  <input id="schoolpassword" type="password" name="schoolpassword" class="form-control" placeholder="Type password" required>

  <label for="schoolconfirmpassword" class="d-inline-block mt-2">Confirm Password</label>
  <input id="schoolconfirmpassword" type="password" name="schoolconfirmpassword" class="form-control" placeholder="Retype password" required>

  <input type="submit" name="newschooluser" value="Save School User" class="mt-3 btn btn-primary align-right w-100">
</form>