<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber; 

use Illuminate\Http\Request;

class AdminSubscriberController extends Controller
{
    public function index(Request $request)
    {
       
        $subscribers = Subscriber::query()
            ->when($request->search, function ($query, $search) {
                return $query->where('email', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate(15);

        $totalSubscribers = Subscriber::count();

        return view('admin.subscribers.index', compact('subscribers', 'totalSubscribers'));
    }

    public function destroy(Subscriber $subscriber) // حرف كبير هنا أيضاً
    {
        $subscriber->delete();
        return redirect()->route('admin.subscribers.index')->with('success', __('Subscriber deleted successfully.'));
    }
}
