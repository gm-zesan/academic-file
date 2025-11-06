<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Category;
use App\Models\Course;
use App\Models\File;
use App\Models\Term;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        // Count statistics
        if(Auth::user()->hasRole('admin')) {
            $course_count = Course::count();
        } else {
            $course_count = Course::where('teacher_id', Auth::id())->count();
        }
        $teacher_count = User::role('user')->count();
        $batch_count = Batch::count();
        $term_count = Term::count();
        $active_terms = Term::where('status', 1)->count();
        
        // File statistics
        $total_files = File::count();
        $approved_files = File::where('approved', 1)->count();
        $pending_files = File::where('approved', 0)->count();
        $total_file_size = File::sum('size'); // in bytes
        $total_file_size_mb = round($total_file_size / (1024 * 1024), 2);
        
        // Recent activity
        $recent_files = File::with(['course', 'uploader', 'category'])
            ->latest()
            ->take(5)
            ->get();
            
        
        // Files by category
        $files_by_category = Category::withCount('files')
            ->having('files_count', '>', 0)
            ->orderBy('files_count', 'desc')
            ->take(5)
            ->get();
        
        // Current active term
        $current_term = Term::where('id', Auth::user()->current_term_id)->first();
        
        return view('admin.home.index', compact(
            'course_count',
            'teacher_count',
            'batch_count',
            'term_count',
            'active_terms',
            'total_files',
            'approved_files',
            'pending_files',
            'total_file_size_mb',
            'recent_files',
            'files_by_category',
            'current_term'
        ));
    }
}
