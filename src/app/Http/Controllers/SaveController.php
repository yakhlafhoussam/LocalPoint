<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaveController extends Controller
{
    public function save( Request $request ){
        Favorite::create([
            'post_id' => $request->post_id,
            'user_id' => Auth::id()
        ]);
        return redirect()->back();
    }

    public function unsave( Request $request ){
        Favorite::where('post_id', $request->post_id)
        ->where('user_id', Auth::id())
        ->delete();
        return redirect()->back();
    }
}
