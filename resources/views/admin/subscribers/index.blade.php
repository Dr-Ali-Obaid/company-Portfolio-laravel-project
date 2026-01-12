<x-app-layout>
    <div class="py-6 font-cairo">
        {{-- 1. Header Section --}}
        <div
            class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4 bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div class="flex items-center gap-4">
                <div class="hidden sm:flex items-center justify-center w-12 h-12 bg-slate-100 text-slate-600 rounded-lg">
                    <i class="fa-solid fa-users text-xl"></i>
                </div>

                <div>
                    <div class="flex items-center gap-3">
                        <h2 class="text-2xl font-bold text-slate-800">{{ __('Subscribers Management') }}</h2>

                        {{-- Total Count Badge --}}
                        <span
                            class="inline-flex items-center gap-1 px-3 py-1 bg-cyan-100 text-cyan-700 text-xs font-bold rounded-full shadow-sm">
                            <span class="{{ app()->getLocale() === 'ar' ? 'order-2' : 'order-1' }}" dir="ltr">
                                {{ $totalSubscribers }}
                            </span>
                            <span class="{{ app()->getLocale() === 'ar' ? 'order-1' : 'order-2' }}">
                                {{ __('Subscribers') }}
                            </span>
                        </span>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">{{ __('Manage your mailing list and send new newsletters.') }}
                    </p>
                </div>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('admin.newsletters.create') }}"
                    class="inline-flex items-center px-5 py-2.5 bg-slate-800 text-white text-sm font-medium rounded-lg hover:bg-slate-700 transition-all shadow-sm">
                    <i
                        class="fa-solid fa-paper-plane text-cyan-400 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    {{ __('Send Newsletter') }}
                </a>
            </div>
        </div>

        {{-- 2. Search Section --}}
        <div class="bg-white p-5 rounded-t-xl border-x border-t border-gray-100">
            <form action="{{ route('admin.subscribers.index') }}" method="GET"
                class="flex items-center gap-3 max-w-lg">
                <div class="relative flex-1">
                    <span
                        class="absolute inset-y-0 {{ app()->getLocale() === 'ar' ? 'right-0 pr-3' : 'left-0 pl-3' }} flex items-center pointer-events-none">
                        <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                    </span>

                    <input type="text" name="search" value="{{ request('search') }}"
                        class="block w-full {{ app()->getLocale() === 'ar' ? 'pr-10 pl-10' : 'pl-10 pr-10' }} py-2.5 border border-gray-200 rounded-xl bg-gray-50/50 text-sm focus:ring-2 focus:ring-slate-800/20 focus:border-slate-800 transition-all"
                        placeholder="{{ __('Search subscribers...') }}">

                    @if (request('search'))
                        <a href="{{ route('admin.subscribers.index') }}"
                            class="absolute inset-y-0 {{ app()->getLocale() === 'ar' ? 'left-0 pl-3' : 'right-0 pr-3' }} flex items-center text-gray-400 hover:text-red-500">
                            <i class="fa-solid fa-circle-xmark text-sm"></i>
                        </a>
                    @endif
                </div>

                <button type="submit"
                    class="inline-flex items-center px-6 py-2.5 bg-slate-800 text-white text-sm font-bold rounded-xl hover:bg-slate-700 transition-all">
                    {{ __('Search') }}
                </button>
            </form>
        </div>

        {{-- 3. Data Table Section --}}
        <div class="bg-white shadow-sm border border-gray-200 rounded-b-xl overflow-hidden">
            <x-alert />

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-right rtl:text-right">
                    <thead class="bg-gray-50 text-slate-700 font-bold uppercase border-b">
                        <tr>
                            <th class="px-6 py-4 text-start">{{ __('Email Address') }}</th>
                            <th class="px-6 py-4 text-center">{{ __('Status') }}</th>
                            <th class="px-6 py-4 text-center">{{ __('Subscription Date') }}</th>
                            <th class="px-6 py-4 text-center">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($subscribers as $subscriber)
                            <tr class="hover:bg-slate-50/50 transition duration-150">
                                <td class="px-6 py-4 font-medium text-slate-900 text-start">{{ $subscriber->email }}
                                </td>

                                {{-- Displaying status based on verified_at column --}}
                                <td class="px-6 py-4 text-center">
                                    @if ($subscriber->verified_at)
                                        <span
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-600"></span>
                                            {{ __('Active') }}
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span>
                                            {{ __('Pending') }}
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-center text-gray-600">
                                    <span class="bg-gray-100 px-2 py-1 rounded text-xs">
                                        {{ $subscriber->created_at->format('Y-m-d') }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <form action="{{ route('admin.subscribers.destroy', $subscriber) }}" method="POST"
                                        class="inline-block" onsubmit="return confirm('{{ __('Are you sure?') }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-500 hover:text-red-700 p-2 rounded-lg hover:bg-red-50 transition">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <i class="fa-solid fa-envelope-open-text text-gray-300 text-5xl mb-4"></i>
                                        <p class="text-gray-500 text-lg font-medium">{{ __('No subscribers found.') }}
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- 4. Pagination Links --}}
            <x-my-paginator :items="$subscribers" />
        </div>
    </div>
</x-app-layout>
