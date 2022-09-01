<?php

//use WHMCS\Authentication\CurrentUser;
use WHMCS\ClientArea;
use WHMCS\Database\Capsule;

define('CLIENTAREA', true);

require __DIR__ . '/init.php';

$ca = new ClientArea();

//$ca->setPageTitle('Server Map');

//$ca->addToBreadCrumb('index.php', Lang::trans('globalsystemname'));
//$ca->addToBreadCrumb('map.php', 'Server Map');

$ca->initPage();

//$ca->requireLogin(); // Uncomment this line to require a login to access this page

// To assign variables to the template system use the following syntax.
// These can then be referenced using {$variablename} in the template.

//$ca->assign('variablename', $value);

//$currentUser = new CurrentUser();
//$authUser = $currentUser->user();

// Check login status
//if ($authUser) {

    /**
     * User is logged in - put any code you like here
     *
     * Use the User model to access information about the authenticated User
     */

    $ca->assign('userFullname', $authUser->fullName);


    /*$selectedClient = $currentUser->client();
    if ($selectedClient) {

        /**
         * If the authenticated User has selected a Client Account to manage,
         * the model will be available - put any code you like here
         *

        $ca->assign(
            'clientInvoiceCount',
            $selectedClient->invoices()->count()
        );
    }*/

//} else {

    // User is not logged in
   // $ca->assign('userFullname', 'Guest');

//}

/**
 * Set a context for sidebars
 *
 * @link http://docs.whmcs.com/Editing_Client_Area_Menus#Context
 */
//Menu::addContext();

/**
 * Setup the primary and secondary sidebars
 *
 * @link http://docs.whmcs.com/Editing_Client_Area_Menus#Context
 */
//Menu::primarySidebar('announcementList');
//Menu::secondarySidebar('announcementList');


$serverlist = Capsule::table('server_list')
        ->select('status','mainserver','server_ip')
        //->select('mod_vpn_groups.groupName', 'server_list.server_name', 'server_list.mainserver', 'server_list.status')
        //->where('server_list.status',1)
        //->where('server_list.mainserver','0')
        ->where('status',1)
        ->where('mainserver','0')
        //->join('mod_vpn_groups','server_list.server_group','=','mod_vpn_groups.id')
        ->get();


# Define the template filename to be used without the .tpl extension

$serverlocation = '';
$serverCoordinates = array();
$i = 0;
foreach($serverlist as $server)
{
//$serverlocation = str_replace(' ','',$server->server_name).', '.str_replace(' ','_',$server->groupName);
    
    $serverIP = $server->server_ip;
   // print_r("http://ip-api.com/php/".$serverIP."?fields=region,regionName,city,zip,lat,lon"); die();
    
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://ip-api.com/php/".$serverIP."?fields=region,regionName,city,zip,lat,lon",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
));

$locationresponse = unserialize(curl_exec($curl));

curl_close($curl);
   // $serverlocation = $locationresponse;
    $serverlocation = str_replace(' ','_',$locationresponse['city']);
    
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.mapbox.com/geocoding/v5/mapbox.places/".$serverlocation.".json?limit=1&access_token=pk.eyJ1IjoiYW1hcm5ld3NwYXJrIiwiYSI6ImNraDF4dHFzZDA1NXYyeW9pamkzdDF5MWUifQ.D2af5kGjaQbK_bjlaDyB3Q",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
));

$response = curl_exec($curl);

curl_close($curl);

if($i >= 1)
{
    $responsedecode = json_decode($response);
    $serverCoordinates->features[$i]->type = 'fearures';
    $serverCoordinates->features[$i]->geometry = $responsedecode->features[0]->geometry;
    $serverCoordinates->features[$i]->properties->title = $locationresponse['city'];
   
}
else
{
    $responsedecode = json_decode($response);
    $serverCoordinates = $responsedecode;
    $serverCoordinates->features[$i]->properties->title = $locationresponse['city'];
}

$i++;
}
//echo '<pre>';print_r($serverCoordinates); die();
$ca->assign('geodatajson', json_encode($serverCoordinates));

$ca->setTemplate('map');

$ca->output();
