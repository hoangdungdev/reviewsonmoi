<script type="text/javascript">
	$(document).ready(function() {
		// generate slug
		$('#name').change(function(){
			var me = $(this);
			$.ajax({
				type: "POST",
				url: "<?php echo site_url().$module.'/'.$controller;?>/live_generateSlug",
				data: {
					title : me.val()
				},
				success: function(html){
					$('#slug').html(html);
				}
			});
		})
	});
</script>
<h2 class="fl">
	<?php if ($action == 'edit') echo 'Edit'; else echo 'Add New';?> Category
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
<form enctype="multipart/form-data" class="form-table" id="form-table" method="post" action="<?php echo site_url().$module."/".$controller.'/'.$action.'/'.(!empty($post_category) ? $post_category->id:'');?>">
	<table class="form-table">
		<tbody>
			<tr>
				<th>
					<label for="name">
						Name
						<span class="description">(required)</span>
					</label>
				</th>
				<td>
					<input type="text" class="regular-text medium" value="<?php if(!empty($post_category) && !validation_errors()) echo $post_category->name;else echo set_value('name');?>" id="name" name="name">
					<p class="description">The name is how it appears on your site.</p>
				</td>
			</tr>
			<tr>
				<th><label for="slug">Slug</label></th>
				<td>
					<span class="regular-text small" id="slug" name="slug"><?php if(!empty($post_category) && !validation_errors()) echo $post_category->slug;else echo set_value('slug');?></span><br/>
					<p class="description">The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.</p>
				</td>
			</tr>
			<tr>
				<th><label for="parent">Parent Category</label></th>
				<td>
					<select id="parent" name="parent">
						<option value="0">None</option>
						<?php foreach ($categories as $row):?>
							<option value="<?php echo $row->id?>" <?php echo set_select('parent', $row->id, (!empty($post_category) && $post_category->parent_id == $row->id)); ?>><?php echo $row->name?></option>
						<?php endforeach;?>
					</select>
					<p class="description">Categories, unlike tags, can have a hierarchy. You might have a Jazz category, and under that have children categories for Bebop and Big Band. Totally optional.</p>
				</td>
			</tr>
			<tr>
				<th><label for="description">Description</label></th>
				<td>
					<textarea type="text" class="regular-text" id="description" name="description" cols="50" rows="5"><?php if(!empty($post_category) && !validation_errors()) echo $post_category->description;else echo set_value('description');?></textarea>
					<p class="description">The description is not prominent by default, however some themes may show it.</p>
				</td>
			</tr>
			<tr>
				<th><label for="order">Order</label></th>
				<td>
					<input type="text" class="regular-text small" value="<?php if(!empty($post_category) && !validation_errors()) echo $post_category->order;else echo set_value('order');?>" id="order" name="order">
				</td>
			</tr>
			<tr>
				<th><label for="status">Status</label></th>
				<td>
					<select id="status" name="status">
						<option value="1" <?php echo set_select('status', 1, !empty($post_category) && $post_category->status == 1);?> >Active</option>
						<option value="-1" <?php echo set_select('status', -1, !empty($post_category) && $post_category->status == -1);?> >Block</option>
					</select>
				</td>
			</tr>
		</tbody>
	</table>
	<button class="sz-button">
		Submit
	</button>
</form>