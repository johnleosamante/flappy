<?php
# _layout_/content.php

if (!isset($url) || $url == 'dashboard') {
  include_once('dashboard.php');
} else {
  $file = '';
  
  switch ($url) {
    case 'incoming-transactions':
    case 'pending-transactions':
    case 'outgoing-transactions':
    case 'ongoing-transactions':
    case 'completed-transactions':
    case 'received-transactions';
    case 'new-transaction':
    case 'view-transaction-log':
    case 'receive-transaction':
    case 'forward-transaction':
    case 'approve-transaction':
    case 'transactions':
      $file = '_transactions_/' . $url;
      break;
    case 'users':
    case 'view-user':
    case 'new-user':
      $file = '_users_/' . $url;
      break;
    case 'school-users':
    case 'sds-users':
    case 'asds-users':
    case 'cid-users':
    case 'sgod-users':
    case 'accounting-users':
    case 'bac-users':
    case 'budget-users':
    case 'cash-users':
    case 'health-users':
    case 'ict-users':
    case 'legal-users':
    case 'personnel-users':
    case 'records-users':
    case 'supply-users':
      $file = '_users_/users-list';
      break;
    case 'inactive-users':
      $file = '_users_/inactive-users';
      break;
    case 'employees-list':
    case 'non-user-employees-list':
      $file = '_employees_/employees-list';
      break;
    case 'schools-list':
    case 'non-user-schools-list':
      $file = '_schools_/schools-list';
      break;
    case 'new-school-user':
      $file = '_schools_/new-school-user';
      break;
    default:
      $file = 'dashboard';
  }

  include_once($file . '.php');
}
?>