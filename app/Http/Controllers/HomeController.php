<?php

namespace App\Http\Controllers;

use App\Models\Organ;
use App\Models\People;
use App\Models\Sector;
use Illuminate\Http\Request;

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
        $countSectors = Sector::count();
        $countPeoples = People::count();
        $countOrgans = Organ::count();
        return view('home', compact('countSectors', 'countPeoples', 'countOrgans'));
    }
}
