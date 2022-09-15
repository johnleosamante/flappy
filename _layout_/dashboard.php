<?php
# layout/dashboard.php

AddContentTitle('Dashboard');
?>

<div class="row mt-4">
<?php
  AddCard('Transactions', CreateCustomURL('transactions'), 'fa-exchange-alt');
?>
</div>