import { useDateFormat } from '@vueuse/core'

export const getFormattedDate = (date) => {
  return useDateFormat(date, 'DD/MM/YY h:mm A').value
}

export default getFormattedDate
