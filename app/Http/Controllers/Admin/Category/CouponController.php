<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Model\Coupon;
use App\Model\Newslater;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $coupons = Coupon::all();
        return view('admin.coupon.coupon', compact('coupons'));
    }

    public function storeCoupon(Request $request)
    {
       

 

        //    $data = array();
        //    $data['category_name'] =$request->category_name;
        //    DB::table('categories')->insert($data);

        $coupon = new Coupon();
        $coupon->coupon = $request->coupon;
        $coupon->discount = $request->discount;
        $coupon->save();
        $notification = array(
            'messege' => 'Coupon Add Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function deleteCoupon($id)
    {
        $coupon = Coupon::find($id);
     
        $coupon->delete();
        $notification = array(
            'messege' => 'Coupon Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    public function editCoupon($id)
    {
        $coupon = Coupon::find($id);
        return view('admin.coupon.editCoupon', compact('coupon'));
    }


    public function updateCoupon(Request $request, $id)
    {
       

          $data = array();
           $data['coupon'] =$request->coupon;
           $data['discount'] =$request->discount;
           $update=DB::table('coupons')->where('id', $id)->update($data);
           if ($update) {
                $notification = array(
                    'messege' => 'Coupon Updated Successfully',
                    'alert-type' => 'success'
                );
                return redirect('/coupons')->with($notification);
           }
           else
           {
            $notification = array(
                'messege' => 'Nothing to Updated ',
                'alert-type' => 'error'
            );
            return redirect('/coupons')->with($notification);
           }

    }

    public function NewsLater()
    {
     
            $news = Newslater::all();
            return view('admin.coupon.viewNewsLater',compact('news'));
      

        
    }


    public function storeNewslater(Request $request)
    {
        
        $news = new Newslater();
        $news->email = $request->email;

        $news->save();
        $notification = array(
            'messege' => 'Coupon Add Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    
    public function deleteNewslater($id)
    {
        $news = Newslater::find($id);
     
        $news->delete();
        $notification = array(
            'messege' => 'Email Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    public function editNewslater($id)
    {
        $coupon = Coupon::find($id);
        return view('admin.coupon.editCoupon', compact('coupon'));
    }


    public function updateNewsLater(Request $request, $id)
    {
       

          $data = array();
           $data['coupon'] =$request->coupon;
           $data['discount'] =$request->discount;
           $update=DB::table('coupons')->where('id', $id)->update($data);
           if ($update) {
                $notification = array(
                    'messege' => 'Coupon Updated Successfully',
                    'alert-type' => 'success'
                );
                return redirect('/coupons')->with($notification);
           }
           else
           {
            $notification = array(
                'messege' => 'Nothing to Updated ',
                'alert-type' => 'error'
            );
            return redirect('/coupons')->with($notification);
           }

    }

}
