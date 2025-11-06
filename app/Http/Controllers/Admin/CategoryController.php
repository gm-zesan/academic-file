<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $type = $request->get('type');

            $data = Category::with('parent')
                ->where('course_type_id', $type)
                ->where('term_id', Auth::user()->current_term_id)
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('parent', fn($row) => $row->parent?->name ?? '-')
                ->make(true);
        }

        $treeCategories1 = Category::with('children.children')
            ->whereNull('parent_id')
            ->where('course_type_id', 1)
            ->where('term_id', Auth::user()->current_term_id)
            ->get();

        $treeCategories2 = Category::with('children.children')
            ->whereNull('parent_id')
            ->where('course_type_id', 2)
            ->where('term_id', Auth::user()->current_term_id)
            ->get();

        $courseTypes = CourseType::all();

        return view('admin.categories.index', [
            'categories'     => Category::all(),
            'courses'        => Course::all(),
            'treeCategories1' => $treeCategories1,
            'treeCategories2'=> $treeCategories2,
            'courseTypes'    => $courseTypes
        ]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_type_id' => 'required|exists:course_types,id',
            'name'      => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id'
        ]);

        Category::create([
            'course_type_id'=> $validated['course_type_id'],
            'name'           => $validated['name'],
            'parent_id'      => $validated['parent_id'] ?? null,
            'term_id'        => Auth::user()->current_term_id,
            'allowed_upload' => $request->has('allowed_upload')
        ]);

        return redirect()->route('admin.categories.index')->with('success','Category created');
    }

    public function edit(Category $category)
    {
        $courseTypes = CourseType::all();
        $treeCategories1 = Category::with('children.children')
            ->whereNull('parent_id')
            ->where('course_type_id', 1)
            ->where('term_id', Auth::user()->current_term_id)
            ->get();

        $treeCategories2 = Category::with('children.children')
            ->whereNull('parent_id')
            ->where('course_type_id', 2)
            ->where('term_id', Auth::user()->current_term_id)
            ->get();
        return view('admin.categories.index', [
            'category'        => $category,
            'categories'   => Category::where('id','!=',$category->id)->get(),
            'courseTypes'    => $courseTypes,
            'treeCategories1' => $treeCategories1,
            'treeCategories2'=> $treeCategories2
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $category->update([
            'name'           => $validated['name'],
            'parent_id'      => $validated['parent_id'] ?? null,
            'allowed_upload' => $request->has('allowed_upload')
        ]);

        return redirect()->route('admin.categories.index')->with('success','Category updated');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success','Category deleted');
    }
}
