<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content="Perennial is new Html theme that we have designed to help you transform your store into a beautiful online showroom. This is a fully responsive Html theme, with multiple versions for homepage and multiple templates for sub pages as well" />
    <meta name="keywords" content="Perennial,7uptheme" />
    <meta name="robots" content="noodp,index,follow" />
    <meta name='revisit-after' content='1 days' />
    <title>Thuốc mọc mi</title>
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,500,600,700%7cLobster" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/libs/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/libs/bootstrap-theme.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/libs/ionicons.min.css"/>
    <style>
        <?php echo file_get_contents(base_url('public/css/dp.css'));?>
    </style>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/thememini.css"/>
</head>
<body class="preload">
<div class="wrap">
    <header id="header">
        <div class="header">
            <div class="top-header bg-color top-header2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <ul class="info-account list-inline-block pull-right">
                                <li><a href="#" class="white"><span><i class="fa fa-user-o"></i></span>Đăng ký tài khoản</a></li>
                                <li><a href="#" class="white"><span><i class="fa fa-check-circle-o"></i></span>Thanh toán</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Top Header -->
            <div class="main-header3 bg-white header-ontop">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="logo logo15 pull-left">
                                <a href="<?php echo base_url(); ?>">
                                    <h2 class="title48 lob-font color2"><i class="icon color fa fa-eye"></i>Nutraluxe MD</h2></a>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-12 col-xs-12">
                            <nav class="main-nav main-nav3 pull-left">
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>">Trang chủ</a></li>
                                    <li><a href="about.html">Giới thiệu</a></li>
                                    <li><a href="about.html">Đại lý</a></li>
                                    <li class="menu-item-has-children">
                                        <a href="index.html">Sản phẩm</a>
                                        <ul class="sub-menu">
                                            <li><a href="home-01.html">Home Style 01</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="<?php echo base_url('tin-tuc'); ?>">Tin tức</a>
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
                                    <li><a href="<?php echo base_url('lien-he'); ?>">Liên hệ</a></li>
                                </ul>
                                <a href="#" class="toggle-mobile-menu"><span></span></a>
                            </nav>
                            <ul class="list-inline-block pull-right search-cart3">
                                <li>
                                    <div class="mini-cart-box mini-cart3 pull-right">
                                        <a class="mini-cart-link" href="cart.html">
                                            <span class="mini-cart-icon title18 color2"><i class="fa fa-shopping-basket"></i></span>
                                            <span class="mini-cart-number bg-color white">2</span>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Main Header -->
        </div>
    </header>
    <!-- End Header -->
    <section id="content">
        <div class="container">
            <?php echo $content_for_layout; ?>
        </div>
    </section>
    <!-- End Content -->
    <footer id="footer">
        <div class="footer2 footer14 box-parallax">
            <div class="container">
                <div class="main-footer2">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="footer-box2">
                                <h2 class="title18 font-bold color">Thuốc mọc mi Nutraluxe Lash MD</h2>
                                <p class="desc white"><i class="fa fa-check" aria-hidden="true"></i> Là nhà phân phối Nutra Luxe Lash MD chính hãng tại Việt Nam</p>
                                <p class="desc white"><i class="fa fa-check" aria-hidden="true"></i> Đối tác tin cậy của nhà sản xuất hàng đầu tại Mỹ.</p>
                                <p class="desc white"><i class="fa fa-check" aria-hidden="true"></i> Có giấy chứng nhận lưu hành của Bộ Y Tế.</p>
                                <p class="desc white"><i class="fa fa-check" aria-hidden="true"></i> Cam kết <strong class="color">100%</strong> hàng chính hãng.</p>
                                <p class="desc white"><i class="fa fa-check" aria-hidden="true"></i> Nutra Luxe Lash MD được chiết xuất tự nhiên, đảm bảo độ tinh khiết và an toàn cho sức khỏe.</p>
                            </div> 
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="footer-box2">
                                <h2 class="title18 font-bold color">Thông Tin Shop</h2>
                                <div class="contact-footer2">
                                    <p class="desc white"><span class="color"><i class="fa fa-map-marker" aria-hidden="true"></i></span> <?php echo $config['site_address']; ?></p>
                                    <p class="desc white"><span class="color"><i class="fa fa-phone" aria-hidden="true"></i></span><?php echo $config['site_hotline']; ?></p>
                                    <p class="desc white"><span class="color"><i class="fa fa-envelope" aria-hidden="true"></i></span><a href="mailto:<?php echo $config['site_mail']; ?>" class="white"><?php echo $config['site_mail']; ?></a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="footer-box2">
                                <h2 class="title18 font-bold color">Đăng Ký Email</h2>
                                <p class="white">Nhận tin khuyến mãi hấp dẫn</p>
                                <div class="alert" id="message_info" style="display: none;"></div>
                                <form class="email-form2" id="form-info-kh" action="<?php echo base_url('nhan-mail'); ?>" method="post">
                                    <input onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''" placeholder="Vui lòng nhập Email..." type="text" name="email">
                                    <input type="submit" value="Gửi">
                                </form>
                            </div>
                            <div class="social-network footer-box2">
                                <h2 class="title18 font-bold color">Kết nối với Chúng Tôi</h2>
                                <a href="#" class="float-shadow"><img src="<?php echo base_url(); ?>public/images/icon/icon-fb.png" alt=""></a>
                                <a href="#" class="float-shadow"><img src="<?php echo base_url(); ?>public/images/icon/icon-tw.png" alt=""></a>
                                <a href="#" class="float-shadow"><img src="<?php echo base_url(); ?>public/images/icon/icon-pt.png" alt=""></a>
                                <a href="#" class="float-shadow"><img src="<?php echo base_url(); ?>public/images/icon/icon-gp.png" alt=""></a>
                                <a href="#" class="float-shadow"><img src="<?php echo base_url(); ?>public/images/icon/icon-ig.png" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Main Footer -->
                <div class="logo-footer2 logo logo1">
                    <a href="index.html" class="bg-color"><h1 class="title18 white lob-font"><i class="icon fa fa-eye"></i>NUTRALUXE</h1></a>
                </div>
                <div class="bottom-footer2 text-center">
                    <p class="copyright2 desc white">Bản quyền thuộc về Thuốc mọc dài mi @Copyright 2018</p>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->
    <a href="#" class="scroll-top round"><i class="fa fa-angle-double-up" aria-hidden="true"></i></a>
    <div id="loading">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <div class="object" id="object_four"></div>
                <div class="object" id="object_three"></div>
                <div class="object" id="object_two"></div>
                <div class="object" id="object_one"></div>
            </div>
        </div>
    </div>
    <!-- End Preload -->
</div>
<script src="<?php echo base_url(); ?>public/js/libs/jquery-3.2.1.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/libs/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/libs/jquery.fancybox.js"></script>
<script src="<?php echo base_url(); ?>public/js/libs/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/libs/owl.carousel.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/libs/jquery.jcarousellite.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/libs/jquery.elevatezoom.js"></script>
<script src="<?php echo base_url(); ?>public/js/libs/jquery.mCustomScrollbar.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/libs/slick.js"></script>
<script src="<?php echo base_url(); ?>public/js/libs/modernizr.custom.js"></script>
<script src="<?php echo base_url(); ?>public/js/libs/jquery.hoverdir.js"></script>
<script src="<?php echo base_url(); ?>public/js/libs/wow.js"></script>
<script src="<?php echo base_url(); ?>public/js/theme.js"></script>
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
        $("form#form-review-kh").submit(function(e) {
            e.preventDefault();
            var name = $("form#form-review-kh [name='name']").val();
            var email = $("form#form-review-kh [name='email']").val();
            var rating = $("form#form-review-kh [name='rating']:checked").val();
            var content = $("form#form-review-kh [name='content']").val();
            var id_product = $("form#form-review-kh [name='id_product']").val();
            var name_product = $("form#form-review-kh [name='name_product']").val();
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: {
                    name: name,
                    email: email,
                    rating: rating,
                    content: content,
                    id_product: id_product,
                    name_product: name_product
                },
                dataType: "json",
                success: function(e) {
                    var message_info = $("#review_info");
                    "000" == e.code ? (
                        message_info.text(e.message), 
                        message_info.removeClass("alert-danger"), 
                        message_info.addClass("alert-success")) : (
                            message_info.text(e.message), 
                            message_info.removeClass("alert-success"), 
                            message_info.addClass("alert-danger")), 
                        message_info.show().delay(3200).fadeOut(300);
                        $("form#form-review-kh")[0].reset()
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
        // $('#sp_add').click(function(e) {
        //     e.preventDefault();
        //     var datahref = $(this).attr('href');
        //     if (datahref.indexOf('size=') == -1) {
        //         var size = $('.sizedp.active').attr('dataid');
        //         datahref += "&size="+size;
        //     }
        //     if (datahref.indexOf('color=') == -1) {
        //         var color = $('.colordp.active').attr('dataid');
        //         datahref += "&color="+color;
        //     }
        //     if (datahref.indexOf('qty=') == -1) {
        //         datahref += "&qty="+1;
        //     }
        //     window.location.href = datahref;
        // });
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
<div class="hotline">
    <div id="phonering-alo-phoneIcon" class="phonering-alo-phone phonering-alo-green phonering-alo-show">
        <div class="phonering-alo-ph-circle"></div>
        <div class="phonering-alo-ph-circle-fill"></div>
        <div class="phonering-alo-ph-img-circle"><a class="pps-btn-img" title="Liên hệ qua số điện thoại" href="tel:<?php echo str_replace('.','', $config['site_hotline']); ?>"><img src="<?php echo base_url('public/images/phone.png') ?>" alt="Liên hệ" width="50" class="img-responsive"/></a></div>
    </div>
</div>
</body>
</html>