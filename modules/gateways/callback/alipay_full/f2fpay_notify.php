<?php
if (empty($_POST['out_trade_no'])&& trim($_POST['out_trade_no'])==""){
    exit("error");
}

require_once __DIR__ . "/init.php";
require_once __DIR__ . "/../../class/alipay_full/link_gen.php";
require_once __DIR__ .  "/../../class/alipay_full/f2fpay/service/AlipayTradeService.php";
use Illuminate\Database\Capsule\Manager as Capsule;

$GATEWAY = getGatewayVariables($gatewaymodule);


$out_trade_no = $_POST['out_trade_no'];
$trade_no = $_POST['trade_no'];
$trade_status = $_POST['trade_status'];
$amount    = $_POST['total_amount'];
$invoice_id = explode("-",$out_trade_no)[1];

$queryContentBuilder = new AlipayTradeQueryContentBuilder();
$queryContentBuilder->setOutTradeNo(trim($_POST['out_trade_no']));

$a = new alipayfull_link();

$queryResponse = new AlipayTradeService($a->f2fpay_get_basicconfig($GATEWAY));
$queryResult = $queryResponse->queryTradeResult($queryContentBuilder);
$result = $queryResult->getResponse();
if ($result->msg == "Success"){
    if($result->trade_status == 'TRADE_FINISHED' || $result->trade_status == 'TRADE_SUCCESS'){
        $invoiceid = checkCbInvoiceID($invoice_id,$GATEWAY["name"]);
        $amount = convert_helper( $invoice_id, $amount );
        checkCbTransID($trade_no);
        addInvoicePayment($invoiceid,$trade_no,$amount,$fee,$gatewaymodule);
        logTransaction($gatewaymodule, $_POST, "当面付 - 异步入账");
        exit("success");
    }
}
exit("failed");