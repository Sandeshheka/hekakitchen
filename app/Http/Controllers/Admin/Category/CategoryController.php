<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $category = Category::all();
        return view('admin.category.viewCategory', compact('category'));
    }

    public function storeCategory(Request $request)
    {
        $valiData = $request->validate([
            'category_name' => 'required|unique:categories|max:255',

        ]);

        //    $data = array();
        //    $data['category_name'] =$request->category_name;
        //    DB::table('categories')->insert($data);

        $category = new Category();
        $category->category_name = $request->category_name;
        $category->save();
        $notification = array(
            'messege' => 'Category Add Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function deleteCategory($id)
    {
        $subcategory = DB::table('subcategories')
                        ->select('subcategories.id', 'subcategories.subcategory_name')
                        ->where('subcategories.category_id', '=', $id)
                        ->count();

                 

        if($subcategory>0)  
        {
            $notification = array(
                'messege' => 'Category has subcategory in it!!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }  
        else{
            $category = Category::find($id);
            $category->delete();
            $notification = array(
                'messege' => 'Category Deleted Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }            
  
    }

    public function editCategory($id)
    {
        $category = Category::find($id);
        return view('admin.category.editCategory', compact('category'));
    }

    public function updateCategory(Request $request, $id)
    {
        $valiData = $request->validate([
            'category_name' => 'required|max:255',

        ]);

          $data = array();
           $data['category_name'] =$request->category_name;
           $update=DB::table('categories')->where('id', $id)->update($data);
           if ($update) {
                $notification = array(
                    'messege' => 'Category Updated Successfully',
                    'alert-type' => 'success'
                );
                return redirect('/categories')->with($notification);
           }
           else
           {
            $notification = array(
                'messege' => 'Nothing to Updated ',
                'alert-type' => 'error'
            );
            return redirect('/categories')->with($notification);
           }


    }
}
