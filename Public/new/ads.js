window.gameAs={
    show:function(){
        $('#botBox').show();
    }
}

var containerWidth=$('#container-content').width();
containerWidth=containerWidth<=400?containerWidth:400;

var strAFG='<div id="adContainer" style="position: absolute;top: 28px;width:'+containerWidth+'px;left: 50%;margin-left:-'+(containerWidth/2)+'px;bottom: 0;right: 0;z-index: 999;background:#111;height:400px;transform: scale(1.1);"></div>';
//document.write(strAFG);

$('#vas-container').html(strAFG);

var screenWidth=Math.min(document.documentElement.clientWidth, window.innerWidth),
    screenHeight=Math.min(document.documentElement.clientHeight, window.innerHeight)-100;


var _channel="8322728100";

function showBotAd(){
    $('#vas-container').css('visibility','hidden');
    $('#container-content').removeClass('container-analyze');
}

//AFG FOR MOBILE SITE
var GameAds = {
    adsManager: null,
    adsLoader: null,
    adDisplayContainer: null,
    intervalTimer: null,
    adDiv: null,
    doneFn: null,
    gameWidth: containerWidth,
    gameHeight: 350,
    adsenseURL: 'http://googleads.g.doubleclick.net/pagead/ads?ad_type=standardvideo_image&channel='+_channel+'&client=ca-games-pub-3961823097646209&description_url='+encodeURIComponent(location.href)+'&videoad_start_delay=0&max_ad_duration=15000', //AFG Tag URL address

    init: function() {
        this.adDiv = document.getElementById('adContainer'); //HTML AD Container
        if(this.adDiv.style)
            //this.adDiv.style.height = this.gameHeight+"px";

        //this.gameWidth = Math.min(document.documentElement.clientWidth, window.innerWidth);
        this.gameWidth=containerWidth;
        var a = document.createElement('script'),
            m = document.getElementsByTagName('script')[0];
        a.src = 'http://imasdk.googleapis.com/js/sdkloader/ima3.js';
        m.parentNode.insertBefore(a, m);

        a.onload = function() {
            //direct load ads
            GameAds.requestAd();
        }

        return true;
    },

    requestAd: function(callback) {
        var self = this;
        if (typeof callback == 'function') {
            self.doneFn = callback;
        }

        function resizeAB() {
            var rect = self.gameDiv.getBoundingClientRect();
            self.adDiv.style.top = rect.top + 'px';
            self.adDiv.style.left = rect.left + 'px';
            self.adDiv.style.width = rect.width + 'px';
            self.adDiv.style.height = (rect.height + 1) + 'px';
        }

        if (typeof google == 'undefined')
            return;

        // Create the ad display container.
        self.createAdDisplayContainer();
        // Initialize the container. Must be done via a user action on mobile devices.
        self.adDisplayContainer.initialize();
        // Create ads loader.
        self.adsLoader = new google.ima.AdsLoader(self.adDisplayContainer);
        // Listen and respond to ads loaded and error events.
        self.adsLoader.addEventListener(
            google.ima.AdsManagerLoadedEvent.Type.ADS_MANAGER_LOADED,
            self.onAdsManagerLoaded,
            false);
        self.adsLoader.addEventListener(
            google.ima.AdErrorEvent.Type.AD_ERROR,
            self.onAdError,
            false);

        // Request video ads.
        var adsRequest = new google.ima.AdsRequest();

        // Create and add description-url:
        // var descriptionUrl = location.protocol + location.port + '//' + location.hostname + location.pathname.substr(0, location.pathname.lastIndexOf('/')) + '/about.html';
        // adsRequest.adTagUrl = this.adsenseURL.replace('[description_url]', encodeURIComponent(descriptionUrl));

        // if (/games\.(avoid\.org|webgear\.nl)/.test(location.hostname)) {
        //     adsRequest.adTagUrl += '&adtest=on';
        // }
        adsRequest.adTagUrl = this.adsenseURL;

        adsRequest.linearAdSlotWidth = this.gameWidth;
        adsRequest.linearAdSlotHeight = this.gameHeight;

        adsRequest.nonLinearAdSlotWidth = this.gameWidth;
        adsRequest.nonLinearAdSlotHeight = this.gameHeight;

        self.adsLoader.requestAds(adsRequest);
    },

    createAdDisplayContainer: function() {
        // We assume the adContainer is the DOM id of the element that will house the ads.
        this.adDisplayContainer =
            new google.ima.AdDisplayContainer(GameAds.adDiv);
    },

    onAdsManagerLoaded: function(adsManagerLoadedEvent) {
        // Get the ads manager.
        var adsRenderingSettings = new google.ima.AdsRenderingSettings();
        adsRenderingSettings.loadVideoTimeout = 5000;
        GameAds.adsManager = adsManagerLoadedEvent.getAdsManager(window.document.body, adsRenderingSettings); // should be set to the content video element

        // Add listeners to the required events.
        GameAds.adsManager.addEventListener(google.ima.AdErrorEvent.Type.AD_ERROR, GameAds.onAdError);
        GameAds.adsManager.addEventListener(google.ima.AdEvent.Type.ALL_ADS_COMPLETED, GameAds.onAdEvent);

        // Listen to any additional events, if necessary.
        GameAds.adsManager.addEventListener(google.ima.AdEvent.Type.LOADED, GameAds.onAdEvent);
        GameAds.adsManager.addEventListener(google.ima.AdEvent.Type.STARTED, GameAds.onAdEvent);
        GameAds.adsManager.addEventListener(google.ima.AdEvent.Type.COMPLETE, GameAds.onAdEvent);
        GameAds.adsManager.addEventListener(google.ima.AdEvent.Type.SKIPPABLE_STATE_CHANGED, GameAds.onAdEvent);
        GameAds.adsManager.addEventListener(google.ima.AdEvent.Type.SKIPPED, GameAds.onAdEvent);
        GameAds.adsManager.addEventListener(google.ima.AdEvent.Type.USER_CLOSE, GameAds.onAdEvent);

        try {
            GameAds.adsManager.init(GameAds.gameWidth, GameAds.gameHeight, google.ima.ViewMode.NORMAL);
            GameAds.adsManager.start();
        } catch (adError) {
            // An error may be thrown if there was a problem with the VAST response.
            console.log(JSON.stringify(adError));
        }

        $('#vas-container').css('visibility','visible');
        $('#container-content').addClass('container-analyze');
    },

    onAdEvent: function(adEvent) {
        // Retrieve the ad from the event. Some events (e.g. ALL_ADS_COMPLETED)
        // don't have ad object associated.
        var ad = adEvent.getAd(),
            adType = ad.contentType,
            adIsLinear = ad.isLinear();
        switch (adEvent.type) {
            case google.ima.AdEvent.Type.LOADED:
                //no action
                break;

            case google.ima.AdEvent.Type.STARTED:
                //no action
                break;

            case google.ima.AdEvent.Type.SKIPPABLE_STATE_CHANGED:
                break;

            case google.ima.AdEvent.Type.COMPLETE:
                //no action
                showBotAd();
                break;
            case google.ima.AdEvent.Type.USER_CLOSE:
                GameAds.adDone('complete');
                showBotAd();
                break;

            case google.ima.AdEvent.Type.SKIPPED:
                GameAds.adDone('skipped');
                showBotAd();
                break;
        }
    },

    // Ad done, show/start game
    adDone: function(status, doDone) {
        if (typeof doDone == 'undefined') {
            doDone = true;
        }
        var self = this;
        if (self.adDiv.parentNode)
            self.adDiv.parentNode.removeChild(self.adDiv);
        showBotAd();

        try {
            GameAds.adsManager.destroy();
        } catch (e) {};
        if (doDone && self.doneFn) {
            self.doneFn(status);
        }
    },

    onAdError: function(adErrorEvent) {
        // console.log(adErrorEvent.getError()); 
        GameAds.adDone('error');
        try {
            GameAds.adsManager.destroy();
        } catch (e) {};
    }

};
