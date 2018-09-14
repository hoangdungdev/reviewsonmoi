<div class="content">
    <div class="contact-us">
        <div class="container">
            <div class="row">
                <div class="col-sm-5 col-xs-12">
                    <div class="info-contact">
                        <ul>
                            <li><i class="fa fa-map-marker"></i> Địa chỉ: <?php echo $config['site_address']; ?> </li>
                            <li><i class="fa fa-phone"></i> Điện thoại: <?php echo $config['site_phone']; ?></li>
                            <li><i class="fa fa-envelope"></i>Email: <?php echo $config['site_mail']; ?></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-7 col-xs-12">
                    <div class="text-contact">
                        <h3>Thông tin liên hệ</h3>
                        <form id="contactForm" method="post" action="<?php echo base_url('lien-he#contactForm'); ?>">
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
                            <input type="text" name="fullname" placeholder="Họ tên*">
                            <input type="text" name="email" placeholder="Email*">
                            <input type="text" name="phone" placeholder="Điện thoại*">
                            <input type="text" name="address" placeholder="Địa chỉ*">
                            <textarea name="content" placeholder="Nội dung yêu cầu*"></textarea>
                            <div class="send">
                                <input type="submit" value="Gửi thông tin" name="submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3917.1658398960526!2d106.83806081388941!3d10.950842358946655!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3174dfe04f5c3ccb%3A0x63a32b19bdd83b25!2zMTIzIFbDtSBUaOG7iyBTw6F1LCBUaOG7kW5nIE5o4bqldCwgVGjDoG5oIHBo4buRIEJpw6puIEjDsmEsIMSQ4buTbmcgTmFpLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1531335915614" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>