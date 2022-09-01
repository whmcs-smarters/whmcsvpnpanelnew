<?php
/* Smarty version 3.1.36, created on 2020-11-18 07:37:45
  from '/var/www/html/modules/servers/vpnservernoapi/templates/overview.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fb4cf49c16ca8_89646086',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '953a0c82081e401a794e0a7d9b2918729a9d53e3' => 
    array (
      0 => '/var/www/html/modules/servers/vpnservernoapi/templates/overview.tpl',
      1 => 1605685049,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fb4cf49c16ca8_89646086 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/html/vendor/smarty/smarty/libs/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
if ($_smarty_tpl->tpl_vars['response']->value) {?>    <?php if ($_smarty_tpl->tpl_vars['response']->value == "success") {?>        <?php ob_start();
echo $_smarty_tpl->tpl_vars['message']->value;
$_prefixVariable1 = ob_get_clean();
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"success",'msg'=>$_prefixVariable1,'textcenter'=>true,'idname'=>"alertModuleCustomButtonSuccess"), 0, true);
?>    <?php } else { ?>        <?php ob_start();
echo $_smarty_tpl->tpl_vars['message']->value;
$_prefixVariable2 = ob_get_clean();
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"error",'msg'=>$_prefixVariable2,'textcenter'=>true,'idname'=>"alertModuleCustomButtonFailed"), 0, true);
?>    <?php }
}
if ($_smarty_tpl->tpl_vars['pendingcancellation']->value) {?>    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"error",'msg'=>$_smarty_tpl->tpl_vars['LANG']->value['cancellationrequestedexplanation'],'textcenter'=>true,'idname'=>"alertPendingCancellation"), 0, true);
}?> <?php if ($_smarty_tpl->tpl_vars['alertmessage']->value) {?>    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"info",'msg'=>$_smarty_tpl->tpl_vars['alertmessage']->value,'textcenter'=>true,'idname'=>"alertModuleCustomButtoninfo"), 0, true);
}?> 
<style>
    .row.new_custom1 {
        height: 130px;
    }
    .btn_new_here{
        border: transparent;
        background: url(modules/servers/vpnservernoapi/templates/images/donwload.png) #ff9601;
        background-size: 100%;
        height: 72px;
        color: #fff;
        font-size: 17px;
        background-repeat: no-repeat;
        text-align: center;
        margin: 0 auto;
        position: absolute;
        background-position:0% 50%;
        transition: all 0.2s;
        width: 86%;
        padding-left: 70px;
        padding-top: 7px;
    }
    .btn_new_here:hover,.btn_new_here:active,.btn_new_here:focus{
        /*background: url(modules/servers/vpnservernoapi/templates/images/donwload.png) #ff9601;*/
        color: #fff;
        filter: drop-shadow(8px 8px 10px #888) contrast(110%);
        transition: all 0.2s;
    }
    .btn_new_here1{
        border: transparent;
        background: url(modules/servers/vpnservernoapi/templates/images/QR.png) #000;
        background-size: 100%;
        height: 72px;
        color: #fff;
        font-size: 17px;
        background-repeat: no-repeat;
        text-align: center;
        margin: 0 auto;
        position: relative;
        background-position:0% 50%;
        transition: all 0.2s;
        top: 10px;
        width: 86%;
        padding-left: 20px;
    }
    .btn_new_here1:hover,.btn_new_here1:active,.btn_new_here1:focus{
        /*background: url(modules/servers/vpnservernoapi/templates/images/QR.png) #000;*/
        color: #fff;
        filter: drop-shadow(8px 8px 10px #888) contrast(110%);
        transition: all 0.2s;
    }
    .dropdown-menu
    {
    left: -60px !important;
    }
</style>

<?php echo '<script'; ?>
>
$(document).ready(function(){
<?php if ($_smarty_tpl->tpl_vars['downloadovpn']->value == 1) {?>
window.open('<?php echo $_smarty_tpl->tpl_vars['systemURL']->value;?>
client.ovpn');
<?php }
if ($_smarty_tpl->tpl_vars['downloadcert']->value == 1) {?>
window.open('<?php echo $_smarty_tpl->tpl_vars['systemURL']->value;?>
ca-cert.pem');
<?php }?>

$('.downloadapp').click(function(){
    $('.download-popup').show();
})
$('.closeovpnPopup').click(function(){
        $('.download-popup').hide();
    })

    /*$('.downloadovpn').click(function(){
        $('.download-popup').show();
    })

    */
})
<?php echo '</script'; ?>
>
<div class="tab-content margin-bottom">
    <div class="tab-pane fade in active" id="tabOverview">
        <div class="product-details clearfix">
            <div class="row">
                <div class="col-md-6">
                    <div class="product-status product-status-<?php echo strtolower($_smarty_tpl->tpl_vars['rawstatus']->value);?>
">
                        <div class="product-icon text-center">
                            <span class="fa-stack fa-lg">                            
                                <i class="fa fa-circle fa-stack-2x">
                                </i>                            
                                <i class="fa fa-television fa-stack-1x fa-inverse">
                                </i>                        
                            </span>                        
                            <h3><?php echo $_smarty_tpl->tpl_vars['product']->value;?>

                            </h3>
                            <h4><?php echo $_smarty_tpl->tpl_vars['groupname']->value;?>

                            </h4>
                        </div>
                        <div class="product-status-text">                        <?php echo $_smarty_tpl->tpl_vars['status']->value;?>
                    
                        </div>
                    </div>
                    <?php echo $_smarty_tpl->tpl_vars['unsuspend']->value;?>
  
                    <!--button class="btn btn-info btn-lg vpndetailsbtn text-center" style="width: 100%;">VIEW VPN DETAILS</button-->
                </div>

                <div class="col-lg-6">
                    <div  class="panel panel-default panel-accent-green">
                        <div class="panel-heading">
                            <h3 class="panel-title">                            
                                <i class="fa fa-info">
                                </i>&nbsp;Product Details                        
                            </h3>
                        </div>
                        <div class="list-group">
                            <div class="list-group-item" >                            Product : 
                                <strong class="text-domain"><?php echo $_smarty_tpl->tpl_vars['product']->value;?>
 - <?php echo $_smarty_tpl->tpl_vars['groupname']->value;?>

                                </strong>                        
                            </div>
                            <div class="list-group-item" >                            <?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareastatus'];?>
 : 
                                <span class="label status status-<?php echo $_smarty_tpl->tpl_vars['rawstatus']->value;?>
" style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['status']->value;?>

                                </span>                        
                            </div>
                            <div class="list-group-item" >                            <?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareahostingregdate'];?>
 : 
                                <strong class="text-domain"> <?php echo $_smarty_tpl->tpl_vars['regdate']->value;?>

                                </strong>                        
                            </div>
                            <div style="color:red" class="list-group-item" >                    <?php if ($_smarty_tpl->tpl_vars['nextduedate']->value == '' || $_smarty_tpl->tpl_vars['nextduedate']->value == '-') {?> Exp Date<?php } else {
echo $_smarty_tpl->tpl_vars['LANG']->value['clientareahostingnextduedate'];
}?> : 
                                <strong style="color:red" class="text-domain"><?php if ($_smarty_tpl->tpl_vars['nextduedate']->value == '' || $_smarty_tpl->tpl_vars['nextduedate']->value == '-') {
if ($_smarty_tpl->tpl_vars['exp_date']->value != '') {
echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['exp_date']->value,"%A, %B %e, %Y");
} else { ?>-<?php }
} else {
echo $_smarty_tpl->tpl_vars['nextduedate']->value;
}?>
                                </strong>                
                            </div>
                            <div class="list-group-item" >                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['recurringamount'];?>
 : 
                                <strong class="text-domain"><?php echo $_smarty_tpl->tpl_vars['recurringamount']->value;?>

                                </strong>                
                            </div>
                            <div class="list-group-item" >                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderbillingcycle'];?>
 : 
                                <strong class="text-domain"> <?php echo $_smarty_tpl->tpl_vars['billingcycle']->value;?>

                                </strong>                
                            </div>
                            <div class="list-group-item" >                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderpaymentmethod'];?>
 : 
                                <strong class="text-domain"><?php echo $_smarty_tpl->tpl_vars['paymentmethod']->value;?>

                                </strong>                
                            </div>
                            <div class="list-group-item" >                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['firstpaymentamount'];?>
 : 
                                <strong class="text-domain"><?php echo $_smarty_tpl->tpl_vars['firstpaymentamount']->value;?>

                                </strong>                
                            </div> 
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['extracustomfields']->value, 'customfieldvalue', false, 'customfieldname');
$_smarty_tpl->tpl_vars['customfieldvalue']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['customfieldname']->value => $_smarty_tpl->tpl_vars['customfieldvalue']->value) {
$_smarty_tpl->tpl_vars['customfieldvalue']->do_else = false;
?>

                                <div class="list-group-item" >
                                    <?php echo $_smarty_tpl->tpl_vars['customfieldname']->value;?>


                                    <strong class="text-domain">
                                        <?php echo $_smarty_tpl->tpl_vars['customfieldvalue']->value;?>

                                    </strong>                
                                </div>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            <?php if ($_smarty_tpl->tpl_vars['configurableoptions']->value) {?>  
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['configurableoptions']->value, 'configoption');
$_smarty_tpl->tpl_vars['configoption']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['configoption']->value) {
$_smarty_tpl->tpl_vars['configoption']->do_else = false;
?>                        
                                    <div class="list-group-item" >                            
                                        <?php echo $_smarty_tpl->tpl_vars['configoption']->value['optionname'];?>
                             
                                        <strong class="text-domain">    
                                            <?php if ($_smarty_tpl->tpl_vars['configoption']->value['optiontype'] == 3) {?>
                                                <?php if ($_smarty_tpl->tpl_vars['configoption']->value['selectedqty']) {?>
                                                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['yes'];?>

                                                <?php } else { ?>
                                                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['no'];?>

                                                <?php }?>
                                            <?php } elseif ($_smarty_tpl->tpl_vars['configoption']->value['optiontype'] == 4) {?>
                                                <?php echo $_smarty_tpl->tpl_vars['configoption']->value['selectedqty'];?>
 x <?php echo $_smarty_tpl->tpl_vars['configoption']->value['selectedoption'];?>

                                            <?php } else { ?>
                                                <?php echo $_smarty_tpl->tpl_vars['configoption']->value['selectedoption'];?>

                                            <?php }?>            
                                        </strong>
                                    </div>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            <?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['lastupdate']->value) {?>
                                <div class="list-group-item" >        <?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareadiskusage'];?>
 : 
                                    <strong class="text-domain"><?php echo $_smarty_tpl->tpl_vars['diskusage']->value;?>
MB / <?php echo $_smarty_tpl->tpl_vars['disklimit']->value;?>
MB (<?php echo $_smarty_tpl->tpl_vars['diskpercent']->value;?>
)
                                    </strong>    
                                </div>
                                <div class="list-group-item" >        <?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareabwusage'];?>
 : 
                                    <strong class="text-domain"><?php echo $_smarty_tpl->tpl_vars['bwusage']->value;?>
MB / <?php echo $_smarty_tpl->tpl_vars['bwlimit']->value;?>
MB (<?php echo $_smarty_tpl->tpl_vars['bwpercent']->value;?>
)
                                    </strong>    
                                </div>
                            <?php }?> <?php if ($_smarty_tpl->tpl_vars['suspendreason']->value) {?>    
                                <div class="list-group-item" >        <?php echo $_smarty_tpl->tpl_vars['LANG']->value['suspendreason'];?>
 : 
                                    <strong class="text-domain"><?php echo $_smarty_tpl->tpl_vars['suspendreason']->value;?>

                                    </strong>    
                                </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['hookOutput']->value, 'output');
$_smarty_tpl->tpl_vars['output']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['output']->value) {
$_smarty_tpl->tpl_vars['output']->do_else = false;
?>    
            <div>        <?php echo $_smarty_tpl->tpl_vars['output']->value;?>
    
            </div>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>  
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['BASE_PATH_JS']->value;?>
/bootstrap-tabdrop.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript">    jQuery('.nav-tabs-overflow').tabdrop();<?php echo '</script'; ?>
> 
    </div>
    <div class="tab-pane fade out" id="tabDownloads">
        <h3><?php echo $_smarty_tpl->tpl_vars['LANG']->value['downloadstitle'];?>
</h3>
        <?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"clientAreaProductDownloadsAvailable"),$_smarty_tpl ) );
$_prefixVariable3=ob_get_clean();
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"info",'msg'=>$_prefixVariable3,'textcenter'=>true), 0, true);
?>
        <div class="row">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['downloads']->value, 'download');
$_smarty_tpl->tpl_vars['download']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['download']->value) {
$_smarty_tpl->tpl_vars['download']->do_else = false;
?>
                <div class="col-xs-10 col-xs-offset-1">
                    <h4><?php echo $_smarty_tpl->tpl_vars['download']->value['title'];?>
</h4>
                    <p>
                        <?php echo $_smarty_tpl->tpl_vars['download']->value['description'];?>

                    </p>
                    <p>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['download']->value['link'];?>
" class="btn btn-default"><i class="fa fa-download"></i> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['downloadname'];?>
</a>
                    </p>
                </div>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </div>
    </div>
    <div class="tab-pane fade out" id="tabAddons">
        <h3><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareahostingaddons'];?>
</h3>
        <?php if ($_smarty_tpl->tpl_vars['addonsavailable']->value) {?>
            <?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"clientAreaProductAddonsAvailable"),$_smarty_tpl ) );
$_prefixVariable4=ob_get_clean();
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"info",'msg'=>$_prefixVariable4,'textcenter'=>true), 0, true);
?>
        <?php }?>
        <div class="row">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['addons']->value, 'addon');
$_smarty_tpl->tpl_vars['addon']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['addon']->value) {
$_smarty_tpl->tpl_vars['addon']->do_else = false;
?>
                <div class="col-xs-10 col-xs-offset-1">
                    <h4><?php echo $_smarty_tpl->tpl_vars['addon']->value['name'];?>
</h4>
                    <p>
                        <?php echo $_smarty_tpl->tpl_vars['addon']->value['pricing'];?>

                    </p>
                    <p>
                        <?php echo $_smarty_tpl->tpl_vars['LANG']->value['registered'];?>
: <?php echo $_smarty_tpl->tpl_vars['addon']->value['regdate'];?>

                    </p>
                    <p>
                        <?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareahostingnextduedate'];?>
: <?php echo $_smarty_tpl->tpl_vars['addon']->value['nextduedate'];?>

                    </p>
                    <p>
                        <span class="label status-<?php echo strtolower($_smarty_tpl->tpl_vars['addon']->value['rawstatus']);?>
"><?php echo $_smarty_tpl->tpl_vars['addon']->value['status'];?>
</span>
                    </p>
                </div>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </div>
    </div>
    <div class="tab-pane fade out" id="tabChangepw">
        <h3><?php echo $_smarty_tpl->tpl_vars['LANG']->value['serverchangepassword'];?>
</h3>
        <?php if ($_smarty_tpl->tpl_vars['modulechangepwresult']->value) {?>
            <?php if ($_smarty_tpl->tpl_vars['modulechangepwresult']->value == "success") {?>
                <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"success",'msg'=>$_smarty_tpl->tpl_vars['modulechangepasswordmessage']->value,'textcenter'=>true), 0, true);
?>
            <?php } elseif ($_smarty_tpl->tpl_vars['modulechangepwresult']->value == "error") {?>
                <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"error",'msg'=>preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['modulechangepasswordmessage']->value),'textcenter'=>true), 0, true);
?>
            <?php }?>
        <?php }?>
        <form class="form-horizontal using-password-strength" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>
?action=productdetails#tabChangepw" role="form">
            <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" />
            <input type="hidden" name="modulechangepassword" value="true" />
            <div id="newPassword1" class="form-group has-feedback">
                <label for="inputNewPassword1" class="col-sm-5 control-label"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['newpassword'];?>
</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="inputNewPassword1" name="newpw" autocomplete="off" />
                    <span class="form-control-feedback glyphicon"></span>
                    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/pwstrength.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
                </div>
            </div>
            <div id="newPassword2" class="form-group has-feedback">
                <label for="inputNewPassword2" class="col-sm-5 control-label"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['confirmnewpassword'];?>
</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="inputNewPassword2" name="confirmpw" autocomplete="off" />
                    <span class="form-control-feedback glyphicon"></span>
                    <div id="inputNewPassword2Msg">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-6 col-sm-6">
                    <input class="btn btn-primary" type="submit" value="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareasavechanges'];?>
" />
                    <input class="btn" type="reset" value="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['cancel'];?>
" />
                </div>
            </div>
        </form>
    </div>
    <hr> 

    <?php echo '<script'; ?>
>$(document).ready(function () {
            $('.vpndetailsbtn').click(function () {
                $('#myModal').modal('show');
            })
        })<?php echo '</script'; ?>
>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">VPN Service Details</h4>
                </div>
                <div class="modal-body">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['extracustomfields']->value, 'customfieldvalue', false, 'customfieldname');
$_smarty_tpl->tpl_vars['customfieldvalue']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['customfieldname']->value => $_smarty_tpl->tpl_vars['customfieldvalue']->value) {
$_smarty_tpl->tpl_vars['customfieldvalue']->do_else = false;
?>

                        <div class="list-group-item" >
                            <?php echo $_smarty_tpl->tpl_vars['customfieldname']->value;?>


                            <strong class="text-domain">
                                <?php echo $_smarty_tpl->tpl_vars['customfieldvalue']->value;?>

                            </strong>                
                        </div>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
    <h3 class="text-center">Connect VPN</h3>
        <div class="col-md-6">
            <div  class="panel panel-default panel-accent-green">
                <div class="panel-heading">
                    <h3 class="panel-title" style="font-size: 20px;">                            
                        <i class="fa fa-info">
                        </i>&nbsp;App Login Details                        
                    </h3>
                </div>
                <div class="list-group">
                    <div class="list-group-item" >App Username : 
                        <strong class="text-domain"><?php echo $_smarty_tpl->tpl_vars['clientEmail']->value;?>
</strong>                        
                    </div>
                </div>
                <div class="list-group">
                    <div class="list-group-item" >App Password : 
                        <strong class="text-domain">Your Login Password</strong>                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
        
        <button name="downloadapp" class="btn btn_new_here downloadapp" style="position: relative; height: 50px; background-size: contain;"> Download Application  <i class="fa fa-download download_icn_set" aria-hidden="true"></i>
                </button>
               
                <form method="POST">
                    <input type="hidden" name="serviceid" value="<?php echo $_smarty_tpl->tpl_vars['serviceid']->value;?>
"/>
                    <input type="submit" name="generate_code" class="btn btn_new_here1" style="position: relative; height: 50px; background-size: contain;" value="Generate QR Code"/>
                </form>  
        </div>
                    
    </div> 
    <div class="col-md-12 text-center mapbtn" style="">
        <a href="map.php" style="">View Map <i class="fa fa-map"></i></a></div>
    <hr>
    <style>
    .mapbtn
    {
        background:url('modules/servers/vpnservernoapi/templates/images/map.png'); 
        float: left; 
        padding: 0px;
        border-radius: 5px; 
        overflow: hidden; 
        box-shadow: 0px 0px 10px -4px #000;
    }
    
    .mapbtn a
    {
       transition: 0.5s; width: 100%; padding: 40px; background: rgba(0, 0, 0, 0.5); color:#fff; font-size: 25px; float: left;text-transform: uppercase; text-shadow: 2px 1px 1px #000; text-decoration: none !important;
    }
    .mapbtn a:hover{
        color: #ffac36;
text-shadow: -2px 1px 1px #3e3e3e;
transform: scale(1.05);
transition: 0.5s;
    }
    </style>
    <div class="row new_custom1"> 
        <?php if ($_smarty_tpl->tpl_vars['moduleParams']->value['status'] == 'Active') {?> 
                <div class="download-popup" style="width: 100%; height: 100%; position: fixed; overflow-y: auto; top: 0px; left: 0px; background: rgba(0, 0, 0, 0.5); display: none; z-index: 99999;">
                <div class="col-md-6 col-md-offset-3" style="margin-top: 100px; background: #fff; padding: 10px;">
                    <?php if (count($_smarty_tpl->tpl_vars['appdata']->value) > 0) {?>
        
            <h3 class="text-center">Choose Your Platform</h3>

            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['appdata']->value, 'applidata', false, 'apptype');
$_smarty_tpl->tpl_vars['applidata']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['apptype']->value => $_smarty_tpl->tpl_vars['applidata']->value) {
$_smarty_tpl->tpl_vars['applidata']->do_else = false;
?>
                <?php ob_start();
echo $_smarty_tpl->tpl_vars['apptype']->value;
$_prefixVariable5 = ob_get_clean();
if ($_prefixVariable5 == 'android') {?>
                    <div class="col-md-3" style="padding: 10px; background:#eaeaea; border-radius: 5px; height: 212px; border: solid 3px #fff;"><center><!--img src="https://image.flaticon.com/icons/png/512/174/174836.png" height="100px"--><i class="fa fa-android fa-5x"></i></center>
                        <h3 class="text-center">Android APP</h3>
                        <center style="position: absolute; bottom: 12px; width: 88%;"><a href="<?php echo $_smarty_tpl->tpl_vars['applidata']->value;?>
" class="btn btn-success" style="font-size: 12px; ">DOWNLOAD NOW</a></center>
                    </div>
                <?php }?>
                <?php ob_start();
echo $_smarty_tpl->tpl_vars['apptype']->value;
$_prefixVariable6 = ob_get_clean();
if ($_prefixVariable6 == 'ios') {?>
                    <div class="col-md-3" style="padding: 10px; background:#eaeaea; border-radius: 5px; height: 212px; border: solid 3px #fff;"><center><!--img src="https://toppng.com/uploads/preview/ios-11-app-store-icon-apple-app-store-icon-1156298730556uxorxnhg.png" height="100px"--><i class="fa fa-apple fa-5x"></i></center>
                        <h3 class="text-center">IOS APP</h3>
                        <center style="position: absolute; bottom: 12px; width: 88%;"><a href="<?php echo $_smarty_tpl->tpl_vars['applidata']->value;?>
" class="btn btn-success" style="font-size: 12px;">DOWNLOAD NOW</a></center>
                    </div>
                <?php }?>
                <?php ob_start();
echo $_smarty_tpl->tpl_vars['apptype']->value;
$_prefixVariable7 = ob_get_clean();
if ($_prefixVariable7 == 'linux') {?>
                    <div class="col-md-3" style="padding: 10px; background:#eaeaea; border-radius: 5px; border: solid 3px #fff; height: 212px;"><center><!--img src="http://assets.stickpng.com/thumbs/58480e82cef1014c0b5e4927.png" height="100px"--><i class="fa fa-linux fa-5x"></i></center>
                        <h3 class="text-center">Linux APP</h3>
                        <center style="position: absolute; bottom: 12px; width: 88%;"><a href="<?php echo $_smarty_tpl->tpl_vars['applidata']->value;?>
" class="btn btn-success" style="font-size: 12px;">DOWNLOAD NOW</a></center>
                    </div>
                <?php }?>
                <?php ob_start();
echo $_smarty_tpl->tpl_vars['apptype']->value;
$_prefixVariable8 = ob_get_clean();
if ($_prefixVariable8 == 'windows') {?>
                    <div class="col-md-3" style="padding: 10px; background:#eaeaea; border-radius: 5px; height: 212px; border: solid 3px #fff;"><center><!--img src="https://carlisletheacarlisletheatre.org/images/windows-icon-transparent-1.jpg" height="100px"--><i class="fa fa-windows fa-5x"></i></center>
                        <h3 class="text-center">Windows APP</h3>
                        <center style="position: absolute; bottom: 12px; width: 88%;"><a href="<?php echo $_smarty_tpl->tpl_vars['applidata']->value;?>
" class="btn btn-success" style="font-size: 12px;">DOWNLOAD NOW</a></center>
                    </div>
                <?php }?>
                
                <?php ob_start();
echo $_smarty_tpl->tpl_vars['apptype']->value;
$_prefixVariable9 = ob_get_clean();
if ($_prefixVariable9 == 'macos') {?>
                    <div class="col-md-3" style="padding: 10px; background:#eaeaea; border-radius: 5px; height: 212px; border: solid 3px #fff;"><center><!--img src="https://carlisletheacarlisletheatre.org/images/windows-icon-transparent-1.jpg" height="100px"--><i class="fa fa-desktop fa-5x"></i></center>
                        <h3 class="text-center">MacOS APP</h3>
                        <center style="position: absolute; bottom: 12px; width: 88%;"><a href="<?php echo $_smarty_tpl->tpl_vars['applidata']->value;?>
" class="btn btn-success" style="font-size: 12px;">DOWNLOAD NOW</a></center>
                    </div>
                <?php }?>

            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        
    <?php }?>
                <div class="col-md-12">
                <button class="btn btn-default closeovpnPopup pull-right" type="button">Cancel</button>
                </div>
                </div>
                </div>
            <?php }?>      
        <div class="col-sm-12"> 
            <div class="row">
                 <h3 class="text-center">Other Options</h3>
                 <?php if ($_smarty_tpl->tpl_vars['settings']->value['vpndetails'] == 'on') {?>
                 <div class="col-md-6">
<div  class="panel panel-default panel-accent-green">
                    <div class="panel-heading">
                        <h3 class="panel-title" style="font-size: 20px;">                            
                            <i class="fa fa-info">
                            </i>&nbsp;VPN Login Details                        
                        </h3>
                    </div>

                    <div class="list-group">
                        <div class="list-group-item" >VPN Username:  
                            <strong class="text-domain"><?php echo $_smarty_tpl->tpl_vars['vpnusername']->value;?>
</strong>                        
                        </div>
                        <div class="list-group-item" >VPN Password:  
                            <strong class="text-domain"><?php echo $_smarty_tpl->tpl_vars['vpnpassword']->value;?>
</strong>                        
                        </div>
                    </div>

            </div>
                 </div>
                 <?php }?>
                 <?php if ($_smarty_tpl->tpl_vars['settings']->value['downloadcert'] == 'on') {?>
                 <div class="col-md-6">

 <form method="post">
    <input type="hidden" name="customAction" value="downloadcert" />
    <button type="submit" class="btn btn_new_here" style="padding-top: 7px; position: relative; float: left;"> Download Cert. Files  <i class="fa fa-download download_icn_set" aria-hidden="true"></i></button>
  </form>
                </a>
               
                 </div>
                 <?php }?>
            </div>

        </div>
    </div> 
    <?php if (!empty($_smarty_tpl->tpl_vars['qrcode_image']->value)) {?>  
        <div class="modal" id="qrmodel">
            <div class="modal-dialog">
                <div class="modal-content"> 
                    <div class="modal-header">
                        <h4 class="modal-title" style="float: left;text-align: center;">Scan Your QR Code</h4>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div> 
                    <div class="modal-body">
                        <center><div class="qr_image_container">
                                <img src="<?php echo $_smarty_tpl->tpl_vars['qrcode_image']->value;?>
">
                            </div></center>
                        <p style="font-size: 15px;font-weight: bold;font-family:Arial inherit;text-align:center;">"Use code to login to your APP!!"</p>
                        <?php echo '<script'; ?>
 type="text/javascript">
                            $(document).ready(function () {
                                $("#qrmodel").modal();
                                $('html, body').animate({
                                    scrollTop: $('.qr_image_container').offset().top - 20 //#DIV_ID is an example. Use the id of your destination on the page
                                }, 'slow');
                            });
                        <?php echo '</script'; ?>
>
                    </div> 
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div> 
    <?php }?>
    <hr> 
    
    <p class="alert alert-info text-center" style="font-size: 21px;margin-top: 20px; float: left; width: 100%;">Need a help? <a href="<?php echo $_smarty_tpl->tpl_vars['systemURL']->value;?>
index.php?rp=/knowledgebase" class="btn btn-info" target="_blank">Knowledgebase</a></p>

</div>
<!--  <div class="row new_custom2">
<p>You are using a free trial product that will expire on "Nov 30,2017"</p>
<button type="button" class="btn_custom1">Buy Subscription
    </button><button type="button" class="btn_custom2">Setup Guide
</button>
</div>  -->







<?php }
}
