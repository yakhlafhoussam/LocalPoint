<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $questions = Question::whereHas('favorites', function ($q) {
            $q->where('user_id', Auth::id());
        })
            ->withCount(['answers', 'likes'])
            ->with(['user'])
            ->withExists([
                'likes as is_liked' => function ($q) {
                    $q->where('user_id', Auth::id());
                }
            ])
            ->get();
        $user = User::withCount(['answers', 'favorites', 'questions'])->findOrFail(Auth::id());
        return view('global.profile', compact('user', 'questions'));
    }
}
