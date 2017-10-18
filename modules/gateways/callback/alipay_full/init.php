<?php
define("BASIC_PATH", realpath(__DIR__ ."/../../../../") . "/");
if (file_exists(BASIC_PATH. "init.php")){
    require_once BASIC_PATH. "init.php";
} else {
    require_once BASIC_PATH. "dbconnect.php";
}

require_once BASIC_PATH. "includes/functions.php";
require_once BASIC_PATH. "includes/gatewayfunctions.php";
require_once BASIC_PATH. "includes/invoicefunctions.php";

$fee = "0";
$gatewaymodule = "alipay_full";

use Illuminate\Database\Capsule\Manager as Capsule;

function convert_helper($invoiceid,$amount){
    $setting = Capsule::table("tblpaymentgateways")->where("gateway","alipay_full")->where("setting","convertto")->first();
    ///系统没多货币 , 直接返回
    if (empty($setting)){ return $amount; }
    
    
    ///获取用户ID 和 用户使用的货币ID
    $data = Capsule::table("tblinvoices")->where("id",$invoiceid)->get()[0];
    $userid = $data->userid;
    $currency = getCurrency( $userid );

    /// 返回转换后的
    return  convertCurrency( $amount , $setting->value  ,$currency["id"] );
}