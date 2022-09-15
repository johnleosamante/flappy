<?php
# _transactions_/transactions.php
include_once('_functions_/database/db_transaction.php');

AddContentTitle('Transactions', true, CreateCustomURL('new-transaction'), 'New Transaction', 'fa-plus');
?>

<div class="row mt-4">
  <?php
  AddCard('Incoming Transactions', CreateCustomURL('incoming-transactions'), 'fa-file-download', 'success', true, DatabaseNumRows(RetrieveIncomingTransactions($_SESSION['userportal'])));

  AddCard('Pending Transactions', CreateCustomURL('pending-transactions'), 'fa-history', 'info', true, DatabaseNumRows(RetrievePendingTransactions($_SESSION['userportal'])));

  AddCard('Outgoing Transactions', CreateCustomURL('outgoing-transactions'), 'fa-file-upload', 'warning', true, DatabaseNumRows(RetrieveOutgoingTransactions($_SESSION['userportal'])));

  $ongoing = $_SESSION['userportal'] == 'sds' ? RetrieveOngoingTransactions() : RetrieveOngoingTransactions($_SESSION['userportal']);

  AddCard('Ongoing Transactions', CreateCustomURL('ongoing-transactions'), 'fa-tasks', 'danger', true, DatabaseNumRows($ongoing));

  AddCard('Completed Transactions', CreateCustomURL('completed-transactions'), 'fa-check-circle', 'secondary');

  AddCard('Received Transactions', CreateCustomURL('received-transactions'), 'fa-hand-holding-medical', 'primary');
  ?>
</div>