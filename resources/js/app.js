import './bootstrap';
import Swal from 'sweetalert2'
import $ from 'jquery'

window.$ = window.jQuery = $;

import.meta.glob(['../images/**', '../fonts/**',]);


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

/**
 * Accessibility Enhancement for Modal Triggers:
 * - Hides all dialogs with the class 'modal' by adding a 'hidden' class to prevent them
 *   from being focused while they are not visible.
 * - Marks divs with 'data-modal-id' as focusable (tabindex='0').
 * - Attaches click and 'Enter' keydown events to these divs to open associated modals.
 *
 *
 * The 'showModal' function is called on click or 'Enter' keydown, displaying the modal
 * and allowing both mouse and keyboard users to interact with modals effectively,
 * improving overall web accessibility.
 */
const registerModalTriggers = () => {
    // Hide all dialog elements with class 'modal'
    $('dialog.modal').addClass('hidden');

    // Selects all elements with a `data-modal-id` attribute, not limited to divs
    const modalTriggers = $('[data-modal-id]');

    modalTriggers.each(function () {
        // Set tabindex to 0 to make the element focusable
        $(this).attr('tabindex', '0');

        // Register click event
        $(this).on('click', function () {
            const modalId = $(this).data('modal-id');
            window.showModal(modalId);
        });

        // Register keydown event
        $(this).on('keydown', function (event) {
            if (event.key === 'Enter') {
                const modalId = $(this).data('modal-id');
                window.showModal(modalId);
            }
        });
    });
}
$(function (){
    registerModalTriggers();
})

window.showModal = (modalId) => {
    const modal = document.getElementById(modalId);
    modal.classList.remove('hidden');
    modal.showModal();
};

window.closeModal = (modalId) => {
    const modal = document.getElementById(modalId);
    modal.close();
}
