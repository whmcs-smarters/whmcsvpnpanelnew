<div class="row">
    <div class="col-md-9 pull-md-right">
    </div>
    <div class="col-md-3 pull-md-left sidebar">
        <div menuitemname="Upgrade Downgrade" class="panel panel-sidebar panel-sidebar">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-expand"></i>&nbsp;                Up/Downgrade
                    <i class="fa fa-chevron-up panel-minimise pull-right"></i>
                </h3>
            </div>
            <div class="list-group">
                <div menuitemname="Product-Service" class="list-group-item" id="Primary_Sidebar-Upgrade_Downgrade-Product-Service">
                    Product/Service:<br><strong>{$CurrentProductServiceData[0]->group_name} - {$CurrentProductServiceData[0]->product_name}</strong>
                </div>
            </div>
            <div class="panel-footer clearfix">
                <a href="?m=xtreamdashboard&action=services&userid={$CurrentUserId}" class="btn btn-block btn-primary"><i class="fa fa-arrow-circle-left"></i> Back to Service Details</a>
            </div>
        </div>
    </div>
    <!-- Container for main page display content -->
    <div class="col-md-9 pull-md-right main-content">
        <p>Choose the package you want to upgrade/downgrade your current package to from the options below.</p>
        <p>Current Configuration:<br><strong>{$CurrentProductServiceData[0]->group_name} - {$CurrentProductServiceData[0]->product_name}</strong></p>
        <p>New Configuration:</p>
        <table class="table table-striped">
            <tbody>
                {foreach from=$upgradefinaldetailsarray key=Pid item=data }
                    <tr>
                        <td>
                            <strong>
                                {$data['groupname']} - {$data['productname']}
                            </strong>
                            <br>
                            {$data['productdescription']}
                        </td>
                        <td class="text-center" width="300">
                            <form method="post" action="">
                                <input type="hidden" name="CurrentServiceId" value="{$CurrentServiceId}">
                                <input type="hidden" name="CurrentUserId" value="{$CurrentUserId}">
                                <div class="form-group">
                                    {if $data['price']|@count gt 1}
                                        <select name="SelectPackage" class="form-control">
                                            {foreach from=$data['price'] key=SKey item=Sdata }
                                                <option value="{$Sdata['Price']},{$SKey},{$Pid},{$Sdata['periodtime']},{$Sdata['prefix']},{$Sdata['code']}">{$Sdata['prefix']}{$Sdata['Price']} {$Sdata['code']}  {$SKey|ucfirst}  </option>     
                                            {/foreach}
                                        </select>

                                    {else}
                                        {foreach from=$data['price'] key=SKey item=Sdata }
                                            {$Sdata['prefix']}{$Sdata['Price']} {$Sdata['code']}  {$SKey|ucfirst}  
                                            <input type="hidden" name="SelectPackage" value="{$Sdata['Price']},{$SKey},{$Pid},{$Sdata['periodtime']},{$Sdata['prefix']},{$Sdata['code']}">
                                        {/foreach}
                                    {/if}
                                </div>
                                <input value="Choose Product" name="proceedupgrade" class="btn btn-primary btn-block" type="submit">
                            </form>
                        </td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
        <div style="position:absolute;top:0px;right:0px;padding:5px;background-color:#000066;font-family:Tahoma;font-size:11px;color:#ffffff" class="adminreturndiv">Logged in as Administrator | <a href="admin/clientssummary.php?userid=201&amp;return=1" style="color:#6699ff">Return to Admin Area</a></div>
    </div>
    <!-- /.main-content -->
</div>