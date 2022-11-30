{literal}
<script>
    $(document).ready(function () {
        $('.quickfix').click(function () {
            // add swal confirmation
            swal({
                title: "Are you sure?",
                text: "It will fix the migration issues related to old users.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, fix it!",
                closeOnConfirm: false
            },
                function () {
                    var url = 'addonmodules.php?module=vpnpanel&action=vpn_quickfix';
                    $.get(url, function (data) {
                        if (data == 'success') {
                            swal('Success', 'Quickfix has been applied', 'success');
                        }
                    });
                });

        });

        $('#displayallclients').DataTable({
            iDisplayLength: 25
        });


        /*
        $('.viewPass').click(function(){
            $(this).hide();
            $(this).parent('td').children('p.hidePass1').hide();
            
            $(this).parent('td').children('p.viewPass1').show();
            $(this).parent('td').children('button.hidePass').show();
            
        });
        
        $('.hidePass').click(function(){
            $(this).hide();
            $(this).parent('td').children('p.viewPass1').hide();
            
            $(this).parent('td').children('p.hidePass1').show();
            $(this).parent('td').children('button.viewPass').show();
            
        });
        
        $('.showService').click(function(){
            var cls = $(this).attr('id');
            $(this).parent('td').children('.hideService').show();
            $(this).parent('td').children('.showService').hide();
            $('.'+cls+'').show(0);
        });
        
         $('.hideService').click(function(){
            var cls = $(this).attr('id');
            $(this).parent('td').children('.hideService').hide();
            $(this).parent('td').children('.showService').show();
            $('.'+cls+'').hide(0);
        });
        */


    });
</script>
{/literal}

<!--breadcrumb-->

<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                {$breadcrumb}
            </ol>
        </nav>
    </div>

    <div class="col-md-12">
        <h2>VPN Accounts List</h2>
        <h5>Here , You can see the list of VPN Accounts ( Users)</h5>
    </div>
</div>

<!-- Message -->

<div class="message" style="float: left; width: 100%;">
    {$message}
</div>

<!---clinet list--->
<button class="btn btn-info quickfix pull-right">Run Patch</button>
<table class="table datatable" id="displayallclients" style="margin-top:20px;border-spacing: 0px;">
    <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email Addres</th>
            <th>Owner</th>
            <th>Services</th>
            <th>Created</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>

        {foreach from=$radclients item=radclient}
        <tr>
            <td>
                <a href="clientssummary.php?userid={$radclient.userid}" target="_blank">{$radclient.userid}</a>
            </td>
            <td>
                <a href="clientssummary.php?userid={$radclient.userid}" target="_blank">{$radclient.firstname}</a>
            </td>
            <td>
                <a href="clientssummary.php?userid={$radclient.userid}" target="_blank">{$radclient.lastname}</a>
            </td>
            <td>
                <a href="mailto:{$radclient.email}" target="_blank">{$radclient.email}</a>
            </td>
            <td>{$radclient.owner}</td>
            <td>{$radclient.services}</td>
            <td>{$radclient.created_at}</td>
            <td>
                <span class="label {$radclient.status|lower}">{$radclient.status}</span>
            </td>


            <td>
                <a href="{$modulelink}&action=vpn_userServices&userid={$radclient.userid}"
                    class="showService btn btn-info" alt="View Services"> View Services</a>
            </td>
        </tr>

        {*<tr class="user_{$radclient.userid}" style="display: none !important;">
            <td colspan="5">
                <table class="table table-bordered table-striped datatable">
                    <thead>
                        <tr>
                            <th>Service Name</th>
                            <th>Billing Cycle</th>
                            <th>Next Due Date</th>
                            <th>VPN Username</th>
                            <th>VPN Password</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        {foreach item=$clientService from=$radclient.services}
                        <tr>
                            <td>
                                <a href="clientsservices.php?userid={$radclient.userid}&id={$clientService->serviceid}"
                                    target="_blank">{$clientService->name} - {$clientService->groupname}</a>
                            </td>
                            <td>{$clientService->billingcycle}</td>
                            <td>{$clientService->nextduedate}</td>
                            <td>{$clientService->username}</td>
                            <td>
                                <p class="hidePass1 pull-left" style="margin: 5px;">**********</p>
                                <p class="viewPass1 pull-left" style="display: none; margin: 5px;">
                                    {$clientService->password}</p>
                                <button class="viewPass pull-left btn btn-info" style="display:block;"><i
                                        class="fa fa-eye"></i></button>
                                <button class="hidePass pull-left btn btn-info" style="display: none;"><i
                                        class="fa fa-eye-slash"></i></button>
                            </td>
                            <td>
                                {if {$clientService->domainstatus} eq 'Active'}
                                <span class="label label-success">Active</span>
                                {else}
                                <span class="label label-warning">{$data.status}</span>{/if}
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                        data-toggle="dropdown">View Usage
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="{$modulelink}&action=vpn_usage&id={$clientService->serviceid}&m=d">Daily
                                                Usage</a></li>
                                        <li><a href="{$modulelink}&action=vpn_usage&id={$clientService->serviceid}&m=m">Monthly
                                                Usage</a></li>
                                        <li><a href="{$modulelink}&action=vpn_usage&id={$clientService->serviceid}&m=y">Yearly
                                                Usage</a></li>
                                        <li><a href="{$modulelink}&action=vpn_usage&id={$clientService->serviceid}&m=s">Session
                                                Usage</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        {/foreach}

                    </tbody>
                </table>
            </td>
        </tr>*}
        {/foreach}
    </tbody>
</table>
<div class="row">
    <a href="{$modulelink}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Go Back</a>
</div>