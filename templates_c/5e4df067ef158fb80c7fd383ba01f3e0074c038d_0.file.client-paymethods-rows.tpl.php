<?php
/* Smarty version 3.1.36, created on 2020-11-11 07:54:47
  from '/var/www/html/admin/templates/blend/client-paymethods-rows.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fab98c7ad7807_33065053',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5e4df067ef158fb80c7fd383ba01f3e0074c038d' => 
    array (
      0 => '/var/www/html/admin/templates/blend/client-paymethods-rows.tpl',
      1 => 1605080587,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fab98c7ad7807_33065053 (Smarty_Internal_Template $_smarty_tpl) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['payMethods']->value, 'payMethod', false, 'i');
$_smarty_tpl->tpl_vars['payMethod']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['i']->value => $_smarty_tpl->tpl_vars['payMethod']->value) {
$_smarty_tpl->tpl_vars['payMethod']->do_else = false;
?>
    <tr class="<?php if ($_smarty_tpl->tpl_vars['i']->value%2) {?>altrow<?php }?>">
        <td class="client-paymethod<?php if ($_smarty_tpl->tpl_vars['payMethod']->value['isUsingInactiveGateway']) {?> gateway-inactive<?php }?>">
            <a id="btnPayMethodDetails<?php echo $_smarty_tpl->tpl_vars['payMethod']->value['id'];?>
"
               href="<?php echo $_smarty_tpl->tpl_vars['payMethod']->value['url'];?>
"
               data-modal-title="Pay Method Details"
               data-btn-submit-id="savePaymentMethod"
               data-btn-submit-label="<?php echo AdminLang::trans('global.savechanges');?>
"
               data-role="edit-paymethod"
               onclick="return false;"
               <?php if ($_smarty_tpl->tpl_vars['payMethod']->value['isUsingInactiveGateway']) {?>
               title="<?php echo AdminLang::trans('clientsummary.payMethodGatewayInactive');?>
"
               <?php }?>
               class="paymethod-description open-modal">
                <i class="<?php echo $_smarty_tpl->tpl_vars['payMethod']->value['iconClass'];?>
"></i>
                &nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['payMethod']->value['description'];?>

                <?php if ($_smarty_tpl->tpl_vars['payMethod']->value['isDefault']) {?><i class="pull-right fal fa-user-check">&nbsp;&nbsp;</i><?php }?>
            </a>
        </td>
    </tr>
    <?php
}
if ($_smarty_tpl->tpl_vars['payMethod']->do_else) {
?>
    <tr>
        <td align="center">No Pay Methods</td>
    </tr>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
