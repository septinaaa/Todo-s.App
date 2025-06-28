<?php

namespace App\Http\Controllers;

use App\Models\TaskTemplate;
use Illuminate\Http\Request;

class TaskTemplateController extends Controller
{
    public function index()
    {
        $templates = TaskTemplate::all();
        return view('templates.index', compact('templates'));
    }

    public function create()
    {
        return view('templates.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable|string',
        ]);

        TaskTemplate::create($request->only('title', 'description'));

        return redirect()->route('templates.index')->with('success', 'Template berhasil ditambahkan');
    }

    public function edit(TaskTemplate $template)
    {
        return view('templates.edit', compact('template'));
    }

    public function update(Request $request, TaskTemplate $template)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable|string',
        ]);

        $template->update($request->only('title', 'description'));

        return redirect()->route('templates.index')->with('success', 'Template diperbarui');
    }

    public function destroy(TaskTemplate $template)
    {
        $template->delete();
        return redirect()->route('templates.index')->with('success', 'Template dihapus');
    }
}
