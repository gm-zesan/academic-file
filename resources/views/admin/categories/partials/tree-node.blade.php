<li class="list-group-item py-1 border-0">
    <div class="d-flex justify-content-between align-items-center">
        <span>
            <i class="ri-folder-3-line me-1 text-warning"></i>
            {{ $category->name }}
            @if($category->allowed_upload)
                <span class="badge bg-success ms-1">
                    <i class="ri-upload-cloud-2-line"></i>
                </span>
            @endif
        </span>
        {{-- Optional action buttons --}}
        <span>
            <a href="{{ route('admin.categories.edit',$category->id) }}" class="btn btn-edit">
                <i class="ri-edit-line"></i>
            </a>
        </span>
    </div>

    @if($category->children->count())
        <ul class="list-group list-group-flush mx-4 mt-1">
            @foreach($category->children as $child)
                @include('admin.categories.partials.tree-node', ['category' => $child])
            @endforeach
        </ul>
    @endif
</li>
