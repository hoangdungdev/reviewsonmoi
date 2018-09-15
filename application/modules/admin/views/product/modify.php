<link href="<?php echo base_url()?>/media/css/sz-galery.css"	rel="stylesheet"/>
<script type="text/javascript"	src="<?php echo base_url();?>media/js/jquery.mousewheel.js"></script>
<script type="text/javascript"	src="<?php echo base_url();?>media/tiny_mce/tiny_mce.js"></script>
<link href="<?php echo base_url()?>media/css/jquery.fancybox.css"	rel="stylesheet"/>
<script type="text/javascript"	src="<?php echo base_url()?>media/js/jquery.fancybox.js"></script>
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
		// Sz Galery: init
		var setting = {
			thumb_wraper_width: 0
		};
		$('.sz-galery-thumbs').find('li').each(function(){
			setting.thumb_wraper_width += $(this).width() + parseInt($(this).css('padding-right'));
		});
		$('.sz-galery-thumbs ul').width(setting.thumb_wraper_width);
		// click event
		$('.sz-galery .sz-galery-thumbs ul li a').click(function(event) {
			event.preventDefault();
			var imgsrc = $(this).attr('href');
			$(this).parents('.sz-galery').find('.sz-galery-slider img').attr('src',imgsrc);
		});
		// mouse wheel
		$('.sz-galery-thumbs').mousewheel(function(event, delta) {
			event.preventDefault();
			var ul = $(this).find('ul');
			if(ul.width() > $(this).width()){
				var newpos = parseInt(ul.css('left')) + delta * 50;
				if (newpos > 0){
					ul.css('left',0);
				} else if (newpos < $('.sz-galery .sz-galery-thumbs').width() - setting.thumb_wraper_width){
					ul.css('left',$('.sz-galery .sz-galery-thumbs').width() - setting.thumb_wraper_width);
				} else ul.css('left',parseInt(ul.css('left')) + delta * 50);
			}
		});
		$('.sz-galery-thumbs li:first a').trigger('click');
		// end Sz Galery
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
	<?php if ($action == 'edit') echo 'Edit'; else echo 'Add New';?> Sản phẩm
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
<form enctype="multipart/form-data" class="form-table" id="form-table" method="post" action="<?php echo site_url().$module.'/'.$controller.'/'.$action.'/'.(!empty($product) ? $product->id:'');?>">
	<table class="form-table">
		<tbody>
			<tr>
				<th>
					<label for="name">Mã sản phẩm</label>
					<span class="description">(required)</span>
				</th>
				<td>
					<input type="text" class="regular-text full" value="<?php if(!empty($product) && !validation_errors()) echo $product->code;else echo set_value('code');?>" id="name" name="code">
					<p class="description">The name is how it appears on your site.</p>
				</td>
			</tr>
			<tr>
				<th>
					<label for="name">Tên</label>
					<span class="description">(required)</span>
				</th>
				<td>
					<input type="text" class="regular-text full" value="<?php if(!empty($product) && !validation_errors()) echo $product->name;else echo set_value('name');?>" id="name" name="name">
					<p class="description">The name is how it appears on your site.</p>
				</td>
			</tr>
			<tr>
				<th>
					<label for="meta_des">Meta description</label>
					<span class="description">(required)</span>
				</th>
				<td>
					<input type="text" class="regular-text full" value="<?php if(!empty($product) && !validation_errors()) echo $product->meta_des;else echo set_value('meta_des');?>" id="meta_des" name="meta_des">
				</td>
			</tr>
			<tr>
				<th>
					<label for="meta_key">Meta keyword</label>
					<span class="description">(required)</span>
				</th>
				<td>
					<input type="text" class="regular-text full" value="<?php if(!empty($product) && !validation_errors()) echo $product->meta_key;else echo set_value('meta_key');?>" id="meta_key" name="meta_key">
				</td>
			</tr>
			<tr>
				<th>
					<label for="slug">
					Slug
					</label>
				</th>
				<td>
					<span class="regular-text small" id="slug" name="slug"><?php if(!empty($product) && !validation_errors()) echo $product->slug;else echo set_value('slug');?></span>
					<?php if(!empty($product)): ?>
						<script type="text/javascript">
							$(document).ready(function() {
								$('.get-link').click(function(){
									prompt('Url', '<?php echo site_url()."product/".$product->slug?>');
								})
							});
						</script>
						<a class="sz-button get-link" href="#">
							Lấy Đường Dẫn
						</a>
					<?php endif;?>
					<br/>
					<p class="description">The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.</p>
				</td>
			</tr>
			<tr>
				<th><label for="parent">Chuyên mục</label></th>
				<td>
					<select id="parent" name="parent">
						<?php foreach ($categories as $row):?>
							<option value="<?php echo $row->id?>" <?php echo set_select('parent', $row->id, (!empty($product) && $product->parent_id == $row->id)); ?>><?php echo $row->name?></option>
						<?php endforeach;?>
					</select>
					<p class="description">Categories, unlike tags, can have a hierarchy. You might have a Jazz category, and under that have children categories for Bebop and Big Band. Totally optional.</p>
				</td>
			</tr>
			<tr>
				<th><label for="product-image">Hình ảnh đại diện</label></th>
				<td>
					<?php if(isset($product) && !empty($product->image)):?>
						<img width="150" src="<?php echo base_url(); ?>upload/product/home/thumb/<?php echo $product->image;?>" /><br/>
					<?php endif;?>
					<input type="file" class="regular-text" value="" id="product-image" name="product-image"><br/>					<p class="description">Kích thước trung bình: 600 x 800 </p>
				</td>
			</tr>
			<tr>
				<th><label for="product-image-hover">Hình ảnh đại diện Hover</label></th>
				<td>
					<?php if(isset($product) && !empty($product->image)):?>
						<img width="150" src="<?php echo base_url(); ?>upload/product/hover/thumb/<?php echo $product->image2;?>" /><br/>
					<?php endif;?>
					<input type="file" class="regular-text" value="" id="product-image-hover" name="product-image-hover"><br/>					<p class="description">Kích thước trung bình: 600 x 800 </p>
				</td>
			</tr>
			<tr>
				<th><label for="image-upload">Hình ảnh trưng bày</label></th>
				<td>
					<?php if(isset($product) && !empty($product->list_img)):?>
						<div class="sz-galery">
							<div class="sz-galery-slider">
								<img src="#" />
							</div>
							<div class="sz-galery-thumbs">
								<ul>
									<?php foreach(json_decode($product->list_img) as $row):?>
									<li>
										<a href="<?php echo base_url();?>upload/product/show/min/<?php echo $row?>">
											<img src="<?php echo base_url();?>upload/product/show/min/<?php echo $row?>">
										</a>
									</li>
									<?php endforeach;?>
								</ul>
							</div>
						</div>
					<?php endif;?>
					<input id="image-upload" name="image-upload[]" type="file" class="field" multiple="multiple"><br/>
					<p class="description">Kích thước: 600 x 600 trở lên </p>
				</td>
			</tr>
			<tr>
				<th>
					<label for="price">
					Giá thị trường
					</label>
				</th>
				<td>
					<input type="text" class="regular-text" value="<?php if(!empty($product) && !validation_errors()) echo $product->price;else echo set_value('price');?>" id="price" name="price">
				</td>
			</tr>
			<tr>
				<th><label for="status">Đánh giá</label></th>
				<td>
					<select id="rating" name="rating">
						<option value="0" <?php echo set_select('rating', 0, !empty($product) && $product->rating == 0);?> >0</option>
						<option value="1" <?php echo set_select('rating', 1, !empty($product) && $product->rating == 1);?> >1</option>
						<option value="2" <?php echo set_select('rating', 2, !empty($product) && $product->rating == 2);?> >2</option>
						<option value="3" <?php echo set_select('rating', 3, !empty($product) && $product->rating == 3);?> >3</option>
						<option value="4" <?php echo set_select('rating', 4, !empty($product) && $product->rating == 4);?> >4</option>
						<option value="5" <?php echo set_select('rating', 5, !empty($product) && $product->rating == 5);?> >5</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>
					<label for="description">Mô tả</label>
				</th>
				<td>
					<textarea type="text" class="regular-text full" id="description" name="description" cols="50" rows="5"><?php if(!empty($product) && !validation_errors()) echo $product->description;else echo set_value('description');?></textarea>
				</td>
			</tr>
			<tr>
				<th>
					<label for="content">Mô tả</label>
				</th>
				<td>
					<textarea type="text" class="regular-text full" id="content" name="content" cols="50" rows="5"><?php if(!empty($product) && !validation_errors()) echo $product->content;else echo set_value('content');?></textarea>
				</td>
			</tr>
			<tr>
				<th>
					<label for="order">
					Sắp xếp
					</label>
				</th>
				<td>
					<input type="text" class="regular-text" value="<?php if(!empty($product) && !validation_errors()) echo $product->order;else echo set_value('order');?>" id="order" name="order"><br/>
				</td>
			</tr>
			<tr>
				<th><label for="status">Trạng thái</label></th>
				<td>
					<select id="status" name="status">
						<option value="1" <?php echo set_select('status', 1, !empty($product) && $product->status == 1);?> >Public</option>
						<option value="-1" <?php echo set_select('status', -1, !empty($product) && $product->status == -1);?> >Draff</option>
					</select>
				</td>
			</tr>
			<tr>
				<th><label for="noibat">Nổi bật</label></th>
				<td>
					<select id="noibat" name="noibat">
						<option value="0" <?php echo set_select('noibat', 0, !empty($product) && $product->noibat == 0);?> >Draff</option>
						<option value="1" <?php echo set_select('noibat', 1, !empty($product) && $product->noibat == 1);?> >Public</option>
					</select>
				</td>
			</tr>
			<tr>
				<th><label for="banchay">Bán chạy</label></th>
				<td>
					<select id="banchay" name="banchay">
						<option value="0" <?php echo set_select('banchay', 0, !empty($product) && $product->banchay == 0);?> >Draff</option>
						<option value="1" <?php echo set_select('banchay', 1, !empty($product) && $product->banchay == 1);?> >Public</option>
					</select>
				</td>
			</tr>
			<tr>
				<th><label for="status">Giảm giá</label></th>
				<td>
					<select id="sale" name="sale">
						<option value="-1" <?php echo set_select('sale', -1, !empty($product) && $product->sale == -1);?> >No</option>
						<option value="1" <?php echo set_select('sale', 1, !empty($product) && $product->sale == 1);?> >Yes</option>
					</select>
				</td>
			</tr>
			<tr>
				<th><label for="hethang">Còn hàng</label></th>
				<td>
					<select id="hethang" name="hethang">
						<option value="1" <?php echo set_select('hethang', 1, !empty($product) && $product->hethang == 1);?> >Yes</option>
						<option value="0" <?php echo set_select('hethang', 0, !empty($product) && $product->hethang == 0);?> >No</option>
					</select>
				</td>
			</tr>
            <tr>
				<th>
					<label for="price">
					Giá Giảm
					</label>
				</th>
				<td>
					<input type="text" class="regular-text" value="<?php if(!empty($product) && !validation_errors()) echo $product->price_sale;else echo set_value('price_sale');?>" id="price_sale" name="price_sale">
				</td>
			</tr>
		</tbody>
	</table>
	<button class="sz-button">
		Cập nhật
	</button>
</form>
