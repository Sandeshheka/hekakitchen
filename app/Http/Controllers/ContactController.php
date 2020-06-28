<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    
  public function __construct()
  {
    $this->middleware('auth:admin');
  }

    public function contact()
    {
        return view('pages.contact');
    }

    public function contactForm(Request $request)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['message'] = $request->message;

        DB::table('contacts')->insert($data);
        $notification = array(
            'messege' => 'Your Message Insert Successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }


    public function allMessage()
    {
        $message =    DB::table('contacts')->get();
        return view('admin.contact.all_message', compact('message'));
    }
}
