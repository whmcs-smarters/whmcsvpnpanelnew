<div class="row">
    <div class="col-md-12"><h2>User Services List</h2><h5>Here , You can see the all services of user created under reseller.</h5></div>
    <div class="col-md-12"><nav aria-label="breadcrumb">
  <ol class="breadcrumb">
      {$breadcrumb}
  </ol>
</nav></div>
    <div class="col-md-12">


<!--button class="btn btn-warning pull-right" id="reloadserverbtn"><i class="fa fa-refresh"></i> Reload Server List</button-->
<div class="message" style="float: left; width: 100%;">{$message}</div>

<table class="table table-bordered table-striped datatable">
    <thead>
        <tr><th>Service Name.</th><th>Billing Cycle</th><th>Next Due Date</th><th>Username</th><th>Password</th><th>Status</th></tr>
    </thead>
    <tbody>
        {foreach item=$data from=$servicedata}
        
        <tr><td>{$data.name} - {$data.groupname}</td>
        <td>{$data.billingcycle}</td>
        <td>{$data.nextduedate}</td>
        <td>{$data.username}</td>
        <td><p class="hidePass1 pull-left" style="margin: 5px;">**********</p>
        <p class="viewPass1 pull-left" style="display: none; margin: 5px;">{$data.password}</p>
        <button class="viewPass pull-left btn btn-info" style="display:block;"><i class="fa fa-eye"></i></button>
        <button class="hidePass pull-left btn btn-info" style="display: none;"><i class="fa fa-eye-slash"></i></button>
        </td>
        <td>{if {$data.status} eq 'Active'}<span class="label label-success">Active</span>{else}<span class="label label-warning">{$data.status}</span>{/if}</td></tr>
        {/foreach}
    </tbody>
</table>
<div class="row">
    <button class="btn btn-primary goback"><i class="fa fa-arrow-left"></i> Go Back</button>
</div>
</div>
<script>
    $(document).ready(function(){
        $('.goback').click(function(e){
            e.preventDefault();
             window.history.back()
        })
        $('.viewPass').click(function(){
            $(this).hide();
            $('.hidePass1').hide();
            
            $('.viewPass1, .hidePass').show();
            
        })
        $('.hidePass').click(function(){
            $(this).hide();
            $('.viewPass1').hide();
            
            $('.hidePass1, .viewPass').show();
            
        })
    })
</script>
<style>
    .label
    {
        padding: 3px 10px !important;
        font-size: 14px !important;
        margin-top: 5px;
    }
</style>
