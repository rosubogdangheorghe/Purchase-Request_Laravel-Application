<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchasebody extends Model
{
    use HasFactory;
    protected $fillable = [
        'purchaseheaders_id',   
        'description',
        'unitMeasure',
        'quantity',
        'prvalue',
        'budgeted',
        'budgetLine',

    ];

    const UNIT_MEASURES = ['kg','pcs','batch'];
    const BUDGETED = ['yes','no'];

    public function getPrLines($id) {

        $prLines = DB::select("SELECT * FROM purchasebodies WHERE purchaseheaders_id = $id");
        return $prLines;

    }
    public function getAccountingCheck($id) {
        $accountingCheck = DB::select("SELECT purchasebodies.budgetLine FROM purchasebodies WHERE purchaseheaders_id = $id");
        return $accountingCheck;

    }

}
