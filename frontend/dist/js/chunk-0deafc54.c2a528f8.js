(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-0deafc54"],{"5be1":function(s,t,e){},"9c4f":function(s,t,e){"use strict";e.r(t);var l=function(){var s=this,t=s.$createElement,e=s._self._c||t;return e("div",{staticClass:"app flex-row bg-theme"},[e("div",{staticClass:"container-fluid bg-theme"},[e("b-row",[e("b-col",{staticClass:"col-sm-12 col-12 offset-md-1 offset-lg-1 col-md-5 col-lg-5"},[e("h1",{staticClass:"h1 my-3"},[s._v("Заполните данные поста")])])],1),e("b-row",[e("b-col",{staticClass:"col-sm-12 col-12 offset-md-1 offset-lg-1 col-md-5 col-lg-5"},[s.success?e("div",{staticClass:"alert alert-success alert-dismissable"},[s._v("\n          "+s._s(s.success)+"\n        ")]):s._e()])],1),e("b-row",[e("b-col",{staticClass:"col-sm-12 col-12 offset-md-1 offset-lg-1 col-md-5 col-lg-5"},[e("h1",{staticClass:"h4 my-1"},[s._v("Выберите файл")])])],1),e("b-row",[e("b-col",{staticClass:"col-sm-12 col-12 offset-md-1 offset-lg-1 col-md-10 col-lg-10 d-flex mb-4"},[e("input",{ref:"files",staticClass:"form-control-file",attrs:{language:"ru",type:"file",id:"files",multiple:"multiple"},on:{change:function(t){s.handleFileUploads()}}})])],1),e("b-row",[e("b-col",{staticClass:"col-sm-12 col-12 offset-md-1 offset-lg-1 col-md-5 col-lg-5"},[e("h1",{staticClass:"h4 my-1"},[s._v("Напишите комментарий")])])],1),e("b-row",[e("b-col",{staticClass:"offset-md-1 col-md-5 col-lg-5 offset-lg-1 col-sm-6 col mb-4"},[e("input",{directives:[{name:"model",rawName:"v-model",value:s.comment,expression:"comment"}],staticClass:"form-control",attrs:{type:"text",id:"comment"},domProps:{value:s.comment},on:{input:function(t){t.target.composing||(s.comment=t.target.value)}}})])],1),e("b-row",[e("b-col",{staticClass:"col-sm-12 col-12 offset-md-1 offset-lg-1 col-md-10 col-lg-10 d-flex"},[e("b-button",{staticClass:"form__btn btn btn-lg btn-primary mb-4 mr-3",attrs:{variant:"primary",disabled:s.disabled},on:{click:s.sendFiles}},[s._v("Отправить")]),s.loader?e("div",{staticClass:"loader"}):s._e()],1)],1),""!==s.errors?e("b-row",[e("b-col",{staticClass:"offset-md-1 col-md-5 col-lg-5 offset-lg-1 col-sm-6"},s._l(s.errors,function(t,l){return e("b-alert",{key:l,staticClass:"mb-4",attrs:{show:"",variant:"danger"}},[e("span",{domProps:{innerHTML:s._s(t)}})])}))],1):s._e(),""!==s.message?e("b-row",[e("b-col",{staticClass:"offset-md-1 col-md-5 col-lg-5 offset-lg-1 col-sm-6"},s._l(s.message,function(t,l){return e("b-alert",{key:l,staticClass:"mb-4",attrs:{show:"",variant:"success"}},[s._v("\n          "+s._s(t)+"\n        ")])}))],1):s._e()],1)])},o=[],a=(e("cadf"),e("551c"),e("097d"),e("bc3a")),c=e.n(a),r=(e("2f62"),{data:function(){return{errors:"",message:"",success:"",comment:"",disabled:!1,loader:!1,userFiles:[],uploadFiles:[],test:{},test2:[]}},computed:{},name:"Files",mounted:function(){},methods:{sendFiles:function(){var s=this;this.errors="";var t=new FormData;if(0===this.userFiles.length||this.userFiles.length>10)return this.errors=["Выберите файл для загрузки! Можно загрузить не больше 10 штук!"],!1;for(var e=0;e<this.userFiles.length;e++){var l=this.userFiles[e];t.append("files["+e+"]",l)}t.append("comment",this.comment),this.disabled=!0,this.loader=!0,c.a.post("http://api.fun-gifs.ru/api/putFiles",t,{headers:{Authorization:"Bearer "+localStorage.getItem("access_token"),"Content-Type":"multipart/form-data"}}).then(function(t){return"error"===t.data.status?(s.errors=t.data.data.errors,s.disabled=!1,s.loader=!1,!1):"message"!==t.data.status&&void("ok"===t.data.status&&(s.userFiles="",s.success=t.data.data.message[0],s.$refs.files.value="",s.disabled=!1,s.loader=!1))}).catch(function(t){console.log(t),s.errors=["Ошибка сервера! Попробуйте загрузить файлы еще раз, либо обратитесь в поддержку."],s.disabled=!1,s.loader=!1})},handleFileUploads:function(s){this.userFiles=this.$refs.files.files}}}),i=r,n=(e("c3af"),e("2877")),d=Object(n["a"])(i,l,o,!1,null,null,null);d.options.__file="Files.vue";t["default"]=d.exports},c3af:function(s,t,e){"use strict";var l=e("5be1"),o=e.n(l);o.a}}]);
//# sourceMappingURL=chunk-0deafc54.c2a528f8.js.map