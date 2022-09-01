<?php
/* Smarty version 3.1.36, created on 2020-11-11 07:47:00
  from '/var/www/html/modules/addons/vpnpanel/templates/dashboard.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fab96f4360479_73510218',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ec50180ba33fda56e1f9d3f9f010250ffcf1bd1c' => 
    array (
      0 => '/var/www/html/modules/addons/vpnpanel/templates/dashboard.tpl',
      1 => 1605080588,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fab96f4360479_73510218 (Smarty_Internal_Template $_smarty_tpl) {
?><style>
    .huge
    {
        font-size: 45px;
        line-height: 45px;
    }
    .panel-green 
    {
        border-color: #5cb85c;
    }
    .panel-green > .panel-heading 
    {
        border-color: #5cb85c;
        color: white;
        background: linear-gradient(270deg,#179608 0%,#5cb85c 100%);
    }

    .panel-green .panel-heading i
    {
        padding: 11px;
        border: solid 3px #fff;
        border-radius: 50%;
        background: #fff;
        color: #5cb85c;
    }
    .panel-blue 
    {
        border-color: #3e8ee0;
    }
    .panel-blue > .panel-heading 
    {
        border-color: #3e8ee0;
        color: white;
        background: linear-gradient(270deg,#085596 0%,#3e8ee0 100%);
    }

    .panel-blue .panel-heading i
    {
        padding: 11px;
        border: solid 3px #fff;
        border-radius: 50%;
        background: #fff;
        color: #3e8ee0;
    }

    .panel-purple .panel-heading i
    {
        padding: 11px;
        border: solid 3px #fff;
        border-radius: 50%;
        background: #fff;
        color: #9444c2;
        width:69px;
        text-align:center;
    }

    .panel-vpn
    {
        border-color: #ef7022;
    }
    .panel-vpn > .panel-heading 
    {
        border-color: #ef7022;
        color: white;
        background: linear-gradient(270deg,#e84942 0%,#ef7022 100%);
    }

    .panel-yellow {
        border-color: #f0ad4e;
    }
    .panel-yellow > .panel-heading {
        border-color: #f0ad4e;
        color: white;
        background: linear-gradient(270deg,#e28a0d 0%,#f0ad4e 100%);
    }
    .panel-yellow .panel-heading i
    {
        padding: 11px;
        border: solid 3px #fff;
        border-radius: 50%;
        background: #fff;
        color: #f0ad4e;
    }
    .panel-red {
        border-color: #d9534f;
    }

    .panel-red > .panel-heading {
        border-color: #d9534f;
        color: white;
        background: linear-gradient(270deg,#ea1913 0%,#d9534f 100%);
    }
    .panel-red .panel-heading i
    {
        padding: 11px;
        border: solid 3px #fff;
        border-radius: 50%;
        background: #fff;
        color: #d9534f;
    }

    .panel-gray {
        border-color: #e5458f;
    }

    .panel-gray > .panel-heading {
        border-color: #c03574;
        color: white;
        background: linear-gradient(270deg,#961156 0%,#e84792 100%);
    }



    .panel-gray .panel-heading i
    {
        padding: 11px;
        border: solid 3px #fff;
        border-radius: 50%;
        background: #fff;
        color: #c13573;
    }

    .panel-aqua
    {
        border-color: #3bbdb0;
    }

    .panel-aqua > .panel-heading
    {
        border-color: #3bbdb0;
        color: white;
        background: linear-gradient(270deg,#2e948a 0%,#3bbdb0 100%);
    }

    .panel-aqua .panel-heading i
    {
        padding: 11px;
        border: solid 3px #fff;
        border-radius: 50%;
        background: #fff;
        color: #3bbdb0;
    }

    .panel-purple
    {
        border-color: #d280f0;
    }

    .panel-purple > .panel-heading
    {
        border-color: #d280f0;
        color: white;
        background: linear-gradient(270deg,#470461 0%,#aa0de2 100%)
    }



    .panel_hvr 
    {
        transition: all 0.5s;
    }
    .panel_hvr:hover 
    {
        transform: scale(1.05); transition: all 0.5s;
    }
</style>  
<div class="row" style="margin-top: 30px;"> 


    <div class="col-lg-3 col-md-6">
        <a  href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
&action=vpn_accounts">
            <div class="panel panel-purple panel_hvr">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $_smarty_tpl->tpl_vars['totalclients']->value;?>
</div>
                            <div>VPN Accounts</div>
                        </div>
                    </div>
                </div>

                <div class="panel-footer">
                    <span class="pull-left">Manage VPN Accounts </span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>

            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-6">
        <a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
&action=vpn_resellers">
            <div class="panel panel-yellow panel_hvr">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-users fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $_smarty_tpl->tpl_vars['totalresellers']->value;?>
</div>
                            <div>VPN Resellers</div>
                        </div>
                    </div>
                </div>

                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>

            </div>
        </a>
    </div>

    <div class="col-lg-3 col-md-6">
        <a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
&action=vpn_superresellers">
            <div class="panel panel-red panel_hvr">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-users fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $_smarty_tpl->tpl_vars['totalsuperresellers']->value;?>
</div>
                            <div>VPN Super Resellers</div>
                        </div>
                    </div>
                </div>

                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>

            </div>
        </a>
    </div>

    <div class="col-lg-3 col-md-6">
        <a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
&action=vpn_servers">
            <div class="panel panel-vpn panel_hvr">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <img src="../modules/addons/vpnpanel/vpn1-icon.png">
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $_smarty_tpl->tpl_vars['count']->value;?>
</div>
                            <div>VPN Servers</div>
                        </div>
                    </div>
                </div>

                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>

            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-6">
        <a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
&action=vpn_applinks">
            <div class="panel panel-green panel_hvr">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-link fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $_smarty_tpl->tpl_vars['applink']->value;?>
</div>
                            <div>VPN App Links</div>
                        </div>
                    </div>
                </div>

                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>

            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-6">
        <a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
&action=vpn_api">
            <div class="panel panel-red panel_hvr">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-anchor fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">

                            <div>API</div>
                        </div>
                    </div>
                </div>

                <div class="panel-footer">
                    <span class="pull-left">Generate API Key</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>

            </div>
        </a>
    </div>

    <div class="col-lg-3 col-md-6">
        <a target="_blank" href="https://www.whmcssmarters.com/clients/index.php?rp=/knowledgebase/28/VPN-Software-Solution">
            <div class="panel panel-blue panel_hvr">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-book fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">

                            <div>Knowledgebase</div>
                        </div>
                    </div>
                </div>

                <div class="panel-footer">
                    <span class="pull-left">Knowledgebase </span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>

            </div>
        </a>
    </div>   
    <div class="col-lg-3 col-md-6">
        <a  href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
&action=vpn_onlineusers">
            <div class="panel panel-gray panel_hvr">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-users fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $_smarty_tpl->tpl_vars['onlineusers']->value;?>
</div>
                            <div>Online Users</div>
                        </div>
                    </div>
                </div>

                <div class="panel-footer">
                    <span class="pull-left">List Online Users </span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>

            </div>
        </a>
    </div>

    <div class="col-lg-3 col-md-6">
        <a  href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
&action=vpn_settings">
            <div class="panel panel-red panel_hvr">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-cog fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            
                            <div>Settings</div>
                        </div>
                    </div>
                </div>

                <div class="panel-footer">
                    <span class="pull-left">VPN Settings </span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>

            </div>
        </a>
    </div>

    <div class="col-lg-3 col-md-6">
        <a  href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
&action=vpn_serverConfig">
            <div class="panel panel-green panel_hvr">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-cog fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            
                            <div>Server Configuration</div>
                        </div>
                    </div>
                </div>

                <div class="panel-footer">
                    <span class="pull-left">VPN Server Config. </span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>

            </div>
        </a>
    </div>


</div>
<?php }
}
