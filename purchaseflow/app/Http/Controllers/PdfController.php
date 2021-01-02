<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchaseheader;
use App\Models\Purchasebody;
use \PDF;

class PdfController extends Controller
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
        $purchaseHeaderById =  $purchaseHeader->selectPurchaseRequisition($purchaseHeaderId);
        return view('pdf.show',compact('purchaseHeaderById',$purchaseHeaderById));
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

    public function createPDF($id) { 
        $purchaseHeaderId =  Purchaseheader::findOrFail($id)->id;
        $purchaseHeader = new Purchaseheader();
        $purchaseHeaderById =  $purchaseHeader->selectPurchaseRequisition($purchaseHeaderId);
        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php",true);

        $pdf->loadView('pdf.show',compact('purchaseHeaderById',$purchaseHeaderById))->setPaper('a4','landscape');
       
        return $pdf->stream($purchaseHeaderById[0]->purchaseheaders_id.'_'.$purchaseHeaderById[0]->issueDate.'.pdf');
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
