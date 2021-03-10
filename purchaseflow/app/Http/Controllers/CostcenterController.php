<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Costcenter;
use Illuminate\Support\Facades\DB;


class CostcenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$costcenter = Costcenter::first('code')->paginate(50);
        $costcenter = DB::table('costcenters')->get()->sortBy('code');
        // return view('costcenter.index',compact('costcenter'));
        return view('costcenter.index')->with('costcenter',$costcenter);  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('costcenter.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request ->validate([
            'code'=> 'required|regex:/[0-9]{2}-[0-9]{2}-[0-9]{2}/',
            'description'=> 'required|regex:/[a-zA-Z0-9]*/'
        ]);
        $costcenter = new Costcenter();
        $costcenter->code=$request->get('code');
        $costcenter->description = $request->get('description');
        $exists = DB::table('costcenters')->where('code',$costcenter->code)->exists();
           
        if($exists) {
            return  redirect()->route('costcenter.index')->with('message','Cost center already created');
        } else {
           
            $costcenter ->save();
            return  redirect()->route('costcenter.index')->with('success','Cost center added with success');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Costcenter $costcenter)
    {
        return view('costcenter.show',compact('costcenter',$costcenter));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Costcenter $costcenter) 
    {
        return view('costcenter.edit',compact('costcenter',$costcenter));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $costcenter = Costcenter::findOrFail($id);
        $request ->validate([
            'code'=> 'required|regex:/[0-9]{2}-[0-9]{2}-[0-9]{2}/',
            'description'=> 'required|regex:/[a-zA-Z0-9]/'
        ]);
       // $costcenter->update($request->all());
        $costcenter->code=$request->get('code');
        $costcenter->description = $request->get('description');
        
        $exists = DB::table('costcenters')->where('code',$costcenter->code)->exists();
           
        if($exists) {
            return  redirect()->route('costcenter.index')->with('message','Cost center already created');
        } else {
           
            $costcenter ->save();
            return  redirect()->route('costcenter.index')->with('success','Cost center added with success');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Costcenter $costcenter)
    {
        $costcenter->delete();
        $request->session()->flash('message','Costcenter'.' '.$costcenter['description'].' '.'deteled');
        return redirect()->route('costcenter.index');
    }

}
