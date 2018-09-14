<div class="page-title section-padding overlay">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="page-title-wrap">
                    <h1><?php echo $title; ?></h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb" itemprop="breadcrumb">
                            <li class="breadcrumb-item" itemtype="http://data-vocabulary.org/Breadcrumb" itemscope="">
                                <a href="<?php echo base_url(); ?>" itemprop="url"><span itemprop="title">Trang chủ</span></a></li>
                            <li class="breadcrumb-item active" aria-current="page" itemtype="http://data-vocabulary.org/Breadcrumb" itemscope="">
                                <a href="<?php echo current_url(); ?>" itemprop="url"><span itemprop="title">Thiết kế phong bao lì xì</span></a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<section id="blog-page-wrap" class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="sidebar-area">
                    <div class="single-sidebar">
                        <div class="sidebar-title">Mẫu Bao Lì Xì</div>
                        <div class="sidebar-body">
                            <ul class="sidebar-list">
                                <?php if (count($menu_maus) > 0): ?>
                                    <?php foreach ($menu_maus as $item): ?>
                                        <li><a href="<?php echo base_url('mau-bao-li-xi/'.$item->slug); ?>"><?php echo $item->name; ?></a></li>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </ul>
                        </div>
                    </div>
                    <div class="single-sidebar">
                        <div class="sidebar-title">Liên hệ</div>
                        <div class="sidebar-body">
                            <ul class="sidebar-list" style="overflow: hidden;">
                                <li class="clear">
                                    <div class="icon-contact"><i class="fa fa-mobile"></i></div> 
                                    <div class="text-contact"><?php echo $config['site_hotline']; ?> <br> <?php echo $config['site_phone']; ?></div>
                                </li>
                                <li class="clear">
                                    <div class="icon-contact"><i class="fa fa-phone"></i></div>
                                    <div class="text-contact">[Gửi yêu cầu qua Email] <br> <strong><?php echo $config['site_mail']; ?></strong></div>
                                </li>
                                <li class="clear">
                                    <div class="icon-contact"><i class="fa fa-calendar"></i></div>
                                    <div class="text-contact">Làm việc 8h đến 18h <br> Chủ nhật nghỉ</div>
                                </li>
                                <li>
                                    <p class="pcolor">Quý khách đến lấy hàng ngoài giờ vui lòng liên hệ trước. Xin cảm ơn</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="single-sidebar">
                        <div class="sidebar-title">Tin mới nhất</div>
                        <div class="sidebar-body">
                            <div class="recent-post">
                                <ul class="sidebar-list">
                                    <?php if (count($tintucs) > 0): ?>
                                        <?php foreach ($tintucs as $item): ?>
                                            <li>
                                                <a href="<?php echo base_url('tin-tuc/'.$item->loaitintuc_slug.'/'.$item->slug); ?>"><?php echo $item->title; ?></a>
                                                <p class="recent-post-date"><?php echo $item->created; ?></p>
                                            </li>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="single-sidebar">
                        <div class="sidebar-title">Hỗ trợ giao hàng</div>
                        <div class="sidebar-body">
                            <div class="recent-post">
                                <p>Chúng tôi sẽ giao hàng cho Quý Khách ở tại các khu vực: Quận 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, Gò Vấp, Tân Bình, Tân Phú, Bình Tân, Phú Nhuận, Bình Thạnh, Bình Dương, Dĩ An, Thủ Đức, Huyện Củ Chi, Huyện Hóc Môn, Huyện Bình Chánh, Huyện Nhà Bè, Huyện Cần Giờ, TP Hồ Chí Minh với chi phí SHIP tương ứng</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="singleblog-page-content">
                    <div><?php echo $title; ?></div>
                    <?php echo $dataset->content; ?>
                </div>
            </div>
        </div>
    </div>
</section>