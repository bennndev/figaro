@props(['key' => 'showCreateBarber'])

{{-- Componente para mostrar errores específicos del modal de crear barbero --}}
@if ($errors->any() && (session('modal_context') === 'create_barber' || (request()->routeIs('admin.barbers.store') && !request()->isMethod('put'))))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Mostrar cada error como un toast individual
        @foreach($errors->all() as $error)
            if (typeof showErrorToast === 'function') {
                showErrorToast('{{ $error }}');
            } else {
                // Fallback si showErrorToast no está disponible
                console.error('showErrorToast no está disponible:', '{{ $error }}');
            }
        @endforeach
        
        // Mantener el modal abierto después de mostrar los errores
        setTimeout(() => {
            const createModal = document.querySelector('[x-data*="showCreateBarber"]');
            if (createModal && createModal.__x && createModal.__x.$data.hasOwnProperty('showCreateBarber')) {
                console.log('Reabriendo modal de crear barbero');
                createModal.__x.$data.showCreateBarber = true;
            } else {
                console.log('No se encontró el modal de crear barbero');
            }
        }, 100);
    });
</script>
@endif