!function(e){var t={};function n(i){if(t[i])return t[i].exports;var o=t[i]={i:i,l:!1,exports:{}};return e[i].call(o.exports,o,o.exports,n),o.l=!0,o.exports}n.m=e,n.c=t,n.d=function(e,t,i){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:i})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var i=Object.create(null);if(n.r(i),Object.defineProperty(i,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)n.d(i,o,function(t){return e[t]}.bind(null,o));return i},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=1)}([function(e,t,n){},function(e,t,n){"use strict";n.r(t);const{createElement:i,useState:o,useEffect:r,Fragment:a,render:l}=wp.element,{dispatch:s,select:d}=wp.data;var c=e=>{const[t,n]=o(!0),[l,c]=o(!0),[u,p]=o(null);r(()=>(document.addEventListener("coursebuttonpricingclicked",_),()=>{document.removeEventListener("coursebuttonpricingclicked",_)}),[]);const _=e=>{if(window.wplms_course_data&&window.wplms_course_data.is_app_page&&e.detail.hasOwnProperty("price")&&e.detail.price&&e.detail.price.length){e.detail.price.split("#");let t=[];e.detail.price.replace(/[#&]+([^=&]+)=([^&]*)/gi,(function(e,n,i){t[n]=i}));console.log(t);let i=0,o=!1;Object.keys(t).map(e=>{"component"==e&&"course"==t[e]&&(o=!0),"id"==e&&(i=t[e])}),o&&i&&(e.detail.original_event.preventDefault(),s("vibebp").setComponent("course"),s("vibebp").setAction("course"),s("vibebp").setId(i),n(!1))}};return r(()=>{c(!0),fetch(`${window.wplms_course_data.api_url}/course/singlecourse?client_id=${window.wplms_course_data.client_id}&nocache`,{method:"post",body:JSON.stringify({id:e.id,token:d("vibebp").getToken()})}).then(e=>e.ok?e.json():{status:0,message:window.wplms_course_data.translations.error_loading_data}).then(t=>{p(t),c(!1),setTimeout(()=>{var t=new CustomEvent("single_course_loaded",{detail:{id:e.id}});document.dispatchEvent(t)},200)}).catch(e=>{console.error("Uh oh, an error!",e),s("vibebp").addNotification({text:window.wplms_course_data.translations.error_loading_data})}),n(!0)},[e.id]),t?i("div",{className:"single_item_popup"},i("div",{className:"header"},i("span",null),i("span",{className:"button small",onClick:()=>{n(!1)}},i("span",{className:"vicon vicon-close"}),window.wplms_course_data.translations.close)),i("div",{className:"course_content"},l?i("div",{className:"loader"},i("div",{class:"lds-ellipsis"},i("div",null),i("div",null),i("div",null),i("div",null))):i(a,null,u.length?i("div",{className:"",dangerouslySetInnerHTML:{__html:u}}):""))):""};n(0);const{createElement:u,useState:p,useEffect:_,Fragment:m,render:v}=wp.element,{dispatch:g,select:f}=wp.data;document.addEventListener("course_card_clicked",e=>{if(e.detail.original_event.target.classList&&e.detail.original_event.target.classList.contains("course_video_popup")||e.detail.original_event.target.parentNode&&e.detail.original_event.target.parentNode.classList&&e.detail.original_event.target.parentNode.classList.contains("course_video_popup"))return!1;e.detail.original_event.preventDefault(),e.detail.original_event.stopPropagation(),document.getElementById("single_item_popup")&&document.getElementById("single_item_popup").remove();let t=document.createElement("div");t.innerHTML="",t.id="single_item_popup",document.body.appendChild(t),e.detail.hasOwnProperty("id")&&v(u(c,{id:e.detail.id}),document.getElementById("single_item_popup"))})}]);