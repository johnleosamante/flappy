<?php
# logout/index.php

include_once('../functions/functions.php');
include_once('../functions/database/database.php');
include_once('../functions/database/user.php');

LogoutAccount($_SESSION['userid']);
session_destroy();
header('location:' . GetURL());
?>