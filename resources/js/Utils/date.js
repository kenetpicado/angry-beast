import { useDateFormat } from '@vueuse/core'

export const getFormattedDate = (date) => {
  if (!date) return 'Sin fecha'
  return useDateFormat(date, 'DD/MM/YY hh:mm A').value
}

export const getBasicDate = (date) => {
  if (!date) return 'Sin fecha'
  return useDateFormat(date, 'DD/MM/YYYY').value
}

export default getFormattedDate
