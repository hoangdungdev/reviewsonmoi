<!DOCTYPE html>
<html class="no-js" lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index, follow" />
    <meta name='revisit-after' content="1 days" />
    <meta http-equiv="content-language" content="vi" />

    <title><?php if(isset($meta_title) && !empty($meta_title)) echo $meta_title; else echo $config['site_name'];?></title>
    <link rel="canonical" href="<?php echo current_url(); ?>" />
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:type" content="website" />
    <meta name="description" content="<?php if(isset($meta_des)) echo $meta_des?>">
    <meta name="keywords" content="<?php if(isset($meta_key)) echo $meta_key?>">
    <meta property="og:title" content="<?php if(isset($meta_title) && !empty($meta_title)) echo $meta_title; else echo $config['site_name'];?>" />
    <meta property="og:description" content="<?php if(isset($meta_des)) echo $meta_des?>" />
    <meta property="og:url" content="<?php echo current_url(); ?>" />
    <meta property="og:site_name" content="<?php echo $config['site_name']; ?>" />
    <meta itemprop="name" content="<?php echo $config['site_name'];?><?php if(isset($meta_title)) echo ' - '.$meta_title?>" />
    <meta itemprop="description" content="<?php if(isset($meta_des)) echo $meta_des?>" />

    <link rel="shortcut icon" href="<?php echo base_url('favicon.png'); ?>" type="image/x-icon" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/assets/css/plugins/hover.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/assets/css/plugins/slicknav.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/assets/css/plugins/animate.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/assets/css/plugins/owl.carousel.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/assets/css/reset.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/assets/css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
        <script src="<?php echo base_url(); ?>public/assets///oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="<?php echo base_url(); ?>public/assets///oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>


<body class="preloader-active">
    <div class="preloader">
        <div class="preloader-spinner">
            <div class="waves-block">
                <div class="waves wave-1"></div>
                <div class="waves wave-2"></div>
                <div class="waves wave-3"></div>
            </div>
        </div>
    </div>
    <header id="header-area">
        <div class="preheader-area home__2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 text-center d-none d-lg-block">
                        <div class="preheader-item phone-mail">
                            <a href="#"><i class="fa fa-phone"></i><?php echo $config['site_hotline']; ?></a>
                            <a href="#"><i class="fa fa-envelope"></i><?php echo $config['site_mail']; ?></a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 text-right">
                        <div class="preheader-item">
                            <div class="preheader-icons">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-behance"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-vimeo"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom" id="fixheader">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2">
                        <a href="<?php echo base_url(); ?>" class="logo-area">
                            <img src="<?php echo base_url(); ?>public/assets/img/logo.png" alt="in bao lì xì">
                        </a>
                    </div>
                    <div class="col-lg-10">
                        <nav class="mainmenu pull-right">
                            <ul>
                                <li><a href="<?php echo base_url(); ?>">Trang chủ</a></li>
                                <li><a href="<?php echo base_url('gioi-thieu'); ?>">Giới thiệu</a></li>
                                <li><a href="<?php echo base_url('in-bao-li-xi'); ?>">In bao lì xì</a></li>
                                <li><a href="<?php echo base_url('thiet-ke-bao-li-xi'); ?>">Thiết kế bao lì xì</a></li>
                                <li><a href="<?php echo base_url('mau-bao-li-xi'); ?>">Mẫu bao lì xì</a></li>
                                <li><a href="<?php echo base_url('tin-tuc'); ?>">Tin tức</a>
                                    <ul class="sub">
                                        <?php if (count($menu_tintucs) > 0): ?>
                                            <?php foreach ($menu_tintucs as $item): ?>
                                                <li><a href="<?php echo base_url('tin-tuc/'.$item->loaitintuc_slug); ?>"><?php echo $item->loaitintuc_name; ?></a></li>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </ul>
                                </li>
                                <li><a href="<?php echo base_url('lien-he'); ?>">Liên hệ</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <?php echo $content_for_layout; ?>
    <footer id="footer-area" class="home__2 overlay">
        <div class="footer-widget section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="single-widget-wrap">
                            <div class="widget-title">
                                <h5>Giới thiệu</h5>
                            </div>
                            <div class="widget-body">
                                <p>Chúng Tôi luôn tự hào là doanh nghiệp đi đầu trong việc in ấn và sáng tạo mẫu cho người Việt trong nhiều năm qua. Hiện tại chúng Tôi đã có rất nhiều mẫu bao lì xì với thiết kế đẹp mắt. Quý khách hàng cũng hoàn toàn có thể đặt in riêng bao lì xì theo theo phong cách của mình. Cảm ơn bạn đã tin tưởng chúng tôi!</p>
                                <div class="footer-icons">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                    <a href="#"><i class="fa fa-reddit"></i></a>
                                    <a href="#"><i class="fa fa-digg"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-widget-wrap">
                            <div class="widget-title">
                                <h5>BẠN CẦN BIẾT?</h5>
                            </div>
                            <div class="widget-body">
                                <ul class="footer-list">
                                    <?php if (count($chinhsachs) > 0): ?>
                                        <?php foreach ($chinhsachs as $item): ?>
                                            <li><a href="<?php echo base_url('chinh-sach/'.$item->slug); ?>"><?php echo $item->title; ?></a></li>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-widget-wrap">
                            <div class="widget-title">
                                <h5>Yêu cầu báo giá nhanh</h5>
                            </div>
                            <div class="widget-body">
                                <div class="footer-form">
                                    <form method="post" id="form-info-kh" action="<?php echo base_url('yeu-cau-dat-hang'); ?>">
                                        <div class="alert" id="message_info" style="display: none;"></div>
                                        <input type="text" name="fullname" placeholder="Tên bạn">
                                        <input type="email" name="email" placeholder="Email">
                                        <input type="text" name="phone" placeholder="Số điện thoại">
                                        <button class="quote-btn" type="submit"><i class="fa fa-send"></i> Gửi</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="copyright-text">
                            <p>Hệ thống website in bao lì xì 2019</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="scroll-top home__2">
        <i class="fa fa-angle-double-up"></i>
    </div>
    <script src="<?php echo base_url(); ?>public/assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url(); ?>public/assets/js/jquery-migrate.min.js"></script>
    <script src="<?php echo base_url(); ?>public/assets/js/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>public/assets/js/plugins/owl.carousel.min.js"></script>
    <script src="<?php echo base_url(); ?>public/assets/js/plugins/owl-carousel-thumb.js"></script>
    <script src="<?php echo base_url(); ?>public/assets/js/plugins/waypoints.min.js"></script>
    <script src="<?php echo base_url(); ?>public/assets/js/plugins/counterup.min.js"></script>
    <script src="<?php echo base_url(); ?>public/assets/js/plugins/jquery.slicknav.min.js"></script>
    <script src="<?php echo base_url(); ?>public/assets/js/main.js"></script>
</body>
</html>
