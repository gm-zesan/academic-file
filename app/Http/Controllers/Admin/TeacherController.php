<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $teachers = User::role('user')->get();
            return DataTables::of($teachers)
                ->addIndexColumn()
                ->addColumn('phone', function($row){
                    return $row->phone ?? 'N / A';
                })
                ->addColumn('action-btn', function($row) {
                    return $row->id;
                })
                ->rawColumns(['action-btn'])
                ->make(true);
        }
        return view('admin.teachers.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request){
        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('all-users', 'public');
        }
        $validated['password'] = bcrypt($request->password);
        $user = User::create($validated);
        $user->assignRole('user');
        return redirect()->route('admin.teachers.index')->with('success','Teacher created successfully');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user){
        return view('admin.teachers.edit',[
            'user'=>$user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user){
        $validated = $request->validated();
        if ($request->hasFile('image')) {
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
            $validated['image'] = $request->file('image')->store('all-users', 'public');
        }
        $user->update($validated);
        return redirect()->route('admin.teachers.index')->with('success','Teacher updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user){
        if ($user->image) {
            Storage::disk('public')->delete($user->image);
        }
        $user->delete();
        return redirect()->route('admin.teachers.index')->with('success','Teacher deleted successfully');
    }
}
