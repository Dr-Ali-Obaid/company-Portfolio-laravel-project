<x-app-layout>
    <div class="py-6 font-cairo">
        {{-- 1. Header Section --}}
        <div
            class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4 bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">{{ __('Newsletters Management') }}</h2>
                <p class="text-sm text-gray-500 mt-1">
                    {{ __('View history and send new newsletters to your subscribers.') }}</p>
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

        {{-- 2. Control Section --}}
        <div class="bg-white p-5 rounded-t-xl border-x border-t border-gray-100">
            <form action="{{ route('admin.newsletters.index') }}" method="GET"
                class="flex items-center gap-3 max-w-lg">
                <div class="relative flex-1">
                    <span
                        class="absolute inset-y-0 {{ app()->getLocale() === 'ar' ? 'right-0 pr-3' : 'left-0 pl-3' }} flex items-center pointer-events-none">
                        <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                    </span>

                    <input type="text" name="search" value="{{ request('search') }}"
                        class="block w-full {{ app()->getLocale() === 'ar' ? 'pr-10 pl-10' : 'pl-10 pr-10' }} py-2.5 border border-gray-200 rounded-xl bg-gray-50/50 text-sm focus:ring-2 focus:ring-slate-800/20 focus:border-slate-800 transition-all"
                        placeholder="{{ __('Search by subject...') }}">

                    @if (request('search'))
                        <a href="{{ route('admin.newsletters.index') }}"
                            class="absolute inset-y-0 {{ app()->getLocale() === 'ar' ? 'left-0 pl-3' : 'right-0 pr-3' }} flex items-center text-gray-400 hover:text-red-500 transition-colors">
                            <i class="fa-solid fa-circle-xmark text-sm"></i>
                        </a>
                    @endif
                </div>

                <button type="submit"
                    class="inline-flex items-center px-6 py-2.5 bg-slate-800 text-white text-sm font-bold rounded-xl hover:bg-slate-700 active:scale-95 transition-all shadow-sm">
                    {{ __('Search') }}
                </button>
            </form>
        </div>

        {{-- 3. Data Table --}}
        <div class="bg-white shadow-sm border border-gray-200 rounded-b-xl overflow-hidden">
            <x-alert />

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-right rtl:text-right">
                    <thead class="bg-gray-50 text-slate-700 font-bold uppercase border-b">
                        <tr>
                            <th class="px-6 py-4 text-start">{{ __('Subject') }}</th>
                            <th class="px-6 py-4 text-center">{{ __('Author') }}</th>
                            <th class="px-6 py-4 text-center">{{ __('Status') }}</th>
                            <th class="px-6 py-4 text-center">{{ __('Sent Date') }}</th>
                            <th class="px-6 py-4 text-center">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($newsletters as $item)
                            <tr id="newsletter-row-{{ $item->id }}"
                                class="hover:bg-slate-50/50 transition duration-150">
                                <td class="px-6 py-4 text-start">
                                    <div class="font-medium text-slate-900">
                                        {{ app()->getLocale() === 'ar' ? $item->subject_ar : $item->subject_en }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center text-gray-600">
                                    {{ $item->user->name }}
                                </td>
                                <td class="px-6 py-4 text-center status-container">
                                    @if ($item->sent_at)
                                        <span
                                            class="bg-green-100 text-green-700 px-2.5 py-1 rounded-full text-xs font-bold shadow-sm">
                                            <i class="fa-solid fa-check-double me-1"></i> {{ __('Sent') }}
                                        </span>
                                    @else
                                        <span
                                            class="bg-amber-100 text-amber-700 px-2.5 py-1 rounded-full text-xs font-bold animate-pulse shadow-sm border border-amber-200">
                                            <i class="fa-solid fa-clock me-1"></i> {{ __('Pending') }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center text-gray-500 italic sent-at-cell">
                                    {{ $item->sent_at ? $item->sent_at->format('Y-m-d H:i') : '---' }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('admin.newsletters.show', $item) }}"
                                        class="text-slate-600 hover:text-slate-900 p-2 rounded-lg hover:bg-slate-100 transition"
                                        title="{{ __('View Details') }}">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.newsletters.destroy', $item) }}" method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('{{ __('Are you sure you want to delete this record?') }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-500 hover:text-red-700 p-2 rounded-lg hover:bg-red-50 transition"
                                            title="{{ __('Delete') }}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <i class="fa-solid fa-box-open text-gray-200 text-6xl mb-4"></i>
                                        <p class="text-gray-500 text-lg font-medium">{{ __('No newsletters found.') }}
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <x-my-paginator :items="$newsletters" />
        </div>
    </div>

    {{-- Real-time script using Laravel Echo --}}
    <script type="module">
        document.addEventListener('DOMContentLoaded', function() {
            window.Echo.channel('newsletter-status')
                .listen('NewsletterStatusUpdated', (event) => {
                    console.log('Real-time update received:', event);

                    // Find the specific table row using the ID
                    const row = document.getElementById(`newsletter-row-${event.id}`);

                    // Logic: Only update UI if we have a valid sent_at value from the event
                    if (row && event.sent_at) {

                        // 1. Update the Sent At cell text
                        const dateCell = row.querySelector('.sent-at-cell');
                        dateCell.innerText = event.sent_at;

                        // 2. Update the Status Badge to "Sent"
                        const statusContainer = row.querySelector('.status-container');
                        statusContainer.innerHTML = `
                        <span class="bg-green-100 text-green-700 px-2.5 py-1 rounded-full text-xs font-bold shadow-sm">
                            <i class="fa-solid fa-check-double me-1"></i> {{ __('Sent') }}
                        </span>
                    `;

                        // 3. Visual Feedback: Trigger background highlight only on successful update
                        row.classList.add('bg-green-50');
                        setTimeout(() => {
                            row.classList.remove('bg-green-50');
                        }, 3000);
                    }
                });
        });
    </script>
</x-app-layout>
