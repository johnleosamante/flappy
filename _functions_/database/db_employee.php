<?php
# functions/database/employee.php

function RetrieveNonUserEmployees() {
  return mysqli_query(GetConnection(), "SELECT tblpersonal.id, tblpersonal.lastname, tblpersonal.firstname, tblpersonal.middlename, tblextension.extension, tblpersonal.sex, tblschool.school AS station, tblposition.position FROM tblaccountrole INNER JOIN (((((tblpersonal INNER JOIN tblextension ON tblpersonal.extid = tblextension.id) INNER JOIN tblexperience ON tblpersonal.id = tblexperience.employeeid) INNER JOIN tblposition ON tblexperience.positionid = tblposition.id) INNER JOIN tblassignment ON tblexperience.assignmentid = tblassignment.id) INNER JOIN tblschool ON tblassignment.stationid = tblschool.id) ON tblaccountrole.userid = tblpersonal.id WHERE tblexperience.ispresent=true AND tblaccountrole.roleid=1 AND tblschool.school='' ORDER BY tblpersonal.lastname;");
}

function RetrieveEmployees() {
  return mysqli_query(GetConnection(), "SELECT tblpersonal.id, tblpersonal.lastname, tblpersonal.firstname, tblpersonal.middlename, tblextension.extension, tblpersonal.sex, tblschool.school AS station, tblposition.position FROM ((((tblpersonal INNER JOIN tblextension ON tblpersonal.extid = tblextension.id) INNER JOIN tblexperience ON tblpersonal.id = tblexperience.employeeid) INNER JOIN tblposition ON tblexperience.positionid = tblposition.id) INNER JOIN tblassignment ON tblexperience.assignmentid = tblassignment.id) INNER JOIN tblschool ON tblassignment.stationid = tblschool.id WHERE tblexperience.ispresent=true ORDER BY tblpersonal.lastname;");
}

function RetrieveEmployee($id) {
  return mysqli_query(GetConnection(), "SELECT tblpersonal.id, tblpersonal.lastname, tblpersonal.firstname, tblpersonal.middlename, tblextension.extension, tblpersonal.primaryemail AS email, tblposition.position FROM tblposition INNER JOIN ((tblpersonal INNER JOIN tblextension ON tblpersonal.extid = tblextension.id) INNER JOIN tblexperience ON tblpersonal.id = tblexperience.employeeid) ON tblposition.id = tblexperience.positionid WHERE tblexperience.ispresent=true AND tblpersonal.id='" . $id . "' LIMIT 1;");
}
?>