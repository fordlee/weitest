(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-48110498-14', 'auto');
ga('send', 'pageview');

//Ga Analytics
function sentEvent(category,action,label){
    var category=category?category:'',
        action=action?action:'',
        label=label?label:'';
    ga('send', 'event', category, action, label);
}

function getQueryString(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
    var r = window.location.search.substr(1).match(reg);

    //UTM
    if(!r){
    	var reg=new RegExp("\/"+name+"\/(\\w+)");
    	var r=location.href.match(reg)||[];
    	var r=r[1]||null;
    }

    if (r != null) return unescape(r[2]); return null;
}

$(function(){

	var cata='index';
	var loc=location.href;
	if(loc.indexOf('\/question')>-1){
		cata='question';
	}else if(loc.indexOf('\/analyze')>-1){
		cata='analyze';
	}else if(loc.indexOf('\/show')>-1){
		cata="result";
	}

	$('#language').change(function(e) {
		domain=$('#language').val()||'en';
		sentEvent(cata,'LangSwitch',domain);
		
		var utm=getQueryString('utm');
		var url=location.protocol+'//'+domain+".mytests.co/";
		if(utm)url=url+'?utm='+utm;
		location.href=url;
	});


	//Event Track
	$('#container-box .content,.test-box').on('click',function(){
		var action="TestClick";
		var href=$(this).attr('href')||'';
		if(href.indexOf('javascript')>=0){
			href=location.href;
		}
		var id=href.match(/\/id\/(\d+)/)[1];
		sentEvent(cata,action,id);
	});

	$('.test-login,#content-test a,.share-box a,#resultpic,.test-share').on('click',function(){
		var _cata=cata+"|FB_login";
		var _this=$(this);
		var utm=getQueryString('utm')||'null';
		
		var href=$(this).attr('href')||'';
		if(href.indexOf('javascript')>=0||href==""){
			href=location.href;
		}
		var id=href.match(/\/id\/(\d+)/)[1];		
		
		if(_this.parent().hasClass('share-box')||_this.hasClass('test-share')||_this.attr('id')=='resultpic'){
			_cata=cata+'|'+"FB_share";;
		}
		sentEvent(_cata,id,utm);
	});

})