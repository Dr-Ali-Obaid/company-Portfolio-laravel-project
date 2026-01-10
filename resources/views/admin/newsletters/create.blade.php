<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Newsletter') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- تنبيه الأخطاء في حال وجودها --}}
                <x-alert />

                <form action="{{ route('admin.newsletters.store') }}" method="POST" dir="rtl">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                        <div class="space-y-4 border-l pl-6 border-gray-100" dir="rtl">
                            <h3 class="font-bold text-lg text-gray-800 border-b pb-2">المحتوى باللغة العربية</h3>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">عنوان الرسالة </label>
                                <input type="text" name="subject_ar" value="{{ old('subject_ar') }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">محتوى الرسالة </label>
                                <textarea name="content_ar" rows="12" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('content_ar') }}</textarea>
                            </div>
                        </div>

                        <div class="space-y-4" dir="ltr">
                            <h3 class="font-bold text-lg text-gray-800 border-b pb-2">English Content</h3>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email Subject</label>
                                <input type="text" name="subject_en" value="{{ old('subject_en') }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email Content</label>
                                <textarea name="content_en" rows="12" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('content_en') }}</textarea>
                            </div>
                        </div>

                    </div>

                    <div class="flex items-center justify-center space-x-4 space-x-reverse mt-10">
                        
                        <button type="submit" name="action" value="test"
                            class="text-brand bg-white border border-brand hover:bg-brand-light focus:ring-4 focus:ring-brand-light font-medium rounded-lg text-sm px-6 py-2.5 text-center transition-colors duration-200">
                            <i class="fa-solid fa-eye ml-2"></i>
                            {{ __('Send Test Email') }}
                        </button>

                        <button type="submit" name="action" value="send_all"
                            class="text-white bg-brand hover:bg-brand-dark focus:ring-4 focus:ring-brand-light font-medium rounded-lg text-sm px-10 py-2.5 text-center transition-colors duration-200">
                            <i class="fa-solid fa-paper-plane ml-2"></i>
                            {{ __('Save and Send Newsletter') }}
                        </button>

                        <a href="{{ route('admin.newsletters.index') }}"
                            class="text-gray-500 bg-white border border-gray-200 hover:bg-gray-100 rounded-lg text-sm font-medium px-5 py-2.5 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500">
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
