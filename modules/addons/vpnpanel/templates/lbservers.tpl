<div class="fullpageloader" style="position: fixed; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 99999; top: 0px; left: 0px; display: none;">
    <p style="position: absolute; left: 40%; top: 30%; color: #fff; font-size: 25px;"><i class="fa fa-circle-o-notch  fa-spin"></i> Loading Please wait...</p>
</div>
<div class="row">
    <div class="col-md-12"><nav aria-label="breadcrumb">
  <ol class="breadcrumb">
      {$breadcrumb}
  </ol>
</nav></div>
    <div class="col-md-12"><h2 class="pull-left">LB Servers List</h2>
    <!--button class="btn btn-info pull-right" id="addserverbtn" style="margin-bottom: 10px;"><i class="fa fa-plus"></i> Upload LB VPN Server</button-->
    <button class="btn btn-info pull-right" id="createserverbtn" style="margin-bottom: 10px; margin-right: 10px;"><i class="fa fa-plus"></i> Add LB VPN Server</button></div>
    </div>
<h5>Here you can create your Load Balancer VPN Server using “Add LB VPN Server” button.</h5>
<p class="alert alert-info"><strong>Note</strong> : Only servers with "online" status will be displayed in the application </p>

<!--button class="btn btn-warning pull-right" id="reloadserverbtn"><i class="fa fa-refresh"></i> Reload Server List</button-->
<div class="message" style="float: left; width: 100%;">{$message}</div>
<h2 class="text-center">{$mainServerName}</h2>
<table class="table table-bordered table-striped" style="margin-top: 10px;">
<thead><tr><th>Server Name</th> <th>Server IP/Hostname</th><th>Category</th><th>SSH Port</th><th>Status</th><th>Created At</th><th>Action</th></tr></thead>
<tbody id="serverslist">
{$serverhtml}
</tbody>
</table>
<div class="modal fade" id="editServerModal" tabindex="-1" role="dialog" aria-labelledby="Edit Server" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header alert-info">
        <h5 class="modal-title" id="exampleModalLabel">Edit Server</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="server_frm" name="server_frm" novalidate="novalidate" class="fv-form fv-form-bootstrap">
      <div class="modal-body">
       <button type="submit" class="fv-hidden-submit" style="display: none; width: 0px; height: 0px;"></button>
										<input type="hidden" class="serveridedit" value="">
										<div class="row">
											<div class="form-group control-group col-md-12">
												<div class="controls input-group">
													<label class="control-label input-group-addon" for="server_name">Server Name</label>
													<input class="form-control" id="server_name" name="server_name" placeholder="Eg. New York" data-fv-field="server_name">
												</div>
											<small style="display: none;" class="help-block" data-fv-validator="notEmpty" data-fv-for="server_name" data-fv-result="NOT_VALIDATED"></small><small style="display: none;" class="help-block" data-fv-validator="stringLength" data-fv-for="server_name" data-fv-result="NOT_VALIDATED"></small></div>
											<div class="form-group control-group col-md-12">
												<div class="controls input-group">
													<label class="control-label input-group-addon" for="server_ip">Hostname / Server IP</label>
													<input class="form-control" id="server_ip" readonly="readobnly" name="server_ip" placeholder="Eg. 10.0.0.08" data-fv-field="server_ip">
												</div>
											<small style="display: none;" class="help-block" data-fv-validator="notEmpty" data-fv-for="server_ip" data-fv-result="NOT_VALIDATED"></small></div>
											<div class="form-group control-group col-md-12">
												<div class="controls input-group">
													<label class="control-label input-group-addon" for="sshport">SSH Port</label>
													<input class="form-control" id="sshport" name="sshport" value="22" data-fv-field="sshport">
												</div>
											<small style="display: none;" class="help-block" data-fv-validator="notEmpty" data-fv-for="sshport" data-fv-result="NOT_VALIDATED"></small></div>
										
											</div>
										
										<div class="row">	
										<div class="form-group control-group col-md-12">
			                            <div class="controls input-group">
			                                <label class="control-label input-group-addon" for="maxconn">Max Connections</label>
			                                <input class="form-control" id="maxconn" name="maxconn" data-required="yes" value="0" placeholder="" data-fv-field="maxconn">
			                            </div>
			                            <span style="font-size: 12px; color: #8a8a8a;">Set max. connections limit ( by default 0 for unlimited )</span>
			                            <small style="display: none;" class="help-block" data-fv-validator="notEmpty" data-fv-for="maxconn" data-fv-result="NOT_VALIDATED"></small></div>										
											<div class="form-group control-group col-md-12">
												<div class="controls input-group">
													<label class="control-label input-group-addon" for="sshpass">SSH Pass</label>
													<input class="form-control" id="sshpassp" name="sshpass" placeholder="Server SSH Password" data-fv-field="sshpass">
												</div>
											<small style="display: none;" class="help-block" data-fv-validator="notEmpty" data-fv-for="sshpass" data-fv-result="NOT_VALIDATED"></small></div>
											<div class="form-group control-group col-md-12">
												<div class="controls input-group">
													<label class="control-label input-group-addon" for="server_category">VPN Type</label>
													<select class="form-control" id="server_category" name="server_category" data-fv-field="server_category">
														<option value="openvpn-ikev2" selected="selected">OpenVPN + Ikev2/IPSEC - Recommended</option>
                                    					
														
													</select>
												</div>
											<small style="display: none;" class="help-block" data-fv-validator="notEmpty" data-fv-for="server_category" data-fv-result="NOT_VALIDATED"></small></div>
											<div class="form-group control-group col-md-12">
												<div class="controls input-group">
													<label class="control-label input-group-addon" for="flag1">Country Flag</label>
													<select name="flag" id="flag1" style="text-transform:uppercase;" class="form-control"><option style="text-transform:uppercase;" selected="selected" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/no_flag.png">No Flag</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/abkhazia.png">abkhazia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/afghanistan.png">afghanistan</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/aland-islands.png">aland-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/albania.png">albania</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/algeria.png">algeria</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/american-samoa.png">american-samoa</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/andorra.png">andorra</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/angola.png">angola</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/anguilla.png">anguilla</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/antigua-and-barbuda.png">antigua-and-barbuda</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/argentina.png">argentina</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/armenia.png">armenia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/aruba.png">aruba</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/australia.png">australia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/austria.png">austria</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/azerbaijan.png">azerbaijan</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/azores-islands.png">azores-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/bahamas.png">bahamas</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/bahrain.png">bahrain</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/balearic-islands.png">balearic-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/bangladesh.png">bangladesh</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/barbados.png">barbados</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/basque-country.png">basque-country</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/belarus.png">belarus</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/belgium.png">belgium</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/belize.png">belize</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/benin.png">benin</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/bermuda.png">bermuda</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/bhutan.png">bhutan</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/bhutan-1.png">bhutan-1</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/bolivia.png">bolivia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/bonaire.png">bonaire</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/bosnia-and-herzegovina.png">bosnia-and-herzegovina</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/botswana.png">botswana</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/brazil.png">brazil</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/british-columbia.png">british-columbia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/british-indian-ocean-territory.png">british-indian-ocean-territory</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/british-virgin-islands.png">british-virgin-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/brunei.png">brunei</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/bulgaria.png">bulgaria</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/burkina-faso.png">burkina-faso</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/burundi.png">burundi</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/cambodia.png">cambodia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/cameroon.png">cameroon</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/canada.png">canada</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/canary-islands.png">canary-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/cape-verde.png">cape-verde</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/cayman-islands.png">cayman-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/central-african-republic.png">central-african-republic</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/ceuta.png">ceuta</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/chad.png">chad</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/chile.png">chile</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/china.png">china</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/christmas-island.png">christmas-island</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/cocos-island.png">cocos-island</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/colombia.png">colombia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/comoros.png">comoros</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/cook-islands.png">cook-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/corsica.png">corsica</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/costa-rica.png">costa-rica</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/croatia.png">croatia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/cuba.png">cuba</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/curacao.png">curacao</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/cyprus.png">cyprus</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/czech-republic.png">czech-republic</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/democratic-republic-of-congo.png">democratic-republic-of-congo</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/denmark.png">denmark</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/djibouti.png">djibouti</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/dominica.png">dominica</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/dominican-republic.png">dominican-republic</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/east-timor.png">east-timor</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/ecuador.png">ecuador</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/egypt.png">egypt</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/england.png">england</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/equatorial-guinea.png">equatorial-guinea</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/eritrea.png">eritrea</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/estonia.png">estonia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/ethiopia.png">ethiopia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/european-union.png">european-union</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/falkland-islands.png">falkland-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/faroe-islands.png">faroe-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/fiji.png">fiji</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/finland.png">finland</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/france.png">france</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/french-polynesia.png">french-polynesia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/gabon.png">gabon</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/galapagos-islands.png">galapagos-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/gambia.png">gambia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/georgia.png">georgia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/germany.png">germany</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/ghana.png">ghana</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/gibraltar.png">gibraltar</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/greece.png">greece</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/greenland.png">greenland</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/grenada.png">grenada</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/guam.png">guam</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/guatemala.png">guatemala</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/guernsey.png">guernsey</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/guinea.png">guinea</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/guinea-bissau.png">guinea-bissau</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/guyana.png">guyana</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/haiti.png">haiti</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/hawaii.png">hawaii</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/honduras.png">honduras</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/hong-kong.png">hong-kong</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/hungary.png">hungary</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/iceland.png">iceland</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/india.png" >india</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/indonesia.png">indonesia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/iran.png">iran</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/iraq.png">iraq</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/ireland.png">ireland</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/isle-of-man.png">isle-of-man</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/israel.png">israel</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/italy.png">italy</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/ivory-coast.png">ivory-coast</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/jamaica.png">jamaica</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/japan.png">japan</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/jersey.png">jersey</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/jordan.png">jordan</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/kazakhstan.png">kazakhstan</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/kenya.png">kenya</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/kiribati.png">kiribati</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/kosovo.png">kosovo</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/kuwait.png">kuwait</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/kyrgyzstan.png">kyrgyzstan</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/laos.png">laos</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/latvia.png">latvia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/lebanon.png">lebanon</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/lesotho.png">lesotho</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/liberia.png">liberia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/libya.png">libya</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/liechtenstein.png">liechtenstein</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/lithuania.png">lithuania</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/luxembourg.png">luxembourg</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/macao.png">macao</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/madagascar.png">madagascar</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/madeira.png">madeira</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/malawi.png">malawi</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/malaysia.png">malaysia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/maldives.png">maldives</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/mali.png">mali</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/malta.png">malta</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/marshall-island.png">marshall-island</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/martinique.png">martinique</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/mauritania.png">mauritania</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/mauritius.png">mauritius</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/melilla.png">melilla</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/mexico.png">mexico</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/micronesia.png">micronesia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/moldova.png">moldova</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/monaco.png">monaco</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/mongolia.png">mongolia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/montenegro.png">montenegro</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/montserrat.png">montserrat</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/morocco.png">morocco</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/mozambique.png">mozambique</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/myanmar.png">myanmar</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/namibia.png">namibia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/nato.png">nato</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/nauru.png">nauru</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/nepal.png">nepal</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/netherlands.png">netherlands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/new-zealand.png">new-zealand</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/nicaragua.png">nicaragua</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/niger.png">niger</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/nigeria.png">nigeria</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/niue.png">niue</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/norfolk-island.png">norfolk-island</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/northen-cyprus.png">northen-cyprus</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/northern-marianas-islands.png">northern-marianas-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/north-korea.png">north-korea</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/norway.png">norway</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/oman.png">oman</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/orkney-islands.png">orkney-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/ossetia.png">ossetia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/pakistan.png">pakistan</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/palau.png">palau</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/palestine.png">palestine</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/panama.png">panama</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/papua-new-guinea.png">papua-new-guinea</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/paraguay.png">paraguay</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/peru.png">peru</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/philippines.png">philippines</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/pitcairn-islands.png">pitcairn-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/portugal.png">portugal</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/puerto-rico.png">puerto-rico</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/qatar.png">qatar</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/rapa-nui.png">rapa-nui</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/republic-of-macedonia.png">republic-of-macedonia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/republic-of-poland.png">republic-of-poland</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/republic-of-the-congo.png">republic-of-the-congo</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/romania.png">romania</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/russia.png">russia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/rwanda.png">rwanda</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/saba-island.png">saba-island</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/saint-kitts-and-nevis.png">saint-kitts-and-nevis</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/salvador.png">salvador</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/samoa.png">samoa</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/san-marino.png">san-marino</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/sao-tome-and-principe.png">sao-tome-and-principe</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/sardinia.png">sardinia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/saudi-arabia.png">saudi-arabia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/scotland.png">scotland</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/senegal.png">senegal</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/serbia.png">serbia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/seychelles.png">seychelles</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/sierra-leone.png">sierra-leone</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/singapore.png">singapore</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/sint-eustatius.png">sint-eustatius</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/sint-maarten.png">sint-maarten</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/slovakia.png">slovakia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/slovenia.png">slovenia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/solomon-islands.png">solomon-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/somalia.png">somalia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/somaliland.png">somaliland</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/south-africa.png">south-africa</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/south-korea.png">south-korea</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/south-sudan.png">south-sudan</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/spain.png">spain</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/sri-lanka.png">sri-lanka</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/st-barts.png">st-barts</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/st-lucia.png">st-lucia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/st-vincent-and-the-grenadines.png">st-vincent-and-the-grenadines</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/sudan.png">sudan</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/suriname.png">suriname</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/swaziland.png">swaziland</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/sweden.png">sweden</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/switzerland.png">switzerland</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/syria.png">syria</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/taiwan.png">taiwan</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/tajikistan.png">tajikistan</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/tanzania.png">tanzania</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/thailand.png">thailand</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/Thumbs.db">Thumbs</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/tibet.png">tibet</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/togo.png">togo</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/tokelau.png">tokelau</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/tonga.png">tonga</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/transnistria.png">transnistria</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/trinidad-and-tobago.png">trinidad-and-tobago</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/tunisia.png">tunisia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/turkey.png">turkey</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/turkmenistan.png">turkmenistan</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/turks-and-caicos.png">turks-and-caicos</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/tuvalu.png">tuvalu</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/uganda.png">uganda</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/ukraine.png">ukraine</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/united-arab-emirates.png">united-arab-emirates</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/united-kingdom.png">united-kingdom</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/united-nations.png">united-nations</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/united-states-of-america.png">united-states-of-america</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/uruguay.png">uruguay</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/uzbekistn.png">uzbekistn</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/vanuatu.png">vanuatu</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/vatican-city.png">vatican-city</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/venezuela.png">venezuela</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/vietnam.png">vietnam</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/virgin-islands.png">virgin-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/wales.png">wales</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/western-sahara.png">western-sahara</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/yemen.png">yemen</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/zambia.png">zambia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/zimbabwe.png">zimbabwe</option></select>
												</div>
											</div>
										</div>
										
								
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="updatebtn">Save changes <i class="fa fa-spin fa-spinner loading" style="display: none;"></i></button>
      </div>
      	</form>
    </div>
  </div>
</div>

<!--Add New Server Modal Form start-->


<div class="modal fade" id="addServerModal" tabindex="-1" role="dialog" aria-labelledby="Add New Server" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header alert-info">
        <h5 class="modal-title" id="exampleModalLabel">Add New Server</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="server_frm1" name="server_frm" novalidate="novalidate" class="fv-form fv-form-bootstrap">
      <div class="modal-body">
       <button type="submit" class="fv-hidden-submit" style="display: none; width: 0px; height: 0px;"></button>
										
										<div class="row">
											<div class="form-group control-group col-md-12">
												<div class="controls input-group">
													<label class="control-label input-group-addon" for="server_name">Server Name</label>
													<input class="form-control" id="server_name1" name="server_name" placeholder="Eg. New York" data-fv-field="server_name">
												</div>
											<small style="display: none;" class="help-block" data-fv-validator="notEmpty" data-fv-for="server_name" data-fv-result="NOT_VALIDATED"></small><small style="display: none;" class="help-block" data-fv-validator="stringLength" data-fv-for="server_name" data-fv-result="NOT_VALIDATED"></small></div>
											<div class="form-group control-group col-md-12">
												<div class="controls input-group">
													<label class="control-label input-group-addon" for="server_ip">Hostname / Server IP</label>
													<input class="form-control" id="server_ip1" name="server_ip" placeholder="Eg. 10.0.0.08" data-fv-field="server_ip">
												</div>
											<small style="display: none;" class="help-block" data-fv-validator="notEmpty" data-fv-for="server_ip" data-fv-result="NOT_VALIDATED"></small></div>
										
											</div>
										
										<div class="row">											
											<div class="form-group control-group col-md-12">
												<div class="controls input-group">
													<label class="control-label input-group-addon" for="server_folder">Status Check Folder</label>
													<input class="form-control" id="server_folder1" value="status" name="server_folder" placeholder="Eg. statusfolder">
												</div>
											</div>
											<div class="form-group control-group col-md-12">
												<div class="controls input-group">
													<label class="control-label input-group-addon" for="server_tcp">Status Check File</label>
													<input class="form-control" id="server_tcp1" name="server_tcp" value="tcp" placeholder="Eg. tcp" data-fv-field="server_tcp">
												</div>
											<small style="display: none;" class="help-block" data-fv-validator="notEmpty" data-fv-for="server_tcp" data-fv-result="NOT_VALIDATED"></small></div>
											<div class="form-group control-group col-md-12">
												<div class="controls input-group">
													<label class="control-label input-group-addon" for="server_category1">VPN Type</label>
													<select class="form-control" id="server_category1" name="server_category" data-fv-field="server_category">
														<option value="openvpn-ikev2" selected="selected">OpenVPN + Ikev2/IPSEC - Recommended</option>
														
													</select>
												</div>
											<small style="display: none;" class="help-block" data-fv-validator="notEmpty" data-fv-for="server_category" data-fv-result="NOT_VALIDATED"></small></div>
											<div class="form-group control-group col-md-12">
												<div class="controls input-group">
													<label class="control-label input-group-addon" for="flag">Country Flag</label>
													<select name="flag" id="flag" style="text-transform:uppercase;" class="form-control"><option style="text-transform:uppercase;" selected="selected" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/no_flag.png">No Flag</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/abkhazia.png">abkhazia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/afghanistan.png">afghanistan</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/aland-islands.png">aland-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/albania.png">albania</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/algeria.png">algeria</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/american-samoa.png">american-samoa</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/andorra.png">andorra</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/angola.png">angola</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/anguilla.png">anguilla</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/antigua-and-barbuda.png">antigua-and-barbuda</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/argentina.png">argentina</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/armenia.png">armenia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/aruba.png">aruba</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/australia.png">australia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/austria.png">austria</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/azerbaijan.png">azerbaijan</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/azores-islands.png">azores-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/bahamas.png">bahamas</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/bahrain.png">bahrain</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/balearic-islands.png">balearic-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/bangladesh.png">bangladesh</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/barbados.png">barbados</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/basque-country.png">basque-country</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/belarus.png">belarus</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/belgium.png">belgium</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/belize.png">belize</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/benin.png">benin</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/bermuda.png">bermuda</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/bhutan.png">bhutan</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/bhutan-1.png">bhutan-1</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/bolivia.png">bolivia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/bonaire.png">bonaire</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/bosnia-and-herzegovina.png">bosnia-and-herzegovina</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/botswana.png">botswana</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/brazil.png">brazil</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/british-columbia.png">british-columbia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/british-indian-ocean-territory.png">british-indian-ocean-territory</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/british-virgin-islands.png">british-virgin-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/brunei.png">brunei</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/bulgaria.png">bulgaria</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/burkina-faso.png">burkina-faso</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/burundi.png">burundi</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/cambodia.png">cambodia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/cameroon.png">cameroon</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/canada.png">canada</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/canary-islands.png">canary-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/cape-verde.png">cape-verde</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/cayman-islands.png">cayman-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/central-african-republic.png">central-african-republic</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/ceuta.png">ceuta</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/chad.png">chad</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/chile.png">chile</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/china.png">china</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/christmas-island.png">christmas-island</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/cocos-island.png">cocos-island</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/colombia.png">colombia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/comoros.png">comoros</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/cook-islands.png">cook-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/corsica.png">corsica</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/costa-rica.png">costa-rica</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/croatia.png">croatia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/cuba.png">cuba</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/curacao.png">curacao</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/cyprus.png">cyprus</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/czech-republic.png">czech-republic</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/democratic-republic-of-congo.png">democratic-republic-of-congo</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/denmark.png">denmark</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/djibouti.png">djibouti</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/dominica.png">dominica</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/dominican-republic.png">dominican-republic</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/east-timor.png">east-timor</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/ecuador.png">ecuador</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/egypt.png">egypt</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/england.png">england</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/equatorial-guinea.png">equatorial-guinea</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/eritrea.png">eritrea</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/estonia.png">estonia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/ethiopia.png">ethiopia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/european-union.png">european-union</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/falkland-islands.png">falkland-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/faroe-islands.png">faroe-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/fiji.png">fiji</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/finland.png">finland</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/france.png">france</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/french-polynesia.png">french-polynesia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/gabon.png">gabon</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/galapagos-islands.png">galapagos-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/gambia.png">gambia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/georgia.png">georgia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/germany.png">germany</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/ghana.png">ghana</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/gibraltar.png">gibraltar</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/greece.png">greece</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/greenland.png">greenland</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/grenada.png">grenada</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/guam.png">guam</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/guatemala.png">guatemala</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/guernsey.png">guernsey</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/guinea.png">guinea</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/guinea-bissau.png">guinea-bissau</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/guyana.png">guyana</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/haiti.png">haiti</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/hawaii.png">hawaii</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/honduras.png">honduras</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/hong-kong.png">hong-kong</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/hungary.png">hungary</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/iceland.png">iceland</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/india.png" >india</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/indonesia.png">indonesia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/iran.png">iran</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/iraq.png">iraq</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/ireland.png">ireland</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/isle-of-man.png">isle-of-man</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/israel.png">israel</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/italy.png">italy</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/ivory-coast.png">ivory-coast</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/jamaica.png">jamaica</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/japan.png">japan</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/jersey.png">jersey</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/jordan.png">jordan</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/kazakhstan.png">kazakhstan</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/kenya.png">kenya</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/kiribati.png">kiribati</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/kosovo.png">kosovo</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/kuwait.png">kuwait</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/kyrgyzstan.png">kyrgyzstan</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/laos.png">laos</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/latvia.png">latvia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/lebanon.png">lebanon</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/lesotho.png">lesotho</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/liberia.png">liberia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/libya.png">libya</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/liechtenstein.png">liechtenstein</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/lithuania.png">lithuania</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/luxembourg.png">luxembourg</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/macao.png">macao</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/madagascar.png">madagascar</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/madeira.png">madeira</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/malawi.png">malawi</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/malaysia.png">malaysia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/maldives.png">maldives</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/mali.png">mali</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/malta.png">malta</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/marshall-island.png">marshall-island</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/martinique.png">martinique</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/mauritania.png">mauritania</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/mauritius.png">mauritius</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/melilla.png">melilla</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/mexico.png">mexico</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/micronesia.png">micronesia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/moldova.png">moldova</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/monaco.png">monaco</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/mongolia.png">mongolia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/montenegro.png">montenegro</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/montserrat.png">montserrat</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/morocco.png">morocco</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/mozambique.png">mozambique</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/myanmar.png">myanmar</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/namibia.png">namibia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/nato.png">nato</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/nauru.png">nauru</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/nepal.png">nepal</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/netherlands.png">netherlands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/new-zealand.png">new-zealand</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/nicaragua.png">nicaragua</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/niger.png">niger</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/nigeria.png">nigeria</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/niue.png">niue</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/norfolk-island.png">norfolk-island</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/northen-cyprus.png">northen-cyprus</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/northern-marianas-islands.png">northern-marianas-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/north-korea.png">north-korea</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/norway.png">norway</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/oman.png">oman</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/orkney-islands.png">orkney-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/ossetia.png">ossetia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/pakistan.png">pakistan</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/palau.png">palau</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/palestine.png">palestine</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/panama.png">panama</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/papua-new-guinea.png">papua-new-guinea</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/paraguay.png">paraguay</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/peru.png">peru</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/philippines.png">philippines</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/pitcairn-islands.png">pitcairn-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/portugal.png">portugal</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/puerto-rico.png">puerto-rico</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/qatar.png">qatar</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/rapa-nui.png">rapa-nui</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/republic-of-macedonia.png">republic-of-macedonia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/republic-of-poland.png">republic-of-poland</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/republic-of-the-congo.png">republic-of-the-congo</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/romania.png">romania</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/russia.png">russia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/rwanda.png">rwanda</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/saba-island.png">saba-island</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/saint-kitts-and-nevis.png">saint-kitts-and-nevis</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/salvador.png">salvador</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/samoa.png">samoa</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/san-marino.png">san-marino</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/sao-tome-and-principe.png">sao-tome-and-principe</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/sardinia.png">sardinia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/saudi-arabia.png">saudi-arabia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/scotland.png">scotland</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/senegal.png">senegal</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/serbia.png">serbia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/seychelles.png">seychelles</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/sierra-leone.png">sierra-leone</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/singapore.png">singapore</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/sint-eustatius.png">sint-eustatius</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/sint-maarten.png">sint-maarten</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/slovakia.png">slovakia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/slovenia.png">slovenia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/solomon-islands.png">solomon-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/somalia.png">somalia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/somaliland.png">somaliland</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/south-africa.png">south-africa</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/south-korea.png">south-korea</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/south-sudan.png">south-sudan</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/spain.png">spain</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/sri-lanka.png">sri-lanka</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/st-barts.png">st-barts</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/st-lucia.png">st-lucia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/st-vincent-and-the-grenadines.png">st-vincent-and-the-grenadines</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/sudan.png">sudan</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/suriname.png">suriname</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/swaziland.png">swaziland</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/sweden.png">sweden</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/switzerland.png">switzerland</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/syria.png">syria</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/taiwan.png">taiwan</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/tajikistan.png">tajikistan</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/tanzania.png">tanzania</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/thailand.png">thailand</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/Thumbs.db">Thumbs</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/tibet.png">tibet</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/togo.png">togo</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/tokelau.png">tokelau</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/tonga.png">tonga</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/transnistria.png">transnistria</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/trinidad-and-tobago.png">trinidad-and-tobago</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/tunisia.png">tunisia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/turkey.png">turkey</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/turkmenistan.png">turkmenistan</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/turks-and-caicos.png">turks-and-caicos</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/tuvalu.png">tuvalu</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/uganda.png">uganda</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/ukraine.png">ukraine</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/united-arab-emirates.png">united-arab-emirates</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/united-kingdom.png">united-kingdom</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/united-nations.png">united-nations</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/united-states-of-america.png">united-states-of-america</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/uruguay.png">uruguay</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/uzbekistn.png">uzbekistn</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/vanuatu.png">vanuatu</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/vatican-city.png">vatican-city</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/venezuela.png">venezuela</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/vietnam.png">vietnam</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/virgin-islands.png">virgin-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/wales.png">wales</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/western-sahara.png">western-sahara</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/yemen.png">yemen</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/zambia.png">zambia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/zimbabwe.png">zimbabwe</option></select>
												</div>
											</div>
											<div class="col-md-12 text-center">
												<div id="server_parser" class="form-control col-md-12"></div>
											</div>
										</div>
										
								
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" name="addserver" class="btn btn-primary" id="addbtn">Save changes <i class="fa fa-spin fa-spinner loading" style="display: none;"></i></button>
      </div>
      	</form>
    </div>
  </div>
</div>

<div class="modal fade" id="createServerModal" tabindex="-1" role="dialog" aria-labelledby="Create Server" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header alert-info">
        <h5 class="modal-title" id="exampleModalLabel">Create New Server</h5>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="server_frm2" name="server_frm" novalidate="novalidate" class="fv-form fv-form-bootstrap">
      <div class="modal-body">
       <button type="submit" class="fv-hidden-submit" style="display: none; width: 0px; height: 0px;"></button>
										
										<div class="row">
											<div class="form-group control-group col-md-12">
												<div class="controls input-group">
													<label class="control-label input-group-addon" for="server_name2">Server Name</label>
													<input class="form-control" id="server_name2" name="server_name" data-required="yes" placeholder="Eg. New York" data-fv-field="server_name">
												</div>
											<small style="display: none;" class="help-block" data-fv-validator="notEmpty" data-fv-for="server_name" data-fv-result="NOT_VALIDATED"></small><small style="display: none;" class="help-block" data-fv-validator="stringLength" data-fv-for="server_name" data-fv-result="NOT_VALIDATED"></small></div>
											<div class="form-group control-group col-md-12">
												<div class="controls input-group">
													<label class="control-label input-group-addon" for="server_ip2">Hostname / Server IP</label>
													<input class="form-control" id="server_ip2" name="server_ip"  data-required="yes" placeholder="Eg. 10.0.0.08" data-fv-field="server_ip">
												</div>
											<small style="display: none;" class="help-block" data-fv-validator="notEmpty" data-fv-for="server_ip" data-fv-result="NOT_VALIDATED"></small></div>
										<div class="form-group control-group col-md-12">
												<div class="controls input-group">
													<label class="control-label input-group-addon" for="ssh_port2">SSH Port</label>
													<input class="form-control" id="ssh_port2" name="ssh_port2"  data-required="yes" value="22" placeholder="Server SSH Port" data-fv-field="ssh_port">
												</div>
											<small style="display: none;" class="help-block" data-fv-validator="notEmpty" data-fv-for="server_port" data-fv-result="NOT_VALIDATED"></small></div>
											
											<div class="form-group control-group col-md-12">
												<div class="controls input-group">
													<label class="control-label input-group-addon" for="sshpassword2">SSH Root Password</label>
													<input class="form-control" id="sshpassword2" name="sshpassword" data-required="yes" value="" placeholder="" data-fv-field="sshpassword">
												</div>
											<small style="display: none;" class="help-block" data-fv-validator="notEmpty" data-fv-for="sshpassword" data-fv-result="NOT_VALIDATED"></small></div>
											
											</div>
										
										<div class="row">
										<div class="form-group control-group col-md-12">
			                            <div class="controls input-group">
			                                <label class="control-label input-group-addon" for="maxconn1">Max Connections</label>
			                                <input class="form-control" id="maxconn1" name="maxconn" data-required="yes" value="0" placeholder="" data-fv-field="maxconn">
			                            </div>
			                            <span style="font-size: 12px; color: #8a8a8a;">Set max. connections limit ( by default 0 for unlimited )</span>
			                            <small style="display: none;" class="help-block" data-fv-validator="notEmpty" data-fv-for="maxconn" data-fv-result="NOT_VALIDATED"></small></div>

											<div class="form-group control-group col-md-12">
												<div class="controls input-group">
													<label class="control-label input-group-addon" for="server_category2">VPN Type</label>
													<select class="form-control" id="server_category2" name="server_category" data-fv-field="server_category">
														<option value="openvpn-ikev2" selected="selected">OpenVPN + Ikev2/IPSEC - Recommended</option>
														
													</select>
												</div>
											<small style="display: none;" class="help-block" data-fv-validator="notEmpty" data-fv-for="server_category" data-fv-result="NOT_VALIDATED"></small></div>
											<div class="form-group control-group col-md-12">
												<div class="controls input-group">
													<label class="control-label input-group-addon" for="flag2">Country Flag</label>
													<select name="flag" id="flag2" style="text-transform:uppercase;" class="form-control"><option style="text-transform:uppercase;" selected="selected" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/no_flag.png">No Flag</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/abkhazia.png">abkhazia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/afghanistan.png">afghanistan</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/aland-islands.png">aland-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/albania.png">albania</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/algeria.png">algeria</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/american-samoa.png">american-samoa</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/andorra.png">andorra</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/angola.png">angola</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/anguilla.png">anguilla</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/antigua-and-barbuda.png">antigua-and-barbuda</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/argentina.png">argentina</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/armenia.png">armenia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/aruba.png">aruba</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/australia.png">australia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/austria.png">austria</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/azerbaijan.png">azerbaijan</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/azores-islands.png">azores-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/bahamas.png">bahamas</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/bahrain.png">bahrain</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/balearic-islands.png">balearic-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/bangladesh.png">bangladesh</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/barbados.png">barbados</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/basque-country.png">basque-country</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/belarus.png">belarus</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/belgium.png">belgium</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/belize.png">belize</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/benin.png">benin</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/bermuda.png">bermuda</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/bhutan.png">bhutan</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/bhutan-1.png">bhutan-1</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/bolivia.png">bolivia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/bonaire.png">bonaire</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/bosnia-and-herzegovina.png">bosnia-and-herzegovina</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/botswana.png">botswana</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/brazil.png">brazil</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/british-columbia.png">british-columbia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/british-indian-ocean-territory.png">british-indian-ocean-territory</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/british-virgin-islands.png">british-virgin-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/brunei.png">brunei</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/bulgaria.png">bulgaria</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/burkina-faso.png">burkina-faso</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/burundi.png">burundi</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/cambodia.png">cambodia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/cameroon.png">cameroon</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/canada.png">canada</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/canary-islands.png">canary-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/cape-verde.png">cape-verde</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/cayman-islands.png">cayman-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/central-african-republic.png">central-african-republic</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/ceuta.png">ceuta</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/chad.png">chad</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/chile.png">chile</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/china.png">china</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/christmas-island.png">christmas-island</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/cocos-island.png">cocos-island</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/colombia.png">colombia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/comoros.png">comoros</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/cook-islands.png">cook-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/corsica.png">corsica</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/costa-rica.png">costa-rica</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/croatia.png">croatia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/cuba.png">cuba</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/curacao.png">curacao</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/cyprus.png">cyprus</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/czech-republic.png">czech-republic</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/democratic-republic-of-congo.png">democratic-republic-of-congo</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/denmark.png">denmark</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/djibouti.png">djibouti</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/dominica.png">dominica</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/dominican-republic.png">dominican-republic</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/east-timor.png">east-timor</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/ecuador.png">ecuador</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/egypt.png">egypt</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/england.png">england</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/equatorial-guinea.png">equatorial-guinea</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/eritrea.png">eritrea</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/estonia.png">estonia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/ethiopia.png">ethiopia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/european-union.png">european-union</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/falkland-islands.png">falkland-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/faroe-islands.png">faroe-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/fiji.png">fiji</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/finland.png">finland</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/france.png">france</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/french-polynesia.png">french-polynesia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/gabon.png">gabon</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/galapagos-islands.png">galapagos-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/gambia.png">gambia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/georgia.png">georgia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/germany.png">germany</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/ghana.png">ghana</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/gibraltar.png">gibraltar</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/greece.png">greece</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/greenland.png">greenland</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/grenada.png">grenada</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/guam.png">guam</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/guatemala.png">guatemala</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/guernsey.png">guernsey</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/guinea.png">guinea</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/guinea-bissau.png">guinea-bissau</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/guyana.png">guyana</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/haiti.png">haiti</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/hawaii.png">hawaii</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/honduras.png">honduras</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/hong-kong.png">hong-kong</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/hungary.png">hungary</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/iceland.png">iceland</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/india.png" >india</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/indonesia.png">indonesia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/iran.png">iran</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/iraq.png">iraq</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/ireland.png">ireland</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/isle-of-man.png">isle-of-man</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/israel.png">israel</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/italy.png">italy</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/ivory-coast.png">ivory-coast</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/jamaica.png">jamaica</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/japan.png">japan</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/jersey.png">jersey</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/jordan.png">jordan</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/kazakhstan.png">kazakhstan</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/kenya.png">kenya</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/kiribati.png">kiribati</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/kosovo.png">kosovo</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/kuwait.png">kuwait</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/kyrgyzstan.png">kyrgyzstan</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/laos.png">laos</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/latvia.png">latvia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/lebanon.png">lebanon</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/lesotho.png">lesotho</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/liberia.png">liberia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/libya.png">libya</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/liechtenstein.png">liechtenstein</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/lithuania.png">lithuania</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/luxembourg.png">luxembourg</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/macao.png">macao</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/madagascar.png">madagascar</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/madeira.png">madeira</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/malawi.png">malawi</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/malaysia.png">malaysia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/maldives.png">maldives</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/mali.png">mali</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/malta.png">malta</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/marshall-island.png">marshall-island</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/martinique.png">martinique</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/mauritania.png">mauritania</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/mauritius.png">mauritius</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/melilla.png">melilla</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/mexico.png">mexico</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/micronesia.png">micronesia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/moldova.png">moldova</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/monaco.png">monaco</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/mongolia.png">mongolia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/montenegro.png">montenegro</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/montserrat.png">montserrat</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/morocco.png">morocco</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/mozambique.png">mozambique</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/myanmar.png">myanmar</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/namibia.png">namibia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/nato.png">nato</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/nauru.png">nauru</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/nepal.png">nepal</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/netherlands.png">netherlands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/new-zealand.png">new-zealand</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/nicaragua.png">nicaragua</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/niger.png">niger</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/nigeria.png">nigeria</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/niue.png">niue</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/norfolk-island.png">norfolk-island</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/northen-cyprus.png">northen-cyprus</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/northern-marianas-islands.png">northern-marianas-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/north-korea.png">north-korea</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/norway.png">norway</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/oman.png">oman</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/orkney-islands.png">orkney-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/ossetia.png">ossetia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/pakistan.png">pakistan</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/palau.png">palau</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/palestine.png">palestine</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/panama.png">panama</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/papua-new-guinea.png">papua-new-guinea</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/paraguay.png">paraguay</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/peru.png">peru</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/philippines.png">philippines</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/pitcairn-islands.png">pitcairn-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/portugal.png">portugal</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/puerto-rico.png">puerto-rico</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/qatar.png">qatar</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/rapa-nui.png">rapa-nui</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/republic-of-macedonia.png">republic-of-macedonia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/republic-of-poland.png">republic-of-poland</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/republic-of-the-congo.png">republic-of-the-congo</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/romania.png">romania</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/russia.png">russia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/rwanda.png">rwanda</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/saba-island.png">saba-island</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/saint-kitts-and-nevis.png">saint-kitts-and-nevis</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/salvador.png">salvador</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/samoa.png">samoa</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/san-marino.png">san-marino</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/sao-tome-and-principe.png">sao-tome-and-principe</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/sardinia.png">sardinia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/saudi-arabia.png">saudi-arabia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/scotland.png">scotland</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/senegal.png">senegal</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/serbia.png">serbia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/seychelles.png">seychelles</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/sierra-leone.png">sierra-leone</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/singapore.png">singapore</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/sint-eustatius.png">sint-eustatius</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/sint-maarten.png">sint-maarten</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/slovakia.png">slovakia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/slovenia.png">slovenia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/solomon-islands.png">solomon-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/somalia.png">somalia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/somaliland.png">somaliland</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/south-africa.png">south-africa</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/south-korea.png">south-korea</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/south-sudan.png">south-sudan</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/spain.png">spain</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/sri-lanka.png">sri-lanka</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/st-barts.png">st-barts</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/st-lucia.png">st-lucia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/st-vincent-and-the-grenadines.png">st-vincent-and-the-grenadines</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/sudan.png">sudan</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/suriname.png">suriname</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/swaziland.png">swaziland</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/sweden.png">sweden</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/switzerland.png">switzerland</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/syria.png">syria</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/taiwan.png">taiwan</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/tajikistan.png">tajikistan</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/tanzania.png">tanzania</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/thailand.png">thailand</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/Thumbs.db">Thumbs</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/tibet.png">tibet</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/togo.png">togo</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/tokelau.png">tokelau</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/tonga.png">tonga</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/transnistria.png">transnistria</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/trinidad-and-tobago.png">trinidad-and-tobago</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/tunisia.png">tunisia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/turkey.png">turkey</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/turkmenistan.png">turkmenistan</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/turks-and-caicos.png">turks-and-caicos</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/tuvalu.png">tuvalu</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/uganda.png">uganda</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/ukraine.png">ukraine</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/united-arab-emirates.png">united-arab-emirates</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/united-kingdom.png">united-kingdom</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/united-nations.png">united-nations</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/united-states-of-america.png">united-states-of-america</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/uruguay.png">uruguay</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/uzbekistn.png">uzbekistn</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/vanuatu.png">vanuatu</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/vatican-city.png">vatican-city</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/venezuela.png">venezuela</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/vietnam.png">vietnam</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/virgin-islands.png">virgin-islands</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/wales.png">wales</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/western-sahara.png">western-sahara</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/yemen.png">yemen</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/zambia.png">zambia</option><option style="text-transform:uppercase;" value="{$systemURL}modules/addons/vpnpanel/assets/flags/png/zimbabwe.png">zimbabwe</option></select>
												</div>
											</div>
											
										</div>
										
								
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" name="createserver" class="btn btn-primary" id="createbtn">Create <i class="fa fa-spin fa-spinner loading" style="display: none;"></i></button>
      </div>
      	</form>
    </div>
  </div>
</div>

<div class="modal fade" id="fixnowmodal" tabindex="-1" role="dialog" aria-labelledby="Fixnow" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header alert-success">
                <h2 class="text-center">Fix Server</h2>
            </div>
            <h1 class="heading text-center" style="margin-top: 10px;"></h1>
            <p class="message text-center"></p>
            <p class="note"></p>
            <input type="hidden" class="fixserverid">

            <div class="modal-footer ">
                <center><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-primary"  name="autofix"  id="autofix">Auto Fix <i class="fa fa-spin fa-spinner loading" style="display: none;"></i></button>
                <button class="btn btn-primary"  name="fixeditserver"  id="fixeditserver">Edit Server <i class="fa fa-spin fa-spinner loading" style="display: none;"></i></button></center>
            </div>
        </div>   
        </div>
        </div> 

<div class="row">
    <a href="{$modulelink}&action=vpn_servers" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Go Back</a>
</div>
{literal}
<style>
	.modal-header h2, .modal-header h5
        {
            font-size: 22px;
        }
        .modal-header .close {
    margin-top: -42px;
}
.error
        {
            border-color: #f00;
            box-shadow: 0px 0px 5px -2px;
        }
        .modal-dialog
        {
            width: 60%;
        }

        .spinn
        {
            animation: spinn 2s infinite linear;
        }
        @keyframes spinn {
            0% {-webkit-transfrom:rotate('0deg');}
            50%{-webkit-transfrom:rotate('180deg');}
            100% {-webkit-transfrom:rotate('360deg');}
        }

        @keyframes blink {
            0% {opacity: 0}
            49%{opacity: 0}
            50% {opacity: 1}
        }

        .blink{
            animation: blink 1s infinite;
            color: #f00;
            font-size: 18px;
        }

        .modal-dialog
        {
            width: 70% !important;
        }
        @media screen and (max-width:950px)
        {
            .modal-dialog
            {
                width: 95% !important;
            }
        }

        .dropdown-menu
        {
            left: -72px;
            padding: 5px;
        }

        .dropdown-menu .btn
        {
            width: 100%;
            margin-bottom: 2px;
        }
        .tooltipCustom
{
    float: left;
    margin-bottom: 0px;
}
.tooltipCustom span
{
    position: absolute;
    z-index: 99999;
    background:#000;
    color: #fff;
    display: none;
    padding: 10px;
    border-radius: 5px;
    margin-top: -40px;
    margin-left: 19px;
    max-width: 150px;
    font-size: 12px;
    text-align: center;
    box-shadow: 0px 0px 10px -2px #000;
}
.tooltipCustom:hover span
{
    display: block;
}
.tooltipCustom span::before {

    content: "\f0d9";
    font: normal normal normal 14px/1 FontAwesome;
        font-size: 14px;
    font-size: 14px;
    font-size: inherit;
    text-rendering: auto;
    position: absolute;
    left: -5px;
    top: 23px;
    color: #000;
}
</style>

<script>
$(document).ready(function(){
    
    {/literal}
{$script1}

{literal}
    
    $.ajax({
    	url: 'addonmodules.php?module=vpnpanel&action=vpn_servers',
        type: "POST",
        crossDomain: true,
        data: {getallserverstatus: true},
        dataType: "text",
        success: function (resultData) {
            var data = $.parseJSON(resultData);
            var i = 0;
            $(data['lbservers']).each(function(){
            console.log(data['lbservers'][i]);
            if(data['lbservers'][i]['serverstatus'] == 'invalidpassword')
            {
               var id = data['lbservers'][i]['id'];
                $(document).find('#tr'+id+' .status .serverstatus').html('<span class="badge badge-warning"  style="background: #c9302c;" data-toggle="tooltip" data-placement="right" title="Tooltip on right">Invalid Password</span><p class="tooltipCustom"><i class="fa fa-question-circle"></i><span>Please update the password of your server.</span></p>');

            }
            else if(data['lbservers'][i]['serverstatus'] == 'offline')
            {
               var id = data['lbservers'][i]['id'];
                $(document).find('#tr'+id+' .status .serverstatus').html('<span class="badge badge-warning"  style="background: #c9302c;" data-toggle="tooltip" data-placement="right" title="Tooltip on right">Server Offline</span><p class="tooltipCustom"><i class="fa fa-question-circle"></i><span>Please check your server is not online.</span></p>');

            }
            else if(data['lbservers'][i]['serverstatus'] == 'processing')
            {
               var id = data['lbservers'][i]['id'];
                $(document).find('#tr'+id+' .status .serverstatus').html('<span class="badge badge-warning"  style="background: #c9302c;" data-toggle="tooltip" data-placement="right" title="Tooltip on right">Processing</span><p class="tooltipCustom"><i class="fa fa-question-circle"></i><span>Please wait your server is under processing..</span></p>');

            }else
            {
                var id = data['lbservers'][i]['id'];
                $(document).find('#tr'+id+' .status .serverstatus').html('<span class="badge badge-success"  style="background: #24a238;" data-toggle="tooltip" data-placement="right" title="Tooltip on right">Server Online</span>');
            }

            if(data['lbservers'][i]['servicestatus'] == 'error')
            {
               var id = data['lbservers'][i]['id'];
                $(document).find('#tr'+id+' .status .servicestatus').html('<span class="badge badge-warning"  style="background: #c9302c;">Service Inactive</span><p class="tooltipCustom"><i class="fa fa-question-circle"></i><span>Please restart your services or reboot your server. Also you can click on "Fix Now" to fix the issue.</span></p><br /><p class="fixnowbtn link" data-error="service" data-serverid="'+id+'">Fix Now</p>');
            }else if(data['lbservers'][i]['servicestatus'] == 'processing')
            {
               var id = data['lbservers'][i]['id'];
                $(document).find('#tr'+id+' .status .servicestatus').html('');

            } else if(data['lbservers'][i]['servicestatus'] == 'unabletocheck')
            {
                if(data['lbservers'][i]['serverstatus'] == 'offline')
                {
                    var id = data['lbservers'][i]['id'];
                $(document).find('#tr'+id+' .status .servicestatus').html('<span class="badge badge-warning"  style="background: #c9302c;">Unable to check Services status</span><p class="tooltipCustom"><i class="fa fa-question-circle"></i><span>Please check your server is not online.</span></p>');
                }else
                {
                    var id = data['lbservers'][i]['id'];
                    $(document).find('#tr'+id+' .status .servicestatus').html('<span class="badge badge-warning"  style="background: #c9302c;">Unable to check Services status</span><p class="tooltipCustom"><i class="fa fa-question-circle"></i><span>Please update the password of your server.</span></p><p class="fixnowbtn link" data-error="serverpass" data-serverid="'+id+'">Fix Now</p>');
                }
            }
            else
            {
                var id = data['lbservers'][i]['id'];
                $(document).find('#tr'+id+' .status .servicestatus').html('<span class="badge badge-success"  style="background: #24a238;" data-toggle="tooltip" data-placement="right" title="Tooltip on right">Services Active</span>');
            }
            i++;
            })

        }
    })
$(document).on('click', '.fixnowbtn', function(){ 
    var errorcode = $(this).attr('data-error');
    var serverid = $(this).attr('data-serverid');
$('#fixnowmodal #autofix').show();
$('#fixnowmodal #fixeditserver').hide();
$('#fixnowmodal #fixeditserver').attr('data-serverid',serverid);
    if(errorcode == 'mainservice')
    {
        $('#fixnowmodal .heading').text('Service is inactive.');
        $('#fixnowmodal .message').text('Your Server will reboot and may take 1-2 minutes.');
        $('#fixnowmodal .fixserverid').val(serverid);

        /*$('#fixnowmodal .note').text('Service is inactive.');*/
    }
    if(errorcode == 'mainserverpass')
    {
        $('#fixnowmodal .heading').text('Server Password is invalid.');
        $('#fixnowmodal .message').text('Please Click on Edit Server button to change password.');
        $('#fixnowmodal .fixserverid').val(serverid);
        $('#fixnowmodal #autofix').hide();
        $('#fixnowmodal #fixeditserver').show();
    }
    if(errorcode == 'service')
    {
        $('#fixnowmodal .heading').text('Service is inactive.');
        $('#fixnowmodal .message').text('Your Server will reboot and may take 1-2 minutes.');
        $('#fixnowmodal .fixserverid').val(serverid);
    }
    if(errorcode == 'serverpass')
    {
        $('#fixnowmodal .heading').text('Server Password is invalid.');
        $('#fixnowmodal .message').text('Please Click on Edit Server button to change password');
        $('#fixnowmodal .fixserverid').val(serverid);
        $('#fixnowmodal #autofix').hide();
        $('#fixnowmodal #fixeditserver').show();
    }
     if(errorcode == 'serveroffline')
    {
        $('#fixnowmodal .heading').text('SERVER OFFLINE.');
        $('#fixnowmodal .message').text('Please Check if your server is online. You can also delete the server and add again.');
        $('#fixnowmodal .fixserverid').val(serverid);
        $('#fixnowmodal #autofix').hide();
        $('#fixnowmodal #fixeditserver').hide();
    }
    $(document).find('#fixnowmodal').modal('show');
}); 
   $('#fixnowmodal #fixeditserver').click(function(){
    $('#fixnowmodal').modal('hide');
    var fixserverid = $('#fixnowmodal .fixserverid').val();
    var serverid = fixserverid;
               
                $.ajax({
                	url: 'addonmodules.php?module=vpnpanel&action=vpn_servers',
                    type: "POST",
                    crossDomain: true,
                    data: {editlbserver: true, server_id: serverid},
                    dataType: "text",
                    success: function (resultData) {
                        var data = $.parseJSON(resultData);

                        $(document).find('.serveridedit').val(data[0].server_id);
                        $(document).find('#server_name').val(data[0].server_name);
                        $(document).find('#server_ip').val(data[0].server_ip);
                        $(document).find('#ssh_port2').val(data[0].sshport);
                         $(document).find('#mainserver').val(data[0].mainserver);
                        $(document).find('#flag1').children('option').each(function () {
                            if ($(this).attr('value') == data[0].flag)
                            {
                                $(this).attr('selected', 'selected');
                            } else
                            {
                                $(this).removeAttr('selected');
                            }

                        })
                        if(data[0].mainserver == 1)
                        {
                            $(document).find('.server_groupController').hide(0);
                             $(document).find('.server_vpntype').hide(0);
                        }
                        else
                        {
                            $(document).find('.server_groupController').show(0);
                             $(document).find('.server_vpntype').show(0);

                        $(document).find('#server_group2').children('option').each(function () {
                            if ($(this).attr('value') == data[0].server_group)
                            {
                                $(this).attr('selected', 'selected');
                            } else
                            {
                                $(this).removeAttr('selected');
                            }

                        })

                        $(document).find('#server_category').children('option').each(function () {
                            if ($(this).attr('value') == data[0].server_category)
                            {
                                $(this).attr('selected', 'selected');
                            } else
                            {
                                $(this).removeAttr('selected');
                            }

                        })
                    }

                        $(document).find('#editServerModal').modal('show');

                    }
                });
   })
   $('#autofix').click(function(){
    $(this).children('i').show();
    var fixserverid = $('#fixnowmodal .fixserverid').val();
    var serverid = fixserverid;
    swal({
                    title: "Are you sure?",
                    text: "It will reboot your server.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, Fix it!",
                    closeOnConfirm: false
                },
                        function () {
                            $(document).find('#fullpageloader').show();
                             $.ajax({
                            url: 'addonmodules.php?module=vpnpanel&action=vpn_servers',
                            type: "POST",
                            crossDomain: true,
                            data: {rebootlb: true, server_id: serverid},
                            dataType: "text",
                            success: function (resultData) {
                                $(document).find('.loading').hide();
                                $(document).find('#fullpageloader').show();
                                if (resultData == 'success')
                                {
                                    swal("Success!", "Server Rebooted Successfully!", "success");
                                    window.location.replace('addonmodules.php?module=vpnpanel&action=vpn_servers');
                                } else
                                {
                                    swal("Error!", "Server Reboot Failed!", "error");
                                    window.location.replace('addonmodules.php?module=vpnpanel&action=vpn_servers');
                                }
                            }
                        });
                        })
    $(document).find('.loading').hide();
return false;

})




    $(document).find('#addserverbtn').click(function(){
        $(document).find('#addServerModal').modal('show');
    })
    $(document).find('#createserverbtn').click(function(){
        $(document).find('#createServerModal').modal('show');
    })

function addServer()
{
    var server_category =  $(document).find('#server_category1').val();
   var server_name = $(document).find('#server_name1').val();
    var server_ip = $(document).find('#server_ip1').val();
    var server_port = $(document).find('#server_port1').val();
    var server_folder = $(document).find('#server_folder1').val();
    var server_tcp = $(document).find('#server_tcp1').val();
    var flag = $(document).find('#flag').val();
    var max_conn = $(document).find('#maxconn1').val();
    $(document).find('input').removeClass('error');
    if(server_name.length == 0)
    {
        swal('Server Name Cannot be Empty!');
        $(document).find('#server_name1').addClass('error');
        return;
    }
    if(server_ip.length == 0)
    {
        swal('Server IP/Hostname Cannot be Empty!');
        $(document).find('#server_ip1').addClass('error');
        return;
    }
    $.ajax({
    url: 'addonmodules.php?module=vpnpanel&action=vpn_servers',
      type: "POST",
      crossDomain: true,
      data: {addLBserver:true, server_name:server_name,server_category:server_category,server_ip:server_ip,server_port:server_port,server_folder:server_folder,server_tcp:server_tcp,flag:flag,max_connection:max_conn},
      dataType: "text",
      success: function(resultData){
          if(resultData == 'success')
          {
              swal("Success!", "Server Added Successfully!", "success");
          window.location.replace('addonmodules.php?module=vpnpanel&action=vpn_servers');
          }
          else
          {
              swal("Error!", "Server Add Failed!", "error");
          window.location.replace('addonmodules.php?module=vpnpanel&action=vpn_servers');
          }
      }
    });

}

function rebootServer()
            {
                var serverid = $(this).data('serverid');
                swal({
                    title: "Are you sure?",
                    text: "Your Server will reboot and may down for some time!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, Reboot it!",
                    closeOnConfirm: false
                },
                        function () {
                            $.ajax({
                            	url: 'addonmodules.php?module=vpnpanel&action=vpn_servers',
                            type: "POST",
                            crossDomain: true,
                            data: {rebootlb: true, server_id: serverid},
                            dataType: "text",
                            success: function (resultData) {
                                $(document).find('.loading').hide();
                                if (resultData == 'success')
                                {
                                    swal("Success!", "Server Rebooted Successfully!", "success");
                                    window.location.replace('addonmodules.php?module=vpnpanel&action=vpn_servers');
                                } else
                                {
                                    swal("Error!", "Server Reboot Failed!", "error");
                                    window.location.replace('addonmodules.php?module=vpnpanel&action=vpn_servers');
                                }
                            }
                        });
                        })
            }

function editServer()
{
    
    var serverid = $(this).data('serverid');
    $.ajax({
      type: "POST",
      crossDomain: true,
      data: {editLBserver:true, server_id:serverid},
      dataType: "text",
      success: function(resultData){
          var data = $.parseJSON(resultData);
          
    $(document).find('.serveridedit').val(data[0].server_id);
    $(document).find('#server_name').val(data[0].server_name);
    $(document).find('#server_ip').val(data[0].server_ip);
    $(document).find('#server_port').val(data[0].server_port);
    $(document).find('#server_folder').val(data[0].server_folder);
    $(document).find('#server_tcp').val(data[0].server_tcp);
    $(document).find('#maxconn').val(data[0].max_connection);
    $(document).find('#server_parser').html('<a target="_blank" href="'+data[0].server_parser+'">'+data[0].server_parser+'</a>');
    $(document).find('#flag1').children('option').each(function(){
    if($(this).attr('value') == data[0].flag)
    {
        $(this).attr('selected','selected');
    }
    else
    {
        $(this).removeAttr('selected');
    }
        
    })
    
    $(document).find('#editServerModal').modal('show');
          
      }
    });
}


function updateServer()
{
$(this).children('.loading').show();
    var server_name = $(document).find('#server_name').val();
	var server_category = $(document).find('#server_category').val();
	var server_ip = $(document).find('#server_ip').val();
	var server_port = $(document).find('#server_port').val();
	var server_tcp = $(document).find('#server_tcp').val();
	var server_folder = $(document).find('#server_folder').val();
	var serverID = $(document).find('.serveridedit').val();
	var flag = $(document).find('#flag1').val();
	var max_conn = $(document).find('#maxconn').val();
	$(document).find('input').removeClass('error');
    if(server_name.length == 0)
    {
        swal('Server Name Cannot be Empty!');
        $(document).find('#server_name').addClass('error');
        return;
    }
    if(server_ip.length == 0)
    {
        swal('Server IP/Hostname Cannot be Empty!');
        $(document).find('#server_ip').addClass('error');
        return;
    }
	
    var datakeys = {updateLBServer:true,server_id:serverID, flag:flag, server_name:server_name,server_category:server_category, server_ip:server_ip, server_port:server_port, server_tcp: server_tcp,server_folder:server_folder,max_connection:max_conn};
    $.ajax({
      type: "POST",
      crossDomain: true,
      data: datakeys,
      dataType: "text",
      success: function(resultData){
      
      $(document).find('.loading').hide();
      if(resultData == 'success')
      {
          swal("Success!", "Server Updated Successfully!", "success");
          window.location.replace('addonmodules.php?module=vpnpanel&action=vpn_servers');
      }
      else
      {
          swal("Error!", "Server Update Failed!", "error");
      }
      $(document).find('#editServerModal').modal('hide');
      
      }
});
	
	
}

$('#createbtn').click(function(){
    $(this).children('.loading').show();
    var server_name = $(document).find('#server_name2').val();
	var server_category = $(document).find('#server_category2').val();
	var server_ip = $(document).find('#server_ip2').val();
	var server_port = $(document).find('#server_port2').val();
	
	var serverID = $(document).find('.serveridedit2').val();
	var flag = $(document).find('#flag2').val();
	var sshport = $(document).find('#ssh_port2').val();
	var sshpass = $(document).find('#sshpassword2').val();
	var max_conn = $(document).find('#maxconn1').val();
	
	$(document).find('input').removeClass('error');
    if(server_name.length == 0)
    {
        swal('Server Name Cannot be Empty!');
        $(document).find('#server_name2').addClass('error');
        return;
    }
    if(server_ip.length == 0)
    {
        swal('Server IP/Hostname Cannot be Empty!');
        $(document).find('#server_ip2').addClass('error');
        return;
    }
    
    if(sshport.length == 0)
    {
        swal('SSH Port Cannot be Empty!');
        $(document).find('#ssh_port2').addClass('error');
        return;
    }
    
    if(sshpass.length == 0)
    {
        swal('SSH Root Password Cannot be Empty!');
        $(document).find('#sshpassword2').addClass('error');
        return;
    }
	
    $.ajax({
      type: "POST",
      crossDomain: true,
      data: {createLBserver:true, serverid:serverID,sshport:sshport, flag:flag, server_name:server_name,server_category:server_category, server_ip:server_ip, server_port:server_port, sshpass:sshpass, max_connection:max_conn},
      dataType: "text",
      success: function(resultData){
          $(document).find('.loading').hide();
      if(resultData == 'success')
      {
          swal("Success!", "Installation started successfully! Once it's ready, it will show 'online'.", "success");
          window.location.replace('addonmodules.php?module=vpnpanel&action=vpn_servers');
      }
      else
      {
          swal("Error!", "Server Installation Failed!", "error");
      }
      $(document).find('#editServerModal').modal('hide');
      }
      })
})

function reinstallServer()
{
    
    var serverid = $(this).data('serverid');
    
    swal({
  title: "Are you sure?",
  text: "Your Server will re-install!",
  type: "warning",
  showCancelButton: true,
  confirmButtonClass: "btn-danger",
  confirmButtonText: "Yes, Re-Install it!",
  closeOnConfirm: false
},
function(){
   $(document).find('.sweet-alert').css('z-index','9');
    $(document).find('.fullpageloader').show();
    $.ajax({
      type: "POST",
      crossDomain: true,
      data: {reinstallLBserver:true, server_id:serverid},
      dataType: "text",
      success: function(resultData){
          $(document).find('.sweet-alert').css('z-index','999999');
        $(document).find('.fullpageloader').hide();
          $(document).find('.loading').hide();
          console.log(resultData);
           if(resultData == 'success')
           {
               swal("Success!", "Re-Installation started successfully! Once it's ready, it will show 'online'.", "success");
            $(document).find('.message').html('<p class="alert alert-success">Re-Installation Started Successfully.</p>');
            window.location.reload();
           // $('#tr'+serverid+'').remove();
           
            
           }
           else if(resultData == 'noserverid')
           {
               swal.close();
               swal("Error!", "Server ID not found'.", "error");
               $(document).find('.message').html('<p class="alert alert-warning">Error! Server ID not found.</p>');
               
           }
           else
           {
               swal.close();
               swal("Error!", "Unable to start Re-Installation'.", "error");
               $(document).find('.message').html('<p class="alert alert-warning">Error! Something went wrong.</p>');
               
           }
          //$(document).find('.message').html(resultData);
          
          //reloadserver();
          //window.location.reload();
      
      }
    });
})
}

function repairServer()
            {
                var serverid = $(this).data('serverid');
                swal('Server Repair is underprocess');
            }

function deleteServer()
{
    
    var serverid = $(this).data('serverid');
    
    swal({
  title: "Are you sure?",
  text: "Your will not be able to recover this server!",
  type: "warning",
  showCancelButton: true,
  confirmButtonClass: "btn-danger",
  confirmButtonText: "Yes, delete it!",
  closeOnConfirm: false
},
function(){
    $.ajax({
      type: "POST",
      crossDomain: true,
      data: {deleteLBserver:true, server_id:serverid},
      dataType: "text",
      success: function(resultData){
        swal.close();
          $(document).find('.loading').hide();
           if(resultData == 'success')
           {
            $(document).find('.message').html('<p class="alert alert-success">Server Deleted Successfully.</p>');
            $('#tr'+serverid+'').remove();
           
            
           }
           else if(resultData == 'noserverid')
           {
               $(document).find('.message').html('<p class="alert alert-warning">Error! Server ID not found.</p>');
               
           }
           else
           {
               $(document).find('.message').html('<p class="alert alert-warning">Error! Something went wrong.</p>');
               
           }
          //$(document).find('.message').html(resultData);
          
          //reloadserver();
          //window.location.reload();
      
      }
    });
})
}

})
</script>
{/literal}