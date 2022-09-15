<?php
# _transactions_/new-transaction.php
include_once('_functions_/database/db_transaction.php');
include_once('_functions_/database/db_user.php');
include_once('_functions_/strings.php');
?>

<div class="col-lg-12">
  <div class="card border-left-primary shadow">
    <div class="card-header py-3">
      <?php AddContentTitle('New Transaction', true, CreateCustomURL('transactions')); ?>
    </div>

    <div class="card-body">
      <?php
      if (isset($_POST['newtransaction'])) {
        $datetime = GetDateTime();
        CreateTransaction($_POST['transactioncode'], $_POST['transactiondescription'], $_SESSION['userportal'], $_SESSION['userid'], $datetime, $_POST['transactionaction']);

        if (DatabaseAffectedRows() == 1) {
          if ($_SESSION['userportal'] == 'school') {
            $receiver = 'records';
          } else {
            $receiver = $_POST['destination'];
          }

          CreateTransactionLog($datetime, $_SESSION['userid'], $_SESSION['userportal'], $receiver, $_POST['transactioncode'], 'ongoing');
      ?>
        <div class="d-sm-flex align-items-center justify-content-between alert alert-success py-3 mb-0">
          <span>Transaction successfully saved!</span>
          <a href="<?php echo GetURL() . '/print/transaction?' . sha1(GetTitle()) . '&id=' . urlencode(base64_encode($_POST['transactioncode'])); ?>" target="_blank" title="Print Transaction Code" class="btn btn-success btn-icon-split btn-sm">
          <span class="icon text-white-50">
            <i class="fas fa-print"></i>
          </span>
          <span class="text">Print</span>
        </a>
        </div>
      <?php
        }
      } else {
      ?>
      <form action="" method="post" enctype="multipart/form-data">
        <?php
        if ($_SESSION['userportal'] == 'school') {
          $prefix = $_SESSION['userid'] . '-' . date('y-m');
        } else {
          $prefix = $_SESSION['userportal'] . '-' . date('y-m');
        }

        $num = DatabaseNumRows(RetrieveTransactions($prefix)) + 1;

        if ($num >= 0 && $num <= 9) {
          $code = '000';
        } elseif ($num >= 10 && $num <= 99) {
          $code = '00';
        } elseif ($num >= 100 && $num <= 999) {
          $code = '0';
        } elseif ($num >= 1000) {
          $code = '';
        }

        $code = $prefix . '-' . $code . $num;
        ?>

        <label for="transactioncode">Transaction Code</label>
        <input id="transactioncode" type="text" class="form-control text-uppercase" value="<?php echo $code; ?>" disabled>
        <input type="hidden" name="transactioncode" value="<?php echo $code; ?>">

        <label for="transactiondescription" class="mt-2">Transaction Description</label>
        <textarea id="transactiondescription" name="transactiondescription" class="form-control" rows="5" required></textarea>

        <?php
        if ($_SESSION['userportal'] != 'school') : ?>
        <label class="d-inline-block mt-2">Transaction Destination</label>
        <select name="destination" class="form-control mb-2" required>
          <option value="">Select destination</option>
          <?php
          $destination = RetrieveSections();
          while ($row = DatabaseFetchArray($destination)) :
            if ($row['id'] != $_SESSION['userportal']) : ?>
          <option value="<?php echo $row['id']; ?>"><?php echo $row['section']; ?></option>
          <?php endif;
          endwhile;
          ?>
        </select>
        <?php endif; ?>

        <label for="transactionaction" class="d-inline-block mt-2">Transaction Purpose</label>
        <select id="transactionaction" name="transactionaction" class="form-control mb-2">
          <option value="Select purpose">Select purpose</option>
          <option value="For signature">For signature</option>
          <option value="For evaluation">For evaluation</option>
          <option value="For appropriate action">For appropriate action</option>
          <option value="For reproduction">For reproduction</option>
          <option value="For investigation">For investigation</option>
          <option value="For memo number">For memo number</option>
          <option value="For comments and recommendations">For comments and recommendations</option>
        </select>

        <input type="submit" name="newtransaction" value="Submit Transaction" class="mt-2 btn btn-primary align-right w-100">
      </form>
      <?php } ?>
    </div>
  </div>
</div>