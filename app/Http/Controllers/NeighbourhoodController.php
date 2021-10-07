<?php

namespace App\Http\Controllers;
use App\Models\House;

use App\Models\Neighbourhood;
use Illuminate\Http\Request;
use App\Http\Requests\NeighbourhoodPost;

class NeighbourhoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('manage', 'App\Neighbourhood');

        $neighbourhoods = Neighbourhood::orderBy('display_order')->get();

        return view('neighbourhoods_index',[
            'neighbourhoods' => $neighbourhoods
        ]);
    }

    // public function upsert(Request $request) {
    public function upsert(NeighbourhoodPost $request) {

        $this->authorize('manage', 'App\Neighbourhood');
        $neighbourhoods = $request->post('neighbourhoods');

        // echo '<pre>';
        // print_r($neighbourhoods);

        // $request->validate([
        //     'name' => 'required|max:128',
        //     'subtitle' => 'required|max:512',
        //     'description' => 'required|numeric|min:0',
        //     'image' => 'required'
        // ]);

        if ($request->validated()) {
            foreach ($neighbourhoods as $hood) {
                if ($hood['id']) {
                    Neighbourhood::where('id', $hood['id'])->update($hood);
                } else {
                    Neighbourhood::create($hood);
                    // echo 'test';
                    // Neighbourhood::create($request->validated());
                }
            }
        }

        return ['success' => true, 'neighbourhoods' => Neighbourhood::all()];
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\neighbourhood  $neighbourhood
     * @return \Illuminate\Http\Response
     */
    public function items(neighbourhood $neighbourhood)
    {
        return $neighbourhood->houseItems->map(function($house) {
            return $house->only(['id', 'name']);
        });
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\neighbourhood  $neighbourhood
     * @return \Illuminate\Http\Response
     */
    public function edit(neighbourhood $neighbourhood)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\neighbourhood  $neighbourhood
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, neighbourhood $neighbourhood)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\neighbourhood  $neighbourhood
     * @return \Illuminate\Http\Response
     */
    public function destroy(neighbourhood $neighbourhood)
    {
        $this->authorize('delete', $neighbourhood);

        $neighbourhood->delete();

        return ['success' => true];
    }
}
