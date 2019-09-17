
$(document).ready(function(){if($.browser.msie&&window.location.href.indexOf("/cn-zh/")>0&&jQuery.browser.version==7||jQuery.browser.version==9)
{$('.allArticlesSingleViewContainer .ArticleReadMore .whitearrow-link').css('padding-top','4px');}
setStayConnectedFooterLayout();var url=window.location.href.toString().toLowerCase();if(url.indexOf("edit.")<0){var headID=document.getElementsByTagName("head")[0];var cssNode=document.createElement('link');cssNode.type='text/css';cssNode.rel='stylesheet';cssNode.href='/_layouts/Accenture/Styles/Hide_LiveSiteOnly.css';headID.appendChild(cssNode);}
var stayConnectedTimer;var stayConnectedDelay=1;$('.stay-connected .parent .pop-box').hide();$(".stay-connected .parent li").mouseover(function(){clearTimeout(stayConnectedTimer);$(".stay-connected .parent .pop-box").hide();$(this).find('.pop-box').show();$(this).find('.button a').hide();var stayconnecteddiv=jQuery('.stay-connected');var rightlimit=stayconnecteddiv.position().left+stayconnecteddiv.width();var rightvisiblepopbox=$(this).position().left+174;if(rightvisiblepopbox>rightlimit){var finalpos=rightlimit-174;$(this).find('.pop-box').css("left",finalpos+"px");}});$(".stay-connected .parent li").mouseout(function(){stayConnectedTimer=setTimeout("$('.stay-connected .parent .pop-box').hide();",stayConnectedDelay);$(this).find('.button a').show();});$(".stay-connected .parent .pop-box").mouseover(function(){clearTimeout(stayConnectedTimer);stayConnectedTimer=setTimeout("$('.stay-connected .parent .pop-box').hide();",stayConnectedDelay);});if((navigator.userAgent.match(/iPhone/i))||(navigator.userAgent.match(/iPod/i))||navigator.userAgent.match(/iPad/i))
{for(var ctr=0;ctr<$('.stay-connected .parent li').length;ctr++)
{var StayConWidth=jQuery('.stay-connected .parent li').eq(ctr).width();StayConWidth=StayConWidth-3
jQuery('.stay-connected .parent li').eq(ctr).width(StayConWidth);}}
var displayCountryLanguageSelector=false;var isMouseOnHover=false;$('.country-language-selector .control-selector .drop-button').click(showCountryLanguageSelector);$('.country-language-selector .control-selector .icon-flag').click(showCountryLanguageSelector);$('.country-language-selector .control-selector .drop-button').mouseover(mouseHoverTrue);$('.country-language-selector .control-selector .drop-button').mouseout(mouseHoverFalse);$('.country-language-selector .control-selector .icon-flag').mouseover(mouseHoverTrue);$('.country-language-selector .control-selector .icon-flag').mouseout(mouseHoverFalse);$(".country-language-selector .dropdown-selector").mouseover(mouseHoverTrue);$(".country-language-selector .dropdown-selector").mouseout(mouseHoverFalse);function showCountryLanguageSelector(){displayCountryLanguageSelector=true;isMouseOnHover=true;if($('.country-language-selector .dropdown-selector').is(":visible")){$('.country-language-selector .dropdown-selector').hide();}
else{$('.country-language-selector .dropdown-selector').show();}
if(/msie|MSIE 6/.test(navigator.userAgent)){$(document.frames.ddframe.document.body).css('border',"1px solid gray");}}
function mouseHoverTrue(){isMouseOnHover=true;}
function mouseHoverFalse(){isMouseOnHover=false;}
$(document).click(function(){if((displayCountryLanguageSelector==true)&&(isMouseOnHover==false)){$('.country-language-selector .dropdown-selector').hide();displayCountryLanguageSelector=false;}});$(document).ready(function(){if(/msie|MSIE 6/.test(navigator.userAgent)){$('.country-language-selector .dropdown-selector').css('padding',"0px");var countryLangSelector=$('.country-language-selector .dropdown-selector');var countryLangHeight=$('.country-language-selector .dropdown-selector').height();var countryLangWidth=$('.country-language-selector .dropdown-selector').width();for(c=0;c<countryLangSelector.length;c++){countryLangSelector[c].innerHTML=('<iframe id="ddframe" src="/_layouts/blank.htm" scrolling="no" frameborder="1"></iframe>'+countryLangSelector[c].innerHTML);var frameStyle=countryLangSelector[c].childNodes[0];countryLangHeight=countryLangHeight+10;countryLangWidth=countryLangWidth+1;frameStyle.style.height=countryLangHeight+"px";frameStyle.style.width=countryLangWidth+"px";}
$('.country-language-selector .dropdown-selector').css('height',countryLangHeight+"px");$('.country-language-selector .dropdown-selector').css('border',"none");$('.country-language-selector .dropdown-selector').css('margin-left',"-"+countryLangWidth+"px");$('.country-language-selector .dropdown-selector .countryColumns').css('margin',"-"+countryLangHeight+"px 0px 0px 14px");}});if(/msie|MSIE 6/.test(navigator.userAgent)){$('img[src$=.png], img[src$=.jpg]').each(function(){if(!this.complete){this.onload=function(){SetImageTransparencyInIE6(this)};}else{SetImageTransparencyInIE6(this);}});}
setLeftCoordinateLoginNavigationMenu();});if(/msie|MSIE 6/.test(navigator.userAgent)){try{document.execCommand('BackgroundImageCache',false,true);}
catch(e){}}
function setLeftCoordinateLoginNavigationMenu(){if($('.LoginMenuButton')[0]){var loginMenu=$('.LoginMenuButton');if(loginMenu.length){var loginMenuButtonRight=loginMenu.position().left+loginMenu.width();var loginNavMenu=$('.LoginNavigationMenu');var loginNavigationMenuLeft=loginMenuButtonRight-loginNavMenu.width();loginNavMenu.css("left",loginNavigationMenuLeft);}}}
function selectDropDownIEbehavior(){if(!$.browser.msie)
return;var expand=function(){var width=$(this).css("width");if(width=="auto")
return;$(this).data("origWidth",width).css("width","auto")};var contract=function(){var width=$(this).css("width");if(width!="auto")
return;var origWidth=$(this).data("origWidth");if(origWidth==="undefined")
return;$(this).css("width",origWidth).data("origWidth",width);};$("select").each(function(index){var width=$(this).css("width");var span='<span style="padding: 2px; width:'+width+'; overflow:hidden; float:left;">';$(this).wrap(span);$(this).mousedown(expand).blur(contract).change(contract);});}
function setStayConnectedFooterLayout(){for(var ctr=0;ctr<$('.stay-connected .parent li').length;ctr++)
{var width=$('.stay-connected .parent li').eq(ctr).find('.button').width();var widthTitle=$('.stay-connected .parent li').eq(ctr).find('.title').width();var height=$('.stay-connected .parent li').eq(ctr).find('.title').height();$('.stay-connected .parent li').eq(ctr).find('.button').width(width);$('.stay-connected .parent li').eq(ctr).find('.title').width(widthTitle);$('.stay-connected .parent li').eq(ctr).find('.button').height(height);}}
function SetImageTransparencyInIE6(transparentImage){var src=transparentImage.src;if(!transparentImage.style.width){transparentImage.style.width=$(transparentImage).width();}
if(!transparentImage.style.height){transparentImage.style.height=$(transparentImage).height();}
transparentImage.onload=function(){};transparentImage.src='/PublishingImages/blank.gif';transparentImage.runtimeStyle.filter="progid:DXImageTransform.Microsoft.AlphaImageLoader(src='"+src+"',sizingMethod='scale')";}
function PopUpWindow(refer){$(document).ready(function(){var height=(screen.height*0.70);var width=(screen.width*0.80);var top=((screen.height/2)-(height/2));var left=((screen.width/2)-(width/2));var openWin=self.open(refer,"popupwindow","toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, copyhistory=no, width="+width+", height="+height+", top="+top+", left="+left);});}
function PrintContent(){var winprint;var strPageContentHtml;var strFooterHtml;var strOption;var strPrintHtml;var strTitle=document.title;var pageUrl=document.location.href;strOptions="toolbar=0,location=0,directories=0,menubar=0,status=0,resizable=1,scrollbars=1,";strOptions+="width=760,height=560,left=100,top=25";strPageContentHtml=$('.main-contents').html();strPageContentHtml=strPageContentHtml.replace(/<script(.|\s)*?\/script>/gi);var footer=$('.footer');if(footer.length>1){strFooterHtml='<div class="footer">'+$(footer[1]).html()+'</div>';}else{strFooterHtml='<div class="footer">'+$(footer).html()+'</div>';}
strPrintHtml='<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">';strPrintHtml+='<html><head>';strPrintHtml+='<title>'+strTitle+'</title>';strPrintHtml+=ApplyCSS();strPrintHtml+='</head><body onload="print()">';strPrintHtml+='<div class="print-logo-container">';strPrintHtml+='<img class="logo" src="/PublishingImages/AccSignature_148px_gray.jpg"/></div>';strPrintHtml+='<div id="popup-content" class="popup-content">';strPrintHtml+=strPageContentHtml;strPrintHtml+='</div>';strPrintHtml+='<div class="print-footer-section">';strPrintHtml+='<div class="print-url-container fsize-c">';strPrintHtml+='<div class="print-url-lbl"><strong>Find this article at:</strong></div>';strPrintHtml+='<a class="print-url-link" href="'+pageUrl+'" target="_blank">';strPrintHtml+=pageUrl+'</a></div>';strPrintHtml+=strFooterHtml;strPrintHtml+='</div></body></html>';winprint=window.open(window.location.href,"",strOptions);winprint.document.open();winprint.document.write(strPrintHtml);winprint.document.close();var linksCollection=winprint.document.getElementById('popup-content').getElementsByTagName('a');for(var index=0;index<linksCollection.length;index++){linksCollection[index].removeAttribute('href');}
if((/msie|MSIE 6/.test(navigator.userAgent))||(/msie|MSIE 7/.test(navigator.userAgent))||(/msie|MSIE 8/.test(navigator.userAgent))){winprint.location.reload();}}
function ApplyCSS(){var strCssHtml;var strCurrentSite=document.location.hostname.toLowerCase();strCssHtml='<link type="text/css" rel="stylesheet" ';if(strCurrentSite.indexOf("careers")>-1)
strCssHtml+='href="/Style%20Library/Accenture/Core%20Styles/zzz_careersstyle-core.css"/>';else
strCssHtml+='href="/Style%20Library/Accenture/Core%20Styles/zzz_style-core.css"/>';strCssHtml+='<link type="text/css" rel="stylesheet" ';strCssHtml+='href="/Style%20Library/Accenture/Core%20Styles/Media_Print_Style.css"/>';var currAddress=window.location.pathname;if(currAddress.search(/network/i)==1)
{strCssHtml+='<link type="text/css" rel="stylesheet" ';strCssHtml+='href="/Style%20Library/Accenture/Core%20Styles/Media_Print_Style_Network.css"/>';}
var fileNameIE6="Style_IE6";var fileNameIE7="Style_IE7";var fileNameIE8="Style_IE8";if(strCurrentSite.indexOf("careers")>-1){fileNameIE6+="-Careers";fileNameIE7+="-Careers";fileNameIE8+="-Careers";}
strCssHtml+='<!--[if IE 6]>';strCssHtml+='<link type="text/css" rel="stylesheet" href="/Style Library/Accenture/Core Styles/'+fileNameIE6+'.css"></link>';strCssHtml+='<![endif]-->';strCssHtml+='<!--[if IE 7]>';strCssHtml+='<link type="text/css" rel="stylesheet" href="/Style Library/Accenture/Core Styles/'+fileNameIE7+'.css"></link>';strCssHtml+='<![endif]-->';strCssHtml+='<!--[if IE 8]>';strCssHtml+='<link type="text/css" rel="stylesheet" href="/Style Library/Accenture/Core Styles/'+fileNameIE8+'.css"></link>';strCssHtml+='<![endif]-->';return strCssHtml;}<!--
var _UHcookieSubstring;var _UHcurrentPage=document.title+"~"+unescape(document.location.href.toLowerCase())
var _UHCookieKey="URLHistory";var _UHLinks=new Array();var _UHLinkDefinitions=new Array();var _UHArray=new Array();var _UHMaxLength=6;var _checker=-1;var _ERUrlString;var _ERCookiekey="External_ReferrerURL";var _ExternalReferrerUrl=document.referrer;var _ReferrerUrl=document.referrer;var _RCookiekey="ReferrerURL";var _expireDate=new Date();_expireDate.setHours(_expireDate.getHours()+24);_UHLinkDefinitions=GetUHList();UHCreateLinkArray()
UHMatchPage();if(top.location!=self.location)
{top.location=self.location}
if(_ExternalReferrerUrl.length>0)
{SetExternalReferrerUrlCookie();}
SetReferrerUrlCookie();function UHGetCookieVal(offset)
{var endstr=unescape(document.cookie.indexOf(";",offset));if(endstr==_checker)
{endstr=document.cookie.length;}
return unescape(document.cookie.substring(offset,endstr));}
function UHGetCookie(name)
{var _argument=name;var _argumentLength=_argument.length;var _cookieLength=document.cookie.length;var _cookieIndex=0;while(_cookieIndex<_cookieLength)
{var _endingIndex=_cookieIndex+_argumentLength;if(document.cookie.substring(_cookieIndex,_endingIndex)==_argument)
{return UHGetCookieVal(_endingIndex);break;}
_cookieIndex++;}
return"";}
function GetUHList()
{var extRef=unescape(_ExternalReferrerUrl);_UHcookieSubstring=unescape(UHGetCookie(_UHCookieKey+'='));if(extRef!="")
{if(extRef.toLowerCase().indexOf("accenture.com")<0)
{if(extRef.indexOf("?")>0)
{extRef=extRef.substring(0,extRef.indexOf("?"));}
_UHcookieSubstring=extRef+" "+"|"+_UHcookieSubstring}}
extRef="";_UHArray=_UHcookieSubstring.split("|");return _UHArray;}
function UHMatchPage()
{var _cookie="";var _match;var _end=0;_match=_UHcookieSubstring.indexOf(_UHcurrentPage+"|");preUrl=UHUrlChecker(_UHcookieSubstring)
curUrl=UHUrlChecker(_UHcurrentPage)
if($('#MSOSPWebPartManager_DisplayModeName').val()!='Browse'||preUrl==curUrl){return}
if(_UHLinks.length!=_UHMaxLength)
{if(document.cookie.length>2047)
{_end=_UHcookieSubstring.lastIndexOf("|");_UHcookieSubstring=_UHcookieSubstring.substring(0,_end);_end=_UHcookieSubstring.lastIndexOf("|");_UHcookieSubstring=_UHcookieSubstring.substring(0,_end+1);_cookie=_UHcurrentPage+"|"+_UHcookieSubstring;}
_cookie=_UHcurrentPage+"|"+_UHcookieSubstring;}
else
{_end=_UHcookieSubstring.lastIndexOf("|");_UHcookieSubstring=_UHcookieSubstring.substring(0,_end);_end=_UHcookieSubstring.lastIndexOf("|");_UHcookieSubstring=_UHcookieSubstring.substring(0,_end+1);_cookie=_UHcurrentPage+"|"+_UHcookieSubstring;}
UHUpdateCookie(_cookie);_cookie="";_match=0;_end=0;}
function UHUpdateCookie(value)
{var _updatedCookie=_UHCookieKey+"="+escape(value)+"; path=/"+"; domain=.accenture.com";document.cookie=_updatedCookie;_updatedCookie="";}
function UHCreateLinkArray()
{for(var _counter=0;_counter<_UHLinkDefinitions.length-1;++_counter)
{var _link=_UHLinkDefinitions[_counter].split("~");_UHLinks[_counter]=_link;}
return _UHLinks;}
function UHUrlChecker(Url)
{var cookieArray=new Array();var pageUrl;var pageTitle
cookieArray=Url.split("|");if(cookieArray!=null)
{pageUrl=cookieArray[0];}
else
{pageUrl=Url}
pageUrl=pageUrl.replace("http://","");pageUrl=pageUrl.replace("https://","");pageTitle=pageUrl.substring(0,pageUrl.indexOf("~"));pageUrl=pageTitle+pageUrl.substring(pageUrl.indexOf("/"));return(pageUrl)}
function SetExternalReferrerUrlCookie()
{_ERUrlString=unescape(_ExternalReferrerUrl);if(_ERUrlString.indexOf("?")>0)
{_ERUrlString=_ERUrlString.substring(0,_ERUrlString.indexOf("?"));}
if(_ERUrlString.toLowerCase().indexOf("accenture.com")<0)
{var _newCookie=_ERCookiekey+"="+unescape(_ExternalReferrerUrl)+"; path=/"+"; domain=.accenture.com";document.cookie=_newCookie;_newCookie="";}}
function SetReferrerUrlCookie()
{var referrer="";var prevUrl=_ReferrerUrl;var curUrl=document.location.pathname;var hostName=document.location.hostname;var offset=prevUrl.indexOf(hostName)+hostName.length;if(offset<0){offset=0;}
var qStringIndex=prevUrl.indexOf("?");if(qStringIndex<0){qStringIndex=prevUrl.length;}
prevUrl=prevUrl.substring(offset,qStringIndex);var portOffset=prevUrl.indexOf("/");if(portOffset>0){prevUrl=prevUrl.substring(portOffset);}
if(prevUrl!=curUrl){if($('#MSOSPWebPartManager_DisplayModeName').val()=='Browse'){if(_ReferrerUrl.length>0){referrer=_ReferrerUrl;}
else if(_UHLinks.length>0){referrer=_UHLinks[0][1];}
var _newCookie2=_RCookiekey+"="+unescape(referrer)+"; path=/"+"; domain=.accenture.com";document.cookie=_newCookie2;_newCookie2="";}}}
_UHLinks=null;_UHcurrentPage="";_UHCookieKey="";_ERCookieKey="";_RCookiekey="";_ExternalReferrerUrl="";_ReferrerUrl="";var display=true;function ToggleNavigation(ScopeDiv,ImageButton){display=true;if(document.getElementById(ScopeDiv).style.display==""){document.getElementById(ScopeDiv).style.display="none";document.getElementById(ImageButton).src="/PublishingImages/white-arrow_HPN.gif";}
else{document.getElementById(ScopeDiv).style.display="";document.getElementById(ImageButton).src="/PublishingImages/white-arrow_whiteBG_HPN.gif";}
return false;}
$(document).ready(function(){$("#LogoutPanel .LoginNote a").click(function(){var acnCookie=$.cookie('_ACCENTURE_COM_');if(acnCookie!=null&&acnCookie!=""){if(acnCookie.indexOf("&")>-1){var updatedAcnCookie=acnCookie.substr(0,acnCookie.indexOf("&"));$.cookie('_ACCENTURE_COM_',updatedAcnCookie,{expires:365,domain:'accenture.com',path:'/'});}}});});var isClose=false;var origVal="";var rowHighlighted;var pos=0;var searchBox;var searchSuggestion=false;var divID="";var chosenRow="";var timeOut;var isDropdownOver="";var MicrositesSearch=false;var timer;var display=true;function SearchBoxOnFocus(searchTextBox){if(searchSuggestion==false)
searchTextBox.value="";}
function Detect(searchTextBox,e){var KeyID=e.keyCode;var backspaceKey=8;var enterKey=13;var escapeKey=27;var arrowUpKey=38;var rightKey=39;var arrowDownKey=40;var printScreenKey=44;var deleteKey=46;searchBox=searchTextBox;switch(KeyID){case printScreenKey:break;case enterKey:Collapse(searchTextBox);break;case backspaceKey:{origVal=searchTextBox.value;if(isClose==false){clearTimeout(timeOut);timeOut=setTimeout("Expand('false')",200)}
if(Ltrim(searchTextBox.value).length==0)
isClose=false;pos=0;}
break;case deleteKey:{origVal=searchTextBox.value;if(isClose==false){clearTimeout(timeOut);timeOut=setTimeout("Expand('false')",200)}
if(Ltrim(searchTextBox.value).length==0)
isClose=false;pos=0;}
break;case escapeKey:{if(document.getElementById("row1")!=null)
Collapse(searchTextBox);searchTextBox.value=origVal;}
break;case rightKey:OnRightKey(rowHighlighted);break;case arrowDownKey:{OnDownKey(searchTextBox);}
break;case arrowUpKey:{OnUpKey(searchTextBox);}
break;default:{origVal=searchTextBox.value;if(isClose==false){clearTimeout(timeOut);timeOut=setTimeout("Expand('false')",250)}}}}
function Expand(displaymax){if(searchBox!=undefined){if(isClose==false){divID=GetSearchSuggestDiv(searchBox);var state=document.getElementById(divID);var width=SetSearchSuggestWidth(searchBox);if((Ltrim(searchBox.value).length)>0){origVal=Ltrim(searchBox.value);if(window.ActiveXObject){if(displaymax=="true")
state.innerHTML=DisplayResult(origVal,width,"true");else
state.innerHTML=DisplayResult(origVal,width,"false");}
else if(document.implementation&&document.implementation.createDocument){if(displaymax=="true")
state.appendChild(DisplayResult(origVal,width,"true"));else
state.appendChild(DisplayResult(origVal,width,"false"));}
if(document.getElementById("row1")==null){Collapse(searchBox);}
else if(document.getElementById("row1")!=null){state.className="expand";}}
else{Collapse(searchBox);isClose=false;}}}}
function Collapse(searchTextBox){divID=GetSearchSuggestDiv(searchTextBox);var state=document.getElementById(divID);state.className="collapse";state.innerHTML="";searchSuggestion=true;searchTextBox.focus();}
function DisplayResult(input,width,displaymax){var str=input;var firstChar=String(str).substring(0,1);input=input.replace(",","&#44");input=input.replace(";","&#59");var param="width,"+width+";rawinput,"+input;if(g_basicSearchSuggestionLabel!=undefined)
param+=";suggestionsLabel,"+g_basicSearchSuggestionLabel;if(g_basicSearchCloseLabel!=undefined)
param+=";closeLabel,"+g_basicSearchCloseLabel.toLowerCase();if(IsNumeric(firstChar)){var xmlPath=xmlFilePath+"Numeric.xml";}
else{var xmlPath=xmlFilePath+firstChar+".xml";}
if(displaymax=="true"){param+=";maxdisplay,1000";}
if(g_basicSearchSeeAllLabel!=undefined){param+=";SeeAllLabel,"+g_basicSearchSeeAllLabel;}
var resultSuggestions=xsltTransform(xmlPath,xslFilePath,param);Collapse(searchBox);return(resultSuggestions);}
function OnRightKey(row){Expand(searchBox);Dehighlight(row);pos=0;}
function OnUpKey(searchTextBox){if(document.getElementById("row1")!=null){var row=document.getElementById('row'+pos);if(pos==0){origVal=searchTextBox.value;pos=document.getElementById('searchSuggest').rows.length-1;}
else{Dehighlight(row);pos--}
if(pos==0){searchTextBox.value=origVal;chosenRow="";}
else{var data=document.getElementById('data'+pos);row=document.getElementById('row'+pos)
Highlight(row);if(window.ActiveXObject)
searchTextBox.value=data.innerText;else if(document.implementation&&document.implementation.createDocument)
searchTextBox.value=data.textContent;chosenRow=searchTextBox.value;}}}
function OnDownKey(searchTextBox){if(document.getElementById("row1")!=null){var row=document.getElementById('row'+pos);if((pos==0)&&(origVal.length!=0))
origVal=searchTextBox.value;else
Dehighlight(row);if(pos!=(document.getElementById('searchSuggest').rows.length-1))
pos++;else if(pos>=(document.getElementById('searchSuggest').rows.length-1))
pos=0;var data=document.getElementById('data'+pos);if(pos==0){searchTextBox.value=origVal;chosenRow="";}
else{row=document.getElementById('row'+pos)
Highlight(row);if(window.ActiveXObject)
searchTextBox.value=data.innerText;else if(document.implementation&&document.implementation.createDocument)
searchTextBox.value=data.textContent;chosenRow=searchTextBox.value;}}}
function OnBlurSearchTextBox(searchTextBox){var innerTextVar;if(window.ActiveXObject)
innerTextVar=divID.InnerText;else if(document.implementation&&document.implementation.createDocument)
innerTextVar=divID.textContent;if(innerTextVar=="")
Collapse(searchTextBox);divID=GetSearchSuggestDiv(searchTextBox);var state=document.getElementById(divID);if(state.innerHTML!=""){if(chosenRow==""){searchTextBox.value=origVal;}
else if(chosenRow=="CloseLink"){searchTextBox.focus();searchTextBox.value=origVal;isClose=true;isDropdownOver="";}
else if(chosenRow=="more"){Expand("true");setTimeout(function(){searchTextBox.focus();},10)
isDropdownOver="";}
else{searchTextBox.focus();searchTextBox.value=chosenRow;isDropdownOver="";}}
if(chosenRow!="more"&&isDropdownOver!="true"){state.className="collapse";state.innerHTML="";searchSuggestion=true;chosenRow="";}
if(isDropdownOver=="true"){setTimeout(function(){searchTextBox.focus();},10);}}
function SuggestMouseOut(){chosenRow="";}
function SuggestMouseOver(row){rowHighlighted=document.getElementById("row"+pos);if(rowHighlighted!=undefined)
Dehighlight(rowHighlighted);Highlight(row);pos=row.id.replace("row","");if(window.ActiveXObject)
chosenRow=document.getElementById("data"+pos).innerText;else if(document.implementation&&document.implementation.createDocument)
chosenRow=document.getElementById("data"+pos).textContent;}
function Highlight(row){row.className="highlight";if(row.id=="row1")
document.getElementById("suggestions").className="suggestHighlight";rowHighlighted=row;}
function Dehighlight(row){if(document.getElementById("suggestions")!=null){document.getElementById("suggestions").className="suggestionsText"
row.className="dehighlight";rowHighlighted=row;}}
function SuggestClosed(row){Collapse(searchBox);isClose=true;}
function GetSearchSuggestDiv(searchTextBox){return("searchSuggestBanner");}
function SetSearchSuggestWidth(searchTextBox){if(Ltrim(searchTextBox.id)=="SiteSearchControlStandard_txtBasicSearch")
return("240px");else
return("180px");}
function IsNumeric(numstr){var mystring=numstr;var IsNumber=false;if((mystring.match(/^\d+$/))||(mystring.match(/^\W+$/)))
IsNumber=true;return IsNumber;}
function CloseSuggestOnKeyUp(searchTextBox,event){if(event.keyCode==8||event.keyCode==46){if(Ltrim(searchTextBox.value).length==0){isClose=false;clearTimeout(timeOut);timeOut=setTimeout("Expand('false')",250)}}}
function EnterKeyHandler(event,btn,searchTextBox){var isIE=window.navigator.appName.toLowerCase().indexOf("microsoft")>-1;if(searchTextBox!=undefined){if(event.keyCode==8||event.keyCode==46){if(Ltrim(document.getElementById(searchTextBox).value).length==0){isClose=false;clearTimeout(timeOut);timeOut=setTimeout("Expand('false')",250)}}}
if(event.keyCode==13){var btn=document.getElementById(btn);if(isIE==false){event.returnValue=false;event.cancel=true;window.releaseEvents(event.KEYPRESS);if(btn!=null){btn.click();}}
else{event.returnValue=false;event.cancel=true;if(btn!=null){btn.click();}}}
return false;}
$(document).ready(function(){$('.SearchScopeMenu a').bind('click',function(){$(".SearchScopeMenu a").removeClass("highlightMenu");$(this).addClass("highlightMenu");$('.SearchScopeMenu').hide();val=$('.SearchScopeMenu input')[this.id].value;$('#<%= hidScope.ClientID %>').val(val);});$(document).click(function(e){if(display!=true){$('.SearchScopeMenu').hide();$('.LoginNavigationMenu').hide();$($('.LoginMenuButton').children()[0]).attr("src","/PublishingImages/white-arrow_HPN.gif");}
display=false;});$(document).keydown(function(e){var e=(e)?e:((event)?event:null);if(e.keyCode==13){var node=(e.target)?e.target:((e.srcElement)?e.srcElement:null);if(typeof(node)!="undefined"&&node.type=="text"){return false;}}
if($(".SearchScopeMenu")[0]!=undefined)
{if($(".SearchScopeMenu")[0].style.display!="none"){if(e.keyCode==40||e.charCode==40){var scopeCount=$(".SearchScopeMenu a").length;for(i=0;i<scopeCount;i++){if($(".SearchScopeMenu a")[i].className=="highlightMenu"){if(scopeCount>i+1){$(".SearchScopeMenu a").removeClass("highlightMenu");$(".SearchScopeMenu a")[i+1].className="highlightMenu";var val1=$('.SearchScopeMenu input')[i+1].value;$('#<%= hidScope.ClientID %>').val(val1);break;}}}
e.preventDefault();return false}
else if(e.keyCode==38||e.charCode==38){var scopeCount=$(".SearchScopeMenu a").length;for(i=0;i<scopeCount;i++){if($(".SearchScopeMenu a")[i].className=="highlightMenu"){if(i>0){$(".SearchScopeMenu a").removeClass("highlightMenu");$(".SearchScopeMenu a")[i-1].className="highlightMenu";var val2=$('.SearchScopeMenu input')[i-1].value;$('#<%= hidScope.ClientID %>').val(val2);break;}}}
e.preventDefault();return false}}}});SetBannerSearchProp();});function ToggleScopeMenu(ScopeDiv){display=true;if(document.getElementById(ScopeDiv).style.display==""){document.getElementById(ScopeDiv).style.display="none";}
else{document.getElementById(ScopeDiv).style.display="";}
return false;}
function SetBannerSearchProp(){if(/Windows NT 6/.test(navigator.userAgent)&&($.browser.mozilla)){$(".bannersearch .search-localize .searchbox").css("height","16px");$(".search-localize .SearchBox_BtnSearch").css("margin-left","0px");$(".communities-bannersearch .search-localize .searchbox").css("height","16px");}}
$(document).ready(function(){$('.main-contents').find('img').each(function(i){var altText=$(this).attr('alt');$(this).attr('title',altText);});});var lastXMLloaded='';var lastXSLloaded='';var xml;var xsl;function xsltTransform(xmlPath,xslPath,parameter){if(lastXMLloaded!=xmlPath){xml=loadXMLDoc(xmlPath);lastXMLloaded=xmlPath;}
if(lastXSLloaded!=xslPath){xsl=loadXSLDoc(xslPath);lastXSLloaded=xslPath;}
var param=parameter.split(";");var count=param.length;if(window.ActiveXObject){var template=new ActiveXObject("MSXML2.XSLTemplate");template.stylesheet=xsl.documentElement;var xsltProcessor=template.createProcessor();xsltProcessor.input=xml;for(i=0;i<=count-1;i++){var paramKeyValue=param[i].split(",");xsltProcessor.addParameter(paramKeyValue[0],paramKeyValue[1]);}
xsltProcessor.transform();var result=xsltProcessor.output;return result;}
else if(document.implementation&&document.implementation.createDocument){xsltProcessor=new XSLTProcessor();try{xsltProcessor.importStylesheet(xsl);}
catch(e){}
for(i=0;i<=count-1;i++){var paramKeyValue=param[i].split(",");xsltProcessor.setParameter(null,paramKeyValue[0],paramKeyValue[1]);}
var resultDocument=xsltProcessor.transformToFragment(xml,document);return resultDocument}}
function loadXSLDoc(fname){var xmlDoc;fname=window.location.protocol+"//"+window.location.host+"/"+fname;if(window.ActiveXObject){xmlDoc=new ActiveXObject("MSXML2.FreeThreadedDomDocument");}
else if(document.implementation&&document.implementation.createDocument){xmlDoc=document.implementation.createDocument("","",null);}
else{alert('Your browser cannot handle this script');}
if(xmlDoc&&typeof xmlDoc.load!='undefined'){xmlDoc.async=false;xmlDoc.load(fname);return xmlDoc;}
else{var request=new XMLHttpRequest();request.open("GET",fname,false);request.send("");return request.responseXML;}}
var xmlhttp;function loadXMLDoc(url){xmlhttp=null;if(window.XMLHttpRequest){xmlhttp=new XMLHttpRequest();}
else if(window.ActiveXObject){xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
if(xmlhttp!=null){xmlhttp.open("GET",url,false);xmlhttp.send("");return xmlhttp.responseXML;}}
$(document).ready(function(){$('.outlook.primary-nav .img-over').hide();$(".outlook.primary-nav .menu").mouseover(function(){$(this).find('.img-out').hide();$(this).find('.img-over').show();if($(this).find('.drop-down .dropdown-item').html()){$(this).find('.drop-down').show();}else{$(this).find('.drop-down').hide();}});$(".outlook.primary-nav .menu").mouseout(function(){$(this).find('.img-over').hide();$(this).find('.img-out').show();$(this).find('.drop-down').hide();});$('.outlook.primary-nav .drop-down').hide();});var __primaryNavTimer;var __prevDropDownMenu;var __timer;var __timeConstant=150;var __selectedNavNodeOnLoad;var __hasOpenMenuDropdown=false;var __selectedNavNodeParentId;$(document).ready(function(){__selectedNavNodeOnLoad=$(".primary-nav a[currentNode='Yes']");__selectedNavNodeParentId=__selectedNavNodeOnLoad.parent().attr('id');SelectOnLoadNavNode();$('.drop-down').hide();$(".nav-wrapper .primary-nav .menu").mouseenter(function(){var parentControl=this;clearTimeout(__primaryNavTimer);if(!__timer){__timer=setTimeout(function(){OpenDropDownMenu(parentControl);},__timeConstant);}
if($(this).attr('id')!=__selectedNavNodeParentId){DeselectOnLoadNavNode();}});$(".nav-wrapper .primary-nav").mouseleave(function(){setTimeout(function(){SelectOnLoadNavNode();},__timeConstant);});$(".nav-wrapper .primary-nav .menu").mouseleave(function(){__prevDropDownMenu=this;SetDropDownTimeOut(this);});$(".nav-wrapper .user-status").mouseenter(function(event){clearTimeout(__primaryNavTimer);if(event.relatedTarget!=null){if(event.relatedTarget.className=="img-over"||event.relatedTarget.className=="spacer"){var prevloc="li[id="+event.relatedTarget.parentNode.parentNode.id+"]."+event.relatedTarget.parentNode.parentNode.className;$(prevloc).find('.img-out').hide();$(prevloc).find('.img-over').show();$(prevloc).find('.drop-down').show();}}});});function SetDropDownTimeOut(parentControl){__primaryNavTimer="";__primaryNavTimer=setTimeout(function(){CloseDropDownMenu(parentControl);},__timeConstant);$('.drop-down').mouseenter(function(){clearTimeout(__primaryNavTimer);}).mouseout(function(){clearTimeout(__primaryNavTimer);});clearTimeout(__timer);__timer=undefined;}
function OpenDropDownMenu(parentControl){if(parentControl!=undefined){if(__prevDropDownMenu!=undefined){CloseDropDownMenu(__prevDropDownMenu);}
$(parentControl).find('.img-out').hide();$(parentControl).find('.img-over').show();if(/msie|MSIE 6/.test(navigator.userAgent)){try{$("#sortSelect").css('visibility','hidden');}
catch(e){}}
if(!(($(parentControl).find('.drop-down .sub-wrapper .description').html()==""||$(parentControl).find('.drop-down .sub-wrapper .description').html()==null)&&($(parentControl).find('.drop-down .sub-wrapper ul li').length==0))){if($(parentControl).find('.drop-down').attr('visible').toLowerCase()=='true'){$(parentControl).find('.drop-down').show();}}
__hasOpenMenuDropdown=true;}}
function CloseDropDownMenu(parentControl){$(".primary-nav .menu").find('.img-over').hide();$(".primary-nav .menu").find('.img-out').show();$(".primary-nav .menu").find('.drop-down').hide();if(/msie|MSIE 6/.test(navigator.userAgent)){try{$("#sortSelect").css('visibility','visible');}
catch(e){}}
__timer=undefined;__hasOpenMenuDropdown=false;}
function SelectOnLoadNavNode(){if(!__hasOpenMenuDropdown){__selectedNavNodeOnLoad.find('.img-over').show();__selectedNavNodeOnLoad.find('.img-out').hide();}}
function DeselectOnLoadNavNode(){__selectedNavNodeOnLoad.find('.img-over').hide();__selectedNavNodeOnLoad.find('.img-out').show();}
$(document).ready(function(){$("#PA_Click").click(function(){ToggleLists();});});function ToggleLists(){try{var changeID=document.getElementById("PA_Click");if($(".pa-display-panel").is(":hidden")){SetPopularArticlesActiveTab();$(".display-pa").show();$(".pa-display-panel").show();changeID.className="pa-click-button";if((typeof TrackProductsImpression)=="function"){if(($('#mvTabBody').is(':visible'))&&($('#msTabBody').is(':hidden'))){TrackProductsImpression(RetrieveProductsImpression($('div#mvTabBody').get()));}else{TrackProductsImpression(RetrieveProductsImpression($('div#msTabBody').get()));}}}else{$(".pa-display-panel").hide();$(".display-pa").hide();changeID.className="pa-click-expand";}}catch(e){}}
function TabClick(tabIdx){try{$("#_currentTabIndex").val(tabIdx);var _token,_id;$.each(['mv','ms'],function(n,value){_token=value+"Tab";_id="#"+_token+"Body"
if(value!=tabIdx){if(!$(_id).is(":hidden")){$(_id).hide();$(_id+" .pa-link").hide();$("#"+_token).css("font-weight","normal");}}else{$(_id).show();$(_id+" .pa-link").show();$("#"+_token).css("font-weight","bold");if((typeof TrackProductsImpression)=="function"){if(value=='mv'){TrackProductsImpression(RetrieveProductsImpression($('div#mvTabBody').get()));}
else{TrackProductsImpression(RetrieveProductsImpression($('div#msTabBody').get()));}}}});}catch(e){}}
function SetPopularArticlesActiveTab(){var _activeTab=$("#_currentTabIndex").val();if(!_activeTab){_activeTab="mv";}
TabClick(_activeTab);}
$(document).ready(function(){RVA_Animation();});function RVA_Animation(){$("#RVA_Click").click(function(){if($(".display-rva").is(":hidden")){$('.display-rva').slideDown("fast");$('.recent-section .recentlink').css('display','block');$('.recent-section').css('padding-bottom','16px');$('.containerBottomRightWPZ .recent-section').css('padding-bottom','26px');var changeID;changeID=document.getElementById("RVA_Click");changeID.className="rva-click-expand";}else{$('.display-rva').slideUp("fast");$('.recent-section .recentlink').css('display','none');$('.recent-section').removeAttr('style');var changeID;changeID=document.getElementById("RVA_Click");changeID.className="rva-click-button";}});}
$(document).ready(function(){AttachEventHandlersForRelatedTags();});function AttachEventHandlersForRelatedTags(){$("a[name='modal']").hover(function(e){e.preventDefault();var maskHeight=$(document).height();var maskWidth=$(window).width();var id=$(this).attr("href");var leftpos=$(this).offset().left;if($.browser.version==7.0){var anchorWidth=$(this).width();var anchorHeight=$(this).height();var marginLeft=anchorWidth;id=id.replace(window.location.href,"");}
CloseRTWindow();$(id).css({'left':leftpos});$(id).show();if($(id+" > .rtuc-details > #divViewThePageFor:first").html()!=""){if($.browser.version==7.0)
$(id).css({'margin-top':"-57px"});else
$(id).css({'margin-top':"-72px"});}
if($.browser.version==7.0){$(id).css({'width':"0"});var windowWidth;if(parseInt($(id+" > .rtuc-details > #divViewThePageFor:first").width())>parseInt($(id+" > .rtuc-details > #divSearchFor:first").width()))
windowWidth=CalculateTextWidth($(id+" > .rtuc-details > #divViewThePageFor:first"));else
windowWidth=CalculateTextWidth($(id+" > .rtuc-details > #divSearchFor:first"));$(id).css({'width':windowWidth});$(id).css({'margin-top':"-"+$(id).height()});}});$(document.body).click(function(){CloseRTWindow();});$('.rtuc-window').bind("mouseleave",function(){CloseRTWindow();});$("a[name='close']").click(function(e){e.preventDefault();CloseRTWindow();});$("#divViewThePageFor a[href='']").parent().html("");}
function CloseRTWindow(){$('.rtuc-window').hide();}
function CalculateTextWidth(el){var _width=0;var div=document.createElement('div');document.body.appendChild(div);$(div).css({position:'absolute',left:-1000,top:-1000,display:'none'});$(div).html($(el).text());var styles=['font-size','font-style','font-weight','font-family','line-height','text-transform','letter-spacing'];$(styles).each(function(){var s=this.toString();$(div).css({s:$(el).css(s)});});_width=$(div).outerWidth();$(div).remove();return _width;}
$(document).ready(function(){$('.now-hiring-title:empty').parent().parent().hide();$('.now-hiring-view:empty').parent().parent().hide();$('.now-hiring:hidden').parent().removeClass('box-in');$('.now-hiring:hidden').parent().html('');});$(document).ready(function(){if(($.trim($('.subscriptions-link').text())=="")&&($.trim($('.recommended-jobs-link').text())=="")&&($.trim($('.interests-link').text())=="")){$('.cta-offerings-intro-text').hide();}
else{$('.cta-offerings-intro-text').filter(':empty').hide();}
$('.profile-cta-header, .profile-cta-text, .job-center-header, .job-center-intro, .job-center-link, .job-center-links, .newsletter-header, .newsletter-link, .interests-link, .recommended-jobs-link, .subcription-link, .cta-offerings-intro-text').each(function(){var value=$(this).text();if($(this).html()==null||$(this).html()=="&nbsp;"){$(this).hide();}
else{if($.trim($(this).text())==""){$(this).hide();}
else{$(this).filter(':empty').hide();}}});});function getByClass(matchClass,tag){var elems=document.getElementsByTagName(tag);var result;for(var i in elems){if((" "+elems[i].className+" ").indexOf(" "+matchClass+" ")>-1){result=elems[i];break;}}
return result;};function getCookie(key){var keyValue=document.cookie.match('(^|;) ?'+key+'=([^;]*)(;|$)');return keyValue?keyValue[2]:null;}
$(document).ready(function(){var cookieVal;var acnComCookieValues;var HasLoginID;var recognizedIntroText;var loginLink;var strLoginLink;var splittedLoginLink;var newURL;var newRecognizedIntroText;var myRegex='href\s*=\s*.*article-recommendations.aspx';cookieVal=getCookie("_ACCENTURE_COM_");HasLoginID=0;if((typeof(ZoneType)!='undefined')&&(cookieVal!=null)){acnComCookieValues=cookieVal.split('&');var authIntroText=getByClass('AuthenticatedIntroTextCss','div');var recoIntroText=getByClass('RecognizedIntroTextCss','div');if(authIntroText!=null&&recoIntroText!=null){for(ctr=0;ctr<acnComCookieValues.length;ctr++){var acnComCookieValue=acnComCookieValues[ctr].split('=');if(acnComCookieValue[0]=='LAST_LOGIN_ID'){HasLoginID=1;if(acnComCookieValue[1]!=""){if(ZoneType=='ADFS'){authIntroText.style.visibility="visible";authIntroText.style.display="block";recoIntroText.style.visibility="hidden";recoIntroText.style.display="none";}
else if(ZoneType=='Anon'){authIntroText.style.visibility="hidden";authIntroText.style.display="none";recoIntroText.style.visibility="visible";recoIntroText.style.display="block";recognizedIntroText=$('.RecognizedIntroTextCss').html();loginLink=recognizedIntroText.match(myRegex);strLoginLink=String(loginLink);splittedLoginLink=strLoginLink.split('"');if(splittedLoginLink[1]!=null||splittedLoginLink[1]!=undefined){if(splittedLoginLink[1].indexOf('article-recommendations.aspx')){newURL='href="https://'+String(document.domain)+splittedLoginLink[1]
newRecognizedIntroText=recognizedIntroText.replace(strLoginLink,newURL);$('.RecognizedIntroTextCss').html(newRecognizedIntroText);}}}
else if(ZoneType=='Edit'){authIntroText.style.visibility="visible";authIntroText.style.display="block";recoIntroText.style.visibility="visible";recoIntroText.style.display="block";}}
break;}}
if(HasLoginID==0){if(ZoneType=='Anon'){authIntroText.style.visibility="visible";authIntroText.style.display="block";recoIntroText.style.visibility="hidden";recoIntroText.style.display="none";}
if(ZoneType=='Edit'){authIntroText.style.visibility="visible";authIntroText.style.display="block";recoIntroText.style.visibility="visible";recoIntroText.style.display="block";}}}}});