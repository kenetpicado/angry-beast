import { router, useForm, usePage } from '@inertiajs/vue3'
import confirmAction from '@/Utils/confirmation'
import { deleted, updated } from '@/Utils/toast.js'
import { ref } from 'vue'

export function useAnimal() {
  const props = usePage().props

  const form = useForm({
    id: props.animal?.id,
    name: props.animal?.name,
    code: props.animal?.code,
    sex: props.animal?.sex || 'Hembra',
    race: props.animal?.race || '',
    initial_weight: props.animal?.initial_weight || '',
    initial_height: props.animal?.initial_height || '',
    birth_date: props.animal?.birth_date || '',
    entry_date: props.animal?.entry_date || '',
    exit_date: props.animal?.exit_date || '',
    death_date: props.animal?.death_date || '',
    death_cause: props.animal?.death_cause || '',
    photo: props.animal?.photo || '',
    specie_id: props.animal?.specie_id || '',
    description: props.animal?.description || ''
  })

  const preview = ref(props.animal?.photo)

  function confirmRemoveImage() {
    confirmAction({
      callback: () => {
        router.delete(route('dashboard.photo.destroy', form.id), {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => {
            form.photo = ''
            preview.value = ''
            deleted()
          }
        })
      }
    })
  }

  function removeImage() {
    preview.value = ''
    form.photo = ''
  }

  function handlePhotoChange(event) {
    form.photo = event.target.files[0]
    const reader = new FileReader()
    reader.readAsDataURL(form.photo)
    reader.onload = () => {
      preview.value = reader.result
    }
  }

  function updatePhoto() {
    router.post(
      route('dashboard.photo.store'),
      {
        photo: form.photo,
        animal_id: form.id
      },
      {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
          form.photo = ''
          updated()
        },
        onError: (err) => {
          console.log(err)
        }
      }
    )
  }

  function update(onDone) {
    form.put(route('dashboard.animals.update', form.id), {
      preserveScroll: true,
      preserveState: true,
      onSuccess: () => {
        if (onDone) onDone()
        updated()
      }
    })
  }

  return { form, confirmRemoveImage, preview, handlePhotoChange, updatePhoto, update, removeImage }
}

export default useAnimal
