<link href="<?php echo base_url()?>/media/css/sz-galery.css"	rel="stylesheet"/>
<script type="text/javascript"	src="<?php echo base_url();?>media/js/jquery.mousewheel.js"></script>
<h2 class="fl">
	<?php if ($action == 'edit') echo 'Sửa'; else echo 'Thêm';?> Slider
	<a href="<?php echo site_url().$module."/".$controller."/add/"; ?>" class="add-new-h2">Thêm Mới</a>
</h2>
<div class="clear"></div>

<?php if (validation_errors() || isset($error)):?>
	<div class="response-msg error ui-corner-all">
	<span>Error message</span>
		<?php if (validation_errors()) echo validation_errors(' ','<br>'); ?>
		<?php if(isset($error)) echo $error;?>
	</div>
<?php endif; ?>
<form enctype="multipart/form-data" class="form-table" id="form-table" method="post" action="<?php echo site_url().$module.'/'.$controller.'/'.$action.'/'.(!empty($post) ? $post->id:'');?>">
	<table class="form-table">
		<tbody>
			<tr>
				<th>
					<label for="title">Tên</label>
					<span class="description">(required)</span>
				</th>
				<td>
					<input type="text" class="regular-text full" value="<?php if(!empty($post) && !validation_errors()) echo $post->title;else echo set_value('title');?>" id="title" name="title">
				</td>
			</tr>
			<tr>
				<th>
					<label for="link">Link</label>
				</th>
				<td>
					<input type="text" class="regular-text full" value="<?php if(!empty($post) && !validation_errors()) echo $post->link;else echo set_value('link');?>" id="link" name="link">
				</td>
			</tr>
			<tr>
				<th>
					<label for="order">
					Sắp xếp
					</label>
				</th>
				<td>
					<input type="text" class="regular-text" value="<?php if(!empty($post) && !validation_errors()) echo $post->order;else echo set_value('order');?>" id="order" name="order"><br/>
				</td>
			</tr>
			<tr>
				<th><label for="status">Trạng thái</label></th>
				<td>
					<select id="status" name="status">
						<option value="1" <?php echo set_select('status', 1, !empty($post) && $post->status == 1);?> >Active</option>
						<option value="-1" <?php echo set_select('status', -1, !empty($post) && $post->status == -1);?> >Block</option>
					</select>
				</td>
			</tr>
		</tbody>
	</table>
	<button class="sz-button">
		Submit
	</button>
</form>
