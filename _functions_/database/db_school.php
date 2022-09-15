<?php
# _functions_/database/db_school.php

# tblschool
function RetrieveSchools() {
  return mysqli_query(GetConnection(), "SELECT schoolid, school FROM tblschool WHERE schoolid<>'';");
}

function RetrieveSchool($id) {
  return mysqli_query(GetConnection(), "SELECT school FROM tblschool WHERE schoolid='" . $id . "' LIMIT 1;");
}

function RetrieveNonUserSchools() {
  return mysqli_query(GetConnection(), "SELECT tblschool.schoolid, tblschool.school, tbladdress.lot, tbladdress.street, tbladdress.subdivision, tbladdress.barangay, tblcity.city, tbldistrict.district, tblcluster.cluster FROM (tblcluster INNER JOIN tbldistrict ON tblcluster.districtid = tbldistrict.id) INNER JOIN (tblcity INNER JOIN (tbladdress INNER JOIN tblschool ON tbladdress.id = tblschool.addressid) ON tblcity.id = tbladdress.cityid) ON tblcluster.ID = tblschool.clusterid WHERE tblschool.schoolid != '' AND tblschool.userid='' ORDER BY `tblschool`.`school` ASC;");
}

function UpdateSchoolUser($id) {
  mysqli_query(GetConnection(), "UPDATE tblschool SET userid='" . $id . "' WHERE schoolid='". $id . "' LIMIT 1;");
}
?>