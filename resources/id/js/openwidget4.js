 if (!window.zmCore){(function(window){var document=window.document,navigator=window.navigator,console=window.console,localStorage=window.localStorage,zmCore=window.zmCore=function(selector,context){if(selector!=undefined){if(!(this instanceof zmCore)||context===undefined){return new zmCore(selector,"init")}zmCore.fn.init.call(this,selector,context);return this}return null};zmCore.prototype={size:function(){return this.length},bind:function(eventName,callback,weight){return fn.bind(this,eventName,callback,weight)},unbind:function(eventName,callback){for(var i=0,elem;elem=this[i];i++){var cached=zmCore.data(elem,"zmCore.events."+eventName);if(!cached){continue}var index,callbacks=cached.callbacks;for(var j=0,d;d=callbacks[j];j++){if(d.cb==callback){index=j;break}}index!==-1&&cached.callbacks.splice(index,1)}return this},unbindAll:function(eventName){for(var i=0,elem;elem=this[i];i++){var cached=zmCore.data(elem,"zmCore.events."+eventName);if(!cached){continue}if(elem.detachEvent){elem.detachEvent("on"+fn.mapEventName(eventName),cached.func)}else{if(elem.removeEventListener){elem.removeEventListener(fn.mapEventName(eventName),cached.func,false)}}zmCore.removeData(elem,"zmCore.events."+eventName)}return this},blur:function(callback,weight){return fn.bind(this,"blur",callback,weight)},click:function(callback,weight){return fn.bind(this,"click",callback,weight)},change:function(callback,weight){return fn.bind(this,"change",callback,weight)},dblclick:function(callback,weight){return fn.bind(this,"dblclick",callback,weight)},clickOutside:function(callback,weight,force,group){if(zmCore.isFunction(callback)){for(var i=0,e;e=this[i];i++){var g=zmCore.data(e,"clickoutside.group"),result;if(zmCore.isString(g)&&g.indexOf("zmcog.")!=0){g=null}result=fn.addCoCallback(e,group||g,callback,weight);if(!g){zmCore.data(e,"clickoutside.group",result)}}if(force){var newGroup=this.data("clickoutside.group");curClickGroups!=newGroup&&fn.fireCo(curClickGroups);curClickGroups=newGroup}fn.bindCo()}else{fn.fireCo(this[0])}return this},clickOutsideWith:function(elems){if(this.size()>0){var e=this[0],g=zmCore.data(e,"clickoutside.group");if(g){if(!zmCore.isArray(elems)&&!(elems instanceof zmCore)){elems=[elems]}for(var i=0,elem;elem=elems[i];i++){zmCore.data(elem,"clickoutside.group",g)}}}return this},focus:function(callback,weight){return fn.bind(this,"focus",callback,weight)},keydown:function(callback,weight){return fn.bind(this,"keydown",callback,weight)},keypress:function(callback,weight){return fn.bind(this,"keypress",callback,weight)},keyup:function(callback,weight){return fn.bind(this,"keyup",callback,weight)},mousedown:function(callback,weight){return fn.bind(this,"mousedown",callback,weight)},mouseup:function(callback,weight){return fn.bind(this,"mouseup",callback,weight)},mousemove:function(callback,weight){return fn.bind(this,"mousemove",callback,weight)},mouseenter:function(callback,weight){return fn.bind(this,"mouseenter",callback,weight)},mouseleave:function(callback,weight){return fn.bind(this,"mouseleave",callback,weight)},hover:function(enter,leave){return this.mouseenter(enter).mouseleave(leave)},mousewheel:function(callback,weight){if(zmCore.browser.firefox){return fn.bind(this,"DOMMouseScroll",callback,weight)}else{return fn.bind(this,"mousewheel",callback,weight)}},resize:function(callback,weight){return fn.bind(this,"resize",callback,weight)},scroll:function(callback,weight){return fn.bind(this,"scroll",callback,weight)},submit:function(callback,weight){return fn.bind(this,"submit",callback,weight)},reset:function(callback,weight){return fn.bind(this,"reset",callback,weight)},select:function(callback,weight){return fn.bind(this,"select",callback,weight)},hashchange:function(callback){var w=this[0];if("onhashchange" in window){return fn.bind(this,"hashchange",callback)}else{if(w&&w.location){hashValue=w.location.hash;oldURL=w.location.href;setInterval(function(){if(hashValue!=w.location.hash){hashValue=w.location.hash;var event={};event.timeStamp=new Date().getTime();event.srcElement=event.target=w;event.oldURL=oldURL;event.newURL=oldURL=w.location.href;callback(event)}},hashChangeInv)}return this}},each:function(callback){for(var i=0,elem;elem=this[i];i++){if(callback.call(elem,i,elem)==false){break}}},toArray:function(){var result=new Array();for(var i=0;i<this.size();i++){result.push(this[i])}return result},hasClass:function(className){return fn.hasClass(className,this[0])},addClass:function(className){if(className){for(var i=0,elem;elem=this[i];i++){var cl=elem.classList;if(cl){cl.add(className)}else{var classNames=elem.className;if(!classNames){elem.className=className}else{var classes=classNames.split(" "),skip=false,length=classes.length;for(var j=0;j<length;j++){if(classes[j]==className){skip=true;break}}if(!skip){classes.push(className)}elem.className=classes.join(" ")}}}}return this},removeClass:function(className){if(className){for(var i=0,elem;elem=this[i];i++){var cl=elem.classList;if(cl&&cl.length>0){cl.remove(className)}else{var classNames=elem.className;if(!classNames){continue}var classes=classNames.split(" "),skip=true,length=classes.length;for(var j=0;j<length;j++){if(classes[j]==className){classes.splice(j,1);skip=false;break}}if(!skip){elem.className=classes.join(" ")}}}}return this},attr:function(name,value){if(!zmCore.isString(name)){for(var k in name){this.attr(k,name[k])}return this}if(value==undefined){return fn.attr(this[0],name)}for(var i=0,elem;elem=this[i];i++){fn.attr(elem,name,value)}return this},css:function(name,value){if(!zmCore.isString(name)){for(var k in name){this.css(k,name[k])}return this}var length=this.length;if(length==0){return}if((zmCore.browser.msie&&zmCore.browser.version<9)||zmCore.browser.opera){name=fn.convertStyleName(name)}if(value!=undefined){for(var i=0;i<length;i++){fn.css(this[i],name,value,true)}return this}return fn.css(this[0],name)},val:function(value){var length=this.length;if(value==undefined){return length==0?undefined:this[0].value}for(var i=0;i<length;i++){this[i].value=value}return this},empty:function(){for(var i=0,elem;elem=this[i];i++){while(elem.firstChild){elem.removeChild(elem.firstChild)}}return this},html:function(content){var length=this.length;if(content==undefined){if(length==0){return}return this[0].innerHTML}try{for(var i=0;i<length;i++){this[i].innerHTML=fn.cleanHTML(content)}}catch(e){this.empty().append(content)}return this},text:function(content){var length=this.length;if(content==undefined){if(length==0){return}var elem=this[0];if(elem.textContent!=undefined){return elem.textContent}return elem.innerText}for(var i=0,e;e=this[i];i++){if(e.textContent!=undefined){e.textContent=content}else{e.innerText=content}}return this},before:function(content){var isStr=zmCore.isString(content);for(var i=0,e;e=this[i];i++){var p=e.parentNode;if(!isStr){p.insertBefore(content,e);continue}var d=zmCore.createElement("DIV");d.innerHTML=fn.cleanHTML(content);while(d.firstChild!=null){var c=d.firstChild;d.removeChild(c);p.insertBefore(c,e)}}return this},after:function(content){for(var i=0,e;e=this[i];i++){var c,p=e.parentNode,d=zmCore.createElement("DIV");d.innerHTML=fn.cleanHTML(content);if(p.lastChild==e){while(d.firstChild!=null){c=d.firstChild;d.removeChild(c);p.appendChild(c)}}else{var next=e.nextSibling;while(d.firstChild!=null){c=d.firstChild;d.removeChild(c);p.insertBefore(c,next)}}}return this},clone:function(){if(this.size()==0){return}return this[0].cloneNode(true)},append:function(content){if(this.size()==0){return this}var i,length=0,list;if(content instanceof zmCore){length=content.size();list=content}else{if(zmCore.isArray(content)){length=content.length;list=content}else{if(zmCore.isString(content)){list=new Array();var d=zmCore.createElement("DIV");d.innerHTML=fn.cleanHTML(content);while(d.firstChild!=null){var c=d.firstChild;list.push(c);d.removeChild(c)}length=list.length}else{length=this.size();for(i=0;i<length;i++){this[i].appendChild(content)}return this}}}var f=document.createDocumentFragment();for(i=0;i<length;i++){f.appendChild(list[i])}length=this.size();for(i=0;i<length;i++){this[i].appendChild(f.cloneNode(true))}return this},prepend:function(content){if(this.size()==0){return this}var i,length=0,list;if(content instanceof zmCore){length=content.size();list=content}else{if(zmCore.isArray(content)){length=content.length;list=content}else{if(zmCore.isString(content)){list=new Array();var d=zmCore.createElement("DIV");d.innerHTML=fn.cleanHTML(content);while(d.firstChild!=null){var c=d.firstChild;list.push(c);d.removeChild(c)}length=list.length}else{length=1;list=Array(1);list[0]=content}}}var f=document.createDocumentFragment();for(i=0;i<length;i++){f.appendChild(list[i])}var e;for(i=0;e=this[i];i++){if(e.hasChildNodes()){var fNode=e.firstChild;e.insertBefore(f.cloneNode(true),fNode)}else{e.appendChild(f.cloneNode(true))}}return this},remove:function(){for(var i=0,elem;elem=this[i];i++){zmCore.removeData(elem);elem.parentNode&&elem.parentNode.removeChild(elem)}},insertAtCaret:function(value){if(this.size()==0){return}var e=this[0];if(document.selection){e.focus();var sel=document.selection.createRange();sel.text=value;e.focus()}else{if(e.selectionStart||e.selectionStart=="0"){var startPos=e.selectionStart,endPos=e.selectionEnd,scrollTop=e.scrollTop,newValue=e.value.substring(0,startPos)+value,newPos=startPos+value.length;newValue+=e.value.substring(endPos,e.value.length);e.value=newValue;e.focus();e.selectionStart=newPos;e.selectionEnd=newPos;e.scrollTop=scrollTop}else{e.value+=value;e.focus()}}return this},offset:function(absPosition){if(this.size()==0){return}var o,v,e=this[0];if(e.getBoundingClientRect){o=e.getBoundingClientRect();var doc=e.ownerDocument,docElem=doc.documentElement||doc.body,left=o.left-(docElem.clientLeft||0),top=o.top-(docElem.clientTop||0);if(absPosition){v=zmCore.getViewport();return{left:left+v.offsetX,top:top+v.offsetY}}}else{o={left:e.offsetLeft,top:e.offsetTop};var op=o.offsetParent;while(op){o.left+=op.offsetLeft;o.top+=op.offsetTop;op=op.offsetParent}if(!absPosition){v=zmCore.getViewPort();o.left-=v.offsetX;o.top-=v.offsetY}}return{left:o.left,top:o.top}},position:function(){if(this.size()==0){return}return{left:this[0].offsetLeft,top:this[0].offsetTop}},top:function(){if(this.size()==0){return 0}return this.offset(true).top},left:function(){if(this.size()==0){return 0}return this.offset(true).left},innerWidth:function(){if(this.size()==0){return 0}var elem=this[0];return Math.max(0,elem.offsetWidth-zmCore.intval(fn.css(elem,"border-left-width"))-zmCore.intval(fn.css(elem,"border-right-width")))},outerWidth:function(margin){if(this.size()==0){return 0}var elem=this[0];if(margin){return Math.max(0,elem.offsetWidth+zmCore.intval(fn.css(elem,"margin-left"))+zmCore.intval(fn.css(elem,"margin-right")))}return Math.max(0,elem.offsetWidth)},width:function(){if(this.size()==0){return 0}var elem=this[0];return Math.max(0,this.innerWidth()-zmCore.intval(fn.css(elem,"padding-left"))-zmCore.intval(fn.css(elem,"padding-right")))},innerHeight:function(){if(this.size()==0){return 0}var elem=this[0];return Math.max(0,elem.offsetHeight-zmCore.intval(fn.css(elem,"border-top-width"))-zmCore.intval(fn.css(elem,"border-bottom-width")))},outerHeight:function(margin){if(this.size()==0){return 0}var elem=this[0];if(margin){return Math.max(0,elem.offsetHeight+zmCore.intval(fn.css(elem,"margin-top"))+zmCore.intval(fn.css(elem,"margin-bottom")))}return Math.max(0,elem.offsetHeight)},height:function(){if(this.size()==0){return 0}var elem=this[0];return Math.max(0,this.innerHeight()-zmCore.intval(fn.css(elem,"padding-top"))-zmCore.intval(fn.css(elem,"padding-bottom")))},opacity:function(value,max){var i,val,e;if(zmCore.browser.msie){for(i=0;e=this[i];i++){val=(zmCore.isArray(value)?value[i]:value);if(max&&val>max[i]){val=max[i]}val=val*100;if(e.filters["DXImageTransform.Microsoft.Alpha"]==undefined){if(value==""){e.style.removeAttribute("filter")}else{e.style.filter="progid:DXImageTransform.Microsoft.Alpha(opacity="+val+")"}}else{e.filters["DXImageTransform.Microsoft.Alpha"].Opacity=val}}}else{for(i=0;e=this[i];i++){val=zmCore.isArray(value)?value[i]:value;if(max&&val>max[i]){val=max[i]}e.style.opacity=val}}return this},fadeIn:function(duration,callback){return fn.fade(this,true,duration,callback)},fadeOut:function(duration,callback){return fn.fade(this,false,duration,callback)},stopFading:function(){return this.data("zmCore.fade",2)},show:function(effect,options){var i,length=this.size(),dur=zmCore.isNumber(options)?options:(options&&options.duration),cb=options&&options.callback;if(effect==="blur"){this.fadeIn(dur,cb)}else{if(effect==="roll"){return this.rollDown(dur,cb)}}for(i=0;i<length;i++){this[i].style.display="";var e=this[i];if(fn.css(e,"display")!="none"){continue}var oldDisplay=zmCore.data(e,"display");if(oldDisplay&&oldDisplay!="none"){this[i].style.display=oldDisplay;continue}var tagName=e.tagName.toUpperCase(),t=zmCore.createElement(tagName);document.body.appendChild(t);this[i].style.display=fn.css(t,"display");document.body.removeChild(t)}return this},hide:function(effect,options){var dur=zmCore.isNumber(options)?options:(options&&options.duration),cb=options&&options.callback;for(var i=0,e;e=this[i];i++){zmCore.data(e,"display",fn.css(e,"display"))}if(effect==="blur"){this.fadeOut(dur,cb)}else{if(effect==="roll"){this.rollUp(dur,cb)}else{this.css("display","none")}}return this},toggle:function(effect,options){for(var i=0,elem;elem=this[i];i++){if(fn.css(elem,"display")!="none"){zmCore(elem).hide(effect,options)}else{zmCore(elem).show(effect,options)}}return this},parents:function(selector){var result=new Array();if(this.size()==0){return}var p=this[0].parentNode;while(p){if(p.nodeType==1){result.push(p)}p=p.parentNode}return zmCore(zmCore.filter(result,selector))},parent:function(){if(this.size()==0){return}return zmCore(this[0].parentNode)},children:function(selector){if(this.size()==0){return}var result=new Array();for(var i=0,cn;(cn=this[0].childNodes[i])!=null;i++){if(cn.nodeType==1){result.push(cn)}}return zmCore(zmCore.filter(result,selector))},find:function(selector){var parents=new Array(),length=this.size();for(var i=0;i<length;i++){parents.push(this[i])}return zmCore(fn.findDOMElement(parents,selector))},filter:function(selector){return zmCore(zmCore.filter(this,selector))},get:function(param){var index;if(zmCore.isFunction(param)){index=param(this.size())}else{if(zmCore.isNumber(param)){index=param}}return this[index]?zmCore(this[index]):undefined},rollUp:function(duration,callback,options){return this.roll(zmCore.extend({duration:duration,callback:callback},options))},rollDown:function(duration,callback,options){return this.roll(zmCore.extend({display:1,duration:duration,callback:callback},options))},roll:function(options){if(this.size()<1){return this}if(!options){options={}}var cb=options.callback;if(this.data("zmCore.roll")!=1){this.data("zmCore.roll",1);var dir=options.direction,dsp=options.display,dur=options.duration||animation.settings.duration,bf=options.before,easing=(animation.step[options.easing]&&options.easing)||"sin";zmCore.isFunction(bf)&&bf.call(this);dsp&&this.show();var elem=this[0],ecss,zmElem=this,orgVal,parent=elem.parentNode,wrapper=zmCore.createElement("DIV",{},{overflow:"hidden"}),zw=zmCore(wrapper),width=this.outerWidth(),height=this.outerHeight();if(dir){orgVal=width;ecss="width";zw.css("height",height+"px")}else{orgVal=height;ecss="height";zw.css("width",width+"px")}zw.css(ecss,dsp?((options.start||0)+"px"):(orgVal+"px"));fn.copyCss(elem,wrapper,animation.css);this.css("margin","0px");parent.insertBefore(wrapper,elem);wrapper.appendChild(elem);var val=0,start=options.start||(dsp?0:orgVal),end=options.end||(dsp?orgVal:0),curTime=0,interval=animation.settings.interval,timer=setInterval(function(){curTime+=interval;val=animation.step[easing](start,end,dur,curTime);var cancel=false;if(val==-1){val=end;cancel=true}zw.css(ecss,val+"px");if(cancel){clearInterval(timer);zmElem.removeData("zmCore.roll").css("margin","");!dsp&&zmCore.intval(options.start)<=0&&zmElem.hide();parent.insertBefore(elem,wrapper);parent.removeChild(wrapper);wrapper=null;zmCore.isFunction(cb)&&cb.call(zmElem)}},interval)}else{zmCore.isFunction(cb)&&cb.call(zmElem)}return this},slideUp:function(duration,callback,options){this.slide(zmCore.extend({duration:duration,callback:callback,reverse:true},options))},slideDown:function(duration,callback,options){this.slide(zmCore.extend({duration:duration,callback:callback},options))},slide:function(options){if(this.size()<1){return this}if(!options){options={}}var cb=options.callback;if(this.data("zmCore.slide")!=1){this.data("zmCore.slide",1);var dir=options.direction,reverse=options.reverse,dur=options.duration||animation.settings.duration,bf=options.before,easing=(animation.step[options.easing]&&options.easing)||"sin";zmCore.isFunction(bf)&&bf.call(this);var ecss=dir?"margin-left":"margin-top",zmElem=this,val=0,start=options.start,end=options.end;if(!zmCore.isNumber(start)){start=zmCore.intval(zmElem.css(ecss))}if(!zmCore.isNumber(end)){end=this[dir?"outerWidth":"outerHeight"]();end=reverse?(start-end):(start+end)}var curTime=0,interval=animation.settings.interval,timer=setInterval(function(){curTime+=interval;val=animation.step[easing](start,end,dur,curTime);var cancel=false;if(val==-1){val=end;cancel=true}zmElem.css(ecss,val+"px");if(cancel){clearInterval(timer);zmElem.removeData("zmCore.slide");zmCore.isFunction(cb)&&cb.call(zmElem)}},interval)}else{zmCore.isFunction(cb)&&cb.call(zmElem)}return this},data:function(name,data){if(this.size()>0&&data==undefined){return zmCore.data(this[0],name)}for(var i=0,e;e=this[i];i++){if(zmCore.isFunction(data)){data.call(e,zmCore.data(e,name))}else{zmCore.data(e,name,data)}}return this},removeData:function(name){for(var i=0,e;e=this[i];i++){zmCore.removeData(e,name)}return this}};zmCore.extend=function(){var target=arguments[0]||{},length=arguments.length,deep=false,i=1,src,value;if(typeof target==="boolean"){deep=target;target=arguments[1]||{};i=2}for(;i<length;i++){for(var key in arguments[i]){src=target[key];value=arguments[i][key];if(src===value){continue}if(deep&&value){var clone=zmCore.isArray(src)?[]:{};zmCore.extend(deep,clone,value)}else{if(value!=undefined){target[key]=value}}}}return target};var scripts=new Array(),readyCallbacks=new Array(),jsonCallbacks={},zmId=0,zmGroupId=0,cache={},expandAttr="zmId"+new Date().getTime(),delExpandAttr=true,mouseenter=false,hoverIframe=false,windowData={},noData={embed:true,object:true,appled:true},convertAttrs={"class":"className","for":"htmlFor",readonly:"readOnly"},idleCallbacks,idleStatus=false,idleHandled=false,idleTimer,lastBusy=0,lastWndX,lastWndY,hashValue,oldURL,hashChangeInv=300,bindCo=false,curClickGroups=null,coCallbacks,escMap={"\b":"\\b","\t":"\\t","\n":"\\n","\f":"\\f","\r":"\\r",'"':'"'};var div=document.createElement("DIV");try{delete div.test;mouseenter=typeof div.onmouseenter!="undefined"}catch(ex){delExpandAttr=false}div=null;var animation={settings:{interval:10,duration:250},css:["position","top","left","right","bottom","float","display","margin","margin-top","margin-bottom","margin-left","margin-right","background"],step:{sin:function(start,end,duration,currentTime){if(currentTime>=duration){return -1}var t=(currentTime/duration)*(Math.PI/2);return Math.floor(start+(end-start)*Math.sin(t))},linear:function(start,end,duration,currentTime){if(currentTime>=duration){return -1}return Math.floor(start+(end-start)*(currentTime/duration))},log:function(start,end,duration,currentTime){if(currentTime>=duration){return -1}var t=(currentTime/duration)*Math.E+1;return Math.floor(start+(end-start)*Math.log(t))}}};zmCore.fn={init:function(selector,context){var elements,i;if(zmCore.isArray(selector)){elements=selector}else{if(zmCore.isString(selector)){elements=[document];var subs=selector.split(" "),sLength=subs.length;for(i=0;i<sLength;i++){elements=fn.findDOMElement(elements,subs[i]);if(elements.length==0){break}}}else{elements=[selector]}}var elemsLength=elements.length;if(zmCore.isArray(context)||context instanceof zmCore){i=0;while(i<elemsLength){if(zmCore.inArray(elements[i],context)==-1){elements.splice(i,1)}else{i++}}}elemsLength=elements.length;for(i=0;i<elemsLength;i++){this[i]=elements[i]}this.length=elemsLength},hasClass:function(className,e){className=zmCore.trim(className);if(!className||!e){return true}var cl=e.classList;if(cl){return cl.contains(className)}else{if((" "+e.className+" ").replace(/[\n\t]/g," ").indexOf(" "+className+" ")>-1){return true}}return false},checkClasses:function(classes,e){if(!classes||classes.length<1){return true}var r=0;for(var i=0,c;c=classes[i];i++){if(this.hasClass(c,e)){r++}}return r==classes.length},isSubElement:function(parents,e){if(zmCore.inArray(document,parents)!=-1){return true}var p=e.parentNode;while(p!=null){if(zmCore.inArray(p,parents)!=-1){return true}p=p.parentNode}return false},parseAttrStr:function(str){var result={};if(zmCore.isString(str)){var arr=str.split("]["),length=arr.length;for(var i=0;i<length;i++){var pair=arr[i].split("="),att=pair[0],value=pair[1],nindex=pair[0].indexOf("!"),not=false;if(value==undefined){value=true}typeof value=="string"&&zmCore.trim(value,"'\"");if(nindex==0||nindex==pair[0].length-1){att=nindex==0?pair[0].substr(1):pair[0].substr(0,nindex);not=true}result[att]={value:value,not:not}}}return result},checkAttributes:function(target,attrs){var valid=true;for(var f in attrs){if((fn.attr(target,f)==attrs[f].value)^!attrs[f].not){valid=false}}return valid},findDOMElement:function(parents,selector){var result=new Array(),i,plength=parents.length;if(document.querySelectorAll){for(i=0;i<plength;i++){var elems=parents[i].querySelectorAll(selector),elemsLength=elems.length;for(var j=0;j<elemsLength;j++){result.push(elems[j])}}}else{var found=new RegExp("(h[1-6]|[a-z]+)?(\\.[a-z0-9._-]+)?(#[a-z0-9_-]+)?(\\[(.*)\\])?","gi").exec(selector),e,attrs,tagName=found[1]?found[1].toLowerCase():"*",classes=found[2]?found[2].substr(1).split("."):undefined,id=found[3]?found[3].substr(1):undefined;if(found[5]){attrs=fn.parseAttrStr(found[5])}if(id!=undefined){e=document.getElementById(id);if(e&&(e.tagName.toLowerCase()==tagName||tagName=="*")&&fn.checkClasses(classes,e)&&fn.isSubElement(parents,e)){if(found[5]){if(fn.checkAttributes(e,attrs)){result.push(e)}}else{result.push(e)}}}else{for(j=0;j<plength;j++){elems=parents[j].getElementsByTagName(tagName);for(i=0;(e=elems[i])!=null;i++){if(fn.checkClasses(classes,e)&&fn.isSubElement([parents[j]],e)){if(found[5]){if(fn.checkAttributes(e,attrs)){result.push(e)}}else{result.push(e)}}}}}}return result},bind:function(elements,eventName,callback,weight){var i,e,orgEvt=eventName;eventName=fn.mapEventName(eventName);if(callback==undefined){if(eventName=="select"){this[0]&&this[0].select()}for(i=0;e=elements[i];i++){if(e[eventName]!=undefined){e[eventName]()}else{fn.fireEvent(e,eventName)}}}else{if(zmCore.isFunction(callback)){var self=elements;for(i=0;e=elements[i];i++){var element=((eventName=="scroll"||eventName=="resize")&&e==window)?document:e;var cached=zmCore.data(element,"zmCore.events."+eventName);if(!cached){cached={};cached.callbacks=new Array();cached.orgEvt=orgEvt;zmCore.data(element,"zmCore.events."+eventName,cached);cached.func=function(evt){var target,eventName=evt.type;if(window.event){evt=window.event;target=evt.srcElement}else{target=evt.target}if(!evt.stopPropagation){evt.stopPropagation=function(){this.cancelBubble=true}}if(!evt.preventDefault){evt.preventDefault=function(){this.returnValue=false}}if(eventName=="resize"){var v=zmCore.getViewport();if(v.width==lastWndX&&v.height==lastWndY){return false}lastWndX=v.width;lastWndY=v.height}var eventData=zmCore.data(element,"zmCore.events."+eventName),orgEvt=eventData.orgEvt,hoverEvt=(orgEvt=="mouseenter"||orgEvt=="mouseleave")&&!mouseenter;if(hoverEvt){var cancel=orgEvt=="mouseleave",e=evt.relatedTarget||(cancel?evt.toElement:evt.fromElement);if(e){if(zmCore.inArray(e,self)==-1){cancel=false;while(e!=null){if(zmCore.inArray(e,self)!=-1){cancel=true;break}try{e=e.parentNode}catch(ex){break}}}if(cancel){fn.cancelBubble(evt);return false}}while(zmCore.inArray(target,self)==-1){target=target.parentNode}}var callbacks,rs=true;if(eventData&&zmCore.isArray(eventData.callbacks)){callbacks=eventData.callbacks;for(var j=0,c;c=callbacks[j];j++){if(zmCore.isFunction(c.cb)&&c.cb.call(target,evt)==false){rs=false}if(evt.stopAllHandlers==true){break}}}!rs&&fn.cancelEvent(evt);return rs};if(e.attachEvent){e.attachEvent("on"+eventName,cached.func)}else{if(e.addEventListener){e.addEventListener(eventName,cached.func,false)}}}cached.callbacks.push({cb:callback,weight:weight});cached.callbacks.sort(fn.sortByWeight)}}}return elements},mapEventName:function(eventName){if(!mouseenter){switch(eventName){case"mouseenter":return"mouseover";case"mouseleave":return"mouseout"}}return eventName},cancelEvent:function(evt){evt.returnValue=false;if(evt.preventDefault){evt.preventDefault()}},cancelBubble:function(evt){if(evt.stopPropagation){evt.stopPropagation()}evt.cancelBubble=true;return false},fireEvent:function(element,eventName){var event;if(document.createEvent){event=document.createEvent("HTMLEvents");event.initEvent(eventName,true,true);return !element.dispatchEvent(event)}else{event=document.createEventObject();return element.fireEvent("on"+eventName,event)}},addScript:function(url,callback){var e=document.createElement("SCRIPT");e.setAttribute("type","text/javascript");e.setAttribute("src",url);e.setAttribute("charset","utf-8");e.setAttribute("defer","defer");e.setAttribute("async","async");document.getElementsByTagName("HEAD")[0].appendChild(e);if(callback!=undefined){if(zmCore.browser.opera&&parseFloat(zmCore.browser.version)<9.8){callback.call(window)}else{if(zmCore.browser.msie){var called=false;e.onreadystatechange=function(){if(this.readyState=="loaded"||this.readyState=="complete"){if(url==this.src&&!called){callback.call(window);called=true}}}}else{e.onload=callback}}}return e},loadScripts:function(){var addScript=fn.addScript;for(var i=0,s;s=scripts[i];i++){addScript(s.url,s.callback)}},sortByWeight:function(a,b){return zmCore.intval(a.weight)-zmCore.intval(b.weight)},createXHR:function(){if(!window.ActiveXObject){return new XMLHttpRequest()}return new ActiveXObject("Microsoft.XMLHTTP")},send:function(method,url,postData,options,success,error){var reqTimeout;options=zmCore.extend({dataType:"text"},options);var req=fn.createXHR();req.onreadystatechange=function(){if(req.readyState!=4){return}clearTimeout(reqTimeout);if(zmCore.isFunction(success)&&req.status==200){if(options.dataType=="json"){var data,hasError=false;try{data=zmCore.parseJSON(req.responseText)}catch(e){hasError=true;if(zmCore.isFunction(error)){error.call(req,req.responseText)}}!hasError&&success.call(req,data)}else{success.call(req,req.responseText)}}else{if(zmCore.isFunction(error)){error.call(req,req.responseText)}}};try{var params="";if(typeof postData=="object"){params=zmCore.param(postData)}else{if(postData){params=postData}}if(method=="GET"&&params){if(url.indexOf("?")<0){url+="?"}url+=params}req.open(method,url);if(options.timeout!=undefined){reqTimeout=setTimeout(function(){req.abort()},options.timeout)}if(method=="POST"){req.setRequestHeader("Content-Type","application/x-www-form-urlencoded");req.send(params)}else{req.send(null)}}catch(e){if(error!=undefined){error.call(req,e.message)}}},convertStyleName:function(name){return name.replace(/-[a-z]/gi,function(match){return match.charAt(1).toUpperCase()})},attr:function(element,name,value){if(!element||element.nodeType!=1){return}name=convertAttrs[name]||name;var special=/src|href/i.test(name),set=value!=undefined;if(name in element&&!special){if(set&&!(name=="type"&&/input|button/i.test(element.nodeName)&&element.parentNode)){element[name]=value}return element[name]}if(set){element.setAttribute(name,""+value)}var attr=special?element.getAttribute(name,2):element.getAttribute(name);return attr==null?undefined:attr},css:function(e,name,value,force){if(value==undefined){if(window.getComputedStyle){return window.getComputedStyle(e,null).getPropertyValue(name)}if(e.currentStyle){var val=e.currentStyle[name],style=e.style;if(!/\s/.test(val)&&!/^-?\d+(?:px)?$/i.test(val)&&/^-?\d/.test(val)){var left=style.left,rsLeft=e.runtimeStyle&&e.runtimeStyle.left;if(rsLeft){e.runtimeStyle.left=e.currentStyle.left}style.left=name==="fontSize"?"1em":(val||0);val=style.pixelLeft+"px";style.left=left;if(rsLeft){e.runtimeStyle.left=rsLeft}}return val}return e.style[name]}else{if(!force&&(zmCore.browser.msie||zmCore.browser.opera)){name=fn.convertStyleName(name)}e.style[fn.convertStyleName(name)]=value}},copyCss:function(src,dest,css){if(src.nodeType==dest.nodeType==1){var a=css;if(typeof css=="string"){a=[css]}for(var i=0,name;name=a[i];i++){var val=fn.css(src,name);if(val!=undefined&&val!=null){dest.style[fn.convertStyleName(name)]=val}}}},getOpacity:function(e){if(zmCore.browser.msie){if(e.filters["DXImageTransform.Microsoft.Alpha"]==undefined){return 100}return e.filters["DXImageTransform.Microsoft.Alpha"].Opacity/100}else{if(e.currentStyle){return e.currentStyle.opacity}if(window.getComputedStyle){return window.getComputedStyle(e,null).getPropertyValue("opacity")}return e.style.opacity}},cleanHTML:function(html){return zmCore.isString(html)?html.replace(/(<(?!area|base|br|col|embed|frame|hr|img|input|link|meta|param)([a-z]+)[^<]*)\/>/gi,"$1></$2>"):html},fill2:function(value){return value<10?("0"+value):value},initIdleHandler:function(){if(idleHandled){return}idleHandled=true;idleCallbacks=new Array();zmCore(document).mousemove(fn.hasAnAction).keydown(fn.hasAnAction)},idleTrigger:function(){idleStatus=true;var length=idleCallbacks.length;for(var i=0;i<length;i++){idleCallbacks[i].call(window,true)}},hasAnAction:function(){var now=(new Date()).getTime(),i;if(now-lastBusy<5000){return}if(!idleStatus){clearTimeout(idleTimer);if(now-lastBusy>=30000){for(i=0;i<idleCallbacks.length;i++){idleCallbacks[i].call(window,false)}}}else{idleStatus=false;for(i=0;i<idleCallbacks.length;i++){idleCallbacks[i].call(window,false)}}lastBusy=now;idleTimer=setTimeout(fn.idleTrigger,zmCore.idleTimeout)},bindCo:function(){if(!bindCo){zmCore(document).mouseup(function(){var parents=zmCore(this).parents(),fire=true,newGroup=null,i,j,p;parents["-1"]=this;for(i=-1;p=parents[i];i++){var group=zmCore.data(p,"clickoutside.group");if(!zmCore.isString(group)||group.indexOf("zmcog.")!=0){continue}if(group){newGroup=group}if(curClickGroups&&group==curClickGroups){for(j=-1;j<i;j++){zmCore.data(parents[j],"clickoutside.group",group)}fire=false;break}}if(fire&&coCallbacks&&coCallbacks[curClickGroups]){fn.fireCo(curClickGroups);if(newGroup){curClickGroups=newGroup}}if(newGroup&&!curClickGroups){curClickGroups=newGroup}},-99);if(zmCore.browser.msie){zmCore(document).bind("focusin",function(){if(this.nodeName.toLowerCase()=="iframe"){fn.fireCo(curClickGroups)}})}else{zmCore(window).blur(function(){if(hoverIframe){fn.fireCo(curClickGroups)}});zmCore(document).bind("mouseover",function(){if(this.nodeName.toLowerCase()=="iframe"){hoverIframe=true}}).bind("mouseout",function(){if(this.nodeName.toLowerCase()=="iframe"){hoverIframe=false}})}bindCo=true}},addCoCallback:function(elem,group,callback,weight){if(!coCallbacks){coCallbacks={}}if(!group){group="zmcog."+zmGroupId++}if(!coCallbacks[group]){coCallbacks[group]=new Array()}var added=false;for(var i=0,e;e=coCallbacks[i];i++){if(e.element==elem&&callback==e.callback){added=true;break}}!added&&coCallbacks[group].push({element:elem,callback:callback,weight:weight});coCallbacks[group].sort(fn.sortByWeight);return group},fireCo:function(elem){var group=(zmCore.isString(elem)&&elem)||zmCore.data(elem,"clickoutside.group"),cbs=coCallbacks[group];if(cbs){for(var i=0,c;c=cbs[i];i++){if(c.callback.call(c.element)==false){break}}}},escape:function(s){for(var k in escMap){s=s.replace(k,escMap[k])}return s},fade:function(elems,show,duration,callback){var s=zmCore.fadeSpeed||20,r=show?1:-1,cb=callback,op=show?0:1,d=200,maxOp=new Array();for(var i=0,e;e=elems[i];i++){var oop=zmCore.data(e,"opacity");if(oop==undefined||oop==null){oop=fn.getOpacity(e);zmCore.data(e,"opacity",oop)}maxOp.push(oop)}if(zmCore.isNumber(duration)){d=duration}else{cb=duration}elems.data("zmCore.fade",1).opacity(op);if(show&&elems.css("display")=="none"){elems.show()}var intv=setInterval(function(){if(elems.data("zmCore.fade")==2){elems.removeData("zmCore.fade");clearInterval(intv)}else{op+=r*s/d;elems.opacity(op,maxOp);if(show?op>=1:op<=0){!show&&elems.opacity(maxOp).hide();zmCore.isFunction(cb)&&cb.call(elems,show);clearInterval(intv)}}},s);return elems}};var fn=zmCore.fn;zmCore.version="1.53";zmCore.isReady=false;zmCore.idleTimeout=60000;zmCore.fadeSpeed=15;zmCore.hasStorage=typeof localStorage!=="undefined";zmCore.cookie=function(name,value,options){if(value==undefined){if(document.cookie){var cookies=document.cookie.split(";"),length=cookies.length,nameLength=name.length;for(var i=0;i<length;i++){var cookie=zmCore.trim(cookies[i]);if(cookie.substring(0,nameLength+1)==(name+"=")){value=decodeURIComponent(cookie.substring(nameLength+1));break}}}return value}var defOptions={expires:0,path:"/"};options=zmCore.extend(defOptions,options);var d=new Date(),expires=options.expires,dstr;if(expires==0){dstr=""}else{d.setTime(d.getTime()+expires*1000*60*60*24);dstr="; expires="+d.toUTCString()}document.cookie=name+"="+encodeURIComponent(value)+dstr+"; path="+options.path+(options.domain!=undefined?"; domain="+options.domain:"")+(options.secure?"; secure":"");return zmCore};zmCore.plugins={};zmCore.isInstalled=function(pluginName){return zmCore.plugins[pluginName]!=undefined};zmCore.install=function(pluginName,extFuncs,initCallback){if(zmCore.isInstalled(pluginName)){return false}zmCore.plugins[pluginName]={};for(var func in extFuncs){zmCore.prototype[func]=extFuncs[func]}if(zmCore.isFunction(initCallback)){initCallback()}return true};zmCore.intval=function(val){try{return parseInt(val)||0}catch(e){return 0}};zmCore.isArray=function(obj){if(typeof obj!="object"){return false}return Object.prototype.toString.call(obj).match(/array|nodelist/i)!=null};zmCore.isNumber=function(obj){return typeof obj=="number"};zmCore.isString=function(obj){if(typeof obj=="string"){return true}if(obj==undefined||obj==null){return false}if(typeof obj!="object"){return false}if(!obj.constructor){return false}return obj.constructor.toString().match(/string/i)!=null};zmCore.isFunction=function(obj){return typeof obj==="function"||Object.prototype.toString.call(obj).match(/function/i)!=null};zmCore.isEmpty=function(obj){return obj==undefined||obj==null||obj==""||zmCore.isEmptyObject(obj)};zmCore.isEmptyObject=function(obj){for(var key in obj){return false}return true};zmCore.inArray=function(target,list){var length=(list instanceof zmCore)?list.size():list.length;if(isNaN(length)){return -1}for(var i=0;i<length;i++){if(list[i]==target){return i}}return -1};zmCore.objectLength=function(obj){var length=0;for(var key in obj){length++}return length};zmCore.ltrim=function(s,chars){chars=chars||"\\s";return s&&s.replace(new RegExp("^["+chars+"]+","g"),"")};zmCore.rtrim=function(s,chars){chars=chars||"\\s";return s&&s.replace(new RegExp("["+chars+"]+$","g"),"")};zmCore.trim=function(s,chars){return zmCore.ltrim(zmCore.rtrim(s,chars),chars)};zmCore.detectLink=function(text,options){var attrs="",rdUrl=options.redirectUrl||"http://me.zing.vn/rd/go?url=";for(var attr in options){attrs+=" "+attr.toString()+'="'+options[attr]+'"'}return text.replace(/((https?|ftp):\/\/(([a-z0-9\$\-_\.+!\*'\(\),;\/\?&=]+)\:([a-z0-9\$\-_\.+!\*'\(\),;\/\?&=]+)\@)?([0-9]+|[a-z0-9]([a-z0-9|-]*[a-z0-9])?\.)*([0-9]+|[a-z]([a-z0-9|-]*[a-z0-9])?)(\:\d+)?((\/[a-z0-9\$\-_\.+!\*'\(\)\|,;\/\?\:\@&=%]*)+([;|?|#][a-z0-9\$\-_\.+!\*'\(\)\|,;\/\?\:\@&=%]*)?)?)/gi,function(m){return'<a href="'+rdUrl+encodeURIComponent(m)+'"'+attrs+">"+m+"</a>"})};zmCore.serialize=function(data){if(typeof JSON=="object"&&JSON.stringify){return JSON.stringify(data)}if(zmCore.isString(data)){return'"'+fn.escape(data)+'"'}var a;if(zmCore.isArray(data)){a=new Array();var length=data.length;for(var i=0;i<length;i++){a.push(zmCore.serialize(data[i]))}return"["+fn.escape(a.join(","))+"]"}if(typeof data=="object"){a=new Array();for(var f in data){a.push('"'+f+'":'+zmCore.serialize(data[f]))}return"{"+fn.escape(a.join(","))+"}"}if(data==undefined){return"undefined"}if(data==null){return"null"}return data.toString()};zmCore.param=function(params){var fields=new Array();for(var f in params){fields.push(encodeURIComponent(f)+"="+encodeURIComponent(params[f]))}return fields.join("&")};zmCore.parseJSON=function(s){if(typeof JSON=="object"&&JSON.parse){return JSON.parse(s)}return eval("("+s+")")};zmCore.formatDateTime=function(t){var e=[[11,"sÃ¡ng"],[14,"trÆ°a"],[19,"chiá»u"]],f=["Chá»§ Nháº­t","Thá»© Hai","Thá»© Ba","Thá»© TÆ°","Thá»© NÄƒm","Thá»© SÃ¡u","Thá»© Báº£y"],g=new Date(),j=new Date(t*1000),d=Math.floor(g.getTime()/1000)-t;if(d<60){return(d<0?0:d).toString()+" giÃ¢y trÆ°á»›c"}if(d<3600){return Math.floor(d/60)+" phÃºt trÆ°á»›c"}if(d<43200){return Math.floor(d/3600)+" tiáº¿ng trÆ°á»›c"}var h=j.getHours(),m=fn.fill2(j.getMinutes());if(d<518400){var b="tá»‘i";for(var i=0;i<3;i++){if(h<e[i][0]){b=e[i][1];break}}d=(g.getDay()+7-j.getDay())%7;var k="";if(d==0){k="hÃ´m nay"}else{if(d==1){k="hÃ´m qua"}else{k=f[j.getDay()]}}return(h%12).toString()+":"+m+" "+b+" "+k}h=fn.fill2(h);return h+":"+m+" "+fn.fill2(j.getDate())+"/"+fn.fill2(j.getMonth()+1)+"/"+j.getFullYear()};zmCore.get=function(url,options,success,error){var args=[].concat.apply(["GET"],arguments);args.splice(2,0,{});(zmCore.isFunction(options)||options==undefined)&&args.splice(3,0,{});fn.send.apply(this,args)};zmCore.post=function(url,data,options,success,error){var args=[].concat.apply(["POST"],arguments);(zmCore.isFunction(options)||options==undefined)&&args.splice(3,0,{});fn.send.apply(this,args)};zmCore.ajax=function(options){if(!options||!options.url){return}if(!options.method){options.method="GET"}fn.send(options.method,options.url,options.data,options,options.success,options.error)};zmCore.getJSON=function(url,data,success){var jsonName="js"+Math.floor(Math.random()*1000000),querystr="";if(zmCore.isFunction(data)){success=data}else{if(zmCore.isString(data)){querystr=data}else{querystr=zmCore.param(data)}}jsonCallbacks[jsonName]=success;zmCore[jsonName]=function(obj){var jscb=jsonCallbacks[jsonName];if(zmCore.isFunction(jscb)){jscb.call(zmCore,obj)}delete jsonCallbacks[jsonName];document.getElementsByTagName("HEAD")[0].removeChild(e)};var i=url.indexOf("=?");if(i==-1){i=url.indexOf("?");url+=(i==-1?"?":"&")+"callback=zmCore."+jsonName}else{url=url.substr(0,i)+"=zmCore."+jsonName+url.substr(i+14)}if(querystr){url+="&"+querystr}var e=document.createElement("SCRIPT");e.type="text/javascript";e.src=url;document.getElementsByTagName("HEAD")[0].appendChild(e)};zmCore.each=function(list,callback){var result,value;if(zmCore.isArray(list)||list instanceof zmCore){var length=(list instanceof zmCore)?list.size():list.length;for(var i=0;i<length;i++){value=list[i];result=callback.call(value,i,value);if(result===false){break}}}else{for(var field in list){value=list[field];result=callback.call(value,field,value);if(result===false){break}}}};zmCore.cache={};zmCore.data=function(element,name,data){if(!element||(element.nodeName&&noData[element.nodeName.toLowerCase()])){return}element=element==window?windowData:element;var expattr=expandAttr,id=element[expattr];if(!id&&typeof name=="string"&&data==undefined){return null}var cache=zmCore.cache;if(data!=undefined){if(!id){id=++zmId}if(!cache[id]){cache[id]={}}element[expattr]=id;if(typeof name=="string"){cache[id][name]=data}else{cache[id]=data}}return typeof name=="string"?cache[id][name]:cache[id]};zmCore.removeData=function(element,name){if(!element||(element.nodeName&&noData[element.nodeName.toLowerCase()])){return}element=element==window?windowData:element;var expattr=expandAttr,id=element[expattr];if(id==undefined){return}if(name){delete zmCore.cache[id][name];if(zmCore.isEmpty(zmCore.cache[id])){zmCore.removeData(element)}}else{if(delExpandAttr){delete element[expattr]}else{if(element.removeAttribute){element.removeAttribute(expattr)}}delete zmCore.cache[id]}};zmCore.createElement=function(tagName,attributes,css){var e=document.createElement(tagName),f;if(typeof attributes=="object"){for(f in attributes){if(f=="class"){e.className=attributes[f]}else{e.setAttribute(f,attributes[f])}}}if(typeof css=="object"){for(f in css){fn.css(e,f,css[f])}}return e};zmCore.addScript=function(url,callback){if(zmCore.isReady){fn.addScript(url,callback)}else{scripts.push({url:url,callback:callback})}return zmCore};zmCore.ready=function(callback,weight){var isReady=zmCore.isReady,callbacks=readyCallbacks;if(callback==undefined){if(isReady){return}zmCore.isReady=true;callbacks.sort(fn.sortByWeight);for(var i=0,c;c=callbacks[i];i++){try{c.callback.call(document)}catch(e){e=e.stack||e;zmCore.log(e)}}fn.loadScripts()}else{if(isReady){callback.call(document)}else{callbacks.push({callback:callback,weight:weight==undefined?0:weight})}}};zmCore.getViewport=function(){var result={},docElem=document.documentElement,body=document.body;if(window.innerWidth){result.width=window.innerWidth;result.height=window.innerHeight}else{if(docElem&&docElem.offsetWidth){result.width=docElem.offsetWidth;result.height=docElem.offsetHeight}else{result.width=body.offsetWidth;result.height=body.offsetHeight}}if(zmCore.isNumber(window.pageYOffset)){result.offsetY=window.pageYOffset;result.offsetX=window.pageXOffset}else{if(docElem&&(docElem.scrollLeft||docElem.scrollTop)){result.offsetY=docElem.scrollTop;result.offsetX=docElem.scrollLeft}else{if(body&&(zmCore.isNumber(body.scrollLeft))){result.offsetY=body.scrollTop;result.offsetX=body.scrollLeft}}}return result};zmCore.filter=function(elements,selector){if(!selector||elements.length==0){return elements}var tagName,classes,id,attrs,result=new Array(),found=new RegExp("(h[1-6]|[a-z]+)?(\\.[a-z0-9._-]+)?(#[a-z0-9_-]+)?(\\[(.*)\\])?","gi").exec(selector);if(found){tagName=found[1]?found[1].toLowerCase():tagName;classes=found[2]?found[2].substr(1).split("."):classes;id=found[3]?found[3].substr(1):id;attrs=fn.parseAttrStr(found[5])}for(var i=0,cn;cn=elements[i];i++){if(cn.nodeType==1){if((tagName&&cn.nodeName.toLowerCase()!=tagName)||(id&&cn.id!=id)||(classes&&!fn.checkClasses(classes,cn))||!fn.checkAttributes(cn,attrs)){continue}result.push(cn)}}return result};zmCore.idle=function(callback){fn.initIdleHandler();if(zmCore.isFunction(callback)){idleCallbacks.push(callback)}},zmCore.log=function(){if(typeof console!="undefined"){zmCore.isFunction(console.log)&&console.log.apply(console,arguments)}};zmCore.addStyle=function(text){var style=document.createElement("STYLE"),rules=document.createTextNode(text);style.type="text/css";if(style.styleSheet){style.styleSheet.cssText=rules.nodeValue}else{style.appendChild(rules)}document.getElementsByTagName("HEAD")[0].appendChild(style)};var ua=navigator.userAgent.toLowerCase(),m=ua.match(/(^|\s)(firefox|safari|opera|msie|chrome)[\/:\s]([\d\.]+)/)||["","","0.0"];zmCore.browser={opera:m[2]=="opera",msie:m[2]=="msie",safari:m[2]=="safari",chrome:m[2]=="chrome",firefox:m[2]=="firefox",mozilla:/mozilla/.test(ua),version:(ua.match(/\sversion\/([\d\.]+)/)||["",m[3]])[1]};zmCore.storage={put:function(key,item,exp,force){key="zmvar-"+key;if(exp==undefined){exp=0}if(exp!=0){exp=exp*1000}if(zmCore.hasStorage){if(exp!=0){exp+=(new Date()).getTime()}localStorage.setItem(key,zmCore.serialize({data:item,expires:exp}))}else{if(force){zmCore.cookie(key,zmCore.serialize(item),{expires:exp/(1000*60*60*24)})}}},get:function(key,force){key="zmvar-"+key;if(zmCore.hasStorage){var item=localStorage.getItem(key);if(item){var obj=zmCore.parseJSON(item);if(obj.expires==0||obj.expires>(new Date()).getTime()){return obj.data}localStorage.removeItem(key)}}else{if(force){return zmCore.parseJSON(zmCore.cookie(key))}}},remove:function(key){this.put(key,null,-1)}};if(zmCore.hasStorage){var now=(new Date()).getTime();try{for(var i=0,l=localStorage.length;i<l;i++){var key=localStorage.key(i),item=localStorage.getItem(key);if(item){try{var obj=zmCore.parseJSON(item);if(obj.expires!=0&&obj.expires<=now){localStorage.removeItem(key)}}catch(ex){}}}}catch(ex){}}if(window.zm==undefined){window.zm=zmCore;if(document.addEventListener){document.addEventListener("DOMContentLoaded",function(){document.removeEventListener("DOMContentLoaded",arguments.callee,false);zmCore.ready()},false)}else{if(document.attachEvent){document.attachEvent("onreadystatechange",function(){if(document.readyState=="complete"){document.detachEvent("onreadystatechange",arguments.callee);zmCore.ready()}});if(window==window.top&&document.documentElement.doScroll){(function(){if(zmCore.isReady){return}try{document.documentElement.doScroll("left")}catch(e){setTimeout(arguments.callee,0);return}zmCore.ready()})()}}}}})(window);}if (!window.zmXCall){var zmXCall=(function(window){var resizeCallbacks=new Array(),callbacks={},removeFlags={},html5=false,flash=false,scrollCallbacks=new Array(),scrollWnds=new Array();function serialize(data){if(typeof JSON=="object"&&JSON.stringify){return JSON.stringify(data)}if(data==undefined){return"undefined"}if(data==null){return"null"}try{if(typeof data=="string"||data.constructor.toString().match(/string/i)!=null){return'"'+data.replace(/"/g,'\\"')+'"'}}catch(e){}var a;if(Object.prototype.toString.call(data).match(/array/i)!=null){a=new Array();var length=data.length;for(var i=0;i<length;i++){a.push(serialize(data[i]))}return"["+a.join(",")+"]"}if(typeof data=="object"){a=new Array();for(var f in data){a.push('"'+f+'":'+serialize(data[f]))}return"{"+a.join(",")+"}"}return data.toString()}if(window.postMessage){html5=true;var onmessage=function(e){try{var data=eval("("+e.data+")")}catch(ex){return}if(data.xcallAction){switch(data.xcallAction){case"registerScrollHandler":var existed=false,wnd=e.source;for(var i=0;i<scrollWnds.length;i++){if(scrollWnds[i]==wnd){existed=true;break}}if(!existed){scrollWnds.push(e.source)}break;case"onScroll":for(var i=0;i<scrollCallbacks.length;i++){scrollCallbacks[i].call(window,data.xcallParams)}break;default:zmXCall.call(data.xcallAction,data.xcallParams,window,e.source);break}}};if(window.attachEvent){window.attachEvent("onmessage",onmessage)}else{window.addEventListener("message",onmessage,false)}if(typeof zm!="undefined"){zm(window).scroll(function(){if(scrollWnds.length==0){return}var msg=serialize({xcallAction:"onScroll",xcallParams:zmXCall.getTopSelf()});for(var i=0;i<scrollWnds.length;i++){scrollWnds[i].postMessage(msg,"*")}})}}var m=navigator.userAgent.toLowerCase().match(/(^|\s)(firefox|safari|opera|msie|chrome)[\/:\s]([\d\.]+)/)||["","","0.0"],msie=m[2]=="msie",opera=m[2]=="opera";if(!window.postMessage||msie){var flashUrl="http://static.me.zing.vn/swf/zmxcall-1.00.swf",playerId="zmxcall-obj",oAttrs={id:playerId,type:"application/x-shockwave-flash",width:"0",height:"0",data:flashUrl},oParams={movie:flashUrl,allowScriptAccess:"always"};if(msie&&!opera){oAttrs.classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"}if((!msie)||opera){var e=document.createElement("OBJECT");for(var attrName in oAttrs){e.setAttribute(attrName,oAttrs[attrName])}for(var attrName in oParams){var p=document.createElement("PARAM");p.setAttribute("name",attrName);p.setAttribute("value",oParams[attrName]);e.appendChild(p)}document.body.appendChild(e)}else{var html="<object ";for(var attrName in oAttrs){html+=attrName+'="'+oAttrs[attrName]+'" '}html+=">";for(var attrName in oParams){html+='<param name="'+attrName+'" value="'+oParams[attrName]+'">'}html+="</object>";setTimeout(function(){var e=document.getElementById("zmxcall-obj");if(!e){e=document.createElement("DIV");e.setAttribute("id","zmxcall-obj");document.body.appendChild(e)}e.outerHTML=html},200)}}return{DEFAULT_PROXY_VERSION:"1.00",DEFAULT_HOST:"me.zing.vn",version:"1.14",window:window,enableFlash:function(){flash=true},onresize:function(callback){if(callback){resizeCallbacks.push(callback)}else{for(var i=0;i<resizeCallbacks.length;i++){resizeCallbacks[i]()}}},getXCallID:function(){var fo=document.getElementById("zmxcall-obj");if(fo){return fo.getChannelID()}},register:function(name,callback,remove){callbacks[name]=callback;if(remove){removeFlags[name]=true}else{if(removeFlags[name]){delete removeFlags[name]}}},callByFlash:function(message){try{var o=eval("("+message+")");if(o.name){zmXCall.call(o.name,o.params,window)}}catch(e){}},call:function(name,params,wnd,source){if(!callbacks[name]){return}try{var rs=callbacks[name].call(wnd,params,source);if(rs){this.callParent(rs.callback,rs.params,rs.options,rs.window,true)}}catch(e){}if(removeFlags[name]){delete removeFlags[name];delete callbacks[name]}},callParent:function(funcName,params,options,wnd,postBack){if(!wnd){wnd=window}try{if(html5&&(wnd.parent==window||!postBack||window.opener==wnd)){if(!postBack&&window.opener!=wnd){wnd=wnd.parent}wnd.postMessage(serialize({xcallAction:funcName,xcallParams:params}),"*");return}}catch(e){}if(flash){var uri=window.location.href;var qs={};uri.replace(new RegExp("([^?=&]+)(=([^&]*))?","g"),function($0,$1,$2,$3){qs[$1]=$3});if(qs.zmxcid){var fo=document.getElementById("zmxcall-obj"),msg=serialize({name:funcName,params:params});fo.callParentViaFlash(qs.zmxcid,msg);return}}options=options||{};options.host=options.host||zmXCall.DEFAULT_HOST;options.version=options.version||zmXCall.DEFAULT_PROXY_VERSION;var ifid="xcall-if-"+Math.floor(Math.random()*100),url="http://"+options.host+"/xcall.proxy-"+options.version+".html#"+encodeURIComponent(funcName+","+serialize(params)),tried=0;function doCall(){var e=wnd.document.createElement("IFRAME");e.style.visibility="hidden";e.style.display="none";e.width="0";e.height="0";e.src=url;e.id=ifid;try{wnd.document.body.appendChild(e)}catch(e){tried++;if(tried<3){setTimeout(doCall,200)}return}setTimeout(function(){try{var e=wnd.document.getElementById(ifid);wnd.document.body.removeChild(e)}catch(e){}},10000)}doCall()},resizeParent:function(params,options){if(typeof params=="string"||params.constructor.toString().match(/string/i)!=null){params={id:params}}if(!params.height){var D=document;params.height=Math.max(Math.max(D.body.scrollHeight,D.documentElement.scrollHeight),Math.max(D.body.offsetHeight,D.documentElement.offsetHeight),Math.max(D.body.clientHeight,D.documentElement.clientHeight))}this.callParent("resize",params,options)},setHashParent:function(hash,options){this.callParent("setHash",hash,options)},getTop:function(callback,options){var cbname="getTop"+Math.floor(Math.random()*100);this.register(cbname,callback,true);var params={host:window.location.host,cb:cbname};this.callParent("getTop",params,options)},getTopSelf:function(){var top,height,wnd=zmXCall.window,B=wnd.document.body,D=wnd.document.documentElement;if(typeof wnd.pageYOffset!="undefined"){top=wnd.pageYOffset}else{top=((D&&D.scrollTop)?D:B).scrollTop}if(typeof wnd.innerHeight!="undefined"){height=wnd.innerHeight}else{height=((D&&D.clientHeight)?D:B).clientHeight}return{top:top,height:height,docHeight:Math.max(0,document.body.offsetHeight)}},getViewport:function(callback,options){var cbname="getViewport"+Math.floor(Math.random()*100);this.register(cbname,callback,true);var params={host:window.location.host,cb:cbname};this.callParent("getViewport",params,options)},getViewportSelf:function(){var result={},wnd=zmXCall.window,docElem=wnd.document.documentElement,body=wnd.document.body;if(window.innerWidth){result.width=window.innerWidth;result.height=window.innerHeight}else{if(docElem&&docElem.offsetWidth){result.width=docElem.offsetWidth;result.height=docElem.offsetHeight}else{result.width=body.offsetWidth;result.height=body.offsetHeight}}if(typeof window.pageYOffset=="number"){result.offsetY=window.pageYOffset;result.offsetX=window.pageXOffset}else{if(docElem&&(docElem.scrollLeft||docElem.scrollTop)){result.offsetY=docElem.scrollTop;result.offsetX=docElem.scrollLeft}else{if(body&&(typeof body.scrollLeft=="number")){result.offsetY=body.scrollTop;result.offsetX=body.scrollLeft}}}return result},addScrollHook:function(cb){if(!html5){return}scrollCallbacks.push(cb);window.parent.postMessage('{xcallAction:"registerScrollHandler"}',"*")},openFullFrame:function(params,options){this.callParent("openFullFrame",params,options)},closeFullFrame:function(params,options){this.callParent("closeFullFrame",params,options)},openBoxy:function(title,url,width,height,options,proxyOptions){this.callParent("openBoxy",zm.extend({title:title,url:url,width:width,height:height},options),proxyOptions)},closeBoxy:function(options){this.callParent("closeBoxy",null,options)}}})(window);zmXCall.register("resize",function(a){if(!a.height){return}var b=zm(a.id?"#"+a.id:document);b.css("height",a.height+"px");zmXCall.onresize()});zmXCall.register("getTop",function(d,c){var a=zmXCall.getTopSelf(),b={host:d.host};b.version=d.version||zmXCall.DEFAULT_PROXY_VERSION;return{callback:d.cb,params:a,options:b,window:c||this}});zmXCall.register("setHash",function(a){window.location.hash=a});zmXCall.register("getViewport",function(c,b){var a={host:c.host,version:c.version||zmXCall.DEFAULT_PROXY_VERSION};return{callback:c.cb,params:zmXCall.getViewportSelf(),options:a,window:b||this}});zmXCall.register("openFullFrame",function(d){var m=d.headerSize?d.headerSize:33,i=zm("#header"),q=zm("#fullsized-frame"),a=zm.getViewport(),o,c=a.width-zm(document.body).width(),s=function(){if(zm.browser.msie&&zm.browser.version<"7"){a=zm.getViewport();q=zm("#fullsized-frame");q.css("height",(a.height-m)+"px");var e=zm(q.children()[1]).height();if(e+2<a.height-m){e=a.height-m}else{e+=2}zm(q.children()[0]).css("height",e+"px");zm("#fullsized-closebtn").css("left",(a.width-32)+"px")}},n=function(f){if(f.keyCode==27){zm("#fullsized-closebtn").click()}};if(i.css("position")=="fixed"){m=i.outerHeight()}else{if(i.size()>0){m=0}}if(zm.browser.msie&&zm.browser.version<"8"){c=0;o=document.createElement("STYLE");o.setAttribute("type","text/css");o.styleSheet.cssText="html {overflow: hidden} #fullsized-frame{overflow-y: auto !important}";document.getElementsByTagName("head")[0].appendChild(o)}else{zm(document.body).css({"margin-right":c+"px",overflow:"hidden"})}if(q.size()==0){var g=parseInt(d.height?d.height:500),r=d.width?d.width:980,l=zm.createElement("DIV",{id:"fullsized-frame"},{left:"0",width:"100%"}),k=zm.createElement("DIV",{},{position:"relative",border:"1px #000 solid",width:r+"px",height:g+"px",margin:"auto"}),j=zm.createElement("IFRAME",{src:d.url,border:0},{border:"0px none",height:g+"px",width:r+"px"}),p=zm.createElement("DIV",{id:"fullsized-closebtn",title:"Đóng"},{cursor:"pointer",top:"7px",left:(a.width-42)+"px",width:"20px",height:"20px",position:"fixed",zIndex:899,background:"transparent url(http://stc.ugc.zdn.vn/photo_v4/zme/images/imgsprtpho_1.06.gif) 0 -149px no-repeat"});if(d.onload){j.onload=d.onload}k.appendChild(j);l.appendChild(k);if(zm.browser.msie&&zm.browser.version<"7"){zm(l).css({height:(a.height-m)+"px",position:"absolute",top:(a.offsetY+m)+"px",width:"100%"})}else{zm(l).css({position:"fixed",top:m+"px",bottom:0})}var b={"z-index":700,"background-color":"#fff"};if(m==0){b.top="33px"}zm(k).css(b);document.body.appendChild(l);q=zm(l);q.css({"z-index":699,"overflow-x":"hidden","overflow-y":"auto"});if(zm.browser.msie&&zm.browser.version<"9"){q.css("filter","progid:DXImageTransform.Microsoft.gradient(startColorstr=#B2000000, endColorstr=#B2000000)")}else{q.css("background-color","rgba(0, 0, 0, 0.7)")}q.click(function(){if(this.id=="fullsized-frame"){zm("#fullsized-closebtn").click()}});zm(window).bind("resize",s);document.body.appendChild(p);zm(document).keydown(n);zm(p).click(function(){zm(window).unbind("resize",s);zm(document).unbind("keydown",n);zm("#fullsized-closebtn").remove();zm("#fullsized-frame").remove();zm(document.body).css({"margin-right":"auto",overflow:"auto"});if(zm.browser.msie&&zm.browser.version<"8"){zm(o).remove()}typeof zmChat!="undefined"&&zmChat.displayTicker("revert");if(typeof d.onclose=="function"){d.onclose()}});typeof zmChat!="undefined"&&zmChat.displayTicker(false)}else{zm("#fullsized-frame iframe").bind("load",d.onload)}q.show()});zmXCall.register("resizeFullFrame",function(b){for(var a in b){if(a!="width"&&a!="height"){delete b[a]}else{b[a]+="px"}}if(zm.objectLength(b)==0){return}zm("#fullsized-frame").children().css(b);zm("#fullsized-frame iframe").css(b)});zmXCall.register("closeFullFrame",function(){zm("#fullsized-closebtn").click()});zmXCall.register("openBoxy",function(b){if(!zmXCall.boxy){zmXCall.boxy=new zm.Boxy({title:"",content:'<iframe id="xcallBoxyFrame" frameborder="0"></iframe>',footer:false})}b.footer=!!b.okButton;zmXCall.boxy.changeSettings(b);var a=zm("#xcallBoxyFrame");b.url&&a.attr("src",b.url);if(!a.attr("src")){return}b.width&&a.css("width",b.width+"px");b.height&&a.css("height",b.height+"px");if(!zmXCall.boxy.isShowing()){zmXCall.boxy.show()}else{zmXCall.boxy.center()}});zmXCall.register("closeBoxy",function(){zmXCall.boxy&&zmXCall.boxy.hide()});}if (!window.zm.plugins.boxy ){zm.install("emotions",{renderEmotions:function(){for(var b=0;b<this.size();b++){var a=zm(this[b]).html();a=zm.renderEmotions(a);zm(this[b]).html(a)}return this},attachEmoButtons:function(e,b){if(!zm.plugins.emotions.initialized){zm.plugins.emotions.init();zm.plugins.emotions.initialized=true}function a(g){var i=zm(g),m=zm.getViewport(),k=zm("#zm-emo-list");if(b&&zm.isFunction(b.position)){b.position.call(k,i)}else{var f=i.offset(true),p=f.top+i.outerHeight(),h=f.left,n=k.outerWidth(),j=k.outerHeight();if(f.left+n>m.offsetX+m.width){h-=(n-i.outerWidth())}k.css("left",h+"px");if(f.top+i.outerHeight()+j>m.offsetY+m.height){p-=(25+j)}k.css("top",p+"px")}}for(var d=0;d<this.size();d++){if(!zm.data(this[d],"emotions.attached")){b&&zm.data(zm("#"+(e||"")+this[d].getAttribute("rel").substr(4))[0],"emotions.options",b);zm(this[d]).mousedown(function(){var h=this,i=zm("#zm-emo-list");zm.plugins.emotions.button=h;var f=h.getAttribute("rel"),g=zm("#"+(e||"")+(f&&f.substr(4)))[0];if(!g||g.disabled){return true}if(zm.plugins.emotions.currentEditor===null||zm.plugins.emotions.currentEditor!=g){zm.plugins.emotions.show=false}zm.plugins.emotions.currentEditor=g;if(zm.plugins.emotions.show){zm.plugins.emotions.show=false;i.hide()}else{zm.plugins.emotions.show=true;i.show();a(h)}return true}).mouseup(function(){var f=this;setTimeout(function(){zm(f).clickOutsideWith(zm("#zm-emo-list"))},200)},-1).blur(function(){if(!zm.plugins.emotions.enterEmoList){if(zm.plugins.emotions.button==this){zm.plugins.emotions.show=false;zm("#zm-emo-list").hide();zm.plugins.emotions.currentEditor=null}}}).attr("tabIndex",0);var c=this[d];if(b){b.windowScroll&&zm(window).scroll(function(){a(c)});b.windowResize&&zm(window).resize(function(){a(c)})}zm.data(this[d],"emotions.attached",true)}}}},function(){zm.plugins.emotions.init=function(){var b,a=[":)",":~",":B",":|","8-)",":-((",":$",":X",":Z",":((",":-|",":-H",":P",":D",":o",":(",":+","--B",":Q",":T",";P",";-D",";D",";O",";G","|-)",":!",":L",":>",":;",";F",";-S",";?",";-X",":-F",";8",";!",";-!",";XX",":-BYE",":WIPE",":-DIG",":handclap","&-(","B-)",":-L",":-R",":-O",">-|","P-(",":--|","X-)",":*",";-A","8*","/-showlove","/-rose","/-fade","/-heart","/-break","/-coffee","/-cake","/-li","/-bome","/-bd","/-shit","/-strong","/-weak","/-share","/-v","/-thanks","/-jj","/-punch","/-bad","/-loveu","/-no","/-ok","/-flag","/-z"],d=new Array();for(b=0;b<a.length;b++){d.push(a[b].replace(/[-[\]{}()*+?.,\\^$|#\s]/g,"\\$&").replace(/&/g,"&amp;").replace(/</g,"&lt;").replace(/>/g,"&gt;"))}var c=new Array();for(b=0;b<a.length;b++){c.push({orgCode:a[b],code:d[b],src:'<img src="http://'+(zm.config!=undefined?zm.config.hostImage:"static.me.zing.vn")+"/images/smilley/default/"+(b+1).toString()+'.jpg" />'})}zm.plugins.emotions.data=c;zm.plugins.emotions.clickHandlersFor=[];zm.plugins.emotions.enterEmoList=false;zm.ready(function(){var g,e=zm.createElement("DIV",{id:"zm-emo-list"},{display:"none"}),h=zm.plugins.emotions.data;for(g=0;g<h.length;g++){var f=zm.createElement("SPAN",{title:h[g].orgCode});zm(f).html(h[g].src).click(function(){setTimeout("zm('#zm-emo-list').hide();",100);zm.plugins.emotions.show=false;var l=zm.plugins.emotions.currentEditor;if(l!=null){var n=this,i;if(n.tagName=="IMG"){i=n.src;n=zm(n).parents()[0]}zm.plugins.emotions.showingEmots=false;try{var j=zm(l),r=zm.data(l,"emotions.options");if(j.css("display")!="none"||r.force){var q=r&&r.insert,k=zm(n),o=k.attr("title");if(!i){i=k.children().attr("src")}if(zm.isFunction(q)){q.call(l,o,i)}else{var p=r&&r.beforeInsert,m=true;if(zm.isFunction(p)){m=p.call(l,o,i)}m!==false&&j.insertAtCaret(o)}}}catch(n){}zm.plugins.emotions.currentEditor=null}}).mouseenter(function(){zm.plugins.emotions.enterEmoList=true}).mouseleave(function(){zm.plugins.emotions.enterEmoList=false});e.appendChild(f)}document.body.appendChild(e)})};zm.extend(zmCore,{renderEmotions:function(f,c){if(!zm.plugins.emotions.initialized){zm.plugins.emotions.init();zm.plugins.emotions.initialized=true}var g=zm.plugins.emotions.data,a=c&&c.preventEntities||false,e=c&&c.preventLink||false;for(var b=0,h;h=g[b];b++){if(a||e){f=f.replace(new RegExp("(\\S*)("+h.code+")","gi"),function(j,i,d){if((a&&/&amp|&lt|&gt/.test(i)&&d.indexOf(";")==0)||(e&&/http:\/\/.*/.test(i))){return j}else{return i+h.src}})}else{f=f.replace(new RegExp(h.code,"gi"),h.src)}}return f}})});zm.install("autoresize",{autoResize:function(b){if(!zm.plugins.autoresize.initialized){zm.plugins.autoresize.init();zm.plugins.autoresize.initialized=true}for(var c=0,d;d=this[c];c++){if(!zm.data(d,"autoresize.height")){zm.data(d,"autoresize.height",zm(d).height())}}var a=function(){zm.plugins.autoresize.resizing=this;if(zm.plugins.autoresize.timer){clearTimeout(zm.plugins.autoresize.timer)}zm.plugins.autoresize.timer=setTimeout(function(){var l=zm.plugins.autoresize.resizing;if(zm.data(l,"autoresize.stop")){return}var s=zm(l),p=s.width();if(p<=0){return}var f,r=zm.plugins.autoresize.styles,m=zm("#zmjs-text-resize"),n=zm.data(l,"autoresize.height"),q=s.val()+"&";for(f=0;f<r.length;f++){m.css(r[f],s.css(r[f]))}m.css("width",p+"px");var o=zm.data(l,"autoresize.lineheight");if(!o){m.text("&");o=m.height();zm.data(l,"autoresize.lineheight",o)}if(zm.browser.msie&&zm.browser.version>8){m[0].innerText=q}else{m.text(q)}var g=m.height();if(g<=n){g=n}else{g+=o}var k;if(b&&zm.isFunction(b.onresize)){var j=s.height();if(g!=j){k=b.onresize.call(l,g,j)}}k!==false&&s.css("height",g+"px")},50)};this.change(a).keydown(a).keyup(a).focus(a);return this}},function(){zm.plugins.autoresize.init=function(){var a=["font-family","font-size","font-weight","line-height","text-decoration","letter-spacing","word-spacing","text-indent"];zm.plugins.autoresize.styles=a;zm.ready(function(){var b=zm.createElement("DIV",{id:"zmjs-text-resize"},{padding:0,margin:0,border:0,wordWrap:"break-word",position:"absolute",left:"-9999px",top:"-9999px"});if(zm.browser.msie&&zm.browser.version<9){zm(b).css("_whiteSpace","pre-wrap")}else{zm(b).css("whiteSpace","pre-wrap")}document.body.appendChild(b)})}});zm.install("boxy",{},function(){zm.plugins.boxy.defOptions={noTitle:false,title:"",content:"",closeButton:true,footer:true,modal:true,okButton:"Äá»“ng Ã½",cancelButton:"",center:true,animated:true,scroll:true,revert:false};zm.plugins.boxy.zIndex=1001;zm.plugins.boxy.instances=new Array();zm.Boxy=function(t){var w,E,F,A,D,f,n,o,O,i,C,P=zm.extend({},zm.plugins.boxy.defOptions,t),j=this,T=false,e=null,z=null,g=false,L,J,d,c,H,G;p();y(P.zIndex);P.isTop&&k();zm.plugins.boxy.instances.push(this);function p(){var Y=zm.createElement("DIV",{"class":"zme-boxy"}),W=zm.createElement("DIV",{"class":"zme-boxy-wrapper"+(P.modal?" zme-boxy-modal":"")},{display:"none"}),X=P.contentClass?(" "+P.contentClass):"",V=P.titleClass?(" "+P.titleClass):"";D=zm.createElement("DIV",{"class":"zme-boxy-body"});F=zm.createElement("DIV",{"class":"zme-boxy-container"+X});A=zm.createElement("DIV",{"class":"zme-boxy-title"+V});n=zm.createElement("DIV",{"class":"zme-boxy-content"});u(P.title);K(P.header);h(P.content);F.appendChild(A);D.appendChild(n);if(P.footer){o=zm.createElement("DIV",{"class":"zme-boxy-footer"});D.appendChild(o);P.okButton&&q();P.cancelButton&&v()}F.appendChild(D);Y.appendChild(F);W.appendChild(Y);document.body.appendChild(W);P.closeButton&&R();!(zm.browser.msie&&zm.browser.version<7)&&N();w=zm(Y);E=zm(W);w.keydown(function(Z){if(Z.keyCode==27){j.close(false,true)}})}function q(){if(o){O=zm.createElement("A",{"class":"btn_L3",tabIndex:"0",href:"#"});r(0);zm(O).click(function(){j.close(true);return false}).html("<em>"+P.okButton+"</em>");o.appendChild(O)}}function v(){if(o){i=zm.createElement("A",{"class":"btn_L5",tabIndex:"0",href:"#"});r(1);zm(i).click(function(){j.close(false);return false}).html("<em>"+P.cancelButton+"</em>");P.revert?o.insertBefore(i,O):o.appendChild(i)}}function R(){C=zm.createElement("A",{"class":"zme-boxy-close",href:"#"});r(2);F.appendChild(C);zm(C).click(function(){j.close("close");return false})}function r(X){var V="",W;if(X==0){if(P.okClass){V=P.okClass}else{V="btn_L3"}W=O}else{if(X==1){if(P.cancelClass){V=P.cancelClass}else{V="btn_L5"}W=i}else{if(X==2){if(P.closeClass){V=P.closeClass}else{V="zme-boxy-close"}W=C}}}W&&zm(W).attr("class",V)}function N(){zm(A).mousedown(U);zm.browser.msie&&zm(A).bind("selectstart",function(){return false});zm(document).mousemove(x).mouseup(B);this.moved=false}function k(V){if(V!=undefined){P.isTop=V}if(P.isTop){if(!j.stopOutside){j.stopOutside=function(W){B();P.isTop&&W.stopPropagation()};w.mouseup(j.stopOutside)}}else{j.stopOutside&&w.unbind("mouseup",j.stopOutside)}}function u(V){if(V){P.title=V}if(P.title){zm(A).html(P.title).show()}else{zm(A).hide()}}function K(V){if(V){P.header=V}if(!f&&!P.header){return}if(P.header){if(!f){f=zm.createElement("DIV",{"class":"zme-boxy-header"});zm(f).html(P.header);zm(D).prepend(f)}else{zm(f).html(P.header).show()}}else{if(f){zm(f).hide()}}}function h(V){if(V){P.content=V}if(n&&P.content){var W=P.content;if(zm.isString(W)){zm(n).html(W)}else{zm(n).html("").append(W)}}}function S(){if(P.footer){if(!o){o=zm.createElement("DIV",{"class":"zme-boxy-footer"});D.appendChild(o)}else{zm(o).show()}}else{o&&zm(o).hide()}}function Q(){if(P.okButton){O?zm(O).html("<em>"+P.okButton+"</em>").show():q()}else{if(P.okButton===false&&O){zm(O).hide()}}}function M(){if(P.cancelButton){i?zm(i).html("<em>"+P.cancelButton+"</em>").show():v()}else{if(P.cancelButton===false&&i){zm(i).hide()}}}function m(){if(P.closeButton){C?zm(C).show():R()}else{C&&zm(C).hide()}}function y(V){if(V&&typeof V=="number"){P.zIndex=V}P.zIndex&&E.css("z-index",zm.plugins.boxy.zIndex+P.zIndex)}function l(){E[P.modal?"addClass":"removeClass"]("zme-boxy-modal")}function s(){if(A&&zm.isString(P.titleClass)){zm(A).attr("class","zme-boxy-title "+P.titleClass)}var V=P.contentClass;if(zm.isString(V)){zm(F).attr("class","zme-boxy-container "+V)}if(zm.isString(P.okClass)){r(0)}if(zm.isString(P.cancelClass)){r(1)}if(zm.isString(P.closeClass)){r(2)}}function I(){zm.isFunction(P.beforeShow)&&P.beforeShow.call(j);E.show();T=true;j.locate();if(P.okButton&&P.autoFocus!=false){O&&zm(O).focus()}}function U(W){g=true;var X=zm(this).offset(true);L=X.left;J=X.top;var V=zm.Boxy.mousePosition(W);d=V.left;c=V.top;return false}function x(X){if(g){j.moved=true;var V=zm.Boxy.mousePosition(X),W=zm.getViewport();if(zm.browser.msie){H=V.left-d+L-8-W.offsetX;G=V.top-c+J-8-W.offsetY}else{H=V.left-d+L-W.offsetX-8;G=V.top-c+J-W.offsetY-8}j.moveTo(H,G,false)}}function B(){g=false;j.moved=false}this.centerX=function(){var W,V=w.outerWidth(),X=zm.getViewport();W=Math.round((X.width-V)/2);if(zm.isNumber(P.offsetLeft)){W+=P.offsetLeft}w.css("left",(W<0?"0":W)+"px")};this.centerY=function(){var W,X=w.outerHeight(),V=zm.getViewport();if(e==null){e=V.height}W=Math.round((e-X)/2);if(z!=null){W+=z-P.iframeTopOffset}if(zm.isNumber(P.offsetTop)){W+=P.offsetTop}w.css("top",(W<0?"0":W)+"px");e=null};this.center=function(){this.centerX();this.centerY()};this.locate=function(){if(this.moved){return}if(zm.isFunction(P.setPosition)){P.setPosition.call(this)}else{P.center&&this.center()}};this.moveTo=function(V,X,W){this.moveToX(V,W);this.moveToY(X,W)};this.moveToX=function(V,W){if(V!=undefined){if(V=="center"){this.centerX()}else{w.css("left",V+"px")}}};this.moveToY=function(W,V){if(W!=undefined){if(W=="center"){this.centerY()}else{if(z!=null&&V!=false){W+=z-P.iframeTopOffset}w.css("top",W+"px")}}};this.show=function(){if(T){return}if(typeof zmXCall!="undefined"&&typeof P.iframeTopOffset=="number"){zmXCall.getTop(function(V){e=V.height;z=V.top;I()})}else{e=z=null;I()}};this.hide=function(V){if(!T){return}zm.isFunction(P.beforeHide)&&P.beforeHide();var W=P.afterHide;if(V!==false&&P.animated){if(zm.browser.msie){E.hide();zm.isFunction(W)&&W()}else{E.fadeOut(120,W)}}else{E.hide();zm.isFunction(W)&&W()}T=false;if(this==zm.plugins.boxy.alertInstance&&zm.plugins.boxy.alertTimeout){clearTimeout(zm.plugins.boxy.alertTimeout)}};this.isShowing=function(){return T};this.getElement=function(){return w[0]};this.setTitle=function(V){u(V);return this};this.setHeader=function(V){K(V);return this};this.setContent=function(V){h(V);this.locate();return this};this.close=function(W){var V=true;if(W==="close"){zm.isFunction(P.onClose)&&P.onClose.call(this)}else{if(W){if(zm.isFunction(P.onOk)){V=P.onOk.call(this)}}else{if(zm.isFunction(P.onCancel)){V=P.onCancel.call(this)}}}V!==false&&this.hide()};this.changeSettings=function(V){if(!V){return}if(!P){P=zm.plugins.boxy.defOptions}P=zm.extend(P,V);zm.isString(V.title)&&u();zm.isString(V.header)&&K();zm.isString(V.content)&&h();l();S();Q();M();m();y();k();s()};this.getSettings=function(){return P}};function b(){var e=zm.plugins.boxy.instances;for(var d=0,c;c=e[d];d++){c.locate()}}function a(){var e=zm.plugins.boxy.instances;for(var d=0,c;c=e[d];d++){if(c.isShowing()&&c.getSettings().hideOnClickOutside){if(zm.inArray(c.getElement(),zm(this).parents())==-1){c.close("close")}}}}zm.ready(function(){var c=zm(window);c.resize(b);if(zm.browser.msie&&zm.browser.version<7){c.scroll(b)}zm(document.body).mouseup(a)});zm.extend(zm.Boxy,{alert:function(e,h,g,c){var f;if(zm.plugins.boxy.alertInstance){f=zm.plugins.boxy.alertInstance}else{f=new zm.Boxy({zIndex:100});zm.plugins.boxy.alertInstance=f}var d={contentClass:"lbx_widsml",isTop:false};zm.extend(d,c,{content:e,title:h});f.changeSettings(d);f.show();if(g){zm.plugins.boxy.alertTimeout=setTimeout(function(){f.hide()},g)}},stopAlert:function(){zm.plugins.boxy.alertInstance&&zm.plugins.boxy.alertInstance.hide()},confirm:function(e,g,c){var f=zm.plugins.boxy.confirmInstance;if(!f){f=new zm.Boxy({zIndex:99});zm.plugins.boxy.confirmInstance=f}var d={contentClass:"lbx_widsml",isTop:false};zm.extend(d,c,{content:e,onOk:g});f.changeSettings(d);f.show()},stopConfirm:function(c){zm.plugins.boxy.confirmInstance&&zm.plugins.boxy.confirmInstance.hide(c)},mousePosition:function(d){if(d.pageX||d.pageY){return{left:d.pageX,top:d.pageY}}else{var c=document.documentElement||document.body;return{left:(d.clientX+c.scrollLeft-c.clientLeft),top:(d.clientY+c.scrollTop-c.clientTop)}}}})});zm.install("dragdrop",{startDragDrop:function(i){if(!this[0]){return}var h=this[0];if(zm.data(h,"dragdrop.start")==true){return}zm.data(h,"dragdrop.start",true);var d=0,f,a,b,c=null,e={};this.children().each(function(){zm.data(this,"dragdrop.index",d);d++});f=function(){var j=this;if(j){while(j.parentNode!=h){j=j.parentNode;if(!j){return false}}c=j;zm(c).addClass("zme-dragging");i&&zm.isFunction(i.onDragging)&&i.onDragging.call(c)}return false};a=function(n){if(c){var m=this;while(m.parentNode!=h){m=m.parentNode;if(!m){return}}if(m!=c){var l=zm(h).children(),j=zm.inArray(c,l);for(var k=0,o;o=l[k];k++){if(o==m){if(k==l.size()-1){h.appendChild(c)}else{if(k>j){h.insertBefore(o,c)}else{h.insertBefore(c,o)}}break}}}if(zm.browser.msie&&n.button==0){if(m!=h){zm(c).removeClass("zme-dragging");i&&zm.isFunction(i.onStopDragging)&&i.onStopDragging.call(c);c=null}}}};b=function(){if(c){zm(c).removeClass("zme-dragging");i&&zm.isFunction(i.onStopDragging)&&i.onStopDragging.call(c)}c=null};e.mousedown=[this.mousedown(f),f];e.mousemove=[zm(document).mousemove(a),a];e.mouseup=[zm(document).mouseup(b),b];if(zm.browser.msie&&typeof h.onselectstart!="undefined"){var g=function(){return zm.data(h,"dragdrop.start")!=true};e.selectstart=[this.bind("selectstart",g),g]}zm.data(h,"dragdrop.events",e)},stopDragDrop:function(){var a=zm.data(this[0],"dragdrop.events");zm.each(a,function(c){this[0].unbind(c,this[1])});zm.removeData(this[0],"dragdrop.events");var b=this.getDragDropResult();zm.removeData(this[0],"dragdrop.start");return b},getDragDropResult:function(){if(zm.data(this[0],"dragdrop.start")){var b=new Array();for(var a=0,e;e=this.children()[a];a++){var d=zm.data(e,"dragdrop.index");b.push(d)}return b}return null}});zm.install("popup",{calloutPopup:function(f){if(!zm.plugins.popup.initialized){zm.plugins.popup.init();zm.plugins.popup.initialized=true}var d=zm("#zme-callout-popup-content"),b=zm("#zme-callout-popup");d.html("").append(f);var i=this.offset(true),a=zm.getViewport(),e=this.height(),c=i.top+e/2;i.left+=zm.intval(this.css("padding-left"))+zm.intval(this.css("margin-left"));if(a.offsetY+a.height/2<=c){d.attr("class","zme-callout-content-upper");zm("#zme-callout-popup-head").hide();zm("#zme-callout-popup-bottom").css("padding-left","12px").show();b.css("top",(i.top-b.outerHeight())+"px")}else{d.attr("class","zme-callout-content-lower");zm("#zme-callout-popup-bottom").hide();zm("#zme-callout-popup-head").css("padding-left","12px").show();b.css("top",(i.top+e)+"px")}var j=b.outerWidth(),g=i.left+j+15;if(a.offsetX+a.width>g){b.css("left",i.left+"px")}else{b.css("left",(i.left+this.width()-j)+"px");if(a.offsetY+a.height/2<=c){zm("#zme-callout-popup-bottom").css("padding-left",(b.width()-24)+"px")}else{zm("#zme-callout-popup-head").css("padding-left",(b.width()-24)+"px")}}},hideCalloutPopup:function(){zm("#zme-callout-popup").css({left:"-9999px",top:"0px"})}},function(){zm.plugins.popup.init=function(){zm.ready(function(){var b=zm.createElement("DIV",{id:"zme-callout-popup"}),f=zm.createElement("DIV",{id:"zme-callout-popup-content"}),e=zm.createElement("DIV",{id:"zme-callout-popup-head"}),d=zm.createElement("DIV",{id:"zme-callout-popup-bottom"}),c=zm.createElement("DIV",{"class":"zme-callout-arrow"}),a=zm.createElement("DIV",{"class":"zme-callout-arrow"});e.appendChild(c);d.appendChild(a);b.appendChild(e);b.appendChild(f);b.appendChild(d);document.body.appendChild(b)})}});zm.install("tooltip",{showTip:function(c,i){if(this.size()==0){return}zm.plugins.tooltip.init();zm("#zmtipctn").html(c);i=zm.extend({},zm.plugins.tooltip.defOptions,i);var h=zm("#zmtip"),e,b,f=this.offset(true),d=i.position;h.attr("class","tip_outer "+i.tipClass);i.width&&h.css("width",i.width+"px");if(d.indexOf("bot")==0){e=f.top-h.outerHeight()-5}else{e=f.top+this.outerHeight()+5}var g=h.outerWidth(),a=this.outerWidth();if(d.substr(3)=="left"){b=f.left+5}else{if(d.substr(3)=="right"){b=f.left+a-g-5}else{b=f.left+Math.floor((a-g)/2)}}zm.plugins.tooltip._setArrow(d);e+=i.offsetTop;b+=i.offsetLeft;zm.plugins.tooltip._show(e,b,i)},hideTip:function(){zm.hideTip()}},function(){zm.plugins.tooltip.init=function(){if(zm("#zmtip").size()>0){return}zm.ready(function(){var a=zm.createElement("DIV",{id:"zmtip","class":"tip_outer"},{top:"-9999px",left:"0px"});zm(a).html('<div class="tip_box">				<span id="zmtiparrow" class="tip_arrow skin"></span>				<a id="zmtipclose" href="#" class="tip_close" title="ÄÃ³ng" style="display: none" onclick="zm.hideTip(); return false;">ÄÃ³ng</a>				<div class="tip_inner">					<div id="zmtipctn"></div>				</div>            </div>');document.body.appendChild(a)})};zm.plugins.tooltip.defOptions={position:"topcenter",tipClass:"",close:false,offsetTop:0,offsetLeft:0};zm.showTip=function(d,c){if(!c&&!c.inElement){return}zm.plugins.tooltip.init();c=zm.extend({},zm.plugins.tooltip.defOptions,c);var a=zm("#zmtip"),g=c.position,f=c.top,e=c.left;a.attr("class","tip_outer "+c.tipClass);c.width&&a.css("width",c.width+"px");zm("#zmtipctn").html(d);zm(c.inElement).append(a);zm.plugins.tooltip._setArrow(g);var b=zm("#zmtip").outerWidth();if(!c.absLeft){if(g.substr(3)=="right"){e-=b+5}else{if(g.substr(3)!="left"){e-=Math.floor(b/2)}}}zm.plugins.tooltip._show(f,e,c)};zm.hideTip=function(){if(zm.plugins.tooltip.showing){var a=zm("#zmtip");if(zm.browser.msie){a.remove();zm.isFunction(zm.plugins.tooltip.afterHide)&&zm.plugins.tooltip.afterHide();zm.plugins.tooltip.afterHide=null}else{a.fadeOut(function(){this.remove();zm.isFunction(zm.plugins.tooltip.afterHide)&&zm.plugins.tooltip.afterHide();zm.plugins.tooltip.afterHide=null})}zm.plugins.tooltip.showing=false}};zm.plugins.tooltip._show=function(e,d,b){zm("#zmtipclose")[b.close?"show":"hide"]();var a;if(typeof b.timeout=="number"){a=function(){var f=this;setTimeout(function(){f.hideTip()},b.timeout)}}zm.plugins.tooltip.afterHide=b.afterHide;var c=zm("#zmtip");c.css({top:e+"px",left:d+"px"});if(zm.browser.msie){a&&a()}else{c.fadeIn(a)}zm.plugins.tooltip.showing=true};zm.plugins.tooltip._setArrow=function(c){var a=Math.floor((zm("#zmtip").outerWidth()-20-13)/2),b="";if(c.substr(3)=="left"){b=-a+"px"}else{if(c.substr(3)=="right"){b=a+"px"}}zm("#zmtiparrow").css("left",b)}});zm.install("displaybox",{showDisplaybox:function(f,j){if(this.size()==0){return}var h=true,g=(j&&j.followElement&&zm(j.followElement))||this;g.parents().each(function(){if(zm(this).css("display")=="none"){h=false;return false}});if(!h){return}zm.plugins.displaybox.init();j=zm.extend({},zm.plugins.displaybox.defOptions,j);j.header&&zm("#zmtdbox .dboxheader").html(j.header);j.footer&&zm("#zmtdbox .dboxfooter").html(j.footer);zm("#zmtdbox .dboxcontent").html(f);var d,a,b=this;if(j.checkImage){d=zm("#zmtdbox img");if(j.ignoreImages){a=zm(j.ignoreImages)}var c=0,i=function(){if(zm(this).parents("body").size()==0){return}c++;if(c==d.size()){zm.plugins.displaybox.show(b,g,j)}}}if(d&&d.size()>0){d.each(function(){if(a&&zm.inArray(this,a)>-1){return}if(this.complete){i.call(this)}else{this.onload=this.onerror=i}})}else{if(j.delay){if(zm.plugins.displaybox.timeout){clearTimeout(zm.plugins.displaybox.timeout)}zm.plugins.displaybox.timeout=setTimeout(function(){zm.plugins.displaybox.show(b,g,j)},j.delay)}else{zm.plugins.displaybox.show(this,g,j)}}this.clickOutside(function(){var k=this;setTimeout(function(){zm.plugins.displaybox.element==k&&zm(k).hideDisplaybox()},150)},0,true,j.group||"zmcog.displaybox");this.clickOutsideWith(zm("#zmdbox"))},hideDisplaybox:function(){var a=zm.plugins.displaybox.beforHide;zm.isFunction(a)&&a.call(zm.plugins.displaybox.element);zm("#zmdbox").css({top:"-9999px",left:"-9999px"});zm.plugins.displaybox.showing=false;zm.plugins.displaybox.element=null},toggleDisplaybox:function(b,a){if(zm.plugins.displaybox.showing&&zm.plugins.displaybox.element==this[0]){this.hideDisplaybox()}else{this.showDisplaybox(b,a)}}},function(){zm.plugins.displaybox.init=function(){if(zm("#zmdbox").size()>0){return}zm.ready(function(){var b=zm.createElement("DIV",{id:"zmdbox","class":"ctndisbox",tabindex:"-1"},{top:"-9999px",left:"-9999px",outline:"none"}),c=zm.createElement("DIV",{id:"zmtdbox","class":"ctndisbox"},{top:"-9999px",left:"-9999px"}),a='<span id="zm{ID}dboxtoparrow" class="icodisbox"></span>					<div class="disbox">						<div class="contdisbox">							<div class="disbox_inner">								<a id="zm{ID}dboxclose" href="#" class="disboxclose" title="ÄÃ³ng" style="display: none">ÄÃ³ng</a>								<div id="zm{ID}dboxwrap"><div class="dboxheader"></div><div class="dboxcontent"></div><div class="dboxfooter"></div></div>								<div class="clr"></div>							</div>						</div>					</div>					<span id="zm{ID}dboxbotarrow" class="icodisbox"></span>';zm(b).append(a.replace(/\{ID\}/g,""));zm(c).append(a.replace(/\{ID\}/g,"t"));document.body.appendChild(b);document.body.appendChild(c);zm.plugins.displaybox.scrollUI=new zm.ScrollableUI().init().appendTo(zm("#zmdboxwrap .dboxcontent"));zm("#zmdboxclose").click(function(){var d=zm.plugins.displaybox.element;d&&zm(d).hideDisplaybox();return false})})};zm.plugins.displaybox.defOptions={position:"absolute",close:true,dboxClass:"",offsetTop:0,offsetLeft:0,checkImage:true};zm.plugins.displaybox.show=function(A,a,d){zm.isFunction(d.beforeShow)&&d.beforeShow.call(A);var k=zm("#zmdbox"),r=zm("#zmtdbox"),b="ctndisbox "+d.dboxClass,n="contdisbox",w=d.position||"absolute",f=a.offset(w=="absolute"),x=A.outerHeight(),i=Math.floor(x/2),y=zm.getViewport(),z=w=="absolute"?y.offfsetY:0,u="icodisbox ",c="top",v="bot",q,e,p,o;r.attr("class",b);if(d.noPad){n="contdisboxnopad"}r.children(".disbox").children().attr("class",n);k.children(".disbox").children().attr("class",n);var s=r.outerHeight(true),m=d.minTop||20,j=d.minBottom||20,l=r.find(".dboxcontent").outerHeight(),g=y.height-s-m-j;if(d.align!="right"&&f.left-y.offsetX>r.outerWidth(true)){e=f.left-r.outerWidth()-5;u+="lefttop"}else{e=f.left+A.outerWidth()+5;u+="righttop"}if(f.top<m+z){q=m+z}else{q=f.top}if(g<0){q=m+z;l+=g}else{if(i<15){q+=i-15}if((o=q+s+j-z-y.height)>0){q-=o}}p=f.top-q+i-6;if(p<4){p=f.top+x-q-14}if(i<15){p=""}else{p+="px"}zm("#zmdbox"+c+"arrow").attr("class",u).css("margin-top",p).show();zm("#zmdbox"+v+"arrow").hide();q+=d.offsetTop;e+=d.offsetLeft;k.attr("class",b);zm("#zmdbox .dboxheader").empty().append(zm("#zmtdbox .dboxheader").children());zm("#zmdbox .dboxfooter").empty().append(zm("#zmtdbox .dboxfooter").children());zm.plugins.displaybox.scrollUI.setContent(zm("#zmtdbox .dboxcontent").children()).setHeight(l+1).updateScrollbar(false);d.width&&zm.plugins.displaybox.scrollUI.setWidth(d.width);zm("#zmdboxclose")[d.close?"show":"hide"]();k.css({top:q+"px",left:e+"px",position:d.position});zm.plugins.displaybox.showing=true;zm.plugins.displaybox.element=A[0];zm.plugins.displaybox.beforHide=d.beforeHide;zm.isFunction(d.afterShow)&&d.afterShow.call(A)}});zm.install("scrollableui",{},function(){zm.ScrollableUI=function(c){var m=zm.extend({},zm.ScrollableUI.defaultSettings,c),r,u,b=false,v=false,f=zm.extend({"class":"zmscrollableui"+(m.uiClass?" "+m.uiClass:"")},m.uiAttrs),l=zm.extend({},m.uiStyles),n=zm.createElement("DIV",f,l),g=zm.createElement("DIV",{"class":"zmscrollableui_wrapper"+(m.wrapperClass?" "+m.wrapperClass:""),tabindex:"0"}),k=zm.createElement("DIV",{"class":"zmscrollableui_body"+(m.bodyClass?" "+m.bodyClass:"")}),p=zm.createElement("DIV",{"class":"zmscrollableui_content"+(m.contentClass?" "+m.contentClass:"")}),a=zm.createElement("DIV",{"class":"zmscrollableui_bar"+(m.scrollbarClass?" "+m.scrollbarClass:"")},{visibility:"hidden"}),d=zm.createElement("DIV",{"class":"zmscrollableui_gripper"+(m.gripperClass?" "+m.gripperClass:"")});n.appendChild(g);n.appendChild(a);g.appendChild(k);a.appendChild(d);k.appendChild(p);m.content&&zm(p).append(m.content);var i=zm(n);if(m.width){i.css("width",m.width+"px");zm(k).css("width",m.width+"px")}m.height&&i.css("height",m.height+"px");function q(s){zm(k).hover(function(){zm.ScrollableUI.scrollingElement=g;h();o(true);!s.settings.alwaysShow&&e()},function(){h();if(!s.settings.alwaysShow){var w=zm.ScrollableUI.draggingElement;if(!w||w.parentNode.parentNode!=this){r=setTimeout(e,500)}}if(zm.ScrollableUI.scrollingElement==g){zm.ScrollableUI.scrollingElement=null}t()});zm(n).mousemove(function(w){var x=zm(n);if(zm.Boxy.mousePosition(w).left-x.left()>=x.width()-30){v=true;t();o(true)}else{v=false;!s.settings.alwaysShow&&e()}});zm(g).scroll(function(z){if(u){clearTimeout(u)}var y=this.scrollTop,x=0;if(y==0){x=-1}else{if(y+this.offsetHeight==this.scrollHeight){x=1}}o(true);!s.settings.alwaysShow&&!v&&e();var w=s.settings.onscroll;zm.isFunction(w)&&w.call(this,s,z,x)});zm(a).hover(function(){t()},function(){!s.settings.alwaysShow&&!s.mousedown&&e()});zm(d).mousedown(function(w){zm.ScrollableUI.scrollingElement=g;t();s.mousedown=true;s.offsetY=zm.Boxy.mousePosition(w).top-zm(this).top();zm.ScrollableUI.draggingObj=s;return false});if(zm.browser.msie){zm(a).bind("selectstart",function(){return false});zm(n).bind("selectstart",function(){return !s.mousedown})}}function o(E,y){var x=g.offsetHeight,w=g.scrollHeight;if(x==w){j(y);return}var C=zm(a).show(),z=a.offsetHeight,A=z*x/w,B=zm(d);if(A>4){A-=4}B.css("height",A+"px");A=B.outerHeight();if(E){var D=g.scrollTop,F,G=w-x;if(D>=G){F=z-A}else{F=(z-A)/G*D}B.css("top",F+"px");b=true;C.stopFading().css("visibility","").opacity(1)}}function e(){if(!b){return}if(u){clearTimeout(u)}u=setTimeout(function(){b=false;j()},1000)}function j(s){if(s===false){zm(a).hide()}else{zm(a).fadeOut(function(){this.css("visibility","hidden");var w=this;setTimeout(function(){w.show()},100)})}}function t(){if(u){clearTimeout(u)}u=null}function h(){if(r){clearTimeout(r)}r=null}q(this);this.settings=m;this.init=function(){return this};this.appendTo=function(s){if(s.append){s.append(n)}else{s.appendChild(n)}this.init();return this};this.setContent=function(s){if(zm.isString(s)){zm(p).html(s)}else{zm(p).empty().append(s)}return this};this.setWidth=function(s){s=zm.intval(s);if(s>0){this.width=s;zm(n).css("width",s+"px");zm(k).css("width",s+"px")}return this};this.getWidth=function(){return this.width};this.setHeight=function(s){s=zm.intval(s);if(s>0){this.height=s;zm(n).css("height",s+"px")}return this};this.getHeight=function(){return this.height};this.getElement=function(){return n};this.getGripper=function(){return d};this.updateScrollbar=function(s){o(true,s);return this};this.scrollTo=function(s){g.scrollTop=s;return this};this.scrollToEnd=function(){g.scrollTop=g.scrollHeight;return this};this.scrollToTop=function(){g.scrollTop=0;return this};this.showScrollbar=function(){o(true);return this};this.hideScrollbar=function(s){if(s){e()}else{t();h();j()}return this};this.show=function(){zm(n).show();return this};this.hide=function(){zm(n).hide();return this};this.clear=function(){zm(p).empty();return this};this.remove=function(){zm(n).remove()}};zm(document).mousemove(function(f){var c=zm.ScrollableUI.draggingObj;if(c){var j=zm.Boxy.mousePosition(f).top,l=c.getGripper(),d=zm(l),m=d.outerHeight(),h=d.parent(),a=h.height(),i=j-h.top()-(c.offsetY||0),b=i<=0||i>=a-m;if(i<0){i=0}if(i>a-m){i=a-m}var k=h.parent().children().get(0)[0];if(!zm.browser.msie){k.scrollTop+=1;k.scrollTop-=1}if(b&&i>0){k.scrollTop=k.scrollHeight}else{k.scrollTop=zm.intval(i*(k.scrollHeight-k.offsetHeight)/(a-m))}}}).mouseup(function(){var a=zm.ScrollableUI.draggingObj;if(a){a.hideScrollbar(true);a.mousedown=false;a.offsetY=null;zm.ScrollableUI.draggingObj=null}});zm(document.documentElement).mousewheel(function(h){if((typeof h.axis!=="undefined"&&h.axis===h.HORIZONTAL_AXIS)||(h.wheelDeltaX&&!h.wheelDeltaY)){h.preventDefault()}else{if(zm.ScrollableUI.scrollingElement){var m=h.wheelDeltaY||h.wheelDelta||h.detail,a=zm.ScrollableUI.scrollingElement,f=a.scrollHeight,n=a.offsetHeight,l=zm(a).parents();for(var c=0,b;b=l.get(c);c++){if(b.css("display")=="none"){zm.ScrollableUI.scrollingElement=null;return}}if(f>n){var k=a.scrollTop;if(((zm.browser.firefox?m<0:m>0)&&k==0)||((zm.browser.firefox?m>0:m<0)&&k>=f-n)){h.preventDefault()}else{if(zm.browser.msie&&zm.browser.version<9){var g=zm(a).css("font-size");if(g.indexOf("px")<0){var j=zm.createElement("DIV");j.style.fontSize=g;j.style.height="1em";g=j.style.pixelHeight}else{g=parseInt(g,10)}a.scrollTop=k-Math.round(m/120*g);h.preventDefault()}}}}}});if(zm.browser.msie){zm(document).bind("selectstart",function(){var a=zm.ScrollableUI.draggingObj;if(a&&a.mousedown){return false}})}zm.ScrollableUI.defaultSettings={}});zm.install("box",{autoArrangeBox:function(m){var J=this.children();if(m&&m.filterItem){J.filter(m.filterItem)}if(!J||J.size()<1){return this}if(this.data("box.autoresize")!=1){zm.plugins.box.elems.push({element:this,options:m});this.data("box.autoresize",1)}m=zm.extend({},zm.plugins.box.defSettings,m);var q=this.parent().parent(),H=q.offset().left,D=zm.intval(m.from),c=m.force||D>0;if(H<0&&!c){return this}var d=m.getMaxWidth,z=(zm.isFunction(d)&&d.call(this))||(q.width()-H-20),o=0,K=m.padding,p=m.paddingBottom||K,v=m.paddingRight||K,L=m.minColumn,n,t,a=new Array(),F,I,f,N=0;for(F=0,I;I=J.get(F);F++){var s=I.outerWidth();if(s>0){n=s+v;break}}t=Math.floor(z/n);if(t==zm.intval(this.data("box.cols"))&&!c){return this}var u=m.beforeArrange;zm.isFunction(u)&&u(t,n,z);if(t<L&&!c){return this}this.data("box.cols",t);if(D>0){for(F=D-1;I=J.get(F);F--){if(a.length>=t){break}if(!f){f=new Array()}var y=I.outerHeight();if(y>0){var B=zm.intval(I.css("left")),M=zm.intval(I.css("top"))+y;if(f.length==0){f.push(B);a.push(M)}else{var C=-1;for(var E=0;E<f.length;E++){if(f[E]==B){break}if(f[E]<B){if(E==f.length-1){C=E+1}continue}if(f[E]>B){C=E;break}C=0}if(C>-1){f.splice(C,0,B);a.splice(C,0,M)}}}}}for(F=D;I=J.get(F);F++){var x=0,G=I.outerHeight();if(G==0){continue}if(a.length<t){o=a.length%t*n;if(D>0&&f.length<t){f.push(o)}a.push(G)}else{var r=Math.min.apply(Math,a),A=zm.inArray(r,a);x=r+p;if(D>0&&f){o=f[A]}else{o=A*n}a[A]=x+G}I.css({top:x+"px",left:o+"px"}).attr("data-index",F);N++}this.css("height",Math.max.apply(Math,a)+"px").parent().css("width",(t*n-v)+"px");D==0&&this.data("box.total",N);var g=m.afterArrange;zm.isFunction(g)&&g(t,n,z);return this},getNumberBoxColumns:function(){return this.data("box.cols")},getNumberBoxes:function(){return this.data("box.total")},updateTopBox:function(m){var j=this.children();if(m&&m.filterItem){j.filter(m.filterItem)}if(!j||j.size()<1){return this}m=zm.extend({},zm.plugins.box.defSettings,m);var l=zm.intval(m.from),f=m.paddingBottom||m.padding,a,k;for(var b=l,g;g=j.get(b);b++){var d=g.outerHeight();if(d==0){continue}var c=zm.intval(g.css("left"));if(a===undefined){a=c}else{if(a!=c){continue}}if(k){g.css("top",(k+f)+"px")}k=zm.intval(g.css("top"))+d}if(this.height()<k){this.css("height",k+"px")}return this}},function(){zm.plugins.box.defSettings={padding:10,force:false,from:0};zm.plugins.box.elems=new Array();zm(window).resize(function(){for(var a=0,b;b=zm.plugins.box.elems[a];a++){b.options.force=false;b.from=0;b.element.autoArrangeBox(b.options)}})});}var zmWgConfig = {
    callback: "cb",
    callback_ex: "",
    apikey: "",
    pid: "",
    appIdFB: "",
    tpl: "1",
    zme_widget_callback_data: {},
    css: "https://stc-id.zing.vn/widget/css/login_widget.css",
    sharefb_type: "",
    login_btn: "btn-login",
    register_btn: "btn-register",
    xregister_btn: "btn-xregister",
    regmap_btn: "btn-regmap",
    loginUrl: "https://id.zing.vn/widget/op/login",
    xloginUrl: "https://id.zing.vn/widget/opidx",
    registerUrl: "https://id.zing.vn/widget/opreg",
    openIdUrl: "https://id.zing.vn/openid",
    idxUrl: "http://idx.me.zing.vn",
    retryLoadFB: 0,
    referer: "",
    client_url: "",
    _src: "",
    utm_source: "",
    utm_medium: "",
    utm_term: "",
    utm_content: "",
    utm_campaign: "",
    zme_widget_callback: function () {},
    msg: {
        invalid_account: "Tài khoản hoặc mật khẩu không đúng !",
        input_account: "Vui lòng nhập Tài khoản và Mật khẩu !",
        idx_login_title: "Đăng nhập với ",
        title_loading: "Đang tải dữ liệu",
        baned_account: '<div class="titloginby" align="center"><strong>Tài khoản này đã bị khóa</strong></div><p align="center">',
        loading: '<div class="titloginby" align="center"><strong> Đang kết nối vào hệ thống, bạn chờ tí nhé </strong></div><p align="center"><img src="https://stc-id.zing.vn/login/images/load_small.gif" alt="" /></p>',
        error: '<div class="titloginby" align="center"><strong> Kết nối bị gián đoạn, vui lòng thử lại </strong></div>',
        connect_error: 'Quá trình kết nối bị gián đoạn. Vui lòng thử lại.',
        bxcontent: '<div id="bxcontainer"></div>',
        bxalertcontent: '<div id="bxalertcontainer"></div>',
        ok: "Đồng ý",
        errtitle: "Thông báo",
        create: "Tạo Tài khoản",
        domapping: "Đồng bộ",
        cancel: "Bỏ qua",
        login: "Đăng Nhập",
        mapping: "Đồng bộ tài khoản",
        opt: "Đăng nhập Zing",
        register: "Đăng ký tài khoản Zing ID"
    }
};
zm.install("boxy", {}, function () {
    zm.plugins.boxy.defOptions = {
        content: "",
        closeButton: true,
        modal: true,
        center: true,
        animated: true,
        scroll: true,
        revert: false
    };
    zm.plugins.boxy.zIndex = 1001;
    zm.plugins.boxy.activeInstances = new Array();
    zm.Boxy = function (options) {
        var dlgbox, cover, container, bbody, content, closeBtn, settings = zm.extend({}, zm.plugins.boxy.defOptions, options),
        self = this,
        isShowing = false,
        vpHeight = null,
        sT = null;
        createBoxy();
        setzIndex(settings.zIndex);
        settings.isTop && forceToTop();

        function createBoxy() {
            var _dlgbox = zm.createElement("DIV", {
                "class": "zme-boxy"
            }),
            _cover = zm.createElement("DIV", {
                "class": "zme-boxy-wrapper" + (settings.modal ? " zme-boxy-modal" : "")
            }, {
                display: "none"
            }),
            ac = settings.contentClass ? (" " + settings.contentClass) : "",
            bbody = zm.createElement("DIV", {
                "class": "zme-boxy-body"
            });
            container = zm.createElement("DIV", {
                "class": "zme-boxy-container" + ac
            });
            content = zm.createElement("DIV", {
                "class": "zme-boxy-content"
            });
            setContent(settings.content);
            bbody.appendChild(content);
            container.appendChild(bbody);
            _dlgbox.appendChild(container);
            _cover.appendChild(_dlgbox);
            document.body.appendChild(_cover);
            settings.closeButton && createCloseButton();
            dlgbox = zm(_dlgbox);
            cover = zm(_cover);
            zm(_cover).click(function () {
                setTimeout(function () {
                    var list = zm.plugins.boxy.activeInstances;
                    list && list.length > 0 && list[list.length - 1].close("close")
                }, 150)
            });
            zm(_dlgbox).click(function (e) {
                e.stopPropagation();
                return false
            })
        }

        function createCloseButton() {
            closeBtn = zm.createElement("A", {
                "class": "zme-boxy-close",
                href: "#"
            });
            addButtonClass(2);
            container.appendChild(closeBtn);
            zm(closeBtn).click(function () {
                self.close("close");
                return false
            })
        }

        function addButtonClass(type) {
            var btnclass = "",
            btn;
            if (type == 2) {
                if (settings.closeClass) {
                    btnclass = settings.closeClass
                } else {
                    btnclass = "zme-boxy-close"
                }
                btn = closeBtn
            }
            btn && zm(btn).attr("class", btnclass)
        }

        function forceToTop(f) {
            if (f != undefined) {
                settings.isTop = f
            }
            if (settings.isTop) {
                if (!self.stopOutside) {
                    self.stopOutside = function (e) {
                        settings.isTop && e.stopPropagation()
                    };
                    dlgbox.mouseup(self.stopOutside)
                }
            } else {
                self.stopOutside && dlgbox.unbind("mouseup", self.stopOutside)
            }
        }

        function setContent(html) {
            if (html) {
                settings.content = html
            }
            if (content && settings.content) {
                var c = settings.content;
                if (zm.isString(c)) {
                    zm(content).html(c)
                } else {
                    zm(content).html("").append(c)
                }
            }
        }

        function setCloseButton() {
            if (settings.closeButton) {
                closeBtn ? zm(closeBtn).show() : createCloseButton()
            } else {
                closeBtn && zm(closeBtn).hide()
            }
        }

        function setzIndex(zIndex) {
            if (zIndex && typeof zIndex == "number") {
                settings.zIndex = zIndex
            }
            settings.zIndex && cover.css("z-index", zm.plugins.boxy.zIndex + settings.zIndex)
        }

        function setModal() {
            cover[settings.modal ? "addClass" : "removeClass"]("zme-boxy-modal")
        }

        function addClass() {
            var cl = settings.contentClass;
            if (zm.isString(cl)) {
                zm(container).attr("class", "zme-boxy-container " + cl)
            }
            if (zm.isString(settings.okClass)) {
                addButtonClass(0)
            }
            if (zm.isString(settings.cancelClass)) {
                addButtonClass(1)
            }
            if (zm.isString(settings.closeClass)) {
                addButtonClass(2)
            }
        }

        function _show() {
            zm.isFunction(settings.beforeShow) && settings.beforeShow.call(self);
            cover.show();
            isShowing = true;
            self.locate();
            if (zm.inArray(self, zm.plugins.boxy.activeInstances) == -1) {
                zm.plugins.boxy.activeInstances.push(self)
            }
        }
        this.centerX = function () {
            var l, w = dlgbox.outerWidth(),
            vp = zm.getViewport();
            l = Math.round((vp.width - w) / 2);
            if (zm.isNumber(settings.offsetLeft)) {
                l += settings.offsetLeft
            }
            dlgbox.css("left", (l < 0 ? "0" : l) + "px")
        };
        this.centerY = function () {
            var t, h = dlgbox.outerHeight(),
            vp = zm.getViewport();
            if (vpHeight == null) {
                vpHeight = vp.height
            }
            t = Math.round((vpHeight - h) / 2);
            if (sT != null) {
                t += sT - settings.iframeTopOffset
            }
            if (zm.isNumber(settings.offsetTop)) {
                t += settings.offsetTop
            }
            dlgbox.css("top", (t < 0 ? "0" : t) + "px");
            vpHeight = null
        };
        this.center = function () {
            this.centerX();
            this.centerY()
        };
        this.locate = function () {
            if (this.moved) {
                return
            }
            if (zm.isFunction(settings.setPosition)) {
                settings.setPosition.call(this)
            } else {
                settings.center && this.center()
            }
        };
        this.moveTo = function (x, y, offset) {
            this.moveToX(x, offset);
            this.moveToY(y, offset)
        };
        this.moveToX = function (x, offset) {
            if (x != undefined) {
                if (x == "center") {
                    this.centerX()
                } else {
                    dlgbox.css("left", x + "px")
                }
            }
        };
        this.moveToY = function (y, offset) {
            if (y != undefined) {
                if (y == "center") {
                    this.centerY()
                } else {
                    if (sT != null && offset != false) {
                        y += sT - settings.iframeTopOffset
                    }
                    dlgbox.css("top", y + "px")
                }
            }
        };
        this.show = function () {
            if (isShowing) {
                return
            }
            if (typeof zmXCall != "undefined" && typeof settings.iframeTopOffset == "number") {
                zmXCall.getTop(function (data) {
                    vpHeight = data.height;
                    sT = data.top;
                    _show()
                })
            } else {
                vpHeight = sT = null;
                _show()
            }
        };
        this.hide = function (animated) {
            if (!isShowing) {
                return
            }
            zm.isFunction(settings.beforeHide) && settings.beforeHide();
            var after = settings.afterHide;
            if (animated !== false && settings.animated) {
                if (zm.browser.msie) {
                    cover.hide();
                    zm.isFunction(after) && after()
                } else {
                    cover.fadeOut(100, after)
                }
            } else {
                cover.hide();
                zm.isFunction(after) && after()
            }
            isShowing = false;
            if (this == zm.plugins.boxy.alertInstance && zm.plugins.boxy.alertTimeout) {
                clearTimeout(zm.plugins.boxy.alertTimeout)
            }
            var index = zm.inArray(this, zm.plugins.boxy.activeInstances);
            index > -1 && zm.plugins.boxy.activeInstances.splice(index, 1)
        };
        this.isShowing = function () {
            return isShowing
        };
        this.getElement = function () {
            return dlgbox[0]
        };
        this.setContent = function (html) {
            setContent(html);
            this.locate();
            return this
        };
        this.close = function (ok) {
            var result = true;
            if (ok === "close") {
                zm.isFunction(settings.onClose) && settings.onClose.call(this)
            } else {
                if (ok) {
                    if (zm.isFunction(settings.onOk)) {
                        result = settings.onOk.call(this)
                    }
                } else {
                    if (zm.isFunction(settings.onCancel)) {
                        result = settings.onCancel.call(this)
                    }
                }
            }
            result !== false && this.hide()
        };
        this.changeSettings = function (s) {
            if (!s) {
                return
            }
            if (!settings) {
                settings = zm.plugins.boxy.defOptions
            }
            settings = zm.extend(settings, s);
            zm.isString(s.content) && setContent();
            setModal();
            setCloseButton();
            setzIndex();
            forceToTop();
            addClass()
        };
        this.getSettings = function () {
            return settings
        }
    };

    function resetBoxy() {
        var instances = zm.plugins.boxy.activeInstances;
        for (var i = 0, ins; ins = instances[i]; i++) {
            ins.locate()
        }
    }

    function hideOnClickOutside() {
        var instances = zm.plugins.boxy.activeInstances;
        for (var i = instances.length - 1; i >= 0; i--) {
            var ins = instances[i];
            if (ins.getSettings().hideOnClickOutside && zm.inArray(ins.getElement(), zm(this).parents()) == -1) {
                ins.close("close");
                break
            }
        }
    }
    zm.ready(function () {
        var w = zm(window);
        w.resize(resetBoxy);
        if (zm.browser.msie && zm.browser.version < 7) {
            w.scroll(resetBoxy)
        }
        zm(document.body).mouseup(hideOnClickOutside).keydown(function (e) {
            if (e.keyCode == 27) {
                var list = zm.plugins.boxy.activeInstances;
                list && list.length > 0 && list[list.length - 1].close("close")
            }
        })
    });
    zm.extend(zm.Boxy, {
        alert: function (message, timeout, options) {
            try{
                var boxy;
                if (zm.plugins.boxy.alertInstance) {
                    boxy = zm.plugins.boxy.alertInstance
                } else {
                    boxy = new zm.Boxy({
                        zIndex: 100
                    });
                    zm.plugins.boxy.alertInstance = boxy
                }
                var ops = {
                    contentClass: "lbx_widsml",
                    isTop: false
                };
                zm.extend(ops, options, {
                    content: message
                });
                boxy.changeSettings(ops);
                boxy.show();
                if (timeout) {
                    zm.plugins.boxy.alertTimeout = setTimeout(function () {
                        boxy.hide()
                    }, timeout)
                }
            }catch (err) {
                return
            }
        },
        stopAlert: function () {
            zm.plugins.boxy.alertInstance && zm.plugins.boxy.alertInstance.hide()
        },
        confirm: function (message, after, options) {
            var boxy = zm.plugins.boxy.confirmInstance;
            if (!boxy) {
                boxy = new zm.Boxy({
                    zIndex: 99
                });
                zm.plugins.boxy.confirmInstance = boxy
            }
            var ops = {
                contentClass: "lbx_widsml",
                isTop: false
            };
            zm.extend(ops, options, {
                content: message,
                onOk: after
            });
            boxy.changeSettings(ops);
            boxy.show()
        },
        stopConfirm: function (animated) {
            zm.plugins.boxy.confirmInstance && zm.plugins.boxy.confirmInstance.hide(animated)
        }
    })
});
var zmWgEvent = {
    subscribers: function () {
        if (!this._subscribersMap) {
            this._subscribersMap = {}
        }
        return this._subscribersMap
    },
    subscribe: function (name, cb) {
        var subs = this.subscribers();
        if (!subs[name]) {
            subs[name] = [cb]
        } else {
            subs[name].push(cb)
        }
    },
    unsubscribe: function (name, cb) {
        var subs = this.subscribers()[name];
        zm.each(subs, function (key, value) {
            if (value == cb) {
                subs[key] = null
            }
        })
    },
    monitor: function (name, callback) {
        if (!callback()) {
            var ctx = this,
            fn = function () {
                if (callback.apply(callback, arguments)) {
                    ctx.unsubscribe(name, fn)
                }
            };
            this.subscribe(name, fn)
        }
    },
    clear: function (name) {
        delete this.subscribers()[name]
    },
    fire: function () {
        var args = Array.prototype.slice.call(arguments),
        name = args.shift();
        var fns = this.subscribers()[name];
        zm.each(fns, function (key, sub) {
            if (sub) {
                sub.apply(this, args)
            }
        })
    }
};
var zmContent = {
    bx_handler: null,
    bx_alert: null,
    initBoxy: function () {
        if (zmContent.bx_handler == null) {
            zmContent.bx_handler = new zm.Boxy({
                autoFocus: false,
                footer: false,
                title: false,
                closeButton: false,
                animated: false,
                content: zmWgConfig.msg.bxcontent
            })
        }
        zm(zmContent.bx_handler.getElement()).addClass("zme_login_boxy")
    },
    initBoxyAlert: function () {
        if (zmContent.bx_alert == null) {
            zmContent.bx_alert = new zm.Boxy({
                autoFocus: false,
                footer: true,
                title: "Thông báo",
                closeButton: false,
                animated: false,
                content: zmWgConfig.msg.bxalertcontent
            })
        }
        zm(zmContent.bx_alert.getElement()).addClass("zme_login_boxy")
    },
    hideAndClearBoxy: function () {
        if (zmContent.bx_handler != null) {
            if (zm("#bxcontainer").size() > 0) {
                zm("#bxcontainer").children().each(function () {
                    zm(this).remove()
                });
                zm("#bxcontainer").remove()
            }
            zmContent.bx_handler.hide(false);
            zmContent.bx_handler = null
        }
        if (zmContent.bx_alert != null) {
            if (zm("#bxalertcontainer").size() > 0) {
                zm("#bxalertcontainer").children().each(function () {
                    zm(this).remove()
                });
                zm("#bxalertcontainer").remove()
            }
            zmContent.bx_alert.hide(false);
            zmContent.bx_alert = null
        }
    },
    hideAllBxContent: function () {
        if (zm("#bxcontainer").size() > 0) {
            zm("#bxcontainer").children().each(function () {
                zm(this).hide(true)
            })
        }
        if (zm("#bxalertcontainer").size() > 0) {
            zm("#bxalertcontainer").children().each(function () {
                zm(this).hide(true)
            })
        }
        return true
    },
    hideAllBx: function () {
        if (zmContent.bx_handler != null) {
            zmContent.bx_handler.hide(false)
        }
        if (zmContent.bx_alert != null) {
            zmContent.bx_alert.hide(false)
        }
    },
    hideAllBxTitle: function () {
        zm(".zme-boxy-title").hide(true);
        return true
    },
    hideAllBxFooter: function () {
        zm(".zme-boxy-footer").hide(true);
        return true
    },
    appendBxContent: function (id, html) {
        if (zm("#" + id).size() > 0) {
            if (html) {
                zm("#bxcontainer #" + id).html(html)
            }
            return false
        }
        return zm("#bxcontainer").append('<div id="' + id + '">' + html + "</div>")
    },
    appendBxAlertContent: function (id, html) {
        if (zm("#" + id).size() > 0) {
            if (html) {
                zm("#bxalertcontainer #" + id).html(html)
            }
            return false
        }
        return zm("#bxalertcontainer").append('<div id="' + id + '">' + html + "</div>")
    },
    showLoginBox: function (content) {
        zmContent.initBoxy();
        zmContent.bx_handler.changeSettings({
            closeButton: false,
            onOk: zmWgLogin.zmDoLogin,
            cancelButton: zmWgConfig.msg.cancel
        });
        zmContent.hideAllBx();
        zmContent.hideAllBxContent();
        try {
            zmContent.bx_handler.show()
        } catch (err) {}
        if (content) {
            zmContent.appendBxContent("zmefrmlogin", content);
            zm("#" + zmWgConfig.login_btn).click(function () {
                zmWgLogin.zmDoLogin()
            })
        }
        zm("#zmefrmlogin").show();
        zmContent.bx_handler.moveTo("center", "100");
        return false
    },
    showRegisterBox: function (content) {
        if (OPENWIDGET_ENABLE == true) {
            zmContent.initBoxy();
            zmContent.bx_handler.changeSettings({
                closeButton: false,
                onOk: zmWgRegister.zmDoRegister,
                cancelButton: zmWgConfig.msg.cancel
            });
            zmContent.hideAllBx();
            zmContent.hideAllBxContent();
            try {
                zmContent.bx_handler.show()
            } catch (err) {}
            if (content) {
                zmContent.appendBxContent("zmefrmregister", content);
                zm("#" + zmWgConfig.register_btn).click(function () {
                    zmWgRegister.zmDoRegister()
                })
            }
            zm("#zmefrmregister").show();
            zmContent.bx_handler.moveTo("center", "100");
            return false;
        } else {
            window.location.href = "https://id.zing.vn/v2/register?pid=" + zmWgConfig.pid 
                    + "&apikey=" + zmWgConfig.apikey + "&next=" + encodeURIComponent(location.href);
            return false;
        }
    },
    showRegOauthBox: function (resp) {
        zmContent.initBoxy();
        zmXLoginWg.data = resp.oauthData;
        zmContent.hideAllBx();
        try {
            zmContent.bx_handler.show()
        } catch (err) {
            console.log(err)
        }
        if (resp.data) {
            zmContent.appendBxContent("zmefrmregoauth", resp.data);
            zm("#" + zmWgConfig.xregister_btn).click(function () {
                zmXLoginWg.doOauthReg()
            })
        }
        zm("#zmefrmregoauth").show();
        zmContent.bx_handler.moveTo("center", "100");
        return false
    },
    showRegOpenidBox: function (data) {
        zmContent.initBoxy();
        zmContent.hideAllBxContent();
        try {
            zmContent.bx_handler.show()
        } catch (err) {
            console.log(err)
        }
        if (data.content) {
            var tmp = replaceAll(data.content, "\\", "");
            zmContent.appendBxContent("zmefrmregopenid", tmp);
            zm("#" + zmWgConfig.xregister_btn).click(function () {
                zmXLoginWg.doOpenidReg()
            })
        }
        zm("#zmefrmregopenid").show();
        zmContent.bx_handler.moveTo("center", "100");
        return false
    },
    showRegMap: function (resp) {
        zmContent.initBoxy();
        zmContent.hideAllBxContent();
        try {
            zmContent.bx_handler.show()
        } catch (err) {
            console.log(err)
        }
        if (resp != "") {
            zmXLoginWgdata = resp.oauthData;
            zmXLoginWg.mapacc = resp.acn;
            zmXLoginWg.strData = resp.oauthData;
            zmXLoginWg.provider = "FACEBOOK";
            var content = resp.data;
            if (content) {
                zmContent.appendBxContent("zmefrmregmap", content);
                zm("#" + zmWgConfig.regmap_btn).click(function () {
                    zmXLoginWg.doUpdate()
                })
            }
        }
        zm("#zmefrmregmap").show();
        zmContent.bx_handler.moveTo("center", "100");
        zm("#map_pwd").focus();
        return false
    },
    showBanBox: function () {
        zmContent.initBoxyAlert();
        zmContent.bx_alert.changeSettings({
            footer: true,
            okButton: zmWgConfig.msg.ok,
            onOk: true,
            cancelButton: false,
            title: zmWgConfig.msg.login
        });
        zmContent.hideAllBxContent();
        if (!zmContent.appendBxAlertContent("banned", zmWgConfig.msg.baned_account)) {
            zm("#banned").show()
        }
        try {
            zmContent.bx_hanbx_alertdler.show()
        } catch (err) {}
        zmContent.bx_alert.moveTo("center", "100");
        return false
    },
    showLoginError: function (content) {
        if (!content) {
            content = zmWgConfig.msg.invalid_account
        }
        zm("#lblError").html(content).show()
    },
    hideLoginError: function () {
        zm("#lblError").hide()
    },
    showLoading: function (content) {
        zmContent.initBoxyAlert();
        zmContent.bx_alert.changeSettings({
            title: zmWgConfig.msg.title_loading,
            footer: false,
            closeButton: false
        });
        zmContent.hideAllBxContent();
        var msg = content;
        if (content == "" || content == undefined) {
            msg = zmWgConfig.msg.loading
        }
        zmContent.appendBxAlertContent("loading", msg);
        zm("#loading").show();
        try {
            zmContent.bx_alert.show()
        } catch (err) {}
        zm("#loading").addClass("zme_loading");
        zm("#loading").addClass("wg_loading");
        zmContent.bx_alert.moveTo("center", "100");
        return false
    },
    showMsgBox: function (content) {
        zmContent.initBoxyAlert();
        zmContent.bx_alert.changeSettings({
            footer: true,
            okButton: zmWgConfig.msg.ok,
            onOk: true,
            cancelButton: false,
            title: zmWgConfig.msg.errtitle
        });
        zmContent.hideAllBxContent();
        if (content) {
            zmContent.appendBxAlertContent("errorbox", '<div class="titloginby" align="center"><strong>' + content + "</strong></div>");
            zm("#errorbox").show();
            try {
                zmContent.bx_alert.show()
            } catch (err) {}
            zm("#errorbox").addClass("zme_errorbox");
            zmContent.bx_alert.moveTo("center", "100");
            setTimeout(function () {
                zmContent.hideAndClearBoxy()
            }, 2000)
        }
        return false
    },
    showExpireBox: function (content) {
        zmContent.initBoxyAlert();
        zmContent.bx_alert.changeSettings({
            footer: true,
            okButton: zmWgConfig.msg.ok,
            onOk: true,
            cancelButton: false,
            title: zmWgConfig.msg.errtitle
        });
        zmContent.hideAllBxContent();
        if (content) {
            zmContent.appendBxAlertContent("errorbox", content);
            zm("#errorbox").show()
        } else {
            if (!zmContent.appendBxAlertContent("errorbox", zmWgConfig.msg.error)) {
                zm("#errorbox").show()
            }
        }
        try {
            zmContent.bx_alert.show()
        } catch (err) {}
        zmContent.bx_alert.moveTo("center", "100");
        return false
    },
    showErrorBox: function (content) {
        zmContent.initBoxyAlert();
        zmContent.bx_alert.changeSettings({
            footer: true,
            okButton: zmWgConfig.msg.ok,
            onOk: true,
            cancelButton: false,
            title: zmWgConfig.msg.errtitle
        });
        zmContent.hideAllBxContent();
        if (content) {
            zmContent.appendBxAlertContent("errorbox", content);
            zm("#errorbox").show()
        } else {
            if (!zmContent.appendBxAlertContent("errorbox", zmWgConfig.msg.error)) {
                zm("#errorbox").show()
            }
        }
        try {
            zmContent.bx_alert.show()
        } catch (err) {}
        zmContent.bx_alert.moveTo("center", "100");
        return false
    },
    showError: function (id, content) {
        try {
            zm("#" + id + "_error").html(content);
            zm("#" + id + "_error").show();
            var oldClass = zm("#" + id).attr("class");
            if (oldClass != undefined) {
                oldClass = oldClass.replace(" invalid", "");
                zm("#" + id).attr("class", oldClass + " invalid")
            }
        } catch (err) {}
        return false
    },
    showAccountValid: function (data) {
        zm("#frmAccountError").hide();
        zm("#btnChkZaccount").hide();
        zm("#btnChkZaccount").attr("rel", 1);
        zm("#chk_fullname_ok").show()
    },
    showAccountInvalid: function (data) {
        zm("#frmAccountError").html(data.content);
        zm("#frmAccountError").show();
        zm("#btnChkZaccount").attr("rel", 0);
        zm("#btnChkZaccount").show();
        zm("#chk_fullname_ok").hide()
    },
    showReqAccountValid: function (data) {
        zm("#reg_account_desc").show();
        zmContent.hideMappingError("reg_account");
        zm("#reg_checkacc").hide();
        zm("#reg_checkacc").attr("rel", 1);
        zm("#chk_acc_ok").show()
    },
    showReqAccountInvalid: function (data) {
        zmContent.hideMappingError("reg_account_desc");
        zmContent.showError("reg_account", data.content);
        zm("#reg_checkacc").attr("rel", 0);
        zm("#reg_checkacc").show();
        zm("#chk_acc_ok").hide()
    },
    hideMappingError: function (id) {
        zm("#" + id + "_error").hide();
        var oldClass = zm("#" + id).attr("class");
        if (oldClass != undefined) {
            oldClass = oldClass.replace(" invalid", "");
            zm("#" + id).attr("class", oldClass)
        }
        return false
    }
};

function enterPressed(evn) {
    zm(".Notice").hide();
    if (window.event && window.event.keyCode == 13) {
        zmXLoginWg.doUpdate()
    }
}

function replaceAll(string, token, newtoken) {
    if (token != newtoken) {
        while (string.indexOf(token) > -1) {
            string = string.replace(token, newtoken)
        }
    }
    return string
}
zmXLoginWg = {
    maxretry: 60,
    srcid: "",
    reqid: "",
    retry: 0,
    timer: null,
    provider: "zingme",
    pu_handler: null,
    data: "",
    callback: "",
    boxy: new zm.Boxy({
        title: zmWgConfig.msg.mapping,
        autoFocus: false,
        animated: false
    }),
    logincb: function (acn, zid, uin, authcode) {
        zmContent.hideAndClearBoxy();
        zmWgEvent.fire("zmLogin", zmWgConfig.zme_widget_callback_data, acn, zid, uin, authcode, {
            register: false,
            provider: zmXLoginWg.provider,
            logged: false
        });
        zmWgEvent.clear("zmLogin")
    },
    regcb: function (acn, zid, uin, authcode) {
        zmContent.hideAndClearBoxy();
        zmWgEvent.fire("zmLogin", zmWgConfig.zme_widget_callback_data, acn, zid, uin, authcode, {
            register: true,
            provider: zmXLoginWg.provider,
            logged: false
        });
        zmWgEvent.clear("zmLogin")
    },
    getYahooPopupUrl: function (zmxcid) {
        var params = {
            apikey: zmWgConfig.apikey,
            pid: zmWgConfig.pid,
            callback: "openidRegisterCallback",
            zmxcid: zmxcid,
            protocol:encodeURI(window.location.protocol),
            t: Math.floor(Math.random() * 10000)
        };
        params = zm.param(params);
        var url = zmWgConfig.openIdUrl + "?" + params;
        return url
    },
    getPopupUrl: function (zmxcid, provider) {
        var callback = zmWgConfig.xloginUrl + "/oauthcb?";
        var params = {
            zmxcid: zmxcid,
            apikey: zmWgConfig.apikey,
            pid: zmWgConfig.pid,
            protocol:encodeURI(window.location.protocol),
            tpl: zmWgConfig.tpl
        };
        params = zm.param(params);
        callback = (callback + params);
        params = {
            provider: provider,
            callback: callback,
            t: Math.floor(Math.random() * 10000)
        };
        params = zm.param(params);
        var url = zmWgConfig.idxUrl + "/oauth/dialog?" + params;
        if ((zmWgConfig.sharefb_type != "") && (provider == "facebook")) {
            url = url + "&sharefb=" + zmWgConfig.sharefb_type
        }
        return url
    },
    openPopup: function (provider, callback_name) {
        var zmxcid = zmXCall.getXCallID();
        subscribed = false;
        if (typeof callback_name !== "undefined") {
            function callback() {}
            callback = eval("window." + callback_name);
            if (typeof callback == "function") {
                zmWgEvent.clear("zmLogin");
                zmWgEvent.subscribe("zmLogin", callback);
                subscribed = true
            }
        }
        if ((!subscribed) && (typeof (zmWgConfig.zme_widget_callback) == "function")) {
            zmWgEvent.clear("zmLogin", zmWgConfig.zme_widget_callback);
            zmWgEvent.subscribe("zmLogin", zmWgConfig.zme_widget_callback)
        }
        zmXCall.register("zmxLoginCallback", function (cbdata) {
            zmXLoginWg.pu_handler = null;
            zmXLoginWg.zmxLogin(cbdata)
        });
        if (zmXLoginWg.pu_handler != null && zmXLoginWg.pu_handler.closed == true) {
            zmXLoginWg.pu_handler = null
        }
        if (zmXLoginWg.provider != provider && zmXLoginWg.pu_handler != null) {
            zmXLoginWg.pu_handler.close()
        }
        if (zmXLoginWg.provider == provider && zmXLoginWg.pu_handler != null) {
            try {
                zmXLoginWg.pu_handler.focus();
                return false
            } catch (err) {
                zmXLoginWg.pu_handler = null
            }
        }
        zmXLoginWg.provider = provider;
        var url = "";
        if (provider == "yahoo") {
            url = zmXLoginWg.getYahooPopupUrl(zmxcid)
        } else {
            url = zmXLoginWg.getPopupUrl(zmxcid, provider)
        }
        zmXLoginWg.pu_handler = window.open(url, "_blank", "height=500,width=500,left=400, top=100", "resizable=yes", "scrollbars=no", "toolbar=no", "status=no");
        return zmXLoginWg.pu_handler
    },
    doOauthReg: function () {
        var content = '<div style="text-align: center;font-size: 13px;padding: 5px 50px;"><strong>Đang tiến hành đồng bộ dữ liệu. Vui lòng chờ</strong></div> <p align="center"><img src="https://stc-id.zing.vn/images/load_small.gif" alt="" /></p>';
        zmContent.showLoading(content);
        var params = {
            apikey: zmWgConfig.apikey,
            pid: zmWgConfig.pid,
            data: zmXLoginWg.data,               
            referer: zmWgConfig.referer,
            client_url: zmWgConfig.client_url,
            _src: zmWgConfig._src,
            utm_source: zmWgConfig.utm_source,
            utm_medium: zmWgConfig.utm_medium,
            utm_term: zmWgConfig.utm_term,
            utm_content: zmWgConfig.utm_content,
            utm_campaign: zmWgConfig.utm_campaign
        };
        params = zm.param(params);
        var url = zmWgConfig.xloginUrl + "/oauthreg?" + params;
        zm.getJSON(url, function (data) {
            if (data.code === "error") {
                zmContent.showMsgBox("Quá trình kết nối bị gián đoạn. Vui lòng thử lại.")
            } else if(data.code === "missinfo") {
		if (window.location.host !== "id.zing.vn") {
		  window.open("https://id.zing.vn","_blank");
		}
                zmXLoginWg.regcb(data.acn, data.zid, data.uin, data.authcode);
            } else {
                zmXLoginWg.regcb(data.acn, data.zid, data.uin, data.authcode);
            } 
        });
    },
    doOpenidReg: function () {
        zmContent.hideAndClearBoxy();
        var content = '<div style="text-align: center;font-size: 13px;padding: 5px 50px;"><strong>Đang tiến hành đồng bộ dữ liệu. Vui lòng chờ</strong></div> <p align="center"><img src="https://stc-id.zing.vn/images/load_small.gif" alt="" /></p>';
        zmContent.showLoading(content);
        var params = {
            apikey: zmWgConfig.apikey,
            pid: zmWgConfig.pid,
            data: zmXLoginWg.data,            
            referer: zmWgConfig.referer,
            client_url: zmWgConfig.client_url,
            _src: zmWgConfig._src,
            utm_source: zmWgConfig.utm_source,
            utm_medium: zmWgConfig.utm_medium,
            utm_term: zmWgConfig.utm_term,
            utm_content: zmWgConfig.utm_content,
            utm_campaign: zmWgConfig.utm_campaign
        };
        params = zm.param(params);
        var url = zmWgConfig.xloginUrl + "/openidreg?" + params;
        zm.getJSON(url, function (data) {
            if (data.code === "error") {
                zmContent.showMsg("Quá trình kết nối bị gián đoạn. Vui lòng thử lại.")
            } else {
                zmXLoginWg.regcb(data.acn, data.zid, data.uin, data.authcode)
            }
        })
    },
    doUpdate: function () {
        var val = zmXLoginWgdata;
        var pwd = zm("#map_pwd").val();
        if (pwd == "" || pwd.length > 32 || pwd.length < 6) {
            zmContent.showError("pwd", "Vui lòng nhập mật khẩu từ 6 đến 32 ký tự");
            return false
        }
        var params = {
            val: val,
            apikey: zmWgConfig.apikey,
            pid: zmWgConfig.pid,
            acn: zmXLoginWg.mapacc,
            provider: zmXLoginWg.provider,
            pwd: pwd,
            referer: zmWgConfig.referer,
            client_url: zmWgConfig.client_url,
            _src: zmWgConfig._src,
            utm_source: zmWgConfig.utm_source,
            utm_medium: zmWgConfig.utm_medium,
            utm_term: zmWgConfig.utm_term,
            utm_content: zmWgConfig.utm_content,
            utm_campaign: zmWgConfig.utm_campaign
        };
        params = zm.param(params);
        var url = zmWgConfig.xloginUrl + "/doregmap?" + params;
        var content = '<div style="text-align: center;font-size: 13px;padding: 5px 50px;"><strong>Đang tiến hành đồng bộ dữ liệu. Vui lòng chờ</strong></div> <p align="center"><img src="https://stc-id.zing.vn/images/load_small.gif" alt="" /></p>';
        zmContent.hideAllBx();
        zm.getJSON(url, function (data) {
            if (data.code != "error") {
                zmContent.hideAllBx();
                var content = '<div class="updatemsg"><span class="checkdoneicn"></span>Kết nối thành công.</div>';
                zm.Boxy.alert(content, "", 1000, {
                    footer: false,
                    closeButton: false,
                    contentClass: "title-alert"
                });
                setTimeout(function () {
                    zmXLoginWg.regcb(data.acn, data.zid, data.uin, data.authcode)
                }, 1000)
            } else {
                if (data.msg != "") {
                    zmContent.showRegMap("");
                    zmContent.showError("pwd", data.msg);
                    return false
                } else {
                    zmContent.showErrorBox(zmContent.msg.connect_error)
                }
            }
            return false
        });
        return false
    }
};
zmXCall.register("oauthCb", function (resp) {
    zmContent.hideAndClearBoxy();
    if (resp.code === "success") {
        var content = '<div style="text-align: center;font-size: 13px;padding: 5px 50px;"><strong>Đang tiến hành kết nối. Vui lòng chờ</strong></div> <p align="center"><img src="https://stc-id.zing.vn/images/load_small.gif" alt="" /></p>';
        zmContent.showLoading(content);
        setTimeout(function () {
            zmXLoginWg.logincb(resp.acn, resp.zid, resp.uin, resp.authcode)
        }, 500);
        return false
    } else {
        if (resp.code === "banned") {
            zm.Boxy.alert('<div style="text-align: center;">Tài khoản ' + resp.acn + " đã bị khóa.<br>Vui lòng liên hệ <strong>1900.561.558</strong> để được hỗ trợ.</div>", "Thông báo", false, {
                okButton: "Đồng ý"
            })
        } else {
            if (resp.code === "reg") {
                zmContent.showRegOauthBox(resp)
            } else {
                if (resp.code === "regmap") {
                    zmContent.showRegMap(resp)
                } else {
                    if (resp.code === "error") {
                        zm.Boxy.alert(zmWgConfig.msg.connect_error, "Thông báo", false, {
                            okButton: "Đồng ý"
                        })
                    } else {
                        zm.Boxy.alert(zmWgConfig.msg.connect_error, "Thông báo", false, {
                            okButton: "Đồng ý"
                        })
                    }
                }
            }
        }
    }
});
zmXCall.register("openidRegisterCallback", function (resp) {
    zmContent.hideAndClearBoxy();
    if (resp.error != 0) {
        zm.Boxy.alert(zmWgConfig.msg.connect_error, "Thông báo", false, {
            okButton: "Đồng ý"
        })
    } else {
        zmXLoginWg.data = resp.authdata;
        var url = zmWgConfig.xloginUrl + "/openidcb?data=" + resp.authdata + "&apikey=" + zmWgConfig.apikey + "&pid=" + zmWgConfig.pid;
        zm.getJSON(url, function (data) {
            if (data.error == 6) {
                zm.Boxy.alert('<div style="text-align: center;">Tài khoản ' + data.acn + " đã bị khóa.<br>Vui lòng liên hệ <strong>1900.561.558</strong> để được hỗ trợ.</div>", "Thông báo", false, {
                    okButton: "Đồng ý"
                });
                return false
            } else {
                if (data.error != 0) {
                    zm.Boxy.alert(zmWgConfig.msg.connect_error, "Thông báo", false, {
                        okButton: "Đồng ý"
                    });
                    return false
                }
            }
            if (data.login === "true") {
                if (data.callback === "undefined" || data.callback === "") {}
                var content = '<div style="text-align: center;font-size: 13px;padding: 5px 50px;"><strong>Đang tiến hành kết nối. Vui lòng chờ</strong></div> <p align="center"><img src="https://stc-id.zing.vn/images/load_small.gif" alt="" /></p>';
                zmContent.showLoading(content);
                setTimeout(function () {
                    zmXLoginWg.logincb(data.acn, data.zid, data.uin, data.authcode)
                }, 500);
                return false
            } else {
                if (data.reg === "true") {
                    zmContent.showRegOpenidBox(data)
                }
            }
        })
    }
});
var zmWgRegister = {
    captcha_url: "https://captcha2.zing.vn",
    zmRegister: function (ele, callback_name) {
        subscribed = false;
        if (typeof callback_name !== "undefined") {
            function callback() {}
            callback = eval("window." + callback_name);
            if (typeof callback == "function") {
                zmWgEvent.clear("zmRegister");
                zmWgEvent.subscribe("zmRegister", callback);
                subscribed = true
            }
        }
        if ((!subscribed) && (typeof (zmWgConfig.zme_widget_callback) == "function")) {
            zmWgEvent.clear("zmRegister");
            zmWgEvent.subscribe("zmRegister", zmWgConfig.zme_widget_callback)
        }
        var params = {
            r: Math.floor(Math.random() * 10000),
            tpl: zmWgConfig.tpl,
            method: "register",
            apikey: zmWgConfig.apikey,
            pid: zmWgConfig.pid,
            referer: zmWgConfig.referer,
            client_url: zmWgConfig.client_url,
            protocol:encodeURI(window.location.protocol),
            _src: zmWgConfig._src,
            utm_source: zmWgConfig.utm_source,
            utm_medium: zmWgConfig.utm_medium,
            utm_term: zmWgConfig.utm_term,
            utm_content: zmWgConfig.utm_content,
            utm_campaign: zmWgConfig.utm_campaign
        };
        if (ele) {
            var acn = zm(ele).attr("data-acn");
            var fullname = zm(ele).attr("data-fullname");
            var dob = zm(ele).attr("data-dob");
            var email = zm(ele).attr("data-email");
            var checksum = zm(ele).attr("data-checksum");
            if (acn != undefined && acn != "") {
                params.acn = acn
            }
            if (fullname != undefined && fullname != "") {
                params.fullname = fullname
            }
            if (dob != undefined && dob != "") {
                params.dob = dob
            }
            if (email != undefined && email != "") {
                params.email = email
            }
            if (checksum != undefined && checksum != "") {
                params.checksum = checksum
            }
        }
        params = zm.param(params);
        var url = zmWgConfig.registerUrl + "?" + params;
        zm.getJSON(url, function (data) {
            switch (data.status) {
                case 0:
                    var register_callback = function (data) {
                        zmContent.hideAndClearBoxy();
                        zmWgEvent.fire("zmRegister", zmWgConfig.zme_widget_callback_data, data.acn, data.zid, data.uin, data.autcode, {
                            register: false,
                            provider: "zingme",
                            logged: false
                        });
                        zmWgEvent.clear("zmRegister")
                    };
                    zmXCall.register("zmRegisterCallback", register_callback);
                    zmContent.showRegisterBox(data.content);
                    if (zm("#token_new").size() > 0) {
                        zmWgRegister.refressNewCaptcha();
                    }
                    setTimeout(function () {
                        var action = zm("#frmRegister").attr("action");
                        var zmxcid = zmXCall.getXCallID();
                        action = action + "?zmxcid=" + zmxcid;
                        zm("#frmRegister").attr("action", action);
                        var zxaccount = zm("#reg_account").val();
                        zm("#reg_account").focus();
                        zm("#reg_account").keypress(function () {
                            zmContent.hideMappingError("reg_account_error")
                        });
                        zm("#reg_account").blur(function () {
                            var zxaccount = zm("#reg_account").val();
                            if (zxaccount == "") {
                                return false
                            }
                            zmWgRegister.checkZAccount(zxaccount);
                            return false
                        });
                        zm("#reg_checkacc").click(function () {
                            var zxaccount = zm("#reg_account").val();
                            if (zxaccount == "") {
                                zmContent.showError("reg_account", "Bạn phải nhập Tài khoản");
                                return false
                            }
                            zmWgRegister.checkZAccount(zxaccount);
                            return false
                        });
                        zm("#frmRegister").keypress(function (e) {
                            if (e.keyCode == "13") {
                                zmWgRegister.zmDoRegister()
                            }
                        });
                        zm("#req_login").click(function (e) {
                            zmWgLogin.zmLogin()
                        })
                    }, 500);
                    break;
                case 1:
                    zmContent.hideAndClearBoxy();
                    zmWgEvent.fire("zmRegister", zmWgConfig.zme_widget_callback_data, data.acn, data.zid, data.uin, data.autcode, {
                        register: false,
                        provider: "zingme",
                        logged: true
                    });
                    zmWgEvent.clear("zmRegister");
                    break
            }
            return false
        });
        return false
    },
    checkZAccount: function (account) {
        if (account.length > 24 || account.length < 6) {
            var data = {
                content: "Vui lòng nhập Tài khoản từ 6 đến 24 ký tự"
            };
            zmContent.showReqAccountInvalid(data);
            zm("#reg_checkacc").attr("rel", 0);
            return false
        }
        var url = zmWgConfig.registerUrl + "?method=chkacc&apikey=" + zmWgConfig.apikey + "&pid=" + zmWgConfig.pid + "&account=" + account;
        zm.getJSON(url, function(data) {
            if (data.error == 0) {
                zm("#reg_checkacc").attr("rel", 1);
                zmContent.showReqAccountValid(data)
            } else if (data.error == 1) {
                data.content = "Tài khoản này đã tồn tại.";
                zmContent.showReqAccountInvalid(data);
                zm("#reg_checkacc").attr("rel", 0)
            } else if (data.error == 2) {
                data.content = "Tài khoản không hợp lệ.";
                zmContent.showReqAccountInvalid(data);
                zm("#reg_checkacc").attr("rel", 0)
            } 
        });
        return false
    },
    zmDoRegister: function () {
        var zxaccount = zm("#reg_account").val();
        if (zxaccount == "") {
            zmContent.showError("reg_account", "Bạn phải nhập Tài khoản");
            return false
        }
        if (zxaccount.length > 24 || zxaccount.length < 6) {
            zmContent.showError("reg_account", "Vui lòng nhập Tài khoản từ 6 đến 24 ký tự");
            return false
        }
        if (zm("#reg_checkacc").attr("rel") == 1) {
            zmContent.hideMappingError("reg_account")
        } else {
            return false
        }
        var pwd = zm("#reg_pwd").val();
        if (pwd == "") {
            zm("#reg_pwd").focus();
            zmContent.showError("reg_pwd", "Vui lòng nhập mật khẩu");
            return false
        }
        if (pwd.length > 32 || pwd.length < 6) {
            zm("#reg_pwd").focus();
            zmContent.showError("reg_pwd", "Vui lòng nhập mật khẩu từ 6 đến 32 ký tự");
            return false
        }
        zmContent.hideMappingError("reg_pwd");
        var conpwd = zm("#reg_cpwd").val();
        if (conpwd != pwd) {
            zm("#reg_cpwd").focus();
            zmContent.showError("reg_cpwd", "Nhập lại mật khẩu không giống");
            return false
        }
        zmContent.hideMappingError("reg_dob");
        var dob = zm("#dob").val();
        var mob = zm("#mob").val();
        var yob = zm("#yob").val();
        if (dob !== undefined || mob !== undefined || yob !== undefined) {
            if (dob === "0" || mob === "0" || yob === "0") {
                zmContent.showError("reg_dob", "Ngày tháng không hợp lệ");
                return false
            }
        }
        zmContent.hideMappingError("reg_gender");
        var gender = zm("[name=gender]:checked").val();
        if (gender !== undefined) {
            if (gender !== "0" && gender !== "1") {
                zmContent.showError("reg_gender", "Vui lòng chọn Giới tính");
                return false
            }
        }
        zmContent.hideMappingError("reg_cpwd");
        var captcha = zm("#veryfied_code").val();
        if (captcha !== undefined) {
            if (captcha.length != 6) {
                zm("#veryfied_code").focus();
                zmContent.showError("reg_captcha", "Vui lòng nhập đúng mã xác nhận");
                zmContent.showError("veryfied_code", "Vui lòng nhập đúng mã xác nhận");
                return false
            }
            zmContent.hideMappingError("reg_captcha")
        }
        if (zm("#ragree").attr("checked") != true) {
            zm("#ragree").focus();
            zmContent.showError("reg_agree", "Vui lòng đồng ý với thỏa thuận sử dụng");
            return false
        }
        zmContent.hideMappingError("reg_agree");
        zmXCall.register("zmDoRegCallback", function (data) {
            switch (data.error) {
                case -1:
                    zmContent.showExpireBox(data.content);
                    setTimeout(function () {
                        window.location.reload()
                    }, 3000);
                    return false;
                case 0:
                    zmContent.hideAndClearBoxy();
                    zmWgEvent.fire("zmRegister", zmWgConfig.zme_widget_callback_data, data.acn, data.zid, data.uin, data.autcode, {
                        register: true,
                        provider: "zingme"
                    });
                    zmWgEvent.clear("zmRegister");
                    return false;
                case 1:
                    zmContent.showRegisterBox();
                    zmContent.showReqAccountInvalid(data);
                    break;
                case 2:
                    zmContent.showRegisterBox();
                    zmContent.showError("reg_pwd", data.content);
                    break;
                case 3:
                    zmContent.showRegisterBox();
                    zmContent.showError("reg_gender", data.content);
                    break;
                case 4:
                    zmContent.showRegisterBox();
                    zmContent.showError("reg_dob", data.content);
                    break;
                case 5:
                    zmContent.showRegisterBox();
                    zmContent.showError("veryfied_code", data.content);
                    break;
            }
            zm("#veryfied_code").val("");
            if (zm("#token").size() > 0) {
                zmWgRegister.refressCaptcha()
            }else if (zm("#token_new").size() > 0) {
                zmWgRegister.refressNewCaptcha()
            }
        });
        zmContent.showLoading();
        zm("#frmRegister").submit();
        return false
    },
    refressNewCaptcha: function() {
        var captcha2_url = "https://captcha2.zing.vn/captcha2";
        zm.getJSON(captcha2_url + "/gettoken?publicKey=" + zmWgConfig.apikey, function(data) {
            zm("#captcha").attr("src", captcha2_url + "/getcaptcha?publicKey=" + zmWgConfig.apikey + "&token=" + data.token);
            zm("#token_new").val(data.token);
        });
    },
    refressCaptcha: function () {
        var token = zm("#token").val();
        var d = new Date();        
        var url = zmWgRegister.captcha_url+"/getcaptcha?token="+token+"&ts="+d.getTime();
        zm("#captcha").attr("src", url)
    }
};
var zmWgLogin = {
    zme_login_tpl: "default",
    zme_login_consumer: "zme",
    getUrlParam : function(parameter){
        var currLocation = window.location.search;
        var SearchString = currLocation.substring(1);
        var VariableArray = SearchString.split('&');
        for(var i = 0; i < VariableArray.length; i++){
            var KeyValuePair = VariableArray[i].split('=');
            if(KeyValuePair[0] == parameter){
                return KeyValuePair[1];
            }
        }
        return "";
    },
    zmDoLogin: function () {
        zm("#zaccount").focus(function () {
            zmContent.hideLoginError()
        });
        zm("#zpwpd").focus(function () {
            zmContent.hideLoginError()
        });
        if (zm("#zaccount").val() == "" || zm("#zpwpd").val() == "") {
            zmContent.showLoginError(zmWgConfig.msg.input_account);
            return false
        }
        zmContent.showLoading();
        zm("#frmLogin").submit();
        return false
    },
    zmLogin: function (callback_name, apikey) {
        subscribed = false;
        if (typeof callback_name !== "undefined") {
            function callback() {}
            callback = eval("window." + callback_name);
            if (typeof callback == "function") {
                zmWgEvent.clear("zmLogin");
                zmWgEvent.subscribe("zmLogin", callback);
                subscribed = true
            }
        }
        if ((!subscribed) && (typeof (zmWgConfig.zme_widget_callback) == "function")) {
            zmWgEvent.clear("zmLogin");
            zmWgEvent.subscribe("zmLogin", zmWgConfig.zme_widget_callback)
        }
        var params = {
            r: Math.floor(Math.random() * 10000),
            tpl: zmWgConfig.tpl,
            apikey: zmWgConfig.apikey,
            pid: zmWgConfig.pid,
            referer: zmWgConfig.referer,
            client_url: zmWgConfig.client_url,
            _src: zmWgConfig._src,
            protocol:encodeURI(window.location.protocol),
            utm_source: zmWgConfig.utm_source,
            utm_medium: zmWgConfig.utm_medium,
            utm_term: zmWgConfig.utm_term,
            utm_content: zmWgConfig.utm_content,
            utm_campaign: zmWgConfig.utm_campaign
        };
        tpl = zmWgConfig.tpl;
        if (tpl) {
            params.tpl = tpl
        }
        params = zm.param(params);
        var url = zmWgConfig.loginUrl + "?" + params;
        zm.getJSON(url, function (data) {
            switch (data.status) {
                case 0:
                    var login_callback = function (respdata) {
                        if (respdata.error == 0) {
                            zmContent.hideAndClearBoxy();
                            zmWgEvent.fire("zmLogin", zmWgConfig.zme_widget_callback_data, respdata.acn, respdata.zid, respdata.uin, respdata.autcode, {
                                register: false,
                                provider: zmXLoginWg.provider,
                                logged: false
                            });
                            zmWgEvent.clear("zmLogin")
                        } else {
                            if (respdata.error == 2) {
                                zmContent.showBanBox()
                            } else {
                                if (respdata.error == -1) {
                                    if (zmWgConfig.callback_ex != "") {
                                        var changepass_url = respdata.acn;
                                        var newu1 = encodeURIComponent("https://id.zing.vn");
                                        var newchangepass_url = changepass_url.replace(/(u1=).*?(&)/, "$1" + newu1 + "$2");
                                        newchangepass_url = newchangepass_url.replace(/(fp=).*?(&)/, "$1" + newu1 + "$2");
                                        zmContent.hideAllBx();
                                        eval("window." + zmWgConfig.callback_ex + "('" + newchangepass_url + "')")
                                    } else {
                                        var changepass_url = respdata.acn;
                                        var newu1 = encodeURIComponent(location.href);
                                        var newchangepass_url = changepass_url.replace(/(u1=).*?(&)/, "$1" + newu1 + "$2");
                                        newchangepass_url = newchangepass_url.replace(/(fp=).*?(&)/, "$1" + newu1 + "$2");
                                        window.location.href = newchangepass_url
                                    }
                                } else {
                                    zmContent.showLoginBox();
                                    zmContent.showLoginError()
                                }
                            }
                        }
                    };
                    zmXCall.register("zmLoginCallback", login_callback);
                    zmContent.showLoginBox(data.content, tpl);
                    setTimeout(function () {
                        var u1 = zm("#u1").val();
                        var zmxcid = zmXCall.getXCallID();
                        u1 = u1 + encodeURIComponent("&zmxcid=" + zmxcid);
                        zm("#u1").val(u1);
                        var fp = zm("#fp").val();
                        fp = fp + "&zmxcid=" + zmxcid;
                        zm("#fp").val(fp);
                        zm("#zaccount").focus();
                        zm("#bntYahooLogin").click(function () {
                            zmXLoginWg.openPopup("yahoo",callback_name);
                            return false
                        });
                        zm("#bntGoogleLogin").click(function () {
                            zmXLoginWg.openPopup("google",callback_name);
                            return false
                        });
                        zm("#bntFacebookLogin").click(function () {
                            zmXLoginWg.openPopup("facebook",callback_name);
                            return false
                        });
                        zm("#link_register").click(function () {
                            zmWgRegister.zmRegister()
                        });
                        zm("#frmLogin").keypress(function (e) {
                            if (e.keyCode == "13") {
                                zmWgLogin.zmDoLogin()
                            }
                        })
                    }, 500);
                    break;
                case 1:
                    zmContent.hideAndClearBoxy();
                    zmWgEvent.fire("zmLogin", zmWgConfig.zme_widget_callback_data, data.acn, data.zid, data.uin, data.autcode, {
                        register: false,
                        provider: zmXLoginWg.provider,
                        logged: true
                    });
                    zmWgEvent.clear("zmLogin");
                    break;
                case 2:
                    zmContent.showBanBox();
                    break
            }
            return false
        });
        return false
    },
    zmDoLogout: function () {
        zm("#zaccount").focus(function () {
            zmContent.hideLoginError()
        });
        zm("#zpwpd").focus(function () {
            zmContent.hideLoginError()
        });
        if (zm("#zaccount").val() == "" || zm("#zpwpd").val() == "") {
            zmContent.showLoginError(zmWgConfig.msg.input_account);
            return false
        }
        zmContent.showLoading();
        zm("#frmLogin").submit();
        return false
    }
};

var zmeOpenWidget = {
    isInit: false,
    doLogin: function (callback_name) {
        try {
            var continue_process = true;
            if (typeof precallback == "function") {
                var cbdata = [data.precallback];
                continue_process = precallback.apply(precallback, cbdata)
            }
        } catch (err) {
            continue_process = false
        }
        if (continue_process == false) {
            return false
        }
        zmWgLogin.zmLogin(callback_name);
        return false
    },
    doRegister: function (ele, callback_name) {
        try {
            var continue_process = true;
            if (typeof precallback == "function") {
                var cbdata = [data.precallback];
                continue_process = precallback.apply(precallback, cbdata)
            }
        } catch (err) {
            continue_process = false
        }
        if (continue_process == false) {
            return false
        }
        zmWgRegister.zmRegister(ele, callback_name);
        return false
    },
    init: function (data) {
        if (!zmeOpenWidget.isInit) {
            zmeOpenWidget.isInit = true;
            zmWgConfig.callback = data.callback;
            zmWgConfig.apikey = data.apikey;
            zmWgConfig.referer = document.referrer;            
            zmWgConfig.client_url = encodeURIComponent(location.href.toString());            
            var _src = zmWgLogin.getUrlParam("_src");        
            var utm_source = zmWgLogin.getUrlParam("utm_source");        
            var utm_medium = zmWgLogin.getUrlParam("utm_medium");        
            var utm_term = zmWgLogin.getUrlParam("utm_term");        
            var utm_content = zmWgLogin.getUrlParam("utm_content");        
            var utm_campaign = zmWgLogin.getUrlParam("utm_campaign");
            zmWgConfig._src =_src;
            zmWgConfig.utm_source =utm_source;
            zmWgConfig.utm_medium = utm_medium;
            zmWgConfig.utm_term = utm_term;
            zmWgConfig.utm_content = utm_content;
            zmWgConfig.utm_campaign = utm_campaign;
            if (data.callback_ex != undefined) {
                zmWgConfig.callback_ex = data.callback_ex
            }
            if (data.sharefb_type != undefined) {
                zmWgConfig.sharefb_type = data.sharefb_type
            }
            if (data.tpl != undefined) {
                zmWgConfig.tpl = data.tpl
            }
            if (data.pid != undefined) {
                zmWgConfig.pid = data.pid
            }
            if (data.css != undefined) {
                zmWgConfig.css = data.css
            }
            var fileref = document.createElement("link");
            fileref.setAttribute("rel", "stylesheet");
            fileref.setAttribute("type", "text/css");
            fileref.setAttribute("href", zmWgConfig.css);
            zm("head").append(fileref);
            zmWgConfig.zme_widget_callback = eval("window." + zmWgConfig.callback);
            var continue_process = true;
            var precallback = eval("window." + data.precallback);
            zm("a[rel=zme-loginwg]").each(function () {
                zm(this).click(function () {
                    var callback_name = zm(this).attr("callback");
                    zmeOpenWidget.doLogin(callback_name)
                })
            });
            zm("a[rel=zme-registerwg]").each(function () {
                zm(this).click(function () {
                    var callback_name = zm(this).attr("callback");
                    zmeOpenWidget.doRegister(this, callback_name)
                })
            });
            if (zm("#zme-loginwg").size() > 0) {
                zm("#zme-loginwg").click(function () {
                    var callback_name = zm(this).attr("callback");
                    zmeOpenWidget.doLogin(callback_name)
                })
            }
            if (zm("#zme-registerwg").size() > 0) {
                zm("#zme-registerwg").click(function () {
                    var callback_name = zm(this).attr("callback");
                    zmeOpenWidget.doRegister(this, callback_name)
                })
            }
            if (zm("#btnFacebookLogin").size() > 0) {
                zm("#btnFacebookLogin").click(function () {
                    try {
                        if (typeof precallback == "function") {
                            var cbdata = [data.precallback];
                            continue_process = precallback.apply(precallback, cbdata)
                        }
                    } catch (err) {
                        continue_process = false
                    }
                    if (continue_process == false) {
                        return false
                    }
                    zmXLoginWg.openPopupForFacebook();
                    return false
                })
            }
            if (zm("#btnGoogleLogin").size() > 0) {
                zm("#btnGoogleLogin").click(function () {
                    try {
                        if (typeof precallback == "function") {
                            var cbdata = [data.precallback];
                            continue_process = precallback.apply(precallback, cbdata)
                        }
                    } catch (err) {
                        continue_process = false
                    }
                    if (continue_process == false) {
                        return false
                    }
                    zmXLoginWg.openPopupForGoogle();
                    return false
                })
            }
            if (zm("#btnTwitterLogin").size() > 0) {
                zm("#btnTwitterLogin").click(function () {
                    try {
                        if (typeof precallback == "function") {
                            var cbdata = [data.precallback];
                            continue_process = precallback.apply(precallback, cbdata)
                        }
                    } catch (err) {
                        continue_process = false
                    }
                    if (continue_process == false) {
                        return false
                    }
                    zmXLoginWg.openPopupForTwitter();
                    return false
                })
            }
            if (zm("#btnYahooLogin").size() > 0) {
                zm("#btnYahooLogin").click(function () {
                    try {
                        if (typeof precallback == "function") {
                            var cbdata = [data.precallback];
                            continue_process = precallback.apply(precallback, cbdata)
                        }
                    } catch (err) {
                        continue_process = false
                    }
                    if (continue_process == false) {
                        return false
                    }
                    zmXLoginWg.openPopupForYahoo();
                    return false
                })
            }
        }
    },
    decode: function (str) {
        var decode = decodeURIComponent,
        params = {}, parts = str.split("&"),
        i, pair;
        for (i = 0; i < parts.length; i++) {
            pair = parts[i].split("=");
            if (pair && pair[0]) {
                var name = pair.slice(0, 1);
                var tmp = pair.slice(1, pair.length);
                var value = tmp.join("=");
                params[decode(name)] = decode(value)
            }
        }
        return params
    }
};
window.setTimeout(function () {
    window.zAsyncInit();
    try{
        zmContent.initBoxy();
        zmContent.initBoxyAlert();
    }
    catch(err) {}
    
    window.setTimeout(function () {
        function __zt() {
            if (typeof (window.zt) != "undefined") {
                window.zt.dT()
            } else {
                setTimeout(__zt, 1000)
            }
        }
        if (document.getElementById("zmzt") == undefined) {
            var _zmzt = document.createElement("script");
            _zmzt.id = "zmzt";
            _zmzt.name = "zmzt";
            _zmzt.type = "text/javascript";
            _zmzt.src = "https://stc-id.zing.vn/login/js/zt-1.04-1.min.js";
            document.getElementsByTagName("head")[0].appendChild(_zmzt);
            setTimeout(__zt, 500)
        }
    }, 0)
}, 500);

var openWidgetConfig = document.createElement("script");
openWidgetConfig.setAttribute("type", "text/javascript");
if (window.location.protocol != "https:") {
    openWidgetConfig.setAttribute("src", "http://stc-id.zing.vn/widget/js/openwidget_config.js");
} else {
    openWidgetConfig.setAttribute("src", "https://stc-id.zing.vn/widget/js/openwidget_config.js");
}
zm("head").append(openWidgetConfig);
