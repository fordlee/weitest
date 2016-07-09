<?php
// 本类由系统自动生成，仅供测试用途
class FacebookAction extends Action {
	
    public function facebookLogin(){
        /*require_once __DIR__ . '/Facebook/autoload.php';
        $fb = new Facebook\Facebook([
          'app_id' => C('FACEBOOK_APP_ID'),
          'app_secret' => C('FACEBOOK_APP_SECRET'),
          'default_graph_version' => 'v2.4'
          ]);

        $loginHelper = $fb->getRedirectLoginHelper();
        $canvasHelper = $fb->getCanvasHelper();

        $permissions = ['email','user_birthday', 'user_location', 'user_website','user_friends'];
        $info = array(); 
        try {
            if (isset($_SESSION['facebook_access_token'])) {
                $accessToken = $_SESSION['facebook_access_token'];
            } else {
                $accessToken = $loginHelper->getAccessToken();
            }
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
         }

        if (isset($accessToken)) {
            if (isset($_SESSION['facebook_access_token'])) {
                $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
            } else {
                // getting short-lived access token
                $_SESSION['facebook_access_token'] = (string) $accessToken;
                // OAuth 2.0 client handler
                $oAuth2Client = $fb->getOAuth2Client();
                // Exchanges a short-lived access token for a long-lived one
                $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
                $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
                // setting default access token to be used in script
                $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
            }

            // redirect the user back to the same page if it has "code" GET variable
            if (isset($_GET['code'])) {
                header('Location: ./');
            }

            // getting basic info about user
            try {
                $profile_request = $fb->get('/me?fields=id,name,first_name,last_name,email,birthday,website,location');
                $profile = $profile_request->getGraphNode()->asArray();
            } catch(Facebook\Exceptions\FacebookResponseException $e) {
                // When Graph returns an error
                echo 'Graph returned an error: ' . $e->getMessage();
                session_destroy();
                // redirecting user back to app login page
                header("Location: ./");
                exit;
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
                // When validation fails or other local issues
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                exit;
            }
            
            $info['profile'] = $profile;
            // printing $profile array on the screen which holds the basic info about user
            print_r($profile);
            
            // getting profile picture of the user
            try {
                $requestPicture = $fb->get('/me/picture?redirect=false&height=300'); //getting user picture
                $picture = $requestPicture->getGraphUser();
            } catch(Facebook\Exceptions\FacebookResponseException $e) {
                // When Graph returns an error
                echo 'Graph returned an error: ' . $e->getMessage();
                exit;
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
                // When validation fails or other local issues
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                exit;
            }
            
            // showing picture on the screen
            echo "<img src='".$picture['url']."'/>";

            $info['user_picture'] = $picture['url'];
            // saving picture
            $img = __DIR__.'/'.$profile['id'].'.jpg';
            file_put_contents($img, file_get_contents($picture['url']));
            
            // get list of friends' names
            try {
                $requestFriends = $fb->get('/me/invitable_friends?fields=id,name,picture');
                $friends = $requestFriends->getGraphEdge();
            } catch(Facebook\Exceptions\FacebookResponseException $e) {
                // When Graph returns an error
                echo 'Graph returned an error: ' . $e->getMessage();
                exit;
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
                // When validation fails or other local issues
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                exit;
            }

            if ($fb->next($friends)) {
                $allFriends = array();
                $friendsArray = $friends->asArray();
                $allFriends = array_merge($friendsArray, $allFriends);
                while ($friends = $fb->next($friends)) {
                    $friendsArray = $friends->asArray();
                    $allFriends = array_merge($friendsArray, $allFriends);
                }
                foreach ($allFriends as $key) {
                    echo $key['id']."<br>";
                    echo $key['name'] . "<br>";
                    echo "<img src='".$key['picture']['url']."'/><br>";
                }
                echo count($allFriends);
            } else {
                $allFriends = $friends->asArray();
                $totalFriends = count($allFriends);
                foreach ($allFriends as $key) {
                    echo $key['id']."<br>";
                    echo $key['name'] . "<br>";
                    echo "<img src='".$key['picture']['url']."'/><br>";
                }
            }

            $info['allFriends'] = $allFriends;


            
        } else {
            $loginUrl = $loginHelper->getLoginUrl('http://app.mytests.co/facebook/login.php', $permissions);
            echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
        }*/

        $info = file_get_contents(APP_PATH.'Conf/info.json');
        $info = json_decode($info,true);
        return $info;
    }

    private function _getLanguage(){
        if(!empty($_SESSION['language'])){
            $language = $_SESSION['language'];
        }else{
            $language = 'zh';
        }

        return $language;
    }

    public function PaintResult(){
        $info = $this -> facebookLogin();
        $userprofile = $info['user_profile'];
        //$allfirend = $info['allFriends'];
        var_dump($userprofile);
        $qid = $_GET['id'];
        $language = $this -> _getLanguage();
        $m = D('QuestionView');
        $m_a = M('answer');

        $qitem = $m -> where(array('id' => $qid,'language' => $language)) -> find();
        $where = array(
            'qdid' => $qitem['qdid'],
            'qid'  => $qitem['qid']
        );
        $aitem = $m_a -> where($where) -> select();
        $randnum = $this -> _myrand(count($aitem)-1);
        $data = $this -> _replaceVar($json_decode($aitem[$randnum]['optionset'],true));
        var_dump($data);
        /*$data=array(
        array(
            "type"=>"text",
            "attribute"=>array(
                "content"=>"你好，{#minename}今天很开心：",
                "color"=>"#000000",
                "size"=>"20",
                "font"=>"c:/windows/fonts/simhei.ttf",
                "x"=>50,
                "y"=>50
            ),
        ),

        array(
            "type"=>"image",
            "attribute"=>array(
                "content"=>IMAGE_PATH.'/pic.jpg',
                "x"=>250,
                "y"=>0,
                "alpha" => 10,
                "func"=>"round"//round|resize(100,100)|cut
            ),
        ),

        array(
            "type"=>"image",
            "attribute"=>array(
                "content"=>IMAGE_PATH.'/pic.jpg',
                "x"=>0,
                "y"=>100,
                "alpha" => 50,
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
    );*/
        import('ORG.Util.Image.FacebookPaint');
        $image = new FacebookPaint();
        $imgfile=IMAGE_PATH.'/test.jpg';
        $im=imagecreatefromjpeg($imgfile);
        foreach ($data as $k => $v) {
            if($v['type']=="text"){
                $im=$image -> injectText($im,$v['attribute']);
            }elseif($v['type']=="image"){
                $im=$image -> injectImage($im,$v['attribute']);
            }
        }

        //输出图片
        //Header("Content-type: image/jpeg");
        //imagejpeg($im);

        //释放空间
        //ImageDestroy($im); 

    }

    //每隔300秒返回选项随机数
    private function _myrand($length){
        $currentTime = time();
        $changeTime = 300;
        $rand = '';
        if(isset($_SESSION['time'])) {
           if(($currentTime - $_SESSION['time']) >= $changeTime) {
                $_SESSION['time'] = $currentTime;
                  $rand = mt_rand(0, $length);
                  $_SESSION['rand'] = $rand;
           }else{
                   $rand = $_SESSION['rand'];
           }
        }else{
            $_SESSION['time'] = $currentTime;
            $rand = mt_rand(0, $length);
            $_SESSION['rand'] = $rand;
        }

        return $rand;
    }

    private function _replaceVar($data){
        foreach ($data as $k => $v) {
            $content = $v['attribute']['content'];
            echo $content;    
        }

        return $data;
    }

}
?>