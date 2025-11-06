@extends('admin.app')

@section('title','Courses')

@push('custom-style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.semanticui.min.css">
@endpush


@section('content')
<div class="container-fluid my-4">
    <div class="row">
        {{-- List Table --}}
        <div class="@if(Auth::user()->hasRole('admin')) col-md-8 @else col-md-12 @endif">
            <div class="card table-card">
                <div class="card-header table-header d-flex justify-content-between align-items-center">
                    <h5 class="table-title mb-0">@if(Auth::user()->hasRole('admin')) All Courses @else My Courses @endif</h5>
                    @if(Auth::user()->hasRole('admin'))
                    <a href="{{ route('admin.courses.index') }}" class="add-new">Add New<i class="ms-1 ri-add-line"></i></a>
                    @endif
                </div>
                <div class="card-body" style="overflow-x:auto">
                    <table class="table w-100" id="data-table">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Term</th>
                                <th>Batch</th>
                                <th>Type</th>
                                <th>Assigned Teacher</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @if(Auth::user()->hasRole('admin'))
            {{-- Create / Edit Form --}}
            <div class="col-md-4">
                <form action="{{ isset($course) ? route('admin.courses.update',$course->id) : route('admin.courses.store') }}" method="POST">
                    @csrf
                    @if(isset($course)) @method('PUT') @endif
                    <div class="card table-card">
                        <div class="card-header table-header d-flex justify-content-between align-items-center">
                            <h5 class="table-title mb-0">{{ isset($course) ? 'Edit Course' : 'Add Course' }}</h5>
                            <button type="submit" class="btn add-new">{{ isset($course) ? 'Update' : 'Save' }}</button>
                        </div>
                        <div class="card-body custom-form">
                            <div class="mb-3">
                                <label class="form-label custom-label">Course Name</label>
                                <input type="text" name="name" class="form-control custom-input"
                                    value="{{ old('name', $course->name ?? '') }}">
                                @error('name')<div class="error_msg">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label custom-label">Course Code</label>
                                <input type="text" name="code" class="form-control custom-input"
                                    value="{{ old('code', $course->code ?? '') }}">
                                @error('code')<div class="error_msg">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label custom-label">Course Type</label>
                                <select name="course_type_id" class="form-control custom-select">
                                    <option disabled selected>--Select Type--</option>
                                    @foreach($courseTypes as $ct)
                                        <option value="{{ $ct->id }}"
                                            {{ old('course_type_id',$course->course_type_id ?? '') == $ct->id ? 'selected':'' }}>
                                            {{ $ct->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('course_type_id')<div class="error_msg">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label custom-label">Batch</label>
                                <select name="batch_id" class="form-control custom-select">
                                    <option disabled selected>--Select Batch--</option>
                                    @foreach($batches as $batch)
                                        <option value="{{ $batch->id }}"
                                            {{ old('batch_id',$course->batch_id ?? '') == $batch->id ? 'selected':'' }}>
                                            {{ $batch->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('batch_id')<div class="error_msg">{{ $message }}</div>@enderror
                            </div>

                            {{-- teacher_id --}}
                            <div class="mb-3">
                                <label class="form-label custom-label">Assigned Teacher</label>
                                <select name="teacher_id" class="form-control custom-select">
                                    <option disabled selected>--Select Teacher--</option>
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->id }}"
                                            {{ old('teacher_id',$course->teacher_id ?? '') == $teacher->id ? 'selected':'' }}>
                                            {{ $teacher->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('teacher_id')<div class="error_msg">{{ $message }}</div>@enderror
                            </div>

                            

                            <div class="mb-3">
                                <label class="form-label custom-label">Description</label>
                                <textarea name="description" class="form-control custom-input" style="height:100%; resize:none;" rows="5">{{ old('description', $course->description ?? '') }}</textarea>
                                @error('description')<div class="error_msg">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @endif
    </div>
</div>
@endsection

@push('custom-scripts')
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.js" defer></script>

<script type="text/javascript">
    var listUrl = SITEURL + '/admin/courses';

    $(document).ready(function () {
        $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            fixedHeader: true,
            pageLength: 20,
            lengthMenu: [20, 50, 100, 500],
            ajax: {
                url: listUrl,
                type: 'GET'
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'code', name: 'code' },
                { data: 'term_id', name: 'term_id' },
                { data: 'batch_id', name: 'batch_id' },
                { data: 'course_type_id', name: 'course_type_id' },
                { data: 'teacher_id', name: 'teacher_id' },
                {
                    data: 'action-btn',
                    orderable: false,
                    render: function (data) {
                        let btns = '<div class="action-btn">';
                        btns += '<a href="' + SITEURL + '/admin/courses/' + data.id + '/edit" class="btn btn-edit" title="Edit">' +
                                    '<i class="ri-edit-line"></i></a>';
                        btns += '<form action="' + SITEURL + '/admin/courses/' + data.id + '" method="POST" style="display:inline;" onsubmit="return confirm(\'Delete this course?\');">' +
                                    '@csrf @method("DELETE")' +
                                    '<button type="submit" class="btn btn-delete"><i class="ri-delete-bin-2-line"></i></button>' +
                                '</form>';
                        btns += '</div>';
                        
                        if (data.role !== 'admin') {
                            return ' - ';
                        }
                        return btns;
                    }
                }
            ],
            order: [[2, 'desc']]
        });
    });
</script>
@endpush
