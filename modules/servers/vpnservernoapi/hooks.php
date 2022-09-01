<?php
use Illuminate\Database\Capsule\Manager as Capsule;

include_once('../../../init.php');
add_hook('AdminAreaHeadOutput', 1, function($vars) {
    if ($vars['filename'] == 'configproducts') {
        $serverList = Capsule::table('server_list')->where('mainserver','0')->where('status',1)->get();
        $serverListHtml = '<label><input type="checkbox" class="selectall"> Select All</label><br />';
        foreach($serverList as $server)
        {
            $serverListHtml.= '<label><input type="checkbox" name="servers[]" class="servercheck" id="server_'.$server->server_id.'" value="'.$server->server_id.'"> '.$server->server_name.'</label><br />';
        }
        $pid = $_GET['id'];
        return $head_return = '
       <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
                <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
            <script type="text/javascript">
            
               function customfield(){  
               if($("#conf-dialog-custom-field").is(":data(dialog)"))
                        {
                            $("#conf-dialog-custom-field").dialog("destroy"); 
                        }
                        $("#conf-dialog-custom-field").attr("title", "Product Custom Fields");
                        $("#conf-dialog-custom-field").html("<p style=\"text-align:center\"><img src=\"images/loading.gif\" alt=\"loading...\"/></p>");
                        $("#conf-dialog-custom-field").dialog({minWidth: 650}); 
                        val = $(this).parent().find("input").val(); 
                        
                         jQuery.post("../modules/servers/vpnservernoapi/vpnconfig.php",{stormajax:"create-config",id:"' . $_REQUEST['id'] . '"}, function(data){
                            $("#conf-dialog-custom-field").html(data);
                        });
                   } 
                   
                   function getUsers(){  
                        var serverURL = $(document).find("input[name=\'packageconfigoption[3]\']").val();
                        if(serverURL !== "" || serverURL !== undefined)
                        {
                         jQuery.post("../modules/servers/vpnservernoapi/vpnconfig.php",{action:"getUsers"}, function(data){
                            $("#conf-dialog-custom-field").html(data);
                        });
                        }
                   } 
                   
                   function assignserver()
                   {
                   var selectedserver = [];
                    $(document).find(".servercheck").each(function(){
                    if($(this).is(":checked"))
                    {
                        selectedserver.push($(this).val());
                    }
                   
                   })
                   var serverimplode = selectedserver.join();
                  
                    $(document).find("input[name=\'packageconfigoption[4]\']").val(serverimplode);
                    $(document).find("#assignserver").modal("hide");
                   }
                   
                   function showserverlist()
                   {
                    var selectedservers = $(document).find("input[name=\'packageconfigoption[4]\']").val();
                    var splitselectedservers = selectedservers.split(",");
                    
                    $(".servercheck").prop("checked",false);
                    for(var i = 0; i<splitselectedservers.length; i++)
                    {
                    
                        $(document).find("#server_"+splitselectedservers[i]+"").prop("checked",true);
                    }
                    $(document).find("#assignserver").modal("show");
                   }
                   
                   $(document).ready(function(){
                   $(".selectall").click(function(){
                   if($(this).is(":checked"))
                   {
                   $(document).find(".servercheck").each(function(){
                   $(this).prop("checked",true);
                   })
                   }
                   else
                   {
                   $(document).find(".servercheck").each(function(){
                   $(this).prop("checked",false);
                   })
                   }
                   
                   })
                   
                    $(document).ajaxComplete(function(){
                    
                   
                    if($(document).find("select[name=\'packageconfigoption[1]\']").val() == "resellerCredits")
                      {
                          $(document).find("input[name=\'packageconfigoption[2]\']").attr("disabled",false)
                          $(document).find("input[name=\'packageconfigoption[3]\']").attr("disabled","disabled")
                          
                      }
                      else if($(document).find("select[name=\'packageconfigoption[1]\']").val() == "resellerAccount")
                      {
                          $(document).find("input[name=\'packageconfigoption[2]\']").attr("disabled",false)
                          $(document).find("input[name=\'packageconfigoption[3]\']").attr("disabled","disabled")
                          
                      }
                      else if($(document).find("select[name=\'packageconfigoption[1]\']").val() == "superresellerAccount")
                      {
                          $(document).find("input[name=\'packageconfigoption[2]\']").attr("disabled",false)
                          $(document).find("input[name=\'packageconfigoption[3]\']").attr("disabled","disabled")
                          
                      }
                      else
                      {
                          $(document).find("input[name=\'packageconfigoption[2]\']").attr("disabled","disabled")
                          $(document).find("input[name=\'packageconfigoption[3]\']").attr("disabled",false)
                          
                      }
                       $(document).find("select[name=\'packageconfigoption[1]\']").change(function(){
                      if($(this).val() == "resellerCredits")
                      {
                          $(document).find("input[name=\'packageconfigoption[2]\']").attr("disabled",false)
                          $(document).find("input[name=\'packageconfigoption[3]\']").attr("disabled","disabled")
                          
                      }
                      else if($(this).val() == "resellerAccount")
                      {
                          $(document).find("input[name=\'packageconfigoption[2]\']").attr("disabled",false)
                          $(document).find("input[name=\'packageconfigoption[3]\']").attr("disabled","disabled")
                          
                      }
                      else if($(this).val() == "superresellerAccount")
                      {
                          $(document).find("input[name=\'packageconfigoption[2]\']").attr("disabled",false)
                          $(document).find("input[name=\'packageconfigoption[3]\']").attr("disabled","disabled")
                          
                      }
                      else
                      {
                          $(document).find("input[name=\'packageconfigoption[2]\']").attr("disabled","disabled")
                          $(document).find("input[name=\'packageconfigoption[3]\']").attr("disabled",false)
                          
                      }
                   })
                   })
                   })
                   
              </script>
              <div class="modal fade in" id="assignserver">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Assign Servers To Product</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <form id="server_frm1" name="server_frm" novalidate="novalidate" method="post" action="" class="fv-form fv-form-bootstrap">
                            
                                <div class="modal-body">
                                    '.$serverListHtml.'
                                    </div>
                                
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button class="btn btn-primary assignPackageBtn" onclick="assignserver();" type="button">Save changes <i class="fa fa-spin fa-spinner loading" style="display: none;"></i></button>

                                </div>
                            
                        </div>
                    </div>
                </div>
              <div id="conf-dialog-custom-field" title="">
              </div>';
    }
    
    
    
});

add_hook('AdminAreaHeadOutput', 1, function($vars) {
    if($vars['filename'] == 'clientsservices')
    {
       // echo '<pre>'; echo $vars['jscode']; die();
        $userid = $_REQUEST['userid'];
        $id = $_REQUEST['id'];
        $tkval = $_SESSION['tkval'];
    return <<<HTML
<script type="text/javascript">
$(document).ready(function(){
$(document).find('#modcmdbtns').append('<button type="button" class="btn btn-default" id="btnUpdate">Update</button>')
    var oldusername = $(document).find('input[name="username"]').val();
    var oldpassword = $(document).find('input[name="password"]').val();
    
    $('#btnUpdate').click(function(){
    var cmd = 'custom';
    var custom = 'update';
    
    var username = $(document).find('input[name="username"]').val();
    var password = $(document).find('input[name="password"]').val();
    
    var reqstr = "token="+csrfToken+"&userid={$userid}&id={$id}&modop="+cmd+"&ajax=1&olduname="+oldusername+"&oldpws="+oldpassword+"&uname="+username+"&pws="+password+"";
    if (custom) {
        reqstr += "&ac="+custom;
    } else if (cmd == "suspend") {
        reqstr += "&suspreason="+encodeURIComponent($("#suspreason").val())+"&suspemail="+$("#suspemail").is(":checked");
    } else if (cmd == "unsuspend") {
        reqstr += "&unsuspended_email=" + jQuery("#unsuspended_email").is(":checked");
    }

    $.post("clientsservices.php", reqstr,
    function(data){
    swal('Success','User Updated Successfully','success');
    window.location.reload();
//    if (data.success && data.redirect) {
//            data = data.redirect;
//        }
//
//        if (data.substr(0,9)=="redirect|") {
//            window.location = data.substr(9);
//        } else if (data.substr(0,7)=="window|") {
//            window.open(data.substr(7), '_blank');
//            commandButtons.css("filter","alpha(opacity=100)");
//            commandButtons.css("-moz-opacity","1");
//            commandButtons.css("-khtml-opacity","1");
//            commandButtons.css("opacity","1");
//            commandWorking.fadeOut();
//        } else {
//            $("#servicecontent").html(data);
//        }
    });
    })
})
</script>
HTML;
}

if($vars['filename'] == 'configproducts' && isset($_REQUEST['id']) && $_REQUEST['action'] =='edit')
{   
    $productid = $_REQUEST['id'];
    $productData = Capsule::table('tblproducts')->where('id',$productid)->get();
    
    if($productData[0]->configoption1 == 'resellerAccount')
    {
        Capsule::table('tblproducts')->where('id',$productid)->update(['type'=> 'reselleraccount']);
    }
    else if($productData[0]->configoption1 == 'superresellerAccount')
    {
        Capsule::table('tblproducts')->where('id',$productid)->update(['type'=> 'reselleraccount']);
    }
    else
    {
        Capsule::table('tblproducts')->where('id',$productid)->update(['type'=> 'other']);
    }
}

});
