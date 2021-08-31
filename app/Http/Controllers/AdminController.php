<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Neighbourhood;

class AdminController extends Controller
{
    public function neighbourhood() {

        $neighbourhoods = Neighbourhood::orderBy('display_order')->get();
        return view('admin.neighbourhood_editor',
                    ['neighbourhoods' => $neighbourhoods]
                );
    }
}
