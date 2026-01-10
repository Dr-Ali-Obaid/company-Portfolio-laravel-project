<?php

namespace App\Http\Controllers;

use App\Mail\VerifySubscription;
use App\Models\Subscriber;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:subscribers,email',
        ], [

            'email.required' => __('Please enter your email.'),
            'email.email'    => __('Please enter a valid email address.'),
            'email.unique'   => __('You are already subscribed!'),
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "error",
                "message" => $validator->errors()->first('email'),
            ], 422);
        }

        try {
            $subscriber = Subscriber::create([
                'email' => $request->email,
                'token' => Str::random(32),
                'verified_at' => null,
            ]);
            Mail::to($subscriber->email)->locale(app()->getLocale())->send(new VerifySubscription($subscriber));
            return response()->json([
                'status'  => 'success',
                'message' => __('Thank you! Please check your email to verify your subscription.')
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => "error",
                'message' => __('Something went wrong, please try again later.')
            ], 500);
        }
    }

    public function verify($token)
    {
        $subscriber = Subscriber::where('token', $token)->first();
        if (!$subscriber) {
            return redirect(route('projects.index') . '#response-message')->with('error', __('Invalid verification link.'));
        }
        $subscriber->update([
            'verified_at' => now(),
            'token' => Str::random(32),
        ]);
        return redirect(route('projects.index') . '#response-message')->with('success', __('Your email has been verified!'));
    }

    public function unsubscribe($token){
        $subscriber = Subscriber::where('token', $token)->first();
        if (!$subscriber) {
            return redirect()->route('projects.index')->with('error', __('This link is invalid or you have already unsubscribed'));
        }
        $subscriber->delete();
        return redirect()->route('projects.index') ->with('success', __('You have been successfully unsubscribed'));
    }
}
