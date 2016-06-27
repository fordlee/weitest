<?php
// 本类由系统自动生成，仅供测试用途
class QuestionAction extends Action {
	public function __construct() {
        parent::__construct();
        $this->CheckmSession();
    }

    private function CheckmSession(){
        if(!isset($_SESSION['username'])&& !isset($_SESSION['login']) && $_SESSION['login'] !== true){
            $this -> error('抱歉!您还没有登录或登录超时，请重新登录！',U('Auth/login'));
        }
    }

    public function questionlist(){
        
        $this -> display();
    }

    public function questionentry(){
        if(isset($_POST['portraitLocal']) && !empty($_POST['portraitLocal'])
            && isset($_POST['portraitSize']) && !empty($_POST['portraitSize'])
            && isset($_POST['nameLocal']) && !empty($_POST['nameLocal'])
            && isset($_POST['namesize']) && !empty($_POST['namesize'])){
        $m_q = M('question');
        $user = $_POST['user'];
        $portraitLocal = $_POST['portraitLocal'];
        $portraitSize = $_POST['portraitSize'];
        $relation = $_POST['relation'];
        $nameLocal = $_POST['nameLocal'];
        $namesize = $_POST['namesize'];

        $user = array(
            'portraitLocal' => $portraitLocal,
            'portraitSize'  => $portraitSize,
            'relation'      => $relation,
            'namesize'      => $namesize
        );

        $set = json_encode($user);
        echo $set;
        $filenames = $this -> _upform1file();
        $data = array(
            'icon' => $filenames['icon'],
            'bgpic' => $filenames['back'],
            'generalset' =>  $set 
        );
        
        var_dump($data);
        //die();
        //$m_q -> add($data);
        }else{
            $this -> display();
        }
        
    }

    private function _upform1file(){
        if($_FILES["file"]["error"] > 0){
            $this -> error("Return Code: " . $_FILES["file"]["error"],'questionentry');
        }else{
            $iconfile = time().substr($_FILES['iconfile']['name'], strrpos($_FILES['iconfile']['name'],'.'));
            $backfile = time().substr($_FILES['backfile']['name'], strrpos($_FILES['backfile']['name'],'.'));
        }
        
        $response = array();
        $iconfilepath = ROOTPATH.'/Upload/image/icon/';
        if (!file_exists($iconfilepath)){
            mkdir($iconfilepath, 0777, true);
        }
        $backfilepath = ROOTPATH.'/Upload/image/back/';
        if(!file_exists($backfilepath)){
            mkdir($backfilepath, 0777, true);
        }
        $isupicon = move_uploaded_file($_FILES['iconfile']['tmp_name'], $iconfilepath.$iconfile);
        $isupback = move_uploaded_file($_FILES['backfile']['tmp_name'], $backfilepath.$backfile);
        if($isupicon && $isupback){
            $response['isSuccess'] = true;
            $filenames['icon'] = $iconfile;
            $filenames['back'] = $backfile;
        }else{
            $response['isSuccess'] = false;
        }
        return $filenames;
        echo json_encode($response);
    }

    private function _upform2file(){

    }

}