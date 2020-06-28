<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $category = DB::table('categories')->get();
        $subcat = DB::table('subcategories')
                    ->join('categories', 'subcategories.category_id', 'categories.id')
                    ->select('subcategories.*', 'categories.category_name')
                    ->get();

  
        return view('admin.category.viewSubCategory', compact('category', 'subcat'));
    }

    public function storeSubCategory(Request $request)
    {
        $valiData = $request->validate([
            'category_id' => 'required',
            'subcategory_name' => 'required',

        ]);

        $data = array();
        $data['category_id'] =$request->category_id;
        $data['subcategory_name'] = $request->subcategory_name;
        DB::table('subcategories')->insert($data);
        $notification = array(
            'messege' => 'Sub Category Add Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    public function deleteSubCategory($id)
    {
        $scat = Subcategory::find($id);
        $scat->delete();

        $notification = array(
            'messege' => 'Sub Category Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);


    }

    public function editSubCategory($id)
    {
        $scat = Subcategory::find($id);
        $category= Category::all();
        return view('admin.category.editSubCategory', compact('scat', 'category'));
    }


    public function updateSubCategory(Request $request, $id)
    {
        $data = array();
        $data['category_id'] =$request->category_id;
        $data['subcategory_name'] = $request->subcategory_name;
        DB::table('subcategories')->where('id', $id)->update($data);
        $notification = array(
            'messege' => 'Sub Category Add Successfully',
            'alert-type' => 'success'
        );
        return redirect('/subCategories')->with($notification);
    }
}
