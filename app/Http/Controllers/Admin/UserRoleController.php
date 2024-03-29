<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function allUser()
    {
        $user = DB::table('admins')->where('type', 2)->get();
        return view('admin.user.allUserRole', compact('user'));
    }

    public function createUser()
    {
        return view('admin.user.createUser');
    }

    public function storeRole(Request $request)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['category'] = $request->category;
        $data['coupon'] = $request->coupon;
        $data['product'] = $request->product;
        $data['blog'] = $request->blog;
        $data['orders'] = $request->orders;
        $data['other'] = $request->other;
        $data['report'] = $request->report;
        $data['role'] = $request->role;
        $data['returns'] = $request->returns;
        $data['contact'] = $request->contact;
        $data['comment'] = $request->comment;
        $data['setting'] = $request->setting;
        $data['stock'] = $request->stock;
        $data['type'] = 2;


        DB::table('admins')->insert($data);
        $notification = array(
            'messege' => 'Child Admin Inserted',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function editUserRole($id)
    {
        $user = DB::table('admins')->where('id', $id)->first();
        return view('admin.user.editRole', compact('user'));
    }

    public function deleteUserRole($id)
    {
        $user = DB::table('admins')->where('id', $id)->delete();
        $notification = array(
            'messege' => 'Admin was deleted',
            'alert-type' => 'danger'
        );
        return Redirect()->back()->with($notification);
    }
    public function updateRole(Request $request)
    {
        $id = $request->id;
        $data = array();
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['category'] = $request->category;
        $data['coupon'] = $request->coupon;
        $data['product'] = $request->product;
        $data['blog'] = $request->blog;
        $data['orders'] = $request->orders;
        $data['other'] = $request->other;
        $data['report'] = $request->report;
        $data['role'] = $request->role;
        $data['returns'] = $request->returns;
        $data['contact'] = $request->contact;
        $data['comment'] = $request->comment;
        $data['setting'] = $request->setting;
        $data['stock'] = $request->stock;

        DB::table('admins')->where('id', $id)->update($data);
        $notification = array(
            'messege' => 'Child Admin Updated Successfully',
            'alert-type' => 'success'
        );
        return Redirect('/allUser')->with($notification);
    }


    public function productStock()
    {
        $product = DB::table('products')
            ->join('categories', 'products.category_id', 'categories.id')
            ->join('brands', 'products.brand_id', 'brands.id')
            ->select('products.*', 'categories.category_name', 'brands.brand_name')
            ->get();
        // return response()->json($product);
        return view('admin.stock.stock', compact('product'));
    }
}
