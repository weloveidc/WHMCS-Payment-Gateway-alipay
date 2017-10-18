<?php
require_once __DIR__  .  "/init.php";
require_once __DIR__  .  "/init_mapi.php";

use Illuminate\Database\Capsule\Manager as Capsule;

$out_trade_no = $_POST['out_trade_no'];
$trade_no = $_POST['trade_no'];
$trade_status = $_POST['trade_status'];
$amount    = $_POST['total_fee'];
$invoice_id = explode("-",$out_trade_no)[1];

if ($callback_result){
    if($trade_status == 'TRADE_FINISHED' or $trade_status == 'TRADE_SUCCESS')
    {
            $invoiceid = checkCbInvoiceID($invoice_id,$GATEWAY["name"]);
            $amount = convert_helper( $invoice_id, $amount );
            checkCbTransID($trade_no);
            addInvoicePayment($invoiceid,$trade_no,$amount,$fee,$gatewaymodule);
            logTransaction($gatewaymodule, $_POST, "即时到账 - 同步入账");
            exit("success");
    }
}
exit("failed");