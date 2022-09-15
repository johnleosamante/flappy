<?php
# _functions_/database/db_section.php

# tblsection
function RetrieveSections() {
  return mysqli_query(GetConnection(), "SELECT * FROM tblsection ORDER BY section ASC;");
}

function RetrieveSection($id) {
  return mysqli_query(GetConnection(), "SELECT section FROM tblsection WHERE id='" . $id . "' LIMIT 1;");
}
?>