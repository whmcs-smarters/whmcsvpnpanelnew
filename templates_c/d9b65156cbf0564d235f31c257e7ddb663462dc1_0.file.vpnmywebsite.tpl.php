<?php
/* Smarty version 3.1.36, created on 2020-11-18 10:08:47
  from '/var/www/html/modules/addons/vpnpanel/templates/vpnmywebsite.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fb4f2af257264_72234856',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd9b65156cbf0564d235f31c257e7ddb663462dc1' => 
    array (
      0 => '/var/www/html/modules/addons/vpnpanel/templates/vpnmywebsite.tpl',
      1 => 1605080588,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:modules/addons/vpnpanel/templates/nav_header.tpl' => 1,
  ),
),false)) {
function content_5fb4f2af257264_72234856 (Smarty_Internal_Template $_smarty_tpl) {
?><link href="modules/addons/vpnpanel/templates/css/radio.css" rel="stylesheet">   
<link href="modules/addons/vpnpanel/templates/css/swiftmodders.css" rel="stylesheet">
<link href="modules/addons/vpnpanel/templates/css/mystyle.css" rel="stylesheet"> 
<link href="modules/addons/vpnpanel/templates/css/bootstrap-duallistbox.css" rel="stylesheet"> 
<?php echo '<script'; ?>
 src="modules/addons/vpnpanel/templates/js/jquery.bootstrap-duallistbox.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 type="text/javascript" src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="modules/addons/vpnpanel/templates/js/jquery.tablednd.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="modules/addons/vpnpanel/assets/js/tinymce/tinymce.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>tinymce.init({ height: "500",width: "100%",selector:'textarea' });<?php echo '</script'; ?>
>

<?php echo '<script'; ?>
>

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
<?php echo '</script'; ?>
>

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
    <?php $_smarty_tpl->_subTemplateRender('file:modules/addons/vpnpanel/templates/nav_header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <div class="sm-content-container">
        <div class="sm-content"> 
            <?php if ($_smarty_tpl->tpl_vars['result']->value != '') {?>
                <div class="alert alert-<?php echo $_smarty_tpl->tpl_vars['result']->value;?>
 alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

                </div>
            <?php }?>

<?php if ((isset($_GET['err'])) && $_GET['err'] == 'stripeActive') {?>
                <div class="alert alert-danger alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Authorize.net and Stripe Gateway both cannot be active at same time.
                </div>
                <?php } elseif ((isset($_GET['err'])) && $_GET['err'] == 'authorizeActive') {?>
                <div class="alert alert-danger alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Authorize.net and Stripe Gateway both cannot be active at same time.
            </div>
                <?php }?>
            <div class="sm-page-heading">
                <h1>
                    <i class="fa fa-globe"></i>&nbsp;My Shoping Cart
                </h1>
            </div>
            <div class="panel-body">
                <?php if ($_smarty_tpl->tpl_vars['imgmsg']->value != '') {?>
                    <p class='alert alert-info'><?php echo $_smarty_tpl->tpl_vars['imgmsg']->value;?>
</p>
                <?php }?>

                <div id="exTab2" class="container" style="width: 100%;">	
                    <ul class="nav nav-tabs">
                        <li <?php if ($_smarty_tpl->tpl_vars['styleTab']->value == 'active') {?>class="active"<?php } elseif ($_smarty_tpl->tpl_vars['styleTab']->value != 'active' && $_smarty_tpl->tpl_vars['productsTab']->value != 'active' && $_smarty_tpl->tpl_vars['sortprodctTab']->value != 'active' && $_smarty_tpl->tpl_vars['EmailSettingSectionTab']->value != 'active' && $_smarty_tpl->tpl_vars['gatewayTab']->value != 'active') {?>class="active"<?php }?>><a href="#1" data-toggle="tab">General</a>
                        </li>
                        <li <?php if ($_smarty_tpl->tpl_vars['productsTab']->value == 'active') {?>class="active"<?php }?>>
                            <a  href="#2" data-toggle="tab">Products</a>
                        </li>
                        <li <?php if ($_smarty_tpl->tpl_vars['sortprodctTab']->value == 'active') {?>class="active"<?php }?>>
                            <a  href="#6" data-toggle="tab">Sorting Products</a>
                        </li>
                        <li><a href="#3" data-toggle="tab">Payment gateways</a>
                        </li>
                        <li <?php if ($_smarty_tpl->tpl_vars['gatewayTab']->value == 'active') {?>class="active"<?php }?>><a href="#4" data-toggle="tab">Manage Existing gateways</a>
                        </li>
                        <li <?php if ($_smarty_tpl->tpl_vars['EmailSettingSectionTab']->value == 'active') {?>class="active"<?php }?>><a href="#8" data-toggle="tab">Email Settings</a>
                        </li>
                        <!-- <li <?php if ($_smarty_tpl->tpl_vars['domain']->value == 'active') {?>class="active"<?php }?>><a href="#5" data-toggle="tab">Setup Domain</a>
                        </li> -->

                    </ul>

                    <div class="tab-content ">
                        <div class="tab-pane <?php if ($_smarty_tpl->tpl_vars['styleTab']->value == 'active') {?>active<?php } elseif ($_smarty_tpl->tpl_vars['styleTab']->value != 'active' && $_smarty_tpl->tpl_vars['productsTab']->value != 'active' && $_smarty_tpl->tpl_vars['sortprodctTab']->value != 'active' && $_smarty_tpl->tpl_vars['EmailSettingSectionTab']->value != 'active' && $_smarty_tpl->tpl_vars['gatewayTab']->value != 'active') {?>active<?php }?>" id="1">

                            <div class="row" style="margin: 0px;">
                                <div class="col-md-12">

                                    <h3>General Settings </h3>

                                    <div class="col-md-12 text-center">
                                        <div class="col-md-12">

                                            <form method="post" action="" enctype="multipart/form-data">
                                                <table class="table table-responsive table-bordered table-striped">
                                                    <tr><th style="text-align: center; vertical-align: middle;">Logo</th><td><?php if ($_smarty_tpl->tpl_vars['clientData']->value[0]->logo != '') {?>
                                                            <div class="holder" style="width: auto; height: auto; float: left; margin-top: 30px;">
                                                                <img src="<?php if ($_smarty_tpl->tpl_vars['clientData']->value[0]->logo != '') {
echo $_smarty_tpl->tpl_vars['systemsslurl']->value;
echo $_smarty_tpl->tpl_vars['clientData']->value[0]->logo;
}?>" id="logoView" style="border: solid 1px #ccc; width:auto; max-width: 200px; height: auto;" >
                                                                <form method="post" style="width: auto;position: relative; float: right; right: 7px; top: -10px;">
                                                                    <button type="submit" class="btn btn-danger btn-xs" name="rmImage"><i class="fa fa-times"></i></button>
                                                                </form>
                                                            </div>
                                                            <?php } else { ?>
                                                                <?php echo '<script'; ?>
>
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
                                                                    })<?php echo '</script'; ?>
>

                                                                <form method="post" action="" enctype="multipart/form-data">
                                                                    <div class="form-group">
                                                                        <input type="file" name="logo" id="logoupload" accept="image/*">
                                                                        <br/>
                                                                        <img src="" id="logoView" style="border: solid 1px #ccc; width:auto; max-width: 200px; height: auto;" >
                                                                    </div>

                                                                    <input type="submit" class="btn btn-success" name="uploadImage" value="Upload" >
                                                                    <?php }?>

                                                                    </form></td></tr>

                                                            <tr>
                                                            <form method="post">
                                                                <th style="text-align: center; vertical-align: middle;">Company Name</th><td><input type="text" name="title"<?php if ($_smarty_tpl->tpl_vars['clientData']->value[0]->companyName != '') {?>value="<?php echo $_smarty_tpl->tpl_vars['clientData']->value[0]->companyName;?>
"<?php }?>></td>
                                                                </tr>

                                                                <tr>
                                                                    <th style="text-align: center; vertical-align: middle;">Tagline</th><td><input type="text" name="tagline"<?php if ($_smarty_tpl->tpl_vars['clientData']->value[0]->tagline != '') {?>value="<?php echo $_smarty_tpl->tpl_vars['clientData']->value[0]->tagline;?>
"<?php }?>></td>
                                                                </tr>

                                                                <tr>
                                                                    <th style="text-align: center; vertical-align: middle;">Primary Color</th><td><input type="color" name="headingColor"<?php if ($_smarty_tpl->tpl_vars['clientData']->value[0]->headColor != '') {?>value="<?php echo $_smarty_tpl->tpl_vars['clientData']->value[0]->headColor;?>
"<?php } else { ?>value="#0e5077"<?php }?>></td>
                                                                </tr>

                                                                <tr>
                                                                    <th style="text-align: center; vertical-align: middle;">Secondary Color</th><td><input type="color" name="headingTextColor"<?php if ($_smarty_tpl->tpl_vars['clientData']->value[0]->textColor != '') {?>value="<?php echo $_smarty_tpl->tpl_vars['clientData']->value[0]->textColor;?>
"<?php } else { ?>value="#ffffff"<?php }?>></td>
                                                                </tr>
                                                                <tr>
                                                                    <th style="text-align: center; vertical-align: middle;">Main Domain URL</th><td><input type="url" name="domainURL"<?php if ($_smarty_tpl->tpl_vars['clientData']->value[0]->domainURL != '') {?>value="<?php echo $_smarty_tpl->tpl_vars['clientData']->value[0]->domainURL;?>
"<?php }?>></td>
                                                                </tr>
                                                                <tr>
                                                                    <th style="text-align: center; vertical-align: middle;">Term & Services URL</th><td><input type="url" name="tandc"<?php if ($_smarty_tpl->tpl_vars['clientData']->value[0]->tandc != '') {?>value="<?php echo $_smarty_tpl->tpl_vars['clientData']->value[0]->tandc;?>
"<?php }?>></td>
                                                                </tr>
                                                                <tr>
                                                                    <th style="text-align: center; vertical-align: middle;">Privacy Policy URL</th><td><input type="url" name="privacy"<?php if ($_smarty_tpl->tpl_vars['clientData']->value[0]->privacy != '') {?>value="<?php echo $_smarty_tpl->tpl_vars['clientData']->value[0]->privacy;?>
"<?php }?>></td>
                                                                </tr>

                                                                <tr>
                                                                    <th style="text-align: center; vertical-align: middle;">My Website URL</th><td><?php if ($_smarty_tpl->tpl_vars['clientData']->value[0]->websiteURL != '') {?><a href="<?php echo $_smarty_tpl->tpl_vars['clientData']->value[0]->websiteURL;?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['clientData']->value[0]->websiteURL;?>
</a><?php }?></td>
                                                                </tr>

                                                        </table>
                                                        <button type="submit" name="saveStyle" class="btn btn-primary">Save</button>
                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane <?php if ($_smarty_tpl->tpl_vars['productsTab']->value == 'active') {?>active<?php }?>" id="2">
                                    <div class="row" style="margin: 0px;">
                                        <div class="col-md-12">
                                            <h3>Select Products</h3>
                                            <form method="post">
                                                <select multiple="multiple" size="10" name="products[]">
                                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['products']->value, 'product');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>   
                                                        <option value="<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
"<?php if (in_array($_smarty_tpl->tpl_vars['product']->value->id,$_smarty_tpl->tpl_vars['selectedProducts']->value)) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['product']->value->name;?>
</option> 
                                                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
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
                                                    <button type="submit" name="addGateways" class="btn col-md-12 <?php if (in_array('paypal',$_smarty_tpl->tpl_vars['selectedGateways']->value)) {?>btn-success disabled<?php } else { ?>btn-default<?php }?>" <?php if (in_array('paypal',$_smarty_tpl->tpl_vars['selectedGateways']->value)) {?> disabled<?php }?> value="paypal">Paypal</button>
                                                </form>
                                            </div>

                                            <div class="col-md-4 text-center">
                                                <form method="post" action="index.php?m=vpnpanel&action=vpnmywebsite">
                                                    <input type="hidden" name="gateway" value="stripe">
                                                    <input type="hidden" name="_capture" value="on">
                                                    <button type="submit" name="addGateways" class="btn col-md-12 <?php if (in_array('stripe',$_smarty_tpl->tpl_vars['selectedGateways']->value)) {?>btn-success disabled<?php } else { ?>btn-default<?php }?>" <?php if (in_array('stripe',$_smarty_tpl->tpl_vars['selectedGateways']->value)) {?> disabled<?php }?> value="stripe">Stripe</button>
                                                </form>
                                            </div>


                                            <div class="col-md-4 text-center">
                                                <form method="post" action="index.php?m=vpnpanel&action=vpnmywebsite">
                                                    <input type="hidden" name="gateway" value="authorize">
                                                    <input type="hidden" name="_capture" value="on">
                                                    <button type="submit" name="addGateways" class="btn col-md-12 <?php if (in_array('authorize',$_smarty_tpl->tpl_vars['selectedGateways']->value)) {?>btn-success disabled<?php } else { ?>btn-default<?php }?>" <?php if (in_array('authorize',$_smarty_tpl->tpl_vars['selectedGateways']->value)) {?> disabled<?php }?> value="authorize">Authorize.net</button>
                                                </form>
                                            </div>

 <!--<input type="hidden" name="gateway" value="<?php echo $_smarty_tpl->tpl_vars['gateway']->value['module'];?>
">
    <button type="submit" name="addGateways" class="btn col-md-12 <?php if (in_array($_smarty_tpl->tpl_vars['gateway']->value['module'],$_smarty_tpl->tpl_vars['selectedGateways']->value)) {?>btn-success disabled<?php } else { ?>btn-default<?php }?>" <?php if (in_array($_smarty_tpl->tpl_vars['gateway']->value['module'],$_smarty_tpl->tpl_vars['selectedGateways']->value)) {?> disabled<?php }?>value="<?php echo $_smarty_tpl->tpl_vars['gateway']->value['displayname'];?>
"><?php echo $_smarty_tpl->tpl_vars['gateway']->value['displayname'];?>
</button>
                                            <?php $_smarty_tpl->_assignInScope('count', $_smarty_tpl->tpl_vars['count']->value+1);?>
                                           </form>
                                           </div>
                                            <!--<?php $_smarty_tpl->_assignInScope('count', 0);?>
                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['gateways']->value, 'gateway');
$_smarty_tpl->tpl_vars['gateway']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['gateway']->value) {
$_smarty_tpl->tpl_vars['gateway']->do_else = false;
?>
                                           
                                             <div class="col-md-4 text-center">
                                            <form method="post">
                                                
                                                <input type="hidden" name="gateway" value="paypal">
                                               <button type="submit" name="addGateways" class="btn col-md-12 <?php if (in_array('paypal',$_smarty_tpl->tpl_vars['selectedGateways']->value)) {?>btn-success disabled<?php } else { ?>btn-default<?php }?>" <?php if (in_array('paypal',$_smarty_tpl->tpl_vars['selectedGateways']->value)) {?> disabled<?php }?>value="paypal">Paypal</button>
                                               
                                               <input type="hidden" name="gateway" value="paypal">
                                               <button type="submit" name="addGateways" class="btn col-md-12 <?php if (in_array('stripe',$_smarty_tpl->tpl_vars['selectedGateways']->value)) {?>btn-success disabled<?php } else { ?>btn-default<?php }?>" <?php if (in_array('stripe',$_smarty_tpl->tpl_vars['selectedGateways']->value)) {?> disabled<?php }?>value="stripe">Stripe</button>
                                           
                                           <input type="hidden" name="gateway" value="<?php echo $_smarty_tpl->tpl_vars['gateway']->value['module'];?>
">
                                               <button type="submit" name="addGateways" class="btn col-md-12 <?php if (in_array($_smarty_tpl->tpl_vars['gateway']->value['module'],$_smarty_tpl->tpl_vars['selectedGateways']->value)) {?>btn-success disabled<?php } else { ?>btn-default<?php }?>" <?php if (in_array($_smarty_tpl->tpl_vars['gateway']->value['module'],$_smarty_tpl->tpl_vars['selectedGateways']->value)) {?> disabled<?php }?>value="<?php echo $_smarty_tpl->tpl_vars['gateway']->value['displayname'];?>
"><?php echo $_smarty_tpl->tpl_vars['gateway']->value['displayname'];?>
</button>
                                                <?php $_smarty_tpl->_assignInScope('count', $_smarty_tpl->tpl_vars['count']->value+1);?>
                                               </form>
                                               </div>
                                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                  </select>-->
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane <?php if ($_smarty_tpl->tpl_vars['gatewayTab']->value == 'active') {?>active<?php }?>" id="4">
                                    <div class="row" style="margin: 0px;">
                                        <div class="col-md-12">
                                            <h3>Manage Existing Gateways</h3>
                                            <?php echo $_smarty_tpl->tpl_vars['paymentDetails']->value;?>


                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane <?php if ($_smarty_tpl->tpl_vars['domain']->value == 'active') {?>active<?php }?>" id="5">
                                    <div class="row" style="margin: 0px;">
                                        <div class="col-md-12">

                                            <h3>Setup Your Domain - <font style="font-size: 15px;">Your Current Domain is <?php echo $_smarty_tpl->tpl_vars['clientData']->value[0]->websiteURL;?>
</font></h3>
                                                <?php if ($_smarty_tpl->tpl_vars['verifyData']->value == '') {?>
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
                                            <?php } else { ?>
                                                <div class="col-md-12 text-center">
                                                    <?php if ($_smarty_tpl->tpl_vars['verifyerror']->value != '') {?><p class="alert alert-danger"><?php echo $_smarty_tpl->tpl_vars['verifyerror']->value;?>
</p><?php }?>

                                                    <?php if ($_smarty_tpl->tpl_vars['verifyData']->value[0]->status == '0') {?>
                                                        <!--<div class="col-md-10 col-md-offset-1 verifyCode">
                                                            <h4>Verification Code</h4>
                                                            <h3><strong><?php echo $_smarty_tpl->tpl_vars['verifyData']->value[0]->verifyCode;?>
</strong></h3>
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
                                                    <?php } else { ?>
                                                        <p class="alert alert-success">Congrats! Your Domain "<?php echo $_smarty_tpl->tpl_vars['clientData']->value[0]->websiteURL;?>
" is Verified Successfully.</p>
                                                    <?php }?>

                                                </div>

                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane <?php if ($_smarty_tpl->tpl_vars['sortprodctTab']->value == 'active') {?>active<?php }?>" id="6">
                                    <div class="row" style="margin: 0px;">
                                        <div class="col-md-12">
                                            <h3>Sort Products</h3>
                                            <?php if ($_smarty_tpl->tpl_vars['SortedProductsIds']->value != '') {?> 
                                            <?php if ($_smarty_tpl->tpl_vars['sortprodctTab']->value == 'active') {?>
                                                <div class="alert alert-success alert-dismissible">
                                                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                  <strong>Success!</strong> Changes saved successfully.
                                                </div>
                                            <?php }?>
                                            <form method="post">
                                                <table id="table-1" cellspacing="0" cellpadding="2">
                                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['SortedProductsIds']->value, 'Name', false, 'Id');
$_smarty_tpl->tpl_vars['Name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['Id']->value => $_smarty_tpl->tpl_vars['Name']->value) {
$_smarty_tpl->tpl_vars['Name']->do_else = false;
?> 
                                                            <tr>
                                                                <td>
                                                                    <input type="hidden" name="sortproducts[]" value="<?php echo $_smarty_tpl->tpl_vars['Id']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['Name']->value;?>
    (<?php echo $_smarty_tpl->tpl_vars['Id']->value;?>
)
                                                                </td>
                                                            </tr>
                                                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                </table>
                                                <p class="text-center" style="margin-top: 20px;"><button class="btn btn-primary" name="SortProducts">Save Changes</button></p>
                                            </form>
                                            <?php } else { ?>
                                            <h4 class="text-center">No product selected</h4>
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane <?php if ($_smarty_tpl->tpl_vars['EmailSettingSectionTab']->value == 'active') {?>active<?php }?>" id="8">
                                    <div class="row" style="margin: 0px;">
                                        <div class="col-md-12">
                                            <h3>VPN Email Setting</h3>
                                            <?php if ($_smarty_tpl->tpl_vars['EmailActionResponse']->value == 'success') {?>
                                                <div class="alert alert-success alert-dismissible">
                                                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                  <strong>Success!</strong> Changes saved successfully.
                                                </div>
                                            <?php }?>
                                            <?php if ($_smarty_tpl->tpl_vars['EmailActionResponse']->value == 'error') {?>
                                                <div class="alert alert-danger alert-dismissible">
                                                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                  <strong>Error!</strong> Unable to save changes.
                                                </div>
                                            <?php }?>
                                            <form method="post">
                                                <textarea rows="20" cols="120" name="resellerEmail">
                                                    <?php echo $_smarty_tpl->tpl_vars['EmailData']->value;?>

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
                                                               <?php if ($_smarty_tpl->tpl_vars['ticket_department']->value == "Sales") {?><br>
                                                               Sales only operates Monday-Friday 9am-5pm<br>
                                                               <?php } else { ?><br>
                                                               Your ticket has been received and will be answered shortly<br>
                                                               <?php }?><br><br>
                                                               <b>Looping through data</b><br>
                                                               A foreach loop can be used to cycle through values like invoice items:<br><br>
                                                               <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['array_data']->value, 'data');
$_smarty_tpl->tpl_vars['data']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
$_smarty_tpl->tpl_vars['data']->do_else = false;
?><br>
                                                               <?php echo $_smarty_tpl->tpl_vars['data']->value['option'];?>
: <?php echo $_smarty_tpl->tpl_vars['data']->value['value'];?>
<br>
                                                               <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
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
            </div> <?php }
}
