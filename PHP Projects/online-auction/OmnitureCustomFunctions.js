
var ItemType=[];var filename=[];var isIE;var TouchedCookie=false;var LastFieldUsed="";var FormStart=false;var isPostBack=false;var ExitActionAbandon=true;var ProductsRecorded=false;var hasProductsFromCookie=false;if(typeof(sentFeaturedArticlesInList)=="undefined"){var sentFeaturedArticlesInList="";}
var triggerWriteLinkAnalysisCookie=true;var beltMoved=false;var beltPositionContainer;var productsPageView=false;var conversionPageView=false;var areTrafficVariablesSaved=false;var savedTrafficVariables=false;var c3="";var c8="";var c12="";var c13="";var c14="";var c17="";var c27="";var c28="";var c29="";var c45="";var LINK_ANALYIS_VARIABLE_CHARACTER_LIMIT=50;var linkTypeValues="bookmarking,filtering,now hiring,popular articles,related content,related tags,share,twitter,products";var employeeLoginLink="";function CleanUpLtVars(){var i;var varsToClean=["prop35","prop21","prop22","prop23","prop24","events","products","eVar21","eVar8","eVar12","linkTrackVars","linkTrackEvents","eVar15","eVar9","eVar12","eVar45","eVar3","eVar8","eVar12","eVar34","eVar27","eVar28","eVar29","eVar5","eVar9","eVar23"];for(i=0;i<varsToClean.length;i++){window.s[varsToClean[i]]="";}}
function LowerCaseVars(){var i;var varsToClean=["prop35","prop21","prop22","prop23","prop24",,"prop31","events","products","eVar21","eVar8","eVar12","eVar15","eVar9","eVar12","eVar45","eVar3","eVar8","eVar12","eVar34","eVar27","eVar28","eVar29","eVar5","eVar23"];for(i=0;i<varsToClean.length;i++){if(typeof(window.s[varsToClean[i]])!="undefined"){window.s[varsToClean[i]]=window.s[varsToClean[i]].toLowerCase();}}}
function getElementsByClass(searchClass,domNode,tagName){if(domNode===null){domNode=document;}
if(tagName===null){tagName='*';}
var el=[];var tags=domNode.getElementsByTagName(tagName);var tcl=" "+searchClass+" ";var i,j;for(i=0,j=0;i<tags.length;i++){var test=" "+tags[i].className+" ";if(test.indexOf(tcl)!=-1){el[j++]=tags[i];}}
return el;}
function isInternal(href){var internal=false;var links=[];var i;if(href==""){internal=false;}
else if(href.indexOf("javascript:")==0){internal=true;}
else if(href.indexOf("/")===0){internal=true;}else if(href.match(/^(?:[^\/]+:\/\/)?([^\/:]+)/)[1]==window.location.hostname){internal=true;}
else if(href.indexOf("http://feeds.accenture.com")!=-1){internal=false;}else{links=window.s.linkInternalFilters.split(',');for(i=0;i<links.length;i++){if(href.match(/^(?:[^\/]+:\/\/)?([^\/:]+)/)[1].indexOf(links[i])!=-1){internal=true;break;}}}
return internal;}
function GetServerName(){var url=location.href;var domain=url.match(/http(s)?\:\/\/[^\/]+/);if(domain!=null){return domain[0];}else{return"invalid-URI";}}
function extractURIpath(url){var path=url.match(/[^\:\/\/]\/(.*)/);if(path!=null){if(path.length>1&&path[1]!=""){return path[1].toLowerCase();}else{return"home"}}else{return"home";}}
function getSubDomain(url){var subdomain=url.match(/\/\/(\w+)/);if(subdomain!=null){if(subdomain.length>1&&subdomain[1]!=""){return subdomain[1];}else{return"";}}else{return"";}}
function GetPageName(shortenURL,domainPrefix,contentHier){var path;var url=location.href;var pagename=domainPrefix;if(contentHier!=""){pagename=pagename+":"+contentHier;}
path=extractURIpath(url).replace(/\//g,":");pagename=pagename+":"+path;return pagename.toLowerCase();}
function SetPageConversionVariable(type){SaveTrafficVariables();if(type=="media"){window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"eVar8",",",1);window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"eVar9",",",1);window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"eVar12",",",1);window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"eVar27",",",1);window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"eVar28",",",1);window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"eVar45",",",1);}
else if(type=="products"){window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"products",",",1);window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"eVar21",",",1);window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"eVar8",",",1);window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"eVar12",",",1);window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"eVar27",",",1);window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"eVar28",",",1);window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"eVar45",",",1);}
else{window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"eVar9",",",1);window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"eVar8",",",1);window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"eVar12",",",1);window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"eVar27",",",1);window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"eVar28",",",1);window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"eVar45",",",1);}
window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"prop26",",",1);window.s.eVar8=window.c8;window.s.eVar12=window.c3;window.s.eVar27=window.c27;window.s.eVar28=window.c28;window.s.eVar45=window.c45;window.s.prop26=window.c26;if(type!="products"){window.s.eVar9=window.s.pageName;}
window.conversionPageView=true;ClearTrafficVariables();}
function SaveTrafficVariables(){if(!window.areTrafficVariablesSaved){window.c3=window.s.prop3;window.c8=window.s.prop8;window.c12=window.s.prop12;window.c13=window.s.prop13;window.c14=window.s.prop14;window.c17=window.s.prop17;window.c26=window.s.prop26;window.c27=window.s.prop27;window.c28=window.s.prop28;window.c29=window.s.prop29;window.c45=window.s.prop45;ClearTrafficVariables();window.areTrafficVariablesSaved=true;}}
function ClearConversionVariable(){window.s.eVar8="";window.s.eVar9="";window.s.eVar12="";window.s.eVar27="";window.s.eVar28="";window.s.eVar45="";}
function ClearTrafficVariables(){window.s.prop3="";window.s.prop8="";window.s.prop12="";window.s.prop13="";window.s.prop14="";window.s.prop17="";window.s.prop27="";window.s.prop28="";window.s.prop29="";window.s.prop45="";}
function AssignTrafficVariable(){window.c3=window.c3?window.c3:window.s.prop3;window.c8=window.c8?window.c8:window.s.prop8;window.c12=window.c12?window.c12:window.s.prop12;window.c13=window.c13?window.c13:window.s.prop13;window.c14=window.c14?window.c14:window.s.prop14;window.c17=window.c17?window.c17:window.s.prop17;window.c26=window.c26?window.c26:window.s.prop26;window.c27=window.c27?window.c27:window.s.prop27;window.c28=window.c28?window.c28:window.s.prop28;window.c29=window.c29?window.c29:window.s.prop29;window.c45=window.c45?window.c45:window.s.prop45;ClearTrafficVariables();}
function ReassignTrafficVariable(){window.s.prop3=window.c3;window.s.prop8=window.c8;window.s.prop12=window.c12;window.s.prop13=window.c13;window.s.prop14=window.c14;window.s.prop17=window.c17;window.s.prop26=window.c26;window.s.prop27=window.c27;window.s.prop28=window.c28;window.s.prop29=window.c29;window.s.prop45=window.c45;}
function ReturnRadioGUID(){if($("input[value=JobSearch]").eq(0).attr("name")!==""){return $("input[value=JobSearch]").eq(0).attr("name");}else{return"not found";}}
function ReturnSubmitSelectorGUID(selectorName){var selectorGUID;var divs=getElementsByClass(selectorName,document,"div");if(divs.length>0){if((selectorGUID=divs[0].children[1].id)){if(typeof(selectorGUID)!="undefined"){return selectorGUID;}}}
return"not found";}
function ReturnSelectorGUID(selectorName){var selectorGUID;var divs=getElementsByClass(selectorName,document,"div");if(divs.length>0){if((selectorGUID=divs[0].children[0].id)){if(typeof(selectorGUID)!="undefined"){return selectorGUID;}}}
return"not found";}
function GetQueryString(url,param){var p=escape(unescape(param));var regex=new RegExp("[?&]"+p+"(?:=([^&]*))?","i");var match=regex.exec(url);var value="";if(match!=null){value=match[1];}
return value;}
function GetIntentBasedNavRadio(){var rad=$("input[id*='radRedirectScopeOptions']:checked").next("label").text().toLowerCase().replace(/ /g,"");var skill=$('select[name*="ddlSkill"] option:selected').text();var location=$('select[name*="ddlLocation"] option:selected').text();var cl=window.s.prop8?window.s.prop8:window.c8;window.s.prop21=window.s.pageName;window.s.prop21=InsertCLvalue(cl,window.s.prop21);window.s.prop22=rad+":"+location+":"+skill;window.s.prop23=window.s.prop21+"|"+window.s.prop22;window.s.prop24="other";window.s.products="";LowerCaseVars();WriteLinkAnalysisCookie();}
function GetInfoFromSearchTxtBox(){var cl=window.s.prop8?window.s.prop8:window.c8;var txtJobSearchBoxVal=$('.TxtJobSearchBox').val();var txtJobSearchBox=txtJobSearchBoxVal.replace("'","");if(txtJobSearchBox!=defaultKeyword){txtJobSearchBox=txtJobSearchBoxVal;}
if(txtJobSearchBox==defaultKeyword||txtJobSearchBox==""){txtJobSearchBox="default";}
window.s.prop21=window.s.pageName;window.s.prop21=InsertCLvalue(cl,window.s.prop21);window.s.prop22=txtJobSearchBox;window.s.prop22=window.s.prop22.toLowerCase();window.s.prop23=window.s.prop21+"|"+window.s.prop22;window.s.prop23=window.s.prop23.toLowerCase();window.s.prop35=window.s.prop22;window.s.products="";LowerCaseVars();WriteLinkAnalysisCookie();}
function setIntentCapture(){$("a[class='find-button']").click(function(event){GetIntentBasedNavRadio();});}
function isFindButtonClicked(){$("a[class='find-button']").click(function(event){var showMeWebPartID=$.trim($('#showMe').html());if(showMeWebPartID==""||showMeWebPartID==null)
GetInfoFromSearchTxtBox();});}
function isPageTabClicked(){$(".tab-box").click(function(event){if($(this).length&&!($(this).hasClass('active-tab'))){window.s.linkTrackVars='events,prop17';SetPageConversionVariable();window.s.prop17=$(this).text().toLowerCase();LowerCaseVars();window.s.tl(this,'o','tabbing');}});$(".tab-link").click(function(event){if($(this).length&&!($(this).hasClass('active-tab'))){window.s.linkTrackVars='events,prop17';SetPageConversionVariable();window.s.prop17=$(this).text().toLowerCase();LowerCaseVars();window.s.tl(this,'o','tabbing');}});}
function InsertCLvalue(clValue,pageName){if(pageName.indexOf("http")==-1){return pageName.split(":")[0]+":"+clValue+":"+pageName.substr(pageName.indexOf(":")+1,pageName.length);}
else{return pageName;}}
function setVariablesForProduct(productString,typeAction,mediaType){SetPageConversionVariable("products");window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"events",",",1);window.s.linkTrackEvents=window.s.events;window.s.eVar21=window.s.pageName;window.s.products=productString.toLowerCase();window.s.events="";setProductsEvents(productString,typeAction);if(typeAction!="impression"){WriteLinkAnalysisCookie();}}
function setVariablesForProductMedia(productString,typeAction,mediaType){window.s.Media.products=productString;window.s.Media.eVar21=window.s.Media.pageName;window.s.Media.eVar8=window.s.Media.prop8;window.s.Media.eVar12=window.s.Media.prop3;window.s.Media.linkTrackVars=window.s.apl(window.s.Media.linkTrackVars,"products",",",1);window.s.Media.linkTrackVars=window.s.apl(window.s.Media.linkTrackVars,"events",",",1);window.s.Media.linkTrackVars=window.s.apl(window.s.Media.linkTrackVars,"prop9",",",1);window.s.Media.linkTrackVars=window.s.apl(window.s.Media.linkTrackVars,"eVar21",",",1);window.s.Media.linkTrackVars=window.s.apl(window.s.Media.linkTrackVars,"eVar8",",",1);window.s.Media.linkTrackVars=window.s.apl(window.s.Media.linkTrackVars,"eVar12",",",1);window.s.Media.linkTrackVars=window.s.apl(window.s.Media.linkTrackVars,"prop26",",",1);setProductsEventsForMedia(productString,typeAction);window.s.Media.linkTrackEvents=window.s.Media.events;}
function setProductsEvents(productString,typeAction){if(typeAction=="impression"){if(productString.indexOf("event10")>-1){window.s.events=window.s.apl(window.s.events,"event10",",",1);}
if(productString.indexOf("event12")>-1){window.s.events=window.s.apl(window.s.events,"event12",",",1);}}else{if(productString.indexOf("event15")>-1){window.s.events=window.s.apl(window.s.events,"event15",",",1);}
if(productString.indexOf("event14")>-1){window.s.events=window.s.apl(window.s.events,"event14",",",1);}}}
function setProductsEventsForMedia(productString,typeAction){if(typeAction=="impression"){if(productString.indexOf("event10")>-1){window.s.Media.events=window.s.apl(window.s.Media.events,"event10",",",1);}
if(productString.indexOf("event12")>-1){window.s.Media.events=window.s.apl(window.s.Media.events,"event12",",",1);}}else{if(productString.indexOf("event15")>-1){window.s.Media.events=window.s.apl(window.s.Media.events,"event15",",",1);}
if(productString.indexOf("event14")>-1){window.s.Media.events=window.s.apl(window.s.Media.events,"event14",",",1);}}}
function isHomePage(){if($("div.belt").length>0){return true;}else{return false;}}
function RetrieveProductsImpression(element,additionalParameters){var productsString="";var foundProducts=false;var foundFeaturedProducts=false;var countFeaturedProducts=0;var prodCount=0;var prodLimit=40;var isTransformedAsFeatured=false;if(typeof(additionalParameters)!="undefined"){isTransformedAsFeatured=(additionalParameters=="TransformedAsFeatured")?true:false;}
if(window.navigator.appName.toLowerCase().indexOf("microsoft")>-1){prodLimit=14;}
if(!isHomePage()){$(element).find('a[rel=products_featured]').each(function(){if($(this).attr('name')!="undefined"&&$(this).attr('name')!=""&&$(this).attr('href')!="undefined"&&$(this).attr('href')){if(!isTransformedAsFeatured&&productsString.indexOf($(this).attr('name'))==-1&&prodCount<prodLimit){productsString=productsString+';'+$(this).attr('name')+';;;'+'event10=1'+',';prodCount=prodCount+1;foundProducts=true;}
if(sentFeaturedArticlesInList.indexOf($(this).attr('name'))==-1&&productsString.indexOf($(this).attr('name')+';;;'+'event12=1'+',')==-1&&prodCount<prodLimit){productsString=productsString+';'+$(this).attr('name')+';;;'+'event12=1'+',';prodCount=prodCount+1;foundFeaturedProducts=true;countFeaturedProducts=countFeaturedProducts+1;if((countFeaturedProducts%2)!=0){if(prodLimit==14){prodLimit=15;}else{prodLimit=41;}}
sentFeaturedArticlesInList=sentFeaturedArticlesInList+":"+$(this).attr('name');}}});}
else if(isHomePage()){$(element).find('a[rel=products_featured]').each(function(){if(!$(this).is(":hidden")){if($(this).attr('name')!="undefined"&&$(this).attr('name')!=""&&$(this).attr('href')!="undefined"&&$(this).attr('href')){if(productsString.indexOf($(this).attr('name'))==-1&&prodCount<prodLimit){productsString=productsString+';'+$(this).attr('name')+';;;'+'event10=1'+',';prodCount=prodCount+1;foundProducts=true;}}
if(productsString.indexOf($(this).attr('name')+';;;'+'event12=1'+',')==-1&&prodCount<prodLimit){productsString=productsString+';'+$(this).attr('name')+';;;'+'event12=1'+',';prodCount=prodCount+1;foundFeaturedProducts=true;countFeaturedProducts=countFeaturedProducts+1;if((countFeaturedProducts%2)!=0){if(prodLimit==14){prodLimit=15;}else{prodLimit=41;}}}}});$(element).find("div.featured-section-media > object > param[name=name][value!=]").each(function(){if($(this).attr('value')!="undefined"&&$(this).attr('value')!=""){if(productsString.indexOf($(this).attr('value'))==-1&&prodCount<prodLimit){productsString=productsString+';'+$(this).attr('name')+';;;'+'event10=1'+',';prodCount=prodCount+1;foundProducts=true;}}});}
if($(".pa-display-panel").is(":hidden")||$(".pa-display-panel").length==0){$(element).find('a[rel=products], a[rel=products_list], a[rel=related content]').each(function(){if($(this).attr('name')!="undefined"&&$(this).attr('name')!=""&&$(this).attr('href')!="undefined"&&$(this).attr('href')){if(productsString.indexOf($(this).attr('name'))==-1&&prodCount<prodLimit){productsString=productsString+';'+$(this).attr('name')+';;;'+'event10=1'+',';prodCount=prodCount+1;foundProducts=true;}}});}
else if(!$(".pa-display-panel").is(":hidden")){$(element).find('a[rel=products], a[rel=products_list], a[rel=related content],a[rel=popular articles]').each(function(){if($(this).attr('name')!="undefined"&&$(this).attr('name')!=""&&$(this).attr('href')!="undefined"&&$(this).attr('href')){if(productsString.indexOf($(this).attr('name'))==-1&&prodCount<prodLimit){productsString=productsString+';'+$(this).attr('name')+';;;'+'event10=1'+',';prodCount=prodCount+1;foundProducts=true;}}});}
else{$(element).find('a[rel=popular articles]').each(function(){if($(this).attr('name')!="undefined"&&$(this).attr('name')!=""&&$(this).attr('href')!="undefined"&&$(this).attr('href')){if(productsString.indexOf($(this).attr('name'))==-1&&prodCount<prodLimit){productsString=productsString+';'+$(this).attr('name')+';;;'+'event10=1'+',';prodCount=prodCount+1;foundProducts=true;}}});}
if(foundProducts){window.s.events=window.s.apl(window.s.events,"event10",",",1);window.s.eVar21=window.s.pageName;window.productsPageView=true;}
if(foundFeaturedProducts){window.s.events=window.s.apl(window.s.events,"event12",",",1);window.s.eVar21=window.s.pageName;window.productsPageView=true;}
return productsString;}
function TrackProductsImpression(prodString){if(prodString!=""){setVariablesForProduct(prodString,"impression");LowerCaseVars();window.s.prop21="";window.s.prop22="";window.s.prop23="";window.s.prop24="";window.s.tl(this,'o','impression');CleanUpLtVars();}}
function SendHomePageAfterFullRotation(){try{var prodString='';var impression="";var beltPosition=0;$('div.belt > div.panel').slice((0+beltPosition),(3+beltPosition)).each(function(){impression=RetrieveProductsImpression(this);if(impression!==""){prodString=prodString+impression;}});window.s.products=prodString.toLowerCase();TrackProductsImpression(window.s.products);}catch(err){}}
function SendHomePageChanged(direction){var impression,beltLocation;beltPositionContainer=parseInt(window.stepcarousel.configholder.mygallery.currentpanel,10);beltLocation=beltPositionContainer-1;beltMoved=true;switch(direction){case"back":if($("img[src*=Reverse_Button.png]").eq(0).css("opacity")=="1"){impression=beltLocation-1;if(impression<0){impression=0;}}else{return false;}
break;case"forward":if($("img[src*=Forward_Button.png]").eq(0).css("opacity")=="1"){impression=beltLocation+3;}else if(beltLocation<0){SendHomePageAfterFullRotation();}else{return false;}
break;}
if(((impression)>=0)&&((impression+1)<=($('div.belt > div.panel').length))){TrackProductsImpression(RetrieveProductsImpression($('div.belt > div.panel').get(impression)));}}
function SendHomePageInital(){try{var prodString='';var impression="";var beltPosition;if(typeof(beltPosition)=="undefined"){beltPosition=parseInt(window.s.c_r("mygallerypersist"),10);if(beltPosition){}else{beltPosition=0;}}
if(beltPosition>=0&&beltPosition+3<=$('div.belt > div.panel').length){$('div.belt > div.panel').slice((0+beltPosition),(3+beltPosition)).each(function(){impression=RetrieveProductsImpression(this);if(impression!==""){prodString=prodString+impression;}});window.s.products=prodString.toLowerCase();}}catch(err){}}
function TrackHomePageStepcarousel(){SendHomePageInital();}
function TrackHomePageStepcarouselChanage(direction){SendHomePageChanged(direction);}
function SendGridViewProduct(){if($("div#allArticlesGridView").css("display")!="none"){TrackProductsImpression(RetrieveProductsImpression($('div#allArticlesGridView').get()));}}
function SendListViewProducts(){TrackProductsImpression(RetrieveProductsImpression($('div#allArticlesListView').get()));}
function SendPersonalizedFeaturedImpression(){TrackProductsImpression(RetrieveProductsImpression($('div#segmented-content').get()));}
function SendSingleViewWebPartFeaturedProducts(){triggerWriteLinkAnalysisCookie=false;TrackProductsImpression(RetrieveProductsImpression($('a[rel=products_featured]').get(),"TransformedAsFeatured"));}
function SendSingleViewWebPartProducts(){TrackProductsImpression(RetrieveProductsImpression($('div#allArticlesSingleViewArticleList').get()));}
function SendGenericProductImpressions(){if(!window.isHomePage()&&hasProductsFromCookie==true){TrackProductsImpression((RetrieveProductsImpression(document.body)).toLowerCase());}}
function isProductLink(jObject){var obj=$(jObject);if(obj.attr('rel')&&(obj.attr('rel').indexOf("products")==0||obj.attr('rel').indexOf("popular")==0||obj.attr('rel').indexOf("related")==0)&&obj.attr('href')!=document.location.href&&obj.attr('name')){return true;}else{return false;}}
function setVideoVarsEvents(fname,percent){var audio="aac,aif,iff,mp3,mpa,ra,wav,wma,mid,midi,snd,";window.s.events="";var ext=fname.match(/[\w]*?(?=\?)|[\w]*$/)[0];var productId;if(ext!=="swf"&&ext!=="aspx"&&ext!==""){if(audio.match(RegExp(ext+",",""))){if(percent<25){window.s.linkTrackVars="events,eVar17";window.s.linkTrackEvents=window.s.events;window.s.Media.trackEvents=window.s.apl(window.s.Media.trackEvents,"event7",",",1);window.s.events="event7";window.s.eVar17=fname;SetPageConversionVariable("media");}
else{s.Media.trackVars="";window.s.events="";window.s.eVar17="";ClearConversionVariable();}}else{if(percent<25){window.s.linkTrackVars="events,eVar16";window.s.linkTrackEvents=window.s.events;window.s.Media.trackEvents=window.s.apl(window.s.Media.trackEvents,"event6",",",1);window.s.events="event6";window.s.eVar16=fname;SetPageConversionVariable("media");}
else{s.Media.trackVars="";window.s.events="";window.s.eVar16="";ClearConversionVariable();}}}}
function setOmnitureVideoVars(fname,percent){try{setVideoVarsEvents(fname,percent);}catch(err){}}
function clearVideoVarsEvents(){window.s.eVar16="";window.s.eVar17="";window.s.events="";window.s.eVar3="";window.s.eVar8="";window.s.eVar12="";window.s.eVar9="";}
function MediaTrackingContainer(player,action,filename){try{setOmnitureVideoVars(player);switch(action)
{case 1:window.s.Media.stop(filename[player],document.getElementsByTagName(ItemType[player])[player].controlwindow.s.currentPosition);break;case 2:window.s.Media.stop(filename[player],document.getElementsByTagName(ItemType[player])[player].controlwindow.s.currentPosition);break;case 3:window.s.Media.open(filename[player],document.getElementsByTagName(ItemType[player])[player].currentMedia.duration,"Media Player Non IE");window.s.Media.play(filename[player],document.getElementsByTagName(ItemType[player])[player].currentMedia.duration);break;case 4:break;case 5:break;case 6:break;case 7:break;case 8:window.s.Media.close(filename[player]);break;case 9:break;case 10:break;}}catch(err){}}
function GetPlayState(object){try{MediaTrackingContainer(object,document.getElementsByTagName(ItemType[object])[object].playState);}catch(err){}}
function TrackVideoOmniture(){try{var TagName;var i;if(navigator.appName=="Microsoft Internet Explorer"){isIE=true;TagName="object";}else{isIE=false;TagName="embed";}
for(i=0;i<document.getElementsByTagName(TagName).length;i++){if(isIE){filename[i]=document.getElementsByTagName(TagName)[i].URL.match(/[\w_.\-]*?(?=\?)|[\w_.\-]*$/)[0];ItemType[i]=TagName;}else{filename[i]=document.getElementsByTagName(TagName)[i].src;ItemType[i]=TagName;document.getElementsByTagName(TagName)[i].addEventListener('PlayStateChange',GetPlayState(i),false);document.getElementsByTagName(TagName)[i].addEventListener('CurrentItemChange',GetPlayState(i),false);}}}catch(err){}}
function IsTrackingForm(){if($("div[class='form-main']").length>0||$("div[class='registration']").length>0||$("div[class='CareersRegistrationForm']").length>0||$("div[class='popup-page']").length>0||$("div[id='LoginForm']").length>0||$("div[class='reset-content']").length>0||$("div[class='change-content']").length>0){return true;}else{return false;}}
function TrackFormStart(){var fldName="";if(IsTrackingForm()){$(":input").focus(function(event){if($(this).parents(".form-main").length!==0||$(this).parents(".popup-page").length!==0||$(this).parents("#LoginForm").length!==0||$("div[class='reset-content']").length>0||$("div[class='change-content']").length>0){var fldName="";fldName=$(event.target).attr("rel");SendFormActionCookie("s_lf",fldName);var lastAction=GetFormActionCookies();if(lastAction=="p"){SendFormActionCookie("s_fa","s");}
else if(lastAction!="s"){window.s.c_w('s_fa',"s",0);initializeForm();window.s.linkTrackVars='events,eVar15,prop26';SetPageConversionVariable();window.s.linkTrackEvents="event3";window.s.events="event3";window.s.eVar15=GetFormData();LowerCaseVars();window.s.tl(this,'o','formstart');}
window.s.eVar15="";if($(event.target).attr("type")=="submit"||$(event.target).attr("rel")=="country"||$(event.target).attr("type")=="checkbox"){SendFormActionCookie("s_fa","p");}}});}}
function TrackFormError(){if($('.TextColorError').is(':visible')){isPostBack=true;}
if(IsTrackingForm()&&isPostBack&&GetFormActionCookies()=="p"&&GetFormErrorFields()!=""){window.s.linkTrackVars='events,eVar14,eVar15,prop26';window.s.linkTrackEvents="event8";SetPageConversionVariable();window.s.events="event8";window.s.eVar15=GetFormData();window.s.eVar14=window.s.eVar15+GetFormErrorFields();window.s.tl(this,'o','formerror');window.s.c_w('s_fa',"s",0);}
window.s.eVar14="";window.s.eVar15="";}
function TrackFormComplete(){window.s.linkTrackVars='events,eVar15,prop26';SetPageConversionVariable();window.s.linkTrackEvents="event4";window.s.events="event4"
if(GetFormData()==""){initializeForm()}
window.s.eVar15=GetFormData();window.s.c_w('s_lf','',-1);window.s.c_w('s_fa','',-1);window.s.c_w('s_fac','',-1);window.s.c_w('s_fd','',-1);LowerCaseVars();window.s.tl(this,'o','formComplete');window.s.eVar15="";}
function TrackFormAbandon(){var lastAction=GetFormActionCookies();if(IsTrackingForm()&&IsFormComplete()&&$("div[id='LoginForm']").length==0){TrackFormComplete();}
else if(IsTrackingForm()&&lastAction!=="p"&&lastAction!=="c"&&(employeeLoginLink.indexOf("EmployeeLoginLink")<0)){window.s.linkTrackVars='events,eVar14,eVar15,prop26';SetPageConversionVariable();window.s.linkTrackEvents="event34";window.s.events="event34"
if(GetFormData()==""){initializeForm()}
window.s.eVar15=GetFormData();window.s.eVar14=window.s.eVar15+":"+GetlastField();window.s.c_w('s_lf',"",-1);window.s.c_w('s_fa',"",-1);window.s.c_w('s_fd',"",-1);LowerCaseVars();window.s.tl(this,'o','formabandon');}
window.s.eVar14="";window.s.eVar15="";}
function TrackFormStartReg(){var fldName="";fldName="register";SendFormActionCookie("s_lf",fldName);var lastAction=GetFormActionCookies();if(lastAction=="p"){SendFormActionCookie("s_fa","s");}
else if(lastAction!="s"){window.s.c_w('s_fa',"s",0);initializeForm();window.s.linkTrackVars='events,eVar15,prop26';SetPageConversionVariable();window.s.linkTrackEvents="event3";window.s.events="event3";window.s.eVar15=GetFormData();LowerCaseVars();window.s.tl(this,'o','formstart');}
window.s.eVar14="";window.s.eVar15="";SendFormActionCookie("s_fa","p");}
function TrackFormErrorReg(){var errorFlds=GetFormErrorFields();if(errorFlds!=""){window.s.events="event8";window.s.linkTrackVars='events,eVar15,eVar14,prop26';window.s.linkTrackEvents='event8';SetPageConversionVariable();window.s.eVar15=GetFormData();window.s.eVar14=window.s.eVar15+errorFlds;LowerCaseVars();window.s.tl(this,'o','formerror');window.s.c_w('s_fa',"s",0);}
window.s.eVar14="";window.s.eVar15="";}
function TrackFormCompleteReg(){window.s.c_w('s_fa',"c",0);}
function TrackFormCompleteOnConfirmation(){if(IsFormComplete()){window.s.linkTrackVars='events,eVar15,prop26';window.s.linkTrackEvents="event4";window.s.events=window.s.apl(window.s.events,"event4",",",1);if(GetFormData()==""){initializeForm()}
window.s.eVar15=GetFormData();window.s.c_w('s_lf','',-1);window.s.c_w('s_fa','',-1);window.s.c_w('s_fac','',-1);window.s.c_w('s_fd','',-1);LowerCaseVars();}}
function GetFormActionCookies(){return window.s.c_r('s_fa');}
function IsFormComplete(){if(window.s.c_r('s_fac')=="c"||window.s.c_r('s_fa')=="c"||document.URL.indexOf("Registration/Pages/thank")>0){return true}
else{return false}}
function GetFormData(){return window.s.c_r('s_fd');}
function GetlastField(){var lastField=window.s.c_r('s_lf')?window.s.c_r('s_lf'):"none";return lastField;}
function GetFormErrorFields(){var fldError=":";var fldname="";$("span[rel], input[rel]").each(function(){fldName=$(this).attr('rel');if($(this).is(':visible')&&fldName!=""&&($(this).attr('class')=='redbold'||$(this).attr('class')=='TextColorError'||$(this).attr('class')=='eac-textbox'||$(this).attr('class')=='reset-validator-message-lbl'||$(this).attr('class')=='change-validator-message-lbl'||$(this).attr('class')=='message-validation-color')){if(fldError.indexOf(fldName)==-1){fldError=fldError+fldName+";";}}});$("div[class='reset-invalid-user']").each(function(){fldName=$(this).attr('rel');if(fldName!=""){if(fldError.indexOf(fldName)==-1){fldError=fldError+fldName+";";}}});$("span[class='notice']").each(function(){fldName='captcha';if(fldName!=""){if(fldError.indexOf(fldName)==-1){fldError=fldError+fldName+";";}}});fldError=fldError.substr(0,fldError.length-1);return fldError;}
String.prototype.endsWith=function(str){return(this.match(str+"$")==str)}
function SendFormActionCookie(name,action){window.s.c_w(name,action,0);}
function getEmailColleagueRefURL(aValue){var query=location.search;var aValue=""
if(query.indexOf("refer=")>=0){aValue=query.substring(query.indexOf("refer=")+6);if(aValue.endsWith("&")){aValue=aValue.replace('&','');}
aValue="http://"+document.domain+aValue;}
return aValue;}
function initializeForm(){var lastAction="";var formName=window.s.pageName;formName=InsertCLvalue(s.prop8,formName);var referrer=document.referrer;if(formName=="acn:emailacolleague"||formName=="car:emailacolleague"){referrer=getEmailColleagueRefURL();}
else if(typeof prev_val!="undefined"&&prev_val!=null&&prev_val!=""){referrer=prev_val;var cl=window.s.prop8?window.s.prop8:window.c8;referrer=InsertCLvalue(cl,referrer);}
if(referrer==""){referrer="no referrer";}
if(formName==""){formName="no form name";}
window.s.c_w("s_fd",referrer+"|"+formName,0);SendFormActionCookie("s_fa","s");}
function catchPostBack(){SendFormActionCookie("s_fa","p");}
if($("form").length){$("form").submit(function(event){ExitActionAbandon=false;});}
function TrackVars(varList){var newVars=[];var trackedVars=[];var i,k;newVars=varList.split(',');trackedVars=window.s.linkTrackVars.split(',');for(i=0;i<trackedVars.length;i++){for(k=0;k<newVars.length;k++){if(trackedVars[i]==newVars[k]){newVars.splice(k,1);}}}
if(window.s.linkTrackVars!==""){window.s.linkTrackVars+=",";}
window.s.linkTrackVars+=newVars.join(",");}
function findFirstImage(jObject){var obj=$(jObject);var i;if(obj.children("img").length>0){return obj.children('img').eq(0);}
else if(obj.children().length===0){return false;}else{for(i=0;i<obj.children().length;i++){if(findFirstImage(obj.children().eq(i))){return findFirstImage(obj.children().eq(i));}}
return false;}}
function SetC22Param1(jObject){var c22="";var obj=$(jObject);var image,i,AllImages;if(obj.is('a')){if((image=findFirstImage(obj))){if((c22=image.attr('title'))){}
else if((c22=image.attr('alt'))){}
else if((c22=obj.attr('title'))){}
else if((c22=obj.attr('alt'))){}
else{c22=image.attr('src').match(/[\w_.\-]*?(?=\?)|[\w_.\-]*$/)[0];}}
else{c22=obj.attr('innerText')?obj.attr('innerText'):obj.attr('textContent');if(c22==""||typeof c22=="undefined"){c22=obj.attr('title')?obj.attr('title'):obj.attr('alt');}}}else if(obj.is('area')){if((c22=obj.attr('alt'))){}
else if((c22=obj.attr('title'))){}
else{c22=obj.attr('coords');AllImages=document.getElementsByTagName("img");for(i=0;i<AllImages.length;i++){if(AllImages[i].useMap=="#"+obj.parent().attr('name')){c22=AllImages[i].src.match(/[\w_.\-]*?(?=\?)|[\w_.\-]*$/)[0]+":"+obj.attr('coords');break;}}}}
if(typeof(c22)!="undefined"&&c22!=""){if(c22.length>LINK_ANALYIS_VARIABLE_CHARACTER_LIMIT){c22=c22.substring(0,LINK_ANALYIS_VARIABLE_CHARACTER_LIMIT);}}
return c22;}
function ReturnNavigation(jObject){var obj=$(jObject);if(obj.parents('.menu')&&obj.parents('.menu').attr('id')){return true;}else{return false;}}
function SetC22Param2(jObject,internalMethod){var c22;var obj=$(jObject);var url=obj.attr('href')?obj.attr('href'):"";if(url==""){c22="none";}
else if(url.indexOf("javascript:")==0){c22="none";}
else if(ReturnNavigation(obj)){c22=obj.parents('.menu').attr('id');}
else{if(internalMethod){c22=url.substr(url.lastIndexOf("/")+1,url.length);if(c22.match(/default\./i)){c22=url.replace(/pages\/default\..*/i,"");c22=c22.replace(/http[s]?\:\/\/[^\/]*\//i,"");c22=c22.replace(/^\//,"");}else if(c22===""){c22="home";}}else{c22=url;}}
if(typeof(c22)!="undefined"&&c22!=""){if(c22.length>LINK_ANALYIS_VARIABLE_CHARACTER_LIMIT){c22=c22.substring(0,LINK_ANALYIS_VARIABLE_CHARACTER_LIMIT);}}
return c22;}
function setLinkAnalysisVars(jObject){var obj=$(jObject);var internal=isInternal(obj.attr('href')?obj.attr('href'):"");if(obj.attr('id')=="JobApplyButton1"||obj.attr('id')=="JobApplyButton2"){if(obj.attr('href').indexOf("applyonlineform.aspx")!=-1){internal=true;}else{internal=false;}}
var c21=window.s.pageName;var c22,c23;var cl=window.s.prop8?window.s.prop8:window.c8;c21=InsertCLvalue(cl,c21);c22=SetC22Param1(obj)+"|"+SetC22Param2(obj,internal);c23=c21+"|"+c22;window.s.prop21=c21;window.s.prop22=c22;window.s.prop23=c23;window.s.prop24=getLinkType(obj.attr('rel'));if(obj.attr('rel')&&obj.attr('rel').indexOf('products')==0){window.s.prop24="products";}
TrackVars('prop21,prop22,prop23,prop24,prop26');}
function isDownload(url){var filename=url.substr(url.lastIndexOf("/")+1,url.length);var ext=(filename.lastIndexOf(".")==-1)?" ":filename.substr(filename.lastIndexOf(".")+1,filename.length);if(ext.indexOf("#")>-1){ext=ext.substring(0,ext.lastIndexOf("#"));}
if(ext.indexOf("?")>-1){ext=ext.substring(0,ext.lastIndexOf("?"));}
if(window.s.linkDownloadFileTypes.indexOf(ext)>-1){return true;}else{return false;}}
function isDownloadWithAppendedCharacters(url){var filename=url.substr(url.lastIndexOf("/")+1,url.length);var ext=(filename.lastIndexOf(".")==-1)?" ":filename.substr(filename.lastIndexOf(".")+1,filename.length);if(ext.indexOf("#")>-1){ext=ext.substring(0,ext.lastIndexOf("#"));}
if(ext.indexOf("?")>-1){ext=ext.substring(0,ext.lastIndexOf("?"));}
if(window.s.linkDownloadFileTypes.indexOf(ext)>-1){return true;}else{return false;}}
function SetDownloadVars(url){var filename=url.substr(url.lastIndexOf("/")+1,url.length);if(filename===""){filename=url;}
window.s.eVar3=filename;window.s.events="event1";SetPageConversionVariable();window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"events",",",1);window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"eVar3,prop26",",",1);window.s.linkTrackEvents=window.s.events;}
function SetRSSPodcastVars(url){var domain=url.split(/\/+/g)[1];var path="";if(domain==""){path=url.split("?")[0];}
else{path=url.split(domain+"/")[1].split("?")[0];}
if(GetQueryString(url,".sid")!=""){window.s.eVar34=GetQueryString(url,".sid");}
else if(GetQueryString(url,"id")!=""){window.s.eVar34=GetQueryString(url,"id");}
else if(path.lastIndexOf("/id")!=-1){window.s.eVar34=path.substring(path.lastIndexOf("/id")+1);}
else{window.s.eVar34=path;}
if(url.toLowerCase().indexOf("podcast")==-1){window.s.eVar34=window.s.eVar34+"|"+"RSS Subscription";window.s.events="event40";}
else{window.s.eVar34=window.s.eVar34+"|"+"Podcast Subscription";window.s.events="event41";}
window.s.linkTrackEvents=window.s.events;window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"events",",",1);window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"eVar34,prop26",",",1);SetPageConversionVariable();}
function setDownloadAppVars(url){window.s.eVar36=url+"|"+"Download iPhone Application";window.s.events="event38";window.s.linkTrackEvents=window.s.events;window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"events",",",1);window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"eVar36,prop26",",",1);SetPageConversionVariable();}
function WriteLinkAnalysisCookie(){if(triggerWriteLinkAnalysisCookie){if(window.s.prop35)
window.s.c_w('SC_LINKS',window.s.prop21+'^^'+window.s.prop22+'^^'+window.s.prop23+'^^'+window.s.prop24+'^^'+window.s.products+'^^'+window.s.prop35,0);else
window.s.c_w('SC_LINKS',window.s.prop21+'^^'+window.s.prop22+'^^'+window.s.prop23+'^^'+window.s.prop24+'^^'+window.s.products,0);TouchedCookie=true;}else{triggerWriteLinkAnalysisCookie=true;}}
function ReadLinkAnalysisCookies(whichProps,cookieName){if(!TouchedCookie){var vl=whichProps;var c,x,cv,cva,vla,prodView;if((c=cookieName)){}else{c="SC_LINKS";}
cv=window.s.c_r(c);if(vl&&cv!==''){cva=window.s.split(cv,'^^');vla=window.s.split(vl,',');for(x=0;x<vla.length;x++){if(typeof cva[x]!="undefined"&&cva[x]!=null){window.s[vla[x]]=cva[x];if(vla[x]=="products"){prodView=cva[x];}}}}
window.s.c_w(c,'',0);if(prodView!=""&&typeof prodView!="undefined"){setProductsEvents(prodView,"click");}
if(prodView!=""&&typeof prodView!="undefined"){setProductsEvents(prodView,"click");var cl=window.s.prop8?window.s.prop8:window.c8;var c21=window.s.prop21?window.s.prop21:window.c21;window.s.eVar21=RemoveCLvalue(cl,c21);}
LowerCaseVars();TouchedCookie=true;}}
function setConversionVars(){window.s.eVar45=window.s.prop45;window.s.eVar26=window.s.prop26;window.s.eVar27=window.s.prop27;window.s.eVar28=window.s.prop28;window.s.eVar29=window.s.prop29;}
function GetQueryStringBasedOnName(name){qs=window.location.search.substring(1);qsCollection=qs.split("&");for(i=0;i<qsCollection.length;i++){ft=qsCollection[i].split("=");if(ft[0]==name){return ft[1];}}}
function setJobApplyVars(){var jobId=GetQueryStringBasedOnName('job');if(typeof(jobId)=="undefined"||jobId==""){window.s.eVar5="";}else{window.s.eVar5=jobId;}
window.s.events="event16";window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"events",",",1);window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"eVar5,prop26",",",1);window.s.linkTrackEvents=window.s.events;SetPageConversionVariable();}
function SetupDisplayPageletVars(){window.s.events="event23";window.s.eVar23=$("div#dlp-maincontent > div#dlp-left-maincontent > div#left-pagelet > input#pageletShortenedUrl").attr('value');SetPageConversionVariable();window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"eVar23,prop26",",",1);window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"events",",",1);window.s.linkTrackEvents=window.s.events;}
function TrackDisplayPagelet(){SetupDisplayPageletVars();LowerCaseVars();window.s.tl(this,'o','trackpagelet');CleanUpLtVars();}
function isRSSPodcast(url){var domain=url.split(/\/+/g)[1];var isRssXml=false;var resourceFile="";var isiTunesPodcast=false;if(url.lastIndexOf('/')>-1){resourceFile=url.substring(url.lastIndexOf('/')+1).toLowerCase();resourceFile=$.trim(resourceFile);isRssXml=(resourceFile=="rss.xml");}
if(url.indexOf("itunes.apple.com")!=-1&&url.indexOf("podcast")!=-1){isiTunesPodcast=true;}
if("feeds.accenture.com,feeds.feedburner.com".indexOf(domain)!=-1||isRssXml||isiTunesPodcast){return true;}
return false;}
function isiTunesApp(url){if(url.indexOf("itunes.apple.com")!=-1&&url.indexOf("/app/")!=-1){return true;}
return false;}
function setAllVars(jObject){var obj=$(jObject);var url=obj.attr('href')?obj.attr('href'):"";if(url!=""){url=url.toLowerCase();}
if(url.indexOf("://accenture.com")!=-1){url=url.replace("://accenture.com","://www.accenture.com");}
var domain=url.split(/\/+/g)[1];setLinkAnalysisVars(obj);if(url.indexOf("#")==0){return'none';}
else if(url.indexOf("javascript:")==0){return'e';}
else if(isProductLink(obj)){if(obj.attr('rel').indexOf("products_featured")>-1){setVariablesForProduct(";"+obj.attr('name')+";;;"+"event14=1"+","+";"+obj.attr('name')+";;;"+"event15=1"+",","click");}
else if(obj.attr('rel').indexOf("products")>-1||obj.attr('rel').indexOf("related")>-1||obj.attr('rel').indexOf("popular")>-1){setVariablesForProduct(";"+obj.attr('name')+";;;"+"event15=1"+",","click");}
return'none';}
if(isRSSPodcast(url)){setConversionVars();SetRSSPodcastVars(url);return'o';}else if(isiTunesApp(url)){setConversionVars();setDownloadAppVars(url);return'o';}else if(obj.attr('id')=="JobApplyButton1"||obj.attr('id')=="JobApplyButton2"){setConversionVars();setJobApplyVars();return'o';}else if(obj.attr('id')=="get-referred-link"){setConversionVars();setGetReferredHomeVars();return'oGR';}else if(obj.attr('id')=="get-referred-startlink1"||obj.attr('id')=="get-referred-startlink2"){setConversionVars();setGetReferredStartVars();return'oGR';}else if(obj.attr('id')=="GetReferredJobApplyButton1"||obj.attr('id')=="GetReferredJobApplyButton1"){setConversionVars();setGetReferredJobApplyVars();return'oGR';}else if(isDownload(url)){setConversionVars();SetDownloadVars(url);return'd';}else if(isInternal(url)&&isDownloadWithAppendedCharacters(url)){return"o";}else if(isInternal(url)&&!isDownloadWithAppendedCharacters(url)){WriteLinkAnalysisCookie();return'none';}else{return'e';}}
function SendAnalysisClick(obj,event){var LinkType;var fromGetReferred=false;var indicatorPreventDefault="#self";if($(obj).attr('href')==indicatorPreventDefault||$(obj).attr('hash')==indicatorPreventDefault){if(event.preventDefault){event.preventDefault();}else{event.returnValue=false;}}
if($(obj).attr('rel')!=""||$(obj).attr('href').indexOf("javascript:")!=0&&$(obj).attr('href')!="#"&&$(obj).attr('href')!=""){LinkType=setAllVars(obj);if(LinkType=='oGR'){LinkType='o';fromGetReferred=true;}else{fromGetReferred=false;}
if(LinkType!=="none"){LowerCaseVars();var href=$(obj).attr('href');if(fromGetReferred){if(event.preventDefault){event.preventDefault();}else{event.returnValue=false;}
window.s.tl(this,LinkType,'linkanalysis');setTimeout(function(){window.location=href},500);}else{window.s.tl(this,LinkType,'linkanalysis');}}
CleanUpLtVars();}}
function HandleBodyClick(event){var clickTarget,tagName,obj,aObject;if(!event){var event=window.event;}
clickTarget=(event.srcElement)?event.srcElement:event.target;tagName=clickTarget.tagName.toUpperCase();if(tagName=="A"||tagName=="AREA"||$(clickTarget).parents("a").length>0){if($(clickTarget).parents("a").length>0){aObject=$(clickTarget).parents("a").get(0);}else{aObject=clickTarget;}
obj=$(aObject);if(obj.attr('href')||obj.attr('tagName').toLowerCase()=='area'||obj.attr('rel')){CleanUpLtVars();SendAnalysisClick(obj,event);}}else if(tagName=="IMG"&&$(clickTarget).parents("a").length>0){aObject=$(clickTarget).parents("a").get(0);}}
function globalClick(){document.onclick=HandleBodyClick;}
function SetC22Param2href(href,internalMethod){var c22;var url=href;if(url.indexOf("javascript:")==0){c22="none";}
else if(internalMethod){c22=url.substr(url.lastIndexOf("/")+1,url.length);if(c22.match(/default/i)){c22=url.match(/([\w|\-]*)\/([\w|\-]*)\/default.[\w]*/i)[0].toLowerCase();}else if(c22===""){c22="home";}}else{c22=url;}
if(typeof(c22)!="undefined"&&c22!=""){if(c22.length>LINK_ANALYIS_VARIABLE_CHARACTER_LIMIT){c22=c22.substring(0,LINK_ANALYIS_VARIABLE_CHARACTER_LIMIT);}}
return c22;}
function SetupFlashLinkAnalysisVars(href,anchorText,linkType){if(typeof(anchorText)!="undefined"&&anchorText!=""){if(anchorText.length>LINK_ANALYIS_VARIABLE_CHARACTER_LIMIT){anchorText=anchorText.substring(0,LINK_ANALYIS_VARIABLE_CHARACTER_LIMIT);}}
var internalMethod=isInternal(href);var c21=window.s.pageName;var cl=window.s.prop8?window.s.prop8:window.c8;c21=InsertCLvalue(cl,c21);var c22=anchorText+"|"+SetC22Param2href(href,internalMethod);var c23=c21+"|"+c22;window.s.prop21=c21;window.s.prop22=c22;window.s.prop23=c23;window.s.prop24=getLinkType(linkType);window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"prop21",",",1);window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"prop22",",",1);window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"prop23",",",1);window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"prop26",",",1);if((window.s.prop24=linkType)){window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"prop24",",",1);}}
function SetupEmailToColleagueLinkAnalysisVars(href,anchorText,linkType){if(anchorText.length>LINK_ANALYIS_VARIABLE_CHARACTER_LIMIT){anchorText=anchorText.substring(0,LINK_ANALYIS_VARIABLE_CHARACTER_LIMIT);}
var internalMethod=isInternal(href);var c21=window.s.pageName;var cl=window.s.prop8?window.s.prop8:window.c8;c21=InsertCLvalue(cl,c21);var c22=anchorText+"|"+SetC22Param2href(href,internalMethod);var c23=c21+"|"+c22;window.s.prop21=c21;window.s.prop22=c22;window.s.prop23=c23;window.s.prop24=getLinkType(linkType);window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"prop21",",",1);window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"prop22",",",1);window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"prop23",",",1);window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"prop26",",",1);if((window.s.prop24=linkType)){window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"prop24",",",1);}}
function FlashTrackingOmniture(params,vals,events){var x;if(params&&vals!==''){var valsArray=window.s.split(vals,';');var paramsArray=window.s.split(params,';');if(events){window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"events",",",1);window.s.LinkTrackEvents=events;window.s.events=events;}
for(x=0;x<paramsArray.length;x++){window.s[paramsArray[x]]=valsArray[x];window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,paramsArray[x],",",1);}
LowerCaseVars();window.s.tl(this,'o','flash');for(x=0;x<paramsArray.length;x++){window.s[paramsArray[x]]="";}
window.s.linkTrackVars="";}}
function FlashLinkAnalysis(href,anchorText,linkType){if(href&&anchorText){SetupFlashLinkAnalysisVars(href,anchorText,linkType);LowerCaseVars();window.s.tl(this,'o','flashlinkAnalysis');CleanUpLtVars();}}
function FlashDownload(href,anchorText,linkType){if(href&&anchorText){SetupFlashLinkAnalysisVars(href,anchorText,linkType);SetDownloadVars(href,"force");LowerCaseVars();window.s.tl(this,'d','flashdownload');CleanUpLtVars();}}
function EmailToColleagueLinkAnalysis(href,anchorText){if(href&&anchorText){SetupEmailToColleagueLinkAnalysisVars(href,anchorText,"");LowerCaseVars();window.s.tl(this,'o','emailtocolleaguelinkAnalysis');CleanUpLtVars();}}
function FlashRSSPodcast(href,anchorText,forceFormat,linkType){if(href&&anchorText){var forceFormatText;SetupFlashLinkAnalysisVars(href,anchorText,linkType);SetRSSPodcastVars(href);LowerCaseVars();window.s.tl(this,'d','flashfeed');CleanUpLtVars();}}
function FlashVideoAudio(url,force){var filename=url.substr(url.lastIndexOf("/")+1,url.length);setVideoVarsEvents(filename,0);LowerCaseVars();window.s.tl(this,'o','flashmedia');clearVideoVarsEvents();}
function OmnitureTrackSearch(status){var searchFilters;if(typeof window.s_code!="undefined"&&window.s_code!=null){if(window.s.getQueryParam('sType')){if(window.s.getQueryParam('k')){window.s.prop4=$('<div/>').html(g_siteSearchParams.keywords.toLowerCase()).text();}
else{window.s.prop4="all | "+$('<div/>').html(g_siteSearchParams.all.toLowerCase()).text()+";";window.s.prop4=window.s.prop4+" phrase | "+$('<div/>').html(g_siteSearchParams.phrase.toLowerCase()).text()+";";window.s.prop4=window.s.prop4+" any | "+$('<div/>').html(g_siteSearchParams.any.toLowerCase()).text()+";";window.s.prop4=window.s.prop4+" notany | "+$('<div/>').html(g_siteSearchParams.notAny.toLowerCase()).text()+";";}
if(window.s.getQueryParam('s')){window.s.prop4=window.s.getQueryParam('s')+":"+window.s.prop4;window.s.prop4=window.s.prop4.toLowerCase();}
if(status==false){window.s.prop4="failed:"+window.s.prop4;s.c_w('SC_SEARCH','',0);}
window.s.prop6=window.s.getQueryParam('sType').replace("+"," ").toLowerCase();window.s.eVar4="D=c4";window.s.events="event2";if(typeof prev_val!="undefined"&&prev_val!=null){var cPageNameOriginating=prev_val;var cl=window.s.prop8?window.s.prop8:window.c8;window.s.prop7=InsertCLvalue(cl,cPageNameOriginating);}
else{window.s.prop7="";}
if(typeof(searchFilters)!=="undefined"&&searchFilters!==null&&searchFilters!==""){var cPageName=window.s.pageName;var cl=window.s.prop8?window.s.prop8:window.c8;window.s.prop15=InsertCLvalue(cl,cPageName);window.s.prop31=searchFilters;window.s.prop32="D=c31";window.s.linkTrackVars="events,prop4,prop6,prop7,prop26,prop31,prop32,eVar4,eVar44";}
else{window.s.linkTrackVars="events,prop4,prop6,prop7,prop26,eVar4,eVar44";}
window.s.eVar44=window.s.crossVisitParticipation(window.s.prop4,'s_ev44','30','5','>','',0);window.s.linkTrackEvents="event2";AssignTrafficVariable();LowerCaseVars();window.s.tl(this,'o','search');ReassignTrafficVariable();}
window.s.prop4="";window.s.prop6="";window.s.prop7="";window.s.prop31="";window.s.prop32="";window.s.eVar4="";window.s.eVar44="";window.s.events="";}}
function SendSelectedFilters(searchFilters){if(window.s_code!=null){var cl=window.s.prop8?window.s.prop8:window.c8;var cPageName=window.s.pageName;window.s.prop15=InsertCLvalue(cl,cPageName);window.s.prop31=searchFilters;if(searchFilters==""||typeof searchFilters=="undefined"){window.s.prop31="no filter selected";}
window.s.prop32="D=c31";window.s.linkTrackVars="prop15,prop31,prop32,prop26";AssignTrafficVariable();LowerCaseVars();window.s.tl(this,'o','filter');ReassignTrafficVariable();window.s.prop15="";window.s.prop31="";window.s.prop32="";}}
function RetrieveAllArticlesFilters(filterString){var filterArray;var filters="";filterArray=filterString.split(";");for(i=0;i<filterArray.length;i++){if(typeof filterArray[i]!="undefined"&&filterArray[i]!=""&&filterArray[i].split(":")[1]!=""&&typeof filterArray[i].split(":")[1]!="undefined"){if(filters==""){filters=filterArray[i].split(":")[1];}else{filters=filters+","+filterArray[i].split(":")[1];}}}
return filters}
function RetrieveSelectedFilters(objFilter){var Categories=objFilter;var SubCategories;var selectedSubCategories="";var selectedFilters="";var x,y;for(x in Categories){SubCategories=Categories[x].SubCategories;var selected="";for(y in SubCategories){if(SubCategories[y].Selected){if(selected==""){selected=JSON.stringify(SubCategories[y].DisplayName);}
else{selected=selected+","+JSON.stringify(SubCategories[y].DisplayName);}}}
selectedSubCategories=selected.replace(/["']{1}/gi,"");if(selectedSubCategories!=""){selectedFilters=selectedFilters+(selectedSubCategories+",").replace(/["']{1}/gi,"");}}
selectedFilters=selectedFilters.substring(0,selectedFilters.lastIndexOf(","));return selectedFilters;}
function SendJobSearchFilters(){var cPageName=window.s.pageName;window.s.prop15=InsertCLvalue(window.s.prop8,cPageName);var skill="";var country="";var typeOfWork="";skill=$('select[name*="drpSkills"] option:selected').text();country=$('select[name*="drpCountries"] option:selected').text();typeOfWork=$('select[name*="drpTypeOfWork"] option:selected').text();if(typeOfWork=="")
window.s.prop33=country+":"+skill;else
window.s.prop33=country+":"+typeOfWork+":"+skill;window.s.prop33=window.s.prop33.toLowerCase();}
$(document).ready(function(){globalClick();TrackVideoOmniture();setIntentCapture();isFindButtonClicked();isPageTabClicked();TrackFormStart();TrackFormError();SendGenericProductImpressions();HandleEmployeeLoginLink();checkSelectedTab();});$(window).unload(function(){TrackFormAbandon();});function VideoAudioWithLinkAnalysis(url,anchorText){var filename=url.substr(url.lastIndexOf("/")+1,url.length);setVideoVarsEvents(filename,0);SetupFlashLinkAnalysisVars(url,anchorText);LowerCaseVars();window.s.tl(this,'o','medialink');clearVideoVarsEvents();}
function RemoveCLvalue(clValue,pageName){if(pageName.indexOf("http")==-1){pageName=pageName.replace(clValue+":","");return pageName;}
else{return pageName;}}
function setGetReferredHomeVars(){window.s.events="event42";window.s.prop24="get-referred"
window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"events",",",1);window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"prop24,prop26",",",1);window.s.linkTrackEvents=window.s.events;SetPageConversionVariable();}
function setGetReferredStartVars(){window.s.events="event43";window.s.prop24="get-referred"
window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"events",",",1);window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"prop24,prop26",",",1);window.s.linkTrackEvents=window.s.events;SetPageConversionVariable();}
function setGetReferredJobApplyVars(){window.s.events="event44";window.s.prop24="get-referred"
window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"events",",",1);window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"prop24,prop26",",",1);window.s.linkTrackEvents=window.s.events;SetPageConversionVariable();}
function setGetReferredSubmitVars(network){if(network=="facebook"){window.s.events="event45";}else if(network=="linkedin"){window.s.events="event46";}else if(network=="email"){window.s.events="event47";}
var jobId=GetQueryStringBasedOnName('job_id');if(typeof(jobId)=="undefined"||jobId==""){window.s.eVar5="";}else{window.s.eVar5=jobId;}
window.s.prop24="get-referred";window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"events",",",1);window.s.linkTrackVars=window.s.apl(window.s.linkTrackVars,"eVar5,prop24,prop26",",",1);window.s.linkTrackEvents=window.s.events;SetPageConversionVariable();}
function SendGetReferredSubmit(network){window.s.prop8="us-en";setConversionVars();if(typeof(network)!="undefined"&&network!=""){setGetReferredSubmitVars(network);s.tl(this,'o','linkanalysis');}
CleanUpLtVars();}
function getLinkType(rel){if(typeof(rel)!='undefined'&&rel!=''){var link=rel.toLowerCase();if(window.linkTypeValues.indexOf(link)>-1){return link;}else{return'other';}}
else{return'other';}}
function HandleEmployeeLoginLink(){$('a[id*="EmployeeLoginLink"]').click(function(){employeeLoginLink=$(this).attr('id');});}
function checkSelectedTab(){if($(".active-tab").length>0){window.s.linkTrackVars='events,prop17';SetPageConversionVariable();window.s.prop17=$(".active-tab").text().toLowerCase();LowerCaseVars();window.s.tl(this,'o','tabbing');}}