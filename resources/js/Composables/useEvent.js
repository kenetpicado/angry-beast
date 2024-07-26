import { useForm } from '@inertiajs/vue3'
import confirmAction from '@/Utils/confirmation'
import { created, deleted, updated, error } from '@/Utils/toast.js'

export function useEvent({ model_id, model_type }) {
  const formEvent = useForm({
    id: null,
    model_id: model_id || '',
    model_type: model_type || '',
    name: '',
    quantity: 1,
    reminder: {
      date: '',
      name: ''
    }
  })

  function storeEvent(onSuccessCallback) {
    formEvent.post(route('dashboard.events.store'), {
      preserveScroll: true,
      preserveState: true,
      onSuccess: () => {
        created()
        formEvent.reset()
        if (typeof onSuccessCallback === 'function') {
          onSuccessCallback()
        }
      }
    })
  }

  function updateEvent(onSuccessCallback) {
    formEvent.put(route('dashboard.events.update', formEvent.id), {
      preserveScroll: true,
      preserveState: true,
      onSuccess: () => {
        updated()
        formEvent.reset()
        if (typeof onSuccessCallback === 'function') {
          onSuccessCallback()
        }
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
    formEvent.name = item.name
    formEvent.quantity = item.quantity
    formEvent.value = item.value
  }

  return { storeEvent, updateEvent, destroyEvent, formEvent, setEventValues }
}

export default useEvent
