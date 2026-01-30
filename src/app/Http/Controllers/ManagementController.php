<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagementController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $questions = Question::withCount(['answers', 'likes'])
            ->with(["user"])
            ->get();
        $users = User::get();
        $user = User::find(Auth::id());
        $answerCount = $questions->sum('answers_count');
        return view('admin.manage', compact('users', 'questions', 'user', 'answerCount'));
    }

    public function deleteuser( Request $request)
    {
        User::where('id', $request->user_id)
        ->delete();
        return redirect()->back();
    }

    public function deletequestion( Request $request)
    {
        Question::where('id', $request->post_id)
        ->delete();
        return redirect()->back();
    }
}
