<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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
        $pageTittle = 'home';
        $employeeCounts = DB::table('employees')
    ->join('positions', 'employees.position_id', '=', 'positions.id')
    ->select('positions.name as position_name', DB::raw('count(employees.id) as employee_count'))
    ->groupBy('positions.name')
    ->get();

        return view('home', ['pageTittle' => $pageTittle], compact('employeeCounts'));
    }
}