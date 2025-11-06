<div class="ms-3 my-2">
    <i class="ri-folder-3-line me-1 text-warning"></i>
    <strong>{{ $category->name }}</strong>

    @if($category->allowed_upload)
        <span class="badge bg-success ms-1">
            <i class="ri-upload-cloud-2-line" title="Allowed Upload"></i>
        </span>
    @endif

    @if($category->files->isNotEmpty())
        <i class="ri-check-double-line text-success ms-1" title="File uploaded"></i>
    @endif

    @if($category->children->count())
        <ul class="list-group list-group-flush mx-4 mt-1">
            @foreach($category->children as $child)
                @include('admin.files.partials.category-node',['category'=>$child,'course'=>$course])
            @endforeach
        </ul>
    @endif
</div>
