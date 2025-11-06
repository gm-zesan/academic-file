@extends('admin.app')
@section('title','Upload Files')

@push('custom-style')
    <style>
        .folder-card {
            background: #10b9811a;
            border-radius: 6px;
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
        }

        .folder-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        /* Folder tab */
        .folder-tab {
            width: 50%;
            height: 20px;
            background: #04785735;
            border-top-left-radius: 6px;
            border-top-right-radius: 6px;
            position: absolute;
            top: 0;
            left: 0;
        }

        /* Folder body */
        .folder-body {
            padding-top: 30px; /* space for tab */
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
                        <div class="table-title">Select a Course</div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">File Uploads</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="card-body" style="overflow-x:auto">
                    <div class="row">
                        @foreach($courses as $course)
                            <div class="col-md-3 mb-4">
                                <a href="{{ route('admin.files.categories', $course->id) }}" class="text-decoration-none">
                                    <div class="folder-card h-100 shadow-sm position-relative">
                                        <div class="folder-tab"></div>
                                        <div class="folder-body p-3 text-center">
                                            <h5 class="fw-bold text-dark">{{ $course->name }}</h5>
                                            <p class="text-muted mb-1">{{ $course->code }}</p>
                                            <p class="text-secondary small fw-bold mb-2">
                                                {{ $course->type->name }}
                                            </p>

                                            @if($course->teacher)
                                                <p class="text-secondary small mb-0">
                                                    Teacher: 
                                                    @if($course->teacher->name == Auth::user()->name)
                                                        <span class="fw-bold text-success">You</span>
                                                    @else
                                                        <span class="fw-bold">{{ $course->teacher->name }}</span>
                                                    @endif
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
