<?php
/* Smarty version 3.1.36, created on 2022-08-26 10:27:58
  from '/var/www/html/billing/modules/addons/vpnpanel/templates/resellersList.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_6308a02eeffd36_40963059',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a3d7f8efda470d92ab233ec8e618120ea015e65a' => 
    array (
      0 => '/var/www/html/billing/modules/addons/vpnpanel/templates/resellersList.tpl',
      1 => 1661502792,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6308a02eeffd36_40963059 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="row">
    <div class="col-md-12"><nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <?php echo $_smarty_tpl->tpl_vars['breadcrumb']->value;?>

            </ol>
        </nav></div>
    <div class="col-md-8"><h2>Resellers List</h2>
        <h5>Here , You can see the list of all resellers created by Admin.</h5>
    </div><div class="col-md-4"><button class="btn btn-primary pull-right" id="addserverbtn1"><i class="fa fa-plus"></i> Assign Packages to Reseller Group</button>
    </div>
    <div class="col-md-12">  
        <!--button class="btn btn-warning pull-right" id="reloadserverbtn"><i class="fa fa-refresh"></i> Reload Server List</button-->
        <div class="message" style="float: left; width: 100%;"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</div>
        <table class="table table-bordered table-striped datatable">
            <thead>
                <tr><th width="10">ID.</th><th width="20">Name</th><th width="20">Email</th><th width="30">Assigned packages</th><th width="20">Actions</th></tr>
            </thead>
            <tbody>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['affdata']->value, 'data');
$_smarty_tpl->tpl_vars['data']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
$_smarty_tpl->tpl_vars['data']->do_else = false;
?>
                <?php ob_start();
echo $_smarty_tpl->tpl_vars['groupid']->value;
$_prefixVariable1 = ob_get_clean();
if ($_smarty_tpl->tpl_vars['data']->value['groupid'] == $_prefixVariable1) {?>
                    <tr><td><a href="clientssummary.php?userid=<?php echo $_smarty_tpl->tpl_vars['data']->value['clientid'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['data']->value['clientid'];?>
</a></td> 
                        <td><a href="clientssummary.php?userid=<?php echo $_smarty_tpl->tpl_vars['data']->value['clientid'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['data']->value['firstname'];?>
 <?php echo $_smarty_tpl->tpl_vars['data']->value['lastname'];?>
</a></td>
                        <td><a href="mailto:<?php echo $_smarty_tpl->tpl_vars['data']->value['email'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['data']->value['email'];?>
</a></td> 
                        <td><?php echo $_smarty_tpl->tpl_vars['packageassing'.($_smarty_tpl->tpl_vars['data']->value['clientid'])]->value;?>
</td>
                        <td><a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
&action=vpn_listusers&affid=<?php echo $_smarty_tpl->tpl_vars['data']->value['affid'];?>
" class="btn btn-info">View Users</a>
                            <button class="btn btn-success" onclick="addservermodal(<?php echo $_smarty_tpl->tpl_vars['data']->value['clientid'];?>
);"><i class="fa fa-plus"></i> Assign Packages</button></td></tr>
                <?php }?>

                <div class="modal fade" id="addServerModal<?php echo $_smarty_tpl->tpl_vars['data']->value['clientid'];?>
" tabindex="-1" role="dialog" aria-labelledby="Assign Packages" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Assign Packages to <?php echo $_smarty_tpl->tpl_vars['data']->value['firstname'];?>
 <?php echo $_smarty_tpl->tpl_vars['data']->value['lastname'];?>
</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="server_frm1" name="server_frm" novalidate="novalidate" method="post" action="" class="fv-form fv-form-bootstrap">
                                <div class="modal-body">
                                    <button type="submit" class="fv-hidden-submit" style="display: none; width: 0px; height: 0px;"></button>

                                    <div class="row">
                                        <div class="form-group control-group col-md-12">
                                            <div class="controls input-group"> 
                                                <input type="hidden"  name="reseller" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['clientid'];?>
"> 
                                            </div>
                                            <small style="display: none;" class="help-block" data-fv-validator="notEmpty" data-fv-for="server_name" data-fv-result="NOT_VALIDATED"></small><small style="display: none;" class="help-block" data-fv-validator="stringLength" data-fv-for="server_name" data-fv-result="NOT_VALIDATED"></small></div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group control-group col-md-12">
                                            <label style="width: 100%;"><input type="checkbox" class="selectall" value="all">Select All</label>
                                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['productsListarray']->value, 'productgroup', false, 'group');
$_smarty_tpl->tpl_vars['productgroup']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['group']->value => $_smarty_tpl->tpl_vars['productgroup']->value) {
$_smarty_tpl->tpl_vars['productgroup']->do_else = false;
?>
                                                <label style="background:#ccc; width: 100%; padding: 2px 7px;"><?php echo $_smarty_tpl->tpl_vars['group']->value;?>
</label>
                                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['productgroup']->value, 'product');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
                                                <?php ob_start();
echo $_smarty_tpl->tpl_vars['groupid']->value;
$_prefixVariable2 = ob_get_clean();
if ($_smarty_tpl->tpl_vars['data']->value['groupid'] == $_prefixVariable2) {?>
                                                    <label style="width: 100%;"><input type="checkbox" class="all <?php echo $_smarty_tpl->tpl_vars['data']->value['clientid'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['product']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
</label>
                                                <?php }?>
                                                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

                                            <small style="display: none;" class="help-block" data-fv-validator="notEmpty" data-fv-for="server_name" data-fv-result="NOT_VALIDATED"></small><small style="display: none;" class="help-block" data-fv-validator="stringLength" data-fv-for="server_name" data-fv-result="NOT_VALIDATED"></small></div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button class="btn btn-primary assignPackageBtn" onclick="addassignpack(<?php echo $_smarty_tpl->tpl_vars['data']->value['clientid'];?>
);" type="button" >Save changes <i class="fa fa-spin fa-spinner loading" style="display: none;"></i></button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </tbody>
        </table> 

    <h4 style="float: left;">Assign Packages to Reseller Group</h4> 
    <table class="table table-bordered table-striped" style="margin-top: 10px;">
        <thead><tr><th>Reseller</th> <th>Package IDs</th><th>Action</th></tr></thead>
        <tbody id="serverslist">
            <?php echo $_smarty_tpl->tpl_vars['allpackagesdata']->value;?>

        </tbody>
    </table>
    <div class="modal fade" id="addServerModal" tabindex="-1" role="dialog" aria-labelledby="Assign Packages" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Assign Packages</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="server_frm1" name="server_frm" novalidate="novalidate" method="post" action="" class="fv-form fv-form-bootstrap">
                    <div class="modal-body">
                        <button type="submit" class="fv-hidden-submit" style="display: none; width: 0px; height: 0px;"></button>

                        <div class="row">
                            <div class="form-group control-group col-md-12">
                                <div class="controls input-group">
                                    <label class="control-label input-group-addon" for="appname1">Resellers</label>
                                    <select class="form-control" name="reseller" id="reseller">
                                        <option value="all" selected>All Resellers</option>
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['resellers']->value, 'reseller');
$_smarty_tpl->tpl_vars['reseller']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['reseller']->value) {
$_smarty_tpl->tpl_vars['reseller']->do_else = false;
?>
                                            <option value="<?php echo $_smarty_tpl->tpl_vars['reseller']->value['clientid'];?>
"><?php echo $_smarty_tpl->tpl_vars['reseller']->value['firstname'];?>
 <?php echo $_smarty_tpl->tpl_vars['reseller']->value['lastname'];?>
</option>
                                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select>
                                </div>
                                <small style="display: none;" class="help-block" data-fv-validator="notEmpty" data-fv-for="server_name" data-fv-result="NOT_VALIDATED"></small><small style="display: none;" class="help-block" data-fv-validator="stringLength" data-fv-for="server_name" data-fv-result="NOT_VALIDATED"></small></div>
                        </div> 
                        <div class="row">
                            <div class="form-group control-group col-md-12">
                                <label style="width: 100%;"><input type="checkbox" class="selectall" value="all">Select All</label>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['productsListarray']->value, 'productgroup', false, 'group');
$_smarty_tpl->tpl_vars['productgroup']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['group']->value => $_smarty_tpl->tpl_vars['productgroup']->value) {
$_smarty_tpl->tpl_vars['productgroup']->do_else = false;
?>
                                    <label style="background:#ccc; width: 100%; padding: 2px 7px;"><?php echo $_smarty_tpl->tpl_vars['group']->value;?>
</label>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['productgroup']->value, 'product');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
                                        <label style="width: 100%;"><input type="checkbox"  class="all" value="<?php echo $_smarty_tpl->tpl_vars['product']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
</label>
                                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

                                <small style="display: none;" class="help-block" data-fv-validator="notEmpty" data-fv-for="server_name" data-fv-result="NOT_VALIDATED"></small><small style="display: none;" class="help-block" data-fv-validator="stringLength" data-fv-for="server_name" data-fv-result="NOT_VALIDATED"></small></div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" onclick="addassignpack('all');" type="button" >Save changes <i class="fa fa-spin fa-spinner loading" style="display: none;"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
        <a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Go Back</a>
        </div>
    </div>
     
        <?php echo '<script'; ?>
>
            $('.editbtn').click(function () {
                var rid = $(this).data('id');
                editservermodal(rid);
            })
            function addservermodal(id)
            {
               // $('.all').prop('checked', '');
                $('#reseller').removeAttr('disabled');
                /*$('#reseller').children('option').each(function () {
                    $(this).attr('selected', '');
                })*/ $.ajax({
                    type: 'POST',
                    //url: "addonmodules.php?module=vpnpanel&action=vpn_assignPackages",
                    data: {editassignpack: true, id: id},
                    dataType: "text",
                    success: function (resultData) {
                        $('#reseller').children('option').each(function () {
                                if ($(this).val() == id)
                                {
                                    $(this).attr('selected', 'selected');
                                } else
                                {
                                    $(this).removeAttr('selected');
                                }
                            })
                        if (resultData == '[]')
                        {
                         $(document).find('#addServerModal'+id).modal('show');
                        } else
                        {
                         resultData = $.parseJSON(resultData);
                            var reseller = resultData.id;
                            var assignedpackages = resultData.products;
                            var singlepackage = assignedpackages.split(',');
                            
                            for (var i = 0; i < singlepackage.length; i++)
                            {
                                $('.all').each(function () {
                                    if ($(this).val() == singlepackage[i])
                                    {
                                        $(this).prop('checked', 'checked');
                                    }
                                    
                                })

                            }
                            $(document).find('#addServerModal'+id).modal('show');
                        }
                    }
                })
                
               
            }
            $('.selectall').click(function () {
                if ($(this).prop('checked'))
                {
                    $('.all').prop('checked', 'checked');
                } else
                {
                    $('.all').prop('checked', '');
                }
            })

            function addassignpack(resellerid)
            {
                
                var packages = '';
                var groupid = <?php echo $_smarty_tpl->tpl_vars['groupid']->value;?>
;
                
                $(document).find('.assignPackageBtn').children('.loading').show();
                if (resellerid == 'all') {
                    $(document).find('#addServerModal .all').each(function () {
                        if ($(this).prop('checked'))
                        {
                            packages = $(this).val() + ',' + packages;
                        }
                    });
                } else {
                    $(document).find('.' + resellerid).each(function () {
                        if ($(this).prop('checked'))
                        {
                            packages = $(this).val() + ',' + packages;
                        }
                    });
                }
                $.ajax({
                    type: "POST",
                    crossDomain: true,
                    data: {addassignpack: true, assigngroup: groupid, reseller: resellerid, packages: packages},
                    dataType: "text",
                    success: function (resultData) {
                        $(document).find('.assignPackageBtn').children('.loading').hide();
                        if (resultData == 'success')
                        {
                            swal("Success!", "Package Assigned Successfully!", "success");
                            window.location.replace('addonmodules.php?module=vpnpanel&action=vpn_resellers');
                        } else
                        {
                            swal("Error!", "Package Assign Failed!", "danger");
                            $(document).find('#addServerModal').modal('hide');
                            //window.location.replace('addonmodules.php?module=vpnpanel&action=vpn_applinks');
                        }
                    }
                });
            }
            function editservermodal(rid)
            {
                $.ajax({
                    type: 'POST',
                    //url: "addonmodules.php?module=vpnpanel&action=vpn_assignPackages",
                    data: {editassignpack: true, id: rid},
                    dataType: "text",
                    success: function (resultData) {
                        if (resultData == '[]')
                        {
                            $(document).find('#addServerModal').modal('show');
                        } else
                        {
                            resultData = $.parseJSON(resultData);
                            var reseller = resultData.resellerid;
                            var assignedpackages = resultData.products;
                            var singlepackage = assignedpackages.split(',');
                            //console.log(assignedpackages); return;
                            $('#reseller').attr('disabled', 'disabled');
                            $('.all').prop('checked', '');
                            $('#reseller').children('option').each(function () {
                                if ($(this).val() == reseller)
                                {
                                    $(this).attr('selected', 'selected');
                                } else
                                {
                                    $(this).removeAttr('selected');
                                }
                            })
                            for (var i = 0; i < singlepackage.length; i++)
                            {
                                $('.all').each(function () {
                                    if ($(this).val() == singlepackage[i])
                                    {
                                        $(this).prop('checked', 'checked');
                                    }
                                })

                            }
                            $('.modal-title').text('Edit Packages');
                            $(document).find('#addServerModal').modal('show');
                        }

                    }
                });

            }
            $('#addserverbtn1').click(function () {
                var rid = 'all';
                editservermodal(rid);
            })
        <?php echo '</script'; ?>
>

    <?php }
}
