
var RotateCounter=0;var stepcarousel={ajaxloadingmsg:'<div style="margin: 1em; font-weight: bold"><img src="ajaxloadr.gif" style="vertical-align: middle" /> Fetching Content. Please wait...</div>',defaultbuttonsfade:0,configholder:{},getCSSValue:function(val){return(val=="auto")?0:parseInt(val)},getremotepanels:function($,config){config.$belt.html(this.ajaxloadingmsg)
$.ajax({url:config.contenttype[1],async:true,error:function(ajaxrequest){config.$belt.html('Error fetching content.<br />Server Response: '+ajaxrequest.responseText)},success:function(content){config.$belt.html(content)
config.$panels=config.$gallery.find('.'+config.panelclass)
if(config.$panels.length>0)
stepcarousel.alignpanels($,config)}})},getoffset:function(what,offsettype){return(what.offsetParent)?what[offsettype]+this.getoffset(what.offsetParent,offsettype):what[offsettype]},getCookie:function(Name){var re=new RegExp(Name+"=[^;]+","i");if(document.cookie.match(re))
return document.cookie.match(re)[0].split("=")[1]
return null},setCookie:function(name,value){document.cookie=name+"="+value},fadebuttons:function(config,currentpanel){config.$leftnavbutton.fadeTo('fast',currentpanel==0?this.defaultbuttonsfade:1)
config.$rightnavbutton.fadeTo('fast',currentpanel==config.lastvisiblepanel?this.defaultbuttonsfade:1)},addnavbuttons:function($,config,currentpanel){config.$leftnavbutton=$('<img src="'+config.defaultbuttons.leftnav[0]+'">').css({zIndex:50,position:'absolute',left:(config.offsets.left+config.defaultbuttons.leftnav[1]+10)+'px',top:config.offsets.top+config.defaultbuttons.leftnav[2]+'px',cursor:'hand',cursor:'pointer'}).appendTo('body')
config.$rightnavbutton=$('<img src="'+config.defaultbuttons.rightnav[0]+'">').css({zIndex:50,position:'absolute',left:(config.offsets.left+config.$gallery.get(0).offsetWidth+config.defaultbuttons.rightnav[1]-13)+'px',top:config.offsets.top+config.defaultbuttons.rightnav[2]+'px',cursor:'hand',cursor:'pointer'}).appendTo('body')
this.fadebuttons(config,currentpanel)
config.$leftnavbutton.bind('click',function(){stepcarousel.stepByClick(config.galleryid,-config.defaultbuttons.moveby)})
config.$rightnavbutton.bind('click',function(){stepcarousel.stepByClick(config.galleryid,config.defaultbuttons.moveby)})
if(config.panelbehavior.wraparound==false){this.fadebuttons(config,currentpanel)}
return config.$leftnavbutton.add(config.$rightnavbutton)},alignpanels:function($,config){var paneloffset=0
config.paneloffsets=[paneloffset]
config.panelwidths=[]
config.$panels.each(function(index){var $currentpanel=$(this)
$currentpanel.css({float:'none',position:'absolute',left:paneloffset+'px'})
$currentpanel.bind('click',function(e){return config.onpanelclick(e.target)})
paneloffset+=stepcarousel.getCSSValue($currentpanel.css('marginRight'))+parseInt($currentpanel.get(0).offsetWidth||$currentpanel.css('width'))
config.paneloffsets.push(paneloffset)
config.panelwidths.push(paneloffset-config.paneloffsets[config.paneloffsets.length-2])})
if(config.paneloffsets.length>1){config.paneloffsets.pop()}
var addpanelwidths=0
var lastpanelindex=config.$panels.length-1
config.lastvisiblepanel=lastpanelindex
for(var i=config.$panels.length-1;i>=0;i--){addpanelwidths+=(i==lastpanelindex?config.panelwidths[lastpanelindex]:config.paneloffsets[i+1]-config.paneloffsets[i])
if(config.gallerywidth>addpanelwidths){config.lastvisiblepanel=i}}
config.$belt.css({width:paneloffset+'px'})
config.currentpanel=(config.panelbehavior.persist)?parseInt(this.getCookie(config.galleryid+"persist")):0
config.currentpanel=(typeof config.currentpanel=="number"&&config.currentpanel<config.$panels.length)?config.currentpanel:0
var endpoint=config.paneloffsets[config.currentpanel]+(config.currentpanel==0?0:config.beltoffset)
config.$belt.css({left:-endpoint+'px'})
if(config.defaultbuttons.enable==true){var $navbuttons=this.addnavbuttons($,config,config.currentpanel)
$(window).bind("load resize",function(){config.offsets={left:stepcarousel.getoffset(config.$gallery.get(0),"offsetLeft"),top:stepcarousel.getoffset(config.$gallery.get(0),"offsetTop")}
config.$leftnavbutton.css({left:(config.offsets.left+config.defaultbuttons.leftnav[1]+10)+'px',top:config.offsets.top+config.defaultbuttons.leftnav[2]+'px'})
config.$rightnavbutton.css({left:(config.offsets.left+config.$gallery.get(0).offsetWidth+config.defaultbuttons.rightnav[1]-13)+'px',top:config.offsets.top+config.defaultbuttons.rightnav[2]+'px'})})}
if(config.autostep&&config.autostep.enable){var $carouselparts=config.$gallery.add(typeof $navbuttons!="undefined"?$navbuttons:null)
$carouselparts.bind('click',function(){if(config.autostep.mode!='MultiRotate'){if(RotateCounter==0){stepcarousel.stopautostep(config)}
else{config.autostep.status="stopped"
config.panelbehavior.wraparound=false}}
else{stepcarousel.stopautostep(config)}})
$carouselparts.hover(function(){stepcarousel.stopautostep(config)
config.autostep.hoverstate="over"},function(){if(config.steptimer&&config.autostep.hoverstate=="over"&&config.autostep.status!="stopped"){config.steptimer=setInterval(function(){stepcarousel.autorotate(config.galleryid)},config.autostep.pause)
config.autostep.hoverstate="out"}})
config.steptimer=setInterval(function(){stepcarousel.autorotate(config.galleryid)},config.autostep.pause)}
this.createpaginate($,config)
this.statusreport(config.galleryid)
config.oninit()
config.onslideaction(this)},stepTo:function(galleryid,pindex){var config=stepcarousel.configholder[galleryid]
if(typeof config=="undefined"){return}
stepcarousel.stopautostep(config)
var pindex=Math.min(pindex-1,config.paneloffsets.length-1)
var endpoint=config.paneloffsets[pindex]+(pindex==0?0:config.beltoffset)
if(config.panelbehavior.wraparound==false&&config.defaultbuttons.enable==true){this.fadebuttons(config,pindex)}
config.$belt.animate({left:-endpoint+'px'},config.panelbehavior.speed,function(){config.onslideaction(this)})
config.currentpanel=pindex
this.statusreport(galleryid)},stepByClick:function(galleryid,steps,isauto){var config=stepcarousel.configholder[galleryid]
if(typeof config=="undefined"){return}
if(!isauto)
stepcarousel.stopautostep(config)
var direction=(steps>0)?'forward':'back'
var pindex=config.currentpanel+steps
if(config.panelbehavior.wraparound==false){pindex=(direction=="back"&&pindex<=0)?0:(direction=="forward")?Math.min(pindex,config.lastvisiblepanel):pindex
if(config.defaultbuttons.enable==true){stepcarousel.fadebuttons(config,pindex)}}
else{if(pindex>config.lastvisiblepanel&&direction=="forward"){if(config.currentpanel<config.lastvisiblepanel){pindex=config.lastvisiblepanel}
else{pindex=config.lastvisiblepanel}}
else if(pindex<0&&direction=="back"){if(config.currentpanel>0){pindex=0}
else{pindex=0}}
stepcarousel.fadebuttons(config,pindex)}
var endpoint=config.paneloffsets[pindex]+(pindex==0?0:config.beltoffset)
if(pindex==0&&direction=='forward'||config.currentpanel==0&&direction=='back'&&config.panelbehavior.wraparound==true){}
else
config.$belt.animate({left:-endpoint+'px'},config.panelbehavior.speed,function(){config.onslideaction(this)})
config.currentpanel=pindex
this.statusreport(galleryid)
if(typeof window.s_code!="undefined"&&window.s_code!=null){SendHomePageChanged(direction);}},stepBy:function(galleryid,steps,isauto){var config=stepcarousel.configholder[galleryid]
if(typeof config=="undefined"){return}
if(!isauto)
stepcarousel.stopautostep(config)
var direction=(steps>0)?'forward':'back'
var pindex=config.currentpanel+steps
if(config.panelbehavior.wraparound==false){pindex=(direction=="back"&&pindex<=0)?0:(direction=="forward")?Math.min(pindex,config.lastvisiblepanel):pindex
if(config.defaultbuttons.enable==true){stepcarousel.fadebuttons(config,pindex)}}
else{RotateCounter=RotateCounter+1;if(pindex>config.lastvisiblepanel&&direction=="forward"){if(config.currentpanel<config.lastvisiblepanel){pindex=config.lastvisiblepanel}
else{pindex=0
if(config.autostep.mode=='SingleRotate'){stepcarousel.stopautostep(config)
config.autostep.enable=false}}}
else if(pindex<0&&direction=="back"){if(config.currentpanel>0){pindex=0}
else{pindex=config.lastvisiblepanel}}
stepcarousel.fadebuttons(config,pindex)}
var endpoint=config.paneloffsets[pindex]+(pindex==0?0:config.beltoffset)
if(pindex==0&&direction=='forward'||config.currentpanel==0&&direction=='back'&&config.panelbehavior.wraparound==true){config.$belt.animate({left:-config.paneloffsets[config.currentpanel]-(direction=='forward'?100:-30)+'px'},'normal',function(){config.$belt.animate({left:-endpoint+'px'},config.panelbehavior.speed,function(){config.onslideaction(this)})})}
else
config.$belt.animate({left:-endpoint+'px'},config.panelbehavior.speed,function(){config.onslideaction(this)})
config.currentpanel=pindex
this.statusreport(galleryid)
if(typeof window.s_code!="undefined"&&window.s_code!=null){SendHomePageChanged(direction);}},autorotate:function(galleryid){var config=stepcarousel.configholder[galleryid]
this.stepBy(galleryid,config.autostep.moveby,true)},stopautostep:function(config){clearInterval(config.steptimer)},statusreport:function(galleryid){var config=stepcarousel.configholder[galleryid]
if(config.statusvars.length==3){var startpoint=config.currentpanel
var visiblewidth=0
for(var endpoint=startpoint;endpoint<config.paneloffsets.length;endpoint++){visiblewidth+=config.panelwidths[endpoint]
if(visiblewidth>config.gallerywidth){break}}
startpoint+=1
endpoint=(endpoint+1==startpoint)?startpoint:endpoint
var valuearray=[startpoint,endpoint,config.panelwidths.length]
for(var i=0;i<config.statusvars.length;i++){window[config.statusvars[i]]=valuearray[i]
config.$statusobjs[i].text(valuearray[i]+" ")}}
stepcarousel.selectpaginate(jQuery,galleryid)},createpaginate:function($,config){if(config.$paginatediv.length==1){var $templateimg=config.$paginatediv.find('img["data-over"]:eq(0)')
var controlpoints=[],controlsrc=[],imgarray=[],moveby=$templateimg.attr("data-moveby")||1
var asize=(moveby==1?0:1)+Math.floor((config.lastvisiblepanel+1)/moveby)
var imghtml=$('<div>').append($templateimg.clone()).html()
srcs=[$templateimg.attr('src'),$templateimg.attr('data-over'),$templateimg.attr('data-select')]
for(var i=0;i<asize;i++){var moveto=Math.min(i*moveby,config.lastvisiblepanel)
imgarray.push(imghtml.replace(/>$/,' data-index="'+i+'" data-moveto="'+moveto+'" title="Move to Panel '+(moveto+1)+'">')+'\n')
controlpoints.push(moveto)}
var $controls=$('<span></span>').replaceAll($templateimg).append(imgarray.join('')).find('img')
$controls.css({cursor:'pointer'})
config.$paginatediv.bind('click',function(e){var $target=$(e.target)
if($target.is('img')&&$target.attr('data-over')){stepcarousel.stepTo(config.galleryid,parseInt($target.attr('data-moveto'))+1)}})
config.$paginatediv.bind('mouseover mouseout',function(e){var $target=$(e.target)
if($target.is('img')&&$target.attr('data-over')){if(parseInt($target.attr('data-index'))!=config.pageinfo.curselected)
$target.attr('src',srcs[(e.type=="mouseover")?1:0])}})
config.pageinfo={controlpoints:controlpoints,$controls:$controls,srcs:srcs,prevselected:null,curselected:null}}},selectpaginate:function($,galleryid){var config=stepcarousel.configholder[galleryid]
if(config.$paginatediv.length==1){for(var i=0;i<config.pageinfo.controlpoints.length;i++){if(config.pageinfo.controlpoints[i]<=config.currentpanel)
config.pageinfo.curselected=i}
if(typeof config.pageinfo.prevselected!=null)
config.pageinfo.$controls.eq(config.pageinfo.prevselected).attr('src',config.pageinfo.srcs[0])
config.pageinfo.$controls.eq(config.pageinfo.curselected).attr('src',config.pageinfo.srcs[2])
config.pageinfo.prevselected=config.pageinfo.curselected}},loadcontent:function(galleryid,url){var config=stepcarousel.configholder[galleryid]
config.contenttype=['ajax',url]
stepcarousel.stopautostep(config)
stepcarousel.resetsettings($,config)
stepcarousel.init(jQuery,config)},init:function($,config){config.gallerywidth=config.$gallery.width()
config.offsets={left:stepcarousel.getoffset(config.$gallery.get(0),"offsetLeft"),top:stepcarousel.getoffset(config.$gallery.get(0),"offsetTop")}
config.$belt=config.$gallery.find('.'+config.beltclass)
config.$panels=config.$gallery.find('.'+config.panelclass)
config.$paginatediv=$('#'+config.galleryid+'-paginate')
if(config.autostep)
config.autostep.pause+=config.panelbehavior.speed
config.onpanelclick=(typeof config.onpanelclick=="undefined")?function(target){}:config.onpanelclick
config.onslideaction=(typeof config.onslide=="undefined")?function(){}:function(beltobj){$(beltobj).stop();config.onslide()}
config.oninit=(typeof config.oninit=="undefined")?function(){}:config.oninit
config.beltoffset=stepcarousel.getCSSValue(config.$belt.css('marginLeft'))
config.statusvars=config.statusvars||[]
config.$statusobjs=[$('#'+config.statusvars[0]),$('#'+config.statusvars[1]),$('#'+config.statusvars[2])]
config.currentpanel=0
stepcarousel.configholder[config.galleryid]=config
if(config.contenttype[0]=="ajax"&&typeof config.contenttype[1]!="undefined")
stepcarousel.getremotepanels($,config)
else{if(config.$panels.length>0)
stepcarousel.alignpanels($,config)}
if(typeof window.s_code!="undefined"&&window.s_code!=null){window.SendHomePageInital();}},resetsettings:function($,config){if((typeof(config.$gallery)=="undefined")||(typeof(config.$gallery)==null)||(!config.$gallery)){return;}
config.$gallery.unbind()
config.$belt.stop()
config.$panels.remove()
if(config.$leftnavbutton){config.$leftnavbutton.remove()
config.$rightnavbutton.remove()}
if(config.$paginatediv.length==1){config.$paginatediv.unbind()
config.pageinfo.$controls.eq(0).attr('src',config.pageinfo.srcs[0]).removeAttr('data-index').removeAttr('data-moveto').removeAttr('title').end().slice(1).remove()}
if(config.autostep)
config.autostep.status=null
if(config.panelbehavior.persist){stepcarousel.setCookie(window[config.galleryid+"persist"],0)}},setup:function(config){document.write('<style type="text/css">\n#'+config.galleryid+'{overflow: hidden;}\n</style>')
jQuery(document).ready(function($){config.$gallery=$('#'+config.galleryid)
stepcarousel.init($,config)})
jQuery(window).bind('unload',function(){stepcarousel.resetsettings($,config)
if(config.panelbehavior.persist)
stepcarousel.setCookie(config.galleryid+"persist",config.currentpanel)
jQuery.each(config,function(ai,oi){oi=null})
config=null})}}
jQuery(function(){jQuery('#twitterFeed').cycle({fx:'fade',speed:1000,timeout:5000,pause:1});jQuery('#twitterFeed').show(1000);});function getByClass(matchClass,tag){var elems=document.getElementsByTagName(tag);var result;for(var i in elems){if((" "+elems[i].className+" ").indexOf(" "+matchClass+" ")>-1){result=elems[i];break;}}
return result;};window.onload=function(){var WelcomeMenuHeaderDesc=getByClass('WelcomeMenuHeaderDesc','div');var WelcomeMenuHeaderDescValue;var WelcomeMenuHeaderDescLength;if(WelcomeMenuHeaderDesc!=null){WelcomeMenuHeaderDescValue=$.trim(WelcomeMenuHeaderDesc.innerHTML.toUpperCase());WelcomeMenuHeaderDescLength=$.trim(WelcomeMenuHeaderDesc.innerHTML).length;if(WelcomeMenuHeaderDescValue==" "||WelcomeMenuHeaderDescValue=="<DIV></DIV>"||WelcomeMenuHeaderDescLength==0){WelcomeMenuHeaderDesc.style.display='none';}else{WelcomeMenuHeaderDesc.style.display='block';}}}