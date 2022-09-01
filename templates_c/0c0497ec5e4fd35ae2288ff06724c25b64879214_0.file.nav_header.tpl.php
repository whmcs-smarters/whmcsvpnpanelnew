<?php
/* Smarty version 3.1.36, created on 2020-11-21 06:08:55
  from '/var/www/html/modules/addons/vpnpanel/templates/nav_header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fb8aef7b90022_79174291',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0c0497ec5e4fd35ae2288ff06724c25b64879214' => 
    array (
      0 => '/var/www/html/modules/addons/vpnpanel/templates/nav_header.tpl',
      1 => 1605789141,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fb8aef7b90022_79174291 (Smarty_Internal_Template $_smarty_tpl) {
?><link href="modules/addons/vpnpanel/templates/css/swiftmodders.css" rel="stylesheet">
<link href="modules/addons/vpnpanel/templates/css/mystyle.css" rel="stylesheet"> 
<link href="modules/addons/vpnpanel/templates/css/bootstrap-social.css" rel="stylesheet">
<?php if ($_smarty_tpl->tpl_vars['totalcredit']->value == '0.00') {?>
    <div class="alert alert-danger" style='text-align: left;float: right;margin-right: 55px;width: 71.5%;'>
        <strong>Warring!</strong> You can't add any users and services  because your account credits is exhausted. - Please add credits <a href="cart.php?gid=<?php if ($_smarty_tpl->tpl_vars['topup']->value == '') {?>addons<?php } else {
echo $_smarty_tpl->tpl_vars['topup']->value;
}?>" target="_self">here</a>!
    </div> 
<?php } else { ?>
    <div class="alert alert-info" style="margin-top: 00px;margin-bottom: 10px;">
        Your Remaining Credits : <strong><?php echo $_smarty_tpl->tpl_vars['totalcredit']->value;?>
</strong>
    </div>       
<?php }?> 

<nav class="sm-nav" role="navigation">
    <div id="sm-nav"><span class="heading">Navigation</span>
        <ul id="menu" style="height: auto;">  
            <li <?php echo $_smarty_tpl->tpl_vars['dashboardactive']->value;?>
>
                <a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
" target="_self">
                    <i class="fa fa-home" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Dashboard
                </a> 
            </li>
            <li <?php echo $_smarty_tpl->tpl_vars['addactive']->value;?>
>
                <a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
&amp;action=adduser" target="_self">
                    <i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Add New user
                </a> 
            </li>  
            <li <?php echo $_smarty_tpl->tpl_vars['listactive']->value;?>
 >
                <a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
&amp;action=vpnusers" target="_self">
                    <i class="fa fa-users" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;List Users
                </a> 
            </li>
            <li <?php echo $_smarty_tpl->tpl_vars['installactive']->value;?>
 >
                <a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
&amp;action=installpanel" target="_self">
                    <i class="fa fa-gears" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Install Separated VPN Panel
                </a> 
            </li> 
            <li <?php echo $_smarty_tpl->tpl_vars['APIKEYactive']->value;?>
 >
                <a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
&amp;action=vpn_resellerapikey" target="_self">
                    <i class="fa fa-key" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;API Keys
                </a> 
            </li>  
            <li <?php echo $_smarty_tpl->tpl_vars['listallservices']->value;?>
>
                <a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
&amp;action=vpnusersServices" target="_self">
                    <i class="fa fa-list" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;List Services
                </a> 
            </li> 
            <!--li <?php echo $_smarty_tpl->tpl_vars['listinactive']->value;?>
>
                <a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
&amp;action=vpninactiveusers" target="_self">
                    <i class="fa fa-list" aria-hidden="true"></i>Trial Services
                </a> 
            </li-->
            <?php if ($_smarty_tpl->tpl_vars['checkgroup']->value == 'superreseller') {?>
                <li <?php echo $_smarty_tpl->tpl_vars['addreseller']->value;?>
>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
&amp;action=addreseller" target="_self">
                        <i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Add Reseller
                    </a> 
                </li>
                <li <?php echo $_smarty_tpl->tpl_vars['reseller']->value;?>
>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
&amp;action=resellers" target="_self">
                        <i class="fa fa-users" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;List Resellers
                    </a> 
                </li>
            <?php }?>
            <!-- <li <?php echo $_smarty_tpl->tpl_vars['autorenew']->value;?>
>
                <a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
&amp;action=vpnautorenew" target="_self">
                    <i class="fa fa-refresh" aria-hidden="true"></i>Auto Renew
                </a> 
            </li> -->
            <li>
                <a href="credits.php" target="_self">
                    <i class="fa fa-money" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;My Credits
                </a> 
            </li> 
            <li> 
                <a href="cart.php?gid=3" target="_self"><i class="fa fa-credit-card" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Buy Credits</a>
            </li>
            
			<?php if ($_smarty_tpl->tpl_vars['checkgroup']->value == 'superreseller') {?>
			<li <?php echo $_smarty_tpl->tpl_vars['shopingcartactive']->value;?>
 >
                <a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
&amp;action=vpnmyshopingcart" target="_self">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;My Shoping Cart
                </a>
                <!-- <a href="#" target="_self">
                    My Shoping Cart (Comminng Soon)
                </a> --> 
            </li>
			<li <?php echo $_smarty_tpl->tpl_vars['packpriceactive']->value;?>
 >
                <a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
&amp;action=vpnpackageprice" target="_self">
            <i class="fa fa-folder" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Package Price
             </a>
             <!-- <a href="#" target="_self">
                    Package Price (Comminng Soon)
                </a> --> 
            </li> 
			<?php } else { ?>
			<li <?php echo $_smarty_tpl->tpl_vars['shopingcartactive']->value;?>
 >
                <a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
&amp;action=vpnmywebsite" target="_self">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;My Shoping Cart
                </a> 
                <!-- <a href="#" target="_self">
                    My Shoping Cart (Comminng Soon)
                </a> -->
            </li>
			<li >
                <a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
&amp;action=vpnpackageprice" target="_self">
            <i class="fa fa-folder" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Package Price
             </a> 
             <!-- <a href="#" target="_self">
                    Package Price (Comminng Soon)
                </a> -->
            </li> 
			<?php }?>
             
            
            <!--li id="Primary_Navbar-Support">
                <a href="/submitticket.php" target="_self">
                    Need a Help!
                </a> 
            </li-->  
        </ul>
    </div>
</nav>
<?php }
}
