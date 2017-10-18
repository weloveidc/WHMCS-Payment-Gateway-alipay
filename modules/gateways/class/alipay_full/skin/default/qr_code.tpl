<!--
    可用变量

    $url  - 支付宝二维码展示url

-->
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<div class="alipay" style="max-width: 230px;margin: 0 auto">
    <div id="alipayimg" style="border: 1px solid #AAA;border-radius: 4px;overflow: hidden;margin-bottom: 5px;">
        <iframe id="alipayqr" src="{$url}" width="300" height="292" frameborder="0" scrolling="no" style="transform: scale(.9);margin: -50px 0 -24px -37px;"></iframe>
    </div>
</div>
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