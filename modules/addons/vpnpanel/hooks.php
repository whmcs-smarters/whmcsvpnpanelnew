<?php

if (!defined("WHMCS"))
    die("This file cannot be accessed directly");

use WHMCS\Database\Capsule;

include_once('functions.php');
add_hook('ClientAreaPage', 1, function($vars) {

    if (isset($_SESSION['uid']) && !empty($_SESSION['uid'])) {
        $testing = '';
        $clientdata = Capsule::table('tblclients')->where('id', '=', $_SESSION['uid'])->get();
        if (isset($clientdata[0]->groupid) && !empty($clientdata[0]->groupid)) {
            $clientgrop = Capsule::table('tblclientgroups')->where('id', '=', $clientdata[0]->groupid)->get();

            if ($clientgrop[0]->groupname == 'Reseller' || $clientgrop[0]->groupname == 'Super-Reseller') {
                $products = vpn_getProducts();

                if (isset($products) && !empty($products)) {
                    foreach ($products as $product) {
                        $results = vpn_getClientProducts($_SESSION['uid'], $product->id);

                        if ($results['result'] == "success") {
                            $final = $results['totalresults'];
                            if (!empty($results['products']['product'])) {
                                foreach ($results['products']['product'] as $ProductDt) {
                                    if ($vars['filename'] == 'clientarea' && $vars['clientareaaction'] != 'addfunds' && $vars['clientareaaction'] != 'services' && $vars['clientareaaction'] != 'invoices' && $vars['clientareaaction'] != 'productdetails' && $final != '0' && $ProductDt['status'] == 'Active') {
                                        $_SESSION['producttype'] = 'vpnservernapi';

                                        if ($vars["action"] == "details" || $vars["action"] == "creditcard" || $vars["action"] == "changepw") {
                                            //no redirection
                                        } else {
                                            header('location:index.php?m=vpnpanel');
                                            exit;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
});

add_hook('AdminAreaHeadOutput', 1, function($vars) {

    if($vars['filename'] == 'addonmodules') {
        if (isset($_REQUEST['module']) && $_REQUEST['module'] == 'vpnpanel') {
            $serverActive = '';
            $appActive = '';
            $reselerActive = '';
            $dashActive = '';
            $assignActive = '';
            $apiActive = '';
            if (isset($_REQUEST['action'])) {
                if ($_REQUEST['action'] == 'vpn_servers') {
                    $serverActive = 'active';
                } else if ($_REQUEST['action'] == 'vpn_applinks') {
                    $appActive = 'active';
                } else if ($_REQUEST['action'] == 'vpn_resellers' || $_REQUEST['action'] == 'vpn_listusers') {
                    $reselerActive = 'active';
                }else if ($_REQUEST['action'] == 'vpn_superresellers') {
                    $superreselerActive = 'active';
                } else if ($_REQUEST['action'] == 'vpn_assignPackages') {
                    $assignActive = 'active';
                } else if ($_REQUEST['action'] == 'vpn_api') {
                    $apiActive = 'active';
                }
                else if ($_REQUEST['action'] == 'vpn_serverConfig') {
                    $configActive = 'active';
                }
                else if ($_REQUEST['action'] == 'vpn_accounts') {
                    $accountActive = 'active';
                }
            } else {
                $dashActive = 'active';
            }
        }
    }
if($vars['template'] == 'vpnpanel')
    {
        //echo '<pre>';print_r($vars);
        if($vars['pagetitle'] !== 'Viewing Email Message') {
            if(Capsule::schema()->hasTable('server_list')) {
                if($total = Capsule::table('server_list')->count() == 0) {
                    $servererror = '  <script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("<div class=\"alert alert-danger fade in alert-dismissable\" style=\"width: 80%;margin: 11px auto;margin: 11px auto;position: fixed;width: 389px;float: right;right: 15px;top: 0px;z-index: 99999;\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\" title=\"close\">x</a><strong>VPN Panel  :</strong> No Server Setup -  Please add your first VPN Server. Click <a target=\"blank_\"href=\"addonmodules.php?module=vpnpanel&action=vpn_servers\">Here</a> to add servers.</div>").insertBefore("#contentarea");
    });
</script>';
                }
            }
            return <<<HTML
    <style>
    .vpnlinks a, #vpnlinks1 a
    {
        float: right;
        margin-left: 10px;
        margin-bottom: 0px;
    }
    #vpnlinks1
    {
        position: absolute; 
    }
    .vpnlinks
    {
       position: relative;
margin: auto;
width: 1200px;
    }
    .vpnlinkholder
    {
        width: 100%;
        float: left;
        padding: 10px;
    }
    .vpnlinks a.active, #vpnlinks1 a.active
    {
        background-color: #333 !important;
        border-color: #333 !important;
        box-shadow: 0px 0px 10px -2px #000;
        color: #fff !important;
    }
    #vpnlinks1
    {
        display: none;
        width: 50%;
    }
    .logo img
    {
        width:20%!important;
    }
    .mobilemenu1,  .mobilemenu2
    {
        display: none;
    }
    @media screen and (max-width:1050px)
    {
    #contentarea
    {
        z-index: 3;
    }
    .topbar
    {
        display: block;
    }
        .vpnlinks
        {
            display: none;
        }
        #vpnlinks1
        {
            display: block;
            position: absolute;
            top: 172px;
            width: 256px;
            right: 0px !important;
        }
        #vpnlinks1 a
        {
            float: right;
            clear: both;
            width: 100%;
            margin: 0px 0px 1px 0px;
            text-align: right;
            color:#fff;
            border: none;
            background: #2e2e2e;
        }
        
        .logo img
        {
            width:80%!important;
            margin-top: 10px;
            max-width: 300px;
        }
        
        .mobilemenu1
        {
            display: block !important;
            color: #fff;
            float: left;
            font-size: 18px;
            position: relative;
            left: -10px;
            margin-top: 12px;
            margin-bottom: 0px;
            background: transparent; 
            border: none;
            outline: none;
        }
        .mobilemenu2
        {
            display: block !important;
            color: #fff;
            float: right;
            font-size: 18px;
            position: relative;
            right: -10px;
            margin-top: 12px;
            margin-bottom: 0px;
            background: transparent; 
            border: none;
            outline: none;
        }
        .mobilemenu1:before
        {
            font-size: 25px;
        }
        #menu1
        {
            position: absolute;
        }
        #menu
        {
            float: left: 0px;
            left: 0px;
            top: 172px;
            margin-left: 1px;
            display: list-item;
            width: 256px;
        }
        #menu li
        {
            float: left;
            width: 100%;
            margin-bottom: 1px;
            position: relative;
            height: auto !important;
        }
        
        #menu li a
        {
            float: left;
        }
        
        #menu li ul
        {
            position: relative;
            float: left;
            width: 100%;
        }
        
        #menu li ul li ul
        {
            position: relative;
            float: left;
            width: 100%;
        }
        
        #menu li ul li
        {
            background: rgba(255, 255, 255, 0.5) !important;
            border-radius: 0px;
            margin-bottom: 0px;
        }
        
        #widgetSettings
        {
            float: right !important;
        }
        
        body {
  width: 100%;
  height: 100%;
}


.slideout-menu-left {
  left: 0;
}

.slideout-menu-right {
  right: 0;
}


.slideout-open,
.slideout-open body,
.slideout-open .slideout-panel {
  overflow: hidden;
}

.slideout-open .slideout-menu {
  display: block;
}

#menu > li:hover > ul.submenu
{
    display: block;
}

#menu > ul > li:hover > ul.subsubmenu
{
    display: block;
}

.navigation ul li ul li ul
{
margin: 0px !important;
    text-indent: 30px !important;
    box-shadow: 0px 0px 0px 0px #000;
}
        
    }
    </style>
    {$servererror}
    <script>
    $(document).ready(function(){ 
        $('body').prepend('<div id="vpnlinks1" style="{$dashboardshow}"><a href="https://www.whmcssmarters.com/clients/index.php?rp=/knowledgebase/28/VPN-Software-Solution" target="_blank" class="btn btn-default">Knowledgebase</a><a href="addonmodules.php?module=vpnpanel&action=vpn_api" class="btn btn-default {$apiActive}">API Key</a><a href="addonmodules.php?module=vpnpanel&action=vpn_serverConfig" class="btn btn-default {$configActive}">Server Configuration </a> <a href="addonmodules.php?module=vpnpanel&action=vpn_applinks" class="btn btn-default {$appActive}">VPN App Links</a><a href="addonmodules.php?module=vpnpanel&action=vpn_servers" class="btn btn-default {$serverActive}">VPN Servers</a>  <a href="addonmodules.php?module=vpnpanel&action=vpn_resellers" class="btn btn-default {$reselerActive}">VPN Resellers</a> <a href="addonmodules.php?module=vpnpanel&action=vpn_superresellers" class="btn btn-default {$superreselerActive}">VPN Super-Resellers</a><a href="addonmodules.php?module=vpnpanel&action=vpn_accounts" class="btn btn-default {$accountActive}">VPN Accounts </a><a href="addonmodules.php?module=vpnpanel" class="btn btn-default {$dashActive}">VPN Dashboard</a></div>');
        $('#menu1').after('<div class="vpnlinkholder"><div class="vpnlinks"><a href="https://www.whmcssmarters.com/clients/index.php?rp=/knowledgebase/28/VPN-Software-Solution" target="_blank" class="btn btn-default">Knowledgebase</a><a href="addonmodules.php?module=vpnpanel&action=vpn_api" class="btn btn-default {$apiActive}">API Key</a><a href="addonmodules.php?module=vpnpanel&action=vpn_serverConfig" class="btn btn-default {$configActive}">Server Configuration </a>  <a href="addonmodules.php?module=vpnpanel&action=vpn_applinks" class="btn btn-default {$appActive}">VPN App Links</a><a href="addonmodules.php?module=vpnpanel&action=vpn_servers" class="btn btn-default {$serverActive}">VPN Servers</a> <a href="addonmodules.php?module=vpnpanel&action=vpn_resellers" class="btn btn-default {$reselerActive}">VPN Resellers</a> <a href="addonmodules.php?module=vpnpanel&action=vpn_superresellers" class="btn btn-default {$superreselerActive}">VPN Super-Resellers</a><a href="addonmodules.php?module=vpnpanel&action=vpn_accounts" class="btn btn-default {$accountActive}">VPN Accounts </a><a href="addonmodules.php?module=vpnpanel" class="btn btn-default {$dashActive}">VPN Dashboard</a></div></div>');
        $('#menu>li').click(function(){
            $(this).children('.submenu').toggle();
            $('.navigation ul li ul li ul').show(0);
        })
        
    })
    </script>
    
HTML;
        }
    }


});
//<a href="addonmodules.php?module=vpnpanel&action=vpn_serverConfig" class="btn btn-default {$configActive}">Server Configuration </a> 
//<a href="addonmodules.php?module=vpnpanel&action=vpn_serverConfig" class="btn btn-default {$configActive}">Server Configuration </a>

add_hook('EmailPreSend', 1, function($vars) {
     
    $merge_fields = [];
    if ($vars['messagename'] == 'VPN Service Details') {
        //Stop the email from sending a specific message and related id.
        $androidapplinks = Capsule::table('mod_vpn_applinks')->where('appfor','android')->get();
        $merge_fields['androidapplinks'] = $androidapplinks[0]->applink;
        
        $windowapplinks = Capsule::table('mod_vpn_applinks')->where('appfor','windows')->get();
        $merge_fields['windowapplinks'] = $windowapplinks[0]->applink;
        
        $iosapplinks = Capsule::table('mod_vpn_applinks')->where('appfor','ios')->get();
        $merge_fields['iosapplinks'] = $iosapplinks[0]->applink;
        
        $linuxapplinks = Capsule::table('mod_vpn_applinks')->where('appfor','linux')->get();
        $merge_fields['linuxapplinks'] = $linuxapplinks[0]->applink;

        $linuxapplinks = Capsule::table('mod_vpn_applinks')->where('appfor','macos')->get();
        $merge_fields['macosapplinks'] = $linuxapplinks[0]->applink;
    }
    /*else if ($vars['messagename'] == 'Invoice Created') {
         if(isset($_SESSION['createdclientid']))
        {
            
            $clientdata = Capsule::table('tblclients')->where('id',$_SESSION['uid'])->select('groupid')->get();
            if($clientdata[0]->groupid !== 0)
            {
                //Stop the email from sending a specific message and related id.
                $merge_fields['abortsend'] = true;
            }
        }
    
    }
    else if ($vars['messagename'] == 'VPN Service details') {
        
             if(isset($_SESSION['createdclientid']))
        {
            $clientdata = Capsule::table('tblclients')->where('id',$_SESSION['uid'])->select('groupid')->get();
            if($clientdata[0]->groupid !== 0)
            {
                //Stop the email from sending a specific message and related id.
                $merge_fields['abortsend'] = true;
            }
        }
    
    }*/
    return $merge_fields;
});


add_hook('AcceptOrder', 1, function($vars) {
    
    
    $orderdata = Capsule::table('tblorders')->where('id',$vars['orderid'])->select('userid')->get();
    $serviceid = Capsule::table('tblhosting')->where('orderid',$vars['orderid'])->select('id')->get();
    $affdata = Capsule::table('tblaffiliatesaccounts')->where('relid',$orderdata[0]->userid)->select('affiliateid')->get();
    
    $resellerdata = Capsule::table('tblaffiliates')->where('id',$affdata[0]->affiliateid)->select('clientid')->get();
    
    $clientid = $resellerdata[0]->clientid;
    
    $client = Capsule::table('tblclients')->where('id',$clientid)->select('groupid')->get();
     
    $type = 'Reseller';
    if($client[0]->groupid == 1)
    {
        $type = 'Reseller';
        $command = 'SendEmail';
    $postData = array(

        'messagename' => 'VPN Service Details '.$type.''.$clientid,
        'id' => $serviceid[0]->id,
    );
    $results = localAPI($command, $postData);
    }
    else if($client[0]->groupid == 2)
    {
        $type = 'super Reseller';
        $command = 'SendEmail';
    $postData = array(

        'messagename' => 'VPN Service Details '.$type.''.$clientid,
        'id' => $serviceid[0]->id,
    );
    $results = localAPI($command, $postData);
    }
    else
    {
        $command = 'SendEmail';
    $postData = array(

        'messagename' => 'VPN Service detail',
        'id' => $serviceid[0]->id,
    );
    $results = localAPI($command, $postData);
    }
    
    
});