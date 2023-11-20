<?php

ob_start();
session_start();

if(!isset($_SESSION['usuario'])) {
   header("Location: index.php");
//    exit;
}

include 'ldap.php';

$givename = $_POST['p-nome'];
$surname = $_POST['s-nome'];
$displayname = $givename . ' ' . $surname;
$login_rede = strtolower($_POST['login_rede']);
$fone = $_POST['fone'];
$funcao = $_POST['funcao'];
$local_trabalho = $_POST['local_trabalho'];
$setor_trabalho = $_POST['setor_trabalho'];
$mail = "$login_rede@";
$senha = '';
// $grupo = $_POST['grupo'];
$dn = "cn=$displayname,OU=,DC=,DC=local";

if ($ldapcon == true) {

    $bind = ldap_bind($ldapcon, $user, $ldappass);

    ldap_set_option($ldapcon, LDAP_OPT_PROTOCOL_VERSION, 3); // não mecher
    //ldap_set_option($ldapcon, LDAP_OPT_REFERRALS, 0); // não tirar o comentário

    $info["cn"] = $givename . ' ' . $surname;;  // funciona
    $info["sn"] = $surname;  // funciona
    $info["givenname"] = $givename; // funciona
    $info["displayname"] = $givename . ' ' . $surname; // funciona
    $info["name"] = $givename . ' ' . $surname; // funciona
    $info["title"] = $funcao; // funciona
    $info["userPrincipalName"] = $login_rede . $dominio; // funcionando
    $info["samaccountname"] = $login_rede; //funciona
    $info["department"] = $setor_trabalho; // funciona
    $info["mail"] = $mail; //funciona
    $info['objectclass'][0] = "top"; // não mecher
    $info['objectclass'][1] = "person"; // não mecher
    $info['objectclass'][2] = "organizationalPerson"; // não mecher
    $info['objectclass'][3] = "user"; // não mecher
    $info["physicaldeliveryofficename"] = $local_trabalho; //funciona
    $info["telephoneNumber"] = $fone; //funciona
    //$info["description"] = $description; // não funciona
    $info["useraccountcontrol"] = 512; // funciona
    $info['unicodepwd'] = iconv("UTF-8", "UTF-16LE", "\"" . $senha . "\""); // funciona
    $r = ldap_add($ldapcon, $dn, $info);

    ldap_close($ldapcon);

    header('Location: main.php');

} else {

    echo "Não conectado";
}

if ($ldapcon == true) {
    $bind = ldap_bind($ldapcon, $user, $ldappass);
    if ($bind) {
        $group_dn = "CN=$setor_trabalho,OU=,DC=,DC=local"; // DN do grupo "TI"
        $group_dn_todos = "CN=,OU=,DC=,DC="; // DN do grupo "TI"
        $user_dn = "CN=$displayname,$ldap_base_dn"; // DN do usuário "bruno" em "teste01"
        $resultado = ldap_mod_add($ldapcon, $group_dn, array("member" => $user_dn)); // Adiciona o usuário ao grupo
        $resultado_todos = ldap_mod_add($ldapcon, $group_dn_todos, array("member" => $user_dn)); // Adiciona o usuário ao grupo TODOS
        if ($resultado === true) {
            echo "Usuário adicionado ao grupo com sucesso!";
        } else {
            echo "Não foi possível adicionar o usuário ao grupo.";
        }
    } else {
        echo "Não foi possível autenticar com as credenciais fornecidas.";
    }
} else {
    echo "Não foi possível conectar ao servidor LDAP.";
}
