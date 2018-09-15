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
                                <p class="title16 lob-font margin-b-10"><?php echo $item->description; ?></p>
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
<div class="block-intro17">
    <div class="container">
        <div class="row">
            <div class="col-sm-5 col-xs-12">
                <div class="banner-adv rotate-image pull-left">
                    <img src="<?php echo base_url('public/images/thuoc-moc-dai-mi-md.jpg') ?>" alt="thuốc mọc dài mi" class="img-thumbnail"/>
                </div>
            </div>
            <div class="col-sm-7 col-xs-12">
                <div class="intro-text17">
                    <h2 class="title30 lob-font"><span class="black">Chỉ 21 ngày để sở hữu đôi mắt quyến rũ</span></h2>
                    <img src="<?php echo base_url(); ?>public/images/home/home4/leaf.png" alt=""/>
                    <p class="desc"><i class="fa fa-check"></i> Giúp mi mọc tốt với 5 tiêu chí: Dày – Dài – Cong – Đen – Bóng như ý</p>
                    <p class="desc"><i class="fa fa-check"></i> Phục hồi mau chóng những hư tổn do các sản phẩm kém chất lượng trước đây gây ra</p>
                    <p class="desc"><i class="fa fa-check"></i> Giữ cho vùng da quanh mắt luôn căng mịn, tươi tắn tràn đầy sức sống</p>
                    <p class="desc"><i class="fa fa-check"></i> Kích thích các nang lông mi khoẻ hơn, và cải thiện các nang lông mi mềm và dễ gãy giúp tăng độ đàn hồi cho lông mi</p>
                    <p class="desc"><i class="fa fa-check"></i> Chất chống oxy hoá tự nhiên mạnh mẽ sẽ chữa trị và bảo vệ vùng da nhạy cảm xung quanh mắt</p>
                    <p class="desc"><i class="fa fa-check"></i> Bảo vệ một lớp oxy hoá tự nhiên giúp mi chống lại các tác động không tốt từ môi trường</p>
                </div>
            </div>
        </div>
    </div>
</div>
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
                                    <img src="<?php echo base_url('upload/product/home/'.$item->image); ?>" alt="Hình 1: <?php echo $item->name; ?>">
                                    <img src="<?php echo base_url('upload/product/hover/'.$item->image2); ?>" alt="Hình 2: <?php echo $item->name; ?>">
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
<div class="block-intro17 style2">
    <div class="container">
        <div class="row">
            <div class="col-sm-7 col-xs-12">
                <div>
                    <h2 class="title30 lob-font"><span class="black">Công dụng Nutraluxe Md sẽ giúp lông mi bạn ra sao?</span></h2>
                    <img src="<?php echo base_url(); ?>public/images/home/home4/leaf.png" alt="" />
                    <p class="desc"><strong><i class="fa fa-check"></i>Tạo độ ẩm tránh gẫy rụng:</strong> Được chiết xuất trà xanh giàu Panthenol và Peptide được kết hợp sẽ giúp làm mềm lông mi, tránh cho mi giòn dễ gãy tạo độ ẩm cho mi.</p>
                    <p class="desc"><strong><i class="fa fa-check"></i>Cung cấp dưỡng chất cần thiết:</strong> Để nuôi dưỡng và làm mịn lông mi, giúp mi khỏe mạnh, sáng bóng, Kích thích mi mọc nhanh và dài, tăng trưởng độ dày lông mi.</p>
                    <p class="desc"><strong><i class="fa fa-check"></i>Nuôi dưỡng và làm mịn:</strong> Hàm lượng cao các axit amin, peptide, giúp củng cố làm mịn và cung cấp dưỡng chất cần thiết để nuôi dưỡng làm mi.</p>
                    <p class="desc"><strong><i class="fa fa-check"></i> Giúp lông mi khỏe mạnh - Chống lão hóa:</strong> Với công thức pha trộn độc quyền và sử dụng công nghệ khoa học tiên tiến sản phẩm giúp chống lại sự lão hóa của lông mi và giữ lông mi luôn khỏe mạnh.</p>
                    <p class="desc"><strong><i class="fa fa-check"></i> Kích thích mọc dài mi và dầy mi:</strong> Với hàm lượng cao các axit béo và sterol thực vật sẽ nuôi dưỡng làn mi và kích thích mọc mi từ sâu bên trong. Giúp mi giảm được gãy rụng, khỏe mạnh, mọc dài, dày và sẫm màu tự nhiên.</p>
                    <p class="desc"><strong><i class="fa fa-check"></i> Tái tạo một làn mi mới:</strong> Nhân sâm và Tinh chất thiên nhiên được chiết xuất sẽ chống oxy hóa, lão hóa mi do tác động môi trường, ngoài ra còn cung cấp các chất vitamin B giúp bảo vệ và tái tạo làn mi và kích thích mi dày hơn.</p>
                </div>
            </div>
            <div class="col-sm-5 col-xs-12">
                <div class="banner-adv rotate-image pull-right">
                    <img src="<?php echo base_url('public/images/thuoc-moc-long-mi.jpg') ?>" alt="thuốc mọc lông mi" class="img-thumbnail" />
                </div>
            </div>
        </div>
    </div>
</div>
<div class="about-shop16">
    <h2 class="title30 lob-font title-box15 color2"><span class="inline-block bg-white border">Lý Do Bạn Nên Mua Nutra Luxe Lash MD</span></h2>
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="video-about16 banner-adv zoom-image"><img src="<?php echo base_url('public/images/thuoc-moc-mi-cua-my.jpg'); ?>" alt="thuốc mọc mi của mỹ" /></div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="toggle-tab tab-mission">
                <div class="item-toggle-tab active">
                    <h3 class="toggle-tab-title title14 border color font-bold text-uppercase">Là một thương hiệu uy tín tại Mỹ</h3>
                    <div class="toggle-tab-content">
                        <div class="row">
                            <div class="col-xs-4">
                                <img src="<?php echo base_url(); ?>public/images/home/home5/mis1.jpg" alt="" />
                            </div>
                            <div class="col-xs-8">
                                <p class="desc"><i class="fa fa-check"></i> Là một loại dưỡng dài mi thông dụng tại Mỹ, vào những năm từ 2014 – 2016 thì Nutraluxe MD được phổ biến và sử dụng rộng rãi tại các nước Châu Á như Singapore, Philipines, Hong Kong và các nước khác.</p>
                                <p class="desc"><i class="fa fa-check"></i> Cam kết 100% hàng chính hãng.</p>
                                <p class="desc"><i class="fa fa-check"></i> Sản phẩm có giấy chứng nhận lưu hành của Bộ Y Tế.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item-toggle-tab">
                    <h3 class="toggle-tab-title title14 border color font-bold text-uppercase">Chi phí hợp lý - Chất lượng tốt</h3>
                    <div class="toggle-tab-content">
                        <div class="row">
                            <div class="col-xs-4">
                                <img src="<?php echo base_url(); ?>public/images/home/home5/mis1.jpg" alt="" />
                            </div>
                            <div class="col-xs-8">
                                <p class="desc"><i class="fa fa-check"></i> Cam kết bán hàng đúng giá, có nhiều chương trình khuyến mãi.</p>
                                <p class="desc"><i class="fa fa-check"></i> Được kiểm tra sản phẩm trước khi nhận.</p>
                                <p class="desc"><i class="fa fa-check"></i> Nutra Luxe Lash MD được chiết xuất tự nhiên, đảm bảo độ tinh khiết và an toàn cho sức khỏe.</p>
                                <p class="desc"><i class="fa fa-check"></i> Được các bác sĩ chuyên da chứng minh là một trong những dòng sản phẩm thuốc dài mi đạt chất lượng tốt, cho giải pháp mang đến làn mi dài đẹp an toàn cho phụ nữ.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item-toggle-tab">
                    <h3 class="toggle-tab-title title14 border color font-bold text-uppercase">Dưỡng mi dài tự nhiên - an toàn</h3>
                    <div class="toggle-tab-content">
                        <div class="row">
                            <div class="col-xs-4">
                                <img src="<?php echo base_url(); ?>public/images/home/home5/mis1.jpg" alt="" />
                            </div>
                            <div class="col-xs-8">
                                <p class="desc"><i class="fa fa-check"></i> Là sản phẩm được tổng hợp từ các thảo dược quý của thiên nhiên nên rất an toàn khi sử dụng mà không lo lắng gì cả.</p>
                                <p class="desc"><i class="fa fa-check"></i> Mi bạn sẽ được dài một các tự nhiên mà hoàn toàn không hại mắt, thay vì sài mascara sẽ làm hại cho mắt mà mi sẽ bị yếu đi dễ gãy rụng.</p> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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