<div class="row">
<div class="col-md-12">
<script>
$(document).ready(function(){
{if $downloadovpn eq 1}
window.open('{$systemURL}client.ovpn');
{/if}
{if $downloadcert eq 1}
window.open('{$systemURL}ca-cert.pem');
{/if}
})
</script>

<h3 class="text-center">Download Cert. Files</h3>
<table class="table table-striped">
<tr><th>Server Name</th><th>Action</th></tr>
{foreach from=$allservers item=server}                
<tr><td><img src="{$server.flag}" width="30px; margin-right: 10px;"> {$server.name}</td>
<td> <form method="post" action="{$systemurl}includes/downloadcert.php" style="float: left; width: 100%; margin-bottom: 5px; padding-bottom: 5px; border-bottom: solid 1px #efefef;">

{foreach from=$server.file item=file}
{if $file eq "ovpn"}
<button name="d" type="submit" value="{$file}" class="btn btn-sm btn-success dropdown-item" style="margin-bottom: 5px; text-align: center;"><i class="fa fa-download"></i> Download {$file}</button>
{/if}
{/foreach} 
<input type="hidden" name="s" value="{$server.ip}" />
</form>
</td>                
{/foreach}
</table>
</div>
</div>