<div class="content">
    <div class="wishlist">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="wishlist-inner">
                        <div class="checkout text-center">
                            <h4>Thông tin đặt hàng</h4>
                            <div class="payment-total">
                                <form action="#">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Thông tin</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>Họ tên</th>
                                                <th><?php echo $order->name?></th>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <th><?php echo $order->email?></th>
                                            </tr>
                                            <tr>
                                                <th>Address</th>
                                                <th><?php echo $order->address?></th>
                                            </tr>
                                            <tr>
                                                <th>Phone</th>
                                                <th><?php echo $order->phone?></th>
                                            </tr>
                                            <tr>
                                                <th>Nội dung</th>
                                                <th><?php echo $order->content?></th>
                                            </tr>
                                            <tr>
                                                <th>Trạng thái</th>
                                                <th><?php if($order->status == 1) echo '<span class="btn btn-danger">Chưa giao</span>';else if($order->status == -1) echo '<span class="btn btn-success">Đã giao</span>'?></th>
                                            </tr>
                                            <tr>
                                                <th colspan="2">
                                                    <a href="<?php echo base_url('don-hang'); ?>"> 
                                                        <span>Quay về trang đơn hàng</span>
                                                        <i class="fa fa-long-arrow-right"></i>
                                                    </a>
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                        <div class="checkout text-center">
                            <h4>Thông tin đơn hàng</h4>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th class="hidden-xs">STT</th>
                                    <th class="hidden-xs">Mã sản phẩm</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $stt = 0; foreach ($detail as $row): $stt ++;?>
                                <tr id=<?php echo $row->id;?>>
                                    <th><?php echo $stt;?></th>
                                    <th><?php echo $row->code;?></th>
                                    <th><?php echo $row->name;?></th>
                                    <th><?php echo $row->qty;?></th>
                                    <th><?php echo number_format($row->total);?></th>
                                </tr>
                                <?php endforeach?>
                            </tbody>
                        </table>
                        <div class="cart-check">
                            <a href="<?php echo base_url('san-pham'); ?>"> 
                                <span>Tiếp Tục Mua Hàng</span>
                                <i class="fa fa-long-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>