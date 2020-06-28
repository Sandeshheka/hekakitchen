<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class BlogController extends Controller
{
    public function blog()
    {
        $post = DB::table('posts')
                    ->join('post_category', 'posts.category_id', 'post_category.id')
                    ->select('posts.*', 'post_category.category_name_en', 'post_category.category_name_np')
                    ->get();
        return view('pages.blog', compact('post'));
    }

    public function English()
    {
        Session::get('lang');
        Session()->forget('lang');
        Session::put('lang','english');
        return redirect()->back();
    }

    public function Nepali()
    {
        Session::get('lang');
        Session()->forget('lang');
        Session::put('lang','nepali');
        return redirect()->back();
    }

    public function singleBlog($id)
    {
        $blog = DB::table('posts')->where('id', $id)->get();
   
        return view('pages.singleBlog', compact('blog'));
    }
}
