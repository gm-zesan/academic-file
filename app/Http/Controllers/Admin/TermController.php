<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Term;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TermController extends Controller
{
    /**
     * Display a listing of the terms.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Term::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function($row){
                    return $row->status;
                })
                ->addColumn('start_date', function($row){
                    return $row->start_date ? \Carbon\Carbon::parse($row->start_date)->format('d M, Y') : 'N / A';
                })
                ->addColumn('end_date', function($row){
                    return $row->end_date ? \Carbon\Carbon::parse($row->end_date)->format('d M, Y') : 'N / A';
                })
                ->addColumn('action-btn', function($row) {
                    return $row->id;
                })
                ->rawColumns(['action-btn'])
                ->make(true);
        }
        return view('admin.terms.index');
    }

    /**
     * Show the form for creating a new term.
     */
    public function create()
    {
        return view('admin.terms.create');
    }

    /**
     * Store a newly created term in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255|unique:terms,name',
            'start_date' => 'nullable|date',
            'end_date'   => 'nullable|date|after_or_equal:start_date',
            'status'     => 'required|in:1,0',
        ]);

        Term::create($validated);

        return redirect()->route('admin.terms.index')
            ->with('success', 'Term created successfully.');
    }

    /**
     * Show the form for editing the specified term.
     */
    public function edit(Term $term)
    {
        return view('admin.terms.index', compact('term'));
    }

    /**
     * Update the specified term in storage.
     */
    public function update(Request $request, Term $term)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255|unique:terms,name,' . $term->id,
            'start_date' => 'nullable|date',
            'end_date'   => 'nullable|date|after_or_equal:start_date',
            'status'     => 'required|in:1,0',
        ]);

        $term->update($validated);

        return redirect()->route('admin.terms.index')
            ->with('success', 'Term updated successfully.');
    }

    /**
     * Remove the specified term from storage.
     */
    public function destroy(Term $term)
    {
        $term->delete();

        return redirect()->route('admin.terms.index')
            ->with('success', 'Term deleted successfully.');
    }
}
