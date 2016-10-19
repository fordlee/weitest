testModule=(function(){

	var module={
	
		start:function(){
			window.score=0;
			$('#panel-start,#panel-answer').hide();
			module.next(1);
			$('#panel-testbox').show();
		},
		
		next:function(num,obj){
			if(!num){
				num=1;
			}
			
			//Jump type test check
			if(num.toString().indexOf('#')>-1){
				window.score=num.replace('#','');
				module.showResult();
				return;
			}

			//Set the score
			if(obj){
				var _score=parseInt($(obj).attr('score'));
				window.score+=_score;
			}

			//Last question ,then show result
			var quesLen=testConfig.questionlist.length;
			if(num>quesLen){
				//If the last question,show answer
				module.showResult();
				return;
			}
			
			var ques=testConfig.questionlist[num-1],
				type=testConfig.sort,
				option=ques['option'];
			
			
			//Set question title
			var quesBox=$('#option-question>h3'),
				optionBox=$('#option-box'),
				str='';
			str+='<table cellpadding="0" cellspacing="0">';
			if(ques.image){
				str+='<img src="'+ques.image+'">';
			}
			
			quesBox.text((quesLen>1?num+'、':'  ')+ques.title);
			
			//Set question options
			for(i=0,len=option.length;i<len;i++){
				var data=option[i],
					_score=data[1],
					jump=type=='jump'?data[1]:'';
				
				var _next=jump?jump:parseInt(num)+1,
					_click="testModule.next('"+_next+"',this)";

				str+='<tr><td><input id="option'+i+'" onclick="'+_click+'" score="'+_score+'" name="list" type="radio" value="0"><label for="option'+i+'">'+String.fromCharCode(65+i)+' '+data[0]+'</label></td></tr>';
			}
			str+='</table>';
			optionBox.html(str);
		},
		
		prev:function(){
		
		},
		
		showResult:function(){
			var answerList=testConfig.resultlist;
			var scoreBox=$('#answer-score'),
				introBox=$('#answer-intro'),
				answerIndex='';
			$('#option-box input').attr('onclick','');
			for(i=0,len=answerList.length;i<len;i++){
				var data=answerList[i],
					low=data[1][0],
					high=data[1][1];
					
				if(score==high&&high==low){
					answerIndex=i;
					break;
				}else if(high!=''&&low!=''){
					if(score>=low&&score<=high){
						answerIndex=i;
						break;					
					}
				}else if(high!=''&&low==''){
					if(score<=high){
						answerIndex=i;
						break;					
					}				
				}else if(high==''&&low!=''){
					if(score>=low){
						answerIndex=i;
						break;					
					}				
				}
			}

			if(answerIndex===''){
				alert('oh no,外星人也算不出你的分数了...');
				return;
			}
			alert('测试结果：'+score+':'+answerList[answerIndex][0]);
			analyze({rid:answerIndex});

		}

	};
	
	return {
		start:module.start,
		next:module.next,
		prev:module.prev
	}
})();