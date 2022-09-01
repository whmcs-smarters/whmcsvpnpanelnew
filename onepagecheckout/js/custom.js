function tabselect(domainboxid)
{
    if (domainboxid == 'newdomain') 
    {
        $("#domain-btn").text("CHECK");
        $("#newdomain").addClass("active");
        $("#existingdomain,#transferdomain").removeClass("active");
    }
    if (domainboxid == "existingdomain") 
    {
        $("#domain-btn").text("USE");
        $("#existingdomain").addClass("active");
        $("#newdomain,#transferdomain").removeClass("active");
    }
    if (domainboxid == "transferdomain") 
    {
        $("#domain-btn").text("TRANSFER");
        $("#transferdomain").addClass("active");
        $("#newdomain,#existingdomain").removeClass("active");
    }
}

function domainsearch()
{
    var mode=$("#domain-btn").text();
    $("#ordersummary-items .deets-3").remove();
    
    $("#msg").html('');
    if ($("#domainrt").val() == '') 
    {
        $("#msg").html('<div class="col-md-1 www no-padding"></div><div class="col-md-10 no-padding"><div class="alert alert-danger"><center><strong>Error!</strong> Please fill the domain name.</center></div></div>');
        return;
    }
    $("#msg").html("<div class='col-md-1 www no-padding'></div><div class='col-md-10 no-padding'><div class='alert alert-info text-info'><center><strong>Searching...</strong><br /> <img src='images/loader.gif' alt='loader' style='width:50px;'></img><center></div></div>");
    
    var ordersummaryname='';
    var domaintype='';
    var success_msg='';
    var error_msg='';
    var domainname=$("#domainrt").val() + $("#sel1").val();
    
    if(mode=='USE')
    {
        //ordersummaryname='transfer';
        ordersummaryname='Existing Domain';
        //domaintype="transfer";
        domaintype="use";
        error_msg='<div class="col-md-1 www no-padding"></div><div class="col-md-10 no-padding"><div class="alert alert-warning"><center><strong>Oops! </strong> The domain <b> '+domainname+'</b> is currently not registered and cannot be used</center></div></div>';
        success_msg='<div class="col-md-1 www no-padding"></div><div class="col-md-10 no-padding"><div class="alert alert-success"><center><strong>Congratulations! </strong> The Domain <b>'+ domainname +' </b>is already registered and can be used.</center></div></div>';
        
    }
    else if(mode=='TRANSFER')
    {
        ordersummaryname='Domain transfer';
        domaintype="transfer";
        error_msg='<div class="col-md-1 www no-padding"></div><div class="col-md-10 no-padding"><div class="alert alert-warning"><center><strong>Oops! </strong> The domain <b> '+domainname+'</b> is currently not registered and cannot be transferred</center></div></div>';
        success_msg='<div class="col-md-1 www no-padding"></div><div class="col-md-10 no-padding"><div class="alert alert-success"><center><strong>Congratulations! </strong> The Domain <b>'+ domainname +' </b>is already registered and can be transfered.</center></div></div>';
    }
    else if(mode=='CHECK')
    {
        ordersummaryname='Domain registration';
        domaintype="register";
        success_msg='<div class="col-md-1 www no-padding"></div><div class="col-md-10 no-padding"><div class="alert alert-success"><center><strong>Congratulations! </strong> The Domain <b>'+ domainname +' </b>is available for registartion.</center></div></div>';
        error_msg='<div class="col-md-1 www no-padding"></div><div class="col-md-10 no-padding"><div class="alert alert-warning"><center><strong>Oops! </strong> The Domain <b>'+ domainname +' </b> is already registered.</center></div></div';
    }
    
    $.ajax(
           {
                url: "onepagecart/ajax/checkdomain.php?domain=" + $("#domainrt").val() + $("#sel1").val() + "&tld=" + $("#sel1").val()+ "&type=" + domaintype,
                success: function(result) 
                {
                   if(result.available)
                    {
                        domainname=result.givendomain+$("#sel1").val();
                        $("#msg").html(success_msg);
                        
                        $("#ordersummary-items").append("<div class='deets-3'><div class='col-md-12'><div class='order-details clearfix'><div class='col-md-6 pull-left order-description'><small>"+ordersummaryname+": " + domainname + "</small></div><div class='col-md-6 pull-right order-price order-item' data-price='" + result.price + "'>$" + result.price + "</div></div></div></div>");
                        //$("#longsubtotal").text(result.price);
                        $("#longsubtotal,#longtotal").text(calculateTotal());
                    }
                    else
                    {
                        $("#msg").html(error_msg);
                        
                    }
                },dataType: "json"
        
    });
}

//getting product details(addons, billing cycle)

function getProductBillingCycle()
{
    var id=$("#products-dropdown").val();
    
    $.ajax(
           {
                url: "onepagecart/ajax/ajax.php?" + "products[]=" + id, 
                success: function(result)
                {
                    $("#ordersummary-items .deets-1").remove();
                    $("#ordersummary-items .deets-2").remove();
                    $("#billingcycle").find('option').remove().end();
                    $("#addon-div").hide();
                    
                    $.each(result.products, function(key, value) 
                    {
                        $("#duecycle").text("Due " + ucfirst(value.billingcycle));
                        $(".longdueterm").text("Due " + ucfirst(value.billingcycle));
                        
                        $.each(value.pricing, function(p, price) 
                        {
                            if (price.price != "-1.00" && price.price != "-1")
                            {
                                if (value.billingcycle == price.term)
                                {
                                    var selected = "selected";
                                }
                                else 
                                {
                                    var selected = "";
                                }
                     
                                if (value.paytype == 'recurring') 
                                {
                                    var recurring = price;
                                }
                                else
                                {
                                    var recurring = "0.00";
                                }
                                if (price.savings != '0')
                                {
                                    var savings = " (Save " + price.savings + "%!)";
                                }
                                else
                                {
                                    var savings = "";
                                }
                                var monprice = price.price / price.months;
                                $("#billingcycle").append("<option value='" + price.term + "' data-price='" + recurring + "' data-price-today='" + price.price + "' " + selected + ">" + ucfirst(price.term) + " - $" + monprice.toFixed(2) + " per Month - " + accounting.formatMoney(price.price) + savings + "</option>");
                            }
                        });
                        //end product billing cycle
                        /*
                        $("#product-custom").empty();
                        if (result.cfields != null)
                        {
                            $.each(result.cfields, function(key, value)
                            {
                                cushtml = "<div class='col-md-11'><label class='control-label col-md-3 checkout-label col-md-offset-1' for='id_domain'><p>" + value.name + "</p></label><div class='col-md-7'><div class='form-group select_wrap'><select name='customfields[" + value.id + "]' data-field-id='" + value.id + "' id='customfields[" + value.id + "]' class='customfield form-control styled trigger-update'>";
                                $.each(value.options, function(cuskey, cusvalue)
                                {
                                    cushtml = cushtml + "<option value='" + cusvalue.val + "' " + cusvalue.selected + ">" + cusvalue.val + "</option>";
                                });
                                cushtml = cushtml + "</select></div></div></div>";
                                $("#product-custom").append(cushtml);
                            });
                        }
                        */
                        $("#ordersummary-items").prepend("<div class='deets-1'><div class='col-md-12'><div class='order-details clearfix'><div class='col-md-6 pull-left order-description'>" + value.name + " <small>(Renews <span id='billmode'>" + ucfirst(value.billingcycle) + "</span>)</small></div><div class='col-md-6 pull-right order-price order-item' id='mainproduct' data-price='" + value.productorig + "'>$" + value.productorig + "</div></div></div></div>");
                        //calculating amount
                        
                        //$("#longsubtotal,#longtotal").text(parseFloat($("#longsubtotal").text())+parseFloat(value.productorig));
                        $("#longsubtotal,#longtotal").text(calculateTotal());
                        //if (notPrefill == 1) 
                        {
                            $("#addons-list").empty();
                            alert(value.addons);
                            if (value.addons != null) 
                            {
                                $.each(value.addons, function(akey, avalue)
                                {
                                    var achecked;
                                    var customClass;
                                    if (typeof result.addons != 'undefined')
                                    {
                                        $.each(result.addons, function(selkey, selvalue)
                                        {
                                            if (selvalue.id == avalue.relid)
                                            {
                                                achecked = 'checked';
                                                customClass = 'addon-checked';
                                            }
                                        });
                                    }
                                    $("#addon-div, #addon-heading").show();
                                    $("#addons-list").append("<div id='addon-div-" + avalue.relid + "'  class='form_sec1 form_sec2'><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2 border_set'><img src='images/addons-placeholder.png' class='addons-placeholder' alt='addon img'/></div><div class='col-lg-7 col-md-7 col-sm-7 col-xs-7 border_set custom-addons-text'><div class='checkbox'><input type='checkbox' name='addons[]' value='" + avalue.relid + "' id='addon-" + avalue.relid + "' onclick='selectProductAddon(this.value)'><label for='addon-" +avalue.relid +"'><h4 id='addon-name-" + avalue.relid + "'>" + avalue.name + "</h4>" + avalue.description + " </label></div></div><div class='col-lg-3 col-md-3 col-sm-3 col-xs-3 padd_set'><h3 id='addon-price-" + avalue.relid + "'><b>$" + avalue.monthly + "</b></h3><p class='parag'>(Billed " + avalue.billingcycle + ")</p></div></div>");
                                });
                            }
                            else
                            {
                                $("#addon-div, #addon-heading").hide();
                            }
                        }
                    });//end product
                    //configuration option
                  
                    $("#config-container").empty();
                    $("#product-config").hide();
                    if (result.configoptions !== null)
                    {
                        var select;
                        $.each(result.configoptions, function(ckey, cvalue)
                        {
                            $("#product-config").show();
                            var confightml="<option value='0'>Select Configurable Options</option>";
                            var itemlabel;
                          
                            $.each(cvalue, function(cikey, civalue)
                            {
                                if (civalue.selected) {
                                var cosel = "selected";
                            } 
                            else
                            {
                                var cosel = "";
                            }
                            confightml =confightml+"<option value='" + civalue.sub_id + "' " + cosel + "config-option-name='"+civalue.optionname+"' config-price='"+civalue.price+"'> " + civalue.optionname + " (+$" + civalue.price + ")</option>";
                            //itemlabel = "<div class='four columns'><label for='configoption[" + ckey + "]'>" + civalue.opt_name + "</label></div>";
                            itemlabel = "<label class='control-label col-md-2 checkout-label' for='configoptions[" + ckey + "]'><p id='config-name-" + ckey + "'>" + civalue.opt_name + "</p></label>";

                            });
                            select="<div class='col-md-10'><div class='form-group select_wrap custom-dropdown'><select id='configoptions-" + ckey + "' name='configoptions[" + ckey + "]' class='form-control' onchange='productConfigChanged(this.value,"+ckey+");' data-config-id='" + ckey + "'>"+confightml+"</select></div></div>";
                            $("#config-container").append(itemlabel+select);
                        });
                    }
                    
                    //end Configuration option
                },//end success
                dataType: "json"
            });//end ajax
    }

function ucfirst(str) {
    str += '';
    var f = str.charAt(0)
            .toUpperCase();
    return f + str.substr(1);
}


function selectProductAddon(addonid)
{
   $("#addon-div-"+addonid).toggleClass('form_border');
   var addonName=$("#addon-name-"+addonid).text();
   var addonPrice=$("#addon-price-"+addonid).text();
   var priceint=parseFloat(addonPrice.replace("$", ""));
   
    if($("#addon-"+addonid).prop("checked") == true)
    {
        $("#ordersummary-items").append("<div class='deets-2 checkout-custom' id='addon-summary-"+ addonid +"'><div class='col-md-12'><div class='col-md-8 left-align'><small>" + addonName + "</small></div><div class='col-md-3 right-align order-item' data-price='" + priceint + "'>" + addonPrice + "</div></div></div>");
        //$("#longsubtotal,#longtotal").text(parseFloat($("#longsubtotal").text())+parseFloat(addonPrice.replace("$", "")));
    }
    else if($("#addon-"+addonid).prop("checked") == false)
    {
        $("#addon-summary-"+addonid).remove();
        //$("#longsubtotal,#longtotal").text(parseFloat($("#longsubtotal").text())-parseFloat(addonPrice.replace("$", "")));
    }
    $("#longsubtotal,#longtotal").text(calculateTotal());
}



function applyPromoCode()
{
   
   var promocode=$("#promocode").val();
   var id=$("#products-dropdown").val();
   
   $.ajax(
           {
                url: "onepagecart/ajax/ajax.php?" + "promo=" + promocode+ "&products[]=" + id, 
                success: function(result)
                {
                    if (typeof result.promo != 'undefined' && typeof result.promo.code != 'undefined' ) 
                    {
                        if (result.promo.used === true) 
                        {
                            $("#couponcode").show();
                            $("#couponcode").html('<h3 style="margin-bottom: 0px;font-size: 16px;">The coupon <b>' + result.promo.code + '</b> has been applied to your order! <a class="remove_promo" href="javascript:void(0);" title="Remove code" alt="Remove code" style="float:right"><i class="fa fa-times" aria-hidden="true"></i></a></h3>');
                            if (result.promo.extra.type == 'percent') 
                            {
                                cptrailer = '%';
                            } 
                            else
                            {
                                cptrailer = '';
                            }
                            
                            
                            if (result.promo.extra.type == 'fixed' || result.promo.extra.type == 'override') 
                            {
                                cppre = '$';
                            } 
                            else 
                            {
                                cppre = '';
                            }
                            $("#discount").show();
                            //console.log("Discount with type: " + result.promo.extra.type + " with discount " + result.promo.extra.pre + "/" + result.promo.extra.amount);
                            
                            if (result.promo.extra.type == 'percent') 
                            {
                                $("#long-coupon-amount").text('-' + cppre + parseFloat(result.promo.extra.amount).toFixed(2) + cptrailer);
                                num=parseFloat($("#longtotal").text());
                                var percentageAmount=percentage(num, result.promo.extra.amount);
                                $("#longtotal").text((num-percentageAmount).toFixed(2));
                            }

                            if (result.promo.extra.type == 'override') 
                            {
                                $("#long-coupon-amount").text('-' + cppre + parseFloat(result.promo.extra.pre).toFixed(2) + cptrailer);
                            }

                            if (result.promo.extra.type == 'fixed') 
                            {
                                $("#long-coupon-amount").text('-$' + parseFloat(result.promo.extra.pre).toFixed(2));
                            }

                            $("#long-coupon-code").text('(' + result.promo.code + ')');
                            $("#promocode").css("border", "2px solid green");
                            $("#promomsg").hide();
                            $("#promosuccess").show();
                        } 
                        else {
                            $("#sidebar-coupon-code").text("None");
                            $("#sidebar-coupon").hide();
                            $("#long-coupon-code").text("None");
                            $("#discount").hide();
                            $("#promocode").css("border", "2px solid red");
                            $("#promomsg").show();
                            $("#promosuccess").hide();
                            $("#couponcode").hide();
                        }
                    } 
                    else
                    {
                        $("#sidebar-coupon").hide();
                        $("#discount").hide();
                        $("#promocode").css("border", "1px solid #ccc");
                    }
                },
                dataType: "json"
       });
}


function percentage(num, per)  
{  
 var total='';
  total=(num/100)*per; 
  return total.toFixed(2);
}  



function billingCycleChanged()
{
    var billing=$("#billingcycle option:selected").attr("data-price-today");
    var billingMode=$("#billingcycle option:selected").val();
    $("#billmode").text(billingMode);
    $("#mainproduct").text("$"+billing);
    $("#mainproduct").attr("data-price",billing);
    $("#longsubtotal,#longtotal").text(calculateTotal());
}

function productConfigChanged(data,keyvalue)
{
    //$(".config-opt").remove();
    var name=$("#configoptions-"+keyvalue+" option:selected").attr("config-option-name");
    var price=$("#configoptions-"+keyvalue+" option:selected").attr("config-price");
    var configName=$("#config-name-"+keyvalue).text();
    
    if(data!=0)
    {
        $("#ordersummary-items").append("<div class='deets-2 config-opt'><div class='col-md-12'><div class='order-details clearfix'><div class='col-md-6 pull-left order-description'><small>" + configName+" - "+name + "</small></div><div class='col-md-6 pull-right order-price order-item' data-price='" + price + "'>$" + price + "</div></div></div></div>");
    }
    
    $("#longsubtotal,#longtotal").text(calculateTotal());
    
}

function calculateTotal()
{
    var totaltoday = 0;
            $(".order-item").each(function() 
            {
                totaltoday += parseFloat($(this).attr('data-price'));
            });
    return totaltoday.toFixed(2);
}



function selectLoginMode(data)
{
    if(data=='alreadyRegistered')
    {
        $("#containerNewUserSignup").hide();
        $("#containerExistingUserSignin").show();
        $("#btnAlreadyRegistered").hide();
        $("#btnNewUserSignup").show();
        $("input[name='account_type']").val('existing');
    }
    else if(data=='newUserSignup')
    {
        $("#containerExistingUserSignin").hide();
        $("#containerNewUserSignup").show();
        $("#btnAlreadyRegistered").show();
        $("#btnNewUserSignup").hide();
        $("input[name='account_type']").val('create');
    }
}

$(document).ready(function()
{
    alert(1);
    $("#placeorder").submit(function(e)
    {
       var status='no error';
       var loggedinstatus='no';
       if($("#btnAlreadyRegistered").css("display")!='none')
       {
            status=validateNewRegForm(e);
       }
       if($("#btnNewUserSignup").css("display")!='none')
       {
           status=validateAlreadyForm(e);
           
           
       }
       
       if($("#clientalreadyloggedin").val()=='block')
       {
           status='no error';
           var loggedinstatus='yes';
           
       }
       
       if($("#accepttos").prop("checked")==false)
       {
            e.preventDefault();
            alert('You must agree to the terms of service.');
            return false;
       }
       
       //start placing order
       if(status=='no error')
       {
           $("#orderProcessingModal").modal({
                     keyboard: false,
                     backdrop: 'static',
                 });
                 $("#closemodal").hide();
                 $("#orderProcessingModal .modal-body").html("<div class='alert alert-info' style='text-align: center'><strong>Just a minute!</strong><br /> We're processing your order. This can take up to 60 seconds, so just sit back and relax. <br /><img src='onepagecart/assets/aso/images/ajax-loader.gif'></img> <br /><strong>Please don't close your browser or hit the back button!</strong></div>");
                 $("#orderProcessingModal .modal-footer").html("<button type='button' class='btn btn-warning'>&nbsp; &nbsp;</button>");
         
                 var postData = $(this).serializeArray();
                 var getVar = "?loggedin="+loggedinstatus;
         
                 $.ajax({
                     url: "onepagecart/ajax/placeorder.php" + getVar,
                     type: "POST",
                     data: postData,
                     dataType: "json",
                     success: function(data, textStatus, jqXHR) 
                     {
                         console.log(data);
                         //data: return data from server
                         if (data.status == 'success') 
                         {
                             $("#orderProcessingModal .modal-footer").html("");
                             $("#closemodal").show();
                             // Do all the success fun here.
                             $("#orderProcessingModal .modal-body").empty();
                             $("#orderProcessingModal .modal-body").append("<div class='alert alert-success'><strong>Success!</strong> Your order has been successfully completed!</div>");
                             if (data.paytype == 'paypal') 
                             {
                                 if (!data.fraud) 
                                 {
                                     $("#orderProcessingModal .modal-body").append("<div class='alert alert-info'><strong>Hang Tight!</strong> We're redirecting you over to PayPal to finish your order!</div>");
                                     $(".postcontainer").append(data.paypal);
                                 } 
                                 else
                                 {
                                     $("#orderProcessingModal .modal-body").append("<div class='alert alert-warning'><strong>Something went Wrong!</strong> Please contact our support team.</div>");
                                     $("#closemodal").show();
                                 }
                             } else if (data.paytype == 'sadad') {
                                  $("#orderProcessingModal .modal-body").append("<div class='alert alert-info'><strong>Hang Tight!</strong> We're redirecting you over to Sadad to finish your order!</div>");
                                     $(".postcontainer").append(data.sadad);
                             } else if (data.paytype == 'dialect') {
                                  $("#orderProcessingModal .modal-body").append("<div class='alert alert-info'><strong>Hang Tight!</strong> We're redirecting you over to Dialect to finish your order!</div>");
                                     $(".postcontainer").append(data.dialect);
                             }
                             else 
                             {
                                 $("#orderProcessingModal .modal-body").append("<div class='alert alert-info'><strong>Hang Tight!</strong> We're taking you to the order summary!</div>");
                                 window.location.href = data.redirecturl;
                             }
         
                         } 
                         else {
                             $("#orderProcessingModal .modal-body").empty();
                             $("#closemodal").show();
                             $("#orderProcessingModal .modal-footer").html("<button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>");
                             // Expand the errors from the array, probably via .each
                             $.each(data.errors, function(k, val) {
                                 $("#orderProcessingModal .modal-body").append("<div class='alert alert-danger'><strong>Error:</strong> " + val.message + "</div>");
                             });
                         }
                     },
                     error: function(jqXHR, textStatus, errorThrown) {
                         $("#orderProcessingModal .modal-footer").html("<button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>");
                         $("#orderProcessingModal .modal-body").html("<div class='alert alert-danger'><strong>Error:</strong> An error has occured with your order. Please contact customer support, or try your order again shortly.</div>");
                         $("#closemodal").show();
         
                     }
                 });
                 return false;
       }
       //end placing order
    });
    
    //for first name
    $('#firstname').keyup(function()
    {
        if($(this).val()!='')
        {
            $(this).parent().removeClass('has-error');
        }
        else
        {
            $(this).parent().addClass('has-error');
        }
    });
    
    //for last name
    $('#lastname').keyup(function()
    {
        if($(this).val()!='')
        {
            $(this).parent().removeClass('has-error');
        }
        else
        {
            $(this).parent().addClass('has-error');
        }
    });
    
    $('#password').keyup(function()
    {
        if($(this).val()!='')
        {
            $(this).parent().removeClass('has-error');
        }
        else
        {
            $(this).parent().addClass('has-error');
        }
    });
    
    $('#cpassword').keyup(function()
    {
        if($(this).val()!='' && $(this).val()==$("#password").val())
        {
            $(this).parent().removeClass('has-error');
        }
        else
        {
            $(this).parent().addClass('has-error');
        }
    });
    
    //for email
    $('#email').keyup(function()
    {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if($(this).val()!='' && emailReg.test($(this).val()))
        {
            $(this).parent().removeClass('has-error');
        }
        else
        {
            $(this).parent().addClass('has-error');
        }
    });
    
    //for alreday registered
    
    //for email
    $('#inputLoginEmail').keyup(function()
    {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if($(this).val()!='' && emailReg.test($(this).val()))
        {
            $(this).parent().removeClass('has-error');
        }
        else
        {
            $(this).parent().addClass('has-error');
        }
    });
    //password
    $('#inputLoginPassword').keyup(function()
    {
        if($(this).val()!='')
        {
            $(this).parent().removeClass('has-error');
        }
        else
        {
            $(this).parent().addClass('has-error');
        }
    });
    
});


function validateNewRegForm(e)
{
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    var status='no error';
    var names = $('#firstname').val();
    var company = $('#lastname').val();
    var email = $('#email').val();
    var password = $('#password').val();
    var cpassword = $('#cpassword').val();
    
    var inputVal = new Array(names,company, email,password,cpassword);

    if(inputVal[3] == "")
    {
        e.preventDefault();
        $('#password').parent().addClass('has-error');
        $('#password').focus();
        status='error';
    }
    
    if(inputVal[4] == "")
    {
        e.preventDefault();
        $('#cpassword').parent().addClass('has-error');
        $('#cpassword').focus();
        status='error';
    }
    else if(password!=cpassword)
    {
        e.preventDefault();
        $('#cpassword').parent().addClass('has-error');
        $('#cpassword').focus();
        status='error';
    }
    
    if(inputVal[2] == "")
    {
        e.preventDefault();
        $('#email').parent().addClass('has-error');
        $('#email').focus();
        status='error';
    }
    else if(!emailReg.test(email))
    {
        e.preventDefault();
        $('#email').parent().addClass('has-error');
        $('#email').focus();
        status='error';
    }
    if(inputVal[1] == "")
    {
        e.preventDefault();
        $('#lastname').parent().addClass('has-error');
        $('#lastname').focus();
        status='error';
    }
    
    if(inputVal[0] == "")
    {
        e.preventDefault();
        $('#firstname').parent().addClass('has-error');
        $('#firstname').focus();
        status='error';
    }
    return status;
    
}   

function validateAlreadyForm(e)
{
    var status='no error';
    var email = $('#inputLoginEmail').val();
    var password = $('#inputLoginPassword').val();
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if(email== "")
        {
            e.preventDefault();
            $('#inputLoginEmail').parent().addClass('has-error');
            $('#inputLoginEmail').focus();
            status='error';
        } 
        else if(!emailReg.test(email))
        {
            e.preventDefault();
            $('#inputLoginEmail').parent().addClass('has-error');
            $('#inputLoginEmail').focus();
            status='error';
        }
        
        if(password == "")
        {
            e.preventDefault();
            $('#inputLoginPassword').parent().addClass('has-error');
            $('#inputLoginPassword').focus();
            status='error';
        }
        return status;
        
}

