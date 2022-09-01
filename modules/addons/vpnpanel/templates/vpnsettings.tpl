<div class="fullpageloader" style="position: fixed; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 99999; top: 0px; left: 0px; display: none;">
    <p style="position: absolute; left: 40%; top: 30%; color: #fff; font-size: 25px;"><i class="fa fa-circle-o-notch  fa-spin"></i> Loading Please wait...</p>
</div><h2>VPN Settings</h2>
<h5></h5>
<p class="alert alert-info"><strong>Note</strong> : These Setting will be used for VPN products.</p>
<div class="message"></div>

<form method="post" action="">
  <div class="col-md-12">
    <table class="table table-bordered table-striped">
      <tbody><tr><th>Show Download Cert. Button</th><td><input type="checkbox" name="downloadcert" {if $data.downloadcert eq 'on' }checked{/if} value="on"><p>(Tick to show download cert. button in client area.)</p></td></tr>
      <tr><th>Show VPN Login Details</th><td><input type="checkbox" name="vpndetails" {if $data.vpndetails eq 'on' }checked{/if} value="on"><p>Tick to show VPN login details in client area. (FOR WINDOWS/LINUX/iOS)</p></td></tr>
      <tr><th>Password Type</th><td><label><input type="radio" {if $data.passwordtype eq 'random' }checked{/if} class="Randpasstype" name="passwordtype" value="random"> Random Password</label>
        <label><input type="radio" class="Staticpasstype" {if $data.passwordtype eq 'static' }checked{/if} name="passwordtype" value="static"> Static/Fixed Password</label>
        <input type="text" name="staticPass" {if $data.staticPass neq '' } value="{$data.staticPass}" {else}style="display: none;"{/if}  class="form-control staticPass" placeholder="Enter static password">
        <p>(Select Password Type you want to use for your clients)</p></td></tr>
      
      <tr><th>Manage Fields</th><td><p class="text-center">Select Fields you want to show in reseller panel while add user.</p>
        <table class="table">
          <tr><th>Field</th><th>Action</th></tr>
          <tr><td>Full Name</td><td><input type="checkbox" {if $data.showName eq 'on' } checked {/if} name="showName" value="on"></td></tr>
          <tr><td>Phone</td><td><input type="checkbox" {if $data.showPhone eq 'on' }  checked {/if} name="showPhone" value="on"></td></tr>
          <tr><td>Company</td><td><input type="checkbox" {if $data.showCompany eq 'on' } checked {/if} name="showCompany" value="on"></td></tr>
          <tr><td>Address</td><td><input type="checkbox" {if $data.showAddress eq 'on' } checked {/if} name="showAddress" value="on"></td></tr>
        </table>
      </td></tr>
      <tr><td colspan="2"><button class="btn btn-success pull-right" name="saveSetting">Save Changes</button></td></tr>
    </tbody>
      
    </table>
  </div>
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

$('document').ready(function()
{
  $('.Staticpasstype').click(function(){
    $('.staticPass').show();
  })
  $('.Randpasstype').click(function(){
    $('.staticPass').hide();
  })
});
</script>
{/literal}