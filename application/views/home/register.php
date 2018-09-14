<div class="content">
	<div class="register">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="sign-up">
						<h4>Đăng ký thành viên</h4>
						<form id="registerForm" method="post" action="<?php echo base_url('dang-ky#registerForm'); ?>">
                            <?php $thanhcong = $this->session->userdata('thanhcong'); if (isset($thanhcong) && !empty($thanhcong)): ?>
                            	<div class="alert alert-success" style="line-height:25px;font-size:16px;margin:5px;">
                                    <?php echo $thanhcong; $this->session->unset_userdata('thanhcong');?>
                                </div>
                            <?php endif ?>
							<div class="user-name">
								<?php echo form_error('fullname', '<p class="text-danger">* ', '</p>'); ?>
								<input type="text" name="fullname" placeholder="Họ tên*" value="<?php echo set_value('fullname')?>">
							</div>
							<div class="user-name">
								<?php echo form_error('username', '<p class="text-danger">* ', '</p>'); ?>
								<input type="text" name="username" placeholder="Tài khoản*" value="<?php echo set_value('username')?>">
							</div>
							<div class="enter-email">
								<?php echo form_error('email', '<p class="text-danger">* ', '</p>'); ?>
								<input type="text" name="email" placeholder="Email*" value="<?php echo set_value('email')?>">
							</div>
							<div class="enter-email">
								<?php echo form_error('phone', '<p class="text-danger">* ', '</p>'); ?>
								<input type="text" name="phone" placeholder="Điện thoại*" value="<?php echo set_value('phone')?>">
							</div>
							<div class="password">
								<?php echo form_error('password', '<p class="text-danger">* ', '</p>'); ?>
								<input type="password" name="password" placeholder="Mật khẩu">
							</div>
							<div class="re-password">
								<?php echo form_error('repassword', '<p class="text-danger">* ', '</p>'); ?>
								<input type="password" name="repassword" placeholder="Xác thực mật khẩu">
							</div>
							<div class="forget-pass">
								Bạn đã có tài khoản! Hãy <a href="<?php echo base_url('dang-nhap'); ?>"><u>Đăng nhập</u></a>
							</div>
							<div class="signup-submit">
								<input type="submit" value="Đăng ký" name="submit">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div><!-- .register end -->
</div><!-- .content end -->