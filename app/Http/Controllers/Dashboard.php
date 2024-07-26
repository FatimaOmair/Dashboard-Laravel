<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Controller
{
//هاد الكونترولير جميع الاكشن الي فيه ما رح تتنفذ الا اذا كان auth
//يعني بدل ما اعرف الميدل ووير عمستوى الراوت بعرفه ع مستوى الكونترولير
    // public function  __construct(){
    // $this->middleware(['auth']);
    // }


    //Actions

    public function index(){

        $user=Auth::user();



      return view('dashboard.index');
    }
}
