<?php
# functions/database/school.php

# tblschool
function RetrieveSchools() {
  return mysqli_query(GetConnection(), "SELECT schoolid, school FROM tblschool WHERE schoolid<>'';");
}

function RetrieveSchool($id) {
  return mysqli_query(GetConnection(), "SELECT school FROM tblschool WHERE schoolid='" . $id . "' LIMIT 1;");
}
?>