<?php 
function getTLDPriceList_modified($tld, $currency_id, $type, $renewpricing = "", $userid = "") {

    if ($renewpricing == "renew") {
        $renewpricing = true;
    }


    $result = select_query("tbldomainpricing", "id", array("extension" => $tld));
    $data = mysql_fetch_array($result);
    $id = $data['id'];


    $checkfields = array("msetupfee", "qsetupfee", "ssetupfee", "asetupfee", "bsetupfee", "monthly", "quarterly", "semiannually", "annually", "biennially");

    if (!$renewpricing || $renewpricing === "transfer") {
        $data = get_query_vals("tblpricing", "", array("type" => "domainregister", "currency" => $currency_id, "relid" => $id, "tsetupfee" => "0"));

        if (!$data) {
            $data = get_query_vals("tblpricing", "", array("type" => "domainregister", "currency" => $currency_id, "relid" => $id, "tsetupfee" => "0"));
        }

        foreach ($checkfields as $k => $v) {
            $register[$k + 1] = $data[$v];
        }

        $data = get_query_vals("tblpricing", "", array("type" => "domaintransfer", "currency" => $currency_id, "relid" => $id, "tsetupfee" => $clientgroupid));

        if (!$data) {
            $data = get_query_vals("tblpricing", "", array("type" => "domaintransfer", "currency" => $currency_id, "relid" => $id, "tsetupfee" => "0"));
        }

        foreach ($checkfields as $k => $v) {
            $transfer[$k + 1] = $data[$v];
        }
    }



    $tldpricing = 0;
    $years = 1;


    if ($type == "transfer") {
        if (0 <= $transfer[$years]) {
            $tldpricing = $transfer[$years];
        }
    }
    if ($type == "register") {
        if (0 < $register[$years]) {
            $tldpricing = $register[$years];
        }
    }

    return $tldpricing;
}
 ?>