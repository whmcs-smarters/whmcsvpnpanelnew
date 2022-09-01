<link href="modules/addons/vpnpanel/templates/css/swiftmodders.css" rel="stylesheet">
<link href="modules/addons/vpnpanel/templates/css/mystyle.css" rel="stylesheet"> 
<link href="modules/addons/vpnpanel/templates/css/bootstrap-social.css" rel="stylesheet">
<script type="text/javascript">
    var alreadyReady = false; // The ready function is being called twice on page load.
    jQuery(document).ready(function () {
        var table = jQuery("#xtreamservices").DataTable({
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
           
            
            <div class="listtable" style="overflow-x: scroll;"> 
                <table id="xtreamservices" class="table table-list dataTable no-footer dtr-inline" aria-describedby="xtreamservices_info" role="grid">
                    <thead>
                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="xtreamservices" rowspan="1" colspan="1" style="width: 0px;" aria-sort="ascending">Product/Service</th>
                            <th class="sorting_asc" tabindex="0" aria-controls="xtreamservices" rowspan="1" colspan="1" style="width: 0px;" aria-sort="ascending">Name</th>
                            <th class="sorting" tabindex="0" aria-controls="xtreamservices" rowspan="1" colspan="1"  style="width: 0px;">User Name</th>  
                                
                            <th class="sorting_asc" tabindex="0" aria-controls="xtreamservices" rowspan="1" colspan="1" style="width: 0px;">Next Due Date</th>
                            <th class="sorting_asc" tabindex="0" aria-controls="xtreamservices" rowspan="1" colspan="1" style="width: 0px;">Status</th>
                            
                            <!--th class="sorting_asc" tabindex="0" aria-controls="xtreamservices" rowspan="1" colspan="1" style="width: 0px;">Action</th-->
                        
                    </tr>
                </thead>
                <tbody>  

                    {foreach from=$servicedetails item=service} 
                        <tr> 
                            <td class="text-center">{$service.name} </td>
                            <td class="text-center">{if {$service.firstname} && {$service.lastname} eq ''}No Name{else}{$service.firstname} {$service.lastname}{/if}</td>
                            <td class="text-center">{$service.username}</td> 
                            <!--td class="text-center">{$service.password}</td-->
                            <td class="text-center">{$service.nextduedate}</td>
                            <td class="text-center">{$service.status}</td>
                            
                            <!--td><a href="javascript:;" data-toggle="modal" data-target="#engdevice{$service.id}">Update</a></td-->
                        </tr>
                    {/foreach} 
                                    </tbody>
                                </table> 
                            </div>  
                        </div>
                    </div> 
                </div>   
                               