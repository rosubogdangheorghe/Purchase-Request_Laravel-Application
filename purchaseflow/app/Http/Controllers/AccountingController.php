<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\PurchaseheaderController;
use App\Models\Purchaseheader;
use App\Models\Purchasebody;

class AccountingController extends Controller
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
     
             return view('accounting.index')->with('purchases',$purchases);
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

        return view('accounting.show',compact('purchaseHeaderById',$purchaseHeaderById))->with('prLines', $prLines);
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
    public function editPrLine(Purchasebody $purchasebody,$id)
    {
        $purchaseHeaderId =  Purchaseheader::findOrFail($id)->id;
        $purchaseHeader = new PurchaseHeader();
        $purchaseHeaderById =  $purchaseHeader->selectPurchaseHeaderById($purchaseHeaderId);
        $status = Purchaseheader::getStatus($purchaseHeaderId);
       
        $unitMeasures = Purchasebody::UNIT_MEASURES;
        $budgeted = Purchasebody::BUDGETED;

        if($status[0]->status == Purchaseheader::STATUS[1]) {
                return view('accounting.editPrLine',compact('purchasebody',$purchasebody))
                ->with('unitMeasures',$unitMeasures)->with('budgeted',$budgeted)->with('purchaseHeaderById',$purchaseHeaderById);
                
        } else {
              
                return $this->index();

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
        $purchasebody = Purchasebody::findOrFail($id);
        $purchasebody->purchaseheaders_id = $request->get('purchaseheaders_id');
        $purchasebody->description = $request->get('description');
        $purchasebody->unitMeasure = $request->get('unitMeasure');
        $purchasebody->quantity = $request->get('quantity');
        $purchasebody->unitPrice = $request->get('unitPrice');
        $purchasebody->prvalue = $request->get('prvalue');
        $purchasebody->budgeted = $request->get('budgeted');
        $purchasebody->budgetLine = $request->get('budgetLine');
        $purchasebody->save();
        return $this->show( $purchasebody->purchaseheaders_id);
    }


    public function countNull($var) {
        $count = 0;
        for($i=0;$i<sizeof($var);$i++) {
            if($var[$i]->budgetLine == "") {
                $count++;
              
            }
             
        }
        return $count;
    }

    public function promote($id){

            $status = Purchaseheader::STATUS[2];
            $purchaseHeaderId =  Purchaseheader::findOrFail($id)->id;
         
            $prBody = new Purchasebody();

   
            $accountingCheck = $prBody->getAccountingCheck($purchaseHeaderId);

            $count =  $this->countNull($accountingCheck);

            if($count > 0) {
                return redirect()->route('accounting.show',$id)->with('message','Please proceed with accounting check before promotion');
               
            } else {
                Purchaseheader::updateStatus($id,$status);  
                $contact = new ContactController();
                $email = 'rosu.bogdan@gmail.com';
                $purchaseheader = new Purchaseheader();
             
                $emailData = $purchaseheader->getEmailData($id);
           
                $contact->sendEmail($email,$emailData);

                return redirect()->route('accounting.index')->with('success','Purchase request promoted successfuly');
              
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
