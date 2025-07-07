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
    });
</script>
@endif
