<?php
function CreateAccountRole($userid, $roleid) {
  mysqli_query(GetConnection(), "INSERT INTO tblaccountrole (userid, roleid) VALUES ('" . $userid . "', '" . $roleid . "');");
}

function UpdateAccountRole($userid, $roleid) {
  mysqli_query(GetConnection(), "UPDATE tblaccountrole SET roleid='" . $roleid . "' WHERE userid='" . $userid . "';");
}
?>