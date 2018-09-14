<script type="text/javascript">
	$(document).ready(function() {
		$('.live-edit-nav-item a').click(function(event){
			event.preventDefault();
			var me = $(this);
			
			$.ajax({
				type: "POST",
				dataType: 'json',
				url: "<?php echo site_url().$module.'/'.$controller;?>",
				data: {'uid': me.attr('href').substring(1), 'act':'getcontent'},
				beforeSend: function(xhr){
					$('.live-edit-area-wrap').append($('<div class="loading"></div>'));
				},
				success: function(html){
					console.log(html);
					$('.live-edit-area-wrap').find('.loading').remove();
					$('.live-edit-area-wrap').parent().find('input[name=uid]').val(me.attr('href').substring(1));
					$('.live-edit-nav').find('.active').removeClass('active');
					me.parent().addClass('active');
					if(html.status) {
						$('.live-edit-area-wrap textarea.live-edit-area').val(html.mesage);
						if(html.bk){
							$('.restore').show();
						} else {
							$('.restore').hide();
						}
					}
				}
			})
		})
		$('.restore').click(function(event){
			event.preventDefault();
			var me = $(this);
			$.ajax({
				type: "POST",
				dataType: 'json',
				url: "<?php echo site_url().$module.'/'.$controller;?>",
				data: {'uid': me.parents('form').find('input[name=uid]').val(), 'act':'getbk'},
				beforeSend: function(xhr){
					$('.live-edit-area-wrap').append($('<div class="loading"></div>'));
				},
				success: function(html){
					console.log(html);
					$('.live-edit-area-wrap').find('.loading').remove();
					$('.live-edit-nav').find('.active').removeClass('active');
					me.parent().addClass('active');
					if(html.status) {
						$('.live-edit-area-wrap textarea.live-edit-area').val(html.mesage);
					}
				}
			})
		})
	});
</script>
<h2 class="fl">Live Editor</h2>
<div class="clear"></div>
<?php if(!empty($update)): ?>
	<div class="response-msg success ui-corner-all">
		<span>Success message</span>
		<?php if($update == 'recover'):?> Recover successful<?php endif;?>
		<?php if($update == 'edit'):?> Record has been edited<?php endif;?>
	</div>
<?php endif;?>
<div class="live-edit-nav">
<?php foreach($listfile as $key=>$row):?>
<div class="live-edit-nav-item <?php if($key==0)echo 'active'?>">
	<a href="#<?php echo $key?>"><?php echo $row['name'];?></a><br/>
	<div class="desc">(<?php echo basename($row['file']);?>)</div>
</div>
<?php endforeach;?>
</div>
<form action="<?php echo site_url().$module.'/'.$controller?>" method="POST"/>
<input type="hidden" value="0" name="uid"/>
<input type="hidden" value="update" name="act"/>
<div class="live-edit-area-wrap">
	<br/>
	<textarea class="live-edit-area" name="content" rows=25 cols=70><?php
	
	 echo $dataset;?></textarea>
	<br/>
	<br/>
	<a href="#" class="restore fr" <?php if($bk==false) echo 'style="display:none;"';?>><img src="<?php echo base_url()?>/media/images/restore.gif" />&nbsp;Khôi phục gốc</a>
</div>
<button class="sz-button">Cập nhật</button>

</form>
