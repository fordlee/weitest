<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <meta name="viewport" contenr="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <title>Mytests</title>
    <link rel="stylesheet" href="__PUBLIC__/mytests/css/index.css" type="text/css">
</head>
<body>
<div id="all">
    <div id="header">
        <div id="header-box">
            <a class="header-logo" href="#"></a>
            <a class="header-home" href="#">HOME</a>
            <select class="lan-switch">
                <option value="zh">中文</option>
                <option value="en">English</option>
                <option value="fr">French</option>
                <option value="pt">Portuguese</option>
            </select>
        </div>
    </div>

        <div id="container">
            <p style="text-align: center">Advertisement</p>
            <div id="middle-ad"></div>

            <a href="#" class="nextbtn">
                <span>NEXT</span>
                <img src="__PUBLIC__/mytests/img/arrow1.png">
            </a>
            <br/>
            <?php if(is_array($item)): $i = 0; $__LIST__ = $item;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><a href="<?php echo U('index/question');?>/id/<?php echo ($v["id"]); ?>" class="container-box">
                    <img class="container-box-img" src="<?php echo ($v["icon"]); ?>">
                    <div class="container-box-mask">
                        <div class="container-box-title"><?php echo ($v["content"]); ?></div>
                        <div class="container-box-btn">NEXT</div>
                    </div>
                </a><?php endforeach; endif; else: echo "" ;endif; ?>
            <div id="right-ad">
                <p style="text-align: center">Advertisement</p>
                <span></span>
            </div>
            <br/>
            <a href="#" class="nextbtn" style="margin-bottom: 30px">
                <span>NEXT</span>
                <img src="__PUBLIC__/mytests/img/arrow1.png">
            </a>

            <p style="text-align: center">Advertisement</p>
            <div id="bottom-ad" style="margin-bottom: 30px"></div>
        </div>

    <div id="footer">
        <a href="#">条款和条件</a>
        <a href="#">隐私</a>
        <a href="#">版权声明</a>
        <a href="#">反馈</a>
        <a href="#">成为合作伙伴</a>
        <br/>
        <p>Copyright 2016 By Mytests.co©</p>
        <div id="footer-img"></div>
    </div>

</div>



</body>
</html>