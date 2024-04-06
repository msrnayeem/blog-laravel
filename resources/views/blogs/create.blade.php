<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Blog') }}
        </h2>
    </x-slot>
    <div class="p-4 bg-body-secondary">
        @if (Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('user-blogs.store') }}" class="space-y-4 p-4" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label h4">Title:</label>
                <input type="text" id="title" name="title" required class="form-control form-control-lg"
                    placeholder="Enter title" value="{{ old('title') }}">
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label h4">Image:</label>
                <input type="file" id="image" name="image" class="form-control form-control-lg">
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label h4">Content:</label>
                <textarea id="summernote" name="content" class="form-control form-control-lg" rows="5">{{ old('content') }}</textarea>
                @error('content')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <button type="submit" class="btn btn-primary btn-lg w-10">
                    Save
                </button>
            </div>
        </form>
    </div>

    @push('scripts')
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#summernote').summernote({
                    placeholder: 'Write your blog here...',
                    height: 300,
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['color', ['forecolor', 'backcolor']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']]
                    ]
                });
                $('.note-editable').css('color', 'black');
                $('.note-editable').css('background-color', 'white');
            });
        </script>
    @endpush
</x-app-layout>
