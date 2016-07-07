<?php
// 本类由系统自动生成，仅供测试用途
class QuestionAction extends Action {
	public function __construct() {
        parent::__construct();
        $this->CheckmSession();
    }

    private function CheckmSession(){
        if(!isset($_SESSION['email'])&& !isset($_SESSION['login']) && $_SESSION['login'] !== true){
            $this -> error('抱歉!您还没有登录或登录超时，请重新登录！',U('Auth/login'));
        }
    }

    public function questionlist(){
        $m_q = M('question');
        $list = $m_q -> field('id,qcode,status') -> select();

        $m_q_d = M('question_detail');
        foreach ($list as $k => $v) {
            $ret = $m_q_d -> where(array('qid'=>$v['id'])) -> select();
            $list[$k]['qd'] = $ret;
        }
        
        $this -> assign('list', $list);
        $this -> display();
    }

    public function questionentry(){
        
        $this -> display('questionentry');
    }

    public function questionentrysave(){
        import('ORG.Net.UploadFile');
        $upload = new UploadFile();
        $upload->maxSize  = 3145728;
        $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');
        $upload->uploadReplace = true;
        $upload->savePath = UPLOADS_PATH."/imgQ/";
        if(!$upload->upload()) {
            $this->error($upload->getErrorMsg());
        }else{
            $info =  $upload->getUploadFileInfo();
        }
        
        $qcode = $_POST['qcode'].'_'.uniqid();

        $data = $_POST;
        $generalset = $this -> _getGeneralSet($data);
        $generalsetjson = json_encode($generalset);

        $icon = '/weitest/Uploads/imgQ/'.$info[0]['savename'];
        $bgpic = '/weitest/Uploads/imgQ/'.$info[1]['savename'];

        $item = array(
            'qcode' => $qcode,
            'icon'  => $icon,
            'bgpic' => $bgpic,
            'generalset' => $generalsetjson,
            'status' => 1,
            'date' => date('Y-m-d')
        );
        
        $m_q = M('question');
        $ret = $m_q -> add($item);
        
        if($ret != false){
            $this -> success('添加成功！');
        }else{
            $this -> error('添加失败！');
        }
    }

    public function questionedit(){
        $m_q = M('question');
        $qcodes = $m_q -> field('qcode') -> select();

        $this -> assign('qcodes', $qcodes);
        $this -> display('questionentry');
    }

    public function questionentryedit(){
        import('ORG.Net.UploadFile');
        $upload = new UploadFile();
        $upload->maxSize  = 3145728;
        $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');
        $upload->uploadReplace = true;
        $upload->savePath = UPLOADS_PATH."/imgQ/";
        if(!$upload->upload()) {
            $this->error($upload->getErrorMsg());
        }else{
            $info =  $upload->getUploadFileInfo();
        }
        
        $qcode = $_POST['qcode'];

        $data = $_POST;
        $generalset = $this -> _getGeneralSet($data);
        $generalsetjson = json_encode($generalset);

        $icon = '/weitest/Uploads/imgQ/'.$info[0]['savename'];
        $bgpic = '/weitest/Uploads/imgQ/'.$info[1]['savename'];

        $item = array(
            'qcode' => $qcode,
            'icon'  => $icon,
            'bgpic' => $bgpic,
            'generalset' => $generalsetjson
        );
        
        $m_q = M('question');
        $ret = $m_q -> where(array('qcode' => $qcode)) -> save($item);
        
        if($ret != false){
            $this -> success('添加成功！');
        }else{
            $this -> error('添加失败！');
        }
    }

    private function _getGeneralSet($data){
        $minechecked = $data['mine'];
        $friend1checked = $data['friend1'];
        $friend2checked = $data['friend2'];
        $friend3checked = $data['friend3'];
        $friend4checked = $data['friend4'];

        $generalset = array();
        if($minechecked == 'on'){
            $mine = array(
                'portraitLocal' => $data['mineportraitLocal'],
                'portraitSize'  => $data['mineportraitSize'],
                'rel'           => $data['relmine'],
                'nameLocal'     => $data['minenameLocal'],
                'namesize'      => $data['minenamesize']
            );

            $generalset['mine'] = $mine;
        }

        if($friend1checked == 'on'){
            $friend1 = array(
                'portraitLocal' => $data['friend1portraitLocal'],
                'portraitSize'  => $data['friend1portraitSize'],
                'rel'           => $data['relfriend1'],
                'nameLocal'     => $data['friend1nameLocal'],
                'namesize'      => $data['friend1namesize']
            );

            $generalset['friend1'] = $friend1;
        }

        if($friend2checked == 'on'){
            $friend2 = array(
                'portraitLocal' => $data['friend2portraitLocal'],
                'portraitSize'  => $data['friend2portraitSize'],
                'rel'           => $data['relfriend2'],
                'nameLocal'     => $data['friend2nameLocal'],
                'namesize'      => $data['friend2namesize']
            );

            $generalset['friend2'] = $friend2;
        }

        if($friend3checked == 'on'){
            $friend3 = array(
                'portraitLocal' => $data['friend3portraitLocal'],
                'portraitSize'  => $data['friend3portraitSize'],
                'rel'           => $data['relfriend3'],
                'nameLocal'     => $data['friend3nameLocal'],
                'namesize'      => $data['friend3namesize']
            );

            $generalset['friend3'] = $friend3;
        }

        if($friend4checked == 'on'){
            $friend4 = array(
                'portraitLocal' => $data['friend4portraitLocal'],
                'portraitSize'  => $data['friend4portraitSize'],
                'rel'           => $data['relfriend4'],
                'nameLocal'     => $data['friend4nameLocal'],
                'namesize'      => $data['friend4namesize']
            );

            $generalset['friend4'] = $friend4;
        }

        return $generalset;
    }

    public function addQuestion(){
        if(isset($_POST['qid']) && !empty($_POST['qid'])
            && isset($_POST['languageset']) && !empty($_POST['languageset'])
            && isset($_POST['content']) && !empty($_POST['content'])){
            $item = array(
                'qid'      => $_POST['qid'],
                'language' => $_POST['languageset'],
                'content'  => $_POST['content']
            );

            $m_q_d = M('question_detail');
            $ret = $m_q_d -> where($item) -> find();
            if($ret == null){
                $m_q_d -> add($item);
                $this -> success('添加成功！','questionlist');
            }else{
                $this -> error('请勿重复添加！','questionlist');
            }
        }else{
            $this -> error('添加失败！','questionlist');
        }
    }

    public function setStatus(){
        $id = $_POST['qid'];
        $status = $_POST['status'];
        $m_q = M('question');
        if($status == 1){
            $item = array(
                'id' => $id,
                'status' => 2
            );

            $m_q -> save($item);
        }else{
            $item = array(
                'id' => $id,
                'status' => 1
            );
        
            $m_q -> save($item);
        }

        $this -> success('设置成功！','questionlist');
    }

    

}