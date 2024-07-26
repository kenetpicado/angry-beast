import { useDateFormat } from '@vueuse/core'

export const getFormattedDate = (date, format = 'DD/MM/YY hh:mm A') => {
  if (!date) {
    return ''
  }

  return useDateFormat(date, format).value
}

export const getBasicDate = (date) => {
  if (!date) {
    return ''
  }

  return useDateFormat(date, 'DD/MM/YYYY').value
}

export default getFormattedDate
