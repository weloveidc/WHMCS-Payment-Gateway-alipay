<!--
    可用变量
    $form_params  - 支付宝POST表单变量
    $form_target    - 表单目标
    $form_method - 表单提交方式
    $form_action    - 表单提交地址
    $form_charset  - 表单编码
-->
<form id='alipaysubmit' name='alipaysubmit' action="{$form_action}" method="{$form_method}" target="{$form_target}" accept-charset="{$form_charset}">
{$form_params}
</form>


<button type="button" class="btn btn-danger btn-block" onclick="document.forms['alipaysubmit'].submit()">使用支付宝支付</button>