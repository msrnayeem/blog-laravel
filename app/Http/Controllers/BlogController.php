<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Mail\CommentMail;
use App\Models\Blog;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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

                $image = $request->file('image');

                $filename = time() . '_' . $image->getClientOriginalName();

                $storagePath = '/images/';

                $image->move(public_path($storagePath), $filename);
                $image = $storagePath . $filename;
            }

            $blog = Blog::create([
                'title' => $request->title,
                'content' => $request->content,
                'image' => $image,
                'author_id' => auth()->id(),
            ]);


            Session::flash('success', 'Blog created successfully!');

            return redirect()->route('user-blogs.index');
        } catch (\Exception $e) {

            Session::flash('error', 'Failed to create blog: ' . $e->getMessage());

            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $user_blog)
    {
        return view('blog', compact('user_blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $user_blog)
    {
        if ($user_blog->author_id !== auth()->id()) {
            Session::flash('error', 'You are not authorized to delete this blog!');
            return redirect()->back();
        }
        return view('blogs.edit', compact('user_blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, Blog $user_blog)
    {
        $imagePath = null;
        if ($request->hasFile('image')) {

            if ($user_blog->image) {
                if (file_exists(public_path($user_blog->image))) {
                    unlink(public_path($user_blog->image));
                }
            }

            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $storagePath = '/images/';
            $image->move(public_path($storagePath), $filename);
            $imagePath = $storagePath . $filename;
        }

        $user_blog->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath ?? $user_blog->image,
        ]);

        Session::flash('success', 'Blog updated successfully!');

        return redirect()->route('user-blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $user_blog)
    {
        if ($user_blog->author_id !== auth()->id()) {
            Session::flash('error', 'You are not authorized to delete this blog!');
            return redirect()->back();
        }
        if ($user_blog->image) {
            if (file_exists(public_path($user_blog->image))) {
                unlink(public_path($user_blog->image));
            }
        }
        $user_blog->delete();

        Session::flash('success', 'Blog deleted successfully!');

        return redirect()->route('user-blogs.index');
    }

    public function comment(Blog $user_blog)
    {
        $comment = $user_blog->comments()->create([
            'name' => request('name'),
            'email' => request('email') ?? null,
            'content' => request('comment'),
        ]);

        Mail::to($user_blog->author->email)->send(new CommentMail($user_blog, $comment));

        return redirect()->route('user-blogs.show', $user_blog->id);
    }
}
