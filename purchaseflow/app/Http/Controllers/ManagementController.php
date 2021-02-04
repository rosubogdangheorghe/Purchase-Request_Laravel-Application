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

    public function promote($id)
    {
        $purchaseHeader = new Purchaseheader();
        $status = $purchaseHeader->getStatus($id); 
      
        if($status[0]->status == Purchaseheader::STATUS[2]) {
            $status = Purchaseheader::STATUS[3];
            Purchaseheader::updateStatus($id, $status);
            return redirect()->route('management.index')->with('success', 'Purchase request approved successfuly');
        }   
        elseif($status[0]->status == Purchaseheader::STATUS[4]) {
            return redirect()->route('management.index')->with('message', 'Cannot approve a Purchase request already rejected'); }
        else {
          
            return redirect()->route('management.index')->with('message','Purchase request should be checked by accounting before approval');
            var_dump(Purchaseheader::STATUS[3]);
           
        }
       
    }

    public function reject($id)
    {
        $purchaseHeader = new Purchaseheader();
        $status = $purchaseHeader->getStatus($id); 
        if($status[0]->status == Purchaseheader::STATUS[2]) {
            $status = Purchaseheader::STATUS[4];
            Purchaseheader::updateStatus($id, $status);
            return redirect()->route('management.index')->with('success', 'Purchase request reject successfuly');
        } elseif($status[0]->status == Purchaseheader::STATUS[3]) {
            return redirect()->route('management.index')->with('message', 'Cannot Reject a Purchase request already approved');
        } else {
            return redirect()->route('management.index')->with('message','Purchase request should be checked by accounting before rejection');
        }
       
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
