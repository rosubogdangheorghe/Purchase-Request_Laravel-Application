<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchasebody;
use App\Models\Purchaseheader;

class PurchasebodyController extends Controller
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

     public function create() {

     }

        public function createPrLine($id)
    {  
       
        $purchaseHeaderId =  Purchaseheader::findOrFail($id)->id;
        $status = (Purchaseheader::getStatus($purchaseHeaderId));
      
      
        $purchaseHeader = new PurchaseHeader();
        $purchaseHeaderById =  $purchaseHeader->selectPurchaseHeaderById($purchaseHeaderId);
       
        $unitMeasures = Purchasebody::UNIT_MEASURES;

        $budgeted = Purchasebody::BUDGETED;
        if ($status[0]->status == Purchaseheader::STATUS[0]) {

            return view('purchasebody.createPrLine',compact('purchaseHeaderById',$purchaseHeaderById))
            ->with('unitMeasures',$unitMeasures)->with('budgeted',$budgeted);

        } else {

         
            return redirect()->route('purchaseheader.index');
          
        }
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $purchasebody = new Purchasebody();
        $purchasebody->purchaseheaders_id = $request->get('purchaseheaders_id');
        $purchasebody->description = $request->get('description');
        $purchasebody->unitMeasure = $request->get('unitMeasure');
        $purchasebody->quantity = $request->get('quantity');
        $purchasebody->unitPrice = $request->get('unitPrice');
        $purchasebody->prvalue = $request->get('prvalue');
        $purchasebody->save();
        $purchaseHeader = new PurchaseheaderController();
        return $purchaseHeader->index();
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){


    }

    public function editPrLine(Purchasebody $purchasebody,$id)
    {
        $purchaseHeaderId =  Purchaseheader::findOrFail($id)->id;
        $purchaseHeader = new PurchaseHeader();
        $purchaseHeaderById =  $purchaseHeader->selectPurchaseHeaderById($purchaseHeaderId);
        $status = Purchaseheader::getStatus($purchaseHeaderId);
       
        $unitMeasures = Purchasebody::UNIT_MEASURES;

        $budgeted = Purchasebody::BUDGETED;

        if($status[0]->status == Purchaseheader::STATUS[0]) {
                return view('purchasebody.editPrLine',compact('purchasebody',$purchasebody))
                ->with('unitMeasures',$unitMeasures)->with('budgeted',$budgeted)->with('purchaseHeaderById',$purchaseHeaderById);
        } else {
                $purchaseHeader = new PurchaseheaderController();
                return $purchaseHeader->show( $purchaseHeaderId);

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        
        $purchasebody = Purchasebody::findOrFail($id);
        $purchasebody->purchaseheaders_id = $request->get('purchaseheaders_id');
        $purchasebody->description = $request->get('description');
        $purchasebody->unitMeasure = $request->get('unitMeasure');
        $purchasebody->quantity = $request->get('quantity');
        $purchasebody->unitPrice = $request->get('unitPrice');
        $purchasebody->prvalue = $request->get('prvalue');
        $purchasebody->save();
        $purchaseHeader = new PurchaseheaderController();
        return $purchaseHeader->show( $purchasebody->purchaseheaders_id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Purchasebody $purchasebody)
    {
       
        $id = $purchasebody->purchaseheaders_id;
        $status = Purchaseheader::getStatus($id);
        if($status[0]->status == Purchaseheader::STATUS[0]) {
            $purchasebody->delete();
        } else {
            $purchaseHeader = new PurchaseheaderController();
            return $purchaseHeader->show($id);
        }
        // $request->session()->flash('message','PR Line'.' '.$purchasebody['id'].' '.'deleted');
        //return redirect()->route('purchaseheader.show','purchaseHeaderId');
     
    }
}
