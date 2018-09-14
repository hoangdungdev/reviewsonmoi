<link href="<?php echo base_url()?>/media/css/sz-galery.css"	rel="stylesheet"/>
<script type="text/javascript"	src="<?php echo base_url();?>media/js/jquery.mousewheel.js"></script>
<script type="text/javascript"	src="<?php echo base_url();?>media/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
	// General options
	mode : "textareas",
	theme : "advanced",
	plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,imagemanager",
	// Theme options
	// theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
	theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
	theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
	theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect,|,insertfile,insertimage",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : true,
	//image manager
	relative_urls : false, 
	remove_script_host : false,
	forced_root_block : false,
	force_br_newlines : true,
	force_p_newlines : false,
	entity_encoding : "raw",
});
</script>
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
					$('#slug').val(html);
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
<form enctype="multipart/form-data" class="form-table" id="form-table" method="post" action="<?php echo site_url().$module."/".$controller.'/'.$action.'/'.(!empty($category) ? $category->id:'');?>">
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
					<input type="text" class="regular-text full" value="<?php if(!empty($category) && !validation_errors()) echo $category->name;else echo set_value('name');?>" id="name" name="name">
				</td>
			</tr>
			<tr>
				<th>
					<label for="meta_title">
						Meta title
						<span class="description">(required)</span>
					</label>
				</th>
				<td>
					<input type="text" class="regular-text full" value="<?php if(!empty($category) && !validation_errors()) echo $category->meta_title;else echo set_value('meta_title');?>" id="meta_title" name="meta_title">
				</td>
			</tr>
			<tr>
				<th>
					<label for="name">
						Meta description
						<span class="description">(required)</span>
					</label>
				</th>
				<td>
					<input type="text" class="regular-text full" value="<?php if(!empty($category) && !validation_errors()) echo $category->meta_des;else echo set_value('meta_des');?>" id="meta_des" name="meta_des">
				</td>
			</tr>
			<tr>
				<th>
					<label for="name">
						Meta key
						<span class="description">(required)</span>
					</label>
				</th>
				<td>
					<input type="text" class="regular-text full" value="<?php if(!empty($category) && !validation_errors()) echo $category->meta_key;else echo set_value('meta_key');?>" id="meta_key" name="meta_key">
				</td>
			</tr>
			<tr>
				<th><label for="slug">Slug</label></th>
				<td>
					<input type="text" class="regular-text full" value="<?php if(!empty($category) && !validation_errors()) echo $category->slug;else echo set_value('slug');?>" id="slug" name="slug">
				</td>
			</tr>
			<tr>
				<th><label for="parent">Parent Category</label></th>
				<td>
					<select id="parent" name="parent">
						<option value="0">None</option>
						<?php foreach ($categories as $row):?>
							<option value="<?php echo $row->id?>" <?php echo set_select('parent', $row->id, (!empty($category) && $category->parent_id == $row->id)); ?>><?php echo $row->name?></option>
						<?php endforeach;?>
					</select>
				</td>
			</tr>
			<tr>
				<th><label for="description">Description</label></th>
				<td>
					<textarea type="text" class="regular-text" id="description" name="description" cols="50" rows="5"><?php if(!empty($category) && !validation_errors()) echo $category->description;else echo set_value('description');?></textarea>
				</td>
			</tr>
			<tr>
				<th><label for="order">Order</label></th>
				<td>
					<input type="text" class="regular-text small" value="<?php if(!empty($category) && !validation_errors()) echo $category->order;else echo set_value('order');?>" id="order" name="order">
				</td>
			</tr>
			<tr>
				<th><label for="show">Hiện thị menu</label></th>
				<td>
					<select id="show" name="show">
						<option value="1" <?php echo set_select('show', 1, !empty($category) && $category->show == 1);?> >Active</option>
						<option value="0" <?php echo set_select('show', 0, !empty($category) && $category->show == 0);?> >Block</option>
					</select>
				</td>
			</tr>
			<tr>
				<th><label for="status">Status</label></th>
				<td>
					<select id="status" name="status">
						<option value="1" <?php echo set_select('status', 1, !empty($category) && $category->status == 1);?> >Active</option>
						<option value="-1" <?php echo set_select('status', -1, !empty($category) && $category->status == -1);?> >Block</option>
					</select>
				</td>
			</tr>
		</tbody>
	</table>
	<button class="sz-button">
		Submit
	</button>
</form>