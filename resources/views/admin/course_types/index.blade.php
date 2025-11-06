@extends('admin.app')

@section('title','Course Types')

@push('custom-style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.semanticui.min.css">
@endpush

@section('content')
<div class="container-fluid my-4">
    <div class="row">
        {{-- List --}}
        <div class="col-lg-8">
            <div class="card table-card">
                <div class="card-header table-header d-flex justify-content-between">
                    <div class="table-title">Course Types</div>
                    <a href="{{ route('admin.course-types.index') }}" class="add-new">Add New<i class="ms-1 ri-add-line"></i></a>
                </div>
                <div class="card-body">
                    <table class="table w-100" id="data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Create / Edit --}}
        <div class="col-lg-4">
            <form action="{{ isset($courseType)
                            ? route('admin.course-types.update',$courseType->id)
                            : route('admin.course-types.store') }}"
                  method="POST" autocomplete="off">
                @csrf
                @isset($courseType) @method('PUT') @endisset

                <div class="card table-card">
                    <div class="card-header table-header d-flex justify-content-between">
                        <div class="table-title">
                            {{ isset($courseType) ? 'Edit Course Type' : 'Add Course Type' }}
                        </div>
                        <button type="submit" class="btn add-new">
                            {{ isset($courseType) ? 'Update' : 'Save' }}
                        </button>
                    </div>
                    <div class="card-body custom-form">
                        <div class="mb-3">
                            <label class="form-label custom-label">Name</label>
                            <input type="text" name="name" class="form-control custom-input"
                                   value="{{ old('name', $courseType->name ?? '') }}"
                                   placeholder="Course Type Name">
                            @error('name')<div class="error_msg">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label custom-label">Description</label>
                            <textarea name="description" rows="5"
                                      class="form-control custom-input" style="resize: none; height: 100%;"
                                      placeholder="Description (Optional)">{{ old('description', $courseType->description ?? '') }}</textarea>
                            @error('description')<div class="error_msg">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('custom-scripts')
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.js" defer></script>

<script type="text/javascript">
    var listUrl = SITEURL + '/admin/course-types';

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
                { data: 'description', name: 'description' },
                {
                    data: 'action-btn',
                    orderable: false,
                    render: function (data) {
                        let btns = '<div class="action-btn">';
                        btns += '<a href="' + SITEURL + '/admin/course-types/' + data + '/edit" class="btn btn-edit" title="Edit">' +
                                    '<i class="ri-edit-line"></i></a>';
                        btns += '<form action="' + SITEURL + '/admin/course-types/' + data + '" method="POST" style="display:inline;" onsubmit="return confirm(\'Delete this course type?\');">' +
                                    '@csrf @method("DELETE")' +
                                    '<button type="submit" class="btn btn-delete"><i class="ri-delete-bin-2-line"></i></button>' +
                                '</form>';
                        btns += '</div>';
                        return btns;
                    }
                }
            ],
            order: [[2, 'desc']]
        });
    });
</script>
@endpush
