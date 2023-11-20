<h1 align="center">:file_cabinet: Ad</h1>

## :memo: Descrição
Sistema de cadastro para gestão de usuários e grupos no Active Directory

## :wrench: Tecnologias utilizadas
* Bootstrap, PHP, LDAP PHP

```php
 (useraccountcontrol=514)(useraccountcontrol=66050) // usuários desabilitados
 (useraccountcontrol=512)(useraccountcontrol=66048) // usuários habilitados
 (objectCategory=person)(objectCategory=contact)
 (samaccountname=hadrielle.maria)(useraccountcontrol=66050)

#https://www.nvlan.com.br/comunidade/utilizando-o-atributo-useraccountcontrol/

 Valores convencionais:
// ===========================
 512 - Enable Account
 514 - Disable account
 576 - Enable Account + Passwd_cant_change
 544 - Account Enabled - Require user to change password at first logon
 4096 - Workstation/server
 66048 - Enabled, password never expires
 66050 - Disabled, password never expires
 262656 - Smart Card Logon Required
 532480 - Domain controller

 Todos os valores:
 // ===========================
 1 - script
 2 - accountdisable
 8 - homedir_required
 16 - lockout
 32 - passwd_notreqd
 64 - passwd_cant_change
 128 - encrypted_text_pwd_allowed
 256 - temp_duplicate_account
 512 - normal_account
 2048 - interdomain_trust_account
 4096 - workstation_trust_account
 8192 - server_trust_account
 65536 - dont_expire_password
 131072 - mns_logon_account
 262144 - smartcard_required
 524288 - trusted_for_delegation
 1048576 - not_delegated
 2097152 - use_des_key_only
 4194304 - dont_req_preauth
 8388608 - password_expired
 16777216 - trusted_to_auth_for_delegation

```
## :dart: Status do projeto
Beta funcionando
