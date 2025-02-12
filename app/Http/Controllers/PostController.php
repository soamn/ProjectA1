<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::orderBy('updated_at', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();
        if (request()->ajax()) {

            return DataTables::of($posts)
                ->addIndexColumn()
                ->addColumn('actions', function ($row) {
                    return '
                       <a href="' . route('posts.edit', $row->id) . '" style="color:red; font-weight:600; text-decoration:none;">Edit</a>
<form action="' . route('posts.destroy', $row->id) . '" method="POST" style="display:inline;">
    ' . csrf_field() . '
    ' . method_field('DELETE') . '
    <button type="submit" style="color:blue; font-weight:600; border:none; background-color:transparent; text-decoration:none;">Delete</button>
</form>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'url' => 'required|url',
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('images', 'public') : null;

        Post::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image' => $imagePath,
            'url' => $validated['url'],
        ]);

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'url' => 'required|url',
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('images', 'public') : $post->image;

        $post->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image' => $imagePath,
            'url' => $validated['url'],
        ]);

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index');
    }
}
