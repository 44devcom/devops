!function(t){var e={};function n(s){if(e[s])return e[s].exports;var r=e[s]={i:s,l:!1,exports:{}};return t[s].call(r.exports,r,r.exports,n),r.l=!0,r.exports}n.m=t,n.c=e,n.d=function(t,e,s){n.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:s})},n.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},n.t=function(t,e){if(1&e&&(t=n(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var s=Object.create(null);if(n.r(s),Object.defineProperty(s,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var r in t)n.d(s,r,function(e){return t[e]}.bind(null,r));return s},n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},n.p="",n(n.s=0)}([function(t,e,n){"use strict";n.r(e);n(1);const{createElement:s,render:r,useState:o,useEffect:i,Fragment:a}=wp.element,{select:u,dispatch:d}=wp.data,l=t=>{const[e,n]=o(!0),r=window.instructor_students,[l,c]=o([]),[_,p]=o({user_id:r.user_id,per_page:t.settings.number,page:1}),[f,g]=o(!0);i(()=>{m(_)},[]);const m=e=>{g(!0),fetch(`${r.api}/instrutor_students?args=${encodeURIComponent(JSON.stringify(e))}`,{method:"post",body:JSON.stringify({...e,token:u("vibebp").getToken()})}).then(t=>t.ok?t.json():{status:0,message:window.wplms_course_data.translations.error_loading_data}).then(s=>{if(s.status)if(1==e.page)c(s.data);else{let t=[...l];s.data.map(e=>{t.push(e)}),c(t)}else g(!1);n(!1),document.dispatchEvent(new CustomEvent("vibebp_widget_loaded",{detail:{props:t}}))}).catch(t=>{n(!1),console.error("Uh oh, an error!",t),d("vibebp").addNotification({text:window.wplms_course_data.translations.error_loading_data})})};return s("div",{className:"instrcutor_students"},s("h3",{class:"widget_title"},t.settings.title),e?s("div",null,s("div",{className:"widget_loader"},s("div",null),s("div",null),s("div",null),s("div",null))):s("div",{class:"instructor_students_widget_students_list"},l&&l.length?s(a,null,l.map(t=>s("div",{class:"student_item"},s("div",{class:"student_details"},s("strong",null,t.name)),s("div",{class:"course_details"},t.courses&&t.courses.length?s(a,null,t.courses.map(t=>s("div",{class:"student_course","data-course":t.id},t.title))):""))),f?s("a",{class:"instructor_load_more_students",onClick:()=>{let t={..._,page:_.page+1};m(t)}},r.translations.load_more):""):s("div",{className:"vbp_message"},s("p",null,r.translations.no_student))))};document.addEventListener("wplms_instructor_students_widget",t=>{document.querySelector(".wplms_instructor_student_widget")&&r(s(l,{settings:t.detail.widget.options}),document.querySelector(".wplms_instructor_student_widget"))})},function(t,e,n){}]);