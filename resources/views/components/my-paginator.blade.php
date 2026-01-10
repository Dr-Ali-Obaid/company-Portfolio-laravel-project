@props(['items'])
<div class="px-6 py-4 bg-gray-50 border-t">
    {{-- 
    Force Tailwind pagination since Bootstrap 5 is set as default in AppServiceProvider.
    This component can be reused in all Tailwind-based views by passing the $items variable.
    --}}
    {{ $items->appends(['search' => request('search')])->links('pagination::tailwind') }}
</div>
