<?php
// 本类由系统自动生成，仅供测试用途
class MytestsAction extends Action {
	
    public function index(){
        $this -> display('Mytests/demo');
    }

    public function facebookLogin(){

        $info = file_get_contents(APP_PATH.'Conf/info.json');
        $info = json_decode($info,true);
        //{#user_albums.albums.0.photos.0.images.1.source}
        //var_dump($info['user_albums']['albums'][0]['photos'][0]['images']);
        return $info;
    }

    public function paintResult(){
        $info = $this -> facebookLogin();
        //var_dump($info);
        $data = file_get_contents(UPLOADS_PATH.'/answer.json');
        $data = json_decode($data,true);
        //var_dump($data);die();
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
            'qid'  => 'qt',
            'qdid' => 'qdt'
        );
        $filepath = $this -> _getFilename($path,$filenameArr);
        $this -> _createSavePic($info,$data,$filepath);

        $filepath = $this -> _filepathSwap($filepath);
        
        echo "<img src='$filepath'>";
    }

    private function _getFilename($path, $filenameArr){
        $filename = implode("_", $filenameArr);
        $filepath = $path.'/'.$filename.'.jpg';

        return $filepath;
    }

    private function _filepathSwap($filepath){
        $filepath = str_replace('./', '/', $filepath);

        return $filepath;
    }

    private function _createSavePic($info,$data,$filepath){
        import('ORG.Util.Image.FacebookPaint');
        $image = new FacebookPaint();
        $imgfile=UPLOADS_PATH.'/local/white.jpg';
        //$imgfile=UPLOADS_PATH.'/4cat/360423.jpg';
        $im=imagecreatefromjpeg($imgfile);
        //$im=imagecreatefrompng($imgfile);
        //系统随机变量
        $_SESSION['_RAND']=array();
        $_SESSION['_SRAND']=array();

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
        unset($_SESSION['_SRAND']);
        
        //保存图片
        imagejpeg($im,$filepath);
        //imagepng($im,$filepath);
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

            //调用PHP系统函数
            if($_paramArr[0]=='SYSTEM'){
                preg_match_all('/(\w+)/im', $_paramArr[1], $sysFun);
                $sysFun=$sysFun[0][0];
                $sysParam=$this -> _getStrParam($_paramArr[1]);
                
                if(!$sysFun)continue;

                //处理数据中的随机数
                if($sysFun=='rand'||$sysFun=='_rand'){
                    if($sysFun=='_rand'){//获取已存的SRAND数据
                        $_param=@$_SESSION['_SRAND'][$sysParam[0]];
                    }else{
                        $_param=$this -> _getUniqueRand($sysParam,'_SRAND');
                    }
                }else{
                    $_param=@call_user_func_array($sysFun,$sysParam);
                }

            }else{

                //获取用户数据系统变量
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
                            $_rand=$this ->_getUniqueRand(array(0,$_len),'_RAND');
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
        $pos=strpos($str,'(');
        if($pos>=0){
            $_str=explode('(', $str);
            $str=$_str[1];
        }
        preg_match_all('/(\w+)/im', $str, $match);
        return $match[0];
    }

    //生成不重复随机数
    private function _getUniqueRand($param,$SessionTag=''){
        $min=$param[0];
        $max=$param[1];

        $_arr=range($min,$max);
        $_sRand=$_SESSION[$SessionTag]?$_SESSION[$SessionTag]:array();

        //var_dump($_arr);exit;
        $_arr=array_merge(array_diff($_arr,$_sRand),array_diff($_sRand,$_arr));
        $_len=count($_arr);
        $_rand=@$_arr[rand(0,$_len-1)];

        array_push($_SESSION[$SessionTag], $_rand);
        return $_rand;
    }


}
?>