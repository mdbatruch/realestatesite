<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Neighbourhood;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //check if user is authenticated
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $neighbourhoods = Neighbourhood::orderBy('display_order')->get();

        return view('home',[
            'neighbourhoods' => $neighbourhoods
        ]);
    }
}
