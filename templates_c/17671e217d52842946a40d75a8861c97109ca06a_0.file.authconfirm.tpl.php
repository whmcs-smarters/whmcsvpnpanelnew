<?php
/* Smarty version 3.1.36, created on 2020-11-11 10:27:38
  from '/var/www/html/admin/templates/blend/authconfirm.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fabbc9aad0b78_65292254',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '17671e217d52842946a40d75a8861c97109ca06a' => 
    array (
      0 => '/var/www/html/admin/templates/blend/authconfirm.tpl',
      1 => 1605080587,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fabbc9aad0b78_65292254 (Smarty_Internal_Template $_smarty_tpl) {
?><style>
.contentarea {
    background-color: #f8f8f8;
}
</style>

<div class="auth-container">

    <h2>Confirm password to continue</h2>

    <p>You are entering an administrative area of WHMCS and must confirm your password to continue.</p>

    <?php if ($_smarty_tpl->tpl_vars['incorrect']->value) {?>
        <div class="alert alert-danger text-center" style="padding:5px;margin-bottom:10px;">Password incorrect</div>
    <?php }?>

    <form method="post" action="">
        <input type="hidden" name="authconfirm" value="1">

        <div class="form-group">
            <label for="inputConfirmPassword">Password</label>
            <input type="password" class="form-control" id="inputConfirmPassword" name="confirmpw" placeholder="" autofocus>
        </div>

        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['post_fields']->value, 'value', false, 'name');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['name']->value => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
            <input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
" />
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

        <button type="submit" class="btn btn-primary btn-block">Confirm password</button>
    </form>

</div>
<?php }
}
