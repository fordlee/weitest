<?php
// 本类由系统自动生成，仅供测试用途
class MytestsAction extends Action {
	
    public function index(){
        $this -> display('Mytests/demo');
    }

    public function facebookLogin(){

        $info = file_get_contents(APP_PATH.'Conf/info.json');
        $info = json_decode($info,true);
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
        //$this -> assign('srcPath',$filepath);
        //$this -> display('demo');
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

    public function storeJson(){
        if(@isset($_POST['codeContent'])){
            $content=@$_POST['codeContent'];
            $data=json_decode($content,true);
            
            header('Content-type: text/json');

            if(count($data)>=1){
                file_put_contents('temp.json', $content);
                echo json_encode(array(
                    'error'=>0,
                    'content'=>'Json 存储成功'
                ));
            }else{
                echo json_encode(array(
                    'error'=>1,
                    'content'=>'Json 格式或内容有误'
                ));
            }
            exit;
        }
    }

    public function upLoadZip(){
        if(@$_FILES){
            $content=@$_FILES["demoZip"];
            $file=$content['tmp_name'];
            if($file){
                $file=$content['tmp_name'];
                $res=unzip_file($file,'upload/_temp/');
            }
            
            header("Content-type: text/html; charset=utf-8");

            if(@$res['status']){
                var_dump(array(
                    'error'=>0,
                    'content'=>'文件解压成功!'
                ));
                echo '<style type="text/css">.xdebug-var-dump{background: #B7FDB7;}</style>';
            }else{
                var_dump(array(
                    'error'=>1,
                    'content'=>'压缩文件有误'
                ));
                echo '<style type="text/css">.xdebug-var-dump{background: #FBD1C7;}</style>';
            }

            echo '<br>3s后返回...<script type="text/javascript">setTimeout(function(){history.go(-1);},3000)</script>';
            exit;
        }
    }


}
?>