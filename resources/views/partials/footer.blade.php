<footer class="bg-dark text-white pt-5 pb-4 mt-5">
    <div class="container">
        <div class="row g-4 {{ app()->getLocale() === 'ar' ? 'text-md-start' : 'text-md-end' }} ">

            <div class="col-md-4">
                <h5 class="text-uppercase mb-4 fw-bold" style="color: #2EBBD3;">
                    {{ __('Afaq Digital') }}
                </h5>
                <p class="small text-muted">
                    {{ __('We transform ideas into tangible digital reality through innovative technical solutions and designs that meet future aspirations.') }}
                </p>
            </div>

            <div class="col-md-3 mx-auto">
                <h5 class="text-uppercase mb-4 fw-bold" style="color: #2EBBD3;">
                    {{ __('Contact Us') }}
                </h5>
                <p class="small"><i class="fas fa-envelope mx-2"></i> info@afaq.com</p>
                <p class="small"><i class="fas fa-phone mx-2"></i> {{ __('+966 500 000 000') }}</p>
                <div class="mt-3">
                    <a href="https://www.linkedin.com" target="_blank" rel="noopener noreferrer"
                        class="text-white mx-2 fs-5"><i class="fab fa-linkedin"></i></a>
                    <a href="https://www.twitter.com" target="_blank" rel="noopener noreferrer"
                        class="text-white mx-2 fs-5"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.instagram.com" target="_blank" rel="noopener noreferrer"
                        class="text-white mx-2 fs-5"><i class="fab fa-instagram"></i></a>
                </div>
            </div>

            <div class="col-md-5">
                <h5 class="text-uppercase mb-4 fw-bold" style="color: #2EBBD3;">
                    {{ __('Subscribe to Our Newsletter') }}
                </h5>
                <p class="small text-white">
                    {{ __('Be the first to know about our new projects and the latest technical innovations.') }}
                </p>
                <div id="response-message">

                    @if (session('success'))
                        <div class="alert alert-success py-1 small mb-2 shadow-sm auto-fade-out">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger py-1 small mb-2 shadow-sm auto-fade-out">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>

                <form id="subscribe-form" action="{{ route('subscribe') }}" method="POST" novalidate>
                    @csrf
                    <div class="input-group">
                        <input type="email" name="email" class="form-control custom-subscribe-input border-0"
                            placeholder="{{ __('Your Email') }}">
                        <button id="submit-btn" class="btn btn-brand custom-subscribe-btn px-4" type="submit"
                            style="background-color: #2EBBD3; color: white;">
                            {{ __('Join') }}
                        </button>
                    </div>
                </form>
            </div>

        </div>

        <hr class="mb-4 mt-5 opacity-25">

        <div class="row">
            <div class="col-md-12 text-center">
                <p class="small mb-0 text-white">
                    {{ __('All Rights') }} &copy; {{ date('Y ') }} {{ __('Reserved to') }}
                    <span style="color: #2EBBD3; font-weight: bold;">{{ __('Afaq Digital') }}</span>
                </p>
            </div>
        </div>
    </div>
</footer>

@section('script')
    <script>
        document.getElementById('subscribe-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = this;
            const messageBox = document.getElementById('response-message');
            messageBox.innerHTML = '';
            const submitBtn = document.getElementById('submit-btn');
            let formData = new FormData(form);

            submitBtn.disabled = true;
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            }).then(response => {
                return response.json().then(data => {
                    if (!response.ok) throw data;
                    return data;
                })
            }).then(data => {
                messageBox.innerHTML = `<div class="alert alert-success py-1 small mb-2 shadow-sm auto-fade-out">
                                        ${data.message}
                                    </div>`
                form.reset();
            }).catch(error => {
                const errorMsg = error.message || "{{ __('Something went wrong') }}";
                messageBox.innerHTML = `<div class="alert alert-danger py-1 small mb-2 shadow-sm auto-fade-out">
                        ${errorMsg}
                    </div>`
                form.reset();
            }).finally(() => {
                submitBtn.disabled = false;
            })
        })
    </script>
@endsection
