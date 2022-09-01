{literal}
<script>
    $(document).ready(function() 
    {
        
        $('#displayallclients').DataTable({
            iDisplayLength: 25
        });
        
        
        
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
            
    <div class="col-md-12"><h2>VPN Service List</h2>
    <h5>Here , You can see the list of VPN Services</h5></div>
</div>
            
<!-- Message -->

<div class="message" style="float: left; width: 100%;">
    {$message}
</div>

<!---clinet list--->
    
<table class="table datatable" id="displayallclients" style="margin-top:20px;border-spacing: 0px;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Product/Service</th>
            <th>Username</th>
            <th>Password</th>
            <th>Amount</th>
            <th>Billing Cycle</th>
            <!--<th>Signup Date</th>-->
            <th>Next Due Date</th>
            <th>Status</th>
           {if $disablelogs eq 'on'}{else}<th>Actions</th>{/if}
        </tr>
    </thead>
    <tbody>
        
        {foreach from=$clientServices item=clientService}
            <tr>
                <td>
                    <a href="clientsservices.php?userid={$clientService->userid}&id={$clientService->serviceid}" target="_blank">{$clientService->serviceid}</a>
                </td>
                <td>
                    {$clientService->name}
                </td>
                <td>
                    {$clientService->username}
                </td>
                <td>
                    <p class="hidePass1 pull-left" style="margin: 5px;">**********</p>
                    <p class="viewPass1 pull-left" style="display: none; margin: 5px;">{$clientService->password}</p>
                    <button class="viewPass pull-left btn btn-info" style="display:block;"><i class="fa fa-eye"></i></button>
                    <button class="hidePass pull-left btn btn-info" style="display: none;"><i class="fa fa-eye-slash"></i></button>
                    
                </td>
                <td>{$clientService->amount}</td>
                <td>{$clientService->billingcycle}</td>
                <!--<td>{$clientService->regdate}</td>-->
                <td>{$clientService->nextduedate}</td>
                <td>
                   <span class="label {$clientService->domainstatus|lower}">{$clientService->domainstatus}</span>
                </td>
                
                {if $disablelogs eq 'on'}
                {else}
                <td>
                    <a class="btn btn-primary" href="{$modulelink}&action=vpn_usage&id={$clientService->serviceid}&m=d">View Usage
                        
                    </a>
                    {*
                    <div class="dropdown">
                    
                    <ul class="dropdown-menu">
                        <li><a href="{$modulelink}&action=vpn_usage&id={$clientService->serviceid}&m=d">Daily Usage</a></li>
                        <li><a href="{$modulelink}&action=vpn_usage&id={$clientService->serviceid}&m=m">Monthly Usage</a></li>
                        <li><a href="{$modulelink}&action=vpn_usage&id={$clientService->serviceid}&m=y">Yearly Usage</a></li>
                        <li><a href="{$modulelink}&action=vpn_usage&id={$clientService->serviceid}&m=s">Session Usage</a></li>
                    </ul>
                  </div> 
                  *}
                </td>
                {/if}
            </tr>
            
        {/foreach}
    </tbody>
</table>
<div class="row">
    <a href="{$modulelink}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Go Back</a>
</div>