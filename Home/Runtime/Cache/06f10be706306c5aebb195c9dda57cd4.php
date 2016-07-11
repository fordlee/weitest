<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <title>Mytests</title>
    <link href="__PUBLIC__/mytests/css/question.css" rel="stylesheet" type="text/css">
    <script>
        function change(){
            var headerHome=document.getElementById("header-home");
            var lanSwitch=document.getElementById("lan-switch");
            var header=document.getElementById("header");
            var width=window.screen.width;
                header.style.cssText="height:180px";
                headerHome.style.cssText="display:block";
                lanSwitch.style.cssText="display:block";
        }
    </script>
</head>
<body>
<div id="header" class="header">
    <button id="header-hidden" onclick="change()">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <div class="header-box">
        <form action="<?php echo U('Index/question');?>" id="filterform" method="post">
            <input type="hidden" name="id" value="<?php echo ($qid); ?>" >
            <a href="#" class="header-logo" ></a>
            <a href="<?php echo U('Index/index');?>" class="header-home" id="header-home">HOME</a>
            <select id="language" class="lan-switch" name="language">
                <option value="zh" <?php if($language == 'zh') echo "selected"; ?>>中文</option>
                <option value="en" <?php if($language == 'en') echo "selected"; ?>>English</option>
                <option value="fr" <?php if($language == 'fr') echo "selected"; ?>>French</option>
                <option value="pt" <?php if($language == 'pt') echo "selected"; ?>>Portuguese</option>
            </select>
        </form>
    </div>
</div>

<div id="up-ad">
<p>Advertisement</p>
<div></div>
</div>

<div id="container">
    <div id="container-main">
        <div id="container-content">
            <h1><?php echo ($qitem["content"]); ?></h1>
            <div class="fb-banner">
                <?php if($status == 1): ?><img src="<?php echo ($resultsrc); ?>" style="width:90%">
                <?php else: ?>
                    <img src="<?php echo ($qitem["bgpic"]); ?>" style="width:90%"><?php endif; ?>
            </div>
            <div class="fb-share"><img src="__PUBLIC__/mytests/img/Facebook-login.png"></div>
            <p>请登录<span>Facebook</span>以查看你的测试结果</p>
            <a href="<?php echo U('Facebook/paintResult');?>/id/<?php echo ($qid); ?>">
                <img src="__PUBLIC__/mytests/img/Facebook-logo.png">
                <span>使用Facebook登录</span>
            </a>
        </div>
    </div>
    <div id="container-vice">
        <div class="as_336x280">
            <p>Advertisement</p>
            <div class="as-content"></div>
        </div>

        <?php if(is_array($item)): $i = 0; $__LIST__ = array_slice($item,0,5,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><a href="#" class="container-vice-box">
                <img src="<?php echo ($v["icon"]); ?>">
                <div class="container-vice-box-btn">
                    <img src="__PUBLIC__/mytests/img/arrow.png">
                    <span><?php echo ($v["content"]); ?></span>
                </div>
                <div class="container-vice-mask"></div>
            </a><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <div id="container-patch">
        <div class="as_600x300">
            <p>Advertisement</p>
            <div class="ad-content"></div>
        </div>

        <div id="title">You May Like</div>

        <div id="container-patch-bigbox">

            <div class="patch-list patch-list_top">
                <?php if(is_array($item)): $i = 0; $__LIST__ = array_slice($item,0,6,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 4 );++$i;?><a href="#" class="container-patch-box patch-no-margin3">
                        <div>
                            <img src="<?php echo ($v["icon"]); ?>" >
                        </div>
                        <span><?php echo ($v["content"]); ?></span>
                    </a><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>

            <div class="as_336x280">
                <p>Advertisement</p>
                <div class="as-content"></div>
            </div>

            <div class="patch-list patch-list_bottom">
                <?php if(is_array($item)): $i = 0; $__LIST__ = array_slice($item,0,6,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 4 );++$i;?><a href="#" class="container-patch-box patch-no-margin3">
                        <div>
                            <img src="<?php echo ($v["icon"]); ?>" >
                        </div>
                        <span><?php echo ($v["content"]); ?></span>
                    </a><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
        <a href="#" class="nextbtn">
            <span>NEXT</span>
            <img src="__PUBLIC__/mytests/img/arrow1.png">
        </a>
        <div id="footer-link">
            <a href="#">条款和条件</a>
            <a href="#">隐私</a>
            <a href="#">版权声明</a>
            <a href="#">反馈</a>
            <a href="#">成为合作伙伴</a>
            <br/>
            <p>Copyright 2016 By Mytests.co©</p>
        </div>
    </div>
</div>
<div id="footer"></div>
<script src="__PUBLIC__/mytests/js/jquery-3.0.0.min.js"></script>
<script type="text/javascript">
$('#language').change(function(e) {
    $('#filterform').submit();
});
</script>
</body>
</html>