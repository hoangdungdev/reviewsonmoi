<div class="banner-slider banner-slider16">
    <div class="wrap-item" data-itemscustom="[[0,1]]" data-pagination="false" data-navigation="true">
        <?php if (count($sliders) > 0): ?>
            <?php foreach ($sliders as $item): ?>
                <div class="item-slider16">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="slide-thumb">
                                <img src="<?php echo base_url('upload/slider/'.$item->image); ?>" alt="" />
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="slide-info text-uppercase">
                                <h3 class="title18 lob-font"><?php echo $item->subtitle; ?></h3>
                                <h2 class="title30 font-bold color"><?php echo $item->title; ?></h2>
                                <a href="<?php echo $item->link; ?>" class="shop-button bg-color large">Xem chi tiết <i class="icon ion-ios-arrow-thin-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        <?php endif ?>
    </div>
</div>
<!-- End Slider -->
<div class="banner-friut14">
    <div class="info-banner-text14 text-center inline-block">
        <h2 class="title24 color text-uppercase font-bold">Đừng để lông mi ngắn và thưa làm đôi mắt bạn kém xinh. <br><strong class="color">NHANH TAY LÊN!</strong></h2>
        <a href="tel:<?php echo str_replace('.','', $config['site_hotline']); ?>" class="shop-button"><i class="fa fa-phone"></i> Liên hệ tư vấn: <?php echo $config['site_hotline']; ?></a>
    </div>
    <img class="wobble-horizontal" src="<?php echo base_url(); ?>public/images/home/home3/product.png" alt="" />
</div>
<!-- End Banner -->
<div class="product-bestsale best-sale6">
    <h2 class="title30 font-bold title-box1 lob-font text-center">Sản phẩm thuốc mọc mi Nutraluxe Lash MD</h2>
    <div class="product-loadmore">
        <div class="row">
            <?php if (count($mois) > 0): ?>
                <?php $i = 1; foreach ($mois as $item): ?>
                    <div class="col-sm-4 col-xs-6">
                        <div class="item-product item-product1 text-center border bg-white">
                            <div class="product-thumb">
                                <a href="<?php echo base_url('san-pham/'.$item->slug); ?>" class="product-thumb-link rotate-thumb">
                                    <img src="<?php echo base_url('upload/product/home/thumb/'.$item->image); ?>" alt="">
                                    <img src="<?php echo base_url('upload/product/home/thumb/'.$item->image); ?>" alt="">
                                </a>
                            </div>
                            <div class="product-info">
                                <h3 class="product-title">
                                    <a href="<?php echo base_url('san-pham/'.$item->slug); ?>"><?php echo $item->name; ?></a></h3>
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
                                <div class="product-extra-link">
                                    <a href="#" class="addcart-link">Xem Chi Tiết</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php $i++; endforeach ?>
            <?php endif ?>
        </div>
    </div>
</div>
<div class="pop-cat8 bg-white">
    <h2 class="title30 font-bold lob-font text-center">Tin Tức Nổi Bật</h2>
    <div class="popcat-slider8">
        <div class="wrap-item" data-pagination="false" data-navigation="true" data-itemscustom="[[0,1],[560,2],[990,3]]">
            <?php if (count($tintucs) > 0): ?>
                <?php foreach ($tintucs as $item): ?>
                    <div class="item-popcat8">
                        <div class="banner-adv overlay-image zoom-out">
                            <a href="<?php echo base_url('tin-tuc/'.$item->loaitintuc_slug.'/'.$item->slug); ?>" class="adv-thumb-link">
                                <img src="<?php echo base_url('upload/tintuc/'.$item->image); ?>" alt="<?php echo $item->meta_title; ?>" />
                                <img src="<?php echo base_url('upload/tintuc/'.$item->image); ?>" alt="<?php echo $item->title; ?>" />
                            </a>
                        </div>
                        <div class="popcat-info8 text-center">
                            <h3 class="title18"><?php echo $item->title; ?></h3>
                            <p class="desc"><?php echo word_limiter(strip_tags($item->description),50); ?></p>
                            <a href="<?php echo base_url('tin-tuc/'.$item->loaitintuc_slug.'/'.$item->slug); ?>" class="btn-arrow color">Chi Tiết</a>
                        </div>
                    </div>
                <?php endforeach ?>
            <?php endif ?>
        </div>
    </div>
</div>