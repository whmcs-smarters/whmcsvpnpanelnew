<?php
/* Smarty version 3.1.36, created on 2020-11-19 09:57:38
  from '/var/www/html/modules/addons/vpnpanel/templates/listusers.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fb641929469a3_11780424',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '239b714ef5f56a4e70a9c3e0ecd1d9b7165680be' => 
    array (
      0 => '/var/www/html/modules/addons/vpnpanel/templates/listusers.tpl',
      1 => 1605779855,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fb641929469a3_11780424 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="row">
    <div class="col-md-12"><nav aria-label="breadcrumb">
  <ol class="breadcrumb">
      <?php echo $_smarty_tpl->tpl_vars['breadcrumb']->value;?>

  </ol>
</nav></div>
    <div class="col-md-12"><h2>Users List</h2>
    <h5>Here , You can see the list of users created under reseller.</h5></div>
   
    
    </div>
<div class="col-md-12">


<!--button class="btn btn-warning pull-right" id="reloadserverbtn"><i class="fa fa-refresh"></i> Reload Server List</button-->
<div class="message" style="float: left; width: 100%;"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</div>
<table class="table table-bordered table-striped datatable">
    <thead>
        <tr><th>ID.</th><th>Name</th><th>Login/Email Addres</th><th>Reseller</th><th>Actions</th></tr>
    </thead>
    <tbody>
        
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['affdata']->value, 'data');
$_smarty_tpl->tpl_vars['data']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
$_smarty_tpl->tpl_vars['data']->do_else = false;
?>
        <tr><td><a href="clientssummary.php?userid=<?php echo $_smarty_tpl->tpl_vars['data']->value['clientid'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['data']->value['clientid'];?>
</a></td>
        <td><a href="clientssummary.php?userid=<?php echo $_smarty_tpl->tpl_vars['data']->value['clientid'];?>
" target="_blank"><?php ob_start();
echo $_smarty_tpl->tpl_vars['data']->value['firstname'];
$_prefixVariable1 = ob_get_clean();
ob_start();
echo $_smarty_tpl->tpl_vars['data']->value['lastname'];
$_prefixVariable2 = ob_get_clean();
if ($_prefixVariable1 == '' && $_prefixVariable2 == '') {?>No Name <?php } else { ?> <?php echo $_smarty_tpl->tpl_vars['data']->value['firstname'];?>
 <?php echo $_smarty_tpl->tpl_vars['data']->value['lastname'];
}?></a></td>
        <td><a href="mailto:<?php echo $_smarty_tpl->tpl_vars['data']->value['email'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['data']->value['email'];?>
</a></td>
        <td><?php echo $_smarty_tpl->tpl_vars['owneremail']->value;?>
</td>
        <td><button id="user_<?php echo $_smarty_tpl->tpl_vars['data']->value['clientid'];?>
" class="showService btn btn-info" alt="View Services"><i class="fa fa-arrow-down"></i> VIEW SERVICES</button>
        <button id="user_<?php echo $_smarty_tpl->tpl_vars['data']->value['clientid'];?>
" class="hideService btn btn-info" style="display: none;"><i class="fa fa-arrow-up"></i> HIDE SERVICES</button>
        </td></tr>
        <tr class="user_<?php echo $_smarty_tpl->tpl_vars['data']->value['clientid'];?>
" style="display: none !important;">
            <td colspan="5">
            <table class="table table-bordered table-striped datatable">
    <thead>
        <tr><th>Service Name.</th><th>Billing Cycle</th><th>Next Due Date</th><th>VPN Username</th><th>VPN Password</th><th>Status</th></tr>
    </thead>
    <tbody>
      
        <?php ob_start();
echo $_smarty_tpl->tpl_vars['data']->value['clientid'];
$_prefixVariable3 = ob_get_clean();
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['servicedata']->value[$_prefixVariable3], 'data');
$_smarty_tpl->tpl_vars['data']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
$_smarty_tpl->tpl_vars['data']->do_else = false;
?>
        
        <tr ><td><a href="clientsservices.php?userid=<?php echo $_smarty_tpl->tpl_vars['data']->value['clientid'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>
 - <?php echo $_smarty_tpl->tpl_vars['data']->value['groupname'];?>
</a></td>
        <td><?php echo $_smarty_tpl->tpl_vars['data']->value['billingcycle'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['data']->value['nextduedate'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['data']->value['username'];?>
</td>
        <td><p class="hidePass1 pull-left" style="margin: 5px;">**********</p>
        <p class="viewPass1 pull-left" style="display: none; margin: 5px;"><?php echo $_smarty_tpl->tpl_vars['data']->value['password'];?>
</p>
        <button class="viewPass pull-left btn btn-info" style="display:block;"><i class="fa fa-eye"></i></button>
        <button class="hidePass pull-left btn btn-info" style="display: none;"><i class="fa fa-eye-slash"></i></button>
        </td>
        <td><?php ob_start();
echo $_smarty_tpl->tpl_vars['data']->value['status'];
$_prefixVariable4 = ob_get_clean();
if ($_prefixVariable4 == 'Active') {?><span class="label label-success">Active</span>
        <?php } else { ?>
        <span class="label label-warning"><?php echo $_smarty_tpl->tpl_vars['data']->value['status'];?>
</span><?php }?></td></tr>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </tbody>
</table></td></tr>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </tbody>
</table>
<div class="row">
    <a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
&action=vpn_resellers" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Go Back</a>
</div>
</div>
<style>
.btn-xs
{
    font-size:10px;
    border-radius: 50%;
    padding: 4px 5px;
}
</style>
<?php echo '<script'; ?>
>
    $(document).ready(function(){
        
        $('.viewPass').click(function(){
            $(this).hide();
            $(this).parent('td').children('p.hidePass1').hide();
            
            $(this).parent('td').children('p.viewPass1').show();
            $(this).parent('td').children('button.hidePass').show();
            
        })
        $('.hidePass').click(function(){
            $(this).hide();
            $(this).parent('td').children('p.viewPass1').hide();
            
            $(this).parent('td').children('p.hidePass1').show();
            $(this).parent('td').children('button.viewPass').show();
            
        })
        
        $('.showService').click(function(){
            var cls = $(this).attr('id');
            $(this).parent('td').children('.hideService').show();
            $(this).parent('td').children('.showService').hide();
            $('.'+cls+'').show(0);
        })
         $('.hideService').click(function(){
            var cls = $(this).attr('id');
            $(this).parent('td').children('.hideService').hide();
            $(this).parent('td').children('.showService').show();
            $('.'+cls+'').hide(0);
        })
    })
<?php echo '</script'; ?>
>
<?php }
}
