<div class="content">
	<div class="register">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="sign-up">
						<h4>Đăng Nhập</h4>
						<form id="loginForm" method="post" action="<?php echo base_url('dang-nhap#loginForm'); ?>">
                            <?php $error_login = $this->session->userdata('error_login'); if (isset($error_login) && !empty($error_login)): ?>
                            	<div class="alert alert-danger" style="line-height:25px;font-size:16px;margin:5px;">
                                    <?php echo $error_login; $this->session->unset_userdata('error_login');?>
                                </div>
                            <?php endif ?>
							<div class="user-name">
								<?php echo form_error('username', '<p class="text-danger">* ', '</p>'); ?>
								<input type="text" name="username" placeholder="Tài khoản*" value="<?php echo set_value('username')?>">
							</div>
							<div class="password">
								<?php echo form_error('password', '<p class="text-danger">* ', '</p>'); ?>
								<input type="password" name="password" placeholder="Mật khẩu">
							</div>
							<div class="forget-pass">
								Bạn chưa có tài khoản! Hãy <a href="<?php echo base_url('dang-ky'); ?>"><u>Đăng ký</u></a>
							</div>
							<div class="signup-submit">
								<input type="submit" value="Đăng nhập" name="submit">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>