@extends('admin.app')

@section('title')
    Dashboard
@endsection


@push('custom-style')
   <style>
        .card{
            border-radius: 10px;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .stat-card {
            position: relative;
            overflow: hidden;
        }
        .stat-icon {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 3rem;
            opacity: 0.2;
        }
        .stat-value {
            font-size: 2rem;
            font-weight: bold;
            margin: 10px 0;
        }
        .stat-label {
            font-size: 0.9rem;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .stat-trend {
            font-size: 0.85rem;
            margin-top: 5px;
        }
        .chart-card {
            min-height: 300px;
        }
        .activity-item {
            padding: 12px;
            border-bottom: 1px solid #eee;
            transition: background 0.2s;
        }
        .activity-item:hover {
            background: #f8f9fa;
        }
        .activity-item:last-child {
            border-bottom: none;
        }
        .badge-status {
            padding: 5px 10px;
            border-radius: 12px;
            font-size: 0.75rem;
        }
   </style>
@endpush

@section('content')
    <div class="container-fluid my-3">
        
        {{-- Welcome Banner --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="card bg-gradient-primary">
                    <div class="card-body p-4">
                        <p class="mb-1">Here's what's happening with your academic file management system today.</p>
                        @if($current_term)
                            <small><i class="ri-calendar-line"></i> Current Term: <strong>{{ $current_term->name }}</strong> 
                            ({{ $current_term->start_date->format('M d, Y') }} - {{ $current_term->end_date->format('M d, Y') }})</small>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Statistics Cards Row 1 --}}
        <div class="row mb-4">
            @canany(['batch-list', 'batch-create', 'batch-edit', 'batch-delete'])
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card dashboard-card">
                        <div class="card-body target-bg">
                            <div class="dashboard-icon">
                                <a href="{{ route('admin.teachers.index') }}"><i class="ri-user-3-line"></i></a>
                            </div>
                            <div class="dashboard-info">
                                <h4 class="target-title">Batches</h4>
                                <h3 class="numbers"> {{ $batch_count }} + </h3>
                                <a href="{{ route('admin.batches.index') }}">View all<i class="ms-2 ri-arrow-right-line"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
            @canany(['course-list', 'course-create', 'course-edit', 'course-delete'])
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card dashboard-card">
                        <div class="card-body target-bg non">
                            <div class="dashboard-icon">
                                <a href="{{ route('admin.courses.index') }}">
                                    <i class="ri-book-2-line"></i>
                                </a>
                            </div>
                            <div class="dashboard-info">
                                <h4 class="target-title"> @if(Auth::user()->hasRole('admin')) Total Courses @else My Course @endif</h4>
                                <h3 class="numbers"> {{ $course_count }} + </h3>
                                <a href="{{ route('admin.courses.index') }}">View all<i class="ms-2 ri-arrow-right-line"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
            
            <div class="col-md-3 col-sm-6 mb-3">
                @canany(['teacher-list', 'teacher-create', 'teacher-edit', 'teacher-delete'])
                    <div class="card dashboard-card">
                        <div class="card-body target-bg">
                            <div class="dashboard-icon">
                                <a href="{{ route('admin.teachers.index') }}"><i class="ri-user-3-line"></i></a>
                            </div>
                            <div class="dashboard-info">
                                <h4 class="target-title">Teacher</h4>
                                <h3 class="numbers"> {{ $teacher_count }} + </h3>
                                <a href="{{ route('admin.teachers.index') }}">View all<i class="ms-2 ri-arrow-right-line"></i></a>
                            </div>
                        </div>
                    </div>
                @endcan
            </div>
        </div>

        {{-- Statistics Cards Row 2 --}}
        @canany(['file-monitor'])
            <div class="row mb-4">
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card dashboard-card">
                        <div class="card-body target-bg non">
                            <div class="dashboard-icon">
                                <a href="{{ route('admin.files.monitor') }}">
                                    <i class="ri-file-list-line"></i>
                                </a>
                            </div>
                            <div class="dashboard-info">
                                <h4 class="target-title">Total Files</h4>
                                <h3 class="numbers"> {{ $total_files }} + </h3>
                                <div class="stat-trend">
                                    <small><i class="ri-check-line"></i> {{ $approved_files }} Approved | 
                                    <i class="ri-time-line text-warning"></i> {{ $pending_files }} Pending</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card dashboard-card">
                        <div class="card-body target-bg">
                            <div class="dashboard-icon">
                                <a href="{{ route('admin.files.monitor') }}">
                                    <i class="ri-hard-drive-line"></i>
                                </a>
                            </div>
                            <div class="dashboard-info">
                                <h4 class="target-title">Storage Used</h4>
                                <h3 class="numbers"> {{ $total_file_size_mb }} MB </h3>
                                <div class="stat-trend text-white">
                                    <small>Across all files</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            {{-- Activity Tables Row --}}
            <div class="row mb-4">
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0"><i class="ri-file-add-line"></i> Recent Files</h5>
                        </div>
                        <div class="card-body">
                            @forelse($recent_files as $file)
                                <div class="activity-item">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="flex-grow-1">
                                            <strong>{{ Str::limit($file->original_name, 40) }}</strong>
                                            <br>
                                            <small class="text-muted">
                                                <i class="ri-user-line"></i> {{ $file->uploader->name ?? 'Unknown' }}
                                                @if($file->course)
                                                    | <i class="ri-book-line"></i> {{ $file->course->name }}
                                                @endif
                                            </small>
                                            <br>
                                            <small class="text-muted">
                                                <i class="ri-time-line"></i> {{ $file->created_at->diffForHumans() }}
                                            </small>
                                        </div>
                                        <span class="badge badge-status {{ $file->approved ? 'bg-success' : 'bg-warning' }}">
                                            {{ $file->approved ? 'Approved' : 'Pending' }}
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <div class="activity-item text-center text-muted">
                                    <small>No recent files</small>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0"><i class="ri-file-list-2-line"></i> Top Categories by Files</h5>
                        </div>
                        <div class="card-body p-0">
                            @forelse($files_by_category as $category)
                                <div class="activity-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $category->name }}</strong>
                                        <br>
                                        <small class="text-muted">
                                            <i class="ri-folder-3-line"></i> {{ $category->files_count }} files
                                        </small>
                                    </div>
                                    <div>
                                        <span class="badge bg-primary">{{ $category->files_count }}</span>
                                    </div>
                                </div>
                            @empty
                                <div class="activity-item text-center text-muted">
                                    <small>No files uploaded yet</small>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        
        @endcanany

    </div>
@endsection

@push('custom-scripts')
@endpush
