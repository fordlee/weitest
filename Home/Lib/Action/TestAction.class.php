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
                    "content"=>"姓名：{#user_profile.name}，生日：{#user_profile.birthday.date|strtotime=###;date=Y/m/d,###}，是最帅的人！",
                    "color"=>"#000000",
                    "size"=>"20",
                    "font"=>"c:/windows/fonts/simhei.ttf",
                    "x"=>0,
                    "y"=>100
                )
            ),

            array(
                "type"=>"image",
                "attribute"=>array(
                    "content"=>"{#user_profile.user_picture}",
                    "x"=>250,
                    "y"=>0,
                    "alpha" => 100,
                    "func"=>"round"//round|resize(100,100)|cut|opacity(10)
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
            ),

            array(
                "type"=>"image",
                "attribute"=>array(
                    "content"=>"pic.jpg",
                    "x"=>200,
                    "y"=>0,
                    "func"=>"round"
                ),
            ),

            /*array(
                "type"=>"image",
                "attribute"=>array(
                    "content"=>"pic.jpg",
                    "x"=>0,
                    "y"=>0,
                    "func"=>"resize(300,300)|round"
                )
            ),*/
            
            array(
                "type"=>"image",
                "attribute"=>array(
                    "content"=>"test1.jpg",
                    "x"=>270,
                    "y"=>0,
                    "func"=>"stripXcut(3,3)"
                )
            ), 
            
            array(
                "type"=>"image",
                "attribute"=>array(
                    "content"=>"test1.jpg",
                    "x"=>270,
                    "y"=>0,
                    "alpha"=>50,
                    "func"=>"freecut(270,420,270,0)"
                )
            )
        );

        $ret = json_encode($data);
        echo $ret;
    }

    public function getUrlPicture(){
    	
    	$ret = file_get_contents("https://scontent.xx.fbcdn.net/v/t1.0-1/s320x320/13310349_213272095732702_3570793724905543015_n.jpg?oh=7ffa2be07abca92b956c69fa6f7088cc&oe=57FB6430");
        $im=imagecreatefromstring($ret);
    	Header("Content-type: image/jpeg");
    	imagejpeg($im);
        
    }

    public function getUrlPictureString(){
    	$img = UPLOADS_PATH.'/header/1.jpg';
        file_put_contents($img, file_get_contents("https://scontent.xx.fbcdn.net/v/t1.0-1/s320x320/13310349_213272095732702_3570793724905543015_n.jpg?oh=7ffa2be07abca92b956c69fa6f7088cc&oe=57FB6430"));
        $imgfile = UPLOADS_PATH.'/header/1.jpg';
        Header("Content-type: image/jpeg");
        imagejpeg($im);
        ImageDestroy($im);
        echo $ret;
    }

    public function storeUserInfo(){
        $info = file_get_contents(APP_PATH.'Conf/info.json');
        $info = json_decode($info,true);

        $userInfo = $info['user_profile'];
        var_dump($userInfo);

        $userInfo['uid'] = $userInfo['id'];
        array_splice($userInfo, 0, 1);

        $userBirthday = $userInfo['birthday']['date'];
        $userInfo['birthday'] = date("Y-m-d",strtotime($userBirthday));
        $location = $userInfo['location']['name'];
        $userInfo['location'] = $location;
        var_dump($userInfo);
    }

    public function getPokemon(){
        $str = file_get_contents(UPLOADS_PATH.'/local/22/zh.txt');
        $arr = explode("|", $str);
        $number = $_GET['num'];
        var_dump($arr);
        echo $arr[$number];
    }

    public function getConstellation(){
        $info = file_get_contents(APP_PATH.'Conf/info.json');
        $info = json_decode($info,true);
        $birthdayM = date("m",strtotime($info['user_profile']['birthday']['date']));
        $birthdayD = date("d",strtotime($info['user_profile']['birthday']['date']));
        $constellation_name = $this -> constellation(5,12);

        echo $constellation_name;
    }

    public function constellation($month, $day) {
        // 检查参数有效性 
        if ($month < 1 || $month > 12 || $day < 1 || $day > 31) return false;

        // 星座名称以及开始日期
        $constellations = array(
            array( "20" => "水瓶座"),
            array( "19" => "双鱼座"),
            array( "21" => "白羊座"),
            array( "20" => "金牛座"),
            array( "21" => "双子座"),
            array( "22" => "巨蟹座"),
            array( "23" => "狮子座"),
            array( "23" => "处女座"),
            array( "23" => "天秤座"),
            array( "24" => "天蝎座"),
            array( "23" => "射手座"),
            array( "22" => "摩羯座")
        );

        list($constellation_start, $constellation_name) = each($constellations[(int)$month-1]);

        if ($day < $constellation_start) list($constellation_start, $constellation_name) = each($constellations[($month -2 < 0) ? $month = 11: $month -= 2]);

        return $constellation_name;
    }

    public function getFilemtime(){
        $changetime = filemtime(UPLOADS_PATH."/2.txt");
        $changetime = date("Y-m-d H:i:s",$changetime);
        echo $changetime;
    }

    public function delfile(){
        $file = './Uploads/image/01/231721203887791_3_7.jpg';

        @unlink($file);
    }

    public function getProfile(){
        $profile = file_get_contents(APP_PATH.'Conf/profile.json');
        $profile = json_decode($profile,true);

        var_dump($profile);
    }

    public function getPermissions(){
        $qid = 1;
        $m_q = M('question');
        $qpItem = $m_q -> where(array("id" => $qid)) -> find();

        if($qpItem['profileset'] == NULL){
            $qpItem['profileset'] = 'public_profile,email,user_birthday,user_friends';
        }

        $arr = explode(",",$qpItem['profileset']);
        foreach ($arr as $k => $v) {
            $permissions .= '\''.$v.'\''.",";
        }
        $permissions='['.substr($permissions, 0, -1).']';
        
        echo $permissions;
        //$permissions = ['email','public_profile','user_birthday','user_location','user_website','user_friends','user_photos','user_relationships','user_relationship_details'];
        var_dump($permissions);
    }

    public function getRandomTextSwapLine(){
        $lineNo = 6;
        $path = '40/txt/1924.txt';
        $str = file_get_contents(UPLOADS_PATH.'/local/'.$path);
        preg_match_all("/./us", $str, $match);
        $arr = $match[0];
        for ($i=0; $i < count($arr); $i++) { 
          $txt .= $arr[$i];
          if(($i+1)%$lineNo == 0){
            $txt = $txt."\r\n";
          }
        }
        
        echo $txt;
        file_put_contents(UPLOADS_PATH.'/local/40/txt/1.txt', $txt);
    }

    public function UrlGenerate(){
        $url1 = U('Blog/read@blog.thinkphp.cn','id=1');
        $url2 = U('Blog/read#comment?id=1');

        echo $url1.'<br>';
        echo $url2;
    }

    public function zhuanma(){ 
        $str = "简体";
        
        $s = $this -> getFirstCharter($str);

        echo $s;
    }

    public function generateRandNum(){
        for ($i=0; $i < 5; $i++) { 
            //$number = $this -> createRand_hash(1,5);
            //var_dump($number);
            $num = $this -> getRandomSequence(1,10);
            var_dump($num);
        }
    }
      
    //生成特定范围不重复随机数组,hash去重法
    public function createRand_hash($min, $max){
        $hash = array();
        $out = array();
        for($i=$min;$i<=$max;$i++)
        {
            $randnum = rand($min,$max);
            while(@$hash[$randnum]==1)
            {
                $randnum = rand($min,$max);
            }
            $out[] = $randnum;
            @$hash[$randnum]=1;
        }

        return $out;
    }

    public function getRandomSequence($min,$max){
        $sequence = array();
        $out = array();
        for ($i = $min ; $i <= $max ; $i++) { 
            $sequence[$i] = $i;
        }
        
        $end = $max;

        for ($i=$min; $i <= $max; $i++){
            $num = rand($min,$end);
            $out[$i] = $sequence[$num];
            $sequence[$num] = $sequence[$end];
            $end--;
        }

        return $out;
    }

    //随机产生六位数密码Begin
    public function randStr($len=6,$format='ALL') { 
         switch($format) { 
             case 'ALL':
             $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-@#~'; break;
             case 'CHAR':
             $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-@#~'; break;
             case 'NUMBER':
             $chars='0123456789'; break;
             default :
             $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-@#~'; 
             break;
         }
         mt_srand((double)microtime()*1000000*getmypid());
         $password="";
         while(strlen($password)<$len)
            $password.=substr($chars,(mt_rand()%strlen($chars)),1);
         return $password;
    }

    public function convert(){
        define("MEDIAWIKI_PATH", "./Mediawiki/");
        require_once "./Mediawiki/mediawiki-zhconverter.inc.php";
        /* Convert it, valid variants such as zh, zh-hans, zh-hant, zh-cn, zh-tw, zh-sg & zh-hk */
        echo MediaWikiZhConverter::convert("大中国从古相沿，剥中有复：虞、夏、周、秦、汉、三国、两晋。","zh-hant");
    }

}
?>