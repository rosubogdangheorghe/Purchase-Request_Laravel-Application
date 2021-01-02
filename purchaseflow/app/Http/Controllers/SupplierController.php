<?php

namespace App\Http\Controllers;

use App\Models\Costcenters;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Client\Response;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $supplier = Supplier::first();
        $supplier = DB::table('suppliers')->get()->sortBy('code');
        return view('supplier.index')->with('supplier',$supplier);
        //return view('supplier.index',compact('supplier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplier.create');
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
            'code'=> 'required|regex:/[0-9]{8}/',
            'description'=> 'required|regex:/[a-zA-Z0-9]/'
        ]);
        $supplier = new Supplier();
        $supplier->code = $request->get('code');
        $supplier->description = $request->get('description');
        $exists = DB::table('suppliers')->where('code',$supplier->code)->exists();
        if($exists) {
            return redirect()->route('supplier.index')->with('message','Supplier already created');
        }
        else{
            $supplier->save();
            return redirect()->route('supplier.index')->with('success','Supplier created with succes');
        }    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        return view('supplier.show',compact('supplier',$supplier));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('supplier.edit',compact('supplier',$supplier));
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
        $supplier = Supplier::findOrFail($id);
        $request ->validate([
            'code'=> 'required|regex:/[0-9]{8}/',
            'description'=> 'required|regex:/[a-zA-Z0-9]/'
        ]);
       // $supplier->update($request->all());

        $supplier->code = $request->get('code');
        $supplier->description = $request->get('description');
        $exists = DB::table('suppliers')->where('code',$supplier->code)->exists();
        if($exists) {
            return redirect()->route('supplier.index')->with('message','Supplier already created');
        }
        else{
            $supplier->save();
            return redirect()->route('supplier.index')->with('success','Supplier update with succes');
        }    

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Supplier $supplier)
    {
        $supplier->delete();
        $request->session()->flash('message','Supplier'.' '.$supplier['description'].' '.'deteled');
        return redirect()->route('supplier.index');
    }
}
