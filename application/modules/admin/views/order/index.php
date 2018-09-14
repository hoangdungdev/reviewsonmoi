<script type="text/javascript">

$(document).ready(function() {

	$('.livestatus').click(function(){

		var me = $(this);

		$.ajax({

			type: "POST",

			dataType: 'json',

			url: "<?php echo site_url().$module.'/'.$controller."/livestatus";?>",

			data: "id="+ me.parent().attr('id'),

			success: function(html){

				if(html.status == 1) me.find('span').removeClass('false').addClass('true').html(html.content);

				if(html.status == -1) me.find('span').removeClass('true').addClass('false').html(html.content);

			}

		});

	});

	$(document).ajaxStart(function(){

		$('.sz-grid th:eq(0)').append('<div class="loading"></div>');

	});

	$(document).ajaxStop(function(){

		$('.sz-grid th:eq(0)').find('.loading').remove();

	});
	$(".delete").click(function(){
		return confirm("Bạn có muốn xóa không?");
	});
	$("#delete-all").click(function(){	
		return confirm("Bạn có muốn xóa không?");
	});
});

</script>

<form id="posts-filter" method="get" action="">

	<h2 class="fl">Đơn hàng</h2>

	<p class="search-box">

		<input type="text" value="<?php echo $this->input->get('s')?>" name="s" id="post-search-input" />

		<input type="submit" value="Search" class="sz-button" id="search-submit" />

	</p>

	<div class="clear"></div>

</form>

<form id="posts-filter" method="post" action="<?php echo site_url().$module.'/'.$controller.'/delete';?>">

	<button class="sz-button" id="delete-all" name="deleteall">

		Delete Selected

	</button>

	<?php if(!empty($update)): ?>

		<div class="response-msg success ui-corner-all">

			<span>Success message</span>

			<?php if($update == 'add'):?> New record has been created.<?php endif;?>

			<?php if($update == 'del'):?> Deleted successful<?php endif;?>

			<?php if($update == 'edit'):?> Record has been edited<?php endif;?>

		</div>

	<?php endif;?>

	<div class="sz-grid-pages">

		<div class="sz-grid-pages-num"><?php echo $total_rows.' item'.($total_rows>1?'s':'');?></div>

		<div class="pagination-link">

			<?php echo $this->pagination->create_links();?>

		</div>

		<div class="clear"></div>

	</div>

	<table class="sz-grid">

		<thead>

			<tr>

				<th><input type="checkbox" id="blurcheck" class="submit" /></th>

				<td>Ngày đặt</td>

				<td>Tên người đặt</td>				

				<td>Phone người đặt</td>
                
                <td>Hình Thức Thanh Toán</td>

				<td>Tổng giá trị</td>

				<td>Trạng thái</td>

				<td>Mã đơn hàng</td>

			</tr>

		</thead>

		<tbody>

			<?php foreach ($dataset as $row):?>

			<tr id=<?php echo $row->id;?>>

				<td><input type="checkbox" value="<?php echo $row->id;?>" name="list[]" class="checkbox" /></td>

				<td><?php echo $row->created;?></td>				

				<td class="left">

					<a href="<?php echo site_url().$module."/".$controller."/detail/".$row->id?>"><?php echo $row->name;?></a>

					<div class="action">

						<span><a class="edit" href="<?php echo site_url().$module."/"."order/detail/".$row->id?>">Detail</a> | </span>

						<span><a class="delete" href="<?php echo site_url().$module."/".$controller."/delete/".$row->id?>">Delete</a> | </span>

					</div>

				</td>				

				<td><?php echo $row->phone;?></td>
                
                <td>				
				<?php
				switch($row->payment){
					case '1':
						echo 'Chuyển khoản ngân hàng';
						break;
					default:
						echo 'Thanh toán COD (Nhận Hàng Trả Tiền)';
						break;
				}
				 ?></td>

				<td><?php echo number_format($row->total_order);?></td>				

				<td class="livestatus"><?php if($row->status == 1) echo '<span class="true">Chưa giao</span>';else if($row->status == -1) echo '<span class="false">Đã giao</span>'?></td>

				<td>AP<?php echo $row->id;?></td>

			</tr>

			<?php endforeach?>

		</tbody>

	</table>

	<div class="sz-grid-pages">

		<div class="sz-grid-pages-num"><?php echo $total_rows.' item'.($total_rows>1?'s':'');?></div>

		<div class="pagination-link">

			<?php echo $this->pagination->create_links();?>

		</div>

		<div class="clear"></div>

	</div>

</form>