<?php
# layout/sidebar-brand.php
?>

<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo GetURL(); ?>">
  <img class="sidebar-brand-icon" src="<?php echo GetHostURL(); ?>/_assets_/images/Division.png" title="<?php echo GetDivision(); ?>" width="60">
  <div class="sidebar-brand-text mx-3" title="<?php echo GetTitle(); ?>"><?php echo GetAlias(); ?></div>
</a>

<hr class="sidebar-divider my-0">

<?php AddNavigationItem(!isset($url), GetURL(), 'Dashboard','fa-tachometer-alt'); ?>

<hr class="sidebar-divider d-none d-md-block my-0">

<?php 
  AddNavigationItem(isset($url) && $url == 'transactions', CreateCustomURL('transactions'), 'Transactions', 'fa-exchange-alt');
  
  if (isset($_SESSION['userportal']) && $_SESSION['userportal'] == 'ict') {
    AddNavigationItem(isset($url) && $url == 'users', CreateCustomURL('users'), 'Users', 'fa-user');
  }
?>