<?php
if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}


use Illuminate\Database\Capsule\Manager as Capsule;

class alipayfull_config{
    
    function get_configuration (){
        
        global $_ADMINLANG, $CONFIG;
        $type = Capsule::table("tblpaymentgateways")->where("gateway","alipay_full")->where("setting","apitype")->first();
        $skintype = Capsule::table("tblpaymentgateways")->where("gateway","alipay_full")->where("setting","skintype")->first();
        if (empty($type)){
            $extra_config = [
                "notice" => [
                'FriendlyName' => '温馨提示',
                'Type' => 'dropdown',
                'Options' => [
                    '1' => "</option></select><div class='alert alert-danger' role='alert' id='alipay_full_notice' style='margin-bottom: 0px;'>请点击 [ ".$_ADMINLANG['global']['savechanges']." ] 后 , 再进行修改配置</div><script>$('#alipay_full_notice').prev().hide();</script><select style='display:none'>",
                    ],
                ]
            ];
        } else {
            if ($type->value === "1" || $type->value === "2") {
                $extra_config = [
                    "seller_email" => ["FriendlyName" => "卖家支付宝帐户", "Type" => "text", "Size" => "50","Description" => "需要申请支付宝商家集成", ],
                    "partnerID" => ["FriendlyName" => "合作伙伴ID", "Type" => "text", "Size" => "50","Description" => "到你的支付宝商家后台查找", ],
                    "security_code" => ["FriendlyName" => "安全检验码 (MD5)", "Type" => "text", "Size" => "50", "Description" => "同上",],
                    "notice" => [
                    'FriendlyName' => '',
                    'Type' => 'dropdown',
                    'Options' => [
                        '1' => "</option></select><div class='alert alert-info' role='alert' id='alipay_full_notice' style='margin-bottom: 0px;'>以上信息均可以在 <a href='https://openhome.alipay.com/platform/keyManage.htm?keyType=partner' target='_blank'><span class='glyphicon glyphicon-new-window'></span> 商家支付宝 开放平台</a> 找到 。 请确保已经在支付宝签约 即时到账 (手机则需要手机网站支付) 必需合约</div><script>$('#alipay_full_notice').prev().hide();</script><select style='display:none'>",
                        ],
                    ]
                ];
                if ($type->value === "2") {
                    $extra_config["extra_notice"] =  [
                        'FriendlyName' => '',
                        'Type' => 'dropdown',
                        'Options' => [
                            '1' => "</option></select><div class='alert alert-info' role='alert' id='alipay_full_moblie' style='margin-bottom: 0px;'>请确保已经申请支付宝手机网站支付功能 , 否则未申请手机端将不会显示支付界面(显示未签约或其他错误页面)</div><script>$('#alipay_full_moblie').prev().hide();</script><select style='display:none'>",
                            ],
                        ];
                }
            } elseif ($type->value === "3") {
                    $extra_config = [
                        "app_id" => ["FriendlyName" => "应用ID (APPID)", "Type" => "text", "Size" => "60"],
                        "alipay_key" => ["FriendlyName" => "支付宝公钥", "Type" => "textarea",  'Rows' => '10', 'Cols' => '60' , 'Value'=>'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAlagtk1bbiFdKw/ADO8y7ra6wbHyPOwSY5V9sir/rPWd/7H+vw8RAHadJWM0HExZRSU+zBhgbGV4uLVbSoBTSemuubBdeANHE2jeE8iOit8oJdSrqEr64Ls7YtUsHYCd1LRwt2j+guG+LTigpPOvKXgD79GRCy9Nx2WOVcHda6ZaO4WP1+M9oPogLgnJBO8Dwifv22pVgIruzEn/LRYoDeUNdJTHm35we1XECXnBsInj9rVOv+MPgByAyqyD70qFNfO2N2Q2RBxvJVwJsjDZgEDDkeaxFmc/qHmZaJSfZwcryst2aWyAdkvFUtaD9QmBdt30fZ796OekwYQITCLwt7QIDAQAB'],
                        "rsa_key" => ["FriendlyName" => "RSA2(SHA256) 私钥", "Type" => "textarea",  'Rows' => '10', 'Cols' => '60',"Description" => '您可能需要 :<br/><a type="button" class="btn btn-primary" href="https://os.alipayobjects.com/download/secret_key_tools_RSA256_win.zip" target="_blank"><span class="glyphicon glyphicon-new-window"></span> RSA2(SHA256) 生成器下载</a> <a type="button" class="btn btn-primary" href="https://doc.open.alipay.com/docs/doc.htm?articleId=106130&docType=1" target="_blank"> <span class="glyphicon glyphicon-new-window"></span> OpenSSL生成教程</a><br/>  生成器私钥文件名 : rsa_private_key.pem 公钥文件名 : rsa_public_key.pem<br/>将私钥文件内容<br/>使用<span style="color:red">非Windows记事本打开</span> , 并将里面内容复制到上面文本框中<br/>公钥则请到'." <a href='https://open.alipay.com/platform/keyManage.htm' target='_blank'><span class='glyphicon glyphicon-new-window'></span> 商家支付宝 开放平台</a> 绑定", ],
                        "notice" => [
                        'FriendlyName' => '',
                        'Type' => 'dropdown',
                        'Options' => [
                            '1' => "</option></select><div class='alert alert-info' role='alert' id='alipay_full_notice' style='margin-bottom: 0px;'>以上信息均可以在 <a href='https://open.alipay.com/platform/keyManage.htm' target='_blank'><span class='glyphicon glyphicon-new-window'></span> 商家支付宝 开放平台</a> 找到 。 请确保已经在支付宝签约 当面付 必需合约</div><script>$('#alipay_full_notice').prev().hide();</script><select style='display:none'>",
                            ],
                        ]
                    ];
            } else {
                $extra_config = [];
            }
        }
        $base_config = [
            "FriendlyName" => ['Type' => 'System','Value' => 'WeLoveIDC - 支付宝全能模块',],
            "apitype" => ['FriendlyName' => '支付宝接口类型','Type' => 'dropdown',
                'Options' => [
                    "1" => "[官方] 即时到账",
                    "2" => "[官方] 即时到账 + 手机网站支付",
                    "3" => "[官方] 当面付",
                ],
            ],
            "skintype" => ['FriendlyName' => '前台皮肤','Type' => 'dropdown',
                'Options' => [
                    "1" => "[官方] Bootstrap",
                ],
            ]
        ];
        if ($skintype->value === "2"){
            $base_config = array_merge($base_config,[
                "customhtml" => [
                'FriendlyName' => '自定义html',
                'Type' => 'textarea',
                'Rows' => '10',
                'Cols' => '60',
                'Description' => "<div class='alert alert-info' role='alert' style='margin-bottom: 0px;'>我们建议您在外部编辑器编辑<br/>您可以用的变量<br/><code>%pay_link%</code> - 付款链接<br/><code>%mobliepay_link%</code> - 移动端二维码页面地址(建议使用iframe)</div>",
                ],
            ]);
        } 
        
        $config = array_merge($base_config,$extra_config);
        $config["author"] = [
            'FriendlyName' => '',
            'Type' => 'dropdown',
            'Options' => [
                '1' => "</option></select><div class='alert alert-success' role='alert' id='alipay_full_author' style='margin-bottom: 0px;'>该插件由 <a href='https://www.weloveidc.com' target='_blank'><span class='glyphicon glyphicon-new-window'></span> WeLoveIDC</a> 开发 ， 本款插件为免费开源插件<br/><span class='glyphicon glyphicon-ok'></span> 支持 WHMCS 5/6/7 , 当前WHMCS 版本 ".$CONFIG["Version"]."<br/><span class='glyphicon glyphicon-ok'></span> 仅支持 PHP 5.4 以上的环境 , 当前PHP版本 ".phpversion()."</div><script>$('#alipay_full_author').prev().hide();</script><style>* {font-family: Microsoft YaHei Light , Microsoft YaHei}</style><select style='display:none'>",
            ],
        ];
        return $config;
    }
}