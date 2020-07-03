(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-46a23e7e"],{"2ff2":function(t,e,r){"use strict";r.r(e);var i=function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[t.selected?[r("project",{attrs:{project:t.selected}})]:r("div",{staticClass:"project-list"},[t.projects?[r("b-button",{staticClass:"mb-4",attrs:{block:"",variant:"primary",disabled:t.is_creating},on:{click:function(e){return t.create()}}},[t._v(" Create new project ")]),t._l(t.projects,(function(e){return r("b-button",{key:e.id,staticClass:"project",attrs:{block:""},on:{click:function(r){return t.open(e)}}},[t._v(" "+t._s(e.name)+" ")])}))]:r("div",{staticClass:"loading"},[t._v(" Loading... ")])],2)],2)},n=[],o=(r("7db0"),r("d3b7"),function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"project-page"},[r("h1",[t._v(t._s(t.project.name))]),r("div",[r("b-form",{ref:"build_form",on:{submit:function(e){return e.preventDefault(),t.startBuild()}}},[r("b-row",[r("b-col",{staticStyle:{"flex-grow":"10"}},[r("b-form-file",{attrs:{accept:".zip",placeholder:"Select your project"},model:{value:t.build_form.file,callback:function(e){t.$set(t.build_form,"file",e)},expression:"build_form.file"}})],1),r("b-col",[r("b-button",{attrs:{type:"submit",variant:"primary",disabled:!t.build_form.file}},[t._v(" Upload ")])],1)],1)],1),r("div",{staticClass:"builds-table"},[r("table",[r("tbody",t._l(t.project.builds,(function(e,i){return r("tr",{key:e.id,attrs:{old:i>0}},[r("td",{staticClass:"state"},["built"==e.status?r("b-icon-award"):"building"==e.status?r("b-icon-gear-fill",{attrs:{animation:"spin"}}):"pending"==e.status?r("b-icon-alarm-fill",{attrs:{animation:"fade"}}):"failed"==e.status?r("b-icon-exclamation-triangle-fill"):"canceled"==e.status?r("b-icon-trash-fill"):t._e(),t._v(" "+t._s(t.$t("build_status."+e.status))+" ")],1),r("td",{staticClass:"time"},[r("b-icon-clock"),t._v(" "),r("timeago",{attrs:{datetime:t.$utc(e.created_at),autoUpdate:!0}})],1),r("td",[r("div",{staticClass:"text-right"},["built"==e.status?r("b-button",{directives:[{name:"b-tooltip",rawName:"v-b-tooltip.hover.bottom",modifiers:{hover:!0,bottom:!0}}],attrs:{title:"Download debug apk",variant:"link",href:t.$store.linkTo(e.id+"-debug.apk"),download:""+t.project.name}},[r("b-icon-file-earmark-code")],1):t._e(),"built"==e.status?r("b-button",{directives:[{name:"b-tooltip",rawName:"v-b-tooltip.hover.bottom",modifiers:{hover:!0,bottom:!0}}],attrs:{title:"Download release apk",variant:"link",href:t.$store.linkTo(e.id+"-release.apk"),download:""+t.project.name}},[r("b-icon-file-earmark-check")],1):t._e(),r("b-button",{directives:[{name:"b-tooltip",rawName:"v-b-tooltip.hover.bottom",modifiers:{hover:!0,bottom:!0}}],attrs:{variant:"link",title:"Download source code",href:t.$store.linkTo(e.input+".zip"),download:""+t.project.name}},[r("b-icon-file-earmark-zip")],1)],1)])])})),0)])])],1)])}),a=[],s={props:{project:{required:!0,type:Object}},data:function(){return{build_form:{file:null}}},methods:{startBuild:function(){var t=this,e=new FormData;for(var r in this.build_form)e.append(r,this.build_form[r]);this.$http.post("projects/".concat(this.project.id,"/build"),e).then((function(e){t.project.builds.unshift(e.data)}))}}},c=s,l=(r("57d2"),r("2877")),u=Object(l["a"])(c,o,a,!1,null,null,null),d=u.exports,f={components:{project:d},data:function(){return{projects:null,is_creating:!1}},computed:{selected:function(){var t=this;return(this.projects||[]).find((function(e){return e.id==t.$route.params.id}))}},created:function(){var t=this;this.refresh(),this._int=setInterval((function(){return t.refresh()}),2e3)},beforeDestroy:function(){clearInterval(this._int)},methods:{refresh:function(){var t=this;this.$http.get("projects").then((function(e){t.projects=e.data}))},create:function(){var t=this;this.is_creating=!0;var e={name:"Project #"+(this.projects.length+1),config:{}};this.$http.post("projects",e).then((function(e){t.projects.unshift(e.data),t.$router.push({params:{id:e.data.id}})})).finally((function(){t.is_creating=!1}))},open:function(t){this.$router.push({params:{id:t.id}})}}},p=f,b=(r("ccf1"),Object(l["a"])(p,i,n,!1,null,null,null));e["default"]=b.exports},"57d2":function(t,e,r){"use strict";var i=r("dd3d"),n=r.n(i);n.a},"5a22":function(t,e,r){},"65f0":function(t,e,r){var i=r("861d"),n=r("e8b5"),o=r("b622"),a=o("species");t.exports=function(t,e){var r;return n(t)&&(r=t.constructor,"function"!=typeof r||r!==Array&&!n(r.prototype)?i(r)&&(r=r[a],null===r&&(r=void 0)):r=void 0),new(void 0===r?Array:r)(0===e?0:e)}},"7db0":function(t,e,r){"use strict";var i=r("23e7"),n=r("b727").find,o=r("44d2"),a=r("ae40"),s="find",c=!0,l=a(s);s in[]&&Array(1)[s]((function(){c=!1})),i({target:"Array",proto:!0,forced:c||!l},{find:function(t){return n(this,t,arguments.length>1?arguments[1]:void 0)}}),o(s)},ae40:function(t,e,r){var i=r("83ab"),n=r("d039"),o=r("5135"),a=Object.defineProperty,s={},c=function(t){throw t};t.exports=function(t,e){if(o(s,t))return s[t];e||(e={});var r=[][t],l=!!o(e,"ACCESSORS")&&e.ACCESSORS,u=o(e,0)?e[0]:c,d=o(e,1)?e[1]:void 0;return s[t]=!!r&&!n((function(){if(l&&!i)return!0;var t={length:-1};l?a(t,1,{enumerable:!0,get:c}):t[1]=1,r.call(t,u,d)}))}},b727:function(t,e,r){var i=r("0366"),n=r("44ad"),o=r("7b0b"),a=r("50c4"),s=r("65f0"),c=[].push,l=function(t){var e=1==t,r=2==t,l=3==t,u=4==t,d=6==t,f=5==t||d;return function(p,b,v,h){for(var m,_,j=o(p),k=n(j),g=i(b,v,3),w=a(k.length),y=0,C=h||s,$=e?C(p,w):r?C(p,0):void 0;w>y;y++)if((f||y in k)&&(m=k[y],_=g(m,y,j),t))if(e)$[y]=_;else if(_)switch(t){case 3:return!0;case 5:return m;case 6:return y;case 2:c.call($,m)}else if(u)return!1;return d?-1:l||u?u:$}};t.exports={forEach:l(0),map:l(1),filter:l(2),some:l(3),every:l(4),find:l(5),findIndex:l(6)}},ccf1:function(t,e,r){"use strict";var i=r("5a22"),n=r.n(i);n.a},dd3d:function(t,e,r){},e8b5:function(t,e,r){var i=r("c6b6");t.exports=Array.isArray||function(t){return"Array"==i(t)}}}]);
//# sourceMappingURL=chunk-46a23e7e.e6d21996.js.map