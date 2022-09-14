<?php
# functions/database/transaction.php

# tbltransaction
function RetrieveTransactions($id) {
  return mysqli_query(GetConnection(), "SELECT * FROM tbltransaction WHERE id LIKE '%" . $id . "%';");
}

function RetrieveTransaction($id) {
  return mysqli_query(GetConnection(), "SELECT * FROM tbltransaction WHERE id='" . $id . "' LIMIT 1;");
}

function CreateTransaction($id, $description, $section, $user, $datetime, $purpose) {
  mysqli_query(GetConnection(), "INSERT INTO tbltransaction VALUES ('" . $id . "', '" . $description . "', '" . $section . "', '" . $user . "', '" . $datetime . "', '" . $purpose . "');");
}

# tbltransaction INNER JOIN tbltransactionlog
function RetrieveIncomingTransactions($section) {
  return mysqli_query(GetConnection(), "SELECT tbltransaction.id, tbltransaction.description, tbltransactionlog.from, tbltransactionlog.to, tbltransactionlog.user, tbltransactionlog.datetime, tbltransaction.purpose, tbltransactionlog.status FROM tbltransactionlog INNER JOIN tbltransaction ON tbltransactionlog.code = tbltransaction.id WHERE tbltransactionlog.to='" . $section . "' AND (tbltransactionlog.status='ongoing' OR tbltransactionlog.status='forwarded') AND tbltransactionlog.remark='new';");
}

function RetrieveIncomingTransaction($id) {
  return mysqli_query(GetConnection(), "SELECT tbltransaction.id, tbltransaction.description, tbltransactionlog.from, tbltransactionlog.to, tbltransactionlog.user, tbltransactionlog.datetime, tbltransaction.purpose, tbltransactionlog.status FROM tbltransactionlog INNER JOIN tbltransaction ON tbltransactionlog.code = tbltransaction.id WHERE tbltransaction.id='" . $id . "' AND (tbltransactionlog.status='ongoing' OR tbltransactionlog.status='forwarded') AND tbltransactionlog.remark='new';");
}

function RetrievePendingTransactions($section) {
  return mysqli_query(GetConnection(), "SELECT tbltransaction.id, tbltransaction.description, tbltransactionlog.from, tbltransactionlog.to, tbltransactionlog.user, tbltransactionlog.datetime, tbltransaction.purpose, tbltransactionlog.status FROM tbltransactionlog INNER JOIN tbltransaction ON tbltransactionlog.code = tbltransaction.id WHERE tbltransactionlog.to='" . $section . "' AND tbltransactionlog.status='received' AND tbltransactionlog.remark='new';");
}

function RetrievePendingTransaction($id) {
  return mysqli_query(GetConnection(), "SELECT tbltransaction.id, tbltransaction.description, tbltransactionlog.from, tbltransactionlog.to, tbltransactionlog.user, tbltransactionlog.datetime, tbltransaction.purpose, tbltransactionlog.status FROM tbltransactionlog INNER JOIN tbltransaction ON tbltransactionlog.code = tbltransaction.id WHERE tbltransaction.id='" . $id . "' AND tbltransactionlog.status='received' AND tbltransactionlog.remark='new';");
}

function RetrieveOutgoingTransactions($section) {
  return mysqli_query(GetConnection(), "SELECT tbltransaction.id, tbltransaction.description, tbltransactionlog.from, tbltransactionlog.to, tbltransactionlog.user, tbltransactionlog.datetime, tbltransaction.purpose, tbltransactionlog.status FROM tbltransactionlog INNER JOIN tbltransaction ON tbltransactionlog.code = tbltransaction.id WHERE tbltransactionlog.from='" . $section . "' AND (tbltransactionlog.status='ongoing' OR tbltransactionlog.status='forwarded') AND tbltransactionlog.remark='new';");
}

function RetrieveCompletedTransactions($section='') {
  if ($section == '') {
    $sql = "SELECT tbltransaction.id, tbltransaction.description, tbltransaction.datetime AS `postedon`, tbltransactionlog.datetime AS `completedon` FROM tbltransactionlog INNER JOIN tbltransaction ON tbltransactionlog.code = tbltransaction.id WHERE tbltransactionlog.status='approved' AND tbltransactionlog.remark='done';";
  } else {
    $sql = "SELECT tbltransaction.id, tbltransaction.description, tbltransaction.datetime AS `postedon`, tbltransactionlog.datetime AS `completedon` FROM tbltransactionlog INNER JOIN tbltransaction ON tbltransactionlog.code = tbltransaction.id WHERE tbltransaction.section='" . $section . "' AND tbltransactionlog.status='approved' AND tbltransactionlog.remark='done';";
  }
  return mysqli_query(GetConnection(), $sql);
}

function RetrieveOngoingTransactions($section='') {
  if ($section == '') {
    $sql = "SELECT tbltransaction.id, tbltransaction.description, tbltransaction.section, tbltransactionlog.from, tbltransactionlog.to, tbltransactionlog.user, tbltransactionlog.datetime, tbltransaction.purpose, tbltransactionlog.status FROM tbltransactionlog INNER JOIN tbltransaction ON tbltransactionlog.code = tbltransaction.id WHERE tbltransactionlog.status<>'approved' AND tbltransactionlog.remark='new';";
  } else {
    $sql = "SELECT tbltransaction.id, tbltransaction.description, tbltransactionlog.from, tbltransactionlog.to, tbltransactionlog.user, tbltransactionlog.datetime, tbltransaction.purpose, tbltransactionlog.status FROM tbltransactionlog INNER JOIN tbltransaction ON tbltransactionlog.code = tbltransaction.id WHERE tbltransaction.section='" . $section . "' AND tbltransactionlog.status<>'approved' AND tbltransactionlog.remark='new';";
  }
  return mysqli_query(GetConnection(), $sql);
}

function RetrieveReceivedTransactions($section) {
  return mysqli_query(GetConnection(), "SELECT tbltransaction.id, tbltransaction.description, tbltransactionlog.from, tbltransactionlog.to, tbltransactionlog.user, tbltransactionlog.datetime, tbltransaction.purpose, tbltransactionlog.status FROM tbltransactionlog INNER JOIN tbltransaction ON tbltransactionlog.code = tbltransaction.id WHERE tbltransactionlog.to='" . $section . "' AND tbltransactionlog.status='received';");
}

function RetrieveReceivedTransaction($id) {
  return mysqli_query(GetConnection(), "SELECT tbltransaction.id, tbltransaction.description, tbltransactionlog.from, tbltransactionlog.to, tbltransactionlog.user, tbltransactionlog.datetime, tbltransaction.purpose, tbltransactionlog.status FROM tbltransactionlog INNER JOIN tbltransaction ON tbltransactionlog.code = tbltransaction.id WHERE tbltransaction.id='" . $id . "' AND tbltransactionlog.status='received';");
}

#tbltransactionlog
function CreateTransactionLog($datetime, $user, $from, $to, $code, $status, $remark='new') {
  mysqli_query(GetConnection(), "INSERT INTO tbltransactionlog (`datetime`, `user`, `from`, `to`, `code`, `status`, `remark`) VALUES ('" . $datetime . "', '" . $user . "', '" . $from . "', '" . $to . "', '" . $code . "', '" . $status . "', '" . $remark . "');");
}

function UpdateTransactionLog($code) {
  mysqli_query(GetConnection(), "UPDATE tbltransactionlog SET remark='done' WHERE remark='new' AND code='" . $code . "';");
}

function RetrieveTransactionLog($id) {
  return mysqli_query(GetConnection(), "SELECT * FROM tbltransactionlog WHERE code='" . $id . "' ORDER BY datetime;");
}
?>