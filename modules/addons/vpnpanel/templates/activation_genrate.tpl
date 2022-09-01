<script type="text/javascript">
	$(document).ready(function(){
	var saveBtn = $("#save_changes");
	 saveBtn.click(function(){
	  var confitionForm = 1;
	   $("#passwordStatic").removeClass("addborder");
	   var NoOfUsers = $('#usersselector').val();
	   var packageselector = $('#packageselector').val();
	   var usernamelength = $('#usernamelength').val();
	   var batchnameis = $('#batchnameis').val();
	   var passwordlength = usernamelength;
	   var usernameformat = $("input[name=usernameformat]:checked").val();
	   var usernameformatpass = usernameformat;
	   var passwordStatic = $("#passwordStatic").val(); 
	   var ischecked= $('#staticpasswordenable').is(':checked');
	    if(ischecked)
	   {
	      usernameformatpass = "static";
	      if(passwordStatic == "")
	      {
	         confitionForm = 0;
	         $("#passwordStatic").addClass("addborder");
	      }
	      else
	      {
	         confitionForm = 1;
	         $("#passwordStatic").removeClass("addborder");
	      }
	   }
	   if(confitionForm == 1)
	   {
	          var resellerID = $('#resellerID').val();
	          var common_ind = $('#currenttimestamp').val();
	         if(NoOfUsers < 100)
	         {
	            eachTime = 1;
	            PendingCounter = NoOfUsers; 
	            Requested = NoOfUsers; 
	            var callRequest = CallAjaxAddClients(Requested,packageselector,usernamelength,passwordlength,usernameformat,usernameformatpass,passwordStatic,batchnameis,common_ind,NoOfUsers,resellerID);
	         }
	         else
	         {
	            eachTime = Math.ceil(Number(NoOfUsers)/Number(100));
	            CallAjaxAddClients2(NoOfUsers,eachTime,common_ind,resellerID);
	         } 
	   }
	 });
	 $("#staticpasswordenable").click(function(){
	   var ischecked= $(this).is(':checked');
	    if(ischecked)
	   {
	      $(".randomPass_section").addClass("hideonload");
	      $(".staticpass_section").removeClass("hideonload");
	   }
	   else
	   {
	      $(".staticpass_section").addClass("hideonload");
	      $(".randomPass_section").removeClass("hideonload");
	   }
	});
	 if($('#packageselector').val() != "")
	 {
	    GetProductInformation($('#packageselector').val());
	 }       
	 $( "#packageselector" ).change(function() {
	    GetProductInformation($(this).val());
	});
	});
	function CallAjaxAddClients(NoOfUsers = "", packageselector = "", usernamelength = "", passwordlength = "", usernameformat = "", usernameformatpass = "", passwordStatic = "",batchnameis = "", common_ind = "", totalusers = "",resellerID = "")
	{
	var billingcyclength = $('.billingcycle').length;
	var ValueBilling = "";
	if(billingcyclength > 0)
	{
	 ValueBilling = $("input:radio.billingcycle:checked").val();
	}
	$('#Requesting').text(totalusers);
	$('#TotalUser').text(NoOfUsers);
	$('#exampleModal').modal('show');
	jQuery.ajax({
	  type:"POST",
	  url:"modules/addons/ActivationCoder/ajax-control.php",
	  dataType:"text",
	  data:{
	  action:'AddUsers',
	  NoOfUsers:NoOfUsers,
	  ValueBilling:ValueBilling,
	  packageselector:packageselector,
	  usernamelength:usernamelength,
	  passwordlength:passwordlength,
	  usernameformat:usernameformat,
	  usernameformatpass:usernameformatpass,
	  batchnameis : batchnameis,
	  common_ind:common_ind,
	  resellerID:$('#resellerID').val(),
	  passwordStatic:passwordStatic
	  },  
	  success:function(response){  
	      var obj = jQuery.parseJSON(response);
	      if(obj.result == "success")
	      {
	        $('#exampleModal').modal('hide');
	        window.location.href = "index.php?m=xtreamdashboard&action=actvationcodes&subpage=list&common="+common_ind;
	      }            
	      else
	      {
	          $('#exampleModal').modal('hide');
	          alert("Something Went Wrong check logs");
	      }
	  }
	});
	}
	function CallAjaxAddClients2(PendingCounter = "", timesrun = "",common_ind = "",resellerID = "")
	{
	var billingcyclength = $('.billingcycle').length;
	var ValueBilling = "";
	if(billingcyclength > 0)
	{
	 ValueBilling = $("input:radio.billingcycle:checked").val();
	}
	Requested = 100;
	if(PendingCounter <= 99)
	{
	  Requested = PendingCounter;
	}
	if(PendingCounter > 0)
	{
	  $('#Requesting').text(Requested);
	  $('#TotalUser').text(PendingCounter); 
	}
	$('#exampleModal').modal('show');
	if(timesrun != 0)
	{
	  var packageselector = $('#packageselector').val();
	  var usernamelength = $('#usernamelength').val();
	  var passwordlength = usernamelength;
	  var usernameformat = $("input[name=usernameformat]:checked").val();
	  var usernameformatpass = usernameformat;
	  var passwordStatic = $("#passwordStatic").val();
	  var ischecked= $('#staticpasswordenable').is(':checked');
	    if(ischecked)
	   {
	      usernameformatpass = "static";
	      if(passwordStatic == "")
	      {
	         confitionForm = 0;
	         $("#passwordStatic").addClass("addborder");
	      }
	      else
	      {
	         confitionForm = 1;
	         $("#passwordStatic").removeClass("addborder");
	      }
	   }
	  jQuery.ajax({
	    type:"POST",
	    url:"modules/addons/ActivationCoder/ajax-control.php",
	    dataType:"text",
	    data:{
	    action:'AddUsers',
	    NoOfUsers:Requested,
	    ValueBilling:ValueBilling,
	    packageselector:packageselector,
	    usernamelength:usernamelength,
	    passwordlength:passwordlength,
	    usernameformat:usernameformat,
	    usernameformatpass:usernameformatpass,
	    common_ind:common_ind,
	    resellerID:$('#resellerID').val(),
	    passwordStatic:passwordStatic
	    },  
	    success:function(response){  
	        var obj = jQuery.parseJSON(response);
	        if(obj.result == "success")
	        {
	          --timesrun;
	          PendingCounter = PendingCounter-Number(100);
	          CallAjaxAddClients2(PendingCounter,timesrun,common_ind);
	        }              
	        else
	        {
	            $('#exampleModal').modal('hide');
	            alert("Something Went Wrong check logs");
	        }
	    }
	  });
	}
	else
	{
	    $('#exampleModal').modal('hide');
	    window.location.href = "index.php?m=xtreamdashboard&action=actvationcodes&subpage=list&common="+common_ind;
	}
	}
	function GetProductInformation(productID = "" ,counter = "")
	{
	$('#save_changes').prop('disabled', true);
	$('#appendpackageinformation').html('');
	$("#loadertd").removeClass('hideonload');
	$('#appendpackageinformation').addClass('hideonload');
	 var resellerID = $('#resellerID').val();
	jQuery.ajax({
	    type:"POST",
	    url:"modules/addons/ActivationCoder/ajax-control.php",
	    dataType:"text",
	    data:{
	    action:'GetProductInformation2',
	    productID:productID,
	    resellerID:resellerID
	    },  
	    success:function(response){
	    
	        $('#save_changes').prop('disabled', false);
	        if(response != "0")
	        {
	            $('#loadertd').addClass('hideonload');
	            $('#appendpackageinformation').html('');
	            $('#appendpackageinformation').html(response);
	            $('#appendpackageinformation').removeClass('hideonload');
	            $("#packageinformation").removeClass('hideonload');
	        }
	    }
	  });
	counter = 1;
	}
	</script>
<style type="text/css">
	label.label-custom {
		font-weight: normal;
		cursor: pointer;
	}
	.mainSecation
	{  
		background-color: #efefef;
		padding: 10px;
		margin-top: 20px;
	}
	.hideonload
	{
		display: none !important;
	}
	.addborder
	{
		border: 1px solid red !important;
	}
	.customh3
	{
	    word-wrap: break-word;	
		padding: 0px 0px;
	}
</style>
<div class="row" style="margin-top: 10px;">
   <div class="col-md-1">
   </div>
   <div class="col-md-10 mainSecation">
      <div style="width:100%;">
         <center>
            <h2>Generate Code(s)</h2>
         </center>
      </div>
      <div style="width:100%;">

              <table class="form" width="100%" border="0" cellspacing="2" cellpadding="3">

                 <tbody>

                    <tr>

                       <td style="width: 30%;" class="fieldlabel">Batch Title</td>

                       <td class="fieldarea"><input type="text" class="form-control" id="batchnameis" value="" placeholder="Enter Batch Title">
                       </td>

                       <td class="fieldarea" style="width: 5%;"><center><a href="#" title="You can set name for this batch of codes"><i class="fa fa-info-circle"></i></a></center></td>

                    </tr>

                 </tbody>

              </table>

           </div>
      <div style="width:100%;">
         <table class="form" width="100%" border="0" cellspacing="2" cellpadding="3">
            <tbody>
               <tr>
                  <td style="width: 30%;" class="fieldlabel">Enter the number of Codes</td>
                  <td class="fieldarea"><input type="number" class="form-control" name="users" id="usersselector" min="1" value="1"></td>
                  <td class="fieldarea" style="width: 5%;">
                     <center><a href="#" title="Enter the number of Codes"><i class="fa fa-info-circle"></i></a></center>
                  </td>
               </tr>
            </tbody>
         </table>
      </div>
      <div style="width:100%;">
         <table class="form" width="100%" border="0" cellspacing="2" cellpadding="3">
            <tbody>
               <tr>
                  <td style="width: 30%;" class="fieldlabel">Select the Package/Product</td>
                  <td class="fieldarea">
                     <select class="selectpicker form-control" id="packageselector">
                     	{if !empty($AllProducts)}
                     		<option value="">Select Package</option>
                     		{foreach from=$ProductGroups key=gid item=gname}
		                        {if array_key_exists($gid, $ShowGroparray)}
		                        <optgroup label="{$gname}">
		                        {/if}
		                        {foreach from=$AllProducts item=ProductKey}
			                        {if $gid eq $ProductKey->gid}
			                        	<option value="{$ProductKey->id}">{$ProductKey->name}</option>
			                        {/if}
		                        {/foreach}		                          
		                        </optgroup>
	                        {/foreach}
                        	{else}
                        	<option value="">No Result Found</option>
                        {/if}
                     </select>
                  </td>
                  <td class="fieldarea" style="width: 5%;">
                     <center><a href="#" title="Select packages for codes"><i class="fa fa-info-circle"></i></a></center>
                  </td>
               </tr>
            </tbody>
         </table>
      </div>
      <div style="width:100%;" id="packageinformation" class="hideonload">
         <table class="form" width="100%" border="0" cellspacing="2" cellpadding="3">
            <tbody>
               <tr>
                  <td style="width: 30%;" class="fieldlabel">Package Details</td>
                  <td class="fieldarea" id="loadertd">
                     <h2 style="text-align: center;">loading data</h2>
                     <div style="width: 100%;text-align: center;">
                        <img src="modules/addons/ActivationCoder/assets/img/circleloader.gif" style="width: 100px;">
                     </div>
                  </td>
                  <td class="fieldarea hideonload" id="appendpackageinformation">
                  </td>
               </tr>
            </tbody>
         </table>
      </div>
      <div style="width:100%;">
         <table class="form" width="100%" border="0" cellspacing="2" cellpadding="3">
            <tbody>
               <tr>
                  <td style="width: 30%;" class="fieldlabel">Code(s)’s format</td>
                  <td class="fieldarea">
                     <div class="row">
                        <div class="col-md-8">
                           <input type="radio" class="usernameformat" name="usernameformat" id="onlydigits" value="d" checked="checked">
                           <label class="label-custom" for="onlydigits">Only numeric values (  0 -9 digits )</label>
                           <br>
                           <input type="radio" class="usernameformat" name="usernameformat" id="onlyalphabet" value="lu"> 
                           <label class="label-custom" for="onlyalphabet">Only Alphabets ( A - Z, a-z )</label>
                           <br>
                           <input type="radio" class="usernameformat" name="usernameformat" id="digitalphabet" value="lud"> 
                           <label class="label-custom" for="digitalphabet">Alpha-numeric ( A-Z, a-z , 0-9)</label>
                        </div>
                        <div class="col-md-4">
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="row">
                                    <div class="col-md-9">
                                       <p style="margin: 2px !important;">Code’s Length </p>
                                    </div>
                                    <div class="col-md-3">
                                       <a href="#" title="Set the length for the codes"><i class="fa fa-info-circle"></i></a>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <input type="number" class="form-control" name="usernamelength" id="usernamelength" min="8" value="8">
                              </div>
                           </div>
                        </div>
                     </div>
                  </td>
               </tr>
            </tbody>
         </table>
      </div>
      <div style="width:100%;">
         <table class="form" width="100%" border="0" cellspacing="2" cellpadding="3">
            <tbody>
               <tr>
                  <td style="width: 30%;" class="fieldlabel">Static Password ?</td>
                  <td class="fieldarea">
                     <div class="row">
                        <div class="col-md-12"> 
                           <input type="checkbox" id="staticpasswordenable">
                           <span>( Tick to box if you want to keep the static password)</span>
                           <a href="#" title="Set static password for the codes" style="float: right;margin-right: 12px;">
                           <i class="fa fa-info-circle"></i>
                           </a>
                        </div>
                        <div class="col-md-12 hideonload staticpass_section">
                           <input type="text" class="form-control" id="passwordStatic" name="passwordStatic" placeholder="Enter Static Password">
                        </div>
                     </div>
                  </td>
               </tr>
            </tbody>
         </table>
      </div>
      <div style="width:100%;">
         <table class="form" width="100%" border="0" cellspacing="2" cellpadding="3">
            <tbody>
               <tr>
                  <td>
                     <center>
                     	<input type="hidden" id="resellerID" value="{$currentUserID}">
                     	<input type="hidden" id="currenttimestamp" value="{$timevar}">
                        <input type="submit" id="save_changes" class="btn btn-primary" value="Generate" disabled="disabled">
                        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                           Launch demo modal
                           
                           </button> -->
                     </center>
                  </td>
               </tr>
            </tbody>
         </table>
      </div>
   </div>
   <div class="col-md-1">
   </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-toggle="modal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<center>
					<h4>Please don't refresh page</h4>
					<p>Requesting <span id="Requesting">100</span> out of <span id="TotalUser">200</span></p>
					<img src="modules/addons/ActivationCoder/assets/img/loadingbar.gif" style="width: 100%;height: 100px;">
				</center>
			</div>
		</div>
	</div>
</div>