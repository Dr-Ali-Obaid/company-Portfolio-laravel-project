<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // ملاحظة: الحقل is_admin يأخذ قيمته الافتراضية (0) من قاعدة البيانات تلقائياً
        ]);

        event(new Registered($user));

        Auth::login($user);

        // المنطق الذكي للتوجيه بعد التسجيل مباشرة
        if ($user->is_admin) {
            return redirect(route('admin.dashboard', absolute: false));
        }

        // المستخدم الجديد دائماً يذهب للرئيسية (أو صفحة تفعيل الإيميل إذا كانت مفعلة)
        return redirect(url('/'));
    }
}
