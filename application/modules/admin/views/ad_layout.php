<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link type="image/x-icon" href="<?php echo base_url();?>public/images/f.png" rel="icon">
	<title>DP Administrator</title>
	<link href="<?php echo base_url()?>media/css/sz-admin.css"	rel="stylesheet"/>
	<link href="<?php echo base_url()?>media/css/grid.css"	rel="stylesheet"/>
	<link href="<?php echo base_url()?>media/css/color-default.css"	rel="stylesheet"/>
	<script type="text/javascript"	src="<?php echo base_url()?>media/js/jquery.min.js"></script>
	<script type="text/javascript"	src="<?php echo base_url()?>media/js/jquery-ui-1.8.16.min.js"></script>
	<script type="text/javascript"	src="<?php echo base_url()?>media/js/jquery.hoverIntent.js"></script>
	<script type="text/javascript"	src="<?php echo base_url()?>media/js/jquery.easing.1.3.js"></script>
	<script type="text/javascript"	src="<?php echo base_url()?>media/js/superfish.js"></script>
	<script type="text/javascript"	src="<?php echo base_url()?>media/js/supersubs.js"></script>
	<script type="text/javascript"	src="<?php echo base_url()?>media/js/jquery.cookie.js"></script>
	<base href="<?php echo site_url();?>"/>
	<!-- Superfish Menu -->
	<script type="text/javascript">
		$(document).ready(function(){ 
			$("#admin-menu ul").superfish();
		}); 
	</script>
	<!-- Cookie -->
	<script type="text/javascript">
		$(document).ready(function(){
			$('#admin-menu').find('a[href="'+$.cookie('activeMenu')+'"]').parents('li.menu-top').addClass('active');
			$('#admin-menu a').click(function(){
				$.cookie('activeMenu', $(this).attr('href'),{ path: '/'});
				console.log($.cookie('activeMenu'));
			});
		}); 
	</script>
	<!-- Table -->
	<script type="text/javascript">
		$(document).ready(function(){
			$(".sz-grid tbody tr:visible:even",this).addClass("even"); 
			$(".sz-grid tbody tr:visible:odd",this).addClass("odd");
			
			$('.sz-grid tr').hover(
				function(){
					$(this).find('.action').css("visibility", "visible");
				},
				function(){
					$(this).find('.action').css("visibility", "hidden");
			});
			
			$("#blurcheck").click(function(){
				var checked_status = this.checked;
				$("input[name*=list]").each(function()
				{
				this.checked = checked_status;
				});
			}); 
		}); 
	</script>
	<!-- Hover states on the static widgets -->
	<script type="text/javascript">
		$(document).ready(function(){
			$('.ui-state-default').hover(
				function(){
					$(this).addClass('ui-state-hover');
				},
				function(){
					$(this).removeClass('ui-state-hover');
			});
		});
	</script>
	
</head>
<body>
	<div id="szwrap">
		<div id="szadminbar">
			<div id="sz-admin-bar">
				<ul id="sz-admin-bar-first" class="fl">
					<li id="sz-admin-bar-site" class="menupop">
						<a target="_blank" href="<?php echo site_url();?>" class="ab-item">
								Tới Trang Chủ
						</a>
					</li>
				</ul>
				<ul id="sz-admin-bar-second" class="fr">
					<li id="sz-admin-bar-account">
						<a href="<?php echo site_url().'dpadmin/auth/logout'?>">Chào, <?php echo $auth->username;?> (logout)</a>
					</li>
				</ul>
				<div class="clear"></div>
			</div>
		</div>
		<div id="admin-menu-wrap">
			<div id="admin-menu">
				<ul>
					<li class="menu-top">
						<a class="menu-top" href="<?php echo site_url();?>dpadmin/users">Người sử dụng</a>
					</li>
                    <li class="menu-top">
						<a class="menu-top">Slider chính</a>
						<ul class="sz-supmenu">
							<li><a href="<?php echo site_url();?>dpadmin/slider/add">Thêm mới</a></li>
							<li><a href="<?php echo site_url();?>dpadmin/slider">Danh sách</a></li>
						</ul>
					</li> 
					<li class="menu-top">
						<a class="menu-top" href="<?php echo site_url();?>dpadmin/banner">Banner dưới</a>
					</li>             
					<li class="menu-top">
						<a class="menu-top">Sản phẩm</a>
						<ul class="sz-supmenu">
							<li><a href="<?php echo site_url();?>dpadmin/product/add">Thêm mới</a></li>
							<li><a href="<?php echo site_url();?>dpadmin/product">Danh sách</a></li>
							<li class="current"><a href="<?php echo site_url();?>dpadmin/category">Danh mục</a></li>
						</ul>
					</li>
					<li class="menu-top">
						<a class="menu-top">Tin tức</a>
						<ul class="sz-supmenu">
							<li><a href="<?php echo site_url();?>dpadmin/tintuc/add">Thêm mới</a></li>
							<li><a href="<?php echo site_url();?>dpadmin/tintuc">Danh sách</a></li>
							<li class="current"><a href="<?php echo site_url();?>dpadmin/loaitintuc">Danh mục</a></li>
						</ul>
					</li>
					<li class="menu-top">
						<a class="menu-top">Giới thiệu</a>
						<ul class="sz-supmenu">
							<li><a href="<?php echo site_url();?>dpadmin/gioithieu/add">Thêm mới</a></li>
							<li><a href="<?php echo site_url();?>dpadmin/gioithieu">Danh sách</a></li>
						</ul>
					</li>
					<li class="menu-top">
						<a class="menu-top" href="<?php echo site_url();?>dpadmin/order">Đơn hàng</a>
					</li>
					<li class="menu-top">
						<a class="menu-top" href="<?php echo site_url();?>dpadmin/tags">Liên kết nhanh</a>
					</li>
					<li class="menu-top">
						<a class="menu-top" href="<?php echo site_url();?>dpadmin/contact">K/H Liên Hệ</a>
					</li>
					<li class="menu-top">
						<a class="menu-top" href="<?php echo site_url();?>dpadmin/chinhsach">Chính sách</a>
					</li>
					<li class="menu-top">
						<a class="menu-top" href="<?php echo site_url();?>dpadmin/recivemail">ĐK Mail</a>
					</li>
					<li class="menu-top">
						<a class="menu-top" href="<?php echo site_url();?>dpadmin/clientuser">Quản lý User</a>
					</li>
					<li class="menu-top">
						<a class="menu-top" href="<?php echo site_url();?>dpadmin/bank">Ngân hàng</a>
					</li>
					<li class="menu-top">
						<a class="menu-top">Cấu hình</a>
						<ul class="sz-supmenu">
							<li><a href="<?php echo site_url();?>dpadmin/config/site">Website</a></li>
							<li><a href="<?php echo site_url();?>dpadmin/config/meta">Meta</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
		<div id="admin-content-wrap">
			<div id="admin-content">
				<div class="wrap">
					<?php echo $content_for_layout;?>
				</div>
			</div>
		</div>
		<div id="footer">.
			<div id="footer-left" class="fl">DP Administrator</div>
			<div id="footer-right" class="fr">Design by DP</div>
		</div>
		<div class="clear"></div>
	</div>
</body>
</html>