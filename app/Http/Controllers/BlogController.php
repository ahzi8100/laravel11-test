<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $title = $request->title;
        // Query Builder
        // $blogs = DB::table('blogs')->where('title', 'LIKE', '%' . $title . '%')->orderBy('created_at')->paginate(10);

        // Eloquent ORM
        // $blogs = Blog::all();
        $blogs = Blog::where('title', 'LIKE', '%' . $title . '%')->orderBy('created_at', 'desc')->paginate(10);
        return view('blog', ['blogs' => $blogs, 'title' => $title]);
    }

    public function create()
    {
        $tags = Tag::all();
        return view('blogs/create', compact('tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|unique:blogs|max:20',
            'description' => 'required',
            'status' => 'required',
        ]);

        if ($validated) {
            // Query Builder
            // DB::table('blogs')->insert([
            //     'title' => $request->title,
            //     'description' => $request->description,
            //     'status' => $request->status,
            //     'user_id' => fake()->numberBetween(1, User::all()->count()),
            //     'created_at' => now()
            // ]);

            // Eloquent ORM
            $blog = Blog::create([
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->status,
                'user_id' => fake()->numberBetween(1, User::all()->count()),
            ]);

            $blog->tags()->attach($request->tags);
        }

        return redirect()->route('blogs.index')->with('success', 'New Blog Added Succesfully!');
    }

    public function show($id)
    {
        // Query Builder
        // $blog = DB::table('blogs')->where('id', $id)->first();

        // Eloquent ORM
        // $blog = Blog::where('id', $id)->first();
        // $blog = Blog::find($id);
        $blog = Blog::findOrFail($id);
        // if (!$blog) {
        //     abort(404);
        // }
        return view('blogs/detail', ['blog' => $blog]);
    }

    public function edit($id)
    {
        // Query Builder
        // $blog = DB::table('blogs')->where('id', $id)->first();
        // if (!$blog) {
        //     abort(404);
        // }
        $tags = Tag::all();
        $blog = Blog::with('tags')->findOrFail($id);
        return view('blogs/edit', ['blog' => $blog, 'tags' => $tags]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255|unique:blogs,title,' . $id,
            'description' => 'required',
            'status' => 'required'
        ]);

        if ($validated) {
            // Query Builder
            // DB::table('blogs')->where('id', $id)->update([
            //     'title' => $request->title,
            //     'description' => $request->description,
            //     'status' => $request->status,
            //     'user_id' => fake()->numberBetween(1, User::all()->count()),
            //     'updated_at' => now()
            // ]);

            // Eloquent ORM
            $blog = Blog::findOrFail($id);
            $blog->update([
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->status,
                'user_id' => fake()->numberBetween(1, User::all()->count()),
            ]);
            // $blog->tags()->detach($blog->tags);
            // $blog->tags()->attach($request->tags);
            $blog->tags()->sync($request->tags);
        }

        return redirect()->route('blogs.index')->with('success', 'Blog Edited Succesfully!');
    }

    public function delete($id)
    {
        // Query Builder
        // $blog = DB::table('blogs')->where('id', $id)->delete();

        // Eloquent ORM
        // $blog = Blog::findOrFail($id)->delete();
        $blog = Blog::destroy($id);

        if (!$blog) {
            return redirect()->route('blogs.index')->with('failed', 'Blog Failed to Delete!');
        }

        return redirect()->route('blogs.index')->with('success', 'Blog Deleted Succesfully!');
    }

    public function trash()
    {
        $blogs = Blog::onlyTrashed()->get();
        return view('blogs/restore', ['blogs' => $blogs]);
    }

    public function restore($id)
    {
        $blog = Blog::onlyTrashed()->findOrFail($id)->restore();

        if (!$blog) {
            return redirect()->route('blogs.index')->with('failed', 'Data Blog Failed to Restore!');
        }

        return redirect()->route('blogs.index')->with('success', 'Data Blog Restore Succesfully!');
    }

    public function homepage()
    {
        $blogs = Blog::with('user')->where('status', 'Active')->orderBy('created_at', 'desc')->get();
        return view('blogs.index', ['blogs' => $blogs]);
    }

    public function detail($id)
    {
        $blog = Blog::with(['user', 'comments', 'tags'])->findOrFail($id);
        return view('blogs.show', ['blog' => $blog]);
    }

    public function latest()
    {
        $blog = Blog::with('latestComment')->find(113);
        echo $blog->latestComment->comment_text ?? 'Belum ada komentar';
    }

    public function phone()
    {
        $phone = Blog::with('phone')->find(10);
        return $phone->phone ?? 'Belum ada nomor';
    }
}
