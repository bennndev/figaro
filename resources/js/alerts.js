export function showAlert(type, title, text) {
    const config = {
        title: title,
        text: text,
        confirmButtonColor: '#ffffff',
        confirmButtonText: 'Entendido',
        background: '#2A2A2A',
        color: '#ffffff',
        customClass: {
            confirmButton: 'bg-white text-black font-semibold px-6 py-2 rounded hover:bg-gray-200 transition'
        }
    };

    Swal.fire({
        ...config,
        icon: type,
        iconColor: getColor(type)
    });
}

export function confirmDelete(url, itemName = 'este elemento') {
    Swal.fire({
        title: '¿Estás seguro?',
        text: `Se eliminará ${itemName} permanentemente`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#EF4444',
        cancelButtonColor: '#6B7280',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
        background: '#2A2A2A',
        color: '#ffffff',
        iconColor: '#F59E0B',
        allowOutsideClick: false,
        allowEscapeKey: false
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = url;

            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (csrfToken) {
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = csrfToken.getAttribute('content');
                form.appendChild(csrfInput);
            }

            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            form.appendChild(methodInput);

            document.body.appendChild(form);
            form.submit();
        }
    });
}

export function confirmCreate(formElement, itemName = 'elemento') {
    Swal.fire({
        title: '¿Confirmar creación?',
        text: `Se creará ${itemName}`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#10B981',
        cancelButtonColor: '#6B7280',
        confirmButtonText: 'Sí, crear',
        cancelButtonText: 'Cancelar',
        background: '#2A2A2A',
        color: '#ffffff',
        iconColor: '#10B981',
        allowOutsideClick: false,
        allowEscapeKey: false
    }).then((result) => {
        if (result.isConfirmed) {
            formElement.submit();
        }
    });
}

export function confirmEdit(formElement, itemName = 'elemento') {
    Swal.fire({
        title: '¿Confirmar cambios?',
        text: `Se actualizará ${itemName}`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3B82F6',
        cancelButtonColor: '#6B7280',
        confirmButtonText: 'Sí, actualizar',
        cancelButtonText: 'Cancelar',
        background: '#2A2A2A',
        color: '#ffffff',
        iconColor: '#3B82F6',
        allowOutsideClick: false,
        allowEscapeKey: false
    }).then((result) => {
        if (result.isConfirmed) {
            formElement.submit();
        }
    });
}

export function showValidationErrors(errors) {
    const errorList = Array.isArray(errors) ? errors.join('<br>') : errors;
    Swal.fire({
        icon: 'error',
        title: 'Errores de validación',
        html: errorList,
        confirmButtonColor: '#EF4444',
        confirmButtonText: 'Entendido',
        background: '#2A2A2A',
        color: '#ffffff',
        iconColor: '#EF4444'
    });
}

function getColor(type) {
    switch (type) {
        case 'success': return '#10B981';
        case 'error': return '#EF4444';
        case 'warning': return '#F59E0B';
        case 'info': return '#3B82F6';
        default: return '#FFFFFF';
    }
}
