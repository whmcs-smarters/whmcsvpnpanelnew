<?php
/* Smarty version 3.1.36, created on 2022-08-26 10:27:31
  from '/var/www/html/billing/modules/addons/vpnpanel/templates/cfapi.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_6308a013864c62_32811969',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '526700a7e639b2d000658ca57b4e82ba7fb69b1f' => 
    array (
      0 => '/var/www/html/billing/modules/addons/vpnpanel/templates/cfapi.tpl',
      1 => 1661502792,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6308a013864c62_32811969 (Smarty_Internal_Template $_smarty_tpl) {
?><form method="post" style="max-width: 450px; width: 100%; margin:auto;">
<h2 class="text-center">Cloudflare API Details</h2>
<table class="table table-bordered table-striped">
<tr>
<th>API Key</th>
<td><input type="password" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['cfapidetails']->value['cfapi'];?>
" name="apikey"></td>
</tr>
<tr>
<th>Registered Email</th>
<td><input type="email" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['cfapidetails']->value['cfemail'];?>
" name="email"></td>
</tr>
<tr>
<th>API Secret Token</th>
<td><input type="password" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['cfapidetails']->value['cfsecret'];?>
" name="serviceKey"></td>
</tr>
<tr>
<th>
Account
</th>
<td>
<select name="cfaccount" class="form-control">
<option value="">
Select Account
</option>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cfaccounts']->value, 'acc');
$_smarty_tpl->tpl_vars['acc']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['acc']->value) {
$_smarty_tpl->tpl_vars['acc']->do_else = false;
?>
<option <?php if ($_smarty_tpl->tpl_vars['cfaccount']->value == $_smarty_tpl->tpl_vars['acc']->value->id) {?>selected<?php }?> value="<?php echo $_smarty_tpl->tpl_vars['acc']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['acc']->value->name;?>
</option>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</select>
</td>
</tr>
<tr>
<th>
Domains
</th>
<td>
    
<select name="cfdomain" class="form-control">
<option value="">
Select Domain
</option>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cfdomains']->value, 'domain');
$_smarty_tpl->tpl_vars['domain']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['domain']->value) {
$_smarty_tpl->tpl_vars['domain']->do_else = false;
?>
<option <?php if ($_smarty_tpl->tpl_vars['cfdomain']->value == $_smarty_tpl->tpl_vars['domain']->value->id) {?>selected<?php }?> value="<?php echo $_smarty_tpl->tpl_vars['domain']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['domain']->value->name;?>
</option>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</select>
</td>
</tr>
<tr>
    <th>Enable/Disable</th>
    <td><input type="checkbox" name="cfenabled" <?php if ($_smarty_tpl->tpl_vars['cfenabled']->value == 'on') {?>checked<?php }?>> (Tick to enable CloudFlare API - Recommended)</td>
</tr>
<tr>
<td colspan="2">
<center>
<button type="submit" name="addcfapi" class="btn btn-success pull-right">Save</button>
<button class="btn btn-primary pull-left" type="submit" name="testcon">Test Connection</button>
<?php if ((isset($_smarty_tpl->tpl_vars['message']->value))) {?>
<div class="alert alert-<?php if ($_smarty_tpl->tpl_vars['status']->value) {?>success<?php } else { ?>danger<?php }?> mt-2 pull-left" style="margin-top: 10px; width: 100%"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</div>
<?php }?>
</center>
</td>
</tr>
</table>
</form><?php }
}
