<?php
/* Smarty version 3.1.36, created on 2020-11-21 06:09:42
  from 'mailMessage:plaintext' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fb8af26dd6fb6_97063650',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dac51ccee8dbecedf9afb805fb153d5c6bf41d7a' => 
    array (
      0 => 'mailMessage:plaintext',
      1 => 1605938982,
      2 => 'mailMessage',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fb8af26dd6fb6_97063650 (Smarty_Internal_Template $_smarty_tpl) {
?>Dear <?php echo $_smarty_tpl->tpl_vars['client_name']->value;?>
,


This is a payment receipt for Invoice <?php echo $_smarty_tpl->tpl_vars['invoice_num']->value;?>
 sent on <?php echo $_smarty_tpl->tpl_vars['invoice_date_created']->value;?>



<?php echo $_smarty_tpl->tpl_vars['invoice_html_contents']->value;?>



Amount: <?php echo $_smarty_tpl->tpl_vars['invoice_last_payment_amount']->value;?>

Transaction #: <?php echo $_smarty_tpl->tpl_vars['invoice_last_payment_transid']->value;?>

Total Paid: <?php echo $_smarty_tpl->tpl_vars['invoice_amount_paid']->value;?>

Remaining Balance: <?php echo $_smarty_tpl->tpl_vars['invoice_balance']->value;?>

Status: <?php echo $_smarty_tpl->tpl_vars['invoice_status']->value;?>



You may review your invoice history at any time by logging in to your client area.


Note: This email will serve as an official receipt for this payment.


<?php echo $_smarty_tpl->tpl_vars['signature']->value;
}
}
