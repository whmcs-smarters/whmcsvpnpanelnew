<link href="modules/addons/vpnpanel/templates/css/radio.css" rel="stylesheet">   
<link href="modules/addons/vpnpanel/templates/css/swiftmodders.css" rel="stylesheet">
<link href="modules/addons/vpnpanel/templates/css/mystyle.css" rel="stylesheet"> 
<link href="modules/addons/vpnpanel/templates/css/bootstrap-duallistbox.css" rel="stylesheet"> 
<script src="modules/addons/vpnpanel/templates/js/jquery.bootstrap-duallistbox.js"></script>

<script type="text/javascript" src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
<script type="text/javascript" src="modules/addons/vpnpanel/templates/js/jquery.tablednd.js"></script>
<script src="modules/addons/vpnpanel/assets/js/tinymce/tinymce.min.js"></script>
<script>tinymce.init({ height: "500",width: "100%",selector:'textarea' });</script>

<script>

    $(function () {
        var products = $('select[name="products[]"]').bootstrapDualListbox();
        var gateways = $('select[name="gateways[]"]').bootstrapDualListbox();
    })
     $(document).ready(function() {
        $(".clickBtnIS").click(function(ev){
            ev.preventDefault();
            var TextEnter = "&#123;$"+$(this).data('gettext')+"&#125;";
            
            tinymce.activeEditor.execCommand('mceInsertContent', false, TextEnter);
        });
        // Initialise the first table (as before)
        $("#table-1").tableDnD();
        // Make a nice striped effect on the table
        table_2 = $("#table-2");
        table_2.find("tr:even").addClass("alt");
        // Initialise the second table specifying a dragClass and an onDrop function that will display an alert
        table_2.tableDnD({
            onDragClass: "myDragClass",
            onDrop: function(table, row) {
                var rows = table.tBodies[0].rows;
                var debugStr = "Row dropped was "+row.id+". New order: ";
                for (var i=0; i<rows.length; i++) {
                    debugStr += rows[i].id+" ";
                }
                $(table).parent().find('.result').text(debugStr);
            },
            onDragStart: function(table, row) {
                $(table).parent().find('.result').text("Started dragging row "+row.id);
            }
        });
        $(document).find('.box1 .info-container').append('<p style="float: right; margin-right: 30%;">Assigned Products by Admin</p>');
        $(document).find('.box2 .info-container').append('<p style="float: right; margin-right: 30%;">Products to show on Shopping Cart</p>');
    });
</script>

<style type="text/css">
    table#table-1 {
        border: 1px solid #ebf2f9;
        width: 100%;
        background-color: #ebf2f9;
    }
    #table-1 tr td {
        padding: 15px;
        border: 1px solid;
        font-size: 14px;
    }
    .ManualTable td {
        font-size: 12px;
    }
</style>
<!-- Register -->
<div class="container" style="width: 100%;margin-top: 20px;"> 
    {include file='modules/addons/vpnpanel/templates/nav_header.tpl'}
    <div class="sm-content-container">
        <div class="sm-content"> 
            {if $result!=''}
                <div class="alert alert-{$result} alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {$message}
                </div>
            {/if}

{if isset($smarty.get.err) && $smarty.get.err eq 'stripeActive'}
                <div class="alert alert-danger alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Authorize.net and Stripe Gateway both cannot be active at same time.
                </div>
                {elseif isset($smarty.get.err) && $smarty.get.err eq 'authorizeActive'}
                <div class="alert alert-danger alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Authorize.net and Stripe Gateway both cannot be active at same time.
            </div>
                {/if}
            <div class="sm-page-heading">
                <h1>
                    <i class="fa fa-globe"></i>&nbsp;My Shoping Cart
                </h1>
            </div>
            <div class="panel-body">
                {if $imgmsg neq ''}
                    <p class='alert alert-info'>{$imgmsg}</p>
                {/if}

                <div id="exTab2" class="container" style="width: 100%;">	
                    <ul class="nav nav-tabs">
                        <li {if $styleTab eq 'active'}class="active"{elseif $styleTab neq 'active' AND $productsTab neq 'active' AND $sortprodctTab neq 'active' AND $EmailSettingSectionTab neq 'active'  AND $gatewayTab neq 'active' }class="active"{/if}><a href="#1" data-toggle="tab">General</a>
                        </li>
                        <li {if $productsTab eq 'active'}class="active"{/if}>
                            <a  href="#2" data-toggle="tab">Products</a>
                        </li>
                        <li {if $sortprodctTab eq 'active'}class="active"{/if}>
                            <a  href="#6" data-toggle="tab">Sorting Products</a>
                        </li>
                        <li><a href="#3" data-toggle="tab">Payment gateways</a>
                        </li>
                        <li {if $gatewayTab eq 'active'}class="active"{/if}><a href="#4" data-toggle="tab">Manage Existing gateways</a>
                        </li>
                        <li {if $EmailSettingSectionTab eq 'active'}class="active"{/if}><a href="#8" data-toggle="tab">Email Settings</a>
                        </li>
                        <!-- <li {if $domain eq 'active'}class="active"{/if}><a href="#5" data-toggle="tab">Setup Domain</a>
                        </li> -->

                    </ul>

                    <div class="tab-content ">
                        <div class="tab-pane {if $styleTab eq 'active'}active{elseif $styleTab neq 'active' AND $productsTab neq 'active' AND $sortprodctTab neq 'active' AND $EmailSettingSectionTab neq 'active' AND $gatewayTab neq 'active' }active{/if}" id="1">

                            <div class="row" style="margin: 0px;">
                                <div class="col-md-12">

                                    <h3>General Settings </h3>

                                    <div class="col-md-12 text-center">
                                        <div class="col-md-12">

                                            <form method="post" action="" enctype="multipart/form-data">
                                                <table class="table table-responsive table-bordered table-striped">
                                                    <tr><th style="text-align: center; vertical-align: middle;">Logo</th><td>{if $clientData.0->logo neq ''}
                                                            <div class="holder" style="width: auto; height: auto; float: left; margin-top: 30px;">
                                                                <img src="{if $clientData.0->logo neq ''}{$systemsslurl}{$clientData.0->logo}{/if}" id="logoView" style="border: solid 1px #ccc; width:auto; max-width: 200px; height: auto;" >
                                                                <form method="post" style="width: auto;position: relative; float: right; right: 7px; top: -10px;">
                                                                    <button type="submit" class="btn btn-danger btn-xs" name="rmImage"><i class="fa fa-times"></i></button>
                                                                </form>
                                                            </div>
                                                            {else}
                                                                <script>
                                                                    $(function () {

                                                                        document.getElementById("logoupload").onchange = function () {
                                                                            var reader = new FileReader();

                                                                            reader.onload = function (e) {
                                                                                // get loaded data and render thumbnail.
                                                                                document.getElementById("logoView").src = e.target.result;
                                                                            };

                                                                            // read the image file as a data URL.
                                                                            reader.readAsDataURL(this.files[0]);
                                                                        }
                                                                    })</script>

                                                                <form method="post" action="" enctype="multipart/form-data">
                                                                    <div class="form-group">
                                                                        <input type="file" name="logo" id="logoupload" accept="image/*">
                                                                        <br/>
                                                                        <img src="" id="logoView" style="border: solid 1px #ccc; width:auto; max-width: 200px; height: auto;" >
                                                                    </div>

                                                                    <input type="submit" class="btn btn-success" name="uploadImage" value="Upload" >
                                                                    {/if}

                                                                    </form></td></tr>

                                                            <tr>
                                                            <form method="post">
                                                                <th style="text-align: center; vertical-align: middle;">Company Name</th><td><input type="text" name="title"{if $clientData.0->companyName neq ''}value="{$clientData.0->companyName}"{/if}></td>
                                                                </tr>

                                                                <tr>
                                                                    <th style="text-align: center; vertical-align: middle;">Tagline</th><td><input type="text" name="tagline"{if $clientData.0->tagline neq ''}value="{$clientData.0->tagline}"{/if}></td>
                                                                </tr>

                                                                <tr>
                                                                    <th style="text-align: center; vertical-align: middle;">Primary Color</th><td><input type="color" name="headingColor"{if $clientData.0->headColor neq ''}value="{$clientData.0->headColor}"{else}value="#0e5077"{/if}></td>
                                                                </tr>

                                                                <tr>
                                                                    <th style="text-align: center; vertical-align: middle;">Secondary Color</th><td><input type="color" name="headingTextColor"{if $clientData.0->textColor neq ''}value="{$clientData.0->textColor}"{else}value="#ffffff"{/if}></td>
                                                                </tr>
                                                                <tr>
                                                                    <th style="text-align: center; vertical-align: middle;">Main Domain URL</th><td><input type="url" name="domainURL"{if $clientData.0->domainURL neq ''}value="{$clientData.0->domainURL}"{/if}></td>
                                                                </tr>
                                                                <tr>
                                                                    <th style="text-align: center; vertical-align: middle;">Term & Services URL</th><td><input type="url" name="tandc"{if $clientData.0->tandc neq ''}value="{$clientData.0->tandc}"{/if}></td>
                                                                </tr>
                                                                <tr>
                                                                    <th style="text-align: center; vertical-align: middle;">Privacy Policy URL</th><td><input type="url" name="privacy"{if $clientData.0->privacy neq ''}value="{$clientData.0->privacy}"{/if}></td>
                                                                </tr>

                                                                <tr>
                                                                    <th style="text-align: center; vertical-align: middle;">My Website URL</th><td>{if $clientData.0->websiteURL neq ''}<a href="{$clientData.0->websiteURL}" target="_blank">{$clientData.0->websiteURL}</a>{/if}</td>
                                                                </tr>

                                                        </table>
                                                        <button type="submit" name="saveStyle" class="btn btn-primary">Save</button>
                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane {if $productsTab eq 'active'}active{/if}" id="2">
                                    <div class="row" style="margin: 0px;">
                                        <div class="col-md-12">
                                            <h3>Select Products</h3>
                                            <form method="post">
                                                <select multiple="multiple" size="10" name="products[]">
                                                    {foreach from=$products item=product}   
                                                        <option value="{$product->id}"{if $product->id|in_array:$selectedProducts}selected{/if}>{$product->name}</option> 
                                                    {/foreach}
                                                </select>
                                                <p class="text-center" style="margin-top: 20px;"><button class="btn btn-primary" name="addProducts">Save Changes</button></p>
                                            </form>


                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane" id="3">
                                    <div class="row" style="margin: 0px;">
                                        <div class="col-md-12">
                                            <h3>Select Payment Gateways</h3>

                                            <div class="col-md-4 text-center">
                                                <form method="post" action="index.php?m=vpnpanel&action=vpnmywebsite">

                                                    <input type="hidden" name="gateway" value="paypal">
                                                    <button type="submit" name="addGateways" class="btn col-md-12 {if 'paypal'|in_array:$selectedGateways}btn-success disabled{else}btn-default{/if}" {if 'paypal'|in_array:$selectedGateways} disabled{/if} value="paypal">Paypal</button>
                                                </form>
                                            </div>

                                            <div class="col-md-4 text-center hide">
                                                <form method="post" action="index.php?m=vpnpanel&action=vpnmywebsite">
                                                    <input type="hidden" name="gateway" value="stripe">
                                                    <input type="hidden" name="_capture" value="on">
                                                    <button type="submit" name="addGateways" class="btn col-md-12 {if 'stripe'|in_array:$selectedGateways}btn-success disabled{else}btn-default{/if}" {if 'stripe'|in_array:$selectedGateways} disabled{/if} value="stripe">Stripe</button>
                                                </form>
                                            </div>


                                            <div class="col-md-4 text-center hide">
                                                <form method="post" action="index.php?m=vpnpanel&action=vpnmywebsite">
                                                    <input type="hidden" name="gateway" value="authorize">
                                                    <input type="hidden" name="_capture" value="on">
                                                    <button type="submit" name="addGateways" class="btn col-md-12 {if 'authorize'|in_array:$selectedGateways}btn-success disabled{else}btn-default{/if}" {if 'authorize'|in_array:$selectedGateways} disabled{/if} value="authorize">Authorize.net</button>
                                                </form>
                                            </div>

 <!--<input type="hidden" name="gateway" value="{$gateway.module}">
    <button type="submit" name="addGateways" class="btn col-md-12 {if $gateway.module|in_array:$selectedGateways}btn-success disabled{else}btn-default{/if}" {if $gateway.module|in_array:$selectedGateways} disabled{/if}value="{$gateway.displayname}">{$gateway.displayname}</button>
                                            {assign var=count value=$count+1}
                                           </form>
                                           </div>
                                            <!--{assign var=count value=0}
                                            {foreach from=$gateways item=$gateway}
                                           
                                             <div class="col-md-4 text-center">
                                            <form method="post">
                                                
                                                <input type="hidden" name="gateway" value="paypal">
                                               <button type="submit" name="addGateways" class="btn col-md-12 {if 'paypal'|in_array:$selectedGateways}btn-success disabled{else}btn-default{/if}" {if 'paypal'|in_array:$selectedGateways} disabled{/if}value="paypal">Paypal</button>
                                               
                                               <input type="hidden" name="gateway" value="paypal">
                                               <button type="submit" name="addGateways" class="btn col-md-12 {if 'stripe'|in_array:$selectedGateways}btn-success disabled{else}btn-default{/if}" {if 'stripe'|in_array:$selectedGateways} disabled{/if}value="stripe">Stripe</button>
                                           
                                           <input type="hidden" name="gateway" value="{$gateway.module}">
                                               <button type="submit" name="addGateways" class="btn col-md-12 {if $gateway.module|in_array:$selectedGateways}btn-success disabled{else}btn-default{/if}" {if $gateway.module|in_array:$selectedGateways} disabled{/if}value="{$gateway.displayname}">{$gateway.displayname}</button>
                                                {assign var=count value=$count+1}
                                               </form>
                                               </div>
                                            {/foreach}
                                  </select>-->
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane {if $gatewayTab eq 'active'}active{/if}" id="4">
                                    <div class="row" style="margin: 0px;">
                                        <div class="col-md-12">
                                            <h3>Manage Existing Gateways</h3>
                                            {$paymentDetails}

                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane {if $domain eq 'active'}active{/if}" id="5">
                                    <div class="row" style="margin: 0px;">
                                        <div class="col-md-12">

                                            <h3>Setup Your Domain - <font style="font-size: 15px;">Your Current Domain is {$clientData.0->websiteURL}</font></h3>
                                                {if $verifyData eq ''}
                                                <!--<form method="post">
                                                    <button type="submit" class="btn btn-lg btn-primary" name="create">Create TXT Code</button>
                                                </form>-->
                                                <form method="post">
                                                    <h3>Enter Your Domain and Verify</h3>
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-md-offset-1">

                                                            <input type="text" class="form-control" name="domain" placeholder="(xyz.com)" style="margin-top: 0px;">

                                                        </div>
                                                        <div class="col-md-4">
                                                            <button type="submit" class="btn btn-success form-control" name="check">Verify</button>
                                                        </div>
                                                    </div>



                                                </form>
                                            {else}
                                                <div class="col-md-12 text-center">
                                                    {if $verifyerror neq ''}<p class="alert alert-danger">{$verifyerror}</p>{/if}

                                                    {if $verifyData.0->status eq '0'}
                                                        <!--<div class="col-md-10 col-md-offset-1 verifyCode">
                                                            <h4>Verification Code</h4>
                                                            <h3><strong>{$verifyData.0->verifyCode}</strong></h3>
                                                            <span>Enter the Above Verification Code to Your Domain TXT</span>
                                                        </div>-->
                                                        <form method="post">
                                                            <h3>Enter Your Domain and Verify</h3>
                                                            <div class="form-group">
                                                                <div class="col-md-6 col-md-offset-1">

                                                                    <input type="text" class="form-control" name="domain" placeholder="(xyz.com)" style="margin-top: 0px;">

                                                                </div>
                                                                <div class="col-md-4">
                                                                    <button type="submit" class="btn btn-success form-control" name="check">Verify</button>
                                                                </div>
                                                            </div>



                                                        </form>
                                                    {else}
                                                        <p class="alert alert-success">Congrats! Your Domain "{$clientData.0->websiteURL}" is Verified Successfully.</p>
                                                    {/if}

                                                </div>

                                            {/if}
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane {if $sortprodctTab eq 'active'}active{/if}" id="6">
                                    <div class="row" style="margin: 0px;">
                                        <div class="col-md-12">
                                            <h3>Sort Products</h3>
                                            {if $SortedProductsIds neq ''} 
                                            {if $sortprodctTab eq 'active'}
                                                <div class="alert alert-success alert-dismissible">
                                                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                  <strong>Success!</strong> Changes saved successfully.
                                                </div>
                                            {/if}
                                            <form method="post">
                                                <table id="table-1" cellspacing="0" cellpadding="2">
                                                    {foreach from=$SortedProductsIds key=Id item=Name} 
                                                            <tr>
                                                                <td>
                                                                    <input type="hidden" name="sortproducts[]" value="{$Id}">{$Name}    ({$Id})
                                                                </td>
                                                            </tr>
                                                    {/foreach}
                                                </table>
                                                <p class="text-center" style="margin-top: 20px;"><button class="btn btn-primary" name="SortProducts">Save Changes</button></p>
                                            </form>
                                            {else}
                                            <h4 class="text-center">No product selected</h4>
                                            {/if}
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane {if $EmailSettingSectionTab eq 'active'}active{/if}" id="8">
                                    <div class="row" style="margin: 0px;">
                                        <div class="col-md-12">
                                            <h3>VPN Email Setting</h3>
                                            {if $EmailActionResponse eq 'success'}
                                                <div class="alert alert-success alert-dismissible">
                                                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                  <strong>Success!</strong> Changes saved successfully.
                                                </div>
                                            {/if}
                                            {if $EmailActionResponse eq 'error'}
                                                <div class="alert alert-danger alert-dismissible">
                                                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                  <strong>Error!</strong> Unable to save changes.
                                                </div>
                                            {/if}
                                            <form method="post">
                                                <textarea rows="20" cols="120" name="resellerEmail">
                                                    {$EmailData}
                                                </textarea>
                                                <p class="text-center" style="margin-top: 20px;">
                                                    <button class="btn btn-primary" name="SaveEmailTemplate">Save Changes</button>
                                                </p>
                                                <div id="mergefields" style="border:1px solid #8FBCE9;background:#ffffff;color:#000000;padding:5px;height:300px;overflow:auto;font-size:10px;z-index:10;">
                                                   <table width="100%" cellspacing="0" cellpadding="0" class="ManualTable">
                                                      <tbody>
                                                         <tr>
                                                            <td width="50%" valign="top">
                                                               <b>Product/Service Related</b><br>
                                                               <table>
                                                                  <tbody>
                                                                     <tr>
                                                                        <td><a href="#" class="clickBtnIS" data-gettext="service_id">ID</a></td>
                                                                        <td>&#123;$service_id&#125;</td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td><a href="#" class="clickBtnIS" data-gettext="service_reg_date">Signup Date</a></td>
                                                                        <td>&#123;$service_reg_date&#125;</td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td><a href="#" class="clickBtnIS" data-gettext="service_product_name">Product Name</a></td>
                                                                        <td>&#123;$service_product_name&#125;</td>
                                                                     </tr>
                                                                     
                                                                     
                                                                     <tr>
                                                                        <td><a href="#" class="clickBtnIS" data-gettext="service_server_hostname">Server Hostname</a></td>
                                                                        <td>&#123;$service_server_hostname&#125;</td>
                                                                     </tr>
                                                                     
                                                                     
                                                                     <tr>
                                                                        <td><a href="#" class="clickBtnIS" data-gettext="service_payment_method">Payment Method</a></td>
                                                                        <td>&#123;$service_payment_method&#125;</td>
                                                                     </tr>
                                                                     
                                                                     <tr>
                                                                        <td nowrap=""><a href="#" class="clickBtnIS" data-gettext="service_recurring_amount">Recurring Payment</a></td>
                                                                        <td>&#123;$service_recurring_amount&#125;</td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td><a href="#" class="clickBtnIS" data-gettext="service_billing_cycle">Billing Cycle</a></td>
                                                                        <td>&#123;$service_billing_cycle&#125;</td>
                                                                     </tr>
                                                                     
                                                                     <tr>
                                                                        <td><a href="#" class="clickBtnIS" data-gettext="service_username">Username</a></td>
                                                                        <td>&#123;$service_username&#125;</td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td><a href="#" class="clickBtnIS" data-gettext="service_password">Password</a></td>
                                                                        <td>&#123;$service_password&#125;</td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td><a href="#" class="clickBtnIS" data-gettext="androidapplinks">Android App Link</a></td>
                                                                        <td>&#123;$androidapplinks&#125;</td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td><a href="#" class="clickBtnIS" data-gettext="windowapplinks">Windows App Link</a></td>
                                                                        <td>&#123;$windowapplinks&#125;</td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td><a href="#" class="clickBtnIS" data-gettext="iosapplinks">iOS App Link</a></td>
                                                                        <td>&#123;$iosapplinks&#125;</td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td><a href="#" class="clickBtnIS" data-gettext="linuxapplinks">Linux App Link</a></td>
                                                                        <td>&#123;$linuxapplinks&#125;</td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td><a href="#" class="clickBtnIS" data-gettext="macosapplinks">MacOS App Link</a></td>
                                                                        <td>&#123;$macosapplinks&#125;</td>
                                                                     </tr>
                                                                  </tbody>
                                                               </table>
                                                               <br>
                                                               <b>Client Related</b><br>
                                                               <table>
                                                                  <tbody>
                                                                     
                                                                     <tr>
                                                                        <td><a href="#" class="clickBtnIS" data-gettext="client_name">Client Name</a></td>
                                                                        <td>&#123;$client_name&#125;</td>
                                                                     </tr>
                                                                     
                                                                  </tbody>
                                                               </table>
                                                               <br>
                                                               <b>Other</b><br>
                                                               <table>
                                                                  <tbody>
                                                                     
                                                                     <tr>
                                                                        <td><a href="#" class="clickBtnIS" data-gettext="signature">Signature</a></td>
                                                                        <td>&#123;$signature&#125;</td>
                                                                     </tr>
                                                                     
                                                                  </tbody>
                                                               </table>
                                                               <br>
                                                            </td>
                                                            <td width="50%" valign="top">
                                                               <b>Conditional Display</b><br>
                                                               You can use conditionals to display text based on other values - for example:<br><br>
                                                               {if $ticket_department eq "Sales"}<br>
                                                               Sales only operates Monday-Friday 9am-5pm<br>
                                                               {else}<br>
                                                               Your ticket has been received and will be answered shortly<br>
                                                               {/if}<br><br>
                                                               <b>Looping through data</b><br>
                                                               A foreach loop can be used to cycle through values like invoice items:<br><br>
                                                               {foreach from=$array_data item=data}<br>
                                                               {$data.option}: {$data.value}<br>
                                                               {/foreach}
                                                            </td>
                                                         </tr>
                                                      </tbody>
                                                   </table>
                                                </div>
                                            </form>   
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div> 