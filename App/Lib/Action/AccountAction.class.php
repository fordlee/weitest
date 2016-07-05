<?php
// 本类由系统自动生成，仅供测试用途
class AccountAction extends Action {

	public function __construct() {
        parent::__construct();
        $this->CheckmSession();
    }

    private function CheckmSession(){
        if(!isset($_SESSION['username'])&& !isset($_SESSION['login']) && $_SESSION['login'] !== true){
            $this -> error('抱歉!您还没有登录或登录超时，请重新登录！',U('Auth/login'));
        }
    }

    public function adminlist(){
    	$m = M('admin');
    	$adminlist = $m -> select();
        
        $this -> assign('adminlist',$adminlist);
        $this -> display();
    }

    public function add(){
    	if((isset($_POST['email']) && !empty($_POST['email']))
    		&&(isset($_POST['password']) && !empty($_POST['password']))){
    		$name = $_POST['fullname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $telephone = $_POST['tel'];
    		$level = $_POST['level'];
    		$item = array(
    			"name" => $name,
                "email" => $email,
                "password" => $password,
                "telephone" => $telephone,
    			"level" => $level,
    			"time" => date('Y-m-d H:i:s')
    		);
            $m = M('admin');
            $ret = $m -> where(array("email" => $email)) -> find();
            
    		if($ret == null){
    			$m_u -> add($item);
    			$this -> success('添加成功！','list');
    		}else{
    			$this -> error('该邮箱已经使用！');
    		}
    	}else{
            
    		$this -> display();
    	}
    }

    public function edit(){
        if((isset($_POST['email']) && !empty($_POST['email']))
            &&(isset($_POST['password']) && !empty($_POST['password']))){
            $id = $_POST['id'];
            $name = $_POST['fullname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $telephone = $_POST['tel'];
            $level = $_POST['level'];
            $item = array(
                "id" => $id,
                "name" => $name,
                "email" => $email,
                "password" => $password,
                "telephone" => $telephone
            );
            $m = M('admin');
            $ret = $m -> where($item) -> find();
            if($ret == null){
                $m -> where('id='.$id) -> save($item);
                $this -> success('修改成功！','list');
            }else{
                $this -> error('没有修改内容！');
            }
        }else{
            $id = $_GET['id'];
            $email = $_SESSION['email'];
            $m = M('admin');
            $ret = $m -> where('id='.$id) -> find();
            
            $this -> assign('adminInfo',$ret);
            $this -> display();
            
        }
    }


    public function del(){
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $id = $_GET['id'];
            $email = $_SESSION['email'];
            $where = array(
                "id" => $id,
                "email" => $email
            );
            $m = M('admin');
            $ret = $m_u -> where($where) -> delete();
            if($ret == false){
                $this -> error('你不能够删除他人信息！');
            }else{
                $this -> success('删除成功！');
            }
        }else{
            $this -> error('操作失败！');
        }
    }

}