<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function blogCatList()
    {
        $blog = DB::table('post_category')->get();
        return view('admin.blog.category.index', compact('blog'));
    }

    public function blogCatStore(Request $request)
    {
        $validate = $request->validate([
            'category_name_en'=> 'required|max:255',
            'category_name_np'=> 'required|max:255',
        ]);

        $data = array();
         $data['category_name_en'] = $request->category_name_en;
         $data['category_name_np'] = $request->category_name_np; 
         DB::table('post_category')->insert($data);
         $notification=array(
            'messege'=>'Blog Category Inserted Successfully',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification); 

    }

    public function deleteBlogCat($id)
    {
        $blog = DB::table('post_category')->where('id', $id)->delete();
        $notification=array(
            'messege'=>'Blog Category Deleted Successfully',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification); 
    }

    public function editBlogCat($id)
    {
        $blog =DB::table('post_category')->where('id', $id)->first();
        return view('admin.blog.category.editPost', compact('blog'));
    }

    public function updateBlogCategory(Request $request, $id)
    {
        $data = array();
        $data['category_name_en'] = $request->category_name_en;
        $data['category_name_np'] = $request->category_name_np; 
        DB::table('post_category')->where('id', $id)->update($data);
        $notification=array(
           'messege'=>'Blog Category Updated Successfully',
           'alert-type'=>'success'
            );
          return Redirect('/blogCategory')->with($notification); 
    }


    public function createBlogPost()
    {
        $blogCategory = DB::table('post_category')->get();
        return view('admin.blog.create', compact('blogCategory'));
    }

    public function index()
    {
        $blogPost= DB::table('posts')
                    ->join('post_category','posts.category_id','post_category.id')
                    ->select('posts.*','post_category.category_name_en')
                    ->get();
        return view('admin.blog.index', compact('blogPost'));
    }

    public function insertBlogPost(Request $request)
    {
      $data = array();
      $data['post_title_en'] = $request->post_title_en;
      $data['post_title_np'] = $request->post_title_np;
      $data['category_id'] = $request->category_id;
      $data['details_en'] = $request->details_en;
      $data['details_np'] = $request->details_np;
      $post_image = $request->file('post_image');
      if($post_image)
      {
          $imageName = hexdec(uniqid()).'.'.$post_image->getClientOriginalExtension();
          Image::make($post_image)->resize(400,200)->save('media/post/'.$imageName);
          $data['post_image'] = 'media/post/'.$imageName;

          DB::table('posts')->insert($data);
          $notification=array(
            'messege'=>'Post Inserted Successfully',
            'alert-type'=>'success'
             );
           return Redirect('/viewAllBlogPost')->with($notification); 
      }else{
            $data['post_image']= ' ';
            DB::table('posts')->insert($data);
          $notification=array(
            'messege'=>'Post Inserted Without Image ',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification); 

      }

  

    }
    public function deleteBlogPost($id)
    {
      $post = DB::table('posts')->where('id', $id)->first();
      $image = $post->post_image;
      unlink($image);
      DB::table('posts')->where('id', $id)->delete();
      $notification=array(
        'messege'=>'Post Deleted Successfully',
        'alert-type'=>'success'
         );
       return Redirect()->back()->with($notification); 
    }

    public function editBlogPost($id)
    {
      $post = DB::table('posts')->where('id', $id)->first();
      return view('admin.blog.edit', compact('post'));
    }

    public function updateBlogPost(Request $request, $id)
    {
      $oldImage = $request->old_image;
      $data = array();
      $data['post_title_en'] = $request->post_title_en;
      $data['post_title_np'] = $request->post_title_np;
      $data['category_id'] = $request->category_id;
      $data['details_en'] = $request->details_en;
      $data['details_np'] = $request->details_np;
      $post_image = $request->file('post_image');
      if($post_image)
      {
        unlink($oldImage);
        $postImageName = hexdec(uniqid()).'.'.$post_image->getClientOriginalExtension();
        Image::make($post_image)->resize(400,200)->save('media/post/'.$postImageName);
        $data['post_image'] = 'media/post/'.$postImageName;

        DB::table('posts')->update($data);
        $notification=array(
                  'message' => 'Post Updated Successfully',
                  'alert-type'=>'success'
        );
        return redirect('/viewAllBlogPost')->with($notification);

      }

      else
      {
        $data['post_image'] =$oldImage;
        DB::table('posts')->update($data);
     
        $notification=array(
                  'message' => 'Post Updated Successfully',
                  'alert-type'=>'success'
        );
        return redirect('/viewAllBlogPost')->with($notification);
      }

    }
}
