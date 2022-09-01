<?php

if (file_exists('../../../init.php')) {
    include_once '../../../init.php';
}

use Illuminate\Database\Capsule\Manager as DB;

if (!class_exists('OnePageCartClass')) {



    class OnePageCartClass {

        function __construct() {
            
        }

        static function GetAdminID() {



            try {



                $records = DB::table('tbladmins')->where("roleid", 1)->select("id")->get();



                return ['status' => 'success', 'records' => $records[0]->id];
            } catch (\Exception $e) {



                return ['status' => 'error', 'message' => "There is error while getting the record.Error :- {$e->getMessage()}"];
            }
        }

        static function getallCurrencies() {

            $adminid = self::GetAdminID();

            $adminuser = $adminid['records'];

            $command_getcurrencies = "getcurrencies";

            $allCurriencies_result = localAPI($command_getcurrencies, "", $adminuser);

            return $allCurriencies_result;
        }

        static function GetAddonsbyProductID($pid, $currency) {
            try {
                $records = DB::table('tbladdons')
                        ->join('tblpricing', 'tblpricing.relid', '=', 'tbladdons.id')
                        ->select('tbladdons.*', 'tblpricing.type', 'tblpricing.currency', 'tblpricing.relid', 'tblpricing.msetupfee', 'tblpricing.qsetupfee', 'tblpricing.ssetupfee', 'tblpricing.asetupfee', 'tblpricing.bsetupfee', 'tblpricing.tsetupfee', 'tblpricing.monthly', 'tblpricing.quarterly', 'tblpricing.semiannually', 'tblpricing.annually', 'tblpricing.biennially', 'tblpricing.triennially')
                        ->whereRaw('find_in_set(' . $pid . ',tbladdons.packages)')
                        ->groupBy('id')
                        ->where('tblpricing.currency', '=', $currency)
                        ->where('tblpricing.type', '=', 'addon')
                        ->get();

                $alladdons = json_decode(json_encode($records), TRUE); 
                return ['status' => 'success', 'records' => $alladdons];
            } catch (\Exception $e) {
                return ['status' => 'error', 'message' => "There is error while getting the record.Error :- {$e->getMessage()}"];
            }
        }

        static function GetAddonsbyID($addonid, $currency) {



            try {



                $records = DB::table('tbladdons')
                        ->join('tblpricing', 'tblpricing.relid', '=', 'tbladdons.id')
                        ->select('tbladdons.id', 'tbladdons.name', 'tbladdons.billingcycle AS paytype', 'tblpricing.monthly as price')
                        ->where('tblpricing.currency', '=', $currency)
                        ->where('tblpricing.type', '=', 'addon')
                        ->where('tbladdons.id', '=', $addonid)
                        ->get();





                $alladdons = json_decode(json_encode($records), TRUE);



                return ['status' => 'success', 'records' => $alladdons];
            } catch (\Exception $e) {



                return ['status' => 'error', 'message' => "There is error while getting the record.Error :- {$e->getMessage()}"];
            }
        }

        static function getCurrencies() {



            $adminid = self::GetAdminID();



            $adminuser = $adminid['records'];



            $command_getcurrencies = "getcurrencies";



            $allCurriencies_result = localAPI($command_getcurrencies, "", $adminuser);



            if ($allCurriencies_result['result'] == "success") {



                $currencyCode = $allCurriencies_result['currencies']['currency'][0]['code'];



                $currencyID = $allCurriencies_result['currencies']['currency'][0]['id'];



                $result = array("result" => "success", "currencycode" => $currencyCode, "currencyid" => $currencyID);



                return $result;
            } else {



                return $allCurriencies_result;
            }
        }

        static function DomainWhois($domain) {

            $adminid = self::GetAdminID();

            $adminuser = $adminid['records'];

            $command_getcurrencies = "DomainWhois";

            $postData = array(
                'domain' => $domain,
            );

            $whoisresult = localAPI($command_getcurrencies, $postData, $adminuser);

            return $whoisresult;
        }

        static function ValidateClient($email, $password) {
            //$adminid = self::GetAdminID();



            


            $validateclient = "ValidateLogin";



            $values["email"] = $email;



            $values["password2"] = $password;

            $validateclient_result = localAPI($validateclient, $values);

            if ($validateclient_result['result'] == "success") {

                $userid = $validateclient_result['userid'];
                $upw = $validateclient_result['passwordhash'];

                $result = array("result" => "success", "clientid" => $userid, "upw" => $upw);
                   
                return $result;
            } else {

                return $validateclient_result;
            }
            
        }

        static function checkClientEmailId($email) {

            try {

                $records = DB::table('tblclients')->where("email", $email)->count();

                if ($records >= 1) {

                    return TRUE;
                } else {

                    return FALSE;
                }
            } catch (\Exception $e) {

                return ['status' => 'error', 'message' => "There is error while getting the record.Error :- {$e->getMessage()}"];
            }
        }

        static function AddClient($params = array()) {



            $command = "addclient";



            $postfields["skipvalidation"] = true;







           // $adminid = self::GetAdminID();



            //$adminuser = $adminid['records'];



            $addclient = array_merge($postfields, $params);



            $addclient_results = localAPI($command, $addclient);



            /* $command = 'ValidateLogin';

              $postData = array(

              'email' => $params['email'],

              'password2' => $params['password2'],

              );

              $adminUsername = $adminid['records']; // Optional for WHMCS 7.2 and later



              $results = localAPI($command, $postData, $adminUsername); */



            return $addclient_results;
        }

        /* ------------addclient details in whmcs DB-------------------- */

        static function AddClientinaff($params = array()) {



            DB::table('tblaffiliatesaccounts')
                    ->insert(array(
                        'affiliateid' => self::getWHMCSaffidOP(),
                        'relid' => $params['clientid']
            ));

            $_SESSION['clientID'] = $params['clientid'];
        }

        public function getWHMCSaffidOP() {

            $command = 'getaffiliates';

            $adminuser = DB::table('tbladmins')
                    ->where('roleid', '=', 1)
                    ->get();

            $values['userid'] = $_SESSION['resellerid'];

            $affdetails = localAPI($command, $values, $adminuser[0]->username);

            if ($affdetails['result'] === 'success' && $affdetails['totalresults'] == 1) {

                $affdetails = $affdetails['affiliates']['affiliate'][0];
            }

            return $affdetails['id'];
        }

        static function Encrypt($data) {

            $postfields = array();

            $command = "EncryptPassword";

            $postfields["password2"] = $data;

            $adminid = self::GetAdminID();

            $adminuser = $adminid['records'];

            $Encrypt_results = localAPI($command, $postfields, $adminuser);

            if ($Encrypt_results['result'] == "success") {

                return $Encrypt_results['password'];
            }
        }

        static function Decrypt($data) {

            $postfields = array();

            $command = "DecryptPassword";

            $postfields["password2"] = $data;

            $adminid = self::GetAdminID();

            $adminuser = $adminid['records'];

            $Decrypt_results = localAPI($command, $postfields, $adminuser);

            if ($Decrypt_results['result'] == "success") {

                return $Decrypt_results['password'];
            }
        }

        static function GetClientsDetails($id) {



            $command = "getclientsdetails";



            $postfields["clientid"] = $id;



            



            //$getclientsdetails=array_merge($postfields,$params);



            $getclientsdetails_results = localAPI($command, $postfields);



            return $getclientsdetails_results;
        }
        
        static function getPriceOverride($reseller_id, $params)
        {
             $productprices = DB::table('vpnpackageprice')->where('uid',$reseller_id)->where('products', $params['pid'][0])->get();
            $billingcycle = $params['billingcycle'][0];
            
            $priceoverride = '';
            if($billingcycle == 'monthly')
            {
                $priceoverride = $productprices[0]->priceMonthly;
            }
            else if($billingcycle == 'quarterly')
            {
                $priceoverride = $productprices[0]->priceQuarterly;
            }
            else if($billingcycle == 'semiannually')
            {
                $priceoverride = $productprices[0]->priceSemiannually;
            }
            else if($billingcycle == 'annually')
            {
                $priceoverride = $productprices[0]->priceAnnually;
            }
            else if($billingcycle == 'biennially')
            {
                $priceoverride = $productprices[0]->priceBiennially;
            }
            else if($billingcycle == 'triennially')
            {
                $priceoverride = $productprices[0]->priceTriennially;
            }
            return $priceoverride;
        }

        static function AddOrder($params = array()) {



            $command = "addorder";
            
           

            $addorder_results = localAPI($command, $params);



            return $addorder_results;
        }

        static function AddInvoicePayment($params = array()) {



            $command = "addinvoicepayment";

            $addorder_results = localAPI($command, $params);



            return $addorder_results;
        }

        static function GetInvoice($invoiceid) {



            $command = "getinvoice";



            $params["invoiceid"] = $invoiceid;

            $getinvoice_results = localAPI($command, $params);



            return $getinvoice_results;
        }

        static function GetPaymentGatewaysDetails($gatewayname) {







            try {



                $records = DB::table('tblvpnpaymentgateways')->where("gateway", $gatewayname)->where("setting", "email")->select("value")->get();



                return ['status' => 'success', 'email' => $records[0]->value];
            } catch (\Exception $e) {



                return ['status' => 'error', 'message' => "There is error while getting the record.Error :- {$e->getMessage()}"];
            }
        }

        static function GetAnyPaymentGatewayDetails($gatewayname, $uid) {
            try {



                $records = DB::table('tblvpnpaymentgateways')->where("gateway", $gatewayname)->where("uid", $uid)->get();



                return ['status' => 'success', 'data' => $records];
            } catch (\Exception $e) {



                return ['status' => 'error', 'message' => "There is error while getting the record.Error :- {$e->getMessage()}"];
            }
        }

        static function getTLDList($currency_id, $type = "register") {







            //	$clientgroupid = (isset($_SESSION['uid']) ? get_query_val("tblclients", "groupid", array("id" => $_SESSION['uid'])) : "0");
//
//	if (!$clientgroupid) {



            $clientgroupid = 0;



//	}







            $checkfields = array("msetupfee", "qsetupfee", "ssetupfee", "asetupfee", "bsetupfee", "tsetupfee", "monthly", "quarterly", "semiannually", "annually", "biennially", "triennially");



            $extensions = array();



            $result = select_query("tbldomainpricing", "id,extension", "", "order", "ASC");







            while ($data = mysql_fetch_array($result)) {



                $id = $data['id'];



                $extension = $data['extension'];



                $wherequery = "";



                $pricinggroup = $clientgroupid;



                $data = get_query_vals("tblpricing", "", array("type" => "domainregister", "currency" => $currency_id, "relid" => $id, "tsetupfee" => $clientgroupid));







                if (!$data) {



                    $pricinggroup = "0";



                    $data = get_query_vals("tblpricing", "", array("type" => "domainregister", "currency" => $currency_id, "relid" => $id, "tsetupfee" => "0"));
                }







                $i = 0;







                if (is_array($data)) {



                    foreach ($data as $k => $v) {







                        if (is_integer($k) && 3 < $k) {



                            if (0 < $v) {



                                if ($checkfields[$i]) {



                                    $wherequery .= $checkfields[$i] . ">=0 OR ";
                                }
                            }

                            ++$i;



                            continue;
                        }
                    }
                }











                if ($wherequery) {



                    $result2 = select_query("tblpricing", "COUNT(*)", "type='domain" . $type . ("' AND currency='" . $currency_id . "' AND relid='" . $id . "' AND tsetupfee=" . $pricinggroup . " AND (") . substr($wherequery, 0, 0 - 4) . ")");



                    $data = mysql_fetch_array($result2);







                    if ($data[0]) {



                        $extensions[] = $extension;
                    }
                }
            }







            return $extensions;
        }

        static function getClientGatewayId($userid) {

            try {

                $records = DB::table('tblclients')->where("id", $userid)->select("gatewayid")->get();

                return ['status' => 'success', 'data' => $records];
            } catch (\Exception $e) {

                return ['status' => 'error', 'message' => "There is error while getting the record.Error :- {$e->getMessage()}"];
            }
        }

        static function getAddonModuleSettings($modulename) {

            try {



                $records = DB::table('tbladdonmodules')->where("module", $modulename)->get();

                $settings = array();

                if (isset($records[0]->module)) {

                    foreach ($records as $modulesettings) {

                        $settings[$modulesettings->setting] = $modulesettings->value;
                    }
                }



                return ['status' => 'success', 'data' => $settings];
            } catch (\Exception $e) {



                return ['status' => 'error', 'message' => "There is error while getting the record.Error :- {$e->getMessage()}"];
            }
        }

        static function getProductInfo($pid) {

            try {

                //$records = DB::table('tblproducts')->where("id", $pid)->get();

                $records = DB::table('vpnpackageprice')->where("products", $pid)->get();

                return ['status' => 'success', 'data' => $records];
            } catch (\Exception $e) {



                return ['status' => 'error', 'message' => "There is error while getting the record.Error :- {$e->getMessage()}"];
            }
        }

        static function getConfigOptions($pid, $values, $cycle, $currencyCode, $selectedoptions = array(), $accountid = "", $orderform = "") {

            global $CONFIG;

            global $_LANG;

            if ($cycle == "onetime") {

                $cycle = "monthly";
            }

            $configoptions = array();

            $cycle = strtolower(str_replace("-", "", $cycle));

            if ($cycle == "one time") {

                $cycle = "monthly";
            }

            if ($accountid) {

                $values = array();

                $result = select_query("tblhostingconfigoptions", "", array("relid" => $accountid));

                while ($data = mysql_fetch_array($result)) {

                    $configid = $data['configid'];

                    $result2 = select_query("tblproductconfigoptions", "", array("id" => $configid));

                    $data2 = mysql_fetch_array($result2);

                    $optiontype = $data2['optiontype'];

                    if ($optiontype == 3 || $optiontype == 4) {

                        $configoptionvalue = $data['qty'];
                    } else {

                        $configoptionvalue = $data['optionid'];
                    }

                    $values[$configid] = $configoptionvalue;
                }
            }

            $where = array("pid" => $pid);

            if (!$showhidden) {

                $where['hidden'] = 0;
            }

            $result2 = select_query("tblproductconfigoptions", "", $where, "order` ASC,`id", "ASC", "", "tblproductconfiglinks ON tblproductconfiglinks.gid=tblproductconfigoptions.gid");

            while ($data2 = mysql_fetch_array($result2)) {

                $optionid = $data2['id'];

                $gid = $data2['gid'];

                $optionname = $data2['optionname'];

                $optiontype = $data2['optiontype'];

                $optionhidden = $data2['hidden'];

                $qtyminimum = $data2['qtyminimum'];

                $qtymaximum = $data2['qtymaximum'];

                if (strpos($optionname, "|")) {

                    $optionname = explode("|", $optionname);

                    $optionname = trim($optionname[1]);
                }

                $options = array();

                $selectedqty = 0;

                $selvalue = $values[$optionid];

                if ($optiontype == "1") {

                    $result3 = select_query("tblproductconfigoptionssub", "", array("configid" => $optionid), "sortorder` ASC,`id", "ASC");

                    while ($data3 = mysql_fetch_array($result3)) {

                        $selected = false;

                        $opid = $data3['id'];

                        $opname = $data3['optionname'];

                        $ophidden = $data3['hidden'];

                        $sortorder = $data3['sortorder'];

                        if (strpos($opname, "|")) {

                            $opname = explode("|", $opname);

                            $opname = trim($opname[1]);
                        }

                        if (in_array($opid, $selectedoptions)) {

                            $selected = true;
                        }

                        $opnameonly = $opname;

                        $result4 = select_query("tblpricing", "", array("type" => "configoptions", "currency" => $currencyCode, "relid" => $opid));

                        $data = mysql_fetch_array($result4);

                        $setup = $data[substr($cycle, 0, 1) . "setupfee"];

                        $price = $fullprice = $data[$cycle];

                        if ($orderform && $CONFIG['ProductMonthlyPricingBreakdown']) {

                            $price = $price / $cyclemonths;
                        }

                        if (0 < $price) {

                            $opname .= " " . formatCurrency($price);
                        }

                        $setupvalue = 0 < $setup ? " + " . formatCurrency($setup) . " " . $_LANG['ordersetupfee'] : "";

                        if ($showhidden || !$ophidden) {

                            //starrt 

                            $show = "off";

                            $description = '';

                            $config_show_status = DB::table('opc_config')->where("config_grp_id", $gid)->get();

                            if (!empty($config_show_status[0]->show) && $config_show_status[0]->show == 'on') {

                                $description = DB::table('tblproductconfiggroups')->where("id", $gid)->get();

                                $show = "on";
                            }

                            //end 

                            $options[] = array("configid" => $optionid, "grp_des" => $description[0]->description, "show" => $show, "gid" => $gid, "opt_name" => $optionname, "optionname" => $opnameonly, "pc_id" => $gid, "pid" => $pid, "price" => $price, "selected" => $selected, "sortorder" => $sortorder, "sub_id" => $opid);
                        }

                        if ($opid == $selvalue || !$selvalue) {

                            $selname = $opnameonly;

                            $selectedoption = $opname;

                            $selsetup = $setup;

                            $selrecurring = $fullprice;

                            $selvalue = $opid;
                        }
                    }
                }

                if ($optiontype == "3") {
                    
                } else {

                    if ($optiontype == "4") {
                        
                    } else {
                        
                    }
                }

                if ($optiontype == "1") {

                    $configoptions[$optionid] = $options;
                }
            }

            return $configoptions;

            // print_r($configoptions);
        }

        #added

        static function getImagePath($id, $type) {

            try {

                $image_path = DB::table('opc_images')
                        ->select('imagepath')
                        ->where('relid', $id)
                        ->where('type', $type)
                        ->get();

                return ['status' => 'success', 'records' => $image_path];
            } catch (\Exception $e) {

                return ['status' => 'error', 'message' => "There is error while getting the record.Error :- {$e->getMessage()}"];
            }
        }

        static function getProductConfigGroupDetails($id) {

            $gid = self::getGidfromProductConfigid($id);

            if ($gid['status'] == "success") {

                try {

                    $result = DB::table('tblproductconfiggroups')
                            ->select(array('name', 'description'))
                            ->where('id', $gid['gid'])
                            ->get();

                    return ['status' => 'success', 'data' => $result];
                } catch (\Exception $e) {

                    return ['status' => 'error', 'message' => "There is error while getting the record.Error :- {$e->getMessage()}"];
                }
            }
        }

        static function getProductConfigPopOver($opid) {

            $deatils = self::getConfigGroupDetails($opid);



            if ($deatils['status'] == "success" && !empty($deatils['data'])) {

                try {

                    $result = DB::table('opc_config')
                            ->where('config_grp_id', $deatils['data'][0]->gid)
                            ->where('config_opt_id', $opid)
                            ->get();

                    return ['status' => 'success', 'data' => $result];
                } catch (\Exception $e) {

                    return ['status' => 'error', 'message' => "There is error while getting the record.Error :- {$e->getMessage()}"];
                }
            }
        }

        static function getConfigGroupDetails($id) {

            try {

                $gid = DB::table('tblproductconfigoptions')
                        ->where('id', $id)
                        ->get();

                return ['status' => 'success', 'data' => $gid];
            } catch (\Exception $e) {

                return ['status' => 'error', 'message' => "There is error while getting the record.Error :- {$e->getMessage()}"];
            }
        }

        static function getDomainAddon($tld) {

            try {

                $data = DB::table('tbldomainpricing')
                        ->where('extension', $tld)
                        ->get();

                return ['status' => 'success', 'data' => $data];
            } catch (\Exception $e) {

                return ['status' => 'error', 'message' => "There is error while getting the record.Error :- {$e->getMessage()}"];
            }
        }

        static function get_clientsProfileOptionalFields() {

            try {

                $data = DB::table('tblconfiguration')
                        ->where("setting", "ClientsProfileOptionalFields")

                        //->select("value")
                        //->get();
                        ->value('value');

                return ['status' => 'success', 'data' => $data];
            } catch (\Exception $e) {

                return ['status' => 'error', 'message' => "There is error while getting the record.Error :- {$e->getMessage()}"];
            }
        }

        static function getDomainAddonPrice($currency) {

            try {

                $data = DB::table('tblpricing')
                        ->where('type', "domainaddons")
                        ->where('currency', $currency)
                        ->get();

                return ['status' => 'success', 'data' => $data];
            } catch (\Exception $e) {

                return ['status' => 'error', 'message' => "There is error while getting the record.Error :- {$e->getMessage()}"];
            }
        }

        static function getCustomFields($type, $relid, $relid2, $value_array, $admin = "", $order = "", $ordervalues = "", $hidepw = "") {



            if (isset($value_array)) {

                $custmarray = array();

                foreach ($value_array as $custmkey => $custmvalue) {

                    $custmarray[$custmkey] = $custmvalue;
                }
            }



            if ($type == 'client') {

                $class = "clientcustomfield";

                $name = 'clientcustomfield';
            } else {

                $class = "customfield trigger-update";

                $name = 'customfield';
            }

            $customfields = $where = array();

            $where['type'] = $type;



            if ($relid) {

                $where['relid'] = $relid;
            }





            if (!$admin) {

                $where['adminonly'] = "";
            }





            if ($order) {

                $where['showorder'] = "on";
            }



            $result = select_query("tblcustomfields", "", $where, "sortorder` ASC,`id", "ASC");



            while ($data = mysql_fetch_array($result)) {

                $id = $data['id'];

                $fieldname = $data['fieldname'];



                if (strpos($fieldname, "|")) {

                    $fieldname = explode("|", $fieldname);

                    $fieldname = trim($fieldname[1]);
                }



                $fieldtype = $data['fieldtype'];

                $description = $data['description'];

                $fieldoptions = $data['fieldoptions'];

                $required = $data['required'];

                $adminonly = $data['adminonly'];

                $customfieldval = (is_array($ordervalues) ? $ordervalues[$id] : "");



                if (array_key_exists($id, $custmarray)) {

                    $customfieldval = $custmarray[$id];
                }



                $rawvalue = $customfieldval;



                if ($required == "on") {

                    $required = "required";
                }





                if ($fieldtype == "text" || ($fieldtype == "password" && $admin)) {

                    $input = ("<input type=\"text\" name=\"" . $name . "[" . $id . "]") . "\" id=\"customfield" . $id . "\" value=\"" . $customfieldval . "\" size=\"30\" data-field-id=\"" . $id . "\"  $required  class=\"form-control " . $class . "\" />";
                } else {

                    if ($fieldtype == "link") {

                        $webaddr = trim($customfieldval);



                        if (substr($webaddr, 0, 4) == "www.") {

                            $webaddr = "http://" . $webaddr;
                        }



                        $input = ("<input type=\"text\" name=\"" . $name . "[" . $id . "]") . "\" id=\"customfield" . $id . "\" value=\"" . $customfieldval . "\" size=\"40\" data-field-id=\"" . $id . "\" class=\"form-control " . $class . "\" /> " . ($customfieldval ? "<a href=\"" . $webaddr . "\" target=\"_blank\">www</a>" : "");

                        $customfieldval = "<a href=\"" . $webaddr . "\" target=\"_blank\">" . $customfieldval . "</a>";
                    } else {

                        if ($fieldtype == "password") {

                            $input = ("<input type=\"password\" name=\"" . $name . "[" . $id . "]") . "\" id=\"customfield" . $id . "\" value=\"" . $customfieldval . "\" size=\"30\" data-field-id=\"" . $id . "\" $required class=\"form-control " . $class . "\" />";



                            if ($hidepw) {

                                $pwlen = strlen($customfieldval);

                                $customfieldval = "";

                                $i = 1;



                                while ($i <= $pwlen) {

                                    $customfieldval .= "*";

                                    ++$i;
                                }
                            }
                        } else {

                            if ($fieldtype == "textarea") {

                                $input = ("<textarea name=\"" . $name . "[" . $id . "]") . "\" id=\"customfield" . $id . "\" rows=\"3\" style=\"width:100%;\" data-field-id=\"" . $id . "\" class=\"form-control " . $class . "\">" . $customfieldval . "</textarea>";
                            } else {

                                if ($fieldtype == "dropdown") {

                                    $input = ("<select name=\"customfield[" . $id . "]") . "\" id=\"customfield" . $id . "\" data-field-id=\"" . $id . "\" class=\"form-control " . $class . "\">";

                                    $fieldoptions = explode(",", $fieldoptions);

                                    foreach ($fieldoptions as $optionvalue) {

                                        $input .= ("<option value=\"" . $optionvalue . "\"");



                                        if ($customfieldval == $optionvalue) {

                                            $input .= " selected";
                                        }





                                        if (strpos($optionvalue, "|")) {

                                            $optionvalue = explode("|", $optionvalue);

                                            $optionvalue = trim($optionvalue[1]);
                                        }



                                        $input .= ">" . $optionvalue . "</option>";
                                    }



                                    $input .= "</select>";
                                } else {

                                    if ($fieldtype == "tickbox") {

                                        $input = (("<input type=\"checkbox\" name=\"" . $name . "[" . $id . "]") . "\" id=\"customfield" . $id . "\"");



                                        if ($customfieldval == "on") {

                                            $input .= " checked";
                                        }



                                        $input .= "  data-field-id=\"" . $id . "\" class=\"form-control customfiled-checkbox iradiobox " . $class . "\" />";
                                    }
                                }
                            }
                        }
                    }
                }





                if ($fieldtype != "link" && strpos($customfieldval, "|")) {

                    $customfieldval = explode("|", $customfieldval);

                    $customfieldval = trim($customfieldval[1]);
                }



                $customfields[] = array("id" => $id, "name" => $fieldname, "description" => $description, "type" => $fieldtype, "input" => $input, "value" => $customfieldval, "rawvalue" => $rawvalue, "required" => $required, "adminonly" => $adminonly);
            }



            return $customfields;
        }

#end getting custom fields
    }

//end class
}
?>