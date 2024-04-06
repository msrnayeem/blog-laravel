<x-app-layout>
    @push('styles')
    @endpush


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Blog') }}
        </h2>
    </x-slot>
    <div class="p-4 bg-body-secondary">
        <div class="row justify-content-center">
            <div class="col-md-7">
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Image</th>
                                <th>Published By</th>
                                <th>Published At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($blogs as $blog)
                                <tr>
                                    <td>{{ $blog->title }}</td>
                                    <td>{{ \Illuminate\Support\Str::words(strip_tags($blog->content), 20, '...') }}</td>
                                    <td>
                                        @if ($blog->image)
                                            <img src="{{ asset($blog->image) }}" alt="{{ $blog->image }}" height="50"
                                                width="50">
                                        @else
                                            No
                                            image
                                        @endif
                                    </td>
                                    <td>{{ $blog->publisher->name ?? 'N\A' }}</td>
                                    <td>
                                        @if ($blog->published_at)
                                            {{ $blog->published_at->format('F j, Y') }}
                                        @else
                                            Not published yet
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('user-blogs.edit', $blog->id) }}"
                                            class="btn btn-info btn-sm">Edit</a>
                                        <form action="{{ route('user-blogs.destroy', $blog->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this blog?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No blogs found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
    @endpush





</x-app-layout>
