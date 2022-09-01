{literal}
<script>
    $(document).ready(function() 
    {
        $('#displayallclients').DataTable({
             iDisplayLength: 25
        });
        
        $('.cdatepicker').datepicker({
                        changeMonth: true,
                        changeYear: true,
                        showButtonPanel: true,
                        dateFormat: 'dd/mm/yy'
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
        <h2>Daily Usage</h2>
        <h5>Here , You can see the daily usage of VPN users <b>{$service.username}</b>.</h5>
        <div class="pull-right">
            <a class="btn btn-info" href="{$modulelink}&action=vpn_usage&id={$service.serviceid}&m=d"> Daily Usage</a>
           <a class="btn btn-info" href="{$modulelink}&action=vpn_usage&id={$service.serviceid}&m=m"> Monthly Usage</a>
           <a class="btn btn-info" href="{$modulelink}&action=vpn_usage&id={$service.serviceid}&m=y"> Yearly Usage</a>
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
            <form method="post" name="datepicker" action="{$modulelink}&action=vpn_usage&id={$service.serviceid}&m=d">
                <span style="font-size: 16px;color: #555;"><b>From:</b></span>
                    <input type="text" name="fromdate" value="{$service.fromdate}" size="12" class="cdatepicker" style="margin-right: 5px;">&nbsp;&nbsp;
                    <span style="font-size: 16px;color: #555;"><b>To:</b>
                        <input type="text" name="todate" value="{$service.todate}" size="12" class="cdatepicker" style="margin-right: 5px;">&nbsp;&nbsp;
                        <input class="btn btn-primary" type="submit" name="filter_record" value="Get Usage" style="margin-left: 12px;"/>
                    </span> 
                    <input type="hidden" name="serviceid" value="{$service.serviceid}">
           
                    <button type="submit" class="btn btn-primary" formaction="../modules/addons/NSTfreeradiusaddon/templates/export_csv.php"> <i class="glyphicon glyphicon-export"></i> Export to csv</button>
                </form>
            
        </center>
        <div  id="clienttabs" class="/*tab-pane active*/"><!----start of admin tab---->
            
            <div class="tab-content">
        <!----start of data table----->
        <div id="home" class="tab-pane fade in active">
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
                {*
                <?php 
                $total_upload=$total_download=$total_used=0;
                foreach ($GetUsage as $key=>$usage) 
                {
                    $total_upload=$total_upload+$usage['uploads'];
                    $total_download=$total_download+$usage['downloads'];
                    $total_used=$total_used+$usage['total'];
                    $bar_data.= "["."'".$usage['date']."'".",".$usage['uploads'].",".$usage['downloads'].",".$usage['total']."]".","
                    ?>
                    <tr>
                        <td><?php echo date_format(date_create($usage['date']),"d/m/Y"); ?></td>
                        <td><?php echo NSTFreeRadius_byte_size($usage['uploads']); ?></td>
                        <td><?php echo NSTFreeRadius_byte_size($usage['downloads']); ?></td>
                        <td><?php echo NSTFreeRadius_byte_size($usage['uploads']+$usage['downloads']); ?></td>
                    </tr>
                    <?php
                }
                ?>
*}
            </tbody>
            <tfoot>
                <tr>
                    <th>Total</th>
                    <th>{*<?php echo NSTFreeRadius_byte_size($total_upload); ?>*}</th>
                    <th>{*<?php echo NSTFreeRadius_byte_size($total_download); ?>*}</th>
                    <th>{*<?php echo NSTFreeRadius_byte_size($total_used); ?>*}</th>
                </tr>
            </tfoot>
        </table>
            </div>
        </div>
        <!----end of data table---->
        </div><!-----end of admin tab--->
    
    </div>
</div>