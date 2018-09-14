<h2 class="fl">
	Cấu Hình Mail Server
</h2>
<div class="clear"></div>

<?php if(!empty($update)): ?>
	<div class="response-msg success ui-corner-all">
		<span>Success message</span>
		<?php if($update == 'add'):?> New record has been created.<?php endif;?>
		<?php if($update == 'del'):?> Deleted successful<?php endif;?>
		<?php if($update == 'edit'):?> Record has been edited<?php endif;?>
	</div>
<?php endif;?>
<form enctype="multipart/form-data" class="form-table" id="form-table" method="post" action="<?php echo site_url().$module.'/'.$controller.'/mail';?>">
	<table class="form-table">
		<tbody>
			<tr>
				<th>
					<label for="mail_host">
						Địa chỉ
					</label>
				</th>
				<td>
					<input type="text" class="regular-text" value="<?php echo $dataset['mail_host'];?>" id="mail_host" name="mail_host">
					<p class="description">Địa chỉ server gửi thư smtp. Ví dụ: "ssl://smtp.gmail.com"</p>
				</td>
			</tr>
			<tr>
				<th>
					<label for="mail_port">
						Cổng
					</label>
				</th>
				<td>
					<input type="text" class="regular-text" value="<?php echo $dataset['mail_port'];?>" id="mail_port" name="mail_port">
					<p class="description">Cổng kết nối đến máy chủ Mail. Thường là "25"</p>
				</td>
			</tr>
			<tr>
				<th>
					<label for="mail_user">
						Tên đăng nhập
					</label>
				</th>
				<td>
					<input type="text" class="regular-text" value="<?php echo $dataset['mail_user'];?>" id="mail_user" name="mail_user">
					<p class="description">Tên sử dụng để đăng nhập vào máy chủ Mail (Nó sẽ hiển thị khi bạn gửi mail). Ví dụ: yourname@example.com</p>
				</td>
			</tr>
			<tr>
				<th>
					<label for="mail_pass">
						Mật khẩu
					</label>
				</th>
				<td>
					<input type="password" class="regular-text" value="<?php echo $dataset['mail_pass'];?>" id="mail_pass" name="mail_pass">
					<p class="description">Mật khẩu sử dụng để đăng nhập vào tài khoản Mail</p>
				</td>
			</tr>
			<tr>
				<th>
					<label for="mail_name">
						Tên Email
					</label>
				</th>
				<td>
					<input type="text" class="regular-text" value="<?php echo $dataset['mail_name'];?>" id="mail_name" name="mail_name">
					<p class="description">Đây là tên người gửi. Thường là tên của công ty hoặc website.</p>
				</td>
			</tr>
		</tbody>
	</table>
	<button class="sz-button">
		Cập nhật
	</button>
</form>