<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChildrenRequest;
use App\Http\Middleware\childParent;
use App\Models\Children;
use App\Models\Partners;
use Validator;
use Illuminate\Http\Request;

class ChildrenController extends Controller
{

    public function __construct()
    {
        $this->middleware('childParent',['only'=>['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_babies= Children::with('Partners')->get();
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
     * @param  \Illuminate\Http\Requests\StoreChildrenRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChildrenRequest $request)
    {
        $Childrens = Children::create([
            'name' => $request->name,
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
        ]);

        $Childrens->Partners()->attach(auth()->user());

        return response()->json($Childrens);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Children $children
     * @return \Illuminate\Http\Response
     */
    public function show($children)
    {
        try{
            $children= Children::with('Partners')->where('id',$children)->get();
            return response()->json($children,200);
        }catch(\Exception $e){
            return response()->json("Not Found This Children",404;
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Children  $childerens
     * @return \Illuminate\Http\Response
     */
    public function edit(Children $children)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Children  $childerens
     * @return \Illuminate\Http\Response
     */
    public function update(StoreChildrenRequest $request,$children)
    {
        try{
            $children = Children::firstOrFail($children);
            $data = $request->all();
            $children->update($data);
            $result = $children->with('Partners')->get();
            return response()->json($result,200);
        }catch(\Exception $e){
            return response()->json("Not Found this children",404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Children  $childerens
     * @return \Illuminate\Http\Response
     */
    public function destroy($children)
    {
        try{
         $children= Children::firstOrFail($children);
         $children->delete();
        return response()->json("Baby has been deleted Succussfully");
        }catch (\Exception $e){
            return reponse()->json("Not Found this Children",404);
        }

    }
}
