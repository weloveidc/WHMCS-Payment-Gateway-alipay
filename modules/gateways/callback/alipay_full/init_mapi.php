<?php
require_once __DIR__ .  "/../../class/alipay_full/alipay_mapi/alipay.class.php";
require_once __DIR__ . "/../../class/alipay_full/link_gen.php";


///获取模块在WHMCS里的配置参数

$GATEWAY = getGatewayVariables($gatewaymodule);
if (!$GATEWAY["type"]) die("Module Not Activated");


$a = new alipayfull_link();
$Alipay = new Alipay($a->mapi_get_basicconfig($GATEWAY));
if ($Alipay->verifyCallback()){
    $callback_result = true;
} else {
    $callback_result = false;
}