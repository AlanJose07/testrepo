
<?php
$CI = get_instance();
$uriSegments = $CI->uri->uri_to_assoc($CI->config->item('parm_segment'));
$contextId = $uriSegments['contextId'];
$facebookPageId = $uriSegments['facebookPageId'];
$facebook_app_id = \RightNow\Utils\Config::getConfig(1000049);  //CUSTOM_CFG_FACEBOOK_APP_ID
$facebookAppId = $facebook_app_id;
//$facebookAppId = '110100299485445';
//$facebookPageId = '2102715376480453';
//$facebook_autoredirect = "http://m.me/".$facebookPageId;
//header('Location: ' . $facebook_autoredirect);
?>

<HTML>
<HEAD>
  
  <link rel="icon" type="image/png" sizes="16x16"  href="/euf/assets/themes/mobile/images/BB_Support_Stacked_192x192_Blue.png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />  
  <link href="/euf/assets/themes/responsive/css/fb_styles.css" rel="stylesheet">
  <style>
    .text-block{
      text-align: left;      
	  margin-right: auto;
    }    
   
  </style>
</HEAD>
<BODY>

<script type="text/javascript">
(function(){(function(){function a(){if(!b.dialogArguments)return navigator.cookieEnabled;document.cookie="__dTCookie=1";var a=-1!==document.cookie.indexOf("__dTCookie");document.cookie="__dTCookie=1; expires=Thu, 01-Jan-1970 00:00:01 GMT";return a}if(window.dT_)window.console&&window.console.log("Duplicate agent injection detected, turning off redundant initConfig.");else{var b="undefined"!==typeof window?window:self;a()&&(window.dT_||(window.dT_={cfg:"app=e78d94a27920fcb4|cors=1|featureHash=A27SVfqrux|srsr=25000|reportUrl=https://bf10058zvt.bf.dynatrace.com/bf|rdnt=1|uxrgce=1|srms=1,1,,,|uxrgcm=100,25,300,3;100,25,300,3|dpvc=1|lastModification=1563489280336|dtVersion=10171190704121258|tp=500,50,0,1|uxdcw=1500|featureHash=A27SVfqrux|agentUri=https://js-cdn.dynatrace.com/jstag/147f273fa2a/ruxitagent_A27SVfqrux_10171190704121258.js|auto=|domain=|rid=RID_|rpid=|app=e78d94a27920fcb4",
iCE:a}))}})();}).call(this);





(function(){(function(){function Kb(){return ra?new ra:sa?new sa("MSXML2.XMLHTTP.3.0"):d.XMLHttpRequest?new d.XMLHttpRequest:new d.ActiveXObject("MSXML2.XMLHTTP.3.0")}function Lb(){sa=ra=void 0}function t(){var a=0;try{a=d.performance.timing.navigationStart+Math.floor(d.performance.now())}catch(b){}return 0>=a||isNaN(a)||!isFinite(a)?(new Date).getTime():a}function X(a,b){function c(){delete ja[f];a.apply(this,arguments)}for(var e=[],ua=2;ua<arguments.length;ua++)e[ua-2]=arguments[ua];var f;"apply"in va?f=va.apply(d,
[c,b].concat(e)):f=va(c,b);ja[f]=!0;return f}function $a(a){delete ja[a];"apply"in Y?Y.call(d,a):Y(a)}function k(a){for(var b=[],c=1;c<arguments.length;c++)b[c-1]=arguments[c];a.push.apply(a,b)}function ab(a){k(Z,a)}function Mb(a){for(var b=Z.length;b--;)if(Z[b]===a){Z.splice(b,1);break}}function Nb(){return Z}function Ob(a,b){return bb(a,b)}function Pb(a,b){a=new Qb([a],{type:b});return Rb(a)}function Sb(a,b){return cb?new cb(a,b):void 0}function Tb(a){"function"===typeof a&&k(db,a)}function Ub(){return db}
function Vb(){return Da}function eb(a){return function(){for(var b=[],c=0;c<arguments.length;c++)b[c]=arguments[c];if("number"!==typeof b[0]||!ja[b[0]])try{return a.apply(this,b)}catch(e){return a(b[0])}}}function Wb(){ka&&(d.clearTimeout=Y,d.clearInterval=Ea,ka=!1)}function aa(a,b){return isNaN(a)||isNaN(b)?0:Math.floor(Math.random()*(b-a+1))+a}function u(a,b){return parseInt(a,b||10)}function n(a,b,c){void 0===c&&(c=0);var e=-1;b&&a&&a.indexOf&&(e=a.indexOf(b,c));return e}function fb(a){return document.getElementsByTagName(a)}
function gb(a){var b=a.length;if("number"===typeof b)a=b;else{for(var b=0,c=2048;a[c-1];)b=c,c+=c;for(var e=7;1<c-b;)e=(c+b)/2,a[e-1]?b=e:c=e;a=a[e]?c:b}return a}function Xb(a){a=encodeURIComponent(a);var b=[];if(a)for(var c=0;c<a.length;c++){var e=a.charAt(c);k(b,Yb[e]||e)}return b.join("")}function N(a){if(!a)return"";var b=d.crypto||d.msCrypto;if(b){var c=new Int8Array(a);b.getRandomValues(c)}else for(c=[],b=0;b<a;b++)c.push(aa(0,32));a=[];for(b=0;b<c.length;b++){var e=Math.abs(c[b]%32);a.push(String.fromCharCode(e+
(9>=e?48:55)))}return a.join("")}function hb(){return!(!d.console||!d.console.log)}function Zb(){try{$b.apply(d.parent,arguments)}catch(a){}}function ac(){try{bc.apply(d.top,arguments)}catch(a){}}function cc(a){var b=Array.prototype.slice.call(arguments,1);try{dc.apply(a,b)}catch(c){}}function ec(a){var b=Array.prototype.slice.call(arguments,1);try{fc.apply(a,b)}catch(c){}}function z(){return d.dT_}function gc(){return A}function hc(){return ib}function ic(){return jb}function jc(){return wa}function kb(){return"dtAdk"}
function kc(){return ba}function lb(a){-1<d.dT_.io(a,"^")&&(a=a.split("^^").join("^"),a=a.split("^dq").join('"'),a=a.split("^rb").join(">"),a=a.split("^lb").join("<"),a=a.split("^p").join("|"),a=a.split("^e").join("="),a=a.split("^s").join(";"),a=a.split("^c").join(","),a=a.split("^bs").join("\\"));return a}function lc(){return O}function mc(a){O=a}function mb(a){var b=d.dT_,c=b.scv("rid"),b=b.scv("rpid");c&&(a.rid=c);b&&(a.rpid=b)}function nb(a){if(a.xb){a=lb(a.xb);try{O=new RegExp(a)}catch(b){}}}
function ob(a){var b={};a=a.split("|");for(var c=0;c<a.length;c++){var e=a[c].split("=");2===e.length&&(b[e[0]]=decodeURIComponent(e[1].replace(/\+/g," ")))}return b}function Fa(){var a=l("csu");return(a.indexOf("dbg")===a.length-3?a.substr(0,a.length-3):a)+"_"+l("app")+"_Store"}function xa(a,b,c){b=b||{};a=a.split("|");for(var e=0;e<a.length;e++){var d=a[e],f=n(a[e],"=");-1===f?b[d]="1":(d=a[e].substring(0,f),b[d]=a[e].substring(f+1,a[e].length))}!c&&(c=b,a=c.spc)&&(e=document.createElement("textarea"),
e.innerHTML=a,c.spc=e.value);return b}function P(a){return a in f?f[a]:ya[a]}function m(a){a=P(a);return"false"===a||"0"===a?!1:!!a}function I(a){var b=u(P(a));isNaN(b)&&(b=ya[a]);return b}function l(a){return String(P(a)||"")}function nc(a,b){f[a]=b}function pb(a){return f=a}function qb(a){var b=location.hostname;return b&&a?b===a||-1!==b.indexOf("."+a,b.length-("."+a).length):!0}function Ga(a){f[a]=0>n(f[a],"#"+a.toUpperCase())?f[a]:""}function Ha(a){var b=a.agentUri;b&&-1<n(b,"_")&&(b=/([a-zA-Z]*)[0-9]{0,4}_([a-zA-Z_0-9]*)_[0-9]+/g.exec(b))&&
b.length&&2<b.length&&(a.csu=b[1],a.featureHash=b[2])}function Ia(a,b){qb(f.domain||"")||(f.domainOverride=location.hostname+","+f.domain,delete f.domain);f.pVO&&(a.pVO=f.pVO);b||(a.bp=a.bp||ya.bp,1===g&&a.bp1&&(a.bp=1),a.bp2&&(a.bp=2),4!==a.bp||d.JSON||(a.bp=1))}function oc(){return f}function ca(a,b){try{var c=la;c&&c.setItem(a,b)}catch(e){}}function da(a){try{var b=la;if(b)return b.getItem(a)}catch(c){}return null}function Q(a){try{var b=la;b&&b.removeItem(a)}catch(c){}}function za(a,b){if(R()&&
(!z().A||rb))return a.apply(this,b||[])}function R(){return!m("coo")||m("cooO")||rb}function p(a){document.cookie=a+'="";path=/'+(l("domain")?";domain="+l("domain"):"")+"; expires=Thu, 01 Jan 1970 00:00:01 GMT;"}function sb(a,b,c){var e=1,d=0;do document.cookie=a+'=""'+(b?";domain="+b:"")+";path="+c.substr(0,e)+"; expires=Thu, 01 Jan 1970 00:00:01 GMT;",e=c.indexOf("/",e),d++;while(-1!==e&&5>d)}function J(a){var b=document.cookie;if(!b)return"";var c=a+"=";a=n(b,c);if(0>a)return"";for(;0<=a;)if(a&&
" "!==b.charAt(a-1)&&";"!==b.charAt(a-1))a=n(b,c,a+c.length);else return c=a+c.length,a=n(b,";",a),0<=a?b.substring(c,a):b.substr(c);return""}function pc(a,b,c,e){b||0===b?(b=(""+b).replace(/[;\n\r]/g,"_"),a=a+"="+b+";path=/"+(l("domain")?";domain="+l("domain"):""),c&&(a+=";expires="+c.toUTCString()),e&&(a+=";Secure"),document.cookie=a):p(a)}function B(a,b,c,e){za(pc,[a,b,c,e])}function ma(a){var b=/^[0-9A-Za-z_=:\$\+\/\.\-\*%\|]*$/.test(a);return a&&2<a.split("$").length?!1:b}function tb(){var a=
J(A);a||((a=da(A))&&ma(a)?S(a):a="");return ma(a)?a:""}function S(a){B(A,a,void 0,m("ssc"))}function na(a){return 32===a.length||12>=a.length?a:""}function ub(a){if(!isNaN(Number(a))){var b=u(a);if(-99<=b&&99>=b)return a}return""}function vb(a){var b={sessionId:"",b:""},c=n(a,"|"),e=a;-1!==c&&(e=a.substring(0,c));c=n(e,"$");-1!==c?(b.sessionId=na(e.substring(c+1)),b.b=ub(e.substring(0,c))):b.sessionId=na(e);return b}function wb(a){var b={sessionId:"",b:""};a=a.split("v"===a.charAt(0)?"_":"=");if(2<
a.length&&!(a.length%2)){var c=Number(a[1]);if(isNaN(c)||3>c)return b;for(var c={},e=2;e<a.length;e++)c[a[e]]=a[e+1],e++;b.sessionId=na(c.sn);c.srv&&(b.b=ub(c.srv));"1"===c.ol&&(ca("dtDisabled","true"),z().disabled=!0,z().A=!0)}return b}function C(a){var b=document.cookie?document.cookie.split(a+"=").length-1:0;if(1<b){var c=l("domain")||d.location.hostname,e=d.location.hostname,f=d.location.pathname,ta=0,h=0;D.push(a);do{var g=e.substr(ta);if(g!==c||"/"!==f){sb(a,g===c?"":g,f);var k=document.cookie?
document.cookie.split(a+"=").length-1:0;k<b&&(D.push(g),b=k)}ta=e.indexOf(".",ta)+1;h++}while(ta&&10>h&&1<b);l("domain")&&1<b&&sb(a,"",f)}}function qc(){C(ba);C(A);C(wa);C("rxvt");ab(function(a,b,c,e){0<D.length&&!b&&(a.av(e,0,"dCN",function(){return D.join(",")}),a.av(e,4,"duplicateCookieNames",function(){return D.slice()}),D=[])})}function rc(){return ea}function Aa(a,b,c,e,d){var f=document.createElement("script");f.setAttribute("src",a);b&&f.setAttribute("defer","true");c&&(f.onload=c);e&&(f.onerror=
e);d&&f.setAttribute("id",d);f.setAttribute("crossorigin","anonymous");a=document.getElementsByTagName("script")[0];a.parentElement.insertBefore(f,a)}function Ja(a,b){return Ka+"/"+(b||T)+"_"+a+"_"+(I("buildNumber")||z().version)+".js"}function Ba(a){R()?a():(v||(v=[]),k(v,a))}function sc(a){return za(a)}function tc(){for(var a=0;a<v.length;a++)X(v[a],0);v=[];f.cooO=!0}function uc(){f.cooO=!1;p(A);p(ba);p(wa);p("dtSa");p(kb());0===g&&(p("rxVisitor"),p("rxvt"));try{var a=la;a&&(0===g&&a.removeItem("rxVisitor"),
a.removeItem(A));(a=La)&&a.removeItem(Fa())}catch(b){}}function xb(a){if(a=a||tb()){var b=a.charAt(0);return"v"===b||"="===b?wb(a):vb(a)}return{sessionId:"",b:""}}function U(a){return xb(a).b}function fa(a){return xb(a).sessionId}function vc(){return q}function wc(){Ba(function(){fa()||S((0===g?-1*aa(2,21)+"$":"")+N(32));q=U()||""})}function K(a,b){try{d.localStorage&&d.localStorage.setItem(a,b)}catch(c){}}function oa(a){try{if(d.localStorage)return d.localStorage.getItem(a)}catch(b){}return null}
function ga(a){try{d.localStorage&&d.localStorage.removeItem(a)}catch(b){}}function yb(a,b){b=E(b);for(var c=!1,e=0;e<b.length;e++)b[e].frameId===ea&&(b[e].g=a,c=!0);c||k(b,{frameId:ea,g:a});V(b)}function V(a,b,c){if(a){var e=0===g;var d=[];for(var f=0;f<a.length;f++)if("-"!==a[f].g){0<f&&0<d.length&&k(d,"p");var h=q;h&&(k(d,h),k(d,"$"));k(d,a[f].frameId);k(d,"h");k(d,a[f].g)}e&&!d.length&&(Ma&&(L(0,!0),Na(!1)),q=U()||"",k(d,q),k(d,"$"),k(d,ea),k(d,"h-"));a=e?b||Oa():F();if(e||a)k(d,"v"),k(d,a),e=
"undefined"!==typeof c?c:r(),0<=e&&(k(d,"e"),k(d,e));d=d.join("")}else d="";d||0!==g||(Ma&&(L(0,!0),Na(!1)),q=U()||"",c="undefined"!==typeof c?c:r(),d=q+"$"+ea+"h-v"+(b||Oa()+(0<=c?"e"+c:"")));B(ba,d||"-",void 0,m("ssc"))}function E(a){var b=J(ba),c=[];if(b&&"-"!==b){for(var b=b.split("p"),d="",f=null,g=0;g<b.length;g++){var h=b[g],m=n(h,"h"),l=n(h,"v"),p=n(h,"e"),w=h.substring(n(h,"$")+1,m),m=-1!==l?h.substring(m+1,l):h.substring(m+1),d=d||-1!==l?-1!==p?h.substring(l+1,p):h.substring(l+1):"",f=f||
-1!==p?h.substring(p+1):null;(h=a)||(h=u(w.split("_")[0]),l=t()%Pa,l<h&&(l+=Pa),h=h+9E5>l);h&&k(c,{frameId:w,g:"-"===m?"-":u(m)})}for(g=0;g<c.length;g++)c[g].visitId=d||"",c[g].j=null!==f?u(f):-1}return c}function Oa(){return F()||L(0,!0)}function F(){var a=E(!0);if(!(Qa()<=t())){W(!1);if(1<=a.length)return-1!==r()&&2<=I(Ra)&&a[0].j>=I(xc)?L(0,!0):a[0].visitId||"";(a=oa(ha))||(a=da(ha));return a||""}return""}function W(a){var b=t(),c=zb().m;a&&(c=b);Ab(b+Bb+"|"+c);Cb()}function Db(a){a||(a=aa(1,1E6));
var b=fa()||"";b||(b=(0===g?-1*aa(2,21)+"$":"")+N(32),S(b),b=fa(b)||"");a=""+a;for(var c=a.length,d=[],f=0;f<b.length;f++)d[f]=String.fromCharCode(65+Math.abs((b.charCodeAt(f)^a.charCodeAt(f%c))%26));b=d.join("");for(a=0;a<Sa.length;a++)Sa[a](b,M);return b}function Ta(a){var b=E(!1),c=2<=I(Ra)?0:-1;V(b,a,c);Ua(ha,a);K(Va,String(c));W(!0)}function L(a,b){b&&(M=!0);a=Db(t());Ta(a);return a}function yc(a){Sa.push(a)}function Cb(){Wa&&$a(Wa);Wa=X(Eb,Qa()-t())}function Eb(){if(Qa()<=t()&&R()){var a=Db(t());
Ta(a);return!0}Ba(Cb);return!1}function Ab(a){B("rxvt",a,void 0,m("ssc"));Ua("rxvt",a)}function Ua(a,b){m("dpvc")||m("pVO")?(ca(a,b),ga(a)):(K(a,b),Q(a))}function Fb(){var a=J("rxvt");a||(a=oa("rxvt")||"")||(a=da("rxvt")||"");return a}function Gb(){var a=F()||"";Ua(ha,a);a=Fb();Ab(a)}function zb(){var a={v:0,m:0},b=Fb();if(b)try{var c=b.split("|");2===c.length&&(a.v=parseInt(c[0],10),a.m=parseInt(c[1],10))}catch(e){}return a}function Qa(){var a=zb();return Math.min(a.v,a.m+Hb)}function zc(a){Bb=a}
function Na(a){void 0===a&&(a=!0);Ma=a}function Ac(){var a=M;M=!1;return a}function Bc(){Eb()||W(!1)}function Cc(){if(0===g&&-1!==r()&&2<=I(Ra)){var a=E(!1),b=r()+1;V(a,"",b);K(Va,String(b))}}function r(){var a=E(!0);if(1<=a.length&&!isNaN(a[0].j))return a[0].j;a=oa(Va)||"";a=u(a);return isNaN(a)?-1:a}function Xa(){var a=J("rxVisitor");if(!a||a.length&&a.length!==Ya)a=oa("rxVisitor")||da("rxVisitor"),a&&a.length===Ya||(Ib=!0,a=t()+"",a+=N(Ya-a.length));var b=a;if(m("dpvc")||m("pVO"))ca("rxVisitor",
b);else{var c=new Date;c.setFullYear(c.getFullYear()+2);K("rxVisitor",b)}B("rxVisitor",b,c,m("ssc"));return a}function Dc(){return Ib}function Ec(a){var b=J("rxVisitor");p("rxVisitor");Q("rxVisitor");ga("rxVisitor");B("rxVisitor",b);f.pVO=!0;a&&K(Za,"1");Gb()}function Fc(){ga(Za);m("pVO")&&(f.pVO=!1,Xa());Gb()}function Gc(){var a=d.dT_;d.dT_={version:"10171190704121258",cfg:a?a.cfg:"",iCE:a?a.iCE:function(){return navigator.cookieEnabled},ica:1,disabled:!1,A:!1,gx:Kb,cx:Lb,mp:Zb,mtp:ac,mi:cc,mw:ec,
gAST:Vb,ww:Sb,stu:Pb,nw:t,apush:k,st:X,si:Ob,aBPSL:ab,rBPSL:Mb,gBPSL:Nb,aBPSCC:Tb,gBPSCC:Ub,buildType:0===g?"dynatrace":"appmon",gSSV:da,sSSV:ca,rSSV:Q,rvl:ga,pn:u,iVSC:ma,p3SC:wb,pLSC:vb,io:n,dC:p,sC:B,esc:Xb,gSId:U,gDtc:fa,gSC:tb,sSC:S,gC:J,cRN:aa,cRS:N,gEL:gb,gEBTN:fb,gSCN:gc,gPCHN:hc,gRHN:ic,gPCCN:kc,gLCN:jc,gMSIDCN:kb,cfgO:oc,pCfg:ob,pCSAA:xa,cFHFAU:Ha,sCD:Ia,bcv:m,ncv:I,scv:l,stcv:nc,rplC:pb,cLSCK:Fa,gFId:rc,gBAU:Ja,iS:Aa,eWE:Ba,oEIE:sc,oEIEWA:za,eA:tc,dA:uc,gcSId:vc,iNV:Dc,gVID:Xa,dPV:Ec,ePV:Fc,
sVIdUP:Na,sVTT:zc,sVID:Ta,rVID:F,gVI:Oa,gNVId:L,gARnVF:Ac,cAUV:Bc,uVT:W,aNVL:yc,gPC:E,cPC:yb,sPC:V,clB:Wb,ct:$a,aRI:mb,iXB:nb,gXBR:lc,sXBR:mc,de:lb,cCL:hb,gEC:r,iEC:Cc}}var G=window;if(!G.dT_||!G.dT_.cfg||"string"!=typeof G.dT_.cfg||G.dT_.initialized)G.console&&G.console.log("Initconfig not found or agent already initialized! This is an injection issue.");else if(!(navigator.userAgent&&0<=navigator.userAgent.indexOf("RuxitSynthetic"))){var d="undefined"!==typeof window?window:self,ra,sa,Z,db=[],Da,
La,la,ja={},Yb=new (function(){return function(){this["!"]="%21";this["~"]="%7E";this["*"]="%2A";this["("]="%28";this[")"]="%29";this["'"]="%27";this.$="%24";this[";"]="%3B";this[","]="%2C"}}()),va,bb,dc=d.postMessage,cb=d.Worker,Qb=d.Blob,Rb=d.URL&&d.URL.createObjectURL,fc=d.Worker&&d.Worker.prototype.postMessage,$b=d.parent.postMessage,bc=d.top.postMessage,Y,Ea,ka=!1,g,ya,ba="dtPC",A="dtCookie",ib="x-dtpc",jb="x-dtreferer",wa="dtLatC",O,f={},rb=!!navigator.userAgent&&0<=navigator.userAgent.indexOf("RuxitSynthetic"),
D=[],ea,Pa=6E8,Jb,Ka,T,Hc={childList:!0,subtree:!0,attributes:!0,attributeOldValue:!0},Ic=["_DT_RENDERING_"],v=[],q,xc="mel",Ra="vs",Va="rxec",ha="rxvisitid",Wa,Bb=18E5,Hb=216E5,M=!1,Sa=[],Ma=!1,Za="dt-pVO",Ya=45,Ib=!1;if(!function(a){try{g=a;var b=d.dT_;ra=d.XMLHttpRequest;sa=d.ActiveXObject;va=d.setTimeout;bb=d.setInterval;ka||(Y=d.clearTimeout,Ea=d.clearInterval);if(!((b.iCE?b.iCE():navigator.cookieEnabled)&&("complete"!==document.readyState||d.performance&&d.performance.timing)))return!1;Gc();
try{La=d.localStorage,la=d.sessionStorage}catch(Ca){}Da=t();Z=[];ja={};ka||(d.clearTimeout=eb(Y),d.clearInterval=eb(Ea),ka=!0);ea=Da%Pa+"_"+u(aa(0,1E3)+"");ya={ade:"",agentLocation:"",agentname:"",agentUri:"",uana:"data-dtname,data-dtName",app:"",async:!1,auto:!1,bandwidth:"300",bp1:!1,bp2:!1,bp:0===g?1:2,bs:!1,buildNumber:0,coo:!1,cooO:!1,cors:!1,csu:"",cux:!1,dataDtConfig:"",debugName:"",dASXH:0===g?!1:!0,disableCookieManager:!1,disableLogging:!1,dmo:!1,dpvc:!1,disableXhrFailures:!1,domain:"",domainOverride:"",
doNotDetect:"",dsndb:!1,dsss:!1,euf:!1,evl:"",extblacklist:"",exteventsoff:!1,fa:!1,featureHash:"",ffi:!1,hvt:216E5,lastModification:0,imm:!1,initializedModules:"",ign:"",instr:"",lab:!1,legacy:!1,lmut:!0,lzwd:!1,lzwe:!1,md:"",name:"",mdn:5E3,mel:200,mepp:10,moa:30,mrt:3,mpl:0===g?1024:100,msl:3E4,mhl:4E3,ncw:!1,ntd:!1,oat:180,ote:!1,perfbv:1,pui:!1,pVO:!1,rdnt:0,reportUrl:"dynaTraceMonitor",restoreTimeline:!1,rid:"",ridPath:"",rpid:"",rt:0===g?1E4:0,rtl:0===g?0:100,rtp:0===g?2:1,rtt:1E3,rtu:200,
rx_visitID:"",sl:100,sosi:!1,spc:"",srbbv:1,srbw:!0,srad:!0,srmr:100,srms:"1,1,,,",srsr:1E5,srtbv:3,srtd:1,srtr:500,srwo:!1,ssc:!1,st:3E3,svNB:!1,syntheticConfig:!1,tal:0,tp:"500,50,3",tt:100,tvc:3E3,uam:!1,useNewCookies:!1,uxdce:!1,uxdcw:1500,uxrgce:!0,uxrgcm:"100,25,300,3;100,25,300,3",vcfi:0===g?!0:!1,vs:1,WST:!1,xb:"",xmut:!0,xt:0};a:{var c=z().cfg;f={reportUrl:"dynaTraceMonitor",initializedModules:"",csu:"dtagent",dataDtConfig:"string"===typeof c?c:""};z().cfg=f;0===g&&(f.csu="ruxitagentjs");
var e=f.dataDtConfig;e&&-1===n(e,"#CONFIGSTRING")&&(xa(e,f),Ga("domain"),Ga("auto"),Ga("app"),Ha(f));var k=fb("script"),p=gb(k),h=-1===n(f.dataDtConfig||"","#CONFIGSTRING")?f:null;if(0<p)for(a=0;a<p;a++)b:{var b=void 0,q=k[a],c=h;if(q.attributes){var B=f.csu+"_bootstrap.js",e=/.*\/jstag\/.*\/.*\/(.*)_bs(_dbg)?.js$/,D=c,w=q.src,v=w&&w.indexOf(B),E=q.attributes.getNamedItem("data-dtconfig");if(E){var r=w,G=E.value,x={};f.legacy=!0;if(r){var ia=/([a-zA-Z]*)[0-9]{0,4}_([a-zA-Z_0-9]*)_([0-9]+)/g.exec(r);
ia&&ia.length&&(x.csu=ia[1],x.featureHash=ia[2],0===g&&(x.agentLocation=r.substr(0,n(r,ia[1])-1),x.buildNumber=ia[3]))}G&&xa(G,x,!0);qb(x.domain)||(x.domainOverride=location.hostname+","+x.domain,delete x.domain);b=x;if(!c)D=b;else if(!b.syntheticConfig){h=b;break b}}b||(b=f);if(v&&0<=v){var K=v+B.length+5;b.app=w.length>K?w.substr(K):"Default%20Application"}else if(w){var L=e.exec(w);L&&(b.app=L[1])}h=D}else h=c}if(h)for(var N in h)h.hasOwnProperty(N)&&(k=N,f[k]=h[k]);f.rx_visitID&&(z().rx_visitID=
f.rx_visitID);var ca=Fa();try{var S=(h=La)&&h.getItem(ca);if(S){var pa=ob(S),y=xa(pa.config||""),C=f.lastModification||"0",U=u((y.lastModification||pa.lastModification||"0").substr(0,13)),fa="string"===typeof C?u(C.substr(0,13)):C;if(!C||U>=fa)if(y.agentname=pa.name,y.agentUri?Ha(y):(y.csu=pa.name,y.featureHash=pa.featureHash),Ia(y,!0),nb(y),mb(y),U>(f.lastModification||0)){var ga=m("auto");f=pb(y);f.auto=ga}}}catch(Ca){}Ia(f);try{var V=f.ign;if(V&&(new RegExp(V)).test(d.location.href)){document.dT_=
d.dT_=void 0;var qa=!1;break a}}catch(Ca){}f.useNewCookies&&0===g&&(ba="rxpc",A="rxsession",wa="rxlatency",ib="x-rxpc",jb="x-rxreferer");qa=!0}if(!qa)return!1;qc();try{Jb=z().disabled||!!da("dtDisabled")}catch(Ca){}var F;if(!(F=l("agentLocation")))a:{var W=l("agentUri");if(W||document.currentScript){var H=W||document.currentScript.src;if(H){var ha=-1===n(H,"_bs")&&-1===n(H,"_bootstrap")&&-1===n(H,"_complete")?1:2,M=H.lastIndexOf("/");for(qa=0;qa<ha&&-1!==M;qa++)H=H.substr(0,M),M=H.lastIndexOf("/");
F=H;break a}}var X=location.pathname;F=X.substr(0,X.lastIndexOf("/"))}Ka=F;T=l("agentname")||l("csu")||(0===g?"ruxitagentjs":"dtagent");"true"===J("dtUseDebugAgent")?0>T.indexOf("dbg")&&(T=l("debugName")||T+"dbg"):T=l("name")||T;if(!m("auto")&&!m("legacy")&&!Jb){var O=l("agentUri")||Ja(l("featureHash")),P;if(!(P=m("async")||"complete"===document.readyState)){var Q=d.navigator.userAgent,R=Q.indexOf("MSIE ");P=0<R?9>=parseInt(Q.substring(R+5,Q.indexOf(".",R)),10):!1}P?Aa(O,m("async"),void 0,void 0,
"dtjsagent"):(document.write('<script id="dtjsagentdw" type="text/javascript" src="'+O+'">\x3c/script>'),document.getElementById("dtjsagentdw")||Aa(O,m("async"),void 0,void 0,"dtjsagent"))}var ma=d.location.href;0===g&&-1!==n(ma,"_DT_RENDERING_")&&(z().RMOD={conf:Hc,ignore:Ic,ID:"_DT_RENDERING_"},Ka&&Aa(Ja("R"),!0,void 0,void 0,"dtjsagent"));J(A)&&(f.cooO=!0);wc();if(0===g){var na=!!oa(Za);f.pVO=na;Ba(Xa)}0===g&&I("hvt")&&(Hb=I("hvt"));za(yb,[1])}catch(Ca){return!1}return!0}(0)){try{delete d.dT_}catch(a){d.dT_=
void 0}hb()&&d.console.log("JsAgent initCode initialization failed!")}}})();}).call(this);




</script>
	<!-- Hotjar Tracking Code for faq.beachbody.com -->

<script>

    (function(h,o,t,j,a,r){

        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};

        h._hjSettings={hjid:977138,hjsv:6};

        a=o.getElementsByTagName('head')[0];

        r=o.createElement('script');r.async=1;

        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;

        a.appendChild(r);

    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');

</script>

<!-- Hotjar Tracking Code for faq.beachbody.com -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://connect.facebook.net/en_US/sdk.js"></script>
<script>
  window.fbAsyncInit = function() {
  FB.init({
    appId            : '<?php echo $facebookAppId;?>',
    autoLogAppEvents : true,
    xfbml            : true,
    version          : 'v3.2'
  });

 };
 
 
  $(document).ready(function(){ 
    var windowWidth = $(window).width(); //alert(windowWidth);
    var blockwidth =  $('.text-block').width(); 
	//alert(windowWidth);
     $('.text-block').css('margin-left', windowWidth / 2 - 73 + 'px'); 
     if ($(window).width() < 1024 && $(window).width() >767){ 
        $('.text-block').css('margin-left', windowWidth / 2 - 263 + 'px');
      }  
     if ($(window).width() < 767) { 
        $('.text-block').css('margin-left', windowWidth / 2 - 74 + 'px');
      }    
	 
	  if ($(window).width() == 768) { 
        //$('.text-block').css('margin-left', 289 + 'px');
      }    
          
  });
  $(window).resize(function(){
     var windowWidth = $(window).width(); //alert(windowWidth);
	 //alert(windowWidth);
      $('.text-block').css('margin-left', windowWidth / 2 - 73 + 'px');
      if ($(window).width() < 1024 && $(window).width() >767) {
        $('.text-block').css('margin-left', windowWidth / 2 - 263 + 'px');
      } 
      if ($(window).width() < 767) {
        $('.text-block').css('margin-left', windowWidth / 2 - 74 + 'px');
      }
      if ($(window).width() == 768) { 
        //$('.text-block').css('margin-left', 289 + 'px');
      }
	  
    });
  $(window).on('load', function(){
     var windowWidth = $(window).width(); //alert(windowWidth);
	// alert(windowWidth);
      $('.text-block').css('margin-left', windowWidth / 2 - 73 + 'px');
      if ($(window).width() < 1024 && $(window).width() >767) { 
        $('.text-block').css('margin-left', windowWidth / 2 - 263 + 'px');
      } 
      if ($(window).width() < 767) { 
        $('.text-block').css('margin-left', windowWidth / 2 - 74 + 'px');
      } 
	  if ($(window).width() == 768) { 
        //$('.text-block').css('margin-left', 289 + 'px');
      }     
    });
	

</script>

<script>

FB.Event.subscribe('send_to_messenger', function(e) {
    // callback for events triggered by the plugin
    console.log(e);
    if (e.event === 'opt_in') {
		var page_url = String(window.location.href);
		var exploded_url = page_url.split('/');
		var ref_no_index = exploded_url.indexOf('ref_no');
		ref_no = exploded_url[ref_no_index+1];
		$.ajax({
		   url: '/cc/bbresponsivecontroller/fb_status_update',  
		   data:  {ref_no: ref_no},
		   async:true,
		   dataType: "json", 
		   type: "POST",
			  success: function(data) {    
			 ajaxResult=data;
			}
			  
			}); 

		//var action = dtrum.enterAction('Continue clicked', 'click', null, 'info');
        setTimeout(redirectToMessenger, 1000);
		//dtrum.leaveAction(action);
    }
});
 
function redirectToMessenger() {
    window.location = "http://m.me/<?php echo $facebookPageId?>";
}


</script>

    
<div class="page-holder">
  <div class="holder">
    <div class="image-holder">
      <img src="/euf/assets/images/mobile-icons/fb.jpg">
      <p class="f-24"></p>
      <p class="p-6"></p>
      <p class="p-3"></p>
    </div>
	
    <div class="text-block">      
      <div class="fb-wrapper">
          <div class="fb-send-to-messenger" messenger_app_id="<?php echo $facebookAppId; ?>" page_id="<?php echo $facebookPageId;?>" data-ref="<?php echo $contextId;?>" color="blue" size="xlarge" cta_text="MESSAGE_ME">
      </div>
     
	  <div>
    </div>
  </div>
</div>

 

</BODY>
</HTML>