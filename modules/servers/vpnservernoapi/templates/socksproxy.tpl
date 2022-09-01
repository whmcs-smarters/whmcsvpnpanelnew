<div class="row">
<div class="col-md-12">
<script>
     function copyToClipboard(text) {
    var sampleTextarea = document.createElement("textarea");
    document.body.appendChild(sampleTextarea);
    sampleTextarea.value = text; //save main text in it
    sampleTextarea.select(); //select textarea contenrs
    document.execCommand("copy");
    document.body.removeChild(sampleTextarea);
}

function myFunction(textdata, copyshow){
    copyToClipboard(textdata);
    $('.'+copyshow+'').css('opacity', '1');
    $('.'+copyshow+'').css('margin-top', '-30px');
    setTimeout(function(){
        $('.'+copyshow+'').css('opacity', '0');
        $('.'+copyshow+'').css('margin-top', '-20px');
    }, 1000);
    
}
$(document).ready(function(){
   
})
</script>
<style>
    .copied
    {
        position: absolute;
        font-size: 10px;
        background: rgba(0, 0, 0, 0.7);
        border-radius: 4px;
        padding: 1px 6px;
        color: #fff;
        margin-top: -20px;
        -webkit-transition: 0.3s;
        transition: 0.3s;
        opacity: 0;
    }
    </style>
    
<h3 class="text-center">Socks5 Proxy Servers</h3>
<div class="row">
<div class="col-md-12">
<div class="table-responsive">
<table class="table table-striped table-bordered">
<tbody>
<tr>
<th>Username</th>
<td>{$vpnusername} <button class="btn btn-default btn-sm" onclick="myFunction('{$vpnusername}', 'copyusername')"><i class="fa fa-copy" style="cursor: pointer" ></i><p class="copied copyusername">Copied</p></button></td>
</tr>
<tr>
<th>Password</th>
<td>{$vpnpassword} <button class="btn btn-default btn-sm" onclick="myFunction('{$vpnpassword}', 'copypassword')"><i class="fa fa-copy" style="cursor: pointer" ></i><p class="copied copypassword">Copied</p></button></td>
</tr>
</tbody>
</table>
</div>
</div>
<table class="table table-striped">
<tr><th>Server Name</th><th>URL</th> </tr>
{foreach from=$allservers item=server}                
<tr><td><img src="{$server.flag}" width="30px; margin-right: 10px;"> {$server.name}</td>
<td>{$server.server_ipv4} <button class="btn btn-default btn-sm" onclick="myFunction('{$server.server_ipv4}', 'server{$server.server_id}')"><i class="fa fa-copy" style="cursor: pointer" ></i><p class="copied server{$server.server_id}">Copied</p></button>
</td>                
{/foreach}
</table>
</div>
</div>
</div>