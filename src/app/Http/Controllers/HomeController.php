<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $questions = Question::withCount(['answers', 'likes'])
            ->with(["user"])
            ->withExists([
                'favorites as is_favorited' => function ($q) {
                    $q->where('user_id', Auth::id());
                },
                'likes as is_liked' => function ($q) {
                    $q->where('user_id', Auth::id());
                }
            ])
            ->get();
        $user = User::find(Auth::id());
        return view('global.home', compact('user', 'questions'));
    }
}
