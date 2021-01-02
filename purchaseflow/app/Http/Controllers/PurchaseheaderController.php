<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Purchaseheader;

use App\Models\Purchasebody;


class PurchaseheaderController extends Controller
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

        return view('purchaseheader.index')->with('purchases',$purchases);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $ccId = Purchaseheader:: selectCostcenter(); 

        $suppId = Purchaseheader:: selectSupplier();
    
        $userId = Purchaseheader::selectUser();

        $currencies = Purchaseheader::CURRENCIES;

        return view('purchaseheader.create')->with('ccId',$ccId)->with('suppId',$suppId)->with('userId',$userId)
        ->with('currencies',$currencies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $purchaseHeader = new Purchaseheader();
        $purchaseHeader ->issueDate     = $request->get('issueDate');
        $purchaseHeader->deliveryDate   = $request->get('deliveryDate');
        $purchaseHeader->costcenters_id      = $request->get('costcenters_id');
        $purchaseHeader->suppliers_id         = $request->get('suppliers_id');
        $purchaseHeader->users_id         = $request->get('users_id');
        $purchaseHeader->currency       = $request->get('currency');
        $purchaseHeader->status         = Purchaseheader::STATUS[0];
        $purchaseHeader->save();
        
        return redirect()->route('purchaseheader.index')->with('success','Pr Header saved');

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
        return view('purchaseheader.show',compact('purchaseHeaderById',$purchaseHeaderById))->with('prLines', $prLines);
    }

   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchaseheader $purchaseheader)
    {   
        $purchaseHeaderId =  $purchaseheader->id;

        $ccId = Purchaseheader:: selectCostcenter(); 

        $suppId = Purchaseheader:: selectSupplier();
    
        $userId = Purchaseheader::selectUser();

        $currencies = Purchaseheader::CURRENCIES;
        
      
        $status = Purchaseheader::getStatus($purchaseHeaderId);

        if($status[0]->status == Purchaseheader::STATUS[0]){

        return view('purchaseheader.edit',compact('purchaseheader',$purchaseheader))->with('ccId',$ccId)->with('suppId',$suppId)->with('userId',$userId)
        ->with('currencies',$currencies);
        }
        else {
            return redirect()->route('purchaseheader.index');
        }
        
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

        $purchaseHeader = Purchaseheader::findOrFail($id);
        $purchaseHeader ->issueDate     = $request->get('issueDate');
        $purchaseHeader->deliveryDate   = $request->get('deliveryDate');
        $purchaseHeader->costcenters_id      = $request->get('costcenters_id');
        $purchaseHeader->suppliers_id         = $request->get('suppliers_id');
        $purchaseHeader->users_id         = $request->get('users_id');
        $purchaseHeader->currency       = $request->get('currency');
        $purchaseHeader->status         = Purchaseheader::STATUS[0];
        $purchaseHeader->save();
        
        return redirect()->route('purchaseheader.index')->with('success','Purchase request updated successfuly');

    }

    public function promote($id){

            $status = Purchaseheader::STATUS[1];
            $purchasebody = new Purchasebody();
            $prlines = $purchasebody->getPrLines($id);
            $count = sizeof($prlines);
            if($count > 0) {
                Purchaseheader::updateStatus($id,$status);
               


                return redirect()->route('purchaseheader.index')->with('success','Purchase request promoted successfuly');
            }
            else {
                return redirect()->route('purchasebody.createPrLine',$id)->with('message','Please create PR lines before promotion');
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
