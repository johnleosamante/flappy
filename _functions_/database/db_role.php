<?php
# _functions_/database/db_role.php

function RetrieveRoleID($role) {
  return mysqli_query(GetConnection(), "SELECT id FROM tblrole WHERE role='" . $role . "' LIMIT 1;");
}

function RetrieveRoles($role='') {
  return mysqli_query(GetConnection(), "SELECT id, role AS value FROM tblrole WHERE role LIKE CONCAT('%', '" . $role . "', '%') ORDER BY role ASC;");
}
?>