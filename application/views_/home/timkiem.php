<div class="row">
	<div class="col-sm-12 col-xs-12 item-list">
		<?php if (count($products)>0){ ?>
		<h3><span>SẢN PHẨM</span></h3>
			<?php foreach ($products as $product): ?>
				<!-- item -->
				<div class="col-md-3 col-sm-4 col-xs-6">
					<div class="hot-item-img">
						<a href="<?php echo base_url('chi-tiet/'.$product->category_slug.'/'.$product->slug); ?>">
							<img src="<?php echo base_url()?>upload/product/<?php echo $product->image; ?>" alt="<?php echo $product->name; ?>">
							<?php if (!empty($product->price_sale) && $product != 0): ?>
								<div class="promotion">
									<span><?php echo $product->price_sale; ?>%</span>
								</div>
							<?php endif ?>
							<div class="show-more-detail">
								<span><i class="fa fa-search"></i> Xem chi tiết</span>
							</div>
						</a>
					</div>
					<div class="hot-item-information">
						<a href="<?php echo base_url('chi-tiet/'.$product->category_slug.'/'.$product->slug); ?>" class="hot-item-name"><?php echo $product->name; ?></a>
						<p class="MSP"><span>MSP:</span> AD<?php echo $product->id; ?></p>
						<p class="hot-item-price"><span>Giá:</span>
							<?php if ($product->price == 0 || $product->price ==''){ ?>
								<a href="<?php echo base_url('lien-he'); ?>">Liên Hệ</a>
							<?php }else{
								echo $product->price.' VNĐ';
							} ?>
						</p>
					</div>
				</div>
				<!--  -->
			<?php endforeach ?>			
		<?php }else{ ?>
			<h3><span>SẢN PHẨM BẠN TÌM KHÔNG TỒN TẠI</span></h3>
		<?php } ?>
		<!-- pagination -->
		<div class="col-xs-12 pag-container">
			<ul class="pagination">
				<?php echo $this->pagination->create_links();?>
		  	</ul>
		</div>
		<!--  -->
	</div>
</div>