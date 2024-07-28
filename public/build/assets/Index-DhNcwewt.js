import{k,T as C,y as V,o as u,c as S,w as r,b as e,a as s,h as _,j as $,l as w,F as N,u as a,d as U,t as d}from"./app-DhAk2B9F.js";import{_ as E}from"./DefaultLayout-CWSOlPCh.js";import{_ as p}from"./PrimaryButton-D9xsJ82q.js";import{_ as I}from"./SecondaryButton-B4hYLcYP.js";import{_ as f}from"./InputForm-ZivRodwo.js";import{u as j,c as B,d as M}from"./toast-aXzCVqLX.js";import{I as q}from"./IconEdit-DVNOvkGw.js";import{_ as T,a as A,b as h,I as F}from"./TableSection-DnIYx_0D.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";import"./createVueComponent-YZjrh2G-.js";const z={class:"mb-6 flex gap-3 items-center justify-between"},D=e("h2",{class:"text-2xl font-semibold"},"Usuarios",-1),G=e("th",null,"Nombre",-1),L=e("th",null,"Correo",-1),O=e("th",null,"Tipo",-1),H=e("th",null,"Compañia",-1),J=e("th",null,"Acciones",-1),K={key:0},P=e("td",{class:"text-center text-slate-400",colspan:"4"},"No hay datos que mostrar",-1),Q=[P],R={class:"text-primary tracking-wider"},W={class:"flex gap-3"},X=e("h2",{class:"text-xl font-semibold mb-5"},"Usuario",-1),Y={class:"flex-1"},Z={class:"grid grid-cols-1 lg:grid-cols-2 gap-4"},ee={class:"flex gap-3 items-center justify-end"},me={__name:"Index",props:{users:{type:Object,required:!0}},setup(m){const i=k(!1),o=C({id:null,name:"",email:""});function v(){o.id?o.put(route("dashboard.users.update",o.id),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{j(),c()}}):o.post(route("dashboard.users.store"),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{B(),c()}})}function x(n){o.id=n.id,o.name=n.name,o.email=n.email,i.value=!0}function b(n){confirm("¿Estas seguro de eliminar este usuario?")&&o.delete(route("dashboard.users.destroy",n),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{M()}})}function c(){i.value=!1,o.reset()}return(n,l)=>{const g=V("Modal");return u(),S(E,{head:"Usuarios"},{default:r(()=>[e("div",z,[D,s(p,{text:"Nuevo",onClick:l[0]||(l[0]=t=>i.value=!0)})]),s(A,null,{header:r(()=>[G,L,O,H,J]),body:r(()=>[m.users.data.length==0?(u(),_("tr",K,Q)):$("",!0),(u(!0),_(N,null,w(m.users.data,t=>(u(),_("tr",{key:t.id},[e("td",null,[e("div",null,d(t.name),1),e("small",R,"Activo: "+d(t.active),1)]),e("td",null,d(t.email),1),e("td",null,d(t.type),1),e("td",null,d(t.company),1),e("td",null,[e("div",W,[s(h,{icon:a(q),onClick:y=>x(t),tooltip:"Editar"},null,8,["icon","onClick"]),s(h,{icon:a(F),onClick:y=>b(t.id),tooltip:"Eliminar"},null,8,["icon","onClick"])])])]))),128))]),footer:r(()=>[s(T,{links:m.users.links},null,8,["links"])]),_:1}),s(g,{modelValue:i.value,"onUpdate:modelValue":l[3]||(l[3]=t=>i.value=t),class:"z-30"},{default:r(()=>[e("form",{class:"bg-white rounded-md px-7 py-5 w-full flex flex-col",style:{"max-width":"50rem","min-height":"20rem"},onSubmit:U(v,["prevent"])},[X,e("div",Y,[e("div",Z,[s(f,{modelValue:a(o).name,"onUpdate:modelValue":l[1]||(l[1]=t=>a(o).name=t),label:"Nombre",name:"name",required:""},null,8,["modelValue"]),s(f,{modelValue:a(o).email,"onUpdate:modelValue":l[2]||(l[2]=t=>a(o).email=t),label:"Correo",name:"email",type:"email"},null,8,["modelValue"])])]),e("div",ee,[s(I,{text:"Cancelar",onClick:c}),s(p,{text:"Guardar",type:"submit",loading:a(o).processing},null,8,["loading"])])],32)]),_:1},8,["modelValue"])]),_:1})}}};export{me as default};
