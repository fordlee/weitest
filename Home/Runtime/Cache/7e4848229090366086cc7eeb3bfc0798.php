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
            <form action="<?php echo U('Index/index');?>" id="filterform" method="post">
            <a href="<?php echo U('Index/index');?>" class="header-logo" ><img src="__PUBLIC__/mytests/img/logo.png" alt="mytests.co" title="Home"></a>
            <a href="<?php echo U('Index/index');?>" class="header-home" >HOME</a>
            <select id="language" class="lan-switch" name="language">
                <option value="zh" <?php if($language == 'zh') echo "selected"; ?>>中文</option>
                <option value="en" <?php if($language == 'en') echo "selected"; ?>>English</option>
                <option value="pt" <?php if($language == 'pt') echo "selected"; ?>>Portuguese</option>
                <!-- <option value="fr" <?php if($language == 'fr') echo "selected"; ?>>French</option> -->
            </select>
            </form>
        </div>
    </div>

        <div id="container">
            <p style="text-align: center">Advertisement</p>
            <div id="middle-ad"></div>
            <!-- <?php if(($backflag) == "1"): ?><a href="javascript:void()" onclick="window.history.back(-1);" class="nextbtn">
                    <img src="__PUBLIC__/mytests/img/arrowb1.png">
                    <span>BACK</span>
                </a><?php endif; ?>
            <a href="<?php echo U('Index/next');?>" class="nextbtn">
                <span>NEXT</span>
                <img src="__PUBLIC__/mytests/img/arrow1.png">
            </a> -->
            <br/>
            <?php if(is_array($item)): $i = 0; $__LIST__ = $item;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Index/question');?>/id/<?php echo ($v["id"]); ?>" class="container-box">
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
            <?php if(($backflag) == "1"): ?><a href="javascript:void()" onclick="window.history.back(-1);" class="nextbtn">
                <img src="__PUBLIC__/mytests/img/arrowb1.png">
                <span>BACK</span>
            </a><?php endif; ?>
            <!-- <a href="<?php echo U('Index/next');?>" class="nextbtn" style="margin-bottom: 30px">
                <span>NEXT</span>
                <img src="__PUBLIC__/mytests/img/arrow1.png">
            </a> -->

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
<script src="__PUBLIC__/mytests/js/jquery-3.0.0.min.js"></script>
<script type="text/javascript">
$('#language').change(function(e) {
    $('#filterform').submit();
});
</script>
</body>
</html>