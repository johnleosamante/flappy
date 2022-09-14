<?php
# functions/functions.php

require_once('config.php');

date_default_timezone_set('Asia/Manila');
ini_set('upload_max_filesize', '50M');
ini_set('post_max_size', '50M');
ini_set('max_input_time', 300);
ini_set('max_execution_time', 300);
ini_set('memory_limit', '1024M');

function GetTitle($page='') {
  return $page == '' ? TITLE : $page . ' | ' . TITLE; 
}

function GetAlias() {
  return ALIAS;
}

function GetDepartment() {
  return DEPARTMENT;
}

function GetDivision() {
  return DIVISION;
}

function GetCity() {
  return CITY;
}

function GetDivisionCode() {
  return DIVISION_CODE;
}

function GetDivisionOffice() {
  return DIVISION . " Office";
}

function GetDescription() {
  return DESCRIPTION;
}

function GetAuthor() {
  return AUTHOR;
}

function GetHostURL() {
  global $HOST_URL;
  return $HOST_URL;
}

function GetURL() {
  global $URL;
  return $URL;
}

function CreateCustomURL($link) {
  return GetURL() . '/?' . sha1(GetTitle()) . '&view=' . urlencode(base64_encode($link));
}

function CreateCustomGetURL($link, $id) {
  return GetURL() . '/?' . sha1(GetTitle()) . '&id=' . urlencode(base64_encode($id)) . '&view=' . urlencode(base64_encode($link));
 }

function GetConnection() {
  global $CONNECTION;
  return $CONNECTION;
}

function HashPassword($password) {
  return PASSWORD_SALT_PREFIX . $password . PASSWORD_SALT_SUFFIX;
}

function GetDateTime() {
  return date('Y-m-d H:i:s');
}

function GetDateFormat() {
  return date('Y-m-d');
}

function SessionErrorReport($session, $errorReporting) {
  if ($session) session_start();

  if ($errorReporting) error_reporting();
  else error_reporting(0);
}

SessionErrorReport(true, true);
?>