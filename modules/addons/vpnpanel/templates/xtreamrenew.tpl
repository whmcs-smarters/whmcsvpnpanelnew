<link href="modules/addons/xtreamdashboard/templates/css/radio.css" rel="stylesheet">   
<link href="modules/addons/xtreamdashboard/templates/css/swiftmodders.css" rel="stylesheet">
<link href="modules/addons/xtreamdashboard/templates/css/mystyle.css" rel="stylesheet">  
<!-- Register -->
<div class="container" style="width: 100%;margin-top: 20px;"> 
    {include file='modules/addons/xtreamdashboard/templates/nav_header.tpl'}
    <div class="sm-content-container">
        <div class="sm-content"> 
            {if $result!=''}
                <div class="alert alert-{$result} alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {$message}
                </div>
            {/if}
            <div class="col-sm-12"> 
                <div class="panel panel-default panel-accent-blue">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="fa fa-info"></i>&nbsp;Auto Renew
                        </h3>
                    </div>
                    <div class="panel-body">
                        <span style="font-size:16px"><b>Enabled :</b> If it's enabled it will renew your user subscription automatically on the next due date and deduct the credits from your account
                            <br><br><b>Disabled :</b> If it's disabled it will need to renew your user subscription manually using <b>"Renew"</b> button on the <b>service page</b> when it's expired. "<b>It will automatically show renew button when there is unpaid invoice</b>"
                        </span>
                        <form method="POST" id="autorenew" class="form-horizontal">   
                            <hr><div class="col-md-4" style="margin-top: -30px;margin-left: 137px;">
                                <div class="funkyradio"> 
                                    <div class="funkyradio-success">
                                        <input {if $checked eq 'Enable'}checked{/if} type="radio" name="renew" value="Enable" id="radio3" />
                                        <label for="radio3">Enable Auto Renew</label>
                                    </div> 
                                </div>
                            </div>    
                            <div class="col-md-4" style="margin-top: -30px;">
                                <div class="funkyradio">  
                                    <div class="funkyradio-danger">
                                        <input {if $checked eq 'Disable'}checked{/if} type="radio" name="renew" value="Disable" id="radio4" />
                                        <label for="radio4">Disable Auto Renew</label>
                                    </div> 
                                </div>
                            </div>
                            <br>
                            <center style="margin-top: 35px;">   <input type="submit" name="autorenew" value="Save Changes" class="btn btn-success btn_change"></center> 
                        </form>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div> 