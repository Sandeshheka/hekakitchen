<?php

namespace App\Http\Controllers;

use App\Model\Newslater;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function storeNewslater(Request $request)
    {
        $vali = $request->validate([
            'email' => 'required|unique:newslaters|max:55'
        ]);
        
        $news = new Newslater();
        $news->email = $request->email;

        $news->save();
        $notification = array(
            'messege' => 'Thanks For Suscribed ',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    public function orderTrack(Request $request)
    {
        $code = $request->code;
        $track = DB::table('orders')->where('status_code',$code)->first();

        if ($track) {
            return view('pages.trackOrder', compact('track'));
        } else {
            $notification = array(
                'messege' => 'Status Code Invalid!! ',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        
      
    }
}
