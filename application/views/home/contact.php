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
<div class="content-page">
    <div class="contact-info-page">
        <div class="list-contact-info">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="item-contact-info text-center">
                        <a class="contact-icon color wobble-horizontal" href="tel:<?php echo str_replace('.','', $config['site_hotline']); ?>"><i class="fa fa-mobile"></i></a>
                        <h2 class="title18 text-upperrcase font-bold">Hotline: <a href="tel:<?php echo str_replace('.','', $config['site_hotline']); ?>"><?php echo $config['site_hotline']; ?></a></h2>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="item-contact-info text-center">
                        <a class="contact-icon color wobble-horizontal" href="#"><i class="fa fa-map-marker"></i></a>
                        <h2 class="title18 text-upperrcase font-bold"><?php echo $config['site_address']; ?></h2>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="item-contact-info text-center">
                        <a class="contact-icon color wobble-horizontal" href="mailto:<?php echo $config['site_mail']; ?>"><i class="fa fa-envelope"></i></a>
                        <h2 class="title18 text-upperrcase font-bold"><a href="mailto:<?php echo $config['site_mail']; ?>"><?php echo $config['site_mail']; ?></a></h2>
                    </div>
                </div>
            </div>
        </div>
        <p class="desc">Hãy liên hệ với Chúng Tôi nếu bạn cần tư vấn thêm về sản phẩm hoặc các vấn đề liên quan đến sản phẩm. Xin chân thành cảm ơn.</p>
    </div>
    <div class="contact-form-page">
        <h2 class="title30 text-uppercase font-bold">Thông tin của Quý khách</h2>
        <div class="form-contact">
            <form id="contactForm" method="post" action="<?php echo base_url('lien-he#contactForm'); ?>">
                <div class="row">
                    <?php if (isset($thanhcong) && !empty($thanhcong)): ?>
                        <div class="alert alert-success" style="line-height:25px;font-size:16px;margin:5px;">
                            <?php echo $thanhcong; ?>
                        </div>
                    <?php endif ?>
                    <?php if (validation_errors()):?>
                        <div class="alert alert-danger" style="line-height:25px;font-size:16px;margin:5px;">
                            <strong>Thông Báo Lỗi:</strong> <br>
                            <?php if (validation_errors()) echo validation_errors(' ',' * <br>'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="col-sm-6 col-xs-12">
                        <input name="fullname" placeholder="Họ tên..." onfocus="if (this.value==this.defaultValue) this.value = ''" onblur="if (this.value=='') this.value = this.defaultValue" type="text">
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <input name="email" placeholder="Email..." onfocus="if (this.value==this.defaultValue) this.value = ''" onblur="if (this.value=='') this.value = this.defaultValue" type="text">
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <input name="phone" placeholder="Số điện thoại..." onfocus="if (this.value==this.defaultValue) this.value = ''" onblur="if (this.value=='') this.value = this.defaultValue" type="text">
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <input name="address" placeholder="Địa chỉ..." onfocus="if (this.value==this.defaultValue) this.value = ''" onblur="if (this.value=='') this.value = this.defaultValue" type="text">
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <textarea name="content" cols="30" rows="8" onfocus="if (this.value==this.defaultValue) this.value = ''" onblur="if (this.value=='') this.value = this.defaultValue"></textarea>
                        <input class="shop-button" value="Đồng ý" type="submit">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>