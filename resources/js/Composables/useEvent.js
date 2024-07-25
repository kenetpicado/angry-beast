import { useForm } from '@inertiajs/vue3'
import confirmAction from '@/Utils/confirmation'
import { created, deleted, updated, error } from '@/Utils/toast.js'

export function useEvent({ model_id, model_type }) {

  const formEvent = useForm({
    id: null,
    model_id: model_id || '',
    model_type: model_type || '',
    description: '',
    quantity: 1
  })

  function storeEvent(onSuccessCallback) {
    formEvent.post(route('dashboard.events.store'), {
      preserveScroll: true,
      preserveState: true,
      onSuccess: () => {
        created()
        if (typeof onSuccessCallback === 'function') {
          onSuccessCallback()
        }
      }
    })
  }

  function updateEvent() {
    formEvent.put(route('dashboard.events.update', formEvent.id), {
      preserveScroll: true,
      preserveState: true,
      onSuccess: () => {
        updated()
      }
    })
  }

  function destroyEvent(id) {
    confirmAction({
      callback: () => {
        formEvent.delete(route('dashboard.events.destroy', id), {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => {
            deleted()
          }
        })
      }
    })
  }

  function setEventValues(item) {
    formEvent.id = item.id
    formEvent.description = item.description
    formEvent.quantity = item.quantity
    formEvent.value = item.value
  }

  return { storeEvent, updateEvent, destroyEvent, formEvent, setEventValues }
}

export default useEvent
