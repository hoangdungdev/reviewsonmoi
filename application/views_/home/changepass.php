<div class="content">
	<div class="register">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="sign-up">
						<h4>Đổi mật khẩu</h4>
						<form id="profileForm" method="post" action="<?php echo base_url('doi-mat-khau#changeForm'); ?>">
                            <?php $thanhcong = $this->session->userdata('thanhcong'); if (isset($thanhcong) && !empty($thanhcong)): ?>
                            	<div class="alert alert-success" style="line-height:25px;font-size:16px;margin:5px;">
                                    <?php echo $thanhcong; $this->session->unset_userdata('thanhcong');?>
                                </div>
                            <?php endif ?>
                            <?php $userlogin = $this->session->userdata('userlogin'); ?>
							<div class="password_old">
								<?php echo form_error('password_old', '<p class="text-danger">* ', '</p>'); ?>
								<input type="password" name="password_old" placeholder="Mật khẩu cũ*">
							</div>
							<div class="password">
								<?php echo form_error('password', '<p class="text-danger">* ', '</p>'); ?>
								<input type="password" name="password" placeholder="Mật khẩu">
							</div>
							<div class="re-password">
								<?php echo form_error('repassword', '<p class="text-danger">* ', '</p>'); ?>
								<input type="password" name="repassword" placeholder="Xác thực mật khẩu">
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