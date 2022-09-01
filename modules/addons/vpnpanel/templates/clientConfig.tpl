<div class="fullpageloader" style="position: fixed; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 99999; top: 0px; left: 0px; display: none;">
    <p style="position: absolute; left: 40%; top: 30%; color: #fff; font-size: 25px;"><i class="fa fa-circle-o-notch  fa-spin"></i> Loading Please wait...</p>
</div>
{$message}
<hr>
<h1>Client Configuration</h1>
<div class="row">
	
	{if $editfile eq 'true'}
	<div class="col-md-12">
		<h2>Edit OVPN File ({$serverIP})</h2>
		<textarea class="form-control" rows="30">{$filedata}</textarea>
	</div>
	{else}
	<div class="col-md-12" style="background: rgb(250, 250, 250);">
		<h2>Server List</h2>
		<table class="table">
		{foreach from=$servers item=server}
		{if $server.category eq 'openvpn' || $server.category eq 'openvpn-ikev2'}
		<tr><td><img src="{$server.flag}" width="30px"> {$server.name} ({$server.ip})</td>
			<td>
			<form method="post"><input type="hidden" name="serverid" value="{$server.id}"><button type="submit" class="btn btn-success" name="editfile">Edit OVPN</button></form>
			</td>
		</tr>
		{/if}
		{/foreach}
	</table>
	</div>
	{/if}
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
            $('#saveChanges, .reconfigall').click(function(e){
                e.preventDefault();

                customportval = $('#showcustompport').val();
                dnsval1 = $(document).find('input[name="dns1"]').val();
                dnsval2 = $(document).find('input[name="dns2"]').val();

                $('.ipv6val').text(ipv6val);
                $('.portval').html(portval);
                $('.protocolval').text(protocolval);
                $('.dnsval').html(dnsval+'<br />'+dnsval1+'<br />'+dnsval2);
                $('#ConfirmModal').modal('show');
            })

            $('#saveconfig').click(function(){
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