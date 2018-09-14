<div class="content">
    <div class="shop">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="sidebar">
                        <div class="widget">
                            <h4 class="title-widget"><span>Danh mục</span></h4>
                            <div class="category-product">
                                <ul>
                                    <?php if (count($menu_maus) > 0): $category_model = new Category_model();?>
                                        <?php foreach ($menu_maus as $item): $cat_id = $item->id; 
                                            $menu_level2 = $category_model->getbyparent($cat_id);
                                        ?>
                                            <li class="menu_parent">
                                                <a href="<?php echo base_url('danh-muc/'.$item->slug) ?>"><?php echo $item->name; ?></a>
                                                <?php if (count($menu_level2) > 0): ?>
                                                <ul class="menu_child">
                                                    <?php foreach ($menu_level2 as $item2): ?>
                                                        <li>
                                                            <a href="<?php echo base_url('danh-muc/'.$item2->slug) ?>">
                                                                <i class="fa fa-long-arrow-right"></i> <?php echo $item2->name; ?></a>
                                                        </li>
                                                    <?php endforeach ?>
                                                </ul>
                                                <?php endif ?>
                                            </li>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </ul>
                            </div>
                        </div>
                        <div class="widget hidden-xs">
                            <h4 class="title-widget">
                                <span>Bạn có thể xem</span>
                            </h4>
                            <?php if (count($tintucs) > 0): ?>
                                <?php foreach ($tintucs as $item): ?>
                                    <div class="recent-post">
                                        <div class="post-thumb">
                                            <a href="<?php echo base_url('tin-tuc/'.$item->loaitintuc_slug.'/'.$item->slug); ?>">
                                                <img src="<?php echo base_url('upload/tintuc/thumb/'.$item->image); ?>" alt="<?php echo $item->meta_title; ?>"/></a>
                                        </div>
                                        <div class="post-info">
                                            <h4><a href="<?php echo base_url('tin-tuc/'.$item->loaitintuc_slug.'/'.$item->slug); ?>"><?php echo $item->title; ?></a></h4>
                                            <span><?php echo $item->created; ?></span>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            <?php endif ?>
                        </div>
                        <div class="widget hidden-xs">
                            <h4 class="title-widget">
                                <span>Fanpage</span>
                            </h4>
                            <div class="archive">
                                <div id="fb-root"></div>
                                <script>(function(d, s, id) {
                                  var js, fjs = d.getElementsByTagName(s)[0];
                                  if (d.getElementById(id)) return;
                                  js = d.createElement(s); js.id = id;
                                  js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.1';
                                  fjs.parentNode.insertBefore(js, fjs);
                                }(document, 'script', 'facebook-jssdk'));</script>
                                <div class="fb-page" data-href="https://www.facebook.com/AP-Collection-533582713707504/" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/AP-Collection-533582713707504/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/AP-Collection-533582713707504/">A&amp;P Collection</a></blockquote></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <div class="shop-inner">
                        <div class="shop-product tab-content">
                            <div class="tab-pane fade active" id="th">
                                <div class="row">
                                    <?php if (count($products) > 0): ?>
                                        <?php foreach ($products as $item): $sale = $item->price -($item->price*($item->price_sale/100));?>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
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
                                                        <h4 class="product-name"><a href="<?php echo base_url('san-pham/'.$item->slug); ?>"><?php echo $item->name; ?></a></h4>
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