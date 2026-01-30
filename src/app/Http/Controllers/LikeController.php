<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like( Request $request ){
        Like::create([
            'post_id' => $request->post_id,
            'user_id' => Auth::id()
        ]);
        return redirect()->back();
    }

    public function unlike( Request $request ){
        Like::where('post_id', $request->post_id)
        ->where('user_id', Auth::id())
        ->delete();
        return redirect()->back();
    }
}
