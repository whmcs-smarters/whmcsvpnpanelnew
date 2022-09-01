<form method="post" style="max-width: 450px; width: 100%; margin:auto;">
<h2 class="text-center">Cloudflare API Details</h2>
<table class="table table-bordered table-striped">
<tr>
<th>API Key</th>
<td><input type="password" class="form-control" value="{$cfapidetails['cfapi'] }" name="apikey"></td>
</tr>
<tr>
<th>Registered Email</th>
<td><input type="email" class="form-control" value="{$cfapidetails['cfemail']}" name="email"></td>
</tr>
<tr>
<th>API Secret Token</th>
<td><input type="password" class="form-control" value="{$cfapidetails['cfsecret']}" name="serviceKey"></td>
</tr>
<tr>
<th>
Account
</th>
<td>
<select name="cfaccount" class="form-control">
<option value="">
Select Account
</option>
{foreach $cfaccounts as $acc}
<option {if $cfaccount eq  $acc->id}selected{/if} value="{$acc->id}">{$acc->name}</option>
{/foreach}
</select>
</td>
</tr>
<tr>
<th>
Domains
</th>
<td>
    
<select name="cfdomain" class="form-control">
<option value="">
Select Domain
</option>
{foreach $cfdomains as $domain}
<option {if $cfdomain eq  $domain->id}selected{/if} value="{$domain->id}">{$domain->name}</option>
{/foreach}
</select>
</td>
</tr>
<tr>
    <th>Enable/Disable</th>
    <td><input type="checkbox" name="cfenabled" {if $cfenabled eq 'on'}checked{/if}> (Tick to enable CloudFlare API - Recommended)</td>
</tr>
<tr>
<td colspan="2">
<center>
<button type="submit" name="addcfapi" class="btn btn-success pull-right">Save</button>
<button class="btn btn-primary pull-left" type="submit" name="testcon">Test Connection</button>
{if isset($message) }
<div class="alert alert-{if $status }success{else}danger{/if} mt-2 pull-left" style="margin-top: 10px; width: 100%">{$message}</div>
{/if}
</center>
</td>
</tr>
</table>
</form>