<?php
# activate/index.php
include_once('../_functions_/functions.php');

if (!isset($_SESSION['activate']) || !$_SESSION['activate']) header('location:' . GetURL());

$page = 'Activate';
include_once('../_layout_/header.php'); ?>
</head>

<body>
  <div id="layoutAuthentication" class="container">
    <div id="layoutAuthentication_content">
      <div class="row justify-content-center">
        <div class="card col-lg-5 o-hidden border-0 shadow-lg my-5 p-0">
          <div class="card-header p-4">
            <img src="<?php echo GetURL(); ?>/assets/images/Division.png" alt="<?php echo GetDivision(); ?>" class="d-block m-auto" width="50%">
            <h1 class="text-center mb-0"><?php echo $page; ?></h1>
          </div>

          <div class="card-body p-4"><?php
            if (isset($_POST['activate'])) {
              if ($_POST['newuserpassword'] != $_POST['confirmuserpassword']) { ?>
            <div class="alert alert-danger">Password does not match!</div><?php
              } else {
                $_SESSION['activate'] = false;
                include_once('../_functions_/database/database.php');
                include_once('../_functions_/database/db_user.php');
                ActivateAccount(HashPassword($_POST['newuserpassword']), $_SESSION['userid']);
                LoginAccount($_SESSION['userid']);
                header('location:' . GetURL());
              }
            } ?>

            <form action="" method="POST" enctype="multipart/form-data" class="user">
              <div class="form-group">
                <input type="email" id="inputEmail" class="form-control form-control-user" value="<?php echo $_SESSION['useremail']; ?>" disabled>
              </div>
              <div class="form-group">
                <input type="password" name="newuserpassword" id="inputPassword" class="form-control form-control-user" placeholder="New password" required>
              </div>
              <div class="form-group">
                <input type="password" name="confirmuserpassword" id="inputConfirmPassword" class="form-control form-control-user" placeholder="Retype password" required>
              </div>
              <button name="activate" class="btn btn-primary btn-user btn-block">Activate</button>
            </form><!-- .user -->
          </div><!-- .card-body -->
        </div><!-- .card -->
      </div><!-- .row -->
    </div><!-- #layoutAuthentication_content -->

    <div id="layoutAuthentication_footer">
      <?php include_once('../_layout_/footer.php'); ?>
    </div><!-- #layoutAuthentication_footer -->
  </div><!-- #layoutAuthentication -->

  <?php include_once('../_layout_s/javascripts.php'); ?>
</body>
</html>