<style type="text/css">
	.same-btn
    {
    	display: inline-block;
	    padding: 6px 12px;
	    margin-bottom: 5px;
	    font-size: 14px;
	    font-weight: 400;
	    line-height: 1.42857143;
	    text-align: center;
	    white-space: nowrap;
	    vertical-align: middle;
	    -ms-touch-action: manipulation;
	    touch-action: manipulation;
	    cursor: pointer;
	    -webkit-user-select: none;
	    -moz-user-select: none;
	    -ms-user-select: none;
	    user-select: none;
	    background-image: none;
	    border: 1px solid transparent;
	    border-radius: 4px;
	    height: 34px !important;
    }
    input[type=checkbox]{
		cursor: pointer;
	}
	.showclick
     {
        cursor: pointer;
     }
</style>
 <h2 style="margin-top: 25px; margin-bottom: 0;">List of Archive</h2>

{if $pagetype eq "view"}

	{if !empty($getActivationCodeData)}	
		<div class="row"> 
	        <div class="col-md-12" style="text-align: right;margin-top: 20px;">  
	       		<a href="index.php?m=xtreamdashboard&action=actvationcodes&subpage=archive" class="btn btn-primary same-btn" style="float: left;">Back to Archive</a>
	           <button class="btn btn-info MoveFromArchivees" disabled>Remove From Archive</button> 
	          <button class="btn btn-danger deletebtn" disabled>
	            Delete Selected
	          </button>
	        </div>
	    </div>
	    {if isset($totalRecords)}
			<p style="padding-left: 10px;">
				Total {$totalRecords} Records found, Page {$currentPage} of {$totalPage} 
			</p>
		{/if}
		<div class="tablebg">
		<table id="sortabletbl0" class="datatable table table-responsive" width="100%" border="0" cellspacing="1" cellpadding="3">
		  <tbody>
		     <tr>
		        <th>
		           <label>
		              Select All
		              <center>
		              	<input type="hidden" id="currentUserID" value="{$currentUserID}">
		              	<input type="checkbox" name="" id="selectall" style="display: block;">
		              </center>
		           </label>
		        </th>
		        <th>
		           <!-- <a href="#">  -->
		           ID
		           <!-- </a> -->
		           <!-- <img src="modules/addons/ActivationCoder/assets/img/desc.gif" class="absmiddle"> -->
		        </th>
		        <!-- <th>Package</th> -->
		        <th>Activation Code</th>
		        <th>
		           Password 
		           <span class="showclickAll label active" data-currentaction="show" style="float: right;margin-top: 4px;margin-right: -8px;cursor: pointer;">
		           Show All
		           </span>
		        </th>
		        <th>Created On</th>
		        {if $Common_ind != "allinactive"}
		        	<th>Activated On</th>
		        {/if}
		        <th>Product Name</th>
		        <th>Status</th>
		     </tr>
		     {foreach from=$getActivationCodeData item=akey}
		     <tr>
		        <td>
		           <center><input type="checkbox" name="codeid" value="{$akey->id}" class="checkme checkbox"></center>
		        </td>
		        <td>
		           <!-- <a href="#" title="View attached Product" target="_blank" class="cus-anchor"> -->
		           {$akey->id} 
		           <!-- </a> -->                      
		        </td>
		        <td>
		           {$akey->username}                         
		        </td>
		        <td>
		           <div class="row">
		              <div class="col-md-9">
		                 <span class="" id="dataShow-{$akey->id}">
		                 XXXXXXXXXXXXXX
		                 </span>
		              </div>
		              <div class="col-md-3">
		                 <span class="showclick label active" id="{$akey->id}" data-passval="{$akey->password}" data-current="show">
		                 Show
		                 </span>
		              </div>
		           </div>
		        </td>
		        <td>
		        	{$akey->common|date_format:'%a, %e %B %Y'}                     
		        </td>
		        {if $Common_ind != "allinactive"}
		        <td>
		        	{if $akey->activationdate != ""}
		        		{$akey->activationdate|date_format:'%a, %e %B %Y'} 
		        		{else}
		           		----  
		           	{/if}	                         
		        </td>
		        {/if}
		        <td>
		          {if $akey->status eq "Active"}
		        		<a href="" id="{$akey->username}" title="View Service Details" class="showpopup cus-anchor"> 
		        			{$GetAllProductsNames[$akey->productid]}
		        		</a>
		        		{else}
		        		    ----
		        	{/if}                    
		        </td>
		        <td>
		           <span class='label {if $akey->status eq "Active"}active{else}inactive{/if}'>
		           {if $akey->status eq "Active"}active{else}inactive{/if}                           
		           </span>
		           &nbsp; 
		        </td>
		     </tr>
		     {/foreach}
		  </tbody>
		</table>
		<p align="center">
		{if isset($previousPage) && !empty($previousPage) && $previousPage != 0}
				<a href="index.php?m=xtreamdashboard&action=actvationcodes&subpage=archive&type=view&common={$Common_ind}&orderbyid={$OrderBy}&pageno={$previousPage}">&#171; Previous Page </a>&nbsp;
				{else}
				&#171; Previous Page &nbsp;		
		{/if}
		{if isset($nextPage) && !empty($nextPage) && !($nextPage > $totalPage)}
				<a href="index.php?m=xtreamdashboard&action=actvationcodes&subpage=archive&type=view&common={$Common_ind}&orderbyid={$OrderBy}&pageno={$nextPage}">Next Page &#187; </a>&nbsp;
				{else}
				Next Page &#187;  &nbsp;		
		{/if}
		</p>
		</div>

		{else}
			<center><h2>No Result Found !</h2></center>
	{/if}

	<script type="text/javascript">
		$(document).ready(function(){	
		var currentUserID = $('#currentUserID').val()	
		    $('#selectall').click(function(){
		      if(this.checked) {
		          $('.checkme').each(function() {
		              this.checked = true;
		              $('.deletebtn').removeAttr('disabled');           
		              $('.MoveFromArchivees').removeAttr('disabled');           
		          });
		      } else {
		          $('.checkme').each(function() {
		              this.checked = false;
		              $('.deletebtn').attr('disabled', 'disabled'); 
		              $('.MoveFromArchivees').attr('disabled', 'disabled'); 
		          });
		      }
		    });
		    $('.checkme').click(function(){            
		      var selectCount = $('.checkme').filter(':checked').length;                        
		      if(selectCount == 0){
		        $('.deletebtn').attr('disabled', 'disabled'); 
		        $('.MoveFromArchivees').attr('disabled', 'disabled'); 
		      }else{
		        $('.deletebtn').removeAttr('disabled');
		        $('.MoveFromArchivees').removeAttr('disabled');
		      }                   
		    });
		    var selectedcodeid = [];
	         $('.deletebtn').click(function(e){
	         	selectedcodeid = [];
	          $('.loader-image3').addClass('hide');
	            e.preventDefault();            
	            $.each($("input[name='codeid']:checked"), function(){            
	                selectedcodeid.push($(this).val());
	            }); 
	            totaldeletes = selectedcodeid.length;
	            $('#del_from_archs').modal('show');
	            $(".deletesinglearch").html('<h2 class="text-center">Are you Sure about Delete <b>'+ totaldeletes +'</b> Codes</h2>');           
	         });

	         $('.delSingle').click(function(){
	            $('#del_from_archs').modal('show');
	            $(".deletesinglearch").html('');
	            $('.loader-image3').removeClass('hide');
	            $('.deletefooter').addClass('hide');
	            deletefilesfunction(selectedcodeid,currentUserID);            
	         });


	         $('.MoveFromArchivees').click(function(e){
	         	selectedcodeid = [];
	          $('.loader-image4').addClass('hide');
	            e.preventDefault();            
	            $.each($("input[name='codeid']:checked"), function(){            
	                selectedcodeid.push($(this).val());
	            }); 	            
	            totaldeletes = selectedcodeid.length;
	            $('#move_from_archs').modal('show');
	            $(".Appendmovesinglearch").html('<h2 class="text-center">Are you Sure about removing <b>'+ totaldeletes +'</b> Codes from Archive</h2>');           
	         });

	         $('.movefromarchsSingle').click(function(){
	            $('#move_from_archs').modal('show');
	            $(".Appendmovesinglearch").html('');
	            $('.loader-image4').removeClass('hide');
	            $('.deletefooter').addClass('hide');
	            removeArchsfunction(selectedcodeid,currentUserID);            
	         });

	          $(".showclickAll").click(function(){
            var currentaction = $(this).data('currentaction');
            if(currentaction == 'show')
            {
              $(this).text('HIDE ALL'); 
              $(this).data('currentaction','hide');
              $(this).removeClass('active');   
              $(this).addClass('inactive'); 
            }
            else
            {
              $(this).text('SHOW ALL'); 
              $(this).data('currentaction','show');
              $(this).removeClass('inactive');   
              $(this).addClass('active')
            }
            $( ".showclick" ).each(function() {            	
              passval = $(this).data('passval');
              idIs = $(this).attr('id');
              if(currentaction == "show")
              {
                 $(this).data('current','hide');   
                 $(this).removeClass('active');   
                 $(this).addClass('inactive');   
                 $(this).text('Hide');   
                 $('#dataShow-'+idIs).text(passval);
              }
              if(currentaction == "hide")
              {
                 $(this).data('current','show');   
                 $(this).removeClass('inactive');   
                 $(this).addClass('active');   
                 $(this).text('Show');   
                 $('#dataShow-'+idIs).text('XXXXXXXXXXXXXX');
              }
              console.log(passval+" - - - - - "+idIs);
            });
          }); 
          $(".showclick").click(function(){
          	console.log('click');
              var idIs = $(this).attr('id');
              var current = $(this).data('current');
              var password = $(this).data('passval');
              if(current == "show")
              {
                 $(this).data('current','hide');   
                 $(this).removeClass('active');   
                 $(this).addClass('inactive');   
                 $(this).text('Hide');   
                 $('#dataShow-'+idIs).text(password);
              }
              if(current == "hide")
              {
                 $(this).data('current','show');   
                 $(this).removeClass('inactive');   
                 $(this).addClass('active');   
                 $(this).text('Show');   
                 $('#dataShow-'+idIs).text('XXXXXXXXXXXXXX');
              }
         });
          
		});

		function deletefilesfunction(selectedfiles = "", resellerID = ""){
			$.ajax({
				url: 'modules/addons/ActivationCoder/ajax-control.php',
				type: "POST",
				data: {
				  action: 'delete_single_arch',
				  selectedArches: selectedfiles,
				  resellerID: resellerID
				},
				success: function (response) { 	
				console.log(response);	                          
				  if(response == 1)
				  {
				    window.location.reload();			      
				  }
				  else if(response == 0)
				  {
				    $(".loader-image").addClass("hideonload");
				    $(".AppendConfirmBatch").html('<center><b>Sorry Error in deleting ActivationCodes from Archive</b></center>');
				  } 
				}
			});
		}
		function removeArchsfunction(selectedfiles = "", resellerID = ""){
			$.ajax({
				url: 'modules/addons/ActivationCoder/ajax-control.php',
				type: "POST",
				data: {
				  action: 'removeArchssingle',
				  removeselectedArches: selectedfiles,
				  resellerID: resellerID
				},
				success: function (response) { 
				console.log(response);                           
				  if(response == 1)
				  {
				    window.location.reload();			      
				  }
				  else if(response == 0)
				  {
				    $(".loader-image").addClass("hideonload");
				    $(".AppendConfirmBatch").html('<center><b>Sorry Error in deleting ActivationCodes from Archive</b></center>');
				  } 
				}
			});
		}
			
</script>




	{else}

		{if !empty($getActivationCodeGroup)}
		
		<div class="row"> 
	        <div class="col-md-12" style="text-align: right;margin-top: 20px;">
	          <button class="btn btn-danger deletebatch" style="float: right;" disabled>Delete Seleted</button>
	        <button class="btn btn-info archivebatch" style="float: right;margin-right: 10px;" disabled>Remove from Archive (Selected)</button>
	        </div>
	    </div>
	    Total {count($finalBatchArray)} Records found
    	<div class="row">
			<div class="tablebg">
				<table id="sortabletbl0" class="datatable" width="100%" border="0" cellspacing="1" cellpadding="3">
				   <tbody>
				        <tr>
					        <th>
					          <label>
					            Select All
					            <center>
					            	<input type="hidden" id="currentUserID" value="{$currentUserID}">
					            	<input type="checkbox" id="selectallBatch">
					            </center>
					          </label>
					        </th>
					        <th>Batches</th>
					        <th>
					            <!-- <a href="#">  -->
					               Date
					            <!-- </a> -->
					            <!-- <img src="modules/addons/ActivationCoder/assets/img/{$OrderBy}.gif" class="absmiddle"> -->
					        </th>
							<th>Attached Product</th>
							<th>Active Codes</th>
							<th>Inactive Codes</th>
							<th>Total Codes</th>
							<th>Action</th>
				        </tr>

				      {foreach from=$finalBatchArray key=time item=akey}
				        <tr>								                  	
				            <td>
				            	<center><input type="checkbox" name="BatchesCheck" class="checkbatch" value="{$akey['common']}"></center>
				            </td>
				              <td style="text-align: left; padding-left: 25px;">
                          
                           {$akey['batchname']}
                          
                        </td>
				            <td>{$time|date_format:'%a, %e %B %Y'} </td>
				            <td>								              	            
								<a href="#">
									{$akey['productname']}
								</a>
				                      
				            </td>
				            <td>{$akey['activeBatchCode']}</td>
				            <td>{$akey['InactiveBatchCode']}</td>
				            <td>{$akey['total']}</td>
				            <td>
				              	<a href="index.php?m=xtreamdashboard&action=actvationcodes&subpage=archive&type=view&common={$akey['common']}" class="btn btn-primary same-btn">
				                View Codes
				              	</a>
				              	<!-- &nbsp;
				              	<a class="btn btn-primary same-btn" href="{$RedirectURL}?common={$akey['common']} target="_blank">
				                Download CSV
				              	</a> -->
				            </td>								                    
				        </tr>
				        {/foreach}								                    
				      </tbody>
				</table>
			</div>
		</div>

	{else}
		<center><h2>No Result Found !</h2></center>
{/if}

		<script type="text/javascript">
		  $(document).ready(function(){
		    var selectedBatches = []; 
		    $('#selectallBatch').click(function(){
		      if(this.checked) {
		          $('.checkbatch').each(function() {
		              this.checked = true;
		              $('.deletebatch').removeAttr('disabled');           
		              $('.archivebatch').removeAttr('disabled');           
		          });
		      } else {
		          $('.checkbatch').each(function() {
		              this.checked = false;
		              $('.deletebatch').attr('disabled', 'disabled'); 
		              $('.archivebatch').attr('disabled', 'disabled'); 
		          });
		      }
		    });
		    $('.checkbatch').click(function(){            
		      var selectCount = $('.checkbatch').filter(':checked').length;                        
		      if(selectCount == 0){
		        $('.deletebatch').attr('disabled', 'disabled'); 
		        $('.archivebatch').attr('disabled', 'disabled'); 
		      }else{
		        $('.deletebatch').removeAttr('disabled');
		        $('.archivebatch').removeAttr('disabled');
		      }                   
		    });
		    $('.deletebatch').click(function(e){     
		    	selectedBatches = [];
		          $('.loader-image2').addClass('hide');
		            e.preventDefault();            
		            $.each($("input[name='BatchesCheck']:checked"), function(){            
		                selectedBatches.push($(this).val());
		            }); 
		            totalbatchdeletes = selectedBatches.length;
		            $('#confirmationBatch').modal('show');
		            $(".AppendConfirmBatch").html('<h2 class="text-center">Are you Sure about Delete <b>'+ totalbatchdeletes +'</b> Batch</h2>');           
		    });
		    $('.deleteConfirmbatch').click(function(){
		            $('#confirmationBatch').modal('show');
		            $(".AppendConfirmBatch").html('');
		            $('.loader-image2').removeClass('hide');
		            $('.totalrequested').html(totalbatchdeletes);
		            $('.deletefooter').addClass('hide');
		            deletebatchfunction(selectedBatches);
		    });
		     $('.archivebatch').click(function(e){ 
		     	selectedBatches = [];
		          $('.loader-image2').addClass('hide');
		            e.preventDefault();            
		            $.each($("input[name='BatchesCheck']:checked"), function(){            
		                selectedBatches.push($(this).val());
		            }); 
		            totalbatcharchive = selectedBatches.length;
		            $('#ArchiveBatch').modal('show');
		            $(".AppendArchiveBatch").html('<h2 class="text-center">Are you Sure about Delete <b>'+ totalbatcharchive +'</b> Batch</h2>');           
		    });
		    $('.addArchive').click(function(){
		            $('#ArchiveBatch').modal('show');
		            $(".AppendArchiveBatch").html('');
		            $('.loader-image2').removeClass('hide');
		            $('.deletefooter').addClass('hide');
		            movefromarchivebatch(selectedBatches);
		    });

		   

		  });
		function deletebatchfunction(selectedfiles = "")
		{
			$.ajax({
				url: 'modules/addons/ActivationCoder/ajax-control.php',
				type: "POST",
				data: {
				  action: 'delete_selected_batch',
				  selectedBatches: selectedfiles
				},
				success: function (response) {
				console.log(response);                             
				  if(response == 1)
				  {
				    window.location.reload();			      
				  }
				  else if(response == 0)
				  {
				    $(".loader-image").addClass("hideonload");
				    $(".AppendConfirmBatch").html('<center><b>Sorry Error in deleting ActivationCodes</b></center>');
				  } 
				}
			}); 
		}
		  function movefromarchivebatch(selectedfiles = "")
		  {
		    $.ajax({
		        url: 'modules/addons/ActivationCoder/ajax-control.php',
		        type: "POST",
		        data: {
		            action: 'movefromarchivebatch',
		            selectedarchivebatch: selectedfiles
		        },
		        success: function (response) {  
		        console.log(response);                                        
		            if(response == 1)
		            {
		                window.location.reload();                
		            }
		            else if(response == 0)
		            {
		              $(".loader-image").addClass("hide");
		              $(".AppendArchiveBatch").html('<center><b>Sorry ! Error in Adding to Archive</b></center>');
		            } 
		        }
		    }); 
		  }



		</script>

{/if}


 <!-- Modal -->
  <div class="modal fade" id="confirmationBatch" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Confirm Please</h4>
        </div>
        <div class="modal-body ">
          <div class="loader-image2 hide">
           <center>
            <img src="modules/addons/ActivationCoder/assets/img/circleloader.gif" style="width: 100px;">
          </center> 
          </div>
          <div class="AppendConfirmBatch"></div>          
        </div>
        <div class="modal-footer deletefooter">
          <button type="button" class="btn btn-info deleteConfirmbatch">Delete</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
 <!-- ArchiveBox Modal -->
  <div class="modal fade" id="ArchiveBatch" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Confirm Please</h4>
        </div>
        <div class="modal-body ">
          <div class="loader-image2 hide">
           <center>
            <img src="modules/addons/ActivationCoder/assets/img/circleloader.gif" style="width: 100px;">
          </center> 
          </div>
          <div class="AppendArchiveBatch"></div>          
        </div>
        <div class="modal-footer deletefooter">
          <button type="button" class="btn btn-info addArchive">Move from Archive</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
  <!-- move from ArchiveBox Modal -->
  <div class="modal fade" id="move_from_archs" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Confirm Please</h4>
        </div>
        <div class="modal-body ">
          <div class="loader-image4 hide">
           <center>
            <img src="modules/addons/ActivationCoder/assets/img/circleloader.gif" style="width: 100px;">
          </center> 
          </div>
          <div class="Appendmovesinglearch"></div>          
        </div>
        <div class="modal-footer deletefooter">
          <button type="button" class="btn btn-info movefromarchsSingle">Move from Archive</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div> 
  <!-- delete from ArchiveBox Modal -->
  <div class="modal fade" id="del_from_archs" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Confirm Please</h4>
        </div>
        <div class="modal-body ">
          <div class="loader-image3 hide">
           <center>
            <img src="modules/addons/ActivationCoder/assets/img/circleloader.gif" style="width: 100px;">
          </center> 
          </div>
          <div class="deletesinglearch"></div>          
        </div>
        <div class="modal-footer deletefooter">
          <button type="button" class="btn btn-info delSingle">Delete from Archive</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>