<?php
# _users_/new-user.php
?>

<div class="card border-left-primary shadow">
  <div class="card-header py-3">
    <?php AddContentTitle('New User', true, CreateCustomURL('users')); ?>
  </div><!-- .card-header -->

  <div class="card-body"><?php
    $status = '';
    if (isset($_POST['newuser'])) {
      if ($_POST['employeepassword'] != $_POST['employeeconfirmpassword']) {
        $status = '<div class="alert alert-danger">Password does not match!</div>';
        include_once('new-user-form.php');
      } else {
        include_once('_functions_/database/db_user.php');
          
        if (DatabaseNumRows(RetrieveUser($_GET['id'])) == 0) {
          include_once('_functions_/database/db_accountrole.php');
          include_once('_functions_/database/db_log.php');
          $datetime = GetDateTime();

          CreateAccount($_GET['id'], $_POST['employeeemail'], HashPassword($_POST['employeepassword']), $_POST['employeeportal'], date('Y-m-d H:i:s', strtotime('+1 YEAR', strtotime($datetime))));
          UpdateAccountRole($_GET['id'], $_POST['employeeusertype']);
          RegisteredUser($_SESSION['userid'], $_GET['id'], $_POST['employeeusertype'], '1'); ?>
          <div class="alert alert-success mb-0">New user successfully saved!</div><?php
        } else { ?>
          <div class="alert alert-danger mb-0">User account already exist!</div>
        <?php }
      }
    } else {
      include('new-user-form.php');
    } ?>
  </div><!-- .card-body -->
</div><!-- .card -->