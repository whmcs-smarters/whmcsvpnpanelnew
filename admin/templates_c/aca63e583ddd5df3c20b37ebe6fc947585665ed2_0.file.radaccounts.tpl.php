<?php
/* Smarty version 3.1.36, created on 2020-11-11 13:30:43
  from '/var/www/html/modules/addons/vpnpanel/templates/radaccounts.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fabe78372d304_75665022',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'aca63e583ddd5df3c20b37ebe6fc947585665ed2' => 
    array (
      0 => '/var/www/html/modules/addons/vpnpanel/templates/radaccounts.tpl',
      1 => 1605080588,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fabe78372d304_75665022 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
>
    $(document).ready(function() 
    {
        
        $('#displayallclients').DataTable({
            iDisplayLength: 25
        });
        
        
        /*
        $('.viewPass').click(function(){
            $(this).hide();
            $(this).parent('td').children('p.hidePass1').hide();
            
            $(this).parent('td').children('p.viewPass1').show();
            $(this).parent('td').children('button.hidePass').show();
            
        });
        
        $('.hidePass').click(function(){
            $(this).hide();
            $(this).parent('td').children('p.viewPass1').hide();
            
            $(this).parent('td').children('p.hidePass1').show();
            $(this).parent('td').children('button.viewPass').show();
            
        });
        
        $('.showService').click(function(){
            var cls = $(this).attr('id');
            $(this).parent('td').children('.hideService').show();
            $(this).parent('td').children('.showService').hide();
            $('.'+cls+'').show(0);
        });
        
         $('.hideService').click(function(){
            var cls = $(this).attr('id');
            $(this).parent('td').children('.hideService').hide();
            $(this).parent('td').children('.showService').show();
            $('.'+cls+'').hide(0);
        });
        */
        
        
    });
<?php echo '</script'; ?>
>


<!--breadcrumb-->

<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <?php echo $_smarty_tpl->tpl_vars['breadcrumb']->value;?>

            </ol>
        </nav>
    </div>
            
    <div class="col-md-12"><h2>VPN Accounts  List</h2>
    <h5>Here , You can see the list of VPN Accounts ( Users)</h5></div>
</div>
            
<!-- Message -->

<div class="message" style="float: left; width: 100%;">
    <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

</div>

<!---clinet list--->
    
<table class="table datatable" id="displayallclients" style="margin-top:20px;border-spacing: 0px;">
    <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email Addres</th>
            <th>Owner</th>
            <th>Services</th>
            <th>Created</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['radclients']->value, 'radclient');
$_smarty_tpl->tpl_vars['radclient']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['radclient']->value) {
$_smarty_tpl->tpl_vars['radclient']->do_else = false;
?>
            <tr>
                <td>
                    <a href="clientssummary.php?userid=<?php echo $_smarty_tpl->tpl_vars['radclient']->value['userid'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['radclient']->value['userid'];?>
</a>
                </td>
                <td>
                    <a href="clientssummary.php?userid=<?php echo $_smarty_tpl->tpl_vars['radclient']->value['userid'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['radclient']->value['firstname'];?>
</a>
                </td>
                <td>
                    <a href="clientssummary.php?userid=<?php echo $_smarty_tpl->tpl_vars['radclient']->value['userid'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['radclient']->value['lastname'];?>
</a>
                </td>
                <td>
                    <a href="mailto:<?php echo $_smarty_tpl->tpl_vars['radclient']->value['email'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['radclient']->value['email'];?>
</a>
                </td>
                <td><?php echo $_smarty_tpl->tpl_vars['radclient']->value['owner'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['radclient']->value['services'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['radclient']->value['created_at'];?>
</td>
                <td>
                   <span class="label <?php echo mb_strtolower($_smarty_tpl->tpl_vars['radclient']->value['status'], 'UTF-8');?>
"><?php echo $_smarty_tpl->tpl_vars['radclient']->value['status'];?>
</span>
                </td>
                
                
                <td>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
&action=vpn_userServices&userid=<?php echo $_smarty_tpl->tpl_vars['radclient']->value['userid'];?>
" class="showService btn btn-info" alt="View Services"> View Services</a>
                </td>
            </tr>
            
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </tbody>
</table>
<div class="row">
    <a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Go Back</a>
</div><?php }
}
