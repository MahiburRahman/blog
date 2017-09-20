<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Model\User;
use App\Model\UserMetaInfo;
use App\Model\Post;
use App\Model\Comment;
use App\Enumaration\CategoryType;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function ViewHomePage( Request $request )
    {
    	$allPost = Post::orderBy('created_at', 'desc')->paginate(5);
    	$data['allPost'] = $allPost;
        return view('index', $data);
    }

    public function SearchByCategory ( $id )
    {
        $checker = 0;
        $id = (int)$id;
        $categories = get_class_vars(CategoryType::class);
        foreach ($categories as $key => $value) {
            if($id == $value)
                $checker = 1;
        }
        if($checker == 0)
        {
            abort(404);
        }

    	$allPost = Post::where('category_id', $id)->orderBy('created_at', 'desc')->paginate(5);
    	$data['allPost'] = $allPost;
        return view('index', $data);
    }

    public function ViewMyPosts ()
    {
    	$allPost = Post::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(5);
    	$data['allPost'] = $allPost;
        return view('index', $data);
    }

    
}
