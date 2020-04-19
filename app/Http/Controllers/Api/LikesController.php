<?php

namespace App\Http\Controllers\Api;

use App\Like;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
    public  function like(Request $request){
        $like = Like::where('post_id',$request->id)->where('user_id',Auth::user()->id)->get();
        //check if it returns 0 then this post is not liked and should be liked else unliked
        if (count($like)>0){
            $like[0]->delete();
            return response([
               'success' => true,
               'message' => 'unliked'
            ]);
        }

        $like = new Like();
        $like->user_id = Auth::user()->id;
        $like->post_id = $request->id;
        $like->save();
        return response([
            'success' => true,
            'message' => 'liked'
        ]);
    }
}
