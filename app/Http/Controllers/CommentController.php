<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CommentController extends Controller
{
    public function postComment(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'post_id' => 'required|integer',
            'comment' => 'required|string',
        ]);

        if ($validated->fails()) {
            return response()->json($validated->errors(), 422);
        }


        try {
            $comment = new Comment();
            $comment->post_id = $request->post_id;
            $comment->comment = $request->comment;
            $comment->user_id = auth()->user()->id;
            $comment->save();

            return response()->json([
                'message' => 'Comment added successfully',
                'comment_data' => $comment,
            ], 200);
        } catch (\Exception $th) {
            return response()->json(['error' => $th->getMessage()], 403);
        }
    }
}
