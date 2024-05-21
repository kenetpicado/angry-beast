import Swal from 'sweetalert2'

export function confirmAction({ title, icon, confirmButtonText, cancelButtonText, callback }) {
  Swal.fire({
    title: title || '¿Estás seguro?',
    icon: icon || 'warning',
    showCancelButton: true,
    confirmButtonColor: '#15803d',
    cancelButtonColor: '#e74a3b',
    confirmButtonText: confirmButtonText || 'Confirmar',
    cancelButtonText: cancelButtonText || 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) callback()
  })
}

export default confirmAction
