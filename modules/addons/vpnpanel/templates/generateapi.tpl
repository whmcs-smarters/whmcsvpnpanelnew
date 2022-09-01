<div class="fullpageloader" style="position: fixed; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 99999; top: 0px; left: 0px; display: none;">
    <p style="position: absolute; left: 40%; top: 30%; color: #fff; font-size: 25px;"><i class="fa fa-circle-o-notch  fa-spin"></i> Loading Please wait...</p>
</div><h2>API KEY</h2><a href="addonmodules.php?module=ResellerAutomaticAPI" class="btn btn-success pull-right" style="margin-top: -15px;"><i class="fa fa-users"></i> Reseller API Key</a>
<h5>API Key is used to communicate between VPN Panel and  VPN App securely</h5>
<p class="alert alert-info"><strong>Note</strong> : if you generate new API Key or updated the existing one, then your old one will no longer be working. </p>
<div class="message"></div>
<form method="post" id="" name="">
    <input type="hidden" id="submitted" name="submitted" value="Delete Atom">
    <table id="banlist" class="table table-striped table-bordered" cellspacing="0" style="width: 50%; margin:auto;">
        <thead>
            <tr>
                <td><strong>Current API Key</strong></td><td><p class="text-center apicode">{if {$apikey} neq ''}<input type="text" readonly="readonly" class="apikeyinput form-control pull-left" style="border: none; width: 50%;" value="{$apikey}"> 
                        <button type="button" class="editkey btn btn-info" style="float: left;" readonly="readonly">Edit</button> 
                        <button type="button"  class="updatekey btn btn-update" style="display: none; float: left;">Update</button> 
                        <button type="button" class="cancelkey btn btn-danger" style="display: none; float: left;">Cancel</button>
                        {else}
                            <input type="text" readonly="readonly" class="apikeyinput form-control pull-left" style="border: none; width: 50%;" value=""> 
                            <button type="button" class="editkey btn btn-info" style="float: left;" readonly="readonly">Edit</button> 
                            <button type="button"  class="updatekey btn btn-update" style="display: none; float: left;">Update</button> 
                            <button type="button" class="cancelkey btn btn-danger" style="display: none; float: left;">Cancel</button>
                            {/if}</p></td>
                    </tr>
                    <tr><td class="text-center" colspan="2"><button type="button" class="btn btn-success generateapi generatebtn" name="generateapi">Generate New API Key</button></td></tr>
                </thead>
                <tbody class="text-center">
                </tbody>
            </table>
        </form>
        
            <form method="post">
                <table id="banlist" class="table table-striped table-bordered" cellspacing="0" style="width: 50%; margin:auto;">
                    <thead>
                        <tr>
                            <th>
                                Set Signup Product
                            </th>
                            <td> 
                               {$allProductshtml}
                            </td>
                        </tr>
                        <tr><td colspan="2"><p class="text-center"><button class="btn btn-success" name="saveproduct">Save Product</button></p></td></tr>
                    </thead>
                    <tbody class="text-center">
                    </tbody>
                </table>
            </form>
        
        <div class="row">
            <div class="col-md-12" style="margin-bottom: 30px;">
                <a href="https://www.whmcssmarters.com/clients/index.php?rp=/knowledgebase/151/Lost-Your-API-Key-or-System-moved-or-Re-install-VPN-Panel-.html"  target="_blank" class="link" style="float:left; clear: both; text-decoration: underline;">Lost Your API Key ?</a>
                <a href="https://www.whmcssmarters.com/clients/index.php?rp=/knowledgebase/151/Lost-Your-API-Key-or-System-moved-or-Re-install-VPN-Panel-.html"  target="_blank" class="link" style="float:left; clear: both; text-decoration: underline;">System Upgraded ? Re-issue your API Key</a>
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
                .activeinput
                {

                }
            </style>

            <script>

                $('document').ready(function ()
                {
                    
                    var currentapikey = $('input.apikeyinput').val();
                    $('.editkey').click(function () {
                        $('input.apikeyinput').removeAttr('readonly');
                        $('input.apikeyinput').addClass('activeinput');
                        $('input.apikeyinput').focus();
                        $(this).hide();
                        $('.cancelkey, .updatekey').show();
                    })
                    $('.cancelkey').click(function () {
                        $('input.apikeyinput').attr('readonly', 'readonly');
                        $('input.apikeyinput').removeClass('activeinput');
                        $('input.apikeyinput').val(currentapikey);
                        $(this).hide();
                        $('.editkey').show();
                        $('.updatekey').hide();

                    })
                    $('.updatekey').click(function () {

                        if ($('input.apikeyinput').val().length > 0)
                        {
                            swal({
                                title: "Are you sure?",
                                text: "You will also have to change the API Credentials in your Application too.",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonClass: "btn-danger",
                                confirmButtonText: "Yes",
                                closeOnConfirm: false
                            },
                                    function () {
                                        $('input.apikeyinput').attr('readonly', 'readonly');
                                        $('input.apikeyinput').removeClass('activeinput');
                                        $('.updatekey').hide();
                                        $('.editkey').show();
                                        $('.cancelkey').hide();
                                        //$('.fullpageloader').show();
                                        var manualapikey = $('input.apikeyinput').val();
                                        var postdata = {generateapi: 'true', apicode: manualapikey};
                                        $.ajax({
                                            dataType: "text",
                                            type: 'POST',
                                            data: postdata,
                                            cache: false,
                                            success: function (data)
                                            {
                                                //$('.fullpageloader').hide();
                                                if (data)
                                                {
                                                    //$('#success').html(data);
                                                    $('.input.apikeyinput').val(manualapikey);
                                                    swal('Success!', 'API Key Updated Successfully.', 'success');
                                                    window.location.reload();
                                                } else
                                                {
                                                    swal('Error!', 'Failed To Update API Key.', 'error');
                                                }
                                            }
                                        });
                                    })
                            //$('.fullpageloader').hide();
                        } else
                        {
                            swal('Error!', 'API Key cannot be empty.', 'error');
                        }
                    })

                    var apicodetext = $('.apicode').text();


                    //$('.apicode').html();


                    function makeid(length) {
                        var result = '';
                        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                        var charactersLength = characters.length;
                        for (var i = 0; i < length; i++) {
                            result += characters.charAt(Math.floor(Math.random() * charactersLength));
                        }
                        return result;
                    }

                    $('.generateapi').click(function () {
                        swal({
                            title: "Are you sure?",
                            text: "You will also have to change the API Credentials in your Application too.",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonClass: "btn-danger",
                            confirmButtonText: "Yes",
                            closeOnConfirm: false
                        },
                                function () {
                                    var randomapi = makeid(12);
                                    var postdata = {generateapi: 'true', apicode: randomapi};
                                    $.ajax({
                                        dataType: "text",
                                        type: 'POST',
                                        data: postdata,
                                        cache: false,
                                        success: function (data)
                                        {
                                            if (data)
                                            {
                                                //$('#success').html(data);
                                                $('.input.apikeyinput').val(randomapi);
                                                swal('Success!', 'New API Key Generated Successfully.', 'success');
                                                window.location.reload();
                                            } else
                                            {
                                                swal('Error!', 'Failed To Generate New API Key.', 'error');
                                            }
                                        }
                                    });

                                })

                    })



                });
            </script>
        {/literal}