<?php

namespace App\Http\Controllers;

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
    }
}
