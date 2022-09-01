<div class="row">
    <div class="col-md-12"><nav aria-label="breadcrumb">
  <ol class="breadcrumb">
      {$breadcrumb}
  </ol>
</nav></div>
    <div class="col-md-12"><h2 class="pull-left">Assign Packages</h2>
    
    </div>
    </div>
<h5>Here, you can assign packages to single resller or to all resellers which will appear on reseller panel while adding user. </h5>
<br />

<!--button class="btn btn-warning pull-right" id="reloadserverbtn"><i class="fa fa-refresh"></i> Applications List</button-->
<div class="message" style="float: left; width: 100%;">{$message}</div>
<h4 style="float: left;">Assign Packages to Single Reseller</h4>
<button class="btn btn-info pull-right" id="addserverbtn"><i class="fa fa-plus"></i> Assign Packages to New Reseller</button>
<table class="table table-bordered table-striped" style="margin-top: 10px;">
<thead><tr><th>Reseller</th> <th>Package IDs</th><th>Action</th></tr></thead>
<tbody id="serverslist">
{$packagesdata}
</tbody>
</table>
<h4 style="float: left;">Assign Packages to Reseller Group</h4>
<button class="btn btn-info pull-right" id="addserverbtn1"><i class="fa fa-plus"></i> Assign Packages to Reseller Group</button>
<table class="table table-bordered table-striped" style="margin-top: 10px;">
<thead><tr><th>Reseller</th> <th>Package IDs</th><th>Action</th></tr></thead>
<tbody id="serverslist">
{$allpackagesdata}
</tbody>
</table>
<!--Add New Server Modal Form start-->
<div class="modal fade" id="addServerModal" tabindex="-1" role="dialog" aria-labelledby="Assign Packages" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Assign Packages</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="server_frm1" name="server_frm" novalidate="novalidate" method="post" action="" class="fv-form fv-form-bootstrap">
      <div class="modal-body">
       <button type="submit" class="fv-hidden-submit" style="display: none; width: 0px; height: 0px;"></button>
									
										<div class="row">
											<div class="form-group control-group col-md-12">
												<div class="controls input-group">
													<label class="control-label input-group-addon" for="appname1">Resellers</label>
													<select class="form-control" name="reseller" id="reseller">
													<option value="all" selected>All Resellers</option>
													{foreach item=reseller from=$resellers}
													<option value="{$reseller.clientid}">{$reseller.firstname} {$reseller.lastname}</option>
													{/foreach}</select>
												</div>
											<small style="display: none;" class="help-block" data-fv-validator="notEmpty" data-fv-for="server_name" data-fv-result="NOT_VALIDATED"></small><small style="display: none;" class="help-block" data-fv-validator="stringLength" data-fv-for="server_name" data-fv-result="NOT_VALIDATED"></small></div>
											</div>
											<div class="row">
											<div class="form-group control-group col-md-12">
    											<label style="width: 100%;"><input type="checkbox" class="selectall" value="all">Select All</label>
    											{foreach item=productgroup key=group from=$productsListarray}
    											<label style="background:#ccc; width: 100%; padding: 2px 7px;">{$group}</label>
    											{foreach item=product from=$productgroup}
    											<label style="width: 100%;"><input type="checkbox" class="all" value="{$product.id}">{$product.name}</label>
    											{/foreach}
    											{/foreach}
												
											<small style="display: none;" class="help-block" data-fv-validator="notEmpty" data-fv-for="server_name" data-fv-result="NOT_VALIDATED"></small><small style="display: none;" class="help-block" data-fv-validator="stringLength" data-fv-for="server_name" data-fv-result="NOT_VALIDATED"></small></div>
											
											</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" name="addassignpack" id="addbtn">Save changes <i class="fa fa-spin fa-spinner loading" style="display: none;"></i></button>
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
$('.editbtn').click(function(){
    var rid = $(this).data('id');
    editservermodal(rid);
})
    $('#addserverbtn').click(function(){
        addservermodal();
    })
    $('#addserverbtn1').click(function(){
    var rid = 'all';
    editservermodal(rid);
})
    
    
    
    $('.selectall').click(function(){
        if($(this).prop('checked'))
        {
        $('.all').prop('checked','checked');
        }
        else
        {
            $('.all').prop('checked','');
        }
    })
    
    {/literal}
{literal}
function addservermodal($rid)
{
    $('.all').prop('checked','');
    $('#reseller').removeAttr('disabled');
    var rid = $rid;
    alert(rid);
    $.ajax({
      type: 'POST',
      //url: "addonmodules.php?module=vpnpanel&action=vpn_assignPackages",
      data: {editassignpack:true, id:rid},
      dataType: "text",
      success: function(resultData) {
          resultData = $.parseJSON(resultData);
          console.log(resultData);
          var reseller = resultData.resellerid;
          var assignedpackages = resultData.products;
          var singlepackage = assignedpackages.split(',');
         $('#reseller').children('option').each(function(){
        for(var i = 0; i<singlepackage.length;i++)
          {
              $('.all').each(function(){
                  if($(this).val() == singlepackage[i])
                  {
                      $(this).prop('checked','checked');
                  }
              })
              
          }
              })
      }
    })
    $(document).find('#addServerModal').modal('show');
}
function editservermodal(rid)
{
    $.ajax({
      type: 'POST',
      //url: "addonmodules.php?module=vpnpanel&action=vpn_assignPackages",
      data: {editassignpack:true, id:rid},
      dataType: "text",
      success: function(resultData) {
          //console.log(resultData);return;
          if(resultData == '[]')
          {
              $(document).find('#addServerModal').modal('show');
          }
              else
              {
          resultData = $.parseJSON(resultData);
          
          var reseller = resultData.resellerid;
          var assignedpackages = resultData.products;
          var singlepackage = assignedpackages.split(',');
          //console.log(assignedpackages); return;
          $('#reseller').attr('disabled','disabled');
          $('.all').prop('checked','');
          $('#reseller').children('option').each(function(){
                  if($(this).val() == reseller)
                  {
                      $(this).attr('selected','selected');
                  }
                  else
                  {
                      $(this).removeAttr('selected');
                  }
              })
          for(var i = 0; i<singlepackage.length;i++)
          {
              $('.all').each(function(){
                  if($(this).val() == singlepackage[i])
                  {
                      $(this).prop('checked','checked');
                  }
              })
              
          }
          $('.modal-title').text('Edit Packages');
          $(document).find('#addServerModal').modal('show');
          }
          
      }
});
    
}
$('#addbtn').click(function(){
    addassignpack();
})
function addassignpack()
{
    $('#reseller').removeAttr('disabled');
    var reseller = $(document).find('#reseller').val();
    var packages = '';
    
    $(document).find('.all').each(function(){
        if($(this).prop('checked'))
        {
            packages = $(this).val()+','+packages;
        }
    })
    $.ajax({
      type: "POST",
      crossDomain: true,
      data: {addassignpack:true, reseller:reseller,packages:packages},
      dataType: "text",
      success: function(resultData){
          if(resultData == 'success')
          {
              swal("Success!", "Package Assigned Successfully!", "success");
          window.location.replace('addonmodules.php?module=vpnpanel&action=vpn_assignPackages');
          }
          else
          {
              swal("Error!", "Package Assign Failed!", "danger");
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