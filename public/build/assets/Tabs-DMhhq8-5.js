import{q as o,s as n,o as s,h as l,F as c,l as u,n as t,b as d,c as m,x as i,e as p,t as v}from"./app-DhAk2B9F.js";const b={class:"bg-white mb-4 rounded-md flex gap-4 items-center p-4 border"},g=["onClick"],h={__name:"Tabs",props:o(["options"],{modelValue:{},modelModifiers:{}}),emits:["update:modelValue"],setup(r){const a=n(r,"modelValue");return(x,_)=>(s(),l("div",b,[(s(!0),l(c,null,u(r.options,e=>(s(),l("button",{onClick:k=>a.value=e.value,type:"button",class:t(["flex items-center gap-1 rounded-md",[a.value==e.value?"text-primary":"text-gray-400"]]),key:e},[d("span",{class:t(["p-1.5 rounded-lg",[a.value==e.value?"bg-primary":""]])},[(s(),m(i(e.icon),{size:"18",stroke:"2",class:t([a.value==e.value?"text-white":""])},null,8,["class"]))],2),p(" "+v(e.label),1)],10,g))),128))]))}};export{h as _};
