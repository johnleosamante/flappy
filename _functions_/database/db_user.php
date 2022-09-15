<?php
# functions/database.user.php

function AuthenticateAccount($username, $password) {
  return mysqli_query(GetConnection(), "SELECT * FROM tbluser WHERE BINARY username= BINARY '" . $username . "' AND BINARY password= BINARY PASSWORD('" . $password . "') LIMIT 1;");
}

function ActivateAccount($password, $id) {
  mysqli_query(GetConnection(), "UPDATE tbluser SET password=PASSWORD('" . $password . "'), status='active' WHERE id='" . $id . "' LIMIT 1;") or die ('Account activation error!');
}

function LoginAccount($id) {
  mysqli_query(GetConnection(), "UPDATE tbluser SET lastlogin='" . GetDateTime() . "', activity='online' WHERE id='" . $id . "' LIMIT 1;") or die ('Account login error!');
}

function LogoutAccount($id) {
  mysqli_query(GetConnection(), "UPDATE tbluser SET activity='offline' WHERE id='" . $id . "' LIMIT 1;") or die ('Account logout error!');
}

function CreateAccount($id, $username, $password, $portal, $validity) {
  mysqli_query(GetConnection(), "INSERT INTO tbluser (`id`, `username`, `password`, `portal`, `validity`, `created`, `updated`, `status`, `activity`) VALUES ('" . $id . "', '" . $username . "', PASSWORD('" . $password . "'), '" . $portal . "', '" . $validity . "', NOW(), NOW(), 'inactive', 'offline');");
}

function UpdateAccount($id, $username, $password, $portal, $validity) {
  mysqli_query(GetConnection(), "UPDATE tbluser SET username='" . $username . "', password=PASSWORD('" . $password . "'), '" . $validity . "', updated=NOW() WHERE id='" . $id . "';");
}

function RetrieveUsersInformation($portal='') {
  return mysqli_query(GetConnection(), "SELECT tblpersonal.id, tblpersonal.lastname, tblpersonal.firstname, tblpersonal.middlename, tblextension.extension, tbluser.username, tblposition.position, tbluser.lastlogin FROM (((tblpersonal INNER JOIN tblextension ON tblpersonal.extid = tblextension.id) INNER JOIN tbluser ON tblpersonal.id = tbluser.id) INNER JOIN tblexperience ON tblpersonal.id = tblexperience.employeeid) INNER JOIN tblposition ON tblexperience.positionid = tblposition.id WHERE tblexperience.ispresent=true AND tbluser.status='active' AND tbluser.portal='" . $portal . "';");
}

function RetrieveUser($id) {
  return mysqli_query(GetConnection(), "SELECT * FROM tbluser WHERE id='" . $id . "' LIMIT 1;");
}

function RetrieveUsers($portal='') {
  return mysqli_query(GetConnection(), "SELECT * FROM tbluser WHERE `status`='active' AND portal='" . $portal . "';");
}

function RetrieveSchoolUsers() {
  return mysqli_query(GetConnection(), "SELECT tbluser.id, tblschool.school, tbluser.username, tbluser.lastlogin FROM tblschool INNER JOIN tbluser ON tblschool.schoolid = tbluser.id WHERE tbluser.portal='school' AND tbluser.status='active';");
}

function RetrieveUserImage($id) {
  return mysqli_query(GetConnection(), "SELECT * FROM tbluserimage WHERE id='" . $id . "' LIMIT 1;");
}
?>