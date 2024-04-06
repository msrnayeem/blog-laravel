<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use Illuminate\Support\Facades\Session;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function myBlogs()
    {
        $blogs = Blog::where('author_id', auth()->id())->get();

        return view('blogs.myBlogs', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {
        try {
            $image = null;

            if ($request->hasFile('image')) {
                $image = $request->file('image')->store('blog_images', 'public');
            }

            $blog = Blog::create([
                'title' => $request->title,
                'content' => $request->content,
                'image' => $image,
                'author_id' => auth()->id(),
            ]);


            Session::flash('success', 'Blog created successfully!');

            return redirect()->route('blogs.my-blogs');
        } catch (\Exception $e) {

            Session::flash('error', 'Failed to create blog: ' . $e->getMessage());

            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
