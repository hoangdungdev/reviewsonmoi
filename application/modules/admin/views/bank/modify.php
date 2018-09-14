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
<h2 class="fl">
	<?php if ($action == 'edit') echo 'Sửa'; else echo 'Thêm';?> Ngân Hàng
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
					<label for="namebank">Tên ngân hàng</label>
					<span class="description">(required)</span>
				</th>
				<td>
					<input type="text" class="regular-text full" value="<?php if(!empty($post) && !validation_errors()) echo $post->namebank;else echo set_value('namebank');?>" id="namebank" name="namebank">
				</td>
			</tr>
			<tr>
				<th>
					<label for="title">Số TK</label>
					<span class="description">(required)</span>
				</th>
				<td>
					<input type="text" class="regular-text full" value="<?php if(!empty($post) && !validation_errors()) echo $post->title;else echo set_value('title');?>" id="title" name="title">
				</td>
			</tr>
			<tr>
				<th>
					<label for="name">Chủ TK</label>
					<span class="description">(required)</span>
				</th>
				<td>
					<input type="text" class="regular-text full" value="<?php if(!empty($post) && !validation_errors()) echo $post->name;else echo set_value('name');?>" id="name" name="name">
				</td>
			</tr>
			<tr>
				<th>
					<label for="position">Chi Nhánh</label>
				</th>
				<td>
					<input type="text" class="regular-text full" value="<?php if(!empty($post) && !validation_errors()) echo $post->position;else echo set_value('position');?>" id="position" name="position">
				</td>
			</tr>
			<tr>
				<th><label for="post-image">Hình ảnh đại diện</label></th>
				<td>
					<?php if(isset($post) && !empty($post->image)):?>
						<img src="<?php echo base_url(); ?>upload/bank/thumb/<?php echo $post->image;?>" /><br/>
					<?php endif;?>
					<input type="file" class="regular-text" value="" id="post-image" name="post-image"><br/>					
					<p class="description">Kích thước: 150 x 80</p>
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
