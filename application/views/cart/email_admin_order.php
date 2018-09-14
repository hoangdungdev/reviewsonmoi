

<table style="width: 100%; border-spacing: 0px; border-collapse: collapse; font-size: 12px;">

	<tr>

		<td>

		<strong><?php echo date('d/m/Y');?></strong><br/>

		Thông tin đặt hàng đặt</td>


	</tr>

	<tr><td colspan=2>&nbsp;</td></tr>

	<tr>

		<td colspan=2 style="text-align: center;border-bottom: 1px solid #cdcdcd;border-top: 1px solid #cdcdcd;margin: 5px 0px;">

			<h2 style="color: #3A9DE6; font-size: 12px; font-weight: bold;">THÔNG TIN ĐƠN HÀNG</h2>

		</td>

	</tr>

	<tr>

		<td colspan=2 style="width: 50%;border-right: 1px solid #ccc; border-bottom: 1px solid #ccc; padding: 8px 5px;">

			<table>

				<tr>

					<td style="width: 100px;">Mã đơn hàng: </td>

					<td><?php echo $order->id?></td>

				</tr>

				<tr>

					<td style="width: 100px;">Tên khách hàng: </td>

					<td><?php echo $order->name?></td>

				</tr>

				<tr>

					<td>Email: </td>

					<td><?php echo $order->email?></td>

				</tr>

				<tr>

					<td>Địa chỉ: </td>

					<td><?php echo $order->address?></td>

				</tr>

				<tr>

					<td>Điện thoại: </td>

					<td><?php echo $order->phone?></td>

				</tr>				

			</table>

		</td>

	</tr>

	<tr>

		<td colspan=2 style="padding-left: 0px;padding-right: 0px;">

			<?php if(!empty($cart)) {?>

			<table style="width: 100%; border-spacing: 0px; border-collapse: collapse; font-size: 12px; text-align: center; margin-top: 8px;">

				<thead style="background: #3A9DE6; color: #fff">

					<tr>

						<th style="padding: 3px auto">STT</th>

						<th>Mã sản phẩm</th>

						<th>Hình</th>

						<th>Tên</th>

						<th>Giá</th>

						<th>Số Lượng</th>

						<th>Thành Tiền</th>

					</tr>

				</thead>

				<tbody>

					<?php

						$sum = 0;

						foreach ($detail as $row):

						$sum ++;

					?>

					<tr style="border-bottom: 1px dashed #CDCDCD">

						<td><?php echo $sum;?></td>

						<td>

							<?php echo $row->code;?>

						</td>

						<td>

							<img src="<?php echo base_url();?>upload/product/<?php echo $row->product_id?>/thumb/<?php echo $row->image?>"/>

						</td>

						

						<td style="padding:8px; text-align: left;">

							<a target="_blank" href="<?php echo site_url().'/'.$row->parent_slug.'/'.$row->slug;?>">

							<strong><?php echo $row->name;?></strong>

							</a>

						</td>			

					

						<td>

							<div><?php echo number_format($row->price);?></div>

						</td>

						<td>

							<?php echo $row->qty;?>

						</td>

						<td>

							<?php echo number_format($row->total);?>

						</td>

					</tr>

					<?php endforeach;?>

				</tbody>

				<tfoot>

					<tr>

						<td colspan=6 style="text-align:right;">Tổng tiền (VNĐ)</td>

						<td style="color: #D92231"><?php echo number_format($order->total_order)?></td>

					</tr>

				</tfoot>

			</table>

			<?php } else echo 'No item in your cart';?>

		</td>

	</tr>

</table>

<br/>

<br/>

Chúc bạn một ngày làm việc vui vẻ.