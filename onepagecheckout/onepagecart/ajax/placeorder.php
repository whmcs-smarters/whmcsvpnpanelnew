<?php

require_once '../../../init.php';

require_once '../onepagecart.Class.php';

//require_once "../../../includes/api.php";

require_once "../../../includes/ccfunctions.php";

require_once "../../../includes/clientfunctions.php";

require_once "../../../includes/gatewayfunctions.php";

require_once "../../../includes/invoicefunctions.php";


$phone_number = $_REQUEST['phonenumber'];

$password = $_REQUEST['password'];

$domain = $_REQUEST['domain'];

$owndomain = $_REQUEST['owndomain'];

$owndomain1 = $_REQUEST['owndomain1'];

$owndomaindropdown = $_REQUEST['owndomaindropdown'];

$domain_selected = $_REQUEST['domain_select'];

$gatewayid = $_REQUEST['gatewayid'];

$error = $data = array();


if (empty($_SESSION['uid']) && $_REQUEST['account_type'] == "create")

{

    if (strlen($phone_number) != 10) {

        $error[]['message'] = "You must enter your phone number in the full ten digit format. For example: 5555555555";

    }

    if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,30}$/', $password)) {

        $error[]['message'] = 'The password entered did not meet the minimum requirements. A password must contain at least one letter, one number, and be at least 8 characters in length. <br> A  

  Password should also contain both upper and lowercase letters, and at least one symbol.';

    }

}



if (!isset($_REQUEST['paymenttype'])) {

    $error[]['message'] = "Please select any payment method.";

}



if ($_REQUEST['paymenttype'] != "paypal" && $_REQUEST['paymenttype'] != "payu" && $_REQUEST['paymenttype'] != "ebs") {

//    if (isset($_REQUEST['ccnumber']) && empty($_REQUEST['ccnumber'])) {

//        $error[]['message'] = "You must enter your credit card number to continue.";

//    }

//    if (isset($_REQUEST['cccvv']) && empty($_REQUEST['cccvv'])) {

//        $error[]['message'] = "You must enter your credit card's CVC number.";

//    }

//    if (isset($_REQUEST['ccexpirydate']) && empty($_REQUEST['ccexpirydate'])) {

//        $error[]['message'] = "You did not enter the card expiry date.";

//    } else {

//        $expirationdate = str_replace(' ', '', $_REQUEST['ccexpirydate']);

//        $expmonth = substr($expirationdate, 0, 2);

//        $expyear = substr($expirationdate, 5);

//        if ($expmonth < date("m") && "20" . $expyear <= date("Y")) {

//            $error[]['message'] = "The expiry date must be entered in the format MM/YY and must not be in the past.";

//        } else {

//            if ("20" . $expyear <= date("Y")) {

//                $error[]['message'] = "The expiry date must be entered in the format MM/YY and must not be in the past.";

//            }

//        }

//    }

//

//    $cardnumber = (isset($_REQUEST['ccnumber']) ? str_replace(' ', '', $_REQUEST['ccnumber']) : "");

//    $ccexpirymonth = (isset($expmonth) ? $expmonth : "");

//    $ccexpiryyear = (isset($expyear) ? $expyear : "");

//    $cvc = (isset($_REQUEST['cccvv']) ? $_REQUEST['cccvv'] : "");

}



if (!isset($_REQUEST['accepttos'])) {

    $error[]['message'] = "You must agree to the terms of service.";

}



if ($_REQUEST['paymenttype'] == "stripe") 

{

    if (empty($_POST['stripeToken']) && empty($gatewayid)) 

    {

        $error[]['message'] = "Strip token or gateway id not found.";

        $data['status'] = "creditcard_error";

        $data['errors'] = $error;

        $result = json_encode($data);

        echo $result;

        exit;

    }

}



if (!empty($error) && count($error) > 0)

{

    $data['errors'] = $error;

    $data['status'] = "failure";

} 

else

{

    $resellerdetails = OnePageCartClass::GetClientsDetails($_SESSION['resellerid']);

    $reselleremail = $affdetails['email'];

    $affid = OnePageCartClass::getWHMCSaffidOP();

    $values = array();

    $values["firstname"] = $_REQUEST['firstname'];

    $values["lastname"] = $_REQUEST['lastname'];

    $values["companyname"] = $_REQUEST['company'];

    $values["email"] = $_REQUEST['email'];

    $values["address1"] = $_REQUEST['address1'];

    $values["address2"] = $_REQUEST['address2'];

    $values["city"] = $_REQUEST['city'];

    $values["state"] = $_REQUEST['state'];

    $values["postcode"] = $_REQUEST['postcode'];

    $values["country"] = $_REQUEST['country'];

    $values["phonenumber"] = $_REQUEST['phonenumber'];

    $values["password2"] = $_REQUEST['password'];

    $values['customfields'] = base64_encode(serialize($_POST['clientcustomfield']));

    $values['notes'] = 'Created by:'.$reselleremail.'';

    $values["currency"] = !empty($_SESSION['onepagecart_active_currency']['id']) ? $_SESSION['onepagecart_active_currency']['id'] : 1;



    if (!empty($_SESSION['uid']))

    {

        $getclientdetails_result = OnePageCartClass::GetClientsDetails($_SESSION['uid']);

        $clientid = $getclientdetails_result['userid'];

        $clientemail = $getclientdetails_result['email'];

        $productids = $addonids = $domainname = $domaintype = $domainepp = $regperiod = $configoptions = $configureserver_hostname = $configureserver_ns1prefix = $configureserver_ns2prefix = $configureserver_rootpw = array();

        $hostname = $ns1prefix = $ns2prefix = $rootpw = "";



        foreach ($_SESSION['onepagecart_mainsession']['products'] as $key_product => $product)

        {

            $addonidsstring = $productwithdomainname = $productwithdomaintype = $registrationperiod = $productwithdomainepp = "";

            $Configarray = array();

            if (!empty($product['addon_selected']) && is_array($product['addon_selected']) && count($product['addon_selected']) > 0) {

                foreach ($product['addon_selected'] as $addonkey => $addon) {

                    $addonidsstring .= $addon['id'] . ",";

                }

            }



            //new start

            if (!empty($product['selconfigopts']) && is_array($product['selconfigopts']) && count($product['selconfigopts']) > 0) {

                foreach ($product['selconfigopts'] as $configkey => $configvalue) {

                    $Configarray[$configvalue['configid']] = $configvalue['sub_id'];

                }

            }

            #checking domain 

            $ProductInfo = OnePageCartClass::getProductInfo($product['id']);

            if ($ProductInfo['status'] == "success")

            {

                $ShowDomainOptions = $ProductInfo['data'][0]->showdomainoptions;

                $productName = $ProductInfo['data'][0]->name;

            }

            if ($ShowDomainOptions && empty($product['productwithdomain']['full']))

            {

                $error[]['message'] = "You must set a domain either by registration, or using a existing domain for ".$productName;

                $data['errors'] = $error;

                $data['status'] = "failure";

                $result = json_encode($data);

                echo $result;

                exit();

            }

            

            //new end

            if (!empty($product['productwithdomain']) && is_array($product['productwithdomain']) && count($product['productwithdomain']) > 0)

            {

                if (isset($product['productwithdomain']['register']) && $product['productwithdomain']['register'] == true)

                {

                    $productwithdomainname = $product['productwithdomain']['full'];

                    $productwithdomaintype = "register";

                    $registrationperiod = "1";

                }

                if (isset($product['productwithdomain']['transfer']) && $product['productwithdomain']['transfer'] == true) 

                {

                    $productwithdomainname = $product['productwithdomain']['full'];

                    $productwithdomaintype = "transfer";

                    $registrationperiod = "1";

                    $productwithdomainepp = $product['productwithdomain']['epp'];

                }

                if (isset($product['productwithdomain']['transfer']) && $product['productwithdomain']['transfer'] == false) 

                {

                    $productwithdomainname = $product['productwithdomain']['full'];

                }

            }

            if ($product['product_type'] == "server") {

                if (!empty($product['configureserver']) && is_array($product['configureserver']) && count($product['configureserver']) > 0) {

                    $hostname = $product['configureserver']['hostname'];

                    $ns1prefix = $product['configureserver']['ns1prefix'];

                    $ns2prefix = $product['configureserver']['ns2prefix'];

                    $rootpw = $product['configureserver']['rootpw'];

                }

            }



            $configureserver_hostname[$key_product] = $hostname;

            $configureserver_ns1prefix[$key_product] = $ns1prefix;

            $configureserver_ns2prefix[$key_product] = $ns2prefix;

            $configureserver_rootpw[$key_product] = $rootpw;

            $addonidsstring = rtrim($addonidsstring, ", ");

            $addonids[$key_product] = $addonidsstring;

            $domainname[$key_product] = $productwithdomainname;

            $domainepp[$key_product] = $productwithdomainepp;

            $domaintype[$key_product] = $productwithdomaintype;

            $regperiod[$key_product] = $registrationperiod;

            $configoptions[$key_product] = base64_encode(serialize($Configarray));

            $productids[] = $product['id'];



            #start domain addon

            $domain_emailforwarding[$key_product] = $product['domainaddonselected']['emailforwarding'] === 'on' ? TRUE : FALSE;

            $domain_idprotection[$key_product] = $product['domainaddonselected']['idprotection'] === 'on' ? TRUE : FALSE;

            $domain_dnsmanagement[$key_product] = $product['domainaddonselected']['dnsmanagement'] === 'on' ? TRUE : FALSE;

            #end domain addon

            

            #start custom fields

            if (isset($_SESSION['customfieldvalues'])) 

            {

                foreach ($_SESSION['customfieldvalues'][$key_product] as $custmkey => $custmvalue) 

                {

                    $custmarray[$custmvalue['id']] = $custmvalue['rawvalue'];

                }

                $addorder_values["customfields"][$key_product] = base64_encode(serialize($custmarray));
                

            }

            #end custom fields

        }



        $addorder_values['clientid'] = $clientid;

        $addorder_values['pid'] = $productids;

        $addorder_values['addons'] = $addonids;

        $addorder_values['domain'] = $domainname;

        $addorder_values['domaintype'] = $domaintype;

        $addorder_values['regperiod'] = $regperiod;

        $addorder_values['eppcode'] = $domainepp;

        $addorder_values['configoptions'] = $configoptions;

        $addorder_values['billingcycle'] = $_SESSION['productbillingcycles'];

        $addorder_values['hostname'] = $configureserver_hostname;

        $addorder_values['ns1prefix'] = $configureserver_ns1prefix;

        $addorder_values['ns2prefix'] = $configureserver_ns2prefix;

        $addorder_values['rootpw'] = $configureserver_rootpw;



        #start domain addon

        $addorder_values['emailforwarding'] = $domain_emailforwarding;

        $addorder_values['idprotection'] = $domain_idprotection;

        $addorder_values['dnsmanagement'] = $domain_dnsmanagement;

        #End domain addon

        if (isset($_REQUEST['paymenttype']) && !empty($_REQUEST['paymenttype'])) {

            if ($_REQUEST['paymenttype'] == "paypal")

                $addorder_values['paymentmethod'] = "paypal";

            else

                $addorder_values['paymentmethod'] = $_REQUEST['paymenttype'];

        }

        if (isset($_REQUEST['promocode']) && !empty($_REQUEST['promocode'])) {

            $addorder_values['promocode'] = $_REQUEST['promocode'];

        }

        $allselecteddomains_names = $allselecteddomains_types = array();

        foreach ($_SESSION['alldomainsselected'] as $singledomainname => $singledomaintype) {

            $allselecteddomains_names[] = $singledomainname;

            $allselecteddomains_types[] = $singledomaintype;

        }

        if (isset($addorder_values["domain"]) && is_array($addorder_values["domain"])) {

            $addorder_values["domain"] = array_merge($addorder_values["domain"], $allselecteddomains_names);

        } else {

            $addorder_values["domain"] = $allselecteddomains_names;

        }

        if (isset($addorder_values["domaintype"]) && is_array($addorder_values["domaintype"])) {

            $addorder_values["domaintype"] = array_merge($addorder_values["domaintype"], $allselecteddomains_types);

        } else {

            $addorder_values["domaintype"] = $allselecteddomains_types;

        }

        if(isset($_REQUEST['configOption']) && !empty($_REQUEST['configOption']))
            {
                $COnfigIDSValues = array();
                foreach($_REQUEST['configOption'] as $ConfigID => $SubArray)
                {
                    foreach($SubArray as $BillingValue)
                    {
                        if($BillingValue != "0")
                        {
                           $COnfigIDSValues[$ConfigID] = $BillingValue;  
                        }
                    }
                }

                $FinalArrayCombine = $COnfigIDSValues; 
                if(!empty($FinalArrayCombine))
                {
                    $addorder_values["configoptions"][0] = base64_encode(serialize($FinalArrayCombine));
                }
            }

        /*print_r($addorder_values);die();*/
            $reseller_id = $_SESSION['resellerid'];
            $priceoverride = OnePageCartClass::getPriceOverride($reseller_id, $addorder_values);
            
            $addorder_values["priceoverride"] = array((float) $priceoverride);
            
        $addorder_results = OnePageCartClass::AddOrder($addorder_values);

        

        unset($_SESSION['productids']);

        unset($_SESSION['productbillingcycles']);

        unset($_SESSION['alldomainsselected']);

        unset($_SESSION['alldomainsselectedtypes']);

        unset($_SESSION['productwithdomain']);

        unset($_SESSION['onepagecart_mainsession']);

        unset($_SESSION['productconfiguration']);

        unset($_SESSION['selected_addon']);

        unset($_SESSION['domainaddonselected']);

        unset($_SESSION['tax']);

        unset($_SESSION['customfieldvalues']);

        if ($addorder_results['result'] == "success") 

        {

            $invoiceid = $addorder_results['invoiceid'];

            $GetinvoiceDetails = OnePageCartClass::GetInvoice($invoiceid);

            if ($GetinvoiceDetails['result'] == "success") {

                

                $total_invoice_amount_with_tax = $GetinvoiceDetails['total'];

                $item = $GetinvoiceDetails['items']['item'];

                $invoicestatus = $GetinvoiceDetails['status'];

                

                

            }

            global $CONFIG;

            if (empty($CONFIG['SystemSSLURL']))

                $system_url = $CONFIG['SystemURL'];

            else

                $system_url = $CONFIG['SystemSSLURL'];



            $orderinfo = array(

                'clientid' => $clientid,

                'invoiceid' => $invoiceid,

                'orderid' => $addorder_results['orderid'],

                'data' =>array(

                                'total' => $total_invoice_amount_with_tax,

                                'status' => $invoicestatus,

                                 'items' => $item,

                                ),

                'promo' => '',

                'total' => $total_invoice_amount_with_tax,

                'currency'=>$_SESSION['onepagecart_active_currency']['code']

            );



            $data['orderinfo'] = $orderinfo;

            if ($_REQUEST['paymenttype'] == "paypal" && $invoiceid != "0") {

                require_once ROOTDIR . ("/modules/gateways/paypal.php");

                $paypal_details = OnePageCartClass::GetAnyPaymentGatewayDetails('paypal',$_SESSION['resellerid']);

                if (isset($paypal_details['status']) && $paypal_details['status'] == "success") 
                {
                    $paypal_params = array();

                    $paypal_params['invoiceid'] = $invoiceid;

                    $paypal_params['currency'] = $_SESSION['onepagecart_active_currency']['code']; //"USD";

                    $paypal_params['description'] = $CONFIG['CompanyName'] . " - Invoice #" . $invoiceid."@".$_SESSION['resellerid'];

                    $paypal_params['returnurl'] = $system_url . '/viewinvoice.php?id=' . $invoiceid;

                    $paypal_params['systemurl'] = $system_url;

                    $paypal_params['amount'] = $total_invoice_amount_with_tax;

                    $paypal_params["clientdetails"]["country"] = $getclientdetails_result['country'];

                    $paypal_params["clientdetails"]["phonenumber"] = $getclientdetails_result['phonenumber'];

                    $paypal_params["clientdetails"]["phonecc"] = $getclientdetails_result['phonecc'];

                    $paypal_params["clientdetails"]["firstname"] = $getclientdetails_result['firstname'];

                    $paypal_params["clientdetails"]["lastname"] = $getclientdetails_result['lastname'];

                    $paypal_params["clientdetails"]["address1"] = $getclientdetails_result['address1'];

                    $paypal_params["clientdetails"]["city"] = $getclientdetails_result['city'];

                    $paypal_params["clientdetails"]["state"] = $getclientdetails_result['state'];

                    $paypal_params["clientdetails"]["postcode"] = $getclientdetails_result['postcode'];

                    $paypal_params["clientdetails"]["email"] = $getclientdetails_result['email'];

                    foreach ($paypal_details['data'] as $details) 
                    {

                        if ($details->setting == "name") {

                            $paypal_params['name'] = $details->value;

                        }

                        if ($details->setting == "email") {

                            $paypal_params['email'] = $details->value;

                        }

                        if ($details->setting == "forceonetime") {

                            $paypal_params['forceonetime'] = $details->value;

                        }

                        if ($details->setting == "forcesubscriptions") {

                            $paypal_params['forcesubscriptions'] = $details->value;

                        }

                        if ($details->setting == "requireshipping") {

                            $paypal_params['requireshipping'] = $details->value;

                        }

                        if ($details->setting == "overrideaddress") {

                            $paypal_params['overrideaddress'] = $details->value;

                        }

                        if ($details->setting == "apiusername") {

                            $paypal_params['apiusername'] = $details->value;

                        }

                        if ($details->setting == "apipassword") {

                            $paypal_params['apipassword'] = $details->value;

                        }

                        if ($details->setting == "apisignature") {

                            $paypal_params['apisignature'] = $details->value;

                        }

                        if ($details->setting == "sandbox") {

                            $paypal_params['sandbox'] = $details->value;

                        }

                    }

                    $data['status'] = "success";

                    $data['fraud'] = FALSE;

                    $data['fullname'] = $getclientdetails_result['firstname'] . " " . $getclientdetails_result['lastname'];

                    $data['invoiceid'] = $invoiceid;

                    $data['orderinfo'] = $orderinfo;

                    $data['paytype'] = "paypal";
                    
                    #strat 
                    $paypal_form = paypal_link($paypal_params);
                    $html = new DOMDocument();
                    @$html->loadHtml($paypal_form);
                    $nodes = $html->getElementsByTagName('input');

                    foreach ($nodes as $node)
                    {

                        foreach ($node->attributes as $att)
                        {

                                if ($att->value=='notify_url')
                                {
                                    //$price = $node->getAttribute('value');
                                    $node->setAttribute('value',''.$system_url.'/onepagecheckout/callback/paypal.php');
                                }

                        }
                    }
                    $paypal_form_new = $html->saveHTML();
                    
                    #end

                    $data['paypal'] = "<div id='frmPaymentpaypal'>" . $paypal_form_new . "</div><script>jQuery(\"#frmPaymentpaypal\").find(\"form:first\").submit();</script>";

//                $data['paypal'] = '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" ><input type="hidden" name="cmd" value="_xclick-subscriptions"><input type="hidden" name="business" value="' . $paypal_email . '"><input type="hidden" name="item_name" value="Tradingfx VPS - Invoice #' . $invoiceid . '"><input type="hidden" name="no_shipping" value="1"><input type="hidden" name="address_override" value="0"><input type="hidden" name="first_name" value="' . $getclientdetails_result['firstname'] . '"><input type="hidden" name="last_name" value="' . $getclientdetails_result['lastname'] . '"><input type="hidden" name="address1" value="' . $getclientdetails_result['address1'] . '"><input type="hidden" name="city" value="' . $getclientdetails_result['city'] . '"><input type="hidden" name="state" value="' . $getclientdetails_result['state'] . '"><input type="hidden" name="zip" value="' . $getclientdetails_result['postcode'] . '"><input type="hidden" name="country" value="' . $getclientdetails_result['country'] . '"><input type="hidden" name="night_phone_a" value="1"><input type="hidden" name="night_phone_b" value="' . $getclientdetails_result['phonenumber'] . '"><input type="hidden" name="no_note" value="1"><input type="hidden" name="currency_code" value="USD"><input type="hidden" name="bn" value="WHMCS_ST"><input type="hidden" name="a1" value="' . $total_invoice_amount_with_tax / 100 . '"><input type="hidden" name="p1" value="1"><input type="hidden" name="t1" value="M"><input type="hidden" name="a3" value=""><input type="hidden" name="p3" value="1"><input type="hidden" name="t3" value="M"><input type="hidden" name="src" value="1"><input type="hidden" name="sra" value="1"><input type="hidden" name="charset" value="utf-8"><input type="hidden" name="custom" value="180561"><input type="hidden" name="return" value="' . $system_url . 'index.php?success&return=1&paymentsuccess=true"><input type="hidden" name="cancel_return" value="' . $system_url . 'index.php?success&return=1&paymentfailed=true"><input type="hidden" name="notify_url" value="' . $system_url . 'modules/gateways/callback/paypal.php"><input type="hidden" name="rm" value="2"><input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but20.gif" border="0" name="submit" alt="Subscribe with PayPal for Automatic Payments"></form></td><td><form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="paymentfrm"><input type="hidden" name="cmd" value="_xclick"><input type="hidden" name="business" value="' . $paypal_email . '"><input type="hidden" name="item_name" value="Veero Tech - Invoice #' . $invoiceid . '"><input type="hidden" name="amount" value="' . $total_invoice_amount_with_tax . '"><input type="hidden" name="tax" value="0.00"><input type="hidden" name="no_note" value="1"><input type="hidden" name="no_shipping" value="1"><input type="hidden" name="address_override" value="0"><input type="hidden" name="first_name" value="' . $getclientdetails_result['firstname'] . '"><input type="hidden" name="last_name" value="' . $getclientdetails_result['lastname'] . '"><input type="hidden" name="address1" value="' . $getclientdetails_result['address1'] . '"><input type="hidden" name="city" value="' . $getclientdetails_result['city'] . '"><input type="hidden" name="state" value="' . $_REQUEST['state'] . '"><input type="hidden" name="zip" value="' . $getclientdetails_result['postcode'] . '"><input type="hidden" name="country" value="' . $getclientdetails_result['country'] . '"><input type="hidden" name="night_phone_a" value="1"><input type="hidden" name="night_phone_b" value="' . $getclientdetails_result['phonenumber'] . '"><input type="hidden" name="charset" value="utf-8"><input type="hidden" name="currency_code" value="USD"><input type="hidden" name="custom" value="1446991"><input type="hidden" name="return" value="' . $system_url . 'index.php?success&return=1&paymentsuccess=true"><input type="hidden" name="cancel_return" value="' . $system_url . 'index.php?success&return=1&paymentfailed=true"><input type="hidden" name="notify_url" value="' . $system_url . 'modules/gateways/callback/paypal.php"><input type="hidden" name="bn" value="WHMCS_ST"><input type="hidden" name="rm" value="2"><input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but03.gif" border="0" name="submit" alt="Make a one time payment with PayPal"></form><script>document.getElementsByName(\'paymentfrm\')[0].submit();</script>';

                }

            }

            #end paypal

            else if ($_REQUEST['paymenttype'] == "bitpay" && $invoiceid != "0") {

                require_once ROOTDIR . ("/modules/gateways/bitpay.php");

                $bitpay_details = OnePageCartClass::GetAnyPaymentGatewayDetails('bitpay',$_SESSION['resellerid']);

               

                if (isset($bitpay_details['status']) && $bitpay_details['status'] == "success") {

                    $bitpay_params = array();

                    $bitpay_params['invoiceid'] = $invoiceid;

                    $bitpay_params['currency'] = $_SESSION['onepagecart_active_currency']['code']; //"USD";

                    $bitpay_params['description'] = $CONFIG['CompanyName'] . " - Invoice #" . $invoiceid;

                    $bitpay_params['returnurl'] = $system_url . '/viewinvoice.php?id=' . $invoiceid;

                    $bitpay_params['systemurl'] = $system_url;

                    $bitpay_params['amount'] = $total_invoice_amount_with_tax;

                    $bitpay_params["clientdetails"]["country"] = $getclientdetails_result['country'];

                    $bitpay_params["clientdetails"]["phonenumber"] = $getclientdetails_result['phonenumber'];

                    

                    $bitpay_params["clientdetails"]["firstname"] = $getclientdetails_result['firstname'];

                    $bitpay_params["clientdetails"]["lastname"] = $getclientdetails_result['lastname'];

                    $bitpay_params["clientdetails"]["address1"] = $getclientdetails_result['address1'];

                    $bitpay_params["clientdetails"]["city"] = $getclientdetails_result['city'];

                    $bitpay_params["clientdetails"]["state"] = $getclientdetails_result['state'];

                    $bitpay_params["clientdetails"]["postcode"] = $getclientdetails_result['postcode'];

                    $bitpay_params["clientdetails"]["email"] = $getclientdetails_result['email'];

                    foreach ($bitpay_details['data'] as $details) {

                        if ($details->setting == "apiKey") {

                            $bitpay_params['apiKey'] = $details->value;

                        }

                        if ($details->setting == "convertto") {

                            $bitpay_params['convertto'] = $details->value;

                        }

                        if ($details->setting == "name") {

                            $bitpay_params['name'] = $details->value;

                        }

                        if ($details->setting == "network") {

                            $bitpay_params['network'] = $details->value;

                        }

                        if ($details->setting == "transactionSpeed") {

                            $bitpay_params['transactionSpeed'] = $details->value;

                        }

                        if ($details->setting == "type") {

                            $bitpay_params['type'] = $details->value;

                        }

                        if ($details->setting == "visible") {

                            $bitpay_params['visible'] = $details->value;

                        }

                      

                   }

                    $data['status'] = "success";

                    $data['fraud'] = FALSE;

                    $data['fullname'] = $getclientdetails_result['firstname'] . " " . $getclientdetails_result['lastname'];

                    $data['invoiceid'] = $invoiceid;

                    $data['orderinfo'] = $orderinfo;

                    $data['paytype'] = "bitpay";

                    $data['bitpay'] = "<div id='frmPaymentbitpay'>" . bitpay_link($bitpay_params) . "</div><script>jQuery(\"#frmPaymentbitpay\").find(\"form:first\").submit();</script>";

                }

            }

            #end_bitpay

            #start Payumoney

            elseif ($_REQUEST['paymenttype'] == "payu" && $invoiceid != "0") {

                require_once ROOTDIR . ("/modules/gateways/payu.php");

                //include_once 'opc_payu.php';

                $payu_details = OnePageCartClass::GetAnyPaymentGatewayDetails('payu',$_SESSION['resellerid']);



                if (isset($payu_details['status']) && $payu_details['status'] == "success") {

                    $payu_params = array();

                    $payu_params['invoiceid'] = $invoiceid;

                    $payu_params['currency'] = $_SESSION['onepagecart_active_currency']['code']; //"USD";

                    $payu_params['description'] = $CONFIG['CompanyName'] . " - Invoice #" . $invoiceid;

                    $payu_params['systemurl'] = $system_url;

                    $payu_params['amount'] = $total_invoice_amount_with_tax;

                    $payu_params["clientdetails"]["country"] = $getclientdetails_result['country'];

                    $payu_params["clientdetails"]["phonenumber"] = $getclientdetails_result['phonenumber'];

                    $payu_params["clientdetails"]["phonecc"] = $getclientdetails_result['phonecc'];

                    $payu_params["clientdetails"]["firstname"] = $getclientdetails_result['firstname'];

                    $payu_params["clientdetails"]["lastname"] = $getclientdetails_result['lastname'];

                    $payu_params["clientdetails"]["address1"] = $getclientdetails_result['address1'];

                    $payu_params["clientdetails"]["city"] = $getclientdetails_result['city'];

                    $payu_params["clientdetails"]["state"] = $getclientdetails_result['state'];

                    $payu_params["clientdetails"]["postcode"] = $getclientdetails_result['postcode'];

                    $payu_params["clientdetails"]["email"] = $getclientdetails_result['email'];

                    foreach ($payu_details['data'] as $details) {

                        if ($details->setting == "convertto") {

                            $payu_params['convertto'] = $details->value;

                        }

                        if ($details->setting == "MerchantKey") {

                            $payu_params['MerchantKey'] = $details->value;

                        }

                        if ($details->setting == "SALT") {

                            $payu_params['SALT'] = $details->value;

                        }

                        if ($details->setting == "mode") {

                            $payu_params['mode'] = $details->value;

                        }

                    }



                    $data['status'] = "success";

                    $data['fraud'] = FALSE;

                    $data['fullname'] = $getclientdetails_result['firstname'] . " " . $getclientdetails_result['lastname'];

                    $data['invoiceid'] = $invoiceid;

                    $data['orderinfo'] = $orderinfo;

                    $data['paytype'] = "payu";

                    $data['payu'] = "<div id='frmPaymentpayu'>" . payu_link($payu_params) . "</div><script>jQuery(\"#frmPaymentpayu\").find(\"form:first\").submit(); function validate(){ return true; }</script>";

                }

            }

            #end payu

            #start ebs

            elseif ($_REQUEST['paymenttype'] == "ebs" && $invoiceid != "0") {

                require_once ROOTDIR . ("/modules/gateways/ebs.php");

                $ebs_details = OnePageCartClass::GetAnyPaymentGatewayDetails('ebs',$_SESSION['resellerid']);



                if (isset($ebs_details['status']) && $ebs_details['status'] == "success") {

                    $ebs_params = array();

                    $ebs_params['invoiceid'] = $invoiceid;

                    $ebs_params['currency'] = $_SESSION['onepagecart_active_currency']['code']; //"USD";

                    $ebs_params['description'] = $CONFIG['CompanyName'] . " - Invoice #" . $invoiceid;

                    $ebs_params['returnurl'] = $system_url . '/viewinvoice.php?id=' . $invoiceid;

                    $ebs_params['systemurl'] = $system_url;

                    $ebs_params['amount'] = $total_invoice_amount_with_tax;

                    $ebs_params["clientdetails"]["country"] = $getclientdetails_result['country'];

                    $ebs_params["clientdetails"]["phonenumber"] = $getclientdetails_result['phonenumber'];

                    $ebs_params["clientdetails"]["phonecc"] = $getclientdetails_result['phonecc'];

                    $ebs_params["clientdetails"]["firstname"] = $getclientdetails_result['firstname'];

                    $ebs_params["clientdetails"]["lastname"] = $getclientdetails_result['lastname'];

                    $ebs_params["clientdetails"]["address1"] = $getclientdetails_result['address1'];

                    $ebs_params["clientdetails"]["city"] = $getclientdetails_result['city'];

                    $ebs_params["clientdetails"]["state"] = $getclientdetails_result['state'];

                    $ebs_params["clientdetails"]["postcode"] = $getclientdetails_result['postcode'];

                    $ebs_params["clientdetails"]["email"] = $getclientdetails_result['email'];

                    foreach ($ebs_details['data'] as $details) {

                        if ($details->setting == "accountid") {

                            $ebs_params['accountid'] = $details->value;

                        }

                        if ($details->setting == "convertto") {

                            $ebs_params['convertto'] = $details->value;

                        }

                        if ($details->setting == "hashtype") {

                            $ebs_params['hashtype'] = $details->value;

                        }

                        if ($details->setting == "mode") {

                            $ebs_params['mode'] = $details->value;

                        }

                        if ($details->setting == "name") {

                            $ebs_params['name'] = $details->value;

                        }

                        if ($details->setting == "pageid") {

                            $ebs_params['pageid'] = $details->value;

                        }

                        if ($details->setting == "secretkey") {

                            $ebs_params['secretkey'] = $details->value;

                        }

                        if ($details->setting == "type") {

                            $ebs_params['type'] = $details->value;

                        }

                        if ($details->setting == "visible") {

                            $ebs_params['visible'] = $details->value;

                        }

                    }







                    $data['status'] = "success";

                    $data['fraud'] = FALSE;

                    $data['fullname'] = $getclientdetails_result['firstname'] . " " . $getclientdetails_result['lastname'];

                    $data['invoiceid'] = $invoiceid;

                    $data['orderinfo'] = $orderinfo;

                    $data['paytype'] = "ebs";



                    $data['ebs'] = "<div id='frmPaymentebs'>" . ebs_link($ebs_params) . "</div><script>jQuery(\"#frmPaymentebs\").find(\"form:first\").submit(); function validate(){ return true; }</script>";

                }

            }

            #end ebs

            elseif ($_REQUEST['paymenttype'] == "stripe" && $invoiceid != "0")

            {

                if((isset($_POST['stripeToken']) && !empty($_POST['stripeToken'])) || !empty($gatewayid))

                {

                    if (file_exists(ROOTDIR . ("/vendor/stripe/stripe-php/init.php")))

                    {

                        require_once ROOTDIR . ("/vendor/stripe/stripe-php/init.php");

                        $stripe = new \Stripe\Stripe;

                        $stripe_customer = new \Stripe\Customer;

                        $stripe_charge = new \Stripe\Charge;

                        $stripe_trans = new \Stripe\BalanceTransaction;

                    }

                    $stripe_details = OnePageCartClass::GetAnyPaymentGatewayDetails('stripe',$_SESSION['resellerid']);

                    if (isset($stripe_details['status']) && $stripe_details['status'] == "success")

                    {

                        try

                        {

                            foreach ($stripe_details['data'] as $details)

                            {

                                if ($details->setting == "secretKey")

                                {

                                    $gatewaysecretkey = $details->value;

                                }

                                if ($details->setting == "publishableKey") 

                                {

                                    $gatewaypublishablekey = $details->value;

                                }

                            }

                            $stripe->setApiKey($gatewaysecretkey);

                            $token = $_POST['stripeToken'];

                            $customer_id = $gatewayid;

                            if(empty($gatewayid))

                            {

                                // Create a Customer:

                                $customer = $stripe_customer->create(array(

                                                                        "email" => $clientemail,

                                                                        "source" => $token,

                                                                      )

                                                                );

                                $customer_id = $customer->id;

                                logTransaction('Stripe', $customer, "Create Customer");

                                // Charge the Customer instead of the card:

                            }

                            

                            

                            $charge = $stripe_charge->create(array(

                                "amount" => ($total_invoice_amount_with_tax * 100),

                                "currency" => "usd",

                                "customer" => $customer_id

                            ));

                            if (isset($charge->status) && $charge->status == "succeeded" || isset($charge->status) && $charge->status == "paid")

                            {

                                $stripeTransaction = $stripe_trans->retrieve($charge->balance_transaction);

                                $addinviocepayment = array();

                                $addinviocepayment["invoiceid"] = $invoiceid;

                                $addinviocepayment["transid"] = $charge->balance_transaction;

                                $addinviocepayment["amount"] = $total_invoice_amount_with_tax;

                                $addinviocepayment["gateway"] = "stripe";

                                $addinviocepayment["fees"] = ($stripeTransaction->fee / 100);

                                $AddInvoicePayment_result = OnePageCartClass::AddInvoicePayment($addinviocepayment);

                                update_query("tblclients", array("cardtype" => "Visa", "cardlastfour" => "", "cardnum" => "", "expdate" => "", "startdate" => "", "issuenumber" => "", "gatewayid" => $customer_id), array("id" => $clientid));

                            }

                            logTransaction('Stripe', $charge, "Charge");

                            $data['status'] = "success";

                            $data['fraud'] = FALSE;

                            $data['fullname'] = $getclientdetails_result['firstname'] . " " . $getclientdetails_result['lastname'];

                            $data['invoiceid'] = $invoiceid;

                            $data['orderinfo'] = $orderinfo;

                            $data['paytype'] = "stripe";

                            $data['redirecturl'] = $system_url . '/viewinvoice.php?id=' . $invoiceid;
                            
                            //print_r($_SESSION);

                        } catch (Exception $e) {



                            // Something else happened, completely unrelated to Stripe

                        }

                    }

                }

            }

            else {

                $data['redirecturl'] = $system_url . '/viewinvoice.php?id=' . $invoiceid;

                $data['status'] = "success";

            }

            if (session_status() == PHP_SESSION_NONE) {

                session_start();

            }

            $_SESSION['onepagecart'] = $data;

        } else {

            $error[]['message'] = $addorder_results['message'];

            $data['errors'] = $error;

            $data['status'] = "failure";

        }

    } 

    else

    {

        if ($_REQUEST['account_type'] == "existing")

        {

            $addclient_result = OnePageCartClass::ValidateClient($_REQUEST['loginemail'], $_REQUEST['loginpassword']);
            

        }

        if ($_REQUEST['account_type'] == "create")

        {

            $checkClientEmail_response = OnePageCartClass::checkClientEmailId($_REQUEST['email']);

            

            if(!$checkClientEmail_response)
            {

                $addclient_result = OnePageCartClass::AddClient($values);

                OnePageCartClass::AddClientinaff($addclient_result);

                $validateLogin = OnePageCartClass::ValidateClient($_REQUEST['email'], $_REQUEST['password']);
               
               
            }

            else
            {

                $error[]['message'] = "A user already exist with that email address";

                $data['errors'] = $error;

                $data['status'] = "failure";

                $result = json_encode($data);

                echo $result;

                exit;

            }

        }

        
        
        $clientemail = $_REQUEST['email'];

        if ($addclient_result['result'] == "success") {

            $clientid = $addclient_result['clientid'];

            $getclientdetails_result = OnePageCartClass::GetClientsDetails($clientid);


            $productids = $addonids = $domainname = $domaintype = $regperiod = $configoptions = $configureserver_hostname = $configureserver_ns1prefix = $configureserver_ns2prefix = $configureserver_rootpw = array();

            $hostname = $ns1prefix = $ns2prefix = $rootpw = "";

            foreach ($_SESSION['onepagecart_mainsession']['products'] as $key_product => $product)

            {

                $addonidsstring = $productwithdomainname = $productwithdomaintype = $registrationperiod = "";

                $Configarray = array();

                if (!empty($product['addon_selected']) && is_array($product['addon_selected']) && count($product['addon_selected']) > 0) {

                    foreach ($product['addon_selected'] as $addonkey => $addon) {

                        $addonidsstring .= $addon['id'] . ",";

                    }

                }

                /*

                  if(!empty($product['selconfigopts']) && is_array($product['selconfigopts'])  && count($product['selconfigopts'])>0){

                  foreach ($product['selconfigopts'] as $configkey => $configvalue) {

                  $Configarray[$configkey] = $configvalue['configid'];

                  }

                  }

                 */

                if (!empty($product['selconfigopts']) && is_array($product['selconfigopts']) && count($product['selconfigopts']) > 0) {

                    foreach ($product['selconfigopts'] as $configkey => $configvalue) {

                        $Configarray[$configvalue['configid']] = $configvalue['sub_id'];

                    }

                }



                #checking domain 

                $ProductInfo = OnePageCartClass::getProductInfo($product['id']);

                if ($ProductInfo['status'] == "success")

                {

                    $ShowDomainOptions = $ProductInfo['data'][0]->showdomainoptions;

                    $productName = $ProductInfo['data'][0]->name;

                }

                if ($ShowDomainOptions && empty($product['productwithdomain']['full']))

                {

                    $error[]['message'] = "You must set a domain either by registration, or using a existing domain for ".$productName;

                    $data['errors'] = $error;

                    $data['status'] = "failure";

                    $result = json_encode($data);

                    echo $result;

                    exit();

                }

                

                if (!empty($product['productwithdomain']) && is_array($product['productwithdomain']) && count($product['productwithdomain']) > 0) {

                    if (isset($product['productwithdomain']['register']) && $product['productwithdomain']['register'] == true) {

                        $productwithdomainname = $product['productwithdomain']['full'];

                        $productwithdomaintype = "register";

                        $registrationperiod = "1";

                    }

                    if (isset($product['productwithdomain']['transfer']) && $product['productwithdomain']['transfer'] == true) {

                        $productwithdomainname = $product['productwithdomain']['full'];

                        $productwithdomaintype = "transfer";

                        $registrationperiod = "1";

                        // $productwithdomainepp[] = "";

                    }

                    if (isset($product['productwithdomain']['transfer']) && $product['productwithdomain']['transfer'] == false) {

                        $productwithdomainname = $product['productwithdomain']['full'];

                    }

                }



                if ($product['product_type'] == "server") {

                    if (!empty($product['configureserver']) && is_array($product['configureserver']) && count($product['configureserver']) > 0) {

                        $hostname = $product['configureserver']['hostname'];

                        $ns1prefix = $product['configureserver']['ns1prefix'];

                        $ns2prefix = $product['configureserver']['ns2prefix'];

                        $rootpw = $product['configureserver']['rootpw'];

                    }

                }



                $configureserver_hostname[$key_product] = $hostname;

                $configureserver_ns1prefix[$key_product] = $ns1prefix;

                $configureserver_ns2prefix[$key_product] = $ns2prefix;

                $configureserver_rootpw[$key_product] = $rootpw;

                $addonidsstring = rtrim($addonidsstring, ", ");

                $addonids[$key_product] = $addonidsstring;

                $domainname[$key_product] = $productwithdomainname;

                $domaintype[$key_product] = $productwithdomaintype;

                $regperiod[$key_product] = $registrationperiod;

                $configoptions[$key_product] = base64_encode(serialize($Configarray));

                $productids[] = $product['id'];



                #start domain addon

                $domain_emailforwarding[$key_product] = $product['domainaddonselected']['emailforwarding'] === 'on' ? TRUE : FALSE;

                $domain_idprotection[$key_product] = $product['domainaddonselected']['idprotection'] === 'on' ? TRUE : FALSE;

                $domain_dnsmanagement[$key_product] = $product['domainaddonselected']['dnsmanagement'] === 'on' ? TRUE : FALSE;

                #end domain addon

                

                #start custom fields

                if (isset($_SESSION['customfieldvalues'])) 

                {

                    foreach ($_SESSION['customfieldvalues'][$key_product] as $custmkey => $custmvalue) 

                    {

                        $custmarray[$custmvalue['id']] = $custmvalue['rawvalue'];

                    }

                    $addorder_values["customfields"][$key_product] = base64_encode(serialize($custmarray));

                }

            #end custom fields

            }



            $addorder_values['clientid'] = $clientid;

            $addorder_values['pid'] = $productids;

            $addorder_values['addons'] = $addonids;

            $addorder_values['domain'] = $domainname;

            $addorder_values['domaintype'] = $domaintype;

            $addorder_values['regperiod'] = $regperiod;

            $addorder_values['configoptions'] = $configoptions;

            $addorder_values['billingcycle'] = $_SESSION['productbillingcycles'];

            $addorder_values['hostname'] = $configureserver_hostname;

            $addorder_values['ns1prefix'] = $configureserver_ns1prefix;

            $addorder_values['ns2prefix'] = $configureserver_ns2prefix;

            $addorder_values['rootpw'] = $configureserver_rootpw;



            #start domain addon

            $addorder_values['emailforwarding'] = $domain_emailforwarding;

            $addorder_values['idprotection'] = $domain_idprotection;

            $addorder_values['dnsmanagement'] = $domain_dnsmanagement;

            #End domain addon



            if (isset($_REQUEST['paymenttype']) && !empty($_REQUEST['paymenttype'])) {

                if ($_REQUEST['paymenttype'] == "paypal")

                    $addorder_values['paymentmethod'] = "paypal";

                else

                    $addorder_values['paymentmethod'] = $_REQUEST['paymenttype'];

            }

            if (isset($_REQUEST['promocode']) && !empty($_REQUEST['promocode'])) {

                $addorder_values['promocode'] = $_REQUEST['promocode'];

            }

            $allselecteddomains_names = $allselecteddomains_types = array();

            foreach ($_SESSION['alldomainsselected'] as $singledomainname => $singledomaintype) {

                $allselecteddomains_names[] = $singledomainname;

                $allselecteddomains_types[] = $singledomaintype;

            }

            if (isset($addorder_values["domain"]) && is_array($addorder_values["domain"])) {

                $addorder_values["domain"] = array_merge($addorder_values["domain"], $allselecteddomains_names);

            } else {

                $addorder_values["domain"] = $allselecteddomains_names;

            }

            if (isset($addorder_values["domaintype"]) && is_array($addorder_values["domaintype"])) {

                $addorder_values["domaintype"] = array_merge($addorder_values["domaintype"], $allselecteddomains_types);

            } else {

                $addorder_values["domaintype"] = $allselecteddomains_types;

            }

            if(isset($_REQUEST['configOption']) && !empty($_REQUEST['configOption']))
            {
                $COnfigIDSValues = array();
                foreach($_REQUEST['configOption'] as $ConfigID => $SubArray)
                {
                    foreach($SubArray as $BillingValue)
                    {
                        if($BillingValue != "0")
                        {
                           $COnfigIDSValues[$ConfigID] = $BillingValue;  
                        }
                    }
                }

                $FinalArrayCombine = $COnfigIDSValues; 
                if(!empty($FinalArrayCombine))
                {
                    $addorder_values["configoptions"][0] = base64_encode(serialize($FinalArrayCombine));
                }
            }

            
            /*print_r($addorder_values);die();*/
           $reseller_id = $_SESSION['resellerid'];
            $priceoverride = OnePageCartClass::getPriceOverride($reseller_id, $addorder_values);
            $addorder_values["priceoverride"] = array((float) $priceoverride);
            
            $addorder_results = OnePageCartClass::AddOrder($addorder_values);

            

            unset($_SESSION['productids']);

            unset($_SESSION['productbillingcycles']);

            unset($_SESSION['alldomainsselected']);

            unset($_SESSION['alldomainsselectedtypes']);

            unset($_SESSION['productwithdomain']);

            unset($_SESSION['onepagecart_mainsession']);

            unset($_SESSION['productconfiguration']);

            unset($_SESSION['selected_addon']);

            unset($_SESSION['domainaddonselected']);

            unset($_SESSION['tax']);

            unset($_SESSION['customfieldvalues']);

            if ($addorder_results['result'] == "success")
            {

                $_SESSION['orderdetails']['OrderID'] = $addorder_results['orderid'];

                //include_once 'tracking-success.php';

                

                $invoiceid = $addorder_results['invoiceid'];

                $GetinvoiceDetails = OnePageCartClass::GetInvoice($invoiceid);

                if ($GetinvoiceDetails['result'] == "success") {

                    $total_invoice_amount_with_tax = $GetinvoiceDetails['total'];

                    $item = $GetinvoiceDetails['items']['item'];

                    $invoicestatus = $GetinvoiceDetails['status'];

                }

                global $CONFIG;

                if (empty($CONFIG['SystemSSLURL']))

                    $system_url = $CONFIG['SystemURL'];

                else

                    $system_url = $CONFIG['SystemSSLURL'];

                $orderinfo = array(

                    'clientid' => $clientid,

                    'invoiceid' => $invoiceid,

                    'orderid' => $addorder_results['orderid'],

                    'data' =>

                    array(

                        'total' => $total_invoice_amount_with_tax,

                        'status' => $invoicestatus,

                        'items' => $item,

                    ),

                    'promo' => '',

                    'total' => $total_invoice_amount_with_tax,

                    'currency'=>$_SESSION['onepagecart_active_currency']['code']

                );
                
                $data['orderinfo'] = $orderinfo;

                if ($_REQUEST['paymenttype'] == "paypal" && $invoiceid != "0") {

                    require_once ROOTDIR . ("/modules/gateways/paypal.php");

                    $paypal_details = OnePageCartClass::GetAnyPaymentGatewayDetails('paypal',$_SESSION['resellerid']);

                    if (isset($paypal_details['status']) && $paypal_details['status'] == "success") {

                        $paypal_params = array();

                        $paypal_params['invoiceid'] = $invoiceid;

                        $paypal_params['currency'] = $_SESSION['onepagecart_active_currency']['code']; //"USD";

                        $paypal_params['description'] = $CONFIG['CompanyName'] . " - Invoice #" . $invoiceid."@".$_SESSION['resellerid'];

                        $paypal_params['returnurl'] = $system_url . '/viewinvoice.php?id=' . $invoiceid;

                        $paypal_params['systemurl'] = $system_url;

                        $paypal_params['amount'] = $total_invoice_amount_with_tax;

                        $paypal_params["clientdetails"]["country"] = $getclientdetails_result['country'];

                        $paypal_params["clientdetails"]["phonenumber"] = $getclientdetails_result['phonenumber'];

                        $paypal_params["clientdetails"]["phonecc"] = $getclientdetails_result['phonecc'];

                        $paypal_params["clientdetails"]["firstname"] = $getclientdetails_result['firstname'];

                        $paypal_params["clientdetails"]["lastname"] = $getclientdetails_result['lastname'];

                        $paypal_params["clientdetails"]["address1"] = $getclientdetails_result['address1'];

                        $paypal_params["clientdetails"]["city"] = $getclientdetails_result['city'];

                        $paypal_params["clientdetails"]["state"] = $getclientdetails_result['state'];

                        $paypal_params["clientdetails"]["postcode"] = $getclientdetails_result['postcode'];

                        $paypal_params["clientdetails"]["email"] = $getclientdetails_result['email'];



                        foreach ($paypal_details['data'] as $details) {

                            if ($details->setting == "name") {

                                $paypal_params['name'] = $details->value;

                            }

                            if ($details->setting == "email") {

                                $paypal_params['email'] = $details->value;

                            }

                            if ($details->setting == "forceonetime") {

                                $paypal_params['forceonetime'] = $details->value;

                            }

                            if ($details->setting == "forcesubscriptions") {

                                $paypal_params['forcesubscriptions'] = $details->value;

                            }

                            if ($details->setting == "requireshipping") {

                                $paypal_params['requireshipping'] = $details->value;

                            }

                            if ($details->setting == "overrideaddress") {

                                $paypal_params['overrideaddress'] = $details->value;

                            }

                            if ($details->setting == "apiusername") {

                                $paypal_params['apiusername'] = $details->value;

                            }

                            if ($details->setting == "apipassword") {

                                $paypal_params['apipassword'] = $details->value;

                            }

                            if ($details->setting == "apisignature") {

                                $paypal_params['apisignature'] = $details->value;

                            }

                            if ($details->setting == "sandbox") {

                                $paypal_params['sandbox'] = $details->value;

                            }

                        }

                        $data['status'] = "success";

                        $data['fraud'] = FALSE;

                        $data['fullname'] = $getclientdetails_result['firstname'] . " " . $getclientdetails_result['lastname'];

                        $data['invoiceid'] = $invoiceid;

                        $data['orderinfo'] = $orderinfo;

                        $data['paytype'] = "paypal";
                        
                        
                        #strat 
                    $paypal_form = paypal_link($paypal_params);
                    $html = new DOMDocument();
                    @$html->loadHtml($paypal_form);
                    $nodes = $html->getElementsByTagName('input');

                    foreach ($nodes as $node)
                    {

                        foreach ($node->attributes as $att)
                        {

                                if ($att->value=='notify_url')
                                {
                                    //$price = $node->getAttribute('value');
                                    $node->setAttribute('value','https://iptvsolution.whmcssmarters.com/billing/reseller2/callback/paypal.php');
                                }

                        }
                    }
                    $paypal_form_new = $html->saveHTML();
                    
                    #end

                        $data['paypal'] = "<div id='frmPaymentpaypal'>" . $paypal_form_new . "</div><script>jQuery(\"#frmPaymentpaypal\").find(\"form:first\").submit();</script>";

                    }

                }

                

                else if ($_REQUEST['paymenttype'] == "bitpay" && $invoiceid != "0") {

                require_once ROOTDIR . ("/modules/gateways/bitpay.php");

                $bitpay_details = OnePageCartClass::GetAnyPaymentGatewayDetails('bitpay',$_SESSION['resellerid']);

               

                if (isset($bitpay_details['status']) && $bitpay_details['status'] == "success") {

                    $bitpay_params = array();

                    $bitpay_params['invoiceid'] = $invoiceid;

                    $bitpay_params['currency'] = $_SESSION['onepagecart_active_currency']['code']; //"USD";

                    $bitpay_params['description'] = $CONFIG['CompanyName'] . " - Invoice #" . $invoiceid;

                    $bitpay_params['returnurl'] = $system_url . '/viewinvoice.php?id=' . $invoiceid;

                    $bitpay_params['systemurl'] = $system_url;

                    $bitpay_params['amount'] = $total_invoice_amount_with_tax;

                    $bitpay_params["clientdetails"]["country"] = $getclientdetails_result['country'];

                    $bitpay_params["clientdetails"]["phonenumber"] = $getclientdetails_result['phonenumber'];

                    

                    $bitpay_params["clientdetails"]["firstname"] = $getclientdetails_result['firstname'];

                    $bitpay_params["clientdetails"]["lastname"] = $getclientdetails_result['lastname'];

                    $bitpay_params["clientdetails"]["address1"] = $getclientdetails_result['address1'];

                    $bitpay_params["clientdetails"]["city"] = $getclientdetails_result['city'];

                    $bitpay_params["clientdetails"]["state"] = $getclientdetails_result['state'];

                    $bitpay_params["clientdetails"]["postcode"] = $getclientdetails_result['postcode'];

                    $bitpay_params["clientdetails"]["email"] = $getclientdetails_result['email'];

                    foreach ($bitpay_details['data'] as $details) {

                        if ($details->setting == "apiKey") {

                            $bitpay_params['apiKey'] = $details->value;

                        }

                        if ($details->setting == "convertto") {

                            $bitpay_params['convertto'] = $details->value;

                        }

                        if ($details->setting == "name") {

                            $bitpay_params['name'] = $details->value;

                        }

                        if ($details->setting == "network") {

                            $bitpay_params['network'] = $details->value;

                        }

                        if ($details->setting == "transactionSpeed") {

                            $bitpay_params['transactionSpeed'] = $details->value;

                        }

                        if ($details->setting == "type") {

                            $bitpay_params['type'] = $details->value;

                        }

                        if ($details->setting == "visible") {

                            $bitpay_params['visible'] = $details->value;

                        }

                      

                   }

                    $data['status'] = "success";

                    $data['fraud'] = FALSE;

                    $data['fullname'] = $getclientdetails_result['firstname'] . " " . $getclientdetails_result['lastname'];

                    $data['invoiceid'] = $invoiceid;

                    $data['orderinfo'] = $orderinfo;

                    $data['paytype'] = "bitpay";

                    $data['bitpay'] = "<div id='frmPaymentbitpay'>" . bitpay_link($bitpay_params) . "</div><script>jQuery(\"#frmPaymentbitpay\").find(\"form:first\").submit();</script>";

//                $data['paypal'] = '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" ><input type="hidden" name="cmd" value="_xclick-subscriptions"><input type="hidden" name="business" value="' . $paypal_email . '"><input type="hidden" name="item_name" value="Tradingfx VPS - Invoice #' . $invoiceid . '"><input type="hidden" name="no_shipping" value="1"><input type="hidden" name="address_override" value="0"><input type="hidden" name="first_name" value="' . $getclientdetails_result['firstname'] . '"><input type="hidden" name="last_name" value="' . $getclientdetails_result['lastname'] . '"><input type="hidden" name="address1" value="' . $getclientdetails_result['address1'] . '"><input type="hidden" name="city" value="' . $getclientdetails_result['city'] . '"><input type="hidden" name="state" value="' . $getclientdetails_result['state'] . '"><input type="hidden" name="zip" value="' . $getclientdetails_result['postcode'] . '"><input type="hidden" name="country" value="' . $getclientdetails_result['country'] . '"><input type="hidden" name="night_phone_a" value="1"><input type="hidden" name="night_phone_b" value="' . $getclientdetails_result['phonenumber'] . '"><input type="hidden" name="no_note" value="1"><input type="hidden" name="currency_code" value="USD"><input type="hidden" name="bn" value="WHMCS_ST"><input type="hidden" name="a1" value="' . $total_invoice_amount_with_tax / 100 . '"><input type="hidden" name="p1" value="1"><input type="hidden" name="t1" value="M"><input type="hidden" name="a3" value=""><input type="hidden" name="p3" value="1"><input type="hidden" name="t3" value="M"><input type="hidden" name="src" value="1"><input type="hidden" name="sra" value="1"><input type="hidden" name="charset" value="utf-8"><input type="hidden" name="custom" value="180561"><input type="hidden" name="return" value="' . $system_url . 'index.php?success&return=1&paymentsuccess=true"><input type="hidden" name="cancel_return" value="' . $system_url . 'index.php?success&return=1&paymentfailed=true"><input type="hidden" name="notify_url" value="' . $system_url . 'modules/gateways/callback/paypal.php"><input type="hidden" name="rm" value="2"><input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but20.gif" border="0" name="submit" alt="Subscribe with PayPal for Automatic Payments"></form></td><td><form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="paymentfrm"><input type="hidden" name="cmd" value="_xclick"><input type="hidden" name="business" value="' . $paypal_email . '"><input type="hidden" name="item_name" value="Veero Tech - Invoice #' . $invoiceid . '"><input type="hidden" name="amount" value="' . $total_invoice_amount_with_tax . '"><input type="hidden" name="tax" value="0.00"><input type="hidden" name="no_note" value="1"><input type="hidden" name="no_shipping" value="1"><input type="hidden" name="address_override" value="0"><input type="hidden" name="first_name" value="' . $getclientdetails_result['firstname'] . '"><input type="hidden" name="last_name" value="' . $getclientdetails_result['lastname'] . '"><input type="hidden" name="address1" value="' . $getclientdetails_result['address1'] . '"><input type="hidden" name="city" value="' . $getclientdetails_result['city'] . '"><input type="hidden" name="state" value="' . $_REQUEST['state'] . '"><input type="hidden" name="zip" value="' . $getclientdetails_result['postcode'] . '"><input type="hidden" name="country" value="' . $getclientdetails_result['country'] . '"><input type="hidden" name="night_phone_a" value="1"><input type="hidden" name="night_phone_b" value="' . $getclientdetails_result['phonenumber'] . '"><input type="hidden" name="charset" value="utf-8"><input type="hidden" name="currency_code" value="USD"><input type="hidden" name="custom" value="1446991"><input type="hidden" name="return" value="' . $system_url . 'index.php?success&return=1&paymentsuccess=true"><input type="hidden" name="cancel_return" value="' . $system_url . 'index.php?success&return=1&paymentfailed=true"><input type="hidden" name="notify_url" value="' . $system_url . 'modules/gateways/callback/paypal.php"><input type="hidden" name="bn" value="WHMCS_ST"><input type="hidden" name="rm" value="2"><input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but03.gif" border="0" name="submit" alt="Make a one time payment with PayPal"></form><script>document.getElementsByName(\'paymentfrm\')[0].submit();</script>';

                }

            }

            #end_biytpay



                #start Payumoney

                elseif ($_REQUEST['paymenttype'] == "payu" && $invoiceid != "0") {

                    require_once ROOTDIR . ("/modules/gateways/payu.php");

                    $payu_details = OnePageCartClass::GetAnyPaymentGatewayDetails('payu',$_SESSION['resellerid']);



                    if (isset($payu_details['status']) && $payu_details['status'] == "success") {

                        $payu_params = array();

                        $payu_params['invoiceid'] = $invoiceid;

                        $payu_params['currency'] = $_SESSION['onepagecart_active_currency']['code']; //"USD";

                        $payu_params['description'] = $CONFIG['CompanyName'] . " - Invoice #" . $invoiceid;

                        $payu_params['systemurl'] = $system_url;

                        $payu_params['amount'] = $total_invoice_amount_with_tax;

                        $payu_params["clientdetails"]["country"] = $getclientdetails_result['country'];

                        $payu_params["clientdetails"]["phonenumber"] = $getclientdetails_result['phonenumber'];

                        $payu_params["clientdetails"]["phonecc"] = $getclientdetails_result['phonecc'];

                        $payu_params["clientdetails"]["firstname"] = $getclientdetails_result['firstname'];

                        $payu_params["clientdetails"]["lastname"] = $getclientdetails_result['lastname'];

                        $payu_params["clientdetails"]["address1"] = $getclientdetails_result['address1'];

                        $payu_params["clientdetails"]["city"] = $getclientdetails_result['city'];

                        $payu_params["clientdetails"]["state"] = $getclientdetails_result['state'];

                        $payu_params["clientdetails"]["postcode"] = $getclientdetails_result['postcode'];

                        $payu_params["clientdetails"]["email"] = $getclientdetails_result['email'];

                        foreach ($payu_details['data'] as $details) {

                            if ($details->setting == "convertto") {

                                $payu_params['convertto'] = $details->value;

                            }

                            if ($details->setting == "MerchantKey") {

                                $payu_params['MerchantKey'] = $details->value;

                            }

                            if ($details->setting == "SALT") {

                                $payu_params['SALT'] = $details->value;

                            }

                            if ($details->setting == "mode") {

                                $payu_params['mode'] = $details->value;

                            }

                        }



                        $data['status'] = "success";

                        $data['fraud'] = FALSE;

                        $data['fullname'] = $getclientdetails_result['firstname'] . " " . $getclientdetails_result['lastname'];

                        $data['invoiceid'] = $invoiceid;

                        $data['orderinfo'] = $orderinfo;

                        $data['paytype'] = "payu";

                        $data['payu'] = "<div id='frmPaymentpayu'>" . payu_link($payu_params) . "</div><script>jQuery(\"#frmPaymentpayu\").find(\"form:first\").submit();function validate(){ return true; }</script>";

                    }

                }

                #end payu

                elseif ($_REQUEST['paymenttype'] == "ebs" && $invoiceid != "0") {

                    require_once ROOTDIR . ("/modules/gateways/ebs.php");

                    $ebs_details = OnePageCartClass::GetAnyPaymentGatewayDetails('ebs',$_SESSION['resellerid']);



                    if (isset($ebs_details['status']) && $ebs_details['status'] == "success") {

                        $ebs_params = array();

                        $ebs_params['invoiceid'] = $invoiceid;

                        $ebs_params['currency'] = $_SESSION['onepagecart_active_currency']['code']; //"USD";

                        $ebs_params['description'] = $CONFIG['CompanyName'] . " - Invoice #" . $invoiceid;

                        $ebs_params['returnurl'] = $system_url . '/viewinvoice.php?id=' . $invoiceid;

                        $ebs_params['systemurl'] = $system_url;

                        $ebs_params['amount'] = $total_invoice_amount_with_tax;

                        $ebs_params["clientdetails"]["country"] = $getclientdetails_result['country'];

                        $ebs_params["clientdetails"]["phonenumber"] = $getclientdetails_result['phonenumber'];

                        $ebs_params["clientdetails"]["phonecc"] = $getclientdetails_result['phonecc'];

                        $ebs_params["clientdetails"]["firstname"] = $getclientdetails_result['firstname'];

                        $ebs_params["clientdetails"]["lastname"] = $getclientdetails_result['lastname'];

                        $ebs_params["clientdetails"]["address1"] = $getclientdetails_result['address1'];

                        $ebs_params["clientdetails"]["city"] = $getclientdetails_result['city'];

                        $ebs_params["clientdetails"]["state"] = $getclientdetails_result['state'];

                        $ebs_params["clientdetails"]["postcode"] = $getclientdetails_result['postcode'];

                        $ebs_params["clientdetails"]["email"] = $getclientdetails_result['email'];

                        foreach ($ebs_details['data'] as $details) {

                            if ($details->setting == "accountid") {

                                $ebs_params['accountid'] = $details->value;

                            }

                            if ($details->setting == "convertto") {

                                $ebs_params['convertto'] = $details->value;

                            }

                            if ($details->setting == "hashtype") {

                                $ebs_params['hashtype'] = $details->value;

                            }

                            if ($details->setting == "mode") {

                                $ebs_params['mode'] = $details->value;

                            }

                            if ($details->setting == "name") {

                                $ebs_params['name'] = $details->value;

                            }

                            if ($details->setting == "pageid") {

                                $ebs_params['pageid'] = $details->value;

                            }

                            if ($details->setting == "secretkey") {

                                $ebs_params['secretkey'] = $details->value;

                            }

                            if ($details->setting == "type") {

                                $ebs_params['type'] = $details->value;

                            }

                            if ($details->setting == "visible") {

                                $ebs_params['visible'] = $details->value;

                            }

                        }







                        $data['status'] = "success";

                        $data['fraud'] = FALSE;

                        $data['fullname'] = $getclientdetails_result['firstname'] . " " . $getclientdetails_result['lastname'];

                        $data['invoiceid'] = $invoiceid;

                        $data['orderinfo'] = $orderinfo;

                        $data['paytype'] = "ebs";



                        $data['ebs'] = "<div id='frmPaymentebs'>" . ebs_link($ebs_params) . "</div><script>jQuery(\"#frmPaymentebs\").find(\"form:first\").submit(); function validate(){ return true; }</script>";

                    }

                } 

                elseif ($_REQUEST['paymenttype'] == "stripe" && $invoiceid != "0")
                {
                    
                    if((isset($_POST['stripeToken']) && !empty($_POST['stripeToken'])) || !empty($gatewayid)) 

                    {
                        $upw = $_SESSION['upw'];
                        $uid = $_SESSION['uid'];
                        
                        
                        
                        if (file_exists(ROOTDIR . ("/vendor/stripe/stripe-php/init.php")))
                        {

                            require_once ROOTDIR . ("/vendor/stripe/stripe-php/init.php");

                            $stripe = new \Stripe\Stripe;

                            $stripe_customer = new \Stripe\Customer;

                            $stripe_charge = new \Stripe\Charge;

                            $stripe_trans = new \Stripe\BalanceTransaction;

                        }

                        $stripe_details = OnePageCartClass::GetAnyPaymentGatewayDetails('stripe',$_SESSION['resellerid']);

                        

                        if (isset($stripe_details['status']) && $stripe_details['status'] == "success") 

                        {

                            

                            try

                            {

                                foreach ($stripe_details['data'] as $details) 

                                {

                                    if ($details->setting == "secretKey") {

                                        $gatewaysecretkey = $details->value;

                                    }

                                    if ($details->setting == "publishableKey") {

                                        $gatewaypublishablekey = $details->value;

                                    }

                                }

                                $stripe->setApiKey($gatewaysecretkey);

                                $token = $_POST['stripeToken'];

                                // Create a Customer:

                                $customer_id = $gatewayid;

                                if(empty($gatewayid))

                                {

                                    // Create a Customer:

                                    $customer = $stripe_customer->create(array(

                                                                            "email" => $clientemail,

                                                                            "source" => $token,

                                                                          )

                                                                    );

                                    $customer_id = $customer->id;

                                    logTransaction('Stripe', $customer, "Create Customer");

                                    // Charge the Customer instead of the card:

                                }

                                

                                

                                // Charge the Customer instead of the card:

                                $charge = $stripe_charge->create(array(

                                    "amount" => ($total_invoice_amount_with_tax * 100),

                                    "currency" => "usd",

                                    "customer" => $customer_id

                                ));

                                if (isset($charge->status) && $charge->status == "succeeded" || isset($charge->status) && $charge->status == "paid") {

                                    $stripeTransaction = $stripe_trans->retrieve($charge->balance_transaction);

                                    $addinviocepayment = array();

                                    $addinviocepayment["invoiceid"] = $invoiceid;

                                    $addinviocepayment["transid"] = $charge->balance_transaction;

                                    $addinviocepayment["amount"] = $total_invoice_amount_with_tax;

                                    $addinviocepayment["gateway"] = "stripe";

                                    $addinviocepayment["fees"] = ($stripeTransaction->fee / 100);

                                    $AddInvoicePayment_result = OnePageCartClass::AddInvoicePayment($addinviocepayment);

                                    update_query("tblclients", array("cardtype" => "Visa", "cardlastfour" => "", "cardnum" => "", "expdate" => "", "startdate" => "", "issuenumber" => "", "gatewayid" => $customer_id), array("id" => $clientid));

                                }

                                logTransaction('Stripe', $charge, "Charge");

                                $data['status'] = "success";

                                $data['fraud'] = FALSE;

                                $data['fullname'] = $getclientdetails_result['firstname'] . " " . $getclientdetails_result['lastname'];

                                $data['invoiceid'] = $invoiceid;

                                $data['orderinfo'] = $orderinfo;

                                $data['paytype'] = "stripe";

                                $data['redirecturl'] = $system_url . '/viewinvoice.php?id=' . $invoiceid;

                                

                            } 

                            catch (Exception $e)

                            {



                                // Something else happened, completely unrelated to Stripe

                            }

                        }
                        #Restoring session
                        
                        if(empty($_SESSION['uid']))
                        {
                            $_SESSION['uid'] = $uid;
                        }

                        if(empty($_SESSION['upw']))
                        {
                            $_SESSION['upw'] = $upw;
                        }

                    }
                    
                }
                else
                {

                    $data['redirecturl'] = $system_url . '/viewinvoice.php?id=' . $invoiceid;

                    $data['status'] = "success";

                }
               
                if (session_status() == PHP_SESSION_NONE) 
                {
                    session_start();
                }
                
                $_SESSION['onepagecart'] = $data;

            } else {

                $error[]['message'] = $addorder_results['message'];

                $data['errors'] = $error;

                $data['status'] = "failure";

            }

        } else {

            $error[]['message'] = $addclient_result['message'];

            $data['errors'] = $error;

            $data['status'] = "failure";

        }

    }

}

$result = json_encode($data);

echo $result;

?> 