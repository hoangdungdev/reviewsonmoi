
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
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
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/x.icon" href="<?php echo base_url('favicon.ico'); ?>">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/meanmenu.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/animate.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/owl.carousel.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap-touch-slider.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery-ui.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair+Display|Quicksand">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/responsive.css">
        <script src="<?php echo base_url(); ?>public/js/respond.js"></script>
        <script>
            <?php 
                if ($this->session->userdata('userlogin')) {
                    $info = $this->session->userdata('userlogin');
                    unset($info->password, $info->sex, $info->birthday, $info->created, $info->lastvisited, $info->params, $info->status);
                    $str = json_encode($info);
                    echo 'var userInfo = '.$str;
                }
            ?>
        </script>
    </head>
    <body>
        <header class="header">
            <div class="header-top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-7 col-xs-8">
                            <span class="email hidden-xs">
                                <i class="fa fa-envelope"></i> Email: <?php echo $config['site_mail']; ?>
                            </span>
                            <span class="phone">
                                <i class="fa fa-phone"></i> Điện thoại: <?php echo $config['site_hotline']; ?>
                            </span>
                        </div>
                        <div class="col-md-6 col-sm-5 col-xs-4">
                            <div class="cart">
                                <a href="<?php echo base_url('cart'); ?>" class="cart-link">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span class="number-cart"><?php echo $this->cart->total_items(); ?></span>
                                </a>
                            </div>
                            <div class="user hidden-xs">
                                <?php if ($this->session->userdata('userlogin')) { ?>
                                    <a class="user-link" href="<?php echo base_url(''); ?>"> <i class="fa fa-user"></i> Tài khoản</a>
                                    <ul>
                                        <li>
                                            <a href="<?php echo base_url('don-hang'); ?>"><i class="fa fa-list-ul"></i> Đơn hàng</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('thong-tin'); ?>"><i class="fa fa-shopping-cart"></i> Thông tin</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('doi-mat-khau'); ?>"><i class="fa fa-user"></i> Đổi mật khẩu</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('thoat'); ?>"><i class="fa fa-sign-in"></i> Thoát</a>
                                        </li>
                                    </ul>
                                <?php } else { ?>
                                    <a class="user-link" href="<?php echo base_url('dang-nhap'); ?>"> <i class="fa fa-user"></i> Đăng nhập</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-main">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 hidden-xs">
                            <div class="social-media">
                                <ul>
                                    <?php if (!empty($config['site_facebook'])): ?>
                                        <li class="i-facebook">
                                            <a href="<?php echo $config['site_facebook']; ?>"><i class="fa fa-facebook"></i></a>
                                        </li>
                                    <?php endif ?>
                                    <?php if (!empty($config['site_youtube'])): ?>
                                        <li class="i-youtube">
                                            <a href="<?php echo $config['site_youtube']; ?>"><i class="fa fa-youtube"></i></a>
                                        </li>
                                    <?php endif ?>
                                    <?php if (!empty($config['site_instagram'])): ?>
                                        <li class="i-instagram">
                                            <a href="<?php echo $config['site_youtube']; ?>"><i class="fa fa-instagram"></i></a>
                                        </li>
                                    <?php endif ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="logo">
                                <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>public/img/logo.png"/></a>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="search">
                                <form id="searchform" method="get" action="<?php echo base_url('san-pham'); ?>">
                                    <input id="search" type="text" placeholder="Từ khóa ..." name="s"/>
                                    <button type="submit"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom">
                <div class="menu">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <nav class="main-menu visible-lg visible-md visible-sm">
                                    <ul>
                                        <li>
                                            <a href="<?php echo base_url(); ?>">TRANG CHỦ</a>
                                        </li>
                                        <li class="has-children">
                                            <a href="<?php echo base_url('gioi-thieu'); ?>">GIỚI THIỆU</a>
                                            <?php if (count($gioithieus) > 0): ?>
                                                <ul class="sub-menu">
                                                <?php foreach ($gioithieus as $item): ?>
                                                    <li>
                                                        <a href="<?php echo base_url('gioi-thieu/'.$item->slug); ?>"><?php echo $item->title; ?></a>
                                                    </li>    
                                                <?php endforeach ?>
                                                </ul>
                                            <?php endif ?>
                                        </li>
                                        <li class="has-children">
                                            <a href="<?php echo base_url('san-pham') ?>">SẢN PHẨM</a>
                                            <ul class="sub-menu">
                                                <?php if (count($menu_maus) > 0): ?>
                                                    <?php foreach ($menu_maus as $item): ?>
                                                        <li>
                                                            <a href="<?php echo base_url('danh-muc/'.$item->slug) ?>"><?php echo $item->name; ?></a>
                                                        </li>
                                                    <?php endforeach ?>
                                                <?php endif ?>
                                            </ul>
                                        </li>
                                        <li class="has-children">
                                            <a href="<?php echo base_url('tin-tuc'); ?>">TIN TỨC</a>
                                            <ul class="sub-menu">
                                                <?php if (count($menu_tintucs) > 0): ?>
                                                    <?php foreach ($menu_tintucs as $item): ?>
                                                        <li>
                                                            <a href="<?php echo base_url('tin-tuc/'.$item->loaitintuc_slug); ?>"><?php echo $item->loaitintuc_name; ?></a>
                                                        </li>
                                                    <?php endforeach ?>
                                                <?php endif ?>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('khuyen-mai'); ?>">KHUYẾN MÃI</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('lien-he'); ?>">LIÊN HỆ</a>
                                        </li>
                                        <li class="has-children">
                                            <a>CHÍNH SÁCH</a>
                                            <?php if (count($chinhsachs) > 0): ?>
                                                <ul class="sub-menu">
                                                <?php foreach ($chinhsachs as $item): ?>
                                                    <li>
                                                        <a href="<?php echo base_url('chinh-sach/'.$item->slug); ?>"><?php echo $item->title; ?></a>
                                                    </li>    
                                                <?php endforeach ?>
                                                </ul>
                                            <?php endif ?>
                                        </li>
                                    </ul>
                                </nav>
                                <div class="mobile-menu visible-xs">
                                    <nav>
                                        <ul>
                                            <li>
                                                <a href="<?php echo base_url(); ?>">TRANG CHỦ</a>
                                            </li>
                                            <li class="has-children">
                                                <a href="<?php echo base_url('gioi-thieu'); ?>">GIỚI THIỆU</a>
                                                <?php if (count($gioithieus) > 0): ?>
                                                    <ul class="sub-menu">
                                                    <?php foreach ($gioithieus as $item): ?>
                                                        <li>
                                                            <a href="<?php echo base_url('gioi-thieu/'.$item->slug); ?>"><?php echo $item->title; ?></a>
                                                        </li>    
                                                    <?php endforeach ?>
                                                    </ul>
                                                <?php endif ?>
                                            </li>
                                            <li class="has-children">
                                                <a href="<?php echo base_url('san-pham') ?>">SẢN PHẨM</a>
                                                <ul class="sub-menu">
                                                    <?php if (count($menu_maus) > 0): ?>
                                                        <?php foreach ($menu_maus as $item): ?>
                                                            <li>
                                                                <a href="<?php echo base_url('danh-muc/'.$item->slug) ?>"><?php echo $item->name; ?></a>
                                                            </li>
                                                        <?php endforeach ?>
                                                    <?php endif ?>
                                                </ul>
                                            </li>
                                            <li class="has-children">
                                                <a href="<?php echo base_url('tin-tuc'); ?>">TIN TỨC</a>
                                                <ul class="sub-menu">
                                                    <?php if (count($menu_tintucs) > 0): ?>
                                                        <?php foreach ($menu_tintucs as $item): ?>
                                                            <li>
                                                                <a href="<?php echo base_url('tin-tuc/'.$item->loaitintuc_slug); ?>"><?php echo $item->loaitintuc_name; ?></a>
                                                            </li>
                                                        <?php endforeach ?>
                                                    <?php endif ?>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url('khuyen-mai'); ?>">KHUYẾN MÃI</a>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url('lien-he'); ?>">LIÊN HỆ</a>
                                            </li>
                                            <li class="has-children">
                                                <a>CHÍNH SÁCH</a>
                                                <?php if (count($chinhsachs) > 0): ?>
                                                    <ul class="sub-menu">
                                                    <?php foreach ($chinhsachs as $item): ?>
                                                        <li>
                                                            <a href="<?php echo base_url('chinh-sach/'.$item->slug); ?>"><?php echo $item->title; ?></a>
                                                        </li>    
                                                    <?php endforeach ?>
                                                    </ul>
                                                <?php endif ?>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <?php echo $content_for_layout; ?>
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="contact">
                            <h4 class="title-footer"><span>Thông tin liên hệ</span></h4>
                            <ul>
                                <li><i class="fa fa-map-marker"></i><span>Địa chỉ: </span> <?php echo $config['site_address']; ?></li>
                                <li><i class="fa fa-phone"></i><span>Điện thoại: </span> <?php echo $config['site_phone']; ?></li>
                                <li><i class="fa fa-envelope"></i><span>Email: </span> <?php echo $config['site_mail']; ?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="subscribe">
                            <h4>ĐỂ LẠI THÔNG TIN</h4>
                            <div class="subscribe-form">
                                <p>Nhận tư vấn tận tình từ đội ngũ tư vấn</p>
                                <div class="alert" id="message_info" style="display: none;"></div>
                                <form method="post" id="form-info-kh" action="<?php echo base_url('nhan-mail'); ?>">
                                    <input type="text" name="email" placeholder="Email ..." />
                                    <button type="submit">Gửi</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="tags">
                            <h4 class="title-footer"><span>Liên kết nhanh</span></h4>
                            <ul>
                                <?php if (count($tags) > 0): ?>
                                    <?php foreach ($tags as $item): ?>
                                        <li><a href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a></li>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="text-center">
                                <p>&copy; 2018 Bản quyền thuộc về A&P Collection.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <div class="scroll-top-wrapper">
            <span class="scroll-top-inner">
                <i class="fa fa-long-arrow-up"></i>
            </span>
        </div>
        <script src="<?php echo base_url(); ?>public/js/jquery-3.2.1.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery-ui.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.meanmenu.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.countdown.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/mixitup.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.scroll-up.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.quantity.js"></script>
        <script src="<?php echo base_url(); ?>public/js/owl.carousel.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/bootstrap-touch-slider.js"></script>
        <script src="<?php echo base_url(); ?>public/js/scripts.js"></script>
        <script>
            $(document).ready(function() {
                $("form#form-info-kh").submit(function(e) {
                    e.preventDefault();
                    var email = $("form#form-info-kh [name='email']").val();
                    $.ajax({
                        type: "POST",
                        url: $(this).attr("action"),
                        data: {
                            email: email
                        },
                        dataType: "json",
                        success: function(e) {
                            var message_info = $("#message_info");
                            "000" == e.code ? (
                                message_info.text(e.message), 
                                message_info.removeClass("alert-danger"), 
                                message_info.addClass("alert-success")) : (
                                    message_info.text(e.message), 
                                    message_info.removeClass("alert-success"), 
                                    message_info.addClass("alert-danger")), 
                                message_info.show().delay(3200).fadeOut(300)
                        },
                        error: function() {
                            alert("Đã có lỗi xảy ra")
                        },
                        complete: function() {
                            $("form#form-info-kh [name='email']").val("");
                        }
                    });
                });
                $('#userInfo').change(function() {
                    if($(this).is(":checked")) {
                        $('#fullname').val(userInfo.name);
                        $('#phone').val(userInfo.phone);
                        $('#email').val(userInfo.email);
                        $('#address').val(userInfo.address);
                    } else {
                        $("#formInfo")[0].reset();
                    }       
                });
                $(".colordp").on("click",function(){
                    var datahref = $("#sp_add").attr('href');
                    var dataid = $(this).attr("dataid");
                    if (datahref.indexOf('color=') >= 0) {
                        datahref = datahref.replace(/\bcolor=[^&#]+/g, "color=" + dataid);
                    } else {
                        datahref += "&color="+dataid;
                    }
                    $('#sp_add').attr({href: datahref});
                    var clase = $(this).attr("class");
                    $("." + clase).removeClass("active");
                    $(this).addClass("active");
                    $('.colorid').hide();
                    $('#colorid_'+dataid).show();
                });
                $(".sizedp").on("click",function(){
                    var datahref = $("#sp_add").attr('href');
                    var dataid = $(this).attr("dataid");
                    if (datahref.indexOf('size=') >= 0) {
                        datahref = datahref.replace(/\bsize=[^&#]+/g, "size=" + dataid);
                    } else {
                        datahref += "&size="+dataid;
                    }
                    $('#sp_add').attr({href: datahref});
                    var clase = $(this).attr("class");
                    $("." + clase).removeClass("active");
                    $(this).addClass("active");
                });
                $('#sp_add').click(function(e) {
                    e.preventDefault();
                    var datahref = $(this).attr('href');
                    if (datahref.indexOf('size=') == -1) {
                        var size = $('.sizedp.active').attr('dataid');
                        datahref += "&size="+size;
                    }
                    if (datahref.indexOf('color=') == -1) {
                        var color = $('.colordp.active').attr('dataid');
                        datahref += "&color="+color;
                    }
                    if (datahref.indexOf('qty=') == -1) {
                        datahref += "&qty="+1;
                    }
                    window.location.href = datahref;
                });
                $("input[name='payment'][value='1']").click(function(e) {
                    $('#showbank').show();
                });
                $("input[name='payment'][value='0']").click(function(e) {
                    $('#showbank').hide();
                });
            }); 
            function _quanhuyen(val){
                $.ajax({
                    url: '<?php echo base_url("cart/quanhuyen"); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        pid: val
                    }
                }).done(function(result) {
                    var strResult = '';
                    if (result.data.length > 0) {
                        result.data.map(function(item){
                            strResult += '<option value="'+item.id+'">'+item.name+'</option>';
                        });
                    }else{
                        strResult += '<option value="">Chọn quận/huyện</option>';
                    }
                    $('select[name="quanhuyen"]').html(strResult);
                });
            }
        </script>
    </body>
</html>