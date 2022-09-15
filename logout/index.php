<?php
# logout/index.php
include_once('../_functions_/functions.php');
include_once('../_functions_/database/database.php');
include_once('../_functions_/database/db_user.php');

LogoutAccount($_SESSION['userid']);
session_destroy();
header('location:' . GetURL());
?>