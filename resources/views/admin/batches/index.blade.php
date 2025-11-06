@extends('admin.app')

@section('title','Batches')

@push('custom-style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.semanticui.min.css">
@endpush

@section('content')
<div class="container-fluid my-4">
    <div class="row">

        {{-- ===== Left: Batch list table ===== --}}
        <div class="col-lg-8">
            <div class="card table-card">
                <div class="card-header table-header">
                    <div class="title-with-breadcrumb">
                        <div class="table-title">Batches</div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Batches</li>
                            </ol>
                        </nav>
                    </div>
                    <a href="{{ route('admin.batches.index') }}" class="add-new">
                        Add Batch <i class="ms-1 ri-add-line"></i>
                    </a>
                </div>

                <div class="card-body">
                    <table class="table w-100" id="data-table">
                        <thead>
                            <tr>
                                <th>SL NO</th>
                                <th>Name</th>
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

        {{-- ===== Right: Create / Edit form ===== --}}
        <div class="col-lg-4">
            <form
                action="{{ isset($batch)
                            ? route('admin.batches.update', $batch->id)
                            : route('admin.batches.store') }}"
                method="POST"
                autocomplete="off">
                @csrf
                @if(isset($batch)) @method('PUT') @endif

                <div class="card table-card">
                    <div class="card-header table-header d-flex justify-content-between">
                        <div class="table-title">
                            {{ isset($batch) ? 'Edit Batch' : 'Add Batch' }}
                        </div>
                        <button type="submit" class="btn add-new">
                            {{ isset($batch) ? 'Update' : 'Save' }}
                            <span class="ms-1 spinner-border spinner-border-sm d-none" role="status"></span>
                        </button>
                    </div>

                    <div class="card-body custom-form">
                        <div class="mb-3">
                            <label class="form-label custom-label">Name</label>
                            <input type="text" name="name" class="form-control custom-input"
                                   value="{{ old('name', $batch->name ?? '') }}"
                                   placeholder="e.g. Batch 2025">
                            @error('name') <div class="error_msg">{{ $message }}</div> @enderror
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
    var listUrl = SITEURL + '/admin/batches';

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
                {
                    data: 'action-btn',
                    orderable: false,
                    render: function (data) {
                        let btns = '<div class="action-btn">';
                        btns += '<a href="' + SITEURL + '/admin/batches/' + data + '/edit" class="btn btn-edit" title="Edit">' +
                                    '<i class="ri-edit-line"></i></a>';
                        btns += '<form action="' + SITEURL + '/admin/batches/' + data + '" method="POST" style="display:inline;" onsubmit="return confirm(\'Delete this batch?\');">' +
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
