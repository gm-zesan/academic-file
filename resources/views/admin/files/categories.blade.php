@extends('admin.app')
@section('title', 'Upload Files for ' . $course->name)

@push('custom-styles')
    <style>
        /* Custom File Uploader Container */
        .custom-file-uploader {
            background: #f9f9fb;
            border: 2px dashed #845adf;
            border-radius: 8px;
            padding: 20px;
            position: relative;
            transition: border-color 0.3s, background 0.3s;
        }

        .custom-file-uploader:hover {
            border-color: #be20c9;
            background: #f3e6fa;
        }

        /* Upload Area */
        .custom-file-uploader .upload-area {
            text-align: center;
            cursor: pointer;
            color: #845adf;
        }

        .custom-file-uploader .upload-area p {
            margin-top: 10px;
            font-size: 14px;
            font-weight: 500;
        }

        /* File Preview */
        #filePreview {
            font-size: 13px;
            color: #555;
            padding: 5px 0;
        }

        /* Progress Bar Container */
        .progress {
            height: 20px;
            background-color: #e9ecef;
            border-radius: 5px;
            overflow: hidden;
        }

        /* Progress Bar */
        .progress-bar {
            background-color: #845adf;
            text-align: center;
            color: #fff;
            font-weight: 500;
            line-height: 20px;
            transition: width 0.3s;
        }

        /* Optional: Drag & Drop Highlight */
        .custom-file-uploader.dragover {
            background-color: #f3e6fa;
            border-color: #be20c9;
        }
    </style>

@endpush

@section('content')
    <div class="container-fluid my-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card table-card">
                    <div class="card-header table-header">
                        <div class="title-with-breadcrumb">
                            <div class="table-title">Upload Files for: {{ $course->name }}</div>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item" aria-current="page">File Uploads</li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ $course->name }}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="card-body" style="overflow-x:auto">
                        <div class="category-tree">
                            @foreach ($treeCategories as $cat)
                                @include('admin.files.partials.category-node', [
                                    'category' => $cat,
                                    'course' => $course,
                                ])
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <form action="{{ route('admin.files.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card table-card">
                        <div class="card-header table-header d-flex justify-content-between align-items-center">
                            <h5 class="table-title mb-0">File Upload</h5>
                            <button type="submit" class="btn add-new">Upload</button>
                        </div>
                        <div class="card-body custom-form">
                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                            <div>
                                <label class="form-label custom-label">Select Category</label>
                                <select name="category_id" class="form-control custom-select">
                                    <option value="">-- Select Category --</option>
                                    @foreach ($categories as $c)
                                        @if ($c->allowed_upload)
                                            <option value="{{ $c->id }}"
                                                {{ old('category_id') == $c->id ? 'selected' : '' }}>
                                                {{ $c->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="error_msg">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label custom-label">Upload File</label>
                                <div class="custom-file-uploader border p-3 rounded" id="uploader">
                                    <div class="upload-area text-center" style="cursor:pointer;">
                                        <i class="ri-upload-cloud-line" style="font-size:48px;color:#845adf;"></i>
                                        <p>Drag & Drop or Click to Upload</p>
                                    </div>
                                    <input type="file" name="file" id="fileInput" style="display:none;"
                                        accept=".jpg,.png,.pdf,.doc,.csv,.xlsx">
                                    <div id="filePreview" class="mt-3"></div>
                                    <div class="progress mt-2 d-none" id="uploadProgress">
                                        <div class="progress-bar" role="progressbar" style="width:0%">0%</div>
                                    </div>
                                </div>
                                @error('file')
                                    <div class="error_msg">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('custom-scripts')
    <script>
        const uploader = document.getElementById('uploader');
        const fileInput = document.getElementById('fileInput');
        const filePreview = document.getElementById('filePreview');
        const progressContainer = document.getElementById('uploadProgress');
        const progressBar = progressContainer.querySelector('.progress-bar');

        uploader.querySelector('.upload-area').addEventListener('click', () => fileInput.click());

        fileInput.addEventListener('change', () => {
            if (fileInput.files.length) handleFilePreview(fileInput.files[0]);
        });

        function handleFilePreview(file) {
            filePreview.innerHTML = `<p>${file.name}</p>`;
            progressContainer.classList.remove('d-none');
            uploadFile(file);
        }

        function uploadFile(file) {
            const formData = new FormData();
            formData.append('file', file);
            formData.append('_token', '{{ csrf_token() }}');

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '{{ route('admin.files.store') }}', true);

            xhr.upload.onprogress = function(e) {
                if (e.lengthComputable) {
                    const percent = Math.round((e.loaded / e.total) * 100);
                    progressBar.style.width = percent + '%';
                    progressBar.textContent = percent + '%';
                }
            };

            xhr.onload = function() {
                if (xhr.status === 200) {
                    progressBar.style.width = '100%';
                    progressBar.textContent = 'Upload Complete';
                    // Optional: Show uploaded file link / icon
                    const response = JSON.parse(xhr.responseText);
                    filePreview.innerHTML =
                        `<p>Uploaded: <a href="${response.file_url}" target="_blank">${file.name}</a></p>`;
                } else {
                    alert('Upload failed!');
                }
            };

            xhr.send(formData);
        }
    </script>
@endpush
