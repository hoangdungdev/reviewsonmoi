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
<div class="content-shop">
    <div class="row">
        <div class="col-md-3 col-sm-4 col-xs-12">
            <aside class="sidebar-left sidebar">
                <!-- End Widget -->
                <div class="widget widget-category">
                    <h2 class="title18 title-widget font-bold">Sản Phẩm</h2>
                    <ul class="list-none wg-list-cat">
                        <li><a href="#">Dried Products</a><span class="color">20</span></li>
                    </ul>
                </div>
                <!-- ENd Widget -->
                <div class="widget widget-popular-post">
                    <h2 class="title18 title-widget font-bold">Tin mới nhất</h2>
                    <div class="wg-product-slider wg-post-slider">
                        <div class="wrap-item group-navi" data-pagination="false" data-navigation="true" data-itemscustom="[[0,1],[560,2],[768,1]]">
                            <div class="item">
                                <div class="item-pop-post table">
                                    <div class="post-thumb banner-adv overlay-image zoom-image">
                                        <a href="blog-detail.html" class="adv-thumb-link">
                                            <img src="images/product/fruit_12.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="post-info">
                                        <h3 class="title14"><a href="blog-detail.html">How to steam & purée your sugar pie pumkin</a></h3>
                                        <span class="silver">August 9, 2018</span>
                                    </div>
                                </div>
                            </div>
                            <!-- End Item -->
                        </div>
                    </div>
                </div>
                <div class="widget widget-new-product">
                    <h2 class="title18 title-widget font-bold">New Arrivals</h2>
                    <div class="wg-product-slider">
                        <div class="wrap-item group-navi" data-pagination="false" data-navigation="true" data-itemscustom="[[0,1],[560,2],[768,1]]">
                            <div class="item">
                                <?php if (count($banchays) > 0): ?>
                                    <?php foreach ($banchays as $item): ?>
                                        <div class="item-wg-product table">
                                            <div class="product-thumb">
                                                <a href="<?php echo base_url('san-pham/'.$item->slug); ?>" class="product-thumb-link zoom-thumb">
                                                    <img src="<?php echo base_url('upload/product/home/thumb/'.$item->image); ?>" alt="<?php echo $item->name; ?>">
                                                </a>
                                            </div>
                                            <div class="product-info">
                                                <h3 class="product-title"><a href="<?php echo base_url('san-pham/'.$item->slug); ?>"><?php echo $item->name; ?></a></h3>
                                                <div class="product-price">
                                                    <?php if ($item->sale == 1) { ?>
                                                        <del class="silver"><span><?php echo $this->cart->format_number_custom($item->price); ?> đ</span></del>
                                                        <ins class="color"><span><?php echo $this->cart->format_number_custom($item->price_sale); ?> đ</span></ins>
                                                    <?php } else { ?>    
                                                        <ins class="color"><span><?php echo $this->cart->format_number_custom($item->price); ?> đ</span></ins>
                                                    <?php } ?>
                                                </div>
                                                <div class="product-rate">
                                                    <div class="product-rating" style="width:100%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
        <div class="col-md-9 col-sm-8 col-xs-12">
            <div class="main-content-blog">
                <div class="content-blog-list">
                    <?php if (count($list_news) > 0): ?>
                        <?php foreach ($list_news as $item): ?>
                            <article class="item-blog-list">
                                <div class="banner-adv fade-out-in zoom-image">
                                    <a href="#" class="adv-thumb-link"><img src="<?php echo base_url('upload/tintuc/'.$item->image); ?>" alt="<?php echo $item->meta_title; ?>" /></a>
                                </div>
                                <div class="blog-info border bg-white">
                                    <h2 class="title30 font-bold">
                                        <a href="<?php echo base_url('tin-tuc/'.$item->loaitintuc_slug.'/'.$item->slug); ?>" class="black"><?php echo $item->title; ?></a></h2>
                                    <ul class="list-inline-block blog-comment-date">
                                        <li><label>Danh mục: </label><a href="<?php echo base_url('tin-tuc/'.$item->loaitintuc_slug); ?>" class="color"><?php echo $item->loaitintuc_name; ?></a></li>
                                        <li><label>Ngày: </label><span class="color"><?php echo $item->created; ?></span></li>
                                    </ul>
                                    <p class="desc"><?php echo word_limiter(strip_tags($item->description),150); ?></p>
                                    <div class="table social-readmore">
                                        <div class="text-left">
                                            <a href="#" class="shop-button">Xem chi tiết</a>
                                        </div>
                                        <div class="text-right blog-social">
                                            <span>Share: </span>
                                            <a href="#" class="silver"><i class="fa fa-facebook"></i></a>
                                            <a href="#" class="silver"><i class="fa fa-twitter"></i></a>
                                            <a href="#" class="silver"><i class="fa fa-instagram"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach ?>
                    <?php endif ?>
                </div>
                <div class="pagibar text-center">
                    <?php echo $this->pagination->create_links();?>
                </div>
            </div>
        </div>
    </div>
</div>