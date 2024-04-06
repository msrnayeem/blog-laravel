<x-login-layout>
    <style>
        .blog-post {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            position: relative;
        }

        .blog-post h2 {
            color: #007bff;
        }

        .read-more-btn {
            position: absolute;
            bottom: 10px;
            right: 20px;
        }
    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blog List') }}
        </h2>
    </x-slot>

    <div class="mt-4 grid gap-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    @forelse ($blogs as $user_blog)
                        <div class="blog-post">
                            <h2>{{ $user_blog->title }}</h2>
                            <p class="text-muted">Published on {{ $user_blog->published_at->format('F j, Y') }}</p>
                            @if ($user_blog->image)
                                <img src="{{ asset($user_blog->image) }}" class="w-full h-48 object-cover"
                                    alt="{{ $user_blog->title }}" height="300" width="800">
                            @else
                                <img src="https://via.placeholder.com/800x400" class="img-fluid mb-3"
                                    alt="Blog Post Image">
                            @endif
                            <p>{!! Str::limit($user_blog->content, 100) !!}</p>
                            <a href="{{ route('user-blogs.show', $user_blog) }}"
                                class="btn btn-primary btn-sm read-more-btn">Read More</a>
                        </div>
                    @empty
                        <p>No blog posts found.</p>
                    @endforelse
                </div>
            </div>
            @if ($blogs->count() > 0)
                <div class="row justify-content-center mt-4">
                    {{ $blogs->links() }}
                </div>
            @endif
        </div>
    </div>
</x-login-layout>
