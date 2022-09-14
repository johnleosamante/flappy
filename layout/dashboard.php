<?php
# layout/dashboard.php

AddContentTitle('Dashboard');
?>

<div class="row mt-4">
<?php
  AddCard('Transactions', CreateCustomURL('transactions'), 'fa-exchange-alt');

  if (isset($_SESSION['userportal']) && $_SESSION['userportal'] == 'ict') {
    AddCard('Users', CreateCustomURL('users'), 'fa-users');
  }
?>
</div>