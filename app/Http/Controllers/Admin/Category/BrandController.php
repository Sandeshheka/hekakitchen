<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Model\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $brand = Brand::all();
  
        return view('admin.category.viewBrand', compact('brand'));
    }

    public function storeBrand(Request $request)
    {
 
        $valiData = $request->validate([
            'brand_name' => 'required|unique:brands|max:255',
         

        ]);

        //    $data = array();
        //    $data['category_name'] =$request->category_name;
        //    DB::table('categories')->insert($data);
        $brand = new Brand();
        $brand->brand_name = $request->brand_name;
        $image = $request->brand_logo;
        if ($image) {
            $image_name = date('dmy_h_s_i');
            $ext = strtolower($image->getClientOriginalExtension());
            $imageFullName = $image_name.'.'.$ext;
            $upload_path = 'media/brand/';
            $image_url= $upload_path.$imageFullName;
            $success = $image->move($upload_path, $imageFullName);
            $brand->brand_logo = $image_url;
            $brand->save();
            $notification = array(
                'messege' => 'Brand Add Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);

        }

        else{
            $brand->save();
            $notification = array(
                'messege' => 'Brand Has no Logo',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);

        }
      

      
      
    }

    public function deleteBrand($id)
    {
        $brand = Brand::find($id);
        $image= $brand->brand_logo;
        unlink($image);
        $brand->delete();
        $notification = array(
            'messege' => 'Brand Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function editBrand($id)
    {
        $brand = Brand::find($id);
        return view('admin.category.editBrand', compact('brand'));
    }

    public function updateBrand(Request $request, $id)
    {
        $valiData = $request->validate([
            'brand_name' => 'required|max:255',

        ]);


        $oldLogo = $request->old_logo;

            $data = array();
          $data['brand_name'] =$request->brand_name;

 
        $image = $request->file('brand_logo');
        if ($image) {
            unlink($oldLogo);
            $image_name = date('dmy_h_s_i');
            $ext = strtolower($image->getClientOriginalExtension());
            $imageFullName = $image_name.'.'.$ext;
            $upload_path = 'media/brand/';
            $image_url= $upload_path.$imageFullName;
            $success = $image->move($upload_path, $imageFullName);
            $data['brand_logo'] = $image_url;

        
            $brand = DB::table('brands')->where('id', $id)->update($data);
            $notification = array(
                'messege' => 'Brand Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect('/brands')->with($notification);

        }

        else{
            $brand = DB::table('brands')->where('id', $id)->update($data);
            $notification = array(
                'messege' => 'Brand Has no Logo',
                'alert-type' => 'success'
            );
            return redirect('/brands')->with($notification);

        }


    }

}
