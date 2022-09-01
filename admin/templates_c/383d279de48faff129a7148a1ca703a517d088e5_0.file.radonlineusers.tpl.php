<?php
/* Smarty version 3.1.36, created on 2020-10-07 07:49:21
  from '/var/www/html/whmcs/modules/addons/vpnpanel/templates/radonlineusers.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5f7d7301009892_74647074',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '383d279de48faff129a7148a1ca703a517d088e5' => 
    array (
      0 => '/var/www/html/whmcs/modules/addons/vpnpanel/templates/radonlineusers.tpl',
      1 => 1602047800,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f7d7301009892_74647074 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
>
    $(document).ready(function() 
    {
        $('.datatable').DataTable({
            iDisplayLength: 25
        });        
        
    });
<?php echo '</script'; ?>
>

<style>
#activeclinets th, #activeclinets td
{
    text-align: center;
}
</style>



<!--breadcrumb-->

<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <?php echo $_smarty_tpl->tpl_vars['breadcrumb']->value;?>

            </ol>
        </nav>
    </div>
            
    <div class="col-md-12"><h2>Online Users List</h2>
    <h5>Here , You can see the list of VPN online users.</h5></div>
</div>
            
<!-- Message -->

<div class="message" style="float: left; width: 100%;">
    <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

</div>

<!---clinet list--->
<div class="row" style="margin-top:30px;"> 
    <div class="col-md-12">
<table class="table table-bordered table-striped datatable" id="activeclinets">
    <thead>
        <tr>
            <th>Name</th>
            <th>Username</th>
            <th>IP Address</th>
            <th>Start Time</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['activeclients']->value, 'activeclient');
$_smarty_tpl->tpl_vars['activeclient']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['activeclient']->value) {
$_smarty_tpl->tpl_vars['activeclient']->do_else = false;
?>
            <tr>
                <td>
                    <a href="clientssummary.php?userid=<?php echo $_smarty_tpl->tpl_vars['activeclient']->value->userid;?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['activeclient']->value->name;?>
</a>
                </td>
                
                <td>
                    <a href="clientsservices.php?userid=<?php echo $_smarty_tpl->tpl_vars['activeclient']->value->userid;?>
&productselect=<?php echo $_smarty_tpl->tpl_vars['activeclient']->value->serviceid;?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['activeclient']->value->Username;?>
</a>
                </td>
                
                <td>
                    IP: <?php echo $_smarty_tpl->tpl_vars['activeclient']->value->FramedIPAddress;?>
 </br>
                    MAC: <?php echo $_smarty_tpl->tpl_vars['activeclient']->value->CallingStationId;?>

                </td>
                
                <td><?php echo $_smarty_tpl->tpl_vars['activeclient']->value->AcctStartTime;?>
</td>
                <td>
                    <?php echo $_smarty_tpl->tpl_vars['activeclient']->value->total;?>

                </td>
            </tr>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </tbody>
</table>
<div>
    <a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Go Back</a>
</div>
    </div>
</div><?php }
}
