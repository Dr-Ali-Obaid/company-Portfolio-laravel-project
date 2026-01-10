@extends('layouts.main')

@section('content')
<main class="py-5"> 
    <div class="container mt-5">
        <div class="row g-5">
           
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm overflow-hidden rounded-4">
                    <img src="{{ Storage::url($project->image) }}" class="img-fluid w-100" alt="{{ $project->title_ar }}" style="max-height: 500px; object-fit: cover;">
                </div>
            </div>

            <div class="col-lg-5">
                <nav class="mb-4">      
                        <a href="{{ route('projects.index') }}" class="text-decoration-none text-muted fw-bolder">{{ __('Home') }}</a>
                </nav>

                <h1 class="fw-bold mb-4" style="color: #2EBBD3;">
                    {{ app()->getLocale() === 'ar' ? $project->title_ar : $project->title_en }}
                </h1>

                <div class="project-info mb-4">
                    <p class="text-muted fs-5" style="line-height: 1.8; text-align: justify;">
                        {{ app()->getLocale() === 'ar' ? $project->description_ar : $project->description_en }}
                    </p>
                </div>

                <div class="pt-4 border-top">
                    <a href="{{ route('projects.index') }}" class="btn btn-outline-secondary rounded-pill px-4 shadow-sm">
                        <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} mx-2"></i>
                        {{ __('Back') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection