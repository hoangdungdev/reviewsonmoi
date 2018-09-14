<div class="content">
    <div class="slider-area">
        <div id="bootstrap-touch-slider" class="carousel bs-slider fade  control-round indicators-line" data-ride="carousel" data-pause="hover" data-interval="5000" >
            <?php $slider_length = count($sliders); ?>
            <ol class="carousel-indicators">
                <?php if ($slider_length > 0): ?>
                    <?php for ($i=0; $i < $slider_length; $i++) { ?>
                        <li data-target="#bootstrap-touch-slider" data-slide-to="<?php echo $i; ?>" class="<?php echo ($i == 0) ? 'active':''; ?>"></li>
                    <?php } ?>
                <?php endif ?>
            </ol>
            <div class="carousel-inner" role="listbox">
                <?php if ($slider_length > 0): ?>
                    <?php foreach ($sliders as $i => $item): ?>
                        <div class="item <?php echo ($i == 0) ? 'active':''; ?>">
                            <img src="<?php echo base_url('upload/slider/'.$item->image); ?>" class="slide-image" alt="<?php echo $item->title; ?>"/>
                            <div class="bs-slider-overlay"></div>
                            <div class="vertical">
                                <div class="align">
                                    <div class="middle">
                                        <!-- slide_style_right -->
                                        <div class="slide-text"> 
                                            <h1 data-animation="animated zoomInRight"><?php echo $item->title; ?></h1>
                                            <p data-animation="animated fadeInLeft"><?php echo $item->subtitle; ?></p>
                                            <a href="<?php echo $item->link; ?>" target="_blank"  class="btn btn-primary" data-animation="animated fadeInRight">Xem chi tiết</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                <?php endif ?>
            </div>
            <a class="left carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="prev">
            <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
                <span class="sr-only">Trở lại</span>
            </a>
            <a class="right carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="next">
                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                <span class="sr-only">Tiếp</span>
            </a>
        </div>
    </div>
    <div class="banner-area">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="banner-1">
                        <a class="banner-image" href="<?php echo $banners_left->link; ?>">
                            <img src="<?php echo base_url('upload/banner/'.$banners_left->image); ?>" alt="<?php echo $banners_left->title; ?>"/></a>
                        <div class="overlay"></div>
                        <div class="vertical banner-content">
                            <div class="align banner-inner">
                                <div class="middle banner-cell">    
                                    <h3><?php echo $banners_left->title; ?></h3>
                                    <p><?php echo $banners_left->subtitle; ?></p>
                                    <div class="read-more">
                                        <a href="<?php echo $banners_left->link; ?>"> 
                                            <span>Chi tiết</span>
                                            <i class="fa fa-long-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="row">
                        <?php if (count($banners_right)): ?>
                            <?php foreach ($banners_right as $item): ?>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="banner-2">
                                    <a class="banner-image" href="<?php echo $item->link; ?>">
                                        <img src="<?php echo base_url('upload/banner/'.$item->image); ?>"/></a>
                                    <div class="overlay"></div>
                                    <div class="vertical banner-content">
                                        <div class="align banner-inner">
                                            <div class="middle banner-cell left">   
                                                <h3><?php echo $item->title; ?></h3>
                                                <p><?php echo $item->subtitle; ?></p>
                                                <div class="read-more">
                                                    <a href="<?php echo $item->link; ?>"> 
                                                        <span>Chi tiết</span>
                                                        <i class="fa fa-long-arrow-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
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
    <div class="featured-product-area">
        <div class="container">
            <div class="row">
                <div class="content-title">
                    <div class="container">
                        <div class="row">
                            <h4>Sản phẩm mới nhất</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php if (count($mois) > 0): ?>
                    <?php $i = 1; foreach ($mois as $item): ?>
                        <div class="col-md-3 col-sm-4 col-xs-12">
                            <div class="single-product">
                                <div class="product-img">
                                    <?php if ($item->sale == 1): ?>
                                        <div class="product-label">
                                            <span class="sale">Sale</span>
                                        </div>
                                    <?php endif ?>
                                    <div class="product-action">
                                        <a href="<?php echo base_url('san-pham/'.$item->slug); ?>">
                                            <i class="fa fa-shopping-cart"></i> Chi Tiết
                                        </a>
                                    </div>
                                    <a href="<?php echo base_url('san-pham/'.$item->slug); ?>">
                                        <img src="<?php echo base_url('upload/product/home/thumb/'.$item->image); ?>"/>
                                    </a>
                                </div>
                                <div class="product-desc">
                                    <h4 class="product-name">
                                        <a href="<?php echo base_url('san-pham/'.$item->slug); ?>"><?php echo $item->name; ?></a></h4>
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
                        <?php echo ($i % 4 == 0) ? '<div style="clear:both"></div>' : ''; ?>
                    <?php $i++; endforeach ?>
                <?php endif ?>
            </div>
            <div class="row">
                <div class="show-more">
                    <a href="<?php echo base_url('san-pham'); ?>">Xem nhiều hơn <i class="fa fa-plus-square-o"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="latest-product-area">
        <div class="container">
            <div class="row">
                <div class="content-title">
                    <div class="container">
                        <div class="row">
                            <h4>Sản phẩm bán chạy</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="product-carousel owl-carousel owl-theme">
                    <?php if (count($banchays) > 0): ?>
                        <?php foreach ($banchays as $item): ?>
                            <div class="col-sm-12">
                                <div class="single-product">
                                    <div class="product-img">
                                        <?php if ($item->sale == 1): ?>
                                            <div class="product-label">
                                                <span class="sale">Sale</span>
                                            </div>
                                        <?php endif ?>
                                        <div class="product-action">
                                            <a href="<?php echo base_url('san-pham/'.$item->slug); ?>">
                                                <i class="fa fa-shopping-cart"></i> Chi Tiết
                                            </a>
                                        </div>
                                        <a href="<?php echo base_url('san-pham/'.$item->slug); ?>">
                                            <img src="<?php echo base_url('upload/product/home/thumb/'.$item->image); ?>"/>
                                        </a>
                                    </div>
                                    <div class="product-desc">
                                        <h4 class="product-name">
                                            <a href="<?php echo base_url('san-pham/'.$item->slug); ?>"><?php echo $item->name; ?></a></h4>
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
    <div class="blog-area">
        <div class="container">
            <div class="row">
                <div class="content-title">
                    <div class="container">
                        <div class="row">
                            <h4>Tin nổi bật</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="blog-carousel owl-carousel owl-theme">
                        <?php if (count($tintucs) > 0): ?>
                            <?php foreach ($tintucs as $item): ?>
                                <div class="col-sm-12">
                                    <div class="post">
                                        <div class="post-thumb">
                                            <a href="<?php echo base_url('tin-tuc/'.$item->loaitintuc_slug.'/'.$item->slug); ?>">
                                                <img src="<?php echo base_url('upload/tintuc/'.$item->image); ?>" alt="<?php echo $item->meta_title; ?>"/></a>
                                        </div>
                                        <div class="post-inner">
                                            <div class="post-meta">
                                                <span><i class="fa fa-calendar-o"></i> <?php echo $item->created; ?></span>
                                                <span><i class="fa fa-star"></i><?php echo $config['site_name']; ?></span>
                                            </div>
                                            <div class="post-content">
                                                <h4><a href="<?php echo base_url('tin-tuc/'.$item->loaitintuc_slug.'/'.$item->slug); ?>"><?php echo $item->title; ?></a></h4>
                                                <p><?php echo word_limiter(strip_tags($item->description),50); ?></p>
                                            </div>
                                            <div class="read-more">
                                                <a href="<?php echo base_url('tin-tuc/'.$item->loaitintuc_slug.'/'.$item->slug); ?>">
                                                    <span>Chi Tiết</span>
                                                    <i class="fa fa-long-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .blog-area end -->
</div><!-- .content end -->