<x-login-layout>
    <style>
        .container {
            max-width: 800px;
        }

        .bg-white {
            background-color: #ffffff;
        }

        .shadow-sm {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .sm\:rounded-lg {
            border-radius: 0.5rem;
        }

        .text-muted {
            color: #6c757d;
        }

        .img-fluid {
            max-width: 100%;
            height: auto;
        }

        .lead {
            font-size: 1.25rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }
    </style>
    <div class="container mt-4">
        <div class="bg-white shadow-sm sm:rounded-lg p-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $user_blog->title }}
            </h2>
            <p>
                Author- <strong> {{ $user_blog->author->name }} </strong>
            </p>
            <p class="text-muted">Published on {{ $user_blog->published_at->format('F j, Y') }}</p>

            @if ($user_blog->image)
                <img src="{{ asset($user_blog->image) }}" class="img-fluid mb-4" alt="{{ $user_blog->title }}">
            @endif

            <p class="lead">{!! $user_blog->content !!}</p>

            <hr>

            <h3 class="mt-4">Comments</h3>

            @if ($user_blog->comments->count() > 0)
                <div class="comments-list mt-3">
                    @foreach ($user_blog->comments as $comment)
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">{{ $comment->name }} @if ($comment->email)
                                        (<strong>{{ $comment->email }}</strong>)
                                    @endif
                                </h5>
                                <p class="card-text text-italic">{{ $comment->content }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="m-3">No comments yet.</p>
            @endif

            <hr>

            <h3 class="mt-2">Leave a Comment</h3>

            <form method="POST" action="{{ route('blog.comment', $user_blog) }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="blog_id" value="{{ $user_blog->id }}">

                <div class="form-group mt-4">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="email">Email (Optional)</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>

                <div class="form-group">
                    <label for="comment">Comment</label>
                    <textarea name="comment" id="comment" rows="5" class="form-control" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit Comment</button>
            </form>
        </div>
    </div>
</x-login-layout>
