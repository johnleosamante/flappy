<?php
# transactions/view-transaction-log.php

include_once('functions/database/transaction.php');
include_once('functions/database/personal.php');
include_once('functions/database/school.php');
include_once('functions/strings.php');
?>

<div class="card border-left-primary shadow mb-4">
  <div class="card-header py-3">
    <?php AddContentTitle('View Transaction Log', true, $_SERVER['HTTP_REFERER']); ?>
  </div>
                        
  <div class="card-body">
    <div class="table-responsive">
    <?php $transaction = DatabaseFetchAssoc(RetrieveTransaction($_GET['id']));?>
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
          <th class="pr-4" scope="row">From:</th>
          <td class="text-uppercase">
          <?php
          $section = RetrieveSection($transaction['section']);
          if (DatabaseNumRows($section) > 0) {
            echo DatabaseFetchArray($section)['section'];
          } else {
            $school = DatabaseFetchArray(RetrieveSchool($transaction['section']))['school'];
            echo $school;
          }
          ?>
          </td>
        </tr>
        <tr>
          <th class="pr-4" scope="row">By:</th>
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
          <th class="pr-4" scope="row">Created on:</th>
          <td class="text-uppercase"><?php echo $transaction['datetime']; ?></td>
        </tr>
        <tr>
          <th class="pr-4" scope="row">Purpose:</th>
          <td><?php echo $transaction['purpose']; ?></td>
        </tr>
      </table>
    </div>
    <hr>
    <div class="table-responsive">
      <table class="table table-striped table-hover table-bordered mb-0" width="100%" cellspacing="0">
        <thead>
          <tr class="text-center align-middle">
            <th>Posted on</th>
            <th>From</th>
            <th>To</th>
            <th>Status</th>
          </tr>
        </thead>
                                    
        <tbody>
        <?php
        $transactionlog = RetrieveTransactionLog($transaction['id']);
        while ($log = DatabaseFetchArray($transactionlog)) : ?>
          <tr>
            <td class="text-center"><?php echo $log['datetime']; ?></td>
            <td class="text-center text-uppercase">
            <?php
            $sender = RetrieveSection($log['from']);
            if (DatabaseNumRows($sender) > 0) {
              echo DatabaseFetchArray($sender)['section'];
            } else {
              $school = DatabaseFetchArray(RetrieveSchool($log['from']))['school'];
              echo $school;
            }
            ?>
            </td>
            <td class="text-center text-uppercase">
            <?php
            $receiver = RetrieveSection($log['to']);
            if (DatabaseNumRows($receiver) > 0) {
              echo DatabaseFetchArray($receiver)['section'];
            } else {
              $school = DatabaseFetchArray(RetrieveSchool($log['to']))['school'];
              echo $school;
            }
            ?>
            </td>
            <td class="text-center text-capitalize"><?php echo $log['status']; ?></td>
          </tr>
        <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>