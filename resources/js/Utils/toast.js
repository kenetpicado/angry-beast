import { createToaster } from '@meforma/vue-toaster'

export const toast = createToaster({
  position: 'bottom',
  duration: 2000,
  maxToasts: 2
})

export const created = () => {
  toast.success('Creado correctamente')
}

export const updated = () => {
  toast.success('Actualizado correctamente')
}

export const deleted = () => {
  toast.success('Eliminado correctamente')
}

export default toast
