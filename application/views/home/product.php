<style>
	.activecolor{display: block;}
	.inactivecolor{display: none;}
</style>
<div class="content">
	<div class="product-single">
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-sm-12 col-xs-12">
					<div class="sidebar">
						<div class="widget">
                            <h4 class="title-widget"><span>Danh mục</span></h4>
                            <div class="category-product">
                                <ul>
                                    <?php if (count($menu_maus) > 0): $category_model = new Category_model();?>
                                        <?php foreach ($menu_maus as $item): $cat_id = $item->id; 
                                            $menu_level2 = $category_model->getbyparent($cat_id);
                                        ?>
                                            <li class="menu_parent">
                                                <a href="<?php echo base_url('danh-muc/'.$item->slug) ?>"><?php echo $item->name; ?></a>
                                                <?php if (count($menu_level2) > 0): ?>
                                                <ul class="menu_child">
                                                    <?php foreach ($menu_level2 as $item2): ?>
                                                        <li>
                                                            <a href="<?php echo base_url('danh-muc/'.$item2->slug) ?>">
                                                                <i class="fa fa-long-arrow-right"></i> <?php echo $item2->name; ?></a>
                                                        </li>
                                                    <?php endforeach ?>
                                                </ul>
                                                <?php endif ?>
                                            </li>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </ul>
                            </div>
                        </div>
                        <div class="widget hidden-xs">
                            <h4 class="title-widget">
                                <span>Bạn có thể xem</span>
                            </h4>
                            <?php if (count($tintucs) > 0): ?>
                                <?php foreach ($tintucs as $item): ?>
                                    <div class="recent-post">
                                        <div class="post-thumb">
                                            <a href="<?php echo base_url('tin-tuc/'.$item->loaitintuc_slug.'/'.$item->slug); ?>">
                                                <img src="<?php echo base_url('upload/tintuc/thumb/'.$item->image); ?>" alt="<?php echo $item->meta_title; ?>"/></a>
                                        </div>
                                        <div class="post-info">
                                            <h4><a href="<?php echo base_url('tin-tuc/'.$item->loaitintuc_slug.'/'.$item->slug); ?>"><?php echo $item->title; ?></a></h4>
                                            <span><?php echo $item->created; ?></span>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            <?php endif ?>
                        </div>
                        <div class="widget hidden-xs">
                            <h4 class="title-widget">
                                <span>Fanpage</span>
                            </h4>
                            <div class="archive">
                                <div id="fb-root"></div>
                                <script>(function(d, s, id) {
                                  var js, fjs = d.getElementsByTagName(s)[0];
                                  if (d.getElementById(id)) return;
                                  js = d.createElement(s); js.id = id;
                                  js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.1';
                                  fjs.parentNode.insertBefore(js, fjs);
                                }(document, 'script', 'facebook-jssdk'));</script>
                                <div class="fb-page" data-href="https://www.facebook.com/AP-Collection-533582713707504/" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/AP-Collection-533582713707504/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/AP-Collection-533582713707504/">A&amp;P Collection</a></blockquote></div>
                            </div>
                        </div>
					</div>
				</div>
				<div class="col-md-9 col-sm-12 col-xs-12">
					<div class="product-single-inner">
						<div class="row">
							<?php if (!empty($products_detail->listmausac)) { ?>
								<?php 
									$list_img_color = unserialize($products_detail->listmausac);
									$color =  $products_detail->mausac;
									$array_color = explode(",", $color);
								?>
								<?php foreach ($array_color as $i => $value) { ?>
								<div class="col-md-5 col-sm-6 col-xs-12 colorid <?php echo ($i == 0) ? 'activecolor':'inactivecolor'; ?>" id="colorid_<?php echo $value?>">
									<div class="tab-content">
										<?php foreach ($list_img_color[$i][$value] as $i => $item) { ?>
										<div class="tab-pane fade <?php echo ($i == 0) ? 'active' : ''; ?>" id="<?php echo str_replace('.', '', $item); ?>">
											<img src="<?php echo base_url('upload/product/color/'.$item); ?>"/>	
										</div>
										<?php } ?>
									</div>
									<div class="gallery-product owl-carousel owl-theme nav nav-tabs" role="tablist">
										<?php foreach ($list_img_color[$i][$value] as $i => $item) { ?>
											<div role="presentation" class="<?php echo ($i == 0) ? 'active' : ''; ?>"><a href="#<?php echo str_replace('.', '', $item); ?>" aria-controls="<?php echo $i; ?>" data-toggle="tab">
												<img src="<?php echo base_url('upload/product/color/'.$item); ?>"/></a></div>
			                            <?php } ?>  	
									</div>
								</div>
								<?php } ?>
							<?php } else { ?>
								<div class="col-md-5 col-sm-6 col-xs-12">
									<div class="tab-content">
										<?php $img = json_decode($products_detail->list_img);?>
			                            <?php if (!empty($img) && count($img)>0): ?>
			                              	<?php foreach ($img as $i=> $item_img): ?>
			                                <div class="tab-pane fade <?php echo ($i == 1) ? 'active' : ''; ?>" id="<?php echo $i; ?>">
												<img src="<?php echo base_url('upload/product/show/'.$item_img); ?>" alt="<?php echo $products_detail->name.' '.$i.$i; ?>"/>	
											</div>
			                              	<?php endforeach ?>  
			                            <?php endif ?>
									</div>
									<div class="gallery-product owl-carousel owl-theme nav nav-tabs" role="tablist">
										<?php if (!empty($img) && count($img)>0): ?>
			                              	<?php foreach ($img as $i=> $item_img): ?>
											<div role="presentation" class="<?php echo ($i == 1) ? 'active' : ''; ?>"><a href="#<?php echo $i; ?>" aria-controls="<?php echo $i; ?>" data-toggle="tab">
												<img src="<?php echo base_url('upload/product/show/min/'.$item_img); ?>"/></a></div>
			                              	<?php endforeach ?>  
			                            <?php endif ?>
									</div>
								</div>
							<?php } ?>	
							<div class="col-md-7 col-sm-6 col-xs-12">
								<div class="product-details">
									<h4><?php echo $products_detail->name; ?></h4>
									<div class="product-rating">
										<span class="star-rating">
											Đánh giá:
											<?php if (!empty($products_detail->rating)): ?>
												<?php for ($i=1; $i <= $products_detail->rating; $i++) { ?>
													<i class="fa fa-star"></i>
												<?php } ?>
											<?php endif ?>
										</span>
									</div>
									<?php if ($products_detail->sale == 1) {?>									
										<del class="price"><?php echo $this->cart->format_number_custom($products_detail->price); ?> đ</del>
										<span class="price bold"><?php echo $this->cart->format_number_custom($products_detail->price_sale); ?> đ</span>
									<?php } else { ?>
										<span class="price bold"><?php echo $this->cart->format_number_custom($products_detail->price); ?> đ</span>
									<?php } ?>
									<p><?php echo word_limiter($products_detail->description,100); ?></p>
									<?php if (!empty($products_detail->mausac)): ?>
									<div class="product-quantity">
										<p class="not-padding">Màu sắc:</p>
										<div class="input-group">
											<?php 
                            					$arr_mausac = explode(",", $products_detail->mausac);
											?>
	                          				<?php if (count($mausacs) > 0): ?>
	                          					<?php foreach ($mausacs as  $i => $item): 
	                          						$active = (!empty($zcolor) && $zcolor == $item->id) ? 'active' : ((empty($zcolor) && $i == 0)?'active':'');
	                          					?>
	                          						<?php if (in_array($item->id, $arr_mausac)): ?>
	                          							<span data-toggle="tooltip" data-original-title="<?php echo $item->title; ?>" class="colordp <?php echo $active;?>" dataid='<?php echo $item->id; ?>' style="background: url(<?php echo base_url('upload/mausac/thumb/'.$item->image); ?>) no-repeat center; background-size: 25px 25px;"></span>
	                          						<?php endif ?>
	                          					<?php endforeach ?>
	                          				<?php endif ?>
										</div>
									</div>
									<?php endif ?>
									<?php if (!empty($products_detail->size)): ?>
									<div class="product-quantity">
										<p class="not-padding">Kích thước:</p>
										<div class="input-group">
											<?php 
                            					$arr_size = explode(",", $products_detail->size);
											?>
	                          				<?php if (count($sizes) > 0): ?>
	                          					<?php foreach ($sizes as $i => $item): 
	                          						$active = (!empty($zsize) && $zsize == $item->id) ? 'active' : ((empty($zsize) && $i == 0)?'active':'');
	                          					?>
	                          						<?php if (in_array($item->id, $arr_size)): ?>
	                          							<span class="sizedp <?php echo $active;?>" dataid='<?php echo $item->id; ?>'><?php echo $item->title; ?></span>
	                          						<?php endif ?>
	                          					<?php endforeach ?>
	                          				<?php endif ?>
										</div>
									</div>
									<?php endif ?>
									<div class="product-quantity">
										<p>Số lượng:</p>
										<div class="input-group">
											<span class="input-group-btn">
												<button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant[1]" datahref="<?php echo base_url();?>cart/add/?pid=<?php echo $products_detail->id ?>">
													<span class="glyphicon glyphicon-minus"></span>
												</button>
											</span>
											<input type="text" name="quant[1]" class="form-control input-number" value="1" min="1" max="10">
											<span class="input-group-btn">
												<button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quant[1]" datahref="<?php echo base_url();?>cart/add/?pid=<?php echo $products_detail->id ?>">
													<span class="glyphicon glyphicon-plus"></span>
												</button>
											</span>
										</div>
									</div>
									<div class="product-action-details">
										<?php if ($products_detail->hethang == 1) { ?>
											<a id="sp_add" href="<?php echo base_url();?>cart/add/?pid=<?php echo $products_detail->id ?>" title="Mua Hàng" class="addto">Mua Hàng</a>
										<?php } else { ?>
											<a href="tel:<?php echo str_replace(".","",$config['site_hotline']); ?>" title="<?php echo $config['site_hotline']; ?>" class="addto"><?php echo $config['site_hotline']; ?></a>
										<?php } ?>
										<a href="<?php echo base_url('lien-he'); ?>" data-toggle="tooltip" title="Liên hệ" data-original-title="Liên hệ">
											<i class="fa fa-envelope"></i></a>
									</div>
									<div class="product-meta">
										<div class="cat-product">
											Danh mục:
											<a href="<?php echo base_url('danh-muc/'.$products_detail->product_category_slug) ?>"><?php echo $products_detail->product_category_name ?></a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="product-info">
									<ul class="nav nav-tabs" role="tablist">
										<li role="presentation" class="active"><a href="#desc" aria-controls="desc" data-toggle="tab">Thông tin sản phẩm</a></li>
										<li role="presentation"><a href="#review" aria-controls="review" data-toggle="tab">Nhận xét</a></li>
									</ul>
									<div class="tab-content">
										<div class="tab-pane fade active" id="desc">
											<div class="product-description">
												<?php echo $products_detail->content; ?>
											</div>
										</div>
										<div class="tab-pane fade" id="review">
											<div class="fb-comments" data-href="<?php echo current_url(); ?>" data-numposts="5" data-width="100%"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="related-product">
							<div class="row">
								<div class="col-md-12">
									<h4 class="title-related">Sản phẩm cùng loại</h4>
								</div>
							</div>
							<div class="row">
								<div class="related-carousel owl-carousel owl-theme">
									<?php if (count($products_lienquan) > 0): ?>
										<?php foreach ($products_lienquan as $item): ?>
											<div class="col-sm-12">
												<div class="single-product">
													<div class="product-img">
														<?php if ($item->sale == 1): ?>
                                                            <div class="product-label">
                                                                <span class="sale">Sale</span>
                                                            </div>
                                                        <?php endif ?>
														<div class="product-action">
                                                            <a href="<?php echo base_url();?>cart/add/?pid=<?php echo $item->id ?>">
                                                                <i class="fa fa-shopping-cart"></i> Mua Hàng
                                                            </a>
                                                        </div>
                                                        <a href="<?php echo base_url('san-pham/'.$item->slug); ?>">
                                                            <img src="<?php echo base_url('upload/product/home/thumb/'.$item->image); ?>"/>
                                                        </a>
													</div>
													<div class="product-desc">
														<h4 class="product-name"><a href="<?php echo base_url('san-pham/'.$item->slug); ?>"><?php echo $item->name; ?></a></h4>
                                                        <?php if ($item->sale == 1) { ?>
                                                            <span class="product-price">
                                                                <del><?php echo $this->cart->format_number_custom($item->price); ?> đ</del>
                                                                <span><?php echo $this->cart->format_number_custom($item->price_sale); ?> đ</span>
                                                            </span>
                                                        <?php } else { ?>    
                                                            <span class="product-price">
                                                                <span><?php echo $this->cart->format_number_custom($item->price); ?> đ</span>
                                                            </span>
                                                        <?php } ?>
													</div>
												</div>
											</div>
										<?php endforeach ?>
									<?php endif ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>