<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();
        return view('projects', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|max:2048',
            'date' => 'required|date',
            'type' => 'required|in:Tugas,Hobi',
        ]);

        $path = $request->file('image')->store('projects', 'public');

        Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $path,
            'date' => $request->date,
            'type' => $request->type,
        ]);

        return back()->with('success', 'Project berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|max:2048',
            'date' => 'required|date',
            'type' => 'required|in:Tugas,Hobi',
        ]);

        if ($request->hasFile('image')) {
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $path = $request->file('image')->store('projects', 'public');
            $project->image = $path;
        }

        $project->update([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'type' => $request->type,
        ]);

        return back()->with('success', 'Project berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }
        $project->delete();

        return back()->with('success', 'Project berhasil dihapus!');
    }
}
