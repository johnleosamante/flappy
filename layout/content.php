<?php
# layout/content.php

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
      $file = 'transactions/' . $url;
      break;
    case 'users':
    case 'view-user':
    case 'new-user':
    case 'update-user':
      $file = 'users/' . $url;
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
    case 'records-user':
    case 'supply-users':
      $file = 'users/users-list';
      break;
    case 'employees-list':
    case 'non-user-employees-list':
      $file = 'employees/employees-list';
      break;
    default:
      $file = 'dashboard';
  }

  include_once($file . '.php');
}
?>