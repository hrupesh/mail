<?php

namespace App\Http\Controllers;

use App\Post;
use App\like;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function getDashboard(Request $request){

        $posts = Post::orderBy('created_at','desc')->paginate(10);
        
        return view('dashboard',['posts' => $posts]);

    }

   

    public function postCreatePost(Request $request){

        $this->validate($request,[

            'post' => 'required|max:100'

        ]);
        $post = new Post();
        $post->post=$request['post'];
        $message="There was an unexpected error while creating your post";
        if($request->user()->posts()->save($post)){
            $message="Your post was posted succesfully";
        }
        return redirect()->route('dashboard')->with(['message' => $message]);
    }

    public function EditPost(Request $request){
            $this->validate($request,[
                'editedbody' => 'required|min:10|max:100'
            ]);
            $postid = $request['p_id'];  
            $post = Post::find($postid);
            $post->post=$request->input('editedbody');
            $message="The post was edited Succesfully";
            $post->save();
            return redirect()->route('dashboard')->with(['message' => $message]);
            
    }

    public function like($p_id){
        $like = Like::where('post_id',$p_id)->where('user_id',Auth::user()->id)->first();
        if($like){
            $like->dislike--;
            $like->like++;
            $like->update();
            $message = "incremented with post found";
        }
        else{
            $like2 = new Like();
            $like2->post_id = $p_id;
            $like2->user_id = Auth::user()->id;
            $like2->like++;
            $like2->dislike=0;
            $like2->save();
            $message = "incremented with new record made";
        }
        return redirect()->back();
    }

    public function dislike($p_id){
        $like = Like::where('post_id',$p_id)->where('user_id',Auth::user()->id)->first();
        if($like){
            $like->dislike++;
            $like->like--;
            $like->update();
            $message = "decremented with post found";
        }
        else{
            $like2 = new Like();
            $like2->post_id = $p_id;
            $like2->user_id = Auth::user()->id;
            $like2->like=0;
            $like2->dislike++;
            $like2->save();
            $message = "decremented with new record made";
        }
        return redirect()->back();
    }

    public function DeletePost($post_id){
            $post = Post::where('id',$post_id)->first();
            if(Auth::user() != $post->user){
                return redirect()->route('dashboard')->with(['message' => 'Hey.....You Mind your buisness :-( ']);
            }
            $post->Delete();
            return redirect()->route('dashboard')->with(['message' => 'Post Successfully Deleted']);
    } 

}
