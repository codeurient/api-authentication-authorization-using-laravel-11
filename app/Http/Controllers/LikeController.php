<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LikeController extends Controller
{
    public function likePost(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'post_id' => 'required|integer',
        ]);

        if ($validated->fails()) {
            return response()->json($validated->errors(), 422);
        }


        try {
            $comment = new Like();
            $comment->post_id = $request->post_id;
            $comment->user_id = auth()->user()->id;
            $comment->save();

            return response()->json([
                'message' => 'Post liked successfully',
                'comment_data' => $comment,
            ], 200);
        } catch (\Exception $th) {
            return response()->json(['error' => $th->getMessage()], 403);
        }
    }
}
