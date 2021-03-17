<?php

namespace App\Http\Controllers\Api;

use App\Actions\PostComment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'hello world',
        ]);
    }

    public function store($comment = null, PostComment $action)
    {
        $createdComment = $action->post($comment);

        return response()->json($createdComment);
    }
}
