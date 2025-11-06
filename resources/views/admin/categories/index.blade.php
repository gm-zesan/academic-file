@extends('admin.app')

@section('title', 'Categories')

@push('custom-style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <style>
        /* === Custom Tab Styling === */
        .nav-tabs {
            border-bottom: 2px solid #dee2e6;
        }

        .nav-tabs .nav-link {
            color: #555;
            border: none;
            border-bottom: 3px solid transparent;
            font-weight: 500;
            padding: 8px 16px;
            transition: all 0.3s;
            font-size: 13px;
            font-weight: bold;
        }

        .nav-tabs .nav-link.active {
            color: #845adf;
            border-color: #845adf;
            background-color: #f8f9fa;
        }

        .nav-tabs .nav-link:hover {
            color: #845adf;
            border-color: #d6c3f3;
        }

        .btn-edit {
            color: #845adf;
            background-color: #e4def5;
            height: 28px;
            width: 28px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-edit:hover {
            background-color: #845adf;
            color: #fff;
        }

        .btn-tree {
            color: #be20c9;
            background-color: #f3d1f1;
            height: 28px;
            width: auto;
            font-size: 12px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .btn-tree:hover {
            background-color: #be20c9;
            color: #fff;
        }

        .btn-tree:focus {
            box-shadow: none;
        }

        .table-title {
            font-weight: 600;
            color: #444;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid my-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card table-card">
                    <div class="card-header table-header d-flex justify-content-between align-items-center">
                        <h5 class="table-title mb-0">Categories</h5>
                        <div class="d-flex gap-2">
                            {{-- add btn --}}
                            <a href="{{ route('admin.categories.index') }}" class="add-new">Add New<i
                                    class="ms-1 ri-add-line"></i></a>

                            
                        </div>
                    </div>

                    {{-- Tabs --}}
                    <ul class="nav nav-tabs" id="categoryTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="type1-tab" data-bs-toggle="tab" data-bs-target="#type1"
                                type="button" role="tab">Theory</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="type2-tab" data-bs-toggle="tab" data-bs-target="#type2"
                                type="button" role="tab">Lab</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="categoryTabContent">
                        {{-- Type 1 Table --}}
                        <div class="tab-pane fade show active" id="type1" role="tabpanel">
                            <div class="card-body" style="overflow-x:auto">
                                <a href="#" data-bs-toggle="modal" class="btn btn-tree" data-bs-target="#categoryModal1">
                                    Tree View for Theory <i class="ms-1 ri-tree-line"></i>
                                </a>
                                <table class="table w-100" id="data-table-1">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th>Parent</th>
                                            <th>Allowed Upload</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Type 2 Table --}}
                        <div class="tab-pane fade" id="type2" role="tabpanel">
                            <div class="card-body" style="overflow-x:auto">
                                <a href="#" data-bs-toggle="modal" class="btn btn-tree" data-bs-target="#categoryModal2">
                                    Tree View for Lab <i class="ms-1 ri-tree-line"></i>
                                </a>
                                <table class="table w-100" id="data-table-2">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th>Parent</th>
                                            <th>Allowed Upload</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- File Upload Form --}}
            <div class="col-md-4">
                <div class="card table-card">
                    <div class="card-header table-header d-flex justify-content-between align-items-center">
                        <h5 class="table-title mb-0">{{ isset($category) ? 'Edit Category' : 'Add Category' }}</h5>
                        <button type="submit" form="categoryForm" class="btn add-new">
                            {{ isset($category) ? 'Update' : 'Save' }}
                        </button>
                    </div>
                    <div class="card-body custom-form">
                        <form id="categoryForm"
                            action="{{ isset($category) ? route('admin.categories.update', $category->id) : route('admin.categories.store') }}"
                            method="POST">
                            @csrf
                            @if (isset($category))
                                @method('PUT')
                            @endif

                            <div class="mb-3">
                                <label class="form-label custom-label">Course Type</label>
                                <select name="course_type_id" class="form-control custom-select">
                                    <option value="">-- Select Course Type --</option>
                                    @foreach ($courseTypes as $ct)
                                        <option value="{{ $ct->id }}"
                                            {{ old('course_type_id', $category->course_type_id ?? '') == $ct->id ? 'selected' : '' }}>
                                            {{ $ct->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('course_type_id')
                                    <div class="error_msg">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label custom-label">Name</label>
                                <input type="text" name="name" class="form-control custom-input"
                                    value="{{ old('name', $category->name ?? '') }}">
                                @error('name')
                                    <div class="error_msg">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label custom-label">Parent Category</label>
                                <select name="parent_id" class="form-control custom-select">
                                    <option value="">-- No Parent --</option>
                                    @foreach ($categories as $c)
                                        <option value="{{ $c->id }}"
                                            {{ old('parent_id', $category->parent_id ?? '') == $c->id ? 'selected' : '' }}>
                                            {{ $c->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('parent_id')
                                    <div class="error_msg">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-check mb-3">
                                <input type="checkbox" class="form-check-input" name="allowed_upload" id="allowed_upload"
                                    value="1"
                                    {{ old('allowed_upload', $category->allowed_upload ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label custom-label" for="allowed_upload">Allowed File Upload</label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- ===== Tree View Modal (Theory) ===== -->
        <div class="modal fade" id="categoryModal1" tabindex="-1" aria-labelledby="categoryModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" style="font-size: 16px">Theory Tree</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group">
                        @forelse($treeCategories1 as $category)
                            @include('admin.categories.partials.tree-node', ['category' => $category])
                        @empty
                            <li class="list-group-item">No data available.</li>
                        @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== Tree View Modal (Lab) ===== -->
        <div class="modal fade" id="categoryModal2" tabindex="-1" aria-labelledby="categoryModalLabel2" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" style="font-size: 16px">Lab Tree</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group">
                        @forelse($treeCategories2 as $category)
                            @include('admin.categories.partials.tree-node', ['category' => $category])
                        @empty
                            <li class="list-group-item">No data available.</li>
                        @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-scripts')
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js" defer></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            function makeDataTable(selector, type) {
                return $(selector).DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('admin.categories.index') }}',
                        data: { type: type }
                    },
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        { data: 'name', name: 'name' },
                        { data: 'parent', name: 'parent' },
                        { data: 'allowed_upload', name: 'allowed_upload', render: data => data ? 'Yes' : 'No' },
                        {
                            data: 'id',
                            render: id => `
                                <div class="action-btn d-flex gap-2">
                                    <a href="{{ url('admin/categories') }}/${id}/edit" class="btn btn-edit"><i class="ri-edit-line"></i></a>
                                    <form action="{{ url('admin/categories') }}/${id}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this category?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-delete"><i class="ri-delete-bin-2-line"></i></button>
                                    </form>
                                </div>`
                        }
                    ]
                });
            }

            // Load first table immediately
            const table1 = makeDataTable('#data-table-1', 1);
            let table2Loaded = false;

            // Load second table only when its tab is opened
            $('button[data-bs-target="#type2"]').on('shown.bs.tab', function() {
                if (!table2Loaded) {
                    makeDataTable('#data-table-2', 2);
                    table2Loaded = true;
                }
            });

        });
    </script>
@endpush
