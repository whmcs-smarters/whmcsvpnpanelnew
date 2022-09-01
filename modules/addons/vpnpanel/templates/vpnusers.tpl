<link href="modules/addons/vpnpanel/templates/css/swiftmodders.css" rel="stylesheet">
<link href="modules/addons/vpnpanel/templates/css/mystyle.css" rel="stylesheet"> 
<link href="modules/addons/vpnpanel/templates/css/bootstrap-social.css" rel="stylesheet">
<script type="text/javascript">
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
        var totalcredits = {$totalcredit};
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
</script> 

<div class="container"  style="width: 100%;margin-top: 20px;"> 
    {include file='modules/addons/vpnpanel/templates/nav_header.tpl'}
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
            {if $result!=''}
                <div class="alert alert-{$result} alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {$message}
                </div>
            {/if}
            
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
                    
                        {foreach from=$servicedetails item=details}
                            <tr> <td align="center"><a href="{$modulelink}&action=vpnusersServices&userid={$details.client_id}">{$details.client_id}</a> </td>
                                <td align="center">
                                    <a href="{$modulelink}&action=vpnusersServices&userid={$details.client_id}"> 
                                        {if $details.firstname && $details.lastname neq ''} 
                                            {$details.firstname} {$details.lastname} 
                                        {elseif $details.firstname neq '' && $details.lastname eq ''}
                                              {$details.firstname}  
                                        {elseif $details.firstname eq '' && $details.lastname neq ''}
                                              {$details.lastname}                                             
                                        {else} 
                                            No Name 
                                        {/if}
                                    </a> 
                                </td> 
                                <td align="center"><a href="{$modulelink}&action=vpnusersServices&userid={$details.client_id}"> {if $details.email neq ''} {$details.email} {else } No Email {/if}</a> </td>  
                                <td class="text-center text-center1">
                                    <a href="{$modulelink}&action=vpnusersServices&userid={$details.client_id}" class="btn btn-default btn-primary">
                                        <i class="fa fa-arrow-right"></i>
                                        View Services
                                    </a> </td><td class="text-center text-center1">
                                    <div class="btn-group btn-group-sm" style="width:60px;"> 
                                    <button class="btn btn-success addcredits" data-clientid="{$details.client_id}"><i class="fa fa-money"></i> Give Credits</button> 
                                            
                                    </div></td>
                            </tr> 
                        {/foreach} 
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
                                