<script type="text/javascript">

$(document).ready(function() {
	$(".delete").click(function(){
		return confirm("Bạn có muốn xóa không?");
	});
	$("#delete-all").click(function(){	
		return confirm("Bạn có muốn xóa không?");
	});
	$('.livestatus').click(function(){

		var me = $(this);

		$.ajax({

			type: "POST",

			dataType: 'json',

			url: "<?php echo site_url().$module.'/'.$controller."/livestatus";?>",

			data: "id="+ me.parent().attr('id'),

			success: function(html){

				if(html.status == 1) me.find('span').removeClass('false').addClass('true').html(html.content);

				if(html.status == -1) me.find('span').removeClass('true').addClass('false').html(html.content);

			}

		});

	});

	$('.livesale').click(function(){

		var me = $(this);

		$.ajax({

			type: "POST",

			dataType: 'json',

			url: "<?php echo site_url().$module.'/'.$controller."/livesale";?>",

			data: "id="+ me.parent().attr('id'),

			success: function(html){

				console.log(html);

				if(html.sale == 1) me.find('span').removeClass('false').addClass('true').html(html.content);

				if(html.sale == -1) me.find('span').removeClass('true').addClass('false').html(html.content);

			}

		});

	});

	$('.livenews').click(function(){

		var me = $(this);

		$.ajax({

			type: "POST",

			dataType: 'json',

			url: "<?php echo site_url().$module.'/'.$controller."/livenews";?>",

			data: "id="+ me.parent().attr('id'),

			success: function(html){

				if(html.news == 1) me.find('span').removeClass('false').addClass('true').html(html.content);

				if(html.news == -1) me.find('span').removeClass('true').addClass('false').html(html.content);

			}

		});

	});

	$('.liveprice').change(function(){		
		var me = $(this);		
		$.ajax({			
			type: "POST",			
			dataType: 'json',			
			url: "<?php echo site_url().$module.'/'.$controller."/liveprice";?>",			
			data: {				
				"id" : me.parent().attr('id'),				
				"value" : me.find('input').val()			
			},			
			success: function(html){				
				me.find('input').val(html);			
			}		
		});	
	});		
	$(".liveprice input").keypress(function(event) {
		var me = $(this);			
		if ( event.which == 13 ) {			
			event.preventDefault();			
			me.trigger('change');	   
		}	
	});
	
	$(document).ajaxStart(function(){

		$('.sz-grid th:eq(0)').append('<div class="loading"></div>');

	});

	$(document).ajaxStop(function(){

		$('.sz-grid th:eq(0)').find('.loading').remove();

	});

});

</script>

<form id="posts-filter" method="get" action="">

	<h2 class="fl">Sản phẩm

		<a href="<?php echo site_url().$module."/".$controller."/add/"; ?>" class="add-new-h2">Add New</a>

	</h2>

	<p class="search-box">

		<input type="text" value="<?php echo $this->input->get('s')?>" name="s" id="post-search-input" />

		<input type="submit" value="Search" class="sz-button" id="search-submit" />

	</p>

	<div class="clear"></div>

</form>

<form id="posts-filter" method="post" action="<?php echo site_url().$module.'/'.$controller.'/delete';?>">

	<button class="sz-button" id="delete-all" name="deleteall">

		Delete Selected

	</button>

	<?php if(!empty($update)): ?>

		<div class="response-msg success ui-corner-all">

			<span>Success message</span>

			<?php if($update == 'add'):?> New record has been created.<?php endif;?>

			<?php if($update == 'del'):?> Deleted successful<?php endif;?>

			<?php if($update == 'edit'):?> Record has been edited<?php endif;?>

		</div>

	<?php endif;?>

	<div class="sz-grid-pages">

		<div class="sz-grid-pages-num"><?php echo $total_rows.' item'.($total_rows>1?'s':'');?></div>

		<div class="pagination-link">

			<?php echo $this->pagination->create_links();?>

		</div>

		<div class="clear"></div>

	</div>

	<table class="sz-grid">

		<thead>

			<tr>

				<th><input type="checkbox" id="blurcheck" class="submit" /></th>

				<td>Tên</td>				

				<td>Chuyên mục</td>

				<td>Hình ảnh</td>
				
				<td>Giá</td>

				<td>SP giảm giá</td>

				<td>Ngày tạo</td>

				<td>Ngày cập nhật</td>

				<td>Cập nhật bởi</td>

				<td>Trạng thái</td>

				<td>Id</td>

			</tr>

		</thead>

		<tbody>

			<?php foreach ($dataset as $row):?>

			<tr id=<?php echo $row->id;?>>

				<td><input type="checkbox" value="<?php echo $row->id;?>" name="list[]" class="checkbox" /></td>

				<td class="left">

					<a href="<?php echo site_url().$module."/".$controller."/edit/".$row->id?>"><?php echo $row->name;?></a>

					<div class="action">

						<span><a class="edit" href="<?php echo site_url().$module."/".$controller."/edit/".$row->id?>">Edit</a> | </span>

						<span><a class="delete" href="<?php echo site_url().$module."/".$controller."/delete/".$row->id?>">Delete</a> | </span>

						<span><a class="view" target="_blank" href="<?php echo site_url()."san-pham/".$row->slug?>">Preview</a> </span>

					</div>

				</td>

				<td><?php echo $row->product_category_name;?></td>

				<td><img src="<?php echo base_url();?>upload/product/home/thumb/<?php echo $row->image;?>" width="100px"/></td>	

				<td class="liveprice">					
				
					<input type="text" value="<?php echo number_format($row->price, 0, ',', '.');?>" name="price" id="price">				
				
				</td>

				<td class="livesale"><?php if($row->sale == 1) echo '<span class="true">Yes</span>';else if($row->sale == -1) echo '<span class="false">No</span>'?></td>

				<td><?php echo $row->created;?></td>

				<td><?php echo $row->modified;?></td>

				<td><?php echo $row->modified_by;?></td>

				<td class="livestatus"><?php if($row->status == 1) echo '<span class="true">Public</span>';else if($row->status == -1) echo '<span class="false">Draff</span>'?></td>

				<td><?php echo $row->id;?></td>

			</tr>

			<?php endforeach?>

		</tbody>

	</table>

	<div class="sz-grid-pages">

		<div class="sz-grid-pages-num"><?php echo $total_rows.' item'.($total_rows>1?'s':'');?></div>

		<div class="pagination-link">

			<?php echo $this->pagination->create_links();?>

		</div>

		<div class="clear"></div>

	</div>

</form>