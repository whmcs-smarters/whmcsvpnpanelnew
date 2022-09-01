<?php

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

require_once __DIR__ . '/lib/Admin/AdminDispatcher.php';
require_once __DIR__ . '/lib/Admin/Controller.php';
require_once __DIR__ . '/lib/Client/ClientDispatcher.php';
require_once __DIR__ . '/lib/Client/Controller.php';

use WHMCS\Database\Capsule;

include_once 'hooks.php';

function vpnpanel_config() {
    $configarray = array(
        'name' => 'VPN Panel', // Display name for your module
        'description' => 'The module provide the VPN User and Reseller Management.', // Description displayed within the admin interface
        'author' => '<img src="../modules/addons/vpnpanel/whmcssmarters.png"><br><a href="https://whmcssmarters.com/" target="_blank">WHMCS Smarters</a>',
        'language' => 'english', // Default language
        'version' => '2.10', // Version number 
        "fields" => array(
            "licenseregto" => array(
                "FriendlyName" => "License Registered To",
                "Description" => "Not Available"
            ),
            "licenseregmail" => array(
                "FriendlyName" => "License Registered Email",
                "Description" => "Not Available"
            ),
            "licenseduedate" => array(
                "FriendlyName" => "License Due Date",
                "Description" => "Not Available"
            ),
            "licensestatus" => array(
                "FriendlyName" => "License Status",
                "Description" => "Not Available"
            ),
            "license" => array(
                "FriendlyName" => "License",
                "Type" => "text",
                "Size" => "35"
            ),
            "deletetables" => array(
                "FriendlyName" => "Delete Records",
                "Type" => "yesno",
                "Size" => "25",
                "Description" => "Tick to check it should delete all the tables relative to this module on deactivation"
            ),
            "downloadbutton" => array("FriendlyName" => "Download Cetificate Button","Type" => "yesno", "Description" => "Tick to Show Download Button On Client Area."),
        )
    );


    $licenseinfo = vpnpanel_doCheckLicense();
    if ($licenseinfo['status'] != 'licensekeynotfound') {
        if ($licenseinfo['status'] == 'Active') {
            if (isset($licenseinfo['localkey']) && !empty($licenseinfo['localkey'])) {
                $moduledata = Capsule::table('tbladdonmodules')
                        ->where('module', '=', 'vpnpanel')
                        ->where('setting', '=', 'localkey')
                        ->get();
                if (isset($moduledata[0]->setting) && !empty($moduledata[0]->setting)) {
                    Capsule::table('tbladdonmodules')
                            ->where('setting', 'localkey')
                            ->where('module', 'vpnpanel')
                            ->update(['value' => $licenseinfo['localkey']]);
                } else {
                    Capsule::table('tbladdonmodules')->insert(
                            ['setting' => 'localkey', 'value' => $licenseinfo['localkey'], 'module' => 'vpnpanel']
                    );
                }
            }
        }
        if ($licenseinfo['registeredname']) {
            $configarray['fields']['licenseregto']['Description'] = $licenseinfo['registeredname'];
        }
        if ($licenseinfo['email']) {
            $configarray['fields']['licenseregmail']['Description'] = $licenseinfo['email'];
        }
        if ($licenseinfo['nextduedate']) {
            $configarray['fields']['licenseduedate']['Description'] = $licenseinfo['nextduedate'];
        }
        $configarray['fields']['licensestatus']['Description'] = $licenseinfo['status'];
        $configarray['fields']['license']['Value'] = $licenseinfo['licensekey'];
    }
    return $configarray;
}

function vpnpanel_doCheckLicense() {
    $result = Capsule::table('tbladdonmodules')->where('module', '=', 'vpnpanel')->get();
    foreach ($result as $row) {
        $settings[$row->setting] = $row->value;
    }
    if ($settings['license']) {
        $localkey = $settings['localkey'];
        $licenseinfo = $result = vpnpanel_checkLicense($settings['license'], $localkey);
        if ($licenseinfo['status'] == 'Active') {
            if (isset($licenseinfo['localkey']) && !empty($licenseinfo['localkey'])) {
                $moduledata = Capsule::table('tbladdonmodules')
                        ->where('module', '=', 'vpnpanel')
                        ->where('setting', '=', 'localkey')
                        ->get();
                if (isset($moduledata[0]->setting) && !empty($moduledata[0]->setting)) {
                    Capsule::table('tbladdonmodules')
                            ->where('setting', 'localkey')
                            ->where('module', 'vpnpanel')
                            ->update(['value' => $licenseinfo['localkey']]);
                } else {
                    Capsule::table('tbladdonmodules')->insert(
                            ['setting' => 'localkey', 'value' => $licenseinfo['localkey'], 'module' => 'vpnpanel']
                    );
                }
            }
        }
        $result['licensekey'] = $settings['license'];
    } else {
        $result['status'] = 'licensekeynotfound';
    }
    return $result;
}

function vpnpanel_checkLicense($licensekey, $localkey = '') {
    $whmcsurl = "https://www.whmcssmarters.com/clients/";
    $licensing_secret_key = "smartersvpnpanel";
    $localkeydays = 7;
    $allowcheckfaildays = 5;
    $check_token = time() . md5(mt_rand(1000000000, 9999999999) . $licensekey);
    $checkdate = date("Ymdhis");
    $domain = $_SERVER['SERVER_NAME'];
    $usersip = isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : $_SERVER['LOCAL_ADDR'];
    $dirpath = dirname(__FILE__);
    $verifyfilepath = 'modules/servers/licensing/verify.php';
    $localkeyvalid = false;
    if ($localkey) {
        $localkey = str_replace("\n", '', $localkey); # Remove the line breaks
        $localdata = substr($localkey, 0, strlen($localkey) - 32); # Extract License Data
        $md5hash = substr($localkey, strlen($localkey) - 32); # Extract MD5 Hash
        if ($md5hash == md5($localdata . $licensing_secret_key)) {
            $localdata = strrev($localdata); # Reverse the string
            $md5hash = substr($localdata, 0, 32); # Extract MD5 Hash
            $localdata = substr($localdata, 32); # Extract License Data
            $localdata = base64_decode($localdata);
            $localkeyresults = unserialize($localdata);
            $originalcheckdate = $localkeyresults['checkdate'];
            if ($md5hash == md5($originalcheckdate . $licensing_secret_key)) {
                $localexpiry = date("Ymdhis", mktime(date("h"), date("i"), date("s"), date("m"), date("d") - $localkeydays, date("Y")));
                if ($originalcheckdate > $localexpiry) {
                    $localkeyvalid = true;
                    $results = $localkeyresults;
                    $validdomains = explode(',', $results['validdomain']);
                    if (!in_array($_SERVER['SERVER_NAME'], $validdomains)) {
                        $localkeyvalid = false;
                        $localkeyresults['status'] = "Invalid";
                        $results = array();
                    }
                    $validips = explode(',', $results['validip']);
                    if (!in_array($usersip, $validips)) {
                        $localkeyvalid = false;
                        $localkeyresults['status'] = "Invalid";
                        $results = array();
                    }
                    $validdirs = explode(',', $results['validdirectory']);
                    if (!in_array($dirpath, $validdirs)) {
                        $localkeyvalid = false;
                        $localkeyresults['status'] = "Invalid";
                        $results = array();
                    }
                }
            }
        }
    }
    if (!$localkeyvalid) {
        $responseCode = 0;
        $postfields = array(
            'licensekey' => $licensekey,
            'domain' => $domain,
            'ip' => $usersip,
            'dir' => $dirpath
        );
        if ($check_token)
            $postfields['check_token'] = $check_token;
        $query_string = '';
        foreach ($postfields AS $k => $v) {
            $query_string .= $k . '=' . urlencode($v) . '&';
        }
        if (function_exists('curl_exec')) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $whmcsurl . $verifyfilepath);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $data = curl_exec($ch);
            $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
        } else {
            $responseCodePattern = '/^HTTP\/\d+\.\d+\s+(\d+)/';
            $fp = @fsockopen($whmcsurl, 80, $errno, $errstr, 5);
            if ($fp) {
                $newlinefeed = "\r\n";
                $header = "POST " . $whmcsurl . $verifyfilepath . " HTTP/1.0" . $newlinefeed;
                $header .= "Host: " . $whmcsurl . $newlinefeed;
                $header .= "Content-type: application/x-www-form-urlencoded" . $newlinefeed;
                $header .= "Content-length: " . @strlen($query_string) . $newlinefeed;
                $header .= "Connection: close" . $newlinefeed . $newlinefeed;
                $header .= $query_string;
                $data = $line = '';
                @stream_set_timeout($fp, 20);
                @fputs($fp, $header);
                $status = @socket_get_status($fp);
                while (!@feof($fp) && $status) {
                    $line = @fgets($fp, 1024);
                    $patternMatches = array();
                    if (!$responseCode && preg_match($responseCodePattern, trim($line), $patternMatches)) {
                        $responseCode = (empty($patternMatches[1])) ? 0 : $patternMatches[1];
                    }
                    $data .= $line;
                    $status = @socket_get_status($fp);
                }
                @fclose($fp);
            }
        }
        if ($responseCode != 200) {
            $localexpiry = date("Ymdhis", mktime(date("h"), date("i"), date("s"), date("m"), date("d") - ($localkeydays + $allowcheckfaildays), date("Y")));
            if ($originalcheckdate > $localexpiry) {
                $results = $localkeyresults;
            } else {
                $results = array();
                $results['status'] = "Invalid";
                $results['description'] = "Remote Check Failed";
                return $results;
            }
        } else {
            preg_match_all('/<(.*?)>([^<]+)<\/\\1>/i', $data, $matches);
            $results = array();
            foreach ($matches[1] AS $k => $v) {
                $results[$v] = $matches[2][$k];
            }
        }
        if (!is_array($results)) {
            die("Invalid License Server Response");
        }
        if ($results['md5hash']) {
            if ($results['md5hash'] != md5($licensing_secret_key . $check_token)) {
                $results['status'] = "Invalid";
                $results['description'] = "MD5 Checksum Verification Failed";
                return $results;
            }
        }
        if ($results['status'] == "Active") {
            $results['checkdate'] = $checkdate;
            $data_encoded = serialize($results);
            $data_encoded = base64_encode($data_encoded);
            $data_encoded = md5($checkdate . $licensing_secret_key) . $data_encoded;
            $data_encoded = strrev($data_encoded);
            $data_encoded = $data_encoded . md5($data_encoded . $licensing_secret_key);
            $data_encoded = wordwrap($data_encoded, 80, "\n", true);
            $results['localkey'] = $data_encoded;
        }
        $results['remotecheck'] = true;
    }
    unset($postfields, $data, $matches, $whmcsurl, $licensing_secret_key, $checkdate, $usersip, $localkeydays, $allowcheckfaildays, $md5hash);
    return $results;
}

function vpnpanel_activate() {
    // Create custom tables and schema required by your module
    try {
        if (!Capsule::schema()->hasTable('mod_vpn_applinks')) {
            Capsule::schema()
                    ->create(
                            'mod_vpn_applinks', function ($table) {
                        /** @var \Illuminate\Database\Schema\Blueprint $table */
                        $table->increments('id');
                        $table->text('appname');
                        $table->text('applink');
                        $table->text('appfor');
                    }
            );
        }if (!Capsule::schema()->hasTable('mod_vpn_api')) {
            Capsule::schema()
                    ->create(
                            'mod_vpn_api', function ($table) {
                        /** @var \Illuminate\Database\Schema\Blueprint $table */
                        $table->increments('id');
                        $table->text('setting');
                        $table->text('value');
                    }
            );
        }if (!Capsule::schema()->hasTable('mod_vpn_assignpackages')) {
            Capsule::schema()
                    ->create(
                            'mod_vpn_assignpackages', function ($table) {
                        /** @var \Illuminate\Database\Schema\Blueprint $table */
                        $table->increments('id');
                        $table->text('resellerid');
                        $table->text('assigngroup');
                        $table->text('products');
                    }
            );
        }
        if (!Capsule::schema()->hasTable('mod_vpn_assignpackages_superresellers')) {
            Capsule::schema()
                    ->create(
                            'mod_vpn_assignpackages_superresellers', function ($table) {
                        /** @var \Illuminate\Database\Schema\Blueprint $table */
                        $table->increments('id');
                        $table->text('resellerid');
                        $table->text('assigngroup');
                        $table->text('products');
                    }
            );
        }if (!Capsule::schema()->hasTable('server_list')) {
            Capsule::schema()
                    ->create(
                            'server_list', function ($table) {
                        /** @var \Illuminate\Database\Schema\Blueprint $table */
                        $table->increments('server_id');
                        $table->string('server_name', 255);
                        $table->string('flag', 255);
                        $table->string('server_ip', 255);
                        $table->string('server_ipv4', 255);
                        $table->string('server_category', 255);
                        $table->integer('sshport');
                        $table->integer('server_port');
                        $table->integer('mainserver');
                        $table->string('sshpass', 255);
                        $table->integer('status');
                        $table->string('pskkey',190);
                        $table->string('max_connection',50);
                        $table->string('createdUploaded', 50);
                        $table->string('bandwidth_usage', 50);
                        $table->string('cpu', 50);
                        $table->string('disk', 50);
                        $table->string('memory', 50);
                        $table->string('uptime', 190);
                        $table->string('server_group', 30)->default('All');
                        $table->timestamp('created_at')->useCurrent();
                    }
            );
        }
        if (!Capsule::schema()->hasTable('lb_server_list')) {
            Capsule::schema()
                    ->create(
                            'lb_server_list', function ($table) {
                        /** @var \Illuminate\Database\Schema\Blueprint $table */
                        $table->increments('server_id');
                        $table->integer('relid');
                        $table->string('server_name', 255);
                        $table->string('flag', 255);
                        $table->string('server_ip', 255);
                        $table->string('server_ipv4', 255);
                        $table->string('server_category', 255);
                        $table->integer('sshport');
                        $table->integer('server_port');
                        $table->string('sshpass', 255);
                        $table->integer('status');
                        $table->string('createdUploaded', 255);
                        $table->string('max_connection',255);
                        $table->string('pskkey',255);
                        $table->timestamp('created_at')->useCurrent();
                    }
            );
        }if (!Capsule::schema()->hasTable('vpnmaxconnections')) {
            Capsule::schema()
                    ->create(
                            'vpnmaxconnections', function ($table) {
                        /** @var \Illuminate\Database\Schema\Blueprint $table */
                        $table->increments('id');
                        $table->string('userid', 255);
                        $table->string('connection', 255);
                        $table->string('macAddress', 255);
                    }
            );
        }

        if (!Capsule::schema()->hasTable('mod_clients_cert')) {
            Capsule::schema()
                    ->create(
                            'mod_clients_cert', function ($table) {
                        /** @var \Illuminate\Database\Schema\Blueprint $table */
                        $table->increments('id');
                        $table->string('filename', 255);
                        $table->string('clientid', 255)->default('0');
                        $table->string('serviceid', 255)->default('0');
                        $table->longText('content');
                        $table->string('server_ip', 255);
                        $table->timestamp('created_at')->useCurrent();
                    }
            );
        }

        if (!Capsule::schema()->hasTable('mod_server_certs')) {
            Capsule::schema()
                    ->create(
                            'mod_server_certs', function ($table) {
                        /** @var \Illuminate\Database\Schema\Blueprint $table */
                        $table->increments('id');
                        $table->string('filename', 255);
                        $table->string('server_ip', 255);
                        $table->longText('content');
                        $table->timestamp('created_at')->useCurrent();
                    }
            );
        }

        if (!Capsule::schema()->hasTable('mod_vpn_serverconfig')) {
            Capsule::schema()
                    ->create(
                            'mod_vpn_serverconfig', function ($table) {
                        /** @var \Illuminate\Database\Schema\Blueprint $table */
                        $table->string('setting', 255);
                        $table->string('value', 255);
                    }
            );
            Capsule::table('mod_vpn_serverconfig')->insert([
                ['setting' => 'token', 'value' => "7cf0ed77a6c9a8388d21e43e760baba07ad86d61"],
                ['setting' => 'ipv6', 'value' => "n|No"],
                ['setting' => 'port', 'value' => "1|1194"],
                ['setting' => 'customport', 'value' => ""],
                ['setting' => 'protocol', 'value' => "udp|UDP"],
                ['setting' => 'dns', 'value' => "3|Cloudflare (Anycast: worldwide)"],
                ['setting' => 'dns1', 'value' => ""],
                ['setting' => 'dns2', 'value' => ""],
                ['setting' => 'saveconfig', 'value' => "Save Changes"],
            ]);


        }

        if (!Capsule::schema()->hasTable('mod_vpn_settings')) {
            Capsule::schema()
                    ->create(
                            'mod_vpn_settings', function ($table) {
                        /** @var \Illuminate\Database\Schema\Blueprint $table */
                        $table->increments('id');
                        $table->string('settings', 255);
                        $table->string('value', 255);
                    }
            );
        }
        if (!Capsule::schema()->hasTable('mod_vpn_groups')) {
            Capsule::schema()
                    ->create(
                            'mod_vpn_groups', function ($table) {
                        /** @var \Illuminate\Database\Schema\Blueprint $table */
                        $table->increments('id');
                        $table->string('groupName', 255);
                    }
            );
        }
        if (!Capsule::schema()->hasTable('vpnmywebsite')) {
            Capsule::schema()
                    ->create(
                            'vpnmywebsite', function ($table) {
                        /** @var \Illuminate\Database\Schema\Blueprint $table */
                        $table->increments('id');
                        $table->string('uid');
                        $table->string('logo');
                        $table->string('companyName');
                        $table->string('tagline');
                        $table->string('domainURL');
                        $table->string('tandc');
                        $table->string('privacy');
                        $table->string('websiteURL');
                        $table->string('headColor');
                        $table->string('textColor');
                        $table->string('products');
                        $table->string('gateways');
                        $table->string('status');
                        $table->string('sep_vpn_panel');
                        $table->string('sepvpn_panel_status');
                    }
            );
        }
        if (!Capsule::schema()->hasTable('tblvpnpaymentgateways')) {
        Capsule::schema()->create(
                    'tblvpnpaymentgateways', function ($table) {
                $table->string('uid');
                $table->text('gateway');
                $table->text('setting');
                $table->text('value');
                $table->integer('order');
            });
        }
        if (!Capsule::schema()->hasTable('vpnpackageprice')) {
            Capsule::schema()->create(
                    'vpnpackageprice', function ($table) {
                $table->increments('id');
                $table->string('uid');
                $table->string('products');
                $table->string('priceMonthly');
                $table->string('priceQuarterly');
                $table->string('priceSemiannually');
                $table->string('priceAnnually');
                $table->string('priceBiennially');
                $table->string('priceTriennially');
            }
            );
        }

        


        if (!Capsule::schema()->hasTable('radacct')) {
            Capsule::statement("CREATE TABLE radacct (
  radacctid bigint(21) NOT NULL auto_increment,
  acctsessionid varchar(64) NOT NULL default '',
  acctuniqueid varchar(32) NOT NULL default '',
  username varchar(64) NOT NULL default '',
  realm varchar(64) default '',
  nasipaddress varchar(15) NOT NULL default '',
  nasportid varchar(15) default NULL,
  nasporttype varchar(32) default NULL,
  acctstarttime datetime NULL default NULL,
  acctupdatetime datetime NULL default NULL,
  acctstoptime datetime NULL default NULL,
  acctinterval int(12) default NULL,
  acctsessiontime int(12) unsigned default NULL,
  acctauthentic varchar(32) default NULL,
  connectinfo_start varchar(50) default NULL,
  connectinfo_stop varchar(50) default NULL,
  acctinputoctets bigint(20) default NULL,
  acctoutputoctets bigint(20) default NULL,
  calledstationid varchar(50) NOT NULL default '',
  callingstationid varchar(50) NOT NULL default '',
  acctterminatecause varchar(32) NOT NULL default '',
  servicetype varchar(32) default NULL,
  framedprotocol varchar(32) default NULL,
  framedipaddress varchar(15) NOT NULL default '',
  framedipv6address varchar(15) NOT NULL default '',
  framedipv6prefix varchar(15) NOT NULL default '',
  framedinterfaceid varchar(32) NOT NULL default '',
  delegatedipv6prefix varchar(32) NOT NULL default '',
  PRIMARY KEY (radacctid),
  UNIQUE KEY acctuniqueid (acctuniqueid),
  KEY username (username),
  KEY framedipaddress (framedipaddress),
  KEY acctsessionid (acctsessionid),
  KEY acctsessiontime (acctsessiontime),
  KEY acctstarttime (acctstarttime),
  KEY acctinterval (acctinterval),
  KEY acctstoptime (acctstoptime),
  KEY nasipaddress (nasipaddress)
) ENGINE = INNODB;");
        }
if (!Capsule::schema()->hasTable('radcheck')) {
            Capsule::statement("CREATE TABLE radcheck (
  id int(11) unsigned NOT NULL auto_increment,
  username varchar(64) NOT NULL default '',
  attribute varchar(64)  NOT NULL default '',
  op char(2) NOT NULL DEFAULT '==',
  value varchar(253) NOT NULL default '',
  PRIMARY KEY  (id),
  KEY username (username(32))
);");
        }

if (!Capsule::schema()->hasTable('radgroupcheck')) {
            Capsule::statement("CREATE TABLE radgroupcheck (
  id int(11) unsigned NOT NULL auto_increment,
  groupname varchar(64) NOT NULL default '',
  attribute varchar(64)  NOT NULL default '',
  op char(2) NOT NULL DEFAULT '==',
  value varchar(253)  NOT NULL default '',
  PRIMARY KEY  (id),
  KEY groupname (groupname(32))
);");
        }
        if (!Capsule::schema()->hasTable('radgroupreply')) {
            Capsule::statement("CREATE TABLE radgroupreply (
  id int(11) unsigned NOT NULL auto_increment,
  groupname varchar(64) NOT NULL default '',
  attribute varchar(64)  NOT NULL default '',
  op char(2) NOT NULL DEFAULT '=',
  value varchar(253)  NOT NULL default '',
  PRIMARY KEY  (id),
  KEY groupname (groupname(32))
);");
        }
        if (!Capsule::schema()->hasTable('radreply')) {
            Capsule::statement("CREATE TABLE radreply (
  id int(11) unsigned NOT NULL auto_increment,
  username varchar(64) NOT NULL default '',
  attribute varchar(64) NOT NULL default '',
  op char(2) NOT NULL DEFAULT '=',
  value varchar(253) NOT NULL default '',
  PRIMARY KEY  (id),
  KEY username (username(32))
);");
        }
        if (!Capsule::schema()->hasTable('radusergroup')) {
            Capsule::statement("CREATE TABLE radusergroup (
  username varchar(64) NOT NULL default '',
  groupname varchar(64) NOT NULL default '',
  priority int(11) NOT NULL default '1',
  KEY username (username(32))
);");
        }

        if (!Capsule::schema()->hasTable('radpostauth')) {
            Capsule::statement("CREATE TABLE radpostauth (
  id int(11) NOT NULL auto_increment,
  username varchar(64) NOT NULL default '',
  pass varchar(64) NOT NULL default '',
  reply varchar(32) NOT NULL default '',
  authdate timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY  (id)
) ENGINE = INNODB;");
        }

        if (!Capsule::schema()->hasTable('nas')) {
            Capsule::statement("CREATE TABLE nas (
  id int(10) NOT NULL auto_increment,
  nasname varchar(128) NOT NULL,
  shortname varchar(32),
  type varchar(30) DEFAULT 'other',
  ports int(5),
  secret varchar(60) DEFAULT 'secret' NOT NULL,
  server varchar(64),
  community varchar(50),
  description varchar(200) DEFAULT 'RADIUS Client',
  PRIMARY KEY (id),
  KEY nasname (nasname)
);");
        }

        


        return [
            // Supported values here include: success, error or info
            'status' => 'success',
            'description' => 'Smart VPN Billing Panel to manage VPN Servers, VPN Clients, VPN Reseller, VPN Package automatically.',
        ];
    } catch (\Exception $e) {
        return [
            // Supported values here include: success, error or info
            'status' => "error",
            'description' => 'Unable to activate module: ' . $e->getMessage(),
        ];
    }
}

function vpnpanel_deactivate() {
    $results = Capsule::table('tbladdonmodules')->where('module', '=', 'vpnpanel')->get();
    foreach ($results as $row) {
        $settings[$row->setting] = $row->value;
    }
    if (isset($settings['deletetables']) && !empty($settings['deletetables'])) {
        if ($settings['deletetables'] == 'on') {
            Capsule::schema()
                    ->dropIfExists('mod_vpn_applinks');
            Capsule::schema()
                    ->dropIfExists('mod_vpn_assignpackages');
            Capsule::schema()
                    ->dropIfExists('mod_vpn_assignpackages_superresellers');       
            Capsule::schema()
                    ->dropIfExists('server_list');
            Capsule::schema()
                    ->dropIfExists('lb_server_list');
            Capsule::schema()
                    ->dropIfExists('vpnmaxconnections');
            Capsule::schema()
                    ->dropIfExists('mod_clients_cert');
            Capsule::schema()
                    ->dropIfExists('mod_server_certs');
            /*Capsule::schema()
                    ->dropIfExists('mod_vpn_serverconfig');*/
        }
    }
    return array(
        'status' => 'success', // Supported values here include: success, error or info
        'description' => ' VPN Dashboard modules deactivated successfully!',
    );
}

function vpnpanel_output($vars) {
    $checklicense = vpnpanel_doCheckLicense();
    if ($checklicense["status"] != "Active" && $_REQUEST['action'] != 'vpn_servers') {
        echo ' 
<div class="alert alert-danger" role="alert">
  <h4 class="alert-heading">Your license is expired or Invalid!</h4>
  <p>For more Infomation <a target="_blank" href="https://www.whmcssmarters.com/clients/index.php?rp=/knowledgebase/149/Issues---License-Expired-Service-Suspended-or-disabled.html" class="alert-link">click here</a></p>
  <hr>
  <p class="mb-0"><a target="_blank" href="configaddonmods.php" class="alert-link">Here you can check your licnese key status</a> (Setup > Addon Modules > VPN Panel )</p>
</div>';
    }
    if (getapi() == '') {
        echo ' 
 <div class="alert alert-danger" role="alert">
    <h4 class="alert-heading">Warning!</h4> 
    <p>Your API Key is not found, Please generate your API Key <a class="alert-link" href="addonmodules.php?module=vpnpanel&action=vpn_api">here</a></p> 
</div>';
    }
    // Get common module parameters
    $modulelink = $vars['modulelink'];
    $version = $vars['version'];
    $_lang = $vars['_lang'];
    $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
    $dispatcher = new AdminDispatcher();
    $response = $dispatcher->dispatch($action, $vars);
    echo $response;
}

function vpnpanel_clientarea($vars) {
    // Get common module parameters
    $modulelink = $vars['modulelink']; // eg. index.php?m=addonmodule
    $version = $vars['version']; // eg. 1.0
    $_lang = $vars['_lang']; // an array of the currently loaded language variables
    // Get module configuration parameters
    $configTextField = $vars['Text Field Name'];
    $configPasswordField = $vars['Password Field Name'];
    $configCheckboxField = $vars['Checkbox Field Name'];
    $configDropdownField = $vars['Dropdown Field Name'];
    $configRadioField = $vars['Radio Field Name'];
    $configTextareaField = $vars['Textarea Field Name'];

    /**
     * Dispatch and handle request here. What follows is a demonstration of one
     * possible way of handling this using a very basic dispatcher implementation.
     */
    $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
    $clientgroip = Capsule::table('tblclients')->where('id', '=', $_SESSION['uid'])->get();
    $clientgroup = Capsule::table('tblclientgroups')->where('id', '=', $clientgroip[0]->groupid)->get();
    if ($clientgroup[0]->groupname == 'Reseller') {
        $group['checkgroup'] = 'reseller';
    } elseif ($clientgroup[0]->groupname == 'Super-Reseller') {
        $group['checkgroup'] = 'superreseller';
    }
 //$zip = new ZipArchive;
    $dispatcher = new ClientDispatcher();
   $response = $dispatcher->dispatch($action, $vars/*, $zip*/);
    $affdetails = $dispatcher->dispatch('CheckAffCredit', $vars/*, $zip*/);
    $group['totalcredit'] = $affdetails->credit;
    $response['vars'] = array_merge($response['vars'], $group);
    return $response;
}


function vpnpanel_upgrade($vars)
{
    $currentlyInstalledVersion = $vars['version'];
    // Perform SQL schema changes required by the upgrade to version 1.1 of your module
//     if($currentlyInstalledVersion < 2.2)
//         {
// if (Capsule::schema()->hasTable('mod_server_certs')) {
//                 Capsule::statement('ALTER TABLE mod_server_certs ADD server_ip VARCHAR(255) NOT NULL');
//             }
// Capsule::statement('ALTER TABLE server_list CHANGE server_category server_category VARCHAR(255) NOT NULL');

//         if (!Capsule::schema()->hasTable('radacct')) {
//             Capsule::statement("CREATE TABLE radacct (
//   radacctid bigint(21) NOT NULL auto_increment,
//   acctsessionid varchar(64) NOT NULL default '',
//   acctuniqueid varchar(32) NOT NULL default '',
//   username varchar(64) NOT NULL default '',
//   realm varchar(64) default '',
//   nasipaddress varchar(15) NOT NULL default '',
//   nasportid varchar(15) default NULL,
//   nasporttype varchar(32) default NULL,
//   acctstarttime datetime NULL default NULL,
//   acctupdatetime datetime NULL default NULL,
//   acctstoptime datetime NULL default NULL,
//   acctinterval int(12) default NULL,
//   acctsessiontime int(12) unsigned default NULL,
//   acctauthentic varchar(32) default NULL,
//   connectinfo_start varchar(50) default NULL,
//   connectinfo_stop varchar(50) default NULL,
//   acctinputoctets bigint(20) default NULL,
//   acctoutputoctets bigint(20) default NULL,
//   calledstationid varchar(50) NOT NULL default '',
//   callingstationid varchar(50) NOT NULL default '',
//   acctterminatecause varchar(32) NOT NULL default '',
//   servicetype varchar(32) default NULL,
//   framedprotocol varchar(32) default NULL,
//   framedipaddress varchar(15) NOT NULL default '',
//   PRIMARY KEY (radacctid),
//   UNIQUE KEY acctuniqueid (acctuniqueid),
//   KEY username (username),
//   KEY framedipaddress (framedipaddress),
//   KEY acctsessionid (acctsessionid),
//   KEY acctsessiontime (acctsessiontime),
//   KEY acctstarttime (acctstarttime),
//   KEY acctinterval (acctinterval),
//   KEY acctstoptime (acctstoptime),
//   KEY nasipaddress (nasipaddress)
// ) ENGINE = INNODB;");
//         }
// if (!Capsule::schema()->hasTable('radcheck')) {
//             Capsule::statement("CREATE TABLE radcheck (
//   id int(11) unsigned NOT NULL auto_increment,
//   username varchar(64) NOT NULL default '',
//   attribute varchar(64)  NOT NULL default '',
//   op char(2) NOT NULL DEFAULT '==',
//   value varchar(253) NOT NULL default '',
//   PRIMARY KEY  (id),
//   KEY username (username(32))
// );");
//         }

// if (!Capsule::schema()->hasTable('radgroupcheck')) {
//             Capsule::statement("CREATE TABLE radgroupcheck (
//   id int(11) unsigned NOT NULL auto_increment,
//   groupname varchar(64) NOT NULL default '',
//   attribute varchar(64)  NOT NULL default '',
//   op char(2) NOT NULL DEFAULT '==',
//   value varchar(253)  NOT NULL default '',
//   PRIMARY KEY  (id),
//   KEY groupname (groupname(32))
// );");
//         }
//         if (!Capsule::schema()->hasTable('radgroupreply')) {
//             Capsule::statement("CREATE TABLE radgroupreply (
//   id int(11) unsigned NOT NULL auto_increment,
//   groupname varchar(64) NOT NULL default '',
//   attribute varchar(64)  NOT NULL default '',
//   op char(2) NOT NULL DEFAULT '=',
//   value varchar(253)  NOT NULL default '',
//   PRIMARY KEY  (id),
//   KEY groupname (groupname(32))
// );");
//         }
//         if (!Capsule::schema()->hasTable('radreply')) {
//             Capsule::statement("CREATE TABLE radreply (
//   id int(11) unsigned NOT NULL auto_increment,
//   username varchar(64) NOT NULL default '',
//   attribute varchar(64) NOT NULL default '',
//   op char(2) NOT NULL DEFAULT '=',
//   value varchar(253) NOT NULL default '',
//   PRIMARY KEY  (id),
//   KEY username (username(32))
// );");
//         }
//         if (!Capsule::schema()->hasTable('radusergroup')) {
//             Capsule::statement("CREATE TABLE radusergroup (
//   username varchar(64) NOT NULL default '',
//   groupname varchar(64) NOT NULL default '',
//   priority int(11) NOT NULL default '1',
//   KEY username (username(32))
// );");
//         }

//         if (!Capsule::schema()->hasTable('radpostauth')) {
//             Capsule::statement("CREATE TABLE radpostauth (
//   id int(11) NOT NULL auto_increment,
//   username varchar(64) NOT NULL default '',
//   pass varchar(64) NOT NULL default '',
//   reply varchar(32) NOT NULL default '',
//   authdate timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
//   PRIMARY KEY  (id)
// ) ENGINE = INNODB;");
//         }

//         if (!Capsule::schema()->hasTable('nas')) {
//             Capsule::statement("CREATE TABLE nas (
//   id int(10) NOT NULL auto_increment,
//   nasname varchar(128) NOT NULL,
//   shortname varchar(32),
//   type varchar(30) DEFAULT 'other',
//   ports int(5),
//   secret varchar(60) DEFAULT 'secret' NOT NULL,
//   server varchar(64),
//   community varchar(50),
//   description varchar(200) DEFAULT 'RADIUS Client',
//   PRIMARY KEY (id),
//   KEY nasname (nasname)
// );");
//         }
//         }

//         if($currentlyInstalledVersion < 2.3)
//         {
//             Capsule::statement('ALTER TABLE server_list CHANGE server_category server_category VARCHAR(255) NOT NULL');
            
//         }

//         if($currentlyInstalledVersion < 2.4)
//         {
//             // if (Capsule::schema()->hasTable('server_list')) {
//             //     Capsule::statement('ALTER TABLE server_list ADD server_group VARCHAR(30) NOT NULL DEFAULT "All"');
//             // }
//             if (!Capsule::schema()->hasTable('mod_vpn_groups')) {
//             Capsule::schema()
//                     ->create(
//                             'mod_vpn_groups', function ($table) {
//                         /** @var \Illuminate\Database\Schema\Blueprint $table */
//                         $table->increments('id');
//                         $table->string('groupName', 255);
//                     }
//             );
//         }
//             if (!Capsule::schema()->hasTable('mod_vpn_settings')) {
//             Capsule::schema()
//                     ->create(
//                             'mod_vpn_settings', function ($table) {
//                         /** @var \Illuminate\Database\Schema\Blueprint $table */
//                         $table->increments('id');
//                         $table->string('settings', 255);
//                         $table->string('value', 255);
//                     }
//             );
//         }
//         }
// if($currentlyInstalledVersion < 2.7)
//         {
//             if (!Capsule::schema()->hasTable('vpnmywebsite')) {
//             Capsule::schema()
//                     ->create(
//                             'vpnmywebsite', function ($table) {
//                         /** @var \Illuminate\Database\Schema\Blueprint $table */
//                         $table->increments('id');
//                         $table->string('uid');
//                         $table->string('logo');
//                         $table->string('companyName');
//                         $table->string('tagline');
//                         $table->string('domainURL');
//                         $table->string('tandc');
//                         $table->string('privacy');
//                         $table->string('websiteURL');
//                         $table->string('headColor');
//                         $table->string('textColor');
//                         $table->string('products');
//                         $table->string('gateways');
//                         $table->string('status');
//                         $table->string('sep_vpn_panel');
//                         $table->string('sepvpn_panel_status');
//                     }
//             );
//         }
//         else
//         {
//             if (Capsule::schema()->hasTable('vpnmywebsite')) {
//                 Capsule::schema()->table('vpnmywebsite', function ($table) {
//                   if (!Capsule::schema()->hasColumn('vpnmywebsite', 'sep_vpn_panel')) {
//                 $table->timestamp('sep_vpn_panel');
//                   } 
//                   if (!Capsule::schema()->hasColumn('vpnmywebsite', 'sepvpn_panel_status')) {
//                 $table->timestamp('sepvpn_panel_status');
//                   } 
//                 });
//             }
//         }
//         if (!Capsule::schema()->hasTable('tblvpnpaymentgateways')) {
//             Capsule::schema()->create(
//                     'tblvpnpaymentgateways', function ($table) {
//                 $table->string('uid');
//                 $table->text('gateway');
//                 $table->text('setting');
//                 $table->text('value');
//                 $table->integer('order');
//             }
//             );
//         }
//         if (!Capsule::schema()->hasTable('vpnDomainVerify')) {
//             Capsule::schema()->create(
//                     'vpnDomainVerify', function ($table) {
//                 $table->increments('id');
//                 $table->string('uid');
//                 $table->string('verifyCode');
//                 $table->string('status');
//             }
//             );
//         }
//         if (!Capsule::schema()->hasTable('vpnpackageprice')) {
//             Capsule::schema()->create(
//                     'vpnpackageprice', function ($table) {
//                 $table->increments('id');
//                 $table->string('uid');
//                 $table->string('products');
//                 $table->string('priceMonthly');
//                 $table->string('priceQuarterly');
//                 $table->string('priceSemiannually');
//                 $table->string('priceAnnually');
//                 $table->string('priceBiennially');
//                 $table->string('priceTriennially');
//             }
//             );
//         }

//         if (!Capsule::schema()->hasTable('mod_vpn_assignpackages_superresellers')) {
//             Capsule::schema()
//                     ->create(
//                             'mod_vpn_assignpackages_superresellers', function ($table) {
//                         /** @var \Illuminate\Database\Schema\Blueprint $table */
//                         $table->increments('id');
//                         $table->text('resellerid');
//                         $table->text('assigngroup');
//                         $table->text('products');
//                     }
//             );
//         }



//     }
//     if($currentlyInstalledVersion < 2.8)
//         {

//     // if (Capsule::schema()->hasTable('server_list')) {
//     //         Capsule::statement('ALTER TABLE server_list ADD max_connection VARCHAR(30) NOT NULL DEFAULT "0"');
//     //     }
        
//     // if (Capsule::schema()->hasTable('lb_server_list')) {
//     //         Capsule::statement('ALTER TABLE lb_server_list ADD max_connection VARCHAR(30) NOT NULL DEFAULT "0"');
//     //     }

        

//     }
//     if($currentlyInstalledVersion <= 2.9)
//         {
//             /*if(Capsule::schema()->hasTable('radacct'))
//         {
//             Capsule::statement("ALTER TABLE radacct ADD framedipv6address varchar(15) NOT NULL default ''");
//             Capsule::statement("ALTER TABLE radacct ADD framedipv6prefix varchar(15) NOT NULL default ''");
//             Capsule::statement("ALTER TABLE radacct ADD framedinterfaceid varchar(32) NOT NULL default ''");
//             Capsule::statement("ALTER TABLE radacct ADD delegatedipv6prefix varchar(32) NOT NULL default ''");
//         }*/
//         if (!Capsule::schema()->hasTable('tblvpnpaymentgateways')) {
//         Capsule::schema()->create(
//                     'tblvpnpaymentgateways', function ($table) {
//                 $table->string('uid');
//                 $table->text('gateway');
//                 $table->text('setting');
//                 $table->text('value');
//                 $table->integer('order');
//             });
//         }
//         if (!Capsule::schema()->hasTable('vpnpackageprice')) {
//             Capsule::schema()->create(
//                     'vpnpackageprice', function ($table) {
//                 $table->increments('id');
//                 $table->string('uid');
//                 $table->string('products');
//                 $table->string('priceMonthly');
//                 $table->string('priceQuarterly');
//                 $table->string('priceSemiannually');
//                 $table->string('priceAnnually');
//                 $table->string('priceBiennially');
//                 $table->string('priceTriennially');
//             }
//             );
//         }

//         }
        
        }
    
