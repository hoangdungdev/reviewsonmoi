<h2 class="fl">
	Cấu Hình Website
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
<form enctype="multipart/form-data" class="form-table" id="form-table" method="post" action="<?php echo site_url().$module.'/'.$controller.'/site';?>">
	<table class="form-table">
		<tbody>
			<tr>
				<th>
					<label for="site_name">
						Tiêu Đề Website
					</label>
				</th>
				<td>
					<input type="text" class="regular-text full" value="<?php echo $dataset['site_name'];?>" id="site_name" name="site_name">
					<p class="description">Tên hiển thị trên website của bạn</p>
				</td>
			</tr>
			<tr>
				<th>
					<label for="site_phone">
						Điện thoại
					</label>
				</th>
				<td>
					<input type="text" class="regular-text full" value="<?php echo $dataset['site_phone'];?>" id="site_name" name="site_phone">
					<p class="description">Điện thoại hiển thị trên website của bạn</p>
				</td>
			</tr>
			<tr>
				<th>
					<label for="site_phone">
						Hotline
					</label>
				</th>
				<td>
					<input type="text" class="regular-text full" value="<?php echo $dataset['site_hotline'];?>" id="site_hotline" name="site_hotline">
					<p class="description">Hotline hiển thị trên website của bạn</p>
				</td>
			</tr>
			<tr>
				<th>
					<label for="site_address">
						Địa chỉ
					</label>
				</th>
				<td>
					<input type="text" class="regular-text full" value="<?php echo $dataset['site_address'];?>" id="site_address" name="site_address">
					<p class="description">Địa chỉ hiển thị trên website của bạn</p>
				</td>
			</tr>
			<tr>
				<th>
					<label for="site_address">
						Địa chỉ Facebook
					</label>
				</th>
				<td>
					<input type="text" class="regular-text full" value="<?php echo $dataset['site_facebook'];?>" id="site_facebook" name="site_facebook">
					<p class="description">Địa chỉ Facebook hiển thị trên website của bạn</p>
				</td>
			</tr>
			<tr>
				<th>
					<label for="site_youtube">
						Địa chỉ Youtube
					</label>
				</th>
				<td>
					<input type="text" class="regular-text full" value="<?php echo $dataset['site_youtube'];?>" id="site_youtube" name="site_youtube">
					<p class="description">Địa chỉ Youtube hiển thị trên website của bạn</p>
				</td>
			</tr>
			<tr>
				<th>
					<label for="site_instagram">
						Địa chỉ instagram
					</label>
				</th>
				<td>
					<input type="text" class="regular-text full" value="<?php echo $dataset['site_instagram'];?>" id="site_instagram" name="site_instagram">
					<p class="description">Địa chỉ instagram hiển thị trên website của bạn</p>
				</td>
			</tr>
			<tr>
				<th><label for="site_description">Mô Tả Website</label></th>
				<td>
					<textarea type="text" class="regular-text" id="site_description" name="site_description" cols="50" rows="5"><?php echo $dataset['site_description'];?></textarea>
				</td>
			</tr>
			<tr>
				<th><label for="site_keyword">Keyword</label></th>
				<td>
					<textarea type="text" class="regular-text" id="site_keyword" name="site_keyword" cols="50" rows="5"><?php echo $dataset['site_keyword'];?></textarea>
				</td>
			</tr>
			<tr>
				<th><label for="site_mail">Email Quản Trị Viên</label></th>
				<td>
					<input type="text" class="regular-text full" value="<?php echo $dataset['site_mail'];?>" id="site_mail" name="site_mail">
					<p class="description">Email để nhận các vấn đề từ website</p>
				</td>
			</tr>
		</tbody>
	</table>
	<button class="sz-button">
		Cập nhật
	</button>
</form>