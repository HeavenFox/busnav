/*
THIS FILE IS NOT WRITTEN BY MYSELF
THIS IS NOT A PART OF THIS PROJECT
*/
var G_INCOMPAT=false;
function GScript(src){
	document.write('<'+'script src="'+src+'"'+' type="text/javascript"><'+'/script>');
	
}
function GBrowserIsCompatible(){
	if(G_INCOMPAT)return false;
	if(!window.RegExp)return false;
	var AGENTS=["opera","msie","safari","firefox","netscape","mozilla"];
	var agent=navigator.userAgent.toLowerCase();
	for(var i=0;i<AGENTS.length;i++){
		var agentStr=AGENTS[i];
		if(agent.indexOf(agentStr)!=-1){
			var versionExpr=new RegExp(agentStr+"[ \/]?([0-9]+(\.[0-9]+)?)");
			var version=0;
			if(versionExpr.exec(agent)!=null){
				version=parseFloat(RegExp.$1);
			}
			if(agentStr=="opera")return version>=7;
			if(agentStr=="safari")return version>=125;
			if(agentStr=="msie")return (version>=5.5&&agent.indexOf("powerpc")==-1);
			if(agentStr=="netscape")return version>7;
			if(agentStr=="firefox")return version>=0.8;
			
		}
	}
	return !!document.getElementById;
	
}

function GVerify(){
	
}

function GLoad(){
	GLoadApi(["http://mapgoogle.mapabc.com/googlechina/maptile?v=w2.46&"],
			["http://kh0.google.com/kh?n=404&v=17&","http://kh1.google.com/kh?n=404&v=17&","http://kh2.google.com/kh?n=404&v=17&","http://kh3.google.com/kh?n=404&v=17&"],
			["http://mt0.google.com/mt?n=404&v=w2t.47&","http://mt1.google.com/mt?n=404&v=w2t.47&","http://mt2.google.com/mt?n=404&v=w2t.47&","http://mt3.google.com/mt?n=404&v=w2t.47&"]);
	if(window.GJsLoaderInit){
		GJsLoaderInit("http://maps.google.com/mapfiles/maps2.79.js");
		
	}
}

function GUnload(){
	if(window.GUnloadApi){
		GUnloadApi();
	}

}

var _mFlags={};
var _mHost="http://ditu.google.cn";
var _mUri="/maps";
var _mDomain="google.cn";
var _mStaticPath="http://www.google.cn/intl/zh-CN_cn/mapfiles/";
var _mTermsUrl="http://www.google.cn/intl/zh-CN_cn/help/terms_local.html";
var _mTerms="使用条款";
var _mMapMode="地图";
var _mMapModeShort="地图";
var _mMapError="很抱歉，在这一缩放级别的地图上未找到此区域。<p>请缩小地图，扩大视野范围。</p>";
var _mSatelliteMode="卫星";
var _mSatelliteModeShort="星期六";
var _mSatelliteError="很抱歉，在这一缩放级别的成像上未找到此区域。<p>请缩小成像，扩大视野范围。</p>";
var _mHybridMode="混合地图";
var _mHybridModeShort="混合地图";
var _mSatelliteToken="fzwq1JXT3xA-aAS05AxQE0iP0Q-bN4oSjRGTFA";
var _mZoomIn="放大";
var _mZoomOut="缩小";
var _mZoomSet="单击设置缩放水平";
var _mZoomDrag="拖动缩放";
var _mPanWest="向左平移";
var _mPanEast="向右平移";
var _mPanNorth="向上平移";
var _mPanSouth="向下平移";
var _mLastResult="返回上一结果";
var _mMapCopy="地图数据 &#169;2007";
var _mSatelliteCopy="Imagery &#169;2007";
var _mGoogleCopy="&#169;2007 Google";
var _mKilometers="公里";
var _mMiles="英里";
var _mMeters="米";
var _mFeet="英尺";
var _mPreferMetric=true;
var _mPanelWidth=20;
var _mTabBasics="地址";
var _mTabDetails="详细资料";
var _mDecimalPoint='.';
var _mThousandsSeparator=',';
var _mUsePrintLink='要查看屏幕上的所有细节，请使用地图旁边的"打印"链接。';
var _mPrintSorry='';
var _mMapPrintUrl='http://www.google.com/mapprint';
var _mPrint='打印';
var _mOverview='概要';
var _mStart='起始地点';
var _mEnd='目的地';
var _mStep='第 %1$s 步';
var _mStop='目的地 %1$s';
var _mHideAllMaps='隐藏地图';
var _mShowAllMaps='显示所有地图';
var _mUnHideMaps='显示地图';
var _mShowLargeMap='显示原始地图视图。';
var _mmControlTitle=null;
var _mAutocompleteFrom='从';
var _mAutocompleteTo='至';
var _mAutocompleteNearRe='^(?:(?:.*?)&#92;s+)(?:(?:in|near|around|close to):?&#92;s+)(.+)$';
var _mSvgEnabled=true;
var _mSvgForced=false;
var _mStreetMapAlt='显示街道地图';
var _mSatelliteMapAlt='显示卫星图片';
var _mHybridMapAlt='显示标有街道名称的图片';
var _mSeeOnGoogleMaps="点击可在 Google 地图上参看该区域";
var _mLogInfoWinExp=true;
var _mLogPanZoomClks=false;
var _mLogWizard=true;
var _mTransitV2=false;
function GLoadMapsScript(){
	if(GBrowserIsCompatible()){
		GScript("http://maps.google.com/mapfiles/maps2.79.api.js");
	}
}
GLoadMapsScript();
