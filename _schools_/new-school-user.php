<?php
# _users_/new-school-user.php
?>

<div class="card border-left-primary shadow">
  <div class="card-header py-3">
    <?php AddContentTitle('New School User', true, CreateCustomURL('non-user-schools-list')); ?>
  </div><!-- .card-header -->

  <div class="card-body"><?php
    $status = '';
    if (isset($_POST['newschooluser'])) {
      if ($_POST['schoolpassword'] != $_POST['schoolconfirmpassword']) {
        $status = '<div class="alert alert-danger">Password does not match!</div>';
        include_once('new-school-user-form.php');
      } else {
        include_once('functions/database/user.php');
          
        if (DatabaseNumRows(RetrieveUser($_GET['id'])) == 0) {
          include_once('functions/database/log.php');
          $datetime = GetDateTime();

          CreateAccount($_GET['id'], $_POST['schoolemail'], HashPassword($_POST['schoolpassword']), 'school', date('Y-m-d H:i:s', strtotime('+1 YEAR', strtotime($datetime))));
          UpdateSchoolUser($_GET['id']);
          RegisteredUser($_SESSION['userid'], $_GET['id'], 'member', '1'); ?>
          <div class="alert alert-success mb-0">New school user account successfully saved!</div><?php
        } else { ?>
          <div class="alert alert-danger mb-0">School user account already exist!</div>
        <?php }
      }
    } else {
      include('new-school-user-form.php');
    } ?>
  </div><!-- .card-body -->
</div><!-- .card -->