import './bootstrap';
import Swal from 'sweetalert2'

import.meta.glob([
    '../images/**',
    '../fonts/**',
]);


const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    padding: '10px',
    showCloseButton: true,
    timer: 2000,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    },
})

Livewire.on('toast', (e) => {
    Toast.fire({
        icon: e[0].type,
        title: e[0].message
    })
})
