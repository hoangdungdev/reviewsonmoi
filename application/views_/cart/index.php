<div class="content">
    <?php if (isset($cart) && count($cart) > 0) { ?>
    <div class="wishlist">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="wishlist-inner">
                        <form method="post" action="<?php echo site_url()?>cart/update">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="hidden-xs">STT</th>
                                        <th class="hidden-xs">Ảnh</th>
                                        <th>Tên sản phẩm</th>
                                        <th class="hidden-xs">Đơn giá</th>
                                        <th width="180">Số lượng</th>
                                        <th>Tổng giá</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; foreach ( $cart as $row): ?>
                                    <tr>
                                        <th class="hidden-xs"><?php echo $i;$i++; ?></th>
                                        <th class="hidden-xs">
                                            <img src="<?php echo base_url('upload/product/home/'.$row['options']['image']); ?>" title="<?php echo $row['name']?>" class="img-responsive center-block"  style="width: 80px;">
                                        </th>
                                        <th>
                                            <a href="<?php echo base_url("san-pham/".$row['options']['slug']).'?size='.$row['options']['idsize'].'&color='.$row['options']['idcolor'] ?>" title="<?php echo $row['name']?>">
                                                <?php echo $row['name']?>
                                            </a>
                                            <?php if (!empty($row['options']['title_size'])): ?>
                                            <p>Size: <?php echo $row['options']['title_size']?></p>
                                            <?php endif ?>
                                            <?php if (!empty($row['options']['img_color'])): ?>
                                            <p>Màu sắc: <img style="width: 25px" src="<?php echo base_url('upload/mausac/thumb/'.$row['options']['img_color']) ?>"></p>
                                            <?php endif ?>
                                        </th>
                                        <th class="hidden-xs">
                                            <?php echo number_format($row['price'])?> đ
                                        </th>
                                        <th>
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default btn-number" data-type="minus" data-field="qty[<?php echo $row['rowid']?>]">
                                                        <span class="glyphicon glyphicon-minus"></span>
                                                    </button>
                                                </span>
                                                <input type="text" name="qty[<?php echo $row['rowid']?>]" class="form-control input-number" value="<?php echo $row['qty']?>" min="1" max="10" onkeypress="return isNumberKey(event)">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="qty[<?php echo $row['rowid']?>]">
                                                        <span class="glyphicon glyphicon-plus"></span>
                                                    </button>
                                                </span>
                                            </div>
                                        </th>
                                        <th>
                                            <?php echo number_format($row['subtotal'])?> đ
                                        </th>
                                        <th>
                                            <button type="submit" class="btn btn-info btn-xs btnUpdateItem"><i class="fa fa-refresh"></i></button>
                                            <a href="<?php echo site_url()?>cart/destroy?pid=<?php echo $row['rowid']?>" class="btn btn-warning btn-xs btnRemoveItem"><i class="fa fa-trash-o"></i></a>
                                        </th>
                                    </tr>
                                    <?php endforeach;?>   
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="checkout">
        <div class="container">
            <div class="row">
                <form action="<?php echo site_url()?>cart/checkout#bill-info" method="post" enctype="multipart/form-data" id="formInfo">
                <div class="col-sm-6 col-xs-12">
                    <div class="adress" id="bill-info">
                        <h4>Thông tin đơn hàng</h4>
                        <?php if ($this->session->userdata('userlogin')) { ?>
                            <div class="radio">
                                Sử dụng thông tin của bạn?
                                <input type="checkbox" id="userInfo">
                            </div>
                        <?php } else { ?>
                            <div class="cart-check text-left">
                                Bạn đã có tài khoản?
                                <a href="<?php echo base_url('dang-nhap'); ?>"> 
                                    <span>Đăng Nhập</span>
                                    <i class="fa fa-long-arrow-right"></i>
                                </a>
                            </div>
                        <?php } ?>
                        <div class="adress-inner">
                            <?php if (validation_errors()):?>
                                <div class="alert alert-danger" style="line-height:25px;font-size:16px;margin:5px;">
                                  <h4 style="color:red;font-weight:bold;font-size:20px;">* Thông báo lỗi</h4><br>
                                  <?php if (validation_errors()) echo validation_errors(' ','<br>'); ?>
                                </div>
                            <?php endif; ?>
                            <input type="text" name="fullname" id="fullname" value="<?php echo set_value('fullname');?>" placeholder="Họ tên*">
                            <input type="text" name="phone" id="phone" value="<?php echo set_value('phone');?>" placeholder="Điện thoại *">
                            <input type="email" name="email" id="email" value="<?php echo set_value('email');?>" placeholder="Email*">
                            <input type="text" name="organ" id="organ" value="<?php echo set_value('organ');?>" placeholder="Cơ quan">
                            <select name="tinhthanhpho" onchange="_quanhuyen(this.value);">
                                <?php if (count($tinhthanhphos) > 0): ?>
                                    <option value="">Chọn Tỉnh/Thành Phố</option>
                                    <?php foreach ($tinhthanhphos as $item): ?>
                                        <option value="<?php echo $item->id; ?>"><?php echo $item->name; ?></option>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </select>
                            <select name="quanhuyen">
                                <option value="">Chọn Quận/Huyện</option>
                            </select>
                            <input type="text" name="address" id="address" value="<?php echo set_value('address');?>" placeholder="Địa chỉ*">
                            <textarea id="content" name="content" placeholder="Ghi chú" maxlength="255"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="payment">
                        <h4>Số Tiền Thanh Toán</h4>
                        <div class="payment-total">
                            <form action="#">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Số tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>Tổng cộng</th>
                                            <th></span> <?php echo number_format($total)?> đ</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                        <div class="payment-pay">
                            <h4>Phương thức thanh toán</h4>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="payment" id="paymentcod" value="0" checked>
                                    Thanh toán COD (Nhận Hàng Trả Tiền)
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="payment" id="paymentbank" value="1">
                                     Chuyển khoản ngân hàng
                                </label>
                            </div>
                            <div id="showbank" class="payment-total">
                                <table>
                                    <?php if (count($banks) > 0): ?>
                                    <tbody>
                                        <?php foreach ($banks as $item): ?>
                                        <tr>
                                            <th><img style="width: 150px;" src="<?php echo base_url('upload/bank/'.$item->image); ?>"></th>
                                            <th>
                                                <p class="text-left"><span style="width: 100px;display: inline-block;">STK:</span><?php echo $item->title; ?></p>
                                                <p class="text-left"><span style="width: 100px;display: inline-block;">Chủ TK:</span><?php echo $item->name; ?></p>
                                                <p class="text-left"><span style="width: 100px;display: inline-block;">Chi Nhánh:</span><?php echo $item->position; ?></p>
                                            </th>
                                        </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                    <?php endif ?>
                                </table>
                            </div>
                        </div>
                        <div class="cart-check">
                            <input type="submit" value="Thanh toán" class="btn btn-success btn-lg">
                            <a href="<?php echo base_url(); ?>"> 
                                <span>MUA HÀNG TIẾP</span>
                                <i class="fa fa-long-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php } else { ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="alert alert-success text-center">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong>GIỎ HÀNG CỦA BẠN (0 sản phẩm)!</strong> Giỏ hàng của bạn đang trống!
                    <a href="<?php echo base_url(); ?>" class="btn btn-danger btn-large"><i class="fa fa-arrow-circle-o-left"></i> Mua Hàng Ngay Nào</a>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>