<?php
/* Smarty version 3.1.36, created on 2020-11-19 08:26:51
  from '/var/www/html/modules/addons/vpnpanel/templates/vpnGroup.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fb62c4b4f4b43_39892862',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '86bfaa5b69b590f54b650fa3add24692730b1de3' => 
    array (
      0 => '/var/www/html/modules/addons/vpnpanel/templates/vpnGroup.tpl',
      1 => 1605080588,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fb62c4b4f4b43_39892862 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="fullpageloader" style="position: fixed; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 99999; top: 0px; left: 0px; display: none;">
    <p style="position: absolute; left: 40%; top: 30%; color: #fff; font-size: 25px;"><i class="fa fa-circle-o-notch  fa-spin"></i> Loading Please wait...</p>
</div>
<?php echo $_smarty_tpl->tpl_vars['message']->value;?>

<hr>
<h1>Server Group</h1>
<h5><?php if ($_smarty_tpl->tpl_vars['edit']->value == 'true') {?>Update<?php } else { ?>Create<?php }?> Group for VPN Servers</h5>

<div class="tab-content admin-tabs" style="
     padding: 0px 33px;
     ">
     <?php if ($_smarty_tpl->tpl_vars['edit']->value == 'true') {?>
     <form method="post" action="" id="configform">
     <table class="table table-bordered" style="background: rgb(250, 250, 250);">
        <tbody>
            
            <tr><td style="text-align:right" width="300">Group Name</td><td><input type="hidden" name="gid" value="<?php echo $_smarty_tpl->tpl_vars['groupid']->value;?>
">
                <input type="text" class="form-control" name="groupname" value="<?php echo $_smarty_tpl->tpl_vars['groupname']->value;?>
" placeholder="Enter Group Name" style="width: 50%"></td></tr>
        </tbody>
        <tfoot><tr><td colspan="2"><div class="btn-container">
        <input type="submit" value="Save Changes" name="saveGroup" class="btn btn-primary"> <input type="button" value="Cancel Changes" onclick="window.location='addonmodules.php?module=vpnpanel&action=vpn_servers'" class="btn btn-default">
    </div></td></tr></tfoot>
     </table>
    </form>
     <?php } else { ?>
    <form method="post" action="" id="configform">
     <table class="table table-bordered" style="background: rgb(250, 250, 250);">
        <tbody>
            <tr><td style="text-align:right" width="300">Group Name</td><td><input type="text" class="form-control" name="groupname" placeholder="Enter Group Name" style="width: 50%"></td></tr>
        </tbody>
        <tfoot><tr><td colspan="2">
<div class="btn-container">
        <input type="submit" value="Save Changes" name="saveGroup" class="btn btn-primary"> <input type="button" value="Cancel Changes" onclick="window.location='addonmodules.php?module=vpnpanel&action=vpn_servers'" class="btn btn-default">
    </div></td></tr></tfoot>
     </table>
    </form>
<?php }?>
    <div class="row">
        <!--a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Go Back</a-->
    </div>     

</div>



 
    <style>
        .modal-dialog
        {
            width: 50% !important;
        }
        @media screen and (max-width:950px)
        {
            .modal-dialog
            {
                width: 95% !important;
            }
        }

        .modal .fieldarea
        {
            font-weight: bold;
        }
    </style>

<?php }
}
