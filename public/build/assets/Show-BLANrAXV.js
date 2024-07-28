import{k as v,o as i,c as w,w as u,b as a,t as m,a as n,h as f,j as b,l as U,F as V,u as l,p as I,v as S}from"./app-DhAk2B9F.js";import{_ as F}from"./PrimaryButton-D9xsJ82q.js";import{_ as c}from"./InputForm-ZivRodwo.js";import{_ as B}from"./ModalForm-BzeIvtvi.js";import{_ as D,a as T,b as y,I as A}from"./TableSection-DnIYx_0D.js";import{_ as M}from"./DefaultLayout-CWSOlPCh.js";import{I as j}from"./IconEdit-DVNOvkGw.js";import{I as O}from"./IconUserDollar-CaUEK6X6.js";import{a as L}from"./date-a-P_LG0S.js";import{_ as R}from"./Tabs-DMhhq8-5.js";import"./toast-aXzCVqLX.js";import"./confirmation-LqhIgFI2.js";import{u as z}from"./useEvent-Cv18EGms.js";import"./SecondaryButton-B4hYLcYP.js";import"./createVueComponent-YZjrh2G-.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const G={class:"mb-4 flex gap-3 items-center justify-between"},H={class:"text-2xl font-semibold"},J=a("th",null,"Fecha",-1),K=a("th",null,"Nombre",-1),P=a("th",null,"Cantidad",-1),Q=a("th",null,"Acciones",-1),W={key:0},X=a("td",{class:"text-center text-slate-400",colspan:"6"},"No hay datos que mostrar",-1),Y=[X],Z={class:"flex gap-4"},ee={class:"inline-flex items-center cursor-pointer lg:col-span-2 mb-4"},te=a("span",{class:"mr-3 text-sm"},"Agregar recordatorio",-1),ae=a("div",{class:"relative w-11 h-6 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"},null,-1),ye={__name:"Show",props:["events","event_type"],setup(s){const h=s,r=v(!1),d=v(!1),_=v("EVENTS"),{storeEvent:k,updateEvent:g,formEvent:o,setEventValues:x}=z({model_id:h.event_type.id,model_type:"App\\Models\\EventType"});function E(p){x(p),r.value=!0}const C=[{label:"Eventos",value:"EVENTS",icon:O}];function $(){o.id?g(()=>(r.value=!1,d.value=!1)):k(()=>(r.value=!1,d.value=!1))}function N(){o.reset(),r.value=!1}return(p,t)=>(i(),w(M,{head:"Usuarios"},{default:u(()=>[a("div",G,[a("h2",H,m(s.event_type.name),1),n(F,{text:"Nuevo",onClick:t[0]||(t[0]=e=>r.value=!0)})]),n(R,{options:C,modelValue:_.value,"onUpdate:modelValue":t[1]||(t[1]=e=>_.value=e)},null,8,["modelValue"]),n(T,null,{header:u(()=>[J,K,P,Q]),body:u(()=>[s.events.data.length==0?(i(),f("tr",W,Y)):b("",!0),(i(!0),f(V,null,U(s.events.data,e=>(i(),f("tr",{key:e.id},[a("td",null,m(l(L)(e.created_at)),1),a("td",null,m(e.name),1),a("td",null,m(e.quantity),1),a("td",null,[a("div",Z,[n(y,{icon:l(j),onClick:q=>E(e),tooltip:"Editar"},null,8,["icon","onClick"]),n(y,{icon:l(A),onClick:q=>p.destroy(e.id),tooltip:"Eliminar"},null,8,["icon","onClick"])])])]))),128))]),footer:u(()=>[n(D,{links:s.events.links},null,8,["links"])]),_:1}),n(B,{modelValue:r.value,"onUpdate:modelValue":t[7]||(t[7]=e=>r.value=e),onOnSubmit:t[8]||(t[8]=e=>$()),onOnCancel:N,title:"Evento",loading:l(o).processing},{default:u(()=>[n(c,{modelValue:l(o).name,"onUpdate:modelValue":t[2]||(t[2]=e=>l(o).name=e),label:"Nombre",required:"",name:"name"},null,8,["modelValue"]),n(c,{modelValue:l(o).quantity,"onUpdate:modelValue":t[3]||(t[3]=e=>l(o).quantity=e),label:"Cantidad",name:"quantity",type:"number",required:""},null,8,["modelValue"]),a("label",ee,[te,I(a("input",{type:"checkbox","onUpdate:modelValue":t[4]||(t[4]=e=>d.value=e),class:"sr-only peer"},null,512),[[S,d.value]]),ae]),d.value?(i(),f(V,{key:0},[n(c,{modelValue:l(o).reminder.name,"onUpdate:modelValue":t[5]||(t[5]=e=>l(o).reminder.name=e),label:"Nombre del recordatorio",name:"reminder.name",required:""},null,8,["modelValue"]),n(c,{modelValue:l(o).reminder.date,"onUpdate:modelValue":t[6]||(t[6]=e=>l(o).reminder.date=e),label:"Fecha del recordatorio",name:"reminder.date",type:"date",required:""},null,8,["modelValue"])],64)):b("",!0)]),_:1},8,["modelValue","loading"])]),_:1}))}};export{ye as default};
