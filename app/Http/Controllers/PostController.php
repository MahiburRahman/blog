<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Model\User;
use App\Model\UserMetaInfo;
use App\Model\Post;
use App\Model\Comment;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function ViewSinglePost( Request $request, $title )
    {
    	$post = Post::where('title', $request->title)->first();
        
        $auth = Auth::user();

    	if(!$post)
    		abort(404);
    	else{
    		$data['post'] = $post;
            $comments = $post->comments;
            $data['auth'] = $auth;
            $data['comments'] = $comments;
    	}
        return view('post_management.single_post', $data);
    }

    public function SaveComment( Request $request, $id)
    {
    	$this->validate($request, [
            'name'=>'required',
            'comment' => 'required'
        ]);

        $post = Post::where('id', $id)->first();
        if(!$post)
            abort(404);

        $commentDetails = [
            'text' => $request->comment,
            'name' => $request->name,
            'post_id' => $id,
        ];

        if(Auth::user())
        {
            $commentDetails ['user_id'] =  Auth::user()->id;
        }

        $commentCreation = Comment::create($commentDetails);
        if ($commentCreation) {
            return redirect()->route('single_post', $post->title)->with('success', 'Thank you.');
        }else{
            return redirect()->route('single_post', $post->title)->with('unsuccess', 'Sorry, Something error.');
        }
    }
    
    public function AddNewPost( Request $request )
    {
        return view('post_management.new_post');
    }

    public function SaveNewPost( Request $request )
    {
    	$this->validate($request, [
            'title'=>'required',
            'text' => 'required'
        ]);

        $text   = strip_tags( $request->text );
        $text = nl2br($text);    
        $text = preg_replace('#<br\s*/?>#i', "\n", $text);
        //dd($var);

        $postDetails = [
            'title' => $request->title,
            'text' => $text,
            'category_id' => $request->category,
            'user_id' => Auth::user()->id,
        ];
        $postCreation = Post::create($postDetails);

        if($postCreation){
        	return redirect()->route('home_page')->with('success', 'Thank you for writing a blog.');
        }else{
        	return redirect()->route('new_post')->with('unsuccess', 'Sorry, somethin errors.');
    	}
    }
}
