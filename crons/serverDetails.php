<?php
include_once '/var/www/html/init.php';

use Illuminate\Database\Capsule\Manager as Capsule;
//logActivity('Initiate Server status cron', 0);
$checkserver = Capsule::table('server_list')->where('mainserver', 0)->count();
if ($checkserver > 0) {
    $servers = Capsule::table('server_list')->where('mainserver', 0)->get();
    
    foreach ($servers as $server) {

        try {
            $url = $server->server_ip . ":4545";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10); //timeout in seconds

            $result = curl_exec($ch);
            if ($result != "") {
                $resp = explode(',', $result);
                $cpu = isset($resp[0]) ? $resp[0] : '0%';
                $memory = isset($resp[1]) ? $resp[1] : '0%';
                $disk = isset($resp[2]) ? $resp[2] : '0%';
                $uptime = isset($resp[3]) ? $resp[3] : '0 days';
                $upload = isset($resp[4]) ? $resp[4] : '0';
                $download = isset($resp[5]) ? $resp[5] : '0';
                $total = isset($server->totald) ? $server->totald : '0';
                $downspeed = (isset($server->downspeed) && $server->downspeed !== '0') ? str_replace('Download:', '', $server->downspeed) : '0';
                $upspeed = (isset($server->upspeed) && $server->upspeed !== '0') ? str_replace('Upload:', '', $server->upspeed) : '0';
                $downloadVal = 0;
                $uploadVal = 0;
                if (str_contains($upload, 'Mbit/s')) {
                    $uploadexp = explode(' ', trim($upload));
                    $uploadVal = $uploadexp[0];
                } else if (str_contains($upload, 'kbit/s')) {
                    $uploadexp = explode(' ', trim($upload));
                    $uploadVal = $uploadexp[0];
                    $uploadVal = intval($uploadVal) / 1000;
                }
                if (str_contains($download, 'Mbit/s')) {
                    $downlaodexp = explode(' ', trim($download));
                    $downloadVal = $downlaodexp[0];
                } else if (str_contains($download, 'kbit/s')) {
                    $downlaodexp = explode(' ', trim($download));
                    $downloadVal = $downlaodexp[0];
                    $downloadVal = intval($downloadVal) / 1000;
                }

                $downspeedVal = 0;

                if (str_contains($downspeed, 'Kbit/s')) {
                    $downspeedExp = explode(' ', trim($downspeed));
                    $downspeedVal = $downspeedExp[0] / 1000;
                } else {
                    $downspeedExp = explode(' ', trim($downspeed));
                    $downspeedVal = $downspeedExp[0];
                }
                //
                if ($downspeedVal > 0) {
                    $bandwidthusage = (intval($downloadVal) / intval($downspeedVal)) * 100;
                } else {
                    $bandwidthusage = 0;
                }

                $postdata = [
                    'cpu' => $cpu,
                    'memory' => $memory,
                    'disk' => $disk,
                    'uptime' => $uptime,
                    'upload' => $upload,
                    'download' => $download,
                    'totald' => $total,
                    'bandwidth_usage' => number_format($bandwidthusage, 2),
                ];
                Capsule::table('server_list')->where('server_id', $server->server_id)->update($postdata);
                //logActivity('Server '.$server->server_ip.' Updated', 0);
            }

            curl_close($ch);
        } catch (\Throwable $th) {
            echo $th->getMessage().' | '.$th->getLine().' | '.$th->getFile();
            //logActivity('Server '.$server->server_ip.' Error | '.$th->getMessage().'', 0);
        }
    }
}
