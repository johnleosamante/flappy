<?php
# _transactions_/new-transaction.php
include_once('_functions_/database/db_transaction.php');
include_once('_functions_/database/db_personal.php');
include_once('_functions_/database/db_school.php');
include_once('_functions_/strings.php');
?>

<div class="card border-left-primary shadow">
  <div class="card-header py-3">
    <?php AddContentTitle('Forward Transaction', true, CreateCustomURL('pending-transactions')); ?>
  </div>

  <div class="card-body"><?php
    $transaction = DatabaseFetchAssoc(RetrievePendingTransaction($_GET['id']));

    if (isset($_POST['forwardtransaction'])) {
      $datetime = GetDateTime();
      UpdateTransactionLog($_GET['id']);

      if (DatabaseAffectedRows() == 1) {
        CreateTransactionLog($datetime, $_SESSION['userid'], $_SESSION['userportal'], $_POST['destination'], $_GET['id'], 'forwarded'); ?>
        <div class="alert alert-success py-3 mb-0">Transaction successfully forwarded!</div><?php  
      }
    } else { ?>
    <table cellspacing="0">
      <tr>
        <th class="pr-4" scope="row">#:</th>
        <td class="text-uppercase"><?php echo $transaction['id']; ?></td>
      </tr>
      <tr>
        <th class="pr-4" scope="row">Description:</th>
        <td class="text-capitalize"><?php echo $transaction['description']; ?></td>
      </tr>
      <tr>
        <th class="pr-4" scope="row">Received from:</th>
        <td class="text-capitalize"><?php
            $section = RetrieveSection($transaction['from']);
            if (DatabaseNumRows($section) > 0) {
              echo DatabaseFetchArray($section)['section'];
            } else {
              $school = DatabaseFetchArray(RetrieveSchool($transaction['from']))['school'];
              echo $school;
            } ?>
        </td>
      </tr>
      <tr>
        <th class="pr-4" scope="row">Received by:</th>
        <td class="text-capitalize"><?php
          $user = RetrieveName($transaction['user']);
          if (DatabaseNumRows($user) > 0) {
            $row = DatabaseFetchArray($user);
            echo ToName($row['lastname'], $row['firstname'], $row['middlename'], $row['extension']);
          } else {
            echo $school;
          } ?>
        </td>
      </tr>
      <tr>
        <th class="pr-4" scope="row">Received on:</th>
        <td><?php echo $transaction['datetime']; ?></td>
      </tr>
      <tr>
        <th class="pr-4" scope="row">Purpose:</th>
        <td class="text-capitalize"><?php echo $transaction['purpose']; ?></td>
      </tr>
    </table>

    <hr class="mt-2 mb-1">

    <form action="" method="post" enctype="multipart/form-data">
      <label class="d-inline-block mt-2">Forward to</label>
      <select name="destination" class="form-control mb-2" required>
        <option value="">Select destination</option><?php
        $destination = RetrieveSections();
        while ($receiver = DatabaseFetchArray($destination)) :
          if ($receiver['id'] != $_SESSION['userportal']) : ?>
          <option value="<?php echo $receiver['id']; ?>"><?php echo $receiver['section']; ?></option><?php
          endif;
        endwhile; ?>
      </select>
      <input type="submit" name="forwardtransaction" value="Forward Transaction" class="mt-2 btn btn-primary align-right w-100">
    </form>
    <?php } ?>
  </div><!-- .card-body -->
</div><!-- .card -->