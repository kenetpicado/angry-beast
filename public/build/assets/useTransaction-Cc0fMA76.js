import{T as p}from"./app-DhAk2B9F.js";import{c as f}from"./confirmation-LqhIgFI2.js";import{c as v,u as y,e as S,d as m}from"./toast-aXzCVqLX.js";function g({model_id:s,model_type:o,type:u}){const t=p({id:null,model_id:s||"",model_type:o||"",type:u||"",description:"",quantity:1,value:""});function r(e){t.post(route("dashboard.transactions.store"),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{v(),t.reset(),e&&e()}})}function a(e){t.put(route("dashboard.transactions.update",t.id),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{y(),t.reset(),e&&e()}})}function i(e){f({callback:()=>{t.delete(route("dashboard.transactions.destroy",e),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{m()}})}})}function n(e){try{d(),t.id?a(e):r(e)}catch(l){S(l)}}function c(e){t.id=e.id,t.description=e.description,t.type=e.type,t.quantity=e.quantity,t.value=e.value}function d(){if(t.quantity<1)throw"Ingrese una cantidad valida";if(t.value<1)throw"Ingrese un monto valido"}return{store:r,update:a,destroy:i,form:t,onSubmit:n,setValues:c}}export{g as u};