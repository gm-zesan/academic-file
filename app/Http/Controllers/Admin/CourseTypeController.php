<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CourseTypeController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = CourseType::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action-btn', function($row) {
                    return $row->id;
                })
                ->rawColumns(['action-btn'])
                ->make(true);
        }
        return view('admin.course_types.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255|unique:course_types,name',
            'description' => 'nullable|string',
        ]);

        CourseType::create($validated);

        return redirect()->route('admin.course-types.index')
                         ->with('success','Course Type created successfully.');
    }

    public function edit($id)
    {
        $courseType  = CourseType::findOrFail($id);
        $courseTypes = CourseType::latest()->get();

        return view('admin.course_types.index', compact('courseTypes','courseType'));
    }

    public function update(Request $request, $id)
    {
        $courseType = CourseType::findOrFail($id);

        $validated = $request->validate([
            'name'        => 'required|string|max:255|unique:course_types,name,' . $courseType->id,
            'description' => 'nullable|string',
        ]);

        $courseType->update($validated);

        return redirect()->route('admin.course-types.index')
                         ->with('success','Course Type updated successfully.');
    }

    public function destroy($id)
    {
        CourseType::findOrFail($id)->delete();

        return redirect()->route('admin.course-types.index')
                         ->with('success','Course Type deleted successfully.');
    }
}
