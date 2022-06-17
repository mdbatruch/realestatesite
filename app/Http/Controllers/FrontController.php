<?php

namespace App\Http\Controllers;

use App\Models\Neighbourhood;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function neighbourhoods()
    {
        $neighbourhoods = Neighbourhood::orderBy('display_order')->get();

        return view('neighbourhoods',[
            'neighbourhoods' => $neighbourhoods
        ]);
    }
    
    public function aboutUs()
    {
        return view('aboutUs');
    }
}
