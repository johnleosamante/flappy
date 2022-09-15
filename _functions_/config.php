<?php
# _functions_/config.php

# CONSTANTS
define('DB_SERVER', '124.106.213.148');
define('DB_USER', 'web_user_2022');
define('DB_PASSWORD', 'u78Ee71FEY&T6krB9TCu');
define('DB_NAME', 'sdodipologdb');
define('DB_SERVER_PORT', '3306');
define('PASSWORD_SALT_PREFIX', '5d0');
define('PASSWORD_SALT_SUFFIX', 'd1p0706');
define('TITLE', 'DepEd Dipolog City Data Management System');
define('ALIAS', 'DCDMS');
define('DEPARTMENT', 'Department of Education');
define('DIVISION', 'Dipolog City Schools Division');
define('CITY', 'Dipolog City');
define('DIVISION_CODE', '143');
define('DESCRIPTION', '');
define('AUTHOR', '');

# URL
$PROTOCOL = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
$HOST_URL = $PROTOCOL . $_SERVER['HTTP_HOST'];
$URL = $HOST_URL . '/' . strtolower(ALIAS);

# DATABASE CONNECTION
$CONNECTION = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME, DB_SERVER_PORT) or die('Connection Error!');
?>