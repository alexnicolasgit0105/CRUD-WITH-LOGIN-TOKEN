<?php

namespace App\Cash_Source;

use App\cash_source\Transaction;
use App\Rules\cash as validateCash;

use App\Models\Transaction as TransactionModel;

class Cash Implements Transaction {

    private $id;

	public function inputs($request) {

		$Transaction = new TransactionModel();

        $totalCash   = 0;
        $amount = $request->all()['amount'];

        foreach ($amount as $key => $cash) {
            $totalCash = $totalCash + $cash;
        }

        $totalQ   = 0;

        foreach ($request->all()['quantity'] as $key => $quantity) {
            $totalQ = $totalQ + $quantity;
        }
        $total = $totalQ * $totalCash;   
        $request = $request->all();

        $Transaction->total_amount  = $total;
        $Transaction->inputs  = json_encode([
            'type' => $request['type'],
            'banknotes' => [
                'amount'    => $request['amount'],
                'quantity' => $request['quantity'],
            ],
            'total' => $total
        ]);

        try {

            $response = $Transaction->save();
            $this->id = $Transaction->id;

            return [
                'status' => true,
                'data'	=> self::amount()
            ];

        } catch(\Illuminate\Database\QueryException $ex){
     
            return [
                'status' => false,
                'message' => $ex->getMessage()
            ]; 
        }

	}

	public function validate($amount) {

		$validated = $amount->validate([
		    'amount'	 => new validateCash($amount->all())
		]);

	}

    public function amount() {

        $response = TransactionModel::where([
            'id' => $this->id,
        ])->get()->toArray();
        return $response[0];
    }
	
}