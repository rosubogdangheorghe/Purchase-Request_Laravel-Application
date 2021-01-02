<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchaseheader;
use App\Models\Purchasebody;

class ManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchaseHeader = new Purchaseheader();
        $purchases = $purchaseHeader->selectPurchaseHeaders();
 
         return view('management.index')->with('purchases',$purchases);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchaseHeaderId =  Purchaseheader::findOrFail($id)->id;
        $purchaseHeader = new Purchaseheader();
        $purchaseHeaderById =  $purchaseHeader->selectPurchaseHeaderById($purchaseHeaderId);
        $prBody = new Purchasebody();
       
        $prLines = $prBody->getPrLines($purchaseHeaderId);

        return view('management.show',compact('purchaseHeaderById',$purchaseHeaderById))->with('prLines', $prLines);
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    public function promote($id){

        $status = Purchaseheader::STATUS[3];
        //$purchaseHeaderId =  Purchaseheader::findOrFail($id)->id;
     
        Purchaseheader::updateStatus($id,$status);  

        return redirect()->route('management.index')->with('success','Purchase request approved successfuly');
          
        }

        public function reject($id){

            $status = Purchaseheader::STATUS[4];
            //$purchaseHeaderId =  Purchaseheader::findOrFail($id)->id;
         
            Purchaseheader::updateStatus($id,$status);  
    
            return redirect()->route('management.index')->with('success','Purchase request reject successfuly');
              
            }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
