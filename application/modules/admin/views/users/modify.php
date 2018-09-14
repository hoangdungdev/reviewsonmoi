<h2 class="fl">
	<?php if ($action == 'edit') echo 'Edit'; else echo 'Add New';?> User
	<a href="<?php echo site_url().$module."/".$controller."/add/"; ?>" class="add-new-h2">Add New</a>
</h2>
<div class="clear"></div>

<?php if (validation_errors() || isset($error)):?>
	<div class="response-msg error ui-corner-all">
	<span>Error message</span>
		<?php if (validation_errors()) echo validation_errors(' ','<br>'); ?>
		<?php if(isset($error)) echo $error;?>
	</div>
<?php endif; ?>
<form enctype="multipart/form-data" class="form-table" id="form-table" method="post" action="<?php echo site_url().$module.'/'.$controller.'/'.$action.'/'.(!empty($user_info) ? $user_info->id:'');?>">
	<table class="form-table">
		<tbody>
			<tr>
				<th>
					<label for="username">
						Username
						<span class="description">(required)</span>
					</label>
				</th>
				<td>
					<input type="text" class="regular-text" value="<?php if(!empty($user_info) && !validation_errors()) echo $user_info->username;else echo set_value('username');?>" id="username" name="username" <?php if($action == 'edit') echo 'readonly="readonly"'?>>
				</td>
			</tr>
			<tr>
				<th><label for="fullname">Name</label></th>
				<td><input type="text" class="regular-text" value="<?php if(!empty($user_info) && !validation_errors()) echo $user_info->name;else echo set_value('fullname');?>" id="fullname" name="fullname"></td>
			</tr>
			<tr>
				<th>
					<label for="pwd">
					Password
					<span class="description">(twice, required)</span>
					</label>
				</th>
				<td>
					<input type="password" class="regular-text" value="" id="pwd" name="pwd"><br/>
					<input type="password" class="regular-text" value="" id="conf_pwd" name="conf_pwd">
				</td>
			</tr>
			<tr class="hidden">
				<th><label for="avatar">Avatar</label></th>
				<td>
					<?php if(isset($user_info) && !empty($user_info->avatar)):?>
						<img src="<?php echo base_url(); ?>upload/users/<?php echo $user_info->avatar;?>" /><br/>
					<?php endif;?>
					<input type="file" class="regular-text" value="" id="avatar" name="avatar"><br/>
				</td>
			</tr>
			<tr>
				<th>
					<label for="email">Email</label>
					<span class="description">(required)</span>
				</th>
				<td><input type="text" class="regular-text" value="<?php if(!empty($user_info) && !validation_errors()) echo $user_info->email;else echo set_value('email');?>" id="email" name="email"></td>
			</tr>
			<tr>
				<th><label for="phone">Phone</label></th>
				<td><input type="text" class="regular-text" value="<?php if(!empty($user_info) && !validation_errors()) echo $user_info->phone;else echo set_value('phone');?>" id="phone" name="phone"></td>
			</tr>
			<tr>
				<th><label for="role">Role</label></th>
				<td>
					<select id="role" name="role">
						<?php foreach($usergroups as $row):?>
							<option value="<?php echo $row->name?>" <?php echo set_select('role', $row->name, (!empty($user_info) && $user_info->usertype == $row->name)); ?> ><?php echo $row->title?></option>
						<?php endforeach;?>	
					</select>
				</td>
			</tr>
			<tr>
				<th><label for="status">status</label></th>
				<td>
					<select id="status" name="status">
						<option value="1" <?php echo set_select('status', 1, !empty($user_info) && $user_info->status == 1);?>>Active</option>
						<option value="-1" <?php echo set_select('status', -1, !empty($user_info) && $user_info->status == -1);?>>Block</option>
					</select>
				</td>
			</tr>
		</tbody>
	</table>
	<button class="sz-button">
		Submit
	</button>
</form>