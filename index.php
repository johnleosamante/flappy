<?php
# index.php

include_once('functions/functions.php');
include_once('functions/database/database.php');
include_once('functions/database/school.php');

if ((!isset($_SESSION['userid']) || $_SESSION['userid'] == '') && (!isset($_SESSION['userportal']) || $_SESSION['userportal'] == '')) {

$page = 'Login';

include_once('layout/header.php');
?>

</head>
<body>
  <div id="layoutAuthentication" class="container min-vh-100">
    <div id="layoutAuthentication_content" class="d-flex align-items-center">
      <div class="row justify-content-center">
        <div class="card col-lg-5 o-hidden border-0 shadow-lg my-5 p-0">
          <div class="card-header p-4">
            <img src="<?php echo GetURL(); ?>/assets/images/Division.png" alt="<?php echo GetDivision(); ?>" class="d-block m-auto" width="50%">
            <h1 class="text-center mb-0"><?php echo $page; ?></h1>
          </div>

          <div class="card-body p-4">
            <?php
            
            include_once('functions/database/user.php');
            include_once('functions/database/personal.php');
            include_once('functions/strings.php');
            
            if (isset($_POST['login'])) {
              $query = AuthenticateAccount($_POST['loginemail'], HashPassword($_POST['loginpassword']));

              if (DatabaseNumRows($query) == 1) {
                $user = DatabaseFetchAssoc($query);
                $_SESSION['useremail'] = $user['username'];
                $_SESSION['userid'] = $user['id'];
                $name = RetrieveName($user['id']);

                if (DatabaseNumRows($name) > 0) {
                  $row = DatabaseFetchArray($name);
                  $_SESSION['username'] = ToName($row['lastname'], $row['firstname'], $row['middlename'], $row['extension'], true);
                } else {
                  $_SESSION['username'] = DatabaseFetchArray(RetrieveSchool($user['id']))[0];
                }

                $_SESSION['userimage'] = "data:image;base64," . base64_encode(DatabaseFetchArray(RetrieveUserImage($_SESSION['userid']))['image']);

                $_SESSION['userportal'] = $user['portal'];

                if ($user['status'] == 'inactive') {
                  $_SESSION['activate'] = true;
                  header('location:' . GetURL() . '/activate');
                } else {
                  LoginAccount($_SESSION['userid']);
                  header('location:' . GetURL());
                }
              } else { ?>
                <div class="alert alert-danger">Invalid email and password!</div><?php
              }
            }
            ?>

            <form action="" method="post" enctype="multipart/form-data" class="user">
              <div class="form-group">
                <input type="email" class="form-control form-control-user" id="inputEmail" name="loginemail" placeholder="DepEd Email Address">
              </div>

              <div class="form-group">
                <input type="password" class="form-control form-control-user" id="inputPassword" name="loginpassword" placeholder="Password">
              </div>
                      
              <div class="form-group">
                <div class="form-check small">
                  <input type="checkbox" class="form-check-input" id="inputShowPassword">
                  <label class="form-check-label" for="inputShowPassword">Show Password</label>
                </div>
              </div>
              
              <button name="login" class="btn btn-primary btn-user btn-block">Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div id="layoutAuthentication_footer">
      <?php include_once('layout/footer.php'); ?>
    </div>
  </div>

  <?php include_once('layout/javascripts.php'); ?>

  <script>
    document.getElementById('inputShowPassword').onclick = function () {
      var x = document.getElementById('inputPassword');
      x.type = x.type === 'password' ? 'text' : 'password';
    }
  </script>
<?php
} else {
  include_once('functions/database/section.php');

  if ($_SESSION['userportal'] == 'school') {
    $page = DatabaseFetchArray(RetrieveSchool($_SESSION['userid']))[0];
  } else {
    $page = DatabaseFetchArray(RetrieveSection($_SESSION['userportal']))[0];
  }

  include_once('layout/header.php');
  include_once('layout/components.php');
?>

  <link rel="stylesheet" href="<?php echo GetHostURL(); ?>/_assets_/vendor/datatables/dataTables.bootstrap4.min.css">
</head>

<body id="page-top">
  <div id="wrapper">
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <?php include_once('layout/sidebar-brand.php'); ?>
    </ul>

    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <?php include_once('layout/navbar.php'); ?>

        <div class="container-fluid mb-4">
          <?php include_once('layout/content.php'); ?>
        </div>
      </div>

      <?php include_once('layout/footer.php'); ?>
    </div>
  </div>

  <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

  <?php include_once('layout/javascripts.php'); ?>
  
  <script src="<?php echo GetURL(); ?>/assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo GetURL(); ?>/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo GetURL(); ?>/assets/vendor/sb-admin-2/js/demo/datatables-demo.js"></script>

  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="LogoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="LogoutModalLabel">Logout</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Are you sure you want to logout and exit the system?</div>
        <div class="modal-footer">
          <a class="btn btn-primary" href="<?php echo GetURL(); ?>/logout">Yes</a>
          <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
        </div>
      </div>
    </div>
  </div>
<?php } ?>

  <script>
    if (window.history.replaceState) window.history.replaceState(null, null, window.location.href);
  </script>
</body>
</html>