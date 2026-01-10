<aside class="w-64 min-h-screen bg-white shadow-sm border-e border-gray-100 hidden md:block">
    <div class="p-4 space-y-4">
        <h2 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('Management') }}</h2>

        <nav class="space-y-1">
            <a href="{{ route('admin.subscribers.index') }}"
                class="flex items-center px-4 py-2 text-gray-700 hover:bg-cyan-50 hover:text-cyan-600 rounded-lg transition group">
                <i class="fa-solid fa-users me-3 text-gray-400 group-hover:text-cyan-600"></i>
                <span class="font-medium">{{ __('Subscribers') }}</span>
            </a>

            <a href="{{ route('admin.newsletters.index') }}"
                class="flex items-center px-4 py-2 text-gray-700 hover:bg-cyan-50 hover:text-cyan-600 rounded-lg transition group">
                <i class="fa-solid fa-envelope-open-text me-3 text-gray-400 group-hover:text-cyan-600"></i>
                <span class="font-medium">{{ __('Newsletters') }}</span>
            </a>

            <hr class="my-2 border-gray-50">

            <a href="{{ route('admin.projects.index') }}"
                class="flex items-center px-4 py-2 text-gray-700 hover:bg-cyan-50 hover:text-cyan-600 rounded-lg transition group">
                <i class="fa-solid fa-briefcase me-3 text-gray-400 group-hover:text-cyan-600"></i>
                <span class="font-medium">{{ __('Projects') }}</span>
            </a>

            <a href="{{ route('admin.projects.create') }}"
                class="flex items-center px-4 py-2 text-gray-700 hover:bg-cyan-50 hover:text-cyan-600 rounded-lg transition group border-t border-gray-50 pt-3">
                <i class="fa-solid fa-plus-circle me-3 text-gray-400 group-hover:text-cyan-600"></i>
                <span class="font-medium">{{ __('Add New Project') }}</span>
            </a>
        </nav>
    </div>
</aside>
