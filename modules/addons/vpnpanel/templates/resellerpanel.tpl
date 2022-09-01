<div class="container"  style="width: 100%;margin-top: 20px;">
    {include file='modules/addons/vpnpanel/templates/nav_header.tpl'}    
    <div class="sm-content-container">
        <div class="sm-content">
            <div class="sm-page-heading">
                <h1>Dashboard</h1>
                <ol class="breadcrumb">
                    <li>                        <a href="index.php">            Portal Home                        </a>        </li>
                    <li class="active">                        Dashboard                    </li>
                </ol>
            </div>
            <div class="tab-pane fade in active" id="tabOverview">
                <div class="product-details clearfix">
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="panel panel-primary">
                                <a href="{$modulelink}&action=vpnusers">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-users fa-5x"  aria-hidden="true"></i>                                        </div>

                                            <div class="col-xs-9 text-right">
                                                <div class="huge">{$totalusers}</div>
                                                <div>Total Users!</div>
                                                
                                            </div>

                                        </div>
                                    </div>
                                </a>
                                <a href="{$modulelink}&action=vpnusers">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>                                        
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!--div class="col-lg-4 col-md-4 hide">
                            <div class="panel panel-green">
                                <a href="{$modulelink}&action=vpninactiveusers">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">                                              <i class="fa fa-user-times fa-5x"  aria-hidden="true"></i>                                        </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge">{$undertrial}</div>
                                                <div>Under Trial Services!</div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="{$modulelink}&action=vpninactiveusers">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>                                        
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div-->
                        <div class="col-lg-4 col-md-4">
                            <div class="panel panel-yellow">
                                <a href="credits.php">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">                                            <i class="fa fa-usd fa-5x" aria-hidden="true"></i>                                        </div>
                                            <div class="col-xs-9 text-right">
                                                <div style="font-size: 30px;">{$totalcredit}</div>
                                                <div>Credits!</div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="credits.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>                                        
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 25px;">
                        <div class="col-lg-4 col-md-6"><a href="{$modulelink}&action=adduser" class="btn btn-block btn-social btn-bitbucket btn1" style="background-color: #337ab7;color: white;">                                <i class="fa fa-plus-circle" style="left: 5px;top: -2px;"></i> Add New User                            </a>                        </div>
                        <!--div class="col-lg-4 col-md-6"><a href="{$modulelink}&action=adduser" class="btn btn-block btn-social btn-bitbucket btn2" style="background-color: #5cb85c;color: white;">                                <i class="fa fa-plus-circle" style="left: 5px;top: -2px;"></i> Add New User                            </a>                        </div-->
                        <div class="col-lg-4 col-md-6"> <a href="cart.php?gid={if $topup eq ''}addons{else}{$topup}{/if}" class="btn btn-block btn-social btn-bitbucket btn3" style="background-color: #d69232;color: white;">                                <i class="fa fa-plus-circle" style="left: 5px;top: -2px;"></i> Add Credits                            </a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

