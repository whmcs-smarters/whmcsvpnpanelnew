<?php
/* Smarty version 3.1.36, created on 2020-11-21 06:09:43
  from 'mailMessage:plaintext' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fb8af27725fa7_81654308',
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
function content_5fb8af27725fa7_81654308 (Smarty_Internal_Template $_smarty_tpl) {
?>Dear <?php echo $_smarty_tpl->tpl_vars['client_name']->value;?>
,

Thanks for buying our service. Your service <?php echo $_smarty_tpl->tpl_vars['service_product_name']->value;?>
 has now activated.
Please use the following to details to use your service. 

Your VPNService Details are: 

Your Username : <?php echo $_smarty_tpl->tpl_vars['service_username']->value;?>


Your Password : <?php echo $_smarty_tpl->tpl_vars['service_password']->value;?>



Your VPNService App login Details are: 

Your Username : <?php echo $_smarty_tpl->tpl_vars['client_email']->value;?>


Your Password : <?php echo $_smarty_tpl->tpl_vars['client_password']->value;?>
 (Your panel login password)

Your VPNService App Download Links:

Android App Link:  <?php echo $_smarty_tpl->tpl_vars['androidapplinks']->value;?>

Window App Link:  <?php echo $_smarty_tpl->tpl_vars['windowapplinks']->value;?>

Ios App Link:  <?php echo $_smarty_tpl->tpl_vars['iosapplinks']->value;?>

Linux App Link:  <?php echo $_smarty_tpl->tpl_vars['linuxapplinks']->value;?>


Billing Info: 

Product/Service: <?php echo $_smarty_tpl->tpl_vars['service_product_name']->value;?>

Payment Method: <?php echo $_smarty_tpl->tpl_vars['service_payment_method']->value;?>

Amount: <?php echo $_smarty_tpl->tpl_vars['service_recurring_amount']->value;?>

Billing Cycle: <?php echo $_smarty_tpl->tpl_vars['service_billing_cycle']->value;?>

Next Due Date: <?php echo $_smarty_tpl->tpl_vars['service_next_due_date']->value;?>


Thank you for choosing us.

<?php echo $_smarty_tpl->tpl_vars['signature']->value;
}
}
