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
<form enctype="multipart/form-data" class="form-table" id="form-table" method="post" action="<?php echo site_url().$module.'/'.$controller.'/meta';?>">
	<table class="form-table">
		<tbody>
			<tr>
				<th>
					<label for="meta_home_title">
						Home title
					</label>
				</th>
				<td>
					<input type="text" class="regular-text full" value="<?php echo $dataset['meta_home_title'];?>" id="meta_home_title" name="meta_home_title">
				</td>
			</tr>
			<tr>
				<th>
					<label for="site_phone">
						Home des
					</label>
				</th>
				<td>
					<input type="text" class="regular-text full" value="<?php echo $dataset['meta_home_des'];?>" id="meta_home_des" name="meta_home_des">
				</td>
			</tr>
			<tr>
				<th>
					<label for="meta_home_key">
						Home key
					</label>
				</th>
				<td>
					<input type="text" class="regular-text full" value="<?php echo $dataset['meta_home_key'];?>" id="meta_home_key" name="meta_home_key">
				</td>
			</tr>

			<tr>
				<th>
					<label for="meta_intro_title">
						Giới thiệu title
					</label>
				</th>
				<td>
					<input type="text" class="regular-text full" value="<?php echo $dataset['meta_intro_title'];?>" id="meta_intro_title" name="meta_intro_title">
				</td>
			</tr>
			<tr>
				<th>
					<label for="meta_intro_des">
						Giới thiệu des
					</label>
				</th>
				<td>
					<input type="text" class="regular-text full" value="<?php echo $dataset['meta_intro_des'];?>" id="meta_intro_des" name="meta_intro_des">
				</td>
			</tr>
			<tr>
				<th>
					<label for="meta_intro_key">
						Giới thiệu key
					</label>
				</th>
				<td>
					<input type="text" class="regular-text full" value="<?php echo $dataset['meta_intro_key'];?>" id="meta_intro_key" name="meta_intro_key">
				</td>
			</tr>

			<tr>
				<th>
					<label for="meta_sp_title">
						Sp title
					</label>
				</th>
				<td>
					<input type="text" class="regular-text full" value="<?php echo $dataset['meta_sp_title'];?>" id="meta_sp_title" name="meta_sp_title">
				</td>
			</tr>
			<tr>
				<th>
					<label for="meta_sp_des">
						Sp des
					</label>
				</th>
				<td>
					<input type="text" class="regular-text full" value="<?php echo $dataset['meta_sp_des'];?>" id="meta_sp_des" name="meta_sp_des">
				</td>
			</tr>
			<tr>
				<th><label for="meta_sp_key">Sp key</label></th>
				<td>
					<input type="text" class="regular-text full" value="<?php echo $dataset['meta_sp_key'];?>" id="meta_sp_key" name="meta_sp_key">
				</td>
			</tr>
			<tr>
				<th><label for="meta_news_title">News title</label></th>
				<td>
					<input type="text" class="regular-text full" value="<?php echo $dataset['meta_news_title'];?>" id="meta_news_title" name="meta_news_title">
				</td>
			</tr>
			<tr>
				<th><label for="meta_news_des">News des</label></th>
				<td>
					<input type="text" class="regular-text full" value="<?php echo $dataset['meta_news_des'];?>" id="meta_news_des" name="meta_news_des">
				</td>
			</tr>
			<tr>
				<th><label for="meta_news_key">News key</label></th>
				<td>
					<input type="text" class="regular-text full" value="<?php echo $dataset['meta_news_key'];?>" id="meta_news_key" name="meta_news_key">
				</td>
			</tr>
			<tr>
				<th><label for="meta_contact_title">Contact title</label></th>
				<td>
					<input type="text" class="regular-text full" value="<?php echo $dataset['meta_contact_title'];?>" id="meta_contact_title" name="meta_contact_title">
				</td>
			</tr>
			<tr>
				<th><label for="meta_contact_des">Contact des</label></th>
				<td>
					<input type="text" class="regular-text full" value="<?php echo $dataset['meta_contact_des'];?>" id="meta_contact_des" name="meta_contact_des">
				</td>
			</tr>
			<tr>
				<th><label for="meta_contact_key">Contact key</label></th>
				<td>
					<input type="text" class="regular-text full" value="<?php echo $dataset['meta_contact_key'];?>" id="meta_contact_key" name="meta_contact_key">
				</td>
			</tr>

		</tbody>
	</table>
	<button class="sz-button">
		Cập nhật
	</button>
</form>