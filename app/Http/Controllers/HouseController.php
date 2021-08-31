<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;
use App\Http\Requests\HousePost;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HousePost $request)
    // public function store(HousePost $request)
    {
        // if (!$request->user()->can('edit-house')) {
        //     return response('Unathorized', 403);
        // }

        // $request->validate([
        //     'name' => 'required|max:128',
        //     'description' => 'required|max:512',
        //     'price' => 'required|numeric|min:0',
        //     'neighbourhood' => 'required|numeric',
        //     'image' => 'required'
        // ]);



        // House::create($request->post());
        House::create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\House  $house
     * @return \Illuminate\Http\Response
     */
    public function show(House $house)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\House  $house
     * @return \Illuminate\Http\Response
     */
    public function edit(House $house)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\House  $house
     * @return \Illuminate\Http\Response
     */
    public function update(HousePost $request, House $house)
    {
        $house->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\House  $house
     * @return \Illuminate\Http\Response
     */
    public function destroy(House $house)
    {
        //
    }

    public function getHouse($id) {
        // logic to get a student record goes here
        if (House::where('id', $id)->exists()) {
            $house = House::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($house, 200);
          } else {
            return response()->json([
              "message" => "Student not found"
            ], 404);
          }
      }
}
