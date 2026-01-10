<div
    style="direction: {{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; padding: 20px; border: 1px solid #eee; border-radius: 10px; max-width: 600px; margin: auto;">
    <h2 style="color: #333;">{{ __('Welcome to Afaq Digital') }}</h2>
    <p style="color: #555; line-height: 1.6;">
        {{ __('Thank you for subscribing to our newsletter. To start receiving our latest updates, please verify your email address by clicking the button below:') }}
    </p>

    <div style="margin: 30px 0;">
        <a href="{{ route('subscribe.verify', ['token' => $subscriber->token]) }}"
            style="background-color: #007bff; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold;">
            {{ __('Confirm Subscription') }}
        </a>
    </div>

    <p style="font-size: 0.9em; color: #e74c3c; margin-top: 20px;">
        * {{ __('This verification link will expire in 30 minutes.') }}
    </p>

    <p style="font-size: 0.85em; color: #999;">
        {{ __('If you did not sign up for this newsletter, you can safely ignore this email.') }}
    </p>
    <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">
    <p style="font-size: 0.8em; color: #bbb;">&copy; {{ date('Y') }} {{ config('app.name') }}.
        {{ __('All rights reserved.') }}</p>
</div>
