{if $response}    {if $response == "success"}        {include file="$template/includes/alert.tpl" type="success" msg={$message} textcenter=true idname="alertModuleCustomButtonSuccess"}    {else}        {include file="$template/includes/alert.tpl" type="error" msg={$message}  textcenter=true idname="alertModuleCustomButtonFailed"}    {/if}{/if}{if $pendingcancellation}    {include file="$template/includes/alert.tpl" type="error" msg=$LANG.cancellationrequestedexplanation textcenter=true idname="alertPendingCancellation"}{/if} {if $alertmessage}    {include file="$template/includes/alert.tpl" type="info" msg=$alertmessage textcenter=true idname="alertModuleCustomButtoninfo"}{/if} 
<style>
    .row.new_custom1 {
        height: 130px;
    }
    .btn_new_here{
        border: transparent;
        background: url(modules/servers/vpnservernoapi/templates/images/donwload.png) #ff9601;
        background-size: 75%;
        height: 52px;
        color: #fff;
        font-size: 17px;
        background-repeat: no-repeat;
        text-align: center;
        margin: 0 auto;
        position: absolute;
        background-position:0% 50%;
        transition: all 0.2s;
        width: 86%;
        padding-left: 70px;
        padding-top: 7px;
    }
    .btn_new_here:hover,.btn_new_here:active,.btn_new_here:focus{
        /*background: url(modules/servers/vpnservernoapi/templates/images/donwload.png) #ff9601;*/
        color: #fff;
        filter: drop-shadow(8px 8px 10px #888) contrast(110%);
        transition: all 0.2s;
    }
    .btn_new_here1{
        border: transparent;
        background: url(modules/servers/vpnservernoapi/templates/images/QR.png) #000;
        background-size: 100%;
        height: 52px;
        color: #fff;
        font-size: 17px;
        background-repeat: no-repeat;
        text-align: center;
        margin: 0 auto;
        position: relative;
        background-position:0% 50%;
        transition: all 0.2s;
        top: 10px;
        width: 86%;
        padding-left: 20px;
        text-indent: 5px !important;
    }
    .btn_new_here1:hover,.btn_new_here1:active,.btn_new_here1:focus{
        /*background: url(modules/servers/vpnservernoapi/templates/images/QR.png) #000;*/
        color: #fff;
        filter: drop-shadow(8px 8px 10px #888) contrast(110%);
        transition: all 0.2s;
    }


    .btn_new_here2{
        border: transparent;
        background: url(modules/servers/vpnservernoapi/templates/images/server.png) #3f8ddd;
        background-size: 40px;
        background-position-x: 12px !important;
        height: 52px;
        color: #fff;
        font-size: 17px;
        background-repeat: no-repeat;
        text-align: center;
        margin: 0 auto;
        position: relative;
        background-position:0% 50%;
        transition: all 0.2s;
        top: 10px;
        width: 86%;
        padding: 5px 70px !important;
    }
    .btn_new_here2:hover,.btn_new_here2:active,.btn_new_here2:focus{
        /*background: url(modules/servers/vpnservernoapi/templates/images/QR.png) #000;*/
        color: #fff;
        filter: drop-shadow(8px 8px 10px #888) contrast(110%);
        transition: all 0.2s;
    }
    .dropdown-menu
    {
    left: -60px !important;
    }
</style>

<script>
$(document).ready(function(){
{if $downloadovpn eq 1}
window.open('{$systemURL}client.ovpn');
{/if}
{if $downloadcert eq 1}
window.open('{$systemURL}ca-cert.pem');
{/if}

$('.downloadapp').click(function(){
    $('.download-popup').show();
})
$('.closeovpnPopup').click(function(){
        $('.download-popup').hide();
    })

    /*$('.downloadovpn').click(function(){
        $('.download-popup').show();
    })

    */
})
</script>
<div class="tab-content margin-bottom">
    <div class="tab-pane fade in active" id="tabOverview">
        <div class="product-details clearfix">
            <div class="row">
                <div class="col-md-6">
                    <div class="product-status product-status-{$rawstatus|strtolower}">
                        <div class="product-icon text-center">
                            <span class="fa-stack fa-lg">                            
                                <i class="fa fa-circle fa-stack-2x">
                                </i>                            
                                <i class="fa fa-television fa-stack-1x fa-inverse">
                                </i>                        
                            </span>                        
                            <h3>{$product}
                            </h3>
                            <h4>{$groupname}
                            </h4>
                        </div>
                        <div class="product-status-text">                        {$status}                    
                        </div>
                    </div>
                    {$unsuspend}  
                    <!--button class="btn btn-info btn-lg vpndetailsbtn text-center" style="width: 100%;">VIEW VPN DETAILS</button-->
                </div>

                <div class="col-lg-6">
                    <div  class="panel panel-default panel-accent-green">
                        <div class="panel-heading">
                            <h3 class="panel-title">                            
                                <i class="fa fa-info">
                                </i>&nbsp;Product Details                        
                            </h3>
                        </div>
                        <div class="list-group">
                            <div class="list-group-item" >                            Product : 
                                <strong class="text-domain">{$product} - {$groupname}
                                </strong>                        
                            </div>
                            <div class="list-group-item" >                            {$LANG.clientareastatus} : 
                                <span class="label status status-{$rawstatus}" style="display: inline;">{$status}
                                </span>                        
                            </div>
                            <div class="list-group-item" >                            {$LANG.clientareahostingregdate} : 
                                <strong class="text-domain"> {$regdate}
                                </strong>                        
                            </div>
                            <div style="color:red" class="list-group-item" >                    {if $nextduedate eq '' || $nextduedate eq '-'} Exp Date{else}{$LANG.clientareahostingnextduedate}{/if} : 
                                <strong style="color:red" class="text-domain">{if $nextduedate eq '' || $nextduedate eq '-'}{if $exp_date neq ''}{$exp_date|date_format:"%A, %B %e, %Y"}{else}-{/if}{else}{$nextduedate}{/if}
                                </strong>                
                            </div>
                            <div class="list-group-item" >                    {$LANG.recurringamount} : 
                                <strong class="text-domain">{$recurringamount}
                                </strong>                
                            </div>
                            <div class="list-group-item" >                    {$LANG.orderbillingcycle} : 
                                <strong class="text-domain"> {$billingcycle}
                                </strong>                
                            </div>
                            <div class="list-group-item" >                    {$LANG.orderpaymentmethod} : 
                                <strong class="text-domain">{$paymentmethod}
                                </strong>                
                            </div>
                            <div class="list-group-item" >                    {$LANG.firstpaymentamount} : 
                                <strong class="text-domain">{$firstpaymentamount}
                                </strong>                
                            </div> 
                            {foreach from=$extracustomfields key=customfieldname item=customfieldvalue}

                                <div class="list-group-item" >
                                    {$customfieldname}

                                    <strong class="text-domain">
                                        {$customfieldvalue}
                                    </strong>                
                                </div>
                            {/foreach}
                            {if $configurableoptions}  
                                {foreach from=$configurableoptions item=configoption}                        
                                    <div class="list-group-item" >                            
                                        {$configoption.optionname}                             
                                        <strong class="text-domain">    
                                            {if $configoption.optiontype eq 3}
                                                {if $configoption.selectedqty}
                                                    {$LANG.yes}
                                                {else}
                                                    {$LANG.no}
                                                {/if}
                                            {elseif $configoption.optiontype eq 4}
                                                {$configoption.selectedqty} x {$configoption.selectedoption}
                                            {else}
                                                {$configoption.selectedoption}
                                            {/if}            
                                        </strong>
                                    </div>
                                {/foreach}
                            {/if}
                            {if $lastupdate}
                                <div class="list-group-item" >        {$LANG.clientareadiskusage} : 
                                    <strong class="text-domain">{$diskusage}MB / {$disklimit}MB ({$diskpercent})
                                    </strong>    
                                </div>
                                <div class="list-group-item" >        {$LANG.clientareabwusage} : 
                                    <strong class="text-domain">{$bwusage}MB / {$bwlimit}MB ({$bwpercent})
                                    </strong>    
                                </div>
                            {/if} {if $suspendreason}    
                                <div class="list-group-item" >        {$LANG.suspendreason} : 
                                    <strong class="text-domain">{$suspendreason}
                                    </strong>    
                                </div>
                            {/if}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {foreach $hookOutput as $output}    
            <div>        {$output}    
            </div>
        {/foreach}  
        <script src="{$BASE_PATH_JS}/bootstrap-tabdrop.js"></script>
        <script type="text/javascript">    jQuery('.nav-tabs-overflow').tabdrop();</script> 
    </div>
    <div class="tab-pane fade out" id="tabDownloads">
        <h3>{$LANG.downloadstitle}</h3>
        {include file="$template/includes/alert.tpl" type="info" msg="{lang key="clientAreaProductDownloadsAvailable"}" textcenter=true}
        <div class="row">
            {foreach from=$downloads item=download}
                <div class="col-xs-10 col-xs-offset-1">
                    <h4>{$download.title}</h4>
                    <p>
                        {$download.description}
                    </p>
                    <p>
                        <a href="{$download.link}" class="btn btn-default"><i class="fa fa-download"></i> {$LANG.downloadname}</a>
                    </p>
                </div>
            {/foreach}
        </div>
    </div>
    <div class="tab-pane fade out" id="tabAddons">
        <h3>{$LANG.clientareahostingaddons}</h3>
        {if $addonsavailable}
            {include file="$template/includes/alert.tpl" type="info" msg="{lang key="clientAreaProductAddonsAvailable"}" textcenter=true}
        {/if}
        <div class="row">
            {foreach from=$addons item=addon}
                <div class="col-xs-10 col-xs-offset-1">
                    <h4>{$addon.name}</h4>
                    <p>
                        {$addon.pricing}
                    </p>
                    <p>
                        {$LANG.registered}: {$addon.regdate}
                    </p>
                    <p>
                        {$LANG.clientareahostingnextduedate}: {$addon.nextduedate}
                    </p>
                    <p>
                        <span class="label status-{$addon.rawstatus|strtolower}">{$addon.status}</span>
                    </p>
                </div>
            {/foreach}
        </div>
    </div>
    <div class="tab-pane fade out" id="tabChangepw">
        <h3>{$LANG.serverchangepassword}</h3>
        {if $modulechangepwresult}
            {if $modulechangepwresult == "success"}
                {include file="$template/includes/alert.tpl" type="success" msg=$modulechangepasswordmessage textcenter=true}
            {elseif $modulechangepwresult == "error"}
                {include file="$template/includes/alert.tpl" type="error" msg=$modulechangepasswordmessage|strip_tags textcenter=true}
            {/if}
        {/if}
        <form class="form-horizontal using-password-strength" method="post" action="{$smarty.server.PHP_SELF}?action=productdetails#tabChangepw" role="form">
            <input type="hidden" name="id" value="{$id}" />
            <input type="hidden" name="modulechangepassword" value="true" />
            <div id="newPassword1" class="form-group has-feedback">
                <label for="inputNewPassword1" class="col-sm-5 control-label">{$LANG.newpassword}</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="inputNewPassword1" name="newpw" autocomplete="off" />
                    <span class="form-control-feedback glyphicon"></span>
                    {include file="$template/includes/pwstrength.tpl"}
                </div>
            </div>
            <div id="newPassword2" class="form-group has-feedback">
                <label for="inputNewPassword2" class="col-sm-5 control-label">{$LANG.confirmnewpassword}</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="inputNewPassword2" name="confirmpw" autocomplete="off" />
                    <span class="form-control-feedback glyphicon"></span>
                    <div id="inputNewPassword2Msg">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-6 col-sm-6">
                    <input class="btn btn-primary" type="submit" value="{$LANG.clientareasavechanges}" />
                    <input class="btn" type="reset" value="{$LANG.cancel}" />
                </div>
            </div>
        </form>
    </div>
    <hr> 

    <script>$(document).ready(function () {
            $('.vpndetailsbtn').click(function () {
                $('#myModal').modal('show');
            })
        })</script>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">VPN Service Details</h4>
                </div>
                <div class="modal-body">
                    {foreach from=$extracustomfields key=customfieldname item=customfieldvalue}

                        <div class="list-group-item" >
                            {$customfieldname}

                            <strong class="text-domain">
                                {$customfieldvalue}
                            </strong>                
                        </div>
                    {/foreach}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
    <h3 class="text-center">Connect VPN</h3>
        <div class="col-md-6">
            <div  class="panel panel-default panel-accent-green">
                <div class="panel-heading">
                    <h3 class="panel-title" style="font-size: 20px;">                            
                        <i class="fa fa-info">
                        </i>&nbsp;App Login Details                        
                    </h3>
                </div>
                <div class="list-group">
                    <div class="list-group-item" >App Username : 
                        <strong class="text-domain">{$clientEmail}</strong>                        
                    </div>
                </div>
                <div class="list-group">
                    <div class="list-group-item" >App Password : 
                        <strong class="text-domain">Your Login Password</strong>                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
        
        <button name="downloadapp" class="btn btn_new_here downloadapp" style="position: relative; height: 50px; background-size: contain;"> Download Application  <i class="fa fa-download download_icn_set" aria-hidden="true"></i>
                </button>
               
                <form method="POST">
                    <input type="hidden" name="serviceid" value="{$serviceid}"/>
                    <input type="submit" name="generate_code" class="btn btn_new_here1" style="position: relative; height: 50px; background-size: contain;" value="Generate QR Code"/>
                </form>  
        </div>
                    
    </div> 
    <div class="col-md-12 text-center mapbtn" style=" width: 100%; margin: 20px 0px; position: relative; z-index: 99999;">
        <a href="map.php" style="">View Map <i class="fa fa-map"></i></a></div>
    <hr>
    <style>
    .mapbtn
    {
        background:url('modules/servers/vpnservernoapi/templates/images/map.png'); 
        float: left; 
        padding: 0px;
        border-radius: 5px; 
        overflow: hidden; 
        box-shadow: 0px 0px 10px -4px #000;
    }
    
    .mapbtn a
    {
       transition: 0.5s; width: 100%; padding: 40px; background: rgba(0, 0, 0, 0.5); color:#fff; font-size: 25px; float: left;text-transform: uppercase; text-shadow: 2px 1px 1px #000; text-decoration: none !important;
    }
    .mapbtn a:hover{
        color: #ffac36;
text-shadow: -2px 1px 1px #3e3e3e;
transform: scale(1.05);
transition: 0.5s;
    }
    </style>
    <div class="row new_custom1"> 
        {if $moduleParams['status'] eq 'Active'} 
                <div class="download-popup" style="width: 100%; height: 100%; position: fixed; overflow-y: auto; top: 0px; left: 0px; background: rgba(0, 0, 0, 0.5); display: none; z-index: 99999;">
                <div class="col-md-6 col-md-offset-3" style="margin-top: 100px; background: #fff; padding: 10px;">
                    {if $appdata|@count gt 0}
        
            <h3 class="text-center">Choose Your Platform</h3>

            {foreach key=apptype item=applidata from=$appdata}
                {if {$apptype} == 'android'}
                    <div class="col-md-3" style="padding: 10px; background:#eaeaea; border-radius: 5px; height: 212px; border: solid 3px #fff;"><center><!--img src="https://image.flaticon.com/icons/png/512/174/174836.png" height="100px"--><i class="fa fa-android fa-5x"></i></center>
                        <h3 class="text-center">Android APP</h3>
                        <center style="position: absolute; bottom: 12px; width: 88%;"><a href="{$applidata}" class="btn btn-success" style="font-size: 12px; ">DOWNLOAD NOW</a></center>
                    </div>
                {/if}
                {if {$apptype} == 'ios'}
                    <div class="col-md-3" style="padding: 10px; background:#eaeaea; border-radius: 5px; height: 212px; border: solid 3px #fff;"><center><!--img src="https://toppng.com/uploads/preview/ios-11-app-store-icon-apple-app-store-icon-1156298730556uxorxnhg.png" height="100px"--><i class="fa fa-apple fa-5x"></i></center>
                        <h3 class="text-center">IOS APP</h3>
                        <center style="position: absolute; bottom: 12px; width: 88%;"><a href="{$applidata}" class="btn btn-success" style="font-size: 12px;">DOWNLOAD NOW</a></center>
                    </div>
                {/if}
                {if {$apptype} == 'linux'}
                    <div class="col-md-3" style="padding: 10px; background:#eaeaea; border-radius: 5px; border: solid 3px #fff; height: 212px;"><center><!--img src="http://assets.stickpng.com/thumbs/58480e82cef1014c0b5e4927.png" height="100px"--><i class="fa fa-linux fa-5x"></i></center>
                        <h3 class="text-center">Linux APP</h3>
                        <center style="position: absolute; bottom: 12px; width: 88%;"><a href="{$applidata}" class="btn btn-success" style="font-size: 12px;">DOWNLOAD NOW</a></center>
                    </div>
                {/if}
                {if {$apptype} == 'windows'}
                    <div class="col-md-3" style="padding: 10px; background:#eaeaea; border-radius: 5px; height: 212px; border: solid 3px #fff;"><center><!--img src="https://carlisletheacarlisletheatre.org/images/windows-icon-transparent-1.jpg" height="100px"--><i class="fa fa-windows fa-5x"></i></center>
                        <h3 class="text-center">Windows APP</h3>
                        <center style="position: absolute; bottom: 12px; width: 88%;"><a href="{$applidata}" class="btn btn-success" style="font-size: 12px;">DOWNLOAD NOW</a></center>
                    </div>
                {/if}
                
                {if {$apptype} == 'macos'}
                    <div class="col-md-3" style="padding: 10px; background:#eaeaea; border-radius: 5px; height: 212px; border: solid 3px #fff;"><center><!--img src="https://carlisletheacarlisletheatre.org/images/windows-icon-transparent-1.jpg" height="100px"--><i class="fa fa-desktop fa-5x"></i></center>
                        <h3 class="text-center">MacOS APP</h3>
                        <center style="position: absolute; bottom: 12px; width: 88%;"><a href="{$applidata}" class="btn btn-success" style="font-size: 12px;">DOWNLOAD NOW</a></center>
                    </div>
                {/if}

            {/foreach}
        
    {/if}
                <div class="col-md-12">
                <button class="btn btn-default closeovpnPopup pull-right" type="button">Cancel</button>
                </div>
                </div>
                </div>
            {/if}      
        <div class="col-sm-12"> 
            <div class="row">
                 <h3 class="text-center">Other Options</h3>
                 {if $settings.vpndetails eq 'on'}
                 <div class="col-md-6">
<div  class="panel panel-default panel-accent-green">
                    <div class="panel-heading">
                        <h3 class="panel-title" style="font-size: 20px;">                            
                            <i class="fa fa-info">
                            </i>&nbsp;VPN Login Details                        
                        </h3>
                    </div>

                    <div class="list-group">
                        <div class="list-group-item" >VPN Username:  
                            <strong class="text-domain">{$vpnusername}</strong>                        
                        </div>
                        <div class="list-group-item" >VPN Password:  
                            <strong class="text-domain">{$vpnpassword}</strong>                        
                        </div>
                    </div>

            </div>
                 </div>
                 {/if}
                 {if $settings.downloadcert eq 'on'}
                 <div class="col-md-6">

 <form method="post">
    <input type="hidden" name="customAction" value="downloadcert" />
    <button type="submit" class="btn btn_new_here" style="padding-top: 7px; position: relative; float: left;"> Download Cert. Files  <i class="fa fa-download download_icn_set" aria-hidden="true"></i></button>
  </form>
  <form method="post">
    <input type="hidden" name="customAction" value="socks5details" />
    <button type="submit" class="btn btn_new_here2" style="padding-top: 7px; position: relative; float: left;"> Get Socks Proxy Credentials<i class="fa fa-link proxy_icn_set" aria-hidden="true"></i></button>
  </form>
                </a>
               
                 </div>
                 {/if}
            </div>

        </div>
    </div> 
    {if !empty($qrcode_image)}  
        <div class="modal" id="qrmodel">
            <div class="modal-dialog">
                <div class="modal-content"> 
                    <div class="modal-header">
                        <h4 class="modal-title" style="float: left;text-align: center;">Scan Your QR Code</h4>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div> 
                    <div class="modal-body">
                        <center><div class="qr_image_container">
                                <img src="{$qrcode_image}">
                            </div></center>
                        <p style="font-size: 15px;font-weight: bold;font-family:Arial inherit;text-align:center;">"Use code to login to your APP!!"</p>
                        <script type="text/javascript">
                            $(document).ready(function () {
                                $("#qrmodel").modal();
                                $('html, body').animate({
                                    scrollTop: $('.qr_image_container').offset().top - 20 //#DIV_ID is an example. Use the id of your destination on the page
                                }, 'slow');
                            });
                        </script>
                    </div> 
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div> 
    {/if}
    <hr> 
    
    <p class="alert alert-info text-center" style="font-size: 21px;margin-top: 20px; float: left; width: 100%;">Need a help? <a href="{$systemURL}index.php?rp=/knowledgebase" class="btn btn-info" target="_blank">Knowledgebase</a></p>

</div>
<!--  <div class="row new_custom2">
<p>You are using a free trial product that will expire on "Nov 30,2017"</p>
<button type="button" class="btn_custom1">Buy Subscription
    </button><button type="button" class="btn_custom2">Setup Guide
</button>
</div>  -->







