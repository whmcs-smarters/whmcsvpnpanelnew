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
            <form method="POST" autocomplete="off" class="form_custom" id="form-add-user">
               <div style="width:100%;" class="">
                                                        <div class="heading-bar">
                                                            <img src="modules/addons/vpnpanel/templates/images/hosting-icon.png" alt="img"><h3>User Details <font style="font-size:10px;">(This below Email and Password is used to login into VPN App)</font></h3>
                                                        </div>
                                                        <div class="panel-body">
                                                            
                <div class="form-group col-md-6"><input class="form-control" placeholder="Email (Required)" type="text" name="login" id="login" value="" required></div>
                <div class="form-group col-md-6"><input class="form-control"  placeholder="Password (Leave Blank to generate automatically.)" type="password" name="password" id="password" value=""></div>
                {if $settings.showName neq ''}<div class="form-group col-md-6"><input class="form-control" type="text" placeholder="Name" name="clientname" id="clientname" value="">
                                </div>  {/if}
                {if $settings.showCompany neq ''}<div class="form-group col-md-6"><input class="form-control" placeholder="{$LANG.clientareacompanyname}" type="text" name="companyname" id="companyname" value="">
                                    </div> {/if}
                
                {if $settings.showPhone neq ''} <div class="form-group col-md-6"><input class="form-control" placeholder="{$LANG.clientareaphonenumber}" type="tel" name="phonenumber" id="phonenumber" value="">
                                                            </div>
                                                        {/if}
                {if $settings.showAddress neq ''}<div class="form-group col-md-6"><input class="form-control" type="text"  placeholder="{$LANG.clientareaaddress1}" name="address1" id="address1" value="">
                                        </div>{/if}
                <!--{if $userinfo eq 'yes'}
                    <div style="width:48%" class="col-lg-6 panel panel-default custom-user-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-user"></i>&nbsp;               {$selectuser} Info
                            </h3>
                        </div> 
                        <div class="panel-body">
                {if $optionactive.login neq ''}<div class="form-group"><input class="form-control" placeholder="Email / Login" type="text" name="login" id="login" {if isset($optionactive.login)}required{/if} value="">
                        <span> (Required for Billing Portal) </span>
                    </div>{/if}
                    {if $optionactive.password neq ''}<div class="form-group"><input class="form-control"  placeholder="Password" type="password" name="password" id="password" {if isset($optionactive.password)}required{/if} value="">
                        </div> {/if}
                        {if $optionactive.confirmpassword neq ''}<div class="form-group"><input class="form-control" onfocusout="Confirm(this.value);" placeholder="Confirm Password" {if isset($optionactive.confirmpassword)}required{/if} type="password" name="confirmpassword" id="confirmpassword" value="">
                            </div> {/if}
                            <!-- Firstname --
                            {if $optionactive.clientname neq ''}<div class="form-group"><input class="form-control" type="text" placeholder="Name" name="clientname" id="clientname" value="" {if isset($optionactive.clientname)}required{/if}>
                                </div>  {/if}
                                <!-- companyname --
                                
                                    <!-- address1 --
                                    {if $optionactive.address1 neq ''}<div class="form-group"><input class="form-control" type="text"  placeholder="{$LANG.clientareaaddress1}" name="address1" id="address1" value="" {if isset($optionactive.address1)}required{/if}>
                                        </div>{/if}
                                        <!-- address2 --
                                        {if $optionactive.address2 neq ''}<div class="form-group"><input class="form-control" type="text"   placeholder="{$LANG.clientareaaddress2}" name="address2" id="address2" value="">
                                            </div>{/if}
                                            <!-- city --
                                            {if $optionactive.city neq ''}<div class="form-group"><input class="form-control" type="text"  placeholder="{$LANG.clientareacity}" name="city" id="city" value="" {if isset($optionactive.city)}required{/if}>
                                                </div>{/if}
                                                <!-- State --
                                                {if $optionactive.state neq ''}<div class="form-group">
                                                        <input class="form-control" placeholder="State" type="text" name="state" id="state" value="" {if isset($optionactive.state)}required{/if}>
                                                    </div> {/if}

                                                    <!-- Post Code --
                                                    {if $optionactive.postcode neq ''}<div class="form-group"><input class="form-control" type="text"  placeholder="{$LANG.clientareapostcode}" name="postcode" id="postcode" value="" {if isset($optionactive.postcode)}required{/if}>
                                                        </div>{/if}
                                                        <!-- phone --
                                                        {if $optionactive.phonenumber neq ''} <div class="form-group"><input class="form-control" placeholder="{$LANG.clientareaphonenumber}" type="tel" name="phonenumber" id="phonenumber" value="" {if isset($optionactive.phonenumber)}required{/if}>
                                                            </div>
                                                        {/if}
                                                    </div> 
                                                </div>
                                                    {/if}-->
                                                    <div style="width:100%;" class="">
                                                        <div class="heading-bar">
                                                            <img src="modules/addons/vpnpanel/templates/images/hosting-icon.png" alt="img"><h3>Choose your VPN Subscription</h3>
                                                        </div>
                                                        <div class="panel-body">
                                                            <center>
                                                                <ul class="productHolder" style="padding-left: 0px;">
                                                                    {foreach from=$products item=product}
                                                                        <li id="product1">
                                                                            <label for="p_{$product->id}" class="product">

                                                                                <div class="price-table">
                                                                                    <div class="top-head">
                                                                                        <div class="top-area">
                                                                                            <h4 id="product1-name">{$product->name}</h4>
                                                                                        </div>

                                                                                        <div class="price-area">
                                                                                            <div class="price" id="product1-price">
                                                                                                {foreach from=$billingcycle[$product->id] item=billing} 
                                                                                                    {if $billing->monthly neq '-1'} 
                                                                                                        {if $billing->monthly neq ''}
                                                                                                            {if $billing->paytype eq 'onetime'}
                                                                                                                {$currency->prefix}
                                                                                                                {$billing->monthly}
                                                                                                                (One Time)
                                                                                                            {else} 

                                                                                                                <span style="font-style:normal; padding: 0px; color: inherit;">{$currency->prefix}{$billing->monthly}</span>/mo
                                                                                                            {/if}
                                                                                                        {else}
                                                                                                            <span class="free" style="font-style:normal; padding: 0px; color: inherit;">FREE</span>
                                                                                                        {/if}
                                                                                                    {elseif $billing->quarterly neq '-1'} 
                                                                                                        <span style="font-style:normal; padding: 0px; color: inherit;">{$currency->prefix}{$billing->quarterly}</span>/3 mo
                                                                                                    {elseif $billing->semiannually neq '-1'} 
                                                                                                        <span style="font-style:normal; padding: 0px; color: inherit;">{$currency->prefix}{$billing->semiannually}</span>/6 mo
                                                                                                    {elseif $billing->annually neq '-1'} 
                                                                                                        <span style="font-style:normal; padding: 0px; color: inherit;">{$currency->prefix}{$billing->annually}</span>/yr
                                                                                                    {elseif $billing->biennially neq '-1'} 
                                                                                                        <span style="font-style:normal; padding: 0px; color: inherit;">{$currency->prefix}{$billing->biennially}</span>/2yr
                                                                                                    {elseif $billing->triennially neq '-1'} 
                                                                                                        <span style="font-style:normal; padding: 0px; color: inherit;">{$currency->prefix}{$billing->triennially}</span>/3yr



                                                                                                    {/if}




                                                                                                {/foreach}
                                                                                            </div>


                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- <ul>

                                                                                        {assign var=des value="\n"|explode:$product->description}

                                                                                        {foreach from=$des item=$list}
                                                                                            <li id="product1-description">{$list}</li>
                                                                                            {/foreach}                               
                                                                                    </ul> -->
                                                                                    <label class="btn btn-primary form-control form_packageid">
                                                                                        <span style="color:#fff; ">Pick now</span>
                                                                                        <input type="radio" id="p_{$product->id}" class="productRadio" name="packageid" value="{$product->id}">
                                                                                    </label>



                                                                                </div>
                                                                            </label>
                                                                        </li>
                                                                    {/foreach}
                                                                </ul>
                                                            </center>
                                                            <!--div class="form-group"> 
                                                                <select id="form_packageid" style="width:100%" name="packageid" class="form-control select-inline" tabindex="-1" aria-hidden="true">    
                                                                    <option value="">Choose Package for {$selectuser}</option>
                                                            {foreach from=$products item=product}
                                                             <option value="{$product->id}">{$product->name}</option> 
                                                            {/foreach}
                                                        </select>
                                                    </div--> 
                                                            <div id="scrl" style="float: left; width: 100%;"></div>
                                                            <div class="heading-bar bilcyc" style="margin-bottom: 30px;">
                                                                <img src="modules/addons/vpnpanel/templates/images/billing-icon.png" alt="img"><h3>Billing Cycle</h3>
                                                            </div>
                                                            {foreach from=$products item=product} 
                                                                {if $billingcycle[$product->id] neq ''}  

                                                                    <div class="hideAll" id="showproduct-{$product->id}" style="display:none; margin-top: 30px;"> 

                                                                        <div class="form-group">  
                                                                            <select id="customfield{$product->id}" data-selector_id="{$product->id}"  style="width: 100%;" class="form-control select-inline changeselectclass "  name="billingcycle[{$product->id}]">
                                                                                {foreach from=$billingcycle[$product->id] item=billing} 
                                                                                    {if $billing->monthly neq '-1'} 
                                                                                        <option
                                                                                            data-current_position_ammount="{$billing->monthly}"            
                                                                                            data-current_position="monthly"
                                                                                            data-current_position_currency="{$currency->prefix}" data-current_position_suffix="{$currency->suffix} ({if $billing->paytype eq 'onetime'}One Time{else}Monthly{/if})" value="monthly|{$billing->currency}|{$billing->monthly}"  >{$currency->prefix}{$billing->monthly}{$currency->suffix} ({if $billing->paytype eq 'onetime'}One Time{else}Monthly{/if})</option>
                                                                                    {/if} {if $billing->quarterly neq '-1'} 
                                                                                        <option
                                                                                            data-current_position_ammount="{$billing->quarterly}"
                                                                                            data-current_position="quarterly" data-current_position_currency="{$currency->prefix}"  data-current_position_suffix="{$currency->suffix} (Quarterly)" value="quarterly|{$billing->currency}|{$billing->quarterly}">{$currency->prefix}{$billing->quarterly}{$currency->suffix} (Quarterly)</option>
                                                                                    {/if} {if $billing->semiannually neq '-1'} 
                                                                                        <option
                                                                                            data-current_position_ammount="{$billing->semiannually}"
                                                                                            data-current_position="semiannually" data-current_position_currency="{$currency->prefix}" data-current_position_suffix="{$currency->suffix} (Semi-Annually)"
                                                                                            value="semiannually|{$billing->currency}|{$billing->semiannually}">{$currency->prefix}{$billing->semiannually}{$currency->suffix} (Semi-Annually)</option>
                                                                                    {/if} {if $billing->annually neq '-1'} 
                                                                                        <option
                                                                                            data-current_position_ammount="{$billing->annually}"
                                                                                            data-current_position="annually"
                                                                                            data-current_position_currency="{$currency->prefix}"
                                                                                            data-current_position_suffix="{$currency->suffix} (Annually)"
                                                                                            value="annually|{$billing->currency}|{$billing->annually}">{$currency->prefix}{$billing->annually}{$currency->suffix} (Annually)</option>
                                                                                    {/if} {if $billing->biennially neq '-1'} 
                                                                                        <option 
                                                                                            data-current_position_ammount="{$billing->biennially}"
                                                                                            data-current_position="biennially"
                                                                                            data-current_position_currency="{$currency->prefix}"
                                                                                            data-current_position_suffix="{$currency->suffix} (Biennially)" 
                                                                                            value="biennially|{$billing->currency}|{$billing->biennially}">{$currency->prefix}{$billing->biennially}{$currency->suffix} (Biennially)</option>
                                                                                    {/if} 
                                                                                    {if $billing->triennially neq '-1'} 
                                                                                        <option
                                                                                            data-current_position_ammount="{$billing->triennially}"
                                                                                            data-current_position="triennially"
                                                                                            data-current_position_currency="{$currency->prefix}"
                                                                                            data-current_position_suffix="{$currency->suffix} (Triennially)"
                                                                                            value="triennially|{$billing->currency}|{$billing->triennially}">{$currency->prefix}{$billing->triennially}{$currency->suffix} (Triennially)</option>
                                                                                    {/if} 
                                                                                {/foreach}
                                                                            </select> 
                                                                            <span style="color:red;" class="amt_det">It will deduct <b><span id='deduct_amount{$product->id}' style="font-weight: 800; font-size: 16px; color: #000;">{if $billingcycle[$product->id][0]->monthly neq '-1'}{$billingcycle[$product->id][0]->monthly}
                                                                                    {elseif $billingcycle[$product->id][0]->quarterly neq '-1'}{$billingcycle[$product->id][0]->quarterly}
                                                                                    {elseif $billingcycle[$product->id][0]->semiannually neq '-1'}{$billingcycle[$product->id][0]->semiannually}
                                                                                    {elseif $billingcycle[$product->id][0]->annually neq '-1'}{$billingcycle[$product->id][0]->annually}
                                                                                    {elseif $billingcycle[$product->id][0]->biennially neq '-1'}{$billingcycle[$product->id][0]->biennially} 
                                                                                {elseif $billingcycle[$product->id][0]->triennially neq '-1'}{$billingcycle[$product->id][0]->triennially}{/if} </span></b> credits from your account</span>
                                                                </div>  

                                                            </div>{/if}
                                                            
                                                            {if  $addonpackagearray[$product->id]|@count gt 0} 
                                                                <div class="hideAll" id="show1-{$product->id}" style="display:none;"> 
                                                                    <div class="heading-bar" style="margin-bottom:15px;">
                                                                        <img src="modules/addons/vpnpanel/templates/images/billing-icon.png" alt="img"><h3>Addons</h3>
                                                                    </div>
                                                                    <div class="" id="showproduct1-{$product->id}" style="display:block; margin-top: 30px;"> 
                                                                       {foreach from=$addonpackagearray[$product->id] item=addonpackageda}
                                                                       <!-- <pre>{$addonpackageda|@print_r}</pre>  -->
                                                                       {if $addonpackageda->addonpackagebillingcycle eq 'onetime'}
                                                                            {if $addonpackageda->addonpackagemonthly neq '-1.00'}
                                                                                 {assign var="addonPrice" value="{$addonpackageda->addonpackagemonthly}"}
                                                                            {elseif $addonpackageda->addonpackagequarterly neq '-1.00'}
                                                                                {assign var="addonPrice" value="{$addonpackageda->addonpackagequarterly}"}
                                                                            {elseif $addonpackageda->addonpackageannually neq '-1.00'}
                                                                                {assign var="addonPrice" value="{$addonpackageda->addonpackageannually}"}
                                                                            {elseif $addonpackageda->addonpackagebiennially neq '-1.00'}
                                                                                {assign var="addonPrice" value="{$addonpackageda->addonpackagebiennially}"}
                                                                            {else}
                                                                                {assign var="addonPrice" value="{$addonpackageda->addonpackagetriennially}"}
                                                                            {/if}
                                                                       {elseif $addonpackageda->addonpackagebillingcycle neq 'free'}
                                                                            {if $addonpackageda->addonpackagemonthly neq '-1.00'}
                                                                                 {assign var="addonPrice" value="{$addonpackageda->addonpackagemonthly}"}
                                                                            {elseif $addonpackageda->addonpackagequarterly neq '-1.00'}
                                                                                {assign var="addonPrice" value="{$addonpackageda->addonpackagequarterly}"}
                                                                            {elseif $addonpackageda->addonpackageannually neq '-1.00'}
                                                                                {assign var="addonPrice" value="{$addonpackageda->addonpackageannually}"}
                                                                            {elseif $addonpackageda->addonpackagebiennially neq '-1.00'}
                                                                                {assign var="addonPrice" value="{$addonpackageda->addonpackagebiennially}"}
                                                                            {else}
                                                                                {assign var="addonPrice" value="{$addonpackageda->addonpackagetriennially}"}
                                                                            {/if}
                                                                        {else}
                                                                            {assign var="addonPrice" value="0.00"}
                                                                       {/if}
                                                                       <!-- Setup fee -->
                                                                       {if $addonpackageda->addonpackagemsetupfee neq '-1.00'}
                                                                             {assign var="addonsetupfee" value="{$addonpackageda->addonpackagemsetupfee}"}
                                                                        {elseif $addonpackageda->addonpackageqsetupfee neq '-1.00'}
                                                                            {assign var="addonsetupfee" value="{$addonpackageda->addonpackageqsetupfee}"}
                                                                        {elseif $addonpackageda->addonpackagessetupfee neq '-1.00'}
                                                                            {assign var="addonsetupfee" value="{$addonpackageda->addonpackagessetupfee}"}
                                                                        {elseif $addonpackageda->addonpackageasetupfee neq '-1.00'}
                                                                            {assign var="addonsetupfee" value="{$addonpackageda->addonpackageasetupfee}"}
                                                                        {elseif $addonpackageda->addonpackagebsetupfee neq '-1.00'}
                                                                            {assign var="addonsetupfee" value="{$addonpackageda->addonpackagebsetupfee}"}
                                                                        {elseif $addonpackageda->addonpackagetsetupfee neq '-1.00'}
                                                                            {assign var="addonsetupfee" value="{$addonpackageda->addonpackagetsetupfee}"} 
                                                                        {else}                                                        {assign var="addonsetupfee" value="0.00"}                  
                                                                        {/if}

                                                                        <!-- Sum of amount and setup fee -->
                                                                        {if $addonsetupfee neq "0.00"}
                                                                            {assign var="showtext" value="&nbsp;<b>{$currency->prefix}{$addonPrice} {$currency->suffix} + {$currency->prefix}{$addonsetupfee} {$currency->suffix} Setup Fee = </b>"}   
                                                                            {$TotalPrice={$addonPrice}+{$addonsetupfee}}
                                                                            
                                                                        {else}
                                                                             {assign var="showtext" value=""}  
                                                                             {$TotalPrice={$addonPrice}}   
                                                                        {/if}    
                                                                        
                                                                       
                                                                       <label class="checkbox-inline"><input type='checkbox'  name='ProductAddons[]' value='{$addonpackageda->addonpackageid}' data-productprice='{$TotalPrice|string_format:"%.2f"}' class='checkboxclick'> {$addonpackageda->addonpackagename} {$showtext} <b>({$currency->prefix}{$TotalPrice|string_format:"%.2f"} {$currency->suffix})</b></label><br>
                                                                       {/foreach}
                                                                    </div>
                                                                </div> 
                                                            {/if} 



                                                            <div class="hideAll" id="show-{$product->id}" style="margin-top:20px"> 
                                                                <div class="heading-bar" style="margin-bottom:30px;">
                                                                    <img src="modules/addons/vpnpanel/templates/images/billing-icon.png" alt="img"><h3>Additional Infrormation</h3>
                                                                </div>
                                                                {foreach from=$customfields[$product->id] item=customfield}  
                                                                    {if $customfield->adminonly neq 'on'}
                                                                        {if $customfield->fieldtype eq 'dropdown'} 
                                                                            {assign var=fieldoptions value=","|explode:$customfield->fieldoptions}
                                                                            <div class="form-group" id="{$customfield->fieldname}"> 
                                                                                <select id="customfield{$customfield->id}" style="width: 100%;" class="form-control select-inline" name="customfields[{$product->id}][{$customfield->fieldname}]">
                                                                                    <option value="">{$customfield->fieldname}</option>
                                                                                    {foreach from=$fieldoptions item=fieldoption}
                                                                                        <option value="{$fieldoption}">{$fieldoption}</option>
                                                                                    {/foreach} 
                                                                                </select> 
                                                                                <span>{$customfield->description}</span>
                                                                            </div> 
                                                                        {elseif $customfield->fieldtype eq 'tickbox'}
                                                                            <div class="form-group" id="{$customfield->fieldname}">
                                                                                <label class="checkbox-inline"> 
                                                                                    <input onclick="checkifmagonly(this.id);" name="customfields[{$product->id}][{$customfield->fieldname}]" value='on' id="customfield{$customfield->id}" type="checkbox">
                                                                                    {$customfield->description}</label>  
                                                                            </div>
                                                                        {else}
                                                                            <div class="form-group" id="{$customfield->fieldname}">
                                                                                {if $customfield->fieldname eq 'Username'}
                                                                                    <p class="validate_error"><b>Error:</b> Special characters and space is not allowed.</p>  
                                                                                {/if} 
                                                                                <input class="form-control {if $customfield->fieldname eq 'Username'}validateusername{/if} {if $customfield->fieldname eq {$maccustomfieldname} or $customfield->fieldname eq {$e2customfieldname}}keyup-characters{/if}" placeholder="{$customfield->fieldname}" type="text" name="customfields[{$product->id}][{$customfield->fieldname}]" >
                                                                                <span>{$customfield->description} {if $customfield->required eq 'on'}<span style="color:red">(Required)</span>{/if}</span>
                                                                            </div>

                                                                        {/if}
                                                                    {/if} 
                                                                {/foreach}
                                                                
                                                                <!-- {$configuralOption} -->
                                                                <!-- <pre>{$configuralOption|print_r}</pre> -->
                                                                {if  isset($configuralOption[{$product->id}]) && !empty($configuralOption[{$product->id}])}
                                                                    
                                                                    <div class="form-group" >
                                                                        {foreach from=$configuralOption[{$product->id}]  key=key item=value}

                                                                            {assign var="configname" value="{$value['optionname']}" nocache}

                                                                            {assign var="inputtype" value="text" nocache}
                                                                            {if $value['optiontype'] == 4}
                                                                                {assign var="inputtype" value="number" nocache}
                                                                            {/if}
                                                                            {assign var="inputmin" value="{$value['qtyminimum']}" nocache}
                                                                            {assign var="inputmax" value="{$value['qtymaximum']}" nocache} 

                                                                        

                                                                            {foreach from=$value['pricetype']  key=pricetypekey item=pricetypeval}
                                                                           

                                                                                <div class="packageconfig{$product->id} Showconfig_{$pricetypekey} hideAllconfig config checkexist" style="margin-bottom: 30px; width:100%;float: left;" >
                                                                                    <!-- {$jkl} -->
                                                                                    <input 
                                                                                        type="{$inputtype}" value="{$inputmin}" 
                                                                                        name="configOption_{$value['id']}[{$product->id}][{$value['id']}][{$pricetypekey}]"  
                                                                                        class="count form-control getinputval" 
                                                                                        data-configprice="{$pricetypeval}"
                                                                                        data-productid="{$product->id}"
                                                                                        data-configopid="{$value['id']}"
                                                                                        data-billingisdata="{$pricetypekey}"
                                                                                        min="{$inputmin}" 
                                                                                        {if $inputmax != '0'} 
                                                                                            max="{$inputmax}" 
                                                                                        {/if} data-oldVal="0"
                                                                                        style="width: 60px; float: left;">

                                                                                    <span style="float: left; margin-top: 10px;">x - {$configname} ({$currency->prefix}{$pricetypeval}{$currency->suffix} <b>{$pricetypekey}</b>)</span>
                                                                                </div>

                                                                            {/foreach}
                                                                            <input type="hidden" name="billingCycleNis[{$product->id}][{$value['id']}]" id="billingCycleNisID_{$product->id}_{$value['id']}" value="">
                                                                            <input type="hidden" name="ConfigOptionIdNis[{$product->id}][{$value['id']}]" id="ConfigOptionIdNisID_{$product->id}_{$value['id']}" value="">
                                                                            
                                                                        {/foreach}
                                                                        
                                                                    </div> 

                                                                {/if}

                                                            </div>
                                                        {/foreach}


                                                        {if $userinfo eq 'yes'}        
                                                            <div class="heading-bar custom-billing" style="margin-top: 30px">
                                                                <img src="modules/addons/vpnpanel/templates/images/billing-icon.png" alt=""><h3>Enter Your Billing Information</h3>
                                                            </div>

                                                            <div class="billing-information" style="margin-top: 30px;">
                                                                <div class="row">
                                                                    {if $optionactive.login neq ''}<div class="form-group col-md-6"><input class="form-control" placeholder="Email / Login (Required for Billing Portal) " type="text" name="login" id="login" {if isset($optionactive.login)}required{/if} value="">

                                                                        </div>{/if}
                                                                        {if $optionactive.password neq ''}<div class="form-group col-md-6"><input class="form-control"  placeholder="Password" type="password" name="password" id="password" {if isset($optionactive.password)}required{/if} value="">
                                                                            </div> {/if}
                                                                            {if $optionactive.confirmpassword neq ''}<div class="form-group col-md-6"><input class="form-control" onfocusout="Confirm(this.value);" placeholder="Confirm Password" {if isset($optionactive.confirmpassword)}required{/if} type="password" name="confirmpassword" id="confirmpassword" value="">
                                                                                </div> {/if}
                                                                                <!-- Firstname -->
                                                                                {if $optionactive.clientname neq ''}<div class="form-group col-md-6"><input class="form-control" type="text" placeholder="Name" name="clientname" id="clientname" value="" {if isset($optionactive.clientname)}required{/if}>
                                                                                    </div>  {/if}
                                                                                    <!-- companyname -->
                                                                                    {if $optionactive.companyname neq ''}<div class="form-group col-md-6"><input class="form-control" placeholder="{$LANG.clientareacompanyname}" type="text" name="companyname" id="companyname" value="">
                                                                                        </div> {/if}
                                                                                        <!-- address1 -->
                                                                                        {if $optionactive.address1 neq ''}<div class="form-group col-md-6"><input class="form-control" type="text"  placeholder="{$LANG.clientareaaddress1}" name="address1" id="address1" value="" {if isset($optionactive.address1)}required{/if}>
                                                                                            </div>{/if}
                                                                                            <!-- address2 -->
                                                                                            {if $optionactive.address2 neq ''}<div class="form-group col-md-6"><input class="form-control" type="text"   placeholder="{$LANG.clientareaaddress2}" name="address2" id="address2" value="">
                                                                                                </div>{/if}
                                                                                                <!-- city -->
                                                                                                {if $optionactive.city neq ''}<div class="form-group col-md-6"><input class="form-control" type="text"  placeholder="{$LANG.clientareacity}" name="city" id="city" value="" {if isset($optionactive.city)}required{/if}>
                                                                                                    </div>{/if}
                                                                                                    <!-- State -->
                                                                                                    {if $optionactive.state neq ''}<div class="form-group col-md-6">
                                                                                                            <input class="form-control" placeholder="State" type="text" name="state" id="state" value="" {if isset($optionactive.state)}required{/if}>
                                                                                                        </div> {/if}

                                                                                                        <!-- Post Code -->
                                                                                                        {if $optionactive.postcode neq ''}<div class="form-group col-md-6"><input class="form-control" type="text"  placeholder="{$LANG.clientareapostcode}" name="postcode" id="postcode" value="" {if isset($optionactive.postcode)}required{/if}>
                                                                                                            </div>{/if}
                                                                                                            <!-- phone -->
                                                                                                            {if $optionactive.phonenumber neq ''} <div class="form-group col-md-6"><input class="form-control" placeholder="{$LANG.clientareaphonenumber}" type="tel" name="phonenumber" id="phonenumber" value="" {if isset($optionactive.phonenumber)}required{/if}>
                                                                                                                </div>
                                                                                                            {/if}  
                                                                                                            <div class="form-group col-md-6"><input class="form-control" style='{if !isset($optionactive.addcredit)}display:none;{/if}' placeholder="Add Credit" type="text" name="add_credit" id="credit" value="">
                                                                                                            </div>
                                                                                                            <div class="form-group col-md-6"><input class="form-control" style='{if !isset($optionactive.promocode)}display:none;{/if}'   type="text" name="promocode" id="credit" placeholder="Enter Promotion Code">
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                {/if}
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
                                                                                                                        <p class="text-center"><b>Your Credit</b><br><span class="credit" style="color: #000; font-style:normal; padding: 0px;">{$totalcredit}</span></p>
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


                                                                    {literal} 
                                                                        <script>
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
                                                                        </script>
                                                                    {/literal}

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
                                                                    </style>