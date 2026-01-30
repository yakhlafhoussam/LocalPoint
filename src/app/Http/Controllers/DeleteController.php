<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeleteController extends Controller
{
    public function delete( Request $request ){
        Question::where('id', $request->post_id)
        ->where('user_id', Auth::id())
        ->delete();
        return redirect()->back();
    }

    public function answerdelete( Request $request ){
        Answer::where('id', $request->answer_id)
        ->where('user_id', Auth::id())
        ->delete();
        return redirect()->back();
    }
}
