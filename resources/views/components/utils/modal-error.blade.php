@props(['key'])
@if ($errors->any())
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
            const modalElements = document.querySelectorAll('[x-data]');
            modalElements.forEach(el => {
                if (el && el.__x && el.__x.$data.hasOwnProperty('{{ $key }}')) {
                    el.__x.$data['{{ $key }}'] = true;
                }
            });
        }, 100);
    });
</script>
@endif
