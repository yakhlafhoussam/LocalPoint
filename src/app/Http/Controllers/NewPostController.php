<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class NewPostController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::id());
        return view('global.newpost', compact('user'));
    }

    public function submitPost( Request $request )
    {
        $request->validate([
            'title' => 'required|min:5',
            'content' => 'required|min:10',
            'city' => 'required|min:3',
        ]);

        $question = Question::create([
            'title' => $request->title,
            'content' => $request->content,
            'city' => $request->city,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('newpost')->with([
            'success' => 'Your question has been successfully posted !'
        ]);
    }
}
