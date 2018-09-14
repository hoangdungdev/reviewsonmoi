<div class="f-block">

	<form action="<?php echo site_url()?>cart/checkout" method="POST">

		<div class="f-block-content-inner">

			<h3 class="title" style="font-weight:bold">Thông tin khách hàng</h3>

			<div style="height: 12px"></div>

			<?php if (validation_errors()):?>

				<div class="response-msg error ui-corner-all">

				<span>Thông báo lỗi</span>

					<?php if (validation_errors()) echo validation_errors(' ','<br>'); ?>

				</div>

			<?php endif; ?>

			<br/>

			<p style="float:left;width:300px;padding-bottom:5px;">Họ Tên <span style="color: #FF2E12">(*)</span></p><br />
			<input type="text" name="fullname" style="width: 357px" value="<?php echo set_value('fullname');?>"/><br />
                        
			<p style="float:left;width:300px;padding-bottom:5px;">Số điện thoại <span style="color: #FF2E12">(*)</span></p><br />
			<input type="text" name="phone" style="width: 357px" value="<?php echo set_value('phone');?>"/><br />
            
			<p style="float:left;width:300px;padding-bottom:5px;">Email <span style="color: #FF2E12">(*)</span></p><br />
			<input type="text" name="email" style="width: 357px" value="<?php echo set_value('email');?>"/><br />
            
			<p style="float:left;width:300px;padding-bottom:5px;">Địa chỉ <span style="color: #FF2E12">(*)</span></p><br />
           	<input type="text" name="address" style="width: 357px" value="<?php echo set_value('address');?>"/><br />
            
			<p style="float:left;width:300px;padding-bottom:5px;">Hình Thức Thanh Toán <span style="color: #FF2E12"></span></p><br />
            <select id="payment" name="payment" style="float:left;width:357px;height:18px">
					<option value="1" >Thanh Toán Tại Cửa Hàng</option>
					<option value="2" >Chuyển Khoản Qua ATM</option>
					<option value="3" >Thanh Toán Qua Bảo Kim</option>
                    <option value="4" >Thanh Toán Qua Ngân Lượng</option>
			</select>            
            <p style="float:left;width:300px;padding-bottom:5px;">Nội dung</p><br />
			<textarea type="text" name="content" style="width: 99%; height: 72px"><?php echo set_value('content');?></textarea><br />
			<p style="float:left;width:90px;padding-bottom:5px;">Mã bảo vệ</p><br />
			<input type="text" name="txtCaptcha" id="txtCaptcha" style="width: 100px" value="<?php echo set_value('email');?>"/><br />
			<img src="<?php echo site_url().'cart/create_image'?>" style="float:left"> 
            <div style="clear:both"></div>
			<button class="btn">Đồng ý</button>
			<div class="clear"></div>

		</div>

	</form>

</div>