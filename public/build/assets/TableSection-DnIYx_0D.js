import{c as l}from"./createVueComponent-YZjrh2G-.js";import{o as t,c as h,w as v,x as u,u as d,i as y,h as s,F as g,l as b,d as m,n as f,a as p,t as _,j as k,O as x,b as n,r as i}from"./app-DhAk2B9F.js";/**
 * @license @tabler/icons-vue v3.3.0 - MIT
 *
 * This source code is licensed under the MIT license.
 * See the LICENSE file in the root directory of this source tree.
 */var C=l("outline","chevron-left","IconChevronLeft",[["path",{d:"M15 6l-6 6l6 6",key:"svg-0"}]]);/**
 * @license @tabler/icons-vue v3.3.0 - MIT
 *
 * This source code is licensed under the MIT license.
 * See the LICENSE file in the root directory of this source tree.
 */var w=l("outline","chevron-right","IconChevronRight",[["path",{d:"M9 6l6 6l-6 6",key:"svg-0"}]]);/**
 * @license @tabler/icons-vue v3.3.0 - MIT
 *
 * This source code is licensed under the MIT license.
 * See the LICENSE file in the root directory of this source tree.
 */var I=l("outline","settings","IconSettings",[["path",{d:"M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z",key:"svg-0"}],["path",{d:"M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0",key:"svg-1"}]]);/**
 * @license @tabler/icons-vue v3.3.0 - MIT
 *
 * This source code is licensed under the MIT license.
 * See the LICENSE file in the root directory of this source tree.
 */var O=l("outline","trash","IconTrash",[["path",{d:"M4 7l16 0",key:"svg-0"}],["path",{d:"M10 11l0 6",key:"svg-1"}],["path",{d:"M14 11l0 6",key:"svg-2"}],["path",{d:"M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12",key:"svg-3"}],["path",{d:"M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3",key:"svg-4"}]]);const P={__name:"ActionIcon",props:{icon:{default:I},tooltip:{type:String,required:!1},href:{type:String,required:!1}},setup(e){return(a,o)=>(t(),h(u(e.href?d(y):"button"),{type:"button",href:e.href,tooltip:e.tooltip},{default:v(()=>[(t(),h(u(e.icon),{size:"20",stroke:"2"}))]),_:1},8,["href","tooltip"]))}},M={key:0,class:"flex items-center gap-3 my-4 w-full justify-center"},$=["disabled","onClick"],S={key:0},z={key:1},B={key:2,class:"cursor-pointer"},R={__name:"Pagination",props:["links"],setup(e){function a(o){o&&x.get(o,{},{preserveState:!0,preserveScroll:!0})}return(o,N)=>e.links.length>3?(t(),s("div",M,[(t(!0),s(g,null,b(e.links,(r,c)=>(t(),s("button",{key:c,disabled:!r.url,type:"button",onClick:m(q=>a(r.url),["prevent"]),class:f([[r.active?"bg-primary border-primary text-white":"border-slate-300 text-slate-400",r.url?"":"opacity-30"],"w-8 h-8 select-none rounded-md font-bold border border-2 text-xs flex items-center justify-center"])},[c===0?(t(),s("span",S,[p(d(C),{size:"20",stroke:"2"})])):c===e.links.length-1?(t(),s("span",z,[p(d(w),{size:"20",stroke:"2"})])):(t(),s("span",B,_(r.label),1))],10,$))),128))])):k("",!0)}},T={class:"bg-white rounded-md flex flex-col border"},V={class:"max-w-full overflow-x-auto"},j={class:"uppercase"},L={class:"divide-y divide-slate-100 border-t border-slate-100"},A={__name:"TableSection",props:["tableClass"],setup(e){return(a,o)=>(t(),s("div",T,[n("div",V,[n("table",{class:f(["w-full table-auto text-left text-sm border-collapse",e.tableClass])},[n("thead",j,[n("tr",null,[i(a.$slots,"header")])]),n("tbody",L,[i(a.$slots,"body")])],2)]),i(a.$slots,"footer")]))}};export{O as I,R as _,A as a,P as b};
