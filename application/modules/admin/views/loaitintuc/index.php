<form id="posts-filter" method="get" action="">
	<h2 class="fl">Chuyên Mục Tin Tức
		<a href="<?php echo site_url().$module."/".$controller."/add/"; ?>" class="add-new-h2">Thêm Mới</a>
	</h2>
	<p class="search-box">
		<input type="text" value="<?php echo $this->input->get('s')?>" name="s" id="post-search-input" />
		<input type="submit" value="Search" class="sz-button" id="search-submit" />
	</p>
	<div class="clear"></div>
</form>
<form id="posts-filter" method="post" action="<?php echo site_url().$module."/".$controller.'/delete';?>">
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
				<td>Ngày tạo</td>
				<td>Cập nhật lúc</td>
				<td>Cập nhật bởi</td>
				<td>Thứ tự</td>
				<td>Trạng thái</td>
				<td>Id</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($dataset as $row):?>
			<tr>
				<td><input type="checkbox" value="<?php echo $row->id;?>" name="list[]" class="checkbox" /></td>
				<td class="left">
					<a href="<?php echo site_url().$module."/".$controller."/edit/".$row->id?>"><?php echo $row->name;?></a>
					<div class="action">
						<span><a class="edit" href="<?php echo site_url().$module."/".$controller."/edit/".$row->id?>">Edit</a> | </span>
						<span><a class="delete" href="<?php  echo site_url().$module."/".$controller."/delete/".$row->id?>">Delete</a> </span>
					</div>
				</td>
				<td><?php echo $row->created;?></td>
				<td><?php echo $row->modified;?></td>
				<td><?php echo $row->modified_by;?></td>
				<td><?php echo $row->order;?></td>
				<td><?php if($row->status == 1) echo 'public';else if($row->status == -1) echo 'draff'?></td>
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