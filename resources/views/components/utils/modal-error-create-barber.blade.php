@props(['key' => 'showCreateBarber'])

@if ($errors->any() && (session('modal_context') === 'create_barber' || (request()->routeIs('admin.barbers.store') && !request()->isMethod('put'))))
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
            // Esperamos a que se cierre SweetAlert, y luego forzamos el modal de crear barbero abierto
            setTimeout(() => {
                const createModal = document.querySelector('[x-data*="showCreateBarber"]');
                if (createModal && createModal.__x && createModal.__x.$data.hasOwnProperty('showCreateBarber')) {
                    console.log('Reabriendo modal de crear barbero');
                    createModal.__x.$data.showCreateBarber = true;
                } else {
                    console.log('No se encontró el modal de crear barbero');
                }
            }, 300);
        });
    });
</script>
@endif