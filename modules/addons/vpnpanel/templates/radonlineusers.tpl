{literal}
<script>
    $(document).ready(function() 
    {
        $('.datatable').DataTable({
            iDisplayLength: 25,
            order: [[4, 'desc']],
        });     
        {/literal}   
        $(document).find('#activeclinets_length').append('<label style="float: right">Protocal: <select class="form-control" style="width: 97px" onchange="window.location.href=this.value"><option value="addonmodules.php?module=vpnpanel&action=vpn_onlineusers&proto=ikev2" {$ikev2active}>ikev2</option><option value="addonmodules.php?module=vpnpanel&action=vpn_onlineusers&proto=ovpn" {$ovpnactive}>openvpn</option><option value="addonmodules.php?module=vpnpanel&action=vpn_onlineusers" {$allactive}>All</option></select></label>');
        {literal}
    });
</script>

<style>
#activeclinets th, #activeclinets td
{
    text-align: center;
}
</style>

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
            
    <div class="col-md-12"><h2>Online Users List</h2>
    <h5 style="float: left;">Here , You can see the list of VPN online users.</h5>
    <!-- <form method="post" style="float:right;">
            <button class="btn btn-success" name="resetonlineusers">Reset Online Users</button>
        </form> -->
    </div>
            
</div>
            
<!-- Message -->

<div class="message" style="float: left; width: 100%;">
    {$message}
</div>

<!---clinet list--->
<div class="row" style="margin-top:30px;"> 
    <div class="col-md-12">
        
        <!-- <p>Show Only <a class="btn btn-primary {$ikev2active}" href="addonmodules.php?module=vpnpanel&action=vpn_onlineusers&proto=ikev2">Ikev2</a> <a class="btn btn-primary {$ovpnactive}" href="addonmodules.php?module=vpnpanel&action=vpn_onlineusers&proto=ovpn">OVPN</a> <a class="btn btn-primary {$allactive}" href="addonmodules.php?module=vpnpanel&action=vpn_onlineusers">All</a></p> -->
<table class="table table-bordered table-striped datatable" id="activeclinets">
    <thead>
        <tr>
        <th>Account ID</th>
            <th>Name</th>
            <th>Username</th>
            <th>IP Address</th>
            <th>Start Time</th>
            <th>Update Time</th>
            <th>Stop Time</th>
            <th>Terminate Cause</th>
            <th>Session Time</th>
            <th>Protocol</th>
        </tr>
    </thead>
    <tbody>
        
        {foreach from=$activeclients item=activeclient}
            <tr>
                <td>
                    {$activeclient->radacctid}
                </td>
                <td>
                    <a href="clientssummary.php?userid={$activeclient->userid}" target="_blank">{$activeclient->name}</a>
                </td>
                
                <td>
                    <a href="clientsservices.php?userid={$activeclient->userid}&productselect={$activeclient->serviceid}" target="_blank">{$activeclient->Username}</a>
                </td>
                
                <td>
                    IP: {$activeclient->FramedIPAddress} </br>
                    MAC: {$activeclient->CallingStationId}
                </td>
                
                <td>{$activeclient->AcctStartTime}</td>
                <td>{$activeclient->acctupdatetime}</td>
                <td>{$activeclient->acctstoptime}</td>
                <td>{$activeclient->acctterminatecause}</td>
                <td>
                    {$activeclient->total}
                </td>
                <td>
                    {if $activeclient->nasportid == 'ikev2'}
                        ikev2
                    {else}
                        openvpn
                    {/if}
                </td>
            </tr>
        {/foreach}
    </tbody>
</table>
<div>
    <a href="{$modulelink}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Go Back</a>
</div>
    </div>
</div>