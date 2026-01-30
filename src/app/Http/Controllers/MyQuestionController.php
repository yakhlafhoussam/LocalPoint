<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyQuestionController extends Controller
{
    public function index(){
        $questions = Question::where('user_id', Auth::id())
            ->withCount(['answers', 'likes'])
            ->with(['user'])
            ->withExists([
                'likes as is_liked' => function ($q) {
                    $q->where('user_id', Auth::id());
                },
                'favorites as is_favorited' => function ($q) {
                    $q->where('user_id', Auth::id());
                }
            ])
            ->get();
        $answerCount = $questions->sum('answers_count');
        $likeCount = $questions->sum('likes_count');
        $user = User::find(Auth::id());
        return view('global.myQuestions', compact('user', 'questions', 'answerCount', 'likeCount'));
    }
}
