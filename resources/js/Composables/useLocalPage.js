import { usePage } from '@inertiajs/vue3'

export function useLocalPage() {
  function getAuth() {
    return usePage().props.value.auth
  }

  function resetErrors() {
    usePage().props.value.errors = {}
  }

  function isType(type) {
    return usePage().props.auth.type === type
  }

  return { getAuth, resetErrors, isType }
}

export default useLocalPage
