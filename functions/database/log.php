<?php

function CreateLog($userid, $targetid, $operation, $clientid) {
  mysqli_query(GetConnection(), "INSERT INTO tbllog (`datetime`, `userid`, `targetid`, `operation`, `clientid`) VALUES (NOW(), '" . $userid . "', '" . $targetid . "', '" . $operation . "', '" . $clientid . "');");
}

function RegisteredUser($userid, $targetid, $role, $clientid) {
  CreateLog($userid, $targetid, 'registered ' . $role, $clientid);
}

function UpdatedUser($userid, $targetid, $role, $clientid) {
  CreateLog($userid, $targetid, 'updated ' . $role, $clientid);
}

function DeletedUser($userid, $username, $clientid) {
  CreateLog($userid, '1', 'deleted ' . $username, $clientid);
}
?>