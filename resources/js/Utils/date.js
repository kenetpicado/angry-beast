import { useDateFormat } from '@vueuse/core'

export const getFormattedDate = (date) => {
  return useDateFormat(date, 'DD/MM/YY hh:mm A').value
}

export default getFormattedDate
