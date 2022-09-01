<div class="fullpageloader" style="position: fixed; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 99999; top: 0px; left: 0px; display: none;">
    <p style="position: absolute; left: 40%; top: 30%; color: #fff; font-size: 25px;"><i class="fa fa-circle-o-notch  fa-spin"></i> Loading Please wait...</p>
</div>
{$message}
<hr>
<center><h1 style="
            color: #ed5e2f;
            font-weight: 600;
            font-size: 25px;
            ">Server Info - {$servername} ({$serverip})</h1></center>
<center><h5></h5></center>

<ul class="nav nav-tabs admin-tabs" role="tablist">
<li class="active"><a class="tab-top" href="#tab1" role="tab" data-toggle="tab" id="tabLink1" data-tab-id="1" aria-expanded="true">OS Info</a></li>
<li class=""><a class="tab-top" href="#tab2" role="tab" data-toggle="tab" id="tabLink2" data-tab-id="2" aria-expanded="false">Server Health</a></li>
</ul>
<div class="tab-content admin-tabs">
  <div class="tab-pane active" id="tab1">
<table class="table table-bordered table-striped">
{$serverhtml}
</table>
  </div>
  <div class="tab-pane" id="tab2">
    <table class="table table-bordered table-striped">
<tr><th>CPU Memory Usage</th><td>{$cpu}%</td></tr>
<tr><th>Memory (KiB)</th><td><span class="text-warning">{$memused}</span> / <span class="text-info">{$memtotal}</span> (KiB)<br /><span class="label" style="color:#2e2e2e;">(Used / Total) Memory</span></td></tr>
<tr><th>Free Memory (KiB)</th><td>{$memfree}</td></tr>
</table>
  </div></div>

<style>
.indented
{
    margin-left: 0px !important;
    padding-bottom: 0px !important;
}
table
{
    background: #eaeaea !important;
    border: none !important;
}
table tr td
{
    padding: 10px;
}
</style>
