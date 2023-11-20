<?php
ob_start();
session_start();

$username = '';
$password = '';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Verifique se o nome de usuário está vazio
    if(empty($_POST["login"])){
        $username_err = "Por favor, insira o nome de usuário.";
    } else{
        $username = $_POST["login"];
    }

    // Verifique se a senha está vazia
    if(empty($_POST["senha"])){
        $password_err = "Por favor, insira sua senha.";
    } else{
        $password = $_POST["senha"];
    }

    // Validar credenciais
    if(!empty($username) && !empty($password)){

        $ldap_server = "";
        $dominio = "";
        $user = $username.$dominio;
        $ldap_porta = "389";
        $ldap_pass   = $password;
        $ldapcon = ldap_connect($ldap_server, $ldap_porta) or die("Não foi possível conectar ao servidor LDAP.");

        if ($ldapcon == true){

            $bind = ldap_bind($ldapcon, $user, $ldap_pass);

            if ($bind == true) {
                // Busca o usuário no LDAP
                $search_result = ldap_search($ldapcon, "DC=,DC=local", "(sAMAccountName={$username})");
                $user_entry = ldap_first_entry($ldapcon, $search_result);
                $user_dn = ldap_get_dn($ldapcon, $user_entry);

                // Verifica se o usuário pertence ao grupo DP
                $admin_group_dn = "CN=DP,OU=,DC=,DC=local";
                $is_admin = ldap_compare($ldapcon, $user_dn, "memberOf", $admin_group_dn);
                // Verifica se o usuário pertence ao grupo TI
                $ti_group_dn = "CN=TI,OU=,DC=,DC=local";
                $is_ti = ldap_compare($ldapcon, $user_dn, "memberOf", $ti_group_dn);

                if ($is_admin || $is_ti == true) {
                    // Usuário é um administrador, redireciona para a página principal
                    header("Location:main.php");
                    $_SESSION['usuario'] = $username;
                } else {
                    // Usuário não é um administrador, redireciona para a página de login
                    header("Location:index.php");
                }

            } else {
                header("Location:index.php");
            }
        }
    }else{
        header("Location:index.php");
        echo "<script>alert('Senha e/ou Usuario Vazios')</script>";
    }
}
