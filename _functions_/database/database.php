<?php
# _functions_/database/database.php

function DatabaseFetchAssoc($query) {
  return mysqli_fetch_assoc($query);
}

function DatabaseFetchArray($query) {
  return mysqli_fetch_array($query);
}

function DatabaseNumRows($query) {
  return mysqli_num_rows($query);
}

function DatabaseAffectedRows() {
  return mysqli_affected_rows(GetConnection());
}
?>