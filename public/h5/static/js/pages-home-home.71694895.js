(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-home-home"],{"05d1":function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var i={props:{list:{type:Array,default:function(){return[]}},listKey:{type:String,default:""},show:{type:Boolean,default:!1}},watch:{show:function(t){t&&this.$emit("on-open")}},data:function(){return{statusBarHeight:0}},methods:{onSelectorClick:function(t){var e=this,n=this;setTimeout((function(){n.list[t].page&&n.$u.route({url:n.list[t].page}),e.$emit("on-select",t),e.clickMask()}),80)},clickMask:function(){this.$emit("update:show")}},created:function(){var t=this;uni.getSystemInfo({success:function(e){t.statusBarHeight=e.statusBarHeight}})},computed:{__selector_styles:function(){return"10rpx"},triangle_styles:function(){return"0rpx"}}};e.default=i},"288d":function(t,e,n){"use strict";n.r(e);var i=n("a62f"),o=n.n(i);for(var a in i)"default"!==a&&function(t){n.d(e,t,(function(){return i[t]}))}(a);e["default"]=o.a},"2c70":function(t,e,n){"use strict";var i=n("e42a"),o=n.n(i);o.a},3060:function(t,e,n){"use strict";n.d(e,"b",(function(){return o})),n.d(e,"c",(function(){return a})),n.d(e,"a",(function(){return i}));var i={uIcon:n("8f29").default},o=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-uni-view",{staticClass:"mask",class:t.show?"mask-show":"",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.clickMask.apply(void 0,arguments)}}},[n("v-uni-view",{staticStyle:{position:"relative",top:"0",left:"0","text-align":"right"}},[n("v-uni-view",{staticClass:"triangle",style:{top:t.triangle_styles}})],1),n("v-uni-view",{staticClass:"uni-combox__selector",style:{top:t.__selector_styles}},[n("v-uni-scroll-view",{staticClass:"uni-combox__selector-scroll",attrs:{"scroll-y":"true"}},t._l(t.list,(function(e,i){return n("v-uni-view",{key:i,staticClass:"uni-combox__selector-item",attrs:{"hover-class":"select-hover-class"},on:{click:function(e){e.stopPropagation(),arguments[0]=e=t.$handleEvent(e),t.onSelectorClick(i)}}},[e.icon?n("u-icon",{staticClass:"uni-combox__selector-item-icon",attrs:{name:e.icon}}):t._e(),n("v-uni-text",[t._v(t._s(e[t.listKey]))])],1)})),1)],1)],1)},a=[]},4602:function(t,e,n){var i=n("4d2a");"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var o=n("4f06").default;o("59e43286",i,!0,{sourceMap:!1,shadowMode:!1})},"4d2a":function(t,e,n){var i=n("24fb");e=i(!1),e.push([t.i,'@charset "UTF-8";\r\n/**\r\n * 这里是uni-app内置的常用样式变量\r\n *\r\n * uni-app 官方扩展插件及插件市场（https://ext.dcloud.net.cn）上很多三方插件均使用了这些样式变量\r\n * 如果你是插件开发者，建议你使用scss预处理，并在插件代码中直接使用这些变量（无需 import 这个文件），方便用户通过搭积木的方式开发整体风格一致的App\r\n *\r\n */\r\n/**\r\n * 如果你是App开发者（插件使用者），你可以通过修改这些变量来定制自己的插件主题，实现自定义主题功能\r\n *\r\n * 如果你的项目同样使用了scss预处理，你也可以直接在你的 scss 代码中使用如下变量，同时无需 import 这个文件\r\n */\r\n/* 颜色变量 */\r\n/* 行为相关颜色 */\r\n/* 文字基本颜色 */\r\n/* 背景颜色 */\r\n/* 边框颜色 */\r\n/* 尺寸变量 */\r\n/* 文字尺寸 */\r\n/* 图片尺寸 */\r\n/* Border Radius */\r\n/* 水平间距 */\r\n/* 垂直间距 */\r\n/* 透明度 */\r\n/* 文章场景相关 */.content .item[data-v-3a790e99]{width:%?750?%;display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-align:center;-webkit-align-items:center;align-items:center}.content .item uni-image[data-v-3a790e99]{width:%?76?%;height:%?76?%;margin:%?20?%;border-radius:%?12?%;-webkit-box-flex:0;-webkit-flex:0 0 %?76?%;flex:0 0 %?76?%;position:relative}.content .item .no-read[data-v-3a790e99]{position:absolute;border-radius:50%;min-width:%?40?%;line-height:%?40?%;height:%?40?%;top:%?10?%;left:%?70?%;background-color:red;color:#fff;display:block;text-align:center;z-index:99}.content .item .right[data-v-3a790e99]{overflow:hidden;-webkit-box-flex:1;-webkit-flex:1 0;flex:1 0;padding:%?20?% %?20?% %?20?% 0}.content .item .right_top[data-v-3a790e99]{display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-pack:justify;-webkit-justify-content:space-between;justify-content:space-between}.content .item .right_top_name[data-v-3a790e99]{font-size:%?28?%;color:#303133;-webkit-box-flex:0;-webkit-flex:0 0 %?450?%;flex:0 0 %?450?%;overflow:hidden}.content .item .right_top_time[data-v-3a790e99]{font-size:%?22?%;color:#c0c4cc}.content .item .right_btm[data-v-3a790e99]{display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-pack:justify;-webkit-justify-content:space-between;justify-content:space-between;-webkit-box-align:center;-webkit-align-items:center;align-items:center;font-size:%?22?%;color:#909399;padding-top:%?10?%}.content .bg_view[data-v-3a790e99]{background-color:#fafafa}.content .slot-wrap[data-v-3a790e99]{display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-align:center;-webkit-align-items:center;align-items:center;padding:0 %?30?%}',""]),t.exports=e},"5a0b":function(t,e,n){var i=n("24fb");e=i(!1),e.push([t.i,'@charset "UTF-8";\r\n/**\r\n * 这里是uni-app内置的常用样式变量\r\n *\r\n * uni-app 官方扩展插件及插件市场（https://ext.dcloud.net.cn）上很多三方插件均使用了这些样式变量\r\n * 如果你是插件开发者，建议你使用scss预处理，并在插件代码中直接使用这些变量（无需 import 这个文件），方便用户通过搭积木的方式开发整体风格一致的App\r\n *\r\n */\r\n/**\r\n * 如果你是App开发者（插件使用者），你可以通过修改这些变量来定制自己的插件主题，实现自定义主题功能\r\n *\r\n * 如果你的项目同样使用了scss预处理，你也可以直接在你的 scss 代码中使用如下变量，同时无需 import 这个文件\r\n */\r\n/* 颜色变量 */\r\n/* 行为相关颜色 */\r\n/* 文字基本颜色 */\r\n/* 背景颜色 */\r\n/* 边框颜色 */\r\n/* 尺寸变量 */\r\n/* 文字尺寸 */\r\n/* 图片尺寸 */\r\n/* Border Radius */\r\n/* 水平间距 */\r\n/* 垂直间距 */\r\n/* 透明度 */\r\n/* 文章场景相关 */.u-swipe-action[data-v-bbf71338]{width:auto;height:auto;position:relative;overflow:hidden}.u-swipe-view[data-v-bbf71338]{\r\ndisplay:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-direction:row;flex-direction:row;\r\nheight:auto;position:relative\r\n  /* 这一句很关键，覆盖默认的绝对定位 */}.u-swipe-content[data-v-bbf71338]{-webkit-box-flex:1;-webkit-flex:1;flex:1}.u-swipe-del[data-v-bbf71338]{position:relative;font-size:%?30?%;color:#fff}.u-btn-text[data-v-bbf71338]{position:absolute;top:50%;left:50%;-webkit-transform:translate(-50%,-50%);transform:translate(-50%,-50%)}',""]),t.exports=e},"5cd4":function(t,e,n){"use strict";var i=n("4602"),o=n.n(i);o.a},"83a0":function(t,e,n){"use strict";n.r(e);var i=n("b225"),o=n.n(i);for(var a in i)"default"!==a&&function(t){n.d(e,t,(function(){return i[t]}))}(a);e["default"]=o.a},"84ff":function(t,e,n){"use strict";n.r(e);var i=n("9018"),o=n("288d");for(var a in o)"default"!==a&&function(t){n.d(e,t,(function(){return o[t]}))}(a);n("5cd4");var s,r=n("f0c5"),c=Object(r["a"])(o["default"],i["b"],i["c"],!1,null,"3a790e99",null,!1,i["a"],s);e["default"]=c.exports},9018:function(t,e,n){"use strict";n.d(e,"b",(function(){return o})),n.d(e,"c",(function(){return a})),n.d(e,"a",(function(){return i}));var i={selectInput:n("a8dc").default,uSwipeAction:n("fd63").default},o=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-uni-view",{staticClass:"content"},[n("selectInput",{attrs:{list:t.selectList,"list-key":"name",show:t.selectShow},on:{"update:show":function(e){arguments[0]=e=t.$handleEvent(e),t.selectShow=e},"on-select":function(e){arguments[0]=e=t.$handleEvent(e),t.checkSelect.apply(void 0,arguments)},close:function(e){arguments[0]=e=t.$handleEvent(e),t.closeSelect.apply(void 0,arguments)}}}),n("searchInput"),t._l(t.list,(function(e,i){return n("u-swipe-action",{key:e.id,attrs:{show:e.show,index:i,"btn-width":"160",options:t.options},on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.click.apply(void 0,arguments)},open:function(e){arguments[0]=e=t.$handleEvent(e),t.open.apply(void 0,arguments)}}},[n("v-uni-view",{staticClass:"item",attrs:{"hover-class":"message-hover-class"},on:{click:function(n){arguments[0]=n=t.$handleEvent(n),t.linkTo(e)}}},[e.no_read>0?n("span",{staticClass:"no-read"},[t._v(t._s(e.no_read>99?99:e.no_read))]):t._e(),n("v-uni-image",{attrs:{mode:"aspectFill",src:e.other_user.avatar}}),n("v-uni-view",{staticClass:"right u-border-bottom title-wrap"},[n("v-uni-view",{staticClass:"right_top"},[n("v-uni-view",{staticClass:"right_top_name u-line-1"},[t._v(t._s(e.other_user.name))]),n("v-uni-view",{staticClass:"right_top_time "},[t._v(t._s(e.updated_at))])],1),n("v-uni-view",{staticClass:"right_btm "},[n("v-uni-view",{staticClass:"u-line-1"},[t._v(t._s(e.last_content))]),n("v-uni-view",{})],1)],1)],1)],1)}))],2)},a=[]},"9dc1":function(t,e,n){"use strict";var i;n.d(e,"b",(function(){return o})),n.d(e,"c",(function(){return a})),n.d(e,"a",(function(){return i}));var o=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-uni-view",{},[n("v-uni-movable-area",{staticClass:"u-swipe-action",style:{backgroundColor:t.bgColor}},[n("v-uni-movable-view",{staticClass:"u-swipe-view",style:{width:t.movableViewWidth?t.movableViewWidth:"100%"},attrs:{direction:"horizontal",disabled:t.disabled,x:t.moveX},on:{change:function(e){arguments[0]=e=t.$handleEvent(e),t.change.apply(void 0,arguments)},touchend:function(e){arguments[0]=e=t.$handleEvent(e),t.touchend.apply(void 0,arguments)},touchstart:function(e){arguments[0]=e=t.$handleEvent(e),t.touchstart.apply(void 0,arguments)}}},[n("v-uni-view",{staticClass:"u-swipe-content",on:{click:function(e){e.stopPropagation(),arguments[0]=e=t.$handleEvent(e),t.contentClick.apply(void 0,arguments)}}},[t._t("default")],2),t._l(t.options,(function(e,i){return t.showBtn?n("v-uni-view",{key:i,staticClass:"u-swipe-del",style:[t.btnStyle(e.style)],on:{click:function(e){e.stopPropagation(),arguments[0]=e=t.$handleEvent(e),t.btnClick(i)}}},[n("v-uni-view",{staticClass:"u-btn-text"},[t._v(t._s(e.text))])],1):t._e()}))],2)],1)],1)},a=[]},a62f:function(t,e,n){"use strict";(function(t){var i=n("4ea4");n("d81d"),n("a434"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var o=i(n("a95e")),a=i(n("a8dc")),s=i(n("125f")),r=n("1ed1"),c=n("b512"),l={components:{searchInput:o.default,selectInput:a.default},data:function(){return{page:1,list:[],selectShow:!1,options:[{text:"删除",style:{backgroundColor:"#dd524d",fontSize:"24rpx"}}],selectList:[{id:"1",name:"添加朋友",icon:"man-add-fill",page:"/pages/search/newFriend"}]}},methods:{showSelect:function(){this.selectShow=!this.selectShow},click:function(e,n){if(0==n){var i=this;t.log(i.list[e]),i.delById(i.list[e].id),i.list.splice(e,1)}},open:function(t){var e=this;this.list[t].show=!0,this.list.map((function(n,i){t!=i&&(e.list[i].show=!1)}))},onNavigationBarButtonTap:function(t){var e=t.index;0==e&&this.showSelect()},linkTo:function(t){this.$u.route({url:"pages/chat/chat",params:{id:t.other_user.id}})},closeSelect:function(){this.selectShow=!1},checkSelect:function(t){1==t&&(uni.vibrateLong(),uni.scanCode({success:function(t){this.$u.toast("条码类型:",t.scanType)}}))},getChatList:function(){var t=this,e=t.page,n={url:"".concat(s.default.chatList),data:{page:e},noToast:!0,sCallback:function(n){1==n.code&&n.data&&n.data.length>0&&(t.page=e+1,1==e&&(t.list=n.data,uni.setStorageSync("chatList:page:1",n.data)))}};(0,r.http_request)(n)},delById:function(t){var e=this,n=(e.page,{url:"".concat(s.default.chatHide),data:{id:t},type:"POST"});(0,r.http_request)(n)},wsNotifyMessage:function(){var t=this;t.page=1,t.getChatList()}},onLoad:function(){var e=this;(0,c.ws_conn)(),e.list=uni.getStorageSync("chatList:page:1"),(!e.list||e.list.length<1)&&(e.page=1),uni.onSocketMessage((function(n){var i=JSON.parse(n.data);t.log(i),i&&i.event&&"user.message"==i.event&&e.wsNotifyMessage()}))},onShow:function(){var t=this;t.page=1,t.getChatList()}};e.default=l}).call(this,n("5a52")["default"])},a8dc:function(t,e,n){"use strict";n.r(e);var i=n("3060"),o=n("b87f");for(var a in o)"default"!==a&&function(t){n.d(e,t,(function(){return o[t]}))}(a);n("c243");var s,r=n("f0c5"),c=Object(r["a"])(o["default"],i["b"],i["c"],!1,null,"1e3a4b92",null,!1,i["a"],s);e["default"]=c.exports},ae68:function(t,e,n){var i=n("e9c7");"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var o=n("4f06").default;o("1dcfc563",i,!0,{sourceMap:!1,shadowMode:!1})},b225:function(t,e,n){"use strict";n("a9e3"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var i={name:"u-swipe-action",props:{index:{type:[Number,String],default:""},btnWidth:{type:[String,Number],default:180},disabled:{type:Boolean,default:!1},show:{type:Boolean,default:!1},bgColor:{type:String,default:"#ffffff"},vibrateShort:{type:Boolean,default:!1},options:{type:Array,default:function(){return[]}}},watch:{show:{immediate:!0,handler:function(t,e){t?this.open():this.close()}}},data:function(){return{moveX:0,scrollX:0,status:!1,movableAreaWidth:0,elId:this.$u.guid(),showBtn:!1}},computed:{movableViewWidth:function(){return this.movableAreaWidth+this.allBtnWidth+"px"},innerBtnWidth:function(){return uni.upx2px(this.btnWidth)},allBtnWidth:function(){return uni.upx2px(this.btnWidth)*this.options.length},btnStyle:function(){var t=this;return function(e){return e.width=t.btnWidth+"rpx",e}}},mounted:function(){this.getActionRect()},methods:{btnClick:function(t){this.status=!1,this.$emit("click",this.index,t)},change:function(t){this.scrollX=t.detail.x},close:function(){this.moveX=0,this.status=!1},open:function(){this.disabled||(this.moveX=-this.allBtnWidth,this.status=!0)},touchend:function(){this.moveX=this.scrollX,this.$nextTick((function(){var t=this;0==this.status?this.scrollX<=-this.allBtnWidth/4?(this.moveX=-this.allBtnWidth,this.status=!0,this.emitOpenEvent(),this.vibrateShort&&uni.vibrateShort()):(this.moveX=0,this.status=!1,this.emitCloseEvent()):this.scrollX>3*-this.allBtnWidth/4?(this.moveX=0,this.$nextTick((function(){t.moveX=101})),this.status=!1,this.emitCloseEvent()):(this.moveX=-this.allBtnWidth,this.status=!0,this.emitOpenEvent())}))},emitOpenEvent:function(){this.$emit("open",this.index)},emitCloseEvent:function(){this.$emit("close",this.index)},touchstart:function(){},getActionRect:function(){var t=this;this.$uGetRect(".u-swipe-action").then((function(e){t.movableAreaWidth=e.width,t.$nextTick((function(){t.showBtn=!0}))}))},contentClick:function(){1==this.status&&(this.status="close",this.moveX=0),this.$emit("content-click",this.index)}}};e.default=i},b512:function(t,e,n){"use strict";(function(t){var i=n("4ea4");Object.defineProperty(e,"__esModule",{value:!0}),e.notifyFriend=e.ws_conn=void 0;var o=i(n("277c")),a=i(n("125f")),s=function(){uni.getStorageSync("userInfo")["id"];var e=a.default.wsUrl+"?token=".concat(o.default.getToken());uni.connectSocket({url:e,header:{"content-type":"application/json"},method:"GET",success:function(){},fail:function(){},complete:function(){}}),uni.onSocketOpen((function(e){t.log("WebSocket连接已打开！")})),uni.onSocketError((function(e){t.log("WebSocket连接打开失败，请检查！")})),uni.onSocketClose((function(e){t.log("WebSocket 已关闭！")}))};e.ws_conn=s;var r=function(t){var e=JSON.stringify(t);uni.sendSocketMessage({data:e})};e.notifyFriend=r}).call(this,n("5a52")["default"])},b87f:function(t,e,n){"use strict";n.r(e);var i=n("05d1"),o=n.n(i);for(var a in i)"default"!==a&&function(t){n.d(e,t,(function(){return i[t]}))}(a);e["default"]=o.a},c243:function(t,e,n){"use strict";var i=n("ae68"),o=n.n(i);o.a},e42a:function(t,e,n){var i=n("5a0b");"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var o=n("4f06").default;o("4b0bc1f8",i,!0,{sourceMap:!1,shadowMode:!1})},e9c7:function(t,e,n){var i=n("24fb");e=i(!1),e.push([t.i,'@charset "UTF-8";\r\n/**\r\n * 这里是uni-app内置的常用样式变量\r\n *\r\n * uni-app 官方扩展插件及插件市场（https://ext.dcloud.net.cn）上很多三方插件均使用了这些样式变量\r\n * 如果你是插件开发者，建议你使用scss预处理，并在插件代码中直接使用这些变量（无需 import 这个文件），方便用户通过搭积木的方式开发整体风格一致的App\r\n *\r\n */\r\n/**\r\n * 如果你是App开发者（插件使用者），你可以通过修改这些变量来定制自己的插件主题，实现自定义主题功能\r\n *\r\n * 如果你的项目同样使用了scss预处理，你也可以直接在你的 scss 代码中使用如下变量，同时无需 import 这个文件\r\n */\r\n/* 颜色变量 */\r\n/* 行为相关颜色 */\r\n/* 文字基本颜色 */\r\n/* 背景颜色 */\r\n/* 边框颜色 */\r\n/* 尺寸变量 */\r\n/* 文字尺寸 */\r\n/* 图片尺寸 */\r\n/* Border Radius */\r\n/* 水平间距 */\r\n/* 垂直间距 */\r\n/* 透明度 */\r\n/* 文章场景相关 */.mask[data-v-1e3a4b92]{width:100%;height:100%;overflow:hidden;position:absolute;top:0;left:0;z-index:0;background-color:initial;box-sizing:border-box;opacity:0;-webkit-transition:all .15s ease-in-out;transition:all .15s ease-in-out}.mask-show[data-v-1e3a4b92]{opacity:1;z-index:1000}.uni-combox__selector[data-v-1e3a4b92]{position:absolute;top:%?10?%;right:%?20?%;box-sizing:border-box;width:28%;background-color:#303133;border-radius:3px;box-shadow:#ddd 2px 2px 4px,#ddd -2px -2px 4px;z-index:998}.triangle[data-v-1e3a4b92]{position:absolute;width:0;height:0;border-bottom:solid 5px #303133;border-right:solid 5px transparent;border-left:solid 5px transparent;right:%?30?%;top:%?0?%;z-index:999}.uni-combox__selector-scroll[data-v-1e3a4b92]{max-height:150px;box-sizing:border-box}.uni-combox__selector-item[data-v-1e3a4b92]{font-size:%?24?%;padding:%?20?%;color:#fff;border-bottom:%?1?% solid #909399}.uni-combox__selector-item-icon[data-v-1e3a4b92]{padding-right:%?10?%}.uni-combox__selector-item[data-v-1e3a4b92]:last-child{border-bottom:none}',""]),t.exports=e},fd63:function(t,e,n){"use strict";n.r(e);var i=n("9dc1"),o=n("83a0");for(var a in o)"default"!==a&&function(t){n.d(e,t,(function(){return o[t]}))}(a);n("2c70");var s,r=n("f0c5"),c=Object(r["a"])(o["default"],i["b"],i["c"],!1,null,"bbf71338",null,!1,i["a"],s);e["default"]=c.exports}}]);