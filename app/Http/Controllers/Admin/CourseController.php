<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Course;
use App\Models\CourseType;
use App\Models\Term;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class CourseController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:course-list|course-create|course-edit|course-delete', only: ['index']),
            new Middleware('permission:course-create', only: ['create', 'store']),
            new Middleware('permission:course-edit', only: ['edit', 'update']),
            new Middleware('permission:course-delete', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $user = Auth::user();
            
            $query = Course::with(['term', 'batch', 'type'])->where('term_id', $user->current_term_id);

            if (! $user->hasRole('admin')) {
                $query->where('teacher_id', $user->id);
            }

            $data = $query->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('term_id', function($row){
                    return $row->term ? $row->term->name : '';
                })
                ->addColumn('batch_id', function($row){
                    return $row->batch ? $row->batch->name : '';
                })
                ->addColumn('course_type_id', function($row){
                    return $row->type ? $row->type->name : '';
                })
                ->addColumn('teacher_id', function($row){
                    return $row->teacher ? $row->teacher->name : ' - ';
                })
                ->addColumn('action-btn', function ($row) {
                    $role = Auth::user()->roles->pluck('name')->first();
                    return [
                        'id' => $row->id,
                        'role' => $role,
                    ];
                })
                ->rawColumns(['action-btn'])
                ->make(true);
        }
        $terms       = Term::all();
        $batches     = Batch::all();
        $courseTypes = CourseType::all();
        $teachers    = User::role('user')->get();
        return view('admin.courses.index', compact('terms','batches','courseTypes','teachers'));
    }

    
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'code'           => 'required|string|max:100',
            'batch_id'       => 'nullable|exists:batches,id',
            'course_type_id' => 'required|exists:course_types,id',
            'teacher_id'     => 'nullable|exists:users,id',
            'description'    => 'nullable|string'
        ]);
        $data['term_id'] = Auth::user()->current_term_id;
        Course::create($data);

        return redirect()->route('admin.courses.index')->with('success','Course created successfully.');
    }

    public function edit(Course $course)
    {
        $courses      = Course::with(['term','batch','type'])->latest()->get();
        $terms        = Term::all();
        $batches      = Batch::all();
        $courseTypes  = CourseType::all();
        $teachers     = User::role('user')->get();

        return view('admin.courses.index', compact('courses','course','terms','batches','courseTypes','teachers'));
    }

    public function update(Request $request, Course $course)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'code'           => 'required|string|max:100',
            'batch_id'       => 'nullable|exists:batches,id',
            'course_type_id' => 'required|exists:course_types,id',
            'teacher_id'     => 'nullable|exists:users,id',
            'description'    => 'nullable|string'
        ]);
        $data['term_id'] = Auth::user()->current_term_id;
        $course->update($data);

        return redirect()->route('admin.courses.index')->with('success','Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return back()->with('success','Course deleted successfully.');
    }
}
