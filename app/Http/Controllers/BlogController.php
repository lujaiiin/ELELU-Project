<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;

class BlogController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $post = new Post;
        $post->title = $validatedData['title'];
        $post->content = $validatedData['content'];
        $post->save();

        return response()->json(['success' => true]); 
    }
}
