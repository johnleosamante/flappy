<?php
# transactions/received-transactions.php

include_once('functions/database/transaction.php');
include_once('functions/database/personal.php');
include_once('functions/database/school.php');
include_once('functions/strings.php');
?>

<div class="card border-left-primary shadow mb-4">
  <div class="card-header py-3">
    <?php AddContentTitle('Received Transactions', true, CreateCustomURL('transactions')); ?>
  </div>
                        
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-striped table-hover table-bordered mb-0" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr class="text-center align-middle">
            <th>#</th>
            <th>Description</th>
            <th>Received from</th>
            <th>Received by</th>
            <th>Received on</th>
            <th>Action</th>
          </tr>
        </thead>
                                    
        <tbody>
          <?php
          $query = RetrieveReceivedTransactions($_SESSION['userportal']);

          while ($transaction = DatabaseFetchArray($query)) : ?>
          <tr>
            <td class="text-uppercase text-center"><?php echo $transaction['id']; ?></td>
            <td><?php echo $transaction['description']; ?></td>
            <td class="text-center text-uppercase">
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
            <td class="text-center text-uppercase">
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
            <td class="text-center"><?php echo $transaction['datetime']; ?></td>
            <td>
              <a class="text-xs btn btn-success d-block" href="<?php echo CreateCustomGetURL('view-transaction-log', $transaction['id']); ?>" title="View Transaction Log"><i class="fas fa-eye"></i></a>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>

        <tfoot>
          <tr class="text-center align-middle">
            <th>#</th>
            <th>Description</th>
            <th>Received from</th>
            <th>Received by</th>
            <th>Received on</th>
            <th>Action</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>