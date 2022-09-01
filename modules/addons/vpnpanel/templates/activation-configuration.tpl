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
      background-color: #efefef;
      padding: 0px 0px;
   }
</style>
{if isset($list_common)}
	<script type="text/javascript">
       window.location.href = "index.php?m=xtreamdashboard&action=actvationcodes&subpage=configuration";
    </script>
{/if}
<div class="row" style="margin-top: 10px;">
	<div class="col-md-3">
	</div>
	<div class="col-md-6 mainSecation">
		<div style="width:100%;">
		<center><h2>API Credentials</h2></center>
		</div>
		{if !empty($credetials)}
			<div style="width:100%;">
	            <table class="form" width="100%" border="0" cellspacing="2" cellpadding="3">
	               <tbody>
	                  <tr>
	                     <td style="width: 100%;text-align: center;" class="fieldlabel">
	                     	<h3 style=" padding: 0;  margin: 0; font-size: 15px;font-weight: bold;">
	                     		Your current API crenedtails
	                     	</h3>
	                     </td>
	                  </tr>
	               </tbody>
	            </table>
	         </div>
	         <div style="width:100%;">
	            <table class="form" width="100%" border="0" cellspacing="2" cellpadding="3">
	               <tbody>
	                  <tr>
	                     <td style="width: 30%;" class="fieldlabel">API Username</td>
	                     <td class="fieldarea">
	                     	<input type="text" class="form-control" value="{if isset($apiusername)}{$apiusername}{/if}" readonly>
	                     </td>
	                     <td class="fieldarea" style="width: 5%;">
	                     	<center>
	                     		<a href="#" title="Api Username"><i class="fa fa-info-circle"></i></a>
	                     	</center>
	                     </td>
	                  </tr>
	               </tbody>
	            </table>
	         </div>
	         <div style="width:100%;">
	            <table class="form" width="100%" border="0" cellspacing="2" cellpadding="3">
	               <tbody>
	                  <tr>
	                     <td style="width: 30%;" class="fieldlabel">API Password</td>
	                     <td class="fieldarea">
	                     	<input type="text" class="form-control" value="{if isset($apipassword)}{$apipassword}{/if}" readonly>
	                     </td>
	                     <td class="fieldarea" style="width: 5%;">
	                     	<center>
	                     		<a href="#" title="Api Password"><i class="fa fa-info-circle"></i></a>
	                     	</center>
	                     </td>
	                  </tr>
	               </tbody>
	            </table>
	         </div>
		{/if}
		<div style="width:100%;">
            <table class="form" width="100%" border="0" cellspacing="2" cellpadding="3">
               <tbody>
                  <tr>
                     <td>
                     	{if !empty($credetials)}
                     		<center>
								<!-- <form method="post">
								<input class="btn btn-success" name="generate" value="Update API Credentials" type="submit">
								</form> -->
								<form method="post" id="updateform">
			                        <input name="generate" value="Update API Credentials" type="hidden">
			                        <input class="btn btn-success confirmfirst" value="Update API Credentials" type="submit">
								</form>
							</center>
                     		{else}
                     		<center>
	                           <h4>You are just one click away to create api credetials. Simply click on below button and get api access.</h4>
								<form method="post">
								<input class="btn btn-success" name="generate" value="Generate Your API Credentials" type="submit">
								</form>
							</center>
                     	{/if}
                     </td>
                  </tr>
               </tbody>
            </table>       
         </div>

	</div>
	<div class="col-md-3">
	</div>
</div>


<style type="text/css">
   h3.heading-warning {
       font-size: 16px;
   }
</style>
 <!-- Confirm Modal -->
  <div class="modal fade" id="modalforconfirm" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Confirmation</h4>
        </div>
        <div class="modal-body ">
          <div class="row">
               <div class="col-md-12">
                  <center>
                        <h3 class="heading-warning">
                           <b>
                              Are you sure you want to update your API credentials?
                           </b>                        
                        </h3> 
                  </center>
               </div>
               <div class="col-md-12">
                  <p style="margin-bottom: 1px;text-decoration: underline;"><b>Important Note -</b></p>
                  <center>
                        <p>
                           Once you will update your API credentials your APP will stop working. You have to pay for re-built the app with new credentials .                    
                        </p> 
                  </center>
               </div>
           </div>
          <div class="AppendSearchDelete"></div>          
        </div>
        <div class="modal-footer deletefooter">
          <button type="button" class="btn btn-info confirmedbtn">Confirm</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
<script type="text/javascript">
   $(document).ready(function(){
     $(".confirmfirst").click(function(e){
       e.preventDefault();
       $('#modalforconfirm').modal('show');  
     });
     $(".confirmedbtn").click(function(e){
       e.preventDefault();
       $('#updateform').submit(); 
     });
   });
</script>