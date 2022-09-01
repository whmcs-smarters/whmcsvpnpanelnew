<?php

include_once '../onepagecart.Class.php';
include_once '../domainfunctions.php';
include_once "../../../includes/domainfunctions.php";
//include_once "../../../includes/whoisfunctions.php";
include_once '../../../includes/configoptionsfunctions.php';
use WHMCS\Database\Capsule;
//$promocode = $_REQUEST['promo'];
function opc_clean($string) 
{
   $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9]/', '', $string); // Removes special chars.
}

    unset($_SESSION['productwithdomain']);
    unset($_SESSION['alldomainsselected']);
    unset($_SESSION['alldomainsselectedtypes']);
    unset($_SESSION['productids']);
    unset($_SESSION['productbillingcycles']);
    unset($_SESSION['onepagecart_mainsession']);
    unset($_SESSION['productconfiguration']);
    unset($_SESSION['selected_addon']);

function promocode($promotioncode, $pid, $fpamount,$billingcycle) 
{

    $result = select_query("tblpromotions", "", array("code" => $promotioncode));
    $data = mysql_fetch_array($result);
    $id = $data['id'];
    $maxuses = $data['maxuses'];
    $uses = $data['uses'];
    $startdate = $data['startdate'];
    $expiredate = $data['expirationdate'];
    $newsignups = $data['newsignups'];
    $existingclient = $data['existingclient'];
    $onceperclient = $data['onceperclient'];
    $cycles = $data['cycles'];
    $applyonce = $data['applyonce'];
    $recurring = $data['recurring'];
    $value = $data['value'];
    $type = $data['type'];
    $appliesto = explode(",", $data['appliesto']);
    
    if (!$id)
    {
        return false;
    }

    if ($startdate != "0000-00-00") 
    {
        $startdate = str_replace("-", "", $startdate);
        if (date("Ymd") < $startdate) 
        {
            return false;
        }
    }

    if ($expiredate != "0000-00-00")
    {
        $expiredate = str_replace("-", "", $expiredate);
        if ($expiredate < date("Ymd")) 
        {
            return false;
        }
    }

    if (0 < $maxuses)
    {
        if ($maxuses <= $uses) 
        {
            return false;
        }
    }

    if (!in_array($pid, $appliesto))
    {
        return false;
    }
    
    #Billing cycle
    $cycles_array =  explode(",",$cycles);
    foreach ($cycles_array as $cycle)
    {
        $cycles_array_formatted[]= strtolower(opc_clean($cycle));
    }
   
    if (!empty($cycles) && !in_array(strtolower($billingcycle), $cycles_array_formatted))
    {
        return false;
    }
    
    if ($type == "Percentage")
    {
        $type = "percent";
        $onetimediscount = $fpamount * ($value / 100);
    }
    elseif ($type == "Fixed Amount") 
    {
        $type = "fixed";
        if ($fpamount < $value) {
            $onetimediscount = $fpamount;
        } else {
            $onetimediscount = $value;
        }
    } 
    elseif ($type == "Price Override")
    {
        $type = "override";
        $onetimediscount = $fpamount - $value;
    }
    $onetimediscount = round($onetimediscount, 2);
    return array("amount" => $value, "applies" => TRUE, "recurring" => $recurring, "type" => $type, "pre" => $onetimediscount);
}



function getTax_Rate($level, $state, $country)
{
    global $_LANG;
    $result = select_query("tbltax", "", array("level" => $level, "state" => $state, "country" => $country));
    $data = mysql_fetch_array($result);
    $taxname = $data['name'];
    $taxrate = $data['taxrate'];
    if (!$taxrate)
    {
        $result = select_query("tbltax", "", array("level" => $level, "state" => "", "country" => $country));
        $data = mysql_fetch_array($result);
        $taxname = $data['name'];
        $taxrate = $data['taxrate'];
    }
    if (!$taxrate)
    {
        $result = select_query("tbltax", "", array("level" => $level, "state" => "", "country" => ""));
        $data = mysql_fetch_array($result);
        $taxname = $data['name'];
        $taxrate = $data['taxrate'];
    }
    if (!$taxrate)
    {
        $taxrate = 0;
    }
    if (!$taxname)
    {
        $taxname = $_LANG['invoicestax'];
    }
    return array("name" => $taxname, "rate" => $taxrate);
}

#start 
$totaltoday = $total_recurring = 0;
$selected_product_price = $selected_addon_price = $selected_config_options_price =$selected_domain_tax= 0;
$total_recurring_monthly = $total_recurring_quarterly = $total_recurring_semiannually = $total_recurring_annually = $total_recurring_biennially = $total_recurring_triennially = 0;


$removeitem = $_REQUEST['removeitem'];
$removeitemtype = $_REQUEST['removeitemtype'];


/*if (!empty($_REQUEST['producttoadd']) && $_REQUEST['producttoadd'] == "add") 
{
    $pid = $_REQUEST['products'][0];
} else {
    $pid = "";
}*/
if (!empty($_REQUEST['products'])) 
{
    $pid = $_REQUEST['products'];
} else {
    $pid = "";
}
//$pid = $_REQUEST['products'][0];

if (isset($_REQUEST['producttoedit']) && is_numeric($_REQUEST['producttoedit'])) {
    $editproduct = true;
    $producttoeditkey = $_REQUEST['producttoedit']; #0
} else {
    $editproduct = false;
}

#if adding product
if (!empty($pid) && !is_numeric($removeitem)) {
    $billingcycle = !empty($_REQUEST['billingcycle']) && $_REQUEST['billingcycle'] != "null" ? $_REQUEST['billingcycle'] : "free";
}

$selectedsession_pconfigids = $selectedsession_pids = $selectedsession_pcycles = $selectedsession_domains = $onepagecart_mainsession = array();


if (isset($_SESSION['onepagecart_mainsession']['products']) && !empty($_SESSION['onepagecart_mainsession']['products'])) {
    $sessionsizebefore = count($_SESSION['onepagecart_mainsession']['products']); #counting session array products
    $i = 0;
    foreach ($_SESSION['onepagecart_mainsession']['products'] as $sessionproductkey => $sessionproductvalue) 
    {
        if (is_numeric($removeitem) && $removeitemtype == "p" && $i == $removeitem) 
        {
            $i++;
            $selectedsession_domains[$sessionproductkey] = $sessionproductvalue['productwithdomain'];
            continue;
        } 
        else
        {
            $selectedsession_domains[$sessionproductkey] = $sessionproductvalue['productwithdomain'];
        }
        $onepagecart_mainsession[$sessionproductkey] = $sessionproductvalue;
        $i++;
        $selectedsession_pids[] = $sessionproductvalue['id'];
        $selectedsession_pcycles[] = $sessionproductvalue['billingcycle'];
    }
    $_SESSION['onepagecart_mainsession']['products'] = $onepagecart_mainsession;
    $sessionsizeafter = count($_SESSION['onepagecart_mainsession']['products']);
}


if (is_numeric($removeitem) && $removeitemtype == "p") {
    $TransferedDomainfromproduct = array();
    $domaintotransfer = $selectedsession_domains[$removeitem];
    unset($selectedsession_domains[$removeitem]);
    if (!empty($domaintotransfer) && is_array($domaintotransfer) && count($domaintotransfer) > 0) {
        if ($domaintotransfer['register'] == TRUE) {
            $type = "register";
        } elseif ($domaintotransfer['transfer'] == TRUE) {
            $type = "transfer";
        } else {
            $type = "register";
        }
        $TransferedDomainfromproduct[$domaintotransfer['full']] = $type;
        if (is_array($TransferedDomainfromproduct) && count($TransferedDomainfromproduct) > 0) {
            if (is_array($_SESSION['alldomainsselected'])) {
                $_SESSION['alldomainsselected'] = array_merge($_SESSION['alldomainsselected'], $TransferedDomainfromproduct);
            } else {
                $_SESSION['alldomainsselected'] = $TransferedDomainfromproduct;
            }
        }
    }
}
if (is_array($selectedsession_domains) && count($selectedsession_domains) > 0) {
    $sortselecteddomainkey = 0;
    foreach ($selectedsession_domains as $sortselectedomainvalue) {
        $selectedsession_domains[$sortselecteddomainkey] = $sortselectedomainvalue;
        $sortselecteddomainkey++;
    }
}


if (count($selectedsession_pids) > 0) {
    $_SESSION['productids'] = is_array($_SESSION['productids']) ? $_SESSION['productids'] : array();
    $_SESSION['productbillingcycles'] = is_array($_SESSION['productbillingcycles']) ? $_SESSION['productbillingcycles'] : array();
    if (!empty($pid)) {
        $_SESSION['productids'] = array_merge($selectedsession_pids, array($pid));
        $_SESSION['productbillingcycles'] = array_merge($selectedsession_pcycles, array($billingcycle));
    } else {
        $_SESSION['productids'] = $selectedsession_pids;
        $_SESSION['productbillingcycles'] = $selectedsession_pcycles;
    }
} else {
    if (!empty($pid)) {
       
        $_SESSION['productids'] = array($pid);
        $_SESSION['productbillingcycles'] = array($billingcycle);
    }
}


if (is_numeric($removeitem) && $removeitemtype == "p" && $sessionsizebefore == $sessionsizeafter) {
    unset($_SESSION['productids'][$removeitem]);
    unset($_SESSION['productbillingcycles'][$removeitem]);
}

if (isset($_SESSION['productids']) && is_array($_SESSION['productids']) && count($_SESSION['productids']) > 0) {
    $countproductids = count($_SESSION['productids']);
    if (!$editproduct) {
        $producttoeditkey = $countproductids - 1;
    }
$total_taxable_price = 0;

                        /*-----start main loop-----*/
    foreach ($_SESSION['productids'] as $key_session => $pid) 
    {
        #start customfields
        $selected_config_options_price=$config_setup_fee=0;
        
        if ($editproduct) 
        {
            if (!empty($_REQUEST['customfields']) && !empty($_SESSION['customfieldvalues'][$key_session]) && $key_session == $producttoeditkey) 
            {
                #Updating the product config of last product,but not first product
                //$_SESSION['customfieldvalues'][$key_session]=$_REQUEST['customfields'];
                $values=$_REQUEST['customfields'];
                $customfields = OnePageCartClass::getCustomFields("product",$pid,"",$values,"",TRUE,"","");
                $_SESSION['customfieldvalues'][$key_session]=$customfields;
              
            }  
            else
            {
                $customfields = $_SESSION['customfieldvalues'][$key_session];
            }
        } 
        else
        {
            if (empty($_SESSION['customfieldvalues'][$key_session]) && ($countproductids - 1) == $key_session) 
            {
                #first time
                //$_SESSION['customfieldvalues'][$key_session]=$_REQUEST['customfields'];
                $values=$_REQUEST['customfields'];
                $customfields = OnePageCartClass::getCustomFields("product",$pid,"",$values,"",TRUE,"","");
                $_SESSION['customfieldvalues'][$key_session]=$customfields;
            
            } 
           
            elseif (!empty($_REQUEST['customfields']) && !empty($_SESSION['customfieldvalues'][$key_session]) && ($countproductids - 1) == $key_session) 
            {
                #Updating the product config of last product,but not first product
                //$_SESSION['customfieldvalues'][$key_session]=$_REQUEST['customfields'];
                $values=$_REQUEST['customfields'];
                $customfields = OnePageCartClass::getCustomFields("product",$pid,"",$values,"","","","");
                $_SESSION['customfieldvalues'][$key_session]=$customfields;
              
            }  
            else
            {
                $customfields = $_SESSION['customfieldvalues'][$key_session];
            }
        }

        
        
        #custom fields end
        if ($editproduct) 
        {
            if ($key_session == $producttoeditkey && !empty($_REQUEST['configoptions']))
            {
                #editing product
                $selected_config_options_array = $_REQUEST['configoptions']; #array
                $_SESSION['productconfiguration'][$key_session] = $selected_config_options_array;
            }
            else
            {
                #retain previous value
                $selected_config_options_array = $_SESSION['productconfiguration'][$key_session];
            }
        }
        else
        {
            if (empty($_SESSION['productconfiguration'][$key_session]) && ($countproductids - 1) == $key_session) 
            {
                #first time
                $selected_config_options_array = $_REQUEST['configoptions'];
                $_SESSION['productconfiguration'][$key_session] = $selected_config_options_array;
            } 
            elseif (!empty($_REQUEST['configoptions']) && !empty($_SESSION['productconfiguration'][$key_session]) && ($countproductids - 1) == $key_session) 
            {
                #Updating the product config of last product,but not first product
                $selected_config_options_array = $_REQUEST['configoptions'];
                $_SESSION['productconfiguration'][$key_session] = $selected_config_options_array;
            }
            else
            {
                #second product is added without any config option
                $selected_config_options_array = $_SESSION['productconfiguration'][$key_session];
            }
        }


        //$selectedAddonsArray = $_REQUEST['addons'];
        //start product addon

        if ($editproduct) {
            /*print_r($_REQUEST['addons']);die('if');*/
            if ($key_session == $producttoeditkey && isset($_SESSION['pre_addon'][$key_session])) {
                $_REQUEST['addons'] = $_SESSION['pre_addon'][$key_session];
                unset($_SESSION['pre_addon']);
            }

            if ($key_session == $producttoeditkey) {
                #editing product
                $selectedAddonsArray = $_REQUEST['addons']; #array
                $_SESSION['selected_addon'][$key_session] = $selectedAddonsArray;
            } else {
                #retain previous value
                $selectedAddonsArray = $_SESSION['selected_addon'][$key_session];
            }
        } else {
            /*print_r($_REQUEST['addons']);die('in else');*/
            if (empty($_SESSION['selected_addon'][$key_session]) && ($countproductids - 1) == $key_session) {
                #last product(first time requested)
                $selectedAddonsArray = $_REQUEST['addons']; #no addon id
                $_SESSION['selected_addon'][$key_session] = $selectedAddonsArray; #no addon id
            } elseif (!empty($_SESSION['selected_addon'][$key_session]) && ($countproductids - 1) == $key_session && $_REQUEST['urlpram'] == 'add') {
                #Updating the addon of last product
                $selectedAddonsArray = $_REQUEST['addons'];
                $_SESSION['selected_addon'][$key_session] = $selectedAddonsArray;
            } else {
                #Not last product
                $selectedAddonsArray = $_SESSION['selected_addon'][$key_session];
            }
        }

        //end product addon



        //STart Product Config Options
        $currencyCode = $_SESSION['onepagecart_active_currency']['code'];
        $currencyID = $_SESSION['onepagecart_active_currency']['id'];
        $FinalCalculationOFConfigOption = "";    
        $SelectedConfigOptionArray = array();    
        if(isset($_REQUEST['configOptionvValue']) && isset($_REQUEST['configOptionvBilling']))
        {
            $ConfigDataArray = reseller_getProductConfigOption($_REQUEST['products'], $currencyID);
            foreach($ConfigDataArray as  $VKal)
            {
                $ValueOfConfigOP =  $_REQUEST['configOptionvValue'][$VKal['id']];    
                $BillingForPrice =  $_REQUEST['configOptionvBilling'][$VKal['id']];    
                $FinalCalculationOFConfigOption+= $ValueOfConfigOP*$VKal['pricetype'][$BillingForPrice];
                $SelectedConfigOptionArray[$VKal['id']] = array($BillingForPrice => $ValueOfConfigOP);
            }
        }

        //end product Config



        if ($editproduct) {

            if ($key_session == $producttoeditkey) {
                $hostname = $_REQUEST['hostname'];
                $rootpw = $_REQUEST['rootpw'];
                $ns1prefix = $_REQUEST['ns1prefix'];
                $ns2prefix = $_REQUEST['ns2prefix'];
                $configureserver = array(
                    "hostname" => $hostname, "rootpw" => $rootpw, "ns1prefix" => $ns1prefix, "ns2prefix" => $ns2prefix
                );
                $selectedconfigureserverArray = $configureserver;
                $_SESSION['configureserver_fields'][$key_session] = $selectedconfigureserverArray;
            } else {
                $selectedconfigureserverArray = $_SESSION['configureserver_fields'][$key_session];
            }
        } else {
            if (empty($_SESSION['configureserver_fields'][$key_session]) && ($countproductids - 1) == $key_session) {
                $hostname = $_REQUEST['hostname'];
                $rootpw = $_REQUEST['rootpw'];
                $ns1prefix = $_REQUEST['ns1prefix'];
                $ns2prefix = $_REQUEST['ns2prefix'];
                $configureserver = array(
                    "hostname" => $hostname, "rootpw" => $rootpw, "ns1prefix" => $ns1prefix, "ns2prefix" => $ns2prefix
                );
                $selectedconfigureserverArray = $configureserver;
                $_SESSION['configureserver_fields'][$key_session] = $selectedconfigureserverArray;
            } elseif (!empty($_SESSION['configureserver_fields'][$key_session]) && ($countproductids - 1) == $key_session && isset($_REQUEST['urlpram']) && $_REQUEST['urlpram'] == 'add') {
                $hostname = $_REQUEST['hostname'];
                $rootpw = $_REQUEST['rootpw'];
                $ns1prefix = $_REQUEST['ns1prefix'];
                $ns2prefix = $_REQUEST['ns2prefix'];
                $configureserver = array(
                    "hostname" => $hostname, "rootpw" => $rootpw, "ns1prefix" => $ns1prefix, "ns2prefix" => $ns2prefix
                );
                $selectedconfigureserverArray = $configureserver;
                $_SESSION['configureserver_fields'][$key_session] = $selectedconfigureserverArray;
            } else {
                $selectedconfigureserverArray = $_SESSION['configureserver_fields'][$key_session];
            }
        }


        $adminid = OnePageCartClass::GetAdminID();
        $command_getproducts = "GetProducts";
        $adminuser = $adminid['records'];
        $pid = $_SESSION['productids'][0];
        //echo '<pre>'; print_r($_SESSION); die();
        $values_getproducts = array('pid' => $pid,);
        $Products_result = localAPI($command_getproducts, $values_getproducts);
        //echo '<pre>';print_r($Products_result); die();
                $packagePriceData = Capsule::table('vpnpackageprice')
                ->where('uid', '=', $_SESSION['resellerid'])
                ->where('products', '=', $pid)
               
                ->get();
                
        $currencyCode = $_SESSION['onepagecart_active_currency']['code'];
        $currencyID = $_SESSION['onepagecart_active_currency']['id'];
        
        

        $GetSelectedAddonDetails = array();
        if (isset($selectedAddonsArray) && !empty($selectedAddonsArray)) {
            $selectedaddons = array();
            foreach ($selectedAddonsArray as $selectedAddonsID) {
                $GetSelectedAddonDetails = OnePageCartClass::GetAddonsbyID($selectedAddonsID, $currencyID);
                if ($GetSelectedAddonDetails['status'] == "success") {
                    if (isset($GetSelectedAddonDetails['records'][0]) && !empty($GetSelectedAddonDetails['records'][0])) {
                        $selectedaddons[] = $GetSelectedAddonDetails['records'][0];
                    }
                }
            }
        }

        $getAddons_result = OnePageCartClass::GetAddonsbyProductID($pid, $currencyID);
        $addons = array();
        if ($getAddons_result['status'] == "success") {
            $addons = $getAddons_result['records'];
        }
        if ($Products_result['result'] == "success") 
        {
         //echo '<pre>'; print_r($Products_result); die();   
            $product_name = $Products_result['products']['product'][0]['name'];
            $product_type = $Products_result['products']['product'][0]['type'];
            
            $monthly_price_setup = $Products_result['products']['product'][0]['pricing'][$currencyCode]['msetupfee'];
            $quarterly_price_setup = $Products_result['products']['product'][0]['pricing'][$currencyCode]['qsetupfee'];
            $semiannually_price_setup = $Products_result['products']['product'][0]['pricing'][$currencyCode]['ssetupfee'];
            $anually_price_setup = $Products_result['products']['product'][0]['pricing'][$currencyCode]['asetupfee'];
            $biennially_price_setup = $Products_result['products']['product'][0]['pricing'][$currencyCode]['bsetupfee'];
            $triennially_price_setup = $Products_result['products']['product'][0]['pricing'][$currencyCode]['tsetupfee'];
           
            $product_paytype = $Products_result['products']['product'][0]['paytype'];
            $monthly_price = $packagePriceData[0]->priceMonthly;
            $quarterly_price = $packagePriceData[0]->priceQuarterly;
            $semiannually_price = $packagePriceData[0]->priceSemiannually;
            $anually_price = $packagePriceData[0]->priceAnnually;
            $biennially_price = $packagePriceData[0]->priceBiennially;
            $triennially_price = $packagePriceData[0]->priceTriennially;
           
            $anually_saving = $biennially_saving = $triennially_saving = 0;
            if (!empty($monthly_price) && $monthly_price != "-1.00") {
                $quarterly_saving = number_format(((($monthly_price) - ($quarterly_price / 3)) / $monthly_price) * 100, 2);
                $semiannually_saving = number_format(((($monthly_price) - ($semiannually_price / 6)) / $monthly_price) * 100, 2);
                $anually_saving = number_format(((($monthly_price) - ($anually_price / 12)) / $monthly_price) * 100, 2);
                $biennially_saving = number_format(((($monthly_price) - ($biennially_price / 24)) / $monthly_price) * 100, 2);
                $triennially_saving = number_format(((($monthly_price) - ($triennially_price / 36)) / $monthly_price) * 100, 2);
            }
            $pricing = array();
            if (!empty($monthly_price) && $monthly_price != "-1.00") {
                $pricing['monthly'] = array(
                    'term' => 'monthly',
                    'price' => $monthly_price,
                    'savings' => 0,
                    'months' => 1,
                );
            }
            if (!empty($quarterly_price) && $quarterly_price != "-1.00") {
                $pricing['quarterly'] = array(
                    'term' => 'quarterly',
                    'price' => $quarterly_price,
                    'savings' => (float) $quarterly_saving,
                    'months' => 3,
                );
            }
            if (!empty($semiannually_price) && $semiannually_price != "-1.00") {
                $pricing['semiannually'] = array(
                    'term' => 'semiannually',
                    'price' => $semiannually_price,
                    'savings' => (float) $semiannually_saving,
                    'months' => 6,
                );
            }
            if (!empty($anually_price) && $anually_price != "-1.00") {
                $pricing['annually'] = array(
                    'term' => 'annually',
                    'price' => $anually_price,
                    'savings' => (float) $anually_saving,
                    'months' => 12,
                        )
                ;
            }
            if (!empty($biennially_price) && $biennially_price != "-1.00") {
                $pricing['biennially'] = array(
                    'term' => 'biennially',
                    'price' => $biennially_price,
                    'savings' => (float) $biennially_saving,
                    'months' => 24,
                );
            }
            if (!empty($triennially_price) && $triennially_price != "-1.00") {
                $pricing['triennially'] = array(
                    'term' => 'triennially',
                    'price' => $triennially_price,
                    'savings' => (float) $triennially_saving,
                    'months' => 36,
                );
            }

            #setting billing cycle first time
            if (isset($_SESSION['onepagecart_billingcycle']) && !empty($_GET['billingcycle'])) {
                $billingcycle = $_SESSION['onepagecart_billingcycle'];
                if (is_array($pricing)) {
                    if (!isset($pricing[$billingcycle])) {
                        foreach ($pricing as $k => $v) {
                            $billingcycle = $k;
                            break;
                        }
                    }
                }
            } else {
                $billingcycle = $_SESSION['productbillingcycles'][$key_session];
                if (is_array($pricing)) {
                    if (!isset($pricing[$billingcycle])) {
                        foreach ($pricing as $k => $v) {
                            $billingcycle = $k;
                            break;
                        }
                    }
                }
            }
            #end setting billing cycle first
            #start edit billingcycle
            if ($editproduct && $producttoeditkey == $key_session) {
                $billingcycle = $_REQUEST['billingcycle'];
                if (is_array($pricing)) {
                    if (!isset($pricing[$billingcycle])) {
                        foreach ($pricing as $k => $v) {
                            $billingcycle = $k;
                            break;
                        }
                    }
                }
                $editedproductbillingcycle = $billingcycle;
            }
            #end edit billingcycle
            #updating last product start 
            else if (($countproductids - 1) == $key_session && !$editproduct) {
                $billingcycle = $_REQUEST['billingcycle'];
                if (!isset($pricing[$billingcycle])) {
                    foreach ($pricing as $k => $v) {
                        $billingcycle = $k;
                        break;
                    }
                }
            }
            #updating last product ends

            $_SESSION['productbillingcycles'][$key_session] = $billingcycle; #update billingcycle
            $amountFinal = $monthly_price;
            
            if ($billingcycle == "onetime") {
                $billingcycle = "monthly";
                
               $amountFinal = $monthly_price;
           
            }
            
            if ($billingcycle == "quarterly") {
                $amountFinal = $quarterly_price; 
           
            }
            if ($billingcycle == "semiannually") {
                $amountFinal = $semiannually_price; 
           
            }
            if ($billingcycle == "annually") {
                $amountFinal = $anually_price; 
           
            }
            if ($billingcycle == "biennially") {
                 $amountFinal = $biennially_price; 
            
            }
            if ($billingcycle == "triennially") {
                  $amountFinal = $triennially_price; 
            
            }
            
            
            $selected_product_price = $amountFinal;
        }

        $formatselectedAddons = array();
        if (isset($selectedaddons) && !empty($selectedaddons) && count($selectedaddons) > 0) {
            foreach ($selectedaddons as $key => $selectedaddondetails) {
                $addon_rec_price = "0.00";
                if ($selectedaddondetails['paytype'] == "Monthly") {
                    $total_recurring_monthly += $packagePriceData[0]->priceMonthly;
                    $type = "monthly";
                } elseif ($selectedaddondetails['paytype'] == "Quarterly") {
                    $total_recurring_quarterly +=  $packagePriceData[0]->priceQuarterly;
            
                    $type = "quarterly";
                } elseif ($selectedaddondetails['paytype'] == "Semi-Annually") {
                    $total_recurring_semiannually +=  $packagePriceData[0]->priceSemiannually;
            
                    $type = "semiannually";
                } elseif ($selectedaddondetails['paytype'] == "Annually") {
                    $total_recurring_annually += $packagePriceData[0]->priceAnnually;
           
                    $type = "annually";
                } elseif ($selectedaddondetails['paytype'] == "Biennially") {
                    $total_recurring_biennially += $packagePriceData[0]->priceBiennially;
            
                    $type = "biennially";
                } elseif ($selectedaddondetails['paytype'] == "Triennially") {
                    $total_recurring_triennially += $packagePriceData[0]->priceTriennially;
                    $type = "triennially";
                } elseif ($selectedaddondetails['paytype'] == "Free Account") {
                    $type = "free";
                } elseif ($selectedaddondetails['paytype'] == "One Time") {
                    $type = "onetime";
                }
                $totaltoday += $selectedaddondetails['price'];
                if ($billingcycle == $type) {
                    $addon_rec_price = $selectedaddondetails['price'];
                    $selected_addon_price += $selectedaddondetails['price'];
                }
                $addon_image_path = OnePageCartClass::getImagePath($selectedaddondetails['id'], "addons");

                $formatselectedAddons[$key] = array("id" => $selectedaddondetails['id'], "name" => $selectedaddondetails['name'], "paytype" => $type, "price" => $selectedaddondetails['price'], "recurring" => $addon_rec_price, "imagepath" => $addon_image_path['records'][0]->imagepath);
            }
        }


        $currency['id']=$_SESSION['onepagecart_active_currency']['id'];
        $configoptions = getCartConfigOptions($pid, $selected_config_options_array, $billingcycle, $accountid = "", $orderform = "");


        $configoptionsManual2 = reseller_getProductConfigOption($pid, $currency['id']);
        $BillingCycle12 = reseller_getBillingCycleFun($pid,$currency['id']);


        $selconfigopts = array();
        foreach ($configoptions as $suboptions) 
        {
            $selected_config_options_price += $suboptions['selectedrecurring'];
            $totaltoday += $suboptions['selectedrecurring'];
            if ($billingcycle == "monthly") 
            {
                $total_recurring_monthly += $suboptions['selectedrecurring'];
            }
            if ($billingcycle == "quarterly") 
            {
                $total_recurring_quarterly += $suboptions['selectedrecurring'];
            }
            if ($billingcycle == "semiannually") 
            {
                $total_recurring_semiannually += $suboptions['selectedrecurring'];
            }
            if ($billingcycle == "annually") 
            {
                $total_recurring_annually += $suboptions['selectedrecurring'];
            }
            if ($billingcycle == "biennially") 
            {
                $total_recurring_biennially += $suboptions['selectedrecurring'];
            }
            if ($billingcycle == "triennially") 
            {
                $total_recurring_triennially += $suboptions['selectedrecurring'];
            }
            if (!empty($suboptions['selectedrecurring'])) 
            {
                $selconfigopts[] = array("selectedname" => $suboptions['selectedname'],"options"=>$suboptions['options'], "selectedrecurring" => $suboptions['selectedrecurring'], "optionname" => $suboptions['optionname'], "configid" => $suboptions['id'], "sub_id" => $suboptions['selectedvalue']);
            }
            #start toatltoday
            foreach ($suboptions['options'] as $option) 
            {
                if($option['nameonly']==$suboptions['selectedname'])
                {
                    $totaltoday=$totaltoday+$option['setup'];
                    $config_setup_fee+=$option['setup'];
                }
            }
            #end totaltoday
        }
        $selected_config_options_price_with_setup = $selected_config_options_price+$config_setup_fee;
        
        if ($CONFIG['TaxEnabled'])
        {
            $taxdata = getTax_Rate(1, $state, $country);
            $taxname = $taxdata['name'];
            $taxrate = $taxdata['rate'];
            $rawtaxrate = $taxrate;
            $inctaxrate = $taxrate / 100 + 1;
            $taxrate /= 100;
            
            $taxdata2 = getTax_Rate(2, $state, $country);
            $taxname2 = $taxdata2['name'];
            $taxrate2 = $taxdata2['rate'];
            $rawtaxrate2 = $taxrate2;
            $inctaxrate2 = $taxrate2 / 100 + 1;
            $taxrate2 /= 100;
        }

        if ($CONFIG['TaxInclusiveDeduct'] && ((!$taxrate && !$taxrate2) || $clientsdetails['taxexempt'])) 
        {
            $result = select_query("tbltax", "", "");
            $data = mysql_fetch_array($result);
            $excltaxrate = 1 + $data['taxrate'] / 100;
        }
        else
        {
            $CONFIG['TaxInclusiveDeduct'] = 0;
        }

        $total_recurring += $selected_product_price + $selected_addon_price + $selected_config_options_price;
        $totaltoday += $selected_product_price;
        $totdaytoday_withouttax = $totaltoday;
        
                                        #start domain tax added
        
        if(($countproductids - 1) == $key_session)
        {
            if (!empty($_REQUEST['regdomain'])) 
            {
                $domainprice = $_REQUEST['domaincost'];
               
                if ($CONFIG['TaxInclusiveDeduct']) 
                {
                    $domainprice = round($_REQUEST['domaincost'] / $excltaxrate, 2);
                }
                

            }
        }
        #End tax added
        
        if (isset($_REQUEST['domain']) && !empty($_REQUEST['domain']) && $_REQUEST['domain'] != "undefined") 
        {
            $transfer_sld = $_REQUEST['domain'];
            $transfer_tld = $_REQUEST['transfertld'];
            $eppcode = $_REQUEST['eppcode'];
            if (checkDomainisValid($transfer_sld, $transfer_tld)) {
                $result=OnePageCartClass::DomainWhois($transfer_sld.$transfer_tld);
               // print_r($result);
                //$result = lookupDomain($transfer_sld, $transfer_tld);
                if ($result['status'] == "unavailable") {
                    $price = getTLDPriceList_modified($transfer_tld, $currencyID, "transfer");
                    $totaltoday += $price;
                    $total_recurring_annually += $price;
                    $domains = array(
                        "cost" => $price,
                        "full" => $transfer_sld . $transfer_tld,
                        "tld" => $transfer_tld,
                        "transfer" => TRUE,
                        "epp" => $eppcode
                    );
                    $DomainResult = array(
                        "domaintype" => "transfer",
                        "transfer" => TRUE
                    );
                    $TransferDomains = $domains;
                } else {
                    $DomainResult = array(
                        "domaintype" => "transfer",
                        "transfer" => FALSE
                    );
                    #custom
                    $selectedsession_domains[$key_session] = '';
                }
            }
        }

        if (isset($_REQUEST['owndomain']) && !empty($_REQUEST['transfertld']) && $_REQUEST['transfertld'] != "undefined") {
            $DomainResult = array(
                "domaintype" => "owndomain",
                "transfer" => FALSE
            );
            $owndomain_sld = $_REQUEST['owndomain'];
            $owndomain_tld = $_REQUEST['transfertld'];
            $domains = array(
                "cost" => "0.00",
                "full" => $owndomain_sld . $owndomain_tld,
                "tld" => $owndomain_tld,
                "transfer" => FALSE
            );
            $owndomainDomains = $domains;
        }


        /*         * ******additional products details started********** */

        $result = select_query("tblproducts", "tblproducts.id,tblproducts.gid,tblproductgroups.name AS groupname,tblproducts.name,tblproducts.paytype,tblproducts.allowqty,tblproducts.proratabilling,tblproducts.proratadate,tblproducts.proratachargenextmonth,tblproducts.tax,tblproducts.servertype,tblproducts.servergroup,tblproducts.stockcontrol,tblproducts.freedomain,tblproducts.freedomainpaymentterms,tblproducts.freedomaintlds", array("tblproducts.id" => $pid), "", "", "", "tblproductgroups ON tblproductgroups.id=tblproducts.gid");
        $data = mysql_fetch_array($result);
        $product_tax_enable = $data['tax'];
        /*         * ******additional products details ended********** */
        #start tax added
        $tax1=$total_tax_1=$total_tax_2=0;
        $tax2=0;
        
        
        
        if (isset($_SESSION['alldomainsselected']) && is_array($_SESSION['alldomainsselected'])) {
            $domain_with_price = $domaintypes = $alldomainsselected = array();
            $i = 0;
            foreach ($_SESSION['alldomainsselected'] as $domain => $domaintype) {

                if (is_numeric($removeitem) && $removeitemtype == "d" && $i == $removeitem) {
                    $i++;
                    continue;
                }
                $alldomainsselected[$domain] = $domaintype;
                $domaintypes[] = $domaintype;
                if (strpos($domain, '.') !== false) {
                    $lookuptld_exploded = explode(".", $domain);
                    $lookuptld_without_dot = $lookuptld_exploded[1];
                }
                $domainprice = getTLDPriceList_modified("." . $lookuptld_without_dot, $currencyID, $domaintype);
                $domainprice = !empty($domainprice) ? $domainprice : "0.00";
                $domain_with_price[$domain] = array("price" => $domainprice, "type" => $domaintype, "domainkey" => $i);
                $i++;
                if ($key_session == "0") {
                    $totaltoday += $domainprice;
                    $total_recurring_annually += $domainprice;
                }
            }
            $domainkey = 0;
            foreach ($domain_with_price as $dwithpricekey => $dwithpriceval) {
                $domain_with_price[$dwithpricekey] = array("price" => $dwithpriceval['price'], "type" => $dwithpriceval['type'], "domainkey" => $domainkey++);
            }
            $_SESSION['alldomainsselected'] = $alldomainsselected;
            $_SESSION['alldomainsselectedtypes'] = $domaintypes;
        }
        
        
                                                #Promo code start
        $promocode = $_REQUEST['promo'];
        
        if(($countproductids - 1) == $key_session)
        {
            $_SESSION['promocode'][$key_session] = $_REQUEST['promo'];
        }
        
        
        if(empty($promocode))
        {
            foreach ($_SESSION['promocode'] as $code) 
            {
                if(!empty($code))
                {
                    $promocode = $code;
                    break;
                }
            }
        }
        $c = $billingcycle;
        $discount = 0;
        if (isset($promocode)) 
        {
            if (!empty($promocode)) 
            {
                $results_getpromotions = promocode($promocode, $pid, $total_recurring,$billingcycle);
                if ($results_getpromotions && count($results_getpromotions) > 0) 
                {
                    if (isset($results_getpromotions['pre'])) 
                    {
                        $totaltoday -= $results_getpromotions['pre'];
                        $discount = $results_getpromotions['pre'];
                    }
                    $promocode_result = array(
                                                'code' => $promocode,
                                                'extra' => $results_getpromotions,
                                                'used' => TRUE
                                            );
                    if(($countproductids - 1) == $key_session)
                    {
                        $_SESSION['promocode_result'][$key_session] = $promocode_result;
                    }
                }
                else
                {
                    #here to add
                    foreach ($_SESSION['promocode_result'] as $code_result) 
                    {
                        if(!empty($code_result))
                        {
                            $promocode_result = $code_result;
                            break;
                        }
                    }
                    
                    if(empty($promocode_result))
                    {
                        $promocode_result = array(
                                           'code' => $promocode,
                                           'extra' =>
                                            array(
                                                    'applies' => FALSE,
                                                    'recurring' => NULL,
                                                ),
                                            'used' => FALSE
                                        );
                    }
                    
                }
            }
            else
            {
                $promocode_result = array(
                                            'extra' =>
                                                        array(
                                                                'applies' => FALSE,
                                                                'recurring' => NULL,
                                                            ),
                                        );
            }
        }
        
        
        
        
        
        
        $tableimg = "ProductWithImgage_ImageData";
        $fieldsimg = "image_name,product_id";
        $resultimg = select_query($table, $fields, array("product_id" => '2'));
        $resultimg = "select * from opc_images where relid =" . $pid . " and type='products' ";
        $res = mysql_query($resultimg);
        
        $dataimage = mysql_fetch_array($res);
        if ($selected_product_price == NULL || $product_paytype == "free") 
        {
            $selected_product_price = "0.00";
//        $totaltoday = $total_recurring = 0;
        }
        
        if ($product_paytype == "onetime") 
        {
            $billingcycle = "onetime";
            $setupfee=$monthly_price_setup;
        }

        if ($billingcycle == "monthly") 
        {
            $total_recurring_monthly += $selected_product_price+$tax1 + $tax2;
            $setupfee=$monthly_price_setup;
        }
        if ($billingcycle == "quarterly") 
        {
            $total_recurring_quarterly += $selected_product_price+$tax1 + $tax2;
            $setupfee=$quarterly_price_setup;
        }
        if ($billingcycle == "semiannually") 
        {
            $total_recurring_semiannually += $selected_product_price+$tax1 + $tax2;
            $setupfee=$semiannually_price_setup;
        }
        if ($billingcycle == "annually")
        {
            $total_recurring_annually += $selected_product_price+$tax1 + $tax2;
            $setupfee=$anually_price_setup;
        }
        if ($billingcycle == "biennially") 
        {
            $total_recurring_biennially += $selected_product_price+$tax1 + $tax2;
            $setupfee=$biennially_price_setup;
        }
        if ($billingcycle == "triennially") 
        {
            $total_recurring_triennially += $selected_product_price+$tax1 + $tax2;
            $setupfee=$triennially_price_setup;
        }
        $setupfee=floatval($setupfee);
        $selected_product_price = $setupfee + $selected_product_price;
	$totaltoday += $setupfee;
	$selected_product_price = number_format($selected_product_price, 2, '.', '');
        
        
                                                    #start tax
        
        if (($CONFIG['TaxEnabled']) && !$clientsdetails['taxexempt']) 
        {
            if($product_tax_enable)
            {
                $total_taxable_price += ($selected_product_price-$discount)+$selected_config_options_price_with_setup;
            }
           
            if ($CONFIG['TaxDomains']) 
            {
                $total_taxable_price += $domainprice;
            }
            
            
            if ($CONFIG['TaxType'] == "Exclusive") 
            {
                $total_tax_1 = $total_taxable_price * $taxrate;
                
                if ($CONFIG['TaxL2Compound']) 
                {
                    $total_tax_2 = ($total_taxable_price + $total_tax_1) * $taxrate2;
                } 
                else
                {
                    $total_tax_2 = $total_taxable_price * $taxrate2;
                }
                
                $total_tax_2 = round($total_tax_2, 2);
                
                if (0 < $total_tax_1) 
                {
                    $tax1 = ($total_tax_1);
                    $tax1_name=$taxname." @ ".$rawtaxrate."%";
                }
                if (0 < $total_tax_2) 
                {
                    $tax2 = ($total_tax_2);
                    $tax2_name=$taxname2." @ ".$rawtaxrate2."%";
                }
            }
        }
        
        $vattoday1=$vattoday2=0;
        $totaltoday_withtax=$totaltoday;
        
        if ($_REQUEST['vatexempt'] == "no")
        {
            $vattoday1 = $tax1;
            $vattoday2 = $tax2;
            $totaltoday_withtax += $vattoday1+$vattoday2;

            if(!isset($_SESSION['tax'][$key_session]) && $_REQUEST['producttoadd']=='add')
            {
                #first time
                $_SESSION['tax'][$key_session]=array("vattoday1"=>$vattoday1,"vattoday2"=>$vattoday2);
                $total_tax=$total_tax+$vattoday1+$vattoday2;
            }
            else if(isset($_SESSION['tax'][$key_session]) && $_REQUEST['producttoadd']!='add' && ($countproductids - 1) == $key_session )
            {
              
                $_SESSION['tax'][$key_session]=array("vattoday1"=>$vattoday1,"vattoday2"=>$vattoday2);
                $total_tax=$total_tax+$vattoday1+$vattoday2;  
            }
            else
            {
                #previous
                $total_tax = $total_tax+$_SESSION['tax'][$key_session][0]['vattoday1']+$_SESSION['tax'][$key_session][0]['vattoday2'];
                $vattoday1 = $_SESSION['tax'][$key_session][0]['vattoday1'];
                $vattoday2=$_SESSION['tax'][$key_session][0]['vattoday2'];
            }
            
        }
        #End Tax added
        #end configuration option tax
        
        
        $productwithdomain = "";
        $domainaddonexist=FALSE;
        $tld='';
        if (is_array($TransferDomains) && isset($TransferDomains)) 
        {
            $productwithdomain = $TransferDomains;
            $domainaddonexist=TRUE;
            $tld=$_REQUEST['transfertld'];
        }
        if (is_array($owndomainDomains) && isset($owndomainDomains)) 
        {
            $productwithdomain = $owndomainDomains;
        }
        if (isset($_REQUEST['regdomain']) && !empty($_REQUEST['regdomain']) && $_REQUEST['regdomain'] != "undefined") 
        {
            $domainaddonexist=TRUE;
            $tld=$_REQUEST['tld'];
            if ($_REQUEST['privreg'] == "yes") 
            {
                $private_status = TRUE;
            }
            else
            {
                $private_status = FALSE;
            }
            $domains = array(
                            "cost" => $_REQUEST['domaincost'],
                            "full" => $_REQUEST['regdomain'],
                            "private" => $private_status,
                            "recurring" => NULL,
                            "tld" => NULL,
                            "register" => TRUE
                        );
            $productwithdomain = $domains;
        }
        #Start Domain Addon
        if($domainaddonexist)
        {
            $domain_addon_response = OnePageCartClass::getDomainAddon($tld);
            $domainAddonPrice = OnePageCartClass::getDomainAddonPrice($currency['id']);
            
            $domainaddon=array();
            if($domain_addon_response['status']=='success' && !empty($domain_addon_response['data']))
            {
                if($domain_addon_response['data'][0]->dnsmanagement=='on')
                {
                    $domainaddon['dnsmanagement']='on';
                    $domainaddon['dnsmanagement_price']=$domainAddonPrice['data'][0]->msetupfee;
                }
                if($domain_addon_response['data'][0]->emailforwarding=='on')
                {
                    $domainaddon['emailforwarding']='on';
                    $domainaddon['emailforwarding_price']=$domainAddonPrice['data'][0]->qsetupfee;
                }
                if($domain_addon_response['data'][0]->idprotection=='on')
                {
                    $domainaddon['idprotection']='on';
                    $domainaddon['idprotection_price']=$domainAddonPrice['data'][0]->ssetupfee;
                }
            }
            
        }
        #session
        $domainaddonselected=array();
        if(empty($_SESSION['domainaddonselected'][$key_session]) || ($countproductids - 1) == $key_session)
        {
            #First Time
            $domainaddonselected['dnsmanagement']=$_REQUEST['dnsmanagement'];
            $domainaddonselected['emailforwarding']=$_REQUEST['emailforwarding'];
            $domainaddonselected['idprotection']=$_REQUEST['idprotection'];
            $_SESSION['domainaddonselected'][$key_session]=$domainaddonselected;
        }
        else
        {
            $domainaddonselected=$_SESSION['domainaddonselected'][$key_session];
        }
        
        #Adding Price
        foreach ($domainaddonselected as $key => $value)
        {
            if($key=='dnsmanagement' && $value=='on')
            {
                $totaltoday += $domainAddonPrice['data'][0]->msetupfee;
            }
            if($key=='emailforwarding' && $value=='on')
            {
                $totaltoday += $domainAddonPrice['data'][0]->qsetupfee;
            }
            if($key=='idprotection' && $value=='on')
            {
                $totaltoday += $domainAddonPrice['data'][0]->ssetupfee;
            }
        }
        #End Domain Addon
        
        if (isset($selectedsession_domains[$key_session]) && !empty($selectedsession_domains[$key_session])) {
            if ($removeitemtype == "pd" && $key_session == $removeitem) {
                $_SESSION['productwithdomain'][$key_session] = "";
            } else {
                if (!empty($productwithdomain) && $producttoeditkey == $key_session) {
                    $_SESSION['productwithdomain'][$key_session] = $productwithdomain;
                } else {

                    $productwithdomain = $selectedsession_domains[$key_session];
                    $total_recurring_annually += $selectedsession_domains[$key_session]['cost'];
                    $totaltoday += $selectedsession_domains[$key_session]['cost'];
                    $totaltoday_withtax +=$selectedsession_domains[$key_session]['cost'];
                    $_SESSION['productwithdomain'][$key_session] = $productwithdomain;
                }
            }
        } else {
            if ($producttoeditkey != $key_session) {
                $productwithdomain = "";
                $_SESSION['productwithdomain'][$key_session] = "";
            }
        }
        if ($productwithdomain['cost'] == "undefined") {
            $productwithdomain = "";
        }

        $configAddonArray = Capsule::table('tbladdons')
                ->join('tblpricing', 'tbladdons.id', '=', 'tblpricing.relid')
                ->whereRaw("find_in_set('" . $pid . "',tbladdons.packages)")
                ->where("tblpricing.currency", '=', $CurrencyId)
                ->where("tblpricing.type", '=', 'addon')
                ->select('tbladdons.id as addonpackageid'
                        , 'tbladdons.name as addonpackagename'
                        , 'tbladdons.billingcycle as addonpackagebillingcycle'
                        , 'tblpricing.monthly as addonpackagemonthly'
                        , 'tblpricing.quarterly as addonpackagequarterly'
                        , 'tblpricing.semiannually as addonpackagesemiannually'
                        , 'tblpricing.annually as addonpackageannually'
                        , 'tblpricing.biennially as addonpackagebiennially'
                        , 'tblpricing.triennially as addonpackagetriennially'
                        , 'tblpricing.msetupfee as addonpackagemsetupfee'
                        , 'tblpricing.qsetupfee as addonpackageqsetupfee'
                        , 'tblpricing.ssetupfee as addonpackagessetupfee'
                        , 'tblpricing.asetupfee as addonpackageasetupfee'
                        , 'tblpricing.bsetupfee as addonpackagebsetupfee'
                        , 'tblpricing.tsetupfee as addonpackagetsetupfee'
                )
                ->get();

        $MainProducts[] = array(
            'setupfee' => $setupfee,
            "producttax"=>($tax1 + $tax2),
            'session_productid' => $key_session,
            'pricing' => $pricing,
            'productwithdomain' => $productwithdomain,
            'domainaddon'=>$domainaddon,
            'domainaddonselected'=>$domainaddonselected,
            'id' => $pid,
            'product_type' => $product_type,
            'addons' => $addons,
            'addon_selected' => (isset($formatselectedAddons) && !empty($formatselectedAddons) && count($formatselectedAddons) > 0) ? $formatselectedAddons : '',
            'customfields'=>(!empty($customfields))?$customfields:'null',
            'discount' => $discount,//array('applies' => false),
            'billingcycle' => empty($billingcycle)?"Free":$billingcycle,
            'paytype' => $product_paytype,
            'totaltoday' => $selected_product_price,
            'addonsData' => $configAddonArray,
            'totalrecurring' => $selected_product_price,
            'productprice' => $selected_product_price,
            'productorig' => $selected_product_price,
            'productimage' => $dataimage['imagepath'],
            'productrecur' => $selected_product_price,
            'name' => $product_name,
            'freedomain' => 'no',
            'domainprice' => NULL,
            'configoptionsManual2' => (!empty($configoptionsManual2))?$configoptionsManual2:'null',
            'temops' => $FinalCalculationOFConfigOption,//array('1' => array('quarterly' => '2'),'3' => array('quarterly' => '1')),
            'SelectedConfigOption' => (!empty($SelectedConfigOptionArray))?$SelectedConfigOptionArray:'null',
            'BillingCycle12' => (!empty($BillingCycle12))?$BillingCycle12:'null',
            'selconfigopts' => (isset($selconfigopts) && !empty($selconfigopts) && count($selconfigopts) > 0) ? $selconfigopts : '',
            'configureserver' => $selectedconfigureserverArray
        );
        $producttoedit = $key_session;
    }


    /*echo "<pre>";print_r($MainProducts);die();*/

    if (isset($_REQUEST['regdomain']) && !empty($_REQUEST['regdomain'])) {
        $total_recurring_annually += $_REQUEST['domaincost'];
        $totaltoday += $_REQUEST['domaincost'];
        $totaltoday_withtax += $_REQUEST['domaincost'];
    }

    if(isset($FinalCalculationOFConfigOption) && $FinalCalculationOFConfigOption != "")
    {
        $totaltoday = $FinalCalculationOFConfigOption+$totaltoday;
        $totaltoday_withtax = $FinalCalculationOFConfigOption+$totaltoday;
    }

    $MainCartResult = array(
        'cfields' => NULL,
        'promo' => $promocode_result,
        'products' => $MainProducts,
        'totaltoday' => $totaltoday,//$totaltoday_withtax,//$totaltoday
        'totaltoday_withouttax' => $totaltoday,
        'totalrecurring' => $total_recurring,
        'vattoday' => $vattoday,
        'tax_session'=>$_SESSION['tax'],
        'tax1_name'=>$tax1_name,
        'tax2_name'=>$tax2_name,
        'toatlvattoday1'=>$vattoday1,
        'toatlvattoday2'=>$vattoday2,
        'currency_prefix' => $_SESSION['onepagecart_active_currency']['prefix'],
        'currency_surfix' => $_SESSION['onepagecart_active_currency']['suffix'],
        'billingcycle' => $editproduct == TRUE ? $editedproductbillingcycle : $billingcycle,
        'totalrecurringmonthly' => $total_recurring_monthly,
        'totalrecurringquarterly' => $total_recurring_quarterly,
        'totalrecurringsemiannually' => $total_recurring_semiannually,
        'totalrecurringannually' => $total_recurring_annually,
        'totalrecurringbiennially' => $total_recurring_biennially,
        'totalrecurringtriennially' => $total_recurring_triennially,
        'domains' => $domain_with_price,

    );
    

    if (is_array($DomainResult)) {
        $MainCartResult['domainresult'] = $DomainResult;
    }
    if ($_REQUEST['vatexempt'] == "no") 
    {
        if ($vattoday != null)
        {
            $MainCartResult['vattoday'] = $vattoday;
            
        }
    }
    if (isset($formatselectedAddons) && !empty($formatselectedAddons) && count($formatselectedAddons) > 0) {
        $MainCartResult['addons'] = $formatselectedAddons;
    }

    $result = json_encode($MainCartResult);
// if ($_REQUEST['addtocart'] == "true") {
    $_SESSION['onepagecart_mainsession'] = $MainCartResult;
// }
    echo $result;

    //print_r($_SESSION);
}
else
{
    $totaltoday = $total_recurring = 0;
    if (isset($_SESSION['alldomainsselected']) && is_array($_SESSION['alldomainsselected'])) 
    {
        $currencyCode = $_SESSION['onepagecart_active_currency']['code'];
        $currencyID = $_SESSION['onepagecart_active_currency']['id'];
        
        $domain_with_price = $domaintypes = $alldomainsselected = array();
        $i = 0;
        foreach ($_SESSION['alldomainsselected'] as $domain => $domaintype) {
            if (is_numeric($removeitem) && $removeitemtype == "d" && $i == $removeitem) {
                $i++;
                continue;
            }
            $alldomainsselected[$domain] = $domaintype;
            $domaintypes[] = $domaintype;
            if (strpos($domain, '.') !== false) {
                $lookuptld_exploded = explode(".", $domain);
                $lookuptld_without_dot = $lookuptld_exploded[1];
            }
            $domainprice = getTLDPriceList_modified("." . $lookuptld_without_dot, $currencyID, $domaintype);
            $domainprice = !empty($domainprice) ? $domainprice : "0.00";
            $domain_with_price[$domain] = array("price" => $domainprice, "type" => $domaintype, "domainkey" => $i);
            $i++;
            $totaltoday += $domainprice;
            $total_recurring_annually += $domainprice;
        }
        $domainkey = 0;
        foreach ($domain_with_price as $dwithpricekey => $dwithpriceval) {
            $domain_with_price[$dwithpricekey] = array("price" => $dwithpriceval['price'], "type" => $dwithpriceval['type'], "domainkey" => $domainkey++);
        }

        $_SESSION['alldomainsselected'] = $alldomainsselected;
        $_SESSION['alldomainsselectedtypes'] = $domaintypes;

        if (isset($promocode)) {
            if (!empty($promocode)) {
                $results_getpromotions = promocode($promocode, $pid, $total_recurring);
                if ($results_getpromotions && count($results_getpromotions) > 0) {
                    if (isset($results_getpromotions['pre'])) {
                        $totaltoday -= $results_getpromotions['pre'];
                    }
                    $promocode_result = array(
                        'code' => $promocode,
                        'extra' => $results_getpromotions,
                        'used' => TRUE
                    );
                } else {
                    $promocode_result = array(
                        'code' => $promocode,
                        'extra' =>
                        array(
                            'applies' => FALSE,
                            'recurring' => NULL,
                        ),
                        'used' => FALSE
                    );
                }
            } else {
                $promocode_result = array(
                    'extra' =>
                    array(
                        'applies' => FALSE,
                        'recurring' => NULL,
                    ),
                );
            }
        }
         if(isset($FinalCalculationOFConfigOption) && $FinalCalculationOFConfigOption != "")
        {
            $totaltoday = $FinalCalculationOFConfigOption+$totaltoday;
            $totaltoday_withtax = $FinalCalculationOFConfigOption+$totaltoday;
        }
        $MainCartResult = array(
            'promo' => $promocode_result,
            'totaltoday' => $totaltoday,
            'domains' => $domain_with_price,
        );
        $result = json_encode($MainCartResult);
        $_SESSION['onepagecart_mainsession'] = $MainCartResult;
        echo $result;
    }
    else
    {
        $MainCartResult = array(
                                    'cart' =>"empty",
                                    'currency_prefix' => $_SESSION['onepagecart_active_currency']['prefix'],
        );
        $result = json_encode($MainCartResult);
        echo $result;
    }
}


function reseller_getProductConfigOption($pid = "", $currency = "") {

                $ReturnDataArray = array();
                $productdata = Capsule::table('tblproductconfiglinks')
                        ->join('tblproductconfigoptions', 'tblproductconfiglinks.gid', '=', 'tblproductconfigoptions.gid')
                        ->join('tblproductconfigoptionssub', 'tblproductconfigoptions.id', '=', 'tblproductconfigoptionssub.configid')
                        ->join('tblpricing', 'tblproductconfigoptionssub.id', '=', 'tblpricing.relid')
                        ->select('tblproductconfigoptions.*'
                                , 'tblpricing.monthly as monthly'
                                , 'tblpricing.quarterly as quarterly'
                                , 'tblpricing.semiannually as semiannually'
                                , 'tblpricing.annually as annually'
                                , 'tblpricing.biennially as biennially'
                                , 'tblpricing.triennially as triennially'
                        )
                        ->where('tblproductconfiglinks.pid', '=', $pid)
                        ->where('tblpricing.type', '=', 'configoptions')
                        ->where('tblpricing.currency', '=', $currency)
                        ->get();
                $productdata = json_decode(json_encode($productdata), TRUE);
                $ReturnDataArray = array();
                if (!empty($productdata)) {
                    $NewArrayForDervision = array();
                    $NewArrayForDervision2 = array();
                    foreach ($productdata as $key => $val) {
                        $NewArrayForDervision2['id'] = $val['id'];
                        $NewArrayForDervision2['gid'] = $val['gid'];
                        $NewArrayForDervision2['optionname'] = $val['optionname'];
                        $NewArrayForDervision2['optiontype'] = $val['optiontype'];
                        $NewArrayForDervision2['qtyminimum'] = $val['qtyminimum'];
                        $NewArrayForDervision2['qtymaximum'] = $val['qtymaximum'];
                        $NewArrayForDervision2['order'] = $val['order'];
                        $NewArrayForDervision2['hidden'] = $val['hidden'];
                        $NewArrayForDervision2['pricetype'] = array(
                            'monthly' => $val['monthly'],
                            'quarterly' => $val['quarterly'],
                            'semiannually' => $val['semiannually'],
                            'annually' => $val['annually'],
                            'biennially' => $val['biennially'],
                            'triennially' => $val['triennially'],
                        );
                        $NewArrayForDervision[] = $NewArrayForDervision2;
                    }
                }
                $ReturnDataArray = $NewArrayForDervision;

                return $ReturnDataArray;
            }

    function reseller_getBillingCycleFun($productid,$currency) {
        $ReturnArray = array();
        $productcycle = Capsule::table('tblproducts')
        ->join('tblpricing', 'tblproducts.id', '=', 'tblpricing.relid')
        ->where('tblpricing.relid', '=', $productid)
        ->where('tblpricing.type', '=', 'product')
        ->where('tblpricing.currency', '=', $currency)
        ->where('tblproducts.paytype', '!=', 'free')
        ->select('tblpricing.*', 'tblproducts.paytype')
        ->get();
        if(!empty($productcycle))
        {
            $ReturnArray = $productcycle;
        }
        return $ReturnArray;
    }
?>