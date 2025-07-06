@props(['barberId'])

@if ($errors->any() && (session('modal_context') === 'edit_barber' || request()->routeIs('admin.barbers.update')))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'error',
            title: 'Se encontraron errores',
            html: `{!! implode('<br>', $errors->all()) !!}`,
            background: '#2A2A2A',
            color: 'white',
            iconColor: '#EF4444',
            confirmButtonColor: '#EF4444',
            confirmButtonText: 'Entendido',
            customClass: {
                popup: 'rounded-xl border border-white/10 shadow-lg',
                confirmButton: 'text-white font-semibold px-4 py-2'
            }
        }).then(() => {
            // Esperamos a que se cierre SweetAlert, y luego forzamos el modal de editar barbero abierto
            const editModal = document.querySelector('[x-data*="showEditModal"]');
            if (editModal && editModal.__x && editModal.__x.$data.hasOwnProperty('showEditModal')) {
                editModal.__x.$data.showEditModal = true;
            }
            
            // También podemos usar el evento personalizado si está disponible
            @if(isset($barberId))
            window.dispatchEvent(new CustomEvent('open-modal-edit-barber-{{ $barberId }}'));
            @endif
        });
    });
</script>
@endif