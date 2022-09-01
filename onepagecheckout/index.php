<?php
define('CLIENTAREA', true);

use WHMCS\Database\Capsule;

if (file_exists('../init.php')) 
{
    require_once '../init.php';

    if (empty($CONFIG['SystemSSLURL'])) {
        $system_url = $CONFIG['SystemURL'];
    } else {
        $system_url = $CONFIG['SystemSSLURL'];
    }
    require_once 'onepagecart/onepagecart.Class.php';
    include_once '../includes/customfieldfunctions.php';
    include_once '../includes/configoptionsfunctions.php';

    if (isset($_REQUEST['a']) && $_REQUEST['a'] == "empty")
    {
        unset($_SESSION['productwithdomain']);
        unset($_SESSION['alldomainsselected']);
        unset($_SESSION['alldomainsselectedtypes']);
        unset($_SESSION['productids']);
        unset($_SESSION['productbillingcycles']);
        unset($_SESSION['onepagecart_mainsession']);
        unset($_SESSION['productconfiguration']);
        unset($_SESSION['selected_addon']);
        unset($_SESSION['domainaddonselected']);
        unset($_SESSION['tax']);
        unset($_SESSION['pre_addon']);
        unset($_SESSION['configureserver_fields']);
        unset($_SESSION['customfieldvalues']);
        unset($_SESSION['promocode']);
        unset($_SESSION['promocode_result']);
        
        header("location:index.php?success");
    }

    if (isset($_REQUEST['r']) && $_REQUEST['r'] == "p" && isset($_REQUEST['i'])) {
        unset($_SESSION['productids'][$_REQUEST['i']]);
        unset($_SESSION['productbillingcycles'][$_REQUEST['i']]);
        array_splice($_SESSION['productconfiguration'], $_REQUEST['i'], 1);
        array_splice($_SESSION['selected_addon'], $_REQUEST['i'], 1);
    }

    #removing product configuration
    if (isset($_REQUEST['r']) && $_REQUEST['r'] == "c" && isset($_REQUEST['i'])) {
        unset($_SESSION['productconfiguration'][$_REQUEST['i']][$_REQUEST['o']]);
    }
    #removing addon 
    if (isset($_REQUEST['r']) && $_REQUEST['r'] == "a" && isset($_REQUEST['i'])) {
        unset($_SESSION['selected_addon'][$_REQUEST['i']][$_REQUEST['o']]);
    }
    $_SESSION['pre_addon'] = $_SESSION['selected_addon'];

    $currencies_result = OnePageCartClass::getallCurrencies();
    $optionalFields_response=OnePageCartClass::get_clientsProfileOptionalFields();
    if($optionalFields_response['status']=='success' && !empty($optionalFields_response['data']))
    {
        $optionalFieldArray=explode(",",$optionalFields_response['data']);
    }
    
    
    $data1 =  Capsule::table('vpnmywebsite')->where('uid',$_SESSION['resellerid'])->get();
     
    $title = ($data1[0]->companyName == "")? "Your Company" : $data1[0]->companyName;
    $tagline = ($data1[0]->tagline == "")? "Your Tagline" : $data1[0]->tagline;
    
    
    //$link1 = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 
    //$link = $link.split("?")[0];
    $parsedURL = parse_url($_SERVER[REQUEST_URI], PHP_URL_PATH);
    
    $link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$parsedURL";
    
/*$getresellerID =  Capsule::table('vpnmywebsite')->where('websiteURL',$link)->get();*/
$getresellerID = $_GET['user'];

/*$_SESSION['resellerid'] = $getresellerID[0]->uid;*/
$_SESSION['resellerid'] = $getresellerID;

$data =  Capsule::table('vpnmywebsite')->where('uid',$_SESSION['resellerid'])->get();


    ?>

    <!DOCTYPE html>
    <html lang="en">
        <head>
    <?php
    include_once 'templates/head.tpl';
    ?>
            <style>
                .order-item-product
                {
                    text-align: right;
                }
                .btn-orange
                {
                    height: 55px;
                    padding: 0 15px;
                    border-radius: 5px;
                    border: 2px solid #ff6c3a;
                    background: #ff6c3a;
                    font-family: "Brandon Grotesque Black", sans-serif;
                    font-size: 16px;
                    line-height: 50px;
                    color: #ffffff;
                    text-transform: uppercase;
                    white-space: nowrap;
                }
                .custom-btn
                {
                    background: #ff6c3a none repeat scroll 0 0;
                    color: #fff;
                    margin-left: 21px;
                }
                .custom-btn:hover
                {
                    background: #ff6c3a none repeat scroll 0 0;
                    color: #fff;
                    margin-left: 21px;
                }
                .btn-orange:hover 
                {
                        background: #232C3B !important;
    border-color: #232C3B !important;
                    color: #fff;
                    opacity: 1;
                }
                .paymentmethodbox {
                    margin-top: 20px;
                    position: relative;
                    margin: 1% auto;
                    background: #ffffff;
                    border-radius: 7px;
                    color: black;
                    text-align: center;
                    padding: 25px;
                    cursor: pointer;
                    border: 1px solid #2e3e5f;
                }
                /*---start custom--- */
                .panel-addon 
                {
                    text-align: center;
                }
                .panel
                {
                    border: none;
                    box-shadow: 0px 0px 4px 1px #ddd;
                    margin-bottom: 20px;
                    background-color: #fff;
                    border-radius: 4px;
                }
                .panel-body 
                {
                    padding: 10px 15px;
                    height: 115px;
                }
                
                
                .panel-addon .panel-body label
                {
                    font-size: 1em;
                    font-weight: 700;
                    color: #333;
                 }
                .panel-addon .panel-price
                {
                    padding: 4px;
                    background-color: #e8e8e8;
                }
                
                .panel-addon .panel-add
                {
                    display: block;
                    padding: 4px;
                    background-color: #5cb85c;
                    color: #fff;
                    border-radius: 0 0 4px 4px;
                }
                .domain-addon
                {
                    width: 33%;
                    display: inline-block;
                    padding: 0px 15px;
                }
                .panel-add-selected
                {
                    background-color: #ebccd1 !important;
                    color: #a94442 !important;
                }
                .panel-price-selected
                {
                    background-color: #5cb85c !important;
                    color: #fff !important;
                }
                .control
                {
                    cursor: pointer;
                }
                .footer
                {
                    width: 100%;
                    margin: 0 auto;
                    float: left;
                    background: #5F6F80;
                    padding: 10px 0px;
                    margin-top: 30px;
                }
                .footer p
                {
                    color: #fff;
                    padding-top: 40px;
                }
                iframe
                {
                    display:none;
                }
                .place-order
                {
                        background-color: #0e5077;
                        border: #0e5077;
                        padding: 14px 30px;
                        font-size: 15px;
                        border-radius: 0px;
                        margin-left: -5px;
                        margin-top: -3px;
                        color: #ffffff;
                        font-weight: 700;
                }
                .top-right-section 
                {
                      float: right;
                     background-color: #5f6f80;
                      padding: 8px 15px 5px 15px;
                      color: #fff;
                     margin-bottom: 12px;
                  }
                  
                  .pickbtn 
                  {
                      background: #00506e;
                      border-color: #00506e;
                  }

                  .config-container {
                        clear: both;
                    }

                    .hideAllconfig{
                        display: none !important;
                    }
                /*---End Custom------*/
            </style>
            <style>
            <?php
               
                
                
                if($data[0]->headColor !== '')
                {
                    

$hex = $data[0]->headColor; //Bg color in hex, without any prefixing #!
                    $hex = preg_replace( '/[^0-9a-f]/i', '', $hex );
	$new_hex = '#';
		$new_hex1 = '#';
	
	if ( strlen( $hex ) < 6 ) {
		$hex = $hex[0] + $hex[0] + $hex[1] + $hex[1] + $hex[2] + $hex[2];
		
	}
	$dec = '';
	$percent = 0.3;
	$new_dec = '0';
	
		$dec1 = '';
	$percent1 = 45;
	$new_dec1 = '0';
	// convert to decimal and change luminosity
	for ($i = 0; $i < 3; $i++) {
		$dec = hexdec( substr( $hex, $i*2, 2 ) );

		$dec = min( max( 0, $dec + $dec * $percent ), 255 );
		$new_dec = $dec+$new_dec;
	
		$new_hex .= str_pad( dechex( $dec ) , 2, 0, STR_PAD_LEFT );
			//echo str_pad( dechex( $dec ) , 2, 0, STR_PAD_LEFT ).'<br>';
		
	}
	function hex2rgba($color, $opacity = false) {
 
	$default = 'rgb(0,0,0)';
 
	//Return default if no color provided
	if(empty($color))
          return $default; 
 
	//Sanitize $color if "#" is provided 
        if ($color[0] == '#' ) {
        	$color = substr( $color, 1 );
        }
 
        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }
 
        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);
 
        //Check if opacity is set(rgba or rgb)
        if($opacity){
        	if(abs($opacity) > 1)
        		$opacity = 1.0;
        	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
        	$output = 'rgb('.implode(",",$rgb).')';
        }
 
        //Return rgb(a) color string
        return $output;
}
$new_rgba1 = hex2rgba($data[0]->headColor,0.31); 
	
	echo '.crDetails
	{
	    background-color: '.$new_rgba1.' !important; 
	    border-color: '.$new_hex.' !important;
	    
	}';
	


if($new_dec > 510){
  echo '.price-table .top-head .top-area
  {
     border-bottom: 1px solid #000; 
  }
  .price-table .top-head .price-area
  {
     border-top: 1px solid #000; 
  }
  #product1-name
  {
  color:#000;
    }';
}
else
{
    echo '.price-table .top-head .top-area
  {
     border-bottom: 1px solid #fff; 
  }
  .price-table .top-head .price-area
  {
     border-top: 1px solid #fff; 
  }
  #product1-name
  {
  color:#fff;
    }
  ';
}
	
	
                    echo ' .control input:checked ~ .control__indicator {
  background: '.$data[0]->headColor.' !important;
  
}
.btn-primary
{
background: '.$data[0]->headColor.' !important;
border-color: '.$data[0]->headColor.' !important;
}

.btn-primary:hover
{
background: '.$new_hex.' !important;
border-color: '.$new_hex.' !important;
}
.pickbtn
{
 background: '.$data[0]->headColor.' !important;
  border-color: '.$data[0]->headColor.' !important;
}
.pickbtn:hover
{
 background: '.$new_hex.' !important;
 border-color: '.$new_hex.' !important;
}
.active .price-table .top-head
{
 background: '.$data[0]->headColor.' !important;
}
.price-table .top-head
{
    background:linear-gradient(to bottom, '.$new_hex.' 0%,'.$data[0]->headColor.' 100%);
}
.product:hover, .product.active
{
    box-shadow: 0 0 15px 5px '.$new_rgba1.';
}
';
 echo '.control:hover input:not([disabled]):checked ~ .control__indicator,
.control input:checked:focus ~ .control__indicator {
  background: '.$data[0]->headColor.' !important;
  
}';
 echo '.control input:disabled ~ .control__indicator {
  background: '.$data[0]->headColor.' !important;
}';
                    echo '.heading-bar, .control input:checked ~ .control__indicator{background-color:'.$data[0]->headColor.' !important;}';
                    echo '.place-order {background-color: '.$data[0]->headColor.' !important;border: '.$data[0]->headColor.' !important;}';   
                }
                if($data[0]->textColor !== '')
                {
                    echo '.heading-bar h3{color:'.$data[0]->textColor.'!important;}
                    .btn-primary
{
color: '.$data[0]->textColor.' !important;
}
                    ';   
                }
                
                ?>
            </style>
            <script type="text/javascript">
        $(document).ready(function(){
			<?php if(isset($_GET['product']) && !empty($_GET['product']))
			{
			?>
			$('#p_<?php echo $_GET['product'];?>').parent('.product').addClass("active");
    $('.product.active').children('input').prop('checked', true);
    $('.product.active p.pickbtn').html('<i class="fa fa-check"></i> Selecionado');

   
        opcupdate();
    
			<?php } else{
				?>
				$('.product:eq(0)').addClass("active");
    $('.product.active').children('input').prop('checked', true);
    $('.product.active p.pickbtn').html('<i class="fa fa-check"></i> Selecionado');

   
        opcupdate();
   
			<?php } ?>
        });
	</script>
            <script>
                var csrfToken = '<?php echo generate_token("plain"); ?>';

            </script>
        </head>
        <body>
            <!-------start container------>
            <?php if(!isset($_GET['user']) || empty($_GET['user'])){
                echo '<h2 class="text-center">No User Found!</h2>'; die();
            }?>
            
            <div class="container">
                
                <a href="<?php if($data[0]->domainURL !== ''){echo $data[0]->domainURL;} else{ echo '#' ; }?>"><img src="<?php if($data[0]->logo !== ''){echo '../'.$data[0]->logo;} else{ echo 'images/logo.png' ; }?>" alt="" style="margin-bottom: 10px; max-width: 300px;"></a>
                     <div class="top-right-section"><img src="images/lock_img.png" style="padding: 0px 2px 5px 0px;">100% safe and secure signup</div>
                    <!----currency start---->
                    <?php
                       if (empty($_SESSION['uid'])) 
                       {
                            if (isset($currencies_result['result']) && $currencies_result['result'] == "success" && count($currencies_result['totalresults']) > 0) 
                            {
                        ?>
                                <div style="float: right;padding-top: 40px;display: none;">
                                    <span style="float: left;line-height: 30px;margin-right: 10px;">Choose Currency:</span> 
                                    <span style="float: right;">
                                    <form method="GET" id="onepagecartactivecurrencyform">
                                    <select name="currency" onchange="$('#onepagecartactivecurrencyform').submit();" style="padding: 6px 12px!important;height: 30px!important;font-size: 12px!important;">
                                    <?php
                                    $currency_prefix=$_SESSION['onepagecart_active_currency']['prefix'];
                                    foreach ($currencies_result['currencies']['currency'] as $currency_key=>$currency) 
                                    {
                                        if (isset($_GET['currency'])) 
                                        {
                                            if($currency['id']==$_GET['currency'])
                                            {
                                                $_SESSION['onepagecart_active_currency'] = $currencies_result['currencies']['currency'][$currency_key];
                                                $currency_prefix=$currencies_result['currencies']['currency'][$currency_key]['prefix'];
                                            }
                                        }
                                    ?>
                                        <option value="<?php echo $currency['id']; ?>" <?php if($currency['id']==$_SESSION['onepagecart_active_currency']['id']){ echo "selected"; } ?>><?php echo $currency['code']; ?></option>
                                    <?php
                                    }
                                    ?>
                                    </select>
                                    </form>
                                    </span>
                                </div>
                                <?php
                                if(empty($_SESSION['onepagecart_active_currency']))
                                {
                                    $_SESSION['onepagecart_active_currency'] = $currencies_result['currencies']['currency'][0];
                                    $currency_prefix= $currencies_result['currencies']['currency'][0]['prefix'];
                                }
                            } 
                            else
                            {
                                echo $currencies_result['message'];
                                exit;
                            }
                       }
                       else
                        {
                           #loged in
                           $getclientdetails_result = OnePageCartClass::GetClientsDetails($_SESSION['uid']);
                            foreach ($currencies_result['currencies']['currency'] as $currency_key=>$currency) 
                            {
                                if($currency['id']==$getclientdetails_result['currency'])
                                {
                                    $_SESSION['onepagecart_active_currency'] = $currencies_result['currencies']['currency'][$currency_key];
                                    $currency_prefix= $_SESSION['onepagecart_active_currency']['prefix'];
                                }
                            }
                        }
                        
                        ?>
                    <!---currency end---->
                    <?php
                    #Start config option(only php)
                    if (isset($_REQUEST['product']) && isset($_REQUEST['a']))
                    {
                        $currency['id']=$_SESSION['onepagecart_active_currency']['id'];
                        if ($_REQUEST['a'] == 'edit') 
                        {
                            $selectedconfigoptions = $_SESSION['onepagecart_mainsession']['products'][$_REQUEST['i']]['selconfigids'];
                            $billingcycle = $_SESSION['onepagecart_mainsession']['products'][$_REQUEST['i']]['billingcycle'];
                            
                            $configoptions = getCartConfigOptions($_REQUEST['product'], $selectedconfigoptions, $billingcycle, $accountid = "", $orderform = "");
                        }
                        elseif ($_REQUEST['a'] == 'add') 
                        {
                            $adminid = OnePageCartClass::GetAdminID();
                            $command_getproducts = "getproducts";
                            $adminuser = $adminid['records'];
                            $values_getproducts["pid"] = $_REQUEST['product'];
                            $Products_result = $results = Capsule::table('tblproducts')
                            ->join('tblpricing','tblproducts.id','=','tblpricing.relid')
                            ->where('tblproducts.id', $_REQUEST['product'])
                            ->select(
                                    'tblproducts.*',
                                    'tblpricing.currency as clientcurrency',
                                    'tblpricing.monthly',
                                    'tblpricing.quarterly',
                                    'tblpricing.semiannually',
                                    'tblpricing.annually',
                                    'tblpricing.biennially',
                                    'tblpricing.triennially',
                                    'tblpricing.msetupfee',
                                    'tblpricing.qsetupfee',
                                    'tblpricing.ssetupfee',
                                    'tblpricing.asetupfee',
                                    'tblpricing.bsetupfee',
                                    'tblpricing.tsetupfee',
                                    'tblproducts.paytype'
                                    )
                            ->get();
                            if ($Products_result['result'] == "success") 
                            {
                                $product_paytype = $Products_result['products']['product'][0]['paytype'];
                                if ($product_paytype == 'recurring') 
                                {
                                    $price = array();
                                    
                                    $currencyCode = $_SESSION['onepagecart_active_currency']['code'];
                                    $currencyID = $_SESSION['onepagecart_active_currency']['id'];
                                    $currency['id']=$currencyID;
                                    $price['monthly'] = $Products_result['products']['product'][0]['pricing'][$currencyCode]['monthly'];
                                    $price['quarterly'] = $Products_result['products']['product'][0]['pricing'][$currencyCode]['quarterly'];
                                    $price['semiannually'] = $Products_result['products']['product'][0]['pricing'][$currencyCode]['semiannually'];
                                    $price['annually'] = $Products_result['products']['product'][0]['pricing'][$currencyCode]['annually'];
                                    $price['biennially'] = $Products_result['products']['product'][0]['pricing'][$currencyCode]['biennially'];
                                    $price['triennially'] = $Products_result['products']['product'][0]['pricing'][$currencyCode]['triennially'];

                                    foreach ($price as $key => $value)
                                    {
                                        if ($value != "-1.00") {
                                            $billingcycle = $key;
                                            break;
                                        }
                                    }
                                } 
                                else
                                {
                                    $billingcycle = 'monthly';
                                  
                                }
                            }
                            $configoptions = getCartConfigOptions($_REQUEST['product'], '', $billingcycle, '', '');
                        }
                    }
                    #End Config Option(only php)
                    ?>
                    
                    
                    
                    <!----start wrapper----->
                    <div class="wrapper">
                        <form id='placeorder' data-toggle="validator" method='post' name="orderfrm">
    <?php
   
        $ProductInfo = OnePageCartClass::getProductInfo($_SESSION['productids']);
        if ($ProductInfo['status'] == "success") {
            $ShowDomainOptions = $ProductInfo['data'][0]->showdomainoptions;
            $productName = $ProductInfo['data'][0]->name;
        }
        if (isset($_GET['a']) && $_GET['a'] == "edit" && isset($_GET['product']) && !empty($_GET['product'])) {
            //$choosebillingcycle = "Choose your IPTV Subscription (" . $productName . ")";
            $choosebillingcycle = "Choose your VPN Subscription";
        } else {
            $choosebillingcycle = "Choose your VPN Subscription";
        }
       
        ?>
        
                            
                            <!-- Choose a hosting Plan --->
                            <div id="billingcycleblock" style="display: block; float: left; width: 100%;">
                                <div class="heading-bar">
                                    <img src="images/hosting-icon.png" alt="img"><h3><?php echo $choosebillingcycle; ?></h3>
                                </div>
                                <!----start hosting plan-->
                                <?php $products = '';
                                
                                    if(empty($data[0]->products))
                                    {
                                        
                                        ?>
                                        <style>
                                            #billingcycleblock .personal-info, #billingcycleblock .personal-info-2  {display: none;}
                                        </style>
                                        <p class="text-center" style="margin-top: 20px;">No Product Added yet.</p>
                                        <?php 
                                    }else
                                    {
                                    $products = explode(',',$data[0]->products);
                                    ?>
                                <div class="col-md-12 personal-info clearfix">
                                    <div class="col-md-12 side-label">
                                        <h4 class="text-center">Choose a Plan</h4>
                                    </div>
                            <?php
                            $adminid = OnePageCartClass::GetAdminID();
                            $command = "getproducts";
                            $adminuser = $adminid['records'];
                            //$getproducts_values['gid'] = $_GET['gid'];
                            $allProducts_result = localAPI($command, $getproducts_values, $adminuser);
                            ?>
                                    <div class="col-md-12">
                                    
                                        <div class="form-group">
                                            <input type="hidden" name="producttoadd" id="producttoadd" value="add"/>
                                <input type='hidden' name="urlpram" value="add">
                                <center>
                                <ul>
                                            
                                <?php 
                                  $adminid = OnePageCartClass::GetAdminID();
                                  $adminuser = $adminid['records'];
                                  
                                foreach($products as $product)
                                {
                                    $results = Capsule::table('tblproducts')
                            ->join('tblpricing','tblproducts.id','=','tblpricing.relid')
                            ->where('tblproducts.id', $product)
                            ->select(
                                    'tblproducts.*',
                                    'tblproducts.id as pid',
                                    'tblpricing.currency as clientcurrency',
                                    'tblpricing.monthly',
                                    'tblpricing.quarterly',
                                    'tblpricing.semiannually',
                                    'tblpricing.annually',
                                    'tblpricing.biennially',
                                    'tblpricing.triennially',
                                    'tblpricing.msetupfee',
                                    'tblpricing.qsetupfee',
                                    'tblpricing.ssetupfee',
                                    'tblpricing.asetupfee',
                                    'tblpricing.bsetupfee',
                                    'tblpricing.tsetupfee',
                                    'tblproducts.paytype'
                                    )
                            ->get();
//print_r($results['products']['product'][0]['pid']);
$currencyCode = $_SESSION['onepagecart_active_currency']['code'];
        $currencyID = $_SESSION['onepagecart_active_currency']['id'];
     
      $Products_result = $results;
       //print_r($Products_result['result']); die();
       
       $data2 =  Capsule::table('vpnpackageprice')->where('uid',$_SESSION['resellerid'])->where('products',$product)->get();
       
     //$data2Count = Capsule::table('vpnpackageprice')->where('uid',$_SESSION['resellerid'])->count();
       /*echo "<pre>";print_r($results);echo"</pre>";*/
       
       
?>

<li id="product1">
    
    <label for="p_<?php echo $results[0]->pid;?>" class="product product_label">
    <input type="radio" id="p_<?php echo $results[0]->pid;?>" class="productRadio" name="products" value="<?php echo $results[0]->pid;?>">

                                <div class="price-table">
                                    <div class="top-head">
                                        <div class="top-area">
                                            <h4 id="product1-name"><?php echo $results[0]->name;?></h4>
                                        </div>
                                                                                
                                        <div class="price-area">
                                            <div class="price" id="product1-price">
                                                <?php 
                                                if (!empty($Products_result)) 
        {
           
            $product_name = $Products_result[0]->name;
            $product_type = $Products_result[0]->type;
            
            $monthly_price_setup = $Products_result[0]->msetupfee;
            $quarterly_price_setup = $Products_result[0]->qsetupfee;
            $semiannually_price_setup = $Products_result[0]->ssetupfee;
            $anually_price_setup = $Products_result[0]->asetupfee;
            $biennially_price_setup = $Products_result[0]->bsetupfee;
            $triennially_price_setup = $Products_result[0]->tsetupfee;

            $product_paytype = $Products_result[0]->paytype;
            /*$prefix = $Products_result[[0]->prefix;*/
            //$prefix = "$";
            $monthly_price = $data2[0]->priceMonthly;
           
            $quarterly_price = $data2[0]->priceQuarterly;
            $semiannually_price = $data2[0]->priceSemiannually;
            $anually_price = $data2[0]->priceAnnually;
            $biennially_price = $data2[0]->priceBiennially;
            $triennially_price = $data2[0]->priceTriennially;
            
            $prefix = '$';
            
            $anually_saving = $biennially_saving = $triennially_saving = 0;
            if (!empty($monthly_price) && $monthly_price != "-1.00") {
                $quarterly_saving = number_format(((($monthly_price) - ($quarterly_price / 3)) / $monthly_price) * 100, 2);
                $semiannually_saving = number_format(((($monthly_price) - ($semiannually_price / 6)) / $monthly_price) * 100, 2);
                $anually_saving = number_format(((($monthly_price) - ($anually_price / 12)) / $monthly_price) * 100, 2);
                $biennially_saving = number_format(((($monthly_price) - ($biennially_price / 24)) / $monthly_price) * 100, 2);
                $triennially_saving = number_format(((($monthly_price) - ($triennially_price / 36)) / $monthly_price) * 100, 2);
            }
            $pricing = array();
            if (!empty($monthly_price) && $monthly_price != "-1.00" ) {
               echo '<span style="font-size: 23px;">'.$prefix.' '.$monthly_price.'/mo</span>';
                
            }
            elseif (!empty($quarterly_price) && $quarterly_price != "-1.00") {
               echo '<span style="font-size: 23px;">'.$prefix.' '.$quarterly_price.'/3 mo</span>';
                
            }
            elseif (!empty($semiannually_price) && $semiannually_price != "-1.00") {
               echo '<span style="font-size: 23px;">'.$prefix.' '.$semiannually_price.'/6 mo</span>';
                
            }
            elseif (!empty($anually_price) && $anually_price != "-1.00" ) {
               echo '<span style="font-size: 23px;">'.$prefix.' '.$anually_price.'/1 yr</span>';
                
            }
            elseif (!empty($biennially_price) && $biennially_price != "-1.00" ) {
               echo '<span style="font-size: 23px;">'.$prefix.' '.$biennially_price.'/2 yr</span>';
                
            }
            elseif (!empty($triennially_price) && $triennially_price != "-1.00") {
               echo '<span style="font-size: 23px;">'.$prefix.' '.$triennially_price.'/3 yr</span>';
                
            }
            
            else
            {
                 echo '<span style="font-size: 23px;">FREE</span>';
            }
       
            
        }
        
                                                ?>
                                                
                                                                                                  
                                                                                            </div>
                                                                                            
                                            
                                        </div>
                                    </div>

                                    <ul>
                                        <?php $des = explode("\n", $results['products']['product'][0]['description']);
                                        foreach($des as $list)
                                        {
                                            ?>
                                            <li id="product1-description"><?php echo $list;?> </li>
                                            <?php 
                                        }?>
                                                                                    
                                                                            </ul>
                                                <p class="btn btn-primary form-control btn-lg pickbtn" id="product1-order-button" style="height: auto;">
                                                    Pick Now
                                                </p>
                                </div>
                                </label>
                            </li>
                            


<?php 

                                }
                                
                                ?>
                                            </ul>
                                            </center>
                                        </div>
                                        
            
                                    </div>
                                </div>
                                <?php } ?>
                                <!----end hosting plan--->
                                <div class="col-md-12 personal-info-2 clearfix" id="billCyc" style="margin-top: 15px; display: none;">
                                    <div class="col-md-2 side-label">
                                        <label for="billingcycle">Billing Cycle</label>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <select class="form-control custom-dropdown trigger-update" id="billingcycle" name="billingcycle">
                                                <option value="">Please Select Validity</option>
        <?php
        if (isset($_GET['a']) && $_GET['a'] == "edit") {
            ?>
                                                    <option value="<?php echo $_SESSION['productbillingcycles'][$_GET['i']]; ?>" selected="selected">Please select a billing cycle</option>
            <?php
        } else {
            ?>
                                                    <option value="<?php
            if (isset($_GET['billingcycle']) && !empty($_GET['billingcycle'])) {
                echo $_GET['billingcycle'];
            } else {
                echo "free";
            }
            ?>" 
                                                            selected="selected">Please select a billing cycle
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!---end Choose a hosting plan -->

                                                <?php
                                            
                                            ?>
                            
                            
                            
                            
                                            <?php
                                            if (isset($_GET['r'])) {
                                                ?>
                            <input type="hidden" name="removeitemtype" id="remove_item_type" value="<?php echo $_GET['r']; ?>"/>
                            <input type="hidden" name="removeitem" id="remove_item_hidden"  value="<?php echo $_GET['i']; ?>">
        <?php
    }
    ?>
                        <?php
                        if (isset($_GET['a']) && $_GET['a'] == "add") {
                            ?>
                            <input type="hidden" name="producttoadd" id="producttoadd" value="add"/>
                            <?php
                        }
                        ?>
                        <?php
                            if (isset($_GET['a']) && $_GET['a'] == "edit" && isset($_GET['i']) && is_numeric($_GET['i'])) {
                         ?>
                            <input type="hidden" name="producttoedit" id="producttoedit" value="<?php echo $_GET['i']; ?>"/>
                            <?php
                        }
                        ?>


                        <!-----start domain block---->
                        <?php
                        if ($ShowDomainOptions)
                        {
                            echo '<input type="hidden" name="domain_required[]" value="true">';
                            if (isset($_GET['a']) && $_GET['a'] == "edit" && isset($_GET['product']) && !empty($_GET['product'])) {
                                $chooseadomain = "Choose a Domain (" . $productName . ")";
                            } else {
                                $chooseadomain = "Choose a Domain";
                            }
                            ?>
                            <div class="heading-bar">
                                <img src="images/domain-icon.png" alt="img"><h3><?php echo $chooseadomain; ?></h3>
                            </div>
                            <div class="choose-a-domain">
                                <ul class="nav nav-tabs center-pills">
                                    <li class="active" id="newdomain" onclick="domainselect('newdomain');"><a href="#service-one" data-toggle="tab">Register a New Domain</a></li>
                                    <li id="existingdomain" onclick="domainselect('existingdomain');"><a href="#service-two" data-toggle="tab">I already have a Domain for the hosting plan</a></li>
                                </ul>
                                <div class="tab-content clearfix">
                                    <!----tab Register domain tab---->
                                    <div class="tab-pane fade in active" id="service-one">
                                        <h3>Enter Your Domain</h3>
                                        <div>
                                            <div class="col-md-1 www no-padding">
                                                <p>www.</p>
                                            </div>

                                            <div class="col-md-11 no-padding">
                                                <div class="form-group">

                                                    <input type="text" placeholder="yourdomain" class="form-control domain-input" id="domainrt" name="domain">
                                                    <select class="form-control domain-selection" id="domaindropdown">
        <?php
        
        $currencyCode = $_SESSION['onepagecart_active_currency']['code'];
        $currencyID = $_SESSION['onepagecart_active_currency']['id'];
        $getTlds = OnePageCartClass::getTLDList($currencyID);
        foreach ($getTlds as $Tlds) {
            ?>
                                                            <option value="<?php echo $Tlds; ?>"><?php echo $Tlds; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <button type="button" class="btn btn-primary domain-btn" id="domain_search">CHECK</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!--- start message--->
                                        <div id="regdomain-message" class="col-md-12" style="padding-left:0px;"></div>
                                        <div id="domain_select_block" class="col-md-12" style="padding-left:0px;padding-right: 0px;display:none;">
                                            <div class="col-md-1 www no-padding"></div>
                                            <div class="col-md-8 no-padding" style="width: 63.3%;">
                                                <div class='form-group select_wrap'>
                                                    <select id="domain_select" name="domain_select" class="form-control styled" style="height:55px;"></select>
                                                </div>
                                            </div>
                                            <div class='col-md-3 col-md-push-0 col-xs-push-1 col-xs-10' style="padding: 0px;width: 26%;">
                                                <button id="savedomain" type="button" class="btn btn-orange custom-btn">Add to cart</button>
                                                <button type="button" class="btn btn-orange" id="canceldomain" style="padding: 0 16px;margin-left: 18px;">Cancel</button>
                                            </div>
                                        </div>
                                        <!--- end message--->
                                    </div>
                                    <!----End register domain---->

                                    <!----start own domain----->
                                    <div class="tab-pane fade" id="service-two">
                                        <h3>Enter your Domain</h3>
                                        <div class="col-md-12">
                                            <div class="col-md-3 www no-padding">
                                                <p>www.</p>
                                            </div>

                                            <div class="col-md-4 no-padding">
                                                <div class="form-group">
                                                    <input type="text" placeholder="yourdomain.com" class="form-control domain-input" id="owndomain1" name="owndomain1" style="float:left; width: 100%;">
                                                    <!--<input type="text" placeholder=".com" class="form-control" id="owndomaindropdown" name="owndomaindropdown" style="width:10%;height: 55px;float:left;">-->
                                                </div>
                                            </div>
                                            <div class='col-md-2 col-md-push-0 col-xs-push-1 col-xs-10'>
                                                <button type="button" class="btn btn-orange domain-btn" style="margin-top:0px; width: 70%;" id="usedomain">SAVE</button>
                                            </div>
                                        </div>

                                        <!----start transfer domain---->
                                        <div class="col-md-12">
                                            <div class="col-md-3 www no-padding">
                                                <p>I Want To Transfer My Domain To Dat-Hosting</p>
                                            </div>
                                            <div class="col-md-1 no-padding">
                                                <input type="checkbox"  class="form-control" id="transfer-checkbox" name="transfer-checkbox" style="margin-top:34px;margin-left:0px;width: 20px;height: 20px;">
                                            </div>
                                        </div>
                                        <!----end transfer domain---->
                                        <!----start transfer msg-->
                                        <div class="col-md-12">
                                            <div class="col-md-3 www no-padding"></div>
                                            <div class="col-md-4 no-padding" id="tranferdomain-message"></div>
                                        </div>
                                        <!----end transfer msg-->
                                        <!-----start Epp code---->
                                        <div class="col-md-12" id='epp-text' style='display:none;'>
                                            <div class="col-md-3 www no-padding">
                                                <p>EPP Code</p>
                                            </div>
                                            <div class="col-md-4 no-padding">
                                                <input type="text" placeholder="EPP Code" class="form-control domain-input trigger-update" id="eppcode" name="eppcode" style="float:left; width: 100%;">
                                            </div>
                                        </div>
                                        <!----end Epp Code----->

                                        <!----start Epp code msg---
                                        <div class="col-md-12" id='epp-msg' style='display:none;'>
                                            <div class="col-md-3 www no-padding"></div>
                                            <div class="col-md-4 no-padding">
                                                <p style="background-color:#f6f6f6;text-align:center;font-size: 17px;padding: 12px;">
                                                    In order to transfer this domain , you will need to obtain
                                                    the EPP Code from your current registrar ,Don't worry, you
                                                    can always transfer your domain later!
                                                </p>
                                            </div>
                                        </div>
                                        ---ens Epp code msg---->
                                    </div>
                                    <!------end own domain----->
                                </div>
                            </div>
                        
                            <!----start domain addon---->
                            <div id="domain-addon" style="display:none;">
                                <div class="heading-bar" style="margin-bottom: 20px;">
                                    <img src="images/domain-icon.png" alt="img"><h3>Domain Addons</h3>
                                </div>
                            <div class="col-md-12" style="text-align: center;margin-top: 30px;margin-bottom: 30px;" id="domainaddonblock">
                                
                            </div>
                            </div>
                            <!-----End domain addon---->
        <?php
    }
    ?>
                        <!-----End domain block---->

                        
                        
                            
                            
                            
                            <?php
                             
        ?>
                            <!-- Billing information -->
                            <div class="heading-bar custom-billing">
                                <img src="images/billing-icon.png" alt=""><h3>Enter Your Billing Information</h3>
                            </div>
        <?php if(empty($_SESSION['uid'])) { ?>
                                <div class="billing-information">
                                    <div class="col-md-12" style='margin-top: 15px;'>
                                        <div class="already-registered clearfix">
                                            <div class="pull-right">
                                                <button type="button" class="btn btn-primary registered-btn" id="btnAlreadyRegistered" value="alreadyRegistered" onclick="selectLoginMode(this.value);">
                                                    Already Registered ?
                                                </button>
                                                <button type="button" class="btn btn-primary registered-btn" id="btnNewUserSignup"  value="newUserSignup" onclick="selectLoginMode(this.value);" style="display: none;">
                                                    Create a New Account
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div id='containerNewUserSignup'>
                                        <input type='hidden' name='account_type' value='create'>
                                        <!--<h4 class="head_set">Please enter your personal details and billing information to checkout</h4>-->
                                        
                                        <div class="col-md-12 personal-info clearfix">
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <label for="firstname">First Name
                                                        <?php
                                                        if(!in_array("firstname",$optionalFieldArray))
                                                        {
                                                            $firstname="mandatory='true'";
                                                        ?>
                                                            <span class="mandatory">*</span>
                                                        <?php    
                                                        }
                                                        ?>                                                        
                                                    </label>
                                                    <br/>
                                                    <input type="text" placeholder="Enter your First Name" class="form-control personal-input" name="firstname" id="firstname" <?php echo $firstname; ?> >
                                                </div>

                                            </div>
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <label for="lastname">Last Name
                                                        <?php
                                                        if(!in_array("lastname",$optionalFieldArray))
                                                        {
                                                            $lastname="mandatory='true'";
                                                        ?>
                                                            <span class="mandatory">*</span>
                                                        <?php    
                                                        }
                                                        ?>
                                                    </label><br>
                                                    <input type="text" placeholder="Enter your Last Name" name="lastname" class="form-control personal-input" id="lastname" <?php echo $lastname; ?> >
                                                </div>

                                            </div>
                                        </div> <!-- personal information -->
                                        <div class="col-md-12  clearfix">
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <label for="email">Email Address<span class="mandatory">*</span></label><br>
                                                    <input type="text" placeholder="Enter your Email Address" class="form-control personal-input" name="email" id="email">
                                                </div>

                                            </div>
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <label for="phonenumber">Phone No.
                                                        <?php
                                                        if(!in_array("phonenumber",$optionalFieldArray))
                                                        {
                                                            $phone="mandatory='true'";
                                                        ?>
                                                            <span class="mandatory">*</span>
                                                        <?php    
                                                        }
                                                        ?>
                                                    </label><br/>
                                                    <input type="text" placeholder="Enter your Phone No." class="form-control personal-input" name="phonenumber" id="phonenumber" <?php echo $phone; ?>>
                                                </div>

                                            </div>
                                        </div> 
                                        <!-- Billng Address -->
                                        <div class="main-fieldset">
                                            <div class="fieldset clearfix">
                                                <center><p class>Billing Address</p></center>
                                            </div>
                                        </div>
                                        <div class="col-md-12 personal-info clearfix">
                                            <div class="col-md-12">

                                                <div class="form-group">
                                                    <label for="company">Company Name (Optional)</label><br>
                                                    <input type="text" placeholder="Enter your Company Name" class="form-control personal-input" name="company" id="company">
                                                </div>

                                            </div>

                                        </div> <!-- personal information -->
                                        <div class="col-md-12 personal-info-2 clearfix">
                                            <div class="col-md-12">

                                                <div class="form-group">
                                                    <label for="address">Street Address
                                                       <?php
                                                        if(!in_array("address1",$optionalFieldArray))
                                                        {
                                                            $address="mandatory='true'";
                                                        ?>
                                                            <span class="mandatory">*</span>
                                                        <?php    
                                                        }
                                                        ?>
                                                    </label>
                                                    <br/>
                                                    <input type="text" placeholder="Enter Your Address" name="address1" class="form-control personal-input" id="address" <?php echo $address; ?>>
                                                </div>

                                            </div>
                                            <div class="col-md-12">

                                                <div class="form-group">
                                                    <label for="country">Country<span class="mandatory">*</span></label><br>
                                                    <select id="country" name="country" class="form-control personal-input"> <option value="AF">Afghanistan</option> <option value="AX">Aland Islands</option> <option value="AL">Albania</option> <option value="DZ">Algeria</option> <option value="AS">American Samoa</option> <option value="AD">Andorra</option> <option value="AO">Angola</option> <option value="AI">Anguilla</option> <option value="AQ">Antarctica</option> <option value="AG">Antigua And Barbuda</option> <option value="AR">Argentina</option> <option value="AM">Armenia</option> <option value="AW">Aruba</option>
                                                        <option value="AU">Australia</option> <option value="AT">Austria</option> <option value="AZ">Azerbaijan</option> <option value="BS">Bahamas</option> <option value="BH">Bahrain</option> <option value="BD">Bangladesh</option> <option value="BB">Barbados</option> <option value="BY">Belarus</option> <option value="BE">Belgium</option> <option value="BZ">Belize</option> <option value="BJ">Benin</option>
                                                        <option value="BM">Bermuda</option> <option value="BT">Bhutan</option> <option value="BO">Bolivia</option> <option value="BA">Bosnia And Herzegovina</option> <option value="BW">Botswana</option> <option value="BV">Bouvet Island</option> <option value="BR">Brazil</option> <option value="IO">British Indian Ocean Territory</option> <option value="BN">Brunei Darussalam</option> <option value="BG">Bulgaria</option> <option value="BF">Burkina Faso</option> <option value="BI">Burundi</option> <option value="KH">Cambodia</option> <option value="CM">Cameroon</option> <option value="CA">Canada</option> <option value="CV">Cape Verde</option> <option value="KY">Cayman Islands</option> <option value="CF">Central African Republic</option> <option value="TD">Chad</option>
                                                        <option value="CL">Chile</option>
                                                        <option value="CN">China</option>
                                                        <option value="CX">Christmas Island</option> <option value="CC">Cocos (Keeling) Islands</option> <option value="CO">Colombia</option> <option value="KM">Comoros</option> <option value="CG">Congo</option>
                                                        <option value="CD">Congo, Democratic Republic</option> <option value="CK">Cook Islands</option> <option value="CR">Costa Rica</option> <option value="CI">Cote D'Ivoire</option> <option value="HR">Croatia</option> <option value="CU">Cuba</option>
                                                        <option value="CW">Curacao</option> <option value="CY">Cyprus</option> <option value="CZ">Czech Republic</option> <option value="DK">Denmark</option> <option value="DJ">Djibouti</option> <option value="DM">Dominica</option> <option value="DO">Dominican Republic</option> <option value="EC">Ecuador</option> <option value="EG">Egypt</option>
                                                        <option value="SV">El Salvador</option> <option value="GQ">Equatorial Guinea</option> <option value="ER">Eritrea</option> <option value="EE">Estonia</option> <option value="ET">Ethiopia</option> <option value="FK">Falkland Islands (Malvinas)</option> <option value="FO">Faroe Islands</option> <option value="FJ">Fiji</option>
                                                        <option value="FI">Finland</option> <option value="FR">France</option> <option value="GF">French Guiana</option> <option value="PF">French Polynesia</option> <option value="TF">French Southern Territories</option> <option value="GA">Gabon</option>
                                                        <option value="GM">Gambia</option> <option value="GE">Georgia</option> <option value="DE">Germany</option> <option value="GH">Ghana</option>
                                                        <option value="GI">Gibraltar</option> <option value="GR">Greece</option> <option value="GL">Greenland</option> <option value="GD">Grenada</option> <option value="GP">Guadeloupe</option> <option value="GU">Guam</option>
                                                        <option value="GT">Guatemala</option> <option value="GG">Guernsey</option> <option value="GN">Guinea</option> <option value="GW">Guinea-Bissau</option> <option value="GY">Guyana</option> <option value="HT">Haiti</option>
                                                        <option value="HM">Heard Island &amp; Mcdonald Islands</option> <option value="VA">Holy See (Vatican City State)</option> <option value="HN">Honduras</option> <option value="HK">Hong Kong</option> <option value="HU">Hungary</option> <option value="IS">Iceland</option> <option value="IN">India</option>
                                                        <option value="ID">Indonesia</option> <option value="IR">Iran, Islamic Republic Of</option> <option value="IQ">Iraq</option>
                                                        <option value="IE">Ireland</option> <option value="IM">Isle Of Man</option> <option value="IL">Israel</option> <option value="IT">Italy</option>
                                                        <option value="JM">Jamaica</option> <option value="JP">Japan</option>
                                                        <option value="JE">Jersey</option> <option value="JO">Jordan</option> <option value="KZ">Kazakhstan</option> <option value="KE">Kenya</option>
                                                        <option value="KI">Kiribati</option> <option value="KR">Korea</option>
                                                        <option value="KW">Kuwait</option> <option value="KG">Kyrgyzstan</option> <option value="LA">Lao People's Democratic Republic</option> <option value="LV">Latvia</option> <option value="LB">Lebanon</option> <option value="LS">Lesotho</option> <option value="LR">Liberia</option> <option value="LY">Libyan Arab Jamahiriya</option> <option value="LI">Liechtenstein</option> <option value="LT">Lithuania</option> <option value="LU">Luxembourg</option> <option value="MO">Macao</option>
                                                        <option value="MK">Macedonia</option> <option value="MG">Madagascar</option> <option value="MW">Malawi</option> <option value="MY">Malaysia</option> <option value="MV">Maldives</option> <option value="ML">Mali</option>
                                                        <option value="MT">Malta</option>
                                                        <option value="MH">Marshall Islands</option> <option value="MQ">Martinique</option> <option value="MR">Mauritania</option> <option value="MU">Mauritius</option> <option value="YT">Mayotte</option> <option value="MX">Mexico</option> <option value="FM">Micronesia, Federated States Of</option> <option value="MD">Moldova</option> <option value="MC">Monaco</option> <option value="MN">Mongolia</option> <option value="ME">Montenegro</option> <option value="MS">Montserrat</option> <option value="MA">Morocco</option> <option value="MZ">Mozambique</option> <option value="MM">Myanmar</option> <option value="NA">Namibia</option> <option value="NR">Nauru</option>
                                                        <option value="NP">Nepal</option>
                                                        <option value="NL">Netherlands</option> <option value="AN">Netherlands Antilles</option> <option value="NC">New Caledonia</option> <option value="NZ">New Zealand</option> <option value="NI">Nicaragua</option> <option value="NE">Niger</option>
                                                        <option value="NG">Nigeria</option> <option value="NU">Niue</option>
                                                        <option value="NF">Norfolk Island</option> <option value="MP">Northern Mariana Islands</option> <option value="NO">Norway</option> <option value="OM">Oman</option>
                                                        <option value="PK">Pakistan</option> <option value="PW">Palau</option>
                                                        <option value="PS">Palestine, State of</option> <option value="PA">Panama</option> <option value="PG">Papua New Guinea</option> <option value="PY">Paraguay</option> <option value="PE">Peru</option>
                                                        <option value="PH">Philippines</option> <option value="PN">Pitcairn</option> <option value="PL">Poland</option> <option value="PT">Portugal</option> <option value="PR">Puerto Rico</option> <option value="QA">Qatar</option>
                                                        <option value="RE">Reunion</option> <option value="RO">Romania</option> <option value="RU">Russian Federation</option> <option value="RW">Rwanda</option> <option value="BL">Saint Barthelemy</option> <option value="SH">Saint Helena</option> <option value="KN">Saint Kitts And Nevis</option> <option value="LC">Saint Lucia</option> <option value="MF">Saint Martin</option> <option value="PM">Saint Pierre And Miquelon</option> <option value="VC">Saint Vincent And Grenadines</option> <option value="WS">Samoa</option>
                                                        <option value="SM">San Marino</option> <option value="ST">Sao Tome And Principe</option> <option value="SA">Saudi Arabia</option> <option value="SN">Senegal</option> <option value="RS">Serbia</option> <option value="SC">Seychelles</option> <option value="SL">Sierra Leone</option> <option value="SG">Singapore</option> <option value="SK">Slovakia</option> <option value="SI">Slovenia</option> <option value="SB">Solomon Islands</option> <option value="SO">Somalia</option> <option value="ZA">South Africa</option> <option value="GS">South Georgia And Sandwich Isl.</option> <option value="ES">Spain</option>
                                                        <option value="LK">Sri Lanka</option> <option value="SD">Sudan</option>
                                                        <option value="SR">Suriname</option> <option value="SJ">Svalbard And Jan Mayen</option> <option value="SZ">Swaziland</option> <option value="SE">Sweden</option> <option value="CH">Switzerland</option> <option value="SY">Syrian Arab Republic</option> <option value="TW">Taiwan</option> <option value="TJ">Tajikistan</option> <option value="TZ">Tanzania</option> <option value="TH">Thailand</option> <option value="TL">Timor-Leste</option> <option value="TG">Togo</option>
                                                        <option value="TK">Tokelau</option> <option value="TO">Tonga</option>
                                                        <option value="TT">Trinidad And Tobago</option> <option value="TN">Tunisia</option> <option value="TR">Turkey</option> <option value="TM">Turkmenistan</option> <option value="TC">Turks And Caicos Islands</option> <option value="TV">Tuvalu</option> <option value="UG">Uganda</option> <option value="UA">Ukraine</option> <option value="AE">United Arab Emirates</option> <option value="GB">United Kingdom</option> <option value="US" selected="selected">United States</option> <option value="UM">United States Outlying Islands</option> <option value="UY">Uruguay</option> <option value="UZ">Uzbekistan</option> <option value="VU">Vanuatu</option> <option value="VE">Venezuela</option> <option value="VN">Viet Nam</option> <option value="VG">Virgin Islands, British</option> <option value="VI">Virgin Islands, U.S.</option> <option value="WF">Wallis And Futuna</option> <option value="EH">Western Sahara</option> <option value="YE">Yemen</option>
                                                        <option value="ZM">Zambia</option> <option value="ZW">Zimbabwe</option> </select>
                                                </div>
                                            </div>
                                        </div> 

                                        <div class="col-md-12 personal-info-2 clearfix">
                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <label for="city">City
                                                        <?php
                                                        if(!in_array("city",$optionalFieldArray))
                                                        {
                                                            $city="mandatory='true'";
                                                        ?>
                                                            <span class="mandatory">*</span>
                                                        <?php    
                                                        }
                                                        ?>
                                                    </label><br/>
                                                    <input type="text" name="city" placeholder="Enter City" class="form-control personal-input" id="city" <?php echo $city ;?>>
                                                </div>

                                            </div>
                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <label for="state">State
                                                        <?php
                                                        if(!in_array("state",$optionalFieldArray))
                                                        {
                                                            $state="mandatory='true'";
                                                        ?>
                                                            <span class="mandatory">*</span>
                                                        <?php    
                                                        }
                                                        ?>
                                                    </label><br/>
                                                    <input type="text" id="stateinput" value="" class="form-control personal-input trigger-update" style="display: none;" <?php echo $state; ?> >
                                                    <select class='form-control personal-input' id='stateselect' <?php echo $state; ?> > <option value="">Choose One...</option> <option>Alabama</option> <option>Alaska</option> <option>Arizona</option> <option>Arkansas</option> <option>California</option> <option>Colorado</option> <option>Connecticut</option> <option>Delaware</option> <option>District of Columbia</option> <option>Florida</option> <option>Georgia</option> <option>Hawaii</option> <option>Idaho</option>
                                                        <option>Illinois</option> <option>Indiana</option> <option>Iowa</option>
                                                        <option>Kansas</option> <option>Kentucky</option> <option>Louisiana</option> <option>Maine</option>
                                                        <option>Maryland</option> <option>Massachusetts</option> <option>Michigan</option> <option>Minnesota</option> <option>Mississippi</option> <option>Missouri</option> <option>Montana</option> <option>Nebraska</option> <option>Nevada</option> <option>New Hampshire</option> <option>New Jersey</option> <option>New Mexico</option> <option>New York</option> <option>North Carolina</option> <option>North Dakota</option> <option>Ohio</option>
                                                        <option>Oklahoma</option> <option>Oregon</option> <option>Pennsylvania</option> <option>Rhode Island</option> <option>South Carolina</option> <option>South Dakota</option> <option>Tennessee</option> <option>Texas</option>
                                                        <option>Utah</option>
                                                        <option>Vermont</option> <option>Virginia</option> <option>Washington</option> <option>West Virginia</option> <option>Wisconsin</option> <option>Wyoming</option> </select>
                                                </div>

                                            </div>
                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <label for="postcode">Post Code
                                                        <?php
                                                        if(!in_array("postcode",$optionalFieldArray))
                                                        {
                                                            $mandatory_postal_code="mandatory='true'";
                                                        ?>
                                                            <span class="mandatory">*</span>
                                                        <?php    
                                                        }
                                                        ?>
                                                    </label><br>
                                                    <input type="text" placeholder="Enter Pin Code" class="form-control personal-input" name="postcode" id="postcode" <?php echo $mandatory_postal_code; ?>>
                                                </div>

                                            </div>
                                            
                                        </div> 
                                        
                                        <!-- Billing Address -->
                                        
                                        <!-- Account Security -->
                                        <div class="main-fieldset">
                                            <div class="fieldset clearfix">
                                                <center><p class>Account Security</p></center>
                                            </div>
                                        </div>
                                        <div class="col-md-12 personal-info clearfix">
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <label for="password">Password<span class="mandatory">*</span></label><br>
                                                    <input type="password" placeholder="Enter Password" class="form-control personal-input" name="password" id="password">
                                                </div>

                                            </div>
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <label for="cpassword">Confirm Password<span class="mandatory">*</span></label><br>
                                                    <input type="password" placeholder="Enter Your Password Again" class="form-control personal-input" name="cpassword" id="cpassword">
                                                </div>

                                            </div>

                                        </div> 
                                        <div class="col-md-12 clearfix" style="margin-bottom: 40px;position: static; padding: 0px 35px;">
                                           
                                           <note>
                                               A password must contain at least one letter, one number, and be at least 8 characters in length.  A  
                                               Password should also contain both upper and lowercase letters, and at least one symbol.</note>
                                        </div>
                                        <?php
                                        $customfields = OnePageCartClass::getCustomFields("client",'',"",'',"",'',"","");
                                       
                                        if(!empty($customfields))
                                        {
                                        ?>
                                            <!---start Client custom fields--->
                                            <div class="main-fieldset">
                                                <div class="fieldset clearfix">
                                                    <center><p class>Client Custom Fields</p></center>
                                                </div>
                                            </div>
                                            <div class="col-md-12 personal-info clearfix">
                                            <?php
                                            foreach ($customfields as $customfield)
                                            {
                                            ?>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="customfield<?php echo $customfield['id']; ?>"><?php echo $customfield['name']; ?><span class="mandatory"><?php echo $customfield['required']; ?></span></label><br>
                                                        <?php echo $customfield['input']; ?>
                                                       
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                            </div>
                                            <!-----End client custom fields----->
                                        <?php
                                        }
                                        ?>
                                        
                                        
                                        <!-- Account Security -->
                                    </div>
                                    <!--end container New User Sign up---->

                                    <!-----existing user start---->
                                    <div id='containerExistingUserSignin' style="display:none;">
                                        <div class="col-md-12 personal-info clearfix">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="inputLoginEmail">Email Address <span class="mandatory">*</span></label><br>
                                                    <input  class="form-control personal-input" name="loginemail" id="inputLoginEmail" placeholder="Enter Email Address" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="inputLoginPassword">Password <span class="mandatory">*</span></label><br>
                                                    <input class="form-control personal-input" name="loginpassword" id="inputLoginPassword" placeholder="Enter password" type="password">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!------existing user end----->
                                </div>
                                <!-- end billing information -->
            <?php
        } else {
            $getclientdetails_result = OnePageCartClass::GetClientsDetails($_SESSION['uid']);
            ?>
                                <input type="hidden" id="clientalreadyloggedin"  style="display: block;" value="block"/>
                                <div class="col-md-12">
                                    <div class='deets-1' style="width: 100%;height: 15px;text-align: center;margin-top: 15px;margin-bottom: 40px;">
                                        Welcome back, <?php echo $getclientdetails_result['firstname']; ?>!
                                    </div>
                                </div>
                                <input type="hidden" id="country" name="country" value="<?php echo $getclientdetails_result['country']; ?>" />
                                <input type="hidden" id='stateselect' value="<?php echo $getclientdetails_result['state']; ?>" />
            <?php
        }
    
    ?>
                            
                            
                            
                        
                        
                        <!-- Configural Option -->
    <?php
   // if (isset($_GET['a']) && ($_GET['a'] == "edit" || $_GET['a'] == "add")) {
        $adminid = OnePageCartClass::GetAdminID();
        $command_getproducts = "getproducts";
        $adminuser = $adminid['records'];
        $values_getproducts["pid"] = $_SESSION['productids'];
        $Products_result = localAPI($command_getproducts, $values_getproducts, $adminuser);


        $producttype = $Products_result['products']['product']['0']['type'];

        if ($producttype == "server") {
            if (isset($_REQUEST['product']) && isset($_REQUEST['a']) && $_REQUEST['a'] == "edit") {
                $hostname = ($_SESSION['onepagecart_mainsession']['products'][$_REQUEST['i']]['configureserver']['hostname'] != "undefined") ? $_SESSION['onepagecart_mainsession']['products'][$_REQUEST['i']]['configureserver']['hostname'] : "";
                $ns1prefix = ($_SESSION['onepagecart_mainsession']['products'][$_REQUEST['i']]['configureserver']['ns1prefix'] != "undefined") ? $_SESSION['onepagecart_mainsession']['products'][$_REQUEST['i']]['configureserver']['ns1prefix'] : "";
                $ns2prefix = ($_SESSION['onepagecart_mainsession']['products'][$_REQUEST['i']]['configureserver']['ns2prefix'] != "undefined") ? $_SESSION['onepagecart_mainsession']['products'][$_REQUEST['i']]['configureserver']['ns2prefix'] : "";
                $rootpw = ($_SESSION['onepagecart_mainsession']['products'][$_REQUEST['i']]['configureserver']['rootpw'] != "undefined") ? $_SESSION['onepagecart_mainsession']['products'][$_REQUEST['i']]['configureserver']['rootpw'] : "";
            } else {
                $hostname = $ns1prefix = $ns2prefix = $rootpw = "";
            }
            ?>

                                <div class='section-background' id="configureserver_section">

                                    <div class="heading-bar" style="margin-bottom: 20px;"><i class="fa fa-cogs m-rt1" style="font-size: 20px;color: white;"></i><h3>CONFIGURE SERVER</h3></div>

                                    <div class="field-container" style="padding: 30px;text-align: left;">

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="inputHostname">Hostname</label>
                                                    <input type="text" name="hostname" class="form-control personal-input trigger-update" id="inputHostname" value="<?php echo $hostname; ?>" placeholder="servername.yourdomain.com">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="inputRootpw">Root Password</label>
                                                    <input type="password" name="rootpw" class="form-control personal-input trigger-update" id="inputRootpw" value="<?php echo $rootpw; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row" style="display:none;">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="inputNs1prefix">NS1 Prefix</label>
                                                    <input type="text" name="ns1prefix" class="form-control personal-input trigger-update" id="inputNs1prefix" value="<?php echo $ns1prefix; ?>" placeholder="ns1">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="inputNs2prefix">NS2 Prefix</label>
                                                    <input type="text" name="ns2prefix" class="form-control personal-input trigger-update" id="inputNs2prefix" value="<?php echo $ns2prefix; ?>" placeholder="ns2">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


            <?php
        }
        ?>
                            <div class='section-background' id="configurable_options_section" style="display:none;">
                                <div class="heading-bar" style="margin-bottom: 20px;"><img src="images/config.png" alt=""><h3>Configurable Options</h3></div>


                                <div class="clearfix ow" id="configurable-list" style="    margin-top: 30px;">

        <?php
        if (is_array($configoptions) && count($configoptions) > 0) {
            ?>
                                        <style>
                                            #configurable_options_section
                                            {
                                                display: block!important;
                                            }
                                            .popover
                                            {
                                                width: 180px;
                                            }

                                        </style>
            <?php
            foreach ($configoptions as $configkey => $configoption) {
                if ($configoption['optiontype'] == "1") {
                    ?>
                                                <div style="float: left;width: 100%;">
                                                    <div class="col-md-2 side-label"><label class="control-label checkout-label col-md-offset-1"><?php echo $configoption['optionname']; ?></label> </div>

                                                    <div class="col-md-9">               
                                                        <div class="form-group">                                                        
                                                            <select name="configoptions[<?php echo $configoption['id']; ?>]" class="form-control personal-input configoption" data-config-id="<?php echo $configoption['id']; ?>" onchange="opcupdate();">
                    <?php
                    foreach ($configoption['options'] as $num2 => $options)
                    {
                    ?>
                                                                    <option value="<?php echo $options['id']; ?>" <?php
                                                    if ($configoption['selectedvalue'] == $options['id']) {
                                                        echo 'selected="selected"';
                                                    }
                                                    ?>><?php echo $options['name']; ?></option>
                        <?php
                    }
                    ?>
                                                            </select>
                                                        </div>
                                                    </div> 
                                                                <?php
                                                                $groupdetails = OnePageCartClass::getProductConfigPopOver($configoption['id']);
                                                                if ($groupdetails['status'] == "success" && $groupdetails['data'][0]->show == "on") 
                                                                {
                                                                    ?>
                                                        <div class="col-md-1">
                                                            <a href="#" data-toggle="popover" title="" data-content="<?php echo $groupdetails['data'][0]->description; ?>" data-original-title="<?php echo $configoption['optionname']; ?>"><img src="images/popover.png" alt="popup"></a>
                                                        </div>
                                                                        <?php } ?>
                                                </div>
                    <?php
                }
                if ($configoption['optiontype'] == "2") 
                {
                ?>
                    <div style="float: left;width: 100%;">
                        <table style="width: 100%;">
                            <tbody>
                                <tr>
                                    <td style="width: 16.66%;/*! text-align: right; */padding: 0px 15px;">
                                        <div style="position:relative;top:20%;">
                                            <label class="control-label checkout-label col-md-offset-1">
                                                <?php echo $configoption['optionname']; ?>
                                            </label>
                                        </div>
                                    </td>    
                                    <td style="vertical-align:middle;width:75%;">
                        <div class="col-md-10">               
                            <div class="form-group" style="text-align:left">                                                        
                                <?php
                                foreach ($configoption['options'] as $num2 => $options)
                                {
                                    ?>
                                        <label  style="font-weight:normal;"><input type="radio" class="iradiobox configoption_radio" name="configoptions[<?php echo $configoption['id']; ?>]" data-config-id="<?php echo $configoption['id']; ?>" value="<?php echo $options['id']; ?>" <?php
                                        if ($configoption['selectedvalue'] == $options['id'])
                                        {
                                            echo 'checked="checked"';
                                        }
                                    ?> onclick="opcupdate();">
                                            <span style="margin-left:10px;"><?php echo $options['name']; ?> </span></label><br />
                                    <?php
                                }
                                ?>
                            </div>
                        </div> 
                                    </td>
                                    <td style="vertical-align:middle;">
                                        <?php
                                                                $groupdetails = OnePageCartClass::getProductConfigPopOver($configoption['id']);
                                                                if ($groupdetails['status'] == "success" && $groupdetails['data'][0]->show == "on") 
                                                                {
                                                                    ?>
                                                        <div class="col-md-1">
                                                            <a href="#" data-toggle="popover" title="" data-content="<?php echo $groupdetails['data'][0]->description; ?>" data-original-title="<?php echo $configoption['optionname']; ?>"><img src="images/popover.png" alt="popup"></a>
                                                        </div>
                                                                        <?php } ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                                                            <?php
                                                        }
                                                        if ($configoption['optiontype'] == "3") {
                                                            ?>
                                                <div style="float: left;width: 100%;">
                                                    <div class="col-md-2 side-label"><label class="control-label checkout-label col-md-offset-1"><?php echo $configoption['optionname']; ?></label></div>  
                                                    <div class="col-md-9" style="margin: 1% auto;">               
                                                        <div class="form-group" style="text-align:left">                                                        
                                                                                                       <?php
                                                                                                       foreach ($configoption['options'] as $num2 => $options) {
                                                                                                           ?>
                                                                <label style="font-weight:normal;"><input type="checkbox" class="iradiobox configoption_checkbox" data-config-id="<?php echo $configoption['id']; ?>" name="configoptions[<?php echo $configoption['id']; ?>]" value="1"<?php
                                                    if ($configoption['selectedqty']) {
                                                        echo 'checked';
                                                    }
                                                    ?> onclick="opcupdate()" /> <span style="margin-left:10px;"><?php echo $configoption['options']['0']['name']; ?></span></label><br>
                        <?php
                    }
                    ?>
                                                        </div>
                                                    </div> 
                                                    <?php
                                                                $groupdetails = OnePageCartClass::getProductConfigPopOver($configoption['id']);
                                                                if ($groupdetails['status'] == "success" && $groupdetails['data'][0]->show == "on") 
                                                                {
                                                                    ?>
                                                        <div class="col-md-1">
                                                            <a href="#" data-toggle="popover" title="" data-content="<?php echo $groupdetails['data'][0]->description; ?>" data-original-title="<?php echo $configoption['optionname']; ?>"><img src="images/popover.png" alt="popup"></a>
                                                        </div>
                                                                        <?php } ?>
                                                </div>
                                                            <?php
                                                        }
                                                    }
                                                }
                                                ?>


                                </div>



                            </div> 


                            <!-- Configural Option -->
                            <!--start custom fields-->
                            

<div class="section-background" id="customfields_section" style="display: none;">
    <div class="heading-bar" style="margin-bottom: 20px;">
        <i class="fa fa-cogs m-rt1" style="font-size: 20px;color: white;"></i>
        <h3>ADDITIONAL INFORMATION</h3>
    </div>
    
    <div class="field-container" id="product-custom" style="text-align: left;">
        
        
    </div>
   <!--  <div class="field-container" id="product-BillingCycle" style="text-align: left;">
        
        <div id="BillingCycleDiv">
            
        </div>
    </div> -->
    <div class="field-container" id="product-custom2" style="text-align: left;">
        
        <div id="configoptionDiv">
            
        </div>
    </div>
    <?php 
    

    ?>
</div>

                            <!-----end custom fields----->
                            <!-- Recommended Addons -->
                            <div class="heading-bar" id="addon-heading" style="display:none;">
                                <img src="images/recommended-icon.png" alt=""><h3>Recommended Add-ons</h3>
                            </div>
                            <div class="col-md-12" id="addons-list" style="margin-bottom:20px;"></div>
                            <!-- Recommended Addons -->
        <?php
    //}
   ?>
                        <input type="hidden" id="vatexempt" name="vatexempt" value="no">
                        
                        
                        <!-- Review Order Details --> 
                        <div class="heading-bar">
                            <img src="images/order-icon.png" alt=""><h3>Review Order Details</h3>
                        </div>
                        <!---start order summary--->
                        <div id="ordersummary-items"></div>
                        <!---end order summary--->
                        <!---start empty cart---->
                        <div class="empty-cart" style="text-align: right;margin: -20px 20px 0 0;line-height: 1em;">
                            <button type="button" class="btn btn-link btn-xs" id="btnEmptyCart" onclick="$('#emptycartmodal').modal('show');" style="margin: 0;padding: 6px 24px;background-color: #3C383A;border: 0;color: #fff;border-radius: 0 0 4px 4px;font-size: 14px; text-decoration: none;margin-right: 30px;">
                                <i class="fa fa-trash"></i> 
                                <span> Empty Cart</span> 
                            </button> 
                        </div>
                        <!---end empty card---->
                        <div class="col-md-12 coupon-input">
                            <div class=" clearfix">
                                <?php 
                                $getclientdetails_result1 = OnePageCartClass::GetClientsDetails($_SESSION['resellerid']);
                                $credit = $getclientdetails_result1['credit'];
                                

                                ?>

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input type="text" class="form-control coupon" id="promocode" name="promocode" placeholder="Enter Promo Code If You Have One">
                                        <button type="button" class="btn btn-primary coupon-btn" onclick="opcupdate();
                                                    return false;">VALIDATE CODE</button>
                                    </div>
                                    <!----start coupon code message---->
                                    <div id="couponcode" style="margin-right: 15px;display: none;width:85%;" onclick="$(this).hide();"> </div>
                                    <!----end coupon code message----->
                                </div>
                                <!----start total---->
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pay_h">
                                    <!--div class="row">
                                        <table class="table table-responsive table-bordered">
                                            <tr><th>Amount</th><td><span class="plan" style="color: #000; font-style:normal; padding: 0px;">10.00
                                                                                         </span></td></tr>
                                            <tr><th>Sub Total</th><td><span class="plan" style="color: #000; font-style:normal; padding: 0px;">10.00
                                                                                         </span></td></tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pay_h hide">
                                
                                    <div class="row">
                                <div class="col-md-4 crDetails" style="border-left: solid 1px #004a95;">
                                    <p class="text-center"><b>Your Credit</b><br><span class="credit" style="color: #000; font-style:normal; padding: 0px;"></span></p>
                                </div>
                                <div class="col-md-4 crDetails minus">
                                    <p class="text-center"><b>Plan Credit</b><br><span class="plan" style="color: #000; font-style:normal; padding: 0px;">10.00
                                                                                         </span></p>
                                </div>
                                <div class="col-md-4 crDetails equal" style="border-right: solid 1px #004a95;">
                                    <p class="text-center"><b>Balance</b><br><span class="bal" style="color: #000; font-style:normal; padding: 0px;">78.54</span></p>
                                </div>
                                </div-->
                                
                                    <table class="table" style="border: 1px solid #ccc;">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    Subtotal: 
                                                </td>
                                                <td>
                                                    <input type="hidden" class="credit" value="<?php echo $credit;?>">
                                                    <input type="hidden" class="plan" value="">
                                                    <input type="hidden" id="conditionForFreshCLick" value="">
                                                    <span id="longsubtotal">
                                                        <?php echo $currency_prefix; ?>0.00
                                                    </span>
                                                </td>
                                            </tr>
                                            
                                            <tr id="discount" style="display:none;">
                                                <td>F
                                                    Discount:<span id="discount-text"> </span>
                                                </td>
                                                <td id="long-coupon-amount"><?php echo $currency_prefix; ?>0.00</td>
                                            </tr>
                                            <tr id="tax2"></tr>
                                            <tr id="tax1"></tr>
                                            
                                            <tr>
                                                <td style="border-top:1px solid #ccc;">
                                                    Amount Due:
                                                </td>
                                                <td style="border-top:1px solid #ccc;"><span id="longtotal"><?php echo $currency_prefix; ?>0.00</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-----end total--->
                            </div>
                        </div>
                        <!-- Review Order Details -->
                        <?php
                        $getCreditDetails_result = OnePageCartClass::getClientGatewayId($_SESSION['uid']);
                                    
                        //if($getCreditDetails_result['status']=='success' && empty($getCreditDetails_result['data']))
                        {
                        ?>
                        <div class="payment-method">
                            <div class="col-md-12 main-fieldset" style="margin-bottom: 30px;">
                                <div class="fieldset clearfix">
                                    <center><p class>Payment Method</p></center>
                                    
                                </div>
                            </div>
                            
                            <div class="col-md-12 payment-options" id="payment-block">
                            <center><?php $gateways = Capsule::table('tblvpnpaymentgateways')->where('uid', '=', $_SESSION['resellerid'])->where('setting','name')->groupby('gateway')->get();
                            if(count($gateways) == 0)
                            {
                                echo '<p class="text-center">No Payment Gateway Added yet.</p>';
                            }
                                //print_r($gateways);
                                foreach($gateways as $gateway)
                                {
                                    ?>
                                    <label>
                                        <input class="iradiobox payment-radio" type="radio" name="paymenttype1" class="<?php echo $gateway->gateway?>" value="<?php echo $gateway->gateway?>" id="paymenttype_<?php echo $gateway->gateway?>" style="display:  inline-block;"/> <span class="payment_custom"> <?php echo $gateway->value?> </span>
                                    </label> 
                                    
                                    <?php 
                                }
                                
                                ?></center>
                                <center class="hide">
                                    <label>
                                        <input class="iradiobox payment-radio" type="radio" name="paymenttype1" value="paypal" id="paymenttype_" style="display:  inline-block;"/> <span class="payment_custom">Paypal </span>
                                    </label> 
                                    <label>
                                        <input class="iradiobox payment-radio" type="radio" name="paymenttype1" value="banktransfer" style="display:  inline-block;"/> Bank Transfer
                                    </label> 
                                    <!--
                                    <label>
                                        <input class="iradiobox payment-radio" type="radio" name="paymenttype1" value="banktransfer"  style="display: inline-block;"/> ATM Payment
                                    </label> 
                                    -->
                                    <label>
                                        <input class="iradiobox payment-radio" type="radio" name="paymenttype1" value="stripe"  class="stripe" style="display: inline-block;"/> Stripe
                                    </label> 
                                    <!---
                                    <label>
                                        <input class="iradiobox payment-radio" type="radio" name="paymenttype1" value="banktransfer"  style="display: inline-block;"/> Bit Pay
                                    </label> 
                                    -->
                                </center>
                                <div id="card" class="col-md-8 col-md-offset-2 col-xs-12" style="background: #fff; padding:10px; border: solid 2px #ccc; display: none;">
                                    <div id="creditCardInputFields"  class="col-md-12" style="float: left;margin-top: 00px;">
                                        <input type="hidden" name="paymenttype" id="paymentname" value=""/>
                                        <input type="hidden" name="ccinfo" value="new">
                                        <div id="newCardInfo" class="row" style="width: 97%; margin: 0 auto;">
                                            <div class="col-sm-12">
                                                <div class="form-group prepend-icon">
                                                    <label for="inputNameOnCard" class="control-label col-sm-4" style="line-height:3">Name on card</label>
                                                    <div class="col-md-7">
                                                        <input type="tel" name="nameoncard" id="inputNameOnCard" class="form-control form_set" placeholder="Name as appears on card" autocomplete="name-on-card" >
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group prepend-icon">
                                                    <label for="inputCardNumber" class="control-label col-sm-4" style="line-height:3">Card Number</label>
                                                    <div class="col-md-7">
                                                         <input type="number" name="ccnumber" id="inputCardNumber" class="form-control form_set" placeholder="1111 2222 3333 4444" autocomplete="cc-number" >
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <label class="control-label col-md-4 col-xs-12 checkout-label" for="exp-month">
                                                  <p>Expiration Date</p>
                                                </label>
                                                <div class="col-md-5">
                                                    <select class="form-control styled" id="exp-month" name="exp-month" style="width:auto; float: left;">
                                                        <option>01</option>
                                                        <option>02</option>
                                                        <option>03</option>
                                                        <option>04</option>
                                                        <option>05</option>
                                                        <option>06</option>
                                                        <option>07</option>
                                                        <option>08</option>
                                                        <option>09</option>
                                                        <option>10</option>
                                                        <option>11</option>
                                                        <option>12</option>
                                                    </select>

                                                    <label class="control-label col-md-1 col-xs-1 checkout-label" style="line-height: 30px;">
                                                       <p class="clearfix">/</p>
                                                    </label>

                                                    <select class="form-control styled" id="exp-year" name="exp-year" style="width:auto; float: left;">
                                                        <option value="16">2016</option>
                                                        <option value="17">2017</option>
                                                        <option value="18">2018</option>
                                                        <option value="19">2019</option>
                                                        <option value="20">2020</option>
                                                        <option value="21">2021</option>
                                                        <option value="22">2022</option>
                                                        <option value="23">2023</option>
                                                        <option value="24">2024</option>
                                                        <option value="25">2025</option>
                                                        <option value="26">2026</option>
                                                        <option value="27">2027</option>
                                                        <option value="28">2028</option>
                                                        <option value="29">2029</option>
                                                        <option value="30">2030</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="inputCardCVV" class="control-label col-md-4 col-xs-12" style="line-height:1">
                                                       CVV Code
                                                    </label>
                                                    <div class="col-md-3">
                                                        <input type="number"  name="cccvv" id="inputCardCVV" class="form-control form_set" placeholder="123" autocomplete="cc-cvc">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <center style="display: none;">
                                    <div style="width:32.9%; display: <?php echo $display_1; ?>" id="banktransfer">
                                        <div class="paymentmethodbox" onclick="selectpaymentmethod('banktransfer', this);" style="border: 1px solid rgb(46, 62, 95);padding: 4px 25px;">
                                            <div class="icon">
                                                <div class="image"><img src="onepagecart/assets/images/banktransfer.jpg" style="width:280px;margin-top: 0;"></div>

                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div id="paypal" style="width:32.9%;display: <?php echo $display_1; ?>">
                                        <div class="paymentmethodbox" onclick="selectpaymentmethod('paypal', this);" style="border: 1px solid rgb(46, 62, 95);">
                                            <div class="icon">
                                                <div class="image"><img src="onepagecart/assets/images/paypal_logo.png" style="    width: 150px;"></div>

                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div id="eft_atm" style="width:32.9%;display: <?php echo $display_1; ?>">
                                        <div class="paymentmethodbox" onclick="selectpaymentmethod('banktransfer', this);" style="border: 1px solid rgb(46, 62, 95);">
                                            <div class="icon">
                                                <div class="image"><img src="onepagecart/assets/images/eft-atm.png" style="    width: 80px;"></div>

                                            </div>
                                        </div>
                                    </div>
                                    
                                </center>
                            </div>
                            
                        </div>
                        <!----payment end---->
                        <?php
                        }
                        /*
                        else
                        {
                            #Gateway id found
                            echo '<input type="hidden" id="gatewayid" name="gatewayid" value="'.$getCreditDetails_result['data'][0]->gatewayid.'">';
                        ?>
                            <input type="hidden" name="paymenttype" id="paymentname" value="stripe"/>
                            <script>
                                $(document).ready(function()
                                {
                                    slectpaymentmethod("stripe");
                                });
                            </script>
                        <?php    
                        }
                        */
                        ?>
                        
                        <div class=" col-md-12" style="margin-bottom: 20px">
                            <center>
                            <div class="checkbox">
                                    <label class="control control--checkbox">
                                        <input type="checkbox" class="custom-checkbox" name="accepttos" value="" id="accepttos">I have read and agree to the <?php echo $title;?> <?php if(!$data[0]->tandc == ''){?><a href="<?php echo $data[0]->tandc;?>" target="_blank"> Terms of Service</a> , <a href="<?php echo $data[0]->tandc;?>/#cancellations" target="_blank"> Cancellation Policy</a>,<?php } if(!$data[0]->privacy == ''){?> and <a href="<?php echo $data[0]->privacy;?>" target="_blank">Privacy Policy</a><?php } ?>
                                        <span class="control__indicator"></span/a>
                                    </label>
                                </div>
                               
                            </center>
                        </div>
                        <div class="place-order-btn">
                            <center> 
                                <button type="submit" id="place-order" class="btn btn-primary place-order" disabled>
                                PLACE MY ORDER</button>
                                <p class="alert alert-danger hide col-md-12" >Please contact your Administrator</p>
                            </center>
                        </div>
                    </div>
                </form>
                <!----end place order form--->
            </div>
            <!-------end container------>

            <!--------start footer------>
            
    <?php
    include_once 'templates/footer.tpl';
    ?>
            <!--------end footer------>
            <script>
                var notPrefill = 1;
                function removeItem(e, n)
                    {
                        jQuery("#inputRemoveItemType").val(e),
                                jQuery("#inputRemoveItemRef").val(n),
                                jQuery("#modalRemoveItem").modal("show");
                    }
                    opcupdate();
    <?php
    if (isset($_GET['product']) && !empty($_GET['product']) || isset($_GET['a']) && $_GET['a'] == "empty" || isset($_GET['gid']) || isset($_SESSION['alldomainsselected']) && is_array($_SESSION['alldomainsselected']) || isset($_SESSION['onepagecart_mainsession'])) {
        ?>
                    //$(document).ready(function() 
                    //{
                    function removeItem(e, n)
                    {
                        jQuery("#inputRemoveItemType").val(e),
                                jQuery("#inputRemoveItemRef").val(n),
                                jQuery("#modalRemoveItem").modal("show");
                    }
                    opcupdate();
        <?php
        if (!isset($_SESSION['onepagecart']['products'])) 
            {
            ?>
                        // $("#hideifnoproductincart").html('');
                         //$("#ordersummary-items").html("<center style='margin-top: 10px;'>Your Shopping Cart is Empty</center>");
                         //$(".empty-cart").hide();
            <?php
        }
        ?>
                    $('html, body').animate({scrollTop: 0}, 'fast');
                    setTimeout(function ()
                    {
                        $("#frmCheckout").show();
                    },
                            500
                            );
                    //});

        <?php
    } else {
        ?>
                    $(document).ready(function ()
                    {
                        
                        $("#hideifnoproductincart").html('');
                        $("#ordersummary-items").html("<center style='margin-top: 10px;'>Your Shopping Cart is Empty</center>");
                        $(".empty-cart").hide();
                        $('html, body').animate({scrollTop: 0}, 'fast');
                        setTimeout(function ()
                        {
                            $("#frmCheckout").show();
                        },
                                500
                                );
                    });
        <?php
    }
    ?>
            </script> 
            
            <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

            <script>
        <?php
        $stripe_details = OnePageCartClass::GetAnyPaymentGatewayDetails('stripe',$_SESSION['resellerid']);
        if (isset($stripe_details['status']) && $stripe_details['status'] == "success") {
            foreach ($stripe_details['data'] as $details) {
                if ($details->setting == "publishableKey") {
                    $gatewaypublishablekey = $details->value;
                } if ($details->setting == "applePay") {
                    $applePay = $details->value;
                }
            }
            ?>
                                                Stripe.setPublishableKey('<?php echo $gatewaypublishablekey; ?>');
        <?php } ?>
                                            var notPrefill = 1;
        <?php
        if (isset($_GET['product']) && !empty($_GET['product']) || isset($_GET['a']) && $_GET['a'] == "empty" || isset($_GET['gid']) || isset($_SESSION['alldomainsselected']) && is_array($_SESSION['alldomainsselected']) || isset($_SESSION['onepagecart_mainsession'])) {
            ?>
                                                //$(document).ready(function() 
                                                //{
                                                function removeItem(e, n)
                                                {
                                                    jQuery("#inputRemoveItemType").val(e),
                                                            jQuery("#inputRemoveItemRef").val(n),
                                                            jQuery("#modalRemoveItem").modal("show");
                                                }
                                                opcupdate();
            <?php
            if (isset($_GET['a']) || isset($_GET['success']) && !isset($_SESSION['onepagecart'])) {
                ?>
                                                    // $("#hideifnoproductincart").html('');
                                                    // $("#ordersummary-items").html("Your Shopping Cart is Empty");
                                                    // $(".empty-cart").hide();
                <?php
            }
            ?>
                                                $('html, body').animate({scrollTop: 0}, 'fast');
                                                setTimeout(function ()
                                                {
                                                    $("#frmCheckout").show();
                                                },
                                                        500
                                                        );
                                                //});

            <?php
        } else {
            ?>
                                                $(document).ready(function ()
                                                {
                                                    
    $('.productRadio:eq(0)').prop('checked');
    
                                                    //$('.payment-radio:eq(0)').prop('checked', true);
                                                  //$('.payment-radio:eq(0)').parent().addClass('checked')
                                                 
                                                    $("#hideifnoproductincart").html('');
                                                    $("#ordersummary-items").html("<center style='margin-top: 10px;'>Your Shopping Cart is Empty</center>");
                                                    $(".empty-cart").hide();
                                                    $('html, body').animate({scrollTop: 0}, 'fast');
                                                    setTimeout(function ()
                                                    {
                                                        $("#frmCheckout").show();
                                                    },
                                                            500
                                                            );
                                                });
            <?php
        }
        ?>
            </script> 

            <!-----start Modal----->
            <form method="get">
                <input type="hidden" name="r" value="" id="inputRemoveItemType">
                <input type="hidden" name="i" value="" id="inputRemoveItemRef">
                <input type="hidden" name="o" value="0" id="inputRemoveConfigRef">
                <div class="modal fade modal-remove-item" id="modalRemoveItem" tabindex="-1" role="dialog" style="display: none;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title">
                                    <i class="fa fa-times fa-3x"></i>
                                    <span>Remove Item</span>
                                </h4>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to remove this item from your cart?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                <button type="submit" class="btn btn-primary">Yes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="emptycartmodal" id="emptycartmodal"    aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title">
                                <i class="fa fa-trash fa-3x"></i>
                                <span>Empty Cart</span>
                            </h4>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to empty your shopping cart?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                            <a href="?a=empty" class="btn btn-primary">Yes</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="orderProcessingModal" id="orderProcessingModal"    aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" id="closemodal"><span
                                    aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">Processing your order...</h4>
                        </div>
                        <div class="modal-body"></div>
                        <div class="modal-footer"></div>
                    </div>
                </div>
            </div>
            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" id="loginModal"            aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header" style="border: none">
                            <button type="button" class="close" data-dismiss="modal" id="closemodal"><span   aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="loginModalLabel">Please sign in...</h4>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="loginform">
                                <div class="form-group" id="domain_form">
                                    <div class="form-group select_wrap">
                                        <input type="text" id="username" name="username" placeholder="email@address.net" class="form-control styled">
                                    </div>
                                </div>
                                <div class="form-group" id="domain_form">
                                    <div class="form-group select_wrap">
                                        <input type="password" id="password" name="password" placeholder="password" class="form-control styled">
                                        <input type="hidden" id="action" name="action" value="login">
                                    </div>
                                </div>
                                <div class="loginmodalbutton">
                                    <button type="submit" class="btn btn-orange-tiny btn-orange pull-right">Login</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer" style="display: none; border: none;"></div>
                    </div>
                </div>
            </div>
            <div class="postcontainer" style="display: none"></div>
            <!----End Modal----->
            
        </body>
    </html>
    <?php
} else {
    echo "WHMCS not Found!!";
}
?>