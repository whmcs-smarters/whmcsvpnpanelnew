<?php
include_once('../../init.php');

use Illuminate\Database\Capsule\Manager as Capsule;

if (isset($_POST['api']) && isset($_POST['ip']) && !empty($_POST['api']) && !empty($_POST['ip'])) {
    $a = $_POST['api'];
    $ip = $_POST['ip'];
    $serverIP = (!isset($_POST['VPNSERVERIP']))?$_POST['ip']:$_POST['VPNSERVERIP'];
    $speed1 = $_POST['speed1'];
    $speed2 = $_POST['speed2'];
    //update server ip in database
    $scount = Capsule::table('server_list')->where('server_ip', $serverIP)->count();
    if ($scount > 0) {
        $server = Capsule::table('server_list')->where('server_ip', $serverIP)->update(['server_ipv4' => $ip, 'downspeed' => $speed1, 'upspeed' => $speed2]);
    }
    else{
        $s1count = Capsule::table('server_list')->where('server_ip', $ip)->count();
        if ($s1count > 0) {
            $server = Capsule::table('server_list')->where('server_ip', $ip)->update(['server_ip' => $serverIP, 'server_ipv4' => $ip, 'downspeed' => $speed1, 'upspeed' => $speed2]);
        }
    }

    logModuleCall('VPN Panel', 'Server Status API', $_POST, 'API CallBack After Server Creation', '', '');

    $apiderails = Capsule::table('mod_vpn_api')->where('value', $a)->count();
    if ($apiderails == 0) {
        logActivity('**VPN Panel - Server status API Request - API Key Not identified.**', 0);
        logModuleCall('VPN Panel', 'API Key not identified ', $_POST, 'ERROR', '', '');
    } else {

        # Port Insertion in server list 
        //$serverPort = Capsule::table('mod_vpn_serverconfig')->where('setting', 'port')->get();
        //$serverportval = '1194';
        /*if ($serverPort[0]->value == '1|1194') {
            $serverportval = '1194';
        } else if ($serverPort[0]->value == '2|custom') {
            $customserverPort = Capsule::table('mod_vpn_serverconfig ')->where('setting', 'customport')->get();
            $serverportval = $customserverPort[0]->value;
        } else if ($serverPort[0]->value == '3') {
            $serverportval = rand(49152, 65535);
        } else {
            logModuleCall('VPN Panel', 'Port not identified ', 'Server Status', 'ERROR', '', '');
        }*/

        $serverPortcustom = Capsule::table('mod_vpn_serverconfig')->where('setting', 'customport')->get();
        //$serverPort = Capsule::table('mod_vpn_serverconfig')->where('setting', 'port')->get();
        $serverPort = (!empty($serverPortcustom[0]->value)) ? $serverPortcustom[0]->value : '1194';

        //echo $serverPort; die();
        $chacklb = Capsule::table('lb_server_list')->where('server_ip', $serverIP)->count();
        if ($chacklb >= 1) {
            $serevrsData = Capsule::table('lb_server_list')->where('server_ip', $serverIP)->get();
            $sshpass = decryptPass1($serevrsData[0]->sshpass);
            $server_ip = $serevrsData[0]->server_ip;
            $sshport = (isset($serevrsData[0]->sshport) && !empty($serevrsData[0]->sshport)) ? $serevrsData[0]->sshport : '22';
            $serverType = $_POST['v'];
            $mainserver = $serevrsData[0]->mainserver;
            $relid = $serevrsData[0]->relid;
            $copyfiles = copyfilestodb($server_ip, $sshport, $sshpass, $serverType, $serverIP);


            if ($copyfiles) {
                $update = Capsule::table('lb_server_list')->where('server_ip', $server_ip)->update(['status' => 1]);
                logModuleCall('VPN Panel', 'Status Update for Main Server', $server_ip, 'Server Status Updated - Marked', '', '');
                echo $update;
                exit;
            } else {
                logModuleCall('VPN Panel', 'Status Update for Main Server', $server_ip, 'Unable to copy files', '', '');
            }
        } else {
            $serevrsData = Capsule::table('server_list')->where('server_ip', $serverIP)->get();
            $sshpass = decryptPass1($serevrsData[0]->sshpass);
            $server_ip = $serevrsData[0]->server_ip;
            $sshport = (isset($serevrsData[0]->sshport) && !empty($serevrsData[0]->sshport)) ? $serevrsData[0]->sshport : '22';
            $serverType = $_POST['v'];
            $mainserver = $serevrsData[0]->mainserver;
            $copyfiles = copyfilestodb($server_ip, $sshport, $sshpass, $serverType, $serverIP);
            if ($copyfiles) {
                $update = Capsule::table('server_list')->where('server_ip', $server_ip)->update(['status' => 1, 'mainserver' => $mainserver, 'server_port' => $serverPort]);
                logModuleCall('VPN Panel', 'Status Update for Main Server', $server_ip . ', ' . $serverPort, 'Server Status Updated - Marked', '', '');
                echo $update;
                exit;
            }





            # Check if mod_server_certs data exist - Identification for First Server( main ServeR) or other servers ( LB/ Secondary srevers)
            /*$serevrFiles = Capsule::table('mod_clients_cert')->count();
        $checkmainserver = Capsule::table('server_list')->where('mainserver', '1')->count();
                
        if ($serevrFiles == 0) {
            $serevrsData = Capsule::table('server_list')->where('server_ip', $ip)->get();
            $random_psk = $serevrsData[0]->pskkey;
            logActivity('**VPN Panel - Server status API Request - API Callback After Server Creation.**',0);
            logModuleCall('VPN Panel', 'MAIN Server data #32', $serevrsData, 'API CallBack After Server Creation', '', '');
            # start coping file
            $sshpass = decryptPasscode($serevrsData[0]->sshpass);
            $server_ip = $serevrsData[0]->server_ip;
            $sshport = (isset($serevrsData[0]->sshport) && !empty($serevrsData[0]->sshport)) ? $serevrsData[0]->sshport : '22';
            $copyfiles = copyfilestodb($server_ip, $sshport, $sshpass);
            if ($copyfiles) {
                if($checkmainserver > 1)
                    {
                        
                $update = Capsule::table('server_list')->where('server_ip', $server_ip)->update(['status' => 1, 'server_port' => $serverportval]);
                logModuleCall('VPN Panel', 'Main Server Already set', $update, 'Main Server Already Marked', '', '');
            }
            else
            {$update = Capsule::table('server_list')->where('server_ip', $server_ip)->update(['status' => 1, 'server_port' => $serverportval,'mainserver' => 1]);
                logModuleCall('VPN Panel', 'Status Update for Main Server', $update, 'Main Server Status Updated - Marked', '', '');
            }
                
            }
            logModuleCall('VPN Panel', 'First Main Server Created', 'Inserted Successfully', 'API callback file', '', '');
            logActivity('**VPN Panel - Server status API Request - First Main Server Created ('.$server_ip.').**',0);
            $serevrInfo = Capsule::table('server_list')->where('server_ip',$_POST['ip'])->get();
        
            
            echo $update;
            exit;
        } else {
            #other servers ( LB/ Secondary srevers)
            #identify for the LB or Secondary server 
            # get main server data from database and copy to secondary server 

            $serevrsData = Capsule::table('server_list')->where('server_ip', $ip)->get();
            if ($serevrsData) {
                $sshpass = decryptPasscode($serevrsData[0]->sshpass);
                $server_ip = $serevrsData[0]->server_ip;
                $sshport = (isset($serevrsData[0]->sshport) && !empty($serevrsData[0]->sshport)) ? $serevrsData[0]->sshport : '22';
                $copyfiles = copyfilesfromdb($server_ip, $sshport, $sshpass);
                if ($copyfiles) {
                    $update = Capsule::table('server_list')->where('server_ip', $server_ip)->update(['status' => 1, 'server_port' => $serverportval]);
                    /*if($serevrsData[0]->server_category == 'openvpn_ipsec')
                    {
                        $ipsecInstall = runIPSEC($server_ip,$sshport,$sshpass,$serevrsData[0]->pskkey);
                        logActivity('**VPN Panel - Server status API Request - Installation Started for IPSEC/L2TP Server ('.$server_ip.').**',0);
                        logModuleCall('VPN Panel', 'Run IPSEC Install Function', $ipsecInstall, '', '', '');
                    }*
                }

            
                echo $update;
                exit;
            } else {
                $lbserevrsDataCount = Capsule::table('lb_server_list')->where('server_ip', $ip)->count(); #LB server management
                if ($lbserevrsDataCount) {
                    # It's lb server, now we need to copy date to this sserver from database
                    $serevrsData = Capsule::table('lb_server_list')->where('server_ip', $ip)->get();

                    $sshpass = decryptPasscode($serevrsData[0]->sshpass);
                    $server_ip = $serevrsData[0]->server_ip;
                    $sshport = (isset($serevrsData[0]->sshport) && !empty($serevrsData[0]->sshport)) ? $serevrsData[0]->sshport : '22';
                    $copyfiles = copyfilesfromdb($server_ip, $sshport, $sshpass);
                    if ($copyfiles) {
                        $update = Capsule::table('lb_server_list')->where('server_ip', $server_ip)->update(['status' => 1, 'server_port' => $serverportval]);
                        logActivity('**VPN Panel - Server status API Request - Server Status Updated from processing to Online ('.$server_ip.').**',0);
                        /*if($serevrsData[0]->server_category == 'openvpn_ipsec')
                        {
                            logActivity('**VPN Panel - Server status API Request - Installation Started for IPSEC/L2TP Server ('.$server_ip.').**',0);
                            $ipsecInstall = runIPSEC($server_ip,$sshport,$sshpass,$serevrsData[0]->pskkey);
                            logModuleCall('VPN Panel', 'Run IPSEC Install Function', $ipsecInstall, '', '', '');
                        }*
                    }
                    echo $update;
                    exit;
                }
            }
        }*/
            exit;
        }
    }
} else {
    logModuleCall('VPN Panel', 'Server Status API', 'No Response received', 'API CallBack After Server Creation', '', '');
}
function apirandompsk()
{
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 20; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass);
}
function copyfilestodb($server_ip, $sshport, $sshpass, $serverType, $orgIP)
{

    set_include_path(get_include_path() . PATH_SEPARATOR . 'phpseclib');
    require_once __DIR__ . '/../../modules/addons/vpnpanel/phpseclib/Crypt/RC4.php';
    require_once __DIR__ . '/../../modules/addons/vpnpanel/phpseclib/Crypt/Rijndael.php';
    require_once __DIR__ . '/../../modules/addons/vpnpanel/phpseclib/Crypt/Twofish.php';
    require_once __DIR__ . '/../../modules/addons/vpnpanel/phpseclib/Crypt/Blowfish.php';
    require_once __DIR__ . '/../../modules/addons/vpnpanel/phpseclib/Crypt/TripleDES.php';
    require_once __DIR__ . '/../../modules/addons/vpnpanel/phpseclib/Crypt/Random.php';
    require_once __DIR__ . '/../../modules/addons/vpnpanel/phpseclib/Crypt/Hash.php';
    require_once __DIR__ . '/../../modules/addons/vpnpanel/phpseclib/Math/BigInteger.php';
    require_once __DIR__ . '/../../modules/addons/vpnpanel/phpseclib/Net/SSH2.php';

    $ssh = new Net_SSH2($orgIP, $sshport);
    if (!$ssh->login('root', $sshpass)) {
        logModuleCall('VPN Panel', 'Unable to Login Main Server #96', $server_ip . $sshport . $sshpass, 'API CallBack After Server Creation', '', '');
        return 0;
    }

    /*---------------------------if openvpn or openvpn-ikev2-------------------------------------*/
    if ($serverType == 'openvpn' || $serverType == 'openvpn-ikev2') {
        $ssh->exec('service openvpn restart');
        $list = $ssh->exec("ls /etc/openvpn/ -p | grep -v /");
        $list = explode(PHP_EOL, $list);
        foreach ($list as $file) {
            $fileContent = $ssh->exec("cat /etc/openvpn/" . $file . "");
            if (!empty($file)) {
                Capsule::table('mod_server_certs')->insert(['filename' => $file, 'content' => $fileContent, 'server_ip' => $server_ip]);
            }
        }
        $ovpnfileContent = $ssh->exec("cat /root/client.ovpn"); # $homedir 
        Capsule::table('mod_server_certs')->where('server_ip', $server_ip)->where('filename', 'client.ovpn')->delete();
        $insert = Capsule::table('mod_server_certs')->insert(['filename' => 'client.ovpn', 'content' => $ovpnfileContent, 'server_ip' => $server_ip]);
        if ($serverType == 'openvpn-ikev2') {

            /*$listPrivate = $ssh->exec("ls /etc/ipsec.d/private/ -p | grep -v /");
     $list = explode(PHP_EOL, $listPrivate);
     foreach ($list as $file) {
        $fileContent = $ssh->exec("cat /etc/ipsec.d/private/" . $file . "");
        if (!empty($file)) {
            Capsule::table('mod_server_certs')->insert(['filename' => $file, 'content' => $fileContent, 'server_ip' => $server_ip]);
        }
    }

    $listCerts = $ssh->exec("ls /etc/ipsec.d/certs/ -p | grep -v /");
     $list = explode(PHP_EOL, $listCerts);
     foreach ($list as $file) {
        $fileContent = $ssh->exec("cat /etc/ipsec.d/certs/" . $file . "");
        if (!empty($file)) {
            Capsule::table('mod_server_certs')->insert(['filename' => $file, 'content' => $fileContent, 'server_ip' => $server_ip]);
        }
    }

                    $listCaCerts = $ssh->exec("ls /etc/ipsec.d/cacerts/ -p | grep -v /");
             $list = explode(PHP_EOL, $listCaCerts);
             foreach ($list as $file) {
                $fileContent = $ssh->exec("cat /etc/ipsec.d/cacerts/" . $file . "");
                if (!empty($file)) {
                    Capsule::table('mod_server_certs')->where('server_ip',$server_ip)->where('filename','ca-cert.pem')->delete();
                    Capsule::table('mod_server_certs')->insert(['filename' => 'ca-cert.pem','content' => $fileContent,'server_ip' => $server_ip]);
                }
            }
        }*/


            /*$ovpnfileContent = $ssh->exec("cat /root/client.ovpn"); # $homedir 
         Capsule::table('mod_server_certs')->where('server_ip',$server_ip)->where('filename','client.ovpn')->delete();
        $insert = Capsule::table('mod_server_certs')->insert(['filename' => 'client.ovpn', 'content' => $ovpnfileContent, 'server_ip' => $server_ip]);*/
            $ssh->exec('service openvpn restart');

            $pemfileContent = $ssh->exec("if [ -f /etc/ipsec.d/cacerts/ca-cert.pem ]; then cat /etc/ipsec.d/cacerts/ca-cert.pem; fi"); # $homedir 
            Capsule::table('mod_server_certs')->where('server_ip', $server_ip)->where('filename', 'ca-cert.pem')->delete();
            $insert = Capsule::table('mod_server_certs')->insert(['filename' => 'ca-cert.pem', 'content' => $pemfileContent, 'server_ip' => $server_ip]);
        }
    }
    /*---------------------------if openvpn or openvpn-ikev2-end-------------------------------------*/
    /*---------------------------if ikev2 or openvpn-ikev2-------------------------------------*/
    if ($serverType == 'ikev2' || $serverType == 'openvpn-ikev2') {

        if ($serverType == 'openvpn-ikev2') {
            $ssh->exec('service openvpn restart');
            $ovpnfileContent = $ssh->exec("cat /root/client.ovpn"); # $homedir 
            Capsule::table('mod_server_certs')->where('server_ip', $server_ip)->where('filename', 'client.ovpn')->delete();
            $insert = Capsule::table('mod_server_certs')->insert(['filename' => 'client.ovpn', 'content' => $ovpnfileContent, 'server_ip' => $server_ip]);
        }

        $listCaCerts = $ssh->exec("ls /etc/ipsec.d/cacerts/ -p | grep -v /");
        $list = explode(PHP_EOL, $listCaCerts);
        foreach ($list as $file) {
            $fileContent = $ssh->exec("if [ -f /etc/ipsec.d/cacerts/" . $file . " ]; then cat /etc/ipsec.d/cacerts/" . $file . "; fi");
            Capsule::table('mod_server_certs')->where('server_ip', $server_ip)->where('filename', 'ca-cert.pem')->delete();
            if (!empty($file) || !empty($fileContent)) {
                Capsule::table('mod_server_certs')->insert(['filename' => 'ca-cert.pem', 'content' => $fileContent, 'server_ip' => $server_ip]);
            }
        }
    }


    $mainServerData = Capsule::table('server_list')->where('mainserver', 1)->get();


    $ssh = new Net_SSH2($mainServerData[0]->server_ip, $mainServerData[0]->sshport);
    if (!$ssh->login('root', decryptPass1($mainServerData[0]->sshpass))) {
        logModuleCall('VPN Panel', 'Unable to Login Main Server #97', $mainServerData[0]->server_ip . $mainServerData[0]->sshport . $mainServerData[0]->sshpass, 'API CallBack After Server Creation', '', '');
        return 0;
    }

    $ssh->exec('sudo systemctl restart freeradius.service');


    /*---------------------------if ikev2 or openvpn-ikev2-end-------------------------------------*/
    /*$listPrivate = $ssh->exec("ls /etc/ipsec.d/private/ -p | grep -v /");
     $list = explode(PHP_EOL, $listPrivate);
     foreach ($list as $file) {
        $fileContent = $ssh->exec("cat /etc/ipsec.d/private/" . $file . "");
        if (!empty($file)) {
            Capsule::table('mod_server_certs')->insert(['filename' => $file, 'content' => $fileContent]);
        }
    }*/

    /* $listCerts = $ssh->exec("ls /etc/ipsec.d/certs/ -p | grep -v /");
     $list = explode(PHP_EOL, $listCerts);
     foreach ($list as $file) {
        $fileContent = $ssh->exec("cat /etc/ipsec.d/certs/" . $file . "");
        if (!empty($file)) {
            Capsule::table('mod_server_certs')->insert(['filename' => $file, 'content' => $fileContent]);
        }
    }*/


    return 1;
}

function copyfilesfromdb($server_ip, $sshport, $sshpass, $serverType, $relid)
{
    set_include_path(get_include_path() . PATH_SEPARATOR . 'phpseclib');
    require_once __DIR__ . '/../../modules/addons/vpnpanel/phpseclib/Crypt/RC4.php';
    require_once __DIR__ . '/../../modules/addons/vpnpanel/phpseclib/Crypt/Rijndael.php';
    require_once __DIR__ . '/../../modules/addons/vpnpanel/phpseclib/Crypt/Twofish.php';
    require_once __DIR__ . '/../../modules/addons/vpnpanel/phpseclib/Crypt/Blowfish.php';
    require_once __DIR__ . '/../../modules/addons/vpnpanel/phpseclib/Crypt/TripleDES.php';
    require_once __DIR__ . '/../../modules/addons/vpnpanel/phpseclib/Crypt/Random.php';
    require_once __DIR__ . '/../../modules/addons/vpnpanel/phpseclib/Crypt/Hash.php';
    require_once __DIR__ . '/../../modules/addons/vpnpanel/phpseclib/Math/BigInteger.php';
    require_once __DIR__ . '/../../modules/addons/vpnpanel/phpseclib/Net/SSH2.php';

    $ssh = new Net_SSH2($server_ip, $sshport);
    if (!$ssh->login('root', $sshpass)) {
        logModuleCall('VPN Panel', 'Unable to Login Server #90', $server_ip, 'API CallBack After Server Creation (Copy files)', '', '');
        return 0;
    }
    $serverData = Capsule::table('server_list')->where('server_id', $relid)->get();
    $relserverIP = $serverData[0]->server_ip;

    if ($serverType == 'openvpn' || $serverType == 'openvpn-ikev2') {

        $list = Capsule::table('mod_server_certs')->where('server_ip', $relserverIP)->get();
        foreach ($list as $file) {
            $filename = $file->filename;
            $ssh->exec("rm * -r /etc/openvpn/" . $filename . "");
            $filecontent = $file->content;
            $ssh->exec("rm /etc/openvpn/" . $filename . "");
            $logData = $ssh->exec("echo '" . $filecontent . "' >> /etc/openvpn/" . $filename . "");
            $log .= 'echo "' . $filecontent . '" >> /etc/openvpn/' . $filename . '';
        }
        if ($serverType == 'openvpn-ikev2') {/*

                $listPrivate = $ssh->exec("ls /etc/ipsec.d/private/ -p | grep -v /");
     $list = explode(PHP_EOL, $listPrivate);
     foreach ($list as $file) {
        $filename = $file;
           $filedata = Capsule::table('mod_server_certs')->where('server_ip',$relserverIP)->where('filename',$file)->get();
           $filecontent = $filedata[0]->content;
        $ssh->exec("rm /etc/ipsec.d/private/" . $filename . "");
        $logData = $ssh->exec("echo '" . $filecontent . "' >> /etc/ipsec.d/private/" . $filename . "");
        $log .= 'echo "' . $filecontent . '" >> /etc/ipsec.d/private/' . $filename . '';
    }

    $listCerts = $ssh->exec("ls /etc/ipsec.d/certs/ -p | grep -v /");
     $list = explode(PHP_EOL, $listCerts);
     foreach ($list as $file) {
        $filename = $file;
           $filedata = Capsule::table('mod_server_certs')->where('server_ip',$relserverIP)->where('filename',$file)->get();
           $filecontent = $filedata[0]->content;
        $ssh->exec("rm /etc/ipsec.d/certs/" . $filename . "");
        $logData = $ssh->exec("echo '" . $filecontent . "' >> /etc/ipsec.d/certs/" . $filename . "");
        $log .= 'echo "' . $filecontent . '" >> /etc/ipsec.d/certs/' . $filename . '';
    }

                    $listCaCerts = $ssh->exec("ls /etc/ipsec.d/cacerts/ -p | grep -v /");
             $list = explode(PHP_EOL, $listCaCerts);
             foreach ($list as $file) {
                $filename = $file;
           $filedata = Capsule::table('mod_server_certs')->where('server_ip',$relserverIP)->where('filename',$file)->get();
           $filecontent = $filedata[0]->content;
        $ssh->exec("rm /etc/ipsec.d/cacerts/" . $filename . "");
        $logData = $ssh->exec("echo '" . $filecontent . "' >> /etc/ipsec.d/cacerts/" . $filename . "");
        $log .= 'echo "' . $filecontent . '" >> /etc/ipsec.d/cacerts/' . $filename . '';
            }
        */
        }

        $file = 'client.ovpn';
        $filename = $file;
        $filedata = Capsule::table('mod_server_certs')->where('server_ip', $relserverIP)->where('filename', $file)->get();
        $filecontent = $filedata[0]->content;
        $ssh->exec("rm /root/" . $filename . "");
        $logData = $ssh->exec("echo '" . $filecontent . "' >> /root/" . $filename . "");
        $log .= 'echo "' . $filecontent . '" >> /root/' . $filename . '';
    }
    /*---------------------------if openvpn or openvpn-ikev2-end-------------------------------------*/
    /*---------------------------if ikev2 or openvpn-ikev2-------------------------------------*/
    if ($serverType == 'ikev2' || $serverType == 'openvpn-ikev2') {

        if ($serverType == 'openvpn-ikev2') {
            $ovpnfileContent = $ssh->exec("cat /root/client.ovpn"); # $homedir 
            Capsule::table('mod_server_certs')->where('server_ip', $server_ip)->where('filename', 'client.ovpn')->delete();
            $insert = Capsule::table('mod_server_certs')->insert(['filename' => 'client.ovpn', 'content' => $ovpnfileContent, 'server_ip' => $server_ip]);
        }
    }

    $mainServerData = Capsule::table('server_list')->where('mainserver', 1)->get();


    $ssh = new Net_SSH2($mainServerData[0]->server_ip, $mainServerData[0]->sshport);
    if (!$ssh->login('root', decryptPass1($mainServerData[0]->sshpass))) {
        logModuleCall('VPN Panel', 'Unable to Login Main Server #98', $mainServerData[0]->server_ip . $mainServerData[0]->sshport . $mainServerData[0]->sshpass, 'API CallBack After Server Creation', '', '');
        return 0;
    }

    $ssh->exec('sudo systemctl restart freeradius.service');

    /*---------------------------if openvpn or openvpn-ikev2-------------------------------------*/

    return 1;
}

function runIkev2($serverIP, $serversshport, $serverPass, $pskkey)
{
    set_include_path(get_include_path() . PATH_SEPARATOR . 'phpseclib');
    require_once __DIR__ . '/../../modules/addons/vpnpanel/phpseclib/Crypt/RC4.php';
    require_once __DIR__ . '/../../modules/addons/vpnpanel/phpseclib/Crypt/Rijndael.php';
    require_once __DIR__ . '/../../modules/addons/vpnpanel/phpseclib/Crypt/Twofish.php';
    require_once __DIR__ . '/../../modules/addons/vpnpanel/phpseclib/Crypt/Blowfish.php';
    require_once __DIR__ . '/../../modules/addons/vpnpanel/phpseclib/Crypt/TripleDES.php';
    require_once __DIR__ . '/../../modules/addons/vpnpanel/phpseclib/Crypt/Random.php';
    require_once __DIR__ . '/../../modules/addons/vpnpanel/phpseclib/Crypt/Hash.php';
    require_once __DIR__ . '/../../modules/addons/vpnpanel/phpseclib/Math/BigInteger.php';
    require_once __DIR__ . '/../../modules/addons/vpnpanel/phpseclib/Net/SSH2.php';
    $ssh = new Net_SSH2($serverIP, $serversshport);
    if (!$ssh->login('root', $serverPass)) {
        logModuleCall('VPN Panel', 'Unable to Login Main Server #99', $server_ip . $sshport . $sshpass, 'API CallBack After Server Creation', '', '');
        return 0;
    }

    logModuleCall('VPN Panel', 'Remove Server IPSEC File check', $serverIP, $checkfile, '', '');
    $serverconfigvars = "./vpnsetup.sh -k '" . $pskkey . "' ";
    $ssh->exec('curl -O https://raw.githubusercontent.com/amansmarters/setup-ipsec-vpn/master/vpnsetup.sh'); // get script file on server
    $ssh->exec('chmod +x vpnsetup.sh'); // set permission to script file
    $process = $ssh->exec("./vpnsetup.sh -k '" . $pskkey . "' > /dev/null 2>&1 &"); //> /dev/null 2>&1 &

    //    $process = $ssh->exec("./openvpn-install.sh -h '" . $systemURL . "' -a '" . $api . "' > /dev/null 2>&1 &");
    logModuleCall('VPN Panel', 'Install Server IPSEC', $serverIP, 'Server Installation Started', '', '');
    logModuleCall('VPN Panel', 'Server Config define vars', $serverIP, $serverconfigvars, '', '');
    return 1;
}

function decryptPass1($pass)
{
    $salt = 'TeFrg&65TY!23Olk(';
    $qDecoded = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($salt), base64_decode($pass), MCRYPT_MODE_CBC, md5(md5($salt))), "\0");
    return ($qDecoded);
}
