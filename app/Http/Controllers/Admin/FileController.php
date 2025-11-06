<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class FileController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:file-list|file-upload|file-monitor', only: ['index', 'showCategories', 'monitorFiles']),
            new Middleware('permission:file-upload', only: ['store']),
            new Middleware('permission:file-monitor', only: ['monitorFiles']),
        ];
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = Course::where('term_id', $user->current_term_id);

        if (! $user->hasRole('admin')) {
            $query->where('teacher_id', $user->id);
        }

        $courses = $query->get();


        return view('admin.files.index', compact('courses'));
    }

    public function showCategories(Course $course)
    {
        $course_type = $course->type->id;
        $categories = Category::where('allowed_upload', true)->where('course_type_id', $course_type)->where('term_id', Auth::user()->current_term_id)->get();

        $treeCategories =Category::with([
            'children.children',
            'files' => fn($q) => $q->where('course_id', $course->id),
            'children.files' => fn($q) => $q->where('course_id', $course->id),
            'children.children.files' => fn($q) => $q->where('course_id', $course->id),
        ])->whereNull('parent_id')->where('course_type_id', $course_type)->where('term_id', Auth::user()->current_term_id)->get();

        return view('admin.files.categories', compact('course','categories','treeCategories'));
    }

    public function monitorFiles()
    {
        $courses = Course::with(['type', 'teacher', 'files.category'])->where('term_id', Auth::user()->current_term_id)->get();
        $categories = Category::with('parent')->get();

        return view('admin.files.monitor', compact('courses', 'categories'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'course_id'   => 'required|exists:courses,id',
            'file'        => 'required|file|max:10240' // 10 MB
        ]);

        $fileRecord = File::where('category_id', $request->category_id)
                      ->where('course_id', $request->course_id)
                      ->first();

        $path = $request->file('file')->store('uploads/files','public');

        if ($fileRecord) {
            if (Storage::disk('public')->exists($fileRecord->file_path)) {
                Storage::disk('public')->delete($fileRecord->file_path);
            }

            // Update the existing record
            $fileRecord->update([
                'uploaded_by'   => Auth::id(),
                'file_path'     => $path,
                'original_name' => $request->file('file')->getClientOriginalName(),
                'mime_type'     => $request->file('file')->getClientMimeType(),
                'size'          => $request->file('file')->getSize(),
            ]);
        } else {
            // Create a new record if not exists
            File::create([
                'category_id'   => $request->category_id,
                'course_id'     => $request->course_id,
                'uploaded_by'   => Auth::id(),
                'file_path'     => $path,
                'original_name' => $request->file('file')->getClientOriginalName(),
                'mime_type'     => $request->file('file')->getClientMimeType(),
                'size'          => $request->file('file')->getSize(),
            ]);
        }

        if ($request->ajax()) {
            return response()->json([
                'message'  => 'Uploaded successfully',
                'file_url' => Storage::url($path)
            ]);
        }

        return back()->with('success','File uploaded successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file)
    {
        //
    }

    public function download($id)
    {
        $file = File::findOrFail($id);
        return response()->download(storage_path('app/'.$file->file_path), $file->original_name);
    }


}
