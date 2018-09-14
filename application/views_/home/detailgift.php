<div class="row">
	<div class="col-xs-12 item-list">
		<h3><span>CHI TIẾT QUÀ TẶNG</span></h3>
		<div class="col-xs-12">
			<div class="item-detail-img">
				<img class="fancybox-button" rel="fancybox-button" src="<?php echo base_url(); ?>upload/gift/<?php echo $products_detail->image; ?>" alt="">
			</div>
			<div class="item-detail-information">
				<article>
					<h4 class="item-detail-name"><?php echo $products_detail->name; ?></h4>
					<p class="description"><?php echo $products_detail->content; ?></p>
					<p class="hot-item-price"><span><strong>Xem sản phẩm có quà tặng:</strong></span><a href="<?php echo $products_detail->link; ?>" class="gift-item-link">Sản phẩm</a></p>
				</article>
			</div>
		</div>
		<!--  -->
		<h3><span>CÁC QUÀ TẶNG KHÁC</span></h3>
		<div class="container-all-item">
			<?php if (count($products_lienquan)>0): ?>
				<?php foreach ($products_lienquan as $product_lienquan): ?>
					<!-- item -->
					<div class="col-md-3 col-sm-4 col-xs-6">
						<div class="hot-item-img">
							<a class="fancybox-button" rel="fancybox-button" href="<?php echo base_url('qua-tang/'.$product_lienquan->slug); ?>"><img src="<?php echo base_url() ?>upload/gift/<?php echo $product_lienquan->image; ?>" alt=""></a>
						</div>
						<div class="hot-item-information">
							<a href="item-detail.html" class="hot-item-name" href="<?php echo base_url('qua-tang/'.$product_lienquan->slug); ?>">Tranh chữ phúc</a>
						</div>
					</div>
					<!--  -->
				<?php endforeach ?>
			<?php endif ?>
		</div>
	</div>


</div>