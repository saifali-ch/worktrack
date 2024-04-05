import './bootstrap';
import Swal from 'sweetalert2'
import $ from 'jquery'
import "@selectize/selectize/dist/js/selectize.min.js"
import 'flatpickr/dist/flatpickr.min.js'
import flatpickr from "flatpickr"
import "inputmask/dist/jquery.inputmask.min.js"

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

Livewire.on('js:render', (e) => {
    registerModalTriggers()
    requestAnimationFrame(() => {
        $('select.selectize').each(function () {
            const $selectize = $(this)[0].selectize;
            const items = $selectize ? [$selectize.getValue()] : ['null'];
            if ($selectize) {
                $selectize.destroy();
            }
            $(this).selectize({
                items: items,
                onChange: function () {
                    this.$input[0].dispatchEvent(new Event('change'));
                    this.blur();
                }
            });
        });

        flatpickr('.fp-calender', {
            disableMobile: true,
        });

        flatpickr('.fp-calender.range', {
            disableMobile: true,
            mode: "range",
            defaultDate: e[0] ? [e[0].fromDate, e[0].toDate] : [],
            onClose: function (selectedDates, dateStr, instance) {
                const from = $('#fromDate');
                const to = $('#toDate');
                from.val(dateStr.split(' to ')[0]);
                to.val(dateStr.split(' to ')[1]);
                from[0].dispatchEvent(new Event('input'));
                to[0].dispatchEvent(new Event('input'));
            },
        });

        flatpickr('.fp-time', {
            disableMobile: true,
            enableTime: true,
            noCalendar: true,
            dateFormat: "G:i K",
        });

        function dispatchInputEvent() {
            this.dispatchEvent(new Event('input'));
        }

        const currencyInputs = $('.currency');
        currencyInputs.inputmask('currency', {
            allowMinus: false,
            groupSeparator: ',',
            prefix: 'GBP £',
            rightAlign: false,
            removeMaskOnSubmit: true,
            oncomplete: dispatchInputEvent,
            oncleared: dispatchInputEvent
        });
        currencyInputs.on('change', dispatchInputEvent);

        // Scroll into view the last shift when a new shift is added
        const shifts = document.querySelectorAll('.shift');
        if (shifts.length) {
            const lastShift = shifts[shifts.length - 1];

            // Scroll the last shift into view with smooth behavior
            lastShift.scrollIntoView({behavior: 'smooth'});

            // Scroll additional 50 pixels if needed
            // Note: We wrap this in a 'setTimeout' to ensure it runs after the smooth scroll has finished.
            setTimeout(() => {
                window.scrollBy({top: 50, left: 0, behavior: 'smooth'});
            }, 200);
        }
    })
})

Livewire.on('show:invoice-preview', function () {
    showModal('modal-invoice-preview');
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

// Invoice Alpine Component
window.invoice = (sites) => ({
    sites: sites,

    clearInvoice() {
        $('select.selectize').each(function () {
            $(this)[0].selectize.destroy();
            $(this).selectize({
                items: ['null'],
            });
        });
        Livewire.dispatch('clearInvoice')
    },

    formatDate(str) {
        const formatted = new Date(str).toLocaleDateString('en-GB', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
        return formatted === 'Invalid Date' ? '' : formatted;
    },

    getSiteName(siteId) {
        if (!siteId) return;
        const site = this.sites.find(site => site.id === parseInt(siteId));
        return site ? site.name : '';
    },

    total(shifts) {
        const total = shifts.reduce((acc, shift) => acc + this.parseGBP(shift.total), 0);
        return this.formatToGBP(total)
    },

    removeGBP(currency) {
        return currency.replace('GBP ', '')
    },

    parseGBP(currencyString) {
        // Remove currency symbol and potential preceding characters (e.g., "GBP £", spaces)
        currencyString = currencyString.replace(/[^\d.,]/g, '');

        // Remove commas
        currencyString = currencyString.replace(/,/g, '');

        // Convert to a Number type
        return parseFloat(currencyString) || 0;
    },

    formatToGBP(numberValue) {
        // Ensure the input is a number
        if (isNaN(numberValue)) {
            return
        }

        // Convert the number to a string with fixed two decimal places
        let currencyString = numberValue.toFixed(2);

        // Add comma as a thousand separator
        let parts = currencyString.split('.');
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');

        // Reassemble the parts and prepend the currency symbol
        currencyString = '£' + parts.join('.');

        return currencyString;
    }

})
