<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of posts for guests and users.
     */
    public function index()
    {
        $posts = Post::with(['user', 'category'])
            ->latest()
            ->paginate(6);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new post.
     */
    public function create()
    {
        $categories = Category::all();

        return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        if (! $this->isInsideRabat($request->latitude, $request->longitude)) {
            return back()->withErrors(['location' => 'You must be inside Rabat to create a post.'])->withInput();
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $this->saveImage($request->file('image'));
        }

        Post::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect()->route('posts.index')->with('success', 'Incident post created successfully.');
    }

    /**
     * Display the specified post with comments.
     */
    public function show(Post $post)
    {
        $post->load(['user', 'category', 'comments.user']);

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified post.
     */
    public function edit(Post $post)
    {
        $this->authorizePostOwner($post);

        $categories = Category::all();

        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified post in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorizePostOwner($post);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $post->image;
        if ($request->hasFile('image')) {
            $imagePath = $this->saveImage($request->file('image'));
        }

        $post->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('posts.show', $post)->with('success', 'Incident post updated successfully.');
    }

    /**
     * Remove the specified post from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorizePostOwner($post);

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Incident post deleted successfully.');
    }

    /**
     * Check that the current user owns the post.
     */
    protected function authorizePostOwner(Post $post): void
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }
    }

    /**
     * Save an uploaded image to the public/images folder.
     */
    protected function saveImage($image): string
    {
        $destination = public_path('images');
        if (! file_exists($destination)) {
            mkdir($destination, 0755, true);
        }

        $filename = time().'_'.$image->getClientOriginalName();
        $image->move($destination, $filename);

        return 'images/'.$filename;
    }

    /**
     * Very simple Rabat bounding box check.
     */
    protected function isInsideRabat(float $latitude, float $longitude): bool
    {
        return $latitude >= 34.000000 && $latitude <= 34.150000
            && $longitude >= -6.950000 && $longitude <= -6.650000;
    }
}
