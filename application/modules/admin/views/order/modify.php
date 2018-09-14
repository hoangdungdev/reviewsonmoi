<link href="<?php echo base_url()?>/media/css/sz-galery.css"	rel="stylesheet"/>
<script type="text/javascript">

$(document).ready(function() {

	$('#statusCheck').click(function(e){
		e.preventDefault();
		var me = $(this);

		$.ajax({

			type: "POST",

			dataType: 'json',

			url: "<?php echo site_url().$module.'/'.$controller."/livestatus";?>",

			data: "id="+ me.attr('dataid'),

			success: function(html){
				if(html.status == 1) $("#giaohang").html(html.content).removeClass('false').addClass('true');

				if(html.status == -1) $("#giaohang").html(html.content).removeClass('true').addClass('false');
				;
			}

		});

	});
});

</script>
<style>
	strong._bold{
		font-weight: bold;
	}
</style>
<h2 class="fl">Chi tiết đơn hàng: AP<?php echo $order->id?></h2><br/>
<?php echo $order->created?>
<div class="clear"></div>
<div style="width: 100%; overflow: hidden; margin-top: 20px; margin-bottom: 20px;">
	<div class="fl" style="width: 65%;">
		<p style="color: red; text-decoration:underline;">Thông tin giao hàng</p></br>
		<p><strong class="_bold">Họ tên:</strong> <?php echo $order->name?></br>
		<strong class="_bold">Email:</strong> <?php echo $order->email?></br>
		<strong class="_bold">Địa chỉ:</strong> <?php echo $order->address?> - <strong class="_bold">Quận/Huyện:</strong>  <?php echo $quanhuyens->name; ?> - <strong class="_bold">Tỉnh:</strong> <?php echo $tinhthanhphos->name; ?></br>
		<strong class="_bold">Cơ quan:</strong> <?php echo (!empty($order->organ) ? $order->organ : 'Không có'); ?></br>
		<strong class="_bold">Phone:</strong> <?php echo $order->phone?></br>
		<strong class="_bold">Trạng thái hàng:</strong> <strong id="giaohang"><?php if($order->status == 1) echo '<span class="true">Chưa giao</span>';else if($order->status == -1) echo '<span class="false">Đã giao</span>'?></strong></br>
		<a href="#" class="sz-button" id="statusCheck" dataid="<?php echo $order->id?>">Giao Hàng</a> <br></p>
		<p style="clear: both;"></p>
		<p>
		<strong class="_bold">Phương thức thanh toán:  </strong>
		<?php
			switch($order->payment){
				case "1":
					echo 'Chuyển khoản ngân hàng';
					break;
				default:
					echo 'Thanh toán COD (Nhận Hàng Trả Tiền)';
					break;
			}
		?></br>
		<strong class="_bold">Nội dung:</strong> <?php echo (!empty($order->content)? $order->content : 'Không có ghi chú')?></br>
	</div>
	<div class="clear"></div>
</div>
<h3><span style="color: red">Tổng tiền đơn hàng: </span><?php echo number_format($order->total_order)?> VND</h3>
<div class="clear"></div>
<div style="margin-top: 10px; margin-bottom: 30px;">
	<table class="sz-grid">
		<thead>
			<tr>
				<th>STT</th>
				<td>Mã sản phẩm</td>
				<td>Tên</td>
				<td>Số lượng</td>
				<td>Tổng tiền</td>
			</tr>
		</thead>
		<tbody>
			<?php $stt = 0; foreach ($detail as $row): $stt ++;?>
			<tr id=<?php echo $row->id;?>>
				<td><?php echo $stt;?></td>
				<td><?php echo $row->code;?></td>
				<td><?php echo $row->name;?></td>
				<td><?php echo $row->qty;?></td>
				<td><?php echo number_format($row->total);?></td>
			</tr>
			<?php endforeach?>
		</tbody>
	</table>
</div>
<a href="<?php echo site_url();?>admin/order" style="text-decoration: none;"><<< Trở về</a>
<div class="clear"></div>
