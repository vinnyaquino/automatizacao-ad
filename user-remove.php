<?php

ob_start();
session_start();

if(!isset($_SESSION['usuario'])) {
   header("Location: index.php");
   exit;
}

include 'ldap.php';

$nome = $_GET['nome'];

$dn = "cn=".$nome.",OU=,DC=,DC=";
$mod = array();
$mod["userAccountControl"] = array(
  0 => "514",
);

$bind = ldap_modify($ldapcon, $dn, $mod);

if ($bind) {
  header('Location: main.php');
} 
else {
  echo "Error changing user account control: " . ldap_error($ldapcon);
}

ldap_close($ldapcon);
?>

