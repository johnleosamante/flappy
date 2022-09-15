<?php
# transactions/completed-transactions.php

include_once('functions/database/transaction.php');
?>

<div class="card border-left-primary shadow mb-4">
  <div class="card-header py-3">
    <?php AddContentTitle('Completed Transactions', true, CreateCustomURL('transactions')); ?>
  </div>
                        
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-striped table-hover table-bordered mb-0" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr class="text-center align-middle">
            <th>#</th>
            <th>Description</th>
            <th>Posted on</th>
            <th>Completed on</th>
            <th>Action</th>
          </tr>
        </thead>
                                    
        <tbody>
        <?php
        $query = $_SESSION['userportal'] == 'sds' ? RetrieveCompletedTransactions() : RetrieveCompletedTransactions($_SESSION['userportal']);

        while ($row = DatabaseFetchArray($query)) : ?>
          <tr>
            <td class="text-uppercase text-center"><?php echo $row['id']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td class="text-center"><?php echo $row['postedon']; ?></td>
            <td class="text-center"><?php echo $row['completedon']; ?></td>
            <td>
              <a class="text-xs btn btn-success d-block" href="<?php echo CreateCustomGetURL('view-transaction-log', $row['id']); ?>" title="View Transaction Log"><i class="fas fa-eye"></i></a>
            </td>
          </tr>
        <?php endwhile; ?>
        </tbody>

        <tfoot>
          <tr class="text-center align-middle">
            <th>#</th>
            <th>Description</th>
            <th>Posted on</th>
            <th>Completed on</th>
            <th>Action</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>