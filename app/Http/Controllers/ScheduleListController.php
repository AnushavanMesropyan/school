<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleListController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
           $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //php artisan make:policy ScheduleListPolicy
        $list = Schedule::with(['classRoom'])->where('teacher_id','=',auth()->id())->get();
        return view('scheduleList',compact('list'));
    }


}
