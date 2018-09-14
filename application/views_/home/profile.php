<div class="content">
	<div class="register">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="sign-up">
						<h4>Thông tin của bạn</h4>
						<form id="profileForm" method="post" action="<?php echo base_url('thong-tin#profileForm'); ?>">
                            <?php $thanhcong = $this->session->userdata('thanhcong'); if (isset($thanhcong) && !empty($thanhcong)): ?>
                            	<div class="alert alert-success" style="line-height:25px;font-size:16px;margin:5px;">
                                    <?php echo $thanhcong; $this->session->unset_userdata('thanhcong');?>
                                </div>
                            <?php endif ?>
                            <?php $userlogin = $this->session->userdata('userlogin'); ?>
							<div class="user-name">
								<?php echo form_error('fullname', '<p class="text-danger">* ', '</p>'); ?>
								<input type="text" name="fullname" placeholder="Họ tên*" value="<?php echo (!empty($userlogin->name))?$userlogin->name : set_value('fullname')?>">
							</div>
							<div class="user-name">
								<?php echo form_error('address', '<p class="text-danger">* ', '</p>'); ?>
								<input type="text" name="address" placeholder="Địa chỉ*" value="<?php echo (!empty($userlogin->address))?$userlogin->address : set_value('address')?>">
							</div>
							<div class="enter-email">
								<?php echo form_error('email', '<p class="text-danger">* ', '</p>'); ?>
								<input type="text" name="email" placeholder="Email*" value="<?php echo (!empty($userlogin->email))?$userlogin->email : set_value('email')?>">
							</div>
							<div class="enter-email">
								<?php echo form_error('phone', '<p class="text-danger">* ', '</p>'); ?>
								<input type="text" name="phone" placeholder="Điện thoại*" value="<?php echo (!empty($userlogin->phone))?$userlogin->phone : set_value('phone')?>">
							</div>
							<div class="user-name shop-select text-left" style="margin-bottom: 15px;width:50%;margin-left:0;">
								Giới tính: 
								<select name="sex" class="form-control" style="width:60%;">
									<option value="1" <?php echo ($userlogin->sex == 1) ? 'selected' : ''; ?>>Nam</option>
									<option value="0" <?php echo ($userlogin->sex == 0) ? 'selected' : ''; ?>>Nữ</option>
								</select>
							</div>
							<div class="signup-submit">
								<input type="submit" value="Cập nhật" name="submit">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div><!-- .register end -->
</div><!-- .content end -->