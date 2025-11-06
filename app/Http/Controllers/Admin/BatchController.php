<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BatchController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Batch::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action-btn', function($row) {
                    return $row->id;
                })
                ->rawColumns(['action-btn'])
                ->make(true);
        }
        return view('admin.batches.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255|unique:batches,name',
        ]);

        Batch::create($validated);
        return redirect()->route('admin.batches.index')
            ->with('success','Batch created successfully.');
    }

    public function edit(Batch $batch)
    {
        return view('admin.batches.index', compact('batch'));
    }

    public function update(Request $request, Batch $batch)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255|unique:batches,name,' . $batch->id,
        ]);

        $batch->update($validated);
        return redirect()->route('admin.batches.index')
            ->with('success','Batch updated successfully.');
    }

    public function destroy(Batch $batch)
    {
        $batch->delete();
        return redirect()->route('admin.batches.index')
            ->with('success','Batch deleted successfully.');
    }

}
