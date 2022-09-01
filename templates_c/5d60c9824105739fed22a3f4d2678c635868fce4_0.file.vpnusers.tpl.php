<?php
/* Smarty version 3.1.36, created on 2020-11-19 07:50:04
  from '/var/www/html/modules/addons/vpnpanel/templates/vpnusers.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fb623ace32879_19933751',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5d60c9824105739fed22a3f4d2678c635868fce4' => 
    array (
      0 => '/var/www/html/modules/addons/vpnpanel/templates/vpnusers.tpl',
      1 => 1605080588,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:modules/addons/vpnpanel/templates/nav_header.tpl' => 1,
  ),
),false)) {
function content_5fb623ace32879_19933751 (Smarty_Internal_Template $_smarty_tpl) {
?><link href="modules/addons/vpnpanel/templates/css/swiftmodders.css" rel="stylesheet">
<link href="modules/addons/vpnpanel/templates/css/mystyle.css" rel="stylesheet"> 
<link href="modules/addons/vpnpanel/templates/css/bootstrap-social.css" rel="stylesheet">
<?php echo '<script'; ?>
 type="text/javascript">
    var alreadyReady = false; // The ready function is being called twice on page load.
    jQuery(document).ready(function () {

        jQuery('.addcredits').click(function(){
        	jQuery('.clientid').val($(this).data('clientid'));
            jQuery('.creditholder').show();
        })
        jQuery('.closecredit').click(function(){
            jQuery('.creditholder').hide();
        })

        jQuery('.credits').focusout(function(){
        var totalcredits = <?php echo $_smarty_tpl->tpl_vars['totalcredit']->value;?>
;
        var remainingcredits = '';
        var addcredits = jQuery('.credits').val();
        remainingcredits = totalcredits - parseInt(addcredits);
        if(totalcredits<addcredits)
        {
        alert("You don't have sufficient credits to add.");
        jQuery('.credits').val('0');
        }
        else
        {
        	jQuery('.remainingCredits').val(remainingcredits);
        }
        })




        var table = jQuery("#tableReseller").DataTable({
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
                <h1>Users</h1>
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
                <div class="alert alert-<?php echo $_smarty_tpl->tpl_vars['result']->value;?>
 alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

                </div>
            <?php }?>
            
            <div class="listtable" style="overflow-x: scroll;"> 
                <table id="tableReseller" class="table table-list dataTable no-footer dtr-inline" aria-describedby="tableReseller_info" role="grid">
                    <thead>
                        <tr role="row">
                            <th class="sorting_desc" tabindex="0" aria-controls="tableReseller" rowspan="1" colspan="1" style="width: 0px;" aria-sort="descending">ID</th>
                            <th class="sorting" tabindex="0" aria-controls="tableReseller" rowspan="1" colspan="1"  style="width: 0px;">Name</th> 
                            <th class="sorting_desc" tabindex="0" aria-controls="tableReseller" rowspan="1" colspan="1" style="width: 0px;">Email</th>
                            <th class="sorting_desc" tabindex="0" aria-controls="tableReseller" rowspan="1" colspan="1" style="width: 0px;">Services</th>
                            <th class="sorting_desc" tabindex="0" aria-controls="tableReseller" rowspan="1" colspan="1" style="width: 0px;">Action</th>
                        </tr>
                    </thead>
                    <tbody> 
                    
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['servicedetails']->value, 'details');
$_smarty_tpl->tpl_vars['details']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['details']->value) {
$_smarty_tpl->tpl_vars['details']->do_else = false;
?>
                            <tr> <td align="center"><a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
&action=vpnusersServices&userid=<?php echo $_smarty_tpl->tpl_vars['details']->value['client_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['details']->value['client_id'];?>
</a> </td>
                                <td align="center">
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
&action=vpnusersServices&userid=<?php echo $_smarty_tpl->tpl_vars['details']->value['client_id'];?>
"> 
                                        <?php if ($_smarty_tpl->tpl_vars['details']->value['firstname'] && $_smarty_tpl->tpl_vars['details']->value['lastname'] != '') {?> 
                                            <?php echo $_smarty_tpl->tpl_vars['details']->value['firstname'];?>
 <?php echo $_smarty_tpl->tpl_vars['details']->value['lastname'];?>
 
                                        <?php } elseif ($_smarty_tpl->tpl_vars['details']->value['firstname'] != '' && $_smarty_tpl->tpl_vars['details']->value['lastname'] == '') {?>
                                              <?php echo $_smarty_tpl->tpl_vars['details']->value['firstname'];?>
  
                                        <?php } elseif ($_smarty_tpl->tpl_vars['details']->value['firstname'] == '' && $_smarty_tpl->tpl_vars['details']->value['lastname'] != '') {?>
                                              <?php echo $_smarty_tpl->tpl_vars['details']->value['lastname'];?>
                                             
                                        <?php } else { ?> 
                                            No Name 
                                        <?php }?>
                                    </a> 
                                </td> 
                                <td align="center"><a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
&action=vpnusersServices&userid=<?php echo $_smarty_tpl->tpl_vars['details']->value['client_id'];?>
"> <?php if ($_smarty_tpl->tpl_vars['details']->value['email'] != '') {?> <?php echo $_smarty_tpl->tpl_vars['details']->value['email'];?>
 <?php } else { ?> No Email <?php }?></a> </td>  
                                <td class="text-center text-center1">
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
&action=vpnusersServices&userid=<?php echo $_smarty_tpl->tpl_vars['details']->value['client_id'];?>
" class="btn btn-default btn-primary">
                                        <i class="fa fa-arrow-right"></i>
                                        View Services
                                    </a> </td><td class="text-center text-center1">
                                    <div class="btn-group btn-group-sm" style="width:60px;"> 
                                    <button class="btn btn-success addcredits" data-clientid="<?php echo $_smarty_tpl->tpl_vars['details']->value['client_id'];?>
"><i class="fa fa-money"></i> Give Credits</button> 
                                            
                                    </div></td>
                            </tr> 
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> 
                    </tbody>
                </table> 
                            </div>  
                        </div>
                        <div class="creditholder" style="width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); top: 0px; left: 0px; position: fixed; z-index:99999; display: none;">
                            <div class="col-md-6 col-md-offset-3" style="background: #fff; padding: 15px; top: 100px">
                                <h3>Give Credits</h3>
                                <form method="post" action="">
                                    <input type="hidden" name="clientid" class="clientid">
                                    <input type="hidden" name="remainingCredits" class="remainingCredits">
                                    <table class="table table-bordered">
                                        <tr><th>Credits</th><td><input type="number" name="credits" class="credits"></td></tr>
                                        <tr><th>Description</th><td><textarea name="description" class="description"></textarea></td></tr>
                                    </table>
                                    <center><button class="btn btn-success addCredits" name="addCredits">Add Credits</button> <button type="button" class="btn btn-default closecredit">Close</button> </center>
                                </form>
                            </div>
                        </div>
                    </div> 
                </div>   
                                <?php }
}
