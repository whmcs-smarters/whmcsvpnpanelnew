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
      <div class="alert alert-block alert-info text-center">
         Current Configuration: <strong>{$CurrentProductServiceData[0]->group_name} - {$CurrentProductServiceData[0]->product_name}</strong>
      </div>
      <table class="table table-striped">
         <thead>
            <tr>
               <th width="60%">Description</th>
               <th class="text-center" width="40%">Price</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td><input name="pid" value="63" type="hidden"><input name="billingcycle" value="quarterly" type="hidden">{$CurrentProductServiceData[0]->product_name} =&gt; {$newproductdetails[0]->name}</td>
               <td class="text-center">{$prefixCurrency}{$FinalAmmountofNewPackage} {$codecurrency}</td>
            </tr>
            <tr class="masspay-total">
               <td class="text-right">Subtotal:</td>
               <td class="text-center">{$prefixCurrency}{$FinalAmmountofNewPackage} {$codecurrency}</td>
            </tr>
            <tr class="masspay-total">
               <td class="text-right">Total Due Today:</td>
               <td class="text-center">{$prefixCurrency}{$FinalAmmountofNewPackage} {$codecurrency}</td>
            </tr>
         </tbody>
      </table>
      <div class="form-group text-center">
         {if $totalcredit >= $FinalAmmountofNewPackage}
         	<form method="POST" action="">
         		<input type="hidden" name="serviceid" value="{$CurrentServiceId}">
         		<input type="hidden" name="paymentmethod" value="{$DefaultPaymentMethod}">
         		<input type="hidden" name="newproductbillingcycle" value="{$UpGradebillingcycle}">
         		<input type="hidden" name="type" value="product">
         		<input type="hidden" name="newproductid" value="{$newproductdetails[0]->id}">
               <input value="Click to Continue >>" name="upgradenow" class="btn btn-primary" type="submit">
            </form>
         {else}
            <div class="alert alert-danger" >
               <strong>Warring!</strong> You can't add any users and services  because your account credits is exhausted. - Please add credits <a href="cart.php?gid={if $topup eq ''}addons{else}{$topup}{/if}" target="_self">here</a>!
            </div> 
         {/if}
      </div>
      <div class="alert alert-warning text-center">
         Upgrade price is calculated from a credit of the unused portion of the current plan and billing of the new plan for the same period ({$UpgradePeriod})
      </div>
   </div>
   <!-- /.main-content -->
</div>