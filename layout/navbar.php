<?php
# layout/navbar.php
?>

<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>

  <div class="d-none d-sm-inline-block mr-auto ml-md-2 my-2 my-md-0 mw-100">
    <h1 class="h6 m-0 text-uppercase text-gray-800">
      <?php echo GetTitle(); ?>
    </h1>
  </div>

  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small text-uppercase"><?php echo $_SESSION['username']; ?></span>
        <img class="img-profile rounded-circle" src="<?php echo $_SESSION['userimage']; ?>">
      </a>

      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in p-0" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="#">
          <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Profile
        </a>
        <a class="dropdown-item" href="#">
          <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i> Settings
        </a>
        <a class="dropdown-item" href="#">
          <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i> Activity Log
        </a>
        <div class="dropdown-divider m-0"></div>                     
        <a class="dropdown-item" href="<?php echo GetURL(); ?>/logout">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
        </a>
      </div>
    </li>
  </ul>
</nav>