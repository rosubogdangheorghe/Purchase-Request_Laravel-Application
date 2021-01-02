<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Purchaseheader extends Model
{
    use HasFactory;

    protected $fillable = [
        'issueDate',
        'deliveryDate',
        'costcenters_id',
        'suppliers_id',
        'suppliers_id',
        'currency',
        'fxRate',
        'status'

    ];

    const CURRENCIES = ['ron','euro','usd','jpy','gbp'];
    const STATUS = ['progress','issued','checked','approved','rejected','received'];


    public function selectPurchaseHeaders() {
        
        $purchases = DB::select('SELECT purchaseheaders.*, 
                    CONCAT(costcenters.code," ",costcenters.description) as costcenter,
                    CONCAT(suppliers.code," ",suppliers.description) as supplier,
                    users.username as user
                    FROM purchaseheaders
                    
                    JOIN costcenters ON purchaseheaders.costcenters_id = costcenters.id
                    JOIN suppliers ON  purchaseheaders.suppliers_id = suppliers.id 
                    JOIN users ON  purchaseheaders.users_id = users.id');

         return $purchases;
    }
            public function selectPurchaseHeaderById($id){
                $purchaseHeaderById = DB::select("SELECT purchaseheaders.*, 
                            CONCAT(costcenters.code,' ',costcenters.description) as costcenter,
                            CONCAT(suppliers.code,' ',suppliers.description) as supplier,
                            users.username as user FROM purchaseheaders
                            
                            JOIN costcenters ON purchaseheaders.costcenters_id = costcenters.id
                            JOIN suppliers ON  purchaseheaders.suppliers_id = suppliers.id 
                            JOIN users ON  purchaseheaders.users_id = users.id where purchaseheaders.id = $id");
                return $purchaseHeaderById;


            }

            public function selectPurchaseRequisition($id){
                $purchaseRequisition = DB::select("SELECT * FROM purchase_requisition where purchaseheaders_id = $id");


                return $purchaseRequisition;

        }

        public function getEmailData($id) {
                $getEmailData = DB::select("SELECT * FROM email_data WHERE purchaseheaders_id = $id");
                return  $getEmailData;


        }
        public static function updateStatus($id,$status) {

        $updateStatus = DB::table('purchaseheaders')->where('id', $id)->update(['status'=>$status]);

        return $updateStatus;

        }
        public static function getStatus($id) {

           //$status = DB::table('purchaseheaders','status')->where('id',$id)->get();
            $status = DB::select("SELECT purchaseheaders.status from purchaseheaders WHERE purchaseheaders.id = $id");
            
            return $status;
        }
        public static function selectCostcenter() {
            $ccId = DB::select('SELECT id,code, description from costcenters order by code');
            return $ccId;
        }

        public static function selectSupplier() {
            $suppId = DB::select('SELECT id,code, description from suppliers order by description');
            return $suppId;
        }
       
        public static function selectUser() {
            $userId = DB::select('SELECT id,firstName, lastName from users order by lastName');
            return $userId;
        }
      
}
