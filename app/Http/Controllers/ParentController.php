<?php

namespace App\Http\Controllers;

use App\Models\Children;
use App\Models\Partner;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_babies= Partner::with('childrens')->get();
        return response()->json($all_babies);
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
     * @param  \App\Models\Parents  $parents
     * @return \Illuminate\Http\Response
     */
    public function show(Partner $parents)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Parents  $parents
     * @return \Illuminate\Http\Response
     */
    public function edit(Partner $parents)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Parents  $parents
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Partner $parents)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Parents  $parents
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partner $partner)
    {
        //
    }

    public function addPartner($partner,$children){
        try{
            $partner = Partner::findOrFail($partner);
            $children = Children::findOrFail($children);
            $children->Partners()->sync($partner->id);
            return response()->json(Children::with('Partners')->where('id',$children->id)->get());
        }catch (\Exception $e){
            return response()->json("Not Found Parent or Children",404);
        }

    }
}
