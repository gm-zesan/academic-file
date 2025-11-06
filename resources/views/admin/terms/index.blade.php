@extends('admin.app')

@section('title')
    Terms
@endsection

@push('custom-style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.semanticui.min.css">
@endpush

@section('content')
<div class="container-fluid my-4">
    <div class="row">
        {{-- ====== Left side: Table list ====== --}}
        <div class="col-lg-8">
            <div class="card table-card">
                <div class="card-header table-header">
                    <div class="title-with-breadcrumb">
                        <div class="table-title">Terms</div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Terms</li>
                            </ol>
                        </nav>
                    </div>
                    <a href="{{ route('admin.terms.index') }}" class="add-new">Terms<i class="ms-1 ri-add-line"></i></a>
                </div>
                <div class="card-body">
                    <table class="table w-100" id="data-table">
                        <thead>
                            <tr>
                                <th>SL NO</th>
                                <th>Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Ajax DataTable will fill --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- ====== Right side: Create / Edit form ====== --}}
        <div class="col-lg-4">
            <form
                action="{{ isset($term)
                            ? route('admin.terms.update', $term->id)
                            : route('admin.terms.store') }}"
                method="POST"
                autocomplete="off">
                @csrf
                @if(isset($term))
                    @method('PUT')
                @endif
                <div class="row">
                    <div class="col-12">
                        <div class="card table-card">
                            <div class="card-header table-header">
                                <div class="title-with-breadcrumb">
                                    <div class="table-title">
                                        {{ isset($term) ? 'Edit Term' : 'Add Term' }}
                                    </div>
                                </div>
                                <button type="submit" class="btn add-new">
                                    {{ isset($term) ? 'Update' : 'Save' }}
                                    <span class="ms-1 spinner-border spinner-border-sm d-none" role="status"></span>
                                </button>
                            </div>
                            <div class="card-body custom-form">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="form-label custom-label" for="name">Name</label>
                                        <input type="text" name="name" id="name"
                                               class="form-control custom-input"
                                               value="{{ old('name', $term->name ?? '') }}"
                                               placeholder="Term Name">
                                        @error('name')
                                            <div class="error_msg">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <label class="form-label custom-label" for="start_date">Start Date</label>
                                        <input type="date" name="start_date" id="start_date"
                                               class="form-control custom-input"
                                               value="{{ old('start_date', isset($term) ? optional($term->start_date)->format('Y-m-d') : '') }}">
                                        @error('start_date')
                                            <div class="error_msg">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <label class="form-label custom-label" for="end_date">End Date</label>
                                        <input type="date" name="end_date" id="end_date"
                                               class="form-control custom-input"
                                               value="{{ old('end_date', isset($term) ? optional($term->end_date)->format('Y-m-d') : '') }}">
                                        @error('end_date')
                                            <div class="error_msg">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <label class="form-label custom-label" for="status">Status</label>
                                        <select name="status" id="status" class="single-select2 form-select">
                                            <option value="1"
                                                {{ old('status', $term->status ?? '') == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0"
                                                {{ old('status', $term->status ?? '') === 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        @error('status')
                                            <div class="error_msg">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
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
    var listUrl = SITEURL + '/admin/terms';

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
                { data: 'start_date', name: 'start_date' },
                { data: 'end_date', name: 'end_date' },
                { 
                    data: 'status', 
                    name: 'status',
                    render: function(data) {
                        if (data == 1) {
                            return '<span class="badge bg-success">Active</span>';
                        } else {
                            return '<span class="badge bg-secondary">Inactive</span>';
                        }
                    },
                    orderable: false,
                    searchable: false
                    },
                {
                    data: 'action-btn',
                    orderable: false,
                    render: function (data) {
                        let btns = '<div class="action-btn">';
                        btns += '<a href="' + SITEURL + '/admin/terms/' + data + '/edit" class="btn btn-edit" title="Edit">' +
                                    '<i class="ri-edit-line"></i></a>';
                        btns += '<form action="' + SITEURL + '/admin/terms/' + data + '" method="POST" style="display:inline;" onsubmit="return confirm(\'Delete this term?\');">' +
                                    '@csrf @method("DELETE")' +
                                    '<button type="submit" class="btn btn-delete"><i class="ri-delete-bin-2-line"></i></button>' +
                                '</form>';
                        btns += '</div>';
                        return btns;
                    }
                }
            ],
            order: [[2, 'asc']]
        });
    });
</script>
@endpush
