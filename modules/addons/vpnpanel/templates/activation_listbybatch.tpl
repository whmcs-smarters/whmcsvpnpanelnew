<style type="text/css">
    .list-class {
          padding: 10px 8px;
          text-align: center;
      }
    td
    {
      text-align: center;
    }
    th
    {
      text-align: center !important;
    }
    input[type=checkbox]{
      cursor: pointer;
    }
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
    .active_editbatchname  {
            background-color: #5cb85c !important;
        }


        .editbatchname  {
          background-color: #0251af;
          padding: 5px 5px;
          color: #fff;
          font-weight: bold;
          border-radius: 6px;
          overflow: hidden;
          text-overflow: ellipsis;
          white-space: nowrap;
        }


        .editbatchname:hover  {
          color: #fff;
           background-color: #406796;
        }

</style>

{if !empty($getActivationCodeGroup)}

    <div class="row" style="margin-top: 10px;">
      <div class="col-md-6"></div>
      <div class="col-md-6">
        <button class="btn btn-danger deletebatch" style="float: right;" disabled>Delete Seleted</button>
        <button class="btn btn-info archivebatch" style="float: right;margin-right: 10px;" disabled>To Archive (Selected)</button>
      </div>
    </div>
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
                <th>
                       Batches
                  </th>
                 <th>
                       Date
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
                          <a href="#" class="editbatchname cus-anchor" data-commonis="{$akey['common']}"   data-batchtitleis="{$akey['batchname']}" id="batchtitle-{$akey['common']}" title="Change batch title">
                           {$akey['batchname']}
                           </a>
                        </td>
                  
                    <td>{$time|date_format:'%a, %e %B %Y'} </td>
                    <td>								              	            
						<!-- <a href="#"> -->
							{$akey['productname']}
						<!-- </a> -->
                              
                    </td>
                    <td>{$akey['activeBatchCode']}</td>
                    <td>{$akey['InactiveBatchCode']}</td>
                    <td>{$akey['total']}</td>
                    <td>
                      <a href="index.php?m=xtreamdashboard&action=actvationcodes&subpage=list&common={$akey['common']}" class="btn btn-primary same-btn">
                        View Codes
                      </a>
                      &nbsp;
                      <a class="btn btn-primary same-btn" href="{$RedirectURL}?common={$akey['common']}&sk={$resellerSalt}" target="_blank">
                        Download CSV
                      </a>
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
	var currentUserID = $('#currentUserID').val();

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
	        $('.deletefooter').addClass('hide');
	        deletebatchfunction(selectedBatches,currentUserID);
	});
	//archivebatch
	 $('.archivebatch').click(function(e){     
	 	selectedBatches = []; 
	      $('.loader-image2').addClass('hide');
	        e.preventDefault();            
	        $.each($("input[name='BatchesCheck']:checked"), function(){            
	            selectedBatches.push($(this).val());
	        }); 
	        totalbatcharchive = selectedBatches.length;
	        $('#ArchiveBatchbox').modal('show');
	        $(".AppendArchiveBatch").html('<h2 class="text-center">Please confirm to Add to Archive <b>'+ totalbatcharchive +'</b> Batch</h2>');           
	});
	$('.addArchivebatch').click(function(e){
	  e.preventDefault();
	        $('#ArchiveBatchbox').modal('show');
	        $(".AppendArchiveBatch").html('');
	        $('.loader-image2').removeClass('hide');
	        $('.deletefooter').addClass('hide');
	        addtoarchivebatch(selectedBatches,currentUserID);
	});

	$("#newbatchupdate").click(function(){
                $("#newbatchupdate").removeClass("addborder");   
              });

            $(".editbatchname").click(function(e){
              e.preventDefault();
              commonis = $(this).data("commonis");
              text = $(this).data("batchtitleis");
              $("#changebatchbtn").data("clickedcommon",commonis);
              $("#newbatchupdate").val(text);
              $("#updatebatchname").modal("show");
            });


            $("#changebatchbtn").click(function(e){
              e.preventDefault();
              $('#changebatchbtn').prop('disabled', true);
              $("#newbatchupdate").removeClass("addborder");
              commonis = $(this).data("clickedcommon");
              newtitle = $("#newbatchupdate").val();
              if(newtitle != "")
              {
                  jQuery.ajax({
                    type:"POST",
                    url:"modules/addons/ActivationCoder/ajax-control.php",
                    dataType:"text",
                    data:{
                    action:'changebatchtitle',
                      commonis:commonis,
                      newtitle:newtitle
                    },  
                    success:function(response){
                      if(response == 1)
                      {
                        $("#batchtitle-"+commonis).text(newtitle);
                        $("#batchtitle-"+commonis).addClass("active_editbatchname");
                        $("#batchtitle-"+commonis).data("batchtitleis",newtitle);
                        $("#successchanges").modal("show");
                        setTimeout(function(){ 
                          $("#successchanges").modal("hide"); 
                          $('html, body').animate({
                                scrollTop: $("#batchtitle-"+commonis).offset().top - 20 
                            }, 'slow');
                          setTimeout(function(){
                              $("#batchtitle-"+commonis).removeClass("active_editbatchname");
                             }, 1500);
                        }, 2000);
                      }
                      $('#changebatchbtn').prop('disabled', false);
                      $("#updatebatchname").modal("hide");
                    }
                  });
              }
              else
              {
                  $("#newbatchupdate").addClass("addborder");
              }
            });
	});
	function deletebatchfunction(selectedfiles = "", resellerID = "")
	{
	  $.ajax({
	      url: 'modules/addons/ActivationCoder/ajax-control.php',
	      type: "POST",
	      data: {
	          action: 'delete_selected_batch',
	          resellerID: resellerID,
	          selectedBatches: selectedfiles
	      },
	      success: function (response) {                             
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
	function addtoarchivebatch(selectedfiles = "", resellerID = "")
	{
	$.ajax({
	  url: 'modules/addons/ActivationCoder/ajax-control.php',
	  type: "POST",
	  data: {
	      action: 'addtoarchivebatch',
	      resellerID: resellerID,
	      selectedarchivebatch: selectedfiles
	  },
	  success: function (response) {                                             
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

	<!--  Modal -->
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
	<div class="modal fade" id="ArchiveBatchbox" role="dialog">
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
	      <button type="button" class="btn btn-info addArchivebatch">Add to Archive</button>
	      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	    </div>
	  </div>
	</div>
	</div>
	<!-- ArchiveBox_back Modal -->
	<div class="modal fade" id="back_from_archives" role="dialog">
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
	      <div class="appendBackArchive"></div>          
	    </div>
	    <div class="modal-footer deletefooter">
	      <button type="button" class="btn btn-info bcktoArchive">Add to Archive</button>
	      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	    </div>
	  </div>
	</div>
	</div> 

	     <div class="modal fade" id="updatebatchname" data-backdrop="static" data-keyboard="false" role="dialog">
          <div class="modal-dialog">
          
            <!-- Modal content-->
            <div class="modal-content" id="">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change Batch Title</h4>
              </div>
              <div class="modal-body" >
                  <div class="row" style="margin-top: 24px;">
                    <div class="col-md-2"></div>
                    <div class="col-md-6">
                       <input type="text" id="newbatchupdate" value="" class="form-control" placeholder="Enter New Batch Title">
                    </div>
                    <div class="col-md-2"> 
                        <button type="button" class="btn btn-primary" id="changebatchbtn" data-clickedcommon="">Save Changes</button>
                    </div>
                    <div class="col-md-2"></div>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
            
          </div>
      </div>