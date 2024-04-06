<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\BlogApprove;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function users()
    {
        $users = User::whereNot('id', auth()->id())->get();

        return view('admin.users', compact('users'));
    }
    public function blogs()
    {
        $blogs = Blog::all();

        return view('admin.blogs', compact('blogs'));
    }

    public function publish(Blog $blog)
    {
        $blog->published_at = now();
        $blog->publisher_id = auth()->id();
        $blog->save();
        $blog->relationLoaded('author');

        Mail::to($blog->author->email)->send(new BlogApprove($blog));

        return redirect()->route('admin.blogs')->with('success', 'Blog published successfully.');
    }

    /**
     * Publish the specified resource.
     */
    public function unpublish(Blog $blog)
    {
        $blog->published_at = null;
        $blog->publisher_id = null;
        $blog->save();

        return redirect()->route('admin.blogs')->with('success', 'Blog unpublished successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyUser(User $user)
    {
        try {
            $user->delete();
            $user->roles()->detach();

            return redirect()->route('users.index')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Failed to delete user. ' . $e->getMessage());
        }
    }

    public function destroyBlog(Blog $blog)
    {
        $blog->delete();

        return redirect()->route('admin.blogs')->with('success', 'Blog deleted successfully.');
    }
}
