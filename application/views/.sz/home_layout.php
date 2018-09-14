<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $config['site_name'];?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<meta content="<?php echo $config['site_name'];?>" name="title">
	<meta content="<?php echo $config['site_description'];?>" name="description">
	
	<link rel="icon" href="<?php echo base_url();?>public/images/f.png" type="image/x-icon">
	
    <link rel="stylesheet" href="<?php echo base_url();?>public/css/reset.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo base_url();?>public/css/style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo base_url();?>public/css/grid.css" type="text/css" media="screen">    
    <script src="<?php echo base_url();?>public/js/jquery-1.6.min.js" type="text/javascript"></script>  
    <script src="<?php echo base_url();?>public/js/jquery.easing.1.3.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>public/js/cufon-yui.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>public/js/cufon-replace.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>public/js/cufon-refresh.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>public/js/Bebas_400.font.js" type="text/javascript"></script>   
    <script src="<?php echo base_url();?>public/js/superfish.js" type="text/javascript"></script>         
    <script src="<?php echo base_url();?>public/js/tms-0.js" type="text/javascript"></script>      
    <script src="<?php echo base_url();?>public/js/tms_presets.js" type="text/javascript"></script> 
    <script src="<?php echo base_url();?>public/js/ColorPlugin.js" type="text/javascript"></script>     
    <script src="<?php echo base_url();?>public/js/script.js" type="text/javascript"></script>   
  	<!--[if lt IE 7]> 
		<div style=' clear: both; text-align:center; position: relative;'> <a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" alt="" /></a></div>  
	<![endif]-->
	<!--[if lt IE 9]>
		<script type="text/javascript" src="<?php echo base_url();?>public/js/html5.js"></script>
		<link rel="stylesheet" href="<?php echo base_url();?>public/css/ie.css" type="text/css" media="screen">
	<![endif]-->
</head>
<body id="page1"> 
<!--==============================header=================================-->
   	<header>	
    	<div class="main">
        	<div class="container">
                <nav>
                    <h1><a href="<?php echo site_url()?>"><img class="ks-logo" src="<?php echo base_url();?>public/images/ks-logo.png"/></a></h1>
					<h2 class="slim-address">Lô B 10, Đường N4, KCN Nam Tân Uyên, Xã Khánh Bình, Huyện Tân Uyên, Tỉnh Bình Dương, Việt Nam<br/>Hotline: <span style="color: #ff1e00">(+84) 6503 652 866 </span></h2>
                    <ul class="sf-menu">
                        <li><a href="<?php echo site_url()?>" class="active">Trang Chủ</a></li>
                        <li><a href="<?php echo site_url()?>gioi-thieu-cong-ty-kingstar">Giới Thiệu</a></li>
                        <li><a href="<?php echo site_url()?>product">Sản Phẩm</a>
                        	<ul>
								<?php foreach($products as $row):?>
									<li><a href="<?php echo site_url().'product/'.$row->slug?>"><?php echo $row->name?></a></li>
								<?php endforeach;?>
                            	
                            </ul>
                        </li>
                        <li><a href="<?php echo site_url()?>khach-hang">Khách Hàng</a></li>
                        <li><a href="<?php echo site_url()?>tuyen-dung ">Tuyển Dụng</a></li>
                        <li><a href="<?php echo site_url()?>contact">Liên Hệ</a></li>
                    </ul>
                    <div class="clear"></div>
                </nav>
                <div class="inner">
                    <div class="slider_box">
                        <div class="slider">
                        	<ul class="items">
                            	<li><img src="<?php echo base_url();?>public/images/page1_slide1.jpg" alt="" /></li>
                            	<li><img src="<?php echo base_url();?>public/images/page1_slide2.jpg" alt="" /></li>
                            	<li><img src="<?php echo base_url();?>public/images/page1_slide3.jpg" alt="" /></li>
                            	<li><img src="<?php echo base_url();?>public/images/page1_slide4.jpg" alt="" /></li>
                            	<li><img src="<?php echo base_url();?>public/images/page1_slide5.jpg" alt="" /></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
<!--==============================content================================-->
    <section id="content">
    	<div class="main">
        	<div class="container">
            	<div class="container_24">
					<?php echo $content_for_layout;?>
                </div>
            </div>
        </div>
    </section>
<!--==============================footer=================================-->
	<div class="inner">
        <footer>
        	<div>
        	<ul class="footer_menu">
            	<li><a href="#" class="active">Trang Chủ</a></li>
                <li><a href="#">Giới Thiệu</a></li>
                <li><a href="#">Sản Phẩm</a></li>
                <li><a href="#">Khách Hàng</a></li>
                <li><a href="#">Tuyển Dụng</a></li>
                <li><a href="#">Liên Hệ</a></li>
            </ul>
            King Star &copy; 2011 <a href="#">Privacy Policy</a>
            </div>
            <!-- {%FOOTER_LINK} -->
        </footer>
    </div>
<script type="text/javascript"> Cufon.now(); </script>
</body>
</html>
