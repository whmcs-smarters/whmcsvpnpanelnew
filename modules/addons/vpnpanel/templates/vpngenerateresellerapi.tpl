<script src="modules/addons/vpnpanel/templates/js/sample.js"></script>
<style>
    ::-moz-placeholder {
        color: #555 !important;
    }
</style>

<!-- Register -->   
<div class="container" style="width: 100%;margin-top: 40px;"> 
    {include file='modules/addons/vpnpanel/templates/nav_header.tpl'}

    <div class="sm-content-container">
        <div class="sm-content">
            <div class="sm-page-heading">
                <h1>{$pagetitle}</h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="index.php"> Portal Home
                        </a></li>
                    <li class="active">
                        Dashboard
                    </li>
                </ol>
            </div> 
            {if $result!=''}
                <div class="alert alert-{$result} alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {$message}
                </div>
            {/if}

            <h2>Reseller's API Credentials</h2>
<h5>These API Keys are useed to communicate with Separated Reseller VPN Panel</h5>
<p class="alert alert-info"><strong>Note</strong> : if you generate new API Key, then your old one will no longer be working. </p>
{if $apikey eq ''}
<center><button type="button" class="btn btn-success generateapi generatebtn" name="generateapi">Generate New API Credentials <i class="loading fa fa-spinner fa-spin"></i></button></center>
{else}
<form method="post" id="" name="">
								<input type="hidden" id="submitted" name="submitted" value="Delete Atom">
								<table id="banlist" class="table table-striped table-bordered" cellspacing="0" style="width: 50%; margin:auto;">
									<thead>
									    <tr>
											<td width="200">API Key</td><td>{$apikey}</td></tr>
                      <tr><td>API Password</td><td>{$apipassword}</td>
										</tr>
										<tr><td class="text-center" colspan="2"><button type="button" class="btn btn-success generateapi generatebtn" name="generateapi">Generate New API Credentials <i class="loading fa fa-spinner fa-spin"></i></button> <button class="btn btn-danger deleteapi" type="button"><i class="fa fa-trash"></i> <i class="loading fa fa-spinner fa-spin"></i></button></td></tr>
									</thead>
									<tbody class="text-center">
									</tbody>
								</table>
							</form>

<hr / style="float: left; width: 100%;">
<h3 class="text-center" style="margin-top: 20px;">IP Address Whitelisting</h3>
<table id="banlist" class="table table-striped table-bordered" cellspacing="0" style="width: 50%; margin:auto; margin-top: 30px; margin-bottom: 30px;">
  <tr><td>IP Address Allowed:</td><td><input type="text" name="alloweips" class="allowedips" value="{$allowedips}"></td></tr>
  <tr><td colspan="2"><center><button class="btn btn-success addips" type="button">Save <i class="loading fa fa-spinner fa-spin"></i></button></center></td></tr>
</table>
{/if}


{literal}
<style>
.error
{
    border-color: #f00;
    box-shadow: 0px 0px 5px -2px;
}
.activeinput
{
   
}

.loading
{
  display: none;
}
</style>

<script>

$('document').ready(function()
{
  var currentapikey =  $('input.apikeyinput').val();
  var apicodetext = $('.apicode').text();   
   
  function makeid(length) {
   var result           = '';
   var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
   var charactersLength = characters.length;
   for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }
   return result;
}
    
    $('.generateapi').click(function(){
      $(this).children('.loading').show();
       var postdata = {generate:'true'};
        $.ajax({
        dataType: "text",
        type: 'POST',
        data: postdata,
		cache: false,
        success: function(data)
        {
            if(data)
            {
              window.location.reload();
            }
            else
            {
                alert('Error! Failed To Generate New API Credentials.');
                window.location.reload();
            }
	    }
    });
    
    
});


$('.addips').click(function(){
var allowedips = $('.allowedips').val();
if($('.allowedips').val().length == 0)
{
  $('.allowedips').css('border', 'solid 1px red');
  $('.allowedips').after('<span style="color: red;">Field can not be Empty.</span>');

  return;
}
$(this).children('.loading').show();

       var postdata = {addip:'true', 'allowedips':allowedips};
        $.ajax({
        dataType: "text",
        type: 'POST',
        data: postdata,
    cache: false,
        success: function(data)
        {
            if(data)
            {
            //$('#success').html(data);
              window.location.reload();
            }
            else
            {
                alert('Error! Failed To Add IP.');
            }
      }
    });
    
    
});


$('.deleteapi').click(function(){
  $(this).children('.loading').show();
       var postdata = {delete:'true'};
        $.ajax({
        dataType: "text",
        type: 'POST',
        data: postdata,
    cache: false,
        success: function(data)
        {
            if(data)
            {
            //$('#success').html(data);
              window.location.reload();
            }
            else
            {
                alert('Error! Failed To delete.');
            }
      }
    });
    
    
});


  })
</script>
{/literal}