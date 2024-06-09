import { useForm } from '@inertiajs/vue3'
import confirmAction from '@/Utils/confirmation'
import { created, deleted, updated, error } from '@/Utils/toast.js'

export function useTransaction({ model_id, model_type, type }) {
  const form = useForm({
    id: null,
    model_id: model_id || '',
    model_type: model_type || '',
    type: type || '',
    description: '',
    quantity: 1,
    value: ''
  })

  function store(onDone) {
    form.post(route('dashboard.transactions.store'), {
      preserveScroll: true,
      preserveState: true,
      onSuccess: () => {
        created()
        form.reset()
        if (onDone) onDone()
      }
    })
  }

  function update(onDone) {
    form.put(route('dashboard.transactions.update', form.id), {
      preserveScroll: true,
      preserveState: true,
      onSuccess: () => {
        updated()
        form.reset()
        if (onDone) onDone()
      }
    })
  }

  function destroy(id) {
    confirmAction({
      callback: () => {
        form.delete(route('dashboard.transactions.destroy', id), {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => {
            deleted()
          }
        })
      }
    })
  }

  function onSubmit(onDone) {
    try {
      validateFields()
      if (form.id) update(onDone)
      else store(onDone)
    } catch (err) {
      error(err)
    }
  }

  function setValues(item) {
    form.id = item.id
    form.description = item.description
    form.type = item.type
    form.quantity = item.quantity
    form.value = item.value
  }

  function validateFields() {
    if (form.quantity < 1) {
      throw 'Ingrese una cantidad valida'
    }

    if (form.value < 1) {
      throw 'Ingrese un monto valido'
    }
  }

  return { store, update, destroy, form, onSubmit, setValues }
}

export default useTransaction
