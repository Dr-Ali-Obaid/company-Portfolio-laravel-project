<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage ;
use Illuminate\Support\Str;

class AdminProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::latest()->paginate(6);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'image' => 'required|mimes:jpeg,png,jpg,gif|image|max:2048',
        ]);
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . Str::random(5) . '.' . $image->getClientOriginalExtension();
            $disk = config('filesystems.default');
            $imagePath = $image->storeAs('images', $name, $disk);
        }
        Project::create([
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,
            'image' => $imagePath,
            'slug' => Str::slug($request->title_en) .  '-' . Str::random(5),
            'user_id' => auth()->user()->id,
        ]);
        return redirect()->route('admin.projects.index')->with('success', value: __('Project created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif|image|max:2048', //notice nullable here in update
        ]);
        $project->title_ar = $request->title_ar;
        $project->title_en = $request->title_en;
        $project->description_ar = $request->description_ar;
        $project->description_en = $request->description_en;

        $disk = config('filesystems.default');
        if($request->hasFile('image')) {
            if($project->image && Storage::disk($disk)->exists($project->image)) {
                Storage::disk($disk)->delete($project->image);
            }
            $image = $request->file('image');
            $name = time() . Str::random(5) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('images', $name, $disk);
            $project->image = $imagePath;
        }
        $project->save();
        return redirect()->route('admin.projects.index')->with('success', __('Project updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $disk = config('filesystems.default');
        if($project->image && Storage::disk($disk)->exists($project->image)) {
            Storage::disk($disk)->delete($project->image);
        }
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', __('Project deleted successfully.'));
    }
}
