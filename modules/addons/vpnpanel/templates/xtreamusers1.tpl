<script type="text/javascript">
    var alreadyReady = false; // The ready function is being called twice on page load.
    jQuery(document).ready(function () {
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
                [0, "desc"]
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
<style type="text/css">
    .btn_custom{
        width: 19%;
        background: #004a95;
        padding: 12px 0px;
        transition: all 0.4s;
        border-color: #004a95; 
    }
    .btn_custom:hover{
        background: #337ab7 !important;
        transition: all 0.4s;
        border-color: #337ab7 !important;
        padding: 12px 0px !important;
    }   
    .input_custom{
        width: 80%;
        height: 45px;
        padding: 0px 33px;

        border: none;
        display: inline-block;
        box-shadow: 0px 0px 9px 0px #ccc;
        margin-bottom: 20px;
    }
    .fa_custom{
        position: absolute;
        padding: 16px 13px;
        color: #bbb;
    }
</style>
<div class="container"  style="width: 100%;margin-top: 20px;"> 
    {include file='modules/addons/vpn/templates/nav_header.tpl'}
    <div class="sm-content-container">
        <div class="sm-content">
            <div class="sm-page-heading">
                <h1>{$pagetitle}</h1>
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
            <div >
                <form method="POST" action="">
                    <i class="fa fa-search fa_custom" aria-hidden="true" ></i>
                    <input type="text" name="Client_search" class="form-control input-sm input_custom" placeholder="Search by Mac Address, Name, package" value="{$Client_search}" >
                    <input type="submit" class="btn btn-default btn-primary btn_custom" value="SEARCH" >
                </form>            
            </div>
            <div class="listtable"> 
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
              
                        {foreach from=$clientsData1 item=details}
                        
                            <tr> <td align="center"><a href="{$modulelink}&action=xtreamusersservices&userid={$details.client_id}">{$details.client_id}</a> </td>
                                <td align="center">
                                    <a href="{$modulelink}&action=services&userid={$details.client_id}"> 
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
                                <td align="center"><a href="{$modulelink}&action=xtreamusersservices&userid={$details.client_id}"> {if $details.email neq ''} {$details.email} {else } No Email {/if}</a> </td>  
                                <td class="text-center text-center1">
                                    <a href="{$modulelink}&action=xtreamusersservices&userid={$details.client_id}" class="btn btn-default btn-primary">
                                        <i class="fa fa-arrow-right"></i>
                                        View Services
                                    </a> </td> <td class="text-center text-center1">
                                    <div class="btn-group btn-group-sm" style="width:60px;"> 
                                        <button type="button" class="btn btn-default dropdown-toggle btn_new" data-toggle="dropdown" aria-expanded="true">Action
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu text-left action_clr" role="menu"> 
                                            <li class="action_clr1">
                                                <a href="#" role="button" data-toggle="modal" data-target="#login-modal{$details.client_id}" style="display: block;text-decoration: none !important;padding: 3px 20px;clear: both;font-weight: normal;line-height: 1.42857;color: #333;
                                                   white-space: nowrap;"><i class="fa fa-plus"></i> Give Credits</a> 
                                            </li> 
                                            <li class="action_clr2">  <a href="#" role="button" data-toggle="modal" data-target="#dashboard-modal{$details.client_id}"  style="display: block;text-decoration: none !important;padding: 3px 20px;clear: both;font-weight: normal;line-height: 1.42857;color: #333;
                                                                         white-space: nowrap;"><i class="fa fa-sign-in"></i> Log as this User</a> 
                                            </li>
                                            <li class="action_clr3">  <a href="#" role="button" data-toggle="modal" data-target="#dashboard-remove{$details.client_id}" style="display: block;text-decoration: none !important;padding: 3px 20px;clear: both;font-weight: normal;line-height: 1.42857;color: #333;
                                                                         white-space: nowrap;"><i class="fa fa-trash"></i> Remove</a>
                                            </li> 
                                        </ul>
                                    </div></td> 
                            </tr> 
                        {/foreach} 
                    </tbody>
                </table> 
            </div>	
        </div>
    </div> 
</div>   
{foreach from=$userdetails item=details}  
    <div class="modal fade reselleraddcredit" id="dashboard-modal{$details.client_id}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" align="center">
                    Log In 
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </button>
                </div>  
                <div id="div-forms">  
                    <div class="modal-body">Are you sure want to Log as User <b>{$details.email}</b>? </div>
                    <div class="modal-footer"> 
                        <input type="button"  data-dismiss="modal" aria-label="Close" onclick="logincode('{$details.logincode}');" name="logincodebtn" class="btn btn-primary btn-lg btn-block" value="LogIn">
                    </div> 
                </div>  
            </div>
        </div>
    </div>     
    <div class="modal fade reselleraddcredit" id="dashboard-remove{$details.client_id}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" align="center">
                    Remove user
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </button>
                </div>  
                <div id="div-forms">  
                    <div class="modal-body">Are you sure want to Remove User <b>{$details.email}</b>?  <br><br><div>This will delete all history and cannot be undone.</div></div>
                    <div class="modal-footer"> 
                        <form method="POST"> <input name="client_id" type="hidden" value="{$details.client_id}">
                            <input type="submit" name="removeclient" class="btn btn-danger" value="Remove Client">  </form> </div> 
                </div>  
            </div>
        </div>
    </div>   
    <div class="modal fade reselleraddcredit" id="login-modal{$details.client_id}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" align="center">
                    Add Credits 
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </button>
                </div>  
                <div id="div-forms">
                    <div class="modal-body modal_custom">  Remaning Credits in your account : <span class="mdl_set">{$remaningcredits} </span></div>
                    <form id="login-form" method="POST">
                        <div class="modal-body"> 
                            <input class="form-control" type="text" placeholder="Enter Number of Credits" name="credits" required> 
                        </div>
                        <div class="modal-footer">
                            <div>
                                <input name="client_id" type="hidden" value="{$details.client_id}">
                                <input type="submit" name="addcredits" class="btn btn-primary btn-lg btn-block" value="Add Credits">
                            </div> 
                        </div>
                    </form> 
                </div>  
            </div>
        </div>
    </div> {/foreach} 
    {literal} 
        <script>
            function logincode(logincode) {
                $.ajax({
                    method: "POST",
                    url: "modules/addons/vpn/lib/Client/ajax.php",
                    data: {logincode: logincode, session: 'destroy'}
                })
                        .done(function () {
                            window.open('{/literal}{$whmcsurl}{literal}/clientarea.php?logincode=' + logincode, 'privateWindow', 'width=910,height=655,left=160,top=170');
                        });
            }
        </script>
    {/literal}