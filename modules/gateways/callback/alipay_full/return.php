<?php
require_once __DIR__  . "/init.php";

$out_trade_no = $_GET['out_trade_no'];
$trade_no = $_GET['trade_no'];
$trade_status = $_GET['trade_status'];
$amount    = $_GET['total_fee'];
$invoice_id = explode("-",$out_trade_no)[1];
require_once __DIR__  ."/init_mapi.php";

global $CONFIG;

if ($callback_result){
    if($trade_status == 'TRADE_FINISHED' or $trade_status == 'TRADE_SUCCESS')
    {
            header("Location: ".$CONFIG["SystemURL"]."/viewinvoice.php?id=".$invoice_id);
            $invoiceid = checkCbInvoiceID($invoice_id,$GATEWAY["name"]);
            $amount = convert_helper( $invoice_id, $amount );
            checkCbTransID($trade_no);
            addInvoicePayment($invoice_id,$trade_no,$amount,$fee,$gatewaymodule);
            logTransaction($gatewaymodule, $_GET, "即时到账 - 异步入账");
            exit();
    } else {
        header("Location: ".$CONFIG["SystemURL"]."/viewinvoice.php?id=".$invoice_id);
        exit();
    }
} else {
    exit("入账失败 , 请联系管理员为您手工入账");
}
