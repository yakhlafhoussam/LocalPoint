<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    public function index(Request $request)
    {
        $question = Question::where('id', $request->id)
            ->withCount(['answers', 'likes'])
            ->with(["user", "answers"])
            ->withExists([
                'favorites as is_favorited' => function ($q) {
                    $q->where('user_id', Auth::id());
                },
                'likes as is_liked' => function ($q) {
                    $q->where('user_id', Auth::id());
                }
            ])
            ->first();
        $user = User::find(Auth::id());
        return view('global.answer', compact('user', 'question'));
    }

    public function push(Request $request) {
        $request->validate([
            'answer' => 'required|min:5'
        ]);
        Answer::create([
            'content' => $request->answer,
            'post_id' => $request->post_id,
            'user_id' => Auth::id()
        ]);
        return redirect()->back();
    }
}
