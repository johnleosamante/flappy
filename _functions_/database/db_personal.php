<?php
# _functions_/database/db_personal.php

# tblpersonal INNER JOIN tblextension
function RetrieveName($id) {
  return mysqli_query(GetConnection(), "SELECT tblpersonal.id, tblpersonal.lastname, tblpersonal.firstname, tblpersonal.middlename, tblextension.extension FROM tblpersonal INNER JOIN tblextension ON tblpersonal.extid = tblextension.id WHERE tblpersonal.id='" . $id . "' LIMIT 1;");
}
?>