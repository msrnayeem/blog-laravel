<x-guest-layout>
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
        </div>
    </div>
</x-guest-layout>
