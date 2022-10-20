<?php
# _users_/new-user-form.php
include_once('_functions_/database/db_employee.php');
include_once('_functions_/strings.php');

$row = DatabaseFetchArray(RetrieveEmployee($_GET['id']));
?>
      
<form action="" method="post" enctype="multipart/form-data">
  <?php echo $status; ?>
  <label for="employeename" class="d-inline-block">Employee</label>
  <input id="employeename" type="text" class="form-control" value="<?php echo ToName($row['lastname'], $row['firstname'], $row['middlename'], $row['extension']); ?>" readonly>
  <input type="hidden" name="employeeid" value="<?php echo $_GET['id']; ?>">

  <label for="employeeposition" class="d-inline-block mt-2">Position</label>
  <input id="employeeposition" type="text" class="form-control" value="<?php echo $row['position']; ?>" readonly>

  <label for="employeeemail" class="d-inline-block mt-2">Email Address</label>
  <input id="employeeemail" name="employeeemail" type="email" class="form-control" value="<?php echo $row['email']; ?>" required>

  <label for="employeeportal" class="d-inline-block mt-2">Portal</label>
  <select id="employeeportal" name="employeeportal" class="form-control mb-2" required>
    <option value="">Select portal</option>
    <?php
    $employeeportal = RetrieveSections();
    while ($section = DatabaseFetchArray($employeeportal)) : ?>
    <option value="<?php echo $section['id']; ?>"><?php echo $section['section']; ?></option>
    <?php endwhile; ?>
  </select>

  <label for="employeeusertype" class="d-inline-block mt-2">User Type</label>
  <select id="employeeusertype" name="employeeusertype" class="form-control mb-2" required>
    <?php
    include_once('_functions_/database/db_role.php');
    $employeerole = RetrieveRoles();
    while ($role = DatabaseFetchArray($employeerole)) : ?>
    <option class="text-capitalize" value="<?php echo $role['id'] == '1' ? '' : $role['id']; ?>"><?php echo $role['value'] == '' ? 'Select user type' : ucwords($role['value']); ?></option>
    <?php endwhile; ?>
  </select>
        
  <label for="employeepassword" class="d-inline-block mt-2">Password</label>
  <input id="employeepassword" type="password" name="employeepassword" class="form-control" placeholder="Type password" required>

  <label for="employeeconfirmpassword" class="d-inline-block mt-2">Confirm Password</label>
  <input id="employeeconfirmpassword" type="password" name="employeeconfirmpassword" class="form-control" placeholder="Retype password" required>

  <input type="submit" name="newuser" value="Save User" class="mt-3 btn btn-primary align-right w-100">
</form>