<x-app-layout>
    <div class="py-8 max-w-5xl mx-auto font-cairo px-4">

        <div class="flex items-center justify-between mb-8 pb-4 border-b border-gray-200">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">{{ __('Newsletter Archive') }}</h2>
                <p class="text-sm text-gray-500 mt-1">
                    <i class="fa-regular fa-calendar-check me-1"></i>
                    {{ $newsletter->sent_at ? $newsletter->sent_at->format('Y/m/d - H:i') : __('Pending') }}
                </p>
            </div>
            <a href="{{ route('admin.newsletters.index') }}"
                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-slate-700 hover:bg-gray-50 transition shadow-sm">
                <i class="fa-solid fa-arrow-rotate-left {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                {{ __('Back') }}
            </a>
        </div>

        <div class="space-y-8">
            @foreach(['ar' => 'Arabic Version', 'en' => 'English Version'] as $lang => $label)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden" dir="{{ $lang === 'ar' ? 'rtl' : 'ltr' }}">
                
                <div class="bg-slate-50 px-6 py-3 border-b border-gray-200">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-widest">{{ __($label) }}</span>
                </div>
                
                <div class="p-8">
                  
                    <div class="mb-6 pb-6 border-b border-gray-100">
                        <h1 class="text-2xl font-extrabold text-slate-900">
                            {{ $lang === 'ar' ? $newsletter->subject_ar : $newsletter->subject_en }}
                        </h1>
                    </div>

                    <div class="text-slate-700 leading-relaxed text-lg whitespace-pre-line">
                        {{ $lang === 'ar' ? $newsletter->content_ar : $newsletter->content_en }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>