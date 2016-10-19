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
	            "like_txt" => "猜妳喜歡",
	            "index_description" => "在線性格測試、情感測試、娛樂測試、心理測試，即刻參與，讓妳更加了解自己！",
	            "index_keywords" => "測試，免費測試，在線測試，趣味測試，測試遊戲，個性測試，愛情測試，智商測試，情商測試，搞笑測試，測試集錦，生活，事業，運氣",
	            "album_title" => "免费在线图片处理,照片美化，大头贴制作",
	            "album_description" => "在线图片处理，个性化大头贴，美化照片，多种图片特效，趣味装饰，场景，滤镜等让您在照片里展示最完美的自我",
	            "album_keywords" => "大头贴，在线图片处理，照片美化，美化图片，人像美容，美图，美颜，照片润色，免费图片处理，图片特效，图片编辑，照片趣味装饰，图片边框，滤镜，场景，修饰，拼图"
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
	            "like_txt" => "You May Like",
	            "index_description" => "Online personality test, emotion quizzes, entertainment test, psychology quizzes, join now and learn more about yourself!",
	            "index_keywords" => "test, free test, online test, funny test, test game, personality test, love test, IQ test, EQ quizzes, fun quizzes, test collection, life, career, luck",
	            "album_title" => "Photo editor free online: photo stickers & effects",
	            "album_description" => "Free photo editor helps you touch up photo,edit photo with multiple photo stickers, effects, filters, scenes etc. Start now to make your photo more beautiful",
	            "album_keywords" => "custom photo stickers,photo editor，online photo editor,free photo editor,photo processing, photo touch up,photo retouching, image retouching tools, picture effects, photo filters,scenes, frame,photo processor, edit photo online, photo collages, photo process service, deck photo，beautify photo"
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
	            "like_txt" => "Você Também pode Gostar",
	            "index_description" => "Testes de personalidade online: testes de emoção, testes de entretenimento, testes psicológicos e mais! Se inscreva e aprenda mais sobre você mesmo(a)!",
	            "index_keywords" => "teste, testes grátis, testes online, testes engraçados, jogo teste, teste de personalidade, teste de amor, teste de inteligência, testes emocionais, testes divertidos, coleção de testes, vida, carreira, sorte",
	            "album_title" => "Editor de fotos online grátis: adesivos de fotos & efeitos",
	            "album_description" => "O editor de fotos grátis te ajuda a retocar e editar fotos com diferentes adesivos, efeitos, filtros, cenários etc. Comece agora a aperfeiçoar a sua foto",
	            "album_keywords" => "Adesivos customizados, editor de foto, editor de foto online, editor de foto grátis, processador de foto, retoque de foto, ferramentas de retoque, efeitos, filtros, cenários, molduras, processador de foto, editar foto online, colagem de fotos, serviço de processamento de fotos, decorar foto, embelezar foto"
	        );
	        break;
	    case 'vi':
	    	$arr = array(
	    		"code" => "vi_VN",
				"test_btn" => "nhập thử nghiệm",
	            "login_txt" => "Xin hãy đăng nhập vào Facebook để xem kết quả xét nghiệm của bạn",
	            "login" => "Đăng nhập bằng facebook",
	            "share" => "Chia sẻ trên Facebook",
	            "loading_txt" => "Phân tích các dữ liệu cá nhân là để tính toán kết quả của bạn ...",
	            "facebook_like_txt" => "Xin vui lòng cho chúng tôi một ngón tay cái lên!" ,
				"facebook_like" => "https://www.facebook.com/Mytestsco-Vietnamese-1783205645293220",
	            "description" => "Bấm vào đây! Chia sẻ kết quả của bạn cho bạn bè!",
	            "ogdescription" => "Nhấn vào thử nghiệm để xem kết quả của bạn là không giống nhau.",
	            "index_title" => "Mytests.co-Phổ biến nền tảng thử nghiệm tính cách vui vẻ",
	            "like_txt" => "Tôi đoán u thích",
	            "index_description" => "Kiểm tra tính cách mạng, thử nghiệm cảm xúc, thử nghiệm giải trí, kiểm tra tâm lý, ngay lập tức tham gia vào việc đưa bạn tìm hiểu thêm về bản thân!",
	            "index_keywords" => "Kiểm tra, thử nghiệm miễn phí, thử nghiệm trực tuyến, thử nghiệm hương vị, trò chơi kiểm tra, kiểm tra tính cách, kiểm tra tình yêu, test IQ, test EQ, funny kiểm tra, thử nghiệm nổi bật, cuộc sống, nghề nghiệp, may mắn",
	            "album_title" => "",
	            "album_description" => "",
	            "album_keywords" => ""
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
	            "like_txt" => "You May Like",
	            "index_description" => "Online personality test, emotion quizzes, entertainment test, psychology quizzes, join now and learn more about yourself!",
	            "index_keywords" => "test, free test, online test, funny test, test game, personality test, love test, IQ test, EQ quizzes, fun quizzes, test collection, life, career, luck",
	            "album_title" => "Photo editor free online: photo stickers & effects",
	            "album_description" => "Free photo editor helps you touch up photo,edit photo with multiple photo stickers, effects, filters, scenes etc. Start now to make your photo more beautiful",
	            "album_keywords" => "custom photo stickers,photo editor，online photo editor,free photo editor,photo processing, photo touch up,photo retouching, image retouching tools, picture effects, photo filters,scenes, frame,photo processor, edit photo online, photo collages, photo process service, deck photo，beautify photo"
	        );
	        break;
	}

	return $arr;
}
?>