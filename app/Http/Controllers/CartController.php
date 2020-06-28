<?php

namespace App\Http\Controllers;

use App\Model\Products;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;


class CartController extends Controller
{
    public function addToCart($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        $data = array();

        if ($product->discount_price == NULL) {
            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = 1;
            $data['price'] = $product->selling_price;
            $data['weight'] = 1;
            $data['options']['image'] = $product->image_one;
            $data['options']['color'] = '';
            $data['options']['size'] = '';
            Cart::add($data);
            return response()->json(['success' => 'Successfully Added on your Cart']);
        } else {

            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = 1;
            $data['price'] = $product->discount_price;
            $data['weight'] = 1;
            $data['options']['image'] = $product->image_one;
            $data['options']['color'] = '';
            $data['options']['size'] = '';
            Cart::add($data);
            return response()->json(['success' => 'Successfully Added on your Cart']);
        }
    }

    public function check()
    {
        $content = Cart::content();
        return response()->json($content);
    }


    public function showCart()
    {
        $cart = Cart::content();
        return view('pages.cart', compact('cart'));
    }


    public function removeCart($rowId)
    {
        Cart::remove($rowId);
        $notification = array(
            'messege' => 'Product Removed From Cart',
            'alert-type' => 'warning'
        );
        return Redirect()->back()->with($notification);
    }


    public function updateCart(Request $request)
    {
        $rowId = $request->productId;
        $qty = $request->qty;
        Cart::update($rowId, $qty);
        $notification = array(
            'messege' => 'Product Quantity Updated',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function viewProduct($id)
    {
        $product = DB::table('products')
            ->join('categories', 'products.category_id', 'categories.id')
            ->join('brands', 'products.brand_id', 'brands.id')
            ->join('subcategories', 'products.subcategory_id', 'subcategories.id')
            ->select('products.*', 'categories.category_name', 'subcategories.subcategory_name', 'brands.brand_name')
            ->where('products.id', $id)
            ->first();
        $color = $product->product_color;
        $productColor = explode(',', $color);

        $size = $product->product_size;
        $productSize = explode(',', $size);

        return response()->json(array(
            'product' => $product,
            'color' => $productColor,
            'size' => $productSize,
        ));
    }

    public function insertCart(Request $request)
    {
        $id = $request->product_id;
        $qty = $request->qty;
        $size = $request->size;
        $color = $request->color;
        $product = DB::table('products')->where('id', $id)->first();
        $data = array();

        if ($product->discount_price == NULL) {
            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = $qty;
            $data['price'] = $product->selling_price;
            $data['weight'] = 1;
            $data['options']['image'] = $product->image_one;
            $data['options']['color'] = $color;
            $data['options']['size'] =  $size;
            Cart::add($data);
            $notification = array(
                'messege' => 'Product Added Successfully',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        } else {

            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = $qty;
            $data['price'] = $product->discount_price;
            $data['weight'] = 1;
            $data['options']['image'] = $product->image_one;
            $data['options']['color'] = $color;
            $data['options']['size'] =  $size;
            Cart::add($data);
            $notification = array(
                'messege' => 'Product Added Successfully',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function checkout()
    {
        if (Auth::check()) {
            $cart = Cart::content();
            return view('pages.checkout', compact('cart'));
        } else {
            $notification = array(
                'messege' => 'Please Login First',
                'alert-type' => 'success'
            );
            return Redirect('/login')->with($notification);
        }
    }

    public function wishlist()
    {
        $userId = Auth::id();
        $product = DB::table('wishlists')
            ->join('products', 'wishlists.product_id', 'products.id')
            ->select('products.*', 'wishlists.user_id')
            ->where('wishlists.user_id', $userId)
            ->get();
        return view('pages.wishlist', compact('product'));
    }

    public function coupon(Request $request)
    {
        $coupon = $request->coupon;
        $check = DB::table('coupons')
            ->where('coupon', $coupon)
            ->first();
        if ($check) {
            Session::put('coupon', [
                'name' => $check->coupon,
                'discount' => $check->discount,
                'balance' => Cart::Subtotal() - $check->discount,
            ]);
            $notification = array(
                'messege' => 'Coupon Applied Successfully',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        } else {
            $notification = array(
                'messege' => 'Coupon didnt Matched',
                'alert-type' => 'warning'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function CouponRemove()
    {
        Session::forget('coupon');
        $notification = array(
            'messege' => 'Coupon remove Successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function paymentPage()
    {
        $cart = Cart::content();
        return view('pages.payment', compact('cart'));
    }

    public function search(Request $request)
    {
        $item = $request->search;
        $products = DB::table('products')
                       ->where('product_name','LIKE', "%$item%")
                       ->paginate(20);
        return view('pages.search', compact('products')); 
    }

    
}
