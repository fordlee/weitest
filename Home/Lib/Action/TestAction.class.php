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

    public function tojson(){
        $json = '{
  "data": [
    {
      "height": 260,
      "images": [
        {
          "height": 260,
          "source": "https://scontent.xx.fbcdn.net/v/t1.0-9/14322471_279888655737712_8232094000562333041_n.jpg?oh=8d3428986571c0d21e8a4ac987213264&oe=587A37AC",
          "width": 430
        },
        {
          "height": 130,
          "source": "https://fbcdn-photos-d-a.akamaihd.net/hphotos-ak-xtp1/v/t1.0-0/q86/p130x130/14322471_279888655737712_8232094000562333041_n.jpg?oh=0d5bf456dba93bc86d1bb1263495f92c&oe=5884EE60&__gda__=1480110425_15ddfae7eab3cbf4fd28f16be549752b",
          "width": 215
        },
        {
          "height": 225,
          "source": "https://fbcdn-photos-d-a.akamaihd.net/hphotos-ak-xtp1/v/t1.0-0/q86/p75x225/14322471_279888655737712_8232094000562333041_n.jpg?oh=dfdf3653aaafe3b9aa1f800f1604670c&oe=586C5F0B&__gda__=1484214740_e9c3a3a6440925d4a55fe29534e42298",
          "width": 372
        }
      ],
      "id": "279888655737712",
      "picture": "https://fbcdn-photos-d-a.akamaihd.net/hphotos-ak-xtp1/v/t1.0-0/q86/s130x130/14322471_279888655737712_8232094000562333041_n.jpg?oh=476bf218723b713aa0584b053cacb850&oe=5874D573&__gda__=1483709514_607b453f59a4d8d5117372054a7255f8",
      "width": 430
    },
    {
      "height": 319,
      "images": [
        {
          "height": 319,
          "source": "https://scontent.xx.fbcdn.net/v/t1.0-9/13697051_244767759249802_2298796202945580945_n.jpg?oh=9e1763edef042883cd1936a3f2591037&oe=58822310",
          "width": 320
        },
        {
          "height": 130,
          "source": "https://fbcdn-photos-d-a.akamaihd.net/hphotos-ak-xta1/v/t1.0-0/p130x130/13697051_244767759249802_2298796202945580945_n.jpg?oh=f5c79bfd7455a6011a4cb56c960157c8&oe=58693E9E&__gda__=1484034539_e1991ac39f8398f58f670a90669db0e6",
          "width": 130
        },
        {
          "height": 225,
          "source": "https://fbcdn-photos-d-a.akamaihd.net/hphotos-ak-xta1/v/t1.0-0/p75x225/13697051_244767759249802_2298796202945580945_n.jpg?oh=ae1d34b601f530ba8c507a6bdd9df5ce&oe=587307EA&__gda__=1485190175_b4348d3d3176ddb6f6d1f0043cfe00ae",
          "width": 225
        }
      ],
      "id": "244767759249802",
      "picture": "https://fbcdn-photos-d-a.akamaihd.net/hphotos-ak-xta1/v/t1.0-0/s130x130/13697051_244767759249802_2298796202945580945_n.jpg?oh=e6a63b50fb58f0e50ebeacd88247058e&oe=58669D8D&__gda__=1484993784_7f8d4cbddfbb8d77c18ef72f57432ee6",
      "width": 320
    },
    {
      "height": 400,
      "images": [
        {
          "height": 400,
          "source": "https://scontent.xx.fbcdn.net/v/t1.0-9/13718729_244583489268229_9189842162441565712_n.jpg?oh=4a0cb906a0e3df8f5c70f66eb184a6d6&oe=587E477D",
          "width": 400
        },
        {
          "height": 320,
          "source": "https://fbcdn-photos-b-a.akamaihd.net/hphotos-ak-xta1/v/t1.0-0/q82/p320x320/13718729_244583489268229_9189842162441565712_n.jpg?oh=72a70c1a9d511dad90b0e6e19ecf192d&oe=587A1F63&__gda__=1483404126_ccc793e3e1707d7aeb4a7425a0444975",
          "width": 320
        },
        {
          "height": 130,
          "source": "https://fbcdn-photos-b-a.akamaihd.net/hphotos-ak-xta1/v/t1.0-0/q82/p130x130/13718729_244583489268229_9189842162441565712_n.jpg?oh=65e2281626f1da18804b100f03b3e6e2&oe=586DC20C&__gda__=1483874609_c0801d4bc739a0fa9f3e32b2f5fa4742",
          "width": 130
        },
        {
          "height": 225,
          "source": "https://fbcdn-photos-b-a.akamaihd.net/hphotos-ak-xta1/v/t1.0-0/q82/p75x225/13718729_244583489268229_9189842162441565712_n.jpg?oh=6d3d6b995946642bd3ac3e80838486e6&oe=583B1364&__gda__=1484388184_d8d69020d94ca25905406495c1bbde9a",
          "width": 225
        }
      ],
      "id": "244583489268229",
      "picture": "https://fbcdn-photos-b-a.akamaihd.net/hphotos-ak-xta1/v/t1.0-0/q82/p130x130/13718729_244583489268229_9189842162441565712_n.jpg?oh=65e2281626f1da18804b100f03b3e6e2&oe=586DC20C&__gda__=1483874609_c0801d4bc739a0fa9f3e32b2f5fa4742",
      "width": 400
    },
    {
      "height": 150,
      "images": [
        {
          "height": 150,
          "source": "https://scontent.xx.fbcdn.net/v/t1.0-9/13501758_231887937204451_1288020650114524226_n.jpg?oh=50cb62e373e1cc827e9c21b7abe83b43&oe=583B1387",
          "width": 150
        },
        {
          "height": 130,
          "source": "https://fbcdn-photos-b-a.akamaihd.net/hphotos-ak-xfp1/v/t1.0-0/p130x130/13501758_231887937204451_1288020650114524226_n.jpg?oh=a7a0dfa238cce3a3e415d6f5a5bb651c&oe=587AC809&__gda__=1483032377_22ca31d338a19e72acdb5c6cd0ea5034",
          "width": 130
        }
      ],
      "id": "231887937204451",
      "picture": "https://fbcdn-photos-b-a.akamaihd.net/hphotos-ak-xfp1/v/t1.0-0/p130x130/13501758_231887937204451_1288020650114524226_n.jpg?oh=a7a0dfa238cce3a3e415d6f5a5bb651c&oe=587AC809&__gda__=1483032377_22ca31d338a19e72acdb5c6cd0ea5034",
      "width": 150
    },
    {
      "height": 150,
      "images": [
        {
          "height": 150,
          "source": "https://fbcdn-sphotos-a-a.akamaihd.net/hphotos-ak-xpf1/v/t1.0-9/13507143_231887927204452_8019873520003847226_n.jpg?oh=c31948f8ba882bcb417de664d878971c&oe=5866D702&__gda__=1484387176_5f0400f29ba90cf9db76dfb33c0f4859",
          "width": 150
        },
        {
          "height": 130,
          "source": "https://fbcdn-photos-b-a.akamaihd.net/hphotos-ak-xpf1/v/t1.0-0/p130x130/13507143_231887927204452_8019873520003847226_n.jpg?oh=25f93106bd586ce9e8dbd8bf03fe71d2&oe=5873FB8C&__gda__=1484835633_a55f95243608220e89ed3a172c43929f",
          "width": 130
        }
      ],
      "id": "231887927204452",
      "picture": "https://fbcdn-photos-b-a.akamaihd.net/hphotos-ak-xpf1/v/t1.0-0/p130x130/13507143_231887927204452_8019873520003847226_n.jpg?oh=25f93106bd586ce9e8dbd8bf03fe71d2&oe=5873FB8C&__gda__=1484835633_a55f95243608220e89ed3a172c43929f",
      "width": 150
    },
    {
      "height": 150,
      "images": [
        {
          "height": 150,
          "source": "https://scontent.xx.fbcdn.net/v/t1.0-9/13528904_231887920537786_6770763257873508929_n.jpg?oh=19bdebb11e59048df93d46b4bee7c3db&oe=583A0916",
          "width": 150
        },
        {
          "height": 130,
          "source": "https://fbcdn-photos-a-a.akamaihd.net/hphotos-ak-xaf1/v/t1.0-0/p130x130/13528904_231887920537786_6770763257873508929_n.jpg?oh=66c0ed5a47836b6922b2fc474c06904e&oe=586ECA98&__gda__=1483089535_70a39c113b5bbeb1a2458420b438e6fa",
          "width": 130
        }
      ],
      "id": "231887920537786",
      "picture": "https://fbcdn-photos-a-a.akamaihd.net/hphotos-ak-xaf1/v/t1.0-0/p130x130/13528904_231887920537786_6770763257873508929_n.jpg?oh=66c0ed5a47836b6922b2fc474c06904e&oe=586ECA98&__gda__=1483089535_70a39c113b5bbeb1a2458420b438e6fa",
      "width": 150
    },
    {
      "height": 150,
      "images": [
        {
          "height": 150,
          "source": "https://scontent.xx.fbcdn.net/v/t1.0-9/13567428_231887900537788_3287238606832633954_n.jpg?oh=b7dfe4ea0281e8610813b1f178d4b7ce&oe=58771F23",
          "width": 150
        },
        {
          "height": 130,
          "source": "https://fbcdn-photos-c-a.akamaihd.net/hphotos-ak-xft1/v/t1.0-0/p130x130/13567428_231887900537788_3287238606832633954_n.jpg?oh=1b4ca4e600dab9f0bfcfcbb9084ce2bb&oe=586D0DAD&__gda__=1484219327_e17c66d77c2c26cfd9985640732684a9",
          "width": 130
        }
      ],
      "id": "231887900537788",
      "picture": "https://fbcdn-photos-c-a.akamaihd.net/hphotos-ak-xft1/v/t1.0-0/p130x130/13567428_231887900537788_3287238606832633954_n.jpg?oh=1b4ca4e600dab9f0bfcfcbb9084ce2bb&oe=586D0DAD&__gda__=1484219327_e17c66d77c2c26cfd9985640732684a9",
      "width": 150
    },
    {
      "height": 150,
      "images": [
        {
          "height": 150,
          "source": "https://fbcdn-sphotos-g-a.akamaihd.net/hphotos-ak-xpt1/v/t1.0-9/13524277_231887897204455_6233524616373715895_n.jpg?oh=c5fb007081521abedfbb38279048d0df&oe=58739996&__gda__=1483444626_121c1e9544c9b9c958f4274f76623068",
          "width": 150
        },
        {
          "height": 130,
          "source": "https://fbcdn-photos-d-a.akamaihd.net/hphotos-ak-xpt1/v/t1.0-0/p130x130/13524277_231887897204455_6233524616373715895_n.jpg?oh=441cfb4db47a7a3110528ce1f40ff454&oe=587BC518&__gda__=1483536190_d3145cac2eb8dfee716bc2b4f1d026d1",
          "width": 130
        }
      ],
      "id": "231887897204455",
      "picture": "https://fbcdn-photos-d-a.akamaihd.net/hphotos-ak-xpt1/v/t1.0-0/p130x130/13524277_231887897204455_6233524616373715895_n.jpg?oh=441cfb4db47a7a3110528ce1f40ff454&oe=587BC518&__gda__=1483536190_d3145cac2eb8dfee716bc2b4f1d026d1",
      "width": 150
    },
    {
      "height": 150,
      "images": [
        {
          "height": 150,
          "source": "https://scontent.xx.fbcdn.net/v/t1.0-9/13533068_231887887204456_4958703333009604731_n.jpg?oh=e3aac4509a393e5f0b85693843c5d416&oe=58849FC7",
          "width": 150
        },
        {
          "height": 130,
          "source": "https://fbcdn-photos-d-a.akamaihd.net/hphotos-ak-xfa1/v/t1.0-0/p130x130/13533068_231887887204456_4958703333009604731_n.jpg?oh=cb9b6580f0744f9a07d2a92447c709dc&oe=586A6F49&__gda__=1483470235_09a21fb4873aafa871425d1c656d7f19",
          "width": 130
        }
      ],
      "id": "231887887204456",
      "picture": "https://fbcdn-photos-d-a.akamaihd.net/hphotos-ak-xfa1/v/t1.0-0/p130x130/13533068_231887887204456_4958703333009604731_n.jpg?oh=cb9b6580f0744f9a07d2a92447c709dc&oe=586A6F49&__gda__=1483470235_09a21fb4873aafa871425d1c656d7f19",
      "width": 150
    },
    {
      "height": 400,
      "images": [
        {
          "height": 400,
          "source": "https://scontent.xx.fbcdn.net/v/t1.0-9/13592822_231887847204460_635765182377136649_n.jpg?oh=855f54ab40c6cd89a89f71f9a1f8aad6&oe=587B1C3E",
          "width": 521
        },
        {
          "height": 320,
          "source": "https://fbcdn-photos-c-a.akamaihd.net/hphotos-ak-xat1/v/t1.0-0/q85/p320x320/13592822_231887847204460_635765182377136649_n.jpg?oh=be8d4bbc86f1976f2fa3f8d14fafbfbf&oe=58683125&__gda__=1483331302_977a8b801e1e2e0ad4ca06dda87220e1",
          "width": 416
        },
        {
          "height": 130,
          "source": "https://fbcdn-photos-c-a.akamaihd.net/hphotos-ak-xat1/v/t1.0-0/q85/p130x130/13592822_231887847204460_635765182377136649_n.jpg?oh=0d22a273d99ce30c4dcbd5fd74c2860d&oe=5839A0B5&__gda__=1483742582_f7853a6a18c5853da7ea2abfe8827505",
          "width": 169
        },
        {
          "height": 225,
          "source": "https://fbcdn-photos-c-a.akamaihd.net/hphotos-ak-xat1/v/t1.0-0/q85/p75x225/13592822_231887847204460_635765182377136649_n.jpg?oh=21b313d4a3868041ab6fdf924c62d63d&oe=5868EAA2&__gda__=1480111779_d06bcbb627d451f8b436d9c266da3fd6",
          "width": 293
        }
      ],
      "id": "231887847204460",
      "picture": "https://fbcdn-photos-c-a.akamaihd.net/hphotos-ak-xat1/v/t1.0-0/q85/s130x130/13592822_231887847204460_635765182377136649_n.jpg?oh=ab3c08db42e95bbd3904ac874c2d486e&oe=587C8200&__gda__=1484481219_7001b84da0310693bd431bafce026e8b",
      "width": 521
    }
  ],
  "paging": {
    "cursors": {
      "before": "Mjc5ODg4NjU1NzM3NzEy",
      "after": "MjMxODg3ODQ3MjA0NDYw"
    },
    "next": "https://graph.facebook.com/v2.4/233548593705052/photos?access_token=EAACEdEose0cBABFtssLBJdZCEzd3yjaM7k4DP8nwU5ILpIJDqmORqzhCCMV0ZCWhznPMRhy6YhPYh4MToUJBZCqmK8MZCdhHHXoOhUnaZCQaHTCKpYerzPiYvqt3oYVu1ljmxZAA9fBkIgxwaZCB6iZAQbkwMo88PIibvNV73PTGiQZDZD&pretty=0&fields=height%2Cimages%2Cid%2Cpicture%2Cwidth&type=uploaded&limit=10&after=MjMxODg3ODQ3MjA0NDYw"
  }
}';

$info['user_upload_photos'] = json_decode($json,true);
var_dump($info);
$ret = json_encode($info);
echo $ret;
    }

}
?>