<?php
# _users_/users.php
include_once('_functions_/database/db_user.php');

AddContentTitle('Users', true, CreateCustomURL('non-user-employees-list'), 'New User', 'fa-plus');
?>

<div class="row mt-4">
  <?php
  AddCard('Division Schools', CreateCustomURL('school-users'), 'fa-school', 'success', true, DatabaseNumRows(RetrieveUsers('school')));

  AddCard('Office of the Schools Division Superintendent', CreateCustomURL('sds-users'), 'fa-user-tie', 'info', true, DatabaseNumRows(RetrieveUsers('sds')));
  
  AddCard('Office of the Assistant Schools Division Superintendent', CreateCustomURL('asds-users'), 'fa-user-tie', 'warning', true, DatabaseNumRows(RetrieveUsers('asds')));

  AddCard('Curriculum Implementation Division', CreateCustomURL('cid-users'), 'fa-book-reader', 'danger', true, DatabaseNumRows(RetrieveUsers('cid')));

  AddCard('School Governance &amp; Operations Division', CreateCustomURL('sgod-users'), 'fa-handshake', 'secondary', true, DatabaseNumRows(RetrieveUsers('cid')));

  AddCard('Accounting Section', CreateCustomURL('accounting-users'), 'fa-pen-alt', 'primary', true, DatabaseNumRows(RetrieveUsers('accounting')));

  AddCard('Bidding &amp; Awards Committee Section', CreateCustomURL('bac-users'), 'fa-award', 'success', true, DatabaseNumRows(RetrieveUsers('bac')));

  AddCard('Budget Section', CreateCustomURL('budget-users'), 'fa-calculator', 'info', true, DatabaseNumRows(RetrieveUsers('budget')));

  AddCard('Cash Section', CreateCustomURL('cash-users'), 'fa-money-bill', 'warning', true, DatabaseNumRows(RetrieveUsers('cash')));

  AddCard('Health &amp; Nutrition Section', CreateCustomURL('health-users'), 'fa-plus-square', 'danger', true, DatabaseNumRows(RetrieveUsers('health')));

  AddCard('Information &amp; Communication Technology Section', CreateCustomURL('ict-users'), 'fa-satellite-dish', 'secondary', true, DatabaseNumRows(RetrieveUsers('ict')));

  AddCard('Legal Section', CreateCustomURL('legal-users'), 'fa-balance-scale', 'primary', true, DatabaseNumRows(RetrieveUsers('legal')));

  AddCard('Personnel Section', CreateCustomURL('personnel-users'), 'fa-users', 'success', true, DatabaseNumRows(RetrieveUsers('personnel')));

  AddCard('Records Section', CreateCustomURL('records-users'), 'fa-edit', 'info', true, DatabaseNumRows(RetrieveUsers('records')));

  AddCard('Supply & Property Section', CreateCustomURL('supply-users'), 'fa-box-open', 'warning', true, DatabaseNumRows(RetrieveUsers('supply')));
  ?>
</div>