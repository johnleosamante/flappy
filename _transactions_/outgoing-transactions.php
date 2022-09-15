<?php
# _transactions_/outgoing-transactions.php
include_once('_functions_/database/db_transaction.php');
include_once('_functions_/database/db_personal.php');
include_once('_functions_/database/db_school.php');
include_once('_functions_/strings.php');
?>

<div class="card border-left-primary shadow mb-4">
  <div class="card-header py-3">
    <?php AddContentTitle('Outgoing Transactions', true, CreateCustomURL('transactions')); ?>
  </div>
                        
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-striped table-hover table-bordered mb-0" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr class="text-center align-middle">
            <th>#</th>
            <th>Description</th>
            <th>To</th>
            <th>By</th>
            <th>On</th>
            <th>Purpose</th>
            <th>Action</th>
          </tr>
        </thead>
                                    
        <tbody>
          <?php
          $query = RetrieveOutgoingTransactions($_SESSION['userportal']);

          while ($transaction = DatabaseFetchArray($query)) : ?>
          <tr>
            <td class="text-uppercase text-center"><?php echo $transaction['id']; ?></td>
            <td><?php echo $transaction['description']; ?></td>
            <td class="text-center text-uppercase">
            <?php
              $section = RetrieveSection($transaction['to']);
              if (DatabaseNumRows($section) > 0) {
                echo DatabaseFetchArray($section)['section'];
              } else {
                echo DatabaseFetchArray(RetrieveSchool($transaction['to']))['school'];
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
                echo DatabaseFetchArray(RetrieveSchool($transaction['user']))['school'];
              }
            ?>
            </td>
            <td class="text-center"><?php echo $transaction['datetime']; ?></td>
            <td class="text-center"><?php echo $transaction['purpose']; ?></td>
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
            <th>To</th>
            <th>By</th>
            <th>On</th>
            <th>Purpose</th>
            <th>Action</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>