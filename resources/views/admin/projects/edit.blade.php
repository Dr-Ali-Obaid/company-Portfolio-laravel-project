<x-app-layout>
    <div
        class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700 rounded-t-lg">
        <div class="w-full mb-1">
            <nav class="flex mb-5" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 text-sm font-medium">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}"
                            class="inline-flex items-center text-gray-700 hover:text-brand dark:text-gray-300 dark:hover:text-white">
                            {{ __('Dashboard') }}
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400 rtl:rotate-180" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('admin.projects.index') }}"
                                class="ml-1 text-gray-700 hover:text-brand md:ml-2 dark:text-gray-300 dark:hover:text-white">{{ __('Projects') }}</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400 rtl:rotate-180" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-gray-500 md:ml-2 dark:text-gray-400">{{ __('Edit Project') }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">{{ __('Edit Project') }}:
                {{ $project->title_ar }}</h1>
        </div>
    </div>

    <div class="mt-4">
        @if ($errors->any())
            <div class="p-4 mb-6 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                role="alert">
                <div class="font-medium">{{ __('Whoops! Something went wrong.') }}</div>
                <ul class="mt-1.5 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- التعديل هنا: توجيه الأكشن لـ Update واستخدام الـ ID --}}
        <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data"
            class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            @csrf
            {{-- إضافة Method PUT للتعديل --}}
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label for="title_ar"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Project Title (Arabic)') }}</label>
                    {{-- جلب القيمة القديمة --}}
                    <input type="text" name="title_ar" id="title_ar"
                        value="{{ old('title_ar', $project->title_ar) }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        required>
                </div>

                <div>
                    <label for="title_en"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Project Title (English)') }}</label>
                    <input type="text" name="title_en" id="title_en"
                        value="{{ old('title_en', $project->title_en) }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        required>
                </div>

                <div class="md:col-span-2">
                    <label for="description_ar"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Project Description (Arabic)') }}</label>
                    <textarea name="description_ar" id="description_ar" rows="4"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('description_ar', $project->description_ar) }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <label for="description_en"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Project Description (English)') }}</label>
                    <textarea name="description_en" id="description_en" rows="4"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('description_en', $project->description_en) }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <label
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Current Image') }}</label>
                    <div class="mb-4">
                        {{-- استخدام الدالة الاحترافية لعرض الصورة الحالية --}}
                        <img src="{{ Storage::url($project->image) }}" alt="Current"
                            class="w-64 h-40 object-cover rounded-md shadow-sm border border-gray-200">
                    </div>

                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        for="image">{{ __('Update Image (Optional)') }}</label>
                    <div id="preview-container"
                        class="hidden mb-4 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-2 w-max">
                        <img id="image-preview" src="#" alt="Preview"
                            class="w-64 h-40 object-cover rounded-md shadow-sm">
                    </div>
                    <input name="image" id="image" type="file" accept="image/*" onchange="previewImage(event)"
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                        {{ __('Leave empty to keep current image') }}</p>
                </div>
            </div>

            <div class="flex items-center space-x-4 space-x-reverse mt-10">
                <button type="submit"
                    class="text-white bg-brand hover:bg-brand-dark focus:ring-4 focus:ring-brand-light font-medium rounded-lg text-sm px-10 py-2.5 text-center transition-colors duration-200">
                    {{ __('Update Project') }}
                </button>
                <a href="{{ route('admin.projects.index') }}"
                    class="text-gray-500 bg-white border border-gray-200 hover:bg-gray-100 rounded-lg text-sm font-medium px-5 py-2.5 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500">
                    {{ __('Cancel') }}
                </a>
            </div>
        </form>
    </div>
</x-app-layout>

<script>
    function previewImage(event) {
        const input = event.target;
        const previewContainer = document.getElementById('preview-container');
        const previewImage = document.getElementById('image-preview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.classList.remove('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            previewContainer.classList.add('hidden');
        }
    }
</script>
