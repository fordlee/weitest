<?php

function replaceLanguage($language){
	switch ($language) {
	    case 'zh':
	        /*$arr = array(
	            "login_txt" => "请登录Facebook以查看你的测试结果",
	            "login" => "使用facebook登录",
	            "share" => "分享到facebook",
	            "loading_txt" => "分析个人资料，正在计算您的结果...",
	            "facebook_like_txt" => "请给我们点赞！" ,
	            "facebook_like" => "https://www.facebook.com/Mytestsco-&#x4e2d;&#x56fd;-295349334145829",
	            "description" => "点击这里！分享给你的小伙伴们围观！",
	            "ogdescription" => "点击这里！分享给你的小伙伴们围观！",
	        );*/
			$arr = array(
	            "login_txt" => "請登錄Facebook以查看你的測試結果",
	            "login" => "使用facebook登錄",
	            "share" => "分享到Facebook",
	            "loading_txt" => "分析個人資料，正在計算您的結果...",
	            "facebook_like_txt" => "請給我們點贊！" ,
	            "facebook_like" => "https://www.facebook.com/Mytestsco-&#x4e2d;&#x56fd;-295349334145829",
	            "description" => "點擊這裡！分享給你的小夥伴們圍觀！",
	            "ogdescription" => "點擊這裡！分享給你的小夥伴們圍觀！",
	        );
	    break;
	    case 'en':
	        $arr = array(
	        	"login_txt" => "Please login with Facebook to see your result",
	            "login" => "Login with Facebook",
	            "share" => "Share on Facebook",
	            "loading_txt" => "Analyze profile,Calculating your result...",
	            "facebook_like_txt" => "Please like us!",
	            "facebook_like" => "https://www.facebook.com/Mytestsco-English-927186497408131",
	            "description" => "click here! Share with your little friends!",
	            "ogdescription" => "click here! Share with your little friends!",
	        );
	        break;
	    case 'pt':
	        $arr = array(
	        	"login_txt" => "Por favor, faça o seu log-in com o Facebook para ver o seu resultado",
	            "login" => "Entre no Facebook",
	            "share" => "Compartilhe no Facebook",
	            "loading_txt" => "Analisando perfil,Calculando seu resultado...",
	            "facebook_like_txt" => "Curta nossa página!", 
	            "facebook_like" => "https://www.facebook.com/Mytestsco-portugu%C3%AAs-1793850670900218",
	            "description" => "Clique aqui! Compartilhe com seus amigos pequenos espectadores!",
	            "ogdescription" => "Clique aqui! Compartilhe com seus amigos pequenos espectadores!",
	        );
	        break;
	    default:
	        $arr = array(
	        	"login_txt" => "Please login with Facebook to see your result",
	            "login" => "Login with Facebook",
	            "share" => "Share on Facebook",
	            "loading_txt" => "Analyze profile,Calculating your result...",
	            "facebook_like_txt" => "Please like us!",
	            "facebook_like" => "https://www.facebook.com/Mytestsco-English-927186497408131",
	            "description" => "click here! Share with your little friends!",
	            "ogdescription" => "click here! Share with your little friends!",
	        );
	        break;
	}

	return $arr;
}
?>