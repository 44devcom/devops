!function(t){var e={};function s(n){if(e[n])return e[n].exports;var a=e[n]={i:n,l:!1,exports:{}};return t[n].call(a.exports,a,a.exports,s),a.l=!0,a.exports}s.m=t,s.c=e,s.d=function(t,e,n){s.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:n})},s.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},s.t=function(t,e){if(1&e&&(t=s(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var n=Object.create(null);if(s.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var a in t)s.d(n,a,function(e){return t[e]}.bind(null,a));return n},s.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return s.d(e,"a",e),e},s.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},s.p="",s(s.s=0)}([function(t,e,s){"use strict";s.r(e);s(1);const{createElement:n,render:a,useState:i,useEffect:o,Fragment:d}=wp.element,{select:r,dispatch:l}=wp.data,u=t=>{const[e,s]=i(!0),[a,d]=i([]);return o(()=>{s(!0),fetch(`${window.mymodules.api}/mymodules?type=${t.type}&user_id=${t.settings.user_id}`,{method:"post",body:JSON.stringify({type:t.type,token:r("vibebp").getToken(),user_id:t.settings.user_id,number:t.settings.number})}).then(t=>t.ok?t.json():{status:0,message:window.wplms_course_data.translations.error_loading_data}).then(e=>{e.status&&d(e.data),s(!1),document.dispatchEvent(new CustomEvent("vibebp_widget_loaded",{detail:{props:t}}))}).catch(t=>{s(!1),console.error("Uh oh, an error!",t),l("vibebp").addNotification({text:window.wplms_course_data.translations.error_loading_data})})},[t.type]),n("div",{className:"dash-tab-content"},n("div",{className:"dash-tab-pane"},e?n("div",{className:"widget_loader"}," ",n("div",null),n("div",null),n("div",null),n("div",null)):a.length?n("ul",null,a.map(t=>n("li",null,n("a",{href:t.link,target:"_blank"},t.post_title)))):n("div",{className:"vbp_message"},window.mymodules.translations.not_found)))},c=t=>{const[e,s]=i(!0),[a,d]=i();return o(()=>{t.settings.course?d("course"):t.settings.quiz?d("quiz"):t.settings.assignment?d("assignment"):t.settings.unit?d("unit"):t.settings.unit?d("download"):t.settings.unit&&d("finished")},[]),n("div",{className:"wplms_dashboard_mymodules"},n("h3",{class:"widget_title"},t.settings.title),n("div",{className:"dash-tabs-wrapper"},t.settings.course?n("span",{className:"course"==a?"dash-tab-active":"dash-tab",onClick:()=>{d("course")}},window.mymodules.translations.course):"",t.settings.quiz?n("span",{className:"quiz"==a?"dash-tab-active":"dash-tab",onClick:()=>{d("quiz")}},window.mymodules.translations.quiz):"",t.settings.assignment?n("span",{className:"assignment"==a?"dash-tab-active":"dash-tab",onClick:()=>{d("assignment")}},window.mymodules.translations.assignment):"",t.settings.unit?n("span",{className:"unit"==a?"dash-tab-active":"dash-tab",onClick:()=>{d("unit")}},window.mymodules.translations.unit):"",t.settings.download?n("span",{className:"download"==a?"dash-tab-active":"dash-tab",onClick:()=>{d("download")}},window.mymodules.translations.download):"",t.settings.finished?n("span",{className:"finished"==a?"dash-tab-active":"dash-tab",onClick:()=>{d("finished")}},window.mymodules.translations.finished):""),n(u,{type:a,settings:t.settings}))};document.addEventListener("wplms_dash_mymodules",t=>{document.querySelector(".wplms_dashboard_mymodules")&&a(n(c,{settings:t.detail.widget.options}),document.querySelector(".wplms_dashboard_mymodules"))})},function(t,e,s){}]);