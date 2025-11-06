@php
// Recursive function to get full category path
function categoryPath($cat, $allCategories) {
    $path = $cat->name;
    $parent = $allCategories->firstWhere('id', $cat->parent_id);
    while($parent) {
        $path = $parent->name . ' / ' . $path;
        $parent = $allCategories->firstWhere('id', $parent->parent_id);
    }
    return $path;
}
@endphp


@extends('admin.app')
@section('title', 'Course & Category File Monitoring')


@push('custom-style')
<style>
    .course-monitor-card {
        border: 1px solid #ddd;
        border-radius: 8px;
        transition: box-shadow 0.3s, transform 0.3s;
    }

    .course-monitor-card:hover {
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        transform: translateY(-5px);
    }

    .course-monitor-card .card-header {
        background-color: #047857!important;
        color: #fff;
        border-bottom: 1px solid #ddd;
    }

    .course-monitor-card table {
        margin-bottom: 0;
    }

    .course-monitor-card th, .course-monitor-card td {
        padding: 10px;
        text-align: left;
        vertical-align: middle;
    }

    .course-monitor-card th {
        background-color: #f3f4f6;
        font-weight: 600;
    }

    .course-monitor-card tbody tr:nth-child(even) {
        background-color: #fafafa;
    }

    .course-monitor-card .badge {
        font-size: 0.9em;
        padding: 5px 10px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid my-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card table-card">
                <div class="card-header table-header">
                    <div class="title-with-breadcrumb">
                        <div class="table-title">Course & Category File Monitoring</div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">File Monitoring</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="card-body" style="overflow-x:auto">

                    <div class="row">
                        @foreach($courses as $course)
                            <div class="col-md-4 mb-4">
                                <div class="card shadow-sm h-100 course-monitor-card">
                                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="mb-0">{{ $course->name }}</h5>
                                            <small>Code: {{ $course->code }} ({{ $course->type->name }})</small>
                                        </div>
                                        <small>Teacher: {{ $course->teacher?->name ?? 'N/A' }}</small>
                                    </div>
                                    <div class="card-body p-0">
                                        <table class="table table-striped table-hover mb-0">
                                            <tbody>
                                                @foreach($categories as $category)
                                                    @php
                                                        $fullPath = categoryPath($category, $categories);
                                                        $file = $course->files->firstWhere('category_id', $category->id);
                                                    @endphp
                                                    @if($category->allowed_upload == 0 || $category->course_type_id != $course->type->id)
                                                        @continue
                                                    @endif


                                                    <tr>
                                                        <td>{{ $fullPath }}</td>
                                                        <td>
                                                            @if($file)
                                                                <span class="badge bg-success">Uploaded</span>
                                                            @else
                                                                <span class="badge bg-secondary">Pending</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($file)
                                                                <a href="{{ Storage::url($file->file_path) }}" target="_blank" class="btn btn-sm  btn-outline-primary" title="{{ $file->original_name }}">
                                                                    view
                                                                </a>
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection
