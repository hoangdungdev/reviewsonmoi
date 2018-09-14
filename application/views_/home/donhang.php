<div class="content">
    <div class="wishlist">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="wishlist-inner">
                        <div class="checkout text-center">
                            <h4>Thông tin đơn hàng</h4>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th class="hidden-xs">STT</th>
                                    <th class="hidden-xs">Ngày đặt</th>
                                    <th>Tên người đặt</th>
                                    <th>Điện thoại</th>
                                    <th class="hidden-xs">Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Mã Đơn hàng</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; foreach ($dataset as $row): ?>
                                <tr>
                                    <th class="hidden-xs"><?php echo $i;$i++; ?></th>
                                    <th class="hidden-xs">
                                        <?php echo $row->created;?>
                                    </th>
                                    <th>
                                        <?php echo $row->name;?>
                                    </th>
                                    <th class="hidden-xs">
                                        <?php echo $row->phone;?>
                                    </th>
                                    <th>
                                        <?php echo number_format($row->total_order).' đ';?>
                                    </th>
                                    <th>
                                        <?php if($row->status == 1) echo '<span class="btn btn-danger">Chưa giao</span>';else if($row->status == -1) echo '<span class="btn btn-success">Đã giao</span>'?>
                                    </th>
                                    <th>
                                        <?php echo $row->id;?>
                                    </th>
                                    <th>
                                        <a href="<?php echo base_url('xem-don-hang/'.$row->id); ?>">Xem đơn hàng</a>
                                    </th>
                                </tr>
                                <?php endforeach;?>   
                            </tbody>
                        </table>
                        <div class="pagenation">
                            <ul>
                                <?php echo  $this->pagination->create_links(); ?> 
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>