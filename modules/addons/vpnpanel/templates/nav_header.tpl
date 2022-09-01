<link href="modules/addons/vpnpanel/templates/css/swiftmodders.css" rel="stylesheet">
<link href="modules/addons/vpnpanel/templates/css/mystyle.css" rel="stylesheet"> 
<link href="modules/addons/vpnpanel/templates/css/bootstrap-social.css" rel="stylesheet">
{if $totalcredit eq '0.00'}
    <div class="alert alert-danger" style='text-align: left;float: right;margin-right: 55px;width: 71.5%;'>
        <strong>Warring!</strong> You can't add any users and services  because your account credits is exhausted. - Please add credits <a href="cart.php?gid={if $topup eq ''}addons{else}{$topup}{/if}" target="_self">here</a>!
    </div> 
{else}
    <div class="alert alert-info" style="margin-top: 00px;margin-bottom: 10px;">
        Your Remaining Credits : <strong>{$totalcredit}</strong>
    </div>       
{/if} 

<nav class="sm-nav" role="navigation">
    <div id="sm-nav"><span class="heading">Navigation</span>
        <ul id="menu" style="height: auto;">  
            <li {$dashboardactive}>
                <a href="{$modulelink}" target="_self">
                    <i class="fa fa-home" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Dashboard
                </a> 
            </li>
            <li {$addactive}>
                <a href="{$modulelink}&amp;action=adduser" target="_self">
                    <i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Add New user
                </a> 
            </li>  
            <li {$listactive} >
                <a href="{$modulelink}&amp;action=vpnusers" target="_self">
                    <i class="fa fa-users" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;List Users
                </a> 
            </li>
            <li {$installactive} >
                <a href="{$modulelink}&amp;action=installpanel" target="_self">
                    <i class="fa fa-gears" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Install Separated VPN Panel
                </a> 
            </li> 
            <li {$APIKEYactive} >
                <a href="{$modulelink}&amp;action=vpn_resellerapikey" target="_self">
                    <i class="fa fa-key" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;API Keys
                </a> 
            </li>  
            <li {$listallservices}>
                <a href="{$modulelink}&amp;action=vpnusersServices" target="_self">
                    <i class="fa fa-list" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;List Services
                </a> 
            </li> 
            <!--li {$listinactive}>
                <a href="{$modulelink}&amp;action=vpninactiveusers" target="_self">
                    <i class="fa fa-list" aria-hidden="true"></i>Trial Services
                </a> 
            </li-->
            {if $checkgroup eq 'superreseller'}
                <li {$addreseller}>
                    <a href="{$modulelink}&amp;action=addreseller" target="_self">
                        <i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Add Reseller
                    </a> 
                </li>
                <li {$reseller}>
                    <a href="{$modulelink}&amp;action=resellers" target="_self">
                        <i class="fa fa-users" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;List Resellers
                    </a> 
                </li>
            {/if}
            <!-- <li {$autorenew}>
                <a href="{$modulelink}&amp;action=vpnautorenew" target="_self">
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
            
			{if $checkgroup eq 'superreseller'}
			<li {$shopingcartactive} >
                <a href="{$modulelink}&amp;action=vpnmyshopingcart" target="_self">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;My Shoping Cart
                </a>
                <!-- <a href="#" target="_self">
                    My Shoping Cart (Comminng Soon)
                </a> --> 
            </li>
			<li {$packpriceactive} >
                <a href="{$modulelink}&amp;action=vpnpackageprice" target="_self">
            <i class="fa fa-folder" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Package Price
             </a>
             <!-- <a href="#" target="_self">
                    Package Price (Comminng Soon)
                </a> --> 
            </li> 
			{else}
			<li {$shopingcartactive} >
                <a href="{$modulelink}&amp;action=vpnmywebsite" target="_self">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;My Shoping Cart
                </a> 
                <!-- <a href="#" target="_self">
                    My Shoping Cart (Comminng Soon)
                </a> -->
            </li>
			<li >
                <a href="{$modulelink}&amp;action=vpnpackageprice" target="_self">
            <i class="fa fa-folder" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Package Price
             </a> 
             <!-- <a href="#" target="_self">
                    Package Price (Comminng Soon)
                </a> -->
            </li> 
			{/if}
             
            
            <!--li id="Primary_Navbar-Support">
                <a href="/submitticket.php" target="_self">
                    Need a Help!
                </a> 
            </li-->  
        </ul>
    </div>
</nav>
