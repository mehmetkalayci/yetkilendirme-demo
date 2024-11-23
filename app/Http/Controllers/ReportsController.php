<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ReportsController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-report')->only(['create', 'store']);
        $this->middleware('permission:edit-report')->only(['edit', 'update']);
        $this->middleware('permission:delete-report')->only(['destroy']);
    }

    public function index()
    {
        $reports = Report::all();
        return view('reports.index', compact('reports'));
    }

    public function create()
    {
        $posts = Post::all();
        return view('reports.create', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'post_id' => 'required|exists:posts,id',
        ]);

        Report::create($request->all());
        return redirect()->route('reports.index')->with('success', 'Rapor başarıyla oluşturuldu.');
    }

    public function edit(Report $report)
    {
        $posts = Post::all();
        return view('reports.edit', compact('report', 'posts'));
    }

    public function update(Request $request, Report $report)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'post_id' => 'required|exists:posts,id',
        ]);

        $report->update($request->all());
        return redirect()->route('reports.index')->with('success', 'Rapor başarıyla güncellendi.');
    }

    public function destroy(Report $report)
    {
        $report->delete();
        return redirect()->route('reports.index')->with('success', 'Rapor başarıyla silindi.');
    }
}
