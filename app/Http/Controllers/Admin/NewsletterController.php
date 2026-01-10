<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendNewsletterJob;
use App\Mail\Newsletter as NewsletteMail;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $newsletters = Newsletter::query()
            ->when($request->search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('subject_ar', 'like', '%' . $search . '%')
                        ->orWhere('subject_en', 'like', '%' . $search . '%');
                });
            })
            ->with('user')
            ->latest()
            ->paginate(10);
        return view('admin.newsletters.index', compact('newsletters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.newsletters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject_ar' => 'required|string|max:255',
            'subject_en' => 'required|string|max:255',
            'content_ar' => 'required|string', 
            'content_en' => 'required|string', 
        ]);
        if($request->action ==='test') {
            $adminEmail = auth()->user()->email;
            $newsletterObject = (object) $validated;
            $newsletterObject->token = 'test-token';
            Mail::to($adminEmail)->send(new NewsletteMail($newsletterObject));
            return redirect()->route('admin.newsletters.index')->with('success', __('Test email sent successfully.'));
        }
        if($request->action ==='send_all') {
            $newsletter = auth()->user()->newsletters()->create($validated);
            SendNewsletterJob::dispatch($newsletter);
            return redirect()->route('admin.newsletters.index')->with('success', __('Newsletter saved and queued for delivery.'));  
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Newsletter $newsletter)
    {
        return view('admin.newsletters.show', compact('newsletter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Newsletter $newsletter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Newsletter $newsletter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Newsletter $newsletter)
    {
        $newsletter->delete();
        return redirect()->route('admin.newsletters.index')->with('success', __('Newsletter deleted successfully.'));
    }
}
