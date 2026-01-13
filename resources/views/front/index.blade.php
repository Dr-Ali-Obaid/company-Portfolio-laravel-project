@extends('layouts.main')

@section('content')
    <div class="container mt-5 pt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('success'))
                    <div class="alert alert-success py-1 small mb-2 shadow-sm auto-fade-out text-center">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger py-1 small mb-2 shadow-sm auto-fade-out text-center">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        </div>
        <h2 class="text-center mb-5 fw-bold">{{ __('Our Projects') }}</h2>

        <div class="row g-4">
            @foreach ($projects as $project)
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="{{ Storage::url($project->image) }}" class="card-img-top" alt="{{ $project->title_ar }}"
                            style="height: 200px; object-fit: cover;">

                        <div class="card-body">
                            <h5 class="card-title fw-bold">
                                {{ app()->getLocale() === 'ar' ? $project->title_ar : $project->title_en }}
                            </h5>

                            <p class="card-text text-muted small px-1">
                                {{ Str::limit(app()->getLocale() === 'ar' ? $project->description_ar : $project->description_en, 100) }}
                            </p>
                        </div>

                        <div class="card-footer bg-white border-0 pb-3">
                            <a href="{{ route('projects.show', $project->slug) }}"
                                class="btn btn-outline-brand w-100 rounded-pill">
                                {{ __('View Details') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="container pb-5">
        <div class="mt-4">
            {{-- Mobile View --}}
            <div class="d-md-none w-100 mobile-pagination d-flex justify-content-center">
                {{ $projects->links('pagination::simple-bootstrap-5') }}
            </div>

            {{-- Desktop View --}}
            <div class="d-none d-md-block d-flex justify-content-center">
                {{ $projects->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
@endsection
