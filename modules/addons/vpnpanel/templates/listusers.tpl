<div class="row">
    <div class="col-md-12"><nav aria-label="breadcrumb">
  <ol class="breadcrumb">
      {$breadcrumb}
  </ol>
</nav></div>
    <div class="col-md-12"><h2>Users List</h2>
    <h5>Here , You can see the list of users created under reseller.</h5></div>
   
    
    </div>
<div class="col-md-12">


<!--button class="btn btn-warning pull-right" id="reloadserverbtn"><i class="fa fa-refresh"></i> Reload Server List</button-->
<div class="message" style="float: left; width: 100%;">{$message}</div>
<table class="table table-bordered table-striped datatable">
    <thead>
        <tr><th>ID.</th><th>Name</th><th>Login/Email Addres</th><th>Reseller</th><th>Actions</th></tr>
    </thead>
    <tbody>
        
        {foreach item=$data from=$affdata}
        <tr><td><a href="clientssummary.php?userid={$data.clientid}" target="_blank">{$data.clientid}</a></td>
        <td><a href="clientssummary.php?userid={$data.clientid}" target="_blank">{if {$data.firstname} eq '' && {$data.lastname} eq ''}No Name{/if}</a></td>
        <td><a href="mailto:{$data.email}" target="_blank">{$data.email}</a></td>
        <td>{$owneremail}</td>
        <td><button id="user_{$data.clientid}" class="showService btn btn-info" alt="View Services"><i class="fa fa-arrow-down"></i> VIEW SERVICES</button>
        <button id="user_{$data.clientid}" class="hideService btn btn-info" style="display: none;"><i class="fa fa-arrow-up"></i> HIDE SERVICES</button>
        </td></tr>
        <tr class="user_{$data.clientid}" style="display: none !important;">
            <td colspan="5">
            <table class="table table-bordered table-striped datatable">
    <thead>
        <tr><th>Service Name.</th><th>Billing Cycle</th><th>Next Due Date</th><th>VPN Username</th><th>VPN Password</th><th>Status</th></tr>
    </thead>
    <tbody>
      
        {foreach item=$data from=$servicedata[{$data.clientid}]}
        
        <tr ><td><a href="clientsservices.php?userid={$data.clientid}&id={$data.id}" target="_blank">{$data.name} - {$data.groupname}</a></td>
        <td>{$data.billingcycle}</td>
        <td>{$data.nextduedate}</td>
        <td>{$data.username}</td>
        <td><p class="hidePass1 pull-left" style="margin: 5px;">**********</p>
        <p class="viewPass1 pull-left" style="display: none; margin: 5px;">{$data.password}</p>
        <button class="viewPass pull-left btn btn-info" style="display:block;"><i class="fa fa-eye"></i></button>
        <button class="hidePass pull-left btn btn-info" style="display: none;"><i class="fa fa-eye-slash"></i></button>
        </td>
        <td>{if {$data.status} eq 'Active'}<span class="label label-success">Active</span>
        {else}
        <span class="label label-warning">{$data.status}</span>{/if}</td></tr>
        {/foreach}
    </tbody>
</table></td></tr>
        {/foreach}
    </tbody>
</table>
<div class="row">
    <a href="{$modulelink}&action=vpn_resellers" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Go Back</a>
</div>
</div>
<style>
.btn-xs
{
    font-size:10px;
    border-radius: 50%;
    padding: 4px 5px;
}
</style>
<script>
    $(document).ready(function(){
        
        $('.viewPass').click(function(){
            $(this).hide();
            $(this).parent('td').children('p.hidePass1').hide();
            
            $(this).parent('td').children('p.viewPass1').show();
            $(this).parent('td').children('button.hidePass').show();
            
        })
        $('.hidePass').click(function(){
            $(this).hide();
            $(this).parent('td').children('p.viewPass1').hide();
            
            $(this).parent('td').children('p.hidePass1').show();
            $(this).parent('td').children('button.viewPass').show();
            
        })
        
        $('.showService').click(function(){
            var cls = $(this).attr('id');
            $(this).parent('td').children('.hideService').show();
            $(this).parent('td').children('.showService').hide();
            $('.'+cls+'').show(0);
        })
         $('.hideService').click(function(){
            var cls = $(this).attr('id');
            $(this).parent('td').children('.hideService').hide();
            $(this).parent('td').children('.showService').show();
            $('.'+cls+'').hide(0);
        })
    })
</script>
