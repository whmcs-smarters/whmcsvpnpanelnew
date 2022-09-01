<?php
/* Smarty version 3.1.36, created on 2020-10-07 06:39:39
  from '/var/www/html/whmcs/modules/addons/vpnpanel/templates/vpnsettings.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5f7d62ab64acd3_00192903',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'df2fd7546e157ea5385c9338d8e3839bea837857' => 
    array (
      0 => '/var/www/html/whmcs/modules/addons/vpnpanel/templates/vpnsettings.tpl',
      1 => 1602047812,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f7d62ab64acd3_00192903 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="fullpageloader" style="position: fixed; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 99999; top: 0px; left: 0px; display: none;">
    <p style="position: absolute; left: 40%; top: 30%; color: #fff; font-size: 25px;"><i class="fa fa-circle-o-notch  fa-spin"></i> Loading Please wait...</p>
</div><h2>VPN Settings</h2>
<h5></h5>
<p class="alert alert-info"><strong>Note</strong> : These Setting will be used for VPN products.</p>
<div class="message"></div>

<form method="post" action="">
  <div class="col-md-12">
    <table class="table table-bordered table-striped">
      <tbody><tr><th>Show Download Cert. Button</th><td><input type="checkbox" name="downloadcert" <?php if ($_smarty_tpl->tpl_vars['data']->value['downloadcert'] == 'on') {?>checked<?php }?> value="on"><p>(Tick to show download cert. button in client area.)</p></td></tr>
      <tr><th>Show VPN Login Details</th><td><input type="checkbox" name="vpndetails" <?php if ($_smarty_tpl->tpl_vars['data']->value['vpndetails'] == 'on') {?>checked<?php }?> value="on"><p>Tick to show VPN login details in client area. (FOR WINDOWS/LINUX/iOS)</p></td></tr>
      <tr><th>Password Type</th><td><label><input type="radio" <?php if ($_smarty_tpl->tpl_vars['data']->value['passwordtype'] == 'random') {?>checked<?php }?> class="Randpasstype" name="passwordtype" value="random"> Random Password</label>
        <label><input type="radio" class="Staticpasstype" <?php if ($_smarty_tpl->tpl_vars['data']->value['passwordtype'] == 'static') {?>checked<?php }?> name="passwordtype" value="static"> Static/Fixed Password</label>
        <input type="text" name="staticPass" <?php if ($_smarty_tpl->tpl_vars['data']->value['staticPass'] != '') {?> value="<?php echo $_smarty_tpl->tpl_vars['data']->value['staticPass'];?>
" <?php } else { ?>style="display: none;"<?php }?>  class="form-control staticPass" placeholder="Enter static password">
        <p>(Select Password Type you want to use for your clients)</p></td></tr>
      
      <tr><th>Manage Fields</th><td><p class="text-center">Select Fields you want to show in reseller panel while add user.</p>
        <table class="table">
          <tr><th>Field</th><th>Action</th></tr>
          <tr><td>Full Name</td><td><input type="checkbox" <?php if ($_smarty_tpl->tpl_vars['data']->value['showName'] == 'on') {?> checked <?php }?> name="showName" value="on"></td></tr>
          <tr><td>Phone</td><td><input type="checkbox" <?php if ($_smarty_tpl->tpl_vars['data']->value['showPhone'] == 'on') {?>  checked <?php }?> name="showPhone" value="on"></td></tr>
          <tr><td>Company</td><td><input type="checkbox" <?php if ($_smarty_tpl->tpl_vars['data']->value['showCompany'] == 'on') {?> checked <?php }?> name="showCompany" value="on"></td></tr>
          <tr><td>Address</td><td><input type="checkbox" <?php if ($_smarty_tpl->tpl_vars['data']->value['showAddress'] == 'on') {?> checked <?php }?> name="showAddress" value="on"></td></tr>
        </table>
      </td></tr>
      <tr><td colspan="2"><button class="btn btn-success pull-right" name="saveSetting">Save Changes</button></td></tr>
    </tbody>
      
    </table>
  </div>
</form>


<div class="row">
  <div class="col-md-12" style="margin-bottom: 30px;">
<a href="https://www.whmcssmarters.com/clients/index.php?rp=/knowledgebase/151/Lost-Your-API-Key-or-System-moved-or-Re-install-VPN-Panel-.html"  target="_blank" class="link" style="float:left; clear: both; text-decoration: underline;">Lost Your API Key ?</a>
<a href="https://www.whmcssmarters.com/clients/index.php?rp=/knowledgebase/151/Lost-Your-API-Key-or-System-moved-or-Re-install-VPN-Panel-.html"  target="_blank" class="link" style="float:left; clear: both; text-decoration: underline;">System Upgraded ? Re-issue your API Key</a>
  </div>
</div>
<div class="row">
    <a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Go Back</a>
</div>

<style>
.error
{
    border-color: #f00;
    box-shadow: 0px 0px 5px -2px;
}
.activeinput
{
   
}
</style>

<?php echo '<script'; ?>
>

$('document').ready(function()
{
  $('.Staticpasstype').click(function(){
    $('.staticPass').show();
  })
  $('.Randpasstype').click(function(){
    $('.staticPass').hide();
  })
});
<?php echo '</script'; ?>
>
<?php }
}
