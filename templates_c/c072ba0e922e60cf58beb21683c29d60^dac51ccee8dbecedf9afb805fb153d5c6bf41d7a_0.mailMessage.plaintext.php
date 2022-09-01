<?php
/* Smarty version 3.1.36, created on 2020-11-21 06:09:43
  from 'mailMessage:plaintext' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fb8af27950b33_60498161',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dac51ccee8dbecedf9afb805fb153d5c6bf41d7a' => 
    array (
      0 => 'mailMessage:plaintext',
      1 => 1605938983,
      2 => 'mailMessage',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fb8af27950b33_60498161 (Smarty_Internal_Template $_smarty_tpl) {
?>Dear <?php echo $_smarty_tpl->tpl_vars['client_name']->value;?>
,

You have created a new user with following details


User name : <?php echo $_smarty_tpl->tpl_vars['vpn_client_name']->value;?>


Service name : <?php echo $_smarty_tpl->tpl_vars['vpn_client_service']->value;?>


User email : <?php echo $_smarty_tpl->tpl_vars['vpn_client_email']->value;?>


User Password : <?php echo $_smarty_tpl->tpl_vars['vpn_client_password']->value;?>


User Service username : <?php echo $_smarty_tpl->tpl_vars['vpn_service_username']->value;?>
 

User service password : <?php echo $_smarty_tpl->tpl_vars['vpn_service_password']->value;?>
,



Regards
<?php echo $_smarty_tpl->tpl_vars['signature']->value;
}
}
