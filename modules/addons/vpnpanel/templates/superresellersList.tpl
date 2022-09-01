<div class="row">
    <div class="col-md-12"><nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                {$breadcrumb}
            </ol>
        </nav></div>
    <div class="col-md-8"><h2>Super Resellers List</h2>
        <h5>Here , You can see the list of all super resellers created by Admin.</h5>
    </div><div class="col-md-4"><button class="btn btn-primary pull-right" id="addserverbtn1"><i class="fa fa-plus"></i> Assign Packages to Super Reseller Group</button>
    </div>
    <div class="col-md-12">  
        <!--button class="btn btn-warning pull-right" id="reloadserverbtn"><i class="fa fa-refresh"></i> Reload Server List</button-->
        <div class="message" style="float: left; width: 100%;">{$message}</div>
        <table class="table table-bordered table-striped datatable">
            <thead>
                <tr><th width="10">ID.</th><th width="20">Name</th><th width="20">Email</th><th width="30">Assigned packages</th><th width="20">Actions</th></tr>
            </thead>
            <tbody>
                {foreach item=$data from=$affdata}
                {if $data.groupid eq {$groupid}}
                    <tr><td><a href="clientssummary.php?userid={$data.clientid}" target="_blank">{$data.clientid}</a></td> 
                        <td><a href="clientssummary.php?userid={$data.clientid}" target="_blank">{$data.firstname} {$data.lastname}</a></td>
                        <td><a href="mailto:{$data.email}" target="_blank">{$data.email}</a></td> 
                        <td>{$packageassing{$data.clientid}}</td>
                        <td><a href="{$modulelink}&action=vpn_listusers&affid={$data.affid}" class="btn btn-info">View Users</a>
                            <button class="btn btn-success" onclick="addservermodal({$data.clientid});"><i class="fa fa-plus"></i> Assign Packages</button></td></tr>
                {/if}

                <div class="modal fade" id="addServerModal{$data.clientid}" tabindex="-1" role="dialog" aria-labelledby="Assign Packages" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Assign Packages to {$data.firstname} {$data.lastname}</h5>
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
                                                <input type="hidden"  name="reseller" value="{$data.clientid}"> 
                                            </div>
                                            <small style="display: none;" class="help-block" data-fv-validator="notEmpty" data-fv-for="server_name" data-fv-result="NOT_VALIDATED"></small><small style="display: none;" class="help-block" data-fv-validator="stringLength" data-fv-for="server_name" data-fv-result="NOT_VALIDATED"></small></div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group control-group col-md-12">
                                            <label style="width: 100%;"><input type="checkbox" class="selectall" value="all">Select All</label>
                                                {foreach item=productgroup key=group from=$productsListarray}
                                                <label style="background:#ccc; width: 100%; padding: 2px 7px;">{$group}</label>
                                                {foreach item=product from=$productgroup}
                                                {if $data.groupid eq {$groupid}}
                                                    <label style="width: 100%;"><input type="checkbox" class="all {$data.clientid}" value="{$product.id}">{$product.name}</label>
                                                {/if}
                                                    {/foreach}
                                                {/foreach}

                                            <small style="display: none;" class="help-block" data-fv-validator="notEmpty" data-fv-for="server_name" data-fv-result="NOT_VALIDATED"></small><small style="display: none;" class="help-block" data-fv-validator="stringLength" data-fv-for="server_name" data-fv-result="NOT_VALIDATED"></small></div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button class="btn btn-primary assignPackageBtn" onclick="addassignpack({$data.clientid});" type="button" >Save changes <i class="fa fa-spin fa-spinner loading" style="display: none;"></i></button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            {/foreach}
            </tbody>
        </table> 

    <h4 style="float: left;">Assign Packages to Super Reseller Group</h4> 
    <table class="table table-bordered table-striped" style="margin-top: 10px;">
        <thead><tr><th>Super Reseller</th> <th>Package IDs</th><th>Action</th></tr></thead>
        <tbody id="serverslist">
            {$allpackagesdata}
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
                                    <label class="control-label input-group-addon" for="appname1">Super Resellers</label>
                                    <select class="form-control" name="reseller" id="reseller">
                                        <option value="all" selected>All Resellers</option>
                                        {foreach item=reseller from=$resellers}
                                            <option value="{$reseller.clientid}">{$reseller.firstname} {$reseller.lastname}</option>
                                        {/foreach}</select>
                                </div>
                                <small style="display: none;" class="help-block" data-fv-validator="notEmpty" data-fv-for="server_name" data-fv-result="NOT_VALIDATED"></small><small style="display: none;" class="help-block" data-fv-validator="stringLength" data-fv-for="server_name" data-fv-result="NOT_VALIDATED"></small></div>
                        </div> 
                        <div class="row">
                            <div class="form-group control-group col-md-12">
                                <label style="width: 100%;"><input type="checkbox" class="selectall" value="all">Select All</label>
                                    {foreach item=productgroup key=group from=$productsListarray}
                                    <label style="background:#ccc; width: 100%; padding: 2px 7px;">{$group}</label>
                                    {foreach item=product from=$productgroup}
                                        <label style="width: 100%;"><input type="checkbox"  class="all" value="{$product.id}">{$product.name}</label>
                                        {/foreach}
                                    {/foreach}

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
        <a href="{$modulelink}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Go Back</a>
        </div>
    </div>
    {literal} 
        <script>
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
                var groupid = {/literal}{$groupid}{literal};
                
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
        </script>

    {/literal}