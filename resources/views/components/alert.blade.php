
@if (session('success'))
    <div id="global-alert" class="mb-6 p-4 bg-green-50 border-r-4 border-green-500 text-green-700 flex items-center shadow-sm rounded-lg mx-2 transition-all duration-500">
        <i class="fa-solid fa-circle-check {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
        {{ session('success') }}
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const alert = document.getElementById('global-alert');
            if (alert) {
                setTimeout(() => {
                    alert.style.opacity = "0";
                    alert.style.transform = "translateY(-10px)";
                    setTimeout(() => alert.remove(), 1000);
                }, 5000);
            }
        });
    </script>
    @endpush
@endif