<div class="banner-slider-page banner-slider">
    <div class="wrap-item" data-pagination="false" data-itemscustom="[[0,1]]">
        <div class="item-slider item-slider-shop">
            <div class="banner-thumb"><a href="#" class="adv-thumb-link"><img src="<?php echo base_url(); ?>public/images/blog/banner-blog-list.jpg" alt="" /></a></div>
            <div class="banner-info">
                <div class="container">
                    <h2 class="title18 white text-uppercase font-bold">Liên hệ</h2>
                    <div class="bread-crumb white"><a href="<?php echo base_url(); ?>" class="white">Trang chủ</a><span>Liên hệ</span></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="content-shop">
        <div class="row">
            <div class="col-md-9 col-sm-8 col-xs-12">
                <div class="product-detail">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="detail-gallery">
                                <div class="mid">
                                    <img src="<?php echo base_url('upload/product/home/'.$products_detail->image); ?>" alt="<?php echo $products_detail->name; ?>"/>
                                </div>
                                <div class="gallery-control">
                                    <div class="carousel">
                                        <ul class="list-none">
                                            <?php $img = json_decode($products_detail->list_img);?>
                                            <?php if (!empty($img) && count($img)>0): ?>
                                                <?php foreach ($img as $i=> $item_img): ?>
                                                <li><a href="#" class="<?php echo ($i == 0) ? 'active' : ''; ?>"><img src="<?php echo base_url('upload/product/show/'.$item_img); ?>" alt="<?php echo 'Hình ảnh: '.$products_detail->name.' '.$i.$i; ?>"/></a></li>
                                                <?php endforeach ?>  
                                            <?php endif ?>
                                        </ul>
                                    </div>
                                    <a href="#" class="prev"></a>
                                    <a href="#" class="next"></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="detail-info">
                                <h2 class="title30 font-bold"><?php echo $products_detail->name; ?></h2>
                                <div class="product-price">
                                    <?php if ($products_detail->sale == 1) { ?>
                                        <del class="silver"><span><?php echo $this->cart->format_number_custom($products_detail->price); ?> đ</span></del>
                                        <ins class="color"><span><?php echo $this->cart->format_number_custom($products_detail->price_sale); ?> đ</span></ins>
                                    <?php } else { ?>    
                                        <ins class="color"><span><?php echo $this->cart->format_number_custom($products_detail->price); ?> đ</span></ins>
                                    <?php } ?>
                                </div>
                                <div class="product-rate">
                                    <div class="product-rating" style="width:100%"></div>
                                </div>
                                <p class="desc"><?php echo word_limiter($products_detail->description,100); ?></p>
                                <ul class="list-inline-block wrap-qty-extra">
                                    <li>
                                        <div class="detail-qty">
                                            <a href="#" class="qty-down silver"><i class="fa fa-arrow-circle-down" aria-hidden="true"></i></a>
                                            <span class="qty-val">1</span>
                                            <a href="#" class="qty-up silver"><i class="fa fa-arrow-circle-up" aria-hidden="true"></i></a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="product-extra-link">
                                            <a href="#" class="addcart-link"><i class="fa fa-cart-plus" aria-hidden="true"></i> Đặt Mua Hàng</a>
                                        </div>
                                    </li>
                                </ul>
                                <p class="desc info-extra">
                                    <label>Danh Mục:</label><a href="<?php echo base_url(); ?>" class="color">Nutraluxe MD</a>
                                </p>
                                <p class="desc info-extra">
                                    <label>Mã sản phẩm:</label><span class="color"><?php echo $products_detail->code; ?></span>
                                </p>
                                <p class="desc info-extra">
                                    <label>Share:</label>
                                    <a href="#" class="silver"><i class="fa fa-facebook"></i></a>
                                    <a href="#" class="silver"><i class="fa fa-twitter"></i></a>
                                    <a href="#" class="silver"><i class="fa fa-instagram"></i></a>
                                </p>
                            </div>          
                        </div>
                    </div>
                </div>
                <!-- End Product Detail -->
                <div class="detail-tabs">
                    <div class="title-tab-detail">
                        <ul class="title-tab1 list-inline-block">
                            <li class="active"><a href="#tab1" class="title14" data-toggle="tab" aria-expanded="true">Thông tin sản phẩm</a></li>
                            <li class=""><a href="#tab2" class="title14" data-toggle="tab" aria-expanded="false">Nhận xét</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div id="tab1" class="tab-pane active">
                            <div class="detail-descript">
                                <?php echo $products_detail->content; ?>
                            </div>
                        </div>
                        <div id="tab2" class="tab-pane">
                            <div class="content-tags-detail">
                                <?php $lengthComemnt = count($comments); ?>
                                <h3 class="title14">Có [<?php echo $lengthComemnt; ?>] nhận xét về sản phẩm</h3>
                                <ul class="list-none list-tags-review">
                                    <?php if ($lengthComemnt > 0): ?>
                                        <?php foreach ($comments as $item): ?>
                                            <li>
                                                <div class="review-author">
                                                    <?php if (!empty($item->image)) { ?>
                                                        <img src="<?php echo $item->image; ?>" alt="Khách hàng <?php echo $item->name; ?>" class='img-circle' width='79'>
                                                    <?php } else { ?>
                                                        <img src="<?php echo base_url('public/images/client.png') ?>" alt="Khách hàng <?php echo $item->name; ?>">
                                                    <?php } ?>
                                                </div>
                                                <div class="review-info">
                                                    <p class="review-header"><strong><?php echo $item->name; ?></strong> – <?php echo $item->created; ?></p>
                                                    <div class="product-rate">
                                                        <div class="product-rating" style="width:100%"></div>
                                                    </div>
                                                    <p class="desc"><?php echo $item->content ?></p>
                                                </div>
                                            </li>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </ul>
                                <div class="add-review-form">
                                    <h3 class="title14">Bạn cần tư vấn hoặc nhận xét về sản phẩm. Hãy để lại lời nhắn bên dưới và gửi cho Chúng tôi.</h3>
                                    <p>Hãy điền đầy đủ thông tin phía dưới nhé *</p>
                                    <div class="alert" id="review_info" style="display: none;"></div>
                                    <form class="review-form" id="form-review-kh" action="<?php echo base_url('nhan-xet'); ?>" method="post">
                                        <div>
                                            <label>Họ tên *</label>
                                            <input name="name" id="name" type="text">
                                            <input name="id_product" id="id_product" type="hidden" value="<?php echo $products_detail->id; ?>">
                                            <input name="name_product" id="name_product" type="hidden" value="<?php echo $products_detail->name; ?>">
                                        </div>
                                        <div>
                                            <label>Email *</label>
                                            <input name="email" id="email" type="text">
                                        </div>
                                        <div>
                                            <label>Điểm Rating</label>
                                            <div style="height:  40px;line-height:  40px;">
                                                <input type="radio" class="rating" value="1" name="rating">
                                                <label for="shipping_method_0_free_shipping">1</label>
                                                <input type="radio" class="rating" value="2" name="rating">
                                                <label for="shipping_method_0_free_shipping">2</label>
                                                <input type="radio" class="rating" value="3" name="rating">
                                                <label for="shipping_method_0_free_shipping">3</label>
                                                <input type="radio" class="rating" value="4" name="rating">
                                                <label for="shipping_method_0_free_shipping">4</label>
                                                <input type="radio" class="rating" value="5" name="rating" checked="checked">
                                                <label for="shipping_method_0_free_shipping">5</label>
                                            </div>
                                        </div>
                                        <div>
                                            <label>Ghi chú *</label>
                                            <textarea name="content" id="message" cols="30" rows="10"></textarea>
                                        </div>
                                        <div>
                                            <input class="shop-button radius4" value="Gửi" type="submit">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Tabs Detail -->
                <div class="related-product">
                    <h2 class="title30 font-bold">Xem thêm sản phẩm</h2>
                    <div class="related-product-slider product-slider">
                        <div class="wrap-item group-navi" data-navigation="true" data-pagination="false" data-itemscustom="[[0,1],[560,2],[990,3]]">
                            <div class="item-product item-product-grid text-center">
                                <div class="product-thumb">
                                    <a href="detail.html" class="product-thumb-link rotate-thumb">
                                        <img src="images/product/fruit_11.jpg" alt="">
                                        <img src="images/product/fruit_12.jpg" alt="">
                                    </a>
                                    <a href="quick-view.html" class="quickview-link fancybox fancybox.iframe"><i class="fa fa-search" aria-hidden="true"></i></a>
                                </div>
                                <div class="product-info">
                                    <h3 class="product-title"><a href="detail.html">Conconut Chips</a></h3>
                                    <div class="product-price">
                                        <ins class="color"><span>€30.000</span></ins>
                                    </div>
                                    <div class="product-rate">
                                        <div class="product-rating" style="width:100%"></div>
                                    </div>
                                    <div class="product-extra-link">
                                        <a href="#" class="wishlist-link"><i class="fa fa-heart-o" aria-hidden="true"></i><span>Wishlist</span></a>
                                        <a href="#" class="addcart-link">Add to cart</a>
                                        <a href="#" class="compare-link"><i class="fa fa-compress" aria-hidden="true"></i><span>Compare</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Related Product -->
            </div>
            <div class="col-md-3 col-sm-4 col-xs-12">
                <div class="sidebar-right sidebar">
                    <div class="widget widget-popular-post">
                        <h2 class="title18 title-widget font-bold">Tin mới nhất</h2>
                        <div class="wg-product-slider wg-post-slider">
                            <div class="wrap-item group-navi" data-pagination="false" data-navigation="true" data-itemscustom="[[0,1],[560,2],[768,1]]">
                                <div class="item">
                                    <?php if (count($tintucs) > 0): ?>
                                        <?php foreach ($tintucs as $item): ?>
                                            <div class="item-pop-post table">
                                                <div class="post-thumb banner-adv overlay-image zoom-image">
                                                    <a href="<?php echo base_url('tin-tuc/'.$item->loaitintuc_slug.'/'.$item->slug); ?>" class="adv-thumb-link">
                                                        <img src="<?php echo base_url('upload/tintuc/thumb/'.$item->image); ?>" alt="<?php echo $item->title; ?>">
                                                    </a>
                                                </div>
                                                <div class="post-info">
                                                    <h3 class="title14"><a href="<?php echo base_url('tin-tuc/'.$item->loaitintuc_slug.'/'.$item->slug); ?>"><?php echo $item->title; ?></a></h3>
                                                    <span class="silver"><?php echo $item->created; ?></span>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End WIdget -->
                    <div class="widget widget-tags">
                        <h2 class="title18 title-widget font-bold">Search by Tags</h2>
                        <ul class="wg-list-tabs list-inline-block">
                            <li><a href="#">Tomato</a></li>
                            <li><a href="#">Organic</a></li>
                            <li><a href="#">Organic Gardening </a></li>
                            <li><a href="#">Food</a></li>
                            <li><a href="#">Healthy</a></li>
                            <li><a href="#">Vegatable</a></li>
                            <li><a href="#">Natural </a></li>
                        </ul>
                    </div>
                    <!-- End WIdget -->
                </div>
            </div>
        </div>
    </div>
</div>