<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Post;

class PostController extends Controller
{


    public function index()
        {
            return view('posts.index', [
                'posts' => Post::all(), // Fetch all posts initially
            ]);
        }

    public function search(Request $request)
        {
            $query = $request->input('search');
            $posts = Post::where('title', 'LIKE', "%{$query}%")
                ->orWhere('content', 'LIKE', "%{$query}%")
                ->get();

            return view('posts.index', [
                'posts' => $posts,
            ]);
        }
    public function store(Request $request)
        {
            $validatedData = $request->validate([
                'title' => 'required|max:255',
                'publish_entry' => 'required',
            ]);
        
            $post = new Post;
            $post->title = $validatedData['title'];
            $post->content = $validatedData['publish_entry'];
            $post->save();
        
            return redirect()->back()->with('success', 'Post saved successfully!');
        }
    public function searchResults(Request $request)
        {
            $query = $request->get('query');
            $results = Post::where('title', 'LIKE', "%{$query}%")
                        ->orWhere('content', 'LIKE', "%{$query}%")
                        ->paginate(10); // Adjust pagination as needed

            return view('posts.index', compact('results'));
        }

    public function storeImage(Request $request)
        {
            
            // Validate the incoming request...
            $request->validate([
                'screenshot' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048', // Adjust validation rules as needed
            ]);

            // Retrieve the file from the request...
            $file = $request->file('screenshot');

            // Generate a unique filename for the uploaded image...
            $filename = time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/posts'); // Specify your desired upload directory
            $file->move($destinationPath, $filename);

            // Save the path to the database...
            $post = new Post;
            $post->title = $request->title;
            $post->content = "lala"; // Assuming you're passing the title from the form
            $post->image = $filename; // Save the filename to the database
            $post->save();

            return response()->json(['success' => true, 'message' => 'Image saved successfully.']);
        }

    public function storePublishedContent(Request $request)
        {
            try {
                $title = $request->input('title');
                $screenshotPath = Cache::get('last_screenshot_path');

                // Normalize the path to start with "/images/screenshots/"
                $normalizedPath = str_replace('\\', '/', $screenshotPath); // Replace backslashes with forward slashes
                $normalizedPath = preg_replace('#^.*?/images/screenshots/#', '/images/screenshots/', $normalizedPath); 

                // Save the title and screenshot source to the database
                
                $publishedContent = new Post();
                $publishedContent->title = $title;
                $publishedContent->content = "--";
                $publishedContent->image = $normalizedPath; // Assuming you have a column for this
                $publishedContent->save();

                return response()->json(['success' => true]);
            } catch (\Exception $e) {
                return response()->json(['success' => false], 500);
            }
        }
    public function destroy($id)
        {
            $post = Post::find($id);
            if ($post) {
                $post->delete();
                return redirect()->back()->with('success', 'Post saved successfully!');
            }
            return redirect()->route('posts.index')->withErrors(['error' => 'Post not found.']);
        }
    /* destroy with  check if the current user is allowed to delete the <post></post>/*
    public function destroy($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return redirect()->route('posts.index')->withErrors(['error' => 'Post not found.']);
        }

        // Check if the current user is authorized to delete the post
        if (Auth::user()->cannot('delete', $post)) {
            return redirect()->route('posts.index')->withErrors(['error' => 'Unauthorized action.']);
        }

        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }

    */
    
}
