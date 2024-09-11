<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{Voidx,Sale, Payment,Mix,Comp,Promo};

class XmlUploadController extends Controller
{
    public function store(Request $request){

        $request->validate([
            'xmldata' => 'required',
         ]);

            if ($request->file('xmldata')) {
                $xmlData = $request->file('xmldata');
                $rawstring = file_get_contents($xmlData);
                $safestring = mb_convert_encoding($rawstring,'UTF-8');
                $safestring = preg_replace("|&([^;]+?)[\s<&]|","&amp;$1 ",$safestring);
                $xml = simplexml_load_string($safestring);
    
                $nodename = $xml->getName();
            
            if ($xml !== false) {
                
                if ($nodename === 'PAYMENTS') {
                    $result = $this->processPayments($xml);
                } elseif ($nodename === 'CATEGORIES') {
                    $result = $this->processSales($xml);
                } elseif ($nodename === 'PROMOS') {
                    $result = $this->processPromos($xml);
                } elseif ($nodename === 'VOIDS') {
                    $result = $this->processVoids($xml);
                } elseif($nodename === 'SALESMIX') {
                    $result = $this->processMix($xml);
                } elseif($nodename === 'COMPS') {
                    $result = $this->processComps($xml);
                } else {
                    $result = 'Eroor process Xml';
                }
    
                return response()->json($result,200);
            }
            } else {
                $result["message_return"] = array("ERROR" => true,"ERROR_MENSAGGE"=> "Error in read XML.");
                return response()->json(result, 404);
            }
        }
    
    
    protected function processPayments($xmlData)
    {
        try {
       
            Payment::where([
                ['id', '=', $xmlData->attributes()->ID],
                ['dob', '=', $xmlData->attributes()->DOB],
            ])->delete();

            foreach ($xmlData->children() as $payment) {
                $temp = new Payment();
                $temp->id = $xmlData->attributes()->ID;
                $temp->dob = $xmlData->attributes()->DOB;
                $temp->store_code = $xmlData->attributes()->STORECODE;
                $temp->store_name = $xmlData->attributes()->STORENAME;
                $temp->tender = $payment->TENDER;
                $temp->check_payments = $payment->CHECK;
                $temp->card = $payment->CARD;
                if($payment->EXP == '' || $payment->EXP == null)
                    $temp->exp = 0;
                else
                    $temp->exp = $payment->EXP;
                $temp->qty = $payment->QTY;
                $temp->amount = $payment->AMOUNT;
                $temp->total = $payment->TOTAL;
                $temp->employee_name = $payment->EMPLOYEENAME;
                $temp->employee_id = $payment->EMPLOYEEID;

                $temp->save();
            }
            $success = array("message" => "Payments created successfully");
    }
    catch (Exception $e) {
        $success = array("message" => "Wrong file, please upload a correct xml file", "alert" => "danger");
       
    }
    return response($success);
    }
    protected function processSales($xmlData)
    {
        try {
       
            Sale::where([
                ['id', '=', $xmlData->attributes()->ID],
                ['dob', '=', $xmlData->attributes()->DOB],
            ])->delete();
            foreach ($xmlData->children() as $sale) {
                $temp = new Sale();
                $temp->id = $xmlData->attributes()->ID;
                $temp->dob = $xmlData->attributes()->DOB;
                $temp->store_code = $xmlData->attributes()->STORECODE;
                $temp->store_name = $xmlData->attributes()->STORENAME;
                $temp->name = $sale->NAME;
                $temp->id_sale = $sale->ID;
                $temp->net_sale = $sale->NETSALES;
                $temp->comp = $sale->COMPS;
                $temp->promo = $sale->PROMOS;
                $temp->void = $sale->VOIDS;
                if($sale->TAXES == '' || $sale->TAXES == null)
                    $temp->taxes = 0;
                else
                    $temp->taxes = $sale->TAXES;
                $temp->grs_sale = $sale->GRSSALES;

                $temp->save();
            }
            $success = array("message" => "Sales created successfully");
    }
    catch (Exception $e) {
        $success = array("message" => "Wrong file, please upload a correct xml file", "alert" => "danger");
       
    }
    return response($success);
    }
    protected function processPromos($xmlData)
    {
        try {
            Promo::where([
                ['id', '=', $xmlData->attributes()->ID],
                ['dob', '=', $xmlData->attributes()->DOB],
            ])->delete();

            foreach ($xmlData->children() as $promo) {
                $temp = new Promo();
                $temp->id = $xmlData->attributes()->ID;
                $temp->dob = $xmlData->attributes()->DOB;
                $temp->store_code = $xmlData->attributes()->STORECODE;
                $temp->check_promo = $promo->CHECK;
                if($promo->CHECKNAME == '' || $promo->CHECKNAME == null)
                    $temp->check_name = 0;
                else
                    $temp->check_name = $promo->CHECKNAME;
                $temp->employee = $promo->EMPLOYEE;
                $temp->manager = $promo->MANAGER;
                $temp->store_name = $xmlData->attributes()->STORENAME;
                $temp->promo_type = $promo->PROMOTYPE;
                $temp->qty = $promo->QTY;
                $temp->amount = $promo->AMOUNT;
                $temp->emp_id = $promo->EMPID;
                $temp->man_id = $promo->MANID;

                $temp->save();
            }
            $success = array("message" => "Promo created successfully");
    }
    catch (Exception $e) {
        $success = array("message" => "Wrong file, please upload a correct xml file", "alert" => "danger");
       
    }
    return response($success);
    }
     
    protected function processVoids($xmlData){
  
        try {
       
                Voidx::where([
                    ['id', '=', $xmlData->attributes()->ID],
                    ['dob', '=', $xmlData->attributes()->DOB],
                ])->delete();
                foreach ($xmlData->children() as $void) {
                    $temp = new Voidx();
         
                    $temp->dob = $xmlData->attributes()->DOB;
                    $temp->store_code = $xmlData->attributes()->STORECODE;
                    $temp->store_name = $xmlData->attributes()->STORENAME;
                    $temp->check_void = $void->CHECK;
                    $temp->item = $void->ITEM;
                    $temp->reason = $void->REASON;
                    $temp->manager = $void->MANAGER;
                    $temp->time = $void->TIME;
                    $temp->server = $void->SERVER;
                    $temp->amount = $void->AMOUNT;
                    $temp->manager_id = $void->MANAGERID;
                    $temp->server_id = $void->SERVERID;
                    $temp->save();
                }
                $success = array("message" => "Voids created successfully");
        }
        catch (Exception $e) {
            $success = array("message" => "Wrong file, please upload a correct xml file", "alert" => "danger");
           
        }
        return response($success);
    }
    protected function processMix($xmlData)
    {
        try {
       
           
            Mix::where([
                ['id', '=', $xmlData->attributes()->ID],
                ['dob', '=', $xmlData->attributes()->DOB],
            ])->delete();

            foreach ($xmlData->children() as $mix) {
                $temp = new Mix();
                $temp->id = $xmlData->attributes()->ID;
                $temp->dob = $xmlData->attributes()->DOB;
                $temp->store_code = $xmlData->attributes()->STORECODE;
                $temp->store_name = $xmlData->attributes()->STORENAME;
                $temp->item_id = $mix->ITEMID;
                $temp->name = $mix->NAME;
                $temp->qty_sold = $mix->QTYSOLD;
                $temp->item_price = $mix->ITEMPRICE;
                $temp->total_price = $mix->TOTALPRICE;
                $temp->tax = $mix->TAX;
                $temp->cost_price = $mix->COSTPRICE;
                $temp->profit = $mix->PROFIT;

                $temp->save();
            }
            $success = array("message" => "Mixes created successfully");
    }
    catch (Exception $e) {
        $success = array("message" => "Wrong file, please upload a correct xml file", "alert" => "danger");
       
    }
    return response($success);
    }
    protected function processComps($xmlData)
    {
        try {
       
            Comp::where([
                ['id', '=', $xmlData->attributes()->ID],
                ['dob', '=', $xmlData->attributes()->DOB],
            ])->delete();

            foreach ($xmlData->children() as $comp) {
                $temp = new Comp();
                $temp->id = $xmlData->attributes()->ID;
                $temp->dob = $xmlData->attributes()->DOB;
                $temp->store_code = $xmlData->attributes()->STORECODE;
                $temp->store_name = $xmlData->attributes()->STORENAME;
                $temp->check_comps = $comp->CHECK;
                $temp->name = $comp->NAME;
                $temp->employee = $comp->EMPLOYEE;
                $temp->manager = $comp->MANAGER;
                $temp->comp_type = $comp->COMPTYPE;
                $temp->qty = $comp->QTY;
                $temp->amount = $comp->AMOUNT;
                $temp->emp_id = $comp->EMPID;
                $temp->man_id = $comp->MANID;

                $temp->save();
            }
            $success = array("message" => "Comp created successfully");
    }
    catch (Exception $e) {
        $success = array("message" => "Wrong file, please upload a correct xml file", "alert" => "danger");
       
    }
    return response($success);
    }
    

    

}
