<?php
// 本类由系统自动生成，仅供测试用途
class FacebookAction extends Action {
	
    public function facebookLogin(){
        require_once './Facebook/autoload.php';
        $fb = new Facebook\Facebook([
          'app_id' => C('FACEBOOK_APP_ID'),
          'app_secret' => C('FACEBOOK_APP_SECRET'),
          'default_graph_version' => 'v2.4'
          ]);
        
        $loginHelper = $fb->getRedirectLoginHelper();
        $canvasHelper = $fb->getCanvasHelper();

        $permissions = ['email','user_birthday','user_location', 'user_website','user_friends'];
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
            
            $info['user_profile'] = $profile;
            
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

            $info['user_profile']['user_picture'] = $picture['url'];
            
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
            } else {
                $allFriends = $friends->asArray();
            }

            $info['allFriends'] = $allFriends;
            $info = json_decode($info,true);
            return $info;
        } else {
            $loginUrl = $loginHelper->getLoginUrl('http://app.mytests.co/facebook/login.php', $permissions);
        }

        //$info = file_get_contents(APP_PATH.'Conf/info.json');
        //$info = json_decode($info,true);
        //return $info;
    }

    private function _getLanguage(){
        if(!empty($_SESSION['language'])){
            $language = $_SESSION['language'];
        }else{
            $language = 'zh';
        }

        return $language;
    }

    public function paintResult(){
        $info = $this -> facebookLogin();
        
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
        
        //随机获取答案
        $randnum = $this -> _myrand(count($aitem)-1);
        
        $optionresult = $aitem[$randnum]['optionresult'];
        $data = json_decode($aitem[$randnum]['optionset'],true);

        $uid = $info['user_profile']['id'];
        $_SESSION['uid'] = $uid;
        $foldername = substr($uid,-2);
        $path = IMAGE_PATH.'/'.$foldername;

        //生成文件夹
        if(!is_dir($path)){
            mkdir($path,0777,true);
        }

        //判断本地文件
        $filenameArr = array(
            'uid'  => $info['user_profile']['id'],
            'qid'  => $qitem['qid'],
            'qdid' => $qitem['qdid']
        );
        $filepath = $this -> _getFilename($path,$filenameArr);
        if(!file_exists($filepath)){
            $this -> _createSavePic($info,$data,$filepath);
        }
        
        //返回json格式数据
        $filepathJson = $this -> _filepathToJson($filepath,$optionresult);
        echo $filepathJson;
    }

    private function _getFilename($path, $filenameArr){
        $filename = implode("_", $filenameArr);
        $filepath = $path.'/'.$filename.'.jpg';

        return $filepath;
    }

    private function _filepathToJson($filepath,$optionresult){
        $filepath = str_replace('./', '/weitest/', $filepath);
        $filepath = json_encode(array('path' => $filepath.'?t='.rand(1,100), 'result' => $optionresult));

        return $filepath;
    }

    private function _createSavePic($info,$data,$filepath){
        import('ORG.Util.Image.FacebookPaint');
        $image = new FacebookPaint();
        $imgfile=IMAGE_PATH.'/test.jpg';
        $im=imagecreatefromjpeg($imgfile);
        
        //系统随机变量
        $_SESSION['_RAND']=array();

        foreach ($data as $k => $v) {
            $content = $this -> _setSysParam($v['attribute']['content'],$info);
            if($v['type']=="text"){
                $v['attribute']['font'] = FONT_PATH.'/'.$v['attribute']['font'];
                $im=$image -> injectText($im,$v['attribute'],$content);
            }elseif($v['type']=="image"){
                $im=$image -> injectImage($im,$v['attribute'],$content);
            }
        }
        
        unset($_SESSION['_RAND']);
        
        //保存图片
        imagejpeg($im,$filepath);
        imagedestroy($im);
    }

    //返回选项随机数
    private function _myrand($length){
        $currentTime = time();
        $changeTime = 0;
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

    //设置内容内置系统变量
    private function _setSysParam($content='', $apiData){
        //$content="姓名：{#user_profile.name}，生日：{#user_profile.birthday.date|strtotime=###;date=Y/m/d,###}，是最帅的人！{#SYSTEM.rand(100,200)}";
        preg_match_all('/{#(.*?)}/im',$content, $match);
        $match=@$match[1];

        //解析并处理系统变量内容
        foreach ($match as $key => $value) {
            $_sep=explode('|', $value);
            $_paramArr=explode('.', $_sep[0]);
            $_fun=@$_sep[1];

            //调用系统函数
            if($_paramArr[0]=='SYSTEM'){
                preg_match_all('/(\w+)/im', $_paramArr[1], $sysFun);
                $sysFun=$sysFun[0][0];
                $sysParam=$this -> _getStrParam($_paramArr[1]);

                if($sysFun)$_param=@call_user_func_array($sysFun,$sysParam);

                $content=str_replace('{#'.$value.'}', $_param, $content);
                continue;
            }

            //获取系统变量
            $_param=$apiData;
            foreach ($_paramArr as $key1 => $value1) {

                //处理数据中的随机数
                preg_match_all('/^_?RAND(\((\d+)\))?/m', $value1, $match);
                if($match[0]){

                    $_index=$match[2][0];

                    if(isset($_index)&&$_index!=''){ //获取已存的RAND数据
                        $_rand=$_SESSION['_RAND'][$_index];
                    }else{
                        $_len=count($_param);
                        $_rand=rand(0,$_len-1);
                        array_push($_SESSION['_RAND'], $_rand);
                    }

                    $_param=$_param[$_rand];
                    continue;
                }

                $_param=@$_param[$value1];
                if(empty($_param)){
                    $_param='';
                    break;
                }
            }

            //调用后续处理函数
            if($_fun){
                $_funArr=explode(';',$_fun);

                foreach ($_funArr as $key2 => $value2) {
                    $_funSep=explode('=',$value2);
                    $_funParam=@$_funSep[1]?explode(',',$_funSep[1]):array();

                    //检查参数中的预置当前参数###
                    foreach ($_funParam as $key3 => $value3) {
                        if($value3=='###'){
                            $_funParam[$key3]=&$_param;
                        }
                    }
                    $_param=@call_user_func_array($_funSep[0],$_funParam);
                    unset($_funParam);
                }
            }

            //置换内容中系统变量
            $content=str_replace('{#'.$value.'}', $_param, $content);
            unset($_param);
        }

        $content=preg_replace('/{#(.*?)}/im', '', $content);
        
        return $content;
    }

    //获取函数参数列表
    private function _getStrParam($str){
        preg_match_all('/(\d+)/im', $str, $match);
        return $match[0];
    }

}
?>