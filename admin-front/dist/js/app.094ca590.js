(function(e){function t(t){for(var r,a,c=t[0],s=t[1],i=t[2],f=0,l=[];f<c.length;f++)a=c[f],Object.prototype.hasOwnProperty.call(o,a)&&o[a]&&l.push(o[a][0]),o[a]=0;for(r in s)Object.prototype.hasOwnProperty.call(s,r)&&(e[r]=s[r]);p&&p(t);while(l.length)l.shift()();return u.push.apply(u,i||[]),n()}function n(){for(var e,t=0;t<u.length;t++){for(var n=u[t],r=!0,a=1;a<n.length;a++){var c=n[a];0!==o[c]&&(r=!1)}r&&(u.splice(t--,1),e=s(s.s=n[0]))}return e}var r={},a={app:0},o={app:0},u=[];function c(e){return s.p+"js/"+({}[e]||e)+"."+{"chunk-2d0c4643":"86bf6575","chunk-39e5ef8a":"d429f2d0","chunk-3a945364":"20a76b7a","chunk-449d67a2":"7ca365fa","chunk-65f2eb54":"dc388666"}[e]+".js"}function s(t){if(r[t])return r[t].exports;var n=r[t]={i:t,l:!1,exports:{}};return e[t].call(n.exports,n,n.exports,s),n.l=!0,n.exports}s.e=function(e){var t=[],n={"chunk-39e5ef8a":1,"chunk-3a945364":1,"chunk-449d67a2":1,"chunk-65f2eb54":1};a[e]?t.push(a[e]):0!==a[e]&&n[e]&&t.push(a[e]=new Promise((function(t,n){for(var r="css/"+({}[e]||e)+"."+{"chunk-2d0c4643":"31d6cfe0","chunk-39e5ef8a":"1e8c526f","chunk-3a945364":"267776e2","chunk-449d67a2":"39b0e113","chunk-65f2eb54":"94b92565"}[e]+".css",o=s.p+r,u=document.getElementsByTagName("link"),c=0;c<u.length;c++){var i=u[c],f=i.getAttribute("data-href")||i.getAttribute("href");if("stylesheet"===i.rel&&(f===r||f===o))return t()}var l=document.getElementsByTagName("style");for(c=0;c<l.length;c++){i=l[c],f=i.getAttribute("data-href");if(f===r||f===o)return t()}var p=document.createElement("link");p.rel="stylesheet",p.type="text/css",p.onload=t,p.onerror=function(t){var r=t&&t.target&&t.target.src||o,u=new Error("Loading CSS chunk "+e+" failed.\n("+r+")");u.code="CSS_CHUNK_LOAD_FAILED",u.request=r,delete a[e],p.parentNode.removeChild(p),n(u)},p.href=o;var h=document.getElementsByTagName("head")[0];h.appendChild(p)})).then((function(){a[e]=0})));var r=o[e];if(0!==r)if(r)t.push(r[2]);else{var u=new Promise((function(t,n){r=o[e]=[t,n]}));t.push(r[2]=u);var i,f=document.createElement("script");f.charset="utf-8",f.timeout=120,s.nc&&f.setAttribute("nonce",s.nc),f.src=c(e);var l=new Error;i=function(t){f.onerror=f.onload=null,clearTimeout(p);var n=o[e];if(0!==n){if(n){var r=t&&("load"===t.type?"missing":t.type),a=t&&t.target&&t.target.src;l.message="Loading chunk "+e+" failed.\n("+r+": "+a+")",l.name="ChunkLoadError",l.type=r,l.request=a,n[1](l)}o[e]=void 0}};var p=setTimeout((function(){i({type:"timeout",target:f})}),12e4);f.onerror=f.onload=i,document.head.appendChild(f)}return Promise.all(t)},s.m=e,s.c=r,s.d=function(e,t,n){s.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},s.r=function(e){"undefined"!==typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},s.t=function(e,t){if(1&t&&(e=s(e)),8&t)return e;if(4&t&&"object"===typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(s.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)s.d(n,r,function(t){return e[t]}.bind(null,r));return n},s.n=function(e){var t=e&&e.__esModule?function(){return e["default"]}:function(){return e};return s.d(t,"a",t),t},s.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},s.p="/",s.oe=function(e){throw console.error(e),e};var i=window["webpackJsonp"]=window["webpackJsonp"]||[],f=i.push.bind(i);i.push=t,i=i.slice();for(var l=0;l<i.length;l++)t(i[l]);var p=f;u.push([0,"chunk-vendors"]),n()})({0:function(e,t,n){e.exports=n("56d7")},"56d7":function(e,t,n){"use strict";n.r(t);n("cadf"),n("551c"),n("f751"),n("097d"),n("f466"),n("579f"),n("587a"),n("54ba");var r=n("a026"),a=n("5f5b"),o=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("router-view")},u=[],c={name:"app"},s=c,i=(n("5c0b"),n("2877")),f=Object(i["a"])(s,o,u,!1,null,null,null),l=f.exports,p=n("a18c"),h=(n("96cf"),n("3b8d")),d=n("bc3a"),m=n.n(d),g=function(e){e.auth={login:function(e,t){var n=this,r={email:e,password:t},a=new Promise((function(e,t){m.a.post("https://api.fun-gifs.ru/api/login",r).then((function(t){console.log(t.data),void 0!==t.data.access_token&&n.setToken(t.data.access_token),e(t)})).catch((function(e){t(e)}))}));return a},logout:function(){this.destroy()},check:function(){var e=Object(h["a"])(regeneratorRuntime.mark((function e(){var t;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.next=2,this.getToken();case 2:if(t=e.sent,!t){e.next=8;break}return m.a.defaults.baseURL="https://api.fun-gifs.ru/api/checkaccesstoken",e.abrupt("return",!0);case 8:return e.abrupt("return",!1);case 9:case"end":return e.stop()}}),e,this)})));function t(){return e.apply(this,arguments)}return t}(),setToken:function(e){localStorage.setItem("access_token",e),m.a.defaults.headers.common["Authorization"]="Bearer "+e,m.a.defaults.baseURL="https://api.fun-gifs.ru/api/"},getToken:function(){var e=Object(h["a"])(regeneratorRuntime.mark((function e(){var t;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:if(t=localStorage.getItem("access_token"),t){e.next=3;break}return e.abrupt("return",null);case 3:return e.abrupt("return",t);case 4:case"end":return e.stop()}}),e)})));function t(){return e.apply(this,arguments)}return t}(),destroy:function(){localStorage.removeItem("access_token")}},Object.defineProperties(e.prototype,{$auth:{get:function(){return e.auth}}})},b=n("8c4f"),v=n("2f62"),k=(n("7f7f"),{posts:[],postsError:""}),y={posts:function(e){return e.posts},postsError:function(e){return e.postsError}},w={setPosts:function(e,t){e.posts=t.posts},setPostsError:function(e,t){e.postsError=t.postsError}},P={setPosts:function(e){if(null!==localStorage.getItem("access_token")){var t={method:"GET",headers:{Authorization:"Bearer "+localStorage.getItem("access_token")},url:"http://api.fun-gifs.ru/api/getPosts/"};m()(t).then((function(t){console.log(t),"ok"===t.data.status?e.commit("setPosts",{posts:t.data.data.posts}):"error"===t.data.status&&(e.commit("setPostsError",{postsError:t.data.data.error}),console.log(t.data))})).catch((function(e){console.log(e)}))}}},E={namespaced:!0,state:k,getters:y,actions:P,mutations:w};r["default"].use(v["a"]);var O=new v["a"].Store({strict:!0,modules:{posting:E}});r["default"].use(a["a"]),r["default"].use(g),r["default"].use(b["a"]),n("72b3"),O.dispatch("posting/setPosts"),new r["default"]({el:"#app",router:p["a"],store:O,template:"<App/>",components:{App:l}})},"5c0b":function(e,t,n){"use strict";var r=n("e332"),a=n.n(r);a.a},"72b3":function(e,t,n){"use strict";n.r(t);n("7f7f"),n("96cf");var r=n("3b8d"),a=n("a026"),o=n("a18c");o["a"].beforeEach(function(){var e=Object(r["a"])(regeneratorRuntime.mark((function e(t,n,r){var o;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.next=2,a["default"].prototype.$auth.check();case 2:o=e.sent,t.matched.some((function(e){return e.meta.requiresAuth}))&&!o?r({name:"Login"}):r();case 4:case"end":return e.stop()}}),e)})));return function(t,n,r){return e.apply(this,arguments)}}()),o["a"].onReady(function(){var e=Object(r["a"])(regeneratorRuntime.mark((function e(t){var n,r;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return n=t.matched.some((function(e){return e.meta.requiresAuth||!1})),e.next=3,a["default"].prototype.$auth.check();case 3:r=e.sent,n&&!r&&"Login"!==t.name?o["a"].push({name:"Login"}):n&&r&&"Login"===t.name&&o["a"].push({name:"MainPage"});case 5:case"end":return e.stop()}}),e)})));return function(t){return e.apply(this,arguments)}}())},a18c:function(e,t,n){"use strict";var r=n("8c4f"),a=function(){return n.e("chunk-3a945364").then(n.bind(null,"e8c5"))},o=function(){return n.e("chunk-39e5ef8a").then(n.bind(null,"9c4f"))},u=function(){return n.e("chunk-2d0c4643").then(n.bind(null,"3b42"))},c=function(){return n.e("chunk-65f2eb54").then(n.bind(null,"ede4"))},s=function(){return n.e("chunk-449d67a2").then(n.bind(null,"fabf"))};t["a"]=new r["a"]({mode:"history",linkActiveClass:"open active",scrollBehavior:function(){return{y:0}},routes:[{path:"/",redirect:"/Files",name:"Home",component:a,children:[{path:"files",name:"Files",component:o,meta:{requiresAuth:!0}},{path:"profile",name:"Profile",component:u,meta:{requiresAuth:!0}}]},{path:"/main",name:"MainPage",redirect:"/Files",component:s,meta:{requiresAuth:!1}},{path:"/login",name:"Login",meta:{requiresAuth:!1},component:c}]})},e332:function(e,t,n){}});
//# sourceMappingURL=app.094ca590.js.map