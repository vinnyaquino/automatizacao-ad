<?php

include 'ldap.php';

$usuario_habilitado = '(useraccountcontrol=512)(useraccountcontrol=66048)';
$usuario_desabilitado =  '(useraccountcontrol=514)(useraccountcontrol=66050)';


$filter = '(|'.$usuario_habilitado.')'; // filtro de objetos do ldap
$busca = ldap_search($ldapcon,$ldap_base_dn, $filter) or exit("Busca desativada"); // adicionando o filtro a busca
$entrada = ldap_get_entries($ldapcon, $busca); // pegando objetos da busca

echo "<div id='conteudohide'>";
global $nome_funcionario, $setor_funcionario;
for ($i=0; $i < $entrada["count"]; $i++) {
  $nome_funcionario = (isset($entrada[$i]["cn"][0]) ? $entrada[$i]["cn"][0]: 'Sem dados');
  $login_funcionario = (isset($entrada[$i]["samaccountname"][0]) ? $entrada[$i]["samaccountname"][0]: 'Sem dados');
  $email_funcionario = (isset($entrada[$i]["mail"][0]) ? $entrada[$i]["mail"][0]: 'Sem dados');
  $telefone_funcionario = (isset($entrada[$i]['telephonenumber'][0]) ? $entrada[$i]['telephonenumber'][0]: 'Sem dados');
  $local_funcionario = (isset($entrada[$i]["physicaldeliveryofficename"][0]) ? $entrada[$i]["physicaldeliveryofficename"][0]: 'Sem dados');

    echo "<div class='dvConteudo'><tr>".
            "<td class='table-content' >".$nome_funcionario."</td> ".
            "<td >".$login_funcionario."</td> ".
            "<td> ".$email_funcionario."</td> ".
            "<td> ".$telefone_funcionario."</td> ".
            "<td> ".$local_funcionario."</td> ".
            "<td> 
            <div class='d-flex justify-content-between'>
            <form action='user-remove.php?nome=$nome_funcionario' method='POST'>
            <button type='submit' class='btn btn-danger'>Desabilitar</button>
            </form>
            </div>
            </td></div>"
            ;
}
echo "</div>";
