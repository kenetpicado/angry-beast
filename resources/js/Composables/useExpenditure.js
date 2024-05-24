import { useForm } from '@inertiajs/vue3'
import confirmAction from '@/Utils/confirmation'
import { created, deleted, updated } from '@/Utils/toast.js'

export function useExpenditure({model_id, model_type}) {
  const form = useForm({
    id: null,
    model_id: model_id || '',
    model_type: model_type || '',
    description: '',
    quantity: 1,
    value: ''
  })

  function store(onDone) {
    form.post(route('dashboard.expenditures.store'), {
      preserveScroll: true,
      preserveState: true,
      onSuccess: () => {
        created()
        if (onDone) onDone()
      }
    })
  }

  function update(onDone) {
    form.put(route('dashboard.expenditures.update', form.id), {
      preserveScroll: true,
      preserveState: true,
      onSuccess: () => {
        updated()
        if (onDone) onDone()
      }
    })
  }

  function destroy(id) {
    confirmAction({
      callback: () => {
        form.delete(route('dashboard.expenditures.destroy', id), {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => {
            deleted()
          }
        })
      }
    })
  }

  return { store, update, destroy, form }
}

export default useExpenditure
