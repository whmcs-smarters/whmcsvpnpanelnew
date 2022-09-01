<?php
/* Smarty version 3.1.36, created on 2020-11-19 07:37:31
  from '/var/www/html/modules/addons/vpnpanel/templates/supresellerpanel.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fb620bb914894_90011070',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dd5ce71f424fca9236b86443b20864283256099f' => 
    array (
      0 => '/var/www/html/modules/addons/vpnpanel/templates/supresellerpanel.tpl',
      1 => 1605080588,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:modules/addons/vpnpanel/templates/nav_header.tpl' => 1,
  ),
),false)) {
function content_5fb620bb914894_90011070 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="container" style="width: 100%;margin-top: 20px;"> 
    <?php $_smarty_tpl->_subTemplateRender('file:modules/addons/vpnpanel/templates/nav_header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <div class="sm-content-container">
        <div class="sm-content">
            <div class="sm-page-heading">
                <h1>Dashboard</h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="index.php">Portal Home</a>        
                    </li>
                    <li class="active">
                        Dashboard
                    </li>
                </ol>
            </div>  
            <div class="tab-pane fade in active" id="tabOverview"> 
                <div class="product-details clearfix">
                    <div class="row">
                        <div class="col-lg-3 col-md-3">
                            <div class="panel panel-primary">
                                <a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
&action=vpnusers">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3"> 
                                                <i class="fa fa-users fa-5x"  aria-hidden="true"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge"><?php echo $_smarty_tpl->tpl_vars['totalusers']->value;?>
</div>
                                                <div>Total Users!</div>
                                                <div>Active + Trial Users!</div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
&action=vpnusers">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div> 
                        <div class="col-lg-3 col-md-3">
                            <div class="panel panel-green">
                                <a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
&action=vpninactiveusers">
                                    <div class="panel-heading">

                                        <div class="row">
                                            <div class="col-xs-3">  
                                                <i class="fa fa-user-times fa-5x"  aria-hidden="true"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge"><?php echo $_smarty_tpl->tpl_vars['undertrial']->value;?>
</div>
                                                <div>Under Trial Services!</div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
&action=vpninactiveusers">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <div class="panel panel-pink">
                                <a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
&action=resellers">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3"> <i class="fa fa-user-circle-o fa-5x"  aria-hidden="true"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge"><?php echo $_smarty_tpl->tpl_vars['reseller']->value;?>
</div>
                                                <div>Resellers!</div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
&action=resellers">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <div class="panel panel-yellow">
                                <a href="credits.php">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-usd fa-5x" aria-hidden="true"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div style="font-size: 30px;"><?php echo $_smarty_tpl->tpl_vars['totalcredit']->value;?>
</div>
                                                <div>Credits!</div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="credits.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div> 
                    </div>
                    <div class="row" style="margin-bottom: 25px;"> 
                        <div class="col-lg-3 col-md-3"><a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
&action=adduser" class="btn btn-block btn-social btn-bitbucket btn1" style="background-color: #337ab7;color: white;">
                                <i class="fa fa-plus-circle" style="left: 5px;top: -2px;"></i> Add New User
                            </a>
                        </div>   
                        <div class="col-lg-3 col-md-3"><a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
&action=adduser" class="btn btn-block btn-social btn-bitbucket btn2" style="background-color: #5cb85c;color: white;">
                                <i class="fa fa-plus-circle" style="left: 5px;top: -2px;"></i> Add New User
                            </a>
                        </div>  <div class="col-lg-3 col-md-3"><a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
&action=addreseller" class="btn btn-block btn-social btn-bitbucket btn4" style="background-color: #ea5395;color: white;width: 60%;">
                                <i class="fa fa-plus-circle" style="left: 5px;top: -2px;"></i> Add New Reseller
                            </a>
                        </div> 
                        <div class="col-lg-3 col-md-3"> <a href="cart.php?gid=<?php if ($_smarty_tpl->tpl_vars['topup']->value == '') {?>addons<?php } else {
echo $_smarty_tpl->tpl_vars['topup']->value;
}?>" class="btn btn-block btn-social btn-bitbucket btn3" style="background-color: #d69232;color: white;">
                                <i class="fa fa-plus-circle" style="left: 5px;top: -2px;" ></i> Add Credits
                            </a></div>

                    </div> 
                </div> 
            </div> 
        </div>
    </div> 
</div>  <?php }
}
