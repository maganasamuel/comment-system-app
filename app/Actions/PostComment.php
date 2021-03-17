<?php

namespace App\Actions;

use App\Comment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PostComment
{
    public function post($comment = null)
    {
        if ($comment) {
            $comment = Comment::findOrFail($comment);

            throw_unless(
                $comment->layer < config('services.comment.max_layer'),
                ValidationException::class,
                Validator::make(request()->all(), []),
                response()->json(['message' => 'Could not reply to comment. Maximum layer has been reached.'], 403)
            );
        }

        $data = request()->validate([
            'user_name' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        if ($comment) {
            $data['parent_id'] = $comment->id;
        }

        return Comment::create($data);
    }
}
