{literal}
<script>
    $(document).ready(function() 
    {
        $('#displayallclients').DataTable({
             iDisplayLength: 25
        });
        
        $('.datepicker').datepicker( 
        {
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'yy',
            buttonImageOnly: true,
            showOn: "both",
            buttonImage: "images/showcalendar.gif",
            buttonText: "Calendar",
            
            onClose: function(dateText, inst) 
            { 
                $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
            }
    });
                    
                    

    });
    
</script> 

<style>
    .custom
    {
        padding: 0px !important ; 
        border: 0px !important;
    }
    .ui-widget-header
    {
        color: #4E4949;
    }
    #displayallclients th,#displayallclients td
    {
        text-align: center;
    }
    .clientnamedisplaybox 
    {
        padding: 10px;
        margin-bottom: 20px;
        border: 2px solid;
        border-top-color: currentcolor;
        border-top-style: solid;
        border-right-color: currentcolor;
        border-right-style: solid;
        border-bottom-color: currentcolor;
        border-bottom-style: solid;
        border-left-color: currentcolor;
        border-left-style: solid;
        border-style: dotted;
        border-color: #bfbebe;
        text-align: center;
        background:rgb(245, 245, 245);
}
.ui-datepicker-calendar,.ui-datepicker-month
{
    display: none;
}
    
    .datepicker + img 
    {
    position: relative;
    left: -25px;
    top: -2px;
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
    <div class="col-md-12">
        <div class="clientnamedisplaybox" style="font-size: 20px;">
            <a href="clientssummary.php?userid={$service.userid}" target="_blank">#<span id="userId">{$service.userid}</span> - {$service.name}</a>  
        </div>
    </div>
        
    <div class="col-md-12">
        {*<h2>Daily Usage</h2>
        <h5>Here , You can see the daily usage of VPN users <b>{$service.username}</b>.</h5>*}
        <div class="pull-right">
           <a class="btn btn-info" href="{$modulelink}&action=vpn_usage&id={$service.serviceid}&m=d"> Daily Usage</a>
           <a class="btn btn-info" href="{$modulelink}&action=vpn_usage&id={$service.serviceid}&m=m"> Monthly Usage</a>
           {*<a class="btn btn-info" href="{$modulelink}&action=vpn_usage&id={$service.serviceid}&m=s"> Session Usage</a>*}
        </div>
    </div>
</div>
            
<!-- Message -->

<div class="message" style="float: left; width: 100%;">
    {$message}
</div>


<div class="row" style="margin-top: 20px;">
    <div class="col-md-12">        
        
        <center style="margin-bottom: 20px;margin-top: 20px;">
            <form method="post" name="datepicker" action="{$modulelink}&action=vpn_usage&id={$service.serviceid}&m=y">
                <span style="font-size: 16px;color: #555;"><b>From:</b></span>
                    <input type="text" name="fromdate" value="{$service.fromdate}" size="10" class="datepicker" style="margin-right: 5px;">&nbsp;&nbsp;
                    <span style="font-size: 16px;color: #555;"><b>To:</b>
                        <input type="text" name="todate" value="{$service.todate}" size="10" class="datepicker" style="margin-right: 5px;">&nbsp;&nbsp;
                        <input class="btn btn-primary" type="submit" name="filter_record" value="Get Usage" style="margin-left: 12px;"/>
                    </span> 
                    <input type="hidden" name="serviceid" value="{$service.serviceid}">
                    <input type="hidden" name="username" value="{$service.username}">
                    <input type="hidden" name="mode" value="yearlyUsage">
                    <button type="submit" class="btn btn-primary" name="filterdate" value="export_to_csv" formaction="../modules/addons/vpnpanel/export_csv.php"> <i class="glyphicon glyphicon-export"></i> Export to csv</button>
                </form>
            
        </center>
        
            
            
        <table id="displayallclients" class="table table-striped table-bordered" cellspacing="0" width="100%" style="text-align: left;">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Uploaded</th>
                    <th>Downloaded</th>
                    <th>Total Usage</th>
                </tr>
            </thead>
            
            <tbody>
               
                {foreach from=$usageDetails.usage item=usageDetail} 
                    
                    <tr>
                        <td>{$usageDetail->day}</td>
                        <td>{$usageDetail->uploads}</td>
                        <td>{$usageDetail->downloads}</td>
                        <td>{$usageDetail->total}</td>
                    </tr>
                    
                
               {/foreach}

            </tbody>
            <tfoot>
                <tr>
                    <th>Total</th>
                    <th>{$usageDetails.total->uploads}</th>
                    <th>{$usageDetails.total->downloads}</th>
                    <th>{$usageDetails.total->total}</th>
                </tr>
            </tfoot>
        </table>
          
        <div>
            <a href="{$modulelink}&&action=vpn_accounts" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Go Back</a>
        </div>
    </div>
</div>