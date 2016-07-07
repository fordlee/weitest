<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>微测试后台管理系统</title>
		<meta name="keywords" content="picture" />
		<meta name="description" content="picture" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<!-- basic styles -->
		<link href="__PUBLIC__/ace/assets/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="__PUBLIC__/ace/assets/css/font-awesome.min.css" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="__PUBLIC__/ace/assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!-- page specific plugin styles -->
		<!-- text fonts -->
		<link rel="stylesheet" href="__PUBLIC__/ace/assets/css/ace-fonts.css" />
		<link rel="stylesheet" href="__PUBLIC__/ace/assets/css/colorbox.css" />
		<!-- ace styles -->
		<link rel="stylesheet" href="__PUBLIC__/ace/assets/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />
		<!-- fonts -->

		<link rel="stylesheet" href="http://fonts.useso.com/css?family=Open+Sans:400,300" />

		<!-- ace styles -->

		<link rel="stylesheet" href="__PUBLIC__/ace/assets/css/ace.min.css" />
		<link rel="stylesheet" href="__PUBLIC__/ace/assets/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="__PUBLIC__/ace/assets/css/ace-skins.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="__PUBLIC__/ace/assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->

		<script src="__PUBLIC__/ace/assets/js/ace-extra.min.js"></script>

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]>
		<script src="__PUBLIC__/ace/assets/js/html5shiv.js"></script>
		<script src="__PUBLIC__/ace/assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>
		<div class="navbar navbar-default" id="navbar">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>

			<div class="navbar-container" id="navbar-container">
				<div class="navbar-header pull-left">
					<a href="#" class="navbar-brand">
						<small>
							<i class="icon-leaf"></i>
							微测试后台管理系统
						</small>
					</a><!-- /.brand -->
				</div><!-- /.navbar-header -->

				<div class="navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<li class="grey">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="icon-tasks"></i>
								<span class="badge badge-grey">4</span>
							</a>

							<ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="icon-ok"></i>
									还有4个任务完成
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left">软件更新</span>
											<span class="pull-right">65%</span>
										</div>

										<div class="progress progress-mini ">
											<div style="width:65%" class="progress-bar "></div>
										</div>
									</a>
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left">硬件更新</span>
											<span class="pull-right">35%</span>
										</div>

										<div class="progress progress-mini ">
											<div style="width:35%" class="progress-bar progress-bar-danger"></div>
										</div>
									</a>
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left">单元测试</span>
											<span class="pull-right">15%</span>
										</div>

										<div class="progress progress-mini ">
											<div style="width:15%" class="progress-bar progress-bar-warning"></div>
										</div>
									</a>
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left">错误修复</span>
											<span class="pull-right">90%</span>
										</div>

										<div class="progress progress-mini progress-striped active">
											<div style="width:90%" class="progress-bar progress-bar-success"></div>
										</div>
									</a>
								</li>

								<li>
									<a href="#">
										查看任务详情
										<i class="icon-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

						<li class="purple">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="icon-bell-alt icon-animated-bell"></i>
								<span class="badge badge-important">8</span>
							</a>

							<ul class="pull-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="icon-warning-sign"></i>
									8条通知
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-xs no-hover btn-pink icon-comment"></i>
												新闻评论
											</span>
											<span class="pull-right badge badge-info">+12</span>
										</div>
									</a>
								</li>

								<li>
									<a href="#">
										<i class="btn btn-xs btn-primary icon-user"></i>
										切换为编辑登录..
									</a>
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-xs no-hover btn-success icon-shopping-cart"></i>
												新订单
											</span>
											<span class="pull-right badge badge-success">+8</span>
										</div>
									</a>
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-xs no-hover btn-info icon-twitter"></i>
												粉丝
											</span>
											<span class="pull-right badge badge-info">+11</span>
										</div>
									</a>
								</li>

								<li>
									<a href="#">
										查看所有通知
										<i class="icon-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

						<li class="green">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="icon-envelope icon-animated-vertical"></i>
								<span class="badge badge-success">5</span>
							</a>

							<ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="icon-envelope-alt"></i>
									5条消息
								</li>

								<li>
									<a href="#">
										<img src="__PUBLIC__/ace/assets/avatars/avatar.png" class="msg-photo" alt="Alex's Avatar" />
										<span class="msg-body">
											<span class="msg-title">
												<span class="blue">Alex:</span>
												不知道写啥 ...
											</span>

											<span class="msg-time">
												<i class="icon-time"></i>
												<span>1分钟以前</span>
											</span>
										</span>
									</a>
								</li>

								<li>
									<a href="#">
										<img src="__PUBLIC__/ace/assets/avatars/avatar3.png" class="msg-photo" alt="Susan's Avatar" />
										<span class="msg-body">
											<span class="msg-title">
												<span class="blue">Susan:</span>
												不知道翻译...
											</span>

											<span class="msg-time">
												<i class="icon-time"></i>
												<span>20分钟以前</span>
											</span>
										</span>
									</a>
								</li>

								<li>
									<a href="#">
										<img src="__PUBLIC__/ace/assets/avatars/avatar4.png" class="msg-photo" alt="Bob's Avatar" />
										<span class="msg-body">
											<span class="msg-title">
												<span class="blue">Bob:</span>
												到底是不是英文 ...
											</span>

											<span class="msg-time">
												<i class="icon-time"></i>
												<span>下午3:15</span>
											</span>
										</span>
									</a>
								</li>

								<li>
									<a href="inbox.html">
										查看所有消息
										<i class="icon-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="__PUBLIC__/ace/assets/avatars/user.jpg" alt="Jason's Photo" />
								<span class="user-info">
									<small>欢迎光临,</small>
									Jason
								</span>

								<i class="icon-caret-down"></i>
							</a>

							<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="#">
										<i class="icon-cog"></i>
										设置
									</a>
								</li>

								<li>
									<a href="#">
										<i class="icon-user"></i>
										个人资料
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="#">
										<i class="icon-off"></i>
										退出
									</a>
								</li>
							</ul>
						</li>
					</ul><!-- /.ace-nav -->
				</div><!-- /.navbar-header -->
			</div><!-- /.container -->
		</div>

		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<div class="main-container-inner">
				<a class="menu-toggler" id="menu-toggler" href="#">
					<span class="menu-text"></span>
				</a>

				<div class="sidebar" id="sidebar">
					<script type="text/javascript">
						try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
					</script>

					<div class="sidebar-shortcuts" id="sidebar-shortcuts">
						<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
							<button class="btn btn-success">
								<i class="icon-signal"></i>
							</button>

							<button class="btn btn-info">
								<i class="icon-pencil"></i>
							</button>

							<button class="btn btn-warning">
								<i class="icon-group"></i>
							</button>

							<button class="btn btn-danger">
								<i class="icon-cogs"></i>
							</button>
						</div>

						<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
							<span class="btn btn-success"></span>

							<span class="btn btn-info"></span>

							<span class="btn btn-warning"></span>

							<span class="btn btn-danger"></span>
						</div>
					</div><!-- #sidebar-shortcuts -->

					<ul class="nav nav-list">
						<li class="active">
							<a href="<?php echo U('Index/index');?>">
								<i class="icon-dashboard"></i>
								<span class="menu-text"> 控制台 </span>
							</a>
						</li>

						<li>
							<a href="#" class="dropdown-toggle">
								<i class="icon-list"></i>
								<span class="menu-text"> 题库管理 </span>

								<b class="arrow icon-angle-down"></b>
							</a>

							<ul class="submenu">
								<li>
									<a href="<?php echo U('Question/questionlist');?>">
										<i class="icon-double-angle-right"></i>
										题库列表
									</a>
								</li>
								<li>
									<a href="<?php echo U('Question/questionentry');?>">
										<i class="icon-double-angle-right"></i>
										题库添加
									</a>
								</li>
							</ul>
						</li>

						<li>
							<a href="#" class="dropdown-toggle">
								<i class="icon-edit"></i>
								<span class="menu-text"> 账户管理 </span>

								<b class="arrow icon-angle-down"></b>
							</a>

							<ul class="submenu">
								<li>
									<a href="<?php echo U('Account/acclist');?>">
										<i class="icon-double-angle-right"></i>
										管理员列表
									</a>
								</li>
								<li>
									<a href="<?php echo U('Account/accadd');?>">
										<i class="icon-double-angle-right"></i>
										添加管理员
									</a>
								</li>
							</ul>
						</li>

						<li>
							<a href="gallery.html">
								<i class="icon-picture"></i>
								<span class="menu-text"> 相册 </span>
							</a>
						</li>
					</ul><!-- /.nav-list -->

					<div class="sidebar-collapse" id="sidebar-collapse">
						<i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
					</div>

					<script type="text/javascript">
						try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
					</script>
				</div>


<div class="main-content">
	<div class="breadcrumbs" id="breadcrumbs">
		<script type="text/javascript">
			try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
		</script>

		<ul class="breadcrumb">
			<li>
				<i class="icon-home home-icon"></i>
				<a href="#">Home</a>
			</li>
			<li class="active">Gallery</li>
		</ul><!-- .breadcrumb -->

		<div class="nav-search" id="nav-search">
			<form class="form-search">
				<span class="input-icon">
					<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
					<i class="icon-search nav-search-icon"></i>
				</span>
			</form>
		</div><!-- #nav-search -->
	</div>

	<div class="page-content">
		<div class="page-header">
			<h1>
				Gallery
				<small>
					<i class="icon-double-angle-right"></i>
					responsive photo gallery using colorbox
				</small>
			</h1>
		</div><!-- /.page-header -->

		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS -->

				<div class="row-fluid">
					<ul class="ace-thumbnails">
						<li>
							<a href="__PUBLIC__/ace/assets/images/gallery/image-1.jpg" title="Photo Title" data-rel="colorbox">
								<img alt="150x150" src="__PUBLIC__/ace/assets/images/gallery/thumb-1.jpg" />
								<div class="tags">
									<span class="label-holder">
										<span class="label label-info">breakfast</span>
									</span>

									<span class="label-holder">
										<span class="label label-danger">fruits</span>
									</span>

									<span class="label-holder">
										<span class="label label-success">toast</span>
									</span>

									<span class="label-holder">
										<span class="label label-warning arrowed-in">diet</span>
									</span>
								</div>
							</a>

							<div class="tools">
								<a href="#">
									<i class="icon-link"></i>
								</a>

								<a href="#">
									<i class="icon-paper-clip"></i>
								</a>

								<a href="#">
									<i class="icon-pencil"></i>
								</a>

								<a href="#">
									<i class="icon-remove red"></i>
								</a>
							</div>
						</li>

						<li>
							<a href="__PUBLIC__/ace/assets/images/gallery/image-2.jpg" data-rel="colorbox">
								<img alt="150x150" src="__PUBLIC__/ace/assets/images/gallery/thumb-2.jpg" />
								<div class="text">
									<div class="inner">Sample Caption on Hover</div>
								</div>
							</a>
						</li>

						<li>
							<a href="__PUBLIC__/ace/assets/images/gallery/image-3.jpg" data-rel="colorbox">
								<img alt="150x150" src="__PUBLIC__/ace/assets/images/gallery/thumb-3.jpg" />
								<div class="text">
									<div class="inner">Sample Caption on Hover</div>
								</div>
							</a>

							<div class="tools tools-bottom">
								<a href="#">
									<i class="icon-link"></i>
								</a>

								<a href="#">
									<i class="icon-paper-clip"></i>
								</a>

								<a href="#">
									<i class="icon-pencil"></i>
								</a>

								<a href="#">
									<i class="icon-remove red"></i>
								</a>
							</div>
						</li>

						<li>
							<a href="__PUBLIC__/ace/assets/images/gallery/image-4.jpg" data-rel="colorbox">
								<img alt="150x150" src="__PUBLIC__/ace/assets/images/gallery/thumb-4.jpg" />
								<div class="tags">
									<span class="label-holder">
										<span class="label label-info arrowed">fountain</span>
									</span>

									<span class="label-holder">
										<span class="label label-danger">recreation</span>
									</span>
								</div>
							</a>

							<div class="tools tools-top">
								<a href="#">
									<i class="icon-link"></i>
								</a>

								<a href="#">
									<i class="icon-paper-clip"></i>
								</a>

								<a href="#">
									<i class="icon-pencil"></i>
								</a>

								<a href="#">
									<i class="icon-remove red"></i>
								</a>
							</div>
						</li>

						<li>
							<div>
								<img alt="150x150" src="__PUBLIC__/ace/assets/images/gallery/thumb-5.jpg" />
								<div class="text">
									<div class="inner">
										<span>Some Title!</span>

										<br />
										<a href="__PUBLIC__/ace/assets/images/gallery/image-5.jpg" data-rel="colorbox">
											<i class="icon-zoom-in"></i>
										</a>

										<a href="#">
											<i class="icon-user"></i>
										</a>

										<a href="#">
											<i class="icon-share-alt"></i>
										</a>
									</div>
								</div>
							</div>
						</li>

						<li>
							<a href="__PUBLIC__/ace/assets/images/gallery/image-6.jpg" data-rel="colorbox">
								<img alt="150x150" src="__PUBLIC__/ace/assets/images/gallery/thumb-6.jpg" />
							</a>

							<div class="tools tools-right">
								<a href="#">
									<i class="icon-link"></i>
								</a>

								<a href="#">
									<i class="icon-paper-clip"></i>
								</a>

								<a href="#">
									<i class="icon-pencil"></i>
								</a>

								<a href="#">
									<i class="icon-remove red"></i>
								</a>
							</div>
						</li>

						<li>
							<a href="__PUBLIC__/ace/assets/images/gallery/image-1.jpg" data-rel="colorbox">
								<img alt="150x150" src="__PUBLIC__/ace/assets/images/gallery/thumb-1.jpg" />
							</a>

							<div class="tools">
								<a href="#">
									<i class="icon-link"></i>
								</a>

								<a href="#">
									<i class="icon-paper-clip"></i>
								</a>

								<a href="#">
									<i class="icon-pencil"></i>
								</a>

								<a href="#">
									<i class="icon-remove red"></i>
								</a>
							</div>
						</li>

						<li>
							<a href="__PUBLIC__/ace/assets/images/gallery/image-2.jpg" data-rel="colorbox">
								<img alt="150x150" src="__PUBLIC__/ace/assets/images/gallery/thumb-2.jpg" />
							</a>

							<div class="tools tools-top">
								<a href="#">
									<i class="icon-link"></i>
								</a>

								<a href="#">
									<i class="icon-paper-clip"></i>
								</a>

								<a href="#">
									<i class="icon-pencil"></i>
								</a>

								<a href="#">
									<i class="icon-remove red"></i>
								</a>
							</div>
						</li>
					</ul>
				</div><!-- PAGE CONTENT ENDS -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.page-content -->
</div><!-- /.main-content -->

			</div><!-- /.main-container-inner -->

	<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
		<i class="icon-double-angle-up icon-only bigger-110"></i>
	</a>
</div><!-- /.main-container -->
		<!-- basic scripts -->

		<!--[if !IE]> -->

		<script src="http://ajax.useso.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
		<script src="http://ajax.useso.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<![endif]-->

		<!--[if !IE]> -->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='__PUBLIC__/ace/assets/js/jquery-2.0.3.min.js'>"+"<"+"script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
		<script type="text/javascript">
		 window.jQuery || document.write("<script src='__PUBLIC__/ace/assets/js/jquery-1.10.2.min.js'>"+"<"+"script>");
		</script>
		<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='__PUBLIC__/ace/assets/js/jquery.mobile.custom.min.js'>"+"<"+"script>");
		</script>
		<script src="__PUBLIC__/ace/assets/js/bootstrap.min.js"></script>
		<script src="__PUBLIC__/ace/assets/js/typeahead-bs2.min.js"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="__PUBLIC__/ace/assets/js/excanvas.min.js"></script>
		<![endif]-->

		<script src="__PUBLIC__/ace/assets/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="__PUBLIC__/ace/assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="__PUBLIC__/ace/assets/js/jquery.slimscroll.min.js"></script>
		<script src="__PUBLIC__/ace/assets/js/jquery.easy-pie-chart.min.js"></script>
		<script src="__PUBLIC__/ace/assets/js/jquery.sparkline.min.js"></script>
		<script src="__PUBLIC__/ace/assets/js/flot/jquery.flot.min.js"></script>
		<script src="__PUBLIC__/ace/assets/js/flot/jquery.flot.pie.min.js"></script>
		<script src="__PUBLIC__/ace/assets/js/flot/jquery.flot.resize.min.js"></script>

		<!-- ace scripts -->

		<script src="__PUBLIC__/ace/assets/js/ace-elements.min.js"></script>
		<script src="__PUBLIC__/ace/assets/js/ace.min.js"></script>

</body>
</html>
<!-- inline scripts related to this page -->
<script src="__PUBLIC__/ace/assets/js/jquery.colorbox-min.js"></script>
<script type="text/javascript">
jQuery(function($) {
	var colorbox_params = {
		reposition:true,
		scalePhotos:true,
		scrolling:false,
		previous:'<i class="icon-arrow-left"></i>',
		next:'<i class="icon-arrow-right"></i>',
		close:'&times;',
		current:'{current} of {total}',
		maxWidth:'100%',
		maxHeight:'100%',
		onOpen:function(){
			document.body.style.overflow = 'hidden';
		},
		onClosed:function(){
			document.body.style.overflow = 'auto';
		},
		onComplete:function(){
			$.colorbox.resize();
		}
	};

	$('.ace-thumbnails [data-rel="colorbox"]').colorbox(colorbox_params);
	$("#cboxLoadingGraphic").append("<i class='icon-spinner orange'></i>");//let's add a custom loading icon

	/**$(window).on('resize.colorbox', function() {
		try {
			//this function has been changed in recent versions of colorbox, so it won't work
			$.fn.colorbox.load();//to redraw the current frame
		} catch(e){}
	});*/
})
		</script>