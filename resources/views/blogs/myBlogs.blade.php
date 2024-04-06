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
            @foreach ($blogs as $blog)
                <div class="col-md-7 mb-4"> <!-- Use col-md-6 for 50% width on medium screens -->
                    <hr>
                    <div class="blog-item">
                        <h3><strong>title:</strong> {{ $blog->title }}</h3>
                        <p><strong>Content:</strong>
                            {{ \Illuminate\Support\Str::words(strip_tags($blog->content), 20, '...') }}</p>
                        <p><strong>Published By:</strong> {{ $blog->publisher_id }}</p>
                        <p><strong>Published At:</strong>
                            @if ($blog->published_at)
                                {{ $blog->published_at->format('F j, Y') }}
                            @else
                                Not published yet
                            @endif
                        </p>
                        {{-- Uncomment the line below if you have comments relationship --}}
                        {{-- <p><strong>Total Comments:</strong> {{ $blog->comments->count() }}</p> --}}
                    </div>
                </div>
            @endforeach

            @if ($blogs->isEmpty())
                <div class="col-md-6"> <!-- Center align no blogs found message -->
                    <p>No blogs found.</p>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
    @endpush





</x-app-layout>
