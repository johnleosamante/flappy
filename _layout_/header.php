<?php
# _layout_/header.php

foreach ($_GET as $key => $data) {
  $url = $_GET[$key] = base64_decode(urldecode($data));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="<?php echo GetDescription(); ?>">
  <meta name="author" content="<?php echo GetAuthor(); ?>">
  <title><?php echo GetTitle($page); ?></title>
  <link rel="shorcut icon" href="<?php echo GetURL(); ?>/assets/images/Division.png">
  <link rel="stylesheet" href="<?php echo GetURL(); ?>/assets/vendor/font-awesome/css/all.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
  <link rel="stylesheet" href="<?php echo GetURL(); ?>/assets/vendor/sb-admin-2/css/sb-admin-2.min.css">
  <link rel="stylesheet" href="<?php echo GetURL(); ?>/assets/css/styles.css">