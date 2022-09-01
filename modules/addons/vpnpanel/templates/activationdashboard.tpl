<link href="modules/addons/vpnpanel/templates/css/custom-all.min.css" rel="stylesheet">
<link href="modules/addons/vpnpanel/templates/css/swiftmodders.css" rel="stylesheet">
<link href="modules/addons/v/templates/css/mystyle.css" rel="stylesheet"> 
<link href="modules/addons/v/templates/css/bootstrap-social.css" rel="stylesheet">
<link href="modules/addons/ActivationCoder/assets/css/style.css" rel="stylesheet">


{literal}
<style type="text/css">
    ul.list-links {
        padding-left: 10px;
    }
    .list-links li {
        list-style: none;
    }

    .list-links a {
        font-weight: bold;
        font-size: 16px;
        text-decoration: underline;
        color: #202f60;
    }
    .list-links a:hover {
        text-decoration: none;
        color: #383e52;
    }
    .activationcodesec{
	    padding: 2px 12px;
	}
	.header_welcome {
	    color: #FFF;
	    padding: 42px 0px;	    
		margin-top: -20px;
       background-size: cover;
	}
	.navbar-default {
	    background-color: #203f7b;
	    border-color: #203f7b;
	    color:#fff;
	}
	.navbar-default .navbar-nav>li>a {
	    color: #fff;
	}
	

</style>
{/literal}


{if isset($searchsec)}
	<input type="hidden" id="serchsecopen" value="1">
{/if}
<div class="container"  style="width: 100%;margin-top: 20px;"> 
    {include file='modules/addons/vpnpanel/templates/nav_header.tpl'}
    <div class="sm-content-container">
        <div class="sm-content">
            <div class="sm-page-heading">
                <h1>Codes Activator</h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="index.php"> Portal Home
                        </a>        </li>
                    <li class="active">
                        Dashboard
                    </li>
                </ol>
            </div> 
            {if $result!=''}
                <div class="alert alert-{$result} alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {$message}
                </div>
            {/if}  
            <div class="row activationcodesec">
		        <div style="float:left;width:100%;">

		            
			 		<div id="clienttabs" style="clear: both;">
					    <ul class="nav nav-tabs admin-tabs"> 
					        <li class="common-li {if isset($activation_dashboard)}active{/if} tabselected" style="cursor: pointer;">
					            <a href="index.php?m=xtreamdashboard&amp;action=actvationcodes">Dashboard</a>
					        </li>
					        <li class="common-li {if isset($activation_generate)}active{/if}" style="cursor: pointer;">
					            <a href="index.php?m=xtreamdashboard&amp;action=actvationcodes&amp;subpage=generate">Generate Codes</a>
					        </li>
					        <li class="common-li {if isset($activation_list)}active{/if}" style="cursor: pointer;">
					            <a href="index.php?m=xtreamdashboard&amp;action=actvationcodes&amp;subpage=list&amp;common=all">My Codes</a>
					        </li>
					        <li class="common-li {if isset($configuration)}active{/if}" style="cursor: pointer;">
					            <a href="index.php?m=xtreamdashboard&amp;action=actvationcodes&amp;subpage=configuration">API Credentials</a>
					        </li>
					        <li class="common-li {if isset($activation_archive)}active{/if}" style="cursor: pointer;">
					            <a href="index.php?m=xtreamdashboard&amp;action=actvationcodes&amp;subpage=archive">Archive List</a>
					        </li>
					    </ul>
					</div>

					{if isset($activation_dashboard)}
					<!-- Dashboard Section -->	
					{include file='modules/addons/xtreamdashboard/templates/activation_dash.tpl'}
				    
		    		<!-- End  Dashboard Section -->	
		    		{/if}
		    		{if isset($activation_generate)}
		    			<!-- Generate Codes Section -->	
		    			{include file='modules/addons/xtreamdashboard/templates/activation_genrate.tpl'}		    			
		    			<!-- End  Generate Codes Section -->	
		    		{/if}

		    		{if isset($activation_list)}
		    		<!-- List Codes Section -->	
		    		<h2 style="margin-top: 25px; margin-bottom: 10px;">List of Activation Code</h2>
		    				<div class="row">
		    					<div class="col-md-12">
							      <center>
							        <a class="btn btn-{if $Common_ind eq 'all'}success{else}primary{/if} btn-customActive same-btn" href="index.php?m=xtreamdashboard&action=actvationcodes&amp;subpage=list&amp;common=all">
							        SEE All
							        </a>
							        <a class="btn btn-{if $Common_ind eq 'allactive'}success{else}primary{/if}  btn-customActive same-btn" href="index.php?m=xtreamdashboard&action=actvationcodes&amp;subpage=list&amp;common=allactive">
							         All Active
							        </a>
							        <a class="btn btn-{if $Common_ind eq 'allinactive'}success{else}primary{/if}  btn-customActive same-btn" href="index.php?m=xtreamdashboard&action=actvationcodes&amp;subpage=list&amp;common=allinactive">
							         All Inactive
							        </a>
							        <a class="btn btn-{if $Common_ind eq 'allactivecurrentmonth'}success{else}primary{/if} btn-customActive same-btn" href="index.php?m=xtreamdashboard&action=actvationcodes&amp;subpage=list&amp;common=allactivecurrentmonth">
							         Active in current month (December,2018)
							        </a>
							        <a class="btn btn-{if empty($Common_ind) }success{else}primary{/if} same-btn" href="index.php?m=xtreamdashboard&action=actvationcodes&amp;subpage=list">Listing by Batches</a>
							      </center>
							    </div>
		    				</div>
		    				{if isset($list_common)}
		    					<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
								  <link rel="stylesheet" href="/resources/demos/style.css">
								  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
							     td
							     {
							        text-align: center;
							     }
							     .hideonload
							     {
							        display: none !important;
							     }
							     .showclick
							     {
							        cursor: pointer;
							     }
							     th
							     {
							            text-align: center !important;
							          }
							    .commonClass
							    {
							      padding: 10px;
							    }
							   .commonfilter {
							        padding-left: 10px !important;
							        padding: 0px;
							        margin-top: 5px;
							    }
							    .addRedBorder{
							      border:1px solid red !important;
							    }
							    .cus-anchor {
							        text-decoration: underline;
							    }
							    .cus-anchor:hover {
							        text-decoration: none;
							    }
							    .common-3customization {
							        width: 20%;
							    }
							    .common-9customization {
							        width: 80%;
							    }
							    .searchSection
							    {
							    padding: 35px 0px;
							    border: 1px solid #ddd;
							        /* border-top: 0; */
							        background-color: rgb(250, 250, 250);
							            margin-bottom: 10px;
							    }
							    .checkme{
							      cursor: pointer;     
							    }
							    #selectall{
							      cursor: pointer;
							      margin-top: 5px;
							    }
							    .same-btn
							    {
							    	display: inline-block;
								    padding: 6px 12px;
								    margin-bottom: 0;
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
							    .tablebg {
								    padding: 5px;
								}
							  </style>
							  <script type="text/javascript">
							     $(document).ready(function(){
							     	var selectedcodeid = [];
							     	if($("#serchsecopen").length > 0)
							     	{
							     		$('.searchSection').show();
							     	}

							     	var currentUserID = $('#currentUserID').val();
							         $(".showpopup").click(function(e){
							          $('#ShowModelUserData').modal('show');
							          $("#AppendUserData").html('<h2 style="text-align: center;">loading data</h2><div style="width: 100%;text-align: center;"><img src="modules/addons/ActivationCoder/assets/img/circleloader.gif" style="width: 100px;"></div>')
							            e.preventDefault();
							            var username = $(this).attr('id');
							            jQuery.ajax({
							              type:"POST",
							              url:"modules/addons/ActivationCoder/ajax-control.php",
							              dataType:"text",
							              data:{
							              action:'GetActiveUserName',
							                username:username,
							                resellersec:'resellersec'
							              },  
							              success:function(response){
							                if(response != '')
							                {
							                  $("#AppendUserData").html("");
							                  $("#AppendUserData").html(response);
							                }
							              }
							            });
							          });
							         $("#filterbtn").click(function(e){
							            conditinalData = 0;
							           $( ".commoninputs" ).each(function() {
							              if($(this).val() != "")
							              {
							                  ++conditinalData;
							              }
							            });
							            if(conditinalData == 0)
							            {
							               e.preventDefault();
							              $('.commoninputs').addClass("addRedBorder");
							            }
							            //e.preventDefault();
							         });
							         $('.commoninputs').on("focus", function(){
							              $('.commoninputs').removeClass("addRedBorder");
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
							         $(".showfilter").click(function(e){
							          e.preventDefault();
							          $('.searchSection').slideToggle('slow');
							         });
							         //select function start here
							         $('#selectall').click(function(){
							             if(this.checked) {
							                  $('.checkme').each(function() {
							                      this.checked = true;
							                      $('.deletebtn').removeAttr('disabled');           
							                      $('.archive_selected').removeAttr('disabled');           
							                  });
							              } else {
							                  $('.checkme').each(function() {
							                      this.checked = false;
							                      $('.deletebtn').attr('disabled', 'disabled'); 
							                      $('.archive_selected').attr('disabled', 'disabled'); 
							                  });
							              }
							         });
							         $('.checkme').click(function(){            
							            var selectCount = $('.checkme').filter(':checked').length;                        
							            if(selectCount == 0){
							              $('.deletebtn').attr('disabled', 'disabled'); 
							              $('.archive_selected').attr('disabled', 'disabled'); 
							            }else{
							              $('.deletebtn').removeAttr('disabled');
							              $('.archive_selected').removeAttr('disabled');
							            }                   
							          });
							         var totaldeletes = 0;
							         
							         $('.deletebtn').click(function(e){
							         	$('.deletefooter').removeClass('hideonload');
							         	selectedcodeid = [];
							          $('.loader-image').addClass('hideonload');
							            e.preventDefault();            
							            $.each($("input[name='codeid']:checked"), function(){            
							                selectedcodeid.push($(this).val());
							            }); 
							            totaldeletes = selectedcodeid.length;
							            $('#confirmationBox').modal('show');
							            $(".AppendConfirmBox").html('<h2 class="text-center">Are you Sure about Delete <b>'+ totaldeletes +'</b> Codes</h2>');           
							         });
							         $('.deleteConfirm').click(function(){
							            $('#confirmationBox').modal('show');
							            $(".AppendConfirmBox").html('');
							            $('.loader-image').removeClass('hideonload');
							            $('.deletefooter').addClass('hideonload');
							            deletefilesfunction(selectedcodeid,currentUserID);
							            // console.log(selectedcodeid);
							         });
							         var totalarchive =0;
							         $('.archive_selected').click(function(e){
							         	$('.deletefooter').removeClass('hideonload');
							         	selectedcodeid = [];
							            $('.loader-image').addClass('hideonload');
							            e.preventDefault();            
							            $.each($(".checkme:checkbox:checked"), function(){            
							                selectedcodeid.push($(this).val());
							            }); 
							            totalarchive = $('.checkme').filter(':checked').length;
							            $('#ArchiveBox').modal('show');
							            $(".AppendArchiveBox").html('<h2 class="text-center">Saving total <b>'+ totalarchive +'</b> to Archive.</h2>');
							         });
							         $('.addArchive').click(function(e){
							          e.preventDefault();
							            $('#ArchiveBox').modal('show');
							            $(".AppendArchiveBox").html('');
							            $('.loader-image').removeClass('hideonload');
							            $('.deletefooter').addClass('hideonload');
							            addtoarchive(selectedcodeid,currentUserID);
							            //console.log(selectedcodeid);
							         });
							     });
							    function deletefilesfunction(selectedfiles = "", resellerID = "")
							    {
							      $.ajax({
							        url: 'modules/addons/ActivationCoder/ajax-control.php',
							        type: "POST",
							        data: {
							            action: 'delete_selected',
							            resellerID: resellerID,
							            selectedfile: selectedfiles
							        },
							        success: function (response) {                             
							            if(response == 1)
							            {
							              window.location.reload();                
							            }
							            else if(response == 0)
							            {
							                $(".loader-image").addClass("hideonload");
							                $(".AppendConfirmBox").html('<center><b>Sorry Error in deleting ActivationCodes</b></center>');
							            } 
							        }
							      }); 
							    }
							  function addtoarchive(selectedfiles = "", resellerID = "")
							  {
							    $.ajax({
							        url: 'modules/addons/ActivationCoder/ajax-control.php',
							        type: "POST",
							        data: {
							            action: 'addtoarchive',
							            resellerID: resellerID,
							            selectedarchive: selectedfiles
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
							              $(".AppendArchiveBox").html('<center><b>Sorry Error in Move to Archive</b></center>');
							            } 
							        }
							    }); 
							  }
							     $( function() {
							        $( ".datepicker" ).datepicker();
							      } );
							  </script>				    			
				    			<div class="row">								    
								    <!-- {if !empty($getActivationCodeData)} -->
								    <div class="col-md-12" style="margin-top: 15px;">
								       <h4 style="text-align: center;">
								         <a href="#" class="btn btn-primary btn-customActive same-btn showfilter">
								          Search/Filter
								         </a>
								       </h4>
								    </div>
								    <!-- {/if} -->
								    <div class="col-md-12" style="margin-top: 0px;">
								      <div class="row searchSection " style="display: none;">
								          <div class="col-md-2">
								          </div>
								          <div class="col-md-8">
								            <div class="row">
								              <form method="POST" action="" id="SearchForm">
								                <div class="col-md-12 commonfilter">
								                  <div class="row">
								                      <div class="col-md-3  common-3customization">
								                          <label>Activation Code</label>
								                      </div>
								                      <div class="col-md-9  common-9customization">
								                          <input type="text" class="form-control activationSelector commoninputs" name="bycode" placeholder="Activation Code" value="{$bycode}">
								                      </div>
								                  </div>
								                </div>
								                <div class="col-md-12 commonfilter">
								                  <div class="row">
								                      <div class="col-md-3 common-3customization">
								                          <label>Created On</label>
								                      </div>
								                      <div class="col-md-9 common-9customization">
								                          <div class="row">
								                              <div class="col-md-6" style="padding-right: 2px;">
								                                  <input type="text" name="cretedfrom" class="form-control datepicker commoninputs" value="{$cretedfrom}" placeholder="Start Date" autocomplete="off">
								                              </div>
								                              <div class="col-md-6" style="padding-left: 2px;">
								                                   <input type="text" name="cretedto" class="form-control datepicker commoninputs" value="{$cretedto}" placeholder="End Date" autocomplete="off">
								                              </div>
								                          </div>
								                      </div>
								                  </div>
								                </div>
								                <div class="col-md-12 commonfilter">
								                  <div class="row">
								                      <div class="col-md-3 common-3customization">
								                          <label>Activated On</label>
								                      </div>
								                      <div class="col-md-9 common-9customization">
								                          <div class="row">
								                              <div class="col-md-6" style="padding-right: 2px;">
								                                  <input type="text" name="activatedfrom" class="form-control datepicker commoninputs" value="{$activatedfrom}" placeholder="Start Date" autocomplete="off">
								                              </div>
								                              <div class="col-md-6" style="padding-left: 2px;">
								                                   <input type="text" name="activatedto" class="form-control datepicker commoninputs" value="{$activatedto}" placeholder="End Date" autocomplete="off">
								                              </div>
								                          </div>
								                      </div>
								                  </div>
								                </div>
								                <div class="col-md-12 commonfilter">
								                  <div class="row">
								                      <div class="col-md-3 common-3customization">
								                          <label>Select by Period</label>
								                      </div>
								                      <div class="col-md-9 common-9customization">
								                          <div class="row">
								                              <div class="col-md-6" style="padding-right: 2px;">
								                                  <select name="sortedby" class="form-control commoninputs">
								                                  		<option value="">Created On</option>
								                                  		<option value="{$todaytimestamp}" {if $sortedby eq $todaytimestamp }selected {/if}>Today</option>
								                                  		<option value="{$yesterdaytimestamp}" {if $sortedby eq $yesterdaytimestamp}selected {/if}>Yesterday</option>
								                                  		<option value="{$lastweektimestamp}" {if $sortedby eq $lastweektimestamp}selected {/if}>Last Week</option>
								                                  		<option value="{$lastmonthtimestamp}" {if $sortedby eq $lastmonthtimestamp}selected {/if}>Last Month</option>
								                                  		<option value="{$lastyeartimestamp}" {if $sortedby eq $lastyeartimestamp}selected {/if}>Last Year</option>
								                                  </select>
								                              </div>
								                              <div class="col-md-6" style="padding-left: 2px;">
								                                   <select name="sortedby2" class="form-control commoninputs">
								                                   		<option value="">Activated On</option>
								                                  		<option value="{$todaytimestamp2}" {if $sortedby2 eq $todaytimestamp2 }selected {/if}>Today</option>
								                                  		<option value="{$yesterdaytimestamp2}" {if $sortedby2 eq $yesterdaytimestamp2}selected {/if}>Yesterday</option>
								                                  		<option value="{$lastweektimestamp2}" {if $sortedby2 eq $lastweektimestamp2}selected {/if}>Last Week</option>
								                                  		<option value="{$lastmonthtimestamp2}" {if $sortedby2 eq $lastmonthtimestamp2}selected {/if}>Last Month</option>
								                                  		<option value="{$lastyeartimestamp2}" {if $sortedby2 eq $lastyeartimestamp2}selected {/if}>Last Year</option>
								                                  </select>
								                              </div>
								                          </div>
								                      </div>
								                  </div>
								                </div> 
								                <div class="col-md-12 commonfilter" style="text-align: center;">
								                  <input type="hidden" name="searchcommon" value="{$Common_ind}">
								                  <input class="btn btn-primary" id="filterbtn" type="submit" name="search" value="Search">
								                </div>
								              </form>  
								            </div> 
								          </div>
								          <div class="col-md-2">
								          </div>
								      </div>
								    </div>
								    <!-- Modal -->
									  <div class="modal fade" id="ShowModelUserData" role="dialog">
									    <div class="modal-dialog">
									      <!-- Modal content-->
									      <div class="modal-content" id="AppendUserData">
									        <div class="modal-header">
									          <button type="button" class="close" data-dismiss="modal">&times;</button>
									          <h4 class="modal-title">Service Details</h4>
									        </div>
									        <div class="modal-body" >
									        </div>
									        <div class="modal-footer">
									          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									        </div>
									      </div>
									    </div>
									  </div>
									 <!-- Modal -->
									  <div class="modal fade" id="confirmationBox" role="dialog">
									    <div class="modal-dialog">
									      <!-- Modal content-->
									      <div class="modal-content">
									        <div class="modal-header">
									          <button type="button" class="close" data-dismiss="modal">&times;</button>
									          <h4 class="modal-title">Confirm Please</h4>
									        </div>
									        <div class="modal-body ">
									          <div class="loader-image hideonload">
									           <center>
									            <img src="modules/addons/ActivationCoder/assets/img/circleloader.gif" style="width: 100px;">
									          </center> 
									          </div>
									          <div class="AppendConfirmBox"></div>          
									        </div>
									        <div class="modal-footer deletefooter">
									          <button type="button" class="btn btn-info deleteConfirm">Delete</button>
									          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
									        </div>
									      </div>
									    </div>
									  </div>
									 <!-- ArchiveBox Modal -->
									  <div class="modal fade" id="ArchiveBox" role="dialog">
									    <div class="modal-dialog">
									      <!-- Modal content-->
									      <div class="modal-content">
									        <div class="modal-header">
									          <button type="button" class="close" data-dismiss="modal">&times;</button>
									          <h4 class="modal-title">Confirm Please</h4>
									        </div>
									        <div class="modal-body ">
									          <div class="loader-image hideonload">
									           <center>
									            <img src="modules/addons/ActivationCoder/assets/img/circleloader.gif" style="width: 100px;">           
									          </center> 
									          </div>
									          <div class="AppendArchiveBox"></div>          
									        </div>
									        <div class="modal-footer deletefooter">
									          <button type="button" class="btn btn-info addArchive">Add to Archive</button>
									          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
									        </div>
									      </div>
									    </div>
									  </div>
									  {if !empty($getActivationCodeData)}
									  	 <div class="row"> 
        									<div class="col-md-12" style="text-align: right;">       									
        										<button class="btn btn-info archive_selected" disabled>Add to Archive</button>

        									<a class="btn btn-primary same-btn" href="{$final_redirect}" target="_blank">Download CSV</a>
        									
									          <button class="btn btn-danger deletebtn" disabled>
									            Delete Selected
									          </button>	
        									</div>
        								</div>	
									  {/if}
								  </div>
								  <div class="row">
								  	{if !empty($getActivationCodeData)}
								  		{if isset($totalRecords)}
								  			{if isset($searchsec)}
								  				<p style="padding-left: 10px;">
	                								Total {$totalRecords} Records found
	                							</p>
								  				{else}
								  				<p style="padding-left: 10px;">
	                								Total {$totalRecords} Records found, Page {$currentPage} of {$totalPage} 
	                							</p>
								  			{/if}
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
										            	{if isset($OrderBycall)}
											               <a href="{$currentCommon}&orderbyid={$OrderBycall}"> 
											               ID
											               </a>
											               <img src="modules/addons/ActivationCoder/assets/img/{$OrderBy}.gif" class="absmiddle">
											               {else}
											               ID
										               {/if}
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
										   {if !isset($searchsec)}
											   <p align="center">
											   {if isset($previousPage) && !empty($previousPage) && $previousPage != 0}
											   		<a href="index.php?m=xtreamdashboard&action=actvationcodes&subpage=list&common={$Common_ind}&orderbyid={$OrderBy}&pageno={$previousPage}">&#171; Previous Page </a>&nbsp;
											   		{else}
											   		&#171; Previous Page &nbsp;		
											   {/if}
											   {if isset($nextPage) && !empty($nextPage) && !($nextPage > $totalPage)}
											   		<a href="index.php?m=xtreamdashboard&action=actvationcodes&subpage=list&common={$Common_ind}&orderbyid={$OrderBy}&pageno={$nextPage}">Next Page &#187; </a>&nbsp;
											   		{else}
											   		Next Page &#187;  &nbsp;		
											   {/if}
											   </p>
										   {/if}
										</div>
										{else}
										<center style="margin-top: 50px;"><h1>No result found!!</h1></center>
									{/if}
								</div>
								{else}
								<!-- batch list code here -->
								{include file='modules/addons/xtreamdashboard/templates/activation_listbybatch.tpl'}
									
						 
						  {/if}
		    		<!-- End  List Codes Section -->
		    			
		    		{/if}

		    		{if isset($activation_archive)}		    			
		    			{include file='modules/addons/xtreamdashboard/templates/archive.tpl'}		    		
		    		{/if}


		    		{if isset($configuration)}		    			
		    			{include file='modules/addons/xtreamdashboard/templates/activation-configuration.tpl'}	    		
		    		{/if}

		        </div>
            </div>
    </div>          
{literal}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
    <script src="https://clipboardjs.com/dist/clipboard.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.js"></script> 
    <script>
    </script>
{/literal}