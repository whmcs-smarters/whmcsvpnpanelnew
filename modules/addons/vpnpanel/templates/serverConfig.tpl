<div class="fullpageloader" style="position: fixed; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 99999; top: 0px; left: 0px; display: none;">
    <p style="position: absolute; left: 40%; top: 30%; color: #fff; font-size: 25px;"><i class="fa fa-circle-o-notch  fa-spin"></i> Loading Please wait...</p>
</div>
{$message}
<hr>
<center><h1 style="
            color: #ed5e2f;
            font-weight: 600;
            font-size: 25px;
            ">Server Configuration</h1></center>
<center><h5>You can leave the default options </h5></center>

<button type="button" name="reconfigall" class="btn btn-info reconfigall" style="float:right; position: relative; top: -4px;"><i class="fa fa-refresh" aria-hidden="true"></i> Re-Configure All Servers</button>
<br>
<div class="tab-content admin-tabs" style=" padding: 0px 33px;">
    <form method="post" action="" id="configform">
        <table class="form" width="100%" border="0" cellspacing="5" cellpadding="4" style="
               font-size: 15px;border-collapse: collapse;
               ">
            <tbody><tr style="border-bottom: 1px solid #e2e7e8;">
                    <td class="fieldlabel" style="min-width:400px;">Do you want to enable IPv6 support (NAT)?</td><td class="fieldarea">
                        <p class="pull-right">OPENVPN</p>
                        <label class="radio-inline"><input type="radio" name="ipv6" value="n|No" {if {$serverconf.ipv6.value} eq 'n'}checked{else}{/if}>No (Default)</label><br>
                        <label class="radio-inline"><input type="radio" name="ipv6" value="y|Yes" {if {$serverconf.ipv6.value} eq 'y'}checked{else}{/if}>Yes</label>  
                        
                    </td></tr>
                <tr style="border-bottom: 1px solid #e2e7e8;"><td class="fieldlabel">What port do you want OpenVPN to listen to?</td><td class="fieldarea">
                    <p class="pull-right">OPENVPN</p>
                        <label class="radio-inline"><input type="radio" name="port" value="1|1194"  {if {$serverconf.port.value} eq '1'}checked{else}{/if}>Default: 1194</label><br>
                        <label class="radio-inline"><input type="radio" name="port" value="2|custom" class="showcustompport" {if {$serverconf.port.value} eq '2'}checked{else}{/if}>Custom port [1-65535]
                            <input type="number" class="form-control" name="customport" id="showcustompport"  {if {$serverconf.port.value} eq '2'} style="display:block" max="65535" min="1" value="{$serverconf.customport.value}" {else}style="display: none;"{/if} placeholder="Enter Cutom Port"></label>


                    </td></tr>
                <tr style="border-bottom: 1px solid #e2e7e8;">
                    <td class="fieldlabel">What protocol do you want OpenVPN to use?</td><td class="fieldarea"> 
                        <p class="pull-right">OPENVPN</p>
                        <label class="radio-inline"><input type="radio" name="protocol" value="udp|UDP"  {if {$serverconf.protocol.value} eq 'udp'}checked{else}{/if}>UDP (Default)</label><br>
                        <label class="radio-inline"><input type="radio" name="protocol" value="tcp|TCP" {if {$serverconf.protocol.value} eq 'tcp'}checked{else}{/if}>TCP</label></td></tr>
                <tr style="border-bottom: 1px solid #e2e7e8;">
                    <td class="fieldlabel">What DNS resolvers do you want to use with the VPN?</td><td class="fieldarea"> 
                        <p class="pull-right">OPENVPN - IKEv2/IPSEC</p>
                        <label class="radio-inline"><input type="radio" name="dns" value="1|Current system resolvers (from /etc/resolv.conf)" {if {$serverconf.dns.value} eq '1'}checked{else}{/if}>1) Current system resolvers (from /etc/resolv.conf)</label><br>
                        <label class="radio-inline"><input type="radio" name="dns" value="2|Self-hosted DNS Resolver (Unbound)" {if {$serverconf.dns.value} eq '2'}checked{else}{/if}>2) Self-hosted DNS Resolver (Unbound)</label><br>
                        <label class="radio-inline"><input type="radio" name="dns" value="3|Cloudflare (Anycast: worldwide)" {if {$serverconf.dns.value} eq '3'}checked{else}{/if}>3) Cloudflare (Anycast: worldwide)</label><br>
                        <label class="radio-inline"><input type="radio" name="dns" value="4|Quad9 (Anycast: worldwide)" {if {$serverconf.dns.value} eq '4'}checked{else}{/if}>4) Quad9 (Anycast: worldwide)</label><br>
                        <label class="radio-inline"><input type="radio" name="dns" value="5|Quad9 uncensored (Anycast: worldwide)" {if {$serverconf.dns.value} eq '5'}checked{else}{/if}>5) Quad9 uncensored (Anycast: worldwide)</label><br>
                        <label class="radio-inline"><input type="radio" name="dns" value="6|FDN (France)" {if {$serverconf.dns.value} eq '6'}checked{else}{/if}>6) FDN (France)</label><br>
                        <label class="radio-inline"><input type="radio" name="dns" value="7|DNS.WATCH (Germany)" {if {$serverconf.dns.value} eq '7'}checked{else}{/if}>7) DNS.WATCH (Germany)</label><br>
                        <label class="radio-inline"><input type="radio" name="dns" value="8|OpenDNS (Anycast: worldwide)" {if {$serverconf.dns.value} eq '8'}checked{else}{/if}>8) OpenDNS (Anycast: worldwide)</label><br>
                        <label class="radio-inline"><input type="radio" name="dns" value="9|Google (Anycast: worldwide)" {if {$serverconf.dns.value} eq '9'}checked{else}{/if}>9) Google (Anycast: worldwide)</label><br>
                        <label class="radio-inline"><input type="radio" name="dns" value="10|Yandex Basic (Russia)" {if {$serverconf.dns.value} eq '10'}checked{else}{/if}>10) Yandex Basic (Russia)</label><br>
                        <label class="radio-inline"><input type="radio" name="dns" value="11|AdGuard DNS (Russia)" {if {$serverconf.dns.value} eq '11'}checked{else}{/if}>11) AdGuard DNS (Russia)</label><br>
                        <label class="radio-inline"><input type="radio" name="dns" class="showcustomddns" value="12|Custom" {if {$serverconf.dns.value} eq '12'}checked{else}{/if}>12) Custom</label>
                        <br><label class="text-inline" id="showcustomdns" {if {$serverconf.dns.value} eq '12'} style="display:block" {else} style="display: none;"{/if} ><table><tr><td width="150px">Primary DNS: </td><td><input type="text" class="form-control" name="dns1" class="dns1" size="40"   {if {$serverconf.dns.value} eq '12'} required value="{$serverconf.dns1.value}" {/if}  placeholder="Eg. 208.67.222.222"></td></tr></table></label>
                        <label class="text-inline" id="showcustomdns2" {if {$serverconf.dns.value} eq '12'} style="display:block"{else} style="display: none; "{/if} ><table><tr><td width="150px">Secondary DNS: </td><td><input type="text" class="form-control"  size="40" name="dns2" class="dns2"  {if {$serverconf.dns.value} eq '12'} value="{$serverconf.dns2.value}" {/if} placeholder="Eg. 208.67.220.220 (optional)"></td></tr></table> </label>
                        
                    </td></tr>
                    <tr style="border-bottom: solid 1px #e2e7e9;"><td class="fieldlabel">Disable Log</td><td><label><input type="checkbox"{if $serverconf.logging.value eq 'on'}checked{/if} value="on" name="logging">Tick to disable VPN logging.</label></td></tr>
                    <tr><td colspan="2"><center><h1 style="color: #ed5e2f; font-weight: 600; font-size: 25px;">Client Configuration</h1></center></td></tr>
                    <tr>
                        <td class="fieldlabel">Proxy Settings</td>
                        <td>
                            <p class="pull-right">OPENVPN</p>
                            <table>
                                <tr><td>HTTP Proxy? </td><td><label><input type="checkbox" name="enableProxy" {if $serverconf.enableProxy.value eq 'on'}checked{/if} value="on">Tick to enable HTTP Proxy.</label></td></tr>
                                <tr><td>Proxy Server Address / Hostname</td><td><input type="text" value="{$serverconf.proxyserver.value}" placeholder="eg. example.com" name="proxyserver" class="form-control"></td></tr>
                                <tr><td>Port</td><td><input type="text" name="proxyport" value="{$serverconf.proxyport.value}" class="form-control"></td></tr>
                                <tr><td>Proxy Retry</td><td><label><input type="checkbox"{if $serverconf.proxyretry.value eq 'on'}checked{/if} value="on" name="proxyretry">Tick to use http-proxy-retry.</label></td></tr>
                                <tr><td>Custom Headers</td><td>
                                    <label><input type="checkbox"{if $serverconf.customheaderenb1.value eq 'on'}checked{/if} value="on" name="customheaderenb1">Tick to use.</label><input type="text" name="customheader1" value="{$serverconf.customheader1.value}" placeholder="CUSTOM-HEADER Host eample.com"><br/>
                                    <label><input type="checkbox"{if $serverconf.customheaderenb2.value eq 'on'}checked{/if} value="on" name="customheaderenb2">Tick to use.</label><input type="text" name="customheader2" value="{$serverconf.customheader2.value}" placeholder="CUSTOM-HEADER Host eample.com"></td></tr>
                            </table>
                        </td>
                    </tr>

                <tr style="border-bottom: 1px solid #e2e7e8;">
                    <td class="fieldlabel" colspan="2"><div class="btn-container">
                        <input id="resetSettings" type="button" value="Reset Settings" class="btn btn-primary">
                            <input id="saveChanges" type="button" value="Save Changes" class="btn btn-primary">
                            <a href="{$modulelink}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Go Back</a>
                        </div> </td> 
                </tr>
            </tbody></table>
<div class="modal fade" id="ConfirmModal" tabindex="-1" role="dialog" aria-labelledby="Confirm" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="text-center">Server Configuration</h2>
            </div>
            <table class="form" width="100%" border="0" cellspacing="5" cellpadding="4" style="
               font-size: 15px;border-collapse: collapse;
               ">
            <tbody><tr style="border-bottom: 1px solid #e2e7e8;">
                    <td class="fieldlabel" style="min-width:300px;">IPv6 support (NAT)</td>
                    <td class="fieldarea ipv6val">
                         
                    </td></tr>
                <tr style="border-bottom: 1px solid #e2e7e8;"><td class="fieldlabel">OpenVPN to listen to Port?</td>
                    <td class="fieldarea portval">
                        
                    </td></tr>
                <tr style="border-bottom: 1px solid #e2e7e8;">
                    <td class="fieldlabel">OpenVPN to use Protocol</td>
                    <td class="fieldarea protocolval"> 
                        </td></tr>
                <tr style="border-bottom: 1px solid #e2e7e8;">
                    <td class="fieldlabel">DNS resolvers to use with OpenVPN</td>
                    <td class="fieldarea dnsval"> 
                       
                    </td></tr>
            </tbody></table>
            <div class="col-md-12"><p class="alert alert-info">If you make changes with Server configuration, then must need to Re-configure your all servers 
Confrim to Re-configure all Servers</p></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary"  name="saveconfig"  id="saveconfig">Confirm <i class="fa fa-spin fa-spinner loading" style="display: none;"></i></button>
            </div>
        </div>   
        </div>
        </div> 
    </form>

    <div class="row">
        <!--a href="{$modulelink}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Go Back</a-->
    </div>     

</div>



{literal} 
    <style>
        .reconfigall:hover{
            background-color: #3c3938;
            border-color: #3c3938;
        } 
        .reconfigall{
            background-color: #ef7030;
            border-color: #ef7030;
            margin-right: 35px;

        } 
        .modal-dialog
        {
            width: 50% !important;
        }
        @media screen and (max-width:950px)
        {
            .modal-dialog
            {
                width: 95% !important;
            }
        }

        .modal .fieldarea
        {
            font-weight: bold;
        }
    </style>
    <script>

        $('document').ready(function ()
        {
            {/literal}
                var ipv6val = '{$serverconf.ipv6.text}';
                var portval = '{$serverconf.port.text}';
                var customportval = '{$serverconf.port.value}';
                var protocolval = '{$serverconf.protocol.text}';
                var dnsval = '{$serverconf.dns.text}';
                var dnsval1 = '{$serverconf.dns1.value}';
                var dnsval2 = '{$serverconf.dns2.value}';
{literal}
                $('input[name="ipv6"]').click(function(){
                    var res = $(this).val().split('|');
                    ipv6val = res[1];
                });

                $('input[name="port"]').click(function(){
                    var res = $(this).val().split('|');
                    portval = res[1];
                });

                $('input[name="protocol"]').click(function(){
                    var res = $(this).val().split('|');
                    protocolval = res[1];
                });

                $('input[name="dns"]').click(function(){
                    var res = $(this).val().split('|');
                    if(res[0] == '12')
                        {dnsval = '';}
                    else
                    {
                        dnsval = res[1];
                    }
                    
                });

                $('#resetSettings').click(function(){
                    swal({
                    title: "Are you sure?",
                    text: "It will reset all settings to default.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, Reset it!",
                    closeOnConfirm: false
                },
                        function () {
                        $.ajax({
                        type: "POST",
                        data: {resetserverconfig: true},
                        dataType: "html",
                        success: function (resultData) {
                            if (resultData == 'success')
                            {
                                swal('Success!', 'Server Config is now back to default', 'success');
                                window.location.reload()
                            }
                            }
                        })

                        });
                    
                    })
                

            $('#saveChanges, .reconfigall').click(function(e){
                e.preventDefault();

                customportval = $('#showcustompport').val();
                dnsval1 = $(document).find('input[name="dns1"]').val();
                dnsval2 = $(document).find('input[name="dns2"]').val();

                $('.ipv6val').text(ipv6val);
                $('.portval').html(portval+' '+customportval);
                $('.protocolval').text(protocolval);
                $('.dnsval').html(dnsval+'<br />'+dnsval1+'<br />'+dnsval2);
                $('#ConfirmModal').modal('show');
            })

            $('#configform').submit(function(){
                $('.fullpageloader').show();
            })


            $('.reconfigall').click(function () {/*
                $.ajax({
                    type: "POST",
                    crossDomain: true,
                    data: {reconfigall: true},
                    dataType: "text",
                    success: function (resultData) {
                        if (resultData == 'success')
                        {
                            swal('Success!', 'Re Configuration for all servers started. You can check module logs', 'success');
                        }
                    }
                })*/

            })

            $('input[name="dns"]').each(function () {
                if ($(this).is(':checked'))
                {
                    if ($(this).val() == 12)
                    {
                        $('#showcustomdns').attr('required', 'required');
                    } else
                    {
                        $('#showcustomdns').removeAttr('required');
                    }
                }
            })



            $('input[type="radio"]').click(function () {
                if ($('.showcustompport').is(':checked'))
                {
                    $('#showcustompport').show();
                } else
                {
                    $('#showcustompport').hide();
                }

                if ($('.showcustomddns').is(':checked'))
                {
                    $('#showcustomdns, #showcustomdns2').show();
                    $('#showcustomdns').attr('required', 'required');
                } else
                {
                    $('#showcustomdns, #showcustomdns2').hide();
                    $('#showcustomdns').removeAttr('required');
                }

                if ($('.showcustompass').is(':checked'))
                {
                    $('#showcustompass').show();
                } else
                {
                    $('#showcustompass').hide();
                }
            })

        });
    </script>
{/literal}