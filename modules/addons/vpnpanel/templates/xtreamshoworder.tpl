
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
               Product/Service:<br><strong>{$UpdatedProductDetails[0]->group_name} - {$UpdatedProductDetails[0]->product_name}</strong>
            </div>
         </div>
         <div class="panel-footer clearfix">
            <a href="?m=xtreamdashboard&action=services&userid={$uid}" class="btn btn-block btn-primary"><i class="fa fa-arrow-circle-left"></i> Back to Service Details</a>
         </div>
      </div>
   </div>
   <!-- Container for main page display content -->
   <div class="col-md-9 pull-md-right main-content">
      <link rel="stylesheet" type="text/css" href="templates/orderforms/standard_cart/style.css">
      <div id="order-boxes">
         <div class="header-lined">
            <h1>Order Confirmation</h1>
         </div>
         <p>Thank you for your order. You will receive a confirmation email shortly.</p>
         <div class="row">
            <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
               {if $ordernum != ""} 
                  <div class="alert alert-success text-center large-text" role="alert">
                     Your Order Number is: <strong>{$ordernum}</strong>
                  </div>
               {/if}
               {if $error != ""} 
                  <div class="alert alert-danger text-center large-text" role="alert">
                     Error: <strong>{$error}</strong>
                  </div>
               {/if}
            </div>
         </div>
         <p>If you have any questions about your order, please open a support ticket from your client area and quote your order number.</p>
         <div class="line-padded text-center">
            <a href="clientarea.php" class="btn btn-primary btn-lg">Click here to go to your Client Area</a>
         </div>
      </div>
      <div style="position:absolute;top:0px;right:0px;padding:5px;background-color:#000066;font-family:Tahoma;font-size:11px;color:#ffffff" class="adminreturndiv">Logged in as Administrator | <a href="admin/clientssummary.php?userid=201&amp;return=1" style="color:#6699ff">Return to Admin Area</a></div>
   </div>
   <!-- /.main-content -->
</div>