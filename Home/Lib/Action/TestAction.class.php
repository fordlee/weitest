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

}
?>