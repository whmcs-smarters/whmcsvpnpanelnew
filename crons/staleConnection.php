<?php
include_once '/var/www/vhosts/smartersvpn.com/public/members/init.php';

use Illuminate\Database\Capsule\Manager as Capsule;
//    logActivity('Stale Connection Check');
    try {
        // $psql = "SELECT username, acctinterval FROM radacct WHERE acctstoptime IS NULL";
        $datas = Capsule::table('radacct')->select('username', 'acctinterval')->whereNull('acctstoptime')->get();
        // $count = mysqli_query($con, $psql);
       // print_r($datas);
        foreach ($datas as $key => $data) {
            $username = $data->username;
            $acctinterval = $data->acctinterval;
            if ($acctinterval != NULL) {

 //$psql = "UPDATE radacct SET acctstoptime=NOW(), acctterminatecause='User stale session cleared' WHERE acctstoptime IS NULL and acctupdatetime < DATE_SUB( NOW() , INTERVAL $acctinterval SECOND )";
                $resp = Capsule::table('radacct')->where('acctstoptime', '=', null)->where('acctupdatetime', '<', date('Y-m-d H:i:s', strtotime('-' . $acctinterval . ' seconds')))->update(['acctstoptime' => date('Y-m-d H:i:s'), 'acctterminatecause' => 'User stale session cleared']);
            // print_r($psql);
                logActivity("Stale session cleared for user: " . $username.' | Update Status - '.$resp);
            }
        }
    } catch (\Throwable $th) {
        logActivity("Stale session clearing failed: " . $th->getMessage());
    }

