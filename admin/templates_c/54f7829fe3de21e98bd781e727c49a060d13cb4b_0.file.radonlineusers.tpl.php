<?php
/* Smarty version 3.1.36, created on 2022-08-26 10:27:41
  from '/var/www/html/billing/modules/addons/vpnpanel/templates/radonlineusers.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_6308a01d5e8d78_65413944',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '54f7829fe3de21e98bd781e727c49a060d13cb4b' => 
    array (
      0 => '/var/www/html/billing/modules/addons/vpnpanel/templates/radonlineusers.tpl',
      1 => 1661502792,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6308a01d5e8d78_65413944 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
>
    $(document).ready(function() 
    {
        $('.datatable').DataTable({
            iDisplayLength: 25,
            order: [[4, 'desc']],
        });     
           
        $(document).find('#activeclinets_length').append('<label style="float: right">Protocal: <select class="form-control" style="width: 97px" onchange="window.location.href=this.value"><option value="addonmodules.php?module=vpnpanel&action=vpn_onlineusers&proto=ikev2" <?php echo $_smarty_tpl->tpl_vars['ikev2active']->value;?>
>ikev2</option><option value="addonmodules.php?module=vpnpanel&action=vpn_onlineusers&proto=ovpn" <?php echo $_smarty_tpl->tpl_vars['ovpnactive']->value;?>
>openvpn</option><option value="addonmodules.php?module=vpnpanel&action=vpn_onlineusers" <?php echo $_smarty_tpl->tpl_vars['allactive']->value;?>
>All</option></select></label>');
        
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
    <h5 style="float: left;">Here , You can see the list of VPN online users.</h5>
    <!-- <form method="post" style="float:right;">
            <button class="btn btn-success" name="resetonlineusers">Reset Online Users</button>
        </form> -->
    </div>
            
</div>
            
<!-- Message -->

<div class="message" style="float: left; width: 100%;">
    <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

</div>

<!---clinet list--->
<div class="row" style="margin-top:30px;"> 
    <div class="col-md-12">
        
        <!-- <p>Show Only <a class="btn btn-primary <?php echo $_smarty_tpl->tpl_vars['ikev2active']->value;?>
" href="addonmodules.php?module=vpnpanel&action=vpn_onlineusers&proto=ikev2">Ikev2</a> <a class="btn btn-primary <?php echo $_smarty_tpl->tpl_vars['ovpnactive']->value;?>
" href="addonmodules.php?module=vpnpanel&action=vpn_onlineusers&proto=ovpn">OVPN</a> <a class="btn btn-primary <?php echo $_smarty_tpl->tpl_vars['allactive']->value;?>
" href="addonmodules.php?module=vpnpanel&action=vpn_onlineusers">All</a></p> -->
<table class="table table-bordered table-striped datatable" id="activeclinets">
    <thead>
        <tr>
        <th>Account ID</th>
            <th>Name</th>
            <th>Username</th>
            <th>IP Address</th>
            <th>Start Time</th>
            <th>Update Time</th>
            <th>Stop Time</th>
            <th>Terminate Cause</th>
            <th>Session Time</th>
            <th>Protocol</th>
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
                    <?php echo $_smarty_tpl->tpl_vars['activeclient']->value->radacctid;?>

                </td>
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
                <td><?php echo $_smarty_tpl->tpl_vars['activeclient']->value->acctupdatetime;?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['activeclient']->value->acctstoptime;?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['activeclient']->value->acctterminatecause;?>
</td>
                <td>
                    <?php echo $_smarty_tpl->tpl_vars['activeclient']->value->total;?>

                </td>
                <td>
                    <?php if ($_smarty_tpl->tpl_vars['activeclient']->value->nasportid == 'ikev2') {?>
                        ikev2
                    <?php } else { ?>
                        openvpn
                    <?php }?>
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
