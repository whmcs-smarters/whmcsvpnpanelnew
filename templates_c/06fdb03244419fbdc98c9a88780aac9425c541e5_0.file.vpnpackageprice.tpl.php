<?php
/* Smarty version 3.1.36, created on 2020-11-18 10:09:24
  from '/var/www/html/modules/addons/vpnpanel/templates/vpnpackageprice.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fb4f2d48997f7_27467495',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '06fdb03244419fbdc98c9a88780aac9425c541e5' => 
    array (
      0 => '/var/www/html/modules/addons/vpnpanel/templates/vpnpackageprice.tpl',
      1 => 1605080588,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:modules/addons/vpnpanel/templates/nav_header.tpl' => 1,
  ),
),false)) {
function content_5fb4f2d48997f7_27467495 (Smarty_Internal_Template $_smarty_tpl) {
?><link href="modules/addons/vpnpanel/templates/css/radio.css" rel="stylesheet">   
<link href="modules/addons/vpnpanel/templates/css/swiftmodders.css" rel="stylesheet">
<link href="modules/addons/vpnpanel/templates/css/mystyle.css" rel="stylesheet"> 
<link href="modules/addons/vpnpanel/templates/css/bootstrap-duallistbox.css" rel="stylesheet"> 
<?php echo '<script'; ?>
 src="modules/addons/vpnpanel/templates/js/jquery.bootstrap-duallistbox.js">

<?php echo '</script'; ?>
>

<?php echo '<script'; ?>
>
    $(function () {
        var products = $('select[name="products[]"]').bootstrapDualListbox();
        var gateways = $('select[name="gateways[]"]').bootstrapDualListbox();
    })
<?php echo '</script'; ?>
>
<!-- Register -->

<div class="container" style="width: 100%;margin-top: 20px;"> 
    <?php $_smarty_tpl->_subTemplateRender('file:modules/addons/vpnpanel/templates/nav_header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <div class="sm-content-container">
        <div class="sm-content"> 
            <?php if ($_smarty_tpl->tpl_vars['message']->value != '') {?>
                <div class="alert alert-<?php echo $_smarty_tpl->tpl_vars['result']->value;?>
 alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

                </div>
            <?php }?>

            <div class="sm-page-heading">
                <h1>
                    <i class="fa fa-globe"></i>&nbsp;Package Price
                </h1>
            </div>
            <div class="panel-body">
                <?php if ($_smarty_tpl->tpl_vars['imgmsg']->value != '') {?>
                    <p class='alert alert-info'><?php echo $_smarty_tpl->tpl_vars['imgmsg']->value;?>
</p>
                <?php }?>
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
                                        <?php if ((isset($_GET['productedit']))) {?>
                                        
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
                                                        
                                                        <?php $_smarty_tpl->_assignInScope('val', $_GET['productedit']);?>
                                                        
                                                        <tr>
                                                        <td><?php echo $_smarty_tpl->tpl_vars['productName']->value[$_smarty_tpl->tpl_vars['val']->value];?>
<input type="hidden" name="pid" value="<?php echo $_smarty_tpl->tpl_vars['val']->value;?>
"></td>
                                                        <td><input type="number" min="<?php echo $_smarty_tpl->tpl_vars['priceMonthly_org']->value[$_smarty_tpl->tpl_vars['val']->value];?>
" <?php if ($_smarty_tpl->tpl_vars['priceMonthly_org']->value[$_smarty_tpl->tpl_vars['val']->value] == '-1.00') {?>readonly<?php }?> value="<?php ob_start();
echo $_smarty_tpl->tpl_vars['priceMonthly']->value[$_smarty_tpl->tpl_vars['val']->value];
$_prefixVariable1 = ob_get_clean();
if ($_smarty_tpl->tpl_vars['priceMonthly']->value[$_smarty_tpl->tpl_vars['val']->value] == '' || empty($_prefixVariable1)) {
echo $_smarty_tpl->tpl_vars['priceMonthly_org']->value[$_smarty_tpl->tpl_vars['val']->value];
} else {
echo $_smarty_tpl->tpl_vars['priceMonthly']->value[$_smarty_tpl->tpl_vars['val']->value];
}?>" name="monthly" class="form-control "></td>
                                                        <td><input type="number" min="<?php echo $_smarty_tpl->tpl_vars['priceQuarterly_org']->value[$_smarty_tpl->tpl_vars['val']->value];?>
" <?php if ($_smarty_tpl->tpl_vars['priceQuarterly_org']->value[$_smarty_tpl->tpl_vars['val']->value] == '-1.00') {?>readonly<?php }?> value="<?php if ($_smarty_tpl->tpl_vars['priceMonthly']->value[$_smarty_tpl->tpl_vars['val']->value] == '' || empty($_smarty_tpl->tpl_vars['priceMonthly']->value[$_smarty_tpl->tpl_vars['val']->value])) {
echo $_smarty_tpl->tpl_vars['priceQuarterly_org']->value[$_smarty_tpl->tpl_vars['val']->value];
} else {
echo $_smarty_tpl->tpl_vars['priceQuarterly']->value[$_smarty_tpl->tpl_vars['val']->value];
}?>" name="quarterly" class="form-control"></td>
                                                        <td><input type="number" min="<?php echo $_smarty_tpl->tpl_vars['priceSemiannually_org']->value[$_smarty_tpl->tpl_vars['val']->value];?>
" <?php if ($_smarty_tpl->tpl_vars['priceSemiannually_org']->value[$_smarty_tpl->tpl_vars['val']->value] == '-1.00') {?>readonly<?php }?> value="<?php if ($_smarty_tpl->tpl_vars['priceMonthly']->value[$_smarty_tpl->tpl_vars['val']->value] == '' || empty($_smarty_tpl->tpl_vars['priceMonthly']->value[$_smarty_tpl->tpl_vars['val']->value])) {
echo $_smarty_tpl->tpl_vars['priceSemiannually_org']->value[$_smarty_tpl->tpl_vars['val']->value];
} else {
echo $_smarty_tpl->tpl_vars['priceSemiannually']->value[$_smarty_tpl->tpl_vars['val']->value];
}?>" name="semiannually" class="form-control"></td>
                                                        <td><input type="number" min="<?php echo $_smarty_tpl->tpl_vars['priceAnnually_org']->value[$_smarty_tpl->tpl_vars['val']->value];?>
" <?php if ($_smarty_tpl->tpl_vars['priceAnnually_org']->value[$_smarty_tpl->tpl_vars['val']->value] == '-1.00') {?>readonly<?php }?> value="<?php if ($_smarty_tpl->tpl_vars['priceMonthly']->value[$_smarty_tpl->tpl_vars['val']->value] == '' || empty($_smarty_tpl->tpl_vars['priceMonthly']->value[$_smarty_tpl->tpl_vars['val']->value])) {
echo $_smarty_tpl->tpl_vars['priceAnnually_org']->value[$_smarty_tpl->tpl_vars['val']->value];
} else {
echo $_smarty_tpl->tpl_vars['priceAnnually']->value[$_smarty_tpl->tpl_vars['val']->value];
}?>" name="annually" class="form-control"></td>
                                                        <td><input type="number" min="<?php echo $_smarty_tpl->tpl_vars['priceBiennially_org']->value[$_smarty_tpl->tpl_vars['val']->value];?>
" <?php if ($_smarty_tpl->tpl_vars['priceBiennially_org']->value[$_smarty_tpl->tpl_vars['val']->value] == '-1.00') {?>readonly<?php }?> value="<?php if ($_smarty_tpl->tpl_vars['priceMonthly']->value[$_smarty_tpl->tpl_vars['val']->value] == '' || empty($_smarty_tpl->tpl_vars['priceMonthly']->value[$_smarty_tpl->tpl_vars['val']->value])) {
echo $_smarty_tpl->tpl_vars['priceBiennially_org']->value[$_smarty_tpl->tpl_vars['val']->value];
} else {
echo $_smarty_tpl->tpl_vars['priceBiennially']->value[$_smarty_tpl->tpl_vars['val']->value];
}?>" name="biennially" class="form-control"></td>
                                                        <td><input type="number" min="<?php echo $_smarty_tpl->tpl_vars['priceTriennially_org']->value[$_smarty_tpl->tpl_vars['val']->value];?>
" <?php if ($_smarty_tpl->tpl_vars['priceTriennially_org']->value[$_smarty_tpl->tpl_vars['val']->value] == '-1.00') {?>readonly<?php }?> value="<?php if ($_smarty_tpl->tpl_vars['priceMonthly']->value[$_smarty_tpl->tpl_vars['val']->value] == '' || empty($_smarty_tpl->tpl_vars['priceMonthly']->value[$_smarty_tpl->tpl_vars['val']->value])) {
echo $_smarty_tpl->tpl_vars['priceTriennially_org']->value[$_smarty_tpl->tpl_vars['val']->value];
} else {
echo $_smarty_tpl->tpl_vars['priceTriennially']->value[$_smarty_tpl->tpl_vars['val']->value];
}?>" name="triennially" class="form-control"></td>
                                                        
                                                       
                                                        </tr>
                                                        
                                                       
                                                    </tbody>
                                                        </table>
                                                        
                                                        <button class="btn btn-primary" type="submit" name="updateProduct">Update</button>
                                                    </form>
                                        
                                        <?php } else { ?>
                                           
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
                                                        <?php $_smarty_tpl->_assignInScope('val', 0);?>
                                                        
                                                        
                                                        
                                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['products']->value, 'product');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
                                                        
                                                        
                                                        <!-- $productNew = '';
                                                        if($products neq '')
                                                        {
                                                            $productNew = $products[$val];
                                                        } -->

                                                        <tr>
                                                        <td><?php echo $_smarty_tpl->tpl_vars['productName_org']->value[$_smarty_tpl->tpl_vars['product']->value];?>
</td>
                                                        <td><?php if ($_smarty_tpl->tpl_vars['priceMonthly']->value[$_smarty_tpl->tpl_vars['product']->value] == '-1.00') {?>-<?php } elseif ($_smarty_tpl->tpl_vars['priceMonthly']->value[$_smarty_tpl->tpl_vars['product']->value] == '' || empty($_smarty_tpl->tpl_vars['priceMonthly']->value[$_smarty_tpl->tpl_vars['product']->value])) {
ob_start();
echo $_smarty_tpl->tpl_vars['product']->value;
$_prefixVariable2 = ob_get_clean();
if ($_smarty_tpl->tpl_vars['priceMonthly_org']->value[$_prefixVariable2] == '-1.00') {?>-<?php } else {
ob_start();
echo $_smarty_tpl->tpl_vars['product']->value;
$_prefixVariable3 = ob_get_clean();
echo $_smarty_tpl->tpl_vars['priceMonthly_org']->value[$_prefixVariable3];
}
} else {
ob_start();
echo $_smarty_tpl->tpl_vars['product']->value;
$_prefixVariable4 = ob_get_clean();
echo $_smarty_tpl->tpl_vars['priceMonthly']->value[$_prefixVariable4];
}?></td>
                                                        
                                                        <td><?php if ($_smarty_tpl->tpl_vars['priceQuarterly']->value[$_smarty_tpl->tpl_vars['product']->value] == '-1.00') {?>-<?php } else {
ob_start();
echo $_smarty_tpl->tpl_vars['product']->value;
$_prefixVariable5 = ob_get_clean();
if ($_smarty_tpl->tpl_vars['priceQuarterly']->value[$_smarty_tpl->tpl_vars['product']->value] == '' || empty($_smarty_tpl->tpl_vars['priceQuarterly']->value[$_prefixVariable5])) {
ob_start();
echo $_smarty_tpl->tpl_vars['product']->value;
$_prefixVariable6 = ob_get_clean();
if ($_smarty_tpl->tpl_vars['priceQuarterly_org']->value[$_prefixVariable6] == '-1.00') {?>-<?php } else {
ob_start();
echo $_smarty_tpl->tpl_vars['product']->value;
$_prefixVariable7 = ob_get_clean();
echo $_smarty_tpl->tpl_vars['priceQuarterly_org']->value[$_prefixVariable7];
}
} else {
ob_start();
echo $_smarty_tpl->tpl_vars['product']->value;
$_prefixVariable8 = ob_get_clean();
echo $_smarty_tpl->tpl_vars['priceQuarterly']->value[$_prefixVariable8];
}}?></td>
                                                        
                                                        <td><?php if ($_smarty_tpl->tpl_vars['priceSemiannually']->value[$_smarty_tpl->tpl_vars['product']->value] == '-1.00') {?>-<?php } elseif ($_smarty_tpl->tpl_vars['priceSemiannually']->value[$_smarty_tpl->tpl_vars['product']->value] == '' || empty($_smarty_tpl->tpl_vars['priceSemiannually']->value[$_smarty_tpl->tpl_vars['product']->value])) {
if ($_smarty_tpl->tpl_vars['priceSemiannually_org']->value[$_smarty_tpl->tpl_vars['product']->value] == '-1.00') {?>-<?php } else {
echo $_smarty_tpl->tpl_vars['priceSemiannually_org']->value[$_smarty_tpl->tpl_vars['product']->value];
}
} else {
echo $_smarty_tpl->tpl_vars['priceSemiannually']->value[$_smarty_tpl->tpl_vars['product']->value];
}?></td>
                                                        
                                                        <td><?php if ($_smarty_tpl->tpl_vars['priceAnnually']->value[$_smarty_tpl->tpl_vars['product']->value] == '-1.00') {?>-<?php } elseif ($_smarty_tpl->tpl_vars['priceAnnually']->value[$_smarty_tpl->tpl_vars['product']->value] == '' || empty($_smarty_tpl->tpl_vars['priceAnnually']->value[$_smarty_tpl->tpl_vars['product']->value])) {
if ($_smarty_tpl->tpl_vars['priceAnnually_org']->value[$_smarty_tpl->tpl_vars['product']->value] == '-1.00') {?>-<?php } else {
echo $_smarty_tpl->tpl_vars['priceAnnually_org']->value[$_smarty_tpl->tpl_vars['product']->value];
}
} else {
echo $_smarty_tpl->tpl_vars['priceAnnually']->value[$_smarty_tpl->tpl_vars['product']->value];
}?></td>
                                                        
                                                       <td><?php if ($_smarty_tpl->tpl_vars['priceBiennially']->value[$_smarty_tpl->tpl_vars['product']->value] == '-1.00') {?>-<?php } elseif ($_smarty_tpl->tpl_vars['priceBiennially']->value[$_smarty_tpl->tpl_vars['product']->value] == '' || empty($_smarty_tpl->tpl_vars['priceBiennially']->value[$_smarty_tpl->tpl_vars['product']->value])) {
if ($_smarty_tpl->tpl_vars['priceBiennially_org']->value[$_smarty_tpl->tpl_vars['product']->value] == '-1.00') {?>-<?php } else {
echo $_smarty_tpl->tpl_vars['priceBiennially_org']->value[$_smarty_tpl->tpl_vars['product']->value];
}
} else {
echo $_smarty_tpl->tpl_vars['priceBiennially']->value[$_smarty_tpl->tpl_vars['product']->value];
}?></td>
                                                        
                                                        <td><?php if ($_smarty_tpl->tpl_vars['priceTriennially']->value[$_smarty_tpl->tpl_vars['product']->value] == '-1.00') {?>-<?php } elseif ($_smarty_tpl->tpl_vars['priceTriennially']->value[$_smarty_tpl->tpl_vars['product']->value] == '' || empty($_smarty_tpl->tpl_vars['priceTriennially']->value[$_smarty_tpl->tpl_vars['product']->value])) {
if ($_smarty_tpl->tpl_vars['priceTriennially_org']->value[$_smarty_tpl->tpl_vars['product']->value] == '-1.00') {?>-<?php } else {
echo $_smarty_tpl->tpl_vars['priceTriennially_org']->value[$_smarty_tpl->tpl_vars['product']->value];
}
} else {
echo $_smarty_tpl->tpl_vars['priceTriennially']->value[$_smarty_tpl->tpl_vars['product']->value];
}?></td>
                                                         
                                                        <td>
                                                       
                                                        <a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
&productedit=<?php echo $_smarty_tpl->tpl_vars['product']->value;?>
" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                                        
                                                        </td>
                                                        </tr>
                                                        <?php $_smarty_tpl->_assignInScope('val', $_smarty_tpl->tpl_vars['product']->value+1);?>
                                                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                    </tbody>
                                                        </table>
                                                        
                                                    
                                                    <?php }?>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                


                            </div>
                        </div>
                    </div>

                </div>
            </div> <?php }
}
