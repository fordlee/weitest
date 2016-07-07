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

		<link rel="stylesheet" href="__PUBLIC__/ace/assets/css/chosen.css" />
		
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
									<a href="<?php echo U('Question/questionentry');?>">
										<i class="icon-double-angle-right"></i>
										问题设置
									</a>
								</li>
								<li>
									<a href="<?php echo U('Question/questionlist');?>">
										<i class="icon-double-angle-right"></i>
										详细设置
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
									<a href="<?php echo U('Account/adminlist');?>">
										<i class="icon-double-angle-right"></i>
										管理员设置
									</a>
								</li>
							</ul>
						</li>

						<li>
							<a href="<?php echo U('Index/gallery');?>">
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

<link rel="stylesheet" href="__PUBLIC__/static/css/mask.css">
<div class="main-content">
	<div class="breadcrumbs" id="breadcrumbs">
		<script type="text/javascript">
			try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
		</script>
		<ul class="breadcrumb">
			<li>
				<i class="icon-home home-icon"></i>
				<a href="#">题库管理</a>
			</li>
			<li class="active">详细设置</li>
		</ul><!-- .breadcrumb -->
	</div>

	<div class="page-content">
		<div class="row">
			<div class="col-xs-12">
				<table id="sample-table-1" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th class="center">ID</th>
							<th class="center">编号</th>
							<th class="center">题目标题</th>
							<th class="center">状态</th>
						</tr>
					</thead>

					<tbody>
						<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
							<td class="center"><?php echo ($v["id"]); ?></td>
							<td class="center"><?php echo ($v["qcode"]); ?></td>
							<td >
								<?php if(is_array($v['qd'])): $i = 0; $__LIST__ = $v['qd'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$qdetail): $mod = ($i % 2 );++$i;?><font size="5"><?php echo ($qdetail["content"]); ?></font>
									[<a href="javascript:void()" onclick="addResult('<?php echo ($qdetail["id"]); ?>','<?php echo ($qdetail["qid"]); ?>', '<?php echo ($qdetail["language"]); ?>', '<?php echo ($qdetail["content"]); ?>')">添加</a>&nbsp;<a href="<?php echo U('Answer/editResult');?>/qid/<?php echo ($qdetail["qid"]); ?>/qdid/<?php echo ($qdetail["id"]); ?>">修改</a>]
									<br><?php endforeach; endif; else: echo "" ;endif; ?>
								<a href="javascript:void()" onclick="addQuestion('<?php echo ($v["id"]); ?>')" class="btn btn-xs btn-primary">添加题目</a>
							</td>
							<td class="center">
								<form action="<?php echo U('setStatus');?>" method="post" >
									<input type="hidden" name="qid" value="<?php echo ($v["id"]); ?>">
									<input type="hidden" name="status" value="<?php echo ($v["status"]); ?>">
									<?php if($v["status"] == 1): ?><button type="submit" class="btn btn-sm btn-success">启用</button>
									<?php else: ?>
										<button type="submit" class="btn btn-sm btn-danger">关闭</button><?php endif; ?>
								</form>
							</td>
						</tr><?php endforeach; endif; else: echo "" ;endif; ?>
					</tbody>
				</table>

				<div id="dialog" class="dialog" style="display:none">
		            <div class="mask"></div>
		            <div class="body">
		            	<form action="<?php echo U('Answer/answerentrysave');?>" method="post" enctype="multipart/form-data" class="form-horizontal" >
							<input type="hidden" name="qdid" id="qdid">
							<input type="hidden" name="qid" id="qid">
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-right" for="languageset">语言：</label>
								<div class="col-sm-2">
									<select id="languageset" name="languageset" disabled>
										<option value="zh">中文</option>
										<option value="en">英语</option>
										<option value="pt">葡语</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-right">问题：</label>
								<div class="col-sm-10">
									<input type="text" name="content" id="content" placeholder="" class="col-sm-6" />
								</div>
							</div>
							<?php for ($i=0; $i < 4 ; $i++) { ?>
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-right">答案：</label>
								<div class="col-sm-10">
									<input type="text" name="option[]" placeholder="" class="col-sm-6" />
									<div class="col-sm-3">
									<button type="button" onclick="addAnswerPic(this)" class="btn btn-xs btn-primary">
										<i class="icon icon-plus"></i>图片
									</button>&nbsp;
									<button type="button" onclick="delTr(this)" class="btn btn-xs btn-danger"> 
										<i class="icon-minus"></i>移除
									</button>
									</div>
									<input type="file" name="answerPic[]" class="col-sm-2" style="display:none">
								</div>
							</div>
							<?php } ?>
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-right"></label>
								<div class="col-sm-10">
									<button type="button" onclick="addDia(this);" class="btn btn-sm btn-primary">
										<i class="icon icon-plus"></i>添加选项
									</button>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-sm-2">
									
								</div>
								<div class="col-sm-7">
									<input type="submit" class="btn btn-primary pull-right" value="添加">
								</div>
							</div>
						</form>
		            </div>
	        	</div>

	        	<div id="question_dialog" class="question_dialog" style="display:none">
	        		<div class="mask"></div>
	        		<div class="question_body">
	        			<form action="<?php echo U('Question/addQuestion');?>" method="post" class="form-horizontal" >
							<input type="hidden" name="qid" id="questionid">
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-right" for="languageset">语言：</label>
								<div class="col-sm-2">
									<select name="languageset">
										<option value="zh">中文</option>
										<option value="en">英语</option>
										<option value="pt">葡语</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-right">问题：</label>
								<div class="col-sm-10">
									<input type="text" name="content" placeholder="" class="col-sm-6" />
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-sm-2">
									<input type="reset" class="btn btn-light pull-right" value="重置">
								</div>
								<div class="col-sm-7">
									<input type="submit" class="btn btn-primary pull-right" value="添加">
								</div>
							</div>
						</form>
	        		</div>
	        	</div>

			</div>
		</div>

	</div>

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
		<script src="__PUBLIC__/ace/assets/js/chosen.jquery.min.js"></script>
		<!-- ace scripts -->

		<script src="__PUBLIC__/ace/assets/js/ace-elements.min.js"></script>
		<script src="__PUBLIC__/ace/assets/js/ace.min.js"></script>
		<script src="__PUBLIC__/ace/assets/js/jquery.colorbox-min.js"></script>
</body>
</html>
<script type="text/javascript">
$('.mask').click(function(e) {
   $('#dialog').hide();
   $('#question_dialog').hide();
   //window.location.reload();
});

function addResult(qdid,qid,language,content){
	$('#qdid').val(qdid);
	$('#qid').val(qid);
	$('#content').val(content);
	if(language == 'pt'){
		$('#languageset').val('pt');
	}else if(language == 'en'){
		$('#languageset').val('en');
	}else{
		$('#languageset').val('zh');
	}
	$('#dialog').show();
}

function addQuestion(qid){
	$('#questionid').val(qid)
	$('#question_dialog').show();
}

function addAnswerPic(obj){
	var _this=$(obj);
	_this.parent().next().click();
}

function addDia(obj){
	var _this=$(obj);
	var str=
	'<div class="form-group">'+
		'<label class="col-sm-2 control-label no-padding-right" >答案：</label>'+
		'<div class="col-sm-10">'+
			'<input type="text" name="option[]" placeholder="" class="col-sm-6" />'+
			'<div class="col-sm-3">'+
			'<button type="button" onclick="addAnswerPic(this)" class="btn btn-xs btn-primary">'+
				'<i class="icon icon-plus"></i>图片'+
			'</button>&nbsp;'+
			'<button type="button" onclick="delTr(this)" class="btn btn-xs btn-danger">'+ 
				'<i class="icon-minus"></i>移除'+
			'</button>'+
			'</div>'+
			'<input type="file" name="answerPic[]" class="col-sm-2" style="display:none">'+
		'</div>'+
	'</div>';
	_this.parent().parent().before(str);
}

function delTr(obj){
	var _this=$(obj);
	_this.parent().parent().parent().remove();
}

</script>