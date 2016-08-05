<?php
    class QuestionViewModel extends ViewModel {
        public $viewFields = array (
            'question' => array('id', 'qcode', 'profileset', 'icon', 'bgpic', 'generalset', 'status', 'date'),
            'question_detail' => array('id'=>'qdid', 'qid', 'language', 'content','_on' => 'question.id = question_detail.qid')
        );
    }
?>