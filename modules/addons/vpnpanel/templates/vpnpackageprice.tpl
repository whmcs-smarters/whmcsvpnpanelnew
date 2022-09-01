<link href="modules/addons/vpnpanel/templates/css/radio.css" rel="stylesheet">   
<link href="modules/addons/vpnpanel/templates/css/swiftmodders.css" rel="stylesheet">
<link href="modules/addons/vpnpanel/templates/css/mystyle.css" rel="stylesheet"> 
<link href="modules/addons/vpnpanel/templates/css/bootstrap-duallistbox.css" rel="stylesheet"> 
<script src="modules/addons/vpnpanel/templates/js/jquery.bootstrap-duallistbox.js">

</script>

<script>
    $(function () {
        var products = $('select[name="products[]"]').bootstrapDualListbox();
        var gateways = $('select[name="gateways[]"]').bootstrapDualListbox();
    })
</script>
<!-- Register -->

<div class="container" style="width: 100%;margin-top: 20px;"> 
    {include file='modules/addons/vpnpanel/templates/nav_header.tpl'}
    <div class="sm-content-container">
        <div class="sm-content"> 
            {if $message!=''}
                <div class="alert alert-{$result} alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {$message}
                </div>
            {/if}

            <div class="sm-page-heading">
                <h1>
                    <i class="fa fa-globe"></i>&nbsp;Package Price
                </h1>
            </div>
            <div class="panel-body">
                {if $imgmsg neq ''}
                    <p class='alert alert-info'>{$imgmsg}</p>
                {/if}
                <div id="exTab2" class="container" style="width: 100%;">	
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#1" data-toggle="tab">Products</a>
                        </li>
                        
                       

                    </ul>

                    <div class="tab-content ">
                        <div class="tab-pane active" id="1">

                            <div class="row" style="margin: 0px;">
                                <div class="col-md-12">

                                    <h3>Products</h3>

                                    <div class="col-md-12 text-center">
                                        <div class="col-md-12">
                                        {if isset($smarty.get.productedit)}
                                        
                                        <form method="post" action="">
                                                <table class="table table-responsive table-bordered table-striped">
                                                    <thead><tr>
                                                        
                                                    <th>Product</th>
                                                    <th>Monthly</th>
                                                    <th>Quarterly</th>
                                                    <th>Semi Annually</th>
                                                    <th>Annually</th>
                                                    <th>Biennially</th>
                                                    <th>Trinnially</th>
                                                    </tr></thead>
                                                    <tbody>
                                                        
                                                        {assign var=val value=$smarty.get.productedit}
                                                        
                                                        <tr>
                                                        <td>{$productName.$val}<input type="hidden" name="pid" value="{$val}"></td>
                                                        <td><input type="number" min="{$priceMonthly_org.$val}" {if $priceMonthly_org.$val == '-1.00'}readonly{/if} value="{if $priceMonthly.$val == '' || empty({$priceMonthly.$val})}{$priceMonthly_org.$val}{else}{$priceMonthly.$val}{/if}" name="monthly" class="form-control "></td>
                                                        <td><input type="number" min="{$priceQuarterly_org.$val}" {if $priceQuarterly_org.$val == '-1.00'}readonly{/if} value="{if $priceMonthly.$val == '' || empty($priceMonthly.$val)}{$priceQuarterly_org.$val}{else}{$priceQuarterly.$val}{/if}" name="quarterly" class="form-control"></td>
                                                        <td><input type="number" min="{$priceSemiannually_org.$val}" {if $priceSemiannually_org.$val == '-1.00'}readonly{/if} value="{if $priceMonthly.$val == '' || empty($priceMonthly.$val)}{$priceSemiannually_org.$val}{else}{$priceSemiannually.$val}{/if}" name="semiannually" class="form-control"></td>
                                                        <td><input type="number" min="{$priceAnnually_org.$val}" {if $priceAnnually_org.$val == '-1.00'}readonly{/if} value="{if $priceMonthly.$val == '' || empty($priceMonthly.$val)}{$priceAnnually_org.$val}{else}{$priceAnnually.$val}{/if}" name="annually" class="form-control"></td>
                                                        <td><input type="number" min="{$priceBiennially_org.$val}" {if $priceBiennially_org.$val == '-1.00'}readonly{/if} value="{if $priceMonthly.$val == '' || empty($priceMonthly.$val)}{$priceBiennially_org.$val}{else}{$priceBiennially.$val}{/if}" name="biennially" class="form-control"></td>
                                                        <td><input type="number" min="{$priceTriennially_org.$val}" {if $priceTriennially_org.$val == '-1.00'}readonly{/if} value="{if $priceMonthly.$val == '' || empty($priceMonthly.$val)}{$priceTriennially_org.$val}{else}{$priceTriennially.$val}{/if}" name="triennially" class="form-control"></td>
                                                        
                                                       
                                                        </tr>
                                                        
                                                       
                                                    </tbody>
                                                        </table>
                                                        
                                                        <button class="btn btn-primary" type="submit" name="updateProduct">Update</button>
                                                    </form>
                                        
                                        {else}
                                           
                                                <table class="table table-responsive table-bordered table-striped">
                                                    <thead><tr>
                                                        
                                                     <th>Product</th>
                                                    <th>Monthly</th>
                                                    <th>Quarterly</th>
                                                    <th>Semi Annually</th>
                                                    <th>Annually</th>
                                                    <th>Biennially</th>
                                                    <th>Trinnially</th>
                                                    <th>Action</th>
                                                    </tr></thead>
                                                    <tbody>
                                                        {assign var=val value=0}
                                                        
                                                        
                                                        
                                                        {foreach from=$products item=product}
                                                        
                                                        
                                                        <!-- $productNew = '';
                                                        if($products neq '')
                                                        {
                                                            $productNew = $products[$val];
                                                        } -->

                                                        <tr>
                                                        <td>{$productName_org.$product}</td>
                                                        <td>{if $priceMonthly.$product == '-1.00'}-{elseif $priceMonthly.$product == '' || empty($priceMonthly.$product)}{if $priceMonthly_org[{$product}] == '-1.00'}-{else}{$priceMonthly_org[{$product}]}{/if}{else}{$priceMonthly[{$product}]}{/if}</td>
                                                        
                                                        <td>{if $priceQuarterly.$product == '-1.00'}-{elseif $priceQuarterly.$product == '' || empty($priceQuarterly[{$product}])}{if $priceQuarterly_org[{$product}] == '-1.00'}-{else}{$priceQuarterly_org[{$product}]}{/if}{else}{$priceQuarterly[{$product}]}{/if}</td>
                                                        
                                                        <td>{if $priceSemiannually.$product == '-1.00'}-{elseif $priceSemiannually.$product == '' || empty($priceSemiannually.$product)}{if $priceSemiannually_org.$product == '-1.00'}-{else}{$priceSemiannually_org.$product}{/if}{else}{$priceSemiannually.$product}{/if}</td>
                                                        
                                                        <td>{if $priceAnnually.$product == '-1.00'}-{elseif $priceAnnually.$product == '' || empty($priceAnnually.$product)}{if $priceAnnually_org.$product == '-1.00'}-{else}{$priceAnnually_org.$product}{/if}{else}{$priceAnnually.$product}{/if}</td>
                                                        
                                                       <td>{if $priceBiennially.$product == '-1.00'}-{elseif $priceBiennially.$product == '' || empty($priceBiennially.$product)}{if $priceBiennially_org.$product == '-1.00'}-{else}{$priceBiennially_org.$product}{/if}{else}{$priceBiennially.$product}{/if}</td>
                                                        
                                                        <td>{if $priceTriennially.$product == '-1.00'}-{elseif $priceTriennially.$product == '' || empty($priceTriennially.$product)}{if $priceTriennially_org.$product == '-1.00'}-{else}{$priceTriennially_org.$product}{/if}{else}{$priceTriennially.$product}{/if}</td>
                                                         
                                                        <td>
                                                       
                                                        <a href="{$url}&productedit={$product}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                                        
                                                        </td>
                                                        </tr>
                                                        {assign var=val value=$product+1}
                                                        {/foreach}
                                                    </tbody>
                                                        </table>
                                                        
                                                    
                                                    {/if}
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                


                            </div>
                        </div>
                    </div>

                </div>
            </div> 