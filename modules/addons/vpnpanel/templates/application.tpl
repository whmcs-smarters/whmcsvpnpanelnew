<div class="row">
    <div class="col-md-12"><nav aria-label="breadcrumb">
  <ol class="breadcrumb">
      {$breadcrumb}
  </ol>
</nav></div>
    <div class="col-md-12"><h2 class="pull-left">Upload Application Links</h2><button class="btn btn-info pull-right" id="addserverbtn"><i class="fa fa-plus"></i> Add Application</button></div>
    </div>
<h5>Here, you can add your application link that will be displayed in the client area for your customers, so they can download your VPN Application and connect to the VPN </h5>


<!--button class="btn btn-warning pull-right" id="reloadserverbtn"><i class="fa fa-refresh"></i> Applications List</button-->
<div class="message" style="float: left; width: 100%;">{$message}</div>
<table class="table table-bordered table-striped" style="margin-top: 10px;">
<thead><tr><th>Application Type</th> <th>Name</th><th>Link</th><th>Action</th></tr></thead>
<tbody id="serverslist">
{$appdata}
</tbody>
</table>
<div class="modal fade" id="editServerModal" tabindex="-1" role="dialog" aria-labelledby="Edit Server" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit App Link</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="appeditfrm" name="server_frm" method="post" action="" novalidate="novalidate" class="fv-form fv-form-bootstrap">
      <div class="modal-body">
       <button type="submit" class="fv-hidden-submit" style="display: none; width: 0px; height: 0px;"></button>
										<input type="hidden" class="serveridedit">
										<div class="row">
											<div class="form-group control-group col-md-6">
												<div class="controls input-group">
													<label class="control-label input-group-addon" for="appname">Your App Name</label>
													<input class="form-control" id="appname" name="appname" placeholder="App Name" data-fv-field="appname">
												</div>
											<small style="display: none;" class="help-block" data-fv-validator="notEmpty" data-fv-for="server_name" data-fv-result="NOT_VALIDATED"></small><small style="display: none;" class="help-block" data-fv-validator="stringLength" data-fv-for="server_name" data-fv-result="NOT_VALIDATED"></small></div>
											<div class="form-group control-group col-md-6">
												<div class="controls input-group">
													<label class="control-label input-group-addon" for="appfor">App Type</label>
													<select class="form-control" id="appfor" name="appfor">
													<option value="android">Android</option>
													<option value="windows">Windows</option>
													<option value="ios">IOS</option>
													<option value="linux">Linux</option>
                          <option value="macos">Mac OS</option></select>
												</div>
											<small style="display: none;" class="help-block" data-fv-validator="notEmpty" data-fv-for="server_name" data-fv-result="NOT_VALIDATED"></small><small style="display: none;" class="help-block" data-fv-validator="stringLength" data-fv-for="server_name" data-fv-result="NOT_VALIDATED"></small></div>
											<div class="form-group control-group col-md-12">
												<div class="controls input-group">
													<label class="control-label input-group-addon" for="applink">Download Link</label>
													<input class="form-control" id="applink" name="applink" placeholder="http://url/to/app.apk" data-fv-field="applink">
												</div>
											<small style="display: none;" class="help-block" data-fv-validator="notEmpty" data-fv-for="server_ip" data-fv-result="NOT_VALIDATED"></small></div>
										</div>
										
										
									
										
								
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="editapp" id="updatebtn">Save changes <i class="fa fa-spin fa-spinner loading" style="display: none;"></i></button>
      </div>
      	</form>
    </div>
  </div>
</div>

<!--Add New Server Modal Form start-->


<div class="modal fade" id="addServerModal" tabindex="-1" role="dialog" aria-labelledby="Add New Server" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New App</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="server_frm1" name="server_frm" novalidate="novalidate" method="post" action="" class="fv-form fv-form-bootstrap">
      <div class="modal-body">
       <button type="submit" class="fv-hidden-submit" style="display: none; width: 0px; height: 0px;"></button>
										
										<div class="row">
											<div class="form-group control-group col-md-6">
												<div class="controls input-group">
													<label class="control-label input-group-addon" for="appname1">Your App Name</label>
													<input class="form-control" id="appname1" name="appname" placeholder="Eg. VPN Smarters or ABC VPN" data-fv-field="appname">
												</div>
											<small style="display: none;" class="help-block" data-fv-validator="notEmpty" data-fv-for="server_name" data-fv-result="NOT_VALIDATED"></small><small style="display: none;" class="help-block" data-fv-validator="stringLength" data-fv-for="server_name" data-fv-result="NOT_VALIDATED"></small></div>
											<div class="form-group control-group col-md-6">
												<div class="controls input-group">
													<label class="control-label input-group-addon" for="appfor">App Type</label>
													<select class="form-control" id="appfor1" name="appfor">
													<option value="android">Android</option>
													<option value="windows">Windows</option>
													<option value="ios">IOS</option>
													<option value="linux">Linux</option>
                          <option value="macos">Mac OS</option></select>

												</div>
											<small style="display: none;" class="help-block" data-fv-validator="notEmpty" data-fv-for="server_name" data-fv-result="NOT_VALIDATED"></small><small style="display: none;" class="help-block" data-fv-validator="stringLength" data-fv-for="server_name" data-fv-result="NOT_VALIDATED"></small></div>
											
											<div class="form-group control-group col-md-12">
												<div class="controls input-group">
													<label class="control-label input-group-addon" for="applink1">Download Link</label>
													<input class="form-control" id="applink1" name="applink" placeholder="http://url/to/app.apk" data-fv-field="applink">
												</div>
											<small style="display: none;" class="help-block" data-fv-validator="notEmpty" data-fv-for="server_ip" data-fv-result="NOT_VALIDATED"></small></div>
										</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" name="addapp" id="addbtn">Save changes <i class="fa fa-spin fa-spinner loading" style="display: none;"></i></button>
      </div>
      	</form>
    </div>
  </div>
</div>
<div class="row">
    <a href="{$modulelink}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Go Back</a>
</div>
{literal}
<style>
.error
{
    border-color: #f00;
    box-shadow: 0px 0px 5px -2px;
}
</style>

<script>
$(document).ready(function(){
  $('#addbtn').click(function(){
    addapp();
  })
    $(document).find('.deleteapp').click(function(e){
         
        $(this).children('.loading').show();
        var appid = $(this).data('appid');
    swal({
  title: "Are you sure?",
  text: "You will not be able to recover this imaginary file!",
  type: "warning",
  showCancelButton: true,
  confirmButtonClass: "btn-danger",
  confirmButtonText: "Yes, delete it!",
  closeOnConfirm: false
},
function(){
$.ajax({
      type: 'POST',
      url: "addonmodules.php?module=vpnpanel&action=vpn_applinks",
      data: {deleteapp:true,appid:appid},
      dataType: "text",
      success: function(resultData) {
          swal.close();
        window.location.reload();
      }
});
})
    
    })
    {/literal}
{$script1}
var apiKey = '{$apikey}';
var panelUrl = '{$panelURL}';
{literal}
function addservermodal()
{
    $(document).find('#addServerModal').modal('show');
}
function addapp()
{
    var appname = $(document).find('#appname1').val();
   var applink = $(document).find('#applink1').val();
    var appfor = $(document).find('#appfor1').val();
    
    $.ajax({
      type: "POST",
      crossDomain: true,
      data: {addapp:true, appname:appname,applink:applink,appfor:appfor},
      dataType: "text",
      success: function(resultData){
          if(resultData == 'success')
          {
              swal("Success!", "App Added Successfully!", "success");
          window.location.replace('addonmodules.php?module=vpnpanel&action=vpn_applinks');
          }
          else
          {
              swal("Error!", "App Add Failed!", "danger");
              $(document).find('#addServerModal').modal('hide');
          //window.location.replace('addonmodules.php?module=vpnpanel&action=vpn_applinks');
          }
      }
    });
}


function deleteapp(e)
{
    
    $(this).children('.loading').show();
   
        var appid = $(this).data('appid');
    swal({
  title: "Are you sure?",
  text: "You will not be able to recover this imaginary file!",
  type: "warning",
  showCancelButton: true,
  confirmButtonClass: "btn-danger",
  confirmButtonText: "Yes, delete it!",
  closeOnConfirm: false
},
function(){
    $.ajax({
      type: "POST",
      crossDomain: true,
      data: {deleteapp:true, appid:appid},
      dataType: "text",
      success: function(resultData){
          if(resultData == 'success')
          {
              swal("Success!", "App Deleted Successfully!", "success");
          window.location.replace('addonmodules.php?module=vpnpanel&action=vpn_applinks');
          }
          else
          {
              swal("Error!", "App Delete Failed!", "danger");
              $(document).find('#addServerModal').modal('hide');
          //window.location.replace('addonmodules.php?module=vpnpanel&action=vpn_applinks');
          }
      }
    });

})
}
})
</script>
{/literal}