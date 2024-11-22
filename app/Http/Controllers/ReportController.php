<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Post;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::all();
        return view('reports.index', compact('reports'));
    }

    public function create()
    {
        $posts = Post::all(); // Tüm postları al
        return view('reports.create', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'post_id' => 'required|exists:posts,id',
        ]);

        Report::create($request->only('title', 'description', 'post_id'));

        return redirect()->route('reports.index')->with('success', 'Report created successfully.');
    }

    public function edit(Report $report)
    {
        $posts = Post::all(); // Tüm postları al
        return view('reports.edit', compact('report', 'posts'));
    }

    public function update(Request $request, Report $report)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'post_id' => 'required|exists:posts,id',
        ]);

        $report->update($request->only('title', 'description', 'post_id'));

        return redirect()->route('reports.index')->with('success', 'Report updated successfully.');
    }

    public function destroy(Report $report)
    {
        $report->delete();
        return redirect()->route('reports.index')->with('success', 'Report deleted successfully.');
    }
}
