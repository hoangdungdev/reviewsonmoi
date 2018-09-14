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
	theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
	theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
	theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
	theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
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
					$('#slug').html(html);
				}
			});
		})
	});
</script>
<h2 class="fl">
	<?php if ($action == 'edit') echo 'Edit'; else echo 'Add New';?> Danh mục tin tức
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
				<th>
					<label for="meta_title">
						Meta title
						<span class="description">(required)</span>
					</label>
				</th>
				<td>
					<input type="text" class="regular-text medium" value="<?php if(!empty($post_category) && !validation_errors()) echo $post_category->meta_title;else echo set_value('meta_title');?>" id="meta_title" name="meta_title">
				</td>
			</tr>
			<tr>
				<th>
					<label for="meta_des">Mô tả SEO</label>
					<span class="description">(required)</span>
				</th>
				<td>
					<input type="text" class="regular-text full" value="<?php if(!empty($post_category) && !validation_errors()) echo $post_category->meta_des;else echo set_value('meta_des');?>" id="meta_des" name="meta_des">
					<p class="description">The name is how it appears on your site.</p>
				</td>
			</tr>
			<tr>
				<th>
					<label for="meta_key">Keyword SEO</label>
					<span class="description">(required)</span>
				</th>
				<td>
					<input type="text" class="regular-text full" value="<?php if(!empty($post_category) && !validation_errors()) echo $post_category->meta_key;else echo set_value('meta_key');?>" id="meta_key" name="meta_key">
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
			<tr class="hidden">
				<th><label for="description">Giới thiệu</label></th>
				<td>
					<textarea type="text" class="regular-text" id="description" name="description" cols="50" rows="5"><?php if(!empty($post_category) && !validation_errors()) echo $post_category->description;else echo set_value('description');?></textarea>
					<p class="description">The description is not prominent by default, however some themes may show it.</p>
				</td>
			</tr>
			<tr class="hidden">
				<th>
					<label for="content">Nội dung</label>
				</th>
				<td>
					<textarea type="text" class="regular-text full" id="content" name="content" cols="50" rows="12"><?php if(!empty($post_category) && !validation_errors()) echo $post_category->content;else echo set_value('content');?></textarea>
				</td>
			</tr>
			<tr class="hidden">
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