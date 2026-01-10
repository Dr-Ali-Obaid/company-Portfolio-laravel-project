<div class="email-wrapper" style="background-color: #f4f4f7; padding: 20px; font-family: sans-serif;">

    <div dir="rtl"
        style="background-color: #ffffff; padding: 30px; border-radius: 12px 12px 0 0; border-bottom: 2px solid #f1f5f9; text-align: right;">
        <h2 style="color: #1e293b; margin-bottom: 20px;">{{ $newsletter->subject_ar }}</h2>
        <div style="font-size: 16px; line-height: 1.8; color: #334155;">
            {!! nl2br(e($newsletter->content_ar)) !!}
        </div>

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ url('/') }}"
                style="background-color: #3490dc; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;">
                زيارة الموقع
            </a>
        </div>

        <div
            style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #edf2f7; font-size: 12px; color: #64748b;">
            <p>لإلغاء الاشتراك: <a href="{{ route('unsubscribe', $newsletter->token) }}"
                    style="color: #ef4444; font-weight: bold;">اضغط هنا</a></p>
            <p>جميع الحقوق محفوظة &copy; {{ date('Y') }}</p>
        </div>
    </div>

    <div dir="ltr"
        style="background-color: #ffffff; padding: 30px; border-radius: 0 0 12px 12px; text-align: left;">
        <h2 style="color: #1e293b; margin-bottom: 20px;">{{ $newsletter->subject_en }}</h2>
        <div style="font-size: 16px; line-height: 1.8; color: #334155;">
            {!! nl2br(e($newsletter->content_en)) !!}
        </div>

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ url('/') }}"
                style="background-color: #3490dc; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;">
               Visit Website
            </a>
        </div>

        <div
            style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #edf2f7; font-size: 12px; color: #64748b;">
            <p>To unsubscribe: <a href="{{ route('unsubscribe', $newsletter->token) }}"
                    style="color: #ef4444; font-weight: bold;">Click here</a></p>
            <p>All Rights Reserved &copy; {{ date('Y') }}</p>
        </div>
    </div>

</div>
