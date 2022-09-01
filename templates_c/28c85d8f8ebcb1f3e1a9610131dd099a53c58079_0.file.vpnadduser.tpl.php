<?php
/* Smarty version 3.1.36, created on 2020-11-19 07:37:43
  from '/var/www/html/modules/addons/vpnpanel/templates/vpnadduser.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fb620c789d066_62617884',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '28c85d8f8ebcb1f3e1a9610131dd099a53c58079' => 
    array (
      0 => '/var/www/html/modules/addons/vpnpanel/templates/vpnadduser.tpl',
      1 => 1605080588,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:modules/addons/vpnpanel/templates/nav_header.tpl' => 1,
  ),
),false)) {
function content_5fb620c789d066_62617884 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 src="modules/addons/vpnpanel/templates/js/sample.js"><?php echo '</script'; ?>
>
<style>
    ::-moz-placeholder {
        color: #555 !important;
    }
</style>

<!-- Register -->   
<div class="container" style="width: 100%;margin-top: 40px;"> 
    <?php $_smarty_tpl->_subTemplateRender('file:modules/addons/vpnpanel/templates/nav_header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <div class="sm-content-container">
        <div class="sm-content">
            <div class="sm-page-heading">
                <h1><?php echo $_smarty_tpl->tpl_vars['pagetitle']->value;?>
</h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="index.php"> Portal Home
                        </a></li>
                    <li class="active">
                        Dashboard
                    </li>
                </ol>
            </div> 
            <?php if ($_smarty_tpl->tpl_vars['result']->value != '') {?>
                <div class="alert alert-<?php echo $_smarty_tpl->tpl_vars['result']->value;?>
 alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

                </div>
            <?php }?>
            <form method="POST" autocomplete="off" class="form_custom" id="form-add-user">
               <div style="width:100%;" class="">
                                                        <div class="heading-bar">
                                                            <img src="modules/addons/vpnpanel/templates/images/hosting-icon.png" alt="img"><h3>User Details <font style="font-size:10px;">(This below Email and Password is used to login into VPN App)</font></h3>
                                                        </div>
                                                        <div class="panel-body">
                                                            
                <div class="form-group col-md-6"><input class="form-control" placeholder="Email (Required)" type="text" name="login" id="login" value="" required></div>
                <div class="form-group col-md-6"><input class="form-control"  placeholder="Password (Leave Blank to generate automatically.)" type="password" name="password" id="password" value=""></div>
                <?php if ($_smarty_tpl->tpl_vars['settings']->value['showName'] != '') {?><div class="form-group col-md-6"><input class="form-control" type="text" placeholder="Name" name="clientname" id="clientname" value="">
                                </div>  <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['settings']->value['showCompany'] != '') {?><div class="form-group col-md-6"><input class="form-control" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareacompanyname'];?>
" type="text" name="companyname" id="companyname" value="">
                                    </div> <?php }?>
                
                <?php if ($_smarty_tpl->tpl_vars['settings']->value['showPhone'] != '') {?> <div class="form-group col-md-6"><input class="form-control" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareaphonenumber'];?>
" type="tel" name="phonenumber" id="phonenumber" value="">
                                                            </div>
                                                        <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['settings']->value['showAddress'] != '') {?><div class="form-group col-md-6"><input class="form-control" type="text"  placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareaaddress1'];?>
" name="address1" id="address1" value="">
                                        </div><?php }?>
                <!--<?php if ($_smarty_tpl->tpl_vars['userinfo']->value == 'yes') {?>
                    <div style="width:48%" class="col-lg-6 panel panel-default custom-user-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-user"></i>&nbsp;               <?php echo $_smarty_tpl->tpl_vars['selectuser']->value;?>
 Info
                            </h3>
                        </div> 
                        <div class="panel-body">
                <?php if ($_smarty_tpl->tpl_vars['optionactive']->value['login'] != '') {?><div class="form-group"><input class="form-control" placeholder="Email / Login" type="text" name="login" id="login" <?php if ((isset($_smarty_tpl->tpl_vars['optionactive']->value['login']))) {?>required<?php }?> value="">
                        <span> (Required for Billing Portal) </span>
                    </div><?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['optionactive']->value['password'] != '') {?><div class="form-group"><input class="form-control"  placeholder="Password" type="password" name="password" id="password" <?php if ((isset($_smarty_tpl->tpl_vars['optionactive']->value['password']))) {?>required<?php }?> value="">
                        </div> <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['optionactive']->value['confirmpassword'] != '') {?><div class="form-group"><input class="form-control" onfocusout="Confirm(this.value);" placeholder="Confirm Password" <?php if ((isset($_smarty_tpl->tpl_vars['optionactive']->value['confirmpassword']))) {?>required<?php }?> type="password" name="confirmpassword" id="confirmpassword" value="">
                            </div> <?php }?>
                            <!-- Firstname --
                            <?php if ($_smarty_tpl->tpl_vars['optionactive']->value['clientname'] != '') {?><div class="form-group"><input class="form-control" type="text" placeholder="Name" name="clientname" id="clientname" value="" <?php if ((isset($_smarty_tpl->tpl_vars['optionactive']->value['clientname']))) {?>required<?php }?>>
                                </div>  <?php }?>
                                <!-- companyname --
                                
                                    <!-- address1 --
                                    <?php if ($_smarty_tpl->tpl_vars['optionactive']->value['address1'] != '') {?><div class="form-group"><input class="form-control" type="text"  placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareaaddress1'];?>
" name="address1" id="address1" value="" <?php if ((isset($_smarty_tpl->tpl_vars['optionactive']->value['address1']))) {?>required<?php }?>>
                                        </div><?php }?>
                                        <!-- address2 --
                                        <?php if ($_smarty_tpl->tpl_vars['optionactive']->value['address2'] != '') {?><div class="form-group"><input class="form-control" type="text"   placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareaaddress2'];?>
" name="address2" id="address2" value="">
                                            </div><?php }?>
                                            <!-- city --
                                            <?php if ($_smarty_tpl->tpl_vars['optionactive']->value['city'] != '') {?><div class="form-group"><input class="form-control" type="text"  placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareacity'];?>
" name="city" id="city" value="" <?php if ((isset($_smarty_tpl->tpl_vars['optionactive']->value['city']))) {?>required<?php }?>>
                                                </div><?php }?>
                                                <!-- State --
                                                <?php if ($_smarty_tpl->tpl_vars['optionactive']->value['state'] != '') {?><div class="form-group">
                                                        <input class="form-control" placeholder="State" type="text" name="state" id="state" value="" <?php if ((isset($_smarty_tpl->tpl_vars['optionactive']->value['state']))) {?>required<?php }?>>
                                                    </div> <?php }?>

                                                    <!-- Post Code --
                                                    <?php if ($_smarty_tpl->tpl_vars['optionactive']->value['postcode'] != '') {?><div class="form-group"><input class="form-control" type="text"  placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareapostcode'];?>
" name="postcode" id="postcode" value="" <?php if ((isset($_smarty_tpl->tpl_vars['optionactive']->value['postcode']))) {?>required<?php }?>>
                                                        </div><?php }?>
                                                        <!-- phone --
                                                        <?php if ($_smarty_tpl->tpl_vars['optionactive']->value['phonenumber'] != '') {?> <div class="form-group"><input class="form-control" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareaphonenumber'];?>
" type="tel" name="phonenumber" id="phonenumber" value="" <?php if ((isset($_smarty_tpl->tpl_vars['optionactive']->value['phonenumber']))) {?>required<?php }?>>
                                                            </div>
                                                        <?php }?>
                                                    </div> 
                                                </div>
                                                    <?php }?>-->
                                                    <div style="width:100%;" class="">
                                                        <div class="heading-bar">
                                                            <img src="modules/addons/vpnpanel/templates/images/hosting-icon.png" alt="img"><h3>Choose your VPN Subscription</h3>
                                                        </div>
                                                        <div class="panel-body">
                                                            <center>
                                                                <ul class="productHolder" style="padding-left: 0px;">
                                                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['products']->value, 'product');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
                                                                        <li id="product1">
                                                                            <label for="p_<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
" class="product">

                                                                                <div class="price-table">
                                                                                    <div class="top-head">
                                                                                        <div class="top-area">
                                                                                            <h4 id="product1-name"><?php echo $_smarty_tpl->tpl_vars['product']->value->name;?>
</h4>
                                                                                        </div>

                                                                                        <div class="price-area">
                                                                                            <div class="price" id="product1-price">
                                                                                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['billingcycle']->value[$_smarty_tpl->tpl_vars['product']->value->id], 'billing');
$_smarty_tpl->tpl_vars['billing']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['billing']->value) {
$_smarty_tpl->tpl_vars['billing']->do_else = false;
?> 
                                                                                                    <?php if ($_smarty_tpl->tpl_vars['billing']->value->monthly != '-1') {?> 
                                                                                                        <?php if ($_smarty_tpl->tpl_vars['billing']->value->monthly != '') {?>
                                                                                                            <?php if ($_smarty_tpl->tpl_vars['billing']->value->paytype == 'onetime') {?>
                                                                                                                <?php echo $_smarty_tpl->tpl_vars['currency']->value->prefix;?>

                                                                                                                <?php echo $_smarty_tpl->tpl_vars['billing']->value->monthly;?>

                                                                                                                (One Time)
                                                                                                            <?php } else { ?> 

                                                                                                                <span style="font-style:normal; padding: 0px; color: inherit;"><?php echo $_smarty_tpl->tpl_vars['currency']->value->prefix;
echo $_smarty_tpl->tpl_vars['billing']->value->monthly;?>
</span>/mo
                                                                                                            <?php }?>
                                                                                                        <?php } else { ?>
                                                                                                            <span class="free" style="font-style:normal; padding: 0px; color: inherit;">FREE</span>
                                                                                                        <?php }?>
                                                                                                    <?php } elseif ($_smarty_tpl->tpl_vars['billing']->value->quarterly != '-1') {?> 
                                                                                                        <span style="font-style:normal; padding: 0px; color: inherit;"><?php echo $_smarty_tpl->tpl_vars['currency']->value->prefix;
echo $_smarty_tpl->tpl_vars['billing']->value->quarterly;?>
</span>/3 mo
                                                                                                    <?php } elseif ($_smarty_tpl->tpl_vars['billing']->value->semiannually != '-1') {?> 
                                                                                                        <span style="font-style:normal; padding: 0px; color: inherit;"><?php echo $_smarty_tpl->tpl_vars['currency']->value->prefix;
echo $_smarty_tpl->tpl_vars['billing']->value->semiannually;?>
</span>/6 mo
                                                                                                    <?php } elseif ($_smarty_tpl->tpl_vars['billing']->value->annually != '-1') {?> 
                                                                                                        <span style="font-style:normal; padding: 0px; color: inherit;"><?php echo $_smarty_tpl->tpl_vars['currency']->value->prefix;
echo $_smarty_tpl->tpl_vars['billing']->value->annually;?>
</span>/yr
                                                                                                    <?php } elseif ($_smarty_tpl->tpl_vars['billing']->value->biennially != '-1') {?> 
                                                                                                        <span style="font-style:normal; padding: 0px; color: inherit;"><?php echo $_smarty_tpl->tpl_vars['currency']->value->prefix;
echo $_smarty_tpl->tpl_vars['billing']->value->biennially;?>
</span>/2yr
                                                                                                    <?php } elseif ($_smarty_tpl->tpl_vars['billing']->value->triennially != '-1') {?> 
                                                                                                        <span style="font-style:normal; padding: 0px; color: inherit;"><?php echo $_smarty_tpl->tpl_vars['currency']->value->prefix;
echo $_smarty_tpl->tpl_vars['billing']->value->triennially;?>
</span>/3yr



                                                                                                    <?php }?>




                                                                                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                                                            </div>


                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- <ul>

                                                                                        <?php $_smarty_tpl->_assignInScope('des', explode("\n",$_smarty_tpl->tpl_vars['product']->value->description));?>

                                                                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['des']->value, 'list');
$_smarty_tpl->tpl_vars['list']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['list']->value) {
$_smarty_tpl->tpl_vars['list']->do_else = false;
?>
                                                                                            <li id="product1-description"><?php echo $_smarty_tpl->tpl_vars['list']->value;?>
</li>
                                                                                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>                               
                                                                                    </ul> -->
                                                                                    <label class="btn btn-primary form-control form_packageid">
                                                                                        <span style="color:#fff; ">Pick now</span>
                                                                                        <input type="radio" id="p_<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
" class="productRadio" name="packageid" value="<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
">
                                                                                    </label>



                                                                                </div>
                                                                            </label>
                                                                        </li>
                                                                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                                </ul>
                                                            </center>
                                                            <!--div class="form-group"> 
                                                                <select id="form_packageid" style="width:100%" name="packageid" class="form-control select-inline" tabindex="-1" aria-hidden="true">    
                                                                    <option value="">Choose Package for <?php echo $_smarty_tpl->tpl_vars['selectuser']->value;?>
</option>
                                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['products']->value, 'product');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
                                                             <option value="<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['product']->value->name;?>
</option> 
                                                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                        </select>
                                                    </div--> 
                                                            <div id="scrl" style="float: left; width: 100%;"></div>
                                                            <div class="heading-bar bilcyc" style="margin-bottom: 30px;">
                                                                <img src="modules/addons/vpnpanel/templates/images/billing-icon.png" alt="img"><h3>Billing Cycle</h3>
                                                            </div>
                                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['products']->value, 'product');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?> 
                                                                <?php if ($_smarty_tpl->tpl_vars['billingcycle']->value[$_smarty_tpl->tpl_vars['product']->value->id] != '') {?>  

                                                                    <div class="hideAll" id="showproduct-<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
" style="display:none; margin-top: 30px;"> 

                                                                        <div class="form-group">  
                                                                            <select id="customfield<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
" data-selector_id="<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
"  style="width: 100%;" class="form-control select-inline changeselectclass "  name="billingcycle[<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
]">
                                                                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['billingcycle']->value[$_smarty_tpl->tpl_vars['product']->value->id], 'billing');
$_smarty_tpl->tpl_vars['billing']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['billing']->value) {
$_smarty_tpl->tpl_vars['billing']->do_else = false;
?> 
                                                                                    <?php if ($_smarty_tpl->tpl_vars['billing']->value->monthly != '-1') {?> 
                                                                                        <option
                                                                                            data-current_position_ammount="<?php echo $_smarty_tpl->tpl_vars['billing']->value->monthly;?>
"            
                                                                                            data-current_position="monthly"
                                                                                            data-current_position_currency="<?php echo $_smarty_tpl->tpl_vars['currency']->value->prefix;?>
" data-current_position_suffix="<?php echo $_smarty_tpl->tpl_vars['currency']->value->suffix;?>
 (<?php if ($_smarty_tpl->tpl_vars['billing']->value->paytype == 'onetime') {?>One Time<?php } else { ?>Monthly<?php }?>)" value="monthly|<?php echo $_smarty_tpl->tpl_vars['billing']->value->currency;?>
|<?php echo $_smarty_tpl->tpl_vars['billing']->value->monthly;?>
"  ><?php echo $_smarty_tpl->tpl_vars['currency']->value->prefix;
echo $_smarty_tpl->tpl_vars['billing']->value->monthly;
echo $_smarty_tpl->tpl_vars['currency']->value->suffix;?>
 (<?php if ($_smarty_tpl->tpl_vars['billing']->value->paytype == 'onetime') {?>One Time<?php } else { ?>Monthly<?php }?>)</option>
                                                                                    <?php }?> <?php if ($_smarty_tpl->tpl_vars['billing']->value->quarterly != '-1') {?> 
                                                                                        <option
                                                                                            data-current_position_ammount="<?php echo $_smarty_tpl->tpl_vars['billing']->value->quarterly;?>
"
                                                                                            data-current_position="quarterly" data-current_position_currency="<?php echo $_smarty_tpl->tpl_vars['currency']->value->prefix;?>
"  data-current_position_suffix="<?php echo $_smarty_tpl->tpl_vars['currency']->value->suffix;?>
 (Quarterly)" value="quarterly|<?php echo $_smarty_tpl->tpl_vars['billing']->value->currency;?>
|<?php echo $_smarty_tpl->tpl_vars['billing']->value->quarterly;?>
"><?php echo $_smarty_tpl->tpl_vars['currency']->value->prefix;
echo $_smarty_tpl->tpl_vars['billing']->value->quarterly;
echo $_smarty_tpl->tpl_vars['currency']->value->suffix;?>
 (Quarterly)</option>
                                                                                    <?php }?> <?php if ($_smarty_tpl->tpl_vars['billing']->value->semiannually != '-1') {?> 
                                                                                        <option
                                                                                            data-current_position_ammount="<?php echo $_smarty_tpl->tpl_vars['billing']->value->semiannually;?>
"
                                                                                            data-current_position="semiannually" data-current_position_currency="<?php echo $_smarty_tpl->tpl_vars['currency']->value->prefix;?>
" data-current_position_suffix="<?php echo $_smarty_tpl->tpl_vars['currency']->value->suffix;?>
 (Semi-Annually)"
                                                                                            value="semiannually|<?php echo $_smarty_tpl->tpl_vars['billing']->value->currency;?>
|<?php echo $_smarty_tpl->tpl_vars['billing']->value->semiannually;?>
"><?php echo $_smarty_tpl->tpl_vars['currency']->value->prefix;
echo $_smarty_tpl->tpl_vars['billing']->value->semiannually;
echo $_smarty_tpl->tpl_vars['currency']->value->suffix;?>
 (Semi-Annually)</option>
                                                                                    <?php }?> <?php if ($_smarty_tpl->tpl_vars['billing']->value->annually != '-1') {?> 
                                                                                        <option
                                                                                            data-current_position_ammount="<?php echo $_smarty_tpl->tpl_vars['billing']->value->annually;?>
"
                                                                                            data-current_position="annually"
                                                                                            data-current_position_currency="<?php echo $_smarty_tpl->tpl_vars['currency']->value->prefix;?>
"
                                                                                            data-current_position_suffix="<?php echo $_smarty_tpl->tpl_vars['currency']->value->suffix;?>
 (Annually)"
                                                                                            value="annually|<?php echo $_smarty_tpl->tpl_vars['billing']->value->currency;?>
|<?php echo $_smarty_tpl->tpl_vars['billing']->value->annually;?>
"><?php echo $_smarty_tpl->tpl_vars['currency']->value->prefix;
echo $_smarty_tpl->tpl_vars['billing']->value->annually;
echo $_smarty_tpl->tpl_vars['currency']->value->suffix;?>
 (Annually)</option>
                                                                                    <?php }?> <?php if ($_smarty_tpl->tpl_vars['billing']->value->biennially != '-1') {?> 
                                                                                        <option 
                                                                                            data-current_position_ammount="<?php echo $_smarty_tpl->tpl_vars['billing']->value->biennially;?>
"
                                                                                            data-current_position="biennially"
                                                                                            data-current_position_currency="<?php echo $_smarty_tpl->tpl_vars['currency']->value->prefix;?>
"
                                                                                            data-current_position_suffix="<?php echo $_smarty_tpl->tpl_vars['currency']->value->suffix;?>
 (Biennially)" 
                                                                                            value="biennially|<?php echo $_smarty_tpl->tpl_vars['billing']->value->currency;?>
|<?php echo $_smarty_tpl->tpl_vars['billing']->value->biennially;?>
"><?php echo $_smarty_tpl->tpl_vars['currency']->value->prefix;
echo $_smarty_tpl->tpl_vars['billing']->value->biennially;
echo $_smarty_tpl->tpl_vars['currency']->value->suffix;?>
 (Biennially)</option>
                                                                                    <?php }?> 
                                                                                    <?php if ($_smarty_tpl->tpl_vars['billing']->value->triennially != '-1') {?> 
                                                                                        <option
                                                                                            data-current_position_ammount="<?php echo $_smarty_tpl->tpl_vars['billing']->value->triennially;?>
"
                                                                                            data-current_position="triennially"
                                                                                            data-current_position_currency="<?php echo $_smarty_tpl->tpl_vars['currency']->value->prefix;?>
"
                                                                                            data-current_position_suffix="<?php echo $_smarty_tpl->tpl_vars['currency']->value->suffix;?>
 (Triennially)"
                                                                                            value="triennially|<?php echo $_smarty_tpl->tpl_vars['billing']->value->currency;?>
|<?php echo $_smarty_tpl->tpl_vars['billing']->value->triennially;?>
"><?php echo $_smarty_tpl->tpl_vars['currency']->value->prefix;
echo $_smarty_tpl->tpl_vars['billing']->value->triennially;
echo $_smarty_tpl->tpl_vars['currency']->value->suffix;?>
 (Triennially)</option>
                                                                                    <?php }?> 
                                                                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                                            </select> 
                                                                            <span style="color:red;" class="amt_det">It will deduct <b><span id='deduct_amount<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
' style="font-weight: 800; font-size: 16px; color: #000;"><?php if ($_smarty_tpl->tpl_vars['billingcycle']->value[$_smarty_tpl->tpl_vars['product']->value->id][0]->monthly != '-1') {
echo $_smarty_tpl->tpl_vars['billingcycle']->value[$_smarty_tpl->tpl_vars['product']->value->id][0]->monthly;?>

                                                                                    <?php } elseif ($_smarty_tpl->tpl_vars['billingcycle']->value[$_smarty_tpl->tpl_vars['product']->value->id][0]->quarterly != '-1') {
echo $_smarty_tpl->tpl_vars['billingcycle']->value[$_smarty_tpl->tpl_vars['product']->value->id][0]->quarterly;?>

                                                                                    <?php } elseif ($_smarty_tpl->tpl_vars['billingcycle']->value[$_smarty_tpl->tpl_vars['product']->value->id][0]->semiannually != '-1') {
echo $_smarty_tpl->tpl_vars['billingcycle']->value[$_smarty_tpl->tpl_vars['product']->value->id][0]->semiannually;?>

                                                                                    <?php } elseif ($_smarty_tpl->tpl_vars['billingcycle']->value[$_smarty_tpl->tpl_vars['product']->value->id][0]->annually != '-1') {
echo $_smarty_tpl->tpl_vars['billingcycle']->value[$_smarty_tpl->tpl_vars['product']->value->id][0]->annually;?>

                                                                                    <?php } elseif ($_smarty_tpl->tpl_vars['billingcycle']->value[$_smarty_tpl->tpl_vars['product']->value->id][0]->biennially != '-1') {
echo $_smarty_tpl->tpl_vars['billingcycle']->value[$_smarty_tpl->tpl_vars['product']->value->id][0]->biennially;?>
 
                                                                                <?php } elseif ($_smarty_tpl->tpl_vars['billingcycle']->value[$_smarty_tpl->tpl_vars['product']->value->id][0]->triennially != '-1') {
echo $_smarty_tpl->tpl_vars['billingcycle']->value[$_smarty_tpl->tpl_vars['product']->value->id][0]->triennially;
}?> </span></b> credits from your account</span>
                                                                </div>  

                                                            </div><?php }?>
                                                            
                                                            <?php if (count($_smarty_tpl->tpl_vars['addonpackagearray']->value[$_smarty_tpl->tpl_vars['product']->value->id]) > 0) {?> 
                                                                <div class="hideAll" id="show1-<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
" style="display:none;"> 
                                                                    <div class="heading-bar" style="margin-bottom:15px;">
                                                                        <img src="modules/addons/vpnpanel/templates/images/billing-icon.png" alt="img"><h3>Addons</h3>
                                                                    </div>
                                                                    <div class="" id="showproduct1-<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
" style="display:block; margin-top: 30px;"> 
                                                                       <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['addonpackagearray']->value[$_smarty_tpl->tpl_vars['product']->value->id], 'addonpackageda');
$_smarty_tpl->tpl_vars['addonpackageda']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['addonpackageda']->value) {
$_smarty_tpl->tpl_vars['addonpackageda']->do_else = false;
?>
                                                                       <!-- <pre><?php echo print_r($_smarty_tpl->tpl_vars['addonpackageda']->value);?>
</pre>  -->
                                                                       <?php if ($_smarty_tpl->tpl_vars['addonpackageda']->value->addonpackagebillingcycle == 'onetime') {?>
                                                                            <?php if ($_smarty_tpl->tpl_vars['addonpackageda']->value->addonpackagemonthly != '-1.00') {?>
                                                                                 <?php $_smarty_tpl->_assignInScope('addonPrice', ((string)$_smarty_tpl->tpl_vars['addonpackageda']->value->addonpackagemonthly));?>
                                                                            <?php } elseif ($_smarty_tpl->tpl_vars['addonpackageda']->value->addonpackagequarterly != '-1.00') {?>
                                                                                <?php $_smarty_tpl->_assignInScope('addonPrice', ((string)$_smarty_tpl->tpl_vars['addonpackageda']->value->addonpackagequarterly));?>
                                                                            <?php } elseif ($_smarty_tpl->tpl_vars['addonpackageda']->value->addonpackageannually != '-1.00') {?>
                                                                                <?php $_smarty_tpl->_assignInScope('addonPrice', ((string)$_smarty_tpl->tpl_vars['addonpackageda']->value->addonpackageannually));?>
                                                                            <?php } elseif ($_smarty_tpl->tpl_vars['addonpackageda']->value->addonpackagebiennially != '-1.00') {?>
                                                                                <?php $_smarty_tpl->_assignInScope('addonPrice', ((string)$_smarty_tpl->tpl_vars['addonpackageda']->value->addonpackagebiennially));?>
                                                                            <?php } else { ?>
                                                                                <?php $_smarty_tpl->_assignInScope('addonPrice', ((string)$_smarty_tpl->tpl_vars['addonpackageda']->value->addonpackagetriennially));?>
                                                                            <?php }?>
                                                                       <?php } elseif ($_smarty_tpl->tpl_vars['addonpackageda']->value->addonpackagebillingcycle != 'free') {?>
                                                                            <?php if ($_smarty_tpl->tpl_vars['addonpackageda']->value->addonpackagemonthly != '-1.00') {?>
                                                                                 <?php $_smarty_tpl->_assignInScope('addonPrice', ((string)$_smarty_tpl->tpl_vars['addonpackageda']->value->addonpackagemonthly));?>
                                                                            <?php } elseif ($_smarty_tpl->tpl_vars['addonpackageda']->value->addonpackagequarterly != '-1.00') {?>
                                                                                <?php $_smarty_tpl->_assignInScope('addonPrice', ((string)$_smarty_tpl->tpl_vars['addonpackageda']->value->addonpackagequarterly));?>
                                                                            <?php } elseif ($_smarty_tpl->tpl_vars['addonpackageda']->value->addonpackageannually != '-1.00') {?>
                                                                                <?php $_smarty_tpl->_assignInScope('addonPrice', ((string)$_smarty_tpl->tpl_vars['addonpackageda']->value->addonpackageannually));?>
                                                                            <?php } elseif ($_smarty_tpl->tpl_vars['addonpackageda']->value->addonpackagebiennially != '-1.00') {?>
                                                                                <?php $_smarty_tpl->_assignInScope('addonPrice', ((string)$_smarty_tpl->tpl_vars['addonpackageda']->value->addonpackagebiennially));?>
                                                                            <?php } else { ?>
                                                                                <?php $_smarty_tpl->_assignInScope('addonPrice', ((string)$_smarty_tpl->tpl_vars['addonpackageda']->value->addonpackagetriennially));?>
                                                                            <?php }?>
                                                                        <?php } else { ?>
                                                                            <?php $_smarty_tpl->_assignInScope('addonPrice', "0.00");?>
                                                                       <?php }?>
                                                                       <!-- Setup fee -->
                                                                       <?php if ($_smarty_tpl->tpl_vars['addonpackageda']->value->addonpackagemsetupfee != '-1.00') {?>
                                                                             <?php $_smarty_tpl->_assignInScope('addonsetupfee', ((string)$_smarty_tpl->tpl_vars['addonpackageda']->value->addonpackagemsetupfee));?>
                                                                        <?php } elseif ($_smarty_tpl->tpl_vars['addonpackageda']->value->addonpackageqsetupfee != '-1.00') {?>
                                                                            <?php $_smarty_tpl->_assignInScope('addonsetupfee', ((string)$_smarty_tpl->tpl_vars['addonpackageda']->value->addonpackageqsetupfee));?>
                                                                        <?php } elseif ($_smarty_tpl->tpl_vars['addonpackageda']->value->addonpackagessetupfee != '-1.00') {?>
                                                                            <?php $_smarty_tpl->_assignInScope('addonsetupfee', ((string)$_smarty_tpl->tpl_vars['addonpackageda']->value->addonpackagessetupfee));?>
                                                                        <?php } elseif ($_smarty_tpl->tpl_vars['addonpackageda']->value->addonpackageasetupfee != '-1.00') {?>
                                                                            <?php $_smarty_tpl->_assignInScope('addonsetupfee', ((string)$_smarty_tpl->tpl_vars['addonpackageda']->value->addonpackageasetupfee));?>
                                                                        <?php } elseif ($_smarty_tpl->tpl_vars['addonpackageda']->value->addonpackagebsetupfee != '-1.00') {?>
                                                                            <?php $_smarty_tpl->_assignInScope('addonsetupfee', ((string)$_smarty_tpl->tpl_vars['addonpackageda']->value->addonpackagebsetupfee));?>
                                                                        <?php } elseif ($_smarty_tpl->tpl_vars['addonpackageda']->value->addonpackagetsetupfee != '-1.00') {?>
                                                                            <?php $_smarty_tpl->_assignInScope('addonsetupfee', ((string)$_smarty_tpl->tpl_vars['addonpackageda']->value->addonpackagetsetupfee));?> 
                                                                        <?php } else { ?>                                                        <?php $_smarty_tpl->_assignInScope('addonsetupfee', "0.00");?>                  
                                                                        <?php }?>

                                                                        <!-- Sum of amount and setup fee -->
                                                                        <?php if ($_smarty_tpl->tpl_vars['addonsetupfee']->value != "0.00") {?>
                                                                            <?php $_smarty_tpl->_assignInScope('showtext', "&nbsp;<b>".((string)$_smarty_tpl->tpl_vars['currency']->value->prefix).((string)$_smarty_tpl->tpl_vars['addonPrice']->value)." ".((string)$_smarty_tpl->tpl_vars['currency']->value->suffix)." + ".((string)$_smarty_tpl->tpl_vars['currency']->value->prefix).((string)$_smarty_tpl->tpl_vars['addonsetupfee']->value)." ".((string)$_smarty_tpl->tpl_vars['currency']->value->suffix)." Setup Fee = </b>");?>   
                                                                            <?php ob_start();
echo $_smarty_tpl->tpl_vars['addonPrice']->value;
$_prefixVariable1 = ob_get_clean();
ob_start();
echo $_smarty_tpl->tpl_vars['addonsetupfee']->value;
$_prefixVariable2 = ob_get_clean();
$_smarty_tpl->_assignInScope('TotalPrice', $_prefixVariable1+$_prefixVariable2);?>
                                                                            
                                                                        <?php } else { ?>
                                                                             <?php $_smarty_tpl->_assignInScope('showtext', '');?>  
                                                                             <?php ob_start();
echo $_smarty_tpl->tpl_vars['addonPrice']->value;
$_prefixVariable3 = ob_get_clean();
$_smarty_tpl->_assignInScope('TotalPrice', $_prefixVariable3);?>   
                                                                        <?php }?>    
                                                                        
                                                                       
                                                                       <label class="checkbox-inline"><input type='checkbox'  name='ProductAddons[]' value='<?php echo $_smarty_tpl->tpl_vars['addonpackageda']->value->addonpackageid;?>
' data-productprice='<?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['TotalPrice']->value);?>
' class='checkboxclick'> <?php echo $_smarty_tpl->tpl_vars['addonpackageda']->value->addonpackagename;?>
 <?php echo $_smarty_tpl->tpl_vars['showtext']->value;?>
 <b>(<?php echo $_smarty_tpl->tpl_vars['currency']->value->prefix;
echo sprintf("%.2f",$_smarty_tpl->tpl_vars['TotalPrice']->value);?>
 <?php echo $_smarty_tpl->tpl_vars['currency']->value->suffix;?>
)</b></label><br>
                                                                       <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                                    </div>
                                                                </div> 
                                                            <?php }?> 



                                                            <div class="hideAll" id="show-<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
" style="margin-top:20px"> 
                                                                <div class="heading-bar" style="margin-bottom:30px;">
                                                                    <img src="modules/addons/vpnpanel/templates/images/billing-icon.png" alt="img"><h3>Additional Infrormation</h3>
                                                                </div>
                                                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['customfields']->value[$_smarty_tpl->tpl_vars['product']->value->id], 'customfield');
$_smarty_tpl->tpl_vars['customfield']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['customfield']->value) {
$_smarty_tpl->tpl_vars['customfield']->do_else = false;
?>  
                                                                    <?php if ($_smarty_tpl->tpl_vars['customfield']->value->adminonly != 'on') {?>
                                                                        <?php if ($_smarty_tpl->tpl_vars['customfield']->value->fieldtype == 'dropdown') {?> 
                                                                            <?php $_smarty_tpl->_assignInScope('fieldoptions', explode(",",$_smarty_tpl->tpl_vars['customfield']->value->fieldoptions));?>
                                                                            <div class="form-group" id="<?php echo $_smarty_tpl->tpl_vars['customfield']->value->fieldname;?>
"> 
                                                                                <select id="customfield<?php echo $_smarty_tpl->tpl_vars['customfield']->value->id;?>
" style="width: 100%;" class="form-control select-inline" name="customfields[<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
][<?php echo $_smarty_tpl->tpl_vars['customfield']->value->fieldname;?>
]">
                                                                                    <option value=""><?php echo $_smarty_tpl->tpl_vars['customfield']->value->fieldname;?>
</option>
                                                                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['fieldoptions']->value, 'fieldoption');
$_smarty_tpl->tpl_vars['fieldoption']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['fieldoption']->value) {
$_smarty_tpl->tpl_vars['fieldoption']->do_else = false;
?>
                                                                                        <option value="<?php echo $_smarty_tpl->tpl_vars['fieldoption']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['fieldoption']->value;?>
</option>
                                                                                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> 
                                                                                </select> 
                                                                                <span><?php echo $_smarty_tpl->tpl_vars['customfield']->value->description;?>
</span>
                                                                            </div> 
                                                                        <?php } elseif ($_smarty_tpl->tpl_vars['customfield']->value->fieldtype == 'tickbox') {?>
                                                                            <div class="form-group" id="<?php echo $_smarty_tpl->tpl_vars['customfield']->value->fieldname;?>
">
                                                                                <label class="checkbox-inline"> 
                                                                                    <input onclick="checkifmagonly(this.id);" name="customfields[<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
][<?php echo $_smarty_tpl->tpl_vars['customfield']->value->fieldname;?>
]" value='on' id="customfield<?php echo $_smarty_tpl->tpl_vars['customfield']->value->id;?>
" type="checkbox">
                                                                                    <?php echo $_smarty_tpl->tpl_vars['customfield']->value->description;?>
</label>  
                                                                            </div>
                                                                        <?php } else { ?>
                                                                            <div class="form-group" id="<?php echo $_smarty_tpl->tpl_vars['customfield']->value->fieldname;?>
">
                                                                                <?php if ($_smarty_tpl->tpl_vars['customfield']->value->fieldname == 'Username') {?>
                                                                                    <p class="validate_error"><b>Error:</b> Special characters and space is not allowed.</p>  
                                                                                <?php }?> 
                                                                                <input class="form-control <?php if ($_smarty_tpl->tpl_vars['customfield']->value->fieldname == 'Username') {?>validateusername<?php }?> <?php ob_start();
echo $_smarty_tpl->tpl_vars['maccustomfieldname']->value;
$_prefixVariable4 = ob_get_clean();
ob_start();
echo $_smarty_tpl->tpl_vars['e2customfieldname']->value;
$_prefixVariable5 = ob_get_clean();
if ($_smarty_tpl->tpl_vars['customfield']->value->fieldname == $_prefixVariable4 || $_smarty_tpl->tpl_vars['customfield']->value->fieldname == $_prefixVariable5) {?>keyup-characters<?php }?>" placeholder="<?php echo $_smarty_tpl->tpl_vars['customfield']->value->fieldname;?>
" type="text" name="customfields[<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
][<?php echo $_smarty_tpl->tpl_vars['customfield']->value->fieldname;?>
]" >
                                                                                <span><?php echo $_smarty_tpl->tpl_vars['customfield']->value->description;?>
 <?php if ($_smarty_tpl->tpl_vars['customfield']->value->required == 'on') {?><span style="color:red">(Required)</span><?php }?></span>
                                                                            </div>

                                                                        <?php }?>
                                                                    <?php }?> 
                                                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                                
                                                                <!-- <?php echo $_smarty_tpl->tpl_vars['configuralOption']->value;?>
 -->
                                                                <!-- <pre><?php echo print_r($_smarty_tpl->tpl_vars['configuralOption']->value);?>
</pre> -->
                                                                <?php ob_start();
echo $_smarty_tpl->tpl_vars['product']->value->id;
$_prefixVariable6 = ob_get_clean();
ob_start();
echo $_smarty_tpl->tpl_vars['product']->value->id;
$_prefixVariable7 = ob_get_clean();
if ((isset($_smarty_tpl->tpl_vars['configuralOption']->value[$_prefixVariable6])) && !empty($_smarty_tpl->tpl_vars['configuralOption']->value[$_prefixVariable7])) {?>
                                                                    
                                                                    <div class="form-group" >
                                                                        <?php ob_start();
echo $_smarty_tpl->tpl_vars['product']->value->id;
$_prefixVariable8 = ob_get_clean();
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['configuralOption']->value[$_prefixVariable8], 'value', false, 'key');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>

                                                                            <?php $_smarty_tpl->_assignInScope('configname', ((string)$_smarty_tpl->tpl_vars['value']->value['optionname']) ,true);?>

                                                                            <?php $_smarty_tpl->_assignInScope('inputtype', "text" ,true);?>
                                                                            <?php if ($_smarty_tpl->tpl_vars['value']->value['optiontype'] == 4) {?>
                                                                                <?php $_smarty_tpl->_assignInScope('inputtype', "number" ,true);?>
                                                                            <?php }?>
                                                                            <?php $_smarty_tpl->_assignInScope('inputmin', ((string)$_smarty_tpl->tpl_vars['value']->value['qtyminimum']) ,true);?>
                                                                            <?php $_smarty_tpl->_assignInScope('inputmax', ((string)$_smarty_tpl->tpl_vars['value']->value['qtymaximum']) ,true);?> 

                                                                        

                                                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['value']->value['pricetype'], 'pricetypeval', false, 'pricetypekey');
$_smarty_tpl->tpl_vars['pricetypeval']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['pricetypekey']->value => $_smarty_tpl->tpl_vars['pricetypeval']->value) {
$_smarty_tpl->tpl_vars['pricetypeval']->do_else = false;
?>
                                                                           

                                                                                <div class="packageconfig<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
 Showconfig_<?php echo $_smarty_tpl->tpl_vars['pricetypekey']->value;?>
 hideAllconfig config checkexist" style="margin-bottom: 30px; width:100%;float: left;" >
                                                                                    <!-- <?php echo $_smarty_tpl->tpl_vars['jkl']->value;?>
 -->
                                                                                    <input 
                                                                                        type="<?php echo $_smarty_tpl->tpl_vars['inputtype']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['inputmin']->value;?>
" 
                                                                                        name="configOption_<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
[<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
][<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
][<?php echo $_smarty_tpl->tpl_vars['pricetypekey']->value;?>
]"  
                                                                                        class="count form-control getinputval" 
                                                                                        data-configprice="<?php echo $_smarty_tpl->tpl_vars['pricetypeval']->value;?>
"
                                                                                        data-productid="<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
"
                                                                                        data-configopid="<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
"
                                                                                        data-billingisdata="<?php echo $_smarty_tpl->tpl_vars['pricetypekey']->value;?>
"
                                                                                        min="<?php echo $_smarty_tpl->tpl_vars['inputmin']->value;?>
" 
                                                                                        <?php if ($_smarty_tpl->tpl_vars['inputmax']->value != '0') {?> 
                                                                                            max="<?php echo $_smarty_tpl->tpl_vars['inputmax']->value;?>
" 
                                                                                        <?php }?> data-oldVal="0"
                                                                                        style="width: 60px; float: left;">

                                                                                    <span style="float: left; margin-top: 10px;">x - <?php echo $_smarty_tpl->tpl_vars['configname']->value;?>
 (<?php echo $_smarty_tpl->tpl_vars['currency']->value->prefix;
echo $_smarty_tpl->tpl_vars['pricetypeval']->value;
echo $_smarty_tpl->tpl_vars['currency']->value->suffix;?>
 <b><?php echo $_smarty_tpl->tpl_vars['pricetypekey']->value;?>
</b>)</span>
                                                                                </div>

                                                                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                                            <input type="hidden" name="billingCycleNis[<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
][<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
]" id="billingCycleNisID_<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
_<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
" value="">
                                                                            <input type="hidden" name="ConfigOptionIdNis[<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
][<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
]" id="ConfigOptionIdNisID_<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
_<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
" value="">
                                                                            
                                                                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                                        
                                                                    </div> 

                                                                <?php }?>

                                                            </div>
                                                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>


                                                        <?php if ($_smarty_tpl->tpl_vars['userinfo']->value == 'yes') {?>        
                                                            <div class="heading-bar custom-billing" style="margin-top: 30px">
                                                                <img src="modules/addons/vpnpanel/templates/images/billing-icon.png" alt=""><h3>Enter Your Billing Information</h3>
                                                            </div>

                                                            <div class="billing-information" style="margin-top: 30px;">
                                                                <div class="row">
                                                                    <?php if ($_smarty_tpl->tpl_vars['optionactive']->value['login'] != '') {?><div class="form-group col-md-6"><input class="form-control" placeholder="Email / Login (Required for Billing Portal) " type="text" name="login" id="login" <?php if ((isset($_smarty_tpl->tpl_vars['optionactive']->value['login']))) {?>required<?php }?> value="">

                                                                        </div><?php }?>
                                                                        <?php if ($_smarty_tpl->tpl_vars['optionactive']->value['password'] != '') {?><div class="form-group col-md-6"><input class="form-control"  placeholder="Password" type="password" name="password" id="password" <?php if ((isset($_smarty_tpl->tpl_vars['optionactive']->value['password']))) {?>required<?php }?> value="">
                                                                            </div> <?php }?>
                                                                            <?php if ($_smarty_tpl->tpl_vars['optionactive']->value['confirmpassword'] != '') {?><div class="form-group col-md-6"><input class="form-control" onfocusout="Confirm(this.value);" placeholder="Confirm Password" <?php if ((isset($_smarty_tpl->tpl_vars['optionactive']->value['confirmpassword']))) {?>required<?php }?> type="password" name="confirmpassword" id="confirmpassword" value="">
                                                                                </div> <?php }?>
                                                                                <!-- Firstname -->
                                                                                <?php if ($_smarty_tpl->tpl_vars['optionactive']->value['clientname'] != '') {?><div class="form-group col-md-6"><input class="form-control" type="text" placeholder="Name" name="clientname" id="clientname" value="" <?php if ((isset($_smarty_tpl->tpl_vars['optionactive']->value['clientname']))) {?>required<?php }?>>
                                                                                    </div>  <?php }?>
                                                                                    <!-- companyname -->
                                                                                    <?php if ($_smarty_tpl->tpl_vars['optionactive']->value['companyname'] != '') {?><div class="form-group col-md-6"><input class="form-control" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareacompanyname'];?>
" type="text" name="companyname" id="companyname" value="">
                                                                                        </div> <?php }?>
                                                                                        <!-- address1 -->
                                                                                        <?php if ($_smarty_tpl->tpl_vars['optionactive']->value['address1'] != '') {?><div class="form-group col-md-6"><input class="form-control" type="text"  placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareaaddress1'];?>
" name="address1" id="address1" value="" <?php if ((isset($_smarty_tpl->tpl_vars['optionactive']->value['address1']))) {?>required<?php }?>>
                                                                                            </div><?php }?>
                                                                                            <!-- address2 -->
                                                                                            <?php if ($_smarty_tpl->tpl_vars['optionactive']->value['address2'] != '') {?><div class="form-group col-md-6"><input class="form-control" type="text"   placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareaaddress2'];?>
" name="address2" id="address2" value="">
                                                                                                </div><?php }?>
                                                                                                <!-- city -->
                                                                                                <?php if ($_smarty_tpl->tpl_vars['optionactive']->value['city'] != '') {?><div class="form-group col-md-6"><input class="form-control" type="text"  placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareacity'];?>
" name="city" id="city" value="" <?php if ((isset($_smarty_tpl->tpl_vars['optionactive']->value['city']))) {?>required<?php }?>>
                                                                                                    </div><?php }?>
                                                                                                    <!-- State -->
                                                                                                    <?php if ($_smarty_tpl->tpl_vars['optionactive']->value['state'] != '') {?><div class="form-group col-md-6">
                                                                                                            <input class="form-control" placeholder="State" type="text" name="state" id="state" value="" <?php if ((isset($_smarty_tpl->tpl_vars['optionactive']->value['state']))) {?>required<?php }?>>
                                                                                                        </div> <?php }?>

                                                                                                        <!-- Post Code -->
                                                                                                        <?php if ($_smarty_tpl->tpl_vars['optionactive']->value['postcode'] != '') {?><div class="form-group col-md-6"><input class="form-control" type="text"  placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareapostcode'];?>
" name="postcode" id="postcode" value="" <?php if ((isset($_smarty_tpl->tpl_vars['optionactive']->value['postcode']))) {?>required<?php }?>>
                                                                                                            </div><?php }?>
                                                                                                            <!-- phone -->
                                                                                                            <?php if ($_smarty_tpl->tpl_vars['optionactive']->value['phonenumber'] != '') {?> <div class="form-group col-md-6"><input class="form-control" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareaphonenumber'];?>
" type="tel" name="phonenumber" id="phonenumber" value="" <?php if ((isset($_smarty_tpl->tpl_vars['optionactive']->value['phonenumber']))) {?>required<?php }?>>
                                                                                                                </div>
                                                                                                            <?php }?>  
                                                                                                            <div class="form-group col-md-6"><input class="form-control" style='<?php if (!(isset($_smarty_tpl->tpl_vars['optionactive']->value['addcredit']))) {?>display:none;<?php }?>' placeholder="Add Credit" type="text" name="add_credit" id="credit" value="">
                                                                                                            </div>
                                                                                                            <div class="form-group col-md-6"><input class="form-control" style='<?php if (!(isset($_smarty_tpl->tpl_vars['optionactive']->value['promocode']))) {?>display:none;<?php }?>'   type="text" name="promocode" id="credit" placeholder="Enter Promotion Code">
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                <?php }?>
                                                                                                <div class="heading-bar">
                                                                                                    <img src="modules/addons/vpnpanel/templates/images/order-icon.png" alt=""><h3>Review Order Details</h3>
                                                                                                </div>
                                                                                                <div class="orderDetails" style="margin-top: 0px;">
                                                                                                    <div class="row">
                                                                                                        <div class="col-md-12">
                                                                                                            <table class="table table-striped table-respinsive">
                                                                                                                <tr>
                                                                                                                    <td style="text-indent:50px;">1 Month (Monthly) Edit</td>
                                                                                                                    <td style="text-indent:50px;"><p class="price" style="float: left;">10.00 Credits</p>
                                                                                                                        <button type="button" class="btn-link btn-remove-from-cart" onclick="removeItem('p', '0')" style="color: #444!important; float: left;"><i class="fa fa-times" style="font-size:15px;"></i> </button>
                                                                                                                    </td></tr>

                                                                                                            </table>
                                                                                                            <hr />


                                                                                                        </div>
                                                                                                        <center class="text-center">
                                                                                                            <div class="col-md-8 col-md-offset-2">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-md-4 crDetails" style="border-left: solid 1px #004a95;">
                                                                                                                        <p class="text-center"><b>Your Credit</b><br><span class="credit" style="color: #000; font-style:normal; padding: 0px;"><?php echo $_smarty_tpl->tpl_vars['totalcredit']->value;?>
</span></p>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 crDetails minus">
                                                                                                                        <p class="text-center"><b>Plan Credit</b><br><span class="plan" style="color: #000; font-style:normal; padding: 0px;">10</span></p>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 crDetails equal" style="border-right: solid 1px #004a95;">
                                                                                                                        <p class="text-center"><b>Balance</b><br><span class="bal" style="color: #000; font-style:normal; padding: 0px;">290</span></p>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </center>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div> 


                                                                                        <div class="actions">  
                                                                                            <input type="hidden" name="add_client">
                                                                                            <center><input type="submit" value="Submit" style="width:auto;margin-top:10px; padding-right: 20px; padding-left: 20px;" name="add_client_submit" class="btn btn-success btn-sm btn_submit1 validateadduser"></center>
                                                                                            <p class="alert alert-danger creditWarning text-center" style="display: none;">Please Buy Credit First.</p>
                                                                                        </div> 
                                                                                </div>
                                                                                </form>
                                                                            </div>

                                                                        </div>
                                                                    </div>


                                                                     
                                                                        <?php echo '<script'; ?>
>
                                                                            $('.keyup-characters').focusout(function () {
                                                                                $('span.error-keyup-2').remove();
                                                                                var inputVal = $(this).val();
                                                                                var characterReg = /([0-9A-Fa-f]{2}[:]){5}([0-9A-Fa-f]{2})/;
                                                                                if (!characterReg.test(inputVal)) {
                                                                                    $(this).after('<span class="error error-keyup-2" style="color:red">Please enter a valid MAC address.<br></span>');
                                                                                }
                                                                            });
                                                                            function checkifmagonly(id) {
                                                                                if ($('#' + id).is(':checked')) {
                                                                                    jQuery('#Username').hide();
                                                                                    jQuery('#Password').hide();
                                                                                } else if (!$('#' + id).is(':checked')) {
                                                                                    jQuery('#Username').show();
                                                                                    jQuery('#Password').show();
                                                                                }
                                                                            }
                                                                            function Confirm(confirmpassword) {
                                                                                var password = jQuery('#password').val();
                                                                                if (password != confirmpassword) {
                                                                                    jQuery('#confirmpassword').css('border-color', 'red');
                                                                                } else {
                                                                                    jQuery('#confirmpassword').css('border-color', '#959595');
                                                                                }
                                                                            }

                                                                            $(".checkboxclick").click(function () {
                                                                                var ValPrice = $(this).data( "productprice" );
                                                                                var planvalue = $('.plan').text().trim();
                                                                                var bal = $('.bal').text().trim();
                                                                                if($(this).is(':checked'))
                                                                                {
                                                                                    planvaluechange = Number(ValPrice)+Number(planvalue);
                                                                                    fbalance = Number(bal)-Number(ValPrice);

                                                                                }
                                                                                else
                                                                                {

                                                                                    planvaluechange = Number(planvalue)-Number(ValPrice);
                                                                                    fbalance = Number(bal)+Number(ValPrice);
                                                                                }

                                                                                $('.plan').text(planvaluechange.toFixed(2));
                                                                                $('.bal').text(fbalance.toFixed(2));

                                                                            });
                                                                            jQuery(".form_packageid").click(function () {
                                                                                jQuery(".checkboxclick").prop('checked', false);
                                                                                jQuery('.getposition').removeClass('getposition');
                                                                                jQuery('.product').removeClass('active');

                                                                                var PackageidShowID = jQuery(this).children('input').val();

                                                                                var plan = $('#deduct_amount' + PackageidShowID).text();
                                                                                jQuery('.hideAll').removeClass('visiblesection');
                                                                                jQuery('.hideAll').css('display', 'none');

                                                                               // jQuery('#show-' + PackageidShowID).css('display', 'block');
                                                                                jQuery('#show1-' + PackageidShowID).css('display', 'block');
                                                                                $('html, body').animate({
                                                                                    scrollTop: $('#scrl').offset().top
                                                                                }, 1000);
                                                                                $('#p_' + PackageidShowID + '').parent('label').parent().parent().addClass('active');
                                                                                $('.product .form_packageid span').html('Pick Now');
                                                                                $('.product.active .form_packageid span').html('<i class="fa fa-check"></i> Picked');
                                                                                jQuery('#show-' + PackageidShowID).addClass('visiblesection');
                                                                                jQuery('#show1-' + PackageidShowID).addClass('visiblesection');
                                                                                jQuery('#showproduct-' + PackageidShowID).css('display', 'block').show();
                                                                                jQuery('#showproduct1-' + PackageidShowID).css('display', 'block').show();
                                                                                
                                                                                $('.bilcyc').show();

                                                                                if (jQuery('#showproduct-' + PackageidShowID + ' .changeselectclass').length != 0)
                                                                                {
                                                                                    jQuery('#showproduct-' + PackageidShowID + ' .changeselectclass').addClass('getposition');
                                                                                    //jQuery('#showproduct1-' + PackageidShowID + ' .changeselectclass').addClass('getposition');
                                                                                    var OnchangeCurrentPossition = $('.getposition :selected').data('current_position');
                                                                                    $('.hideAllconfig').hide();
                                                                                    $('.packageconfig' + PackageidShowID + '.Showconfig_' + OnchangeCurrentPossition+'').show();
                                                                                }
                                                                                else
                                                                                {
                                                                                    if (jQuery('.packageconfig' + PackageidShowID ).hasClass( "Showconfig_monthly" ))
                                                                                    {
                                                                                        jQuery('.packageconfig' + PackageidShowID +'.Showconfig_monthly').removeClass('hideAllconfig');jQuery('.packageconfig' + PackageidShowID +'.Showconfig_monthly').show();
                                                                                        jQuery('.packageconfig' + PackageidShowID +'.Showconfig_monthly .getinputval').addClass('freeproduct');

                                                                                    }
                                                                                    
                                                                                }
                                                                                if (jQuery('#showproduct1-' + PackageidShowID + ' .changeselectclass').length != 0)
                                                                                {
                                                                                    //jQuery('#showproduct-' + PackageidShowID + ' .changeselectclass').addClass('getposition');
                                                                                    jQuery('#showproduct1-' + PackageidShowID + ' .changeselectclass').addClass('getposition');
                                                                                    var OnchangeCurrentPossition = $('.getposition :selected').data('current_position');
                                                                                    $('.hideAllconfig').hide();
                                                                                    $('.packageconfig' + PackageidShowID + '.Showconfig_' + OnchangeCurrentPossition+'').show();
                                                                                }
                                                                                if ($('.product.active span').hasClass('free'))
                                                                                {
                                                                                    $('.bilcyc').hide();
                                                                                    $('.orderDetails table').html('<tr><td>' + $('.product.active #product1-name').text() + '</td><td>FREE</td></tr>');
                                                                                    $('.plan').text(0.00);
                                                                                    var total = $('.credit').text();
                                                                                    var credit = $('.plan').text();
                                                                                    var bal = parseFloat(total) - parseFloat(credit);
                                                                                    if (parseFloat(total) < parseFloat(credit))
                                                                                    {

                                                                                        $('.btn_submit1').hide();
                                                                                        $('.creditWarning').show();
                                                                                    } else
                                                                                    {
                                                                                        $('.btn_submit1').show();
                                                                                        $('.creditWarning').hide();
                                                                                    }
                                                                                    $('.bal').text(bal.toFixed(2));
                                                                                } else
                                                                                {
                                                                                    $('.orderDetails table').html('<tr><td>' + $('.product.active #product1-name').text() + '</td><td>' + plan + ' Credit</td></tr>');
                                                                                    $('.plan').text(plan);
                                                                                    var total = $('.credit').text();
                                                                                    var credit = $('.plan').text();
                                                                                    var bal = parseFloat(total) - parseFloat(credit);
                                                                                    if (parseFloat(total) < parseFloat(credit))
                                                                                    {

                                                                                        $('.btn_submit1').hide();
                                                                                        $('.creditWarning').show();
                                                                                    } else
                                                                                    {
                                                                                        $('.btn_submit1').show();
                                                                                        $('.creditWarning').hide();
                                                                                    }
                                                                                    $('.bal').text(bal.toFixed(2));

                                                                                }


                                                                                //jQuery('#showproduct-' + PackageidShowID).addClass('getposition');
                                                                            });

                                                                            jQuery(document).ready(function () { 
                                                                                jQuery('.getposition').removeClass('getposition');
                                                                                jQuery('.product:eq(0)').addClass('active');
                                                                                jQuery(document).find('.active .form_packageid').children('input').prop("checked", true);
                                                                                var PackageidShowID = jQuery(document).find('.active .form_packageid').children('input').val();
                                                                                var plan = $('#deduct_amount' + PackageidShowID).text();
                                                                                jQuery('.hideAll').removeClass('visiblesection');
                                                                                jQuery('.hideAll').css('display', 'none');
                                                                                jQuery('#show1-' + PackageidShowID).css('display', 'block');
                                                                                $('html, body').animate({
                                                                                 scrollTop: $('#show-' + PackageidShowID).offset().top
                                                                                 }, 1000);
                                                                                $('#p_' + PackageidShowID + '').parent('label').parent().parent().addClass('active');
                                                                                $('.product .form_packageid span').html('Pick Now');
                                                                                $('.product.active .form_packageid span').html('<i class="fa fa-check"></i> Picked'); 
                                                                                 jQuery('#show1-' + PackageidShowID).css('display', 'block');
                                                                                 jQuery('#show-' + PackageidShowID).css('display', 'block');
                                                                                jQuery('#showproduct-' + PackageidShowID).css('display', 'block');
                                                                                if (jQuery('#showproduct-' + PackageidShowID + ' .changeselectclass').length != 0)
                                                                                {
                                                                                    jQuery('#showproduct-' + PackageidShowID + ' .changeselectclass').addClass('getposition');
                                                                                    var OnchangeCurrentPossition = $('.getposition :selected').data('current_position');
                                                                                    $('.hideAllconfig').hide();
                                                                                    $('.packageconfig' + PackageidShowID + '.Showconfig_' + OnchangeCurrentPossition+'').show();
                                                                                }
                                                                                if ($('.product.active span').hasClass('free'))
                                                                                {
                                                                                    $('.orderDetails table').html('<tr><td>' + $('.product.active #product1-name').text() + '</td><td>FREE</td></tr>');
                                                                                    $('.plan').text('0.00');
                                                                                    var total = $('.credit').text();
                                                                                    var credit = $('.plan').text();
                                                                                    var bal = parseFloat(total) - parseFloat(credit);
                                                                                    if (parseFloat(total) < parseFloat(credit))
                                                                                    {

                                                                                        $('.btn_submit1').hide();
                                                                                        $('.creditWarning').show();
                                                                                    } else
                                                                                    {
                                                                                        $('.btn_submit1').show();
                                                                                        $('.creditWarning').hide();
                                                                                    }
                                                                                    $('.bal').text(bal.toFixed(2));

                                                                                } else
                                                                                {
                                                                                    $('.orderDetails table').html('<tr><td>' + $('.product.active #product1-name').text() + '</td><td>' + plan + ' Credit</td></tr>');
                                                                                    $('.plan').text(plan);
                                                                                    var total = $('.credit').text();
                                                                                    var credit = $('.plan').text();
                                                                                    var bal = parseFloat(total) - parseFloat(credit);
                                                                                    if (parseFloat(total) < parseFloat(credit))
                                                                                    {

                                                                                        $('.btn_submit1').hide();
                                                                                        $('.creditWarning').show();
                                                                                    } else
                                                                                    {
                                                                                        $('.btn_submit1').show();
                                                                                        $('.creditWarning').hide();
                                                                                    }
                                                                                    $('.bal').text(bal.toFixed(2));
                                                                                }
                                                                            })

                                                                            jQuery("#login").keyup(function () {
                                                                                var email = jQuery('#login').val();
                                                                                if (email == '' || !isValidEmailAddress(email))
                                                                                {
                                                                                    jQuery('#login').css('border-color', 'red');
                                                                                } else {
                                                                                    jQuery('#login').css('border-color', '#959595');
                                                                                }
                                                                            });
                                                                            function isValidEmailAddress(emailAddress) {
                                                                                var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
                                                                                return pattern.test(emailAddress);
                                                                            }
                                                                            $(document).ready(function () {
                                                                                /*******Onchange functionality ************/
                                                                                $('.changeselectclass').on('change', function () {

                                                                                    if ($(this).is(".getposition")) {
                                                                                        jQuery(".checkboxclick").prop('checked', false);
                                                                                        var SelectorId = $(this).data('selector_id');

                                                                                        var Deduct_Amount = $('#deduct_amount' + SelectorId);
                                                                                        var OnchangeCurrentPossitionval = $(this).find(":selected").val();
                                                                                        var ExplodedValue = OnchangeCurrentPossitionval.split('|');
                                                                                        var OnlyPriceForDeductAmount = ExplodedValue[2];
                                                                                        var OnchangeCurrentPossition = $(this).find(":selected").data('current_position');
                                                                                        //alert(OnchangeCurrentPossition);
                                                                                        $('.hideAllconfig').hide();
                                                                                        //alert();
                                                                                        $('.packageconfig' + SelectorId + '.Showconfig_' + OnchangeCurrentPossition+'').show();
                                                                                        Deduct_Amount.text(OnlyPriceForDeductAmount);

                                                                                        $('.orderDetails table').html('<tr><td>' + $('.product.active #product1-name').text() + '</td><td>' + OnlyPriceForDeductAmount + ' Credit</td></tr>');
                                                                                        $('.plan').text(OnlyPriceForDeductAmount);
                                                                                        var total = $('.credit').text();
                                                                                        var credit = $('.plan').text();
                                                                                        var bal = parseFloat(total) - parseFloat(credit);
                                                                                        if (parseFloat(total) < parseFloat(credit))
                                                                                        {

                                                                                            $('.btn_submit1').hide();
                                                                                            $('.creditWarning').show();
                                                                                        } else
                                                                                        {
                                                                                            $('.btn_submit1').show();
                                                                                            $('.creditWarning').hide();
                                                                                        }
                                                                                        $('.bal').text(bal.toFixed(2));
                                                                                    }
                                                                                    /**/
                                                                                });

                                                                                // $('.getinputval').on('change', function(e) {
                                                                                $('.getinputval').bind('click', function (e) {
                                                                                    e.preventDefault();
                                                                                    CommonFunctionConfigOption($(this));
                                                                                });
                                                                                $('.getinputval').bind('keyup', function (e) {
                                                                                    e.preventDefault();
                                                                                    CommonFunctionConfigOption($(this));
                                                                                });



                                                                                $(".validateadduser").click(function (e) {
                                                                                    $('.validate_error').hide();
                                                                                    var Usernamevalue = $('.visiblesection .validateusername').val();
                                                                                    var validate_error = $('.visiblesection .validate_error');
                                                                                    var specialregex = /^[0-9a-zA-Z\_-]+$/
                                                                                    var Spaceregex = /\s/g
                                                                                    if (typeof Usernamevalue !== "undefined")
                                                                                    {
                                                                                        if (Usernamevalue != "")
                                                                                        {

                                                                                            if (Spaceregex.test(Usernamevalue) == true || specialregex.test(Usernamevalue) == false)
                                                                                            {
                                                                                                e.preventDefault();
                                                                                                validate_error.show();
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                });

                                                                            });

                                                                            function CommonFunctionConfigOption(thisSelector)
                                                                            {
                                                                                
                                                                                var planvalue = $('.plan').text().trim();
                                                                                var bal = $('.bal').text().trim();
                                                                                var OnchangeInputVal = thisSelector.val();
                                                                                var OnchangeInputConfigPriceVal = thisSelector.data('configprice');
                                                                                var TotalConfigValue = ConvertNumberToFloat(OnchangeInputVal * OnchangeInputConfigPriceVal);
                                                                                if(thisSelector.hasClass('freeproduct'))
                                                                                {

                                                                                if(Number(thisSelector.attr("data-oldVal")) < Number(TotalConfigValue))
                                                                                {
                                                                                planvaluechange = Number(OnchangeInputConfigPriceVal)+Number(planvalue);
                                                                                fbalance = Number(bal)-Number(OnchangeInputConfigPriceVal);
                                                                                }
                                                                                else if(Number(thisSelector.attr("data-oldVal")) > Number(TotalConfigValue))
                                                                                {
                                                                                planvaluechange = Number(planvalue)-Number(OnchangeInputConfigPriceVal);
                                                                                fbalance = Number(bal)+Number(OnchangeInputConfigPriceVal);
                                                                                }
                                                                                thisSelector.attr('data-oldVal',TotalConfigValue);


                                                                                $('.plan').text(planvaluechange.toFixed(2));
                                                                                $('.bal').text(fbalance.toFixed(2));
                                                                                }
                                                                                else
                                                                                {
                                                                                var SelectedOption = $('.getposition :selected');
                                                                                var OnlySelect = $('.getposition');
                                                                                //var UpdatedAmmount = SelectedOption.data('current_position_updatedammount');
                                                                                var CurrencySign = SelectedOption.data('current_position_currency');
                                                                                var SuffixAndPlan = SelectedOption.data('current_position_suffix');
                                                                                var SelectorId = OnlySelect.data('selector_id');
                                                                                //alert(SelectorId);
                                                                                var Deduct_Amount = $('#deduct_amount' + SelectorId);


                                                                                var FinalTotal = ConvertNumberToFloat(parseFloat($('.getposition :selected').data('current_position_ammount')) + parseFloat(TotalConfigValue));
                                                                                //alert(FinalTotal);
                                                                                var OldPriceval = SelectedOption.val();
                                                                                var CreateOldPriceVal = OldPriceval.split('|');
                                                                                var UpdatedAmmountForVal = CreateOldPriceVal[0] + "|" + CreateOldPriceVal[1] + "|" + FinalTotal;
                                                                                var UpdatedAmmountForText = CurrencySign + FinalTotal + SuffixAndPlan;
                                                                                SelectedOption.val(UpdatedAmmountForVal);
                                                                                SelectedOption.text(UpdatedAmmountForText);
                                                                                //SelectedOption.attr('data-current_position_updatedammount',FinalTotal);
                                                                                Deduct_Amount.text(FinalTotal);
                                                                                /*alert(thisSelector.attr("data-oldVal")+" "+TotalConfigValue);*/
                                                                                if(Number(thisSelector.attr("data-oldVal")) < Number(TotalConfigValue))
                                                                                {
                                                                                planvaluechange = Number(OnchangeInputConfigPriceVal)+Number(planvalue);
                                                                                fbalance = Number(bal)-Number(OnchangeInputConfigPriceVal);
                                                                                }
                                                                                else if(Number(thisSelector.attr("data-oldVal")) > Number(TotalConfigValue))
                                                                                {
                                                                                planvaluechange = Number(planvalue)-Number(OnchangeInputConfigPriceVal);
                                                                                fbalance = Number(bal)+Number(OnchangeInputConfigPriceVal);
                                                                                }
                                                                                thisSelector.attr('data-oldVal',TotalConfigValue);


                                                                                $('.plan').text(planvaluechange.toFixed(2));
                                                                                $('.bal').text(fbalance.toFixed(2));
                                                                                }

                                                                                var ProductIDJS = thisSelector.attr("data-productid");
                                                                                var ConfigOPtionId = thisSelector.attr("data-configopid");
                                                                                var BillingDataIdIS = thisSelector.attr("data-billingisdata");

                                                                                $("#billingCycleNisID_"+ProductIDJS+"_"+ConfigOPtionId).val(BillingDataIdIS);

                                                                                $("#ConfigOptionIdNisID_"+ProductIDJS+"_"+ConfigOPtionId).val(ConfigOPtionId);

                                                                                
                                                                            }
                                                                            function ConvertNumberToFloat(Number)
                                                                            {
                                                                                return Number.toFixed(2);
                                                                            }
                                                                        <?php echo '</script'; ?>
>
                                                                    

                                                                    <style type="text/css">
                                                                        .hideAllconfig{
                                                                            display: none;
                                                                        }

                                                                        p.validate_error {
                                                                            color: #a94442 !important;
                                                                            background-color: #ebccd1;
                                                                            border-color: #ebccd1;
                                                                            width: auto;
                                                                            font-size: 14px;
                                                                            padding: 10px !important;
                                                                            display: none;
                                                                        }
                                                                    </style><?php }
}
