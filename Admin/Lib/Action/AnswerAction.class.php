<?php
// 本类由系统自动生成，仅供测试用途
class AnswerAction extends Action {
	public function __construct() {
        parent::__construct();
        $this->CheckmSession();
    }

    private function CheckmSession(){
        if(!isset($_SESSION['email'])&& !isset($_SESSION['login']) && $_SESSION['login'] !== true){
            $this -> error('抱歉!您还没有登录或登录超时，请重新登录！',U('Auth/login'));
        }
    }

    public function answerentry(){
    	$qid = $_GET['id'];
        
    	$this -> assign('qid', $qid);
    	$this -> display();
    }

    public function answerentrysave(){
        $options = $_POST['option'];
        if(!in_array('', $options)){
            import('ORG.Net.UploadFile');
            $upload = new UploadFile();
            $upload->maxSize  = 3145728 ;
            $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');
            $upload->uploadReplace = true;
            $upload->savePath = UPLOADS_PATH."/imgA/";
            $isupload = $upload->upload();
            if($isupload){
                $info = $upload->getUploadFileInfo();
            }else{
                $info = null;
            }

            $m_a = M('answer');
            $qid = $_POST['qid'];
            $qdid = $_POST['qdid'];
            $optionset = $_POST['optionset'];
            foreach ($options as $k => $v) {
                $item = array(
                    'qid' => $qid,
                    'qdid'=> $qdid,
                    'optionresult' => $v
                );
                if($info !== null){
                    $item['answerpic'] = '/weitest/Uploads/imgA/'.$info[$k]['savename'];
                }else{
                    $item['answerpic'] = NULL;
                }
                $item['optionset'] = $optionset[$k];
                $ret = $m_a -> where($item) -> find();
                if($ret == null ){
                    $m_a -> add($item);
                }
            }

            $this -> success('操作成功！', U('Question/questionlist'));
        }else{
            $this -> error('选项内容不能为空！',U('Question/questionlist'));
        }
        
    }

    public function editResult(){
        $qid = $_GET['qid'];
        $qdid = $_GET['qdid'];

        $m_q_d = M('question_detail');
        $m_a = M('answer');

        $qdItem = $m_q_d -> where(array('id' => $qdid)) -> find();
        $aItem = $m_a -> where(array('qid' => $qid, 'qdid' => $qdid)) -> select();
        
        $this -> assign('qdItem', $qdItem);
        $this -> assign('aItem', $aItem);
        
        $this -> display('Answer/answeredit');
    }

    public function answereditsave(){
        $options = $_POST['option'];
        if(!in_array('', $options)){
            import('ORG.Net.UploadFile');
            $upload = new UploadFile();
            $upload->maxSize  = 3145728 ;
            $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');
            $upload->uploadReplace = true;
            $upload->savePath = UPLOADS_PATH."/imgA/";
            $isupload = $upload->upload();
            if($isupload){
                $info = $upload->getUploadFileInfo();
            }else{
                $info = null;
            }

            $m_a = M('answer');
            $aids = $_POST['aid'];
            $optionset = $_POST['optionset'];
            foreach ($options as $k => $v) {
                $item = array(
                    'id' => $aids[$k],
                    'optionresult' => $v
                );
                $ret = $m_a -> where('id='.$aids[$k]) -> find();
                if($info !== NULL){
                    $item['answerpic'] = '/weitest/Uploads/imgA/'.$info[$k]['savename'];
                }else{
                    $item['answerpic'] = $ret['answerpic'];
                }
                $item['optionset'] = $optionset[$k];
                $m_a -> where(array('id' => $aids[$k])) -> save($item);
            }
            $this -> success('操作成功！', U('Question/questionlist'));
        }else{
            $this -> error('选项内容不能为空！',U('Question/questionlist'));
        }
    }


}
?>