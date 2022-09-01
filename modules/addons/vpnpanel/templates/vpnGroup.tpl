<div class="fullpageloader" style="position: fixed; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 99999; top: 0px; left: 0px; display: none;">
    <p style="position: absolute; left: 40%; top: 30%; color: #fff; font-size: 25px;"><i class="fa fa-circle-o-notch  fa-spin"></i> Loading Please wait...</p>
</div>
{$message}
<hr>
<h1>Server Group</h1>
<h5>{if $edit eq 'true'}Update{else}Create{/if} Group for VPN Servers</h5>

<div class="tab-content admin-tabs" style="
     padding: 0px 33px;
     ">
     {if $edit eq 'true'}
     <form method="post" action="" id="configform">
     <table class="table table-bordered" style="background: rgb(250, 250, 250);">
        <tbody>
            
            <tr><td style="text-align:right" width="300">Group Name</td><td><input type="hidden" name="gid" value="{$groupid}">
                <input type="text" class="form-control" name="groupname" value="{$groupname}" placeholder="Enter Group Name" style="width: 50%"></td></tr>
        </tbody>
        <tfoot><tr><td colspan="2"><div class="btn-container">
        <input type="submit" value="Save Changes" name="saveGroup" class="btn btn-primary"> <input type="button" value="Cancel Changes" onclick="window.location='addonmodules.php?module=vpnpanel&action=vpn_servers'" class="btn btn-default">
    </div></td></tr></tfoot>
     </table>
    </form>
     {else}
    <form method="post" action="" id="configform">
     <table class="table table-bordered" style="background: rgb(250, 250, 250);">
        <tbody>
            <tr><td style="text-align:right" width="300">Group Name</td><td><input type="text" class="form-control" name="groupname" placeholder="Enter Group Name" style="width: 50%"></td></tr>
        </tbody>
        <tfoot><tr><td colspan="2">
<div class="btn-container">
        <input type="submit" value="Save Changes" name="saveGroup" class="btn btn-primary"> <input type="button" value="Cancel Changes" onclick="window.location='addonmodules.php?module=vpnpanel&action=vpn_servers'" class="btn btn-default">
    </div></td></tr></tfoot>
     </table>
    </form>
{/if}
    <div class="row">
        <!--a href="{$modulelink}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Go Back</a-->
    </div>     

</div>



{literal} 
    <style>
        .modal-dialog
        {
            width: 50% !important;
        }
        @media screen and (max-width:950px)
        {
            .modal-dialog
            {
                width: 95% !important;
            }
        }

        .modal .fieldarea
        {
            font-weight: bold;
        }
    </style>

{/literal}