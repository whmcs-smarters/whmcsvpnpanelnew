<?php
/* Smarty version 3.1.36, created on 2020-11-18 05:59:28
  from '/var/www/html/modules/servers/vpnservernoapi/templates/downloadcert.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fb4b8403ba7f5_00446165',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '91999cf9c6f4cf71ffd47b6549ac47ae9ef7ab6f' => 
    array (
      0 => '/var/www/html/modules/servers/vpnservernoapi/templates/downloadcert.tpl',
      1 => 1605080588,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fb4b8403ba7f5_00446165 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="row">
<div class="col-md-12">
<?php echo '<script'; ?>
>
$(document).ready(function(){
<?php if ($_smarty_tpl->tpl_vars['downloadovpn']->value == 1) {?>
window.open('<?php echo $_smarty_tpl->tpl_vars['systemURL']->value;?>
client.ovpn');
<?php }
if ($_smarty_tpl->tpl_vars['downloadcert']->value == 1) {?>
window.open('<?php echo $_smarty_tpl->tpl_vars['systemURL']->value;?>
ca-cert.pem');
<?php }?>
})
<?php echo '</script'; ?>
>

<h3 class="text-center">Download Cert. Files</h3>
<table class="table table-striped">
<tr><th>Server Name</th><th>Action</th></tr>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['allservers']->value, 'server');
$_smarty_tpl->tpl_vars['server']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['server']->value) {
$_smarty_tpl->tpl_vars['server']->do_else = false;
?>                
<tr><td><img src="<?php echo $_smarty_tpl->tpl_vars['server']->value['flag'];?>
" width="30px; margin-right: 10px;"> <?php echo $_smarty_tpl->tpl_vars['server']->value['name'];?>
</td>
<td> <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['systemurl']->value;?>
includes/downloadcert.php" style="float: left; width: 100%; margin-bottom: 5px; padding-bottom: 5px; border-bottom: solid 1px #efefef;">

<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['server']->value['file'], 'file');
$_smarty_tpl->tpl_vars['file']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['file']->value) {
$_smarty_tpl->tpl_vars['file']->do_else = false;
?>
<button name="d" type="submit" value="<?php echo $_smarty_tpl->tpl_vars['file']->value;?>
" class="btn btn-sm btn-success dropdown-item" style="margin-bottom: 5px; text-align: center;"><i class="fa fa-download"></i> Download <?php echo $_smarty_tpl->tpl_vars['file']->value;?>
</button>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> 
<input type="hidden" name="s" value="<?php echo $_smarty_tpl->tpl_vars['server']->value['ip'];?>
" />
</form>
</td>                
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</table>
</div>
</div><?php }
}
