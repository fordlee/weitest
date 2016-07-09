<?php
// 本类由系统自动生成，仅供测试用途
class TestAction extends Action {

	public function intomysql(){
    	$m = M('question');
    	$ret = $m -> select();
    	foreach ($ret as $k => $v) {
    		$data['qcode'] = $v['qcode'];
    		$data['icon'] = $v['icon'];
    		$data['bgpic'] = $v['bgpic'];
    		$data['generalset'] = $v['generalset'];
    		$data['status'] = 1;
    		$data['date'] = date('Y-m-d');

    		$m -> add($data);
    	}
    }

    public function into(){
    	$m = M('question_detail');
    	$ret = $m -> select();
    	foreach($ret as $k => $v){
    		$data['qid'] = $v['qid'];
    		$data['language'] = $v['language'];
    		$data['content'] = $v['content'];

    		$m -> add($data);
    	}
    }

    public function arr2json(){
        $data=array(
		array(
			"type"=>"text",
			"attribute"=>array(
				"content"=>"你好，{#me_name}今天很开心：",
				"color"=>"#000000",
				"size"=>"20",
				"font"=>"c:/windows/fonts/simhei.ttf",
				"x"=>50,
				"y"=>50
			),
		),
		
		//round|resize(100,100)|cut
		array(
			"type"=>"image",
			"attribute"=>array(
				"content"=>"pic.jpg",
				"x"=>250,
				"y"=>0,
				"alpha"=>50,
				"func"=>"round"
			),
		),

		array(
			"type"=>"image",
			"attribute"=>array(
				"content"=>"pic.jpg",
				"x"=>0,
				"y"=>100,
				"alpha"=>100,
				"func"=>"round"
			),
		),

		array(
			"type"=>"text",
			"attribute"=>array(
				"content"=>"成功是留给有准备的人的！",
				"color"=>"#4CAF50",
				"size"=>"20",
				"font"=>"c:/windows/fonts/simhei.ttf",
				"x"=>50,
				"y"=>250
			),
		)
	);

        $ret = json_encode($data);
        echo $ret;
    }

    public function getUrlPicture(){
    	$img = UPLOADS_PATH.'/header/1.jpg';
        file_put_contents($img, file_get_contents("https://scontent.xx.fbcdn.net/v/t1.0-1/s320x320/13310349_213272095732702_3570793724905543015_n.jpg?oh=7ffa2be07abca92b956c69fa6f7088cc&oe=57FB6430"));
        $imgfile = UPLOADS_PATH.'/header/1.jpg';
        $im=imagecreatefromjpeg($imgfile);
        Header("Content-type: image/jpeg");
        imagejpeg($im);
        ImageDestroy($im);
    }

}
?>