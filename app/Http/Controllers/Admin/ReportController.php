<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
   public function __construct()
   {
        $this->middleware('auth:admin');
   }

   public function todayOrder()
   {
        $today = date('d-m-y');
        $order = DB::table('orders')->where('status',0)->where('date', $today)->get();
        return view('admin.report.todayOrder', compact('order'));
   }

   public function todayDelivery()
   {
    $today = date('d-m-y');
    $order = DB::table('orders')->where('status',3)->where('date', $today)->get();
    return view('admin.report.todayDelivery', compact('order'));
   }

   public function thisMonth()
   {
    $month = date('F');
    $order = DB::table('orders')->where('status',3)->where('month', $month)->get();
    return view('admin.report.thisMonth', compact('order'));
   }
   public function searchReport()
   {
    return view('admin.report.search');
   }

   public function SearchByYear(Request $request)
   {
        $year = $request->year;
        $total = DB::table('orders')->where('status',3)->where('year', $year)->sum('total');
        $order = DB::table('orders')->where('status',3)->where('year', $year)->get();
        return view('admin.report.searchYear', compact('order', 'total'));
   }

   public function SearchByMonth(Request $request)
   {
    $month = $request->month;
    $total = DB::table('orders')->where('status',3)->where('month', $month)->sum('total');
    $order = DB::table('orders')->where('status',3)->where('month', $month)->get();
    return view('admin.report.searchMonth', compact('order', 'total'));
   }
   public function SearchByDate(Request $request)
   {
    $date = $request->date;
    $newdate = date('d-m-y',strtotime($date));
    $total = DB::table('orders')->where('status',3)->where('date', $newdate)->sum('total');
    $order = DB::table('orders')->where('status',3)->where('date', $newdate)->get();
    return view('admin.report.searchDate', compact('order', 'total'));
   }
}
