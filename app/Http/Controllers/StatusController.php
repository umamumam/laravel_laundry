<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index(Request $request)
    {
        $query = Status::query();
        if ($request->has('search')) {
            $query->where('status_name', 'like', '%' . $request->search . '%');
        }
        $statuses = $query->latest()->paginate(10);
        return view('statuses.index', compact('statuses'));
    }
    

    public function create()
    {
        return view('statuses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'status_name' => 'required|string|max:255',
        ]);

        Status::create($request->all());

        return redirect()->route('statuses.index')->with('success', 'Status berhasil ditambahkan!');
    }

    public function edit(Status $status)
    {
        return view('statuses.edit', compact('status'));
    }

    public function update(Request $request, Status $status)
    {
        $request->validate([
            'status_name' => 'required|string|max:255',
        ]);

        $status->update($request->all());

        return redirect()->route('statuses.index')->with('success', 'Status berhasil diperbarui!');
    }

    public function destroy(Status $status)
    {
        $status->delete();
        return redirect()->route('statuses.index')->with('success', 'Status berhasil dihapus!');
    }
}
