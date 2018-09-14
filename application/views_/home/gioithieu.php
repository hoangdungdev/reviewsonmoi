<div class="content">
    <div class="single-post">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-8 col-xs-12">
                    <div class="blog-main">
                        <?php if (count($list_news) > 0): ?>
                            <?php foreach ($list_news as $item): ?>
                                <div class="post">
                                    <div class="post-header">
                                        <a class="category" href="<?php echo base_url('gioi-thieu/'.$item->loaitintuc_slug); ?>"><?php echo $item->loaitintuc_name; ?></a>
                                        <h4><a href="<?php echo base_url('gioi-thieu/'.$item->slug); ?>"><?php echo $item->title; ?></a></h4>
                                        <span><?php echo $item->created; ?></span>
                                    </div>
                                    <div class="post-content">
                                        <div class="col-md-3 col-xs-12">
                                            <a class="featured-img" href="<?php echo base_url('gioi-thieu/'.$item->slug); ?>">
                                                <img src="<?php echo base_url('upload/gioithieu/'.$item->image); ?>" alt="<?php echo $item->meta_title; ?>"/></a>
                                        </div>
                                        <div class="col-md-9 col-xs-12">
                                            <p class="text-justify"><?php echo word_limiter(strip_tags($item->description),150); ?></p>
                                            <div class="read-more">
                                                <a class="pull-left" href="<?php echo base_url('gioi-thieu/'.$item->slug); ?>">
                                                    <span>Xem chi tiết</span>
                                                    <i class="fa fa-long-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            <?php endforeach ?>
                        <?php endif ?>
                        <div class="page-nav">
                            <div class="page-next">
                                <div class="read-more text-center">
                                    <ul class="pagination">
                                        <?php echo $this->pagination->create_links();?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 col-xs-12">
                    <div class="sidebar">
                        <div class="widget">
                            <h4 class="title-widget">
                                <span>Bạn có thể xem</span>
                            </h4>
                            <?php if (count($tintucs) > 0): ?>
                                <?php foreach ($tintucs as $item): ?>
                                    <div class="recent-post">
                                        <div class="post-thumb">
                                            <a href="<?php echo base_url('gioi-thieu/'.$item->loaitintuc_slug.'/'.$item->slug); ?>">
                                                <img src="<?php echo base_url('upload/tintuc/thumb/'.$item->image); ?>" alt="<?php echo $item->meta_title; ?>"/></a>
                                        </div>
                                        <div class="post-info">
                                            <h4><a href="<?php echo base_url('gioi-thieu/'.$item->loaitintuc_slug.'/'.$item->slug); ?>"><?php echo $item->title; ?></a></h4>
                                            <span><?php echo $item->created; ?></span>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            <?php endif ?>
                        </div>
                        <div class="widget">
                            <h4 class="title-widget">
                                <span>Tags</span>
                            </h4>
                            <div class="tags">
                                <ul>
                                    <?php if (count($tags) > 0): ?>
                                        <?php foreach ($tags as $item): ?>
                                            <li><a href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a></li>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </ul>
                            </div>
                        </div>
                        <div class="widget">
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
            </div>
        </div>
    </div>
</div>