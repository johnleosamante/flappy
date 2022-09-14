<?php
# transactions/new-transaction.php

include_once('functions/database/transaction.php');
include_once('functions/database/personal.php');
include_once('functions/database/school.php');
include_once('functions/strings.php');
?>

<div class="col-lg-12">
  <div class="card border-left-primary shadow">
    <div class="card-header py-3">
      <?php AddContentTitle('Approve Transaction', true, CreateCustomURL('pending-transactions')); ?>
    </div>

    <div class="card-body">
      <?php
      $transaction = DatabaseFetchAssoc(RetrievePendingTransaction($_GET['id']));

      if (isset($_POST['approvetransaction'])) {
        $datetime = GetDateTime();
        
        UpdateTransactionLog($_GET['id']);

        if (DatabaseAffectedRows() == 1) {
          CreateTransactionLog($datetime, $_SESSION['userid'], $transaction['from'], $_SESSION['userportal'], $_GET['id'], 'approved', 'done'); ?>
          <div class="alert alert-success py-3 mb-0">Transaction successfully approved!</div>
        <?php  
        }
      } else { ?>
      <table cellspacing="0">
         <tr>
          <th class="pr-4" scope="row">#:</th>
          <td class="text-uppercase"><?php echo $transaction['id']; ?></td>
        </tr>
        <tr>
          <th class="pr-4" scope="row">Description:</th>
          <td><?php echo $transaction['description']; ?></td>
        </tr>
        <tr>
          <th class="pr-4" scope="row">Received from:</th>
          <td class="text-uppercase">
          <?php
            $section = RetrieveSection($transaction['from']);
            if (DatabaseNumRows($section) > 0) {
              echo DatabaseFetchArray($section)['section'];
            } else {
              $school = DatabaseFetchArray(RetrieveSchool($transaction['from']))['school'];
              echo $school;
            }
          ?>
          </td>
        </tr>
        <tr>
          <th class="pr-4" scope="row">Received by:</th>
          <td class="text-uppercase">
          <?php
            $user = RetrieveName($transaction['user']);
            if (DatabaseNumRows($user) > 0) {
              $row = DatabaseFetchArray($user);
              echo ToName($row['lastname'], $row['firstname'], $row['middlename'], $row['extension']);
            } else {
              echo $school;
            }
          ?>
          </td>
        </tr>
        <tr>
          <th class="pr-4" scope="row">Received on:</th>
          <td><?php echo $transaction['datetime']; ?></td>
        </tr>
        <tr>
          <th class="pr-4" scope="row">Purpose:</th>
          <td><?php echo $transaction['purpose']; ?></td>
        </tr>
      </table>
      <hr class="my-2">
      <form action="" method="post" enctype="multipart/form-data">
        <input type="submit" name="approvetransaction" value="Approve Transaction" class="mt-2 btn btn-primary align-right w-100">
      </form>
      <?php } ?>
    </div>
  </div>
</div>