<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function addNewPost(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        if ($validated->fails()) {
            return response()->json($validated->errors(), 422);
        }

        try {
            $post = new Post();
            $post->title = $request->title;
            $post->content = $request->content;
            $post->user_id = auth()->user()->id;
            $post->save();

            return response()->json([
                'message' => 'Post added successfully',
                'post_data' => $post,
            ], 200);

        } catch (\Exception $th) {
            return response()->json(['error' => $th->getMessage()], 403);
        }

    }

    // Edit a post
    public  function editPost(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        if ($validated->fails()) {
            return response()->json($validated->errors(), 422);
        }

        try {
            $post_data = Post::find($request->post_id);
            $post_data->update([
                'title' => $request->title,
                'content' =>  $request->content,
            ]);

            return response()->json([
                'message' => 'Post updated successfully',
            ], 200);

        } catch (\Exception $th) {
            return response()->json(['error' => $th->getMessage()], 403);
        }
    }



}
