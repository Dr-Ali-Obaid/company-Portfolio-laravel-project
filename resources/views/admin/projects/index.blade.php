<x-app-layout>
    <div class="max-w-7xl mx-auto">
        <div
            class="flex flex-col md:flex-row justify-between mb-8 gap-4 bg-white p-5 rounded-xl shadow-sm border border-gray-100">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 leading-tight">
                    {{ __('Projects Management') }}
                </h2>
                <p class="text-sm text-slate-500 mt-1">{{ __('Manage and monitor all your digital projects') }}</p>
            </div>

            <a href="{{ route('admin.projects.create') }}"
                class="inline-flex items-center px-6 py-3 bg-slate-800 border border-transparent rounded-lg font-bold text-sm text-white uppercase tracking-widest hover:bg-slate-700 active:bg-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-500 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                <i
                    class="fa-solid fa-plus-circle {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }} text-cyan-400 text-xl"></i>
                {{ __('Add New Project') }}
            </a>
        </div>

        {{-- محتوى الجدول --}}
        <div class="bg-white overflow-hidden shadow-sm rounded-xl p-6 border border-gray-100">

            {{-- قسم الرسالة --}}
            <x-alert />

            <div class="overflow-x-auto rounded-lg">
                <table
                    class="w-full text-sm {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }} text-gray-500">
                    <thead class="text-xs text-slate-700 uppercase bg-slate-50 border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-4 font-bold">{{ __('Image') }}</th>
                            <th class="px-6 py-4 font-bold">{{ __('Title') }}</th>
                            <th class="px-6 py-4 font-bold">{{ __('Created At') }}</th>
                            <th class="px-6 py-4 text-center font-bold">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($projects as $project)
                            <tr class="bg-white hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4">
                                    <img src="{{ Storage::url($project->image) }}"
                                        class="w-16 h-10 object-cover rounded shadow-sm border border-gray-100"
                                        alt="">
                                </td>
                                <td class="px-6 py-4 font-semibold text-slate-900">
                                    {{ app()->getLocale() === 'ar' ? $project->title_ar : $project->title_en }}
                                </td>
                                <td class="px-6 py-4 text-xs text-slate-500">
                                    {{ $project->created_at->format('Y-m-d') }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center items-center space-x-4 rtl:space-x-reverse">
                                        <a href="{{ route('admin.projects.edit', $project) }}"
                                            class="text-green-400 hover:text-green-600 transition-colors">
                                            <i class="fa-solid fa-pen-to-square text-lg"></i>
                                        </a>
                                        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST"
                                            onsubmit="return confirm('{{ __('Are you sure you want to delete this project?') }}')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-300 hover:text-red-600 transition-colors">
                                                <i class="fa-solid fa-trash text-lg"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-gray-400 italic font-medium">
                                    {{ __('No projects found.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- 4. Pagination Links --}}
            <x-my-paginator :items="$projects" />
        </div>
    </div>
</x-app-layout>
