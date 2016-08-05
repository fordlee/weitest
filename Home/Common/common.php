<?php
function defaults($data,$default){
	if(!$data){
		return $default;
	}
	return $data;
}

function replaceLanguage($language){
	switch ($language) {
	    case 'zh':
			$arr = array(
				"code" => "zh_TW",
				"test_btn" => "進入測試",
	            "login_txt" => "請登錄Facebook以查看你的測試結果",
	            "login" => "使用facebook登錄",
	            "share" => "分享到Facebook",
	            "loading_txt" => "分析個人資料，正在計算您的結果...",
	            "facebook_like_txt" => "請給我們點贊！" ,
				"facebook_like" => "https://www.facebook.com/Mytestsco-%E4%B8%AD%E5%9C%8B-295349334145829",
	            "description" => "點擊這裡！將你的結果分享給好友！",
	            "ogdescription" => "點擊測試，看看你的結果會有什麼不一樣。",
	            "index_title" => "Mytests.co-大眾化趣味個性測試平臺",
	            "index_description" => "在線性格測試、情感測試、娛樂測試、心理測試，即刻參與，讓妳更加了解自己！",
	            "index_keywords" => "測試，免費測試，在線測試，趣味測試，測試遊戲，個性測試，愛情測試，智商測試，情商測試，搞笑測試，測試集錦，生活，事業，運氣"
	        );
	    break;
	    case 'en':
	        $arr = array(
	        	"code" => "en_US",
	        	"test_btn" => "Test Now",
	        	"login_txt" => "Please login with Facebook to see your result",
	            "login" => "Login with Facebook",
	            "share" => "Share on Facebook",
	            "loading_txt" => "Analyze profile,Calculating your result...",
	            "facebook_like_txt" => "Please like us!",
	            "facebook_like" => "https://www.facebook.com/Mytestsco-English-927186497408131",
	            "description" => "Click here! Share your result with friends.",
	            "ogdescription" => "Want to see your result? Test now!",
	            "index_title" => "Mytests.co-Funny and personality test sites",
	            "index_description" => "Online personality test, emotion quizzes, entertainment test, psychology quizzes, join now and learn more about yourself!",
	            "index_keywords" => "test, free test, online test, funny test, test game, personality test, love test, IQ test, EQ quizzes, fun quizzes, test collection, life, career, luck"
	            );
	        break;
	    case 'pt':
	        $arr = array(
	        	"code" => "pt_BR",
	        	"test_btn" => "Teste Agora",
	        	"login_txt" => "Por favor, faça o seu log-in com o Facebook para ver o seu resultado",
	            "login" => "Entre no Facebook",
	            "share" => "Compartilhe no Facebook",
	            "loading_txt" => "Analisando perfil,Calculando seu resultado...",
	            "facebook_like_txt" => "Curta nossa página!", 
	            "facebook_like" => "https://www.facebook.com/Mytestsco-portugu%C3%AAs-1793850670900218",
	            "description" => "Clique aqui! Compartilhar o resultado com seus amigos.",
	            "ogdescription" => "Quer ver seu resultado? Faça o teste agora!",
	            "index_title" => "Mytests.co-Site de testes de personalidade e divertidos",
	            "index_description" => "Testes de personalidade online: testes de emoção, testes de entretenimento, testes psicológicos e mais! Se inscreva e aprenda mais sobre você mesmo(a)!",
	            "index_keywords" => "teste, testes grátis, testes online, testes engraçados, jogo teste, teste de personalidade, teste de amor, teste de inteligência, testes emocionais, testes divertidos, coleção de testes, vida, carreira, sorte"
	        );
	        break;
	    default:
	        $arr = array(
	        	"code" => "en_US",
	        	"test_btn" => "Test Now",
	        	"login_txt" => "Please login with Facebook to see your result",
	            "login" => "Login with Facebook",
	            "share" => "Share on Facebook",
	            "loading_txt" => "Analyze profile,Calculating your result...",
	            "facebook_like_txt" => "Please like us!",
	            "facebook_like" => "https://www.facebook.com/Mytestsco-English-927186497408131",
	            "description" => "Click here! Share your result with friends.",
	            "ogdescription" => "Want to see your result? Test now!",
	            "index_title" => "Mytests.co-Funny and personality test sites",
	            "index_description" => "Online personality test, emotion quizzes, entertainment test, psychology quizzes, join now and learn more about yourself!",
	            "index_keywords" => "test, free test, online test, funny test, test game, personality test, love test, IQ test, EQ quizzes, fun quizzes, test collection, life, career, luck"
	        );
	        break;
	}

	return $arr;
}
?>