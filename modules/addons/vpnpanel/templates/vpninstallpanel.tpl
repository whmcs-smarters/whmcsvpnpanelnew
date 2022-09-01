<link href="modules/addons/vpnpanel/templates/css/swiftmodders.css" rel="stylesheet">
<link href="modules/addons/vpnpanel/templates/css/mystyle.css" rel="stylesheet"> 
<link href="modules/addons/vpnpanel/templates/css/bootstrap-social.css" rel="stylesheet">
<script type="text/javascript">
  {literal}  var alreadyReady = false; // The ready function is being called twice on page load.
    jQuery(document).ready(function () {
        {/literal}
        {if $deleted eq 'true'}

        window.location.reload();
        {/if}
 {literal}
      
    });
        
        {/literal}
</script> 
<div class="container"  style="width: 100%;margin-top: 20px;"> 
    {include file='modules/addons/vpnpanel/templates/nav_header.tpl'}
    <div class="sm-content-container">
        <div class="sm-content">
            <div class="sm-page-heading">
                <h1>Install VPN Panel</h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="index.php"> Portal Home
                        </a>        </li>
                    <li class="active">
                        Install VPN Panel
                    </li>
                </ol>
            </div> 
            {if $result!=''}
                <div class="alert alert-{$result} alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {$message}
                </div>
            {/if}
            <div class="col-md-12">

{if $installationStarted neq "true" and $sep_vpn_panel eq '' }

<div class="col-md-12">
    
    <h3 class="text-center">Enter the details to start installation</h3>
    <p class="text-center blinking ">( OS Supported  : Ubuntu 18.04  LTS 64 bit )</p>
    
    <form method="post" action="" id="installform">
        {if $alreadyinstalled neq ''}
<div class="popup" style="width: 100%; float: left; position:fixed; background: rgba(0, 0, 0, 0.5); width: 100%; height: 100%; top: 0px; left: 0px; z-index: 9999;">
<div class="col-md-6 col-md-offset-3" style="background: #fff; margin-top: 100px; padding: 50px; border-radius: 5px;">
<h3 class="text-center">VPN Panel Already Installed.</h3>
<div class="col-md-12">
<div class="form-group">
    <label>Mysql Username*</label>
    <input type="text" class="form-control required" name="mysqluname" required="" placeholder="MySQL Username">
</div>
<div class="form-group">
            <label>Mysql Password*</label>
            <input type="password" class="form-control required" name="mysqlpass" required="" placeholder="MySQL Password">
        </div>

        <div class="form-group">
            <label>Mysql DB Name*</label>
            <input type="text" class="form-control required" name="mysqldb" required="" placeholder="MySQL Database Name">
        </div>
        <div class="col-md-12 text-center">
<button name="upgrade" class="btn btn-success btn-lg">Upgrade</button>
<button type="button" class="btn btn-default btn-lg cancelbtn">Cancel</button>
        </div>
    </div>
</div>
</div>
    {/if}
        <div class="form-group">
            <label>Server IP*</label>
            <input type="text" class="form-control required" name="server_ip" value="{$serverIP}" required="" placeholder="Server IP">
        </div>
        <div class="form-group">
            <label>SSH ROOT Password*</label>
            <input type="password" class="form-control required" name="sshpass" value="{$serverPass}" required="" placeholder="SSH ROOT Password ">
        </div>
        <div class="form-group">
            <label>Server SSH Port*</label>
            
            <input type="text" class="form-control required" name="sshport" value="{if $port eq ''}22{else}{$port}{/if}" required="" placeholder="Server SSH Port ">
        </div>
        <div class="form-group">
            <label>License Key* <font style="font-size: 13px; font-weight: normal;">(Don't have the License key? Buy it from WHMCS-Smarters - <a href="https://whmcssmarters.com/clients/cart.php?a=add&pid=231" target="_blank">Buy Now</a>)<font></label>
            <input type="text" class="form-control required" name="license" required="" placeholder="Product License Key " value="{$license}">
            <span><i>( The license key is provided by WHMCS-Smarters via email after the order completed)</i></span>
        </div>
            <div class="form-group">
            <label>WHMCS License Key* <font style="font-size: 13px; font-weight: normal;">(Don't have the License key? Buy it from WHMCS.com - <a href="https://whmcs.com" target="_blank">Buy Now</a>)<font></label>
            <input type="text" class="form-control required" name="whmcslicense" required="" placeholder="WHMCS License Key " value="{$license}">
            <span><i>( The license key is provided by WHMCS.com)</i></span>
        </div>
        <div class="form-group">
            <label>Installation Path (Optional)</label>
            <div class="input-group" style="width: 100%;">
  <div class="input-group-prepend">
    <span class="input-group-text" style="width:20%;">/var/www/html/</span>
  </div>
  <input type="text" class="form-control" name="install_path" placeholder="Folder Name" value="{$path}" style="float: left; width: 80%;">
  <p class="text-center">OR</p>
  <input type="text" class="form-control" name="custom_install_path" placeholder="Enter Custom Folder Name if not in var/www/html" value="{$custompath}" style="float: left;">
  <input type="hidden" name="start_Installation">
</div>
<span><i>Leave blank to install on web root (/var/www/html/).</i></span>
        </div>
        <div class="form-group">
            <label>Domain Name (Optional)</label>
            <input type="text" class="form-control" name="domain" value="{$domain}" placeholder="Domain">
        </div>
        <center>
        
            <button class="btn btn-success start_Installation btn-block" name="installvpnpanel" type="submit">Proceed</button></center>
        
    </form>
    
    <a href="https://www.whmcssmarters.com/clients/index.php?rp=/knowledgebase/143/System-Requirements-for-VPN-Panel-and-VPN-Servers.html" class="serverrequirement btn-block" target="_blank">System Requirements</a>
    <a href="https://whmcssmarters.com/clients/index.php?rp=/knowledgebase/169/How-to-install-separated-VPN-Panel---Reseller-Program-Integration.html" class="link" target="_blank">How to install separated VPN Panel?</a>
    </div>
    {/if}
    {if $sep_vpn_panel neq ""}
    
    <div class="col-md-6 col-md-offset-3" style="background: #e4fcff; padding: 10px;">
        <h3 class="text-center">Panel Details</h3>
        <table class="table table-bordered">
            <tr><td>Domain</td><td><a href="{$domain}/admin">{$domain}/admin</a></td></tr>
            <tr><td>Username</td><td>{$username}</td></tr>
            <tr><td>Password</td><td>{$password}</td></tr>
        </table>
        <form method="post" action="">
            <button class="btn btn-danger" name="reinstallpanel">Re-Install Panel</button>
        </form>
    </div>

    {/if}
    {if $installationStarted eq "true" }
    
    <div class="col-md-6 col-md-offset-3" style="background: #e4fcff; padding: 10px;">
        <h3 class="text-center">Panel Details</h3>
        <table class="table table-bordered">
            <tr><td>Domain</td><td><a href="{$domain}/admin">{$domain}/admin</a></td></tr>
            <tr><td>Username</td><td>{$username}</td></tr>
            <tr><td>Password</td><td>{$password}</td></tr>
        </table>
        <form method="post" action="">
            <button class="btn btn-danger" name="reinstallpanel">Re-Install Panel</button>
        </form>
    </div>

    {/if}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js" integrity="sha256-ZvMf9li0M5GGriGUEKn1g6lLwnj5u+ENqCbLM5ItjQ0=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css" integrity="sha256-Z8TW+REiUm9zSQMGZH4bfZi52VJgMqETCbPFlGRB1P8=" crossorigin="anonymous">
    <script>
        $(document).ready(function(){
            $('.cancelbtn').click(function(){
            $('.popup').hide();
            })
            $('.start_Installation').click(function(event){

            event.preventDefault();
                var error = 0;
                $('#installform input').each(function(){
                    if($(this).hasClass('required'))
                    {
                    if($(this).val().length == 0)
                    {
                        error++;
                        $(this).css('border','solid 1px red');
                    }
                    else
                    {
                        $(this).css('border','1px solid #ccc');
                    }
                    }
                    
                })
                
                if(error > 0)
                {
                    return;
                }
                swal({
  title: "Are you sure?",
  text: "Do you want to install Smart VPN Panel.",
  type: "warning",
  showCancelButton: true,
  confirmButtonClass: "btn-success",
  confirmButtonText: "Yes, Install it!",
  closeOnConfirm: false
},
function(){
  $('#installform').submit();
}
);
            })
        })
    </script>
    <style>
    .blinking{
    animation:blinkingText 1s infinite;
}
@keyframes blinkingText{
    0%{     color: #f00;    }
    50%{    color: transparent; }
    100%{   color: #f00;    }
}

    .start_Installation
    {
    padding: 15px;
    margin-bottom: 10px;
    }
    .serverrequirement
    {
    text-decoration: underline;
    text-align: center;
    width: 100%;
    }
.main-content
{
    background: #0e507724;
padding: 20px;
}

    .form-control
    {
    height: 50px;
    }

    label
    {
    font-size: 17px;
    }

    .form-group span
    {
        color: #6c6c6c;
    }

        .input-group-text {
        height: 50px;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    padding: .375rem .75rem;
    margin-bottom: 0;
    font-size: 16px;
    font-weight: 400;
    line-height: 1.5;
    color: #495057 !important;
text-align: center;
white-space: nowrap;
background-color:
#e9ecef;
border: 1px solid
    #ced4da;
    border-radius: .25rem;
        border-top-right-radius: 0.25rem;
        border-bottom-right-radius: 0.25rem;
        float: left;
}
    </style>
            

<div style="position:absolute;top:0px;right:0px;padding:5px;background-color:#000066;font-family:Tahoma;font-size:11px;color:#ffffff" class="adminreturndiv">Logged in as Administrator | <a href="smartersadmin8333/clientssummary.php?userid=146&amp;return=1" style="color:#6699ff">Return to Admin Area</a></div>

    
                
            </div>
            
                    </div> 
                </div>   
                                