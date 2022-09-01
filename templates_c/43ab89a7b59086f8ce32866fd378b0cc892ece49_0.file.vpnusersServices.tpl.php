<?php
/* Smarty version 3.1.36, created on 2020-11-19 10:44:13
  from '/var/www/html/modules/addons/vpnpanel/templates/vpnusersServices.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fb64c7d0dc549_44127448',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '43ab89a7b59086f8ce32866fd378b0cc892ece49' => 
    array (
      0 => '/var/www/html/modules/addons/vpnpanel/templates/vpnusersServices.tpl',
      1 => 1605080588,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:modules/addons/vpnpanel/templates/nav_header.tpl' => 1,
  ),
),false)) {
function content_5fb64c7d0dc549_44127448 (Smarty_Internal_Template $_smarty_tpl) {
?><link href="modules/addons/vpnpanel/templates/css/swiftmodders.css" rel="stylesheet">
<link href="modules/addons/vpnpanel/templates/css/mystyle.css" rel="stylesheet"> 
<link href="modules/addons/vpnpanel/templates/css/bootstrap-social.css" rel="stylesheet">
<?php echo '<script'; ?>
 type="text/javascript">
    var alreadyReady = false; // The ready function is being called twice on page load.
    jQuery(document).ready(function () {
        
        var table = jQuery("#vpnservices").DataTable({
            "dom": '<"listtable"fit>pl', "responsive": true,
            "oLanguage": {
                "sEmptyTable": "No Records Found",
                "sInfo": "Showing _START_ to _END_ of _TOTAL_ entries",
                "sInfoEmpty": "Showing 0 to 0 of 0 entries",
                "sInfoFiltered": "(filtered from _MAX_ total entries)",
                "sInfoPostFix": "",
                "sInfoThousands": ",",
                "sLengthMenu": "Show _MENU_ entries",
                "sLoadingRecords": "Loading...",
                "sProcessing": "Processing...",
                "sSearch": "",
                "sZeroRecords": "No Records Found",
                "oPaginate": {
                    "sFirst": "First",
                    "sLast": "Last",
                    "sNext": "Next",
                    "sPrevious": "Previous"
                }
            },
            "pageLength": 10,
            "order": [
                [0, "asc"]
            ],
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ], "stateSave": true
        });
        jQuery(".dataTables_filter input").attr("placeholder", "Enter search term...");

        // highlight remembered filter on page re-load
        var rememberedFilterTerm = table.state().columns[3].search.search;
        if (rememberedFilterTerm && !alreadyReady) {
            // This should only run on the first "ready" event.
            jQuery(".view-filter-btns a span").each(function (index) {
                if (jQuery(this).text().trim() == rememberedFilterTerm.replace(/\\|s\*/g, '')) {
                    jQuery(this).parent('a').addClass('active');
                    jQuery(this).parent('a').find('i').switchClass('fa-circle-o', 'fa-dot-circle-o', 0);
                }
            });
        }
        alreadyReady = true;
    });
<?php echo '</script'; ?>
> 

<div class="container"  style="width: 100%;margin-top: 20px;"> 
    <?php $_smarty_tpl->_subTemplateRender('file:modules/addons/vpnpanel/templates/nav_header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <div class="sm-content-container">
        <div class="sm-content">
            <div class="sm-page-heading">
                <h1>Services</h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="index.php"> Portal Home
                        </a>        </li>
                    <li class="active">
                        Dashboard
                    </li>
                </ol>
            </div> 
             <?php if ($_smarty_tpl->tpl_vars['result']->value != '') {?>
            <?php if ($_smarty_tpl->tpl_vars['result']->value == 'success') {?>
                <div class="alert alert-<?php echo $_smarty_tpl->tpl_vars['result']->value;?>
 alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <p><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</p>
                </div>
                <?php } else { ?>
                <div class="alert alert-warning alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <p><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</p>
                </div>
            <?php }?>
            <?php }?>
            <div class="listtable" style="overflow-x: scroll;"> 
                <table id="vpnservices" class="table table-list dataTable no-footer dtr-inline" aria-describedby="vpnservices_info" role="grid">
                    <thead>
                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="vpnservices" rowspan="1" colspan="1" style="width: 0px;" aria-sort="ascending">Product/Service</th>
                            <th class="sorting_asc" tabindex="0" aria-controls="vpnservices" rowspan="1" colspan="1" style="width: 0px;" aria-sort="ascending">Name</th>
                            <th class="sorting" tabindex="0" aria-controls="vpnservices" rowspan="1" colspan="1"  style="width: 0px;">VPN Username</th>  
                            <th class="sorting" tabindex="0" aria-controls="vpnservices" rowspan="1" colspan="1"  style="width: 0px;">VPN Password</th>    
                            <th class="sorting_asc" tabindex="0" aria-controls="vpnservices" rowspan="1" colspan="1" style="width: 0px;">Next Due Date</th>
                            <th class="sorting_asc" tabindex="0" aria-controls="vpnservices" rowspan="1" colspan="1" style="width: 0px;">Status</th>
                            
                            <th class="sorting_asc" tabindex="0" aria-controls="vpnservices" rowspan="1" colspan="1" style="width: 0px;">Action</th>
                    </tr>
                </thead>
                <tbody>  
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['servicedetails']->value, 'service');
$_smarty_tpl->tpl_vars['service']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['service']->value) {
$_smarty_tpl->tpl_vars['service']->do_else = false;
?> 
                        <tr> 
                            <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['service']->value['name'];?>
 </td>
                            <td class="text-center"><?php ob_start();
echo $_smarty_tpl->tpl_vars['service']->value['firstname'];
$_prefixVariable1 = ob_get_clean();
ob_start();
echo $_smarty_tpl->tpl_vars['service']->value['lastname'];
$_prefixVariable2 = ob_get_clean();
if ($_prefixVariable1 == '' && $_prefixVariable2 == '') {?>No Name<?php } else {
echo $_smarty_tpl->tpl_vars['service']->value['firstname'];?>
 <?php echo $_smarty_tpl->tpl_vars['service']->value['lastname'];
}?></td>
                            <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['service']->value['username'];?>
</td> 
                            <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['service']->value['password'];?>
</td>
                            <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['service']->value['nextduedate'];?>
</td>
                            <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['service']->value['status'];?>
</td>
                            <td><div class="btn-group" role="group">
    <button id="btnGroupDrop1" type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Actions <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="left: -90px;">
      <?php ob_start();
echo $_smarty_tpl->tpl_vars['service']->value['rawstatus'];
$_prefixVariable3 = ob_get_clean();
if ($_prefixVariable3 == "Active") {?><form method="post"><button class="dropdown-item btn text-danger btn-xs" name="terminateservice" style="width: 100%; border-bottom: solid 1px #efefef;"><i class="fa fa-remove"></i> Terminate</button><input type="hidden" name="serviceID" value="<?php echo $_smarty_tpl->tpl_vars['service']->value['service_id'];?>
"></form><?php }?>
      
      <?php ob_start();
echo $_smarty_tpl->tpl_vars['service']->value['rawstatus'];
$_prefixVariable4 = ob_get_clean();
if ($_prefixVariable4 == "Terminated") {?>
      <form method="post"><button class="dropdown-item btn text-success btn-xs" name="createservice" style="width: 100%; border-bottom: solid 1px #efefef;"><i class="fa fa-plus-circle"></i> Create</button><input type="hidden" name="serviceID" value="<?php echo $_smarty_tpl->tpl_vars['service']->value['service_id'];?>
"></form><?php }?>
      <!-- <?php ob_start();
echo $_smarty_tpl->tpl_vars['service']->value['rawstatus'];
$_prefixVariable5 = ob_get_clean();
if ($_prefixVariable5 == "Active") {?><a class="dropdown-item btn text-success btn-xs" href="#" style="width: 100%; border-bottom: solid 1px #efefef;"><i class="fa fa-arrow-up"></i> Upgrade</a><?php }?> -->
      <?php ob_start();
echo $_smarty_tpl->tpl_vars['service']->value['rawstatus'];
$_prefixVariable6 = ob_get_clean();
if ($_prefixVariable6 == "Active") {?><form method="post"><button class="dropdown-item btn text-warning btn-xs"  name="suspendservice" style="width: 100%; border-bottom: solid 1px #efefef;"><i class="fa fa-ban"></i> Suspend</button><input type="hidden" name="serviceID" value="<?php echo $_smarty_tpl->tpl_vars['service']->value['service_id'];?>
"></form><?php }?>
      <?php ob_start();
echo $_smarty_tpl->tpl_vars['service']->value['rawstatus'];
$_prefixVariable7 = ob_get_clean();
if ($_prefixVariable7 == "Suspended") {?><form method="post"><button class="dropdown-item btn text-success btn-xs"  name="unsuspendservice" style="width: 100%; border-bottom: solid 1px #efefef;"><i class="fa fa-check"></i> Unsuspend</button><input type="hidden" name="serviceID" value="<?php echo $_smarty_tpl->tpl_vars['service']->value['service_id'];?>
"></form><?php }?>
      <form method="post"><button class="dropdown-item btn text-success btn-xs"  name="renewservice" style="width: 100%; border-bottom: solid 1px #efefef;"><i class="fa fa-check"></i> Renew</button><input type="hidden" name="serviceID" value="<?php echo $_smarty_tpl->tpl_vars['service']->value['service_id'];?>
"><input type="hidden" name="username" value="<?php echo $_smarty_tpl->tpl_vars['service']->value['username'];?>
"><input type="hidden" name="resellerid" value="<?php echo $_smarty_tpl->tpl_vars['service']->value['productid'];?>
"></form>
    </div>
  </div></td>
                        </tr>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> 
                                    </tbody>
                                </table> 
                               
                        </div>
                    </div> 
                </div>
<?php }
}
