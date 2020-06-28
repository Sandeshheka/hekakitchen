<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Products;
use App\Model\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $product = DB::table('products')
                    ->join('categories', 'products.category_id', 'categories.id')
                    ->join('brands', 'products.brand_id', 'brands.id')
                    ->select('products.*', 'categories.category_name', 'brands.brand_name')
                    ->get();
        // return response()->json($product);
        return view('admin.products.viewAllProduct', compact('product'));
        
    }

    public function createProduct()
    {

        $category = Category::all();
        $brand = Brand::all();
        $subcat = Subcategory::all();
        return view('admin.products.create', compact('category', 'brand'));
    }

    public function getSub($category_id)
    {
        $cate = DB::table('subcategories')->where('category_id', $category_id)->get();
        return json_encode($cate);
    }


    public function insertProduct(Request $request)
    {
    
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_code'] = $request->product_code;
        $data['product_quantity'] = $request->product_quantity;
        $data['category_id'] = $request->category_id;
        $data['subcategory_id'] = $request->subcategory_id;
        $data['brand_id'] = $request->brand_id;
        $data['product_size'] = $request->product_size;
        $data['product_color'] = $request->product_color;
        $data['selling_price'] = $request->selling_price;
        $data['discount_price'] = $request->discount_price;
        $data['product_detail'] = $request->product_detail;
        $data['video_link'] = $request->video_link;
        $data['main_slider'] = $request->main_slider;
        $data['hot_deal'] = $request->hot_deal;
        $data['best_rated'] = $request->best_rated;
        $data['trend'] = $request->trend;
        $data['mid_slider'] = $request->mid_slider;
        $data['hot_new'] = $request->hot_new;
        $data['status'] = 1;

        $image_one = $request->image_one;
        $image_two = $request->image_two;
        $image_three = $request->image_three;
        if ($image_one && $image_two && $image_three) {
            $image_one_name = hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(300,300)->save('media/product/'.$image_one_name);
            $data['image_one'] = 'media/product/'.$image_one_name;

            $image_two_name = hexdec(uniqid()).'.'.$image_two->getClientOriginalExtension();
            Image::make($image_two)->resize(300,300)->save('media/product/'.$image_two_name);
            $data['image_two'] = 'media/product/'.$image_two_name;

            $image_three_name = hexdec(uniqid()).'.'.$image_three->getClientOriginalExtension();
            Image::make($image_three)->resize(300,300)->save('media/product/'.$image_three_name);
            $data['image_three'] = 'media/product/'.$image_three_name;

      

        $product = DB::table('products')->insert($data);
        $notification=array(
              'messege'=>'Product Inserted Successfully',
              'alert-type'=>'success'
               );
             return Redirect()->back()->with($notification);
            }
    }

    public function inactiveProduct($id)
    {
        DB::table('products')->where('id', $id)->update(['status'=>0]);
        $notification=array(
            'messege'=>'Product Successfully Inactive',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);
    }

    public function activeProduct($id)
    {
        DB::table('products')->where('id', $id)->update(['status'=>1]);
        $notification=array(
            'messege'=>'Product Successfully Active',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);
    }


    public function deleteProduct($id)
    {
        $product = Products::find($id);
        $image1 = $product->image_one;
        $image2 = $product->image_two;
        $image3 = $product->image_three;
        unlink($image1);
        unlink($image2);
        unlink($image3);
        $product->delete();
        $notification=array(
            'messege'=>'Product Deleted Successfully',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);

    }

    public function singleProduct($id)
    {
        // dd($id);
       
    
    
       $product = DB::table('products')
       ->join('categories','products.category_id','categories.id')
       ->join('subcategories','products.subcategory_id','subcategories.id')
       ->join('brands','products.brand_id','brands.id')
       ->select('products.*','categories.category_name','brands.brand_name','subcategories.subcategory_name')
       ->where('products.id',$id)
       ->first();
   
        return view('admin.products.singleProductDetail', compact('product'));
    }


    public function editProduct($id)
    {
        $product = Products::find($id);
      
        return view('admin.products.editProduct', compact('product'));
    }


    public function updateProduct(Request $request, $id)
    {
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_code'] = $request->product_code;
        $data['product_quantity'] = $request->product_quantity;
        $data['category_id'] = $request->category_id;
        $data['subcategory_id'] = $request->subcategory_id;
        $data['brand_id'] = $request->brand_id;
        $data['product_size'] = $request->product_size;
        $data['product_color'] = $request->product_color;
        $data['selling_price'] = $request->selling_price;
        $data['discount_price'] = $request->discount_price;
        $data['product_detail'] = $request->product_detail;
        $data['video_link'] = $request->video_link;
        $data['main_slider'] = $request->main_slider;
        $data['hot_deal'] = $request->hot_deal;
        $data['best_rated'] = $request->best_rated;
        $data['trend'] = $request->trend;
        $data['mid_slider'] = $request->mid_slider;
        $data['hot_new'] = $request->hot_new;
        
        $update = DB::table('products')->where('id', $id)->update($data);
        if ($update) {
            $notification=array(
                'messege'=>'Product Successfully Updated',
                'alert-type'=>'success'
                 );
               return Redirect('/viewAllProduct')->with($notification);
        }

        else
        {
            $notification=array(
                'messege'=>'Nothing To Updated',
                'alert-type'=>'success'
                 );
               return Redirect('/viewAllProduct')->with($notification);
        }

    }


    public function updateProductPhoto(Request $request, $id)
    {
        
        $oldOne = $request->old_one;
        $oldTwo = $request->old_two;
        $oldThree = $request->old_three;

        $data = array();
       

 
        $image_one = $request->file('image_one');
        $image_two = $request->file('image_two');
        $image_three = $request->file('image_three'); 
        if ($image_one) {
            unlink($oldOne);
            $image_name = date('dmy_h_s_i');
            $ext = strtolower($image_one->getClientOriginalExtension());
            $imageFullName = $image_name.'.'.$ext;
            $upload_path = 'media/product/';
            $image_url= $upload_path.$imageFullName;
            $success = $image_one->move($upload_path, $imageFullName);
            $data['image_one'] = $image_url;

        
            $productImage = DB::table('products')->where('id', $id)->update($data);
            $notification = array(
                'messege' => 'Image One Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect('/viewAllProduct')->with($notification);

        }
        if ($image_two) {
            unlink($oldTwo);
            $image_name = date('dmy_h_s_i');
            $ext = strtolower($image_two->getClientOriginalExtension());
            $imageFullName = $image_name.'.'.$ext;
            $upload_path = 'media/product/';
            $image_url= $upload_path.$imageFullName;
            $success = $image_two->move($upload_path, $imageFullName);
            $data['image_two'] = $image_url;

        
            $productImage = DB::table('products')->where('id', $id)->update($data);
            $notification = array(
                'messege' => 'Image Two Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect('/viewAllProduct')->with($notification);

        }
        if ($image_three) {
            unlink($oldThree);
            $image_name = date('dmy_h_s_i');
            $ext = strtolower($image_three->getClientOriginalExtension());
            $imageFullName = $image_name.'.'.$ext;
            $upload_path = 'media/product/';
            $image_url= $upload_path.$imageFullName;
            $success = $image_three->move($upload_path, $imageFullName);
            $data['image_three'] = $image_url;

        
            $productImage = DB::table('products')->where('id', $id)->update($data);
            $notification = array(
                'messege' => 'Image Three Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect('/viewAllProduct')->with($notification);

        }

       


    }

    
}
