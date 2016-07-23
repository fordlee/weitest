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

$(function(){

	var cata='index';
	var loc=location.href;
	if(loc.indexOf('question')>-1){
		cata='question';
	}else if(loc.indexOf('analyze')>-1){
		cata='analyze';
	}else if(loc.indexOf('show')>-1){
		cata="result";
	}

	$('#language').change(function(e) {
		domain=$('#language').val()||'en';
		sentEvent(cata,'LangSwitch',domain);
		location.href="http://"+domain+".mytests.co";
	});


	//Event Track
	$('.container-box, .container-patch-box, .container-vice-box').on('click',function(){
		var action="TestClick";
		var id=$(this).attr('href').match(/\/id\/(\d+)/)[1];
		sentEvent(cata,action,id);
	});

	$('.FBlogin,.FBshare').on('click',function(){
		var action="FB_login";
		var _this=$(this);

		try{
			var id=_this.attr('href').match(/\/(\d+)/)[1];
		}catch(e){
			var id=location.href.match(/\/(\d+)/)[1];
		}

		if(_this.hasClass('FBshare')){
			action="FB_share";
		}
		sentEvent(cata,action,id);
	});

})