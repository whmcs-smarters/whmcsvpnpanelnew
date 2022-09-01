<?php
/* Smarty version 3.1.36, created on 2020-11-11 09:46:01
  from '/var/www/html/templates/six/error/page-not-found.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fabb2d978c130_24106587',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '886eb3f433a6670b79e44b590f61596d7875582f' => 
    array (
      0 => '/var/www/html/templates/six/error/page-not-found.tpl',
      1 => 1605080588,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fabb2d978c130_24106587 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="container">

    <div class="error-container boxed">

        <h1><i class="fas fa-exclamation-triangle"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"errorPage.404.title"),$_smarty_tpl ) );?>
</h1>
        <h3><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"errorPage.404.subtitle"),$_smarty_tpl ) );?>
</h3>
        <p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"errorPage.404.description"),$_smarty_tpl ) );?>
</p>

        <div class="buttons">
            <a href="<?php echo $_smarty_tpl->tpl_vars['systemurl']->value;?>
" class="btn btn-default">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"errorPage.404.home"),$_smarty_tpl ) );?>

            </a>
            <a href="<?php echo $_smarty_tpl->tpl_vars['systemurl']->value;?>
submitticket.php" class="btn btn-default">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"errorPage.404.submitTicket"),$_smarty_tpl ) );?>

            </a>
        </div>

    </div>

</div>
<?php }
}
