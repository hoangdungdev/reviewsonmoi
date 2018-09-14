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
	document_base_url : "<?php echo base_url();?>",    
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
		$('#title').change(function(){
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
	<?php if ($action == 'edit') echo 'Sửa'; else echo 'Thêm';?> Danh mục
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
<form enctype="multipart/form-data" class="form-table" id="form-table" method="post" action="<?php echo site_url().$module.'/'.$controller.'/'.$action.'/'.(!empty($country) ? $country->id:'');?>">
	<table class="form-table">
		<tbody>
			<tr>
				<th>
					<label for="title">Tên - Việt</label>
					<span class="description">(required)</span>
				</th>
				<td>
					<input type="text" class="regular-text full" value="<?php if(!empty($country) && !validation_errors()) echo $country->name;else echo set_value('name');?>" id="name" name="name">
				</td>
			</tr>
			<tr>
				<th>
					<label for="email">Email</label>
					<span class="description">(required)</span>
				</th>
				<td>
					<input type="text" class="regular-text full" value="<?php if(!empty($country) && !validation_errors()) echo $country->email;else echo set_value('email');?>" id="email" name="email">
				</td>
			</tr>
			<tr>
				<th>
					<label for="address">Địa chỉ</label>
					<span class="description">(required)</span>
				</th>
				<td>
					<input type="text" class="regular-text full" value="<?php if(!empty($country) && !validation_errors()) echo $country->address;else echo set_value('address');?>" id="address" name="address">
				</td>
			</tr>
			<tr>
				<th>
					<label for="phone">Điện thoại</label>
					<span class="description">(required)</span>
				</th>
				<td>
					<input type="text" class="regular-text full" value="<?php if(!empty($country) && !validation_errors()) echo $country->phone;else echo set_value('phone');?>" id="phone" name="phone">
				</td>
			</tr>	
			<tr>
				<th>
					<label for="content">Nội dung</label>
				</th>
				<td>
					<textarea type="text" class="regular-text full" id="content" name="content" cols="50" rows="5"><?php if(!empty($country) && !validation_errors()) echo $country->content;else echo set_value('content');?></textarea>
				</td>
			</tr>		
			<tr>
				<th><label for="status">Trạng thái</label></th>
				<td>
					<select id="status" name="status">
						<option value="1" <?php echo set_select('status', 1, !empty($accueil) && $accueil->status == 1);?> >Active</option>
						<option value="-1" <?php echo set_select('status', -1, !empty($accueil) && $accueil->status == -1);?> >Block</option>
					</select>
				</td>
			</tr>
		</tbody>
	</table>
	<button class="sz-button">
		Submit
	</button>
</form>
