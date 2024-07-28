import{k as h,T as g,o as i,c as v,w as u,b as o,d as V,a as s,u as l,h as n,l as y,F as x,j as w,t as k}from"./app-DhAk2B9F.js";import{_ as U}from"./PrimaryButton-D9xsJ82q.js";import{_ as C}from"./SecondaryButton-B4hYLcYP.js";import{_ as d}from"./InputForm-ZivRodwo.js";import{_ as c}from"./SelectForm-BA2bjkri.js";import{_ as j}from"./DefaultLayout-CWSOlPCh.js";import{e as F,c as S}from"./toast-aXzCVqLX.js";import{I as $}from"./IconUpload-DaiZL6wt.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";import"./createVueComponent-YZjrh2G-.js";const I={class:"mx-auto max-w-270"},N={class:"grid grid-cols-5 gap-8"},B={class:"col-span-5 xl:col-span-3"},D={class:"rounded-md border border-stroke bg-white shadow-default"},E=o("div",{class:"border-b border-stroke py-4 px-7"},[o("h3",{class:"font-medium"},"Datos generales")],-1),z={class:"p-7"},H={class:"grid grid-cols-1 lg:grid-cols-2 gap-4"},M=o("div",{class:"col-span-2 font-bold text-lg mb-2"},"Detalles",-1),P=o("option",{value:""},"Ninguna",-1),R=["value"],q=o("option",{value:"Macho"},"Macho",-1),A=o("option",{value:"Hembra"},"Hembra",-1),G={class:"flex justify-end gap-4"},L={class:"col-span-5 xl:col-span-2"},T={class:"rounded-md border border-stroke bg-white shadow-default"},J=o("div",{class:"border-b border-stroke py-4 px-7"},[o("h3",{class:"font-medium"},"Foto")],-1),K={class:"p-7"},O={key:0,class:"mb-4 w-full flex justify-center"},Q=["src"],W={key:1,class:"relative mb-5 block w-full cursor-pointer appearance-none rounded-md border-2 border-dashed border-primary bg-gray py-4 px-4"},X={class:"flex flex-col items-center justify-center space-y-3"},Y={class:"flex h-10 w-10 items-center justify-center rounded-full border-2 border-slate-200 bg-white"},Z=o("p",{class:"text-sm font-medium"},[o("span",{class:"text-primary"}," Subir foto ")],-1),ee={key:2,class:"flex justify-end"},ue={__name:"Create",props:["species"],setup(p){const r=h(""),e=g({name:"",code:"",specie_id:"",photo:"",details:{gender:"Hembra",race:"",initial_weight:"",initial_height:"",birth_date:"",adoption_date:"",entry_date:""}});function _(){if(e.code.includes(" ")){F("El codigo no debe contener espacios en blanco");return}e.post(route("dashboard.animals.store"),{preserveState:!0,preserveScroll:!0,onSuccess:()=>{S()}})}function b(m){e.photo=m.target.files[0];const t=new FileReader;t.readAsDataURL(e.photo),t.onload=()=>{r.value=t.result}}function f(){r.value=null,e.photo=null}return(m,t)=>(i(),v(j,{head:"Perfil"},{default:u(()=>[o("div",I,[o("div",N,[o("div",B,[o("div",D,[E,o("div",z,[o("form",{onSubmit:V(_,["prevent"])},[o("div",H,[s(d,{modelValue:l(e).code,"onUpdate:modelValue":t[0]||(t[0]=a=>l(e).code=a),label:"Codigo",name:"code",required:""},null,8,["modelValue"]),s(d,{modelValue:l(e).name,"onUpdate:modelValue":t[1]||(t[1]=a=>l(e).name=a),label:"Nombre",name:"name"},null,8,["modelValue"]),M,s(c,{modelValue:l(e).specie_id,"onUpdate:modelValue":t[2]||(t[2]=a=>l(e).specie_id=a),label:"Especie",name:"specie_id"},{default:u(()=>[P,(i(!0),n(x,null,y(p.species,a=>(i(),n("option",{value:a.id},k(a.name),9,R))),256))]),_:1},8,["modelValue"]),s(c,{modelValue:l(e).details.gender,"onUpdate:modelValue":t[3]||(t[3]=a=>l(e).details.gender=a),label:"Genero",name:"gender",required:""},{default:u(()=>[q,A]),_:1},8,["modelValue"]),s(d,{modelValue:l(e).details.race,"onUpdate:modelValue":t[4]||(t[4]=a=>l(e).details.race=a),label:"Raza",name:"race"},null,8,["modelValue"]),s(d,{modelValue:l(e).details.initial_weight,"onUpdate:modelValue":t[5]||(t[5]=a=>l(e).details.initial_weight=a),label:"Peso Inicial",name:"initial_weight",type:"number"},null,8,["modelValue"]),s(d,{modelValue:l(e).details.initial_height,"onUpdate:modelValue":t[6]||(t[6]=a=>l(e).details.initial_height=a),label:"Altura Inicial",name:"initial_height",type:"number"},null,8,["modelValue"]),s(d,{modelValue:l(e).details.birth_date,"onUpdate:modelValue":t[7]||(t[7]=a=>l(e).details.birth_date=a),label:"Fecha de nacimiento",name:"birth_date",type:"date"},null,8,["modelValue"]),s(d,{modelValue:l(e).details.adoption_date,"onUpdate:modelValue":t[8]||(t[8]=a=>l(e).details.adoption_date=a),label:"Fecha de adopción",name:"adoption_date",type:"date"},null,8,["modelValue"]),s(d,{modelValue:l(e).details.entry_date,"onUpdate:modelValue":t[9]||(t[9]=a=>l(e).details.entry_date=a),label:"Fecha de ingreso",name:"entry_date",type:"date"},null,8,["modelValue"])]),o("div",G,[s(C,{onClick:t[10]||(t[10]=a=>m.$inertia.visit(m.route("dashboard.animals.index"))),text:"Cancelar"}),s(U,{loading:l(e).processing,text:"Guardar",type:"submit"},null,8,["loading"])])],32)])])]),o("div",L,[o("div",T,[J,o("div",K,[r.value?(i(),n("div",O,[o("img",{src:r.value,alt:"",class:"mb-2 w-auto max-h-[35rem] rounded-md object-contain"},null,8,Q)])):(i(),n("div",W,[o("input",{type:"file",accept:"image/*",class:"absolute inset-0 z-50 m-0 h-full w-full cursor-pointer p-0 opacity-0 outline-none",onChange:b},null,32),o("div",X,[o("span",Y,[s(l($),{size:"20",stroke:"2",class:"text-slate-400"})]),Z])])),l(e).photo?(i(),n("div",ee,[o("button",{type:"button",class:"text-primary font-medium",onClick:f}," Eliminar ")])):w("",!0)])])])])])]),_:1}))}};export{ue as default};