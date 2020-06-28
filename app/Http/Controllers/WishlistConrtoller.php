<?php

namespace App\Http\Controllers;

use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WishlistConrtoller extends Controller
{


   public function addWishlist($id)
   {
       $userId = Auth::id();
       $wish = DB::table('wishlists')->where('user_id', $userId)->where('product_id', $id)->first();
       $data = array(
           'user_id' => $userId,
           'product_id' =>$id,
       );

       if(Auth::check())
       {
            if ($wish) 
            
            {
                return response()->json(['error' => 'Product alerady exits on wishlist']);
            }
            else
            {
                DB::table('wishlists')->insert($data);
                return response()->json(['success' => 'Product Added on Wishlist']);
            }
       }
       else
       {
        return response()->json(['error' => 'At First Login your account']);
        }
  
     

   }

 
}
