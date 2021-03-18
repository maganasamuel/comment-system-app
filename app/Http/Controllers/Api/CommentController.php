<?php

namespace App\Http\Controllers\Api;

use App\Actions\PostComment;
use App\Comment;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index($comment = null)
    {
        $query = new Comment();

        if ($comment) {
            $parentComment = Comment::findOrFail($comment);

            $query = $parentComment->children();
        } else {
            $query = $query->whereNull('parent_id');
        }

        $offset = request()->query('offset', 0);

        $count = $query->count();

        $comments = $query
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->offset($offset)->limit(15)
            ->get();

        return CommentResource::collection($comments)->additional(['count' => $count]);
    }

    public function store($comment = null, PostComment $action)
    {
        $createdComment = $action->post($comment);

        return new CommentResource($createdComment);
    }
}
