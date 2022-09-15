<?php
# _functions_/strings.php

function ToString($text, $prefix='', $suffix='', $isChar=false) {
  if ($text == '') return '';
  
  if ($isChar) $text = mb_substr($text, 0, 1);

  return $prefix . $text . $suffix;
}

function ToName($lname, $fname, $mname='', $ext='', $fnamefirst=false, $mi=true) {
  $mname = $mi ? ToString($mname, ' ', '.', true) : ToString($mname, ' ');
  
  if ($fnamefirst) {
    return $fname . $mname . ToString($lname, ' ') . ToString($ext, ', ');
  } else {
    return $lname . ToString($fname, ', ') . ToString($ext, ' ') . $mname;
  }
}

function ToAddress($lot, $street, $subdivision, $barangay, $city, $province='') {
  return ToString($lot, '', ', ') . ToString($street, '', ', ') . ToString($subdivision, '', ', ') . ToString($barangay, '', ', ') . ToString($city) . ToString($province, ', '); 
}
?>