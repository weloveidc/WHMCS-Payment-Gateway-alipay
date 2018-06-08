<!--
    可用变量
    $url  - 支付宝URL
-->
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="modules/gateways/class/alipay_full/skin/default/arrests/qrcode.min.js"></script>
<div class="alipay_qrcode"><span>正在生成二维码</span></div>
<p>支付宝扫码支付</p>
<script>
jQuery(document).ready(function() {
	var paid_status = false
	var paid_timer = setInterval(function(){
		$.ajax({
			type: "get",
			url : window.location.href,
			dataType : "text",
			success: function(data){
				if ( data.indexOf('class="'+"paid"+'"') != -1)
				{
					clearInterval(paid_timer)
					$('#paidsuccess').modal('show')
					setTimeout(function(){location.reload()},3000)
				}
			}})
	},1500)
	$(".alipay_qrcode span").remove()
	new QRCode($(".alipay_qrcode")[0], {
			text: "{$url}",
			width: 200,
			height: 200,
			colorDark : "#000000",
			colorLight : "#ffffff",
			correctLevel : QRCode.CorrectLevel.H
	});
})
</script>
<div class="modal fade" id="paidsuccess">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><p class="text-success">支付成功</p></h4>
      </div>
      <div class="modal-body">
        <p>本页面将在3秒后刷新</p>
      </div>
    </div>
  </div>
</div>