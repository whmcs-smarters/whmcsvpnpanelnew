<?php
/* Smarty version 3.1.36, created on 2020-11-11 10:19:38
  from '/var/www/html/templates/six/clientareainvoices.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fabbaba224924_74434491',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '159177bcc7a10a38eada6929e1b6e77afc004e43' => 
    array (
      0 => '/var/www/html/templates/six/clientareainvoices.tpl',
      1 => 1605080588,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fabbaba224924_74434491 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/tablelist.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('tableName'=>"InvoicesList",'filterColumn'=>"4"), 0, true);
echo '<script'; ?>
 type="text/javascript">
    jQuery(document).ready( function ()
    {
        var table = jQuery('#tableInvoicesList').removeClass('hidden').DataTable();
        <?php if ($_smarty_tpl->tpl_vars['orderby']->value == 'default') {?>
            table.order([4, 'desc'], [2, 'asc']);
        <?php } elseif ($_smarty_tpl->tpl_vars['orderby']->value == 'invoicenum') {?>
            table.order(0, '<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
');
        <?php } elseif ($_smarty_tpl->tpl_vars['orderby']->value == 'date') {?>
            table.order(1, '<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
');
        <?php } elseif ($_smarty_tpl->tpl_vars['orderby']->value == 'duedate') {?>
            table.order(2, '<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
');
        <?php } elseif ($_smarty_tpl->tpl_vars['orderby']->value == 'total') {?>
            table.order(3, '<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
');
        <?php } elseif ($_smarty_tpl->tpl_vars['orderby']->value == 'status') {?>
            table.order(4, '<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
');
        <?php }?>
        table.draw();
        jQuery('#tableLoading').addClass('hidden');
    });
<?php echo '</script'; ?>
>

<div class="table-container clearfix">
    <table id="tableInvoicesList" class="table table-list hidden">
        <thead>
            <tr>
                <th><?php echo $_smarty_tpl->tpl_vars['LANG']->value['invoicestitle'];?>
</th>
                <th><?php echo $_smarty_tpl->tpl_vars['LANG']->value['invoicesdatecreated'];?>
</th>
                <th><?php echo $_smarty_tpl->tpl_vars['LANG']->value['invoicesdatedue'];?>
</th>
                <th><?php echo $_smarty_tpl->tpl_vars['LANG']->value['invoicestotal'];?>
</th>
                <th><?php echo $_smarty_tpl->tpl_vars['LANG']->value['invoicesstatus'];?>
</th>
                <th class="responsive-edit-button" style="display: none;"></th>
            </tr>
        </thead>
        <tbody>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['invoices']->value, 'invoice', false, 'num');
$_smarty_tpl->tpl_vars['invoice']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['num']->value => $_smarty_tpl->tpl_vars['invoice']->value) {
$_smarty_tpl->tpl_vars['invoice']->do_else = false;
?>
                <tr onclick="clickableSafeRedirect(event, 'viewinvoice.php?id=<?php echo $_smarty_tpl->tpl_vars['invoice']->value['id'];?>
', false)">
                    <td><?php echo $_smarty_tpl->tpl_vars['invoice']->value['invoicenum'];?>
</td>
                    <td><span class="hidden"><?php echo $_smarty_tpl->tpl_vars['invoice']->value['normalisedDateCreated'];?>
</span><?php echo $_smarty_tpl->tpl_vars['invoice']->value['datecreated'];?>
</td>
                    <td><span class="hidden"><?php echo $_smarty_tpl->tpl_vars['invoice']->value['normalisedDateDue'];?>
</span><?php echo $_smarty_tpl->tpl_vars['invoice']->value['datedue'];?>
</td>
                    <td data-order="<?php echo $_smarty_tpl->tpl_vars['invoice']->value['totalnum'];?>
"><?php echo $_smarty_tpl->tpl_vars['invoice']->value['total'];?>
</td>
                    <td><span class="label status status-<?php echo $_smarty_tpl->tpl_vars['invoice']->value['statusClass'];?>
"><?php echo $_smarty_tpl->tpl_vars['invoice']->value['status'];?>
</span></td>
                    <td class="responsive-edit-button" style="display: none;">
                        <a href="viewinvoice.php?id=<?php echo $_smarty_tpl->tpl_vars['invoice']->value['id'];?>
" class="btn btn-block btn-info">
                            <?php echo $_smarty_tpl->tpl_vars['LANG']->value['invoicesview'];?>

                        </a>
                    </td>
                </tr>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </tbody>
    </table>
    <div class="text-center" id="tableLoading">
        <p><i class="fas fa-spinner fa-spin"></i> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['loading'];?>
</p>
    </div>
</div>
<?php }
}
