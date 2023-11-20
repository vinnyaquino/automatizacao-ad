<?php

$username = '';
$password = '';
$ldap_server = "";
$dominio = "";
$user = $username.$dominio;
$ldap_porta = "389";
$ldappass   = $password;
$ldap_base_dn = 'OU=,DC=,DC=local';

$ldapcon = ldap_connect($ldap_server, $ldap_porta) or 
die("Não foi possível conectar ao servidor LDAP.");

if ($ldapcon == true){

$bind = ldap_bind($ldapcon, $user, $ldappass);
    
}else {

echo "Não conectado";

}
